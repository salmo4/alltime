<?php $__env->startSection('head'); ?>


   
 <style>

     
  .carousel-inner > .item > img, .carousel-inner > .item > a > img {
      width: 100%;
      margin: auto;

  }


  </style>  

  


<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>


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

               <?php for($n = 0; $n <= 9; ++$n): ?>
                <?php if(isset($random_pictures[$n])) {$random_picture =$random_pictures[$n];} ?>
                <?php if(!empty($random_picture) && $random_picture->image1 !="default.jpg" ): ?>
 <li data-target="#myCarousel" data-slide-to="<?php echo e($n); ?>"></li>
                <?php endif; ?>
                <?php endfor; ?>  
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner " role="listbox" >

               <?php for($n = 0; $n <= 9; ++$n): ?>
                <?php if(isset($random_pictures[$n])) {$random_picture =$random_pictures[$n];} ?>
                <?php if(!empty($random_picture) && $random_picture->image1 !="default.jpg" ): ?>
               <div class="item <?php if($n == 1): ?>active <?php endif; ?>">
                   <a  href="<?php echo e(URL::to('product/'.$random_picture->id)); ?>" >   <img src="<?php echo e(URL::asset('/uploads/products/thumbs/small/'.$random_picture->image1)); ?>" alt="picture" ></a>   
          <div class="carousel-caption">
         <a  href="<?php echo e(URL::to('product/'.$random_picture->id)); ?>" style="color:white;">   <h4><?php echo e($random_picture->title); ?></h4></a>
        </div>
                 </div>
                <?php endif; ?>
                <?php endfor; ?>  

  
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
     


            <?php foreach($categories as $category): ?>
            <li class="thumbnail col-md-3 col-sm-4 col-xs-8 card add_shadow " style="height:320px;">

                <div style="padding:10px;">
                    <div class='card-image' style="">

                        <a  href="<?php echo e(URL::to('index/'.$category->id.'/0')); ?>" > 
                          
                       <?php if( !empty($category->picture)): ?>
                        <img src="<?php echo e(URL::asset('/uploads/category/'.$category->picture)); ?>" alt="picture <?php echo e($category->picture); ?>" >
                        <?php else: ?>
                        <img src="<?php echo e(URL::asset('/uploads/category/default.jpg')); ?>" alt="picture default" >
                        <?php endif; ?>
                        </a>
                        </a>
                    </div>
                    <div  style="height:220px;"></div>

                    <h4 ><?php echo e(link_to('index/'.$category->id.'/0', trans('c.'.$category->name))); ?></h4>



                </div>

            </li>
            <?php endforeach; ?>

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



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>