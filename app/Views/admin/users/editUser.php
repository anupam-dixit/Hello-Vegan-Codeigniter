<?php echo  $this->extend('admin/templates/admin_template'); ?>

<?php echo  $this->section('content'); ?>
<?php
$id=$users['id'];
$name=$users['name'];
$address=$users['address'];
$description=$users['description'];
$profile_image=$users['profile_image'];
$cover_image=$users['cover_image'];
$email=$users['email'];
$password=$users['password'];
$location=$users['location'];
/* echo "<pre>";
print_r($questions);
echo "</pre>"; */
?>
 <div class="content-wrapper">
 <section class="content-header">
      <h1>
        Edit User
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>admin/users"><i class="fa fa-dashboard"></i> Users</a></li>
        <li class="active">Edit</li>
      </ol>
    </section>
    <section class="content">
        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
          <div class="box-header">
            <h3 class="box-title"></h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
           <form action="<?php echo base_url('admin/update-user');?>" method="post" enctype="multipart/form-data">	
<input type="hidden" name="id" id="id" value="<?php echo $id;?>">		   
 		  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Name</label>
                        <input type="text"  id="name" name="name" class="form-control" placeholder="Enter ..." value="<?php echo $name;?>">
						
                      </div>
                    </div>
					<div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Email</label>
                        <input type="text"  id="email" name="email" class="form-control" placeholder="Enter ..." value="<?php echo $email;?>">
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
                        <input type="text"  id="pac-input" name="location" class="form-control" placeholder="Enter a location" value="<?php echo $location;?>">
                      </div>
                    </div>
					<div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Address</label>
                     <textarea class="form-control" id="address" 
						name="address" rows="3" placeholder="Enter ..."><?php echo $address;?></textarea>
                      </div>
                    </div>
					<div class="col-sm-6">
                      <!-- text input -->
                     <div id="map"  style='width:100%;height:200px;'></div>
                     <?php
						$key="AIzaSyBlf2VfOx5bL5rwlTP4hG5luZxZaLV6xEI";
						$googleWeb="https://maps.googleapis.com/maps/api/js";
						$googleAddress=$googleWeb."?key=".$key."&libraries=places&callback=initialize";
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
							name="description" rows="3" placeholder="Enter ..."><?php echo $description;?></textarea>
						  </div>
				</div>
			
		
			</div>
			
			<div class="row">
			 <div class="col-md-6">
			  <div class="form-group"> 
			  <label>Profile Image</label>
                <div class="custom-file">
                 <input type="file" onchange="return valueonchange(this.id)" class="custom-file-input" name="profile_image" id="profile_image">
                 <label class="custom-file-label" id="profile_image_label" 
                 for="profile_image">Profile Image</label>
				 <span style="display:none;color:red" id="error_profile_image">Please select profile image</span>
				 <?php 
				 if($profile_image!=''){?>
				 <img src="<?php echo base_url();?>/<?php echo $profile_image;?>" width="100" height="100">
				 <?php 
				 } 
				 ?>
                </div>
              </div>
             </div>
			 <div class="col-md-6">
			  <div class="form-group">
			  <label>Cover Image</label>
                <div class="custom-file">
                 <input type="file" onchange="return valueonchange(this.id)" class="custom-file-input" name="cover_image" id="cover_image">
                 <label class="custom-file-label" for="cover_image">Cover Image</label>
				 <span style="display:none;color:red" id="error_cover_image">Please select cover image</span>
				
				 <?php 
				 if($cover_image!=''){?>
				 <img src="<?php echo base_url();?>/<?php echo $cover_image;?>" width="100" height="100">
				 <?php 
				 } 
				 ?>
                </div>
              </div>
             </div>
			
			</div> 
			
			<div style="clear:both;margin-top:5%"></div>
			<div class="row">
			<label>Enter security questions and answers</label>
			</div>
			<?php 
			$k=0;
			for($ii=1;$ii<4;$ii++){
				$sq='';
				$sa='';
				if(isset($questions[$k]['secret_question'])){
					$sq=$questions[$k]['secret_question'];
				}
				if(isset($questions[$k]['secret_answer'])){
					$sa=$questions[$k]['secret_answer'];
				}
			?>
			<div class="row">
			 <div class="col-md-6">
			  <div class="form-group">
			   <label>Q<?php echo $ii;?> </label>
               <input type="text"  id="sq<?php echo $ii;?>" name="sq<?php echo $ii;?>" class="form-control" placeholder="Enter ..." value="<?php echo $sq; ?>">
			  </div>
			 </div>
			 <div class="col-md-6">
			  <div class="form-group">
			   <label>Ans<?php echo $ii;?></label>
               <input type="text"  id="sa<?php echo $ii;?>" name="sa<?php echo $ii;?>" class="form-control" placeholder="Enter ..." value="<?php echo $sa; ?>">
			  </div>
			 </div>
			</div>
			<?php
$k++;	
	
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
	  </div>
 <?php
 if(empty($location)){
	 $location='Jaipur, Rajasthan, India';
 }
 ?>
	<script type="text/javascript">
  var geocoder;
  var map;
  var address ="<?php echo $location;?>";

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
<!-- /.content -->
<?php echo  $this->endSection(); ?>