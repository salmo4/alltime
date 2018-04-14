@section('head')
@extends('layout.main')
@section('content')

<style>
    hr {
  -moz-border-bottom-colors: none;
  -moz-border-image: none;
  -moz-border-left-colors: none;
  -moz-border-right-colors: none;
  -moz-border-top-colors: none;
  border-color: #EEEEEE -moz-use-text-color #FFFFFF;
  border-style: solid none;
  border-width: 3px 0;
  margin: 25px 0;
}
</style>
<div class="container" style="width:60%">

    <h3>  Sent Orders| <a href="{{ URL::to('arrived_orders')}}"> Arrived orders</a>    </h3>
    <br>  <br>
    <div class="menu">


        @foreach($orders as $key => $order)

        
 <table class="table table-striped table-condensed">
   <tr><td>Customer name: </td><td>  {{ $order[0]['name']}} </td></tr>
   <tr><td>Customer email: </td><td>{{$order[0]['email']}} </td></tr>
   <tr><td>Order Detail: </td><td><a  href="{{ URL::to('order/'.$key.'/member') }}"  > <strong> detail >> </strong></a> </td></tr>
   <tr><td>Order ID: </td><td>{{$key}} </td></tr>

 </table>
   



        <table class="table table-striped table-condensed">
            <thead>
                <tr>
                    <th>
                        Product
                    </th>
                    <th>
                        Price
                    </th>
                    <th>
                        Picture
                    </th>
                    <th>
                        Quantity
                    </th>



                </tr>
            </thead>   
            <tbody>
                @foreach($order as $item)
                <tr>
                    <td>  {{$item['title']}}</td>
                    <td>  {{$item['shop_price']}} </td>
                    <td> 
                        <img src="{{URL::asset('/uploads/products/thumbs/small/'.$item['image1'])}}" alt="picture" >
                    </td>
                    <td>  {{$item['quantity']}} </td>


                    <td>      </td>

                    <td> 
                         </td>
                </tr>
                @endforeach

            </tbody>
        </table>
        
    <hr >
        @endforeach







    </div>
    @stop