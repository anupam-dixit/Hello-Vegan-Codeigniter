<?php 
echo  $this->extend('user/templates/blog_template');
echo  $this->section('content');
?>
	<main class="main-feed">
      <ul class="main-feed-list">
         <div class="notfy">
         <?php echo  $this->include('user/templates/notf_header_template'); ?>
        </div>
        <div class="blog_page">
            
          <div class="blog_one_top">
            <div class="blog_date">
              <ul>
               
                <li> Blog</li>
              </ul>
            </div>
            <?php 
      
      if(count($latest_blog)!=0)
      {
      ?>
           

          

            <h2><a href="<?php echo base_url();?>/user/blog/details/<?php echo $latest_blog['id'];?>"><?php echo $latest_blog['title'];?></a></h2>
  

            <div class="blog_images"><a onclick="getSingleblog('<?php echo $latest_blog['id'];?>')"><img src="<?php echo base_url().'/'.$latest_blog['image'];?>"></a></div>


            <div class="loc_event"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $latest_blog['location'];?></div>
            <div class="date_event"><?php echo date('M d,Y h:i a',strtotime($latest_blog['updated_at']));?></div>

            <p><?php echo $latest_blog['content'];?></p>
           
            <div class="read_more"> <a onclick="getSingleblog('<?php echo $latest_blog['id'];?>')">Read More</a> </div>
         

        <?php } ?>
          
          <div class="blog_one_btm">
            <div class="row">

             <?php
        foreach($blogall as $val){
        ?>
              <div class="col-md-6 col-sm-6 padding_right_left">
                <div class="blog_one_top blog_one_tetbtm">

                  <div class="blog_images2"><a onclick="getSingleblog('<?php echo $val['id'];?>')"><img src="<?php echo base_url().'/'.$val['image'];?>"></a></div>

              
                  <h2 class="hidding_one_middel"><a onclick="getSingleblog('<?php echo $val['id'];?>')"><?php echo $val['title'];?> </a></h2>
                  <p><?php echo $val['content'];?></p>
                  <div class="read_more"> <a onclick="getSingleblog('<?php echo $val['id'];?>')">Read More</a> </div>
                
                </div>
              </div>

        <?php } ?>
              
            </div>
          </div>
				 
		</div>
      </ul>
    </main>
   <span id="showmodel" style="display:none"></span>  

  <?php echo  $this->endSection(); ?>