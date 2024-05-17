<?php 

namespace App\Models;  
use CodeIgniter\Model;

  
class BlogModel extends Model{

	
	public function updateReadStatus(){
		$sql="update blog_posts set read_status=1";  
		$query=$this->db->query($sql);
		return true;
	}
	public function getAllPostCategoryByUser() {
        $sql="SELECT MONTHNAME(`created_at`) as BlogMonthName,extract(month from created_at) as BlogMonth,extract(year from created_at) as BlogYear FROM `blog_posts` where deleted_at=0  group by extract(month from `created_at`)  order by created_at desc";  
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
    }
	public function getAllPostCategory() {
        $sql="select * from blog_post_categories where deleted_at=0 order by id desc";  
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
    }
	public function getSinglePostCategory($id = false) {
        $sql="select * from blog_post_categories where id='".$id."'"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		if(isset($result[0])){
		return $result[0];	
		}else{
		return $result[0]=array();	
		}
		
    }
	public function deletePostCategory($id){
		$sql="update blog_post_categories set deleted_at=1 where id='".$id."'"; 
		$query=$this->db->query($sql);
	}
	public function insertPostCategory($data){
		$this->db->table('blog_post_categories')->insert($data);
	}
	public function updatePostCategory($id,$data){
		$sql="update blog_post_categories set name='".$data['name']."' where id='".$id."'"; 
		$query=$this->db->query($sql);
		
	}


	public function updateBlogStatus($id){
		$sql="update blog_posts set status=1 where id='".$id."'"; 
		$query=$this->db->query($sql);
		
	}
	public function updateBlogDeclineStatus($id){
		$sql="update blog_posts set status=2 where id='".$id."'"; 
		$query=$this->db->query($sql);
		
	}
	
    public function getAllPost(){
		$sql="select np.*,npc.name as category_name from blog_posts np left join blog_post_categories npc on npc.id=np.post_category_id where  np.deleted_at=0 and np.status=1";

		$sq="select np.*,npc.name as category_name from blog_posts np left join blog_post_categories npc on npc.id=np.post_category_id where  np.deleted_at=0"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
	}


	 public function getAllPostRequest(){
		$sql="select bp.id,bp.title,bp.content,bp.image,bp.video,bp.created_at,bp.location,bp.galleryimage,bpc.name as category_name,
        CASE bp.posted_by WHEN '0' THEN au.name ELSE u.name END AS user_name,
		CASE bp.posted_by WHEN '0' THEN au.email ELSE u.email END AS user_email  
		from blog_posts bp 
		left join blog_post_categories bpc on bp.post_category_id=bpc.id
		left join users u on u.id=bp.posted_by
		left join admin_users au on bp.posted_by=0
		where bp.status=0 and bp.deleted_at=0 order by bp.id desc"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
	}
    public function getAllBlogByCategoryLimit($categoryId,$start,$limit) {
		 $sql="select bp.*,bpc.name as category_name,u.name as user_name,u.email as user_email,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from blog_posts bp  
		inner join blog_post_categories bpc on bpc.id=bp.post_category_id 
        left join users u on u.id=bp.posted_by
        left join admin_users au on bp.posted_by=0
        where bp.deleted_at=0 and bp.post_category_id='".$categoryId."' and bp.status=1
		order by bp.id desc limit $start,$limit"; 
		
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
    }
      
	public function getAllBlogByCategory($id,$categoryId) {
		
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


         $sq="select bp.*,bpc.name as category_name,u.name as user_name,u.email as user_email,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from blog_posts bp  
		inner join blog_post_categories bpc on bpc.id=bp.post_category_id 
        left join users u on u.id=bp.posted_by
        left join admin_users au on bp.posted_by=0
        where bp.deleted_at=0 and bp.posted_by in (".$userids.") and bp.id != (select id from blog_posts where posted_by in (".$userids.") and bp.id='".$categoryId."'  order by id desc limit 0,1) 
		order by bp.id desc;"; 


		 $sql="select bp.*,bpc.name as category_name,u.name as user_name,u.email as user_email,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from blog_posts bp  
		inner join blog_post_categories bpc on bpc.id=bp.post_category_id 
        left join users u on u.id=bp.posted_by
        left join admin_users au on bp.posted_by=0
        where bp.deleted_at=0 and bp.post_category_id='".$categoryId."' and bp.status=1
		order by bp.id desc;"; 
		
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
    }


