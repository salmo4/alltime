<?php $__env->startSection("content"); ?>

<div class="container">


    <h2>SuperSami section</h2><br><br>
    <div class="list-group">

        <a class="list-group-item active" href="<?php echo e(URL::to('product/superadminproductlist')); ?>" > Moderation | All products</a>

        <br>
        <a class="list-group-item" href="<?php echo e(URL::to('superadmin/userlist')); ?>" >Auction users list</a>
        <br>
        <a class="list-group-item" href="<?php echo e(URL::to('superadminbids')); ?>" >All bids</a>
        <br>
        <a class="list-group-item" href="<?php echo e(URL::to('superadminorders')); ?>" >All orders</a>
        <br> 
        <a class="list-group-item" href="<?php echo e(URL::to('categorylist_super')); ?>" >Edit Category</a>
        <br>
        <div class="list-group-item" >
            <?php echo e(trans('c.Admin info')); ?>:<br>

            <?php echo e(trans('c.The picture upload depend on servers parameter.')); ?><br>

            <?php echo e(trans('c.The compressed file formats (like JPEG) needs much more memory than the actual file size!')); ?><br>

            <?php echo e(trans('c.memory limit')); ?>:<?php echo ini_get('memory_limit'); ?> <br>
            <?php echo e(trans('c.Maximum allowed size for uploaded files')); ?>:<?php echo ini_get('upload_max_filesize'); ?> <br>

            <?php echo e(trans('c.Whether to allow HTTP file uploads')); ?>:<?php echo ini_get('file_uploads'); ?> <br>

            <?php echo e(trans('c.Maximum size of POST data that PHP will accept')); ?>:<?php echo ini_get('post_max_size'); ?> <br>

            <?php echo e(trans('c.Maximum amount of time each script may spend parsing request data')); ?>:  <?php echo ini_get('max_input_time'); ?> <br>

            <?php echo e(trans('c.Maximum execution time of each script, in seconds')); ?>:<?php echo ini_get('max_execution_time'); ?> <br>

        </div>
        <!--
         <br>
          <a class="list-group-item" href="<?php echo e(URL::to('superaminviewslogs')); ?>"  target="_blank">Log viewer</a>
           <br>
          <a class="list-group-item" href="<?php echo e(URL::to('superadmin/deletelog')); ?>"  >Delete log</a>
          
          -->
    </div>
</div>
<?php $__env->stopSection(); ?>




<?php echo $__env->make('layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>