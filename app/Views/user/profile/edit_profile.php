<?php echo  $this->extend('user/templates/profile_template'); ?>
<?php echo  $this->section('content'); ?>
<?php
$public_url=base_url()."/public/frontend/";
$baseurl=base_url()."/";
?>
<?php
$id=$users['id'];
$name=$users['name'];
$last_name=$users['last_name'];
$dob=$users['dob'];
$city=$users['city'];
$pin_code=$users['pin_code'];
$state=$users['state'];
$country=$users['country'];
$address=$users['address'];
$description=$users['description'];
$profile_image=$users['profile_image'];
$cover_image=$users['cover_image'];
$email=$users['email'];
$mobile_no=$users['mobile_no'];
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
        <div class="cover_images panel"> <img src="<?php echo $baseurl.$users['cover_image'];?>">
          <div class="profile-header">
            <div class=" panel-xl">
              <div class="row">
                <div class="col-md-9 col-12 col-sm-12">
                  <div class="profile-header-main">
                    <div class="avatar avatar-normal has-aura text-center"><img class="avatar img-responsive" alt="admin_profile" src="<?php echo  $baseurl.$users['profile_image'];?>"></div>
                    <div class="profile-contact">
                      <div class="profile-main-top">
                        <h1 class="name"><?php echo $name;?></h1>
                      </div>
                      <div class="speciality"><?php echo $address;?> </div>
                      <div class="speciality"><?php echo $email;?>, <?php echo $mobile_no;?></div>
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="profile-button-actions my-15"><a class="btn-floating" href="/user/friendrequestlist">
                    <div class="after-span ripple"></div>
                    <span> </span> Add Friend </a><a class="btn-floating" href="#">
                    <div class="after-span ripple"></div>
                    <span> </span> Messages</a></div>
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
        <div class="col-md-4">
          <div class="side_menu">
            <div class="hadding_side">
              <h2>Menu</h2>
              <span onclick="openNav()"><i class="fa fa-bars" aria-hidden="true"></i> </span> </div>
            <div class="menu_all">
              <ul>
                <li><a href="<?php echo base_url();?>/user/about"><span> <i class="fa fa-question-circle-o" aria-hidden="true"></i></span> About</a></li>
                <li><a href="<?php echo base_url();?>/user/profile"><span> <i class="fa fa-th" aria-hidden="true"></i></span> Post</a></li>
                <li><a href="<?php echo base_url();?>/user/event_user"><span> <i class="fa fa-calendar" aria-hidden="true"></i></span> Events</a></li>
                <li><a href="<?php echo base_url();?>/user/recipes_user"><span> <i class="fa fa-cutlery" aria-hidden="true"></i></span> Recipes</a></li>
                <li><a href="<?php echo base_url();?>/user/blog_user"><span> <i class="fa fa-rss" aria-hidden="true"></i></span> Blog</a></li>
                <li><a href="<?php echo base_url();?>/user/privacy"><span> <i class="fa fa-info" aria-hidden="true"></i></span> Privacy Policy</a></li>
                <li><a href="<?php echo base_url();?>/user/terms"><span> <i class="fa fa-info" aria-hidden="true"></i></span> Terms of Service</a></li>
                <li><a href="<?php echo base_url();?>/user/logout"><span> <i class="fa fa-sign-out" aria-hidden="true"></i></span> Logout</a></li>
              </ul>
            </div>
          </div>


           <div class="side_menu photos_p_profile">
            <div class="menu_all">
              <div class="hadding_side">
                <h2>Photos <a href="<?php echo base_url();?>/user/photo">See All</a></h2>
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
          <div class="side_menu photos_p_profile">
            <div class="menu_all">
              <div class="hadding_side">
                <h2>Friends <a href="<?php echo base_url();?>/user/friendlist">See All</a> <span>
                  <?php  print count($userfriend); ?>
                  friends</span></h2>
              </div>
              <div class="photo_for_gallery">
                <ul>
                  <?php
