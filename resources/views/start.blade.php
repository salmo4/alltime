<!DOCTYPE html>
<html lang="en">
    <head>
        <title>{{$application_name}} </title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/bootstrap_custom_auction_webshop.php')}}">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" >
        <script  src="{{asset('js/jquery-latest.min.js')}}"></script>
        <script src="{{asset('js/bootstrap.min.js')}}"></script>

    </head>
    <body>

        <style>
            html,body {
                padding:0;
                margin:0;
                height:100%;
                min-height:100%;
            }



            .quad{
                width:33%;
                height:100%;
                float:left;
            }
            .line{
                height:90%;
                width:100%;
            }


            .equal, .equal > div[class*='col-'] {  
                display: -webkit-box;
                display: -moz-box;
                display: -ms-flexbox;
                display: -webkit-flex;
                display: flex;
                flex:1 0 auto;
            }

            img {
                position:absolute;
                top:0;
                bottom:0;
                margin:auto;
                width:80%;
                height:80%;
            }

            .btn-xl {
                padding: 18px 28px;
                font-size: 30px;
                border-radius: 8px;
            }

            /*button over image*/
            .img-wrapper {
                position: relative;
            }

            .img-overlay {
                position: absolute;
                top: 0;
                bottom: 0;
                left: 0;
                right: 0;
                text-align: center;
            }

            .img-overlay:before {
                content: ' ';
                display: block;
                /* adjust 'height' to position overlay content vertically */
                height: 50%;
            }


            .btn-responsive {
                /* matches 'btn-md' */
                padding: 10px 16px;
                font-size: 18px;
                line-height: 1.3333333;
                border-radius: 6px;
            }

            @media (max-width:760px) { 
                /* matches 'btn-xs' */
                .btn-responsive {
                    padding: 1px 5px;
                    font-size: 12px;
                    line-height: 1.5;
                    border-radius: 3px;
                }
            }

            /*button over image - END*/ 


            @media (max-width: 767px) {

                .img-overlay {
                    /* position: relative;     */
                }
            }

            footer {
                position: fixed;
                height: 100px;
                bottom: 0;
                width: 100%;
            }
        </style>



        <!-- header -->


        <!-- header -->



        <div class="line">

            <div class="col-md-6 col-xs-12 quad img-wrapper" >
                <img src="img/auction_hammer.png"  class="img-responsive" > 
                <div class="img-overlay">

                    <a  href="{{ URL::to('index')}}/1"><button class="btn btn-lg btn-primary btn-xl"><i class="fa fa-legal fa-1x " ></i> {{trans('c.Auction')}}</button></a>
                </div>
            </div>
            <div class="col-md-6 col-xs-12  quad img-wrapper" style='background-color:black'>
                <img src="img/shopping_trolley.jpg"  class="img-responsive" > 
                <div class="img-overlay">
                    <a  href="{{ URL::to('index')}}/2"><button class="btn btn-lg btn-primary btn-xl"><i class="fa fa-cart-arrow-down fa-1x " ></i> {{trans('c.Web-shop')}}</button></a>
                </div>

            </div>
            
            <div class="col-md-6 col-xs-12 quad img-wrapper" >
                <img src="img/classified.png"  class="img-responsive" > 
                <div class="img-overlay">

                    <a  href="{{ URL::to('index')}}/3"><button class="btn btn-lg btn-primary btn-xl"><i class="fa fa-search fa-1x " ></i> {{trans('c.Classified Ads')}}</button></a>
                </div>
            </div>

            
            
            
            
            




        </div>
        <div class="footer" >
            <div class="row">
                <div class="col-md-8" style='margin:20px;text-align:center'>
                    <p >{{$application_name}}  </p>
                </div>
                <div class="col-md-3" style='margin:20px;'> 
                    <li class="dropup scrollable-menu">  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-language fa-2x " ></i> <span style='font-size:16px;font-weight:bold'> Language: {{$applocale}}  </span> <b class="caret"></b></a>
                        <?php //var_dump(Config::get('languages')); ?>
                        <ul class="dropdown-menu scrollable-menu"  >
                            @foreach (Config::get('languages') as $lang => $language)

                            <li>
                                <a href="{{ route('lang.switch', $lang) }}">{{$language}}</a>
                            </li>

                            @endforeach
                        </ul>


                    </li>
                </div>
            </div>
        </div>

    </body>
</html>
