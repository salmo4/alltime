@extends('layout.main')
@section('title')
{{$product->title}} - {{$product->opening_price}} {{  trans('c.monetary unit') }} | 
@endsection
@section('head')






<style>


    .carousel-inner > .item > img, .carousel-inner > .item > a > img {
        width: 100%;
        margin: auto;
    }


</style>  


<script>
// jQuery From
    $(document).ready(function () {


        current_res = '';
        $('#message2_form').submit(function () {

            $(this).ajaxSubmit({
                success: function (res, statusText, xhr, $form) {
                    //   alert( res);
                    auctionmodal.open({content: res});
                    current_res = res;
                    if (current_res.substr(0, 2) == 'OK') {
                        $('#message2_form')[0].reset();
                        //  $('#message2_form').hide();
                    }

                    $("#captcha_image").attr('src', "{{ URL::to('captcha')}}" + '?' + Math.random());

                }
            });
            // return false to prevent normal browser submit and page navigation 

            return false;
        });

    });

</script> 



<script>

    //captcha_image_place
    $(document).ready(function () {

        $("#captcha_image").attr("src", "{{ URL::to('captcha')}}");

//new captcha load
        $('#new_captcha_image').click(function (e) {
            // console.log('katt');
            // $("#captcha_image").attr("src","{{ URL::to('captcha')}}");
            $("#captcha_image").attr('src', "{{ URL::to('captcha')}}" + '?' + Math.random());
        });

        $("#send_message_btn").click(function (result) {
            // $("#captcha_image").attr('src', "{{ URL::to('captcha')}}"+'?'+Math.random());

        });

    });</script> 

<script>
    $(document).ready(function () {
var date1 = $("#timelimit").html();
var date2 = new Date();
var date1 = new Date(date1.replace(/-/g,'/'));  
if(date1 > date2){
 $("#timelimit").css('color','green');   
}else{
   $("#timelimit").css('color','red');     
}
 });
</script>
@endsection

@section('content')


