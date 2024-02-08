<?php 

namespace App\Models;  
use CodeIgniter\Model;

  
class ForumModel extends Model{
 
	public function getAllPostTag() {
        $sql="select * from forum_post_tags where deleted_at=0"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
    }
	public function getSinglePostTag($id = false) {
        $sql="select * from forum_post_tags where id='".$id."'"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		if(isset($result[0])){
		return $result[0];	
		}else{
		return $result[0]=array();	
		}
    }
	public function deletePostTag($id){
		$sql="update forum_post_tags set deleted_at=1 where id='".$id."'"; 
		$query=$this->db->query($sql);
	}
	public function insertPostTag($data){
		$this->db->table('forum_post_tags')->insert($data);
	}
	public function updatePostTag($id,$data){
		$sql="update forum_post_tags set name='".$data['name']."' where id='".$id."'"; 
		$query=$this->db->query($sql);
		
	}
	
    public function getAllPost(){
		$sql="select fp.*,fpt.name as tag_name from forum_posts fp inner join forum_post_tags fpt on fpt.id=fp.post_tag_id where  fp.deleted_at=0"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
	}
	public function getSinglePost($id = false) {
        $sql="select fp.*,fpt.name as tag_name from forum_posts fp inner join forum_post_tags fpt on fpt.id=fp.post_tag_id where fp.id='".$id."' "; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		if(isset($result[0])){
		return $result[0];	
		}else{
		return $result[0]=array();	
		}
    }
	public function insertPost($data){
		$this->db->table('forum_posts')->insert($data);
	}
	public function updatePost($id,$data){
		if($data['image']!=''){
		 $sql="update forum_posts set post_tag_id='".$data['post_tag_id']."',title='".$data['title']."',content='".$data['content']."',image='".$data['image']."',updated_at='".$data['updated_at']."',location='".$data['location']."' where id='".$id."'";	
		}else{
		$sql="update forum_posts set post_tag_id='".$data['post_tag_id']."',title='".$data['title']."',content='".$data['content']."',updated_at='".$data['updated_at']."',location='".$data['location']."' where id='".$id."'";	
		}
		
		$query=$this->db->query($sql);
		
	}
	public function deletePost($id){
		$sql="update forum_posts set deleted_at=1 where id='".$id."'"; 
		$query=$this->db->query($sql);
	}
	public function getPostComment($id = false) {
      $sql="select fpco.id,fpco.commented_by,fpco.comment_id,fpco.message,fpco.created_at,u.name as users_name,u.profile_image as users_profile_image,u.email as users_email,a.name as admin_name,a.email as admin_email from forum_post_comments fpco 
		left join users u
		on fpco.commented_by=u.id
		left join admin_users a
		on fpco.commented_by=a.id
		 where fpco.post_id='".$id."' and fpco.comment_id=0
		"; 
		
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		
		return $result;
    }
	
	/* public function getPostCommentTree($arr){
		$children=array();
		$i=1;
		
		foreach($arr as $val){
			
	 	$sql_child="select fpco.id,fpco.admin_id,fpco.comment_id,fpco.user_id,fpco.message,fpco.created_at,u.name as users_name,u.profile_image as users_profile_image,u.email as users_email,a.name as admin_name,a.email as admin_email from forum_post_comments fpco 
		left join users u
		on fpco.user_id=u.id
		left join admin_users a
		on fpco.admin_id=a.id
		where fpco.comment_id='".$val['id']."'"; 	
		
		$query_child=$this->db->query($sql_child);
		$result_child=$query_child->getResultArray();
			
		
			if(count($result_child)!=0){
				$children[$val['id']]=$result_child[0];
				
				$this->getPostCommentTree($result_child);
			}
			
          	$i++;	
	
		}
	
		return $children;
	} */
	/* public function getPostCommentTree($arr,$cmid){
		$children=$arr;
		$sql_child="select fpco.id,fpco.admin_id,fpco.comment_id,fpco.user_id,fpco.message,fpco.created_at,u.name as users_name,u.profile_image as users_profile_image,u.email as users_email,a.name as admin_name,a.email as admin_email from forum_post_comments fpco 
		left join users u
		on fpco.user_id=u.id
		left join admin_users a
		on fpco.admin_id=a.id
		where fpco.comment_id='".$cmid."'"; 	
		$query_child=$this->db->query($sql_child);
		$result_child=$query_child->getResultArray();
		
		

		return $children;
		
		
	} */
	public function insertPostComment($data){
		$this->db->table('forum_post_comments')->insert($data);
	}
	//questions
	public function getAllQuestionTag() {
        $sql="select * from forum_question_tags where deleted_at=0"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
    }
	public function getSingleQuestionTag($id = false) {
        $sql="select * from forum_question_tags where id='".$id."'"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		if(isset($result[0])){
		return $result[0];	
		}else{
		return $result[0]=array();	
		}
    }
	public function deleteQuestionTag($id){
		$sql="update forum_question_tags set deleted_at=1 where id='".$id."'"; 
		$query=$this->db->query($sql);
	}
	public function insertQuestionTag($data){
		$this->db->table('forum_question_tags')->insert($data);
	}
	public function updateQuestionTag($id,$data){
		$sql="update forum_question_tags set name='".$data['name']."' where id='".$id."'"; 
		$query=$this->db->query($sql);
		
	}
	
    public function getAllQuestion(){
		$sql="select fq.*,fqt.name as tag_name from forum_questions fq inner join forum_question_tags fqt on fqt.id=fq.question_tag_id where  fq.deleted_at=0"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
	}
	public function getSingleQuestion($id = false) {
        $sql="select fq.*,fpt.name as tag_name from forum_questions fq inner join forum_question_tags fpt on fpt.id=fq.question_tag_id where fq.id='".$id."' "; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		if(isset($result[0])){
		return $result[0];	
		}else{
		return $result[0]=array();	
		}
    }
	public function insertQuestion($data){
		$this->db->table('forum_questions')->insert($data);
	}
	public function updateQuestion($id,$data){
		if($data['image']!=''){
		 $sql="update forum_questions set question_tag_id='".$data['question_tag_id']."',title='".$data['title']."',content='".$data['content']."',image='".$data['image']."',updated_at='".$data['updated_at']."' where id='".$id."'";	
		}else{
		$sql="update forum_questions set question_tag_id='".$data['question_tag_id']."',title='".$data['title']."',content='".$data['content']."',updated_at='".$data['updated_at']."' where id='".$id."'";	
		}
		
		$query=$this->db->query($sql);
		
	}
	public function deleteQuestion($id){
		$sql="update forum_questions set deleted_at=1 where id='".$id."'"; 
		$query=$this->db->query($sql);
	}
	public function getQuestionComment($id = false) {
       $sql="select fqco.admin_id,fqco.message,fqco.created_at,u.name as users_name,u.profile_image as users_profile_image,u.email as users_email,a.name as admin_name,a.email as admin_email from forum_question_comments fqco 
		left join users u
		on fqco.user_id=u.id
		left join admin_users a
		on fqco.admin_id=a.id
		 where fqco.question_id='".$id."'
		"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		
		return $result;
    }
	public function insertQuestionComment($data){
		$this->db->table('forum_question_comments')->insert($data);
	}
}