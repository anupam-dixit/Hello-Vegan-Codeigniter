<?php 

namespace App\Models;  
use CodeIgniter\Model;

  
class ProductModel extends Model{


	public function getAllPost(){
		$sql="select * from product  where  product.deleted_at=0"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
	}

	public function getAllPostForApi($id,$start,$limit){
		$sql="select * from product  where  product.deleted_at=0 order by  product.id desc limit $start,$limit";
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
	}

	public function getProductCommentByid($id = false) {
       $results=array();
	   $sql="select ec.post_id,ec.comment_by,ec.message,ec.created_date,u.name as users_name,u.profile_image as users_profile_image,u.email as  users_email,a.name as admin_name,a.email as admin_email from product_comment ec 
	   left join users u
		on ec.comment_by=u.id left join admin_users a on ec.comment_by=0 where ec.id='".$id."' order by ec.created_date desc
		"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		if(isset($result[0])){
			$results=$result[0];
		}
		return $results;
    }


	public function insertProductComment($data){
		$user_sql="select posted_by from product where id='".$data['post_id']."'";
	    $user_query=$this->db->query($user_sql); 	
		$user_query_result=$user_query->getResultArray();
		$sql="insert into user_notifications set receiver_id='".$user_query_result[0]['posted_by']."',sender_id='".$data['comment_by']."',table_name='posts',table_id='".$data['post_id']."',type='Comments',type_name='Events',created_at='".$data['created_date']."'";
		$this->db->query($sql);
		$this->db->table('product_comment')->insert($data);
		return $this->db->insertID();
	}

	 public function getProductCommentdetail($id = false) {
          $sql="select pc.post_id,pc.comment_by,pc.message,pc.created_date,u.name as users_name,u.profile_image as users_profile_image,u.email as  users_email,a.name as admin_name,a.email as admin_email from product_comment pc left join users u
		on pc.comment_by=u.id left join admin_users a on pc.comment_by=0 where pc.post_id='".$id."' order by pc.created_date desc
		"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		
		return $result;
    }



	public function getSingleProduct_detail($id = false) {

		
		 $sql="select pc.*,u.name as users_name,u.profile_image as users_profile_image,u.email as  users_email,a.name as admin_name,a.email as admin_email from product pc left join users u
		on pc.posted_by=u.id left join admin_users a on pc.posted_by=0 where pc.id='".$id."' 
		"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		if(isset($result[0])){
			if($result[0]['users_name']==''){
				$result[0]['users_name']=$result[0]['admin_name'];
				$result[0]['users_email']=$result[0]['admin_email'];
			}
		return $result[0];	
		}else{
		return $result[0]=array();	
		}
		return $result;
    }
    public function getAllReProductCategories(){
		$sql="select * from product_categories where deleted_at=0"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
	}


	 public function productCategories(){
		$sql="select * from product_categories where deleted_at=0"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
	}


	public function getSingleReProductCategory($id = false){
		$sql="select * from product_categories where id='".$id."'"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		if(isset($result[0])){
		return $result[0];	
		}else{
		return $result[0]=array();	
		}
	}
	public function deleteReProductCategory($id){
		$sql="update product_categories set deleted_at=1 where id='".$id."'"; 
		$query=$this->db->query($sql);
	}
	public function insertReProductCategory($data){
		$status=array();
		$sql="select count(id) as cnt from product_categories where name='".$data['name']."'"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		
		if($result[0]['cnt']==0){
		$this->db->table('product_categories')->insert($data);
		$status=array('status'=>1);
		}else{
		$status=array('status'=>0);	
		}
		return $status;
	}
	public function updateReProductCategory($id,$data){
		$status=array();
		$sql="select id,count(id) as cnt from product_categories where name='".$data['name']."'"; 
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
		$sql="update product_categories set name='".$data['name']."' where id='".$id."'"; 
		$this->db->query($sql);	
		}
        return $status;
	}
	public function updateReProductStatus($id,$data){
		$sql="update product set status='".$data['status']."' where id='".$id."'"; 
		$query=$this->db->query($sql);
	}
	public function getAllReProducts(){
		$sql="select u.name as user_name,u.email as user_email,u.mobile_no as user_phone,ru.*,rc.name as category_name from product ru inner join product_categories rc on rc.id=ru.product_category_id 
		left join users u on u.id=ru.posted_by
		where ru.deleted_at=0 order by ru.id desc"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
	}
	public function getAllUsers(){
		$sql="select id,name from users"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
	}
	public function getSingleReProduct($id = false){
		$sql="select u.name as user_name,u.email as user_email,u.mobile_no as user_phone,ru.*,rc.id as category_id,rc.name as category_name from product ru 
		left join product_categories rc on rc.id=ru.product_category_id 
		left join users u on u.id=ru.posted_by		
		where ru.id='".$id."'"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		if(isset($result[0])){
		return $result[0];	
		}else{
		return $result[0]=array();	
		}
	}
	public function deleteReProduct($id){
		$sql="update product set deleted_at=1 where id='".$id."'"; 
		$query=$this->db->query($sql);
	}
	public function insertReProduct($data){
		$status=array();
		
		$this->db->table('product')->insert($data);
		$status=array('status'=>1);
		
		return $status;
	}
	public function updateReProduct($id,$data){
		$status=array();
		$sql="update product set 
			product_category_id='".$data['product_category_id']."', 
			title='".$data['title']."', 
			content='".$data['content']."',  
			location='".$data['location']."', 
			posted_by='".$data['posted_by']."', 
			product_link='".$data['product_link']."', 
			price='".$data['price']."',
            rating='".$data['rating']."', 
            mobile_no='".$data['mobile_no']."', 
            website_link='".$data['website_link']."', 
			updated_at='".$data['updated_at']."'";
		if($data['image']!=''){
			$sql.=",image='".$data['image']."'";
		}
		if($data['galleryimage']!=''){
			$sql.=",galleryimage='".$data['galleryimage']."'";
		}
		$sql.="where id='".$id."'";	 
		
		$this->db->query($sql);	
		
		$status=array('status'=>1);	
        return $status;
	}
	

	


}