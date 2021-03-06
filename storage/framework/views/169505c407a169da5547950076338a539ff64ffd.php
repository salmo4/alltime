<?php $__env->startSection('head'); ?>

<script type="text/javascript">

    $(function() {
        
    
       
   
        current_images_str = $("#images_str").val();
        if (current_images_str != "") {
            //console.log(" current_images_str: " + current_images_str);
            images_strArr = current_images_str.split(",");
            for (var i = 0; i < images_strArr.length; i++) {
                strFoo = "<img id='" + images_strArr[i] + "' src='<?php echo e(URL::to('/uploads/products/originals')); ?>/" + images_strArr[i] + "' />";
                $("#images").append(strFoo);
            }
        }



        //images div sortable
        $("#images").sortable({
            change: function(event, ui) {
            }
        });
        $("#images").on("sortchange", function(event, ui) {
            images_str = "";
            //console.log("katt");
            $("#images img").each(function(index) {
                //console.log(index + ": " + $(this).attr('id'));
                images_str += $(this).attr('id') + ",";
            }
            );
            // console.log(images_str);
            $("#images_str").val(images_str);


        });
        // "myAwesomeDropzone" is the camelized version of the HTML element's ID
        Dropzone.options.myDropzone = {
            paramName: "image",
            autoProcessQueue: true,
            maxFiles: 10,
            maxFilesize: 20, // MB
            dictResponseError: "The picture is too big. Please upload picture with less size.",
          sending: function(file, xhr, formData) {
        // Pass token. You can use the same method to pass any other values as well such as a id to associate the image with for example.
        formData.append("_token", $('[name=_token').val()); // Laravel expect the token post value to be named _token by default
           },
    init: function() {
                this.on("success", function(file, responseText) {
                    // Handle the responseText here.

                    if (responseText != 'filenotvalid') {

                        //search | character
                        n = responseText.indexOf("|");
                        strFoo = "<img id='" + responseText + "' src='<?php echo e(URL::to('/uploads/products/originals')); ?>/" + responseText.substr(0, n) + "' />";
                        $("#images").append(strFoo);
                        // $("#images_str").append(responseText + ",");
                        //append filename to input text value
                        $("#images_str").val($("#images_str").val() + responseText + ",");


                        $("#image_order_instruction").show();
                    } else {
                        alert('The file is large than 20MB');
                    }
                });
            }
        };
        //
        //
        $("#fix_price_status").click(function() {
            //console.log("click");
            if ($("#fix_price_status").prop('checked')) {
                $('#buynow_price').hide();
                $('#label_buynow_price').hide();
            } else {
                $('#buynow_price').show();
                $('#label_buynow_price').show();
            }

        });
    });</script>


<script>
// jQuery From
    $(document).ready(function() {
        
        // CSRF protection
/*$.ajaxSetup(
{
    headers:
    {
        'X-CSRF-Token': $('input[name="_token"]').val()
    }
});*/
        
        
        current_res ='';
        $('#product_add_form').submit(function() {

            $(this).ajaxSubmit({
                success: function(res, statusText, xhr, $form) {
                    //   alert( res);
                    auctionmodal.open({content: res.substr( 2)});
                    current_res =res;

                }
            });
            // return false to prevent normal browser submit and page navigation 

            return false;
        });


            $('body').on('click', '.modal-close', function() {
              //  console.log('katt');
                if(current_res.substr(0, 2)=='OK'){
                     window.location.href = "<?php echo e(URL::to('product/adminproductlist')); ?>";
                }
            });

    });

</script> 

  <script>
  $( function() {
    $( "#timelimit" ).datepicker(
            {
                format: 'yyyy-mm-dd'
            }
            );
  } );
  </script>
  
  <script>
      //plus 2 weeks
 var fortnightAway = new Date(+new Date + 12096e5);
 
 function formatDate(d) {
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [year, month, day].join('-');
}
      $(document).ready(function () {
    //console.log(formatDate(fortnightAway));
   $("#timelimit").val(formatDate(fortnightAway));     

 });
</script>

<style>
    #images img{
        width: 150px;
        margin:10px;
        border: solid 1px;
    }    
    .dz-details img {

        position: absolute;
        top: 0px;
        left: 0;
        width: 100px;
        height: 100px;
    }

    .dropzone {
        min-height: 260px;
        width: 500px;
        border: dashed 1px red;
        background-color: lightblue;
    }
</style>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>



<div class='col-lg-4 col-lg-offset-4'  style="margin-bottom:300px;">
<!--
    <?php if($errors->has()): ?>
    <?php foreach($errors->all() as $error): ?>
    <div class='bg-danger alert'><?php echo e($error); ?></div>
    <?php endforeach; ?>
    <?php endif; ?>
