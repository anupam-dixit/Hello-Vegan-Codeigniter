<?php 

namespace App\Models;  
use CodeIgniter\Model;

  
class CooksModel extends Model{


	public function getAllPost(){
		$sql="select * from cooks  where  cooks.deleted_at=0"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
	}

	public function getAllPostForApi($id,$start,$limit){
		$sql="select * from cooks  where  cooks.deleted_at=0 order by cooks.id desc limit $start,$limit"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
	}


	public function getSinglecooks_detail($id = false) {

		
		$sq="select c.*,cc.id as category_id,cc.name as  category_name from cooks c
		inner join cooks_categories cc on cc.id=c.cooks_category
		where c.id='".$id."'";
       
		$query=$this->db->query($sq);
		$result=$query->getResultArray();
		if(isset($result[0])){
		return $result[0];	
		}else{
		return $result[0]=array();	
		}
		return $result;
    }


	


}