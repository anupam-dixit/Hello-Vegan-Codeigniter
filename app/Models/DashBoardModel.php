<?php 

namespace App\Models;  
use CodeIgniter\Model;

  
class DashBoardModel extends Model{

	
	public function getAllUsers() {
        $sql="select count(id) as cnt from users";  
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result[0]['cnt'];
    }
//	public function getAllBlogs() {
//        $sql="select count(id) as cnt from blog_posts where status=1";
//		$query=$this->db->query($sql);
//		$result=$query->getResultArray();
//		return $result[0]['cnt'];
//    }
    public function getAllBlogs() {
        $sql="select np.*,npc.name as category_name from blog_posts np left join blog_post_categories npc on npc.id=np.post_category_id where  np.deleted_at=0 and np.status=1";
        $query=$this->db->query($sql);
		$result=$query->getResultArray();
		return count($result);
    }
	public function getBlogNotifications() {
        $sql="select count(id) as cnt from blog_posts where read_status=0";  
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result[0]['cnt'];
    }
	public function getEventNotifications() {
        $sql="select count(id) as cnt from events where read_status=0";  
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result[0]['cnt'];
    }
	public function getRecipeNotifications() {
        $sql="select count(id) as cnt from receipe_user where read_status=0";  
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result[0]['cnt'];
    }
//	public function getAllEvents() {
//        $sql="select count(id) as cnt from events where status=1";
//		$query=$this->db->query($sql);
//		$result=$query->getResultArray();
//		return $result[0]['cnt'];
//    }
    public function getAllEvents() {
        $sql="select ev.*,ec.name as category_name,u.name as user_name,u.email as user_email,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from events ev 
		inner join event_categories ec on ec.id=ev.category 
        left join users u on u.id=ev.posted_by
        left join admin_users au on ev.posted_by=0
        where ev.deleted_at=0 and ev.status=1";
        $query=$this->db->query($sql);
        $result=$query->getResultArray();
        return count($result);
    }
//	public function getAllNews() {
//        $sql="select count(id) as cnt from news_posts where status=1";
//		$query=$this->db->query($sql);
//		$result=$query->getResultArray();
//		return $result[0]['cnt'];
//    }
	public function getAllNews() {
        $sql="select np.*,npc.name as category_name from news_posts np inner join news_post_categories npc on npc.id=np.post_category_id where  np.deleted_at=0";

        $query=$this->db->query($sql);
		$result=$query->getResultArray();
		return count($result);
    }
//	public function getAllRecipes() {
//        $sql="select count(id) as cnt from receipe_user where status=1";
//		$query=$this->db->query($sql);
//		$result=$query->getResultArray();
//		return $result[0]['cnt'];
//    }
	public function getAllRecipes() {
        $sql="select np.*,npc.name as category_name from receipe_user np inner join receipe_categories npc on npc.id=np.receipe_category_id where  np.deleted_at=0";
        $query=$this->db->query($sql);
		$result=$query->getResultArray();
		return count($result);
    }
//	public function getAllRecommendations() {
//        $sql="select count(id) as cnt from recommendation_requests where status=1";
//		$query=$this->db->query($sql);
//		$result=$query->getResultArray();
//		return $result[0]['cnt'];
//    }
	public function getAllRecommendations() {
        $sql="select rp.plan_name as user_plan,u.name as user_name,u.email as user_email,u.mobile_no as user_phone,ru.*,rc.name as category_name from recommendation_requests ru inner join recommendation_categories rc on rc.id=ru.category 
		left join users u on u.id=ru.user_id
		left join recommendation_plans rp on ru.plan=rp.id
		where ru.deleted_at=0";
        $query=$this->db->query($sql);
		$result=$query->getResultArray();
		return count($result);
    }
	public function getUsersDayWise(){
		$sql="SELECT  DAYNAME(created_at) as Day, COUNT(id) as Count FROM users GROUP BY DAYNAME(created_at) ORDER BY (created_at)";  
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
		
	}
}