<?php echo  $this->extend('admin/templates/event_template'); ?>

<?php echo  $this->section('content'); ?>
<div class="content-wrapper">
<section class="content-header">
      <h1>
         Add Event
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>admin/event/list"><i class="fa fa-dashboard"></i> Events</a></li>
        <li class="active">Add New</li>
      </ol>
    </section>
	
	

    <!-- Main content -->
    <section class="content">
 <div class="box box-default">
  <div class="box-header">
   <h3 class="box-title"></h3>
  </div>
   
    <form action="<?php echo base_url('admin/event/insert-event');?>" method="post" enctype="multipart/form-data">		  
 	   <div class="box-body">
	    <?php 
		$name='';
		if(session()->getFlashdata('msg')):?>
                    <div class="alert alert-danger" style="width:32%">
                       <?= session()->getFlashdata('msg') ?>
                    </div>
      <?php $name=session()->getFlashdata('event_category_name') ?>
	  <?php endif;?>
           <div class="col-sm-12">
		   <div class="col-sm-6">
		   <div class="form-group">
             <label>Category</label>
               <select  id="category" name="category" class="form-control">
			   <option >Select Category</option>
			  <?php 
				  foreach($event_cats as $val){
			      ?>
				  <option  
				  value="<?php echo $val['id'];?>"><?php echo $val['name'];?></option>
                  <?php
                  }				  
                  ?>	
			  </select>
			</div>
		   </div>
		   <div class="col-sm-6">
		   <div class="form-group">
             <label>Posted By</label>
               <select  id="posted_by" name="posted_by" class="form-control">
			   <option value="0" >Admin</option>
			  <?php 
				  foreach($event_users as $val){
			      ?>
				  <option  
				  value="<?php echo $val['id'];?>"><?php echo $val['name'];?></option>
                  <?php
                  }				  
                  ?>	
			  </select>
			</div>
		   </div>
		   </div>
		   
		   <div class="col-sm-12">
		   <div class="col-sm-6">
		   <div class="form-group">
             <label>Name</label>
              <input type="text"  id="name" name="name" class="form-control" placeholder="Name" value="">
			</div>
		   </div>
		   <div class="col-sm-6">
		   <div class="form-group">
             <label>Location</label>
              <input type="text"  id="location" name="location" class="form-control" placeholder="Location" value="">
			</div>
		   </div>
		  
		   
		   </div>
		   
		   
		   <div class="col-sm-12">
		   <div class="col-sm-6">
		   <div class="form-group">
             <label>Event Start Date</label>
           
			  <input type="date"  id="event_start_date" name="event_start_date" class="form-control" placeholder="Event Start Date" value="">
			 
			</div>
		   </div>
		   <div class="col-sm-6">
		   <div class="form-group">
             <label>Event Start Time (H:M AM/PM)</label>
           
			 
			  <input type="time"  id="event_start_time" name="event_start_time" class="form-control" placeholder="Event Start Time" value="">
			</div>
		   </div>
		   
		   </div>
		   <div class="col-sm-12">
		   <div class="col-sm-6">
		   <div class="form-group">
             <label>Event End Date</label>
           
			  <input type="date"  id="event_end_date" name="event_end_date" class="form-control" placeholder="Event End Date" value="">
			 
			</div>
		   </div>
		   <div class="col-sm-6">
		   <div class="form-group">
             <label>Event End Time (H:M AM/PM)</label>
           
			 
			  <input type="time"  id="event_end_time" name="event_end_time" class="form-control" placeholder="Event End Time" value="">
			</div>
		   </div>
		   
		   </div>
		   <div class="col-sm-12">
		   <div class="col-sm-6">
		   <div class="form-group">
             <label>Image</label>
              <input type="file"  id="image" name="image" class="form-control" placeholder="Image" value="">
			</div>
		   </div>
		   <div class="col-sm-6">
		   <div class="form-group">
             <label>Video Url</label>
              <input type="text"  id="video" name="video" class="form-control" placeholder="Video" value="">
			</div>
		   </div>
		   </div>
		   <div class="col-sm-12">
		   
		   <div class="form-group">
             <label>Details</label>
              <textarea  id="details" name="details" class="form-control" placeholder="Description"></textarea>
			</div>
		  
		   </div>
		 
			<div class="col-sm-6">
			 <button type="submit" class="btn btn-primary">Submit</button>
			 </div>	
	   </div>

    </form>
   
  </div>

 </section>
</div>
<?php
$key="AIzaSyBlf2VfOx5bL5rwlTP4hG5luZxZaLV6xEI";
$googleWeb="https://maps.googleapis.com/maps/api/js";
$googleAddress=$googleWeb."?key=".$key."&libraries=places&callback=initMap";
?>
<script src="<?php echo $googleAddress;?>"   async defer></script>
<script>
function initMap() {
  var input = document.getElementById('location');
  // var autocomplete = new google.maps.places.Autocomplete(input);
}
var states = [];
$(function () {
    $("#location").autocomplete({
        source:[
            function( q,add ){
                $.getJSON("https://api.geoapify.com/v1/geocode/autocomplete?text="+$("#location").val()+"&apiKey=4b4676202e27484ca2c582be307ec5c5",function(resp){
                    d=resp.features.map(obj=>obj.properties.address_line2).filter(address_line2 => address_line2 !== undefined)
                    console.log(d)
                    add(d)
                })
            }
        ]
    });
});
</script>
<?php echo  $this->endSection(); ?>
