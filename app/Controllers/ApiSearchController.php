<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\AdminModel;
use App\Models\UserChatModel;
class ApiSearchController extends BaseController
{
	
	public function liveSearch(){
		header('Access-Control-Allow-Origin: *');
 		header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 		header('Access-Control-Allow-Headers: token, Content-Type');
		$user_details=[];
		$db = db_connect();
		$id=$this->request->getVar('term');
		$sql=$db->query("select id,profile_image,name from users where name like '%".$id."%'");
		$search=array();
		$search['Peoples']=array();
		$array=$sql->getResult();
		if(isset($array[0])){
			$i=0;
			foreach($array as $val){
				$imgurl=base_url().'/'.$val->profile_image;
				if($val->profile_image==''){
					$imgurl=base_url().'/public/frontend/images/f_icon_user.jpg';
				}
				$url=base_url().'/user/public_profile/'.$val->id;
				$search['Peoples'][$i]['url']=$url;
				$search['Peoples'][$i]['imgurl']=$imgurl;
				$search['Peoples'][$i]['name']=$val->name;
			$i++;	
			}
			
		}
		$search['Blogs']=array();
		$sql=$db->query("select image,title from blog_posts where title like '%".$id."%'");
		$array=$sql->getResult();
		if(isset($array[0])){
			$i=0;
			foreach($array as $val){
				$url=base_url().'/user/blog';
				$imgurl=base_url().'/'.$val->image;
				if($val->image==''){
					$imgurl=base_url().'/public/frontend/images/f_icon_user.jpg';
				}
				$search['Blogs'][$i]['url']=$url;
				$search['Blogs'][$i]['imgurl']=$imgurl;
				$search['Blogs'][$i]['name']=$val->title;
            	
				$i++;
			}
		}
		$search['Cooks']=array();
		$sql=$db->query("select image,name from cooks where name like '%".$id."%'");
		$array=$sql->getResult();
		if(isset($array[0])){
			$i=0;
			foreach($array as $val){
				$url=base_url().'/user/cook';
				$imgurl=base_url().'/'.$val->image;
				if($val->image==''){
					$imgurl=base_url().'/public/frontend/images/f_icon_user.jpg';
				}
				$search['Cooks'][$i]['url']=$url;
				$search['Cooks'][$i]['imgurl']=$imgurl;
				$search['Cooks'][$i]['name']=$val->name;
				$i++;
			}
		}
		$search['Events']=array();
		$sql=$db->query("select image,name from events where name like '%".$id."%'");
		$array=$sql->getResult();
		if(isset($array[0])){
			$i=0;
			foreach($array as $val){
				$url=base_url().'/user/cook';
				$imgurl=base_url().'/'.$val->image;
				if($val->image==''){
					$imgurl=base_url().'/public/frontend/images/f_icon_user.jpg';
				}
				$search['Events'][$i]['url']=$url;
				$search['Events'][$i]['imgurl']=$imgurl;
				$search['Events'][$i]['name']=$val->name;
			$i++;	
			}
		}
		$search['News']=array();
		$sql=$db->query("select image,title from news_posts where title like '%".$id."%'");
		$array=$sql->getResult();
		if(isset($array[0])){
			$i=0;
			foreach($array as $val){
				$url=base_url().'/user/news';
				$imgurl=base_url().'/'.$val->image;
				if($val->image==''){
					$imgurl=base_url().'/public/frontend/images/f_icon_user.jpg';
				}
				$search['News'][$i]['url']=$url;
				$search['News'][$i]['imgurl']=$imgurl;
				$search['News'][$i]['name']=$val->title;
				$i++;
			}
		}
	
		//notifications data
		echo json_encode($search);
		die;
	}
	 public function notificationCount(){
		 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
		$id=$this->request->getVar('userId');
		$db = db_connect();
		$tot=0;
		
		$notification_sql=$db->query("select count(un.id) as cnt from user_notifications un where un.read_status=0 and un.receiver_id='".$id."'");
		$notification_array=$notification_sql->getResult();
		if(isset($notification_array[0])){
		 $tot=$notification_array[0]->cnt;	
		}
		
		$array=array('totalcount'=>$tot);
		echo json_encode($array);
		die;
		
	}
	public function notificationShow(){
		
		$id=$this->request->getVar('userId');
		
		$user_details=[];
		$db = db_connect();
		//get details of notifications
		
		$notification_sql=$db->query("select us.name,us.profile_image,un.created_at,un.type,un.type_name,un.sender_id from user_notifications un 
		left join users us on un.sender_id=us.id 
		where un.read_status=0 and un.receiver_id='".$id."' order by un.id desc limit 0,3");
		$notification_array=$notification_sql->getResult();
		$i=0;
		if(isset($notification_array[0])){
			foreach($notification_array as $n_val){
				$name=$n_val->name;
				
			    $image=$n_val->profile_image;
			    $time=$n_val->created_at;
			    $type=$n_val->type;
			    $type_name=$n_val->type_name;
			      if($name==''){
				   $name='Admin';
				   $image='public/frontend/images/logo.png';
				 }
				 $id=$n_val->sender_id;
				 $user_details[$i]['id']=$id;
				 $user_details[$i]['name']=$name;
				 $user_details[$i]['profile_image']=base_url()."/".$image;
				 $user_details[$i]['notification_pageicon']=base_url()."/".'public/frontend/images/notification_pageicon.png';
				 if($type=='Request_Send'){
				   $user_details[$i]['message']="send you friend request";	 
				 }else if($type=='Request_Confirm'){
				  $user_details[$i]['message']="confirm your friend request";	 
				 }else{
				 $user_details[$i]['message']=$type.' on your '.$type_name;	 
				 }
				 	
				 $user_details[$i]['timeview']=$this->time_Agos(strtotime($time));	
				 $i++;
			}
		}
		//$db->query("update user_notifications set read_status=1 where receiver_id='".$id."'");
		echo json_encode($user_details);
		die;
		
	}
	public function notificationList(){
		
		$id=$this->request->getVar('userId');
		
		$user_details=[];
		$db = db_connect();
		//get details of notifications
		
		$notification_sql=$db->query("select us.name,us.profile_image,un.created_at,un.type,un.type_name,un.sender_id from user_notifications un 
		left join users us on un.sender_id=us.id 
		where un.status=0 and un.receiver_id='".$id."' order by un.id desc");
		$notification_array=$notification_sql->getResult();
		$i=0;
		if(isset($notification_array[0])){
			foreach($notification_array as $n_val){
				$name=$n_val->name;
				
			    $image=$n_val->profile_image;
			    $time=$n_val->created_at;
			    $type=$n_val->type;
			    $type_name=$n_val->type_name;
			      if($name==''){
				   $name='Admin';
				   $image='public/frontend/images/logo.png';
				 }
				 $id=$n_val->sender_id;
				 $user_details[$i]['id']=$id;
				 $user_details[$i]['name']=$name;
				 $user_details[$i]['profile_image']=$image;
				 $user_details[$i]['notification_pageicon']='public/frontend/images/notification_pageicon.png';
				 if($type=='Request_Send'){
				   $user_details[$i]['message']="send you friend request";	 
				 }else if($type=='Request_Confirm'){
				  $user_details[$i]['message']="confirm your friend request";	 
				 }else{
				 $user_details[$i]['message']=$type.' on your '.$type_name;	 
				 }
				 	
				 $user_details[$i]['timeview']=$this->time_Agos(strtotime($time));	
				 $i++;
			}
		}
		//$db->query("update user_notifications set read_status=1 where receiver_id='".$id."'");
		echo json_encode($user_details);
		die;
		
	}
	public function time_Agos($time) {
  $msg='';
    // Calculate difference between current
    // time and given timestamp in seconds
    $diff     = time() - $time;
      
    // Time difference in seconds
    $sec     = $diff;
      
    // Convert time difference in minutes
    $min     = round($diff / 60 );
      
    // Convert time difference in hours
    $hrs     = round($diff / 3600);
      
    // Convert time difference in days
    $days     = round($diff / 86400 );
      
    // Convert time difference in weeks
    $weeks     = round($diff / 604800);
      
    // Convert time difference in months
    $mnths     = round($diff / 2600640 );
      
    // Convert time difference in years
    $yrs     = round($diff / 31207680 );
      
    // Check for seconds
    if($sec <= 60) {
        $msg= "$sec seconds ago";
    }
      
    // Check for minutes
    else if($min <= 60) {
        if($min==1) {
            $msg= "one minute ago";
        }
        else {
            $msg= "$min minutes ago";
        }
    }
      
    // Check for hours
    else if($hrs <= 24) {
        if($hrs == 1) { 
            $msg= "an hour ago";
        }
        else {
            $msg= "$hrs hours ago";
        }
    }
      
    // Check for days
    else if($days <= 7) {
        if($days == 1) {
            $msg= "Yesterday";
        }
        else {
            $msg= "$days days ago";
        }
    }
      
    // Check for weeks
    else if($weeks <= 4.3) {
        if($weeks == 1) {
            $msg= "a week ago";
        }
        else {
            $msg= "$weeks weeks ago";
        }
    }
      
    // Check for months
    else if($mnths <= 12) {
        if($mnths == 1) {
            $msg= "a month ago";
        }
        else {
            $msg= "$mnths months ago";
        }
    }
      
    // Check for years
    else {
        if($yrs == 1) {
            $msg= "one year ago";
        }
        else {
            $msg= "$yrs years ago";
        }
    }
	return $msg;
}
}
?>
