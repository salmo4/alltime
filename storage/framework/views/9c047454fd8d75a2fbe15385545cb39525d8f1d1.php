<?php $__env->startSection('head'); ?>

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
             $.ajax({url: '<?php echo e(URL::to('/message/get/')); ?>'+'/' + $(this).attr('id').substr(7), success: function(result) {
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

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="container">
     <h1> Bid list</h1>
    <form class="form" method="POST">
        <div class="form-group">
            <label><?php echo e(trans('c.Search by name')); ?></label>
            <input class="form-control"
                   name="keyword"
                   value="<?php if( isset($bid_products['filter']['keyword'] )): ?><?php echo e($bid_products['filter']['keyword']); ?><?php endif; ?>"
                    style="width: 300px;"
                    />
        </div>
        <?php /*<div class="form-group">
            <label>Starting price(sa traduci)</label>
            <input class="form-control"
                   name="minimalPrice"
                   value="<?php if( isset($bid_products['filter']['minimalPrice'] )): ?><?php echo e($bid_products['filter']['minimalPrice']); ?><?php endif; ?>"
                    style="width: 300px;"
                    />
        </div>*/ ?>
        <div class="form-group">
            <input type="submit" name="filter" value="Filter" class="right btn btn-primary marginR">
            <input type="submit" name="reset" value="Reset" class="right btn btn-default">
        </div>
        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
    </form>
        <table class="table">
            <tbody>
                <tr>
                    <td>
                    </td>
                     <td>
                        <b><?php echo e(trans('c.Name')); ?></b>
                    </td>
                    <td>
                        <b><?php echo e(trans('c.Opening price')); ?></b>
                        <a href="?sort=<?php if( $bid_products['sort'] == 'oppeningasc' ): ?><?php echo e("oppeningdesc"); ?><?php else: ?><?php echo e("oppeningasc"); ?><?php endif; ?>"
                           class="
                               <?php if( $bid_products['sort'] == 'oppeningasc' ): ?>
                                   fa fa-sort-asc
                               <?php elseif( $bid_products['sort'] == 'oppeningdesc' ): ?>
                                   fa fa-sort-desc
                               <?php else: ?>
                                   fa fa-sort
                               <?php endif; ?>
                                   fa-2x
                                   "
                           style="display: inline-block; float: right; text-decoration: none; padding-left: 10px;   "
                                ></a>
                    </td>
                    <td>
                        <b><?php echo e(trans('c.Bid')); ?></b>
                        <a href="?sort=<?php if( $bid_products['sort'] == 'bidgasc' ): ?><?php echo e("biddesc"); ?><?php else: ?><?php echo e("bidasc"); ?><?php endif; ?>"
                           class="
                               <?php if( $bid_products['sort'] == 'bidasc' ): ?>
                                   fa fa-sort-asc
                               <?php elseif( $bid_products['sort'] == 'biddesc' ): ?>
                                   fa fa-sort-desc
                               <?php else: ?>
                                   fa fa-sort
                               <?php endif; ?>
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
                        <b><?php echo e(trans('c.Sender')); ?></b>
                    </td>
                    <td>
                        <b><?php echo e(trans('c.Owner')); ?></b>
                    </td>
                    <td>
                        <b>Date</b>
                    </td>

                </tr>
                <?php foreach($bid_products['bid_products'] as $bid_item): ?>
                <tr >
                    <td> 
                     <img src="<?php echo e(URL::asset('/uploads/products/thumbs/small/'.$bid_item->image1)); ?>" alt="picture" >
                    </td>
                     <td> 
                        <a  href="<?php echo e(URL::to('product/'.$bid_item->product_id)); ?>" > <?php echo e($bid_item->title); ?> </a>
                    </td>
                    <td>
                        <?php if($bid_item->opening_price != ""): ?> 
                        <?php echo e($bid_item->opening_price); ?> <?php echo e($bid_item->currency); ?>

                        <?php endif; ?>
                    </td>
                    <td>
                         <?php if($bid_item->fix_price_status != "on"): ?> 
                        <?php echo e($bid_item->price); ?> <?php echo e($bid_item->currency); ?>

                        
            <?php if( $bid_item->price > $bid_item->buynow_price  ): ?>
            <br><span style="color:red;">Finished</span>
            <?php endif; ?>
                        <?php else: ?>
                        OK
                        <?php endif; ?>
                    </td>
                    
                    <td>
                        <span class="timelimit_place"><?php echo e($bid_item->timelimit); ?></span> 
                    </td>
                    
                   <td>
                        <span class="daydiff_place"><?php echo e($bid_item->daydiff); ?></span> 
                    </td>
                    
                    <td>
                        <?php echo e($bid_item->cost_name); ?><br>
                    </td>
                    <td>
                        <?php echo e($bid_item->owner_name); ?>

                    </td>



                    <td>  <?php echo e($bid_item->bids_created_at); ?> </td>

                </tr>


                <?php endforeach; ?>

            </tbody>
        </table>
     <br>
 <?php echo $bid_products['bid_products']->links(); ?>
  
</div>
 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>