-->

    <h2><i class='fa fa-user'></i> 
         <?php if( $application_type ==3): ?>New advertisement
         <?php elseif( $application_type ==1): ?>
         Add auction
         <?php else: ?> 
         Add product
         <?php endif; ?>
        
    </h2>
    <strong><?php echo e(trans('c.Picture')); ?>: </strong>
    <div class='form-group'>
        You can add 10 photos.  <br>
        If the red line appears under the picture please upload picture with less size.
    </div>

    <div  id ="dropzone_wrapper">
        <form class="dropzone" method="POST" id ="my-dropzone" action="productaddwithdropimage" >
            <div class="dz-message">
                <h4><?php echo e(trans('c.Drag Photos to Upload')); ?></h4>
                <span> <?php echo e(trans('c.Or click to browse')); ?></span>
            </div>

            <input type="hidden" name="additionaldata" value="<?php echo e(Auth::user()->id); ?>" />

            <!-- If you want control over the fallback form, just add it here: -->
            <div class="fallback"> <!-- This div will be removed if the fallback is not necessary -->
                Error!!
            </div>
        </form>

    </div>
    <br>
    <div id="image_order_instruction" style="font-weight:bold;display:none" >
        <?php echo e(trans('c.Put the main picture to the start of the line')); ?>:
    </div>
    <div id="images">
    </div>

    <?php echo e(Form::open(array('action' => 'ProductController@productAdd','files' => true,  'id'=>'product_add_form'))); ?>



    <div class='form-group'>
        <?php echo e(Form::label('title', trans('c.Name').":")); ?>

        <?php echo e(Form::text('title', null,  [ 'class' => 'form-control' ] )); ?>

    </div>

    <div class='form-group'>
        <?php echo e(Form::label('description',  trans('c.Description').":")); ?>

        <?php echo e(Form::textarea('description', null, ['placeholder' => 'description', 'class' => 'form-control', 'id' => 'description'])); ?>

    </div>



    <div class='form-group'>


        <?php echo e(Form::hidden('images_str', '', [ 'id' => 'images_str' ])); ?>

        <!--
        <?php echo e(Form::textarea('xximages_str', null, ['size' => '50x4', 'id' => 'xximages_str' ])); ?>

        -->
    </div>

<?php if( $application_type ==2 or $application_type ==3): ?>
    <div class='form-group'>
        <?php echo e(Form::label('price',  " Price :" )); ?>

        <?php echo e(Form::text('shop_price', null, [ 'class' => 'form-control', 'id' => 'shop_price', 'style'=>'width:100px;'])); ?>

    </div>
<?php endif; ?>

<?php if( $application_type ==1): ?>
   
<!--
   <div class='form-group'>
        <?php echo e(Form::label('fix_price_status',  trans('c.Fix price'). " :" )); ?>

        <?php echo e(Form::checkbox('fix_price_status', null, false)); ?>

    </div>
-->

    <div class='form-group'>
        <?php echo e(Form::label('opening_price',  trans('c.Opening price'). " :" )); ?>

        <?php echo e(Form::text('opening_price', null, [ 'class' => 'form-control', 'id' => 'opening_price', 'style'=>'width:100px;'])); ?>

    </div>
    <!--
        <div class='form-group'>
            <?php echo e(Form::label('lowest_price', 'Lowest price to accept:')); ?>

            <?php echo e(Form::text('lowest_price', null, [ 'class' => 'form-control', 'id' => 'lowest_price', 'style'=>'width:50px;'])); ?>

        </div>
    -->

    <div class='form-group'>
        <?php echo e(Form::label('buynow_price',  trans('c.Buy now price'). " :" , [  'id' => 'label_buynow_price'])); ?>

        <?php echo e(Form::text('buynow_price', null, [ 'class' => 'form-control', 'id' => 'buynow_price', 'style'=>'width:100px;'])); ?>

    </div>
<?php endif; ?>


    <div class='form-group'>
        <?php echo e(Form::label('', 'Currency'.":" )); ?>

        <?php echo e(Form::select('currency_id', $currency_list, $mycurrency_id,  [ 'class' => 'form-control'])); ?>

    </div>

    <div class='form-group'>
        <?php echo e(Form::label('category_id',  trans('c.Category'). " :")); ?>

        <?php echo e(Form::select('category_id', $category_list, Request::old('category_id'),  [ 'class' => 'form-control'])); ?>

    </div>

    <div class='form-group'>
        <?php echo e(Form::label('timelimit',  " End of the Auction :" )); ?>

        <?php echo e(Form::text('timelimit', null, [ 'class' => 'form-control', 'id' => 'timelimit', 'style'=>'width:100px;'])); ?>

    </div>

    <div class='form-group'>
        <?php echo e(Form::submit(trans('c.Save') , ['class' => 'btn btn-primary', 'id' => 'create_product_btn'])); ?>

    </div>

    <?php echo e(Form::close()); ?>





</div>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>