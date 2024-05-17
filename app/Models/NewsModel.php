<?php 

namespace App\Models;  
use CodeIgniter\Model;

  
class NewsModel extends Model{

	public function updateCount($id){
		$sql="update news_posts set views_count=views_count+1 where id='".$id."'"; 
		$query=$this->db->query($sql);
	}
	public function getAllNewsCategory() {
        $sql="SELECT news_post_categories.id,news_post_categories.name FROM `news_post_categories` inner join news_posts
on news_post_categories.id=news_posts.post_category_id
where news_post_categories.deleted_at=0 and news_posts.deleted_at=0
 group by news_post_categories.name "; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
    }
	public function getAllPostCategory() {
        $sql="select * from news_post_categories where deleted_at=0"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
    }
	public function getSinglePostCategory($id = false) {
        $sql="select * from news_post_categories where id='".$id."'"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		if(isset($result[0])){
		return $result[0];	
		}else{
		return $result[0]=array();	
		}
    }
	public function deletePostCategory($id){
		$sql="update news_post_categories set deleted_at=1 where id='".$id."'"; 
		$query=$this->db->query($sql);
	}
	public function insertPostCategory($data){
		$this->db->table('news_post_categories')->insert($data);
	}
	public function updatePostCategory($id,$data){
		$sql="update news_post_categories set name='".$data['name']."' where id='".$id."'"; 
		$query=$this->db->query($sql);
		
	}

	public function getLatestNewsByUser($id) {
       $userids="0,".$id.",";
       //$userids=$id.",";
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
		if($userids==""){
			$userids=0;
		}
		$sq="select np.*,npc.name as category_name,u.name as user_name,u.email as user_email,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from news_posts np 
		inner join news_post_categories npc on npc.id=np.post_category_id 
        left join users u on u.id=np.posted_by
        left join admin_users au on np.posted_by=0	
		where posted_by in (".$userids.")
		order by np.id desc limit 0,1";


		$sql="select np.*,npc.name as category_name,u.name as user_name,u.email as user_email,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from news_posts np 
		inner join news_post_categories npc on npc.id=np.post_category_id 
        left join users u on u.id=np.posted_by
        left join admin_users au on np.posted_by=0
        where np.deleted_at=0
		order by np.id desc limit 0,1";

		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		if(isset($result[0])){
		return $result[0];	
		}else{
		return $result[0]=array();	
		}
    }

    public function getAllNewsByCategoryLimitForApi($cat_id,$start,$limit) {
		


		 $sql="select np.*,npc.name as category_name,u.name as user_name,u.email as user_email,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from news_posts np 
		inner join news_post_categories npc on npc.id=np.post_category_id 
        left join users u on u.id=np.posted_by
        left join admin_users au on np.posted_by=0
        where np.deleted_at=0  and npc.id='".$cat_id."'
		order by np.id desc limit $start,$limit ";
		


		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
    }



    public function getAllNewsByCategory($id,$categoryId) {
		
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
          $sq="select np.*,npc.name as category_name,u.name as user_name,u.email as user_email,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from news_posts np 
		inner join news_post_categories npc on npc.id=np.post_category_id 
        left join users u on u.id=np.posted_by
        left join admin_users au on np.posted_by=0
        where np.deleted_at=0 and np.posted_by in (".$userids.") and npc.id='".$categoryId."'
		order by np.id desc;"; 


		 $sql="select np.*,npc.name as category_name,u.name as user_name,u.email as user_email,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from news_posts np 
		inner join news_post_categories npc on npc.id=np.post_category_id 
        left join users u on u.id=np.posted_by
        left join admin_users au on np.posted_by=0
        where np.deleted_at=0  and npc.id='".$categoryId."'
		order by np.id desc;"; 
		


		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
    }

