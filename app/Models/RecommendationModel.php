<?php 

namespace App\Models;  
use CodeIgniter\Model;

  
class RecommendationModel extends Model{

	public function getAllReCategories() {
        $sql="select * from recommendation_categories where deleted_at=0"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
    }

    public function getReReceipesByUser($id) {
		
		$userids="0,".$id.",";
		$sql="select sender_id from users_friend where receiver_id='".$id."'";
		$query=$this->db->query($sql);
		$sender=$query->getResultArray();
		
		foreach($sender as $val){
			$userids.=$val['sender_id'].',';
		}
		
		$sql="select receiver_id from users_friend where sender_id='".$id."'";
		$query=$this->db->query($sql);
		$receiver=$query->getResultArray();
		foreach($receiver as $val){
			$userids.=$val['receiver_id'].',';
		}
		$userids=rtrim($userids,",");

		$sq= "select r.*,  rc.name as category_name,u.name as user_name, u.email as users_email,u.mobile_no as user_phone,au.name as admin_user_name,au.email as admin_user_email from receipes r
		inner join receipe_categories rc on rc.id= r.receipe_category_id
		left join users u on u.id=r.admin_id
		left join admin_users au on r.admin_id=0
		where r.deleted_at=0 and r.admin_id in (".$userids.") and r.id !=(select id from receipes where admin_id in (".$userids.")
		order by id desc limit 0,1)
		order by  r.id desc limit 0,3 ;";
		
		$query=$this->db->query($sq);
		$result=$query->getResultArray();
		return $result;
    }






