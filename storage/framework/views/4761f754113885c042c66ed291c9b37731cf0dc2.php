<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>




        <h2> Your product is allowed.</h2>

        <div>
            <?php if($fee !='0.00'): ?>
            
            The price of the product publishing is    <?php echo e($fee); ?> <?php echo e($currency); ?>. <br>
            
            Please settle the payment with Paypal. <br>
            
            ****(This a test program.  You don't have to pay.)**** <br>
            
            <?php endif; ?>
            <br>
            
            <a href="<?php echo e(URL::to('/')); ?>"> <?php echo e(URL::to('/')); ?> </a> 
            <br/><br/>

            <br/><br/>
            Bye,<br/>
            Admin<br/>
            blogbookhu@gmail.com 
        </div>





    </body>
</html>
