<?php echo  $this->extend('user/templates/event_template');
$public_url=base_url()."/public/frontend/";
$baseurl=base_url()."/";
 ?>

<?php echo  $this->section('content'); ?>	
<main class="main-feed">
     <section class="middle_wraper">
    <div class="middle_bg">
      <div class="event_bx">
        <div class="container_user">
          <div class=" main">
            <div class="row" style="margin-right: 0;margin-left: 0;">
            
              
              <!--col-sm-6-->
              
              <div class="col-md-12 col-sm-6 col--12 right-side">
              
              <?php if(session()->getFlashdata('msgevent')):?>
                    <div class="alert alert-success">
                       <p><?= session()->getFlashdata('msgevent') ?></p>
                    </div>
      <?php endif;?>
                <h2><a href="<?php echo base_url();?>/user/event">Events</a></h2>
				<h2>Event Add </h2>
                 
                <!--Form with header-->
                <div class="form">
				
<form action="<?php echo base_url('user/event/insert-event');?>" method="post" enctype="multipart/form-data" id="eventForm" name="eventForm" onsubmit="return submitEventForm()">                  <div class="form-group">
                    <label>Category</label>
					<select name="category" id="category" class="form-control-event">
					  <option value="">Select Category</option>
					<?php
                     foreach($event_cats as $val){
					?>
					<option value="<?php echo $val['id'];?>"><?php echo $val['name'];?></option>
                    <?php					
					}
					?>
					</select>
                  </div>
				  <div class="form-group">
				   <label>Name</label>
                    <input type="hidden" id="video" name="video" class="form-control-event" placeholder="Video" >
                    <input type="text" id="name" name="name" class="form-control-event" placeholder="Event Name" >
                  </div>
                  <div class="form-group">
                    <label>Location</label>
					<input type="text" id="location" name="location" class="form-control-event" placeholder="Event Location" >
                  </div>
				  <div class="form-group">
				  <label>Event Start Date</label>
                    <input type="date" id="event_start_date" name="event_start_date" class="form-control-event" placeholder="Event Start Date" >
                  </div>
				  <div class="form-group">
                    <label>Event Start Time (H:M AM/PM)</label>
					<input type="time" id="event_start_time" name="event_start_time" class="form-control-event" placeholder="Event Start Time" >
                  </div>
				  <div class="form-group">
				  <label>Event End Date</label>
                    <input type="date" id="event_end_date" name="event_end_date" class="form-control-event" placeholder="Event End Date" >
                  </div>
				  <div class="form-group">
				  <label>Event End Time (H:M AM/PM)</label>
                    <input type="time" id="event_end_time" name="event_end_time" class="form-control-event" placeholder="Event End Time" >
                  </div>
				  <div class="form-group">
				  <label>Image</label>
                    <input type="file" id="image" name="image" class="form-control-event" placeholder="Event Image" >
                  </div>
				  <div class="form-group">
				  <label>Details</label>
                    <textarea  id="details" name="details" class="form-control-event" placeholder="Description"></textarea>
                  </div>
                  <div class="text-xs-center"> 
				 <a  class="btn loginbutton "> <input style="background:none;border:none;color:#fff" type="submit" name="submit" id="submit" value="Submit"><span>
				    <img style="display:inline" src="<?php echo $public_url;?>images/back_arrow.svg" alt="img">
				  </span></a>
				  </div>
				  </form>
                  
                </div>
                <!--/Form with header--> 
                
              </div>
              <!--col-sm-6-->
              
             
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
    </main>
	<style>
	label {
  display: inline-block !important;
  margin-bottom: 5px !important;
  font-weight: 700 !important;
  font-size: 18px !important;
}
	</style>
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
    