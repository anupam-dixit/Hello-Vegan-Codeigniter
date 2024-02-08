
<?php echo  $this->extend('user/templates/recipes_template');
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
  <div class="recipes_bx_page">
    <div class="recipes_detailspage">
      <div class="news_page">
        <div class="hadding_main_details"><?php echo $receipe_detail['title'];?></div>
        <div class="post_details_news_page">
          <div class="tdb-block-inner td-fix-index"> <a class="tdb-author-photo" href="<?php echo base_url();?>/user/public_profile/<?php echo $receipe_detail['user_id'];?>" title="David Lee"><img src="<?php echo $baseurl.$receipe_detail['user_profile'];?>"> </a>
            <div class="tdb-author-name-wrap"><span class="tdb-author-by">By</span> <a class="tdb-author-name" href="<?php echo base_url();?>/user/public_profile/<?php echo $receipe_detail['user_id'];?>"><?php echo $receipe_detail['user_name'];?></a></div>
          </div>
          <div class="tdb-block-inner td-fix-index">
            <time class="entry-date updated td-module-date" ><?php echo date('M d,Y h:i a',strtotime($receipe_detail['created_at']));?></time>
          </div>
        </div>
      </div>
      <div class="tag_recipes">
        <ul>
          <h3> Tags :- </h3>
          <?php 
                  $ex=explode(",",$receipe_detail['tags']);
              
              foreach($ex as $val){
                 if(!empty($val)){

                      ?>
          <li><a href="#"> <?php echo $val; ?></a></li>
         

         <?php } } ?>


        </ul>
      </div>
      <div class="recipes_details_images"> <img src="<?php echo $baseurl.$receipe_detail['image'];?>"> </div>
      <p> <?php echo $receipe_detail['content'];?></p>
      <div class="recipes_detail_category">
        <ul>
          <li> <span><img src="<?php echo base_url().'/public/frontend/';?>images/category_icon.png"></span>
            <h2>Category</h2>
            <p><?php echo $receipe_detail['category_name'];?></p>
          </li>
          <li> <span><img src="<?php echo base_url().'/public/frontend/';?>images/cooking_time.png"></span>
            <h2>Cooking Time</h2>
            <p><?php echo $receipe_detail['cooking_time'];?></p>
          </li>
          <li> <span><img src="<?php echo base_url().'/public/frontend/';?>images/location_icon.png"></span>
            <h2>Location</h2>
            <p><?php echo $receipe_detail['location'];?></p>
          </li>
        </ul>
      </div>
      <div class="video_recipes_details">
        <h2>Ingredients</h2>
        <ul>
          <li><?php echo $receipe_detail['ingredients'];?></li>
          
        </ul>
      </div>

       <?php 
                  
                 if(!empty($receipe_detail['video'])){

       ?>
      <div class="video_recipes_details">
        <h2>Video</h2>
        <video controls>
          <source src="<?php echo base_url().'/'.$receipe_detail['video'];?>" type="video/mp4">
          <source src="<?php echo base_url().'/'.$receipe_detail['video'];?>" type="video/ogg">
          Your browser does not support the video tag. </video>
      </div>

<?php }  ?>

      <div class="steps_recipes_details">
        <h2> Steps </h2>
        <ul>
          <li>
            <p> <?php echo $receipe_detail['steps'];?></p>

          </li>
        </ul>
      </div>

      <?php 
                  
                 if(!empty($receipe_detail['galleryimage'])){

       ?>
      <div class="gallery_recipes_details">
        <h2> Gallery </h2>
        <section class="slider-section">
      <div id="owl-demo" class="recipes_detailsgallery owl-carousel owl-theme home_silder1">

        <?php 
                  $ex=explode(",",$receipe_detail['galleryimage']);
              
              foreach($ex as $val){
                 if(!empty($val)){

                      ?>


  <div class="item"> <img src="<?php echo base_url().'/'.$val ?>" class=" " alt="img"  > </div>
  
  <?php } } ?>


</div> 
       </section> 
      </div>
 <?php }  ?>


<div class="blog_comment">
		<div class="detailBox">
					 <div class="titleBox">
                        <label>Comments </label>
          <?php 

                        if(count($receipe_comment)!=0){
      
      if(count($receipe_comment_all)>2){
      $commentscount=count($receipe_comment_all)-count($receipe_comment); 


      ?>

                        <button id="viewold" onclick="showoldercomments('<?php echo $receipe_detail['id'];?>')" class="viewoldcommetns">

                        View Old <?php echo $commentscount; ?> Commetns</button></div>

            <?php } } ?>
			     <div class="actionBox">
                    <ul class="commentList">
    <?php 

    if(count($receipe_comment)!=0){      
      foreach($receipe_comment as $datas){

                      ?>
            <li>
          <div class="commenterImage"> <img src="/public/uploads/users/profileImage/1666126360Friends_list1.jpg"> </div>
          <div class="commentText">
            <h2><?php echo $datas['users_name'];?></h2>
            <p class=""><?php echo $datas['message'];?>  </p>
            <span class="date sub-text"><?php echo date('M d,Y h:i a',strtotime($receipe_detail['created_at']));?></span> </div>
        </li>
        <?php } } ?>

      </ul>


           
		    <form class="form-inline" role="form" method="post" id="recipecommentform" name="recipecommentform">
        <div class="form-group">
          <h2>LEAVE A REPLY </h2>
          <textarea id="messagecomments" name="message" class="form-control comment_here" rows="5" cols="3" placeholder="Enter your comment here..."></textarea>
        </div>
        <div class="form-group">
		<input type="hidden" class="" id="commented_by" name="commented_by" value="<?php echo $users['id'];?>" size="30" aria-required="true">
		<input type="hidden" class="" id="post_id" name="post_id" value="<?php echo $receipe_detail['id'];?>" size="30" aria-required="true">
          <button class="post_comment" type="button" id="submitcomment" onclick="recipecommentssubmit()">Post Comment</button>

        </div>
      </form>
		   
    </div>
  </div>
</div>


    </div>
  </div>
</div>
</ul>
 </main>
   <span id="showmodel" style="display:none"></span>  

  <?php echo  $this->endSection(); ?>
  
