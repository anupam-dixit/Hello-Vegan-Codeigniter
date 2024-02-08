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
  <div class="page-wrapper ">  <div class="prodile_page_bg">
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
                <div class="profile-header-main ">
                  <?php

                  if(file_exists($users['profile_image'])){ ?>

                     <div class="avatar avatar-normal has-aura text-center public_profile_page_login"><img class="avatar img-responsive" alt="admin_profile" src="<?php echo  $baseurl.$users['profile_image'];?>"></div>


                  <?php }else{ ?>

                    <div class="avatar avatar-normal has-aura text-center public_profile_page_login"><img class="avatar img-responsive" alt="admin_profile" src="<?php echo $public_url;?>images/user-icon.png"></div>



                  <?php }


                    ?>



                  <div class="profile-contact public_profile_page_logincontact">
                    <div class="profile-main-top">
                      <h1 class="name"><?php echo $name;?></h1>
                    </div>
                    <div class="speciality"><?php echo $address;?> </div>
                    <div class="speciality"><?php  print count($userfriend); ?> friends</div>
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
          <div class="side_menu public_profile_page_leftcontact">
          <div class="hadding_side">
            <h2>About Us</h2>
          </div>
          <div class="menu_all">
            <p><?php echo $description;?></p>
          </div>
        </div>
          <div class="side_menu photos_p_profile">
            <div class="menu_all">
              <div class="hadding_side">
                <h2>Photos <a href="<?php echo base_url();?>/user/public_photo/<?php echo $id;?>">See All Photos</a></h2>
              </div>
              <div class="photo_for_gallery ">
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
                <?php

				}
				} else{  ?>
                <li class="main-feed-item" id="nopost" style="width: 100%;">
                  <article class="common-post no_deta_all">
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
                <h2>Friends <a href="<?php echo base_url();?>/user/friendlist/<?php echo $id;?>">See All Friends</a> <span>
                  <?php  echo  count($userfriend); ?>
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
                    <h3> <?php echo $uf['name'];?></h3> <span> mutual friend</span>
                  </li>
                  <?php
    }else{
      ?>
                  <li class="main-feed-item" id="nopost" style="width: 100%;">
                    <article class="common-post no_deta_all">
                      <div class="row">
                        <div class="col-sm-12 col-md-12">
                          <div class="common-post-content common-content "> No Friends</div>
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
          <div class="side_menu photos_p_profile" style="display:none">
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
                  <li class="main-feed-item" id="nopost" style="width: 100%;">
                    <article class="common-post no_deta_all">
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


     if(count($posts)!=0){

      foreach($posts as $comm){

    ?>
              <div class="one_bx ">
                <div class="topbar_post ">
                  <div class="topbar_icon"><img src="<?php echo  $baseurl.$users['profile_image'];?>"></div>
                  <h2><?php echo $name;?></h2>
                  <p><?php echo date('d M Y',strtotime($comm['created_at']));?></p>
                </div>
                <p class="post_one_pdding" id="show_content_<?php echo $comm['id'];?>">
				<?php
				$sentences = 2;
                  $contentss=implode('. ', array_slice(explode('.', $comm['content']), 0, $sentences)) . '.';
				 echo $contentss;

				 //echo strlen($contentss);


				 if(strlen($contentss)>200){
					 ?>
				<button  class="readmore_content" onclick="hidecontent('<?php echo $comm['id'];?>')">Read More Content</button>

					 <?php
				 }
				?>
				</p>
                <p  style="display:none" class="post_one_pdding" id="hide_content_<?php echo $comm['id'];?>">
				<?php
				 echo $comm['content'];
				 ?>
				<button class="readmore_content" onclick="showcontent('<?php echo $comm['id'];?>')">Hide Content</button>

				</p>

                <div class="post_images ">
        <?php
		$videourl='';
        $imageurl='';
		if(!empty($comm['image'])){
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
			if($imageurl!=''){
        ?>
                <img src="<?php  echo  $imageurl;?>">
        <?php
			}
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
          <i class="fa fa-thumbs-o-up" aria-hidden="true" id="like_<?php echo $comm['id'];?>" style='color:#185229'  onclick="addpostlike('<?php echo $comm['id'];?>','1')"></i>
         <i class="fa fa-thumbs-o-up"  aria-hidden="true" id="unlike_<?php echo $comm['id'];?>" style="display:none;color:#70cac8"  onclick="addpostlike('<?php echo $comm['id'];?>','0')"></i>
        </a>
                  <?php
          }else{
          ?>
          <a>
          <span id="like_cnt_<?php echo $comm['id'];?>"><?php echo $comm['likes_data']['cnt'];?></span>
          <i class="fa fa-thumbs-o-up" style="display:none;color:#185229" aria-hidden="true" id="like_<?php echo $comm['id'];?>"  onclick="addpostlike('<?php echo $comm['id'];?>','1')"></i>
         <i class="fa fa-thumbs-o-up" style="color:#70cac8" aria-hidden="true" id="unlike_<?php echo $comm['id'];?>"   onclick="addpostlike('<?php echo $comm['id'];?>','0')"></i>
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
        if(count($comm['comments_data'])>4){
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
                /*
         if(count($comm['comments_data'])>3){
             $commentscount=count($comm['comments_data'])-3;
         ?>
         <li id="viewold"><button id="showall_<?php echo $comm['id'];?>" onclick="showoldercomments('<?php echo $comm['id'];?>','hide')">Show All Commetns</button>
         <button id="hideall_<?php echo $comm['id'];?>" style="display:none" onclick="showoldercomments('<?php echo $comm['id'];?>','show')">Hide All Commetns</button>
              </li>

         <?php }
         <?php */
        ?>
         </ul>
         <?php
         if(count($comm['comments_data'])>3){
         ?>
         <div id="viewold">
         <button id="showall_<?php echo $comm['id'];?>" onclick="showoldercomments('<?php echo $comm['id'];?>','hide')">Show All Commetns</button>
         <button id="hideall_<?php echo $comm['id'];?>" style="display:none" onclick="showoldercomments('<?php echo $comm['id'];?>','show')">Hide All Commetns</button>
         </div>
         <?php } ?>
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
  </div>
</main>
<script>
  function showcontent(id){
	  document.getElementById('hide_content_'+id).style.display="none";
	  document.getElementById('show_content_'+id).style.display="block";
  }
  function hidecontent(id){
	 document.getElementById('show_content_'+id).style.display="none";
	  document.getElementById('hide_content_'+id).style.display="block";
  }
  </script>
<?php echo  $this->endSection(); ?>