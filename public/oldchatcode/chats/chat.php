<?php
session_start();
$_SESSION['JD_CURRUNT_USER']=$_GET['id'];
include("config.php");
?>
<html>
<head>
<link rel="stylesheet" href="css/bootstrap.min.css" >
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/chat.css"  />
<script src="js/jquery-1.11.2.min.js" ></script>
<script src="js/chat.js" ></script>
</head>
</head>
<body>
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
<input type="button" class="create_group_btn" onclick="return create_group()" name="create" id="create" value="create">

</div>
		</div>
	</div>
</div>
<div id="chat_group_list">
  <div class="chat_group_main_div">
  <div class="chat_group_list_header">Groups</div>
	<div class="chat_group_list_body">
		<?php
		
		$sql = "SELECT cg.group_name,cg.group_id FROM chat_group_member cgm inner join chat_group cg 
        on cgm.group_id=cg.group_id
		where cgm.user_id='".$_SESSION['JD_CURRUNT_USER']."'";
        $result = mysqli_query($con,$sql);
		$group_ids='';
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
		$group_ids.=$row['group_id'].",";
		?>
         <span class="chat_group_name"  id="group_<?php echo $row['group_id'];?>"> 
		 <?php echo $row['group_name'];?> </span>
		<?php		
		}
		if($group_ids!=''){
			$group_ids=trim($group_ids,",");
		}
		?>
		
		<input type="hidden" id="chat_group_ids" value="<?php echo $group_ids;?>">
		<?php 
		$sql_user = "SELECT name FROM users where id='".$_SESSION['JD_CURRUNT_USER']."'";
        $result_user = mysqli_query($con,$sql_user);
		$row_user = mysqli_fetch_array($result_user,MYSQLI_ASSOC);
		$name=$row_user['name'];
		?>
		<input type="hidden" id="login_user_name" value="<?php echo $name;?>">
		</div>
     	<div class="chat_group_list_footer">
		<input style="width:100% !important" id="chat_group_item_search" placeholder="Serach">
		</div>
	
</div>	
</div>
<?php /* ?>
<div id="chat_user_list">

		<div class="chat_user_list_header">Chat</div>
		
		<div class="chat_user_list_body">
		<?php
		$name='';
		$sql = "SELECT * FROM users ORDER BY name";
        $result = mysqli_query($con,$sql);
		$friend_ids='';
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
		if($row['id']!=$_GET['id']){
		$friend_ids.=$row['id'].",";
		?>
         <span class="chat_user_name"  id="<?php echo $row['id'];?>"> <?php echo $row['name'];?></span>
		<?php		
		}else{
			$name=$row['name'];
			
		}
		}
		if($friend_ids!=''){
			$friend_ids=trim($friend_ids,",");
		}
        ?>
       <input type="hidden" id="chat_friend_ids" value="<?php echo $friend_ids;?>">
		</div>			
		<div class="chat_user_list_footer"><input style="width:100% !important" id="search_chat" placeholder="Serach"></div>

	
</div>
<?php */ ?>
</body>
</html>
