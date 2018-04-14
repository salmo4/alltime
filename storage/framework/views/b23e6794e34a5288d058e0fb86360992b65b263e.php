<?php $__env->startSection('head'); ?>




<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="container" style="width:">
        <h1> All bids</h1>


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
                        <b>Count of the bids</b>
                    </td>


                </tr>
                <?php foreach($main_bid_products as $bid_item): ?>
                <tr>


                    <td>
                     <a href="<?php echo e(URL::to('super_bid/'.$bid_item->product_id)); ?>">   <?php echo e($bid_item->title); ?></a>     
                    </td>
                    <td>  <a href="<?php echo e(URL::to('bids/'.$bid_item->product_id)); ?>"> 
                     <img src="<?php echo e(URL::asset('/uploads/products/thumbs/small/'.$bid_item->image1)); ?>" alt="picture" >   
                        </a></td>
                    <td><?php echo e($bid_item->bids_count); ?> </td>




                </tr>

                <?php endforeach; ?>

            </tbody>
        </table>


    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>