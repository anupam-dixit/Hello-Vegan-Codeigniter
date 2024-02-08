<?php 
echo  $this->extend('user/templates/profile_template'); ?>
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

<main>
  <button class="icon-button e-dark-mode-button u-animation-click" id="darkMode" aria-label="Dark Mode"><span class="icon" aria-hidden="true">🌜</span></button>
  <div class="common-structure">
    <?php echo  $this->include('user/templates/comman_header_profile'); ?>
  </div>
  <section class="middle_wraper">
  <div class="page-wrapper ">
    <div class="container">
      <div class="bgcolor_profile">
        <div class="cover_images panel"><img src="<?php echo $baseurl.$users['cover_image'];?>">
          <div class="profile-header">
            <div class=" panel-xl">
              <div class="row">
                <div class="col-md-9 col-12 col-sm-12">
                  <div class="profile-header-main">
                    <div class="avatar avatar-normal has-aura text-center"><a href="<?php echo base_url();?>/user/public_profile/<?php echo $users['id'];?>"><img class="avatar img-responsive" alt="admin_profile" src="<?php echo  $baseurl.$users['profile_image'];?>"></a></div>
                    <div class="profile-contact">
                      <div class="profile-main-top">
                        <h1 class="name"><?php echo $name;?></h1>
                      </div>
                      <div class="speciality"><?php echo $address;?> </div>
                      <div class="speciality"><?php echo $email;?>, (+91) 0000-000-000</div>
                      <div class="topfred_list">
                        <ul>
                          <?php
