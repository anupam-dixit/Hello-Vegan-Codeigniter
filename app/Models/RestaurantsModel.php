<?php 

namespace App\Models;  
use CodeIgniter\Model;

  
class RestaurantsModel extends Model{


	public function getAllPost(){
		$sql="select * from restaurants  where  restaurants.deleted_at=0"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
	}

	public function getAllPostForApi($id,$start,$limit){
		$sql="select * from restaurants  where  restaurants.deleted_at=0 order by restaurants.id desc limit $start,$limit";
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
	}

		public function getPostComment($id = false) {
       $sql="select npco.post_id,npco.commented_by,npco.message,npco.created_at,u.name as users_name,u.profile_image as users_profile_image,u.email as users_email,a.name as admin_name,a.email as admin_email from restaurant_comment npco left join users u
		on npco.commented_by=u.id left join admin_users a on npco.commented_by=0 where npco.post_id='".$id."' order by npco.created_at desc
		"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		
		return $result;
    }

    	public function getPostCommentOlder($id = false) {
       $sql="select npco.post_id,npco.commented_by,npco.message,npco.created_at,u.name as users_name,u.profile_image as users_profile_image,u.email as users_email,a.name as admin_name,a.email as admin_email from restaurant_comment npco left join users u
		on npco.commented_by=u.id left join admin_users a on npco.commented_by=0 where npco.post_id='".$id."'  order by npco.created_at desc LIMIT 18446744073709551615 OFFSET 2
		"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		
		return $result;
    }
    

	public function getPostCommentUser($id = false) {
       $sql="select npco.post_id,npco.commented_by,npco.message,npco.created_at,u.name as users_name,u.profile_image as users_profile_image,u.email as users_email,a.name as admin_name,a.email as admin_email from restaurant_comment npco left join users u
		on npco.commented_by=u.id left join admin_users a on npco.commented_by=0 where npco.post_id='".$id."' order by npco.created_at desc limit 0,2
		"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		
		return $result;
    }



	public function insertPostComment($data){
		
		
		$user_sql="select posted_by from restaurants where id='".$data['post_id']."'";
	    $user_query=$this->db->query($user_sql); 	
		$user_query_result=$user_query->getResultArray();
		$sql="insert into user_notifications set receiver_id='".$user_query_result[0]['posted_by']."',sender_id='".$data['commented_by']."',table_name='restaurant_comment',table_id='".$data['post_id']."',type='Comments',type_name='Blog',created_at='".$data['created_at']."'";
		$this->db->query($sql);
		$this->db->table('restaurant_comment')->insert($data);
		return $this->db->insertID();
	}

	public function getPostCommentByid($id = false) {
       $results=array();
	   $sql="select npco.post_id,npco.commented_by,npco.message,npco.created_at,u.name as users_name,u.profile_image as users_profile_image,u.email as users_email,a.name as admin_name,a.email as admin_email from restaurant_comment npco left join users u
		on npco.commented_by=u.id left join admin_users a on npco.commented_by=0 where npco.id='".$id."' order by npco.created_at desc
		"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		if(isset($result[0])){
			$results=$result[0];
		}
		return $results;
    }


	public function getSingleRest_detail($id = false,$userid = false) {

		
		$sq="select ru.*,(select count(id) from restaurant_like where post_id=ru.id and liked_by='".$userid."') as liked_status,(select name from restaurants_category where id=ru.category_id) as category_name from restaurants ru where ru.id='".$id."'";
       
		$query=$this->db->query($sq);
		$result=$query->getResultArray();
		if(isset($result[0])){
		return $result[0];	
		}else{
		return $result[0]=array();	
		}
		return $result;
    }
    public function deleteRestaurantLike($post_id,$userid){
		$sq="delete from restaurant_like where post_id='".$post_id."' and liked_by='".$userid."'";
       
		$query=$this->db->query($sq);
	}
	public function insertRestaurantLike($post_id,$userid){
		$sq="insert into restaurant_like set post_id='".$post_id."' ,liked_by='".$userid."'";
       
		$query=$this->db->query($sq);
	}
