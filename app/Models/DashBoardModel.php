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
	public function getAllBlogs() {
        $sql="select count(id) as cnt from blog_posts where status=1";  
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result[0]['cnt'];
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
	public function getAllEvents() {
        $sql="select count(id) as cnt from events where status=1";  
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result[0]['cnt'];
    }
	public function getAllNews() {
        $sql="select count(id) as cnt from news_posts where status=1";  
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result[0]['cnt'];
    }
	public function getAllRecipes() {
        $sql="select count(id) as cnt from receipe_user where status=1";  
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result[0]['cnt'];
    }
	public function getAllRecommendations() {
        $sql="select count(id) as cnt from recommendation_requests where status=1";  
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result[0]['cnt'];
    }
	public function getUsersDayWise(){
		$sql="SELECT  DAYNAME(created_at) as Day, COUNT(id) as Count FROM users GROUP BY DAYNAME(created_at) ORDER BY (created_at)";  
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
		
	}
}