<div class="container">

    <div class="row">
        <div class='col-xs-12' >

            @if( $application_type ==1)  <a  class="navbar-brand" href="{{ URL::to('index')}}/1"><i class="fa fa-chevron-circle-left   fa-1x " ></i> {{  trans('c.Back to the list') }}</a> @endif
            @if( $application_type ==2)  <a  class="navbar-brand" href="{{ URL::to('index')}}/2"<i class="fa fa-chevron-circle-left   fa-1x " ></i>  {{  trans('c.Back to the list') }}</a> @endif
            @if( $application_type ==3)  <a  class="navbar-brand" href="{{ URL::to('index')}}/3"<i class="fa fa-chevron-circle-left   fa-1x " ></i>  {{  trans('c.Back to the list') }}</a> @endif
        </div>

    </div>
    <div class="row">
        <div class='col-xs-9' >
            <h3>{{$product->category_name}}</h3>

            <h2>{{$product->title}}
            
             @if(  $product->opened == 0)
          <span style="color:red;">  -  Closed Auction </span>
            @endif
            
            </h2>


            <p>{{  trans('c.Vendor') }} : <b>{{$product->user_name}}</b></p>
            <h3>{{  trans('c.Description') }}:</h3> 

            <h5>{{$product->description}}</h5>

            @if ( $application_type ==1)
            @if ($product->fix_price_status =="on")
            <h5><b>Fix Price: </b> {{$product->opening_price}} {{$product->currency_code}} ({{$product->currency_currency}})</h5>
            @else               

            <h5><b>{{  trans('c.Opening price') }}:</b> {{$product->opening_price}} {{$product->currency_code}}  ({{$product->currency_currency}}) </h5>
            <!--
            <p>{{  trans('c.Lowest price') }}: <b>{{$product->lowest_price}}</b></p>
            -->
            <h5> <b>{{  trans('c.Buy now price') }}:</b> 
                 @if($product->buynow_price != "") 
                {{$product->buynow_price}} {{$product->currency_code}}  ({{$product->currency_currency}})
                @endif
            </h5>
            @endif
            @elseif ( $application_type ==2 or $application_type ==3)
            <h5 ><b>{{  trans('c.Price') }}:</b> {{$product->shop_price}} {{$product->currency_code}} ({{$product->currency_currency}})</h5>
            @endif
            
            <h5> <b>End of the Auction:</b> 
                <span id="timelimit">{{$product->timelimit}}</span> 

            </h5>
        </div>
    </div>

    <div class="row">  
        <div class='col-md-6 col-xs-12' style="padding:0px;" >

            <!--carousel--> 

            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">

                    @for ($n = 1; $n <= 10; ++$n)
                    @if ($product->{'image'.$n} !="default.jpg" )
                    <li data-target="#myCarousel" data-slide-to="{{$n}}"></li>
                    @endif
                    @endfor  
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox" >

                    @for ($n = 1; $n <= 10; ++$n)
                    @if ($product->{'image'.$n} !="default.jpg" )
                    <div class="item @if($n == 1)active @endif">
                        <img src="{{URL::asset('/uploads/products/thumbs/medium/'.$product->{'image'.$n})}}" alt="picture" >
                    </div>
                    @endif
                    @endfor  


                </div>

                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

            <!--carousel end-->     

        </div>
        <div class='col-md-6 col-xs-12' >

            @if (Auth::check() && $product->fix_price_status =="on" || $minprice > $product->buynow_price)
            
            @if( $minprice > $product->buynow_price && $product->fix_price_status !="on" )
            <h4> <span style="color:blue">The price of the  product has been reached the buy now price! </span>
                <br>
            The seller will connect with the bidder.
            </h4>
            @endif
          
            <!--
            <form action="{{ URL::to('basket/add')}}"  method="post" accept-charset="UTF-8">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="product_id" value="{{$product->id}}" />

                <input type="hidden" name="admin_id" value="{{$product->admin_id}}" />

                <div class='form-inline'>
                    {{ Form::label('quantity', "Quantity:", [ 'style'=>'margin-left:10px;' ]) }}
                    {{ Form::text('quantity', 1,  [ 'class' => 'form-control', 'style'=>'width:50px;margin-left:10px;' ] ) }} 
                </div>

                <div class="form-group">
                    <input class="btn btn-info"  type="submit" name="submit" value="{{trans('c.Add to basket')}}" />
                </div>

            </form>
          -->
            @endif
           @if (Auth::check() && $application_type ==1  && ($minprice < $product->buynow_price || $product->fix_price_status =="on"))
            <form action="{{ URL::to('bid/add')}}"  method="post" accept-charset="UTF-8">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="product" value="{{$product->id}}" />

                <input type="hidden" name="admin_id" value="{{$product->admin_id}}" />

                <input type="hidden" name="fix_price_status" value="{{$product->fix_price_status}}" />

                @if ($product->fix_price_status !="on")

                <h4> {{  trans('c.Enter') }} {{$minprice}} {{$product->currency_code}}  ({{$product->currency_currency}}) or more:</h4>

                @endif

                <input type="hidden" name="minprice" value="{{$minprice}}" />
                <br>
                <div class='form-group'>
                    @if ($product->fix_price_status !="on")
                    {{ Form::label('bid_value', trans('c.Bid value').":") }}
                    {{ Form::text('price', null,  [ 'class' => 'form-control', 'style'=>'width:100px;' ] ) }} {{  trans('c.monetary unit') }}
                    <br>  <br>
                    @endif
                    {{ Form::label('message', trans('c.Private message').":") }}
                    {{ Form::textarea('message', null,  [ 'class' => 'form-control', 'style'=>'width:300px;' ] ) }}
                </div>
                @if ($product->fix_price_status !="on")
                <input class="btn btn-info"  type="submit" name="submit" value="{{trans('c.Place bid')}}" />
                @else
                <input class="btn btn-info"  type="submit" name="submit2" value="Make an offer" />
                @endif

            </form>
            @elseif (!Auth::check() && $application_type ==1 )
            <br>     <br><!-- {{trans('c.Place bid')}} -->
            <a href="{{ URL::route('user/login')}}"> <button class="btn btn-info"><i class="fa fa-legal fa-1x " ></i>  @if ($product->fix_price_status =="on") Buy now  @else   Bid now @endif <br> <i class="fa fa-sign-in fa-1x " ></i> {{trans('c.Please Login')}}</button></a>  

            @elseif (!Auth::check() && $application_type ==2 )
            <br>     <br>
            <a href="{{ URL::route('user/login')}}"> <button class="btn btn-info"><i class="fa fa-cart-arrow-down fa-1x " ></i> Add to basket <br> <i class="fa fa-sign-in fa-1x " ></i>  {{trans('c.Please Login')}}</button></a>  

            @endif 


            <br> <br>
           <!--
            <div style="background: #ccc;padding:20px; width:350px;">
            <h4> Sending message to the vendor </h4> 
            <form action="{{ URL::to('message/add2')}}"  method="post" accept-charset="UTF-8" id='message2_form'>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="product_id" value="{{$product->id}}" />
                <input type="hidden" name="admin_id" value="{{$product->admin_id}}" />
                <br>
                <div class='form-group'>

                    {{ Form::label('Email', 'Your email address:')}}
                    {{ Form::email('email', null,  [ 'class' => 'form-control', 'style'=>'width:300px;','id'=>'message_email' ] ) }} 
                    <br><br>
                    {{ Form::label('message','Message for the vendor:') }}
                    {{ Form::textarea('message', null,  [ 'class' => 'form-control', 'style'=>'width:300px;' ] ) }}
                </div>
                <div class='form-group'>

          
                    <img id="captcha_image" /> 
                </div>

                {{ Form::label('Email', 'Please enter the code above!')}}<br>
                {{ Form::text('captcha', null,  [ 'class' => 'form-control', 'style'=>'width:300px;' ] ) }} 
                <br>
                {{ Form::button('<i class="fa fa-envelope fa-1x " ></i> '.trans('c.Send message') , ['type' => 'submit', 'class' => 'btn btn-primary' ,'id'=>'send_message_btn']) }}

            </form>
             </div>
           -->
        </div>
    </div>  
    
<div class="row" style="padding:50px;"> 
 <!-- 
    
    Advertisement: <br> 
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-9781487221982398"
     data-ad-slot="9464890595"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
-->
</div> 
    
    
    <br>  <br>
</div>
</div>



</div>


@endsection