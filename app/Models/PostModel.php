<?php 

namespace App\Models;  
use CodeIgniter\Model;

  
class PostModel extends Model{



	public function getSingleUserPost($id) {
		$result=array();
		if($id!=''){
         $sql="Select * from posts where posted_by='".$id."' and deleted_at = 0 order by id desc";
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
	     }
	  return $result;

		
    }
	public function getUserPhotos($id) {
		$result=array();
		$sql="select image from posts where posted_by='".$id."' 
		union select image from blog_posts where posted_by='".$id."'
        union select image from events where posted_by='".$id."' 
		union select image from receipes where posted_by='".$id."' 
		union select profile_image as image from users where id='".$id."' limit 0,9"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
	    $data=[];
	    if(count($result)!=0){
			foreach($result as $val){
			$data[]=$val['image'];	
			}
			
		}
	
	  return $data;

		
    }


    public function getUserPhotosForApi($id,$limit,$start) {
		$result=array();
		$sql="select image from posts where posted_by='".$id."' 
		union select image from blog_posts where posted_by='".$id."'
        union select image from events where posted_by='".$id."' 
		union select image from receipes where posted_by='".$id."' 
		union select profile_image as image from users where id='".$id."' limit $start,$limit"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
	    $data=[];
	    if(count($result)!=0){
			foreach($result as $val){
			$data[]=$val['image'];	
			}
			
		}
	
	  return $data;

		
    }



	public function getUserAllPhotos($id) {
		$result=array();
		$sql="select image from posts where posted_by='".$id."' 
		union select image from blog_posts where posted_by='".$id."'
        union select image from events where posted_by='".$id."' 
		union select image from receipes where posted_by='".$id."' 
		union select profile_image as image from users where id='".$id."'"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
	    $data=[];
	    if(count($result)!=0){
			foreach($result as $val){
			$data[]=$val['image'];	
			}
			
		}
	
	  return $data;

		
    }
	
	public function getSinglepostById($id = false) {

		$sq="select p.*,pc.id as category_id,pc.name as  category_name,u.name as user_name,u.email as user_email,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from posts p
		inner join post_categories pc on pc.id=p.post_category_id
		left join users u on u.id=p.posted_by
		left join admin_users au on p.posted_by=0
		where p.id='".$id."'";
       
		$query=$this->db->query($sq);
		$result=$query->getResultArray();
		if(isset($result[0])){
		return $result[0];	
		}else{
		return $result[0]=array();	
		}
		return $result;
    }

	public function getVeganPost($id){
		 $sql="select p.*,(select count(liked_by) from post_like  where post_id=p.id and liked_by='".$id."') as total_like,(select count(message) from post_comments  where post_id=p.id) as total_comment,p.created_at as post_created_at,p.content as post_content,p.image as post_image,us.id as user_id,us.name as user_name,us.profile_image as user_image,(select count(status) from post_like where post_id=p.id and liked_by='".$id."') as likestatus from posts p inner join users us on us.id=p.posted_by where  p.deleted_at=0  order by p.id desc"; 
         $query=$this->db->query($sql);
		$result=$query->getResultArray();
		
		return $result;
	}
	public function getVeganPostLimit($id,$limit,$start){
		 $sql="select p.*,(select count(liked_by) from post_like  where post_id=p.id and liked_by='".$id."') as total_like,(select count(message) from post_comments  where post_id=p.id) as total_comment,p.created_at as post_created_at,p.content as post_content,p.image as post_image,us.id as user_id,CONCAT(us.name, ' ', us.last_name) as user_name,us.profile_image as user_image,(select count(status) from post_like where post_id=p.id and liked_by='".$id."') as likestatus from posts p inner join users us on us.id=p.posted_by where  p.deleted_at=0  order by p.id desc limit $start,$limit"; 
         $query=$this->db->query($sql);
		$result=$query->getResultArray();
		$i=0;
		foreach($result as $val){
			$result[$i]['content']=strip_tags($val['content']);
			$i++;
		}
		return $result;
	}

