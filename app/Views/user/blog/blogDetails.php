<?php 
echo  $this->extend('user/templates/blog_template');
echo  $this->section('content');
$blogs_name=$data['title'];
		$createddate=date('M d,Y h:i a',strtotime($data['created_at']));
		$details=$data['content'];
		$detail1=substr($data['content'],50,200);
		$detail2=substr($data['content'],200,400);
		$detail3=substr($data['content'],400,600);
		$detail4=substr($data['content'],600,800);
		$detail5=substr($data['content'],800,1200);
		if($data['galleryimage']!=''){
		$ex=explode(",",$data['galleryimage']);
         if(isset($ex[0])){
			$image_galary1=base_url().'/'.$ex[0]; 
		 }
		} 
?> 

	<main class="main-feed">
      <ul class="main-feed-list">
        <div class="notfy">
         <?php echo  $this->include('user/templates/notf_header_template'); ?>
        </div>
        <div class="blog_page">
            
          <div class="blog_one_top">
            <div class="custom_fields_pop">
			     <div class="blog_ppup">
                   <div class="blog_images">
		            <?php 
					if($data['image']!=''){
					$image=base_url().'/'.$data['image'];
					?>
					<img src="<?php echo $image;?>">
					<?php
					}
					?>
		         </div>
					<h2 class="hidding_one_middel"><?php echo $blogs_name;?></h2>
					<div class="blog_date">
					<ul>
					 <li><a href="#"><?php echo $createddate;?></a></li>
					 <li> Blog</li>
					</ul>
					</div>
					<p><?php echo $detail1;?></p>
					<div class="blog_text">
					  <div class="row">
					    <div class="col-md-12">
						  <p><?php echo $detail2;?></p>
						</div>
						<div class="col-md-8">
						<p><?php echo $detail3;?> </p>
						</div>
						<div class="col-md-4">
						<div class="blog_images">
						<?php 
						if($data['galleryimage']!=''){
						$ex=explode(",",$data['galleryimage']);
						$image=base_url().'/'.$ex[0];	
						?>
						<img height="150" src="<?php echo $image;?>">	
						<?php 
						}
						?>
						</div>
					  </div>
					</div>
					</div>
					<?php 
					if($data['video']!=''){
					$videos=base_url().'/'.$data['video'];
					?>
					<div class="embed-responsive embed-responsive-16by9 col-xs-4 text-center">
					<video src="<?php echo $videos;?>" controls></video>
					 </div>
					<?php
					}  
					?>
					<p><?php echo $detail4;?></p>
					<?php 
			if($data['galleryimage']!=''){
			   $ex=explode(",",$data['galleryimage']);
				if(isset($ex[0])){
				  $image_galary1=base_url().'/'.$ex[0];
				  ?>
					<section class="slider-section">
					        <div id="owl-demo" class="owl-carousel  owl-theme">
								<?php 
								foreach($ex as $val){
								  $image_galarys=base_url().'/'.$val;
								 ?>
								 <div class="item col-md-14"><img width="150" height="200" src="<?php echo $image_galarys;?>"></div>
								<?php 
								}
								?>
					</div></div>			
				<?php
				}
			}
			?>
		<p><?php echo $detail5;?></p>
		</div>
		<?php 
		
		?>
		
		<div class="blog_comment">
		<div class="detailBox">
					 <div class="titleBox">
                        <label>Comment </label>
		<?php 
		if(count($da)!=0){
			
			if(count($das)>2){
			$commentscount=count($das)-count($da);
			$html.='<button id="viewold" onclick="showoldercomments('.$id.')" class="viewoldcommetns">View Old '.$commentscount.' Commetns</button>';
			}
		}	
		?>
		</div>
			     <div class="actionBox">
                    <ul class="commentList">
		<?php 
		if(count($da)!=0){			
			foreach($da as $datas){
			
			$commented_by='Admin';
			$userimage=base_url().'/'.'public/frontend/images/logo.png';
		      if($datas['users_name']!=''){
			    $commented_by=$datas['users_name'];
			    $userimage=base_url().'/'.$datas['users_profile_image'];
		      }
		?>
		<li>
          <div class="commenterImage"> <img src="'.$userimage.'" /> </div>
          <div class="commentText">
            <h2><?php echo $commented_by;?></h2>
            <p class=""><?php echo $datas['message'];?></p>
            <span class="date sub-text">on <?php echo date('M d, Y',strtotime($datas['created_at']));?></span> </div>
        </li>
		<?php 
			
			}
		}
		?>
	   </ul>
     
        <form class="form-inline" role="form" method="post" id="blogcommentform" name="blogcommentform">
        <div class="form-group">
          <h2>LEAVE A REPLY </h2>
          <textarea id="messagecomments" name="message"  class="form-control comment_here" rows="5" cols="3" placeholder="Enter your comment here..."></textarea>
        </div>
        <div class="form-group">
		<input type="hidden" class="" id="commented_by" name="commented_by"  value="'.$session->get('idUserH').'" size="30" aria-required="true">
		<input type="hidden" class="" id="post_id" name="post_id"  value="'.$id.'" size="30" aria-required="true">
          <button class="post_comment" type="button" id="submitcomment"  onclick="submitblogcomments()">Post Comment</button>
        </div>
      </form>
		   
    </div>
  </div>
</div>
</div>
</div>
</div>
         

      </ul>
    </main>
	
  <?php echo  $this->endSection(); ?>