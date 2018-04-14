<?php $__env->startSection('head'); ?>

<?php $__env->startSection('content'); ?>

<style>
    hr {
        -moz-border-bottom-colors: none;
        -moz-border-image: none;
        -moz-border-left-colors: none;
        -moz-border-right-colors: none;
        -moz-border-top-colors: none;
        border-color: #EEEEEE -moz-use-text-color #FFFFFF;
        border-style: solid none;
        border-width: 3px 0;
        margin: 25px 0;
    }
</style>
<div class="container" style="width:60%">
<br> <a href="<?php echo e(URL::to('superadminorders')); ?>">  Back to the Orders</a> <br>
    <h3>  Order information    </h3>
    
    <div class="menu">


        <?php foreach($orders as $key => $order): ?>


        <table class="table table-striped table-condensed">
            <tr><td>Customer name: </td><td>  <?php echo e($order[0]['name']); ?> </td></tr>
            <tr><td>Customer email: </td><td><?php echo e($order[0]['email']); ?> </td></tr>
            <tr><td>Order ID: </td><td><?php echo e($key); ?> </td></tr>
            <tr><td>Delete order: </td><td>        <a  href="<?php echo e(URL::to('order_delete_super/'.$key)); ?>"  onclick="if (!confirm('Are you sure to delete this order?')) {
                        return false;
                    }
                    ;">  
                        <?php echo e(trans('c.delete')); ?>

                    </a> </td></tr>
        </table>




        <table class="table table-striped table-condensed">
            <thead>
                <tr>
                    <th>
                        Product
                    </th>
                    <th>
                        Price (Your bid)
                    </th>
                    <th>
                        Picture
                    </th>
                    <th>
                        Quantity
                    </th>



                </tr>
            </thead>   
            <tbody>
                <?php foreach($order as $item): ?>
                <tr>
                    <td>  <?php echo e($item['title']); ?></td>
                    <td>  <?php echo e($item['bid']); ?> </td>
                    <td> 
                       <img src="<?php echo e(URL::asset('/uploads/products/thumbs/small/'.$item['image1'])); ?>" alt="picture" >
                    </td>
                    <td>  <?php echo e($item['quantity']); ?> </td>


                    <td>      </td>

                    <td> 
                    </td>
                </tr>
                <?php endforeach; ?>

            </tbody>
        </table>

        <hr >
        <?php endforeach; ?>


        <h3>Billing address</h3>      
        <table class="table table-striped table-condensed">
            <tr><td>First name: </td><td>  <?php echo e($orderinformation->firstname); ?> </td></tr>
            <tr><td>Last name: </td><td><?php echo e($orderinformation->lastname); ?> </td></tr>
            <tr><td>Street: </td><td><?php echo e($orderinformation->street); ?> </td></tr>
            <tr><td>City: </td><td><?php echo e($orderinformation->city); ?> </td></tr> 
            <tr><td>Postal code: </td><td><?php echo e($orderinformation->postal_code); ?> </td></tr>
            <tr><td>Email: </td><td><?php echo e($orderinformation->email); ?> </td></tr>

        </table>      


        <h3>Delivery address</h3>      
        <table class="table table-striped table-condensed">
            <tr><td>First name: </td><td>  <?php echo e($orderinformation->delivery_firstname); ?> </td></tr>
            <tr><td>Last name: </td><td><?php echo e($orderinformation->delivery_lastname); ?> </td></tr>
            <tr><td>Street: </td><td><?php echo e($orderinformation->delivery_street); ?> </td></tr>
            <tr><td>City: </td><td><?php echo e($orderinformation->delivery_city); ?> </td></tr> 
            <tr><td>Postal code: </td><td><?php echo e($orderinformation->delivery_postal_code); ?> </td></tr>
            <tr><td>Order message: </td><td><?php echo e($orderinformation->message); ?> </td></tr>

        </table>  






    </div>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>