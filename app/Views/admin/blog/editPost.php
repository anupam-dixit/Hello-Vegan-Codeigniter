<?php echo  $this->extend('admin/templates/blog_template'); ?>

<?php echo  $this->section('content'); ?>
<div class="content-wrapper">
      <section class="content-header">
      <h1>
        Edit Blog Post
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>admin/blog/posts"><i class="fa fa-dashboard"></i> Posts</a></li>
        <li class="active">Edit</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    
        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
          <div class="box-header">
            <h3 class="box-title">Edit Post</h3>
          </div>
          <!-- /.box-header -->
          <form action="<?php echo base_url('admin/blog/update-post');?>" method="post" enctype="multipart/form-data">
		  <input type="hidden" name="id" id="id" value="<?php echo $posts['id'];?>">
		  <div class="box-body">
           	 <div class="row">
			 <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                <label>Category</label>
                <select name="post_category_id" class="form-control select2" style="width: 100%;">
                  <option >Select Category</option>
				  <?php 
				 
				  foreach($categories as $val){
					  $selected='';
					  $catid=$val['id'];
					  $catname=$val['name'];
					  $post_category_id=$posts['post_category_id'];
					  
					  if($post_category_id==$catid){
						  $selected='selected';
					  }  
					  
					  
			      ?>
				  <option  
				  value="<?php echo $catid;?>" <?php echo $selected;?>><?php echo $catname;?></option>
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
                        <input type="text"  id="title" name="title" class="form-control" placeholder="Enter ..." 
						value="<?php echo $posts['title'];?>">
						
                      </div>
                    </div>
			</div>
			<div class="row">
			<div class="col-sm-12">
			<div class="col-sm-6">
				<div class="form-group">
					<label>Location</label>
                    <input type="text"  id="pac-input" name="location" class="form-control" value="<?php echo $posts['location'];?>" placeholder="Enter a location">
				</div>
			</div>
            <div class="col-sm-6">			
				<div id="map"  style='width:100%;height:200px;'></div>
                     <?php
						$key="AIzaSyBlf2VfOx5bL5rwlTP4hG5luZxZaLV6xEI";
						$googleWeb="https://maps.googleapis.com/maps/api/js";
						$googleAddress=$googleWeb."?key=".$key."&libraries=places&callback=initialize";
					  ?>
						<script src="<?php echo $googleAddress;?>"   async defer></script>
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
							name="content" rows="3" placeholder="Enter ..."><?php echo $posts['content'];?></textarea>
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
				 <br>
				 <?php if($posts['image']!=''){
					 ?>
				<img src="<?php echo base_url();?>/<?php echo $posts['image'];?>" width="100" height="100">	 
					 <?php
				 }?>
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
<?php
 if(empty($posts['location'])){
	 $posts['location']='Jaipur, Rajasthan, India';
 }

 ?>
	<script type="text/javascript">
  var geocoder;
  var map;
  var address ="<?php echo $posts['location'];?>";

  function initialize() {
    geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(-34.397, 150.644);
    var myOptions = {
      zoom: 8,
      center: latlng,
    mapTypeControl: true,
    mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
    navigationControl: true,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map(document.getElementById("map"), myOptions);
    if (geocoder) {
      geocoder.geocode( { 'address': address}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
          if (status != google.maps.GeocoderStatus.ZERO_RESULTS) {
          map.setCenter(results[0].geometry.location);

            var infowindow = new google.maps.InfoWindow(
                { content: '<b>'+address+'</b>',
                  size: new google.maps.Size(150,50)
                });
    
            var marker = new google.maps.Marker({
                position: results[0].geometry.location,
                map: map, 
                title:address
            }); 
            google.maps.event.addListener(marker, 'click', function() {
                infowindow.open(map,marker);
            });

          } else {
            alert("No results found");
          }
        } else {
          alert("Geocode was not successful for the following reason: " + status);
        }
      });
    }
	//autocomplete
  var input = document.getElementById('pac-input');
  var autocomplete = new google.maps.places.Autocomplete(input);
  autocomplete.bindTo('bounds', map);
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
      window.alert("No details available for input: '" + place.name + "'");
      return;
    }
    if (place.geometry.viewport) {
      map.fitBounds(place.geometry.viewport);
    } else {
      map.setCenter(place.geometry.location);
      map.setZoom(17);
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

  });

  function setupClickListener(id, types) {
    var radioButton = document.getElementById(id);
    radioButton.addEventListener('click', function() {
      autocomplete.setTypes(types);
    });
  }
	//autocomplete
  }
</script>
<?php echo  $this->endSection(); ?>
