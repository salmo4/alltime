@extends('layout.main')
@section('head')

<style>
    
  tr.border_bottom td {
  border-bottom:1pt solid black;
}
img {
    width:100px;
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


<script>
    $(document).ready(function () {


            $( ".timelimit_place" ).each(function( index ) {
              //console.log( index + ": " + $( this ).text() );
            var date1 = $( this ).html();
            var date2 = new Date();
            var date1 = new Date(date1.replace(/-/g,'/'));  
            if(date1 > date2){
             $( this ).css('color','green');   
            }else{
              $( this ).css('color','red');     
            }

            });

 });
</script>


<script>
    $(document).ready(function () {


            $( ".daydiff_place" ).each(function( index ) {
            var current_number = $( this ).html();

            if(current_number > 0){
             $( this ).css('color','green');   
            }else{
              $( this ).css('color','red');     
            }

            });

 });
</script>

@stop

@section('content')

<div class="container">
     <h1> Bid list</h1>
    <form class="form" method="POST">
        <div class="form-group">
            <label>{{trans('c.Search by name')}}</label>
            <input class="form-control"
                   name="keyword"
                   value="@if( isset($bid_products['filter']['keyword'] )){{$bid_products['filter']['keyword']}}@endif"
                    style="width: 300px;"
                    />
        </div>
        {{--<div class="form-group">
            <label>Starting price(sa traduci)</label>
            <input class="form-control"
                   name="minimalPrice"
                   value="@if( isset($bid_products['filter']['minimalPrice'] )){{$bid_products['filter']['minimalPrice']}}@endif"
                    style="width: 300px;"
                    />
        </div>--}}
        <div class="form-group">
            <input type="submit" name="filter" value="Filter" class="right btn btn-primary marginR">
            <input type="submit" name="reset" value="Reset" class="right btn btn-default">
        </div>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>
        <table class="table">
            <tbody>
                <tr>
                    <td>
                    </td>
                     <td>
                        <b>{{  trans('c.Name') }}</b>
                    </td>
                    <td>
                        <b>{{  trans('c.Opening price') }}</b>
                        <a href="?sort=@if( $bid_products['sort'] == 'oppeningasc' ){{"oppeningdesc"}}@else{{"oppeningasc"}}@endif"
                           class="
                               @if( $bid_products['sort'] == 'oppeningasc' )
                                   fa fa-sort-asc
                               @elseif( $bid_products['sort'] == 'oppeningdesc' )
                                   fa fa-sort-desc
                               @else
                                   fa fa-sort
                               @endif
                                   fa-2x
                                   "
                           style="display: inline-block; float: right; text-decoration: none; padding-left: 10px;   "
                                ></a>
                    </td>
                    <td>
                        <b>{{  trans('c.Bid') }}</b>
                        <a href="?sort=@if( $bid_products['sort'] == 'bidgasc' ){{"biddesc"}}@else{{"bidasc"}}@endif"
                           class="
                               @if( $bid_products['sort'] == 'bidasc' )
                                   fa fa-sort-asc
                               @elseif( $bid_products['sort'] == 'biddesc' )
                                   fa fa-sort-desc
                               @else
                                   fa fa-sort
                               @endif
                                   fa-2x
                                   "
                           style="display: inline-block; float: right; text-decoration: none; padding-left: 10px;"
                                ></a>
                    </td>
                    
                     <td>
                        <b>End of the Auction</b>
                    </td>
                    
                    <td>
                        <b>Number of the days</b>
                    </td>
                         
                    <td>
                        <b>{{  trans('c.Sender')}}</b>
                    </td>
                    <td>
                        <b>{{  trans('c.Owner') }}</b>
                    </td>
                    <td>
                        <b>Date</b>
                    </td>

                </tr>
                @foreach($bid_products['bid_products'] as $bid_item)
                <tr >
                    <td> 
                     <img src="{{URL::asset('/uploads/products/thumbs/small/'.$bid_item->image1)}}" alt="picture" >
                    </td>
                     <td> 
                        <a  href="{{ URL::to('product/'.$bid_item->product_id) }}" > {{$bid_item->title}} </a>
                    </td>
                    <td>
                        @if($bid_item->opening_price != "") 
                        {{$bid_item->opening_price}} {{  $bid_item->currency}}
                        @endif
                    </td>
                    <td>
                         @if($bid_item->fix_price_status != "on") 
                        {{$bid_item->price}} {{  $bid_item->currency}}
                        
            @if( $bid_item->price > $bid_item->buynow_price  )
            <br><span style="color:red;">Finished</span>
            @endif
                        @else
                        OK
                        @endif
                    </td>
                    
                    <td>
                        <span class="timelimit_place">{{$bid_item->timelimit}}</span> 
                    </td>
                    
                   <td>
                        <span class="daydiff_place">{{$bid_item->daydiff}}</span> 
                    </td>
                    
                    <td>
                        {{$bid_item->cost_name}}<br>
                    </td>
                    <td>
                        {{$bid_item->owner_name}}
                    </td>



                    <td>  {{$bid_item->bids_created_at}} </td>

                </tr>


                @endforeach

            </tbody>
        </table>
     <br>
 <?php echo $bid_products['bid_products']->links(); ?>
  
</div>
 
@stop