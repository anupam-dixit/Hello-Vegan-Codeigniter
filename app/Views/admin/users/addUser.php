<?php echo  $this->extend('admin/templates/admin_template'); ?>

<?php echo  $this->section('content'); ?>
<div class="content-wrapper">
 
    <section class="content-header">
      <h1>
        Add New User
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>admin/users"><i class="fa fa-dashboard"></i> Users</a></li>
        <li class="active">Add New</li>
      </ol>
    </section>
        <!-- SELECT2 EXAMPLE -->
		<section class="content">
        <div class="box box-default">
          <div class="box-header">
            
          </div>
          <!-- /.box-header -->
          <div class="box-body">
           <form action="<?php echo base_url('admin/insert-user');?>" method="post" enctype="multipart/form-data">		  
 		  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Name</label>
                        <input type="text"  id="name" name="name" class="form-control" placeholder="Enter ...">
						
                      </div>
                    </div>
					<div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Email</label>
                        <input type="text"  id="email" name="email" class="form-control" placeholder="Enter ..." onblur="return checkEmail('<?php echo site_url();?>');" onkeypress="return valueonchange(this.id)">
						<span style="display:none;color:red" id="error_email">Please fill email</span>
						<span style="display:none;color:red" id="error_same_email">Email is already taken</span>
                      </div>
                    </div>
					<div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Password</label>
                        <input type="password"  id="password" name="password" class="form-control" placeholder="Enter ...">
						<span style="display:none;color:red" id="error_password">Please fill password</span>
						
                      </div>
                    </div>
					<div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Location</label>
                        <input type="text"  id="pac-input" name="location" class="form-control" placeholder="Enter a location">
                      </div>
                    </div>
					<div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Address</label>
                     <textarea class="form-control" id="address" 
						name="address" rows="3" placeholder="Enter ..."></textarea>
                      </div>
                    </div>
					<div class="col-sm-6">
                      <!-- text input -->
                     <div id="map"  style='width:100%;height:200px;'></div>
                     <?php
						$key="AIzaSyBlf2VfOx5bL5rwlTP4hG5luZxZaLV6xEI";
						$googleWeb="https://maps.googleapis.com/maps/api/js";
						$googleAddress=$googleWeb."?key=".$key."&libraries=places&callback=initMap";
					  ?>
						<script src="<?php echo $googleAddress;?>"   async defer></script>					 
                    </div>
					
                   
                     
            </div>
			
			<div class="row">
			<div class="col-sm-12">
						  <!-- textarea -->
						  <div class="form-group">
							<label>Description</label>
							<span style="display:none;color:red" id="error_long_description">Please fill  Description</span>
							<textarea  class="form-control" id="description" 
							name="description" rows="3" placeholder="Enter ..."></textarea>
						  </div>
				</div>
			
		
			</div>
			
			<div class="row">
			 <div class="col-md-6">
			  <div class="form-group"> 
			  <label>Profile Image</label>
                <div class="custom-file">
                 <input type="file" onchange="return valueonchange(this.id)" class="custom-file-input" name="profile_image" id="profile_image">
                 
				 <span style="display:none;color:red" id="error_profile_image">Please select profile image</span>
                </div>
              </div>
             </div>
			 <div class="col-md-6">
			  <div class="form-group">
			  <label>Cover Image</label>
                <div class="custom-file">
                 <input type="file" onchange="return valueonchange(this.id)" class="custom-file-input" name="cover_image" id="cover_image">
                
				 <span style="display:none;color:red" id="error_cover_image">Please select cover image</span>
                </div>
              </div>
             </div>
			
			</div> 
			<div class="col-md-12">
			<div class="form-group">
			<label>Enter security questions and answers</label>
			</div>
			</div>
			<?php 
			for($ii=1;$ii<4;$ii++){
			?>
			<div class="row">
			 <div class="col-md-6">
			  <div class="form-group">
			   <label>Q<?php echo $ii;?> </label>
               <input type="text"  id="sq<?php echo $ii;?>" name="sq<?php echo $ii;?>" class="form-control" placeholder="Enter ...">
			  </div>
			 </div>
			 <div class="col-md-6">
			  <div class="form-group">
			   <label>Ans<?php echo $ii;?></label>
               <input type="text"  id="sa<?php echo $ii;?>" name="sa<?php echo $ii;?>" class="form-control" placeholder="Enter ...">
			  </div>
			 </div>
			</div>
			<?php 
			}
			?>
			
			
			
			
			
			<div class="row">
			
			 <div class="col-md-12" style="text-align:right;">
			  <div class="form-group">
                
                  <button onclick="return validation()" type="submit" class="btn btn-primary">Submit</button>
                
              </div>
             </div>
			</div>
			</form>
           </div>
         </div>
      
</section>
    <!-- /.content -->
  </div>
<script>
function initMap() {
  var map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: 26.9124, lng: 75.7873},
    zoom: 13
  });
  var card = document.getElementById('pac-card');
  var input = document.getElementById('pac-input');
  var types = document.getElementById('type-selector');
  var strictBounds = document.getElementById('strict-bounds-selector');

  map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);
  
  var autocomplete = new google.maps.places.Autocomplete(input);

  // Bind the map's bounds (viewport) property to the autocomplete object,
  // so that the autocomplete requests use the current map bounds for the
  // bounds option in the request.
  autocomplete.bindTo('bounds', map);

  // Set the data fields to return when the user selects a place.
  autocomplete.setFields(
      ['address_components', 'geometry', 'icon', 'name']);

  var infowindow = new google.maps.InfoWindow();
  var infowindowContent = document.getElementById('infowindow-content');
  infowindow.setContent(infowindowContent);
  var marker = new google.maps.Marker({
    map: map,
    anchorPoint: new google.maps.Point(0, -29)
  });
  
  autocomplete.addListener('place_changed', function() {
    infowindow.close();
    marker.setVisible(false);
    var place = autocomplete.getPlace();
    if (!place.geometry) {
      // User entered the name of a Place that was not suggested and
      // pressed the Enter key, or the Place Details request failed.
      window.alert("No details available for input: '" + place.name + "'");
      return;
    }

    // If the place has a geometry, then present it on a map.
    if (place.geometry.viewport) {
      map.fitBounds(place.geometry.viewport);
    } else {
      map.setCenter(place.geometry.location);
      map.setZoom(17);  // Why 17? Because it looks good.
    }
    marker.setPosition(place.geometry.location);
    marker.setVisible(true);

    var address = '';
    if (place.address_components) {
      address = [
        (place.address_components[0] && place.address_components[0].short_name || ''),
        (place.address_components[1] && place.address_components[1].short_name || ''),
        (place.address_components[2] && place.address_components[2].short_name || '')
      ].join(' ');
    }

    infowindowContent.children['place-icon'].src = place.icon;
    infowindowContent.children['place-name'].textContent = place.name;
    infowindowContent.children['place-address'].textContent = address;
    infowindow.open(map, marker);
  });

  // Sets a listener on a radio button to change the filter type on Places
  // Autocomplete.
  function setupClickListener(id, types) {
    var radioButton = document.getElementById(id);
    radioButton.addEventListener('click', function() {
      autocomplete.setTypes(types);
    });
  }

}
	
	</script>


<?php echo  $this->endSection(); ?>