// print_r($posts);

     if(count($userfriend)!=0)
      foreach($userfriend as $uf){
    ?>
                          <li><a href="#"><img src="<?php echo $baseurl.$uf['profile_image'];?>"></a></li>
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
                </div>
                <div class="col-md-3">
                  <div class="profile-button-actions my-15">
				  <a class="btn-floating" onclick="createpostpopup_open()">
                    <div class="after-span ripple"></div>
                    <span> </span> Add  Post</a>

                    <a class="btn-floating" href="<?php echo base_url();?>/user/profile-edit">
                    <div class="after-span ripple"></div>
                    <span> </span> Edit Profile </a></div>
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
              <h2>Menu</h2>
              <span onclick="openNav()"><i class="fa fa-bars" aria-hidden="true"></i> </span> </div>
            <div class="menu_all">
              <ul>
                <li><a href="<?php echo base_url();?>/user/about"><span> <i class="fa fa-question-circle-o" aria-hidden="true"></i></span> About</a></li>
                <li><a href="<?php echo base_url();?>/user/dashboard"><span> <i class="fa fa-th" aria-hidden="true"></i></span> Post</a></li>
                <li><a href="<?php echo base_url();?>/user/event"><span> <i class="fa fa-calendar" aria-hidden="true"></i></span> Events</a></li>
                <li><a href="<?php echo base_url();?>/user/recipe"><span> <i class="fa fa-cutlery" aria-hidden="true"></i></span> Recipes</a></li>
                <li><a href="<?php echo base_url();?>/user/blog"><span> <i class="fa fa-rss" aria-hidden="true"></i></span> Blog</a></li>
                <li><a href="#"><span> <i class="fa fa-info" aria-hidden="true"></i></span> Privacy Policy</a></li>
                <li><a href="#"><span> <i class="fa fa-info" aria-hidden="true"></i></span> Terms of Service</a></li>
                <li><a href="#"><span> <i class="fa fa-sign-out" aria-hidden="true"></i></span> Logout</a></li>
              </ul>
            </div>
          </div>
          <div class="side_menu photos_p_profile">
            <div class="menu_all">
              <div class="hadding_side">
                <h2>Photos <a href="<?php echo base_url();?>/user/photo">See All Photos</a></h2>
              </div>
              <div class="photo_for_gallery" id="gallery--getting-started">
                <?php
// print_r($posts);

     if(count($photos)!=0){
    
      foreach($photos as $comm){
        
    ?>
                <ul>
                  <li>
                    <?php if(file_exists($comm))
                   { 
			        $mime = mime_content_type($comm);
				       
			       ?>
                    <div class="post_images "> 
					
					<?php 
					if(strstr($mime, "video/")){
					?>
					<video width="120" height="120" controls> 
					  <source src="<?php echo $baseurl.$comm;?>" type="video/webm"> 
					  <source src="<?php echo $baseurl.$comm;?>" type="video/ogg"> 
					  <source src="<?php echo $baseurl.$comm;?>" type="video/mp4">
					  <source src="<?php echo $baseurl.$comm;?>" type="video/3gp">
					</video>
					<?php 
					}else{
					?>
					<a href="<?php  echo  $baseurl.$comm;?>" data-pswp-width="2500" data-pswp-height="1667" target="_blank">
					<img src="<?php  echo  $baseurl.$comm;?>"> 
					</a>
                    <?php 
					}
					?>
					</div>
					<?php } else { ?>
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
          <div class="side_menu photos_p_profile">
            <div class="menu_all">
              <div class="hadding_side">
                <h2>Friends <a href="<?php echo base_url();?>/user/friend">See All Friends</a> <span>
                  <?php  print count($userfriend); ?>
                  friends</span></h2>
              </div>
              <div class="photo_for_gallery">
                <ul>
                  <?php
// print_r($posts);
// print count($userfriend);
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
// print_r($posts);

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
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-8">
          <div class="right_side">
            <div class="post_rightside">
              <?php
// print_r($posts);

     if(count($posts)!=0){
	
      foreach($posts as $comm){
       
    ?>
              <div class="one_bx ">
                <div class="topbar_post ">
                  <div class="topbar_icon"><img src="<?php echo  $baseurl.$users['profile_image'];?>"></div>
                  <h2><?php echo $name=$_SESSION['nameUserH'] ?></h2>
                  <p><?php echo date('d M Y',strtotime($comm['created_at']));?></p>
                </div>
                <p class="post_one_pdding"><?php echo strip_tags($comm['content']);?></p>
                <?php 
				?>
                <div class="post_images "> 
				 <?php 
				?>
                <div class="post_images "> 
				<?php 
				$mime = mime_content_type($comm['image']);
				$videourl='';
				$imageurl='';
				if(strstr($mime, "video/")){
					$videourl=	$baseurl.$comm['image'];	
				}else{
						if(file_exists($comm['image'])){ 
						  $imageurl=$baseurl.$comm['image'];
						}else{
						  $imageurl=$public_url.'images/no_img.jpg';	
						}	
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
				?>
				</div>
               
                <div class="like_comments post_one_pdding">
                  <p class="like_comments_f">
				 
				  
				   
				  
				  
				   <?php 
				  if($comm['liked_by_user']['cnt']==0){
				  ?>
				 
				  <a>
				  <span id="like_cnt_<?php echo $comm['id'];?>"><?php echo $comm['likes_data']['cnt'];?></span>
				  <i class="fa fa-thumbs-o-up" aria-hidden="true" id="like_<?php echo $comm['id'];?>" style='color:#0080ff'  onclick="addpostlike('<?php echo $comm['id'];?>','1')"></i> 
				 <i class="fa fa-thumbs-o-up"  aria-hidden="true" id="unlike_<?php echo $comm['id'];?>" style="display:none;color:#ff0000"  onclick="addpostlike('<?php echo $comm['id'];?>','0')"></i> 
				</a>
                  <?php 				  
				  }else{
				  ?>
				  <a>
				  <span id="like_cnt_<?php echo $comm['id'];?>"><?php echo $comm['likes_data']['cnt'];?></span>
				  <i class="fa fa-thumbs-o-up" style="display:none;color:#0080ff" aria-hidden="true" id="like_<?php echo $comm['id'];?>"  onclick="addpostlike('<?php echo $comm['id'];?>','1')"></i> 
				 <i class="fa fa-thumbs-o-up" style="color:#ff0000" aria-hidden="true" id="unlike_<?php echo $comm['id'];?>"   onclick="addpostlike('<?php echo $comm['id'];?>','0')"></i> 
				 </a>
                  <?php				  
				  }
				  ?>
				  
				  </a>
				  
				  </p>
                  <p class="like_comments_se"><a href="#"><span id="cnt_<?php echo $comm['id'];?>"><?php echo  count($comm['comments_data'])?></span><i class="fa fa-comment-o" aria-hidden="true"></i> </a></p>
                </div>
                <!-- form here comment section -->
				<?php
                  $commentcss='';				
				if(count($comm['comments_data'])>3){
					//$commentcss='overflow-y:scroll;height:300px;width:100%';
				}
				
				?>
                <div class="blog_comment" style="<?php echo $commentcss;?>">
                  <div class="detailBox">
				  <div class="titleBox">
				  <label>Comments </label>
				</div>
				 <div class="actionBox">
				<ul class="commentList commentList_<?php echo $comm['id'];?>">
             
				
				<?php 
				$ks=1;
			  foreach($comm['comments_data'] as $val){
				  if($ks<4){
				  if(file_exists($val['users_profile_image'])){ 
					$user_profile_image=$baseurl.$val['users_profile_image'];
					}else{
					$user_profile_image=$public_url.'images/no_img.jpg';	
					}
			  ?>
			   <li>
          <div class="commenterImage"> <img src="<?php echo $baseurl.$val['users_profile_image'];?>" /> </div>
          <div class="commentText">
            <h2><?php echo $val['users_name'];?></h2>
            <p class=""><?php echo $val['message'];?></p>
            <span class="date sub-text">on <?php echo date('M d,Y',strtotime($val['created_at']));?></span> </div>
        </li>
               <?php 
			  $ks++;
			  }}
	            ?>
				<?php                
			   if(count($comm['comments_data'])>3){
			       $commentscount=count($comm['comments_data'])-3;
			   ?>
			   <li><button id="viewold" onclick="showoldercomments('<?php echo $comm['id'];?>')" >View Old <?php echo $commentscount;?> Commetns</button></li>
			   <?php }
			  ?>
				 </ul>
                <form class="form-inline" role="form" method="post" id="postcommentform_<?php echo $comm['id'];?>" name="postcommentform" onsubmit="return submitpostcomments('<?php echo $comm['id'];?>')">
				<div class="comments_form post_one_pdding">
				<input type="hidden" class="" id="commented_by" name="commented_by"  value="<?php echo $_SESSION['idUserH'];?>" size="30" aria-required="true">
                  <input type="hidden" class="" id="post_id" name="post_id"  value="<?php echo $comm['id'];?>" size="30" aria-required="true">
				  <input class="effect-1" id="messagecomments_<?php echo $comm['id'];?>" name="message" type="text" placeholder="Write here. . . . . .">
                  <span class="focus-border" onclick="submitpostcomments('<?php echo $comm['id'];?>')"><i class="fa fa-send-o" aria-hidden="true"></i> </span>
				</div>
                 <input type="hidden" name="submit">
				 </form>				

				</div>
				  </div>
              </div>
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
  

</main>
<div id="loading">
  <img id="loading-image" src="<?php echo $public_url;?>images/ajax-loader.gif" alt="Loading..." />
</div>
<div id="createpost" class="overlay">
  <div class="modal-dialog modal-dialog-centered" role="document">
  <div class="modal-content">
  <form id="veganpostform" method="post" enctype="multipart/form-data">
    <div class="popup"> <a class="close" onclick="createpostpopup_close()">&times;</a>
      <div class="content">
        <div>
          <label>Create Post</label>
          <textarea  rows="4" cols="50" name="create_post_content" id="create_post_content">
</textarea >
          <br>
          <input type="file" name="create_post_image" id="create_post_image">
        </div>
        <div> </div>
        <div>
          <input type="submit" name="create" id="create" value="create post" class="create_button">
        </div>
      </div>
    </div>
    
  </form>
  </div>
    </div>
</div>
<style>
  #loading {
  position: fixed;
  display: none;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  text-align: center;
  opacity: 0.7;
  background-color: #fff;
  z-index: 99;
}

#loading-image {
  position: absolute;
  top: 100px;
  left: 577px;
  z-index: 100;
}

  </style>
<?php echo  $this->endSection(); ?>