	public function getLatestBlogByCategory($id,$categoryId) {
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

		$sql="select bp.*,bpc.name as category_name,u.name as user_name,u.email as user_email,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from blog_posts bp  
		inner join blog_post_categories bpc on bpc.id=bp.post_category_id 
        left join users u on u.id=bp.posted_by
        left join admin_users au on bp.posted_by=0
        where posted_by in (".$userids.")  and bpc.id='".$categoryId."' and bp.status=1
		order by bp.id desc limit 0,1";
        

		
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		if(isset($result[0])){
		return $result[0];	
		}else{
		return $result[0]=array();	
		}
    }

   public function getAllPostYearByUser($id,$month,$year){

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
         $sq="select bp.*,bpc.name as category_name,u.name as user_name,u.email as user_email,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from blog_posts bp 
		inner join blog_post_categories bpc on bpc.id=bp.post_category_id 
        left join users u on u.id=bp.posted_by
        left join admin_users au on bp.posted_by=0
        where bp.deleted_at=0 and bp.posted_by in (".$userids.") and bp.id != (select id from blog_posts where posted_by in (".$userids.") and extract(month from created_at)=".$month." and extract(year from created_at)=".$year." order by id desc limit 0,1) 
		and extract(month from bp.created_at)=".$month." and extract(year from bp.created_at)=".$year."
		order by bp.id desc;"; 


		 $sql="select bp.*,bpc.name as category_name,u.name as user_name,u.email as user_email,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from blog_posts bp 
		inner join blog_post_categories bpc on bpc.id=bp.post_category_id 
        left join users u on u.id=bp.posted_by
        left join admin_users au on bp.posted_by=0
        where bp.deleted_at=0 
		and extract(month from bp.created_at)=".$month." and extract(year from bp.created_at)=".$year."
		order by bp.id desc;"; 
		
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;


	}
public function insertBlog($data){
		$status=array();
		$this->db->table('blog_posts')->insert($data);
		$status=array('status'=>1);
		return $status;
	}
public function insertBlogApi($data){
		$status=array();
		$this->db->table('blog_posts')->insert($data);
		return $this->db->insertID();
	}	
	public function getAllPostByUser($id){

      $sql="select bp.*,bpc.name as category_name,u.name as user_name,u.email as user_email,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from blog_posts bp 
		inner join blog_post_categories bpc on bpc.id=bp.post_category_id 
        left join users u on u.id=bp.posted_by
        left join admin_users au on bp.posted_by=0
        where bp.deleted_at=0 and bp.status=1
		order by bp.id desc "; 
		
		
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;



	}
   public function getAllPostByUserLimit($id,$start,$limit){

      $sql="select bp.*,bpc.name as category_name,u.name as user_name,u.email as user_email,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from blog_posts bp 
		inner join blog_post_categories bpc on bpc.id=bp.post_category_id 
        left join users u on u.id=bp.posted_by
        left join admin_users au on bp.posted_by=0
        where bp.deleted_at=0 and bp.status=1
		order by bp.id desc limit $start,$limit"; 
		
		
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		$i=0;
		foreach($result as $val){
			$result[$i]['content']=strip_tags($val['content']);
			$i++;
		}
		
		return $result;



	}

	public function getAllPostByUserForProfileForApi($id,$start,$limit){

      $sql="select bp.*,bpc.name as category_name,u.name as user_name,u.email as user_email,u.mobile_no as user_phone,(select count(message) from blog_post_comments  where post_id=bp.id) as total_comment,au.name as au_user_name,au.email as au_user_email from blog_posts bp 
		inner join blog_post_categories bpc on bpc.id=bp.post_category_id 
        left join users u on u.id=bp.posted_by
        left join admin_users au on bp.posted_by=0
        where bp.deleted_at=0 and bp.posted_by='".$id."' and  bp.status=1
		order by bp.id desc limit $start,$limit ";  
		
		
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;



	}

