@extends('layout.main')
@section('head')

<style>
    
  tr.border_bottom td {
  border-bottom:1pt solid black;
}
</style>


<script>
    $(function() {

        $(".show_message_link").click(function() {
          // console.log($(this).attr('id').substr(7));
            curr_element = $(this).attr('id');
           // $.ajax({url: "/message/get/" + $(this).attr('id').substr(7), success: function(result) {
             $.ajax({url: '{{URL::to('/message/get/')}}'+'/' + $(this).attr('id').substr(7), success: function(result) {
                    //   console.log('element in ajax: '+curr_element);
                    //$("#message_place").html(result);
                    $('#' + curr_element).parent().add("<div class='message_wrapper'> message place </div>").html(result);
                }});
        });
    });
</script>

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
                        <b>{{  trans('c.Sender') }}</b>
                    </td>
                    <td>
                        <b>{{  trans('c.Owner') }}</b>
                    </td>
                    <td>
                        <b>{{  trans('c.Name') }}</b>
                    </td>
                    <td>
                        <b>{{  trans('c.Picture') }}</b>
                    </td>
                    <td>
                        <b>{{  trans('c.Fix price') }}</b>
                    </td>
                    <td>
                        <b>{{  trans('c.Bid') }}</b>
                    </td>


                    <td>
                        <b>Date</b>
                    </td>

                </tr>
                @foreach($bid_products as $bid_item)
                <tr>
                    <td>
                        {{$bid_item->cost_name}}<br>

                        <a href="mailto:{{$bid_item->cost_email}}">{{$bid_item->cost_email}}</a>
                    </td>
                    <td>
                        {{$bid_item->owner_name}}
                    </td>
                    <td>{{$bid_item->title}}</td>
                    <td> 

                         <img src="{{URL::asset('/uploads/products/thumbs/small/'.$bid_item->image1)}}" alt="picture" >
                    </td>
                    <td>{{$bid_item->fix_price_status}} </td>
                    <td>{{$bid_item->price}} {{  $bid_item->currency }}</td>

                    <td>  {{$bid_item->bids_created_at}} </td>

                </tr>
                 <tr class="border_bottom">
                      <td colspan ="8"> 
                           <h3>{{  trans('c.Messages') }}</h3>
                       <a name="bidsid_{{$bid_item->bidsid}}"></a>
                        {{$bid_item->message}}  
                        <br>
                        {{-- {{$bid_item->bid_id_count}}   --}}
                        @if ($bid_item->bid_id_count >0)   
                        <div id="message_place">
                            
                            <a href="#bidsid_{{$bid_item->bidsid}}" id="bidsid_{{$bid_item->bidsid}}" class="show_message_link" > Show the {{$bid_item->bid_id_count}} message </a>   
                        </div>
                        <!--   <br><a href="{{URL::to('message/get/'.$bid_item->bidsid)}}">  Show the message!</a>  --> 
                        @endif
                        <br>
                        <a href="{{URL::to('message/add/'.$bid_item->bidsid.'/'.$bid_item->customer_id.'/'.$bid_item->product_id)}}">  Write a message!</a>    
                           </td>  
                       </tr>
                @endforeach

            </tbody>
        </table>


    </form>
</div>
@stop