<?php echo  $this->extend('admin/templates/forum_template'); ?>

<?php echo  $this->section('content'); ?>
<div class="content-wrapper">
 
      <section class="content-header">
      <h1>
        Add Forum Post
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>admin/posts"><i class="fa fa-dashboard"></i> Posts</a></li>
        <li class="active">Add New</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
          <div class="box-header">
            <h3 class="box-title"></h3>
          </div>
          <!-- /.box-header -->
          
           <form action="<?php echo base_url('admin/forum/insert-post');?>" method="post" enctype="multipart/form-data">
<div class="box-body">		   
 		  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                <label>Tag</label>
                <select name="post_tag_id" class="form-control select2" style="width: 100%;">
                  <option >Select Tag</option>
				  <?php 
				  foreach($tags as $val){
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
                      <!-- text input -->
                      <div class="form-group">
                        <label>Title</label>
                        <input type="text"  id="title" name="title" class="form-control" placeholder="Enter ...">
						
                      </div>
                    </div>
			</div>
			<div class="row">
			<div class="col-sm-12">
            <div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label>Location</label>
                    <input type="text"  id="pac-input" name="location" class="form-control" placeholder="Enter a location">
				</div>
			</div>
            <div class="col-sm-6">			
				<div id="map"  style='width:100%;height:200px;'></div>
                     <?php
						$key="AIzaSyBlf2VfOx5bL5rwlTP4hG5luZxZaLV6xEI";
						$googleWeb="https://maps.googleapis.com/maps/api/js";
						$googleAddress=$googleWeb."?key=".$key."&libraries=places&callback=initMap";
					  ?>
						<script src="<?php echo $googleAddress;?>"   async defer></script>
			    </div>
			</div>	
			</div>
			</div>
			<div class="row">
			<div class="col-sm-12">
						  <!-- textarea -->
						  <div class="form-group">
							<label>Description</label>
							<span style="display:none;color:red" id="error_long_description">Please fill  Description</span>
							<textarea  class="form-control" id="description" 
							name="content" rows="3" placeholder="Enter ..."></textarea>
						  </div>
				</div>
			
		
			</div>
			
			<div class="row">
			 <div class="col-md-6">
			  <div class="form-group"> 
			  <label>Image</label>
                <div class="custom-file">
                 <input type="file" onchange="return valueonchange(this.id)" class="custom-file-input" name="image" id="profile_image">
                 
				 <span style="display:none;color:red" id="error_profile_image">Please select  image</span>
                </div>
              </div>
             </div>
			
			
			</div> 
			
			<div class="row">
			
			 <div class="col-md-12" style="text-align:right;">
			  <div class="form-group">
                
                  <button onclick="return validation()" type="submit" class="btn btn-primary">Submit</button>
                
              </div>
             </div>
			</div>
			
           </div>
		   </form>
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
