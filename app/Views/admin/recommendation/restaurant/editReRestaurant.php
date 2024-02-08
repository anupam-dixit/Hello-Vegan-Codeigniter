<?php echo  $this->extend('admin/templates/restaurant_template'); ?>

<?php echo  $this->section('content'); ?>
<div class="content-wrapper">
<section class="content-header">
      <h1>
         Update Restaurant 
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>admin/recommendation/restaurants"><i class="fa fa-dashboard"></i> Restaurants</a></li>
        <li class="active">Update</li>
      </ol>
    </section>
	
	

    <!-- Main content -->
    <section class="content">
 <div class="box box-default">
  <div class="box-header">
   <h3 class="box-title"></h3>
  </div>
   
    <form action="<?php echo base_url('admin/recommendation/restaurant/update-restaurant');?>" method="post" enctype="multipart/form-data">		
<input type="hidden" name="id" value="<?php echo $rerestaurant['id'];?>">	
 	   <div class="box-body">
	    <?php 
		$name='';
		if(session()->getFlashdata('msg')):?>
                    <div class="alert alert-danger" style="width:32%">
                       <?= session()->getFlashdata('msg') ?>
                    </div>
      <?php $name=session()->getFlashdata('rc_name') ?>
	  <?php endif;?>
	  
           <div class="col-sm-12">
		   <div class="col-sm-6">
		   <div class="form-group">
             <label>Category</label>
               <select  id="category" name="category_id" class="form-control">
			   <option >Select Category</option>
			  <?php 
			 
				  foreach($recats as $val){
					  $sel='';
					  if($rerestaurant['category_id']==$val['id']){
						$sel='selected="selected"';  
					  }
			      ?>
				  <option <?php echo $sel;?>  
				  value="<?php echo $val['id'];?>"><?php echo $val['name'];?></option>
                  <?php
                  }				  
                  ?>	
			  </select>
			</div>
		   </div>
		    <div class="col-sm-6">
		   <div class="form-group">
             <label>Restaurant  Name</label>
              <input type="text"  id="name" name="name" class="form-control" placeholder="Name" value="<?php echo $rerestaurant['name'];?>">
			</div>
		   </div>
		   </div>
		   
		   <div class="col-sm-12">
		  
		   <div class="col-sm-6">
		   <div class="form-group">
             <label>Contact No</label>
              <input type="text"  id="contact_no" name="contact_no" class="form-control" placeholder="Contact No" value="<?php echo $rerestaurant['contact_no'];?>">
			</div>
		   </div>
		 
		   
		    
		   
		   </div>
		   <div class="col-sm-12">
		   <div class="col-sm-6">
		   <div class="form-group">
             <label>Price</label>
              <input type="text"  id="price" name="price" class="form-control" placeholder="Price" value="<?php echo $rerestaurant['price'];?>">
			</div>
		   </div>
		   
		   <div class="col-sm-6">
		   <div class="form-group">
             <label>Price For Approx People</label>
              <input type="text"  id="approx" name="approx" class="form-control" placeholder="approx" value="<?php echo $rerestaurant['approx'];?>">
			(for example : Two,Three,Four)
			</div>
		   </div>
		   </div>
		   <div class="col-sm-12">
		   <div class="col-sm-6">
		   <div class="form-group">
             <label>Discount</label>
              <input type="text"  id="discount" name="discount" class="form-control" placeholder="Discount" value="<?php echo $rerestaurant['discount'];?>">
			</div>
		   </div>
		   <div class="col-sm-6">
		   <div class="form-group">
             <label>Location</label>
              <input type="text"  id="pac-input" name="location" class="form-control" placeholder="Location" value="<?php echo $rerestaurant['location'];?>">
			</div>
		   </div>
		   </div>
		   
		   <div class="col-sm-12">
		   <div class="col-sm-6">
		   <div class="form-group">
             <label>Opening Time</label>
              <?php 
			  
			  $opening_time_c = new DateTime($rerestaurant['opening_time']);
              $opening_time = $opening_time_c->format('H:i');
			  ?>
			  <input type="time"  id="opening_time" name="opening_time" class="form-control" placeholder="Opening Time" value="<?php echo $opening_time;?>">
			</div>
		   </div>
		   <div class="col-sm-6">
		   <div class="form-group">
             <label>Closing Time</label>
           <?php 
			  $closing_time_c = new DateTime($rerestaurant['closing_time']);
              $closing_time = $closing_time_c->format('H:i');
			  ?>
			  <input type="time"  id="closing_time" name="closing_time" class="form-control" placeholder="Closing Time" value="<?php echo $closing_time;?>">
			</div>
		   </div>
		   </div> 
		   <div class="col-sm-12">
		   
		   <div class="form-group">
             <label>Description</label>
              <textarea  id="detail" name="detail" class="form-control" placeholder="Description"><?php echo $rerestaurant['detail'];?></textarea>
			</div>
		  
		   </div>
		    <div class="col-sm-12">
		   <div class="col-sm-4">
		   <div class="form-group">
             <label>Image</label>
              <input type="file"  id="image" name="image" class="form-control" placeholder="Image" value="">
			</div>
			<br>
			<?php 
			if($rerestaurant['image']!=''){
				?>
				<img src="<?php echo base_url()."/".$rerestaurant['image'];?>" height="100" width="100">
				<?php 
			}
			?>
		   </div>
		   <div class="col-sm-4">
		   <div class="form-group">
             <label>Upload Menu(PDF or Image)</label>
              <input type="file"  id="menu" name="menu" class="form-control" placeholder="Upload Menu(PDF)" value="">
			  <br><br><?php 
			if($rerestaurant['menu']!=''){
				$fileNameParts = explode('.', $rerestaurant['menu']);
                $ext = end($fileNameParts);
				if($ext=='pdf'){
				?>
			  <a href="<?php echo base_url()."/".$rerestaurant['menu'];?>" download>View Menu As PDF</a>
			<?php 
				}else{
					?>
			<img src="<?php echo base_url()."/".$rerestaurant['menu'];?>" height="200" width="200">	
					<?php
					
				}
			}
			?>
			</div>
		   </div>
		   <div class="col-sm-4">
		   <div class="form-group">
             <label>Add Gallery Images</label>
              <input type="file"  id="gallary" multiple name="gallary" class="form-control" placeholder="Image" value="">
			  <?php 
			if($rerestaurant['gallary']!=''){
				$exx=explode(",",$rerestaurant['gallary']);
				foreach($exx as $vals){
					
				
				?>
				<img src="<?php echo base_url()."/".$vals;?>" height="100" width="100">
				<?php 
			}
			}
			?>
			</div>
		   </div>
		   </div>
		 <div class="col-sm-12">
		   <div class="col-sm-6">
		   <div class="form-group">
             <label>Feature Name</label>
              <?php
              $features_array=array();			  
			  if($rerestaurant['features']!=''){
				  $features_array=explode(",",$rerestaurant['features']);
			  }
			 
			  foreach($refeatures as $val){
				  $checked='';
				  if(in_array($val['id'],$features_array)){
					$checked='checked';  
				  }
				 
			  ?>
			  <p style="padding-right:25px;">
			  <input <?php echo $checked;?>  type="checkbox"   name="features[]"  placeholder="Feature Name" value="<?php echo $val['id'];?>">
			  <?php echo $val['name'];?></p> 
			  <?php 
			  }
			  ?>
			</div>
			</div>
		 
		   </div>
		 <div class="col-sm-12"><div class="col-sm-9"></div>
			<div class="col-sm-3">
			 <button type="submit" class="btn btn-primary">Submit</button>
			 </div>
</div>			 
	   </div>
      <input type="hidden" name="latitude" id="latitude" value="<?php echo $rerestaurant['latitude'];?>">
      <input type="hidden" name="longitude" id="longitude" value="<?php echo $rerestaurant['longitude'];?>">
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
  var input = document.getElementById('pac-input');
  var autocomplete = new google.maps.places.Autocomplete(input);
  google.maps.event.addListener(autocomplete, 'place_changed', function() {
    let place = autocomplete.getPlace();
	$("#latitude").val(place.geometry.location.lat());
    $("#longitude").val(place.geometry.location.lng());
});
  
}
 /* function selectLocation(address){
	
  address=	
   var geocoder = new google.maps.Geocoder();
   geocoder.geocode( { 'address': address}, function(results, status) {
       if (status == google.maps.GeocoderStatus.OK) {
          $("#latitude").val(results[0].geometry.location.lat());
          $("#latitude").val(results[0].geometry.location.lng());
       } 
    });  

}*/
  function deleteRowSlip(id){
	   document.getElementById("fieldslip_"+id).remove();
  }
</script>

<?php echo  $this->endSection(); ?>
