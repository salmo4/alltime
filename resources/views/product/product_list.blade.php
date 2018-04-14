
@extends('layout.main')
@section('head')
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('css/bootstrap_custom_auction_webshop.css')}}">

@endsection
@section('content')


<style>
    .col-md-4 {
        min-height: 1px;
        padding-left: 15px;
        padding-right: 15px;
        position: relative;
        float: left;
        width: 33.3333%;
    }


    .card {
        background-color: #fff;
        border-radius: 2px;
        margin: 10px;
        overflow: hidden;
        position: relative;
        transition: box-shadow 0.25s ease 0s;
        text-align: center;
    }
    
    
        .card-image {
            position: absolute;
            clip: rect(0px,300px,100px,0px);
            height:120px; 
            left: 0;
            right: 0; 
            margin-left: auto;
            margin-right: auto;
    }
</style>

<div class="container">



    <div class="row">





        <ul class="thumbnails ">
            @foreach($products as $product)
            <li class="thumbnail col-md-3 col-sm-4 col-xs-8 card add_shadow " style="height:320px;">
                <div style="padding:10px;">
                    <div class='card-image' style="">

                        <a  href="{{ URL::to('product/'.$product->id) }}" > 
                        
                        <img src="{{URL::asset('/uploads/products/thumbs/small/'.$product->image1)}}" alt="picture" >
                        </a>
                        </a>
                    </div>
                    <div  style="height:100px;"></div>

                    <h4 >{{ link_to('product/'.$product->id, $product->title)}}</h4>

                    <div style="margin-top:10px;">
                        <div  >{{  trans('c.Vendor') }} :  <b>{{$product->user_name}}</b> 
                        </div> 
                         @if ( $application_type ==1)
                        @if ($product->fix_price_status =="on")
                        <p  >{{  trans('c.Price') }}: <b>{{$product->opening_price}}</b> {{$product->code}} ({{$product->currency}})</p>
                        <div  ></div> 
                        @else  
                        <div  >{{  trans('c.Opening price') }} : <b>{{$product->opening_price}}</b> {{$product->code}} ({{$product->currency}})
                        </div> 
                        <div  >
                            @if (empty($product->maxbidprice))
                            {{  trans('c.Minimal price') }} : <b>{{$product->opening_price}}</b> {{$product->code}} ({{$product->currency}})
                            @else
                            {{  trans('c.Minimal price') }} : <b>{{$product->maxbidprice}}</b> {{$product->code}} ({{$product->currency}})
                            @endif
                        </div> 
                        @endif
                        
                        @elseif ( $application_type ==2 or $application_type ==3)
                         <p  >{{  trans('c.Price') }}: <b>{{$product->shop_price}}</b> {{$product->code}} ({{$product->currency}})</p>
                        @endif
                        <div  >
                          {{  trans('c.Category') }} :   {{trans('c.'.$product->category_name)}}
                        </div> 

                    </div>
                  <!--  {{  trans('c.Read more') }}-->
                      
                    <a  href="{{ URL::to('product/'.$product->id) }}" >  
                        <button class="btn btn-info waves-effect waves-light" type="button">@if ($product->fix_price_status =="on") Buy now  @else   Bid now @endif<i class="fa fa-arrow-circle-right  fa-1x " ></i></button>
                    </a>

                </div>

            </li>
            @endforeach
        </ul>
        
        

    </div>
    <div class="row" > 
      <div class="row" style="margin-top:40px;">
          <div class="col-md-2" style="text-align: center;">
          <h4 >  {{  trans('c.vendors') }}:</h4>
           </div>
             <div class="col-md-12">
           <ul class="thumbnails ">
           @foreach($sellers as $seller) 
            <li class="thumbnail col-md-3 col-sm-4 col-xs-8 card add_shadow ">  <strong ><a style="display: block;" href="{{ URL::to('index/0/'.$seller->id) }}" ><span class="glyphicon glyphicon-user"></span>   {{ $seller->name}} </a>   </strong ></li>
                @endforeach     
           </ul>
           </div>
          

     </div>
        <?php echo $products->links(); ?>  
    
     </div>
    
    
   <div class="row" style="padding:50px;">
 <!--
    Advertisement: <br> 
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-9781487221982398"
     data-ad-slot="2081224597"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
-->
</div> 
    
    </div>




@stop