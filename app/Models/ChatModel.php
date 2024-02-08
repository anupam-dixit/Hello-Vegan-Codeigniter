<?php 
namespace App\Models;  
use CodeIgniter\Model;
//print_r($this->db->getLastQuery());
class ChatModel extends Model{
  
	public function getAllChatUsers() {
		
		 $result_sender=array();
		 $sql_sender="select c.sender,c.reciever,u1.name as sender_name,u2.name as reciever_name from chat  c
		 inner join users u1 on u1.id=c.sender
		 inner join users u2 on u2.id=c.reciever
		 group by IF(c.sender > c.reciever, c.sender,c.reciever),
         IF(c.sender > c.reciever, c.reciever,c.sender) order by c.id asc";
		 $query_sender=$this->db->query($sql_sender);
		 $result_sender=$query_sender->getResultArray();
		 return $result_sender;
        /* $sql_sender="select sender from chat group by sender"; 
		$query_sender=$this->db->query($sql_sender);
		$chat_ids='';
		$uniqueStr='';
		$result=array();
		$result_sender=$query_sender->getResultArray();
		if(count($result_sender)!=0){
			foreach($result_sender as $val_sender){
			$chat_ids.=$val_sender['sender'].",";	
			}
			
		}
		
		
		if($chat_ids!=''){
			$chat_ids=rtrim($chat_ids,",");	
			$uniqueStr = implode(',', array_unique(explode(',', $chat_ids)));
			}
		
		if($uniqueStr!=''){
		$sql="select name,id from users where id in(".$uniqueStr.")"; 
		$query=$this->db->query($sql);
        $result=$query->getResultArray();		
		}
		return $result; */
    }
	public function getAllChatGroups(){
	 $result_sender=array();
		 $sql_sender="SELECT * FROM `chat_group`";
		 $query_sender=$this->db->query($sql_sender);
		 $result_sender=$query_sender->getResultArray();
		 return $result_sender;	
	}
	public function getUsersMessage($user1,$user2){
		$sql_sender="SELECT c.sender,c.reciever,c.msg,c.time,u1.name as sender_name,u2.name as reciever_name FROM chat c 
		inner join users u1 on u1.id=c.sender
		 inner join users u2 on u2.id=c.reciever
		WHERE (c.sender = '".$user1."' AND c.reciever = '".$user2."') OR (c.sender = '".$user2."' AND c.reciever = '".$user1."') ORDER BY (c.time) ASC";
		 $query_sender=$this->db->query($sql_sender);
		 $result_sender=$query_sender->getResultArray();
		 return $result_sender;
	}
	public function getGroupsMessage($groupId){
	$sql_sender="SELECT c.*,u1.name as uname FROM chat_group_data c
	inner join users u1 on u1.id=c.user_id
		
		where c.group_id IN(".$groupId.")";
		 $query_sender=$this->db->query($sql_sender);
		 $result_sender=$query_sender->getResultArray();
		 return $result_sender;	
	}
}