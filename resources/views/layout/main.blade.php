<!DOCTYPE html>
<html>
    <head>
        <title> @yield('title')  {{$application_name}} </title>

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap v3.2.0 compiled and minified CSS -->

        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
      <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <!-- Optional theme -->

        <link rel="stylesheet" href="{{asset('css/bootstrap-theme.min.css')}}">


        <link rel="stylesheet" href="{{asset('css/bootstrap_custom_auction_webshop.css')}}">
      


        <link rel="stylesheet" href="{{asset('css/dropzone.css')}}">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" >
        
        <link rel="stylesheet" href="{{asset('css/datepicker.css')}}">
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
        

        <script  src="{{asset('js/jquery-latest.min.js')}}"></script>
        <script src="{{asset('js/jquery-ui.js')}}"></script>
        <script src="{{asset('js/bootstrap.min.js')}}"></script>
        <script src="{{asset('js/dropzone.js')}}"></script>

        <script src="{{asset('js/jquery.form.js')}}"></script>
        <script src="{{asset('js/auction_modal.js')}}"></script>
        
        
        <script src="{{asset('js/bootstrap-datepicker.js')}}"></script>




        @yield('head')

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

            @include('flash::message')

            <div class="container">
                
                
                <div class="row">
                <!-- Brand and toggle get grouped for better mobile display -->
               
                <div class="navbar-header">
                    <a class="navbar-brand" href="{{ URL::to('index')}}">{{$application_name}}</a>
                </div>
              
                <!-- Collect the nav links, forms, and other content for toggling -->
                <ul class="nav navbar-nav ">


                    <li  ><a  href="{{ URL::to('index')}}/1"><i class="fa fa-legal fa-1x " ></i> {{trans('c.Auction')}}</a></li> 
                   <!--
                    <li @if( $application_type ==2) class="active" @endif ><a  href="{{ URL::to('index')}}/2"><i class="fa fa-cart-arrow-down fa-1x " ></i> {{trans('c.Web-shop')}}</a></li>
                    <li @if( $application_type ==3) class="active" @endif ><a  href="{{ URL::to('index')}}/3"><i class="fa fa-search fa-1x " ></i> {{trans('c.Classified Ads')}}</a></li>
                    -->
                    <li> <a  href="{{ URL::to('pub_bid_list')}}"><i class="fa fa-list fa-1x " ></i> {{  trans('c.Items')}}</a></li>
                    <li class="divider-vertical"></li>

                    
                    
                    @if(!Auth::check())
                    <li><a href="{{ URL::to('user/create')}}"><i class="fa fa-pencil fa-1x " ></i> {{  trans('c.Registration') }}</a></li>
                    <li class="divider-vertical"></li>
                    <li><a href="{{ URL::to('user/login')}}"><i class="fa fa-pencil fa-1x " ></i> Log in</a></li>
                        <li><a href="{{ URL::to('help-contact')}}"><i class="fa fa-info fa-1x " ></i> {{ trans('c.help-contact') }}</a></li>

                        <!--<li class="dropdown">
                            <a class="dropdown-toggle" href="#" data-toggle="dropdown"><i class="fa fa-sign-in fa-1x " ></i> Log in <strong class="caret"></strong></a>
                            <div class="dropdown-menu" style="padding: 15px; padding-bottom: 0px;">


                                <a href="{{ URL::to('redirect')}}"><img src="{{URL::asset('img/liwf.png')}}" alt="Login with Facebook" style="width:150pt" ></a>
                                <br>{{  trans('c.Or') }}<br><br>

                                <p>
                                    <i class='fa fa-user'></i> Test user -
                                    email: <samy.gui95@gmail.com</strong>  <br>
                                    password: <strong>123</strong>
                                </p>


                                <p> {{  trans('c.Please Login') }}:
                                <form action="{{ URL::to('user/login')}} " method="post" accept-charset="UTF-8">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    email:
                                    <input id="email" style="margin-bottom: 15px;" type="text" name="email" size="30" placeholder="email" />
                                    {{  trans('c.Password') }}:
                                    <input id="password" style="margin-bottom: 15px;" type="password" name="password" size="30" />

                                    {{ Form::button('<i class="fa fa-sign-in fa-1x " ></i> '.trans('c.Sign In') , ['type' => 'submit', 'class' => 'btn btn-primary', 'id' => 'create_user_btn']) }}
                                </form>
                                <br>

                                <a href="{{ URL::to('/password/remind')}}"> {{  trans('c.Password remind') }}</a>

                                <a href="{{ URL::to('/password/reset')}}"><i class="fa fa-unlock fa-1x " ></i> Password reset</a>
                                <br> <br>


                            </div>
                        </li>
                        -->
                    @else


                    <li class="divider-vertical"></li>

                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class='fa fa-user'></i> {{Auth::user()->name}} <b class="caret"></b></a>
                        <ul class="dropdown-menu" >
                            <li class="divider"></li>
                            <li><a href="{{ URL::to('user/edit')}}">  {{  trans('c.Settings')}}</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ URL::to('user/logout')}}"><i class="icon-off"></i> Logout</a></li>
                        </ul>
                    </li>
                    
                    
                    @endif

                    <li class="dropdown">  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-language fa-1x " ></i> Language: {{$applocale}} <b class="caret"></b></a>
                        <?php //var_dump(Config::get('languages')); ?>
                        <ul class="dropdown-menu scrollable-menu"  >
                            @foreach (Config::get('languages') as $lang => $language)
                            <li>
                                <a href="{{ route('lang.switch', $lang) }}">{{$language}}</a>
                            </li>
                            @endforeach
                        </ul>
                    </li>

                </ul>     

                    
                </div>


                <div class="row">

                <!-- Collect the nav links, forms, and other content for toggling -->
                <ul class="nav navbar-nav ">



                    @if(Auth::check())

                    <li class="divider-vertical"></li>
                    @if ( $application_type ==1)
                    <li><a href="{{ URL::to('product/add')}}"> + {{  trans('c.Add Auction') }}</a></li>
                    @endif
                    @if ( $application_type ==2)
                    <li><a href="{{ URL::to('product/add')}}"> + Add Product</a></li>
                    @endif
                    @if ( $application_type ==3)
                    <li><a href="{{ URL::to('product/add')}}"> + New Advertisement</a></li>
                    @endif
                    
                    <li class="divider-vertical"></li>
                    <li><a href="{{ URL::to('product/adminproductlist')}}"> <i class="fa fa-pencil fa-1x " ></i>  @if ( $application_type ==1) {{  trans('c.Auction Update, Delete') }} @else  Update, Delete   @endif </a></li>

                    @if ( $application_type ==1)
                    <li class="divider-vertical"></li>
                    <li><a href="{{ URL::to('mainbids')}}"><i class="fa fa-legal fa-1x " ></i>{{  trans('c.My Products') }}</a></li>
                    @endif

                    @if ( $application_type ==1)
                    <li class="divider-vertical"></li>
                    <li><a href="{{ URL::to('help-contact')}}"><i class="fa fa-info fa-1x " ></i>{{  trans('c.help-contact') }}</a></li>
                    @endif

                   
                    @if ( $application_type ==1)
                    <li class="divider-vertical"></li>
                    <li><a href="{{ URL::to('basket/basketfull')}}"><i class="fa fa-cart-arrow-down fa-1x " ></i>  {{  trans('c.Basket (Your Winning Bids)') }}</a></li>
                
                    <li class="divider-vertical"></li>
                    <li><a href="{{ URL::to('arrived_orders')}}">  {{  trans('c.Orders') }}</a></li>
                    @endif
                    
                    <!--
                    <li><a href="{{ URL::to('visitor_message_list')}}"><i class="fa fa-envelope fa-1x " ></i> Messages</a></li>
                     -->
                    @endif
                 

                </ul>     
                    
                </div>


                @if (Auth::check() && Auth::user()->admin == 2)
                <a href="{{ URL::to('superadminarea')}}" class='btn btn-primary'> <strong>SuperAdmin section</strong></a>

                @endif
            </div><!-- /.container-fluid -->
            
            

        </nav>
        
