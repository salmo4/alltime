
@extends('layout.main')
@section('head')


   
 <style>

     
  .carousel-inner > .item > img, .carousel-inner > .item > a > img {
      width: 100%;
      margin: auto;

  }


  </style>  

  


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
            clip: rect(0px,300px,220px,0px);
            height:220px; 
            left: 0;
            right: 0; 
            margin-left: auto;
            margin-right: auto;
    }
</style>

<div class="container">


  <div class="row" >

   <ul class="thumbnails "> 
           <li class="thumbnail col-md-3 col-sm-4 col-xs-8 card add_shadow " style="height:320px;">
     <!--carousel--> 
    <div id="myCarousel" class="carousel slide " data-ride="carousel" data-interval="2000">
    <!-- Indicators -->
    <ol class="carousel-indicators">

               @for ($n = 0; $n <= 9; ++$n)
                <?php if(isset($random_pictures[$n])) {$random_picture =$random_pictures[$n];} ?>
                @if (!empty($random_picture) && $random_picture->image1 !="default.jpg" )
 <li data-target="#myCarousel" data-slide-to="{{$n}}"></li>
                @endif
                @endfor  
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner " role="listbox" >

               @for ($n = 0; $n <= 9; ++$n)
                <?php if(isset($random_pictures[$n])) {$random_picture =$random_pictures[$n];} ?>
                @if (!empty($random_picture) && $random_picture->image1 !="default.jpg" )
               <div class="item @if($n == 1)active @endif">
                   <a  href="{{ URL::to('product/'.$random_picture->id) }}" >   <img src="{{URL::asset('/uploads/products/thumbs/small/'.$random_picture->image1)}}" alt="picture" ></a>   
          <div class="carousel-caption">
         <a  href="{{ URL::to('product/'.$random_picture->id) }}" style="color:white;">   <h4>{{ $random_picture->title }}</h4></a>
        </div>
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
           </li>
  
   <!--carousel end-->        
     


            @foreach($categories as $category)
            <li class="thumbnail col-md-3 col-sm-4 col-xs-8 card add_shadow " style="height:320px;">

                <div style="padding:10px;">
                    <div class='card-image' style="">

                        <a  href="{{ URL::to('index/'.$category->id.'/0') }}" > 
                          
                       @if ( !empty($category->picture))
                        <img src="{{URL::asset('/uploads/category/'.$category->picture)}}" alt="picture {{$category->picture}}" >
                        @else
                        <img src="{{URL::asset('/uploads/category/default.jpg')}}" alt="picture default" >
                        @endif
                        </a>
                        </a>
                    </div>
                    <div  style="height:220px;"></div>

                    <h4 >{{ link_to('index/'.$category->id.'/0', trans('c.'.$category->name))}}</h4>



                </div>

            </li>
            @endforeach

        </ul>
   
   
    </div>

 <div class="row" style="padding:50px;"> 
  <!-- 
     Advertisement: <br> 
  <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-9781487221982398"
     data-ad-slot="3837159390"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>  
-->
</div> 
    
    </div> 

</div>



@stop