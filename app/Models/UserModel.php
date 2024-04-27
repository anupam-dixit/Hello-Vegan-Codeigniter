<?php 
namespace App\Models;  
use CodeIgniter\Model;
//print_r($this->db->getLastQuery());
class UserModel extends Model{
    protected $table = 'users';
    protected $allowedFields = [
        'name',
        'last_name',
        'dob',
        'city',
        'pin_code',
        'state',
        'country',
        'address',
        'description',
        'profile_image',
        'cover_image',
        'email',
        'password',
        'created_at',
        'updated_at',
        'created_by',
        'status',
		'location',
		'mobile_no',
		'verificationCode'
    ];
	public function getAllUsersList($id){
		
		$result=array();
		$result_array=array();
		$sql_sender="select receiver_id as id  from users_friend where sender_id='".$id."'
                    UNION
					select sender_id as id  from users_friend where  receiver_id='".$id."'
                     order by id"; 
		$query_sender=$this->db->query($sql_sender);
		$result=$query_sender->getResultArray();
		
		$in=$id.",";
		if(count($result)!=0){
			foreach($result as $val){
				$in.=$val['id'].",";
			}
			
		}
		$in=rtrim($in,",");
		//if($in==''){
		//$sql="select id,name,profile_image from  users";	
		//}else{
		$sql="select id,name,profile_image from  users where id not in (".$in.") and id not in (select sender_id from friend_request where receiver_id='".$id."')";	
		//}
		
		$query=$this->db->query($sql);
		$result_array=$query->getResultArray();
		
		
		return $result_array;
	}
	public function people_you_may_know($id){
		$sql_sender="select receiver_id as id  from users_friend where sender_id='".$id."'
                    UNION
					select sender_id as id  from users_friend where  receiver_id='".$id."'
                     order by id";
		$query_sender=$this->db->query($sql_sender);
		$result=$query_sender->getResultArray();

		$in=$id.",";
		if(count($result)!=0){
			foreach($result as $val){
				$in.=$val['id'].",";
			}

		}
		$in=rtrim($in,",");
		//if($in==''){
		//$sql="select id,name,profile_image from  users";
		//}else{
		$sql="select id,name,profile_image from  users where id not in (".$in.") and id not in (select sender_id from friend_request where receiver_id='".$id."') and id not in (select sender_id from friend_request where receiver_id='".$id."') and id not in (select removed_user_id from users_remove where removed_by_user_id='".$id."')";
		//}

		$query=$this->db->query($sql);
		$result_array=$query->getResultArray();


		return $result_array;
	}
	public function getFrontUserFriendPosts($id){
	  $result_all=array();
		$sql_sender="select * from users_friend  
		 where sender_id='".$id."'"; 
		$query_sender=$this->db->query($sql_sender);
		$result_sender=$query_sender->getResultArray();
		$val_friend_ids='';
		if(count($result_sender)!=0){
			
			
			foreach($result_sender as $val_sender){
				$val_friend_ids.="'".$val_sender['receiver_id']."',";
			}
		}
		$sql_receiver="select * from users_friend  
		 where receiver_id='".$id."'"; 
		$query_receiver=$this->db->query($sql_receiver);
		$result_receiver=$query_receiver->getResultArray();
		if(count($result_receiver)!=0){
			foreach($result_receiver as $val_receiver){
				$val_friend_ids.="'".$val_receiver['sender_id']."',";
			}
		}
        
		//get post data
		if(!empty($val_friend_ids)){
			    $result_all=array();
				$val_friend_ids=rtrim($val_friend_ids,",");
				//form posts
				$sql_forum_post="select fpt.name ,fp.id ,fp.title,fp.content,fp.image,fp.created_at,fp.post_type from forum_posts fp 
				inner join forum_post_tags fpt
				on fp.post_tag_id=fpt.id
				where fp.user_id IN(".$val_friend_ids.")";
				$query_forum_post=$this->db->query($sql_forum_post);
				$result_forum_post=$query_forum_post->getResultArray();
			    
				//news posts
				$sql_news_post="select npc.name  ,np.id,np.title,np.content,np.image,np.created_at,np.post_type from news_posts np 
				inner join news_post_categories npc
				on np.post_category_id=npc.id
				where np.user_id IN(".$val_friend_ids.")";
				$query_news_post=$this->db->query($sql_news_post);
				$result_news_post=$query_news_post->getResultArray();
				$result_all=array_merge($result_forum_post,$result_news_post);
				//blog posts
				$sql_blog_post="select bpc.name ,bp.id as post_id,bp.title,bp.content,bp.image,bp.created_at,bp.post_type from blog_posts bp 
				inner join blog_post_categories bpc
				on bp.post_category_id=bpc.id
				where bp.user_id IN(".$val_friend_ids.")";
				$query_blog_post=$this->db->query($sql_blog_post);
				$result_blog_post=$query_blog_post->getResultArray();
				$result_all=array_merge($result_all,$result_blog_post);
				$keys = array_column($result_all, 'created_at');
                array_multisort($keys, SORT_DESC, $result_all);
				//print_r($result_all);
			}
		
		
		return $result_all;	
	}
	public function Friends($id = false) {
		$result=array();
		$sql="select receiver_id as id  from users_friend where sender_id='".$id."'
                    UNION
					select sender_id as id  from users_friend where  receiver_id='".$id."'
                     order by id"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
    }
	public function friendRequestSent($id,$login_id){
		//get friend list
		$sql_sender="select count(id) as cnt from friend_request where sender_id='".$login_id."' and receiver_id='".$id."'"; 
		$query_sender=$this->db->query($sql_sender);
		$result_sender=$query_sender->getResultArray();
		
		$re=0;
		if($result_sender[0]['cnt']!=0){
			$re=1;
		} 
		
		return $re;
	}
	public function friendRequestSentTotal($id,$login_id){
		//get friend list
		$sql_sender="select count(id) as cnt from friend_request where sender_id='".$login_id."' "; 
		$query_sender=$this->db->query($sql_sender);
		$result_sender=$query_sender->getResultArray();
		
		$re=0;
		if($result_sender[0]['cnt']!=0){
			$re=$result_sender[0]['cnt'];
		} 
		
		return $re;
	}
	public function friendRequestRec($id,$login_id){
		//get friend list
		
		$sql_receiver="select count(id) as cnt from friend_request where sender_id='".$id."' and receiver_id='".$login_id."'"; 
		$query_receiver=$this->db->query($sql_receiver);
		$result_receiver=$query_receiver->getResultArray();
		$re=0;
		
		if($result_receiver[0]['cnt']!=0){
			$re=1;
		} 
		return $re;
	}
	public function friendRequestRecTotal($id,$login_id){
		//get friend list
		$sql_receiver="select count(id) as cnt from friend_request where  receiver_id='".$login_id."'"; 
		$query_receiver=$this->db->query($sql_receiver);
		$result_receiver=$query_receiver->getResultArray();
		$re=0;
		
		if($result_receiver[0]['cnt']!=0){
			$re=$result_receiver[0]['cnt'];
		} 
		return $re;
		
	}
	public function friendRequestSendByMe($id = false) {
		$result=array();
		$sql="select receiver_id as id  from friend_request where  sender_id='".$id."'  order by id"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
    }
	public function friendRequestReceivedByMe($id = false) {
		$result=array();
		$sql="select sender_id as id  from friend_request where  receiver_id='".$id."'  order by id"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
    }
	public function friendRequestSendByMeApi($id = false) {
		$result=array();
		$sql="select u.*  from friend_request fr inner join users u on u.id=fr.receiver_id where  fr.sender_id='".$id."'  order by fr.id"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
    }
	public function friendRequestReceivedByMeAPi($id = false) {
		//get friend list
		$sql_sender="select u.* from users_friend uf inner join users u
        on u.id=uf.receiver_id	where (uf.sender_id='".$id."')"; 
		$query_sender=$this->db->query($sql_sender);
		$result_sender=$query_sender->getResultArray();
		$sql_receiver="select u.* from users_friend uf inner join users u
        on u.id=uf.sender_id where (uf.receiver_id='".$id."')"; 
		$query_receiver=$this->db->query($sql_receiver);
		$result_receiver=$query_receiver->getResultArray();
		$in_array=[];
		if(count($result_sender)!=0 && count($result_receiver)!=0 ){
			$result1=array_merge($result_sender,$result_receiver);
		}elseif(count($result_sender)!=0){
			$result1=$result_sender;
		}elseif(count($result_receiver)!=0){
			$result1=$result_receiver;
		}
		
		$i=0;
		foreach($result1 as $v){
			$in_array[]=$v['id'];
		}
		//get friend list
		$result=array();
		$sql="select u.*  from friend_request fr inner join users u on u.id=fr.sender_id where   fr.receiver_id='".$id."'  order by fr.id"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		$i=0;
		
		
		foreach($result as $val){
			    $sql_mutual="select u.id from users_friend uf inner join users u on u.id=uf.receiver_id	where (uf.sender_id='".$val['id']."' and u.id!='".$id."') union select u.id from users_friend uf inner join users u on u.id=uf.sender_id where (uf.receiver_id='".$val['id']."'  and u.id!='".$id."')"; 
			
		    $query_mutual=$this->db->query($sql_mutual);
			$result_mutual=$query_mutual->getResultArray();
			$result[$i]['mutual_friend_count']=0;
			if(count($result_mutual)!=0){
				foreach($result_mutual as $vs){
				  if(in_array($vs['id'],$in_array)){
					$result[$i]['mutual_friend_count']+=1;
				 }	
				}
				
			} 
			$i++;
		}
		
		return $result;
    }
	public function getSingleUserFriend($id = false) {
		$result=array();
		$sql_sender="select u.* from users_friend uf inner join users u
        on u.id=uf.receiver_id	where (uf.sender_id='".$id."')"; 
		$query_sender=$this->db->query($sql_sender);
		$result_sender=$query_sender->getResultArray();
		$sql_receiver="select u.* from users_friend uf inner join users u
        on u.id=uf.sender_id where (uf.receiver_id='".$id."')"; 
		$query_receiver=$this->db->query($sql_receiver);
		$result_receiver=$query_receiver->getResultArray();
		$in_array=[];
		if(count($result_sender)!=0 && count($result_receiver)!=0 ){
			$result=array_merge($result_sender,$result_receiver);
		}elseif(count($result_sender)!=0){
			$result=$result_sender;
		}elseif(count($result_receiver)!=0){
			$result=$result_receiver;
		}
		
		$i=0;
		foreach($result as $v){
			$in_array[]=$v['id'];
		}
		
		foreach($result as $val){
			    $sql_mutual="select u.id from users_friend uf inner join users u on u.id=uf.receiver_id	where (uf.sender_id='".$val['id']."' and u.id!='".$id."') union select u.id from users_friend uf inner join users u on u.id=uf.sender_id where (uf.receiver_id='".$val['id']."'  and u.id!='".$id."')"; 
			
		    $query_mutual=$this->db->query($sql_mutual);
			$result_mutual=$query_mutual->getResultArray();
			$result[$i]['mutual_friend_count']=0;
			if(count($result_mutual)!=0){
				foreach($result_mutual as $vs){
				  if(in_array($vs['id'],$in_array)){
					$result[$i]['mutual_friend_count']+=1;
				 }	
				}
				
			} 
			$i++;
		}
		return $result;
    }
	public function getFriendRequest($id = false) {
		$result=array();
		$sql_sender="select u.* from friend_request uf inner join users u
        on u.id=uf.sender_id		
		 where (uf.receiver_id='".$id."')"; 
		$query_sender=$this->db->query($sql_sender);
		$result=$query_sender->getResultArray();
		
		
		return $result;
    }
	public function getUserFriendBirthday($id = false) {
		$result=array();
		$sql_sender="select u.* from users_friend uf inner join users u
        on u.id=uf.receiver_id		
		 where (uf.sender_id='".$id."' and dob='".date('Y-m-d')."')"; 
		$query_sender=$this->db->query($sql_sender);
		$result_sender=$query_sender->getResultArray();
		$sql_receiver="select u.* from users_friend uf inner join users u
        on u.id=uf.sender_id		
		 where (uf.receiver_id='".$id."' and dob='".date('Y-m-d')."')"; 
		$query_receiver=$this->db->query($sql_receiver);
		$result_receiver=$query_receiver->getResultArray();
		
		if(count($result_sender)!=0 && count($result_receiver)!=0 ){
			$result=array_merge($result_sender,$result_receiver);
		}elseif(count($result_sender)!=0){
			$result=$result_sender;
		}elseif(count($result_receiver)!=0){
			$result=$result_receiver;
		}
		
		return $result;
    }
	public function getAllUsers() {
		$this->orderBy('id', 'DESC');
		return $this->findAll();
    }
	public function getAllCountry() {
		$query=$this->db->query("select * from country");
		$result=$query->getResultArray();
		return $result;
    }
	public function getSingleUserByEmail($email = false) {
        $sql="select count(verificationCode) as vc,verificationCode from users where email ='".$email."'"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		if(isset($result[0])){
		return $result[0];	
		}else{
		return $result[0]=array();	
		}
    }