	public function getLatestNewsByCategory($id,$categoryId) {
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
		$sq="select np.*,npc.id as category_id,npc.name as category_name,u.name as user_name,u.email as user_email,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from news_posts np 
		inner join news_post_categories npc on npc.id=np.post_category_id 
        left join users u on u.id=np.posted_by
        left join admin_users au on np.posted_by=0	
		where posted_by in (".$userids.")  and npc.id='".$categoryId."'
		order by np.id desc limit 0,1";


		$sql="select np.*,npc.id as category_id,npc.name as category_name,u.name as user_name,u.email as user_email,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from news_posts np 
		inner join news_post_categories npc on npc.id=np.post_category_id 
        left join users u on u.id=np.posted_by
        left join admin_users au on np.posted_by=0	
		where  npc.id='".$categoryId."'
		order by np.id desc limit 0,1";
		
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		if(isset($result[0])){
		return $result[0];	
		}else{
		return $result[0]=array();	
		}
    }


     public function getAllNewstBylimitForApi($id,$start,$limit){
		

		$sql="select np.*,npc.name as category_name,u.name as user_name,u.email as user_email,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from news_posts np 
		inner join news_post_categories npc on npc.id=np.post_category_id 
        left join users u on u.id=np.posted_by
        left join admin_users au on np.posted_by=0 where 
        np.deleted_at=0  
		order by np.id desc   limit $start,$limit";   

		
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
	}




    public function getAllNewstByUser($id){
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

		 $sq="select np.*,npc.name as category_name,u.name as user_name,u.email as user_email,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from news_posts np 
		inner join news_post_categories npc on npc.id=np.post_category_id 
        left join users u on u.id=np.posted_by
        left join admin_users au on np.posted_by=0
        where np.deleted_at=0 and np.posted_by in (".$userids.") and np.id != (select id from news_posts where posted_by in (".$userids.")  order by id desc limit 0,1) 
		order by np.id desc   limit 0,3;";  

		$sql="select np.*,npc.name as category_name,u.name as user_name,u.email as user_email,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from news_posts np 
		inner join news_post_categories npc on npc.id=np.post_category_id 
        left join users u on u.id=np.posted_by
        left join admin_users au on np.posted_by=0 where np.id != (select id from news_posts order by id desc limit 0,1)
        and np.deleted_at=0  
		order by np.id desc   limit 0,3;";  

		
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
	}

	 public function getnews_of_traval_guide($id){

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

		 $sq="select np.*,npc.name as category_name,u.name as user_name,u.email as user_email,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from news_posts np 
		inner join news_post_categories npc on npc.id=np.post_category_id 
        left join users u on u.id=np.posted_by
        left join admin_users au on np.posted_by=0
        where np.deleted_at=0 and np.post_category_id=4 and np.posted_by in (".$userids.") and np.id != (select id from news_posts where posted_by in (".$userids.")  order by id desc limit 0,1) 
		order by np.id desc limit 0,3;"; 

		 $sql="select np.*,npc.name as category_name,u.name as user_name,u.email as user_email,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from news_posts np 
		inner join news_post_categories npc on npc.id=np.post_category_id 
        left join users u on u.id=np.posted_by
        left join admin_users au on np.posted_by=0
        where np.deleted_at=0 and np.post_category_id=4
		order by np.id desc limit 0,3;";  

		// $sq="select np.*,npc.name as category_name from news_posts np inner join news_post_categories npc on npc.id=np.post_category_id where  np.deleted_at=0 and np.post_category_id=4 order by np.id desc limit 0,3"; 

		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
	}

