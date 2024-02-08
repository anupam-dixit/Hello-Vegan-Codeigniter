<div class="side_menu">
            <div class="hadding_side">
              <h2><?=lang('app.global.menu')?></h2>
              <span onclick="openNav()"><i class="fa fa-bars" aria-hidden="true"></i> </span> </div>
            <div class="menu_all">
              <ul>
                <li><a href="<?php echo base_url();?>/user/about"><span> <i class="fa fa-question-circle-o" aria-hidden="true"></i></span> <?=lang('app.global.about')?></a></li>
                <li><a href="<?php echo base_url();?>/user/profile"><span> <i class="fa fa-th" aria-hidden="true"></i></span> <?=lang('app.global.post')?></a></li>
                <li><a href="<?php echo base_url();?>/user/event_user"><span> <i class="fa fa-calendar" aria-hidden="true"></i></span> <?=lang('app.global.events')?></a></li>
                <li><a href="<?php echo base_url();?>/user/recipes_user"><span> <i class="fa fa-cutlery" aria-hidden="true"></i></span> <?=lang('app.global.recipe')?></a></li>
                <li><a href="<?php echo base_url();?>/user/blog_user"><span> <i class="fa fa-rss" aria-hidden="true"></i></span> <?=lang('app.global.blog')?></a></li>
                <li><a href="<?php echo base_url();?>/user/privacy"><span> <i class="fa fa-info" aria-hidden="true"></i></span> <?=lang('app.global.privacy_policy')?></a></li>
                <li><a href="<?php echo base_url();?>/user/terms"><span> <i class="fa fa-info" aria-hidden="true"></i></span> <?=lang('app.global.terms_of_Service')?></a></li>
                <li><a href="<?php echo base_url();?>/user/logout"><span> <i class="fa fa-sign-out" aria-hidden="true"></i></span> <?=lang('app.global.logout')?></a></li>
              </ul>
            </div>
          </div>
          <div class="side_menu photos_p_profile">
            <div class="menu_all">
              <div class="hadding_side">
                <h2><?=lang('app.global.photo')?> <a href="<?php echo base_url();?>/user/photo"><?=lang('app.global.see_all')?></a></h2>
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
                        <a href="<?=$baseurl.$comm;?>" data-lightbox="image-1" data-title="Photos">
					<img src="<?php  echo  $baseurl.$comm;?>"> 
					</a>
                    <?php 
					}
					?>
					</div>
					<?php } else { ?>
                    <div class="post_images ">
					<a href="<?php echo $public_url;?>images/no_img.jpg" data-lightbox="image-1" data-title="Photos">
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
                        <div class="common-post-content common-content no_deta_all">

                        </div>
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
                <h2>Friends <a href="<?php echo base_url();?>/user/friendlist"><?=lang('app.global.see_all')?></a> <span>
                  <?php  print count($userfriend); ?>
                  <?=lang('app.global.friend')?></span></h2>
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
                    <h3> <?php echo $uf['name'];?> </h3><span> <?=lang('app.profile._5')?></span>
                  </li>
                  <?php 
	 }}else{  ?>
                <li class="main-feed-item" id="nopost">
                  <article class="common-post">
                    <div class="row">
                      <div class="col-sm-12 col-md-12">
                        <div class="common-post-content common-content no_deta_all"> <?=lang('app.profile._6')?></div>
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
                <h2>Friend request <a href="<?php echo base_url();?>/user/friendrequestlist">See All</a></h2>
              </div>
              <div class="photo_for_gallery friend_request_profile">
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