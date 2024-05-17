<?php 

namespace App\Models;  
use CodeIgniter\Model;

  
class ReceipeModel extends Model{


public function updateReadStatus(){
		$sql="update receipe_user set read_status=1";  
		$query=$this->db->query($sql);
		return true;
	}

	public function getSingleReceipe($id = false) {

		


		$sql= "select r.*, rc.id as category_id, rc.name as category_name,u.name as user_name,u.id as user_id, u.email as users_email,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from receipes r
		inner join receipe_categories rc on rc.id= r.receipe_category_id
		left join users u on u.id=r.posted_by
		left join admin_users au on r.posted_by=0
		where r.id='".$id."'";

       
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		if(isset($result[0])){
		return $result[0];	
		}else{
		return $result[0]=array();	
		}
		return $result;
    }


	public function getAllBlogReceipesByUser($id) {
		
		

		$sql= "select r.*,  rc.name as category_name,u.name as user_name, u.email as users_email,u.mobile_no as user_phone,au.name as admin_user_name,au.email as admin_user_email from receipes r
		inner join receipe_categories rc on rc.id= r.receipe_category_id
		left join users u on u.id=r.posted_by
		left join admin_users au on r.posted_by=0
		where r.deleted_at=0 
		order by  r.id desc";
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
    }
	

    public function getAllBlogReceipes_blog($id) {
		
		

		$sql= "select r.*,  rc.name as category_name,u.name as user_name, u.email as users_email,u.mobile_no as user_phone,au.name as admin_user_name,au.email as admin_user_email from receipes r
		inner join receipe_categories rc on rc.id= r.receipe_category_id
		left join users u on u.id=r.posted_by
		left join admin_users au on r.posted_by=0
		where r.deleted_at=0 
		order by  r.id desc limit 0,3";

		
       
		
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
    }


     public function getAllRacipeByUserForProfile($id) {
		
		$sql= "select r.*,  rc.name as category_name,u.name as user_name, u.email as users_email,u.mobile_no as user_phone,au.name as admin_user_name,au.email as admin_user_email from receipes r
		inner join receipe_categories rc on rc.id= r.receipe_category_id
		left join users u on u.id=r.posted_by
		left join admin_users au on r.posted_by=0
		where r.deleted_at=0 and r.posted_by='".$id."'
		order by  r.id desc";

		$sq= "select r.*,  rc.name as category_name,u.name as user_name, u.email as users_email,u.mobile_no as user_phone,au.name as admin_user_name,au.email as admin_user_email from receipe_user r
		inner join receipe_categories rc on rc.id= r.receipe_category_id
		left join users u on u.id=r.posted_by
		left join admin_users au on r.posted_by=0
		where r.deleted_at=0 and r.posted_by='".$id."'
		order by  r.id desc";

		
       
		
		$query=$this->db->query($sq);
		$result=$query->getResultArray();
		return $result;
    }



   

   




	public function getAllReceipeCategory() {

//Khalid
//        $sql="select receipe_categories.id,receipe_categories.name from receipe_categories inner join receipes on receipe_categories.id= receipes.receipe_category_id where receipe_categories.deleted_at =0 and receipes.deleted_at=0 group by receipe_categories.name ";
        $sql="select * from receipe_categories where receipe_categories.deleted_at =0 group by receipe_categories.name ";
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result; 
    }
	public function getSingleReceipeCategory($id = false) {
        $sql="select * from receipe_categories where id='".$id."'"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		if(isset($result[0])){
		return $result[0];	
		}else{
		return $result[0]=array();	
		}
		
    }
	public function deleteReceipeCategory($id){
		$sql="update receipe_categories set deleted_at=1 where id='".$id."'"; 
		$query=$this->db->query($sql);
	}
	public function insertReceipeCategory($data){
		$this->db->table('receipe_categories')->insert($data);
	}
	public function updateReceipeCategory($id,$data){
		$sql="update receipe_categories set name='".$data['name']."' where id='".$id."'"; 
		$query=$this->db->query($sql);
		
	}
	
    public function getAllReceipe(){
    //Khalid
//		$sql="select np.*,npc.name as category_name from receipes np inner join receipe_categories npc on npc.id=np.receipe_category_id where  np.deleted_at=0";
		$sql="select np.*,npc.name as category_name from receipe_user np inner join receipe_categories npc on npc.id=np.receipe_category_id where  np.deleted_at=0";
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
	}
	// public function getSingleReceipe($id = false) {
 //        $sql="select np.*,npc.name as category_name from receipes np inner join receipe_categories npc on npc.id=np.receipe_category_id where np.id='".$id."' "; 
	// 	$query=$this->db->query($sql);
	// 	$result=$query->getResultArray();
	// 	if(isset($result[0])){
	// 	return $result[0];	
	// 	}else{
	// 	return $result[0]=array();	
	// 	}
		
