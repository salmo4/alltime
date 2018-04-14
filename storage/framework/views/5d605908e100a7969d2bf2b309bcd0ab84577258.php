<?php $__env->startSection('head'); ?>




<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="container" style="width:">
         <h3> <a href="<?php echo e(URL::to('mainbids')); ?>"><< Back to the main page of Bids</a></h3>


    <h3> <a href="<?php echo e(URL::to('mainbids')); ?>">Arrived bids by products</a>  |   Sent bids by products</h3>
    <form action="order" method="post" accept-charset="UTF-8">
        <table class="table">
            <tbody>
                <tr>

                    <td>
                        <b><?php echo e(trans('c.Name')); ?></b>
                    </td>
                    <td>
                        <b><?php echo e(trans('c.Picture')); ?></b>
                    </td>
                    
                    <td>
                        <b>Buy now price</b>
                    </td>
                     <td>
                        <b>Current Max Bid Price</b>
                    </td>
                    <td>
                        <b>Count of the bids</b>
                    </td>



                </tr>
                <?php foreach($main_bid_products as $bid_item): ?>
                <tr>


                    <td>
                  
                     <a href="<?php echo e(URL::to('sentbids/'.$bid_item->product_id)); ?>"> <h5><?php echo e($bid_item->title); ?> >> </h5>   </a>     
                    </td>
                    <td>  <a href="<?php echo e(URL::to('sentbids/'.$bid_item->product_id)); ?>"> 
                                 <img src="<?php echo e(URL::asset('/uploads/products/thumbs/small/'.$bid_item->image1)); ?>" alt="picture" >   
                        </a></td>
                   <td><?php echo e($bid_item->buynow_price); ?> </td>
                    <td><?php echo e($bid_item->maxbidprice); ?> </td>
                    <td><?php echo e($bid_item->bids_count); ?> </td>




                </tr>

                <?php endforeach; ?>

            </tbody>
        </table>


    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>