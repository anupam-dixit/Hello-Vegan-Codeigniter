<?php echo  $this->extend('admin/templates/forum_template'); ?>

<?php echo  $this->section('content'); ?>
<div class="content-wrapper">
  <section class="content-header">
   <h1>
    View Forum Post
   <small></small>
   </h1>
   <ol class="breadcrumb">
    <li><a href="<?php echo site_url();?>admin/forum/posts"><i class="fa fa-dashboard"></i> Posts</a></li>
    <li class="active">View</li>
   </ol>
  </section>
  <!-- Main content -->
  <section class="content">
		<div class="row">
		 <div class="col-md-9">
		  <div class="box box-default">
			<div class="box-body">
			  <div class="nav-tabs-custom">
			   <div class="tab-content">
			   <div class="active tab-pane" id="activity">
				<div class="post">
				  <div class="user-block">
					<span class="username" style="margin-left:0px;">
						 Tag Name: <span style="font-weight:100"><?php echo $posts['tag_name'];?></span>
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
					<p>
					 <span  style="margin-left:0px;font-weight:600;font-size:16px;">Description:</span>
					   <?php echo $posts['content'];?>
					</p>
					<div class="row margin-bottom">
					  <div class="col-sm-3">
						<?php if($posts['image']!=''){ ?>
							 <img class="img-responsive" src="<?php echo base_url();?>/<?php echo $posts['image'];?>" >	 
						 <?php }?>
					  </div>
					</div>
					<div class="col-sm-6" style="margin-top:20px">
					 <form action="<?php echo base_url('admin/forum/post/insert-comment');?>" method="post" enctype="multipart/form-data">	
                        <input type="hidden" name="post_id" value="<?php echo $posts['id'];?>">
						<div class="form-group">
						<textarea name="message" class="form-control" placeholder="Type a Comment"></textarea>
						</div>
						<div class="form-group">
						<div class="">
                      <button type="submit" class="btn btn-danger">Submit</button>
                       </div>
					   </div>
                     </form>
					 <p>
					 <span  style="margin-left:0px;font-weight:600;font-size:16px;">Comments:</span>
					  <?php 
					
					 function getTree($marginleft,$ids){
						$db = db_connect();
				$q="select fpco.id,fpco.admin_id,fpco.comment_id,fpco.user_id,fpco.message,fpco.created_at,u.name as users_name,u.profile_image as users_profile_image,u.email as users_email,a.name as admin_name,a.email as admin_email from forum_post_comments fpco 
		left join users u
		on fpco.user_id=u.id
		left join admin_users a
		on fpco.admin_id=a.id
		where fpco.comment_id='".$ids."'";
						  $r=$db->query($q);
						  $result=$r->getResultArray();
					if(count($result)!=0){
						foreach($result as $vals){
						   $imgurl='';
						   $username='';
						   if($vals['users_profile_image']!=''){
							 $imgurl= $vals['users_profile_image']; 
						   }
						   if($vals['users_profile_image']==''){
							  $imgurl= "public/dist/img/user2-160x160.jpg"; 
						   }
						   if($vals['users_name']!=''){
							  $username=$vals['users_name']; 
						   }
						   if($vals['admin_name']!=''){
							   $username=$vals['admin_name'];
						   }
						   $rs='<div class="user-block" style="margin-left:'.$marginleft.'%;">';
						   $rs.=' <img style="margin-right:9px" class="img-circle img-bordered-sm" src="'.base_url().'/'.$imgurl.'" alt="User Image">';
						   $rs.='<span class="username" style="margin-left:0px;">';
						   $rs.=$username;
						   $rs.='<span class="description">';
						   $rs.=$vals['created_at'];
						   $rs.='</span>';
						   $rs.='<span class="description">';
						   $rs.=$vals['message'];
						   $rs.='</span>';
						   $rs.='</div>';
						   //$rs.=$vals['id'];
						   echo $rs;
						   $marginleft=$marginleft+10;
						   //$marginleft=20;
						   getTree($marginleft,$vals['id']);
						   //$marginleft=20;
						} 
						   
					}  
						//  return $result; 						 
					  }
					   foreach($comments as $val){
						   $imgurl='';
						   $username='';
						   if($val['users_profile_image']!=''){
							 $imgurl= $val['users_profile_image']; 
						   }
						   if($val['users_profile_image']==''){
							  $imgurl= "public/dist/img/user2-160x160.jpg"; 
						   }
						   if($val['users_name']!=''){
							  $username=$val['users_name']; 
						   }
						   if($val['admin_name']!=''){
							   $username=$val['admin_name'];
						   }
					   ?>
					   <div class="user-block">
					     <img style="margin-right:9px" class="img-circle img-bordered-sm" src="<?php echo base_url();?>/<?php echo $imgurl;?>" alt="User Image">
                        
						 <span class="username" style="margin-left:0px;">
						 <?php echo $username; ?> 
						 </span>
						   <span class="description">
						     <?php echo $val['created_at'];?>
						   </span>
						   <span class="description">
						     <?php echo $val['message'];?>
						   </span>
						   
					   </div>
					   <?php 
					   getTree(20,$val['id']);
					  
						   ?>
						    
						  
                       <?php					   
					   }
					   ?>
					</p>
					
					</div>
				  </div>
				</div>
			   </div>
			 </div>
			</div>
		  </div>
	   </div>
	 </div>
   </section> 
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