 //    }

	public function insertReceipe($data){
		$this->db->table('receipes')->insert($data);
	}
	public function updateReceipe($id,$data){
		if($data['image']!=''){
		 $sql="update receipes set receipe_category_id='".$data['receipe_category_id']."',title='".$data['title']."',content='".$data['content']."',image='".$data['image']."',updated_at='".$data['updated_at']."',location='".$data['location']."' where id='".$id."'";	
		}else{
		$sql="update receipes set receipe_category_id='".$data['receipe_category_id']."',title='".$data['title']."',content='".$data['content']."',updated_at='".$data['updated_at']."',location='".$data['location']."' where id='".$id."'";	
		}
		
		$query=$this->db->query($sql);
		
	}
	public function deleteReceipe($id){
		$sql="update receipes set deleted_at=1 where id='".$id."'"; 
		$query=$this->db->query($sql);
	}
	public function deleteReceipeUser($id){
		$sql="update receipe_user  set deleted_at=1 where id='".$id."'"; 
		$query=$this->db->query($sql);
	}
	public function getReceipeComment($id = false) {
      
		
		return $result;
		$sql="select npco.post_id,npco.commented_by,npco.message,npco.created_at,u.name as users_name,u.profile_image as users_profile_image,u.email as users_email,a.name as admin_name,a.email as admin_email from receipe_comments npco left join users u
		on npco.commented_by=u.id left join admin_users a on npco.commented_by=0 where npco.post_id='".$id."' order by npco.created_at desc
		"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		
		return $result;
    }
	public function insertReceipeComment($data){
		$this->db->table('receipe_comments')->insert($data);
	}
	
	
	
	
	
	//users recipe code
	public function user_recipe_list_api($id,$start,$limit) {
	$sql= "select r.*,  rc.name as category_name,u.id as user_id,u.name as user_name, u.profile_image as users_profile_image,u.email as users_email,u.mobile_no as user_phone,au.name as admin_user_name,au.email as admin_user_email from receipe_user r
		left join receipe_user_categories rc on rc.id= r.receipe_category_id
		left join users u on u.id=r.posted_by
		left join admin_users au on r.posted_by=0
		where r.deleted_at=0 and r.status=1
		order by  r.id desc limit $start,$limit";
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
    }

    public function user_profile_recipe_list_api($id,$start,$limit) {
	$sql= "select r.*,  rc.name as category_name,u.id as user_id,(select count(message) from receipe_user_comments  where post_id=r.id) as total_comment,u.name as user_name, u.profile_image as users_profile_image,u.email as users_email,u.mobile_no as user_phone,au.name as admin_user_name,au.email as admin_user_email from receipe_user r
		left join receipe_user_categories rc on rc.id= r.receipe_category_id
		left join users u on u.id=r.posted_by
		left join admin_users au on r.posted_by=0
		where r.deleted_at=0 and r.status=1 and r.posted_by='".$id."'
		order by  r.id desc limit $start,$limit";
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
    }


	public function user_recipe_list($id) {
	$sql= "select r.*,  rc.name as category_name,u.id as user_id,u.name as user_name, u.profile_image as users_profile_image,u.email as users_email,u.mobile_no as user_phone,au.name as admin_user_name,au.email as admin_user_email from receipe_user r
		left join receipe_user_categories rc on rc.id= r.receipe_category_id
		left join users u on u.id=r.posted_by
		left join admin_users au on r.posted_by=0
		where r.deleted_at=0 and r.status=1
		order by  r.id desc";
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
    }
	public function user_recipe_category() {


        $sql="select * from receipe_user_categories  where deleted_at =0 order by id desc "; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result; 
    }
	public function user_recipe_category_topic() {


        $sql="select receipe_user_categories.* from receipe_user_categories inner join receipe_user on receipe_user_categories.id=receipe_user.receipe_category_id   where receipe_user_categories.deleted_at =0 group by receipe_user_categories.id order by receipe_user_categories.id desc "; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result; 
    }
	public function user_recipe_insert($data){
	    $status=array();
		$this->db->table('receipe_user')->insert($data);
		$status=array('status'=>1);
		return $status;	
	}
	public function user_recipe_insert_api($data){
	    $status=array(); 
		$this->db->table('receipe_user')->insert($data);
		return $this->db->insertID();
	}
	public function user_recipe_insert_comments($data){
		
		
		$user_sql="select posted_by from receipe_user where id='".$data['post_id']."'";
	    $user_query=$this->db->query($user_sql); 	
		$user_query_result=$user_query->getResultArray();
		$sql="insert into user_notifications set receiver_id='".$user_query_result[0]['posted_by']."',sender_id='".$data['commented_by']."',table_name='receipe_user',table_id='".$data['post_id']."',type='Comments',type_name='Recipe',created_at='".$data['created_at']."'";
		$this->db->query($sql);
		$this->db->table('receipe_user_comments')->insert($data);
		return $this->db->insertID();
	}