	public function getProfilePostLimit($id,$limit,$start){
		 $sql="select p.*,(select count(liked_by) from post_like  where post_id=p.id and liked_by='".$id."') as total_like,(select count(message) from post_comments  where post_id=p.id) as total_comment,p.created_at as post_created_at,p.content as post_content,p.image as post_image,us.id as user_id,us.name as user_name,us.profile_image as user_image,(select count(status) from post_like where post_id=p.id and liked_by='".$id."') as likestatus from posts p inner join users us on us.id=p.posted_by where  p.deleted_at=0 and p.posted_by='".$id."' order by p.id desc limit $start,$limit"; 
         $query=$this->db->query($sql);
		$result=$query->getResultArray();
		$i=0;
		foreach($result as $val){
			$result[$i]['content']=strip_tags($val['content']);
			$i++;
		}
		return $result;
	}


	public function getVeganPostUser($id){
		$sql="select p.*,p.created_at as post_created_at,p.content as post_content,p.image as post_image,us.id as user_id,us.name as user_name,us.profile_image as user_image,(select count(status) from post_like where post_id=p.id and liked_by='".$id."') as likestatus from posts p inner join users us on us.id=p.posted_by where  p.deleted_at=0 and p.id='".$id."'  order by p.id desc"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		
		return $result;
	}

	public function getAllPostCategory() {
        $sql="select * from post_categories where deleted_at=0"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
    }
	public function getSinglePostCategory($id = false) {
        $sql="select * from post_categories where id='".$id."'"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		if(isset($result[0])){
		return $result[0];	
		}else{
		return $result[0]=array();	
		}
		
    }
	public function deletePostCategory($id){
		$sql="update post_categories set deleted_at=1 where id='".$id."'"; 
		$query=$this->db->query($sql);
	}
	public function insertPostCategory($data){
		$this->db->table('post_categories')->insert($data);
	}
	public function updatePostCategory($id,$data){
		$sql="update post_categories set name='".$data['name']."' where id='".$id."'"; 
		$query=$this->db->query($sql);
		
	}

