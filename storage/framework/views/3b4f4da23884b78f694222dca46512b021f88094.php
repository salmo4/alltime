<?php $__env->startSection('head'); ?>
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap_custom_auction_webshop.css')); ?>">

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>


<style>
    .col-md-4 {
        min-height: 1px;
        padding-left: 15px;
        padding-right: 15px;
        position: relative;
        float: left;
        width: 33.3333%;
    }


    .card {
        background-color: #fff;
        border-radius: 2px;
        margin: 10px;
        overflow: hidden;
        position: relative;
        transition: box-shadow 0.25s ease 0s;
        text-align: center;
    }
    
    
        .card-image {
            position: absolute;
            clip: rect(0px,300px,100px,0px);
            height:120px; 
            left: 0;
            right: 0; 
            margin-left: auto;
            margin-right: auto;
    }
</style>

<div class="container">



    <div class="row">





        <ul class="thumbnails ">
            <?php foreach($products as $product): ?>
            <li class="thumbnail col-md-3 col-sm-4 col-xs-8 card add_shadow " style="height:320px;">
                <div style="padding:10px;">
                    <div class='card-image' style="">

                        <a  href="<?php echo e(URL::to('product/'.$product->id)); ?>" > 
                        
                        <img src="<?php echo e(URL::asset('/uploads/products/thumbs/small/'.$product->image1)); ?>" alt="picture" >
                        </a>
                        </a>
                    </div>
                    <div  style="height:100px;"></div>

                    <h4 ><?php echo e(link_to('product/'.$product->id, $product->title)); ?></h4>

                    <div style="margin-top:10px;">
                        <div  ><?php echo e(trans('c.Vendor')); ?> :  <b><?php echo e($product->user_name); ?></b> 
                        </div> 
                         <?php if( $application_type ==1): ?>
                        <?php if($product->fix_price_status =="on"): ?>
                        <p  ><?php echo e(trans('c.Price')); ?>: <b><?php echo e($product->opening_price); ?></b> <?php echo e($product->code); ?> (<?php echo e($product->currency); ?>)</p>
                        <div  ></div> 
                        <?php else: ?>  
                        <div  ><?php echo e(trans('c.Opening price')); ?> : <b><?php echo e($product->opening_price); ?></b> <?php echo e($product->code); ?> (<?php echo e($product->currency); ?>)
                        </div> 
                        <div  >
                            <?php if(empty($product->maxbidprice)): ?>
                            <?php echo e(trans('c.Minimal price')); ?> : <b><?php echo e($product->opening_price); ?></b> <?php echo e($product->code); ?> (<?php echo e($product->currency); ?>)
                            <?php else: ?>
                            <?php echo e(trans('c.Minimal price')); ?> : <b><?php echo e($product->maxbidprice); ?></b> <?php echo e($product->code); ?> (<?php echo e($product->currency); ?>)
                            <?php endif; ?>
                        </div> 
                        <?php endif; ?>
                        
                        <?php elseif( $application_type ==2 or $application_type ==3): ?>
                         <p  ><?php echo e(trans('c.Price')); ?>: <b><?php echo e($product->shop_price); ?></b> <?php echo e($product->code); ?> (<?php echo e($product->currency); ?>)</p>
                        <?php endif; ?>
                        <div  >
                          <?php echo e(trans('c.Category')); ?> :   <?php echo e(trans('c.'.$product->category_name)); ?>

                        </div> 

                    </div>
                  <!--  <?php echo e(trans('c.Read more')); ?>-->
                      
                    <a  href="<?php echo e(URL::to('product/'.$product->id)); ?>" >  
                        <button class="btn btn-info waves-effect waves-light" type="button"><?php if($product->fix_price_status =="on"): ?> Buy now  <?php else: ?>   Bid now <?php endif; ?><i class="fa fa-arrow-circle-right  fa-1x " ></i></button>
                    </a>

                </div>

            </li>
            <?php endforeach; ?>
        </ul>
        
        

    </div>
    <div class="row" > 
      <div class="row" style="margin-top:40px;">
          <div class="col-md-2" style="text-align: center;">
          <h4 >  <?php echo e(trans('c.vendors')); ?>:</h4>
           </div>
             <div class="col-md-12">
           <ul class="thumbnails ">
           <?php foreach($sellers as $seller): ?> 
            <li class="thumbnail col-md-3 col-sm-4 col-xs-8 card add_shadow ">  <strong ><a style="display: block;" href="<?php echo e(URL::to('index/0/'.$seller->id)); ?>" ><span class="glyphicon glyphicon-user"></span>   <?php echo e($seller->name); ?> </a>   </strong ></li>
                <?php endforeach; ?>     
           </ul>
           </div>
          

     </div>
        <?php echo $products->links(); ?>  
    
     </div>
    
    
   <div class="row" style="padding:50px;">
 <!--
    Advertisement: <br> 
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-9781487221982398"
     data-ad-slot="2081224597"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
-->
</div> 
    
    </div>




<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>