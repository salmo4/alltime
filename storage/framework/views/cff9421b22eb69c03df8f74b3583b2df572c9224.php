<!DOCTYPE html>
<html>
    <head>
        <title> <?php echo $__env->yieldContent('title'); ?>  <?php echo e($application_name); ?> </title>

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap v3.2.0 compiled and minified CSS -->

        <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap.min.css')); ?>">
      <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <!-- Optional theme -->

        <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap-theme.min.css')); ?>">


        <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap_custom_auction_webshop.css')); ?>">
      


        <link rel="stylesheet" href="<?php echo e(asset('css/dropzone.css')); ?>">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" >
        
        <link rel="stylesheet" href="<?php echo e(asset('css/datepicker.css')); ?>">
     
        

        <script  src="<?php echo e(asset('js/jquery-latest.min.js')); ?>"></script>
        <script src="<?php echo e(asset('js/jquery-ui.js')); ?>"></script>
        <script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
        <script src="<?php echo e(asset('js/dropzone.js')); ?>"></script>

        <script src="<?php echo e(asset('js/jquery.form.js')); ?>"></script>
        <script src="<?php echo e(asset('js/auction_modal.js')); ?>"></script>
        
        
        <script src="<?php echo e(asset('js/bootstrap-datepicker.js')); ?>"></script>




        <?php echo $__env->yieldContent('head'); ?>

    </head>
    <body>


        <div id="fb-root"></div>
        <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id))
                    return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=773457146074751&version=v2.0";
            fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>

        <nav class="navbar " role="navigation" style="background-color: #fff;">

            <?php echo $__env->make('flash::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <div class="container">
                
                
                <div class="row">
                <!-- Brand and toggle get grouped for better mobile display -->
               
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?php echo e(URL::to('index')); ?>"><?php echo e($application_name); ?></a>
                </div>
              
                <!-- Collect the nav links, forms, and other content for toggling -->
                <ul class="nav navbar-nav ">


                    <li  ><a  href="<?php echo e(URL::to('index')); ?>/1"><i class="fa fa-legal fa-1x " ></i> <?php echo e(trans('c.Auction')); ?></a></li> 
                   <!--
                    <li <?php if( $application_type ==2): ?> class="active" <?php endif; ?> ><a  href="<?php echo e(URL::to('index')); ?>/2"><i class="fa fa-cart-arrow-down fa-1x " ></i> <?php echo e(trans('c.Web-shop')); ?></a></li>
                    <li <?php if( $application_type ==3): ?> class="active" <?php endif; ?> ><a  href="<?php echo e(URL::to('index')); ?>/3"><i class="fa fa-search fa-1x " ></i> <?php echo e(trans('c.Classified Ads')); ?></a></li>
                    -->
                    <li> <a  href="<?php echo e(URL::to('pub_bid_list')); ?>"><i class="fa fa-list fa-1x " ></i> Bid list</a></li>
                    <li class="divider-vertical"></li>

                    
                    
                    <?php if(!Auth::check()): ?>
                    <li><a href="<?php echo e(URL::to('user/create')); ?>"><i class="fa fa-pencil fa-1x " ></i> <?php echo e(trans('c.Registration')); ?></a></li>
                    <li class="divider-vertical"></li>
                    <li><a href="<?php echo e(URL::to('user/login')); ?>"><i class="fa fa-pencil fa-1x " ></i> Log in</a></li>
                    
                    <!--<li class="dropdown">
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown"><i class="fa fa-sign-in fa-1x " ></i> Log in <strong class="caret"></strong></a>
                        <div class="dropdown-menu" style="padding: 15px; padding-bottom: 0px;">


                            <a href="<?php echo e(URL::to('redirect')); ?>"><img src="<?php echo e(URL::asset('img/liwf.png')); ?>" alt="Login with Facebook" style="width:150pt" ></a>
                            <br><?php echo e(trans('c.Or')); ?><br><br>

                            <p>
                                <i class='fa fa-user'></i> Test user - 
                                email: <strong>xyusertest@gmail.com</strong>  <br>
                                password: <strong>123</strong>
                            </p>


                            <p> <?php echo e(trans('c.Please Login')); ?>:
                            <form action="<?php echo e(URL::to('user/login')); ?> " method="post" accept-charset="UTF-8">
                                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                email:
                                <input id="email" style="margin-bottom: 15px;" type="text" name="email" size="30" placeholder="email" />
                                <?php echo e(trans('c.Password')); ?>:
                                <input id="password" style="margin-bottom: 15px;" type="password" name="password" size="30" />

                                <?php echo e(Form::button('<i class="fa fa-sign-in fa-1x " ></i> '.trans('c.Sign In') , ['type' => 'submit', 'class' => 'btn btn-primary', 'id' => 'create_user_btn'])); ?>

                            </form>
                            <br>
                           
                            <a href="<?php echo e(URL::to('/password/remind')); ?>"> <?php echo e(trans('c.Password remind')); ?></a>
                           
                            <a href="<?php echo e(URL::to('/password/reset')); ?>"><i class="fa fa-unlock fa-1x " ></i> Password reset</a>
                            <br> <br> 


                        </div>
                    </li>
                    -->
                    <?php else: ?>


                    <li class="divider-vertical"></li>

                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class='fa fa-user'></i> <?php echo e(Auth::user()->name); ?> <b class="caret"></b></a>
                        <ul class="dropdown-menu" >
                            <li class="divider"></li>
                            <li><a href="<?php echo e(URL::to('user/edit')); ?>">  <?php echo e(trans('c.Settings')); ?></a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo e(URL::to('user/logout')); ?>"><i class="icon-off"></i> Logout</a></li>
                        </ul>
                    </li>
                    
                    
                    <?php endif; ?>

                    <li class="dropdown">  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-language fa-1x " ></i> Language: <?php echo e($applocale); ?> <b class="caret"></b></a>
                        <?php //var_dump(Config::get('languages')); ?>
                        <ul class="dropdown-menu scrollable-menu"  >
                            <?php foreach(Config::get('languages') as $lang => $language): ?>
                            <li>
                                <a href="<?php echo e(route('lang.switch', $lang)); ?>"><?php echo e($language); ?></a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>

                </ul>     

                    
                </div>


                <div class="row">

                <!-- Collect the nav links, forms, and other content for toggling -->
                <ul class="nav navbar-nav ">



                    <?php if(Auth::check()): ?>

                    <li class="divider-vertical"></li>
                    <?php if( $application_type ==1): ?>
                    <li><a href="<?php echo e(URL::to('product/add')); ?>"> + <?php echo e(trans('c.Add Auction')); ?></a></li>
                    <?php endif; ?>
                    <?php if( $application_type ==2): ?>
                    <li><a href="<?php echo e(URL::to('product/add')); ?>"> + Add Product</a></li>
                    <?php endif; ?>
                    <?php if( $application_type ==3): ?>
                    <li><a href="<?php echo e(URL::to('product/add')); ?>"> + New Advertisement</a></li>
                    <?php endif; ?>
                    
                    <li class="divider-vertical"></li>
                    <li><a href="<?php echo e(URL::to('product/adminproductlist')); ?>"> <i class="fa fa-pencil fa-1x " ></i>  <?php if( $application_type ==1): ?> <?php echo e(trans('c.Auction Update, Delete')); ?> <?php else: ?>  Update, Delete   <?php endif; ?> </a></li>

                    <?php if( $application_type ==1): ?>
                    <li class="divider-vertical"></li>
                    <li><a href="<?php echo e(URL::to('mainbids')); ?>"><i class="fa fa-legal fa-1x " ></i>  Bids</a></li>
                    <?php endif; ?>

                   
                    <?php if( $application_type ==1): ?>
                    <li class="divider-vertical"></li>
                    <li><a href="<?php echo e(URL::to('basket/basketfull')); ?>"><i class="fa fa-cart-arrow-down fa-1x " ></i>  Basket (Your Winning Bids)</a></li>
                
                    <li class="divider-vertical"></li>
                    <li><a href="<?php echo e(URL::to('arrived_orders')); ?>">  Orders</a></li>
                    <?php endif; ?>
                    
                    <!--
                    <li><a href="<?php echo e(URL::to('visitor_message_list')); ?>"><i class="fa fa-envelope fa-1x " ></i> Messages</a></li>
                     -->
                    <?php endif; ?>
                 

                </ul>     
                    
                </div>


                <?php if(Auth::check() && Auth::user()->admin == 2): ?>
                <a href="<?php echo e(URL::to('superadminarea')); ?>" class='btn btn-primary'> <strong>SuperAdmin section</strong></a>

                <?php endif; ?>
            </div><!-- /.container-fluid -->
            
            

        </nav>
        
<div class="container">
    
      <form action="<?php echo e(URL::to('search')); ?>"  method="post" accept-charset="UTF-8">
             <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
	<div class="row">
        <div class=" col-sm-offset-1 col-sm-2 ">
            <a  href="<?php echo e(URL::to('index')); ?>">    <img src="<?php echo e(URL::asset('/img/labay.png')); ?>" > </a>
         </div>
        <div class="col-sm-6">
            
                 
            <div id="imaginary_container"> 
             
                <div class="input-group stylish-input-group">
                     <?php echo e(Form::text('productname', null, ['placeholder' => 'Full-text search of product name', 'class' => 'form-control', 'id' => 'productname'])); ?>

                    <span class="input-group-addon">
                        <button type="submit">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>  
                    </span>
                </div>
            </div>
        </div>
	</div>
     </form> 
</div>

        <?php echo $__env->yieldContent('content'); ?>

        <br style="clear:both;">

        <div class="container">
            <div class="row" style="margin-top:200px;"></div>      
        </div>   

        <div class="navbar  navbar-fixed-bottom"  style="background-color: #fff;">
            <div class="container">
                <p class="navbar-text pull-left" style='font-size:12px;'>Multi-Vendor Auction - Built with PHP  Laravel 5.2</p>

                <a href="http://www.binpress.com/app/-multivendor-auction-php-laravel/2822" target='_blank' class="navbar-btn btn-sm pull-right" style=' background: #ccc;color:black'>
                    <i class="fa fa-download fa-2x " ></i>  Download this full version software  from here</a>
            </div>


        </div>    



        <script type="text/javascript">
            //show errors

            <?php if(isset($error)): ?>
                    alert("<?php echo e($error); ?>");
            <?php endif; ?>

                    <?php if(Session::has('error')): ?>
                    alert("<?php echo e(Session::get('error')); ?>");
            <?php endif; ?>

                    <?php if(Session::has('message')): ?>
                    alert("<?php echo e(Session::get('message')); ?>");
            <?php endif; ?>



        </script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-84941516-1', 'auto');
  ga('send', 'pageview');

</script>

    </body>
</html>