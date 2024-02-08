<?php echo  $this->extend('user/templates/Recommendation_template');
$public_url=base_url()."/public/frontend/";
$baseurl=base_url()."/";
 ?>

<?php echo  $this->section('content'); ?> 
	<main class="main-feed">
      <ul class="main-feed-list">
         <div class="notfy">
         <?php echo  $this->include('user/templates/notf_header_template'); ?>
        </div>
        <div class="news_page">
        <div class="hadding_recommendation">
          <div class="hadding_main">Recommendation</div>
         <!-- <div class="subhadding_news">Lorem Ipsum is simply dummy text </div>--></div>
          
          <div class="recommendation_bx">
            <div class="  relative restaurant">
              <h2><span></span>Restaurants <a href="<?php echo base_url();?>/user/restaurant"  class="skyblue apxor bucket_see_all">View All</a></h2>
              <div class=" restaurant lblca padding-l-5 padding-r-5 swiper-container-horizontal" >
                <div class="row">

<?php
           foreach($reRestudent as $val){
			   if($val['rating']==''){
				   $val['rating']="No Rating";
			   }else{
				   $val['rating']=number_format($val['rating'],1);
			   }
        ?>

                  <div class="col-md-6 col-sm-6">
                    <div class=" relative text-left flex-start" >
                      <div href="#" class="recommendation_bxbg_white   radius-5 lblca block full-width apxor_click relative full-height">
                        <input type="hidden" class="res_id" value="657710">
                        <div class="lblca relative  height-144"><a onclick="getSingleRestudent('<?php echo $val['id'];?>')"> <img src="<?php echo $baseurl.$val['image'];?>"  alt="Culture" class="radius-top-left-4 radius-top-right-radius-4 lazy full-width"> </a></div>
                        <span class="critic-rating radius-top-left-4"><?php 
						echo $val['rating'];
						?> <i class="fa fa-star-half-o" aria-hidden="true"></i></span>
                        <div class="padding-10 ">
                          <h3 class="grey bold font-16 ellipsis res_name"> <a href="#" data-toggle="modal" data-target=""><?php echo $val['name'];?></a></h3>
                          <h4 class="grey-light-dark padding-b-5 padding-t-5 small ellipsis res_loc"><?php echo $val['address'];?></h4>
                          <p class="small bold font-13 offer_text flex align-v-center relative">
                            <span>%</span>
                            25% Off </p>
                          <h4 class="viewmore"><a onclick="getSingleRestudent('<?php echo $val['id'];?>')">View More</a></h4>
                        </div>
                      </div>
                    </div>
                  </div>
                 

 <?php } ?> 


                </div>
              </div>
            </div>
            <div class="  relative product_bx">
              <h2> Product </h2>
              <div class="product_bx_all">
                <div class="row">
                 <?php
           foreach($reProduct as $val){
			   if($val['rating']==''){
				   $val['rating']="No Rating";
			   }else{
				   $val['rating']=number_format($val['rating'],1);
			   }
        ?>
 
                  

                  <div class="col-md-4 col-sm-6 col-12">
                    <div class="product_one">
                      <a onclick="getSingleProduct('<?php echo $val['id'];?>')">
                      <div class="images_product"><span class="critic-rating radius-top-left-4">  <?php echo $val['rating'];?> <i class="fa fa-star-half-o" aria-hidden="true"></i></span><img src="<?php echo $baseurl.$val['image'];?>"></div>
                      <h2><?php echo $val['title'];?></h2>
                    </a>
                    </div>
                  </div>

       <?php } ?> 


                </div>
                <div class="product_all"> <a href="<?php echo base_url();?>/user/product">View All</a> </div>
              </div>
            </div>
            <div class=" relative restaurant">
              <h2><span></span>Best Cook <a href="<?php echo base_url();?>/user/cook"  class="skyblue apxor bucket_see_all">View All</a></h2>
              <div class="cook_bx_all">
                <div class="row">
<?php
           foreach($reCooks as $val){
        ?>

                  <div class="col-md-6 col-sm-6 col-12">
                    <div class="cook_one">
                      
                      <div class="images_cook"><a onclick="getSingleCooksbyID('<?php echo $val['id'];?>')"><img src="<?php echo $baseurl.$val['image'];?>"> </a></div>
                      <h2><?php echo $val['name'];?></h2>
                      <p><?php echo substr($val['content'],0,200);?></p>
                      <div class="cooking"> <a onclick="getSingleCooksbyID('<?php echo $val['id'];?>')">View More</a> </div>

                    </div>
                  </div>
<?php } ?> 

                  
                </div>
              </div>
            </div>
            <div class="  relative recipes_bx">
              <h2> Recipes </h2>
              <div class="recipes_bx_all">
                <div class="block-quick-links"> 

            <?php
           foreach($reRecipe as $val){
        ?>


                  <a href="<?php echo base_url();?>/user/user-recipe-details/<?php echo $val['id'];?>"><img src="<?php echo $baseurl.$val['image'];?>" class="attachment-thumbnail size-thumbnail entered lazyloaded"> <span><?php echo $val['title'];?></span></a> 

      <?php } ?> 

               </div>
                <div class="recipes_all"> <a href="<?php echo base_url();?>/user/userrecipelist">View All</a> </div>
              </div>
            </div>
          </div>
        </div>
      </ul>
    </main>
    
    <span id="showmodel" style="display:none"></span>  
  


    <?php echo  $this->endSection(); ?>

    <span id="showmodel" style="display:none"></span> 