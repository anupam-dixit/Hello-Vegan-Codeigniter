<?php
include("chat.config.php");
$me = $_SESSION['JD_CURRUNT_USER'];

	if(isset($_POST['send']))
	{		
		$to     = $_POST['to'];
		$msg    = mysqli_real_escape_string($con,$_POST['msg'] );
		$date   = date("Y-m-d H:i:s");
		
		mysqli_query($con,"INSERT INTO chat(`id`, `sender`, `reciever`, `msg`, `time`)  VALUES(0,'$me','$to','$msg','$date')" );
        echo $date;		
	}
	
	if(isset($_POST['get_all_msg']) && isset($_POST['user']))
	{
		$return_string="";
		$set_unread="";
		$user = mysqli_real_escape_string($con,$_POST['user']);
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
	if(isset($_POST['get_update_message_ids'])){
	    $return_string=array();
		$user = mysqli_real_escape_string($con,$_POST['user']);
		$data=mysqli_query($con,"SELECT sender FROM chat WHERE  reciever = '$me' and status=0");
	
		while($row = mysqli_fetch_array($data,MYSQLI_ASSOC)){
			
			$return_string[]=$row['id'];
		}
		echo json_encode($return_string);	
	}
	if(isset($_POST['get_update_message'])){
	    $return_string=array();
		//$user = mysqli_real_escape_string($con,$_POST['user']);
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
	
	
?>
