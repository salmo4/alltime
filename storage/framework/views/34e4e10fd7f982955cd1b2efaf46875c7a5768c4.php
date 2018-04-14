<?php $__env->startSection('title'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('head'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


<div class="container">

    <div class="row">


        <div class='col-xs-6' >
            <?php if(Auth::check()): ?>
            <form action="<?php echo e(URL::to('message/add')); ?>"  method="post" accept-charset="UTF-8">
                   <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <input type="hidden" name="bid_id" value="<?php echo e($bid_id); ?>" />
                <input type="hidden" name="recipient_id" value="<?php echo e($recipient_id); ?>" />
                <input type="hidden" name="product_id" value="<?php echo e($product_id); ?>" />


                <br>
                <div class='form-group'>
                    <?php echo e(Form::label('message', "Message:")); ?>

                    <?php echo e(Form::textarea('message', null,  [ 'class' => 'form-control', 'style'=>'width:300px;' ] )); ?>

                </div>

                <input class="btn btn-info"  type="submit" name="submit" value="OK" />

            </form>


            <?php endif; ?> 
            <br>  <br>
        </div>
    </div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>