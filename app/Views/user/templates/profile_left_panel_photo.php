<div class="side_menu">
          <div class="hadding_side">
            <h2>About Us</h2>
          </div>
          <div class="menu_all">
            <p><?php echo $users['description'];?></p>
          </div>
        </div>
		<?php
		  if(basename($_SERVER['SCRIPT_URI'])!='friendlist'){
		  ?>
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
		  <?php } ?>
		  <?php
		  if(basename($_SERVER['SCRIPT_URI'])!='photo'){
		  ?>
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
		  <?php
		  }
		  ?>
		  <?php
		  if(basename($_SERVER['SCRIPT_URI'])!='friendrequestlist'){
		  ?>
		  <div class="side_menu photos_p_profile">
            <div class="menu_all">
              <div class="hadding_side">
                <h2>Friend requests <a href="<?php echo base_url();?>/user/friendrequestlist">See All</a></h2>
              </div>
              <div class="photo_for_gallery friend_request_profile">
			  <ul>
			  <?php
			 // if(count($friendrequest)<=3){
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
       <?php
		  }
	   ?>