	public function getSingleUser($id = false,$login_user_id = false) {
        $sql="select * from users where id='".$id."'"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		if(isset($result[0])){
		$sql_sender="select count(id) as id from users_friend	where sender_id='".$id."' and receiver_id='".$login_user_id."'"; 
		$query_sender=$this->db->query($sql_sender);
		$result_sender=$query_sender->getResultArray();
		$sql_receiver="select count(id) as id from users_friend	where receiver_id='".$id."'  and sender_id='".$login_user_id."'"; 
		$query_receiver=$this->db->query($sql_receiver);
		$result_receiver=$query_receiver->getResultArray();
		$in_array=[];
		$result[0]['friend_status']=0;
		if($result_sender[0]['id']==1){
		$result[0]['friend_status']=1;	
		}
		if($result_receiver[0]['id']==1){
		$result[0]['friend_status']=1;	
		}
		return $result[0];	
		}else{
		return $result[0]=array();	
		}
    }
 //------------------+++++++++++++++++++++++++++++++++++++++++++++++--------------------------------------

//changes made by akhilesh
     public function getSingleUserPost($id = false) {
        $sql="Select * from vegan_log_posts where user_id='".$id."'"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		if(isset($result[0])){
		return $result[0];	
		}else{
		return $result[0]=array();	
		}
    }

