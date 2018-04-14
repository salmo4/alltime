<?php $__env->startSection('content'); ?>




    <?php foreach($messages as $message): ?>

        <div class="alert alert-info">
            <?php echo e($message->Sender->name); ?>:<?php echo e($message->message); ?>


        </div>


    <?php endforeach; ?>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.ajax', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>