<?php $__env->startSection("content"); ?>

<div class="container">


    <table class="table">
        <tbody>
            <tr>
                <td>
                    <h4>messages</h4>
                </td>
                <td>
                    <h4>email</h4>
                </td>



            </tr>
            <?php foreach($message_list as $item): ?>
            <tr>
                  <td>
                    <?php echo e($item->message); ?>

                </td>
                <td>
                    <?php echo e($item->email); ?>


                </td>


            </tr>

            <?php endforeach; ?>

        </tbody>
    </table>

</div>
<?php $__env->stopSection(); ?>




<?php echo $__env->make('layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>