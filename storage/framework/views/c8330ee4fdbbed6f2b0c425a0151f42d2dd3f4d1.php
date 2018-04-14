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
        
   

             <h2>Managing my products</h2>



        <ul class="thumbnails ">
            <?php foreach($products as $product): ?>
            <li class="thumbnail col-md-3 col-sm-4 col-xs-8 card add_shadow " style="min-height:290px; <?php if($product->confirm ==0): ?>border:1px solid red; <?php endif; ?>">
                
                    <?php if($product->confirm ==0): ?> 
                    <strong>Waiting for moderation</strong>
                    <?php endif; ?>
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
                        
                        <?php elseif( $application_type ==2): ?>
                         <p  ><?php echo e(trans('c.Price')); ?>: <b><?php echo e($product->shop_price); ?></b> <?php echo e($product->code); ?> (<?php echo e($product->currency); ?>)</p>
                        <?php endif; ?>
                        <div  >
                         Category:    <?php echo e(trans('c.'.$product->category_name)); ?>

                        </div> 

                    </div>

        
                  <a  class="btn btn-success" style="line-height: 20px;" href="<?php echo e(URL::to('product/edit/'.$product->id)); ?>" >  
                      Edit
                    </a>   
 
                    <a  class="btn btn-danger " style="line-height: 20px;" href="<?php echo e(URL::to('product/delete/'.$product->id)); ?>"  onclick="if (!confirm('Are you sure to delete this auction?')) {
                                return false;
                            }
                            ;">  
                        Delete
                    </a>  
                
                    
                    
                    
                    
                </div>

            </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div>
        <?php echo $products->links(); ?>  
    </div>
    </div> 

</div>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>