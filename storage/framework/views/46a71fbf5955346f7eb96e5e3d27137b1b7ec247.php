<?php $__env->startSection('head'); ?>

<?php $__env->startSection('content'); ?>


<div class="container" style="width:60%">

    <h3>  Category    </h3>

 <a  href="<?php echo e(URL::to('category/add')); ?>" >  + add new category</a>  

        <table class="table table-striped table-condensed">
            <thead>
                <tr>
                    <th>
                        Name
                    </th>
                    <th>
                        Picture
                    </th>
                  <th>
                   
                  </th>
                  <th>
                   
                  </th>
                </tr>
            </thead>   
            <tbody>
                   <?php foreach($categories as $key => $category): ?>
                <tr>
                    <td>  <?php echo e($category['name']); ?></td>
                     <td>  <?php echo e($category['picture']); ?></td>
                      <td>   <a  href="<?php echo e(URL::to('category/edit/'.$category['id'])); ?>" >  edit</a>  
                      </td>
                      <td>   <a  href="<?php echo e(URL::to('category/delete/'.$category['id'])); ?>"  onclick="if (!confirm('Are you sure to delete this category?')) {
                                return false;
                            }
                            ;">  delete</a>  
                      </td>
                </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
        








    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>