@extends('layout.ajax')

@section('content')


            @foreach($products as $product)



 
<a  href="{{ URL::to('product/'.$product->id) }}" target="_blank" >    {{$product->title}}: {{$product->opening_price}} {{$product->currency}}</a>

@endforeach





@stop

