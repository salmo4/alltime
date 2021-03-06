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

    <h3>  Sent Orders| <a href="<?php echo e(URL::to('arrived_orders')); ?>"> Arrived orders</a>    </h3>
    <br>  <br>
    <div class="menu">


        <?php foreach($orders as $key => $order): ?>

        
 <table class="table table-striped table-condensed">
   <tr><td>Customer name: </td><td>  <?php echo e($order[0]['name']); ?> </td></tr>
   <tr><td>Customer email: </td><td><?php echo e($order[0]['email']); ?> </td></tr>
   <tr><td>Order Detail: </td><td><a  href="<?php echo e(URL::to('order/'.$key.'/member')); ?>"  > <strong> detail >> </strong></a> </td></tr>
   <tr><td>Order ID: </td><td><?php echo e($key); ?> </td></tr>

 </table>
   



        <table class="table table-striped table-condensed">
            <thead>
                <tr>
                    <th>
                        Product
                    </th>
                    <th>
                        Price
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
                    <td>  <?php echo e($item['shop_price']); ?> </td>
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







    </div>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>