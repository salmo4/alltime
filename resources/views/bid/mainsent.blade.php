
@section('head')
@extends('layout.main')



@stop

@section('content')

<div class="container" style="width:">
         <h3> <a href="{{ URL::to('mainbids')}}"><< Back to the main page of Bids</a></h3>


    <h3> <a href="{{ URL::to('mainbids')}}">Arrived bids by products</a>  |   Sent bids by products</h3>
    <form action="order" method="post" accept-charset="UTF-8">
        <table class="table">
            <tbody>
                <tr>

                    <td>
                        <b>{{  trans('c.Name') }}</b>
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



                </tr>
                @foreach($main_bid_products as $bid_item)
                <tr>


                    <td>
                  
                     <a href="{{URL::to('sentbids/'.$bid_item->product_id)}}"> <h5>{{$bid_item->title}} >> </h5>   </a>     
                    </td>
                    <td>  <a href="{{URL::to('sentbids/'.$bid_item->product_id)}}"> 
                                 <img src="{{URL::asset('/uploads/products/thumbs/small/'.$bid_item->image1)}}" alt="picture" >   
                        </a></td>
                   <td>{{$bid_item->buynow_price}} </td>
                    <td>{{$bid_item->maxbidprice}} </td>
                    <td>{{$bid_item->bids_count}} </td>




                </tr>

                @endforeach

            </tbody>
        </table>


    </form>
</div>
@stop