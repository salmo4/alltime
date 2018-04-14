<?php $__env->startSection("content"); ?>

<div class="container">



    <h2>Auction users list</h2><br><br>

    <table class="table">
        <tbody>
            <tr>
                <td>
                    <b>name</b>
                </td>
                <td>
                    <b>email</b>
                </td>

                <td>
                    <b>created</b>
                </td>
                <!--  
                  <td>
                      <b>Delete</b>
                  </td>
                -->
            </tr>
            <?php foreach($users as $item): ?>
            <tr>
                <td>
                    <?php echo e($item->name); ?>


                </td>
                <td>
                    <?php echo e($item->email); ?>

                </td>
                <td>
                    <?php echo e($item->created_at); ?>

                </td>
                <!--
                                <td>
                                    TODO DELETE 
                                </td>
                -->
            </tr>

            <?php endforeach; ?>

        </tbody>
    </table>

</div>
<?php $__env->stopSection(); ?>




<?php echo $__env->make('layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>