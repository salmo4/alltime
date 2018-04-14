<?php $__env->startSection('head'); ?>

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
             $.ajax({url: '<?php echo e(URL::to('/message/get/')); ?>'+'/' + $(this).attr('id').substr(7), success: function(result) {
                    //   console.log('element in ajax: '+curr_element);
                    //$("#message_place").html(result);
                    $('#' + curr_element).parent().add("<div class='message_wrapper'> message place </div>").html(result);
                }});
        });
    });
</script>


<script>
// jQuery From
    $(document).ready(function() {
        
        current_res ='';
        $('.arrived_bid_form').submit(function() {

            $(this).ajaxSubmit({
                success: function(res, statusText, xhr, $form) {
                    //   alert( res);
                    auctionmodal.open({content: res});
                    current_res =res;

                }
            });
            // return false to prevent normal browser submit and page navigation 

            return false;
        });


            $('body').on('click', '.modal-close', function() {
              //  console.log('katt');
                if(current_res.substr(0, 2)=='OK'){
                     window.location.href = "<?php echo e(URL::to('mainbids')); ?>";
                }
            });

    });

</script>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="container" style="width:">
     <h3> <a href="<?php echo e(URL::to('mainbids')); ?>"><< Back to the main page of Bids</a></h3>


    <h3>Arrived bids by products  |    <a href="<?php echo e(URL::to('sentbids')); ?>">Sent bids by products</a></h3>

        <table class="table">
            <tbody>
                <tr>
                    <td>
                        <b><?php echo e(trans('c.Sender')); ?></b>
                    </td>
                    <td>
                        <b><?php echo e(trans('c.Owner')); ?></b>
                    </td>
                    <td>
                        <b><?php echo e(trans('c.Name')); ?></b>
                    </td>
                    <td>
                        <b><?php echo e(trans('c.Picture')); ?></b>
                    </td>
                    <td>
                        <b><?php echo e(trans('c.Fix price')); ?></b>
                    </td>
                    <td>
                        <b><?php echo e(trans('c.Bid')); ?></b>
                    </td>


                    <td>
                        <b>Date</b>
                    </td>
                    <td>
                        <b><?php echo e(trans('c.delete')); ?></b>
                    </td>
                     <td>
                        <b>Put it in the basket of the Bidder</b>
                        <h5 style="color:blue" >You can choose from Bidders! </h5>
                    </td>
                </tr>
                <?php foreach($bid_products as $bid_item): ?>
                <tr>
                    <td>
                        <?php echo e($bid_item->cost_name); ?><br>

                        <a href="mailto:<?php echo e($bid_item->cost_email); ?>"><?php echo e($bid_item->cost_email); ?></a>
                    </td>
                    <td>
                        <?php echo e($bid_item->owner_name); ?>

                    </td>
                    <td><?php echo e($bid_item->title); ?></td>
                    <td> 
                     <img src="<?php echo e(URL::asset('/uploads/products/thumbs/small/'.$bid_item->image1)); ?>" alt="picture" >
                    </td>
                    <td><?php echo e($bid_item->fix_price_status); ?> </td>
                    <td><?php echo e($bid_item->price); ?> <?php echo e($bid_item->currency); ?></td>

                    <td>  <?php echo e($bid_item->bids_created_at); ?> </td>
                    <td> 
      
                 <a href="<?php echo e(URL::to('bid/delete/'.$bid_item->bidsid.'/arrived')); ?>" onclick="if (!confirm('Are you sure to delete this item?')) {
            return false;
        }
        ;"> Delete </a>
                    </td>

                     <td>
        <form action="<?php echo e(URL::to('basket/add')); ?>"  method="post" accept-charset="UTF-8" class="arrived_bid_form">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <input type="hidden" name="product_id" value="<?php echo e($bid_item->product_id); ?>" />
                <input type="hidden" name="admin_id" value="<?php echo e($bid_item->admin_id); ?>" />
                <input type="hidden" name="member_id" value="<?php echo e($bid_item->member_id); ?>" />
                <input type="hidden" name="bid" value="<?php echo e($bid_item->price); ?>" />
                <!-- <?php echo e(Form::text('quantity', 1,  [ 'class' => '', 'style'=>'' ] )); ?> -->
                <input class="btn btn-info"  type="submit" name="submit" value="Add to Bidder's basket" />

        </form>
                    </td>
                </tr>
                <tr class="border_bottom">
                    <td colspan ="8"> 
                        
                      <h3><?php echo e(trans('c.Messages')); ?></h3>
                                           <a name="bidsid_<?php echo e($bid_item->bidsid); ?>"></a>
                        <?php echo e($bid_item->message); ?>  
                        <br>
                        <?php /* <?php echo e($bid_item->bid_id_count); ?>   */ ?>
                        <?php if($bid_item->bid_id_count >0): ?>   
                        <div id="message_place">
                            
                            <a href="#bidsid_<?php echo e($bid_item->bidsid); ?>" id="bidsid_<?php echo e($bid_item->bidsid); ?>" class="show_message_link" > Show the <?php echo e($bid_item->bid_id_count); ?> message </a>   
                        </div>
                        <!--   <br><a href="<?php echo e(URL::to('message/get/'.$bid_item->bidsid)); ?>">  Show the message!</a>  --> 
                        <?php endif; ?>
                        <br>
                        <a href="<?php echo e(URL::to('message/add/'.$bid_item->bidsid.'/'.$bid_item->customer_id.'/'.$bid_item->product_id)); ?>">  Write a message!</a>     
                    
                    </td>  
                </tr>

                <?php endforeach; ?>

            </tbody>
        </table>



</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>