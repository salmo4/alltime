<?php $__env->startSection('head'); ?>

<script>
// jQuery From
    $(document).ready(function() {

        current_res = '';
        $('.basket_modify').submit(function() {

            $(this).ajaxSubmit({
                success: function(res, statusText, xhr, $form) {
                    //   alert( res);
                    auctionmodal.open({content: res});
                    //current_res =res;
                    $('.update_basket_btn').hide();
                }
            });
            // return false to prevent normal browser submit and page navigation 

            return false;
        });




    });

</script> 


<script>
// jQuery From
    $(document).ready(function() {

        current_res = '';
        $('.orderinformation_edit').submit(function() {

            $(this).ajaxSubmit({
                success: function(res, statusText, xhr, $form) {
                    //   alert( res);
                    auctionmodal.open({content: res});
                    //current_res =res;

                }
            });
            // return false to prevent normal browser submit and page navigation 

            return false;
        });




    });

</script> 

<script type="text/javascript">

    $(function() {
      /*  $('.quantity').on('input', function() {
            console.log('katt');
            $('#update_basket_btn').show();
            //  $('#post_order_btn').hide();
        });*/
        
         $(document).on("input", ".quantity" , function() {
         //console.log('katt');
         $('.update_basket_btn').show();

        });
    });
</script>



<script>

//opening basket page 
    $(document).ready(function() {

        //create an orderinformation record if it doen't exist
        $.get("<?php echo e(URL::to('/orderinformation_add')); ?>", function(data, status) {

        });
        
        ///load basket data
          $.get("<?php echo e(URL::to('/basket_get')); ?>", function(data, status) {
                    data = $.parseJSON(data);
                   // console.log(data);
                    var trHTML = '';
                    $.each(data, function(index, value) {
 trHTML += '<tr><td><input id="basketid_' + data[index]['basketid'] + '" type="hidden"  name="id[]" value="' + data[index]['basketid'] + '"   >' + data[index]['owner_name'] + ' </td><td>' + data[index]['cost_name'] + '</td><td>' + data[index]['title'] + '</td> <td><img src="<?php echo e(URL::to('/uploads/products/thumbs/small')); ?>/' + data[index]['image1'] + '"></td><td>' + data[index]['bid'] + '</td><td><a href="<?php echo e(URL::to('/basket/delete')); ?>/' + data[index]['basketid'] + '" onclick="if (!confirm(\'Are you sure to delete this item?\')) {return false;};"></a></td></tr>';
                    });

                   $('.basket_data').html('').append(trHTML);

                });
        

    });

</script> 



<script>
    $(document).ready(function() {
        $(".nav-tabs a").click(function() {
            //    console.log($(this).attr('id')) ;

            if ($(this).attr('id') == 'basket_tab') {
                $.get("<?php echo e(URL::to('/basket_get')); ?>", function(data, status) {
                    data = $.parseJSON(data);
                   // console.log(data);
                    var trHTML = '';
                    $.each(data, function(index, value) {
 trHTML += '<tr><td><input id="basketid_' + data[index]['basketid'] + '" type="hidden"  name="id[]" value="' + data[index]['basketid'] + '"   >' + data[index]['owner_name'] + ' </td><td>' + data[index]['cost_name'] + '</td><td>' + data[index]['title'] + '</td> <td><img src="<?php echo e(URL::to('/uploads/products/thumbs/small')); ?>/' + data[index]['image1'] + '"></td><td>' + data[index]['bid'] + '</td><td><a href="<?php echo e(URL::to('/basket/delete')); ?>/' + data[index]['basketid'] + '" onclick="if (!confirm(\'Are you sure to delete this item?\')) {return false;};"></a></td></tr>';
                    });

                   $('.basket_data').html('').append(trHTML);

                });
            }




            if ($(this).attr('id') == 'address_tab') {
                $.get("<?php echo e(URL::to('/orderinformation_get')); ?>", function(data, status) {
                    data = $.parseJSON(data);
                    //console.log(data);  
                    //$('#firstname').val(data['firstname']);  
                    $.each(data, function(index, value) {
                        //  console.log(index + ',' + value);
                        $('#' + index).val(data[index]);
                    });
                });
            }

            if ($(this).attr('id') == 'payment_tab') {
                $.get("<?php echo e(URL::to('/orderinformation_get')); ?>", function(data, status) {
                    data = $.parseJSON(data);
                    //console.log(data['payment_type']);              
                    $("#payment_type_" + data['payment_type']).attr('checked', 'checked');


                });
            }


            if ($(this).attr('id') == 'summary_tab') {
                
                $('.update_basket_btn').hide();
                
                        ///load basket data
          $.get("<?php echo e(URL::to('/basket_get')); ?>", function(data, status) {
                    data = $.parseJSON(data);
                   // console.log(data);
                    var trHTML = '';
                    $.each(data, function(index, value) {
 trHTML += '<tr><td><input id="basketid_' + data[index]['basketid'] + '" type="hidden"  name="id[]" value="' + data[index]['basketid'] + '"   >' + data[index]['owner_name'] + ' </td><td>' + data[index]['cost_name'] + '</td><td>' + data[index]['title'] + '</td> <td><img src="<?php echo e(URL::to('/uploads/products/thumbs/small')); ?>/' + data[index]['image1'] + '"></td><td>' + data[index]['bid'] + '</td><td><a href="<?php echo e(URL::to('/basket/delete')); ?>/' + data[index]['basketid'] + '" onclick="if (!confirm(\'Are you sure to delete this item?\')) {return false;};"> Delete from Basket </a></td></tr>';
                    });

                   $('.basket_data').html('').append(trHTML);

                });
                
                $.get("<?php echo e(URL::to('/orderinformation_get')); ?>", function(data, status) {
                    data = $.parseJSON(data);
                    $.each(data, function(index, value) {
                        $('#summary_' + index).val(data[index]);
                    });

                    $("#summary_payment_type_" + data['payment_type']).attr('checked', 'checked');

                });
            }

        });



    });
