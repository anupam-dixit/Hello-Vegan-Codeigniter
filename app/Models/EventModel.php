<?php 

namespace App\Models;  
use CodeIgniter\Model;

  
class EventModel extends Model{

	public function updateReadStatus(){
		$sql="update events set read_status=1";  
		$query=$this->db->query($sql);
		return true;
	}
	public function getAllEventCategories() {
        $sql="select * from event_categories where deleted_at=0 order by id desc"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
    }
	public function getSingleEventCategory($id = false) {
        $sql="select * from event_categories where id='".$id."'"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		if(isset($result[0])){
		return $result[0];	
		}else{
		return $result[0]=array();	
		}
    }
	public function deleteEventCategory($id){
		$sql="update event_categories set deleted_at=1 where id='".$id."'"; 
		$query=$this->db->query($sql);
	}
	public function insertEventCategory($data){
		$status=array();
		$sql="select count(id) as cnt from event_categories where name='".$data['name']."'"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		
		if($result[0]['cnt']==0){
		$this->db->table('event_categories')->insert($data);
		$status=array('status'=>1);
		}else{
		$status=array('status'=>0);	
		}
		return $status;
	}


	public function insertNotinterstedEvent($data){

		$status=array();
		$this->db->table('event_not_interested')->insert($data);
		$status=array('status'=>1);
		return $status;
		
		
	}



	public function insertEventComment($data){
		$user_sql="select posted_by from events where id='".$data['event_id']."'";
	    $user_query=$this->db->query($user_sql); 	
		$user_query_result=$user_query->getResultArray();
		$sql="insert into user_notifications set receiver_id='".$user_query_result[0]['posted_by']."',sender_id='".$data['comment_by']."',table_name='posts',table_id='".$data['event_id']."',type='Comments',type_name='Events',created_at='".$data['created_at']."'";
		$this->db->query($sql);
		$this->db->table('event_comment')->insert($data);
		return $this->db->insertID();
	}

