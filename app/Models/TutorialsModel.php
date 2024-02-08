<?php 

namespace App\Models;  
use CodeIgniter\Model;

  
class TutorialsModel extends Model{

	public function getAllPostCategory() {
        $sql="select * from tutorials where deleted_at=0"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
    }
	public function getSinglePostCategory($id = false) {
        $sql="select * from tutorials where id='".$id."'"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		if(isset($result[0])){
		return $result[0];	
		}else{
		return $result[0]=array();	
		}
    }
	public function deletePostCategory($id){
		$sql="update tutorials set deleted_at=1 where id='".$id."'"; 
		$query=$this->db->query($sql);
	}
	public function insertPostCategory($data){
		$this->db->table('news_post_categories')->insert($data);
	}
	public function updatePostCategory($id,$data){
		$sql="update tutorials set name='".$data['name']."' where id='".$id."'"; 
		$query=$this->db->query($sql);
		
	}
	
    public function getAllPost(){
		$sql="select * from tutorials where deleted_at=0"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
	}
	public function getSinglePost($id = false) {
        $sql="select * from tutorials where id='".$id."' "; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		if(isset($result[0])){
		return $result[0];	
		}else{
		return $result[0]=array();	
		}
    }
	public function insertPost($data){
		$this->db->table('tutorials')->insert($data);
	}
	public function updatePost($id,$data){
		if($data['file']!=''){
		 $sql="update tutorials set title='".$data['title']."',content='".$data['content']."',file='".$data['file']."',location='".$data['location']."' where id='".$id."'";	
		}else{
		$sql="update tutorials set title='".$data['title']."',content='".$data['content']."',location='".$data['location']."' where id='".$id."'";	
		}
		
		$query=$this->db->query($sql);
		
	}
	public function deletePost($id){
		$sql="update tutorials set deleted_at=1 where id='".$id."'"; 
		$query=$this->db->query($sql);
	}
	public function getPostComment($id = false) {
       $sql="select npco.post_id,npco.admin_id,npco.message,npco.created_at,u.name as users_name,u.profile_image as users_profile_image,u.email as users_email,a.name as admin_name,a.email as admin_email from news_post_comments npco 
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
		$this->db->table('news_post_comments')->insert($data);
	}
}