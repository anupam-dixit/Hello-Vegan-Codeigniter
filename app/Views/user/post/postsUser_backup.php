<?php echo  $this->extend('user/templates/postUser_templete'); ?>
<?php echo  $this->section('content'); ?>
<main>
<button class="icon-button e-dark-mode-button u-animation-click" id="darkMode" aria-label="Dark Mode"><span class="icon" aria-hidden="true">🌜</span></button>
<div class="common-structure">
  <?php echo  $this->include('user/templates/comman_header_profile'); ?>
</div>
<section class="middle_wraper">
<div class="page-wrapper ">
  <div class="container">
    <div class="bgcolor_profile">
      <div class="cover_images panel"> <img src="<?php echo $baseurl.$users['cover_image'];?>">
        <div class="profile-header">
          <div class=" panel-xl">
            <div class="row">
              <div class="col-md-9 col-12 col-sm-12">
                <div class="profile-header-main">
                 <div class="avatar avatar-normal has-aura text-center"><img class="avatar img-responsive" alt="admin_profile" src="<?php echo  $baseurl.$users['profile_image'];?>"></div>
                  <div class="profile-contact">
                    <div class="profile-main-top">
                      <h1 class="name"><?php echo $name=$_SESSION['nameUserH'] ?></h1>
                    </div>
                    <div class="speciality">Jaipur, Rajasthan, India </div>
                    <div class="speciality">2K friends</div>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="profile-button-actions my-15"><a class="btn-floating" href="#">
                  <div class="after-span ripple"></div>
                 
                  <div class="after-span ripple"></div>
                  <span> </span> Messages</a></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="profile_middel">
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <div class="side_menu">
          <div class="hadding_side">
            <h2>About Us</h2>
          </div>
          <div class="menu_all">
            <p>Lorem Ipsum is simply dummy text of the printing and type setting 
              industry. LoremIpsum has been the industry's standard  dummy text 
              ever since the 1500s, when an unknown
              Lorem Ipsum is simply dummy text of the printing and type setting 
              industry. LoremIpsum has been the industry's standard  dummy text 
              ever since the 1500s, when an unknown
              Lorem Ipsum is simply dummy text of the printing and type setting 
              industry. LoremIpsum has been the industry's standard  dummy text 
              ever since the 1500s, when an unknown</p>
          </div>
        </div>
        <div class="side_menu photos_p_profile">
          <div class="menu_all">
            <div class="hadding_side">
              <h2>Friends <a href="#">See All Friends</a> <span><?php  print count($userfriend); ?> friends</span></h2>
            </div>
            <div class="photo_for_gallery">
              <ul>
                 <?php

     if(count($userfriend)!=0)
      foreach($userfriend as $uf){
    ?>
                <li><img src="<?php echo $baseurl.$uf['profile_image'];?>">
                  <h3> <?php echo $uf['name'];?> <span> mutual friend</span></h3>
                </li>
                
   <?php 
    }else{
      ?>
    <li class="main-feed-item" id="nopost">
          <article class="common-post">
            <div class="row">
              <div class="col-sm-12 col-md-12">
                <div class="common-post-content common-content"> No Posts</div>
              </div>
              
            </div>
          </article>
        </li> 
      <?php
    }
    ?>
              </ul>
            </div>
          </div>
        </div>
         
        <div class="side_menu photos_p_profile">
          <div class="menu_all">
            <div class="hadding_side">
              <h2>Life events <a href="#">See All </a> </h2>
            </div>
            <div class="photo_for_gallery">
              <ul>
                         <?php

     if(count($event_data)!=0)
      foreach($event_data as $ed){
    ?>
                <li><img src="<?php echo $baseurl.$ed['image'];?>">
                  <h3><?php echo $ed['name'];?></h3>
                </li>
                
                 <?php 
    }else{
      ?>
    <li class="main-feed-item" id="nopost">
          <article class="common-post">
            <div class="row">
              <div class="col-sm-12 col-md-12">
                <div class="common-post-content common-content"> No Posts</div>
              </div>
              
            </div>
          </article>
        </li> 
      <?php
    }
    ?>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-8">
        <div class="right_side">
          <div class="proffilr_pb">
            <div class="right_mrnu">
              <ul>
                <li><a href="#"> Post</a></li>
                <li><a href="#"> Events</a></li>
                <li><a href="#"> Recipes</a></li>
                <li><a href="#"> Blog</a></li>
              </ul>
            </div>
          </div>
          <div class="post_rightside">
            <div class="friend_listpage" id="gallery--getting-started">
                            <?php
// print_r($posts);

     if(count($photos)!=0){
    
      foreach($photos as $comm){
        
    ?>
              <ul>
                <li> <?php if(file_exists($comm))
                   { 
			   $mime = mime_content_type($comm);
				if(strstr($mime, "video/")){
					?>
					<div class="post_images "> 
					<video width="120" height="120" controls> 
  <source src="<?php echo $baseurl.$comm;?>" type="video/webm"> 
  <source src="<?php echo $baseurl.$comm;?>" type="video/ogg"> 
  <source src="<?php echo $baseurl.$comm;?>" type="video/mp4">
  <source src="<?php echo $baseurl.$comm;?>" type="video/3gp">
</video>
					</div>
					<?php 
				}else{
			   ?>

                    <div class="post_images "> 
					<a href="<?php  echo  $baseurl.$comm;?>" data-pswp-width="2500" data-pswp-height="1667" target="_blank">
					<img src="<?php  echo  $baseurl.$comm;?>"> 
					</a>
					</div>
				<?php }} else { ?>
                    <div class="post_images "> 
					<a href="<?php echo $public_url;?>images/no_img.jpg" data-pswp-width="2500" data-pswp-height="1667" target="_blank">
					<img src="<?php echo $public_url;?>images/no_img.jpg"> 
					</a>
					</div>
               <?php
                     }
                ?>
            </li>
                
              </ul>
   <?php } } else{  ?>

    <li class="main-feed-item" id="nopost">
          <article class="common-post">
            <div class="row">
              <div class="col-sm-12 col-md-12">
                <div class="common-post-content common-content"> No Posts</div>
              </div>
              
            </div>
          </article>
        </li> 
    <?php
    }
    ?>
             
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="js/jquery.min.js"></script> 
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="js/bootstrap.min.js"></script>






</main>

<?php echo  $this->endSection(); ?>