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
                    <div class="avatar avatar-normal has-aura text-center">

                     <!--  <a href="<?php echo base_url();?>/user/public_profile/<?php echo $users['id'];?>"> -->

                        <?php

                  if(file_exists($users['profile_image'])){ ?>

                     <div class="avatar avatar-normal has-aura text-center public_profile_page_login"><img class="avatar img-responsive" alt="admin_profile" src="<?php echo  $baseurl.$users['profile_image'];?>"></div>


                  <?php }else{ ?>

                    <div class="avatar avatar-normal has-aura text-center public_profile_page_login"><img class="avatar img-responsive" alt="admin_profile" src="<?php echo $public_url;?>images/user-icon.png"></div>



                  <?php }


                    ?>
                     <!--  </a> -->

                    </div>
                    <div class="profile-contact">
                      <div class="profile-main-top">
                        <h1 class="name"><?php echo $name;?></h1>
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
                  <div class="profile-button-actions my-15">
				  <a class="btn-floating" onclick="createpostpopup_open()">
                    <div class="after-span ripple"></div>
                    <span> </span> <?=lang('app.profile._2')?></a>

                    <a class="btn-floating" href="<?php echo base_url();?>/user/profile-edit">
                    <div class="after-span ripple"></div>
                    <span> </span> <?=lang('app.profile._3')?> </a>

                      <a class="btn-floating" href="/subscription/list">
                          <div class="after-span ripple"></div>
                          <span> </span> Subscription </a>
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
        <div class="col-lg-4 col-md-12" id="profile_left">
          <?php echo  $this->include('user/templates/profile_left_panel'); ?>
        </div>
        <div class="col-lg-8 col-md-12">
          <div class="right_side">
            <div class="post_rightside">
              <?php


     if(count($posts)!=0){

      foreach($posts as $comm){

    ?>
              <div id="post_main_div_<?=$comm['id']?>" class="one_bx ">
                <div class="topbar_post ">
                  <div class="topbar_icon"><img src="<?php echo  $baseurl.$users['profile_image'];?>"></div>
                  <h2><?php echo $name=$_SESSION['nameUserH'] ?></h2>
                  <p><?php echo date('d M Y',strtotime($comm['created_at']));?></p>
                </div>
                <p class="post_one_pdding" id="show_content_<?php echo $comm['id'];?>">
				<?php
				$sentences = 2;

				$comcontent=strip_tags($comm['content']);
                  $contentss=implode('. ', array_slice(explode('.', $comcontent), 0, $sentences)) . '.';
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
				 echo strip_tags($comm['content']);
				 ?>
				<button class="readmore_content" onclick="showcontent('<?php echo $comm['id'];?>')">Hide Content</button>

				</p>
                <div class="post_images ">
				<?php
				$videourl='';
				$imageurl='';
				if(file_exists($comm['image']))
                   {
				$mime = mime_content_type($comm['image']);
				if(strstr($mime, "video/")){
					$videourl=	$baseurl.$comm['image'];
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
                      <div class="row">
                          <div class="col">Comments</div>
                          <div class="col text-end">
                              <button id="btn_del_post_<?=$comm['id']?>" target="<?=$comm['id']?>" class="w3-button w3-ripple w3-red w3-round-large btn_del_post">Delete <i class="fa-solid fa-trash ml-2"></i> </button>
                          </div>
                      </div>
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


</main>
<div id="loading">
  <img id="loading-image" src="<?php echo $public_url;?>images/ajax-loader.gif" alt="Loading..." />
</div>
    <div class=" share_your_thoughts_popup_text add_custom_field_pop overlay" id="createpost" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content ">
                <div class="modal-body">
                    <h5 class="modal-title share_your_thoughts_popup_title" id="exampleModalLongTitle"><?=lang('app.user_dashboard._13')?> </h5>
                    <a class="close" href="#" onclick="createpostpopup_close()">&times;</a>
                    <div class="frame__container">
                        <div class="frame__headline"> <img class="headline__image" src="<?php echo  base_url().'/'.$users['profile_image'];?>">
                            <div class="frame__column">
                                <p class="headline__title"> <?php echo $_SESSION['nameUserH'];?> </p>
                            </div>
                        </div>
                        <div class="frame__content">
                            <form id="veganpostform" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <textarea  rows="4" cols="50" class="form-control" name="create_post_content" id="create_post_content" placeholder="<?=lang('app.user_dashboard._13')?>"></textarea>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label"><?=lang('app.global.upload_file')?></label>
                                                <div class="preview-zone hidden">
                                                    <div class="box box-solid">
                                                        <div class="box-header with-border">
                                                            <div><b><?=lang('app.global.preview')?></b></div>
                                                            <div class="box-tools pull-right">

                                                            </div>
                                                        </div>
                                                        <div class="box-body"></div>
                                                    </div>
                                                </div>
                                                <div class="dropzone-wrapper">
                                                    <div class="dropzone-desc">
                                                        <i class="glyphicon glyphicon-download-alt"></i>
                                                        <p><?=lang('app.user_dashboard._14')?></p>
                                                    </div>
                                                    <input type="file" id="create_post_image" name="create_post_image" class="dropzone">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php /* ?>
				<input type="file" name="create_post_image" class="form-control" id="create_post_image" accept="image/*,video/webm,video/ogg,video/mp4,video/3gp" >
				<?php */ ?>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <button type="button" class="btn btn-danger btn-xs remove-preview">
                                            <i class="fa fa-times"></i> <?=lang('app.global.reset_form')?>
                                        </button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <input type="submit" name="create" id="uploadForm" value="<?=lang('app.global.post')?>" class="create_button">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>

$(".dropzone").change(function() {
  readFile(this);
});

$('.dropzone-wrapper').on('dragover', function(e) {
  e.preventDefault();
  e.stopPropagation();
  $(this).addClass('dragover');
});

$('.dropzone-wrapper').on('dragleave', function(e) {
  e.preventDefault();
  e.stopPropagation();
  $(this).removeClass('dragover');
});

$('.remove-preview').on('click', function() {
  var boxZone = $(this).parents('.preview-zone').find('.box-body');
  var previewZone = $(this).parents('.preview-zone');
  var dropzone = $(this).parents('.form-group').find('.dropzone');
  boxZone.empty();
  previewZone.addClass('hidden');
  reset(dropzone);
});


</script>

<?php /*?><div id="createpost" class="overlay">
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
</div><?php */?>
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

  <script>
      $(".btn_del_post").click(function(){
          const requestOptions = {
              method: 'GET', // GET/POST
              headers: {
                  'Content-Type': 'application/json',
              },
              // body: JSON.stringify({ title: 'Fetch POST Request Example' }) // Uncomment this line for POST method
          };
          fetch('/ajax/post/delete/'+$(this).attr('target'), requestOptions)
              .then(response => response.json())
              .then(data => {
                  alert(data.message)
                  $("#post_main_div_"+$(this).attr('target')).fadeOut(600)
              });
      });
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