	public function getEventCommentByid($id = false) {
       $results=array();
	   $sql="select ec.event_id,ec.comment_by,ec.message,ec.created_at,u.name as users_name,u.profile_image as users_profile_image,u.email as  users_email,a.name as admin_name,a.email as admin_email from event_comment ec 
	   left join users u
		on ec.comment_by=u.id left join admin_users a on ec.comment_by=0 where ec.id='".$id."' order by ec.created_at desc
		"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		if(isset($result[0])){
			$results=$result[0];
		}
		return $results;
    }



	public function getEventComment() {

       $sql="select ec.event_id,ec.comment_by,ec.message,ec.created_at,u.name as users_name,u.profile_image as users_profile_image,u.email as users_email,a.name as admin_name,a.email as admin_email from event_comment ec 
		left join users u
		on ec.comment_by=u.id
		left join admin_users a
		on ec.comment_by=0
		 where ec.event_id=(select id from events order by events.id DESC limit 0,1) order by ec.created_at desc
		"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		
		return $result;
    }


	public function updateEventCategory($id,$data){
		$status=array();
		$sql="select id,count(id) as cnt from event_categories where name='".$data['name']."'"; 
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
		$sql="update event_categories set name='".$data['name']."' where id='".$id."'"; 
		$this->db->query($sql);	
		}
        return $status;
		
	}
	//users request

	public function getAllEventAttendent() {
		//  $sq="select ev.*,ec.name as category_name,u.name as user_name,u.email as user_email,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from events ev 
		// inner join event_categories ec on ec.id=ev.category 
  //       left join users u on u.id=ev.posted_by
  //       left join admin_users au on ev.posted_by=0
  //       where ev.deleted_at=0 and ev.posted_by in (".$userids.") and ev.id != (select id from events where posted_by in (".$userids.") and ec.id='".$categoryId."'  order by id desc limit 0,1) 
		// order by ev.id desc;"; 

        $sql="select * from event_attendent where event_id =(select id from events order by events.id DESC limit 0,1)"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
    }


    public function insertEventAttending($data){
		
		$status=array();
		$this->db->table('event_attendent')->insert($data);
		$status=array('status'=>1);
		return $status;
	}


	public function getEventCommentUser($id = false) {
       $sql="select ec.event_id,ec.comment_by,ec.message,ec.created_at,u.name as users_name,u.profile_image as users_profile_image,u.email as users_email,a.name as admin_name,a.email as admin_email from event_comment ec left join users u
		on ec.comment_by=u.id left join admin_users a on ec.comment_by=0 where ec.event_id='".$id."' order by ec.created_at desc limit 0,2
		"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		
		return $result;
    }

    


    public function getEventCommentdetail($id = false) {
          $sql="select ec.event_id,ec.comment_by,ec.message,ec.created_at,u.name as users_name,u.profile_image as users_profile_image,u.email as  users_email,a.name as admin_name,a.email as admin_email from event_comment ec left join users u
		on ec.comment_by=u.id left join admin_users a on ec.comment_by=0 where ec.event_id='".$id."' order by ec.created_at desc
		"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		
		return $result;
    }




	public function getAllUsers() {
        $sql="select id,name from users"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
    }
	public function getAllEvent() {
		
        $sql="select ev.*,ec.name as category_name,u.name as user_name,u.email as user_email,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from events ev 
		inner join event_categories ec on ec.id=ev.category 
        left join users u on u.id=ev.posted_by
        left join admin_users au on ev.posted_by=0
        where ev.deleted_at=0 and ev.status=1
		order by ev.id desc;"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
    }


    public function getEventRequest() {
		
        $sql="select ev.*,ec.name as category_name,u.name as user_name,u.email as user_email,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from events ev 
		inner join event_categories ec on ec.id=ev.category 
        left join users u on u.id=ev.posted_by
        left join admin_users au on ev.posted_by=0
        where ev.deleted_at=0 and ev.status=0
		order by ev.id desc"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
    }


	public function getAllEventByCategory($id,$categoryId) {
		
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
         $sq="select ev.*,ec.name as category_name,u.name as user_name,u.email as user_email,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from events ev 
		inner join event_categories ec on ec.id=ev.category 
        left join users u on u.id=ev.posted_by
        left join admin_users au on ev.posted_by=0
        where ev.deleted_at=0 and ev.posted_by in (".$userids.") and ev.id != (select id from events where posted_by in (".$userids.") and ec.id='".$categoryId."'  order by id desc limit 0,1) 
		order by ev.id desc;"; 

		 $sql="select ev.*,ec.name as category_name,u.name as user_name,u.email as user_email,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from events ev 
		inner join event_categories ec on ec.id=ev.category 
        left join users u on u.id=ev.posted_by
        left join admin_users au on ev.posted_by=0
        where ev.deleted_at=0  and ev.category='".$categoryId."'
		order by ev.id desc;"; 
		



		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
    }

    public function getEventByUser($id) {
		
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
         $sq="select ev.*,ec.name as category_name,u.name as user_name,u.email as user_email,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from events ev 
		inner join event_categories ec on ec.id=ev.category 
        left join users u on u.id=ev.posted_by
        left join admin_users au on ev.posted_by=0
        where ev.deleted_at=0 and ev.posted_by in (".$userids.") and ev.id != (select id from events where posted_by in (".$userids.")  order by id desc limit 0,1) 
		order by ev.id desc;"; 


		$sql="select ev.*,ec.name as category_name,u.name as user_name,u.email as user_email,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from events ev 
		inner join event_categories ec on ec.id=ev.category 
        left join users u on u.id=ev.posted_by
        left join admin_users au on ev.posted_by=0
        where ev.deleted_at=0 and ev.status =1 and ev.posted_by='".$id."'
		order by ev.id desc;"; 
		
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
    }


    public function getAllEventByUserForProfile($id){   

     $sql="select ev.*,ec.name as category_name,u.name as user_name,u.email as user_email,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from events ev 
		inner join event_categories ec on ec.id=ev.category 
        left join users u on u.id=ev.posted_by
        left join admin_users au on ev.posted_by=0
        where ev.deleted_at=0 and ev.posted_by='".$id."' and ev.status =1
		order by ev.id desc;"; 
		
		
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;

	}

	public function getAllEventByUser($id) {
		
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
         $sq="select ev.*,ec.name as category_name,u.name as user_name,u.email as user_email,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from events ev 
		inner join event_categories ec on ec.id=ev.category 
        left join users u on u.id=ev.posted_by
        left join admin_users au on ev.posted_by=0
        where ev.deleted_at=0 and ev.posted_by in (".$userids.") and ev.id != (select id from events where posted_by in (".$userids.")  order by id desc limit 0,1) 
		order by ev.id desc;"; 


		$sql="select ev.*,(select count(user_id) from event_attendent  where event_id=ev.id) as event_attend ,ec.name as category_name,u.name as user_name,u.email as user_email,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from events ev 
		inner join event_categories ec on ec.id=ev.category 
        left join users u on u.id=ev.posted_by
        left join admin_users au on ev.posted_by=0
        left join event_attendent ed on ev.id=ed.event_id
        where ev.status=1 and ev.deleted_at=0   
		order by ev.id desc;"; 

		
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
    }
	
