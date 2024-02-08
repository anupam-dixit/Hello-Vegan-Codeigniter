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
?>
<div class="content-wrapper">
 <section class="content-header">
      <h1>
        View User
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>admin/users"><i class="fa fa-dashboard"></i> Users</a></li>
        <li class="active">View</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    
		<div class="row">
       <!-- /.col -->
        <div class="col-md-9">
		<div class="box box-default">
        <div class="box-body">
          <div class="nav-tabs-custom">
           
            <div class="tab-content">
           <div class="active tab-pane" id="activity">
                <!-- Post -->
               
               
                <!-- Post -->
                <div class="post">
                  <div class="user-block">
				  
                    <span class="username" style="margin-left:0px;">
                     Name: <span style="font-weight:100"><?php echo $name;?></span>
                    </span>
					 <span class="username" style="margin-left:0px;">
                     Email: <span style="font-weight:100"><?php echo $email;?></span>
                    </span>
					 <span class="username" style="margin-left:0px;">
                     Address: <span style="font-weight:100"><?php echo $address;?></span>
                    </span>
					<span class="username" style="margin-left:0px;">
                     Location: <span style="font-weight:100"><?php echo $location;?></span>
                    </span>
					<div id="map"  style='width:100%;height:200px;'></div>
                     <?php
						$key="AIzaSyBlf2VfOx5bL5rwlTP4hG5luZxZaLV6xEI";
						$googleWeb="https://maps.googleapis.com/maps/api/js";
						$googleAddress=$googleWeb."?key=".$key."&libraries=places&callback=initialize";
					  ?>
						<script src="<?php echo $googleAddress;?>"   async defer></script>
				</div>
				  <div class="user-block">
				  <span class="username" style="margin-left:0px;">
				  Security questions and answers
				  </span>
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
                    <span class="username" style="margin-left:0px;">
                     Q<?php echo $ii;?>: <span style="font-weight:100"><?php echo $sq; ?></span>
                    </span>
					<span class="username" style="margin-left:0px;">
                     Ans<?php echo $ii;?>: <span style="font-weight:100"><?php echo $sa; ?></span>
                    </span>
				<?php $k++; }  ?>	
				</div>
                  <!-- /.user-block -->
				   <p>
				   <span  style="margin-left:0px;font-weight:600;font-size:16px;">Description:</span>
                   <?php echo $description;?>
                  </p>
                  <div class="row margin-bottom">
                    <div class="col-sm-3">
                     <span  style="margin-left:0px;font-weight:600;font-size:16px;">Profile Image:</span>
					  <?php if($profile_image!=''){
					 ?>
				<img class="img-responsive" src="<?php echo base_url();?>/<?php echo $profile_image;?>" >	 
					 <?php
				 }?>
                    </div>
					<div class="col-sm-3">
                     <span  style="margin-left:0px;font-weight:600;font-size:16px;">Cover Image:</span>
					  <?php if($cover_image!=''){
					 ?>
				<img class="img-responsive" src="<?php echo base_url();?>/<?php echo $cover_image;?>" >	 
					 <?php
				 }?>
                    </div>
                    <!-- /.col -->
                  
                  </div>
                  <!-- /.row -->

                  
                </div>
                <!-- /.post -->
             </div>
             
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      </div>
	  </div>
     </section> 

    <!-- /.content -->
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