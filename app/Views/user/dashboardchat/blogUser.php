<?php echo  $this->extend('user/templates/blog_template');
$public_url=base_url()."/public/frontend/";
$baseurl=base_url()."/";
 ?>

<?php echo  $this->section('content'); ?> 
	<main class="main-feed">
      <ul class="main-feed-list">
        <div class="notfy">
          <ul>
            <li>
              <div class="icon-container ButtonGroup" ><a href="#"> <img src="<?php echo $public_url;?>images/notification_b.png" /> <img src="<?php echo $public_url;?>images/notification.png" /> <span class="Button-badge">2</span> </a> </div>
            </li>
            <li>
              <div class="icon-container"><a href="#"> <img src="<?php echo $public_url;?>images/chat_b.png" /> <img src="<?php echo $public_url;?>images/chat.png" /> </a> </div>
            </li>
          </ul>
        </div>
        <div class="blog_page">
            
          <div class="blog_one_top">
            <div class="blog_date">
              <ul>
                <li><a href="#"><?php echo date('d M,Y ',strtotime($latest_blog['updated_at']));?></a></li>
                <li> Blog</li>
              </ul>
            </div>
            <?php 
      
      if(count($latest_blog)!=0)
      {
      ?>
           

          <!-- 
            <h2><a  data-toggle="modal" data-target="#add_custom_blog"><?php echo $latest_blog['title'];?></a></h2> -->

            <h2><a href="<?php echo base_url();?>/user/blog/details/<?php echo $latest_blog['id'];?>"><?php echo $latest_blog['title'];?></a></h2>
      <!--  <a href="<?php echo base_url();?>/user/blog/details/<?php echo $latest_blog['id'];?>"> -->

            <div class="blog_images"><a onclick="getSingleblog('<?php echo $latest_blog['id'];?>')"><img src="<?php echo $baseurl.$latest_blog['image'];?>"></a></div>


            <div class="loc_event"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $latest_blog['location'];?></div>
            <div class="date_event"><?php echo date('M d,Y h:i a',strtotime($latest_blog['updated_at']));?></div>

            <p><?php echo $latest_blog['content'];?></p>
            <!-- <div class="read_more"> <a data-toggle="modal" data-target="#add_custom_blog">Read More</a> </div> -->
            <div class="read_more"> <a onclick="getSingleblog('<?php echo $latest_blog['id'];?>')">Read More</a> </div>
         

        <?php } ?>
          <div class="blog_one_middel">
            <a href="<?php echo base_url();?>/user/recipe"><h2>  Vegan  Recipes</h2></a>
            <div class="row">
        <?php
           foreach($blogRECIPES as $val){
        ?>
              <div class="col-md-4 col-sm-4 padding_right_left">
                <div class="blog_one_top">

                  <!-- <div class="blog_images2"><a href="<?php echo base_url();?>/user/blog/details/<?php echo $val['id'];?>"><img src="<?php echo $baseurl.$val['image'];?>"></a></div> -->

                  <div class="blog_images"><img src="<?php echo $baseurl.$val['image'];?>"></div> 


                  <h2 class="hidding_one_middel"><a onclick="getSinglerecipes('<?php echo $val['id'];?>')"><?php echo $val['title'];?> </a></h2>
                </div>
              </div>
        <?php } ?>
              
            </div>
          </div>
          <div class="blog_one_btm">
            <div class="row">

             <?php
        foreach($blogall as $val){
        ?>
              <div class="col-md-6 col-sm-6 padding_right_left">
                <div class="blog_one_top blog_one_tetbtm">

                  <div class="blog_images2"><a onclick="getSingleblog('<?php echo $val['id'];?>')"><img src="<?php echo $baseurl.$val['image'];?>"></a></div>

               <!--    <div class="blog_images"><img src="<?php echo $baseurl.$val['image'];?>"></div> -->
                  <h2 class="hidding_one_middel"><a onclick="getSingleblog('<?php echo $val['id'];?>')"><?php echo $val['title'];?> </a></h2>
                  <p><?php echo $val['content'];?></p>
                  <div class="read_more"> <a onclick="getSingleblog('<?php echo $val['id'];?>')">Read More</a> </div>
                  <!-- <div class="read_more"> <a data-toggle="modal" data-target="#add_custom_blog">Read More</a> </div> -->
                </div>
              </div>

        <?php } ?>
              
            </div>
          </div>
				 
		</div>
      </ul>
    </main>
   <span id="showmodel" style="display:none"></span>  

  <?php echo  $this->endSection(); ?>