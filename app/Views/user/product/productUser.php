<?php echo  $this->extend('user/templates/product_template');
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
          <div class="hadding_main">Product</div>
         <!--  <div class="subhadding_news">Lorem Ipsum is simply dummy text </div> -->
          <div class="recommendation_bx">
            <div class=" relative product_page">
              <div class="product_bx_all">
                <div class="row">
            <?php
		
           foreach($productall as $val){
			   if($val['rating']==''){
				   $val['rating']="No Rating";
			   }else{
				   $val['rating']=number_format($val['rating'],1);
			   }
        ?>

                  <div class="col-md-4 col-sm-6 col-6">
                    <div class="product_one product_page">
                      <div class="images_product"><span class="critic-rating radius-top-left-4"> <?php echo $val['rating']?> <i class="fa fa-star-half-o" aria-hidden="true"></i></span> <a class="btn_view_more_rel_page" onclick="getSingleProduct('<?php echo $val['id'];?>')"><img src="<?php echo $baseurl.$val['image'];?>"></a></div>
                      <h2><?php echo $val['title'];?></h2>
                    </div>
                  </div>

              <?php } ?>    
                   
                   
                   
                </div>
              </div>
            </div>
          </div>
        </div>
      </ul>
    </main>

      <span id="showmodel" style="display:none"></span>  
  


    <?php echo  $this->endSection(); ?>
