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
          <div class="hadding_main_details"><?php echo $news_details['title'];?></div>

          <div class="post_details_news_page">
            <div class="tdb-block-inner td-fix-index"> <a class="tdb-author-photo" href="#" title="David Lee"><img src="<?php echo base_url().'/'.$news_details['image'];?>"> </a>
              <div class="tdb-author-name-wrap"><span class="tdb-author-by">By</span> <a class="tdb-author-name" href="#">David Lee</a></div>
            </div>
            <div class="tdb-block-inner td-fix-index">
              <time class="entry-date updated td-module-date" ><?php echo $news_details['updated_at'];?></time>
            </div>
            <div class="comm_and_view">
              <div class="commemt"> <span><i class="fa fa-eye" aria-hidden="true"></i> </span>
                <p><?php echo $news_details['views_count'];?></p>
              </div>
              <div class="commemt"> <span><i class="fa fa-comments-o" aria-hidden="true"></i> </span>
                <p><?php echo count($new_comment);?></p>
              </div>
            </div>
          </div>
         

          <div class="news_details_page"> <img src="<?php echo base_url().'/'.$news_details['image'];?>">

            
            
            <div class="sub_hadding"><h2><?php echo substr($news_details['content'],0,50) ?></h2></div>
            <p><?php echo substr($news_details['content'],50,200) ?></p>

            <?php 
            
                if(!empty($news_details['galleryimage']))
      {
     
      ?>

             <img src=" <?php 
                  $ex=explode(",",$news_details['galleryimage']);
                
                echo base_url().'/'.$ex[0];
             

                      ?>">
            <?php } ?>

          
           <p><?php echo substr($news_details['content'],200,450) ?></p>
          

<?php 
                  
                 if(!empty($news_details['galleryimage'])){

       ?>

            <section class="slider-section">
             <!--  <div id="carousel" class="carousel slide" data-ride="carousel"> -->
                <!-- <div class="carousel-inner" role="listbox"> -->
                   
                 <!--  <div class="carousel-item active"> -->
                     <div id="owl-demo" class="owl-carousel  owl-theme">
                   <!--  <div class="row">
 -->
                       



                      <?php 
                  $ex=explode(",",$news_details['galleryimage']);
              
              foreach($ex as $val){
                 if(!empty($val)){

                      ?>
                    
                     
                         <div class="item col-md-14"><img src="<?php echo base_url().'/'.$val ?>" width="150" height="200"> </div>
                          

                     

                    <?php } } ?>
                   

               </div>
              <!-- End of Carousel --> 
            </section>

 <?php }  ?>

            <p><?php echo substr($news_details['content'],450,600) ?>
            </p>

        <?php 
                  
                 if(!empty($news_details['videofile'])){

       ?>

            <video id="my-video" class="video-js" controls preload="auto" poster="<?php echo base_url().'/'.$news_details['videofile'];?>" data-setup='' loop>
              <source src="<?php echo base_url().'/'.$news_details['videofile'];?>" type='video/mp4'>
            </video>
        <?php } else if(!empty($news_details['videourl'])){ ?>

          <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="<?php echo $news_details['videourl'];?>" allowfullscreen></iframe>
            </div>


        <?php } ?>
           <p><?php echo substr($news_details['content'],600,1550) ?>
            </p>
          </div>
        </div>
        <div class="news_page_share" >
          <div class="fluid" style="display:none"><a class="btn btn-sm btn-social-outline btn-share-outline" href="#" target="_blank" title=""> <i class="fa fa-share-alt"></i><p> Share </p></a> <a class="btn btn-sm btn-social-outline btn-fb-outline" href="#" target="_blank" title=""> <i class="fa fa-facebook"></i> <p>Facebook </p></a> <a class="btn btn-sm btn-social-outline btn-tw-outline" href="#" target="_blank" title=""> <i class="fa fa-twitter"></i> <p>Tweet </p></a> <a class="btn btn-sm btn-social-outline btn-in-outline" href="#" target="_blank" title=""> <i class="fa fa-pinterest-p" data-fa-transform="grow-2"></i><p> Pinterest</p></a> <a class="btn btn-sm btn-social-outline btn-gp-outline" href="#" target="_blank" title=""> <i class="fa fa-whatsapp" aria-hidden="true"></i> <p> WhatsApp</p></a> </div>
        </div>
        
        
        
        
        <div class="comment_box">
        
         <?php
		 if(count($new_comment)!=0){
        foreach($new_comment as $val){
			
        ?>
         <div class="tdb-author-box td_block_wrap tdb_single_author_box tdb-content-vert-top td-pb-border-top td_block_template_1 " data-td-block-uid="tdi_147">
   <div class="tdb-block-inner td-fix-index commentnews "><a href="#" class="tdb-author-photo comment_news" title="<?php echo $val['user_name'];?>">
   
    <img src="<?php echo base_url().'/'.$val['user_photo'];?>"  class="avatar avatar-96 wp-user-avatar wp-user-avatar-96 alignnone photo ls-is-cached lazyloaded" data-src="<?php echo base_url().'/'.$val['user_photo'];?>">
    
    </a>
	<div class="tdb-author-info"><a href="#" class="tdb-author-name"><?php echo $val['user_name'];?></a> 
      <div class="tdb-author-descr"><?php echo $val['message'];?>
           
      </div>
     </div>
		</div>
		</div>

<?php 			
		}
			} ?>

        


<div class="view_comment_page">
<a href="#" style="display:none">View Comment</a>

</div>
        
        </div>
        <div class="tdb-block-inner td-fix-index">
  <div class="comments" id="comments">
    <div id="respond" class="comment-respond">
      <h3 id="reply-title" class="comment-reply-title">LEAVE A REPLY <small><a rel="nofollow" id="cancel-comment-reply-link" href="#" style="display:none;">Cancel reply</a></small></h3>

      <form action="<?php echo base_url('user/news/post/insert-comment');?>" method="post" enctype="multipart/form-data" id="commentform"  class="comment-form" novalidate="">


        <div class="clearfix"></div>
        <div class="comment-form-input-wrap td-form-author"> <label for="comment" class="is-visually-hidden">Comment:</label>
          <textarea placeholder="Comment:" id="message" name="message" cols="120" rows="8" aria-required="true"></textarea>
         
         
        </div>


        <div class="comment-form-input-wrap td-form-author"> 
         <input type="hidden" class="" id="user_id" name="user_id"  value="<?php echo $_SESSION['idUserH'] ?>" size="30" aria-required="true">
           </div>
        <div class="comment-form-input-wrap td-form-email">
          <input type="hidden" class="" id="post_id" name="post_id"  value="<?php echo $news_details['id'];?>" size="30" aria-required="true">
          <input type="hidden" name="comment_id" value="0">
        </div>
       <!--  <div class="comment-form-input-wrap td-form-url"><label for="url" class="is-visually-hidden">Website:</label>
          <input class="" id="url" name="url" placeholder="Website:" type="text" value="" size="30">
          
        </div> -->
        
        <p class="form-submit">
          <input name="submit" type="submit" id="submit" class="submit" value="Post Comment"> 
        </p>
      </form>
    </div>
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
        
        
      </ul>
    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <?php echo  $this->endSection(); ?>