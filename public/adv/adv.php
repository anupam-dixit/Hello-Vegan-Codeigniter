<?php
@session_start();
$con=mysqli_connect('localhost','hello-vegans','wHq23$jvaZAqd5zx','hello-vegans');

if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Hello Vegans</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body onload="initialize()">
<style>
.container{
	width: 700px;
}
.carousel .item {
  height: 400px;
  
}
.carousel-caption a{
color:#fff !important ;	
}

.carousel-inner > .item > img {
  min-width: 100%;
  width: 100%;
  height: 100%;
}
@media screen and (max-width: 400px) {
.container{
	width: 300px;
}
}
@media screen and (max-width: 930px) {
.container{
	width: 300px;
}
@media screen and (max-width: 1000px) {
.container{
	width: 400px;
}
}

</style>

<div class="container" style="margin-top:20px">
  
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->


    
  </div>
  <h2 id="cityname"></h2> 
  <br><br>
  <?php 
  $sql=mysqli_query($con,"select location_city from recommendation_requests group by location_city");
  
  ?>
  <select onchange="getData(this.value)">
  <option value="jaipur">select city</option>
  <?php
  while($array=mysqli_fetch_assoc($sql)){
	  $ex=explode(",",$array['location_city']);
  ?>
  <option value="<?php echo $ex[0];?>">
  <?php echo $array['location_city'];?>
  </option>
  <?php  
  }
  ?>
  </select>
   
</div>
<?php
$key="AIzaSyBlf2VfOx5bL5rwlTP4hG5luZxZaLV6xEI";
$googleWeb="https://maps.googleapis.com/maps/api/js";
$googleAddress=$googleWeb."?key=".$key."&libraries=places&callback=initMap";
?>
<div id="map"></div>
<script type="text/javascript" 
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBlf2VfOx5bL5rwlTP4hG5luZxZaLV6xEI&sensor=false"></script> 
<script type="text/javascript"> 
  var geocoder;

  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(successFunction, errorFunction);
} 
//Get the latitude and the longitude;
function successFunction(position) {
    var lat = position.coords.latitude;
    var lng = position.coords.longitude;
    codeLatLng(lat, lng)
}

function errorFunction(){
    alert("Geocoder failed");
}

  function initialize() {
    geocoder = new google.maps.Geocoder();
  }

  function codeLatLng(lat, lng) {

    var latlng = new google.maps.LatLng(lat, lng);
    geocoder.geocode({'latLng': latlng}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
      //console.log(results)
        if (results[1]) {
			var add= results[0].formatted_address ;
			 var value=add.split(","); 
			 count=value.length; 
			 country=value[count-1]; 
			 state=value[count-2]; 
			 city=value[count-3]; 
			// alert("city name is: " + city);
			 document.getElementById('cityname').innerHTML=city+","+state+","+country;
			console.log(city)
			 getData(city.trim());
       

        } else {
          alert("No results found");
        }
      } else {
        alert("Geocoder failed due to: " + status);
      }
    });
  }
  function getData(cityName){
	  $.ajax({
	  url:"getLocation.php",
	  type:"POST",
	  data:{'cityName':cityName},
	  success:function(res){
		  $("#myCarousel").html(res);
		  console.log(res);
	  },
	  error:function(err){
		  console.log(err);
	  }
  });  
  }

</script> 
</body>
</html>
