<?php 
namespace App\Models;  
use CodeIgniter\Model;
//print_r($this->db->getLastQuery());
class EmailManagementModel extends Model{
  
	
	public function getAllEmailList(){
	     $result=array();
		 $sql="SELECT * FROM `email_masters`";
		 $query=$this->db->query($sql);
		 $result=$query->getResultArray();
		 return $result;	
	}
	public function getSingleEmail($id){
		$result=array();
		 $sql="SELECT * FROM `email_masters` where id='".$id."'";
		 $query=$this->db->query($sql);
		 $result=$query->getResultArray();
		 return $result;
	}
	
}