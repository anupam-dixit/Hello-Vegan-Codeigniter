<?php echo  $this->extend('user/templates/event_template');
$public_url=base_url()."/public/frontend/";
$baseurl=base_url()."/";
 ?>

<?php echo  $this->section('content');
/* echo "<pre>";
print_r($event_details);
echo "</pre>";
die; */
 ?>	
  <main class="main-feed">
      <ul class="main-feed-list">
        <div class="notfy">
          <ul>
            <li>
              <div class="icon-container ButtonGroup" ><a href="#"> <img src="<?php echo $public_url;?>images/notification_b.png" /> <img src="<?php echo $public_url;?>images/notification.png" /> <span class="Button-badge">2</span> </a> </div>
            </li>
            <li>
              <div class="icon-container"><a href="#"> <img src="<?php echo $public_url;?>images/chat_b.png" /> <img src="<?php echo $public_url;?>images/chat.png" /> </a> </div>
            </li>
          </ul>
        </div>
        <div class="news_page">
          <div class="hadding_main_details"><?php echo $event_details['name'];?></div>
           <div class="">
           <h2 class="event_page_ddd"><a href="<?php echo base_url();?>/user/event/category/<?php echo $event_details['category'];?>"><?php echo $event_details['category_name'];?></a></h2>
            <div class="loc_event"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $event_details['location'];?></div>
            <div class="date_event"><?php echo date('M d,Y h:i a',strtotime($event_details['event_start_date']));?></div>
            <div class="blog_images">
			<?php 
			if(!empty($event_details['image'])){
			?>	
			<img src="<?php echo $baseurl.$event_details['image'];?>">
			<?php 
			}
			?>
			</div>
            
            <?php echo $event_details['details'];?>
            <div class="tribe-events-single-section tribe-events-event-meta primary tribe-clearfix">
  <div class="tribe-events-meta-group tribe-events-meta-group-details">
    <h2 class="tribe-events-single-section-title"> Details </h2>
    <dl>
    <dt class="tribe-events-end-date-label"> Address: </dt>
      <dd> <abbr class="tribe-events-abbr tribe-events-end-date dtend" title="2022-01-04"> <?php echo $event_details['location'];?> </abbr> </dd>
      <dt class="tribe-events-start-date-label"> Start: </dt>
       <dd> <abbr class="tribe-events-abbr tribe-events-start-date published dtstart" title="2021-12-15"> <?php echo date('M d,Y h:i a',strtotime($event_details['event_start_date']));?></abbr> </dd>
      <dt class="tribe-events-end-date-label"> End: </dt>
      <dd> <abbr class="tribe-events-abbr tribe-events-end-date dtend" title="2022-01-04"> <?php echo date('M d,Y h:i a',strtotime($event_details['event_end_date']));?> </abbr> </dd>
      <dt class="tribe-events-event-categories-label">Event Category:</dt>
      <dd class="tribe-events-event-categories"><a href="<?php echo base_url();?>/user/event/category/<?php echo $event_details['category'];?>" rel="tag"><?php echo $event_details['category_name'];?></a></dd>
    </dl>
  </div>
  <div class="tribe-events-meta-group tribe-events-meta-group-organizer">
    <h2 class="tribe-events-single-section-title">Organizer</h2>
    <dl>
      <dt style="display:none;"></dt>
      <dd class="tribe-organizer"> <?php 
	  if($event_details['user_name']==''){
		 echo $event_details['au_user_name']; 
	  }else{
		echo $event_details['user_name'];  
	  }
	  ?> </dd>
      <dt class="tribe-organizer-tel-label"> Phone: </dt>
      <dd class="tribe-organizer-tel"> <?php 
	  echo $event_details['user_phone'];
	  if($event_details['user_phone']==''){
		 echo ''; 
	  }else{
		echo $event_details['user_phone'];  
	  }
	  ?>  </dd>
      <dt class="tribe-organizer-email-label"> Email: </dt>
      <dd class="tribe-organizer-email"> <?php 
	  if($event_details['user_email']==''){
		 echo $event_details['au_user_email']; 
	  }else{
		echo $event_details['user_email'];  
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