	public function recipe_insert_comments($data){
		
		
		$user_sql="select posted_by from receipes where id='".$data['post_id']."'";
	    $user_query=$this->db->query($user_sql); 	
		$user_query_result=$user_query->getResultArray();
		$sql="insert into user_notifications set receiver_id='".$user_query_result[0]['posted_by']."',sender_id='".$data['commented_by']."',table_name='receipe_user',table_id='".$data['post_id']."',type='Comments',type_name='Recipe',created_at='".$data['created_at']."'";
		$this->db->query($sql);
		$this->db->table('receipe_comments')->insert($data);
		return $this->db->insertID();
	}


	public function user_recipe_comment_by_id($id = false) {
       $results=array();
	   $sql="select npco.post_id,npco.commented_by,npco.message,npco.created_at,u.name as users_name,u.profile_image as users_profile_image,u.email as users_email,a.name as admin_name,a.email as admin_email from receipe_user_comments npco left join users u
		on npco.commented_by=u.id left join admin_users a on npco.commented_by=0 where npco.id='".$id."' order by npco.created_at desc
		"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		if(isset($result[0])){
			$results=$result[0];
		}
		return $results;
    }

    	public function recipe_comment_by_id($id = false) {
       $results=array();
	   $sql="select npco.post_id,npco.commented_by,npco.message,npco.created_at,u.name as users_name,u.profile_image as users_profile_image,u.email as users_email,a.name as admin_name,a.email as admin_email from receipe_comments npco left join users u
		on npco.commented_by=u.id left join admin_users a on npco.commented_by=0 where npco.id='".$id."' order by npco.created_at desc
		"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		if(isset($result[0])){
			$results=$result[0];
		}
		return $results;
    }


	public function user_recipe_single($id = false){
	 $sql="select bp.*,bpc.id as category_id,bpc.name as  category_name,u.id as user_id,u.name as user_name,u.profile_image  as user_profile,u.email as user_email,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from receipe_user bp
		inner join receipe_user_categories bpc on bpc.id=bp.receipe_category_id
		left join users u on u.id=bp.posted_by
		left join admin_users au on bp.posted_by=0
		where bp.id='".$id."'";
      
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		if(isset($result[0])){
		return $result[0];	
		}else{
		return $result[0]=array();	
		}
		return $result;
     }
