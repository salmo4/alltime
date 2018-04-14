@extends('layout.main')

@section('head')

<script type="text/javascript">

    $(function() {

        //productid:
        //console.log(" productid: " + $("#productid").val());
        productid = $("#productid").val();

        current_images_str = $("#images_str").val();
        if (current_images_str != "") {
            // console.log(" current_images_str: " + current_images_str);
            images_strArr = current_images_str.split(",");
            for (var i = 0; i < images_strArr.length; i++) {
                if (images_strArr[i] != "") {
                    strFoo = "<div><img id='" + images_strArr[i].slice(0, -4) + "' src='{{ URL::to('/uploads/products/thumbs/small/') }}/" + images_strArr[i] + "' /><input type='button' id='deletebtn-" + productid + "-" + images_strArr[i] + "'  value='X' /></div>";
                    $("#images").append(strFoo);
                }
            }
        }

        //delete Images
        //$("#images :button").on("click", function() {
        $("#images").delegate("input:button", "click", function() {
            //console.log("katt!");
            $.get("imagedelete/" + $(this).attr('id'), function(data, status) {
                //console.log("#"+data);
                $("#" + data).parent().remove();
                
                //delete from #images_str
                current_images_str = $("#images_str").val();
                images_strArr = current_images_str.split(",");
                images_strArr2 = [];
                 for (var i = 0; i < images_strArr.length; i++) {
                        if (images_strArr[i].substring(0, images_strArr[i].length - 4) != data) {
                            images_strArr2.push(images_strArr[i]);
                        }
                }
                $("#images_str").val(images_strArr2.join());
                
            });
        });

        //get, set dropzonejs_place
        //  position = $("#dropzonejs_place").position();
        //  $("#dropzone_wrapper").css('top', position.top);


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
                if ($(this).attr('id') != undefined) {
                    // images_str += $(this).attr('id') + ",";
                    src = $(this).attr('src').split('/');
                    file = src[src.length - 1];
                    images_str += file + ",";
                }
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
                        strFoo = "<div><img id='" + responseText.slice(0, -4) + "' src='{{ URL::to('/uploads/products/originals') }}/" + responseText.substr(0, n) + "' /><input type='button' id='deletebtn-" + productid + "-" + responseText + "'    value='X'  /></div>";

                        $("#images").append(strFoo);

                        //append filename to input text value
                        $("#images_str").val($("#images_str").val() + responseText + ",");


                        $("#image_order_instruction").show();
                    } else {
                        alert('The file is large than 20 MB');
                    }
                });
            }
        };

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

        if ($("#fix_price_status").prop('checked')) {
            $('#buynow_price').hide();
            $('#label_buynow_price').hide();
        }


    });</script>