	public function getAllPostByUserForProfile($id){

      $sql="select bp.*,bpc.name as category_name,u.name as user_name,u.email as user_email,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from blog_posts bp 
		inner join blog_post_categories bpc on bpc.id=bp.post_category_id 
        left join users u on u.id=bp.posted_by
        left join admin_users au on bp.posted_by=0
        where bp.deleted_at=0 and bp.posted_by='".$id."' and  bp.status=1
		order by bp.id desc"; 
		
		
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;



	}

	public function getAllPostfor_dasbord($id){

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
         $sq="select bp.*,bpc.name as category_name,u.name as user_name,u.email as user_email,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from blog_posts bp 
		inner join blog_post_categories bpc on bpc.id=bp.post_category_id 
        left join users u on u.id=bp.posted_by
        left join admin_users au on bp.posted_by=0
        where bp.deleted_at=0 and bp.posted_by in (".$userids.") and bp.id != (select id from blog_posts where posted_by in (".$userids.")  order by id desc limit 0,1) 
		order by bp.id desc limit 0,2;"; 

		 $sql="select bp.*,bpc.name as category_name,u.name as user_name,u.email as user_email,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from blog_posts bp 
		inner join blog_post_categories bpc on bpc.id=bp.post_category_id 
        left join users u on u.id=bp.posted_by
        left join admin_users au on bp.posted_by=0
        where bp.deleted_at=0  
		order by bp.id desc limit 0,2;"; 
		
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;



	}
	public function getSinglePost($id = false) {
        $sql="select np.*,npc.name as category_name from blog_posts np left join blog_post_categories npc on npc.id=np.post_category_id where np.id='".$id."' "; 
		
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		if(isset($result[0])){
		return $result[0];	
		}else{
		return $result[0]=array();	
		}
		
    }
	public function insertPost($data){
		$this->db->table('blog_posts')->insert($data);
	}
	public function updatePost($id,$data){
		if($data['image']!=''){
		 $sql="update blog_posts set post_category_id='".$data['post_category_id']."',title='".$data['title']."',content='".$data['content']."',image='".$data['image']."',updated_at='".$data['updated_at']."',location='".$data['location']."' where id='".$id."'";	
		}else{
		$sql="update blog_posts set post_category_id='".$data['post_category_id']."',title='".$data['title']."',content='".$data['content']."',updated_at='".$data['updated_at']."',location='".$data['location']."' where id='".$id."'";	
		}
		
		$query=$this->db->query($sql);
		
	}
	public function deletePost($id){
		$sql="update blog_posts set deleted_at=1 where id='".$id."'"; 
		$query=$this->db->query($sql);
	}
	public function getPostComment($id = false) {
       $sql="select npco.post_id,npco.commented_by,npco.message,npco.created_at,u.name as users_name,u.profile_image as users_profile_image,u.email as users_email,a.name as admin_name,a.email as admin_email from blog_post_comments npco left join users u
		on npco.commented_by=u.id left join admin_users a on npco.commented_by=0 where npco.post_id='".$id."' order by npco.created_at desc
		"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		
		return $result;
    }
	public function getPostCommentUser($id = false) {
       $sql="select npco.post_id,npco.commented_by,npco.message,npco.created_at,u.name as users_name,u.profile_image as users_profile_image,u.email as users_email,a.name as admin_name,a.email as admin_email from blog_post_comments npco left join users u
		on npco.commented_by=u.id left join admin_users a on npco.commented_by=0 where npco.post_id='".$id."' order by npco.created_at desc limit 0,2
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



   public function getBlogsComment() {

    $sql="select npco.post_id,npco.commented_by,npco.message,npco.created_at,u.name as users_name,u.profile_image as users_profile_image,u.email as users_email,a.name as admin_name,a.email as admin_email from blog_post_comments npco left join users u
		on npco.commented_by=u.id left join admin_users a on npco.commented_by=0
		 where npco.post_id=(select id from blog_posts order by blog_posts.id DESC limit 0,1) order by npco.created_at desc
		"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		
		return $result;
    }





	public function insertPostComment($data){
		
		
		$user_sql="select posted_by from blog_posts where id='".$data['post_id']."'";
	    $user_query=$this->db->query($user_sql); 	
		$user_query_result=$user_query->getResultArray();
		$sql="insert into user_notifications set receiver_id='".$user_query_result[0]['posted_by']."',sender_id='".$data['commented_by']."',table_name='blog_posts',table_id='".$data['post_id']."',type='Comments',type_name='Blog',created_at='".$data['created_at']."'";
		$this->db->query($sql);
		$this->db->table('blog_post_comments')->insert($data);
		return $this->db->insertID();
	}



	// public function getSingleEvent($id = false) {
       
	// 	$sql="select ev.*,ec.id as category_id,ec.name as category_name,u.name as user_name,u.email as user_email,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from events ev 
	// 	inner join event_categories ec on ec.id=ev.category 
 //        left join users u on u.id=ev.posted_by
 //        left join admin_users au on ev.posted_by=0	
	// 	where ev.id='".$id."'";
		
	// 	$query=$this->db->query($sql);
	// 	$result=$query->getResultArray();
	// 	if(isset($result[0])){
	// 	return $result[0];	
	// 	}else{
	// 	return $result[0]=array();	
	// 	}
	// 	return $result;
 //    }



	public function getSingleblogs($id = false) {

		$sq="select bp.*,bpc.id as category_id,bpc.name as  category_name,u.profile_image as user_profile,u.name as user_name,u.email as user_email,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from blog_posts bp
		inner join blog_post_categories bpc on bpc.id=bp.post_category_id
		left join users u on u.id=bp.posted_by
		left join admin_users au on bp.posted_by=0
		where bp.id='".$id."' and bp.status=1";
       
		$query=$this->db->query($sq);
		$result=$query->getResultArray();
		if(isset($result[0])){
		return $result[0];	
		}else{
		return $result[0]=array();	
		}
		return $result;
    }
public function getLatestBlogYearByUser($id,$month,$year) {
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

		$sq="select bp.*,bpc.id as category_name,bpc.name as category_name,u.name as user_name,u.email as user_email,u.mobile_no as user_phone, au.name as admin_user_name,au.email as admin_user_email from blog_posts bp
		inner join blog_post_categories bpc on bpc.id=bp.post_category_id
		left join users u on u.id=bp.posted_by
		left join admin_users au on bp.posted_by=0
		where posted_by in (".$userids.") and extract(month from bp.created_at)=".$month." and extract(year from bp.created_at)=".$year."
		order by bp.id desc limit 0,1";

		$sql="select bp.*,bpc.id as category_name,bpc.name as category_name,u.name as user_name,u.email as user_email,u.mobile_no as user_phone, au.name as admin_user_name,au.email as admin_user_email from blog_posts bp
		inner join blog_post_categories bpc on bpc.id=bp.post_category_id
		left join users u on u.id=bp.posted_by
		left join admin_users au on bp.posted_by=0
		where  extract(month from bp.created_at)=".$month." and extract(year from bp.created_at)=".$year." and bp.status=1
		order by bp.id desc limit 0,1";


		
		
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		if(isset($result[0])){
		return $result[0];	
		}else{
		return $result[0]=array();	
		}
    }

      public function getLatestBlogByUser($id) {
       
	   $sql="select bp.*,bpc.id as category_name,bpc.name as category_name,u.name as user_name,u.email as user_email,u.mobile_no as user_phone, au.name as admin_user_name,au.email as admin_user_email from blog_posts bp
		inner join blog_post_categories bpc on bpc.id=bp.post_category_id
		left join users u on u.id=bp.posted_by
		left join admin_users au on bp.posted_by=0 where  bp.status=1 AND bp.deleted_at = 0
		order by bp.id desc limit 0,1";
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		if(isset($result[0])){
		return $result[0];	
		}else{
		return $result[0]=array();	
		}
    }

    	public function getAllBlogReceipesByUser($id) {
		
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

		$sq= "select r.*,  rc.name as category_name,u.name as user_name, u.email as users_email,u.mobile_no as user_phone,au.name as as admin_user_name,au.email as admin_user_email from receipes r
		inner join receipe_categories rc on rc.id= r.receipe_category_id
		left join users u on u.id=r.admin_id
		left join admin_users au on r.admin_id=0
		where r.deleted_at=0 and r.admin_id in (".$userids.") and r.id !=(select id from receipes where admin_id in (".$userids.")
		order by id desc limit 0,1)
		order by  r.id desc ;";

		
     
		
		$query=$this->db->query($sq);
		$result=$query->getResultArray();
		return $result;
    }


}