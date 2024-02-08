<?php 
echo  $this->extend('user/templates/dashboard_template');
echo  $this->section('content'); 
?>

    <main class="main-feed">
      <ul class="main-feed-list">
      <div class="notfy">
      <?php echo  $this->include('user/templates/notf_header_template'); ?>
      </div>
	  <h2>Vegan log</h2>
		<button  onclick="createpostpopup_open()" class="addli share_your_thoughts">Share Your Thoughts</button>
		<?php 
			if(count($vaganpost)!=0)
		foreach($vaganpost as $val){
		?>
		<li class="main-feed-item">
          <article class="common-post">
            <div class="row">
              <div class="col-sm-6 col-md-6 padding-right">
                <div class="common-post-content common-content"> <a> 
				<?php 
				$mime = mime_content_type($val['post_image']);
				if(strstr($mime, "video/")){
							?>
					
				<video width="320" height="240" controls> 
				  <source src="<?php echo base_url().'/'.$val['post_image'];?>" type="video/webm"> 
				  <source src="<?php echo base_url().'/'.$val['post_image'];?>" type="video/ogg"> 
				  <source src="<?php echo base_url().'/'.$val['post_image'];?>" type="video/mp4">
				  <source src="<?php echo base_url().'/'.$val['post_image'];?>" type="video/3gp">
				</video>

				<?php			
						}else if(strstr($mime, "image/")){
				?>
				<img class="embed-content-image" src="<?php echo base_url().'/'.$val['post_image'];?>" alt="">
				<?php
						} 
				?>
				 </a> </div>
              </div>
              <div class="col-sm-6 col-md-6">
             
				<header class="common-post-header u-flex"> <img src="<?php echo base_url().'/'.$val['user_image'];?>" class="user-image" width="40" height="40" alt="">
                  <div class="common-post-info">
                    <div class="user-and-group u-flex"> <a href="#" target="_blank"><?php echo $val['user_name'];?> </a> </div>
                  </div>
                   </header>
                <div class="embed-content-text">
                  <p class="embed-content-paragraph"><?php echo $val['post_content'];?></p>
                </div>
                <div class="summary u-flex "> 
				<div class="vegan-post-like-share">
				<a >
                  <?php 
				  if($val['likestatus']==0){
				  ?>
				  <div class="reactions" id="like_<?php echo $val['id'];?>"  onclick="addpostlike('<?php echo $val['id'];?>','1')"><span>❤️</span><span>Like</span></div>
				  <div class="reactions" style="display:none" id="unlike_<?php echo $val['id'];?>"   onclick="addpostlike('<?php echo $val['id'];?>','0')"><span>💙</span><span>UnLike</span></div>
                  <?php 				  
				  }else{
				  ?>
				  <div class="reactions" style="display:none" id="like_<?php echo $val['id'];?>"  onclick="addpostlike('<?php echo $val['id'];?>','1')"><span>❤️</span><span>Like</span></div>
				  <div class="reactions"  id="unlike_<?php echo $val['id'];?>"   onclick="addpostlike('<?php echo $val['id'];?>','0')"><span>💙</span><span>UnLike</span></div>
                  <?php				  
				  }
				  ?>
				  
                  </a> 
				  <a > <span class="icon"><i class="fa fa-comment-o" aria-hidden="true" onclick="showcommentmodal('<?php echo $val['id'];?>')"></i></span><span>Comments</span></a> 
				  <a href="#"> <span class="icon"><i class="fa fa-share-alt" aria-hidden="true"></i><span>Share</span> </span>
				  </a> 
				  </div>
				  </div>
                <div class="summary u-flex">
                  <div class="total-comments u-margin-inline-start time_btm"> <a href="#"><?php 
				  $curr_time =$val['post_created_at'];
                  $time_ago = strtotime($curr_time);
				  echo time_Ago($time_ago). "\n";
				  
				  ?>
				  </a> </div>
                </div>
              </div>
            </div>
          </article>
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
    </main>
   
  
 

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
 echo  $this->endSection(); 
 ?>