<?php 
echo  $this->extend('user/templates/friend_template'); ?>
<?php echo  $this->section('content'); ?>
<?php
$public_url=base_url()."/public/frontend/";
$baseurl=base_url()."/";
$friend_request_send_by_me_array=[];

if(count($friend_request_send_by_me)!=0){
	foreach($friend_request_send_by_me as $val){
		$friend_request_send_by_me_array[]=$val['id'];
	}
}
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
                    <div class="speciality"><?php echo $users['address'];?></div>
                    <div class="speciality"><?php echo count($userfriend);?> friends</div>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="profile-button-actions my-15"><a class="btn-floating" href="#">
                 
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
            <div class="friend_requests_page">
              <div class="hadding_side">
                <h2>Friend requests</h2>
              </div>
			  <ul>
			  <?php 
			  if(count($friendrequest)!=0){
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
			  
			  <li class="common-post-content common-content no_deta_all">
                  <div > No Freind Request</div>	</li>  
                  <div class="freand_type"> 
			
				  </div>
                
			  <?php
			  }
			  ?>
			   </ul>
            </div>
            <div class="friend_requests_page"> <br>
              <div class="hadding_side">
                <h2>Friend Suggestions</h2>
              </div>
              <ul>
			  <?php 
			  if(count($people_you_may_know)!=0){
			  foreach($people_you_may_know as $val){
			  if($val['profile_image']!=''){
				$imageurl=base_url().'/'.$val['profile_image'];  
			  }else{
				$imageurl=base_url().'/public/frontend/images/f_icon_user.jpg';  
			  }
			   
				$addfriendstyle='';
				$cancelrequeststyle='display:none;font-size:12px';
				if(in_array($val['id'],$friend_request_send_by_me_array)){
				$addfriendstyle='display:none';
				$cancelrequeststyle='font-size:12px';	
				}
				
			  ?>
                <li id="removed_<?php echo $val['id'];?>">
				<a href="<?php echo base_url();?>/user/public_profile/<?php echo $val['id'];?>">
				<img src="<?php echo $imageurl;?>">
                  </a>
				  <h3> <?php echo $val['name'];?> <span>0 mutual friend</span></h3>
                  <div class="freand_type"> 
				  <a style="<?php echo $addfriendstyle;?>" id="addfriend_<?php echo $val['id'];?>" href="javascript:friend_request_send('<?php echo $val['id'];?>');">Add Friend
				  </a>
                 <a style="<?php echo $cancelrequeststyle;?>" id="requestsend_<?php echo $val['id'];?>" href="javascript:cancel_request('<?php echo $val['id'];?>');"> Cancel Request
				  </a>				  
				  <a  href="javascript:removed_people_you_may_know('<?php echo $val['id'];?>');" class="delete_friends">Remove</a> </div>
                </li> 
              <?php }}?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
<?php echo  $this->endSection(); ?>