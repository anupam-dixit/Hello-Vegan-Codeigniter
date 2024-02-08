<?php echo  $this->extend('admin/templates/blog_template'); ?>

<?php echo  $this->section('content'); ?>
<div class="content-wrapper">
      <section class="content-header">
      <h1>
        View Blog Post
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>admin/blog/posts"><i class="fa fa-dashboard"></i> Posts</a></li>
        <li class="active">View</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="box box-default">
        <div class="box-body">
		<div class="row">
       <!-- /.col -->
        <div class="col-md-6">
          <div class="nav-tabs-custom">
           
            <div class="tab-content">
           <div class="active tab-pane" id="activity">
                <!-- Post -->
               
               
                <!-- Post -->
                <div class="post">
                  <div class="user-block">
				  
                    <span class="username" style="margin-left:0px;">
                     Category Name: <span style="font-weight:100"><?php echo $posts['category_name'];?></span>
                    </span>
					
					<span class="username" style="margin-left:0px;">
                     Title: <span style="font-weight:100"><?php echo $posts['title'];?></span> 
                    </span>
					<span class="username" style="margin-left:0px;">
                     Posted: <span style="font-weight:100"><?php echo $posts['created_at'];?></span> 
                    </span>
					<span class="username" style="margin-left:0px;">
                     Location: <span style="font-weight:100"><?php echo $posts['location'];?></span> 
                    </span>
                    <div id="map"  style='width:100%;height:200px;'></div>
                     <?php
						$key="AIzaSyBlf2VfOx5bL5rwlTP4hG5luZxZaLV6xEI";
						$googleWeb="https://maps.googleapis.com/maps/api/js";
						$googleAddress=$googleWeb."?key=".$key."&libraries=places&callback=initialize";
					  ?>
						<script src="<?php echo $googleAddress;?>"   async defer></script>
                  </div>
                  <!-- /.user-block -->
				   <p>
				   <span  style="margin-left:0px;font-weight:600;font-size:16px;">Description:</span>
                   <?php echo $posts['content'];?>
                  </p>
                  <div class="row margin-bottom">
                    <div class="col-sm-6">
                     
					  <?php if($posts['image']!=''){
					 ?>
				<img class="img-responsive" src="<?php echo base_url();?>/<?php echo $posts['image'];?>" >	 
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