public function getSingleEventApi($id,$event_id) {
		 $sql="select ev.*,date(ev.created_at) as created_at,date(ev.event_start_date) as event_start_date,date(ev.event_end_date) as event_end_date,(select count(user_id) from event_attendent  where event_id=ev.id and user_id='".$id."') as event_attend ,ec.name as category_name,u.name as user_name,u.email as user_email,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from events ev 
		inner join event_categories ec on ec.id=ev.category 
        left join users u on u.id=ev.posted_by
        left join admin_users au on ev.posted_by=0
        left join event_attendent ed on ev.id=ed.event_id
        where ev.status=1 and ev.deleted_at=0 and ev.id='".$event_id."'   
		order by ev.id desc limit 0,1"; 

		
		$query=$this->db->query($sql);
		$result=$query->getRow();
		
		return $result;
    }
public function getAllEventApi($id,$start,$limit) {
		 $sql="select ev.*,(select count(user_id) from event_attendent  where event_id=ev.id and user_id='".$id."') as event_attend ,ec.name as category_name,u.name as user_name,u.email as user_email,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from events ev 
		inner join event_categories ec on ec.id=ev.category 
        left join users u on u.id=ev.posted_by
        left join admin_users au on ev.posted_by=0
        where ev.status=1 and ev.deleted_at=0 and  ev.id not in (select event_id from event_not_interested where event_id=ev.id and user_id='".$id."')    
		order by ev.id desc limit $start,$limit"; 

		
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
    }

    public function getAllEventProfileApi($id,$start,$limit) {
		 $sql="select ev.*,(select count(user_id) from event_attendent  where event_id=ev.id and user_id='".$id."') as event_attend ,ec.name as category_name,(select count(message) from event_comment  where event_id=ev.id) as total_comment,u.name as user_name,u.email as user_email,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from events ev 
		inner join event_categories ec on ec.id=ev.category 
        left join users u on u.id=ev.posted_by
        left join admin_users au on ev.posted_by=0
        where ev.status=1 and ev.deleted_at=0 and  ev.id not in (select event_id from event_not_interested where event_id=ev.id and user_id='".$id."') and ev.posted_by= '".$id."'  
		order by ev.id desc limit $start,$limit"; 

		
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
    }