</script>


<script>
    $(document).ready(function() {
        $("#basket_next").click(function() {
            $('#address_tab').tab('show');
        });
    });
</script>

<?php $__env->stopSection(); ?>
<?php $__env->startSection("content"); ?>



<div class="container">

    <ul class="nav nav-tabs" id="myTab">
        <li class="active"><a data-target="#basket" data-toggle="tab" id ="basket_tab" >Basket</a></li>
        <li><a data-target="#order_information" data-toggle="tab"  id ="address_tab" >Address</a></li>
        <li><a data-target="#payment" data-toggle="tab" id ="payment_tab">Payment</a></li>
        <li><a data-target="#summary" data-toggle="tab" id ="summary_tab">Summary </a></li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="basket">

            <h1>Basket - Your Winning Bids</h1>

            <h4 style="color:blue">Please, fill and save the Address, Payment, Summary and send the the product order to the seller.</h4>  
            <br>

            <?php echo e(Form::open(array('action' => 'BasketController@basketPost' ,  'class'=>'basket_modify'))); ?>


            <table class="table">
                <thead>
                    <tr>
                        <td>
                            <b>Shop</b>
                        </td>
                        <td>
                            <b>Customer</b>
                        </td>

                        <td>
                            <b><?php echo e(trans('c.Name')); ?></b>
                        </td>
                        <td>
                            <b><?php echo e(trans('c.Picture')); ?></b>
                        </td>
                        <td>
                            <b>Your bid</b>
                        </td> 


                         <!-- 
                        <td>
                            <b><?php echo e(trans('c.delete')); ?></b>
                        </td> -->
                    </tr>
                </thead>
                <tbody class='basket_data'>


                </tbody>
            </table>

            <?php echo e(Form::submit("Update basket ", ['class' => 'btn btn-primary update_basket_btn', 'style'=>'display:none;'])); ?>

            </form>


            <!--
            <?php echo e(Form::open(array('action' => 'OrderController@postOrder' ))); ?> 
            <div class='form-group'>
                <?php echo e(Form::submit("Checkout ", ['class' => 'btn btn-primary', 'id' => 'post_order_btn'])); ?>

            </div>
            
            </form>                   
            -->                             

        <!--    <a href='#'  id='basket_next' class = 'btn btn-primary'>Next </a>-->

        </div>
        <div class="tab-pane" id="order_information">




            <?php echo e(Form::open(array('action' => 'OrderinformationController@edit' ,  'class'=>'orderinformation_edit'))); ?>


            <?php echo e(Form::hidden('order_information_type', 1)); ?>

            <h1>Billing address</h1>

            <div class='form-group'>
                <?php echo e(Form::label('firstname', "First name:")); ?>

                <?php echo e(Form::text('firstname', null, [ 'class' => 'form-control', 'id'=>'firstname'])); ?>

            </div>

            <div class='form-group'>
                <?php echo e(Form::label('lastname', "Last name:")); ?>

                <?php echo e(Form::text('lastname', null, [ 'class' => 'form-control' , 'id'=>'lastname'])); ?>

            </div>

            <div class='form-group'>
                <?php echo e(Form::label('street', "Street:")); ?>

                <?php echo e(Form::text('street', null, [ 'class' => 'form-control',  'id'=>'street'])); ?>

            </div>

            <div class='form-group'>
                <?php echo e(Form::label('city', "City:")); ?>

                <?php echo e(Form::text('city', null, [ 'class' => 'form-control', 'id'=>'city'])); ?>

            </div>

            <div class='form-group'>
                <?php echo e(Form::label('postal_code', "Postal code:")); ?>

                <?php echo e(Form::text('postal_code', null, [ 'class' => 'form-control', 'id'=>'postal_code'])); ?>

            </div>

            <div class='form-group'>
                <?php echo e(Form::label('email', 'Email:')); ?>

                <?php echo e(Form::email('email', null, ['placeholder' => 'Email', 'class' => 'form-control', 'id' => 'email'])); ?>

            </div>


            <h1>Delivery address</h1>


            <div class='form-group'>
                <?php echo e(Form::label('delivery_firstname', "First name:")); ?>

                <?php echo e(Form::text('delivery_firstname', null, [ 'class' => 'form-control' , 'id' => 'delivery_firstname'])); ?>

            </div>

            <div class='form-group'>
                <?php echo e(Form::label('delivery_lastname', "Last name:")); ?>

                <?php echo e(Form::text('delivery_lastname', null, [ 'class' => 'form-control' , 'id' => 'delivery_lastname'])); ?>

            </div>

            <div class='form-group'>
                <?php echo e(Form::label('delivery_street', "Street:")); ?>

                <?php echo e(Form::text('delivery_street', null, [ 'class' => 'form-control' , 'id' => 'delivery_street'])); ?>

            </div>

            <div class='form-group'>
                <?php echo e(Form::label('delivery_city', "City:")); ?>

                <?php echo e(Form::text('delivery_city', null, [ 'class' => 'form-control' , 'id' => 'delivery_city'])); ?>

            </div>

            <div class='form-group'>
                <?php echo e(Form::label('delivery_postal_code', "Postal code:")); ?>

                <?php echo e(Form::text('delivery_postal_code', null, [ 'class' => 'form-control' , 'id' => 'delivery_postal_code'])); ?>

            </div>
            
            <div class='form-group'>
                 <?php echo e(Form::label('message', "Order message:")); ?>

                <?php echo e(Form::textarea('message', null,  [ 'class' => 'form-control','id' => 'message', 'style'=>'width:300px;' ] )); ?>


            </div>

            <div class='form-group'>
                <?php echo e(Form::submit( 'Save', ['class' => 'btn btn-primary', 'id' => 'create_user_btn'])); ?>

            </div>
            


            <?php echo e(Form::close()); ?>


         <!--   <a href='#'  id='...basket_next' class = 'btn btn-primary'>Back </a>
            <a href='#'  id='....basket_next' class = 'btn btn-primary'>Next </a>-->

        </div>
        <div class="tab-pane" id="payment">


            <h1>Payment</h1>
            <div class="alert alert-info" style="padding-left : 50px;">
                <?php echo e(Form::open(array('action' => 'OrderinformationController@edit' ,  'class'=>'orderinformation_edit'))); ?>  
                <?php echo e(Form::hidden('order_information_type', 2)); ?>

                <div class="form">
                    <label class="control-label">
                        Please choose your payment method</label>
                    <label class="radio">
                        <?php echo e(Form::radio('payment_type', '1', true, ['id' => 'payment_type_1'] )); ?> Invoice
                    </label>
                    <label class="radio">
                        <?php echo e(Form::radio('payment_type', '2', false, ['id' => 'payment_type_2'] )); ?> Cash on delivery
                    </label>
                    <label class="radio">
                        <?php echo e(Form::radio('payment_type', '3', false, ['id' => 'payment_type_3'] )); ?> PayPal
                    </label>
                    <label class="radio">
                        <?php echo e(Form::radio('payment_type', '4', false, ['id' => 'payment_type_4'] )); ?>Prepayment
                    </label>
                </div>
                <div class='form-group'>
                    <?php echo e(Form::submit( 'Save', ['class' => 'btn btn-primary', 'id' => 'create_user_btn'])); ?>

                </div>
                <?php echo e(Form::close()); ?>

            </div>






        </div>
        <div class="tab-pane" id="summary">


            <h1>Basket</h1>




            <?php echo e(Form::open(array('action' => 'BasketController@basketPost' ,  'class'=>'basket_modify'))); ?>


            <table class="table">
                                <thead>
                    <tr>
                        <td>
                            <b>Shop</b>
                        </td>
                        <td>
                            <b>Customer</b>
                        </td>

                        <td>
                            <b><?php echo e(trans('c.Name')); ?></b>
                        </td>
                        <td>
                            <b><?php echo e(trans('c.Picture')); ?></b>
                        </td>
                        
                        <td>
                            <b>Your bid</b>
                        </td>


                        <!--
                        <td>
                            <b><?php echo e(trans('c.delete')); ?></b>
                        </td>
                        -->
                    </tr>
                </thead>
                <tbody class='basket_data'>
         

                </tbody>
            </table>

            <?php echo e(Form::submit("Update basket ", ['class' => 'btn btn-primary update_basket_btn', 'style'=>'display:none;'])); ?>

            <?php echo e(Form::close()); ?>


            
            <?php echo e(Form::open(array('action' => 'OrderinformationController@edit' ,  'class'=>'orderinformation_edit'))); ?>


            <?php echo e(Form::hidden('order_information_type', 3)); ?>

            <h1>Billing address</h1>
            <div class='form-group'>
                <?php echo e(Form::label('firstname', "First name:")); ?>

                <?php echo e(Form::text('firstname', null, [ 'class' => 'form-control', 'id'=>'summary_firstname'])); ?>

            </div>

            <div class='form-group'>
                <?php echo e(Form::label('lastname', "Last name:")); ?>

                <?php echo e(Form::text('lastname', null, [ 'class' => 'form-control' , 'id'=>'summary_lastname'])); ?>

            </div>

            <div class='form-group'>
                <?php echo e(Form::label('street', "Street:")); ?>

                <?php echo e(Form::text('street', null, [ 'class' => 'form-control',  'id'=>'summary_street'])); ?>

            </div>

            <div class='form-group'>
                <?php echo e(Form::label('city', "City:")); ?>

                <?php echo e(Form::text('city', null, [ 'class' => 'form-control', 'id'=>'summary_city'])); ?>

            </div>

            <div class='form-group'>
                <?php echo e(Form::label('postal_code', "Postal code:")); ?>

                <?php echo e(Form::text('summary_postal_code', null, [ 'class' => 'form-control', 'id'=>'summary_postal_code'])); ?>

            </div>

            <div class='form-group'>
                <?php echo e(Form::label('email', 'Email:')); ?>

                <?php echo e(Form::email('summary_email', null, ['placeholder' => 'Email', 'class' => 'form-control', 'id' => 'summary_email'])); ?>

            </div>


            <h1>Delivery address</h1>


            <div class='form-group'>
                <?php echo e(Form::label('delivery_firstname', "First name:")); ?>

                <?php echo e(Form::text('delivery_firstname', null, [ 'class' => 'form-control' , 'id' => 'summary_delivery_firstname'])); ?>

            </div>

            <div class='form-group'>
                <?php echo e(Form::label('delivery_lastname', "Last name:")); ?>

                <?php echo e(Form::text('delivery_lastname', null, [ 'class' => 'form-control' , 'id' => 'summary_delivery_lastname'])); ?>

            </div>

            <div class='form-group'>
                <?php echo e(Form::label('delivery_street', "Street:")); ?>

                <?php echo e(Form::text('delivery_street', null, [ 'class' => 'form-control' , 'id' => 'summary_delivery_street'])); ?>

            </div>

            <div class='form-group'>
                <?php echo e(Form::label('delivery_city', "City:")); ?>

                <?php echo e(Form::text('delivery_city', null, [ 'class' => 'form-control' , 'id' => 'summary_delivery_city'])); ?>

            </div>

            <div class='form-group'>
                <?php echo e(Form::label('delivery_postal_code', "Postal code:")); ?>

                <?php echo e(Form::text('delivery_postal_code', null, [ 'class' => 'form-control' , 'id' => 'summary_delivery_postal_code'])); ?>

            </div>


            <div class="form-group">
                <label class="control-label">
                    Please choose your payment method</label>
                <label class="radio">
                    <?php echo e(Form::radio('payment_type', '1', true, ['id' => 'summary_payment_type_1'] )); ?> Invoice
                </label>
                <label class="radio">
                    <?php echo e(Form::radio('payment_type', '2', false, ['id' => 'summary_payment_type_2'] )); ?> Cash on delivery
                </label>
                <label class="radio">
                    <?php echo e(Form::radio('payment_type', '3', false, ['id' => 'summary_payment_type_3'] )); ?> PayPal
                </label>
                <label class="radio">
                    <?php echo e(Form::radio('payment_type', '4', false, ['id' => 'summary_payment_type_4'] )); ?>Prepayment
                </label>
            </div>


            <div class='form-group'>
                 <?php echo e(Form::label('message', "Order message:")); ?>

                <?php echo e(Form::textarea('message', null,  [ 'class' => 'form-control',  'id' => 'summary_message', 'style'=>'width:300px;' ] )); ?>


            </div>
            
               <div class='form-group'>
                <?php echo e(Form::submit( 'Save', ['class' => 'btn btn-primary'])); ?>

            </div>

            <?php echo e(Form::close()); ?>

            
            
            
           
            <?php echo e(Form::open(array('action' => 'OrderController@postOrder' ))); ?> 
             <?php echo e(Form::submit( 'Send order', ['class' => 'btn btn-primary'])); ?>

            
            </form>                   
    

        </div>
    </div>

</div>

<?php $__env->stopSection(); ?>




<?php echo $__env->make('layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>