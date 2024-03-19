<?php
namespace App\Controllers;
use App\Models\SubscriptionPurchaseModel;
use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\AdminModel;
use App\Models\UserChatModel;
class ApiChatController extends BaseController
{
	public function getChatGroups(){
		 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
		$users = new UserChatModel();
		$userId=$this->request->getVar('userId');
		$data['chatgroups'] =$users->getChatGroups($userId);
		echo json_encode($data);
		
	}
	public function getChatUsers(){
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
		header('Access-Control-Allow-Headers: token, Content-Type');
		$users = new UserChatModel();
		$userId=$this->request->getVar('userId');
		$data['chatusers'] =$users->getChatUsers($userId);
		echo json_encode($data);
		
	}
	public function messageSend(){
		 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
    $me = $this->request->getVar('userId');
    $db = db_connect();
	$to = $this->request->getVar('touserId');
	$msg = $db->escapeString($this->request->getVar('msg'));
	$date   = date("Y-m-d H:i:s");
	$db->query("INSERT INTO chat(`id`, `sender`, `reciever`, `msg`, `time`)  VALUES(0,'$me','$to','$msg','$date')" );
     $data['msg']='successfully inserted';
     $data['time']=date('H:i',strtotime($date));
	 echo json_encode($data);	
	}
	public function messageReceiveSingle(){
		 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
      $db = db_connect();
	  $me = $this->request->getVar('userId');
	  $to = $this->request->getVar('touserId');
	    $return_string['result']=array();
		$return_strings['results']=array();
		$set_unread="";
		
		$data=$db->query("SELECT * FROM chat WHERE reciever = '".$me."' and sender='".$to."'  and status=0");
	    $k=0;
		foreach($data->getResult() as $row){
			if($row->sender!=''){
			$data_user=$db->query("SELECT name,profile_image FROM users WHERE id='".$row->sender."'");
			$data_user_array=$data_user->getResult();
			if(isset($data_user_array[0])){
               $return_string['result'][$row->sender][$row->id]="<p class='in-title'>".$data_user_array[0]->name."<p><p class='in-time'>".date('H:i',strtotime($row->time))."</p><p class='in-msg'>".$row->msg."</p>";
			   $set_unread.="'".$row->id."',";
              			
			}
				
			}
		$k++;	 
		}
		
		if($set_unread!=''){
			foreach($return_string['result'] as $key=>$value){
				sort($value);
				$return_strings['results'][$key]=$value;
			}
		
		
		$set_unread = trim($set_unread , ",");
		//$db->query("UPDATE chat SET status=1 WHERE id IN($set_unread)");
			
		}
		echo json_encode($return_strings); 	
	}
	public function messageReceiveAll(){
		 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
      $db = db_connect();
	  $me = $this->request->getVar('userId');
	    $return_string['result']=array();
		$return_strings['results']=array();
		$set_unread="";
		
		$data=$db->query("SELECT * FROM chat WHERE reciever = '".$me."'  and status=0");
	    $k=0;
		foreach($data->getResult() as $row){
			if($row->sender!=''){
			$data_user=$db->query("SELECT name,profile_image FROM users WHERE id='".$row->sender."'");
			$data_user_array=$data_user->getResult();
			if(isset($data_user_array[0])){
               $return_string['result'][$row->sender][$row->id]="<p class='in-title'>".$data_user_array[0]->name."<p><p class='in-time'>".date('H:i',strtotime($row->time))."</p><p class='in-msg'>".$row->msg."</p>";
			   $set_unread.="'".$row->id."',";
              			
			}
				
			}
		$k++;	 
		}
		
		if($set_unread!=''){
			foreach($return_string['result'] as $key=>$value){
				sort($value);
				$return_strings['results'][$key]=$value;
			}
		
		
		$set_unread = trim($set_unread , ",");
		//$db->query("UPDATE chat SET status=1 WHERE id IN($set_unread)");
			
		}
		echo json_encode($return_strings); 	
	}
	
