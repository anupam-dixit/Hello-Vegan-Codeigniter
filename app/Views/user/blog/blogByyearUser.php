<?php 
echo  $this->extend('user/templates/blog_template');
echo  $this->section('content');
function text_truncate($string, $n=10) {
    $d= mb_substr($string, 0, $n);
    $d.=(strlen($string)>=$n)?'...':null;
    return $d;
}
 ?>
	<main class="main-feed">
      <ul class="main-feed-list">
        <div class="notfy">
         <?php echo  $this->include('user/templates/notf_header_template'); ?>
        </div>
        <div class="blog_page">
            
          <div class="blog_one_top">
            
           
			<!-- <div class="hadding_main">Blogs </div> -->
			<?php 
      
      if(count($latest_blog)==0)
      {
      ?>
	  <div class="blog_date">
              <ul>
             
                <li> Blog</li>
              </ul>
            </div>
			 <h2></h2>
			 <div class="subhadding_news"><h2><a data-toggle="modal" data-target="#addBlogModal" href="" class="add_blog_button">Add Blog</a></h2></div>

     



            <div class="blog_images">No Blog Added yet</div>
 
            <div class="date_event"></div>

            <p></p>
        
	  <?php 
	  }
	  ?>
            <?php 
      
      if(count($latest_blog)!=0)
      {
      ?>
           
 <div class="subhadding_news"><h2><a data-toggle="modal" data-target="#addBlogModal" href="" class="add_blog_button">Add Blog</a></h2></div>
     <div class="event_page_main_haddeing">
<div class="hadding_main">Blog </div>

 <div class="subhadding_news"><?php echo $latest_blog['category_name'];?> </div>
</div> 

            <div class="top_blog main_blog_page_cdd">
    

            <div class="blog_images blog_mainimages_and_post"><a onclick="getSingleblog('<?php echo $latest_blog['id'];?>')"><img src="<?php echo base_url().'/'.$latest_blog['image'];?>"></a></div>
         <div>
             <h2>
                 <a href="<?php echo base_url();?>/user/blog/details/<?php echo $latest_blog['id'];?>">
                 <?php echo text_truncate($latest_blog['title']);?>
             </h2>
         </div>
          
           
           <div class="blog_date">
              <ul>
                <li><a href="#"><?php echo date('d M Y',strtotime($latest_blog['created_at']));?></a></li>
                  <li><span class="badge bg-theme-primary-dark h2 float-end"><?php echo $latest_blog['category_name'];?></span></li>
            </ul>
            </div>

           <div class="date_event"></div>
           <p><?php echo text_truncate(substr($latest_blog['content'],0,250)) ?></p>
        
            <div class="read_more"> <a onclick="getSingleblog('<?php echo $latest_blog['id'];?>')">Read More</a> </div>
         

        <?php } ?>
		</div>
		</div>
          <div class="blog_one_middel">
            <a href="<?php echo base_url();?>/user/recipe"><h2>  Vegan  Recipes</h2></a>
            <div class="row">
        <?php
           foreach($blogRECIPES as $val){
        ?>
              <div class="col-md-4 col-sm-4 padding_right_left">
                <div class="blog_one_top">


                  <div class="blog_images"><img src="<?php echo base_url().'/'.$val['image'];?>"></div> 


                  <h2 class="hidding_one_middel"><a onclick="getSinglerecipes('<?php echo $val['id'];?>')"><?php echo $val['title'];?> </a></h2>
                </div>
              </div>
        <?php } ?>
              
            </div>
          </div>
          <div class="blog_one_btm">
            <div class="row">

             <?php
        foreach($blogall as $val){
        ?>
              <div class="col-md-6 col-sm-6 padding_right_left">
                <div class="blog_one_top blog_one_tetbtm">

                  <div class="blog_images2"><a onclick="getSingleblog('<?php echo $val['id'];?>')"><img src="<?php echo base_url().'/'.$val['image'];?>"></a></div>

            
                  <h2 class="hidding_one_middel"><a onclick="getSingleblog('<?php echo $val['id'];?>')"><?php echo text_truncate($val['title']);?> </a></h2>
                    <div class="">
                        <span class="badge bg-theme-primary-dark"><?php echo $latest_blog['category_name'];?></span>
                    </div>
                  <p><?php echo text_truncate($val['content']);?></p>
                  <div class="read_more"> <a onclick="getSingleblog('<?php echo $val['id'];?>')">Read More</a> </div>
                 
                </div>
              </div>

        <?php } ?>
              
            </div>
          </div>
				 
		</div>
      </ul>
    </main>
  <?php echo  $this->endSection(); ?>