//admin part
    public function getAllReCategories() {
        $sql="select * from restaurants_category where deleted_at=0"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
    }
	
	public function getAllRestaurants() {
        $sql="select u.name as user_name,u.email as user_email,u.mobile_no as user_phone,ru.*,rc.name as category_name from restaurants ru inner join restaurants_category rc on rc.id=ru.category_id 
		left join users u on u.id=ru.posted_by
		
		where ru.deleted_at=0 order by ru.id desc"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
    }
	public function getSingleReCategory($id = false) {
        $sql="select * from restaurants_category where id='".$id."'"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		if(isset($result[0])){
		return $result[0];	
		}else{
		return $result[0]=array();	
		}
    }
	public function deleteReCategory($id){
		$sql="update restaurants_category set deleted_at=1 where id='".$id."'"; 
		$query=$this->db->query($sql);
	}
	public function insertReCategory($data){
		$status=array();
		$sql="select count(id) as cnt from restaurants_category where name='".$data['name']."'"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		
		if($result[0]['cnt']==0){
		$this->db->table('restaurants_category')->insert($data);
		$status=array('status'=>1);
		}else{
		$status=array('status'=>0);	
		}
		return $status;
	}
	public function updateReCategory($id,$data){
		$status=array();
		$sql="select id,count(id) as cnt from restaurants_category where name='".$data['name']."'"; 
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
		$sql="update restaurants_category set name='".$data['name']."' where id='".$id."'"; 
		$this->db->query($sql);	
		}
        return $status;
		
	}
	
	public function getAllFeatures() {
        $sql="select id,name,svgData from restaurant_features where status=1 and deleted_at=0 order by id desc"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
    }
	public function getAllFeaturesEdit($id) {
        $sql="select id,name,svgData from restaurant_features where status=1 and id='".$id."'"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
    }
	public function getAllUsers() {
        $sql="select id,name from users"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
    }
	public function getSingleReRestaurant($id = false) {
        $sql="select a.name as admin_name,a.email as admin_email,ru.*,rc.id as category_id,rc.name as category_name from restaurants ru 
		left join restaurants_category rc on rc.id=ru.category_id 
		
       left join admin_users a on ru.posted_by=0		
		where ru.id='".$id."'"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		if(isset($result[0])){
		return $result[0];	
		}else{
		return $result[0]=array();	
		}
    }
    public function deleteReRestaurant($id){
		$sql="update restaurants set deleted_at=1 where id='".$id."'"; 
		$query=$this->db->query($sql);
	}
	
	public function insertReRestaurant($data){
		$status=array();
		
		$this->db->table('restaurants')->insert($data);
		$status=array('status'=>1);
		
		return $status;
	}
	public function updateReRestaurant($id,$data){
		$status=array();
		$sql="update restaurants set 
			name='".$data['name']."', 
			detail='".$data['detail']."', 
			address='".$data['address']."', 
			discount='".$data['discount']."', 
			updated_at='".$data['updated_at']."', 
			category_id='".$data['category_id']."', 
			price='".$data['price']."',
			approx='".$data['approx']."',
            opening_time='".$data['opening_time']."', 
			closing_time='".$data['closing_time']."', 
			location='".$data['location']."', 
			features='".$data['features']."',
			latitude='".$data['latitude']."',
			longitude='".$data['longitude']."',
			contact_no='".$data['contact_no']."'";
		if($data['image']!=''){
			$sql.=",image='".$data['image']."'";
		}
        if($data['gallary']!=''){
			$sql.=",gallary='".$data['gallary']."'";
		}
        if($data['menu']!=''){
			$sql.=",menu='".$data['menu']."'";
		}
       		
		$sql.="where id='".$id."'"; 
		
		$this->db->query($sql);	
		
		$status=array('status'=>1);	
        return $status;
		
	}
	public function insertReRestauranFeature($data){
		$status=array();
		
		$this->db->table('restaurant_features')->insert($data);
		$status=array('status'=>1);
		
		return $status;
	}
	public function deleteReRestaurantFeature($id){
		$sql="update restaurant_features set deleted_at=1 where id='".$id."'"; 
		$query=$this->db->query($sql);
	}
	public function updateReRestauranFeature($id,$data){
		
		$status=array();
		$sql="update restaurant_features set 
			name='".$data['name']."'";
		if($data['svgData']!=''){
			$sql.=",svgData='".$data['svgData']."'";
		}
       
       		
		$sql.="where id='".$id."'"; 
		
		$this->db->query($sql);	
		
		$status=array('status'=>1);	
        return $status;
		
	}
public function getPostCommentByPostid($id = false) {
       $results=array();
	   $sql="select npco.post_id,npco.commented_by,npco.message,npco.created_at,u.name as users_name,u.profile_image as users_profile_image,u.email as users_email,a.name as admin_name,a.email as admin_email from restaurant_comment npco left join users u
		on npco.commented_by=u.id left join admin_users a on npco.commented_by=0 where npco.post_id='".$id."' order by npco.created_at desc
		"; 
		$query=$this->db->query($sql);
		$results=$query->getResultArray();
		
		return $results;
    }
	public function getPostFeaturesByPostid($id = false) {
       $results=array();
	   $sql=" select rf.name,rf.svgData from restaurant_features rf where FIND_IN_SET( rf.id,(select features from restaurants where id='".$id."'))"; 
		$query=$this->db->query($sql);
		$results=$query->getResultArray();
		
		return $results;
    }
	public function getPostLikeByPostid($id = false,$userid = false) {
       $results=array();
	   $sql="select npco.post_id,npco.liked_by,npco.created_at,u.name as users_name,u.profile_image as users_profile_image,u.email as users_email,a.name as admin_name,a.email as admin_email from restaurant_like npco left join users u
		on npco.liked_by=u.id left join admin_users a on npco.liked_by=0 where npco.post_id='".$id."' and liked_by='".$userid."' order by npco.created_at desc
		"; 
		$query=$this->db->query($sql);
		$results=$query->getResultArray();
		
		return $results;
    }
}