// print_r($posts);
// print count($userfriend);
     if(count($userfriend)!=0){
      foreach($userfriend as $uf){
    ?>
                  <li><a href="<?php echo base_url();?>/user/public_profile/<?php echo $uf['id'];?>"><img src="<?php echo $baseurl.$uf['profile_image'];?>"></a>
                    <h3> <?php echo $uf['name'];?> </h3><span> mutual friend</span>
                  </li>
                  <?php 
   }}
      ?>
           
                </ul>
              </div>
            </div>
          </div>
      <div class="side_menu photos_p_profile">
            <div class="menu_all">
              <div class="hadding_side">
                <h2>Friend requests <a href="<?php echo base_url();?>/user/friendrequestlist">See All</a></h2>
              </div>
              <div class="photo_for_gallery friend_request_profile">
        <ul>
        <?php 
        if(count($friendrequest)<=3){
        foreach($friendrequest as $val){
        ?>               
         <li id="confirm_<?php echo $val['id'];?>">
         <a href="<?php echo base_url();?>/user/public_profile/<?php echo $val['id'];?>"><img src="<?php echo base_url().'/'.$val['profile_image'];?>"></a>
                  <h3> <?php echo $val['name'];?> <span>178 mutual friend</span></h3>
                  <div class="freand_type"> 
          <a href="javascript:friend_request_confrim('<?php echo $val['id'];?>')">Confirm</a> 
          <a href="javascript:friend_request_delete('<?php echo $val['id'];?>')" class="delete_friends">Delete</a> 
          </div>
                </li>
              <?php 
        }
        }else{
         ?> 
        <li>
        
                  <div class="no_deta_all"> No Freind Request</div>
                  <div class="freand_type"> 
          
          </div>
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

     if(count($event_data)!=0){
      foreach($event_data as $ed){
    ?>
                  <li><img src="<?php echo $baseurl.$ed['image'];?>">
                    <h3><?php echo $ed['name'];?></h3>
                  </li>
                  <?php 
   }}else{
      ?>
                  <li>
                    <h3>No Event Added Yet</h3>
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
          <div class="right_side edit_bg_profile">
            <div class="profile_editbox ">
              <div class="hadding_side">
                <h2>Profile Edit</h2>
              </div>
              <div class="edit_bg_profileform">
              <form action="<?php echo base_url('User1Controller/updateUserProfile');?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
                <div class="row">
                <div class="col-md-6 col-12">
                    <div class="form-group a">
                    <label for="name">First Name</label>
                    <input id="name" type="text" placeholder="First Name" name="name" value="<?php echo $name;?>">
                  </div>
                  </div>
                   <div class="col-md-6 col-12">
                    <div class="form-group b">
                    <label for="first-name">Last Name</label>
                    <input id="first-name" type="text" placeholder="Last Name" name="last_name" value="<?php echo $last_name;?>">
                  </div>
                      </div>
                   <div class="col-md-6 col-12">
                    <div class="form-group email-group">
                    <label for="email">Email</label>
                    <input id="email" type="text" placeholder="Email" name="email" value="<?php echo $email;?>" readonly>
                  </div>
                  </div>
                   <div class="col-md-6 col-12">
                  
                  
                  
                  
                  
                  <div class="form-group phone-group">
                    <label for="phone">Mobile</label>
                    <input id="phone" type="text" placeholder="Mobile" name="mobile" value="<?php echo $mobile_no;?>">
                  </div>
                  </div>
                   <div class="col-md-6 col-12">
                  <div class="form-group">
                    <label for="address">Address</label>
                    <input id="address" type="text" placeholder="Address" name="address" value="<?php echo $address;?>">
                  </div>
                  </div>
                   <div class="col-md-6 col-12">
                  <div class="form-group">
                    <label for="Country">Country</label>
                    <input type="text" placeholder="Country" id="country" name="country" value="<?php echo $country;?>">
                    <input type="hidden" id="countryId" value="0">
                  </div>
                  </div>
                   <div class="col-md-6 col-12">
                  <div class="form-group">
                    <label for="State">State</label>
                    <input id="State" type="text" placeholder="State" name="state" value="<?php echo $state;?>">
                  </div></div>
                   <div class="col-md-6 col-12">
                  <div class="form-group">
                    <label for="city">City</label>
                    <input id="city" type="text" placeholder="City" name="city" value="<?php echo $city;?>">
                  </div></div>
                   <div class="col-md-6 col-12">
                  <div class="form-group">
                    <label for="zip">Code Postal</label>
                    <input id="zip" type="text" placeholder="Code Postal" name="pin" value="<?php echo $pin_code;?>">
                  </div></div>
                   <div class="col-md-6 col-12">
                  <div class="form-group">
                    <label for="zip">Date of birth</label>
                    <input type="date" id="dob" name="dob" value="<?php echo $dob;?>">
                  </div></div>
                   <div class="col-md-6 col-12">
                  <div class="form-group ">
                    <label for="Country">Profile Pictures</label>
                    <input id="Country" type="file" name="profile_image" >
                  </div></div>
                   <div class="col-md-6 col-12">
                  <div class="form-group">
                    <label for="zip">Background Pictures</label>
                    <input id="zip" type="file" name="cover_image">
                  </div></div>
                   <div class="col-md-12 col-12">
                  <div class="form-group">
                    <label for="zip">Description</label>
                    <textarea id="zip" type="text" rows="3" placeholder="Description" name="description" value="<?php echo $description;?>"></textarea>
                  </div>
                  <div class="button-container submit_profile_edit">
                    <div class="after-span ripple"></div>
                    
                    </div>
                    
                    
                    <button  type="submit" class="btn btn-primary btn-floating submit_button_edit_profile">Submit</button>
                  </div>
                </div>
              </form>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<?php echo  $this->endSection(); ?>