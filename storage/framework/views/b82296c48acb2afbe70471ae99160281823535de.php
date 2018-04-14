<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>

        <?php if(Config::get('app.locale') == 'hu'): ?>


        <h2>Köszöntelek az Aukciós oldalon </h2>

        <div>
            <a href="<?php echo e(URL::to('/')); ?>"> <?php echo e(URL::to('/')); ?> </a> 
            <br/><br/>
            <div>A belépéshez használható email cím: <?php echo e($email); ?></div>
            <br/><br/>
            Üdvözlettel,<br/>
            Admin<br/>
            blogbookhu@gmail.com 

        </div>


        <?php else: ?>


        <h2>Welcome to our Online Auction site</h2>

        <div>

            <a href="<?php echo e(URL::to('/')); ?>"> <?php echo e(URL::to('/')); ?> </a> 
            <br/><br/>
            <div>You can log in with this email: <?php echo e($email); ?></div>
            <br/><br/>
            Bye,<br/>
            Admin<br/>
            blogbookhu@gmail.com 
        </div>


        <?php endif; ?>  


    </body>
</html>
