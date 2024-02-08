<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("chat.config.php");
?>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" >
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
</head>
<body>

<div id="jd-chat">
	<div class="jd-online">
		<div class="jd-header">Chat</div>
		
		<div class="jd-body">
		<?php
		$name='';
		$sql = "SELECT * FROM users ORDER BY name";
        $result = mysqli_query($con,$sql);
		$friend_ids='';
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
		if($row['id']!=$_GET['id']){
		$friend_ids.=$row['id'].",";
		?>
         <span class="jd-online_user"  id="<?php echo $row['id'];?>"> <?php echo $row['name'];?></span>
		<?php		
		}else{
			$name=$row['name'];
			
		}
		}
		if($friend_ids!=''){
			$friend_ids=trim($friend_ids,",");
		}
        ?>
     
			
		<input type="hidden" id="loginuser" value="<?php echo $_SESSION['JD_CURRUNT_USER'];?>">
		<input type="hidden" id="loginuser_friends_ids" value="<?php echo $friend_ids;?>">
		<input type="hidden" id="username" value="<?php echo $name;?>">
		</div>			
		<div class="jd-footer"><input style="width:100% !important" id="search_chat" placeholder="Serach"></div>
	</div>
	
</div>
<?php
	$_SESSION['JD_CURRUNT_USER']=$_GET['id'];
	echo "Your are <b>".$name."</b>";
?>
<link href="jd.css" rel="stylesheet" />
<script src="jquery-1.11.2.min.js" ></script>
<script src="jd.js" ></script>
</body>
</html>
