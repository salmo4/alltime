<?php $__env->startSection('head'); ?>




<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="container" style="width:">
        <h1> <a href="<?php echo e(URL::to('mainbids')); ?>">Bids</a></h1>


    <h3>Arrived bids by products  |    <a href="<?php echo e(URL::to('sentbids')); ?>">Sent bids by products</a></h3>
    <form action="order" method="post" accept-charset="UTF-8">
        <table class="table">
            <tbody>
                <tr>

                    <td>
                        <b><?php echo e(trans('c.Name')); ?> /Bids</b>
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
                    
                     <td>
                        <b> Closing this Auction</b>
                    </td>


                </tr>
                <?php foreach($main_bid_products as $bid_item): ?>
                <tr>


                    <td>
                        <a href="<?php echo e(URL::to('bids/'.$bid_item->product_id)); ?>"> <h5><?php echo e($bid_item->title); ?> >> </h5>   </a>     
                    </td>
                    <td>  <a href="<?php echo e(URL::to('bids/'.$bid_item->product_id)); ?>"> 
                     <img src="<?php echo e(URL::asset('/uploads/products/thumbs/small/'.$bid_item->image1)); ?>" alt="picture" >   
                        </a></td>
                    <td><?php echo e($bid_item->buynow_price); ?> </td>
                    <td><?php echo e($bid_item->maxbidprice); ?> </td>
                    <td><?php echo e($bid_item->bids_count); ?> </td>


                      <td>
                     <?php if($bid_item->opened ==1): ?>
                    <?php echo e(Form::open(array('action' => 'ProductController@productClose'))); ?>

                        <?php echo e(Form::hidden('product_id', $bid_item->product_id)); ?> 
                        <?php echo e(Form::submit('Closing Auction' , ['class' => 'btn btn-success', 'style'=>""])); ?>

                     <?php echo e(Form::close()); ?>

                     
                        <?php else: ?>
                       <?php echo e(Form::open(array('action' => 'ProductController@productOpen'))); ?>

                        <?php echo e(Form::hidden('product_id', $bid_item->product_id)); ?> 
                        <?php echo e(Form::submit('Reopening Auction' , ['class' => 'btn btn-danger', 'style'=>""])); ?>

                     <?php echo e(Form::close()); ?>

                        <?php endif; ?>
                     </td>
                </tr>

                <?php endforeach; ?>

            </tbody>
        </table>


    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>