public function getAllEventByCategoryApi($id,$categoryId,$start,$limit) {
		
		$sql="select ev.*,(select count(user_id) from event_attendent  where event_id=ev.id and user_id='".$id."') as event_attend ,ec.name as category_name,u.name as user_name,u.email as user_email,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from events ev 
		inner join event_categories ec on ec.id=ev.category 
        left join users u on u.id=ev.posted_by
        left join admin_users au on ev.posted_by=0
       
        where ev.status=1 and ev.deleted_at=0 and ev.category='".$categoryId."' and  ev.id not in (select event_id from event_not_interested where event_id=ev.id and user_id='".$id."')   
		order by ev.id desc limit $start,$limit"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
    }

	public function getTopFiveEventByUser($id) {
		
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
         $sq="select ev.*,ec.name as category_name,u.name as user_name,u.email as user_email,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from events ev 
		inner join event_categories ec on ec.id=ev.category 
        left join users u on u.id=ev.posted_by
        left join admin_users au on ev.posted_by=0
        where ev.deleted_at=0 and ev.posted_by in (".$userids.") and ev.id != (select id from events where posted_by in (".$userids.")  order by id desc limit 0,1) 
		order by ev.id desc;"; 


		$sql="select ev.*,(select count(user_id) from event_attendent  where event_id=ev.id) as event_attend ,ec.name as category_name,u.name as user_name,u.email as user_email,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from events ev 
		inner join event_categories ec on ec.id=ev.category 
        left join users u on u.id=ev.posted_by
        left join admin_users au on ev.posted_by=0
        left join event_attendent ed on ev.id=ed.event_id
        where ev.status=1 and ev.deleted_at=0   
		order by ev.id desc limit 0,5;"; 

		
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
    }
	public function getUpcomingEvents($id){
		$sql="select ev.*,(select count(user_id) from event_attendent  where event_id=ev.id) as event_attend ,ec.name as category_name,u.name as user_name,u.email as user_email,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from events ev 
		inner join event_categories ec on ec.id=ev.category 
        left join users u on u.id=ev.posted_by
        left join admin_users au on ev.posted_by=0
        left join event_attendent ed on ev.id=ed.event_id
        where ev.status=1 and ev.deleted_at=0 and  ev.id NOT IN (select event_id from event_not_interested where user_id='".$id."' order by id)  
		order by ev.id desc limit 0,5"; 
       
		
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
	}
	public function getLatestEvent() {
       
		$sql="select ev.*,ec.id as category_id,ec.name as category_name,u.name as user_name,u.email as user_email,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from events ev 
		inner join event_categories ec on ec.id=ev.category 
        left join users u on u.id=ev.posted_by
        left join admin_users au on ev.posted_by=0	 where ev.status =1
		order by ev.id desc limit 0,1";
		
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		if(isset($result[0])){
		return $result[0];	
		}else{
		return $result[0]=array();	
		}
    }
	public function getLatestEventByUser($id) {
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
		

		$sql="select ev.*,ec.id as category_id,ec.name as category_name,u.name as user_name,u.email as user_email,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from events ev
		inner join event_categories ec on ec.id=ev.category 
        left join users u on u.id=ev.posted_by
        left join admin_users au on ev.posted_by=0	
        where ev.status=1 and  ev.id NOT IN (select event_id from event_not_interested where user_id='".$id."' order by id)
		order by ev.id desc limit 0,1";

		
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		if(isset($result[0])){
		return $result[0];	
		}else{
		return $result[0]=array();	
		}
    }
	public function getLatestEventByCategory($id,$categoryId) {
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
		$sq="select ev.*,ec.id as category_id,ec.name as category_name,u.name as user_name,u.email as user_email,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from events ev 
		inner join event_categories ec on ec.id=ev.category 
        left join users u on u.id=ev.posted_by
        left join admin_users au on ev.posted_by=0	
		where ev.status =1 and posted_by in (".$userids.")  and ec.id='".$categoryId."'
		order by ev.id desc limit 0,1";


		$sql="select ev.*,ec.id as category_id,ec.name as category_name,u.name as user_name,u.email as user_email,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from events ev 
		inner join event_categories ec on ec.id=ev.category 
        left join users u on u.id=ev.posted_by
        left join admin_users au on ev.posted_by=0	
		where  ev.category='".$categoryId."'
		order by ev.id desc limit 0,1";
		
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		if(isset($result[0])){
		return $result[0];	
		}else{
		return $result[0]=array();	
		}
    }
	
	public function getSingleEvent($id = false) {
       
		$sql="select ev.*,ec.id as category_id,ea.status as event_status,ec.name as category_name,u.name as user_name,u.email as user_email,u.profile_image  as user_profile,u.mobile_no as user_phone,au.name as au_user_name,au.email as au_user_email from events ev 
		inner join event_categories ec on ec.id=ev.category 
        left join users u on u.id=ev.posted_by
        left join event_attendent ea on ea.event_id=ev.id
        left join admin_users au on ev.posted_by=0	
		where ev.id='".$id."' order by ev.id desc limit 0,1";
		
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		if(isset($result[0])){
		return $result[0];	
		}else{
		return $result[0]=array();	
		}
		return $result;
    }

    public function insertEventGoing($data){
		$user_sql="select posted_by from events where id='".$data['event_id']."'";
	    $user_query=$this->db->query($user_sql); 	
		$user_query_result=$user_query->getResultArray();
		
		$likestatus='Going';
		if($data['status']==0){
			$likestatus='notGoing';
			$this->db->query("delete from event_attendent where user_id='".$data['user_id']."' and event_id='".$data['event_id']."'");
		}
		$sql="insert into user_notifications set receiver_id='".$user_query_result[0]['posted_by']."',sender_id='".$data['user_id']."',table_name='events',table_id='".$data['event_id']."',type='".$likestatus."',type_name='Post',created_at='".$data['created_at']."'";
		$this->db->query($sql);
		if($data['status']==1){
		$this->db->table('event_attendent')->insert($data);
		}
		return $this->db->insertID();
	}



    public function updateEventGoingStatus($user_id,$event_id){
		$sql="update event_attendent set status = 0 where user_id='".$user_id."' and event_id='".$event_id."'"; 
		$query=$this->db->query($sql);
	}

	public function updateEventStatus($id,$data){
		$sql="update events set status='".$data['status']."' where id='".$id."'"; 
		$query=$this->db->query($sql);
	}
	public function deleteEvent($id){
		$sql="update events set deleted_at=1 where id='".$id."'"; 
		$query=$this->db->query($sql);
	}
	public function declineEventRequest($id){
		$sql="update events set status=2 where id='".$id."'"; 
		$query=$this->db->query($sql);
	}
	public function approveEventRequest($id){
		$sql="update events set status=1 where id='".$id."'"; 
		$query=$this->db->query($sql);
	}
	public function insertEvent($data){
		$status=array();
		$this->db->table('events')->insert($data);
		$status=array('status'=>1);
		return $status;
	}

	public function insertEventApi($data){
		$status=array();
		$this->db->table('events')->insert($data);
		$status=array('status'=>1);
		return $this->db->insertID();
	}

	public function updateEvent($id,$data){
		$status=array();
		
		$event_start_date=$data['event_start_date'].' '.$data['event_start_time'];
		$event_end_date=$data['event_end_date'].' '.$data['event_end_time'];
        $sql="update events set category='".$data['category']."',name='".$data['name']."',location='".$data['location']."',posted_by='".$data['posted_by']."',event_start_date='".$event_start_date."',event_end_date='".$event_end_date."',details='".$data['details']."',"; 
		if($data['video']!=''){
			$sql.="video='".$data['video']."',"; 
		}
		if($data['image']!=''){
			$sql.="image='".$data['image']."',";
		}
		$sql.="updated_at='".$data['updated_at']."' where id='".$id."'"; 	
		$this->db->query($sql);	
        $status=array('status'=>1);	
        return $status;
	
	}
   
	
	
}