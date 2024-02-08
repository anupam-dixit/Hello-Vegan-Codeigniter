<?php echo  $this->extend('user/templates/recipes_template');
$public_url=base_url()."/public/frontend/";
$baseurl=base_url()."/";
 ?>

<?php echo  $this->section('content'); ?> 

	<main class="main-feed">
      <ul class="main-feed-list">
       
        <div class="news_page">
          <div class="hadding_main">Recipes</div>
          <!--<div class="subhadding_news">Lorem Ipsum is simply dummy text </div>-->
          
          <div class="recipes_bx_page">
             <div class="row">
                <?php
           foreach($receipe as $val){
        ?>

             <div class="col-md-6">

             

             <article class="post-summary primary"><a class="post-summary__image" href="<?php echo base_url();?>/user/recipe-details/<?php echo $val['id'];?>" > <img src="<?php echo $baseurl.$val['image'];?>" class="attachment-thumbnail size-thumbnail entered lazyloaded" /> </a>
             


  <div class="post-summary__content">
   <p class="post-summary__recipe-meta"> <span class="wprm-recipe-difficulty wprm-block-text-bold">Moderate</span> • <span class="wprm-recipe-time wprm-block-text-bold"> 
    <span class="wprm-recipe-details wprm-recipe-details-minutes wprm-recipe-total_time wprm-recipe-total_time-minutes"><?php echo $val['moderate'];?></span> 
    <span class="wprm-recipe-details-unit wprm-recipe-details-minutes wprm-recipe-total_time-unit wprm-recipe-total_timeunit-minutes">mins</span> 
    </span>
    </p>
    <p class="entry-category">
     <img src="<?php echo $baseurl.$val['image'];?>">

      Street Food Recipes </p>
      
    <h2 class="post-summary__title"><a href="#"><?php echo $val['title'];?></a></h2>
  </div>

</article>
             
             </div>    
              <?php } ?>   
             
             </div>      
          </div>
        </div>
      </ul>
    </main>
    <span id="showmodel" style="display:none"></span>  

  <?php echo  $this->endSection(); ?>