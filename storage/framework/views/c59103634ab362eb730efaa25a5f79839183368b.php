<?php $__env->startSection('content'); ?>
<style>
    .error{
        color: #c00; 
        margin-left: 10px;
    }

</style>


<div class='col-lg-4 col-lg-offset-4'>

    <?php if($errors->has()): ?>
    <?php foreach($errors->all() as $error): ?>
    <div class='bg-danger alert'><?php echo e($error); ?></div>
    <?php endforeach; ?>
    <?php endif; ?>





    <h2><?php echo e(trans('c.Currency setting')); ?></h2>
    <?php echo e(Form::model($user, array('route' => array('user/edit', $user->id)))); ?>	

    <?php echo e(Form::hidden('onlycurrency', 1)); ?>


    <div class='form-group'>
        <?php echo e(Form::label('', trans('c.Currency').":" )); ?>

        <?php echo e(Form::select('currency_id', $currency_list, Request::old('currency_id'),  [ 'class' => 'form-control'])); ?>

    </div>


    <div class='form-group'>
        <?php echo e(Form::submit(trans('c.Save'), ['class' => 'btn btn-primary', 'id' => 'create_user_btn'])); ?>

    </div>

    <?php echo e(Form::close()); ?>

    <br><br>

    <h2><i class='fa fa-user'></i>  <?php echo e(trans('c.User data Setting')); ?></h2>

    <?php echo e(Form::model($user, array('route' => array('user/edit', $user->id)))); ?>	

    <?php echo e(Form::hidden('onlycurrency', 0)); ?>


    <div class='form-group'>

        <?php echo e(Form::label('name', trans('c.nameOfUser').":")); ?>

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
        <?php echo e(Form::label('', trans('c.Currency').":" )); ?>

        <?php echo e(Form::select('currency_id', $currency_list, Request::old('currency_id'),  [ 'class' => 'form-control'])); ?>

    </div>


    <div class='form-group'>
        <?php echo e(Form::submit(trans('c.Save'), ['class' => 'btn btn-primary', 'id' => 'create_user_btn'])); ?>

    </div>

    <?php echo e(Form::close()); ?>






</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>