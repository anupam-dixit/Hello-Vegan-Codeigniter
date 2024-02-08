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
$mobile=$users['mobile_no'];
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
  <div class="page-wrapper ">  <div class="prodile_page_bg">
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
  </div></div>
  <div class="profile_middel">
    <div class="container">
      <div class="row">
        <div class="col-md-4" id="profile_left">
        <?php echo  $this->include('user/templates/profile_left_panel'); ?>
		</div>
        <div class="col-lg-8 col-md-12 col-12 col-sm-12">
          <div class="right_side">
            <div class="post_rightside">
              <?php


     if(count($eventall_profile)!=0){
  
      foreach($eventall_profile as $comm){
       
    ?>
              <div class="one_bx ">
                <div class="topbar_post ">
                  <div class="topbar_icon"><img src="<?php echo  $baseurl.$users['profile_image'];?>"></div>
                  <h2><?php echo $name=$_SESSION['nameUserH'] ?></h2>
                  <p><?php echo date('d M Y',strtotime($comm['created_at']));?></p>
                </div>

              <h2 class="blog_user_title">
				  <?php echo $comm['name'];?>
				  </h2>
                <p class="post_one_pdding">
				  <?php
				  $sentences = 2;
                  $contentss=implode('. ', array_slice(explode('.', $comm['details']), 0, $sentences)) . '.';
				 echo $contentss;
				 ?>
				</p>  
                
                <div class="post_images "> <a onclick="getSingleEvent('<?php echo $comm['id'];?>')">
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
         
          <?php /*?><div class="read_more"> <a onclick="getSingleEvent('<?php echo $comm['id'];?>')">Read More</a> </div><?php */?>
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
        <h5 class="modal-title share_your_thoughts_popup_title" id="exampleModalLongTitle">Share Your Thoughts  </h5>
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
                <textarea  rows="4" cols="50" class="form-control" name="create_post_content" id="create_post_content" placeholder="Share Your Thoughts"></textarea>
              </div>
              <div class="form-group">
                <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label class="control-label">Upload File</label>
            <div class="preview-zone hidden">
              <div class="box box-solid">
                <div class="box-header with-border">
                  <div><b>Preview</b></div>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-danger btn-xs remove-preview">
                      <i class="fa fa-times"></i> Reset This Form
                    </button>
                  </div>
                </div>
                <div class="box-body"></div>
              </div>
            </div>
            <div class="dropzone-wrapper">
              <div class="dropzone-desc">
                <i class="glyphicon glyphicon-download-alt"></i>
                <p>Choose an image file or drag it here.</p>
              </div>
              <input type="file" name="create_post_image" class="dropzone">
            </div>
          </div>
        </div>
      </div>
				<?php /* ?>
				<input type="file" name="create_post_image" class="form-control" id="create_post_image" accept="image/*,video/webm,video/ogg,video/mp4,video/3gp" >
				<?php */ ?>
              </div>
              <input type="submit" name="create" id="create" value="  post" class="create_button">
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