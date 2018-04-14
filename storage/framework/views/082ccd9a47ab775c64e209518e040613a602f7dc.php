<?php $__env->startSection('content'); ?>



<div class="container" style="width:60%">

    <?php if(Session::has('error')): ?>
    <p style="color:red;font-weight: bold;"><?php echo e(Session::get('error')); ?></p>
<?php endif; ?>

<?php if(Session::has('message')): ?>
    <p style="color:red;font-weight: bold;"><?php echo e(Session::get('message')); ?></p>
<?php endif; ?>


  NULL template
</div>
<?php $__env->stopSection(); ?>