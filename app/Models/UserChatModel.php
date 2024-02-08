<?php 
namespace App\Models;  
use CodeIgniter\Model;
//print_r($this->db->getLastQuery());
class UserChatModel extends Model{
  
	public function getChatUsers() {
		
		 $result_sender=array();
		 $sql_sender="SELECT id,name,profile_image FROM users ORDER BY name desc";
		 $query_sender=$this->db->query($sql_sender);
		 $result_sender=$query_sender->getResultArray();
		 return $result_sender;
        
    }
	public function getChatGroups($userId){
	 $result_sender=array();
		 $sql_sender="SELECT cg.group_name,cg.group_id FROM chat_group_member cgm inner join chat_group cg 
        on cgm.group_id=cg.group_id
		where cgm.user_id='".$userId."'";
		 $query_sender=$this->db->query($sql_sender);
		 $result_sender=$query_sender->getResultArray();
		 return $result_sender;	
	}
	
}