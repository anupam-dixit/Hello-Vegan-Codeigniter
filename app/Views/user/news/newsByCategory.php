<?php 
echo  $this->extend('user/templates/newsTemplete');
echo  $this->section('content');
 ?>

<?php  ?>
    <main class="main-feed">
      <ul class="main-feed-list">
        <div class="notfy">
           <?php echo  $this->include('user/templates/notf_header_template'); ?>
        </div>


        <div class="news_page">
		<?php 
		if(isset($news[0])){
		?>
        <div class="hadding_main"><?php echo $news[0]['category_name'];?></div>
        <div class="subhadding_news"></div>
        <div class="global_news">
          <div class="gadgets_news">
            <div class="row">
              <div class="col-md-12">
                <?php /*?><div class="td-block-title-wrap">
                  <h4 class="td-block-title"><span><?php echo $news[0]['category_name'];?></span></h4>
                </div><?php */?>
                <div class="main_news">
                  <div class="row">
                    <?php 
					if(count($news)!=0){
						foreach($news as $val){
							
						
						?>
					<div class="col-md-6">
                      <div class="main_news category_pagenews onenews_page_post">
                        <div class="main_images"> <img src="<?php echo base_url().'/'.$val['image'];?>"> </div>
                        <div class="main_news_text">
                          <div class="td-module-meta-info">
                          <div class="top_category_name">
                           <a href="<?php echo base_url();?>/user/news/details/<?php echo $val['id'];?>" class="td-post-category"><?php echo $val['category_name'];?></a>
                          
                             
                            <div class="td-editor-date"> <span class="td-author-date"> <span class="td-post-author-name"><a href="<?php echo base_url();?>/user/news/details/<?php echo $val['id'];?>"><?php 
					  if(!empty($val['user_name'])){
						echo $val['user_name'];  
					  }else{
						  echo "Admin";
					  }
					  
					  
					  ?></a> <span>-</span> </span> <span class="td-post-date">
                              <time class="entry-date updated td-module-date" ><?php echo date('M d,Y ',strtotime($val['created_at']));?></time>
                              </span> </span> </div>
                              </div>
                            
                            <h3 class="entry-title td-module-title"><a href="<?php echo base_url();?>/user/news/details/<?php echo $val['id'];?>" rel="bookmark" title="<?php echo $val['title'];?>"><?php echo $val['title'];?></a></h3>
                            
                            <div class="td-excerpt"><?php echo $val['content'];?></div>
                          </div>
                        </div>
                      </div>
                    </div>
					<?php
                      }					
					}
					?>
					
                 </div>
                </div>
              </div>
            </div>
          </div>
        </div>
		<?php 
		}
		?>
      </div>
     
      </ul>
    </main>
	
 <div class="modal fade" id="addNewsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
  <form action="<?php echo base_url('user/news/insert-news');?>" method="post" enctype="multipart/form-data" id="newsForm" name="newsForm"> 
    <div class="modal-content model_add_event">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add News</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="row" style="margin-right: 0;margin-left: 0;">
            
              
              <!--col-sm-6-->
              
              <div class="col-md-12 col-sm-6 col--12 right-side">
              
              <?php if(session()->getFlashdata('msgnews')):?>
                    <div class="alert alert-success">
                       <p><?= session()->getFlashdata('msgnews') ?></p>
                    </div>
      <?php endif;?>
          
                 
                <!--Form with header-->
                <div class="form">
				<div class="form-group">
                    <label>Topic</label>
					<select name="post_category_id" id="post_category_id" class="form_control_event">
					  <option value="">Select Topic</option>
					<?php
                     foreach($news_category as $val){
					?>
					<option value="<?php echo $val['id'];?>"><?php echo $val['name'];?></option>
                    <?php					
					}
					?>
					</select>
                  </div>
 
				  <div class="form-group">
				   <label>Title</label>
                    <input type="hidden" id="video" name="video" class="form_control_event" placeholder="Video" >
                    <input type="text" id="title" name="title" class="form_control_event" placeholder="Title" >
                  </div>
                  <div class="form-group">
                    <label>Location</label>
					<input type="text" id="location" name="location" class="form_control_event" placeholder="Location" >
                  </div>
				  
				  <div class="form-group">
				  <label>Image</label>
                    <input type="file" id="image" name="image" class="form_control_event" placeholder="Image" >
                  </div>
				  <div class="form-group">
				  <label>Details</label>
                    <textarea  id="details" name="details" class="form_control_event" placeholder="Description"></textarea>
                  </div>
                  <div class="text-xs-center"> 
				 <a  class="btn loginbutton "> <input style="background:none;border:none;color:#fff" type="submit" name="submit" id="submit" value="Submit"><span>
				    <img style="display:inline" src="<?php echo base_url().'/public/frontend/';?>images/back_arrow.svg" alt="img">
				  </span></a>
				  </div>
			
                  
                </div>
                <!--/Form with header--> 
                
              </div>
              <!--col-sm-6-->
              
             
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="sumbit_event close_event" data-dismiss="modal">Close</button> &nbsp;  &nbsp;
        <button type="submit" class="sumbit_event">Save changes</button>
      </div>
    </div>
		  </form>
  </div>
</div>
<div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog modal-sm">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" onclick="location.reload()" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="document_name">Message</h4>
        </div>
        <div class="modal-body">
                 <div id="ErrorMessage" style="text-align:center;margin-bottom:13px;">
                     
                </div>
         </div>
        <div class="modal-footer">
          <button type="button" onclick="location.reload()" class="sumbit_event close_event" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  <div id="loader"></div> 
  <?php
$key="AIzaSyBlf2VfOx5bL5rwlTP4hG5luZxZaLV6xEI";
$googleWeb="https://maps.googleapis.com/maps/api/js";
$googleAddress=$googleWeb."?key=".$key."&libraries=places&callback=initMap";
?>
<script src="<?php echo $googleAddress;?>"   async defer></script>
<script>
function initMap() {
  var input = document.getElementById('location');
  var autocomplete = new google.maps.places.Autocomplete(input);
}
</script>	
    <?php echo  $this->endSection(); ?>