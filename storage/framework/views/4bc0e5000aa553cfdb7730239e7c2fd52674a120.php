<?php $__env->startSection('title'); ?>
<?php echo e($product->title); ?> - <?php echo e($product->opening_price); ?> <?php echo e(trans('c.monetary unit')); ?> | 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('head'); ?>






<style>


    .carousel-inner > .item > img, .carousel-inner > .item > a > img {
        width: 100%;
        margin: auto;
    }


</style>  


<script>
// jQuery From
    $(document).ready(function () {


        current_res = '';
        $('#message2_form').submit(function () {

            $(this).ajaxSubmit({
                success: function (res, statusText, xhr, $form) {
                    //   alert( res);
                    auctionmodal.open({content: res});
                    current_res = res;
                    if (current_res.substr(0, 2) == 'OK') {
                        $('#message2_form')[0].reset();
                        //  $('#message2_form').hide();
                    }

                    $("#captcha_image").attr('src', "<?php echo e(URL::to('captcha')); ?>" + '?' + Math.random());

                }
            });
            // return false to prevent normal browser submit and page navigation 

            return false;
        });

    });

</script> 



<script>

    //captcha_image_place
    $(document).ready(function () {

        $("#captcha_image").attr("src", "<?php echo e(URL::to('captcha')); ?>");

//new captcha load
        $('#new_captcha_image').click(function (e) {
            // console.log('katt');
            // $("#captcha_image").attr("src","<?php echo e(URL::to('captcha')); ?>");
            $("#captcha_image").attr('src', "<?php echo e(URL::to('captcha')); ?>" + '?' + Math.random());
        });

        $("#send_message_btn").click(function (result) {
            // $("#captcha_image").attr('src', "<?php echo e(URL::to('captcha')); ?>"+'?'+Math.random());

        });

    });</script> 

<script>
    $(document).ready(function () {
var date1 = $("#timelimit").html();
var date2 = new Date();
var date1 = new Date(date1.replace(/-/g,'/'));  
if(date1 > date2){
 $("#timelimit").css('color','green');   
}else{
   $("#timelimit").css('color','red');     
}
 });
</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


