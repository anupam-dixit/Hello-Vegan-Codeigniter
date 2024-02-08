<?php echo  $this->extend('user/templates/cooks_template');
$public_url=base_url()."/public/frontend/";
$baseurl=base_url()."/";
 ?><?php echo  $this->section('content'); ?>

<main class="main-feed">
  <ul class="main-feed-list">
  <div class="notfy">
           <?php echo  $this->include('user/templates/notf_header_template'); ?>
        </div>
    <div class="news_page">
      <div class="hadding_main">Cook</div>
      <!--<div class="subhadding_news">Lorem Ipsum is simply dummy text </div>-->
      <div class="cook_bx_page">
        <div class="cook_bx_all">
          <div class="row">
            <?php
           foreach($cooksall as $val){
        ?>
            <div class="col-md-6 col-sm-6">
              <div class="cook_one">
                <div class="images_cook"><img src="<?php echo $baseurl.$val['image'];?>"></div>
                <h2><?php echo $val['name'];?></h2>
                <p><?php echo $val['content'];?></p>
                <div class="cooking"> <a onclick="getSingleCooksbyID('<?php echo $val['id'];?>')">View More</a> </div>
              </div>
            </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </ul>
</main>
<span id="showmodel" style="display:none"></span> <?php echo  $this->endSection(); ?>