	public function getSingleReCategory($id = false) {
        $sql="select * from recommendation_categories where id='".$id."'"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		if(isset($result[0])){
		return $result[0];	
		}else{
		return $result[0]=array();	
		}
    }
	public function deleteReCategory($id){
		$sql="update recommendation_categories set deleted_at=1 where id='".$id."'"; 
		$query=$this->db->query($sql);
	}
	public function insertReCategory($data){
		$status=array();
		$sql="select count(id) as cnt from recommendation_categories where name='".$data['name']."'"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		
		if($result[0]['cnt']==0){
		$this->db->table('recommendation_categories')->insert($data);
		$status=array('status'=>1);
		}else{
		$status=array('status'=>0);	
		}
		return $status;
	}
	public function updateReCategory($id,$data){
		$status=array();
		$sql="select id,count(id) as cnt from recommendation_categories where name='".$data['name']."'"; 
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
		$sql="update recommendation_categories set name='".$data['name']."' where id='".$id."'"; 
		$this->db->query($sql);	
		}
        return $status;
		
	}
	//users request
	public function getAllUsers() {
        $sql="select id,name from users"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
    }
	public function getAllReRequests() {
        $sql="select rp.plan_name as user_plan,u.name as user_name,u.email as user_email,u.mobile_no as user_phone,ru.*,rc.name as category_name from recommendation_requests ru inner join recommendation_categories rc on rc.id=ru.category 
		left join users u on u.id=ru.user_id
		left join recommendation_plans rp on ru.plan=rp.id
		where ru.deleted_at=0 order by ru.id desc"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
    }

	public function getAllReRequestsByUser() {
        $sql="select rp.plan_name as user_plan,u.name as user_name,u.email as user_email,u.mobile_no as user_phone,ru.*,rc.name as category_name from recommendation_requests ru inner join recommendation_categories rc on rc.id=ru.category 
		left join users u on u.id=ru.user_id
		left join recommendation_plans rp on ru.plan=rp.id
		where ru.deleted_at=0 order by ru.id desc limit 0,2"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
    }


    public function recommendationRestutent(){
		$sql="select * from restaurants  where  restaurants.deleted_at=0 order by restaurants.id DESC  limit 0,2"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
	}

	 public function recommendationProduct(){
		$sql="select * from product  where  product.deleted_at=0 order by product.id DESC  limit 0,3"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
	}

	 public function recommendationProductForApi(){
		$sql="select * from product  where  product.deleted_at=0 order by product.id DESC  limit 0,4"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
	}


	 public function recommendationCook(){
		$sql="select * from cooks  where  cooks.deleted_at=0 order by cooks.id DESC  limit 0,2"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
	}

	public function recommendationCookForApi(){
		$sql="select * from cooks  where  cooks.deleted_at=0 order by cooks.id DESC  limit 0,3"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
	}

	public function recommendationRecipe(){
		$sql="select * from receipe_user  where  receipe_user.deleted_at=0 order by receipe_user.id DESC  limit 0,3"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
	}

	public function recommendationRecipeForApi(){
		$sql="select * from receipe_user  where  receipe_user.deleted_at=0 order by receipe_user.id DESC  limit 0,2"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
	}



	public function getSingleReRequest($id = false) {
        $sql="select u.name as user_name,u.email as user_email,u.mobile_no as user_phone,ru.*,rc.id as category_id,rc.name as category_name,rp.id as plan_id,rp.plan_name as plan_name from recommendation_requests ru 
		left join recommendation_categories rc on rc.id=ru.category 
		left join recommendation_plans rp on rp.id=ru.plan
        inner join users u on u.id=ru.user_id		
		where ru.id='".$id."'"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		if(isset($result[0])){
		return $result[0];	
		}else{
		return $result[0]=array();	
		}
    }
	public function updateReRequestStatus($id,$data){
		$sql="update recommendation_requests set status='".$data['status']."' where id='".$id."'"; 
		$query=$this->db->query($sql);
	}
	public function deleteReRequest($id){
		$sql="update recommendation_requests set deleted_at=1 where id='".$id."'"; 
		$query=$this->db->query($sql);
	}
	public function insertReRequest($data){
		$status=array();
		
		$this->db->table('recommendation_requests')->insert($data);
		$status=array('status'=>1);
		
		return $status;
	}
	public function updateReRequest($id,$data){
		$status=array();
		
		if($data['image']!=''){
			$sql="update recommendation_requests set 
			category='".$data['category']."', 
			title='".$data['title']."', 
			user_id='".$data['user_id']."',  
			url='".$data['url']."', 
			plan='".$data['plan']."', 
			location_where='".$data['location_where']."', 
			location_city='".$data['location_city']."',
            date_from='".$data['date_from']."', 
			date_to='".$data['date_to']."', 			
			description='".$data['description']."', 
			updated_at='".$data['updated_at']."', 
			image='".$data['image']."' 
			
			where id='".$id."'"; 	
			}else{
			$sql="update recommendation_requests set 
			category='".$data['category']."', 
			title='".$data['title']."', 
			user_id='".$data['user_id']."', 
			url='".$data['url']."', 
			plan='".$data['plan']."', 
			location_where='".$data['location_where']."', 
			location_city='".$data['location_city']."',
            date_from='".$data['date_from']."', 
			date_to='".$data['date_to']."', 
			description='".$data['description']."', 
			updated_at='".$data['updated_at']."'
			
			where id='".$id."'"; 	
			}
		$this->db->query($sql);	
		
		$status=array('status'=>1);	
        return $status;
		
	}
   //plans
	public function getAllRePlans() {
        $sql="select * from recommendation_plans where deleted_at=0"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
    }
	public function getSingleRePlan($id = false) {
        $sql="select * from recommendation_plans where id='".$id."'"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		if(isset($result[0])){
		return $result[0];	
		}else{
		return $result[0]=array();	
		}
    }
	public function getSingleRePlanTimeSlot($id = false) {
        $sql="select * from recommendation_plan_features where plan_id='".$id."'"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		if(isset($result[0])){
		return $result;	
		}else{
		return $result=array();	
		}
    }
	public function deleteRePlan($id){
		$sql="update recommendation_plans set deleted_at=1 where id='".$id."'"; 
		$query=$this->db->query($sql);
	}
	public function insertRePlan($data){
		$status=array();
		$sql="select count(id) as cnt from recommendation_plans where plan_name='".$data['plan_name']."'"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		
		if($result[0]['cnt']==0){
		$this->db->table('recommendation_plans')->insert($data);
		$status=array('status'=>1,'inserID'=>$this->db->insertID());
		}else{
		$status=array('status'=>0,'inserID'=>0);	
		}
		return $status;
	}
	public function insertRePlanF($data){
		foreach($data as $val){
		$this->db->table('recommendation_plan_features')->insert($val);
		}
		$status=array('status'=>1);
		return $status;
	}
	public function updateRePlanF($data){
		$sql="delete from recommendation_plan_features where plan_id='".$data[0]['plan_id']."'"; 
		$query=$this->db->query($sql);
		foreach($data as $val){
		$this->db->table('recommendation_plan_features')->insert($val);
		}
		$status=array('status'=>1);
		return $status;
	}
	public function updateRePlan($id,$data){
		$status=array();
		$sql="select id,count(id) as cnt from recommendation_plans where plan_name='".$data['plan_name']."'"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		
		if($result[0]['cnt']>0){
			if($result[0]['id']!=$id){
		    $status=array('status'=>0);
			}else{
			$status=array('status'=>1);	
			if($data['image']!=''){
			$sql="update recommendation_plans set 
			plan_name='".$data['plan_name']."', 
			price='".$data['price']."', 
			description='".$data['description']."', 
			updated_at='".$data['updated_at']."', 
			image='".$data['image']."' where id='".$id."'";	
			}else{
			$sql="update recommendation_plans set 
			plan_name='".$data['plan_name']."', 
			price='".$data['price']."', 
			description='".$data['description']."', 
			updated_at='".$data['updated_at']."' where id='".$id."'";	
			}
			 
		$this->db->query($sql);
			}   	
		
		}else{
		$status=array('status'=>1);	
		if($data['image']!=''){
			$sql="update recommendation_plans set 
			plan_name='".$data['plan_name']."', 
			price='".$data['price']."', 
			description='".$data['description']."', 
			updated_at='".$data['updated_at']."', 
			image='".$data['image']."' where id='".$id."'";	
			}else{
			$sql="update recommendation_plans set 
			plan_name='".$data['plan_name']."', 
			price='".$data['price']."', 
			description='".$data['description']."', 
			updated_at='".$data['updated_at']."' where id='".$id."'";	
			}
		$this->db->query($sql);	
		}
        return $status;
		
	}
	
	
}