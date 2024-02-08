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
			  
			 <div class="subhadding_news all_blog_allpage"><h2> <a onclick="$('#addBlogModal').modal('show')" class="add_blog_button">Add Blog</a> </h2></div>

     



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
      

<div class="event_page_main_haddeing">
<div class="hadding_main">
<div class="row">
    <div class="col">
        Blog
    </div>
    <div class="col">
        <a onclick="$('#addBlogModal').modal('show')" class="add_blog_button float-end">Add Blog</a>
    </div>
</div>
</div>

 <div class="subhadding_news"><?php echo $latest_blog['category_name'];?> </div>
</div>
           <div class="top_blog main_blog_page_cdd">
 
            
 

            <div class="blog_images blog_mainimages_and_post"><a onclick="getSingleblog('<?php echo $latest_blog['id'];?>')"><img src="<?php echo ($latest_blog['image'])? base_url().'/'.$latest_blog['image']:'https://st3.depositphotos.com/23594922/31822/v/450/depositphotos_318221368-stock-illustration-missing-picture-page-for-website.jpg';?>"></a></div>

          <div class="blog_titel"><h2><a onclick="getSingleblog('<?php echo $latest_blog['id'];?>')"><?php echo $latest_blog['title'];?></h2></div>
            <div class="blog_date">
              <ul>
                <li><a href="#"><?php echo date('d M Y ',strtotime($latest_blog['updated_at']));?></a></li>
            </ul>
            </div>
 


            <div class="date_event"></div>

            <p><?php echo strip_tags(substr($latest_blog['content'],0,250)); ?></p>
         
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
				<div class="blog_one_top_oneall">
                  <!-- <div class="blog_images2"><a href="<?php echo base_url();?>/user/blog/details/<?php echo $val['id'];?>"><img src="<?php echo base_url().'/'.$val['image'];?>"></a></div> -->

                  <div class="blog_images"><a onclick="getSinglerecipes('<?php echo $val['id'];?>')"><img src="<?php echo base_url().'/'.$val['image'];?>"></a></div> 


                  <h2 class="hidding_one_middel"><a onclick="getSinglerecipes('<?php echo $val['id'];?>')"><?php echo $val['title'];?> </a></h2>
                  </div>
                </div>
              </div>
        <?php } ?>
              
            </div>
          </div>
          
          <div class="blog_one_btm">
            <div class="row" id="load_data">

             <?php
        foreach($blogall as $val){
        ?>
              <div class="col-md-6 col-sm-6 padding_right_left">
                <div class="blog_one_top blog_one_tetbtm">

                  <div class="blog_images2"><a onclick="getSingleblog('<?php echo $val['id'];?>')"><img src="<?php echo ($val['image'])? base_url().'/'.$val['image']:'https://st3.depositphotos.com/23594922/31822/v/450/depositphotos_318221368-stock-illustration-missing-picture-page-for-website.jpg';?>"></a></div>

                  <h2 class="hidding_one_middel"><a onclick="getSingleblog('<?php echo $val['id'];?>')"><?php echo $val['title'];?> </a></h2>
                <div class="content_ptag">   <p><?php echo strip_tags($val['content']);?></p></div>
                  <div class="read_more"> <a onclick="getSingleblog('<?php echo $val['id'];?>')">Read More</a> </div>
                 
                </div>
              </div>

        <?php } ?>
              
            </div>
          </div>
				 
		</div>
      </ul>
    </main>
	<script>
 

$(document).ready(function(){

    var limit = <?php echo $limit;?>;
    var start = <?php echo $start;?>;
    var action = 'inactive';

    

    function load_data(limit, start)
    {
	  $.ajax({
        url:"<?php echo base_url(); ?>/user/blogUserLoadMore",
        method:"POST",
        data:{limit:limit, start:start},
        cache: false,
        success:function(data)
        {
          if(data == '')
          {
            //$('#load_data_message').html('<h3>No More Result Found</h3>');
            action = 'active';
          }
          else
          {
            $('#load_data').append(data);
            //$('#load_data_message').html("");
            action = 'inactive';
          }
        }
      })
    }

    if(action == 'inactive')
    {
      action = 'active';
      load_data(limit, start);
    }

    $(window).scroll(function(){

      if($(window).scrollTop() + $(window).height()+100 > $("#load_data").height() && action == 'inactive'){
   
        action = 'active';
        start = start + limit;
        setTimeout(function(){
          load_data(limit, start);
        }, 1000);
      }
    });

  });	
 </script>
  <?php echo  $this->endSection(); ?>