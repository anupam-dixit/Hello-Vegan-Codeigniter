<?php
@session_start();
$con=mysqli_connect('localhost','hello-vegans','wHq23$jvaZAqd5zx','hello-vegans');

if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}
$url="https://projectstatus.co.in/Hello-Vegans";
$where="where rr.status=1 and rr.date_to >= '".date('Y-m-d')."'";
if($_POST['cityName']!=''){
	
 $sql = "SELECT rr.*,rc.name as category_name FROM recommendation_requests rr 
        left join recommendation_categories rc 
        on rr.category=rc.id
		".$where." 
		ORDER BY (FIND_IN_SET('".$_POST['cityName']."', rr.location_city) > 0) desc,rr.plan desc,rr.id desc	     
		";	
}else{
$sql = "SELECT rr.*,rc.name as category_name FROM recommendation_requests rr 
        left join recommendation_categories rc 
        on rr.category=rc.id
		".$where." 
		ORDER BY rr.plan desc,rr.id desc	     
		";		
}
//echo $sql;	
    $result = mysqli_query($con,$sql);
	$rows=mysqli_num_rows($result);
if($rows!=0){
?>
    <ol class="carousel-indicators">
      <?php 
	  for($k=0;$k<$rows;$k++){
		  $actives="";
		  if($k==0){
			$actives="active";  
		  }
      ?>
     <li data-target="#myCarousel" data-slide-to="<?php echo $k;?>" class="<?php echo $actives;?>"></li>	  
     <?php 
	  }
	 ?>	  
	</ol>
	<!-- Wrapper for slides -->
    <div class="carousel-inner">
      <?php
	  
         $i=1;
		while($rerequest = mysqli_fetch_array($result,MYSQLI_ASSOC)){
			$image=$url."/".$rerequest['image'];
				  if($rerequest['image']==''){
					 $image=$url."/public/noimage.jpg";  
				  }
				  $active="";
				  if($i==1){
				  $active="active";	  
				  }
				  $des = strip_tags($rerequest['description']);
				  if (strlen($des) > 100) {

				// truncate string
					$stringCut = substr($des, 0, 100);
					$endPoint = strrpos($stringCut, ' ');

				//if the string doesn't contain any space then it will cut without word basis.
					$des = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
					//$string .= '... <a href="/this/story">Read More</a>';
					}
	  ?>
	  <div class="item <?php echo $active;?>">
        <img src="<?php echo $image;?>" alt="<?php echo $rerequest['title'];?>" >
         <div class="carousel-caption">
        <a href="<?php echo $rerequest['url'];?>" target="_blank">
		<h3><?php echo $rerequest['title'];?></h3>
        <p><?php echo $des;?></p> 
		</a>
      </div>
	  </div>
     <?php 
	 $i++;
		}
		
	 ?>
  
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
<?php
}			
?>