<?php 
echo  $this->extend('user/templates/friend_template'); ?>
<?php echo  $this->section('content'); ?>
<?php
$public_url=base_url()."/public/frontend/";
$baseurl=base_url()."/";
?>

<?php
$id=$users['id'];
$name=$users['name'];
$address=$users['address'];
$description=$users['description'];
$profile_image=$users['profile_image'];
$cover_image=$users['cover_image'];
$email=$users['email'];
$password=$users['password'];
$location=$users['location'];
?>


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
                    <div class="speciality"><?php echo count($userfriend);?> friends</div>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="profile-button-actions my-15">
				<a  class="btn-floating" href="#">
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
                <li><a href="#"> Post</a></li>
                <li><a href="#"> Events</a></li>
                <li><a href="#"> Recipes</a></li>
                <li><a href="#"> Blog</a></li>
              </ul>
            </div>
          </div>
          <div class="post_rightside">
            <div class="friend_listpage">
               <div class="hadding_side">
              <h2>Friend List</h2>
            </div>
              <ul>
                 <?php

     if(count($userfriend)!=0)
      foreach($userfriend as $uf){
    ?>
              <li><a href="<?php echo base_url();?>/user/public_profile/<?php echo $uf['id'];?>"><img src="<?php echo $baseurl.$uf['profile_image'];?>"></a>
                  <h3> <?php echo $uf['name'];?> <span> mutual friend</span></h3>
                </li>
          <?php 
    }else{
      ?>
    <li class="main-feed-item" id="nopost">
          <article class="common-post">
            <div class="row">
              <div class="col-sm-12 col-md-12">
                <div class="common-post-content common-content no_deta_all"> No Friend Found</div>
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
      </div>
    </div>
  </div>
</div>
</div>
<?php echo  $this->endSection(); ?>