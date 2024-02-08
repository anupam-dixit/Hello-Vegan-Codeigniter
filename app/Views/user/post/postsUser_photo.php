<?php echo  $this->extend('user/templates/postUser_templete'); ?>
<?php echo  $this->section('content'); ?>

<?php
$id=$users['id'];
$address=$users['address'];
$description=$users['description'];
$profile_image=$users['profile_image'];
$cover_image=$users['cover_image'];
$email=$users['email'];
$mobile=$users['mobile_no'];
$password=$users['password'];
$location=$users['location'];

?>

<main>
<button class="icon-button e-dark-mode-button u-animation-click" id="darkMode" aria-label="Dark Mode"><span class="icon" aria-hidden="true">🌜</span></button>
<div class="common-structure">
  <?php echo  $this->include('user/templates/comman_header_profile'); ?>
</div>
<section class="middle_wraper">
<div class="page-wrapper ">
  <div class="prodile_page_bg">
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
                    <div class="speciality"><?php echo $address;?> </div>
                     <div class="speciality"><?php echo $email;?>, <?php echo $mobile;?></div>
                         <div class="topfred_list">
                        <ul>
                          <?php
// print_r($posts);

     if(count($userfriend)!=0){
      foreach($userfriend as $uf){
    ?>
                          <li><a href="#"><img src="<?php echo $baseurl.$uf['profile_image'];?>"></a></li>
                          <?php 
   }}
      ?>
     
                        </ul>
                      </div>
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
</div>
<div class="profile_middel">
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <?php echo  $this->include('user/templates/profile_left_panel_photo'); ?>
      </div>
      <div class="col-md-8">
        <div class="right_side">
          <div class="proffilr_pb">
            <div class="right_mrnu">
               <ul>
                <li><a href="<?php echo base_url();?>/user/post_pofile/<?php echo $id;?>"> Post</a></li>
                <li><a href="<?php echo base_url();?>/user/event_profile/<?php echo $id;?>"> Events</a></li>
                <li><a href="<?php echo base_url();?>/user/recipes_profile/<?php echo $id;?>"> Recipes</a></li>
                <li><a href="<?php echo base_url();?>/user/blog_profile/<?php echo $id;?>"> Blog</a></li>
              </ul>
            </div>
          </div>
          <div class="post_rightside">
            <div class="friend_listpage" id="gallery--getting-started">
                            <?php
// print_r($posts);

     if(count($photosall)!=0){
    
      foreach($photosall as $comm){
        
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
                <div class="common-post-content common-content no_deta_all"> No Posts</div>
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