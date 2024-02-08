<?php
include("config.php");
$me = $_SESSION['JD_CURRUNT_USER'];

	if(isset($_POST['chat_single_send']))
	{		
		$to     = $_POST['to'];
		$msg    = mysqli_real_escape_string($con,$_POST['msg'] );
		$date   = date("Y-m-d H:i:s");
		
		mysqli_query($con,"INSERT INTO chat(`id`, `sender`, `reciever`, `msg`, `time`)  VALUES(0,'$me','$to','$msg','$date')" );
        echo $date;		
	}
	
	if(isset($_POST['chat_single_get_all_msg']) && isset($_POST['chat_single_user']))
	{
		$return_string="";
		$set_unread="";
		$user = mysqli_real_escape_string($con,$_POST['chat_single_user']);
		$data=mysqli_query($con,"SELECT * FROM chat WHERE (sender = '$me' AND reciever = '$user') OR (sender = '$user' AND reciever = '$me') ORDER BY (time) ASC");
		while($row = mysqli_fetch_array($data,MYSQLI_ASSOC))
		{
			if($row['sender'] == $me){
				$data_user=mysqli_query($con,"SELECT name,profile_image FROM users WHERE id='".$row['sender']."'");
				$data_user_array=mysqli_fetch_array($data_user,MYSQLI_ASSOC);
				$return_string.="<div class='outgoing-chats'>
		    <div class='outgoing-chats-msg'>
			    <p><b>".$data_user_array['name']."</b><br>
				".$row['msg']."<br>".$row['time']."</p>
				
			</div>
			
		 </div>";
				
			}else{
				$data_user=mysqli_query($con,"SELECT name,profile_image FROM users WHERE id='".$row['sender']."'");
				$data_user_array=mysqli_fetch_array($data_user,MYSQLI_ASSOC);
			$return_string.= "<div class='received-chats'>
		  
			<div class='received-msg'>
			  <div class='received-msg-inbox'>
			    <p><b>".$data_user_array['name']."</b><br>
				".$row['msg']."<br>".$row['time']."</p>
			  </div>
			</div>
		 </div>";	
			} 
			$set_unread.="'".$row['id']."',";
			
		}
		$set_unread = trim($set_unread , ",");
		mysqli_query($con,"UPDATE chat SET status=1 WHERE id IN($set_unread)");
		
		echo $return_string;
	}
	
	if(isset($_POST['chat_single_get_update_message'])){
	    $return_string=array();
		$data=mysqli_query($con,"SELECT * FROM chat WHERE reciever = '$me'  and status=0");
	    
		while($row = mysqli_fetch_array($data,MYSQLI_ASSOC)){
			$data_user=mysqli_query($con,"SELECT name,profile_image FROM users WHERE id='".$row['sender']."'");
			$data_user_array=mysqli_fetch_array($data_user,MYSQLI_ASSOC);
			$return_string[$row['sender']][$row['id']]="<b>".$data_user_array['name']."</b><br>".$row['msg']."<br>".$row['time']."</b>";
			$set_unread.="'".$row['id']."',";
		}
		$set_unread = trim($set_unread , ",");
		mysqli_query($con,"UPDATE chat SET status=1 WHERE id IN($set_unread)");
		echo json_encode($return_string); 	
	}


	if(isset($_POST['chat_group_send']))
	{		
		$group_id     = $_POST['group_id'];
		$msg    = mysqli_real_escape_string($con,$_POST['msg'] );
		$date   = date("Y-m-d H:i:s");
		
		mysqli_query($con,"INSERT INTO chat_group_data(`id`, `group_id`, `user_id`, `msg`, `time`,`status_ids`)  VALUES(0,'".$group_id."','".$me."','".$msg."','".$date."','".$me."')" );
        echo $date;		
	}
	
	if(isset($_POST['chat_group_get_all_msg']) && isset($_POST['chat_group_user']))
	{
		$return_string="";
		$set_unread="";
		$group_id = mysqli_real_escape_string($con,$_POST['chat_group_user']);
		$data=mysqli_query($con,"SELECT * FROM chat_group_data WHERE 
		group_id = '".$group_id."'  ORDER BY (time) ASC");
		while($row = mysqli_fetch_array($data,MYSQLI_ASSOC))
		{
			if($row['user_id'] == $me){
				$data_user=mysqli_query($con,"SELECT name,profile_image FROM users WHERE id='".$row['user_id']."'");
				$data_user_array=mysqli_fetch_array($data_user,MYSQLI_ASSOC);
				$return_string.="<div class='outgoing-chats'>
		    <div class='outgoing-chats-msg'>
			    <p><b>".$data_user_array['name']."</b> 
				<br>".$row['msg']."<br> 
				".$row['time']."</b></p></div></div>";
				
			}else{
				$data_user=mysqli_query($con,"SELECT name,profile_image FROM users WHERE id='".$row['user_id']."'");
				$data_user_array=mysqli_fetch_array($data_user,MYSQLI_ASSOC);
			$return_string.= "<div class='received-chats'>
		  
			<div class='received-msg'>
			  <div class='received-msg-inbox'>
			    <p><b>".$data_user_array['name']."</b><br>
				".$row['msg']." 
				<br> 
				".$row['time']."</p>
				
			  </div>
			</div>
		 </div>";	
			} 
			
		}
		echo $return_string;
	}
	
	if(isset($_POST['chat_group_get_update_message'])){
	    $return_string=array();
		$group_id = mysqli_real_escape_string($con,$_POST['ids']);
		$data=mysqli_query($con,"SELECT * FROM chat_group_data 
		where group_id IN(".$group_id.")  and FIND_IN_SET(".$me.",status_ids) = 0 ");
	    
		$set_unread='';
		while($row = mysqli_fetch_array($data,MYSQLI_ASSOC)){
			$data_user=mysqli_query($con,"SELECT name,profile_image FROM users WHERE id='".$row['user_id']."'");
			$data_user_array=mysqli_fetch_array($data_user,MYSQLI_ASSOC);
			$return_string[$row['group_id']][$row['id']]="<b>".$data_user_array['name']."</b><br>".$row['msg']."<br>".$row['time']."</b>";
			$set_unread.="'".$row['id']."',";
		}
		if($set_unread!=''){
		$set_unread = trim($set_unread , ",");
		
		mysqli_query($con,"UPDATE chat_group_data  set status_ids=CONCAT(status_ids,',".$me."') WHERE id IN($set_unread)");	
		}

		echo json_encode($return_string); 	
	}
	
	if(isset($_POST['create_group'])){
		$group_name=$_POST['group_name'];
		$group_member=explode(",",$_POST['group_member']);
		$date=date("Y-m-d H:i:s");
		$sql_already=mysqli_query($con,"select group_id from chat_group where group_name='".$group_name."'");
		$rowcount=mysqli_num_rows($sql_already);
		if($rowcount!=0){
			echo "alreay taken";
		}else{
				mysqli_query($con,"INSERT INTO chat_group(`group_id`, `group_name`, `created_at`, `updated_at`, `created_by`, `status`)  VALUES(0,'".$group_name."','".$date."','".$date."','1','1')");
		         $group_id=mysqli_insert_id($con);
		         foreach($group_member as $memberval){
		            mysqli_query($con,"INSERT INTO chat_group_member(`id`, `user_id`, `group_id`, `created_at`)  VALUES(0,'".$memberval."','".$group_id."','".$date."')");	
		          }
	       echo "success";
		}
		
	}
?>

