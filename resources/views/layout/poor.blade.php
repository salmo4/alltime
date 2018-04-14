<!DOCTYPE html>
<html>
    <head>
        <title> @yield('title')</title>

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap v3.2.0 compiled and minified CSS -->
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">

        <!-- Optional theme -->
       <link rel="stylesheet" href="{{asset('css/bootstrap-theme.min.css')}}">

        <link rel="stylesheet" href="{{asset('css/bootstrap_custom_auction.css')}}">




        @yield('head')

    </head>
    <body>
        @yield('content')

    </body>
</html>