<div class="container">
    
      <form action="{{ URL::to('search')}}"  method="post" accept-charset="UTF-8">
             <input type="hidden" name="_token" value="{{ csrf_token() }}">
	<div class="row">
        <div class=" col-sm-offset-1 col-sm-2 ">
            <a  href="{{ URL::to('index')}}">    <img src="{{URL::asset('/img/alltime.png')}}" > </a>
         </div>
        <div class="col-sm-6">
            
                 
            <div id="imaginary_container"> 
             
                <div class="input-group stylish-input-group">
                     {{ Form::text('productname', null, ['placeholder' => 'Full-text search of product name', 'class' => 'form-control', 'id' => 'productname']) }}
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

        @yield('content')

        <br style="clear:both;">

        <div class="container">
            <div class="row" style="margin-top:200px;"></div>      
        </div>

        <div class="navbar  navbar-fixed-bottom footer"  style="background-color: #fff;">
            <div class="container">
                <div class="paddingY10">
                    <a href="mailto: samy_gui95@yahoo.com" target='_blank' class="navbar-btn btn-sm sm-icon" style=' background: #e5e338;color:black'>
                        <i class="fa fa-download fa-2x " ></i>
                <span>
                    Created by Samuel Gui
                </span>
                    </a>
                    <a href="https://www.facebook.com/salmo.samy" target='_blank' class="navbar-btn btn-sm sm-icon" style=' background: #3B5998;color:#fff'>
                        <i class="fa fa-facebook fa-2x" ></i>
                <span>
                    Facebook
                </span>
                    </a>
                    <a href="https://www.instagram.com/sami_salmo/" target='_blank' class="navbar-btn btn-sm sm-icon" style=' background: #0078D7;color:#fff'>
                        <i class="fa fa-instagram fa-2x" ></i>
                <span>
                    Instagram
                </span>
                    </a>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="container">
                <div class="col-lg-12 top-delimiter paddingY20">
                    <div class="row">
                        <p class="navbar-text pull-left" style='font-size:12px;'>Copyright © 2017 AllTime</p>
                        <ul class="footer-menu  pull-right">
                            <li><a  href="{{ URL::to('index')}}/1">{{trans('c.Auction')}}</a></li>
                            <li> <a  href="{{ URL::to('pub_bid_list')}}">{{  trans('c.Items')}}</a></li>
                            <li><a href="{{ URL::to('user/create')}}">{{  trans('c.Registration') }}</a></li>
                            <li><a href="{{ URL::to('user/login')}}"> LOG IN</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>



        <script type="text/javascript">
            //show errors

            @if (isset($error))
                    alert("{{$error}}");
            @endif

                    @if (Session::has('error'))
                    alert("{{Session::get('error')}}");
            @endif

                    @if (Session::has('message'))
                    alert("{{Session::get('message')}}");
            @endif



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