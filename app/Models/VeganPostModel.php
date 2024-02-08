<?php 

namespace App\Models;  
use CodeIgniter\Model;

  
class VeganPostModel extends Model{

	public function getSingleUserPost($id) {
		$result=array();
		if($id!=''){
		//$userids=$id.",";

        //$sql="Select * from vegan_log_posts where user_id='".$id."'"; 
         $sql="Select * from posts where user_id='".$id."'"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();

		// foreach($result as $val){
		// 	$userids.=$val['image'].',';
		// }
	  }
	  return $result;

		
    }

    public function insertContact($data){
		$status=array();
		$this->db->table('contact')->insert($data);
		$status=array('status'=>1);
		return $status;
	}

	
	public function getVeganPost($id){
		//$id=1;
		$result=array();
		if($id!=''){
		$userids=$id.",";
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
		
		//$userids
		$sql="select vlp.created_at as post_created_at,vlp.content as post_content,vlp.image as post_image,us.name as user_name,us.profile_image as user_image from vegan_log_posts vlp inner join users us on us.id=vlp.user_id where  vlp.deleted_at=0 and vlp.user_id in(".$userids.") order by vlp.id desc"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		
		
		}
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
 



	public function insertPost($data){
		$this->db->table('vegan_log_posts')->insert($data);
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
		$query=$this->db->query($sql);
	}
	public function getPostComment($id = false) {
       $sql="select npco.post_id,npco.admin_id,npco.message,npco.created_at,u.name as users_name,u.profile_image as users_profile_image,u.email as users_email,a.name as admin_name,a.email as admin_email from post_comments npco 
		left join users u
		on npco.user_id=u.id
		left join admin_users a
		on npco.admin_id=a.id
		 where npco.post_id='".$id."'
		"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		
		return $result;
    }
	public function insertPostComment($data){
		$this->db->table('post_comments')->insert($data);
	}

	public function getPostCommentByid($id = false) {
       $sql="select p.id as post_id,p.post_category_id as post_categories,p.title as post_title,p.content as post_content,p.image as post_image,p.updated_at as updated_at,p.user_id as user_id,p.post_type as post_type,p.location as post_location, pc.message as comment,pc.admin_id as user_id,pc.user_id as comment_by_id,u.name as name_of_commenter

        from posts p 
        left join post_comments pc
		on p.id=pc.post_id
		
		left join users u
		on u.id=pc.user_id
		 where p.user_id='".$id."'
		"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		
		return $result;
    }




}