	public function getnews_of_receipes_guide($id){


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

		 $sq="select np.*,npc.name as category_name,u.name as user_name,u.email as user_email,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from news_posts np 
		inner join news_post_categories npc on npc.id=np.post_category_id 
        left join users u on u.id=np.posted_by
        left join admin_users au on np.posted_by=0
        where np.deleted_at=0 and np.post_category_id=3 and np.posted_by in (".$userids.") and np.id != (select id from news_posts where posted_by in (".$userids.")  and post_category_id=3 order by id desc limit 0,1) 
		order by np.id desc limit 0,5;";

		 $sql="select np.*,npc.name as category_name,u.name as user_name,u.email as user_email,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from news_posts np 
		inner join news_post_categories npc on npc.id=np.post_category_id 
        left join users u on u.id=np.posted_by
        left join admin_users au on np.posted_by=0
        where np.deleted_at=0 and np.post_category_id=3
		order by np.id desc limit 0,5;";


		// $sql="select np.*,npc.name as category_name from news_posts np inner join news_post_categories npc on npc.id=np.post_category_id where  np.deleted_at=0 and np.post_category_id=6 order by np.id desc limit 0,3"; 

		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
	}
	public function getnews_of_gadgets_guide($id){


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

		 $sq="select np.*,npc.name as category_name,u.name as user_name,u.email as user_email,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from news_posts np 
		inner join news_post_categories npc on npc.id=np.post_category_id 
        left join users u on u.id=np.posted_by
        left join admin_users au on np.posted_by=0
        where np.deleted_at=0 and np.post_category_id=6 and np.posted_by in (".$userids.") and np.id != (select id from news_posts where posted_by in (".$userids.")  and post_category_id=6 order by id desc limit 0,1) 
		order by np.id desc limit 0,5;";


		 $sql="select np.*,npc.name as category_name,u.name as user_name,u.email as user_email,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from news_posts np 
		inner join news_post_categories npc on npc.id=np.post_category_id 
        left join users u on u.id=np.posted_by
        left join admin_users au on np.posted_by=0
        where np.deleted_at=0 and np.post_category_id=6
		order by np.id desc limit 0,5;";


		// $sql="select np.*,npc.name as category_name from news_posts np inner join news_post_categories npc on npc.id=np.post_category_id where  np.deleted_at=0 and np.post_category_id=6 order by np.id desc limit 0,3"; 

		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
	}

	public function getcommentByPostId($id){

      $sql="select npc.*,u.name as user_name,u.email as user_email,u.mobile_no as user_phone,u.profile_image as user_photo from news_post_comments npc
		left join users u on u.id=npc.commented_by 
		where  npc.post_id='".$id."'
		order by npc.id desc "; 
		

        $query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
	}

	public function getNewsCommentByid($id = false) {
       $results=array();
	   $sql="select npc.post_id,npc.commented_by,npc.message,npc.created_at,u.name as users_name,u.profile_image as users_profile_image,u.email as  users_email,a.name as admin_name,a.email as admin_email from news_post_comments npc 
	   left join users u
		on npc.commented_by=u.id left join admin_users a on npc.commented_by=0 where npc.id='".$id."' order by npc.created_at desc
		"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		if(isset($result[0])){
			$results=$result[0];
		}
		return $results;
    }




	public function getlatestGadgatnews(){

      $sql="select np.*,npc.id as category_id,npc.name as category_name,u.name as user_name,u.email as user_email,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from news_posts np
	    inner join news_post_categories npc on npc.id=np.post_category_id 
		left join users u on u.id=np.posted_by
		left join  admin_users as au on np.posted_by=0 
		where np.post_category_id=6 and np.deleted_at=0
		order by np.id desc limit 0,1"; 
		


		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		if(isset($result[0])){
		return $result[0];	
		}else{
		return $result[0]=array();	
		}
	}
	public function getlatestReceipenews(){

      $sql="select np.*,npc.id as category_id,npc.name as category_name,u.name as user_name,u.email as user_email,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from news_posts np
	    inner join news_post_categories npc on npc.id=np.post_category_id 
		left join users u on u.id=np.posted_by
		left join  admin_users as au on np.posted_by=0 
		where np.post_category_id=3 and np.deleted_at=0
		order by np.id desc limit 0,1"; 
		


		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		if(isset($result[0])){
		return $result[0];	
		}else{
		return $result[0]=array();	
		}
	}

	public function getSinglebNewById($id = false) {

		$sql="select np.*,npc.id as category_id,npc.name as category_name,u.name as user_name,u.email as user_email,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from news_posts np
		 inner join news_post_categories npc on npc.id=np.post_category_id 
		left join users u on u.id=np.posted_by
		left join  admin_users as au on np.posted_by=0
		where np.id='".$id."'";
       
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		if(isset($result[0])){
			if(empty($result[0]['user_name'])){
				$result[0]['user_name']=$result[0]['au_user_name'];
				$result[0]['user_email']=$result[0]['au_user_email'];
			}
			
		return $result[0];	
		}else{
		return $result[0]=array();	
		}
		return $result;
    }

    public function insertNewsComment($data){
		$this->db->table('news_post_comments')->insert($data);
		return $this->db->insertID();
	}


	public function getlatestNews(){


      $sql="select np.*,npc.id as category_id,npc.name as category_name,u.name as user_name,u.email as user_email,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from news_posts np
	    inner join news_post_categories npc on npc.id=np.post_category_id 
		left join users u on u.id=np.posted_by
		left join  admin_users as au on np.posted_by=0
		order by np.id desc limit 0,1"; 
		


		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		if(isset($result[0])){
		return $result[0];	
		}else{
		return $result[0]=array();	
		}
	}


