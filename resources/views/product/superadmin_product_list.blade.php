
@extends('layout.main')

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

        <h2>Moderation</h2>



        <ul class="thumbnails ">
            @foreach($products as $product)
            <li class="thumbnail col-md-3 col-sm-4 col-xs-8 card add_shadow " style="min-height:530px; @if($product->confirm ==0)border:1px solid red; @endif">

                @if($product->confirm ==0) 
                <strong>Waiting for moderation</strong>
                @endif

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
                        <div  >Vendor : <b>{{$product->user_name}} </b> <br>
                            ({{$product->user_email}})
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

                        @elseif ( $application_type ==2)
                        <p  >{{  trans('c.Price') }}: <b>{{$product->shop_price}}</b> {{$product->code}} ({{$product->currency}})</p>
                        @endif
                        <div  >
                            Category:    {{trans('c.'.$product->category_name)}}
                        </div> 

                    </div>


                    <a  class="btn btn-success" style="line-height: 20px;" href="{{ URL::to('product/edit/'.$product->id) }}" >  
                        Edit
                    </a>   

                    <a class="btn btn-warning " style="line-height: 20px;" href="{{ URL::to('product/deny/'.$product->id.'/0/'.$product->user_email) }}" >  
                        Deny
                    </a>            

                    <a  class="btn btn-danger " style="line-height: 20px;" href="{{ URL::to('product/superadmindelete/'.$product->id) }}"  onclick="if (!confirm('Are you sure to delete this auction?')) {
                                return false;
                            }
                            ;">  
                        Delete
                    </a>  

                    {{ Form::open(array('action' => 'ProductController@productConfirm')) }}
                    <div class="form-inline">
                        {{ Form::hidden('product_id', $product->id ) }}
                        {{ Form::hidden('email', $product->user_email) }} 
                         {{ Form::submit(' Allow' , ['class' => 'btn btn-primary', 'style'=>"line-height: 20px;"]) }}
  
                    </div>

                     {{ Form::close() }}

                      Date of confirm:  {{$product->confirm_date}}
                        {{ Form::open(array('action' => 'ProductController@feePaid')) }}
                    <div class="form-inline">
    


                        {{ Form::hidden('product_id', $product->id ) }} 
                         {{ Form::hidden('email', $product->user_email) }} 
                         

                    </div>
                        {{ Form::close() }}

                </div>

            </li>
            @endforeach
        </ul>
    </div>
    <div>
        <?php echo $products->links(); ?>  
    </div>
</div> 

</div>



@stop