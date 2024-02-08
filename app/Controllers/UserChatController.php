<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\BlogModel;
use App\Models\UserChatModel;
class UserChatController extends BaseController
{
	public function index()
	{

	}
	
	public function dashboardchatUser(){
		$session = session();
        //$ses_data = ['idUserH' => 3,'nameUserH' => 'pradeep'];
        //$session->set($ses_data);	
		$users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$data['session'] =$session;
		/* echo "<pre>";
		print_r($data);
		die; */
		return view('user/dashboardchat/dashboardchatUser',$data);
	}
	
	public function chatClassPhp(){
    $session = session();
    $me = $session->get('idUserH');
    $db = db_connect();
	
	if($this->request->getPost('send')!='')
	{		
		
		$to     = $this->request->getPost('to');
		$msg    = $db->escapeString($this->request->getPost('msg'));
		$date   = date("Y-m-d H:i:s");
		
		$db->query("INSERT INTO chat(`id`, `sender`, `reciever`, `msg`, `time`)  VALUES(0,'$me','$to','$msg','$date')" );
        echo date('H:i',strtotime($date));	
	}
	
	if($this->request->getPost('get_all_msg')!='' && $this->request->getPost('user')!='')
	{
		$return_string="";
		$set_unread="";
		$user = $this->request->getPost('user');
		
		$data=$db->query("SELECT * FROM chat WHERE (sender = '$me' AND reciever = '$user') OR (sender = '$user' AND reciever = '$me') ORDER BY (time) ASC");
		$flag='';
	
		foreach($data->getResult() as $row)
		{
		   
		   if($flag!=date('M d Y',strtotime($row->time))){
		   $return_string.="<div class='chat-date-heading'>".date('M d Y',strtotime($row->time))."</div>";
		   $flag=date('M d Y',strtotime($row->time));
		   
		   }
			if($row->sender == $me){
				$data_user=$db->query("SELECT name,profile_image FROM users WHERE id='".$row->sender."'");
				$data_user_array=$data_user->getResult();
				$return_string.="<div class='outgoing-chats'>
		    <div class='outgoing-chats-msg'>
			   
			    <p class='out-title'>".$data_user_array[0]->name."</p>
				<p class='out-time'>".date('H:i',strtotime($row->time))."</p>
				<p class='out-msg'>".$row->msg."</p>
				
				
			</div>
			
		 </div>";
				
			}else{
				$data_user=$db->query("SELECT name,profile_image FROM users WHERE id='".$row->sender."'");
				$data_user_array=$data_user->getResult();
			    $return_string.= "<div class='received-chats'>
		  
			<div class='received-msg'>
			  <div class='received-msg-inbox'>
			     <p class='in-title'>".$data_user_array[0]->name."</p>
				<p class='in-time'>".date('H:i',strtotime($row->time))."</p>
				<p class='in-msg'>".$row->msg."</p>
			  </div>
			</div>
		 </div>";	
			} 
			
			 
			$set_unread.="'".$row->id."',";
			
		}
		$set_unread = trim($set_unread , ",");
		$db->query("UPDATE chat SET status=1 WHERE id IN($set_unread)");
		
		echo $return_string;
	} 
	if($this->request->getPost('get_update_message_ids')!=''){
	    $return_string=array();
		$user = $this->request->getPost('user');
		$data=$db->query("SELECT sender FROM chat WHERE  reciever = '$me' and status=0");
	
		foreach($data->getResult() as $row){
			
			$return_string[]=$row->id;
		}
		echo json_encode($return_string);	
	}
	 if($this->request->getPost('get_update_message')!=''){
	    $return_string=array();
		$set_unread="";
		
		$data=$db->query("SELECT * FROM chat WHERE reciever = '".$me."'  and status=0");
	    
		foreach($data->getResult() as $row){
			//echo json_encode($row);
			if($row->sender!=''){
			$data_user=$db->query("SELECT name,profile_image FROM users WHERE id='".$row->sender."'");
			$data_user_array=$data_user->getResult();
			if(isset($data_user_array[0])){
			/* $return_string[$row->sender][$row->id]="<b>".$data_user_array[0]->name."</b><br>".$row->msg."<br>".date('H:i',strtotime($row->time))."</b>"; */$return_string[$row->sender][$row->id]="<p class='in-title'>".$data_user_array[0]->name."<p><p class='in-time'>".date('H:i',strtotime($row->time))."</p><p class='in-msg'>".$row->msg."</p>";
			$set_unread.="'".$row->id."',";	
			}
				
			}
			 
		}
		if($set_unread!=''){
		$set_unread = trim($set_unread , ",");
		$db->query("UPDATE chat SET status=1 WHERE id IN($set_unread)");
			
		}
		echo json_encode($return_string); 	
	}
	}
	public function chatGroupClassPhp(){
		$session = session();
        $me = $session->get('idUserH');
        $db = db_connect();
			if($this->request->getPost('send')!=''){		
			$group_id     = $this->request->getPost('group_id');
			$msg    = $db->escapeString($this->request->getPost('msg'));
			$date   = date("Y-m-d H:i:s");
		
		$db->query("INSERT INTO chat_group_data(`id`, `group_id`, `user_id`, `msg`, `time`,`status_ids`)  VALUES(0,'".$group_id."','".$me."','".$msg."','".$date."','".$me."')" );
        echo date('H:i',strtotime($date));		
	}
	
	if($this->request->getPost('get_all_msg')!='' && $this->request->getPost('user')!='')
	{
		$return_string="";
		$set_unread="";
		$group_id = $this->request->getPost('user');
		$data=$db->query("SELECT * FROM chat_group_data WHERE 
		group_id = '".$group_id."'  ORDER BY (time) ASC");
		 foreach($data->getResult() as $row){
			if($row->user_id == $me){
				$data_user=$db->query("SELECT name,profile_image FROM users WHERE id='".$row->user_id."'");
				$data_user_array=$data_user->getResult();
				$return_string.="<div class='outgoing-chats'>
		    <div class='outgoing-chats-msg'>
			    <p class='out-title'>".$data_user_array[0]->name."</p>
                <p class='out-time'>".date('H:i',strtotime($row->time))."</p>
                <p class='out-msg'>".$row->msg."</p> 				
		    </div></div>";
				
			}else{
				$data_user=$db->query("SELECT name,profile_image FROM users WHERE id='".$row->user_id."'");
				$data_user_array=$data_user->getResult();
			$return_string.= "<div class='received-chats'>
		  
			<div class='received-msg'>
			  <div class='received-msg-inbox'>
			    <p class='in-title'>".$data_user_array[0]->name."</p>
				<p class='in-time'>".date('H:i',strtotime($row->time))."</p>
				<p class='in-msg'>".$row->msg."</p>
				
			  </div>
			</div>
		 </div>";	
			} 
			
		}
		echo $return_string;
	}
	
	if($this->request->getPost('get_update_message')!=''){
	    $return_string=array();
		$group_id = $this->request->getPost('ids');
		$set_unread ='';
		if($group_id!=''){
		$data=$db->query("SELECT * FROM chat_group_data 
		where group_id IN(".$group_id.")  and FIND_IN_SET(".$me.",status_ids) = 0 ");
	    
		$set_unread='';
		 foreach($data->getResult() as $row){
			$data_user=$db->query("SELECT name,profile_image FROM users WHERE id='".$row->user_id."'");
			$data_user_array=$data_user->getResult();
			$return_string[$row->group_id][$row->id]="<b>".$data_user_array[0]->name."</b><br>".$row->msg."<br>".date('H:i',strtotime($row->time))."</b>";
			$set_unread.="'".$row->id."',";
		}
		if($set_unread!=''){
		$set_unread = trim($set_unread , ",");
		
		$db->query("UPDATE chat_group_data  set status_ids=CONCAT(status_ids,',".$me."') WHERE id IN($set_unread)");	
		}
	
		}
		
		echo json_encode($return_string); 	
	}
	
	if($this->request->getPost('create_group')!=''){
		$group_name=$db->escapeString($this->request->getPost('group_name'));
		$group_member=explode(",",$this->request->getPost('group_member'));
		$group_member[]=$_SESSION['idUserH'];
		
		$date=date("Y-m-d H:i:s");
		$sql_already=$db->query("select group_id from chat_group where group_name='".$group_name."'");
		$rowcount=$sql_already->getNumRows();
		if($rowcount!=0){
			echo "alreay taken";
		}else{
				$db->query("INSERT INTO chat_group(`group_id`, `group_name`, `created_at`, `updated_at`, `created_by`, `status`)  VALUES(0,'".$group_name."','".$date."','".$date."','1','1')");
		         $group_id=$db->insertID();
		         foreach($group_member as $memberval){
		        	$db->query("INSERT INTO chat_group_member(`id`, `user_id`, `group_id`, `created_at`)  VALUES(0,'".$memberval."','".$group_id."','".$date."')"); 	
		         }
	       echo $group_id;
		}
		
	}
	}
	
}