public function getAllPost(){
		$sql="select np.*,npc.name as category_name from news_posts np inner join news_post_categories npc on npc.id=np.post_category_id where  np.deleted_at=0"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
	}

	public function getAllPostByUser(){
		$sql="select np.*,npc.name as category_name from news_posts np inner join news_post_categories npc on npc.id=np.post_category_id where  np.deleted_at=0 order by np.id desc limit 0,200";
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
	}
	public function getSinglePost($id = false) {
        $sql="select np.*,npc.name as category_name from news_posts np inner join news_post_categories npc on npc.id=np.post_category_id where np.id='".$id."' "; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		if(isset($result[0])){
		return $result[0];	
		}else{
		return $result[0]=array();	
		}
    }
	public function insertPost($data){
		$this->db->table('news_posts')->insert($data);
	}
	public function insertNews($data){
		$status=array();
		$this->db->table('news_posts')->insert($data);
		$status=array('status'=>1);
		return $status;
	}
	public function updatePost($id,$data){
		$sql="update news_posts set post_category_id='".$data['post_category_id']."',title='".$data['title']."',content='".$data['content']."'";
		if($data['image']!=''){
		$sql.=",image='".$data['image']."'";	
		}
		if($data['galleryimage']!=''){
		$sql.=",galleryimage='".$data['galleryimage']."'";	
		}
		if($data['videofile']!=''){
		$sql.=",videofile='".$data['videofile']."'";	
		}
		$sql.=",videourl='".$data['videourl']."',updated_at='".$data['updated_at']."',location='".$data['location']."' where id='".$id."'";	
		
		
		$query=$this->db->query($sql);
		
	}
	public function deletePost($id){
		$sql="update news_posts set deleted_at=1 where id='".$id."'"; 
		$query=$this->db->query($sql);
	}
	public function getPostComment($id = false) {
       $sql="select npco.post_id,npco.commented_by,npco.message,npco.created_at,u.name as users_name,u.profile_image as users_profile_image,u.email as users_email,a.name as admin_name,a.email as admin_email from news_post_comments npco 
		left join users u
		on npco.commented_by=u.id
		left join admin_users a
		on npco.commented_by=0
		 where npco.post_id='".$id."'
		"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		
		return $result;
    }
	public function insertPostComment($data){
		$this->db->table('news_post_comments')->insert($data);
		$status=array('status'=>1);
		return $status;
	}
//api functions
public function news_dashboard_api(){
		$sql="select np.*,npc.name as category_name,u.name as user_name,u.email as user_email,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from news_posts np 
		inner join news_post_categories npc on npc.id=np.post_category_id 
        left join users u on u.id=np.posted_by
        left join admin_users au on np.posted_by=0 where 
         np.deleted_at=0 order by np.id desc   limit 0,3";  

		
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
	}
	
}