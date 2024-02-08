<?php
if(count($vaganpost)!=0){
		foreach($vaganpost as $val){
?>			
<li class="main-feed-item">
          <article class="common-post">
            <div class=" "><div class="col-sm-12 col-md-12 padding_left_home">
            
				<header class="common-post-header u-flex"> 

                     <?php

                  if(file_exists($val['user_image'])){ ?>

                  <img src="<?php echo base_url().'/'.$val['user_image'];?>" class="user-image" width="40" height="40" alt="">


                  <?php }else{ ?>


                     <img src="<?php echo $public_url;?>images/user-icon.png" class="user-image" width="40" height="40" alt="">



                   



                  <?php }


                    ?>
                    


                  <div class="common-post-info">
                    <div class="user-and-group u-flex "> <a href="<?php echo base_url();?>/user/public_profile/<?php echo $val['user_id'];?>"><?php echo $val['user_name'];?> </a> </div>
                     <div class="username_time"> <a href="#"><?php 
                  $curr_time =$val['post_created_at'];
                  $time_ago = strtotime($curr_time);
                  echo time_Ago($time_ago). "\n";
                  
                  ?>
                  </a> </div>
                  </div>
                  
                   </header>
                <div class="embed-content-text">
                  <p onclick="showcommentmodal('<?php echo $val['id'];?>')" class="embed-content-paragraph"><?php echo strip_tags($val['post_content']);?></p>
                </div>
                
              </div>
              
				

                    <div class="col-sm-12 col-md-12 padding-right">
                <div class="common-post-content common-content"> 
				<?php 
				if(!empty($val['post_image'])){?>
				
				<?php
				$mime = mime_content_type($val['post_image']);
				if(strstr($mime, "video/")){
				?>
				<a><video width="320" height="240" controls> 
				  <source src="<?php echo base_url().'/'.$val['post_image'];?>" type="video/webm"> 
				  <source src="<?php echo base_url().'/'.$val['post_image'];?>" type="video/ogg"> 
				  <source src="<?php echo base_url().'/'.$val['post_image'];?>" type="video/mp4">
				  <source src="<?php echo base_url().'/'.$val['post_image'];?>" type="video/3gp">
				</video>
                 </a>
				<?php			
				}else if(strstr($mime, "image/")){
				?>
				<a><img onclick="showcommentmodal('<?php echo $val['id'];?>')" class="embed-content-image" src="<?php echo base_url().'/'.$val['post_image'];?>" alt=""></a>
				<?php
				}} ?>

                </div>
               
               <div class="btm_common_allblog">
                <div class="summary u-flex "> 
				<div class="vegan-post-like-share">
				
                  <?php 
				  if($val['likestatus']==0){
				  ?>
                  <a>
                   
                   <span id="like_cnt_<?php echo $val['id'];?>"><?php echo $val['total_like'];?></span>
				  <div class="reactions like_icon" id="like_<?php echo $val['id'];?>"  onclick="addpostlike('<?php echo $val['id'];?>','1')"><span><i class="fa fa-heart" aria-hidden="true"></i></span><span>Like</span></div>
				  <div class="reactions" style="display:none" id="unlike_<?php echo $val['id'];?>"   onclick="addpostlike('<?php echo $val['id'];?>','0')"><span><i class="fa fa-heart" aria-hidden="true"></i></span><span>UnLike </span></div>
                  </a>
                  <?php 				  
				  }else{
				  ?>
                  <a>
                    <span id="like_cnt_<?php echo $val['id'];?>"><?php echo $val['total_like'];?></span>

				  <div class="reactions like_icon" style="display:none" id="like_<?php echo $val['id'];?>"  onclick="addpostlike('<?php echo $val['id'];?>','1')">
				  <span><i class="fa fa-heart" aria-hidden="true"></i>è</span>
				  <span>Like</span>
				  </div>
				  <div class="reactions"  id="unlike_<?php echo $val['id'];?>"   onclick="addpostlike('<?php echo $val['id'];?>','0')"><span><i class="fa fa-heart" aria-hidden="true"></i></span><span>UnLike</span></div> </a> 
                  <?php				  
				  }
				  ?>
				  
                 
				  <a class="comment_right_home_page" onclick="showcommentmodal('<?php echo $val['id'];?>')" > <span id="comment_<?php echo $val['id'];?>"><?php echo $val['total_comment'];?></span><span class="icon"><i class="fa fa-comment-o" aria-hidden="true" ></i></span><span>Comments </span></a> 
				  <a href="#"> <span class="icon" style="display:none"><i class="fa fa-share-alt" style="display:none" aria-hidden="true"></i><span>Share</span> </span>
				  </a> 
				  </div>
				  </div>
                <!-- <div class="summary u-flex">
                  <div class="total-comments u-margin-inline-start time_btm"> <a href="#"><?php 
				  $curr_time =$val['post_created_at'];
                  $time_ago = strtotime($curr_time);
				  echo time_Ago($time_ago). "\n";
				  
				  ?>
				  </a> </div> 
                </div>-->
                
                </div>
                       </div>

               
				 
              
            </div>
          </article>
        </li>
<?php 
}
}
?>
<?php
function time_Ago($time) {
   // Calculate difference between current
    // time and given timestamp in seconds
    $diff     = time() - $time;
    // Time difference in seconds
    $sec     = $diff;
    // Convert time difference in minutes
    $min     = round($diff / 60 );
    // Convert time difference in hours
    $hrs     = round($diff / 3600);
    // Convert time difference in days
    $days     = round($diff / 86400 );
    // Convert time difference in weeks
    $weeks     = round($diff / 604800);
    // Convert time difference in months
    $mnths     = round($diff / 2600640 );
    // Convert time difference in years
    $yrs     = round($diff / 31207680 );
    // Check for seconds
    if($sec <= 60) {
        echo "$sec seconds ago";
    }
    // Check for minutes
    else if($min <= 60) {
        if($min==1) {
            echo "one minute ago";
        }
        else {
            echo "$min minutes ago";
        }
    }
    // Check for hours
    else if($hrs <= 24) {
        if($hrs == 1) { 
            echo "an hour ago";
        }
        else {
            echo "$hrs hours ago";
        }
    }
    // Check for days
    else if($days <= 7) {
        if($days == 1) {
            echo "Yesterday";
        }
        else {
            echo "$days days ago";
        }
    }
    // Check for weeks
    else if($weeks <= 4.3) {
        if($weeks == 1) {
            echo "a week ago";
        }
        else {
            echo "$weeks weeks ago";
        }
    }
    // Check for months
    else if($mnths <= 12) {
        if($mnths == 1) {
            echo "a month ago";
        }
        else {
            echo "$mnths months ago";
        }
    }
    // Check for years
    else {
        if($yrs == 1) {
            echo "one year ago";
        }
        else {
            echo "$yrs years ago";
        }
    }
}


 ?>		