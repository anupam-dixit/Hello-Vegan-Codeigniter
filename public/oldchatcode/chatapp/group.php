<?php
session_start();
$_SESSION['JD_CURRUNT_USER']=$_GET['id'];
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("chat_group.class.php");
?>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" >
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
</head>
<body>
<?php 
echo "Your are <b>".$_SESSION['JD_CURRUNT_USER']."</b>";
?>
<div class="creategroup">
<a href="#popup1">
Create Group
</a>

</div>
<div id="popup1" class="overlay">
	<div class="popup">
<a class="close" href="#">&times;</a>
		<div class="content">
<div>
<label>Group Name</label>
<input type="text" name="group_name" id="group_name">
</div>
<div>
<label style="font-weight: bold;font-size: 21px;padding-left: 117px;">Add Members</label>

</div>			
<?php
$sql_u = "SELECT * FROM users ORDER BY name";
$result_u = mysqli_query($con,$sql_u);
$i=1;
while($row_u = mysqli_fetch_array($result_u,MYSQLI_ASSOC)){
?>
<div style="float:left;width:100%;margin-top:5px;">
	<input id="member<?php echo $i;?>" value="<?php echo $row_u['id'];?> " type="checkbox" name="member_name">
	<label for="member<?php echo $i;?>"><?php echo $row_u['name'];?></label>
</div>
<?php 
$i++;
}
?>
<div>
<input type="button"  style="background-color: black;color: #fff;float: right;padding-left: 5px;padding-right: 5px;padding-top: 2px;padding-bottom: 6px;border-radius: 15px;width: 106px;text-transform: capitalize;font-weight: bold;border:1px solid #000;" onclick="return create_group()" name="create" id="create" value="create">

</div>
		</div>
	</div>
</div>
<div id="jd-chat">

	<div class="jd-online">
		<div class="jd-header">Groups</div>
		
		<div class="jd-body">
		<?php
		
		$sql = "SELECT cg.group_name,cg.group_id FROM chat_group_member cgm inner join chat_group cg 
        on cgm.group_id=cg.group_id
		where cgm.user_id='".$_SESSION['JD_CURRUNT_USER']."'";
        $result = mysqli_query($con,$sql);
		$group_ids='';
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
		$group_ids.=$row['group_id'].",";
		?>
         <span class="jd-online_user"  id="<?php echo $row['group_id'];?>"> 
		 <?php echo $row['group_name'];?> <i class="light">&#8226;</i> </span>
		<?php		
		}
		if($group_ids!=''){
			$group_ids=trim($group_ids,",");
		}
		?>
		<input type="hidden" id="loginuser" value="<?php echo $_SESSION['JD_CURRUNT_USER'];?>">
		<input type="hidden" id="loginuser_group_ids" value="<?php echo $group_ids;?>">
		<?php 
		$sql_user = "SELECT name FROM users where id='".$_SESSION['JD_CURRUNT_USER']."'";
        $result_user = mysqli_query($con,$sql_user);
		$row_user = mysqli_fetch_array($result_user,MYSQLI_ASSOC);
		$name=$row_user['name'];
		?>
		<input type="hidden" id="username" value="<?php echo $name;?>">
     	<div class="jd-footer"><input style="width:100% !important" id="search_chat" placeholder="Serach"></div>
	</div>
	
</div>

<link href="jd.css" rel="stylesheet" />
<script src="jquery-1.11.2.min.js" ></script>
<script src="jd_group.js" ></script>
</body>
</html>
