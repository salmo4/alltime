<?php $__env->startSection('title'); ?> Create User <?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>
<style>
    .error{
        color: #c00; 
        margin-left: 10px;
    }

</style>
<script>

</script>

<div class='col-lg-4 col-lg-offset-4'>

    <?php if($errors->has()): ?>
    <?php foreach($errors->all() as $error): ?>
    <div class='bg-danger alert'><?php echo e($error); ?></div>
    <?php endforeach; ?>
    <?php endif; ?>

    
    <!--
    <a href="<?php echo e(URL::to('login/fb')); ?>"> HTML::image('img/liwf.png', 'Login with Facebook',  ['width' =>'300px;']) </a>
    
    <br><br>
    <h3><i class='fa fa-user'></i>  <?php echo e(trans('c.Or')); ?></h3>
    <br>
    -->
    <h2><i class='fa fa-user'></i>  <?php echo e(trans('c.User registration')); ?></h2>

    <?php echo e(Form::open(['role' => 'form', 'url' => 'user/store'])); ?>




    <div class='form-group'>

        <?php echo e(Form::label('name', "Username:")); ?>

        <?php echo e(Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control'])); ?>

    </div>

    <div class='form-group'>
        <?php echo e(Form::label('email', 'Email:')); ?>

        <?php echo e(Form::email('email', null, ['placeholder' => 'Email', 'class' => 'form-control', 'id' => 'email'])); ?>

    </div>

    <div class='form-group'>
        <?php echo e(Form::label('password', trans('c.Password').":" )); ?>

        <?php echo e(Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control'])); ?>

    </div>

    <div class='form-group'>
        <?php echo e(Form::label('password_confirmation', trans('c.Confirm Password').":" )); ?>

        <?php echo e(Form::password('password_confirmation', ['placeholder' => 'Confirm Password', 'class' => 'form-control'])); ?>

    </div>

    <div class='form-group'>
        <?php echo e(Form::submit(trans('c.Create'), ['class' => 'btn btn-primary', 'id' => 'create_user_btn'])); ?>

    </div>

    <?php echo e(Form::close()); ?>


</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>