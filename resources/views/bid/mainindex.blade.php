
@section('head')
@extends('layout.main')



@stop

@section('content')

<div class="container" style="width:">
        <h1> <a href="{{ URL::to('mainbids')}}">Bids</a></h1>


    <h3>Arrived bids by products  |    <a href="{{ URL::to('sentbids')}}">Sent bids by products</a></h3>
    <form action="order" method="post" accept-charset="UTF-8">
        <table class="table">
            <tbody>
                <tr>

                    <td>
                        <b>{{  trans('c.Name')}} /Bids</b>
                    </td>
                    <td>
                        <b>{{  trans('c.Picture') }}</b>
                    </td>
                    
                     <td>
                        <b>Buy now price</b>
                    </td>
                     <td>
                        <b>Current Max Bid Price</b>
                    </td>
                    
                    <td>
                        <b>Count of the bids</b>
                    </td>
                    
                     <td>
                        <b> Closing this Auction</b>
                    </td>


                </tr>
                @foreach($main_bid_products as $bid_item)
                <tr>


                    <td>
                        <a href="{{URL::to('bids/'.$bid_item->product_id)}}"> <h5>{{$bid_item->title}} >> </h5>   </a>     
                    </td>
                    <td>  <a href="{{URL::to('bids/'.$bid_item->product_id)}}"> 
                     <img src="{{URL::asset('/uploads/products/thumbs/small/'.$bid_item->image1)}}" alt="picture" >   
                        </a></td>
                    <td>{{$bid_item->buynow_price}} </td>
                    <td>{{$bid_item->maxbidprice}} </td>
                    <td>{{$bid_item->bids_count}} </td>


                      <td>
                     @if($bid_item->opened ==1)
                    {{ Form::open(array('action' => 'ProductController@productClose')) }}
                        {{ Form::hidden('product_id', $bid_item->product_id) }} 
                        {{ Form::submit('Closing Auction' , ['class' => 'btn btn-success', 'style'=>""]) }}
                     {{ Form::close() }}
                     
                        @else
                       {{ Form::open(array('action' => 'ProductController@productOpen')) }}
                        {{ Form::hidden('product_id', $bid_item->product_id) }} 
                        {{ Form::submit('Reopening Auction' , ['class' => 'btn btn-danger', 'style'=>""]) }}
                     {{ Form::close() }}
                        @endif
                     </td>
                </tr>

                @endforeach

            </tbody>
        </table>


    </form>
</div>
@stop