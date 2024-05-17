<?php 
echo  $this->extend('user/templates/newsTemplete');
echo  $this->section('content');
?>

  <main class="main-feed">
      <ul class="main-feed-list">
        <div class="notfy">
           <?php echo  $this->include('user/templates/notf_header_template'); ?>
        </div>

        <div class="news_page">
          <div class="hadding_main">News</div>
          <div style="display:none" class="subhadding_news"><h2><a data-toggle="modal" data-target="#addNewsModal" href="">Add News</a></h2></div>
          <div class="global_news">
            <div class="row">
              <div class="col-md-6">
                <?php 
                if(count($news_latest)!=0)
      {
		 
      ?>
                <div class="main_news onenews_page_post">
                  
                  <div class="main_images"> <a href="<?php echo base_url();?>/user/news/details/<?php echo $news_latest['id'];?>"><img src="<?php echo base_url().'/'.$news_latest['image'];?>"> </a></div>


                  <div class="main_news_text">
                    <div class="td-module-meta-info"> <div class="top_category_name"> <a href="<?php echo base_url();?>/user/news/details/<?php echo $news_latest['id'];?>" class="td-post-category"><?php echo $news_latest['category_name'];?></a><div class="td-editor-date"> <span class="td-author-date"> <span class="td-post-author-name"> - <a href="<?php echo base_url();?>/user/news/details"> <?php 
					  if(!empty($news_latest['user_name'])){
						echo $news_latest['user_name'];  
					  }else{
						  echo "Admin";
					  }
					  
					  
					  ?></a> 
					  
					  <span>-</span> </span> <span class="td-post-date">
                        <time class="entry-date updated td-module-date" > <?php echo date('M d,Y',strtotime($news_latest['created_at']));?></time>
                        </span> </span> </div> </div>
                      <h3 class="entry-title td-module-title"><a href="<?php echo base_url();?>/user/news/details/<?php echo $news_latest['id'];?>" rel="bookmark" title="Witnessing the Birth of the New Coronavirus Economy"><?php echo $news_latest['title'];?></a></h3>
                      
                      <div class="td-excerpt"> <?php echo substr($news_latest['content'],0,200) ?></div>
                    </div>
                  </div>
                </div>
              </div>

        <?php } ?>
              <div class="col-md-6">
                <div class="main_news">
                  <div class="side_news">
        <?php
           foreach($news as $val){
        ?>

                    <div class="side_news_one">
                      <div class="side_news_images"><a href="<?php echo base_url();?>/user/news/details/<?php echo $val['id'];?>"> <img src="<?php echo base_url().'/'.$val['image'];?>"></a> </div>
                      <div class="side_news_text">
                        <div class="td-module-meta-info">
                          <h3 class="entry-title td-module-title"><a href="<?php echo base_url();?>/user/news/details/<?php echo $val['id'];?>" rel="bookmark"  ><?php echo $val['title'];?></a></h3>
                          <div class="td-editor-date"> <span class="td-author-date"> <span class="td-post-date">
                            <time class="entry-date updated td-module-date" ><?php echo date('M d,Y ',strtotime($val['created_at']));?></time>
                            </span> </span> </div>
                        </div>
                      </div>
                    </div>
               <?php } ?>


                  </div>
                </div>
              </div>
            </div>
            
            <div class="travel_div">
            <div class="td-block-title-wrap"><h4 class="td-block-title"><span>Travel Guides</span></h4></div>
            
            <div class="travel_div_btm">

               <?php
			   
           foreach($news_traval_guide as $val){
        ?>
            <div class="travel_div_btm_one">
            <div class="travel_div_btm_images">
           <a href="<?php echo base_url();?>/user/news/details/<?php echo $val['id'];?>"> <img src="<?php echo base_url().'/'.$val['image'];?>"></a>
            <div class="text_travel">
            <div class="td-module-meta-info"> <a href="<?php echo base_url();?>/user/news/details/<?php echo $val['id'];?>" class="td-post-category">Travel</a>
  <h3 class="entry-title td-module-title"><a href="<?php echo base_url();?>/user/news/details/<?php echo $val['id'];?>" rel="bookmark" ><?php echo $val['content'];?></a></h3>
</div>
            </div>
            </div>
            </div>

        <?php } ?>

            </div>
            
            
            </div>
            
            <div class="gadgets_news">
            <div class="row">
              <div class="col-md-6">
              
               <div class="td-block-title-wrap"><h4 class="td-block-title"><span>Gadgets</span></h4></div>
           <?php 
                if(count($getlatestGadgatnews)!=0)
      {
      ?>
                <div class="main_news onenews_page_post">
                  <div class="main_images"> <a href="<?php echo base_url();?>/user/news/details/<?php echo $getlatestGadgatnews['id'];?>"> <img src="<?php echo base_url().'/'.$getlatestGadgatnews['image'];?>"></a> </div>
                  <div class="main_news_text">
                    <div class="td-module-meta-info"> 
                    <div class="top_category_name">
                    <a href="<?php echo base_url();?>/user/news/details/<?php echo $getlatestGadgatnews['id'];?>" class="td-post-category"><?php echo $getlatestGadgatnews['category_name'];?></a><div class="td-editor-date"> <span class="td-author-date"> <span class="td-post-author-name"><a href="<?php echo base_url();?>/user/news/details"><?php 
					  if(!empty($getlatestGadgatnews['user_name'])){
						echo $getlatestGadgatnews['user_name'];  
					  }else{
						  echo "Admin";
					  }
					  
					  
					  ?></a> <span>-</span> </span> <span class="td-post-date">
                        <time class="entry-date updated td-module-date" ><?php echo date('M d,Y ',strtotime($getlatestGadgatnews['created_at']));?></time>
                        </span> </span> </div>
                    
                    </div>
                      <h3 class="entry-title td-module-title"><a href="<?php echo base_url();?>/user/news/details/<?php echo $getlatestGadgatnews['id'];?>" rel="bookmark" > <?php echo $getlatestGadgatnews['title'];?></a></h3>
                      
                      <div class="td-excerpt"><?php echo substr($getlatestGadgatnews['content'],0,100) ?></div>
                    </div>
                  </div>
                </div>
                <?php } ?>
                
                
                <div class="main_news">
                  <div class="side_news">
                  <div class="row"> 
                  
                 <?php
				
           foreach($news_gadgets_guide as $vals){
        ?>
                    <div class="col-md-12">
					<div class="side_news_one">
                      <div class="side_news_images"> <a href="<?php echo base_url();?>/user/news/details/<?php echo $vals['id'];?>"> <img src="<?php echo base_url().'/'.$vals['image'];?>"></a> </div>
                      <div class="side_news_text">
                        <div class="td-module-meta-info">
                          <h3 class="entry-title td-module-title"><a href="<?php echo base_url();?>/user/news/details/<?php echo $vals['id'];?>" rel="bookmark"  ><?php echo $vals['title'];?></a></h3>
                          <div class="td-editor-date"> <span class="td-author-date"> <span class="td-post-date">
                            <time class="entry-date updated td-module-date" ><?php echo date('M d,Y ',strtotime($vals['created_at']));?></time>
                            </span> </span> </div>
                        </div>
                      </div>
                    </div>
</div>

                  <?php } ?>

                    
                  
                 </div>
              </div>
                </div>

              </div>
             <div class="col-md-6">
              
               <div class="td-block-title-wrap"><h4 class="td-block-title"><span>Receipes</span></h4></div>
           <?php 
                if(count($getlatestReceipenews)!=0)
      {
      ?>
                <div class="main_news onenews_page_post">
                  <div class="main_images"> <a href="<?php echo base_url();?>/user/news/details/<?php echo $getlatestReceipenews['id'];?>"> <img src="<?php echo base_url().'/'.$getlatestReceipenews['image'];?>"></a> </div>
                  <div class="main_news_text">
                    <div class="td-module-meta-info"><div class="top_category_name"> <a href="<?php echo base_url();?>/user/news/details/<?php echo $getlatestReceipenews['id'];?>" class="td-post-category"><?php echo $getlatestReceipenews['category_name'];?></a><div class="td-editor-date"> <span class="td-author-date"> <span class="td-post-author-name"><a href="<?php echo base_url();?>/user/news/details/<?php echo $getlatestReceipenews['id'];?>">
					  <?php 
					  if(!empty($getlatestReceipenews['user_name'])){
						echo $getlatestReceipenews['user_name'];  
					  }else{
						  echo "Admin";
					  }
					  
					  
					  ?></a> <span>-</span> </span> <span class="td-post-date">
                        <time class="entry-date updated td-module-date" ><?php echo date('M d,Y ',strtotime($getlatestReceipenews['created_at']));?></time>
                        </span> </span> </div> </div>
                      <h3 class="entry-title td-module-title"><a href="<?php echo base_url();?>/user/news/details/<?php echo $getlatestReceipenews['id'];?>" rel="bookmark" > <?php echo $getlatestReceipenews['title'];?></a></h3>
                      
                      <div class="td-excerpt"><?php echo substr($getlatestReceipenews['content'],0,100) ?></div>
                    </div>
                  </div>
                </div>
                <?php } ?>
                
                
                <div class="main_news">
                  <div class="side_news">
                  <div class="row"> 
                  
                 <?php
				
           foreach($news_receipes_guide as $vals){
        ?>
                    <div class="col-md-12">
					<div class="side_news_one">
                      <div class="side_news_images"> <a href="<?php echo base_url();?>/user/news/details/<?php echo $vals['id'];?>"> <img src="<?php echo base_url().'/'.$vals['image'];?>"></a> </div>
                      <div class="side_news_text">
                        <div class="td-module-meta-info">
                          <h3 class="entry-title td-module-title"><a href="<?php echo base_url();?>/user/news/details/<?php echo $vals['id'];?>" rel="bookmark"  ><?php echo $vals['title'];?></a></h3>
                          <div class="td-editor-date"> <span class="td-author-date"> <span class="td-post-date">
                            <time class="entry-date updated td-module-date" ><?php echo date('M d,Y ',strtotime($vals['created_at']));?></time>
                            </span> </span> </div>
                        </div>
                      </div>
                    </div>
</div>

                  <?php } ?>

                    
                  
                 </div>
              </div>
                </div>

              </div>
            </div>
            </div>
          </div>
        </div>
      </ul>
      <span id="showmodel" style="display:none"></span> 
    </main>
		
    <?php echo  $this->endSection(); ?>
     <span id="showmodel" style="display:none"></span> 