	public function messageSendReceiveAll(){
		 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
		$db = db_connect();
	
		$set_unread="";
		$me = $this->request->getVar('userId');
		$user = $this->request->getVar('touserId');
	    $data=$db->query("SELECT * FROM chat WHERE (sender = '$me' AND reciever = '$user') OR (sender = '$user' AND reciever = '$me') ORDER BY (time) ASC");
		$flag='';
	    $i=0;
		$r_string='';
		$return_string['result']=array();
		foreach($data->getResult() as $row)
		{
		   
		   
		   if($flag!=date('M d Y',strtotime($row->time))){
		   $r_string.="<div class='chat-date-heading'>".date('M d Y',strtotime($row->time))."</div>";
		   $flag=date('M d Y',strtotime($row->time));
		   
		   }
			if($row->sender == $me){
				$data_user=$db->query("SELECT name,profile_image FROM users WHERE id='".$row->sender."'");
				$data_user_array=$data_user->getResult();
				$r_string.="<div class='outgoing-chats'>
		    <div class='outgoing-chats-msg'>
			   
			    <p class='out-title'>".$data_user_array[0]->name."</p>
				<p class='out-time'>".date('H:i',strtotime($row->time))."</p>
				<p class='out-msg'>".$row->msg."</p>
				
				
			</div>
			
		 </div>";
				
			}else{
				$data_user=$db->query("SELECT name,profile_image FROM users WHERE id='".$row->sender."'");
				$data_user_array=$data_user->getResult();
			    $r_string.= "<div class='received-chats'>
		  
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
			$i++;
		}
		$set_unread = trim($set_unread , ",");
		//$db->query("UPDATE chat SET status=1 WHERE id IN($set_unread)");
		$return_string['result']=$r_string;
		
		echo json_encode($return_string); 	
	}
	public function groupMessageSend(){
		 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
		
        $me = $this->request->getVar('userId');
        $db = db_connect();
		$group_id     = $this->request->getVar('groupId');
		$msg    = $db->escapeString($this->request->getVar('msg'));
		$date   = date("Y-m-d H:i:s");
		
		$db->query("INSERT INTO chat_group_data(`id`, `group_id`, `user_id`, `msg`, `time`,`status_ids`)  VALUES(0,'".$group_id."','".$me."','".$msg."','".$date."','".$me."')" );
        $data['msg']='successfully inserted';
        $data['time']=date('H:i',strtotime($date));
	    echo json_encode($data);		
	}
	public function groupMessageReceive(){
		 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
		$db = db_connect();
		$return_string=array();
		$me = $this->request->getVar('userId');
		$group_id = $this->request->getVar('groupId');
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
		
		//$db->query("UPDATE chat_group_data  set status_ids=CONCAT(status_ids,',".$me."') WHERE id IN($set_unread)");	
		}
	
		}
		
		echo json_encode($return_string);
	}
	public function groupMessageSendReceiveAll(){
		 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
		$db = db_connect();
		$return_string="";
		$set_unread="";
		$me = $this->request->getVar('userId');
		$group_id = $this->request->getVar('groupId');
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
		$return_strings['result']=$return_string;
		echo json_encode($return_strings);
		
	}
	public function createGroup(){
		 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
		$db = db_connect();
		$group_name=$db->escapeString($this->request->getVar('groupName'));
		$group_member=explode(",",$this->request->getVar('groupMember'));
		$group_member[]=$this->request->getVar('userId');
		
		$date=date("Y-m-d H:i:s");
		$sql_already=$db->query("select group_id from chat_group where group_name='".$group_name."'");
		
				$db->query("INSERT INTO chat_group(`group_id`, `group_name`, `created_at`, `updated_at`, `created_by`, `status`)  VALUES(0,'".$group_name."','".$date."','".$date."','1','1')");
		         $group_id=$db->insertID();
		         foreach($group_member as $memberval){
		        	$db->query("INSERT INTO chat_group_member(`id`, `user_id`, `group_id`, `created_at`)  VALUES(0,'".$memberval."','".$group_id."','".$date."')"); 	
		         }
	       $data['msg']='successfully created';
     $data['time']=date('Y-m-d H:i',strtotime($date));
	 echo json_encode($data);
		
	}
}
?>
