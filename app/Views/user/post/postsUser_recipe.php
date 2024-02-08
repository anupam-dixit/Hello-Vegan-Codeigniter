<?php echo  $this->extend('user/templates/profile_template'); ?><?php echo  $this->section('content'); ?>
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

$friends_array=[];
$friend_request_send_by_me_array=[];
$friend_request_received_by_me_array=[];

if(count($friends)!=0){
  foreach($friends as $val){
    $friends_array[]=$val['id'];
  }
}
if(count($friend_request_send_by_me)!=0){
  foreach($friend_request_send_by_me as $val){
    $friend_request_send_by_me_array[]=$val['id'];
  }
}
if(count($friend_request_received_by_me)!=0){
  foreach($friend_request_received_by_me as $val){
    $friend_request_received_by_me_array[]=$val['id'];
  }
}

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
       <?php

                  if(file_exists($users['cover_image'])){ ?>

                    <div class="cover_images panel"> <img src="<?php echo $baseurl.$users['cover_image'];?>">


                  <?php }else{ ?>

                   <div class="cover_images panel"> <img src="<?php echo $public_url;?>images/profile_banner.jpg">



                  <?php }


                    ?>
        <div class="profile-header">
          <div class=" panel-xl">
            <div class="row">
              <div class="col-md-9 col-12 col-sm-12">
                <div class="profile-header-main">
                   <?php

                  if(file_exists($users['profile_image'])){ ?>

                     <div class="avatar avatar-normal has-aura text-center public_profile_page_login"><img class="avatar img-responsive" alt="admin_profile" src="<?php echo  $baseurl.$users['profile_image'];?>"></div>


                  <?php }else{ ?>

                    <div class="avatar avatar-normal has-aura text-center public_profile_page_login"><img class="avatar img-responsive" alt="admin_profile" src="<?php echo $public_url;?>images/user-icon.png"></div>



                  <?php }


                    ?>
                  <div class="profile-contact">
                    <div class="profile-main-top">
                      <h1 class="name"><?php echo $name;?></h1>
                    </div>
                    <div class="speciality"><?php echo $address;?> </div>
                    <div class="speciality">2K friends</div>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
          <div class="profile-button-actions my-15">
        <?php 
        $style_addfriend='';
        $style_confirm='';
        $style_cancel='';
        $style_unfriend='';
        if(in_array($id,$friends_array)){
        $style_addfriend='display:none';
        $style_cancel='display:none'; 
        $style_confirm='display:none';
                $style_unfriend='display:inline-block';       
        }
        else if(in_array($id,$friend_request_send_by_me_array)){
        $style_unfriend='display:none';
        $style_addfriend='display:none';  
        $style_confirm='display:none';
                $style_cancel='display:inline-block';       
        }
        else if(in_array($id,$friend_request_received_by_me_array)){
        $style_unfriend='display:none';
        $style_addfriend='display:none';
        $style_cancel='display:inline-block';
        $style_confirm='display:inline-block';
                }else{
        $style_unfriend='display:none';
        $style_addfriend='display:inline-block';
        $style_cancel='display:none';
        $style_confirm='display:none';  
        }
                
        
        ?>
        
        <a class="btn-floating" id="unfriend" style="<?php echo $style_unfriend;?>" href="javascript:unfriend('<?php echo $id;?>')">
                  <div class="after-span ripple"></div>
                  <span> </span> Unfriend
        </a>
        
        <a class="btn-floating" id="addfriend" style="<?php echo $style_addfriend;?>" href="javascript:friend_request_send('<?php echo $id;?>');">
                  <div class="after-span ripple"></div>
                  <span> </span> Add Friend 
        </a>
          <a class="btn-floating" id="confirm" style="<?php echo $style_confirm;?>" href="javascript:confirm_request('<?php echo $id;?>');">
                  <div class="after-span ripple"></div>
                  <span> </span> Confirm Request 
        </a>
          <a class="btn-floating" id="cancel" style="<?php echo $style_cancel;?>" href="javascript:cancel_request('<?php echo $id;?>');">
                  <div class="after-span ripple"></div>
                  <span> </span> Cancel Request 
        </a>
                        
         <a class="btn-floating" id="showchat1">
                  <div class="after-span ripple"></div>
                  <span> </span> Messages
          </a>        
                </div>
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
          
          <?php echo  $this->include('user/templates/profile_left_panel_photo_id'); ?>
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
              <?php


     if(count($racipeall_profile)!=0){
  
      foreach($racipeall_profile as $comm){
       
    ?>
              <div class="one_bx ">
                <div class="topbar_post ">
                  <div class="topbar_icon"><img src="<?php echo  $baseurl.$users['profile_image'];?>"></div>
                  <h2><?php echo $name;?></h2>
                  <p><?php echo date('d M Y',strtotime($comm['created_at']));?></p>
                </div>
				<h2 class="blog_user_title"><?php echo $comm['title'];?></h2>
                  <p class="post_one_pdding">
				  <?php
				  $sentences = 3;
                  $contentss=implode('. ', array_slice(explode('.', $comm['content']), 0, $sentences)) . '.';
				 echo $contentss;
				 ?>
				</p>
                
                <div class="post_images "> <a onclick="getSinglerecipes('<?php echo $comm['id'];?>')">
        <?php 
		$videourl='';
        $imageurl='';
		if(file_exists($comm['image'])){
		$mime = mime_content_type($comm['image']);
        
        if(strstr($mime, "video/")){
          $videourl=  $baseurl.$comm['image'];  
        }else{
            if(file_exists($comm['image'])){ 
              $imageurl=$baseurl.$comm['image'];
            }else{
              $imageurl=$public_url.'images/no_img.jpg';  
            } 
        }	
		}else{
			$imageurl=$public_url.'images/no_img.jpg'; 
		}
        
        ?>
        <?php 
        if($videourl!=''){
        ?>
        <video  height="400" controls> 
          <source src="<?php echo $videourl;?>" type="video/webm"> 
          <source src="<?php echo $videourl;?>" type="video/ogg"> 
          <source src="<?php echo $videourl;?>" type="video/mp4">
          <source src="<?php echo $videourl;?>" type="video/3gp">
               </video>
                 <?php        
        }else{
        ?>
                <img src="<?php  echo  $imageurl;?>"> 
        <?php         
        }
        ?></a>
        </div>
           
             <div class="read_more">  </div>
         </div>      
                
        <?php 
                }
        ?>
              <?php 
    }else{
      ?>
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
</main>
<?php echo  $this->endSection(); ?>