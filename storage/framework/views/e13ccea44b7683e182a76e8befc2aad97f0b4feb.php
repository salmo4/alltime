<?php $__env->startSection("content"); ?>



<div class='col-lg-4 col-lg-offset-4'>
<!--
    <a href="<?php echo e(URL::to('redirect')); ?>"><img src="<?php echo e(URL::asset('img/liwf.png')); ?>" alt="Login with Facebook" style="width:300pt" ></a>


    <br><br>

    <h3> <?php echo e(trans('c.Or')); ?></h3>
    <br>
    -->
    <p>
       <i class='fa fa-user'></i>  Test user: <br>
        email: <strong>xyusertest@gmail.com</strong>  <br>
        password: <strong>123</strong>
    </p>
    
    
    <?php echo e(Form::open(array('action' => 'UserController@postLogin'))); ?>

    <?php echo e($errors->first("password")); ?><br />


    <div class='form-group'>
        <?php echo e(Form::label('email', 'Email:')); ?>

        <?php echo e(Form::email('email', null, ['placeholder' => 'Email', 'class' => 'form-control', 'id' => 'email'])); ?>

    </div>




    <div class='form-group'>
        <?php echo e(Form::label('password', trans('c.Password').":" )); ?>

        <?php echo e(Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control'])); ?>

    </div>



    <div class='form-group'>
        <?php echo e(Form::button('<i class="fa fa-sign-in fa-1x " ></i> '.'Log in' , ['type' => 'submit', 'class' => 'btn btn-primary', 'id' => 'create_user_btn'])); ?>

    </div>

    <?php echo e(Form::close()); ?>

    <br><br>
    <a href="<?php echo e(URL::to('user/create')); ?>" class="btn btn-default"><i class="fa fa-pencil fa-1x " ></i> <?php echo e(trans('c.Registration')); ?></a>

    <br><br>
   <!-- <a href="<?php echo e(URL::to('/password/remind')); ?>"> <?php echo e(trans('c.Password remind')); ?></a>-->
    
     <a href="<?php echo e(URL::to('/password/reset')); ?>" class="btn btn-default"><i class="fa fa-unlock fa-1x " ></i> Password reset</a>
    <br>     <br>

</div>

<?php $__env->stopSection(); ?>




<?php echo $__env->make('layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>