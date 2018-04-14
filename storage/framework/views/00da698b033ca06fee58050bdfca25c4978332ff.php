<?php $__env->startSection('title'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('head'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


<div class="container">

    <div class="row">


        <div class='col-xs-6' >

              <?php echo e(Form::model($category, array('route' => array('category.edit', $category->id)))); ?>	

              <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <input type="hidden" name="id" value="<?php echo e($category->id); ?>" />
                <br>
                <div class='form-group'>
                    <?php echo e(Form::label('name', "Category name:")); ?>

                    <?php echo e(Form::text('name',$category->name,  [ 'class' => 'form-control' ] )); ?>

                </div>
                
               <div class='form-group'>
                    <?php echo e(Form::label('picture', "Picture name:")); ?>

                    <?php echo e(Form::text('picture',$category->picture ,  [ 'class' => 'form-control' ] )); ?>

                </div>

                <input class="btn btn-info"  type="submit" name="submit" value="OK" />

            </form>



            <br>  <br>
        </div>
    </div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>