<div class="container">

    <div class="row">
        <div class='col-xs-12' >

            <?php if( $application_type ==1): ?>  <a  class="navbar-brand" href="<?php echo e(URL::to('index')); ?>/1"><i class="fa fa-chevron-circle-left   fa-1x " ></i> <?php echo e(trans('c.Back to the list')); ?></a> <?php endif; ?>
            <?php if( $application_type ==2): ?>  <a  class="navbar-brand" href="<?php echo e(URL::to('index')); ?>/2"<i class="fa fa-chevron-circle-left   fa-1x " ></i>  <?php echo e(trans('c.Back to the list')); ?></a> <?php endif; ?>
            <?php if( $application_type ==3): ?>  <a  class="navbar-brand" href="<?php echo e(URL::to('index')); ?>/3"<i class="fa fa-chevron-circle-left   fa-1x " ></i>  <?php echo e(trans('c.Back to the list')); ?></a> <?php endif; ?>
        </div>

        <div class="fb-like" data-href="http://blogbook.hu/auction/" data-layout="standard" data-action="like" data-show-faces="false" data-share="true"></div>
    </div>
    <div class="row">
        <div class='col-xs-9' >
            <h3><?php echo e($product->category_name); ?></h3>

            <h2><?php echo e($product->title); ?>

            
             <?php if(  $product->opened == 0): ?>
          <span style="color:red;">  -  Closed Auction </span>
            <?php endif; ?>
            
            </h2>


            <p><?php echo e(trans('c.Vendor')); ?> : <b><?php echo e($product->user_name); ?></b></p>
            <h3><?php echo e(trans('c.Description')); ?>:</h3> 

            <h5><?php echo e($product->description); ?></h5>

            <?php if( $application_type ==1): ?>
            <?php if($product->fix_price_status =="on"): ?>
            <h5><b>Fix Price: </b> <?php echo e($product->opening_price); ?> <?php echo e($product->currency_code); ?> (<?php echo e($product->currency_currency); ?>)</h5>
            <?php else: ?>               

            <h5><b><?php echo e(trans('c.Opening price')); ?>:</b> <?php echo e($product->opening_price); ?> <?php echo e($product->currency_code); ?>  (<?php echo e($product->currency_currency); ?>) </h5>
            <!--
            <p><?php echo e(trans('c.Lowest price')); ?>: <b><?php echo e($product->lowest_price); ?></b></p>
            -->
            <h5> <b><?php echo e(trans('c.Buy now price')); ?>:</b> 
                 <?php if($product->buynow_price != ""): ?> 
                <?php echo e($product->buynow_price); ?> <?php echo e($product->currency_code); ?>  (<?php echo e($product->currency_currency); ?>)
                <?php endif; ?>
            </h5>
            <?php endif; ?>
            <?php elseif( $application_type ==2 or $application_type ==3): ?>
            <h5 ><b><?php echo e(trans('c.Price')); ?>:</b> <?php echo e($product->shop_price); ?> <?php echo e($product->currency_code); ?> (<?php echo e($product->currency_currency); ?>)</h5>
            <?php endif; ?>
            
            <h5> <b>End of the Auction:</b> 
                <span id="timelimit"><?php echo e($product->timelimit); ?></span> 

            </h5>
        </div>
    </div>

    <div class="row">  
        <div class='col-md-6 col-xs-12' style="padding:0px;" >

            <!--carousel--> 

            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">

                    <?php for($n = 1; $n <= 10; ++$n): ?>
                    <?php if($product->{'image'.$n} !="default.jpg" ): ?>
                    <li data-target="#myCarousel" data-slide-to="<?php echo e($n); ?>"></li>
                    <?php endif; ?>
                    <?php endfor; ?>  
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox" >

                    <?php for($n = 1; $n <= 10; ++$n): ?>
                    <?php if($product->{'image'.$n} !="default.jpg" ): ?>
                    <div class="item <?php if($n == 1): ?>active <?php endif; ?>">
                        <img src="<?php echo e(URL::asset('/uploads/products/thumbs/medium/'.$product->{'image'.$n})); ?>" alt="picture" >
                    </div>
                    <?php endif; ?>
                    <?php endfor; ?>  


                </div>

                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

            <!--carousel end-->     

        </div>
        <div class='col-md-6 col-xs-12' >

            <?php if(Auth::check() && $product->fix_price_status =="on" || $minprice > $product->buynow_price): ?>
            
            <?php if( $minprice > $product->buynow_price && $product->fix_price_status !="on" ): ?>
            <h4> <span style="color:blue">The price of the  product has been reached the buy now price! </span>
                <br>
            The seller will connect with the bidder.
            </h4>
            <?php endif; ?>
          
            <form action="<?php echo e(URL::to('basket/add')); ?>"  method="post" accept-charset="UTF-8">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>" />

                <input type="hidden" name="admin_id" value="<?php echo e($product->admin_id); ?>" />

                <div class='form-inline'>
                    <?php echo e(Form::label('quantity', "Quantity:", [ 'style'=>'margin-left:10px;' ])); ?>

                    <?php echo e(Form::text('quantity', 1,  [ 'class' => 'form-control', 'style'=>'width:50px;margin-left:10px;' ] )); ?> 
                </div>

                <div class="form-group">
                    <input class="btn btn-info"  type="submit" name="submit" value="<?php echo e(trans('c.Add to basket')); ?>" />
                </div>

            </form>
          
            <?php endif; ?>
           <?php if(Auth::check() && $application_type ==1  && ($minprice < $product->buynow_price || $product->fix_price_status =="on")): ?>
            <form action="<?php echo e(URL::to('bid/add')); ?>"  method="post" accept-charset="UTF-8">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <input type="hidden" name="product" value="<?php echo e($product->id); ?>" />

                <input type="hidden" name="admin_id" value="<?php echo e($product->admin_id); ?>" />

                <input type="hidden" name="fix_price_status" value="<?php echo e($product->fix_price_status); ?>" />

                <?php if($product->fix_price_status !="on"): ?>

                <h4> <?php echo e(trans('c.Enter')); ?> <?php echo e($minprice); ?> <?php echo e($product->currency_code); ?>  (<?php echo e($product->currency_currency); ?>) or more:</h4>

                <?php endif; ?>

                <input type="hidden" name="minprice" value="<?php echo e($minprice); ?>" />
                <br>
                <div class='form-group'>
                    <?php if($product->fix_price_status !="on"): ?>
                    <?php echo e(Form::label('bid_value', trans('c.Bid value').":")); ?>

                    <?php echo e(Form::text('price', null,  [ 'class' => 'form-control', 'style'=>'width:100px;' ] )); ?> <?php echo e(trans('c.monetary unit')); ?>

                    <br>  <br>
                    <?php endif; ?>
                    <?php echo e(Form::label('message', trans('c.Private message').":")); ?>

                    <?php echo e(Form::textarea('message', null,  [ 'class' => 'form-control', 'style'=>'width:300px;' ] )); ?>

                </div>
                <?php if($product->fix_price_status !="on"): ?>
                <input class="btn btn-info"  type="submit" name="submit" value="<?php echo e(trans('c.Place bid')); ?>" />
                <?php else: ?>
                <input class="btn btn-info"  type="submit" name="submit2" value="Make an offer" />
                <?php endif; ?>

            </form>
            <?php elseif(!Auth::check() && $application_type ==1 ): ?>
            <br>     <br><!-- <?php echo e(trans('c.Place bid')); ?> -->
            <a href="<?php echo e(URL::route('user/login')); ?>"> <button class="btn btn-info"><i class="fa fa-legal fa-1x " ></i>  <?php if($product->fix_price_status =="on"): ?> Buy now  <?php else: ?>   Bid now <?php endif; ?> <br> <i class="fa fa-sign-in fa-1x " ></i> <?php echo e(trans('c.Please Login')); ?></button></a>  

            <?php elseif(!Auth::check() && $application_type ==2 ): ?>
            <br>     <br>
            <a href="<?php echo e(URL::route('user/login')); ?>"> <button class="btn btn-info"><i class="fa fa-cart-arrow-down fa-1x " ></i> Add to basket <br> <i class="fa fa-sign-in fa-1x " ></i>  <?php echo e(trans('c.Please Login')); ?></button></a>  

            <?php endif; ?> 


            <br> <br>
           <!--
            <div style="background: #ccc;padding:20px; width:350px;">
            <h4> Sending message to the vendor </h4> 
            <form action="<?php echo e(URL::to('message/add2')); ?>"  method="post" accept-charset="UTF-8" id='message2_form'>
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>" />
                <input type="hidden" name="admin_id" value="<?php echo e($product->admin_id); ?>" />
                <br>
                <div class='form-group'>

                    <?php echo e(Form::label('Email', 'Your email address:')); ?>

                    <?php echo e(Form::email('email', null,  [ 'class' => 'form-control', 'style'=>'width:300px;','id'=>'message_email' ] )); ?> 
                    <br><br>
                    <?php echo e(Form::label('message','Message for the vendor:')); ?>

                    <?php echo e(Form::textarea('message', null,  [ 'class' => 'form-control', 'style'=>'width:300px;' ] )); ?>

                </div>
                <div class='form-group'>

          
                    <img id="captcha_image" /> 
                </div>

                <?php echo e(Form::label('Email', 'Please enter the code above!')); ?><br>
                <?php echo e(Form::text('captcha', null,  [ 'class' => 'form-control', 'style'=>'width:300px;' ] )); ?> 
                <br>
                <?php echo e(Form::button('<i class="fa fa-envelope fa-1x " ></i> '.trans('c.Send message') , ['type' => 'submit', 'class' => 'btn btn-primary' ,'id'=>'send_message_btn'])); ?>


            </form>
             </div>
           -->
        </div>
    </div>  
    
<div class="row" style="padding:50px;"> 
 <!-- 
    
    Advertisement: <br> 
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-9781487221982398"
     data-ad-slot="9464890595"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
-->
</div> 
    
    
    <br>  <br>
</div>
</div>



</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>