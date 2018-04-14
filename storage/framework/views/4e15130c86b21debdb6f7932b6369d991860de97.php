<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>

        <?php if(Config::get('app.locale') == 'hu'): ?>


        <h2>Bine ați venit la pagina de licitație</h2>

        <div>
            <a href="<?php echo e(URL::to('/')); ?>"> <?php echo e(URL::to('/')); ?> </a> 
            <br/><br/>
            <div>Introduceți adresa de e-mail <?php echo e($email); ?></div>
            <br/><br/>
            Toate cele bune,,<br/>
            Admin<br/>
            samy.gui95@gmail.com

        </div>


        <?php else: ?>


        <h2>Welcome to AllTime</h2>

        <div>

            <a href="<?php echo e(URL::to('/')); ?>"> <?php echo e(URL::to('/')); ?> </a> 
            <br/><br/>
            <div>You can log in with this email: <?php echo e($email); ?></div>
            <br/><br/>
            Bye,<br/>
            Admin<br/>
            samy.gui95@gmail.com
        </div>


        <?php endif; ?>  


    </body>
</html>
