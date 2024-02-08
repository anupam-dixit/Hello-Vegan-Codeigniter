<?php echo  $this->extend('user/templates/restaurants_template');
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
          <div class="hadding_main">Restaurants</div>
         <!-- <div class="subhadding_news">Lorem Ipsum is simply dummy text </div>-->
          <div class="recommendation_bx">
            <div class=" relative restaurants_page">
              <div class="relative" id="restaurants" >

          <?php
           foreach($restaurant as $val){
			   if($val['rating']==''){
				   $val['rating']="No Rating";
			   }else{
				   $val['rating']=number_format($val['rating'],1);
			   }
        ?>
 
                <div class="radius-4 bg-white restaurant margin-b-10">
                  <input type="hidden" class="res_id" value="646781">
                  <div class="grid">
                   
                    <div class="w-3-12"> <a onclick="getSingleRestudent('<?php echo $val['id'];?>')" class="apxor_click">
                      <input type="hidden" name="view" data-content="nearmelisting">
                      <div class="img1-5 margin-r-15 pb-120"> <img src="<?php echo $baseurl.$val['image'];?>"> </div>
                      </a> </div>
                      <div class="text-right"> <span class="critic"> <?php echo $val['rating'];?> <i class="fa fa-star-half-o" aria-hidden="true"></i></span> </div>
                    <div class="w-9-12"> <a href="#" class="grey-light apxor_click block">
                      <h3 class="grey res_name font-20 bold inline-block"> <?php echo $val['name'];?> </h3>
                       </a>
                      <div class="flex margin-t-10 cost_all"> <span>Cost for two </span> <span>
                        <p class="currency">₹</p>
                        <?php echo $val['price'];?> approx <b> 25% off on food &amp; all bev.</b> </span> </div>
                      
                      
                      <div class="view_menu">
                        <ul>
                          <li><a href="#"><img src="<?php echo $public_url;?>images/menu.svg"> <span> View Menu</span></a></li>
                          <li><a href="#"><img src="<?php echo $public_url;?>images/map.svg"> <span> See Location</span></a></li>
                          <li><a href="#"><img src="<?php echo $public_url;?>images/cuisine.png"> <span> Cuisine - Asian</span></a></li>
                        </ul>
                      </div>
                      
                      <?php /*?><input type="hidden" name="bookable" value="646781" data-value="1"><?php */?>
                      <div class="clear">
                        <div class="text-center margin-t-10"> <a class="btn_view_more_rel_page" onclick="getSingleRestudent('<?php echo $val['id'];?>')"> View More </a> </div>
                      </div>
                    </div>
                     
                  </div>
                </div>

             <?php } ?>    


               
              

              </div>
            </div>
          </div>
        </div>
      </ul>
    </main>

       <span id="showmodel" style="display:none"></span>  

  <?php echo  $this->endSection(); ?>
 

