<!DOCTYPE html>
<html>
    <head>
        <title>Sami</title>

        <meta name="viewport" content="width=device-width, initial-scale=1">



        <!-- Latest compiled and minified JavaScript -->


    </head>
    <body>


        <nav class="navbar navbar-default" role="navigation">

            @include('flash::message')


            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">Licitație Online</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->

                <ul class="nav navbar-nav">
                    <li><a class="active" href="book/index">  {{  trans('c.List'); }}</a></li>
                    <li class="divider-vertical"></li>
                    <li><a class="active" href="about">Licență 2017</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li><a href="lang/en"> English</a></li>
                    <li class="divider-vertical"></li>
                    @if(!Auth::check())
                    <li><a href="user/create"><i class="icon-user icon-white"></i> Registration</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown">Sign In <strong class="caret"></strong></a>
                        <div class="dropdown-menu" style="padding: 15px; padding-bottom: 0px;">
                            <p>Please Login</a>
                            <form action="user/login" method="post" accept-charset="UTF-8">
                                email:
                                <input id="email" style="margin-bottom: 15px;" type="text" name="email" size="30" placeholder="email" />
                                password:
                                <input id="password" style="margin-bottom: 15px;" type="password" name="password" size="30" />
                                <input class="btn btn-info" style="clear: left; width: 100%; height: 32px; font-size: 13px;" type="submit" name="commit" value="Sign In" />
                            </form>
                            <br>
                        </div>
                    </li>
                    @else
                    @if (Auth::user()->admin == 2)
                    <li><a href="admin/products"><i class="icon-user icon"></i> Admin page</a></li>
                    <li class="divider-vertical"></li>
                    @endif
                    <li class="divider-vertical"></li>
                    <li><a href="{{ URL::to('product/add/') }}"> Add Auction</a></li> 
                    <li class="divider-vertical"></li>
                    <li><a href="product/myproducts"><i class="icon-off"></i> Auction Update, Delete</a></li>

                    <li class="divider-vertical"></li>
                    <li><a href="cart"><i class="icon-shopping-cart icon-white"></i> Bids Placed</a></li>
                    <li class="divider-vertical"></li>
                    <li><a href="user/orders"> Orders</a></li>
                    <li class="divider-vertical"></li>
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">{{Auth::user()->name}} <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li class="divider"></li>
                            <li><a href="user/logout"><i class="icon-off"></i> Logout</a></li>
                        </ul>
                    </li>
                    @endif
                </ul>

            </div><!-- /.container-fluid -->
        </nav>

        @if (Session::has('error'))
        <p style="color:red;font-weight: bold;">{{ Session::get('error') }}</p>
        @endif



        @yield('content')



    </body>
</html>