	public function getAllPostByUserForProfile($id){   

      $sql="select bp.*,bpc.name as category_name,u.name as user_name,u.email as user_email,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from posts bp 
		inner join post_categories bpc on bpc.id=bp.post_category_id 
        left join users u on u.id=bp.posted_by
        left join admin_users au on bp.posted_by=0
        where bp.deleted_at=0 and bp.posted_by='".$id."'
		order by bp.id desc"; 
		
		
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;

	}


	
    public function getAllPost(){
		$sql="select np.*,npc.name as category_name from posts np inner join post_categories npc on npc.id=np.post_category_id where  np.deleted_at=0"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
	}
	public function getSinglePost($id = false) {
        $sql="select np.*,npc.name as category_name from posts np inner join post_categories npc on npc.id=np.post_category_id where np.id='".$id."' "; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		if(isset($result[0])){
		return $result[0];	
		}else{
		return $result[0]=array();	
		}
		
    }
	public function getSinglePostUser($id = false) {
       $sq="select bp.*,bpc.id as category_id,bpc.name as  category_name,u.profile_image as user_profile,u.name as user_name,u.email as user_email,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from posts bp
		inner join post_categories bpc on bpc.id=bp.post_category_id
		left join users u on u.id=bp.posted_by
		left join admin_users au on bp.posted_by=0
		where bp.id='".$id."'";
       
		$query=$this->db->query($sq);
		$result=$query->getResultArray();
		if(isset($result[0])){
		return $result[0];	
		}else{
		return $result[0]=array();	
		}
		return $result;
    }
	public function insertPost($data){
		$this->db->table('posts')->insert($data);
		return $this->db->insertID();
	}
	public function updatePost($id,$data){
		if($data['image']!=''){
		 $sql="update posts set post_category_id='".$data['post_category_id']."',title='".$data['title']."',content='".$data['content']."',image='".$data['image']."',updated_at='".$data['updated_at']."',location='".$data['location']."' where id='".$id."'";	
		}else{
		$sql="update posts set post_category_id='".$data['post_category_id']."',title='".$data['title']."',content='".$data['content']."',updated_at='".$data['updated_at']."',location='".$data['location']."' where id='".$id."'";	
		}
		
		$query=$this->db->query($sql);
		
	}
	public function deletePost($id){
		$sql="update posts set deleted_at=1 where id='".$id."'"; 
		return $query=$this->db->query($sql);
	}
	public function getPostComment($id = false) {
       $sql="select npco.post_id,npco.commented_by,npco.message,npco.created_at,u.name as users_name,u.profile_image as users_profile_image,u.email as users_email,a.name as admin_name,a.email as admin_email from post_comments npco 
		left join users u
		on npco.commented_by=u.id
		left join admin_users a
		on npco.commented_by=0
		 where npco.post_id='".$id."' order by npco.created_at desc
		"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		
		return $result;
    }
	public function getPostLike($id){
		$results=[];
		$sql="SELECT count(post_id) as cnt FROM `post_like` where post_id='".$id."'"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		if(isset($result[0])){
		
		$results=$result[0];
		return $result[0];	
		}else{
		$results['likes_data']['cnt']=0;	
		}
		return $results;	
	}
	public function getPostLikeByUser($id,$liked_by){
		$results=[];
		$sql="SELECT count(post_id) as cnt FROM `post_like` where post_id='".$id."' and liked_by='".$liked_by."'"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		if(isset($result[0])){
		
		$results=$result[0];
		return $result[0];	
		}else{
		$results['likes_data']['cnt']=0;	
		}
		return $results;	
	}
	public function getPostCommentUser($id = false) {
       $sql="select npco.post_id,npco.commented_by,npco.message,npco.created_at,u.name as users_name,u.profile_image as users_profile_image,u.email as users_email,a.name as admin_name,a.email as admin_email from post_comments npco 
		left join users u
		on npco.commented_by=u.id
		left join admin_users a
		on npco.commented_by=0
		 where npco.post_id='".$id."' order by npco.created_at desc limit 0,2
		"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		
		return $result;
    }
	public function insertPostComment($data){
		$user_sql="select posted_by from posts where id='".$data['post_id']."'";
	    $user_query=$this->db->query($user_sql); 	
		$user_query_result=$user_query->getResultArray();
		$sql="insert into user_notifications set receiver_id='".$user_query_result[0]['posted_by']."',sender_id='".$data['commented_by']."',table_name='posts',table_id='".$data['post_id']."',type='Comments',type_name='Post',created_at='".$data['created_at']."'";
		$this->db->query($sql);
		$this->db->table('post_comments')->insert($data);
		return $this->db->insertID();
	}
	public function insertPostLike($data){
		$user_sql="select posted_by from posts where id='".$data['post_id']."'";
	    $user_query=$this->db->query($user_sql); 	
		$user_query_result=$user_query->getResultArray();
		
		$likestatus='Like';
		if($data['status']==0){
			$likestatus='UnLike';
			$this->db->query("delete from post_like where liked_by='".$data['liked_by']."' and post_id='".$data['post_id']."'");
		}
		$sql="insert into user_notifications set receiver_id='".$user_query_result[0]['posted_by']."',sender_id='".$data['liked_by']."',table_name='posts',table_id='".$data['post_id']."',type='".$likestatus."',type_name='Post',created_at='".$data['created_at']."'";
		$this->db->query($sql);
		if($data['status']==1){
		$this->db->table('post_like')->insert($data);
		}
		return $this->db->insertID();
	}

	
	public function getPostCommentOlder($id = false) {
       $sql="select npco.post_id,npco.commented_by,npco.message,npco.created_at,u.name as users_name,u.profile_image as users_profile_image,u.email as users_email,a.name as admin_name,a.email as admin_email from post_comments npco left join users u
		on npco.commented_by=u.id left join admin_users a on npco.commented_by=0 where npco.post_id='".$id."'  order by npco.created_at desc LIMIT 18446744073709551615 OFFSET 2
		"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		
		return $result;
    }
	public function getPostCommentByid($id = false) {
       $results=array();
	   $sql="select npco.post_id,npco.commented_by,npco.message,npco.created_at,u.name as users_name,u.profile_image as users_profile_image,u.email as users_email,a.name as admin_name,a.email as admin_email from post_comments npco left join users u
		on npco.commented_by=u.id left join admin_users a on npco.commented_by=0 where npco.id='".$id."' order by npco.created_at desc
		"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		if(isset($result[0])){
			$results=$result[0];
		}
		return $results;
    }
}