    //------------------+++++++++++++++++++++++++++++++++++++++++++++++--------------------------------------

	public function getSecurityQuestions($userId){
		$sql="Select * from users_secret_questions where user_id ='".$userId."'"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
	}
	public function saveSecurityQuestions($userId,$sq){
		$i=1;
		foreach($sq as $values){
				$sql="insert into users_secret_questions values('','".$userId."','".$values['sq'.$i]."','".$values['sa'.$i]."',1)"; 
		        $query=$this->db->query($sql);
                $i++;				
		}
	}
	public function updateSecurityQuestions($userId,$sq){
		$j=0;
		$r=1;
		$sql="Select * from users_secret_questions where user_id ='".$userId."'"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
			if(count($result)!=0){
				foreach($result as $values){
				$sql="update  users_secret_questions set secret_question='".$sq[$j]['sq'.$r]."',secret_answer='".$sq[$j]['sa'.$r]."' where id='".$values['id']."'"; 
				  $query=$this->db->query($sql);
					$j++;				
					$r++;				
				}
			}else{
				$i=1;
				foreach($sq as $values){
				
					$sql="insert into users_secret_questions values('','".$userId."','".$values['sq'.$i]."','".$values['sa'.$i]."',1)"; 
					$query=$this->db->query($sql);
					$i++;				
			    }
		    }
	}
	public function getUserCountByEmail($slug) {
        $sql="Select count(id) as cnt from users where email='".$slug."'"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result[0]['cnt'];
      
    }
	public function getEditUserCountByEmail($slug,$id) {
        $sql="Select count(id) as cnt from users 
		where email='".$slug."' and id!='".$id."'"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result[0]['cnt'];
      
    }
	public function getAllDeletedUsers($id = false) {
        $sql="Select * from users_deleted"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
    }
	public function getSingleDeletedUser($id = false) {
        $sql="Select * from users_deleted where id='".$id."'"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		if(isset($result[0])){
		return $result[0];	
		}else{
		return $result[0]=array();	
		}
    }
	public function getSecurityQuestionsForDeletedUser($id){
		$sql="Select * from users_secret_questions where user_id ='".$id."'"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
	}
	public function deleteUser($id){
		$sql="Select * from users where id ='".$id."'"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		$result[0]['id']='';
		$result[0]['deleted_by']=0;
		$result[0]['deleted_user_id']=$id;
		$this->db->table('users_deleted')->insert($result[0]);
		$deletesql="delete from users where id='".$id."'"; 
		$query=$this->db->query($deletesql);
		
		
	}

	public function country($postdata){
		$sql="Select * from countries where name like '%".$postdata."%'"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
	}
}