<script>
// jQuery From
    $(document).ready(function() {
        
        current_res ='';
        $('#product_edit_form').submit(function() {

            $(this).ajaxSubmit({
                success: function(res, statusText, xhr, $form) {
                    //   alert( res);
                    auctionmodal.open({content: res});
                    current_res =res;

                }
            });
            // return false to prevent normal browser submit and page navigation 

            return false;
        });


            $('body').on('click', '.modal-close', function() {
              //  console.log('katt');
                if(current_res.substr(0, 2)=='OK'){
                     window.location.href = "{{ URL::to('product/adminproductlist')}}";
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

<style>
    #images img{
        width: 150px;
        margin:10px;
        border: solid 1px;
    }   

    #images div{
        float:left;
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

@stop
@section('content')



<div class='col-lg-4 col-lg-offset-4' style="margin-bottom:300px;">
<!--
    @if (isset($edit_success))
    <div class="alert alert-success">
        {{trans('c.The modification is saved.') }} 
    </div>
    @endif
    -->
<!--
    @if ($errors->has())
    @foreach ($errors->all() as $error)
    <div class='bg-danger alert'>{{ $error }}</div>
    @endforeach
    @endif
-->

    <h2>Edit product</h2>
    <strong>{{  trans('c.Picture') }}:</strong>
    <div class='form-group'>
        You can add 10 photos. <br>
        If the red line appears under the picture please upload picture with less size.
    </div>
    <div id ="dropzone_wrapper">
        <form class="dropzone" method="POST" id ="my-dropzone" action="productaddwithdropimage" >

            <div class="dz-message">
                <h4>{{  trans('c.Drag Photos to Upload') }}</h4>
                <span> {{  trans('c.Or click to browse') }}</span>
            </div>

            <input type="hidden" name="additionaldata" value="{{ Auth::user()->id }}" />

            <!-- If you want control over the fallback form, just add it here: -->
            <div class="fallback"> <!-- This div will be removed if the fallback is not necessary -->
                Error!!
            </div>
        </form>

    </div>
    <br>
    <div id="image_order_instruction" style="font-weight:bold;" >
        {{  trans('c.Put the main picture to the start of the line') }}:
    </div>
    <div id="images">
    </div>
    <br style="clear:both;">
    <br>  <br>
    {{ Form::model($product, array('route' => array('product.postedit', $product->id), 'files'=> true, 'id'=>'product_edit_form')) }}	

    {{ Form::hidden('id', $product->id, [ 'id' => 'productid' ]) }}

    <div class='form-group'>
        {{ Form::label('title', trans('c.Name').":") }}
        {{ Form::text('title', null,  [ 'class' => 'form-control' ] ) }}
    </div>

    <div class='form-group'>
        {{ Form::label('description',  trans('c.Description').":") }}
        {{ Form::textarea('description', null, ['placeholder' => 'description', 'class' => 'form-control', 'id' => 'description']) }}
    </div>


    <div class='form-group'>


        {{ Form::hidden('images_str', $images_str, [ 'id' => 'images_str', 'style'=>'width:400px;']) }}


    </div>



<!--
    <div class='form-group'>
        {{ Form::label('fix_price_status',  trans('c.Fix price'). " :" ) }}
        {{ Form::checkbox('fix_price_status', null) }}
    </div>
-->

    <div class='form-group'>
        {{ Form::label('opening_price',  trans('c.Opening price'). " :" ) }}
        {{ Form::text('opening_price', null, [ 'class' => 'form-control', 'id' => 'opening_price', 'style'=>'width:100px;']) }}
    </div>
    <!--
        <div class='form-group'>
            {{ Form::label('lowest_price', 'Lowest price to accept:') }}
            {{ Form::text('lowest_price', null, [ 'class' => 'form-control', 'id' => 'lowest_price', 'style'=>'width:50px;']) }}
        </div>
    -->

    <div class='form-group'>
        {{ Form::label('buynow_price',  trans('c.Buy now price'). " :" ,  [  'id' => 'label_buynow_price']) }}
        {{ Form::text('buynow_price', null, [ 'class' => 'form-control', 'id' => 'buynow_price', 'style'=>'width:100px;']) }}
    </div>

    <div class='form-group'>
        {{ Form::label('', 'Currency'.":" ) }}
        {{ Form::select('currency_id', $currency_list, Request::old('currency_id'),  [ 'class' => 'form-control']) }}
    </div>

    <div class='form-group'>
        {{ Form::label('category_id',  trans('c.Category'). " :") }}
        {{ Form::select('category_id', $category_list, Request::old('category_id'),  [ 'class' => 'form-control']) }}
    </div>

    <div class='form-group'>
        {{ Form::label('timelimit',  " End of the Auction :" ) }}
        {{ Form::text('timelimit', null, [ 'class' => 'form-control', 'id' => 'timelimit', 'style'=>'width:100px;']) }}
    </div>

    <div class='form-group'>
        {{ Form::submit(trans('c.Save') , ['class' => 'btn btn-primary', 'id' => 'create_product_btn']) }}
    </div>

    {{ Form::close() }}




</div>



@stop