public function user_recipe_single_apis($id = false){
	 $sql="select bp.*,bpc.id as category_id,bpc.name as  category_name,u.id as user_id,u.name as user_name,u.profile_image  as user_profile,u.email as user_email,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from receipe_user bp
		inner join receipe_user_categories bpc on bpc.id=bp.receipe_category_id
		left join users u on u.id=bp.posted_by
		left join admin_users au on bp.posted_by=0
		where bp.id='".$id."'";
      
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		if(isset($result[0])){
		return $result[0];	
		}else{
		return $result[0]=array();	
		}
		return $result;
     }

     public function recipe_single($id = false){
	 $sql="select bp.*,bpc.id as category_id,bpc.name as  category_name,u.id as user_id,u.name as user_name,u.profile_image  as user_profile,u.email as user_email,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from receipes bp
		inner join receipe_categories bpc on bpc.id=bp.receipe_category_id
		left join users u on u.id=bp.posted_by
		left join admin_users au on bp.posted_by=0
		where bp.id='".$id."' and bp.status=1";
      
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		if(isset($result[0])){
		return $result[0];	
		}else{
		return $result[0]=array();	
		}
		return $result;
     }

	 public function user_recipe_comment($id = false) {
       $sql="select npco.post_id,npco.commented_by,npco.message,npco.created_at,u.name as users_name,u.profile_image as users_profile_image,u.email as users_email,a.name as admin_name,a.email as admin_email from receipe_user_comments npco left join users u
		on npco.commented_by=u.id left join admin_users a on npco.commented_by=0 where npco.post_id='".$id."' order by npco.created_at desc limit 0,2
		"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		
		return $result;
    }

     public function recipe_comment($id = false) {
       $sql="select npco.post_id,npco.commented_by,npco.message,npco.created_at,u.name as users_name,u.profile_image as users_profile_image,u.email as users_email,a.name as admin_name,a.email as admin_email from receipe_comments npco left join users u
		on npco.commented_by=u.id left join admin_users a on npco.commented_by=0 where npco.post_id='".$id."' order by npco.created_at desc limit 0,2
		"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		
		return $result;
    }

    public function recipe_comment_all($id = false) {
       $sql="select npco.post_id,npco.commented_by,npco.message,npco.created_at,u.name as users_name,u.profile_image as users_profile_image,u.email as users_email,a.name as admin_name,a.email as admin_email from receipe_user_comments npco left join users u
		on npco.commented_by=u.id left join admin_users a on npco.commented_by=0 where npco.post_id='".$id."' order by npco.created_at desc
		"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		
		return $result;
    }


	public function user_recipe_comment_all($id = false) {
       $sql="select npco.post_id,npco.commented_by,npco.message,npco.created_at,u.name as users_name,u.profile_image as users_profile_image,u.email as users_email,a.name as admin_name,a.email as admin_email from receipe_user_comments npco left join users u
		on npco.commented_by=u.id left join admin_users a on npco.commented_by=0 where npco.post_id='".$id."' order by npco.created_at desc
		"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		
		return $result;
    }

    public function getAllReceipeByCategory($id,$categoryId) {
	
	$sql="select r.*,rc.name as category_name,u.name as user_name,u.id as user_id,u.profile_image as users_profile_image,u.email as user_email,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from receipes r 
		inner join receipe_categories rc on rc.id=r.receipe_category_id 
        left join users u on u.id=r.posted_by
        left join admin_users au on r.posted_by=0
        where r.deleted_at=0 and r.status=1  and r.receipe_category_id='".$categoryId."'
		order by r.id desc"; 
		
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
    }
    
	public function user_recipe_list_by_category($id,$categoryId) {
	
	$sql="select r.*,rc.name as category_name,u.name as user_name,u.id as user_id,u.profile_image as users_profile_image,u.email as user_email,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from receipe_user r 
		inner join receipe_user_categories rc on rc.id=r.receipe_category_id 
        left join users u on u.id=r.posted_by
        left join admin_users au on r.posted_by=0
        where r.deleted_at=0 and r.status=1  and r.receipe_category_id='".$categoryId."'
		order by r.id desc"; 
		
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
    }
	public function user_recipe_list_by_category_api($categoryId,$start,$limit) {
	
	$sql="select r.*,rc.name as category_name,u.name as user_name,u.id as user_id,u.profile_image as users_profile_image,u.email as user_email,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from receipe_user r 
		inner join receipe_user_categories rc on rc.id=r.receipe_category_id 
        left join users u on u.id=r.posted_by
        left join admin_users au on r.posted_by=0
        where r.deleted_at=0 and r.status=1  and r.receipe_category_id='".$categoryId."'
		order by r.id desc limit $start,$limit"; 
		
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
    }
	public function user_recipe_old_comments($id = false) {
       $sql="select npco.post_id,npco.commented_by,npco.message,npco.created_at,u.name as users_name,u.profile_image as users_profile_image,u.email as users_email,a.name as admin_name,a.email as admin_email from receipe_user_comments npco left join users u
		on npco.commented_by=u.id left join admin_users a on npco.commented_by=0 where npco.post_id='".$id."'  order by npco.created_at desc LIMIT 18446744073709551615 OFFSET 2
		"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		
		return $result;
    }
	public function user_recipe_request(){
			$sql="select np.*,npc.name as category_name,u.name as user_name,u.email as user_email,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from receipe_user np left join receipe_user_categories npc on npc.id=np.receipe_category_id 
			left join users u on u.id=np.posted_by
             left join admin_users au on np.posted_by=0
			where  np.deleted_at=0 and np.status=0"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
	}
	public function updateRecipeStatus($id){
		$sql="update receipe_user set status=1 where id='".$id."'"; 
		$query=$this->db->query($sql);
	}
	public function userRecipeAcceptRequest($id){
		$sql="update receipe_user set status=1 where id='".$id."'"; 
		$query=$this->db->query($sql);
	}
	public function userRecipeDeclineRequest($id){
		$sql="update receipe_user set status=2 where id='".$id."'"; 
		$query=$this->db->query($sql);
	}
	public function userRecipeDeleteRequest($id){
		$sql="update receipe_user set deleted_at=1 where id='".$id."'"; 
		$query=$this->db->query($sql);
	}
}