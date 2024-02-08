<?php 
namespace App\Models;  
use CodeIgniter\Model;
class ChefModel extends Model{


	public function getAllPost(){
		$sql="select * from chefs  where  chefs.deleted_at=0"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
	}


	public function getSingleChef_detail($id = false) {

		
		$sq="select * from chefs where id='".$id."'";
       
		$query=$this->db->query($sq);
		$result=$query->getResultArray();
		if(isset($result[0])){
		return $result[0];	
		}else{
		return $result[0]=array();	
		}
		return $result;
    }
    public function getAllReChefCategories(){
		$sql="select * from chef_categories where deleted_at=0"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
	}
	public function getSingleReChefCategory($id = false){
		$sql="select * from chef_categories where id='".$id."'"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		if(isset($result[0])){
		return $result[0];	
		}else{
		return $result[0]=array();	
		}
	}
	public function deleteReChefCategory($id){
		$sql="update chef_categories set deleted_at=1 where id='".$id."'"; 
		$query=$this->db->query($sql);
	}
	public function insertReChefCategory($data){
		$status=array();
		$sql="select count(id) as cnt from chef_categories where name='".$data['name']."'"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		
		if($result[0]['cnt']==0){
		$this->db->table('chef_categories')->insert($data);
		$status=array('status'=>1);
		}else{
		$status=array('status'=>0);	
		}
		return $status;
	}
	public function updateReChefCategory($id,$data){
		$status=array();
		$sql="select id,count(id) as cnt from chef_categories where name='".$data['name']."'"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		
		if($result[0]['cnt']>0){
			if($result[0]['id']!=$id){
		    $status=array('status'=>0);
			}else{
			$status=array('status'=>1);	
			}   	
		
		}else{
		$status=array('status'=>1);	
		$sql="update chef_categories set name='".$data['name']."' where id='".$id."'"; 
		$this->db->query($sql);	
		}
        return $status;
	}
	public function updateReChefStatus($id,$data){
		$sql="update chefs set status='".$data['status']."' where id='".$id."'"; 
		$query=$this->db->query($sql);
	}
	public function getAllReChefs(){
		$sql="select u.name as user_name,u.email as user_email,u.mobile_no as user_phone,ru.*,rc.name as category_name from chefs ru inner join chef_categories rc on rc.id=ru.chef_category_id 
		left join users u on u.id=ru.posted_by
		where ru.deleted_at=0 order by ru.id desc"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
	}
	public function getAllUsers(){
		$sql="select id,name from users"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
	}
	public function getSingleReChef($id = false){
		$sql="select u.name as user_name,u.email as user_email,u.mobile_no as user_phone,ru.*,rc.id as category_id,rc.name as category_name from chefs ru 
		left join chef_categories rc on rc.id=ru.chef_category_id 
		left join users u on u.id=ru.posted_by		
		where ru.id='".$id."'"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		if(isset($result[0])){
		return $result[0];	
		}else{
		return $result[0]=array();	
		}
	}
	public function deleteReChef($id){
		$sql="update chefs set deleted_at=1 where id='".$id."'"; 
		$query=$this->db->query($sql);
	}
	public function insertReChef($data){
		$status=array();
		
		$this->db->table('chefs')->insert($data);
		$status=array('status'=>1);
		
		return $status;
	}
	public function updateReChef($id,$data){
		$status=array();
		$sql="update chefs set 
			chef_category_id='".$data['chef_category_id']."', 
			name='".$data['name']."', 
			email='".$data['email']."',  
			address='".$data['address']."', 
			location='".$data['location']."', 
			rating='".$data['rating']."', 
			contact_no='".$data['contact_no']."',
			updated_at='".$data['updated_at']."'";
		if($data['image']!=''){
			$sql.=",image='".$data['image']."'";
		}
		
		$sql.="where id='".$id."'";	 
		
		$this->db->query($sql);	
		
		$status=array('status'=>1);	
        return $status;
	}
	

	


}