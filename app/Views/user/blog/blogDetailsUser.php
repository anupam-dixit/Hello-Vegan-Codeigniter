<?php echo  $this->extend('user/templates/blog_template');?>
<?php echo  $this->section('content'); ?> 

        <main class="main-feed">
      <ul class="main-feed-list">
         <div class="notfy">
         <?php echo  $this->include('user/templates/notf_header_template'); ?>
        </div>
        <div class="news_page">
          <div class="hadding_main_details"><?php echo $blog_details['title'];?></div>
           <div class="">
           <h2 class="event_page_ddd"><a href="#"><?php echo $blog_details['category_name'];?></a></h2>
            <div class="loc_event"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $blog_details['location'];?></div>
            <div class="date_event"><?php echo date('M d,Y h:i a',strtotime($blog_details['created_at']));?></div>
            <div class="blog_images">
                  <?php 
                  if(!empty($blog_details['image'])){
                  ?>    
                  <img src="<?php echo base_url().'/'.$blog_details['image'];?>">
                  <?php 
                  }
                  ?>
                  </div>
            
            <?php echo $blog_details['content'];?>
            <div class="tribe-events-single-section tribe-events-event-meta primary tribe-clearfix">
  <div class="tribe-events-meta-group tribe-events-meta-group-details">
    <h2 class="tribe-events-single-section-title"> Details </h2>
    <dl>
    <dt class="tribe-events-end-date-label"> Address: </dt>
      <dd> <abbr class="tribe-events-abbr tribe-events-end-date dtend" title="2022-01-04"> <?php echo $blog_details['location'];?> </abbr> </dd>
    
    </dl>
  </div>
  <div class="tribe-events-meta-group tribe-events-meta-group-organizer">
    <h2 class="tribe-events-single-section-title">Organizer</h2>
    <dl>
      <dt style="display:none;"></dt>
      <dd class="tribe-organizer"> <?php 
        if($blog_details['user_name']==''){
             echo $blog_details['au_user_name']; 
        }else{
            echo $blog_details['user_name'];  
        }
        ?> </dd>
      <dt class="tribe-organizer-tel-label"> Phone: </dt>
      <dd class="tribe-organizer-tel"> <?php 
        echo $blog_details['user_phone'];
        if($blog_details['user_phone']==''){
             echo ''; 
        }else{
            echo $blog_details['user_phone'];  
        }
        ?>  </dd>
      <dt class="tribe-organizer-email-label"> Email: </dt>
      <dd class="tribe-organizer-email"> <?php 
        if($blog_details['user_email']==''){
             echo $blog_details['au_user_email']; 
        }else{
            echo $blog_details['user_email'];  
        }
        ?> </dd>
      
    </dl>
  </div>
</div> 
          </div>
           
        </div>
 
      </ul>
  </main>
<?php echo  $this->endSection(); ?>
