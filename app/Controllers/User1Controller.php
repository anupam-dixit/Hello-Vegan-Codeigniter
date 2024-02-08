<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\BlogModel;
use App\Models\UserChatModel;
use App\Models\VeganPostModel;
use App\Models\EventModel;
use App\Models\RecommendationModel;
use App\Models\NewsModel;
use App\Models\ReceipeModel;
use App\Models\PostModel;
use App\Models\CooksModel;
use App\Models\ProductModel;
use App\Models\RestaurantsModel;

class User1Controller extends BaseController
{
	public function index()
	{

	}


	public function insertcontact(){
		
		$session = session();
		
		
		
		$data=[
	
	  'name'=>$this->request->getPost('name'),
		'email'=>$this->request->getPost('email'),
		'country'=>$this->request->getPost('country'),
		'message'=>$this->request->getPost('message'),
		'mobile'=>$this->request->getPost('number'),
		'status'=>1,
	    
		]; 
		 $rm = new VeganPostModel();
		 $result=$rm->insertContact($data);
		 $session->setFlashdata('msgblog', 'Contact Added Successfully');
		 $response='';
			if($result['status']==1){
			  $response = ['status' => 1 ,'msgblog' => '<span style="color:#090;">Contact Added Successfully</span>' ];
			}else{
			  $response = ['status' => 0 ,'msgblog' => '<span style="color:#900;">sorry we re having some technical problems. please try again !</span>' 						];
			}
		
			 echo json_encode($response);

			  return redirect()->to('/user/connect');	
		 /* if($result['status']==1){
		 return redirect()->to('user/event/add-event');
		 }else{
		  return redirect()->to('user/event/add-event');	 
		 } */
	}
	public function insertcontactlanding(){
		
		$session = session();
		
		
		
		$data=[
	
	  'name'=>$this->request->getPost('name'),
		'email'=>$this->request->getPost('email'),
		'country'=>$this->request->getPost('country'),
		'message'=>$this->request->getPost('message'),
		'mobile'=>$this->request->getPost('number'),
		'status'=>1,
	    
		]; 
		 $rm = new VeganPostModel();
		 $result=$rm->insertContact($data);
		 $session->setFlashdata('msgblog', 'Contact Added Successfully');
		 $response='';
			if($result['status']==1){
			  $response = ['status' => 1 ,'msgblog' => '<span style="color:#090;">Contact Added Successfully</span>' ];
			}else{
			  $response = ['status' => 0 ,'msgblog' => '<span style="color:#900;">sorry we re having some technical problems. please try again !</span>' 						];
			}
		
			 echo json_encode($response);

			  return redirect()->to('/contact');	
		 /* if($result['status']==1){
		 return redirect()->to('user/event/add-event');
		 }else{
		  return redirect()->to('user/event/add-event');	 
		 } */
	}



		public function updateUserProfile(){
		$cover_image_db_data='';
		$cover_image = $this->request->getFile('cover_image');
		$cover_image_name = $cover_image->getName();
		$profile_image_db_data='';
		$profile_image = $this->request->getFile('profile_image');
		$profile_image_name = $profile_image->getName();
		$id=$this->request->getPost('id');
		$data['name']=$this->request->getPost('name');
		$data['last_name']=$this->request->getPost('last_name');
		$data['mobile_no']=$this->request->getPost('mobile');
		$data['address']=$this->request->getPost('address');
		$data['dob']=$this->request->getPost('dob');
		$data['city']=$this->request->getPost('city');
		$data['pin_code']=$this->request->getPost('pin');
		$data['country']=$this->request->getPost('country');
		$data['state']=$this->request->getPost('state');
		$data['address']=$this->request->getPost('address');
		$data['description']=$this->request->getPost('description');
		$data['email']=$this->request->getPost('email');
		// if($this->request->getPost('password')!=''){
		// $data['password']=password_hash($this->request->getPost('password'), PASSWORD_BCRYPT);
		// }
		if($profile_image_name!=''){
			$profile_image_name=time().$profile_image_name;
			$profile_image->move(ROOTPATH.'public/uploads/users/profileImage',$profile_image_name);
			$profile_image_db_data='public/uploads/users/profileImage/'.$profile_image_name;
			$data['profile_image']=$profile_image_db_data;
		}
		if($cover_image_name!=''){
			$cover_image_name=time().$cover_image_name;
			$cover_image->move(ROOTPATH.'public/uploads/users/coverImage',$cover_image_name);
			$cover_image_db_data='public/uploads/users/coverImage/'.$cover_image_name;
			$data['cover_image']=$cover_image_db_data;
		}
		
		$data['status']=1;
		$data['updated_at']=date('Y-m-d H:i');
		
		 $users = new UserModel();
		 $users->update($id,$data);
		 /* print_r($users->getLastQuery());
		 die; */
		
		 return redirect()->to('user/profile');
		 	
	}


	public function blog_profile($id){
		$session = session();
		 $users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($id);
         $data['session'] =$session;

		$users = new UserModel();
		$data['users']=$users->getSingleUser($id);
        $data['loginusers']=$users->getSingleUser($id);
		$data['userfriend']=$users->getSingleUserFriend($id);
        $data['friendrequest']=$users->getFriendRequest($id);

		$blog= new BlogModel();
		$data['blogall_profile']=$blog->getAllPostByUserForProfile($id);


		$rm = new EventModel();
		$data['event_data']=$rm->getEventByUser($id);

       

		$vegan= new PostModel();
		$veganpost=$vegan->getSingleUserPost($id);


		$veganphoto=$vegan->getUserPhotos($id);
		$i=0;
		foreach($veganpost as $values){
		$veganpost[$i]['comments_data']=$vegan->getPostComment($values['id']);
		$veganpost[$i]['likes_data']=$vegan->getPostLike($values['id']);
		$veganpost[$i]['liked_by_user']=$vegan->getPostLikeByUser($values['id'],$session->get('idUserH'));
		$i++;
		}
		
		$data['posts']=$veganpost;
		$data['photos']=$veganphoto;
		
		
        //$data['comment']=$vegan->getPostCommentByid($session->get('idUserH'));
        $data['public_url']=base_url()."/public/frontend/";
		$data['baseurl']=base_url()."/";
		$data['friends']=$users->Friends($id);
		$data['friend_request_send_by_me']=$users->friendRequestSendByMe($id);
		$data['friend_request_received_by_me']=$users->friendRequestReceivedByMe($id);
		return view('user/post/postsUser_blog',$data);

	}


	public function blog_user(){
		$session = session();
		 $users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$data['session'] =$session;


		$users = new UserModel();
		$data['users']=$users->getSingleUser($session->get('idUserH'));
        $data['loginusers']=$users->getSingleUser($session->get('idUserH'));
		$data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
        $data['friendrequest']=$users->getFriendRequest($session->get('idUserH'));

		$blog= new BlogModel();
		$data['blogall_profile']=$blog->getAllPostByUserForProfile($session->get('idUserH'));


		$rm = new EventModel();
		$data['event_data']=$rm->getEventByUser($session->get('idUserH'));

       

		$vegan= new PostModel();
		$veganphoto=$vegan->getUserPhotos($session->get('idUserH'));
		$data['photos']=$veganphoto;
		$data['public_url']=base_url()."/public/frontend/";
		$data['baseurl']=base_url()."/";
        $data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
		$data['friendrequest']=$users->getFriendRequest($session->get('idUserH'));
		$data['birthday']=$users->getUserFriendBirthday($session->get('idUserH'));
		return view('user/profile/profileUser_blog',$data);

	}

	public function recipes_profile($id){
		$session = session();
		 $users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$data['session'] =$session;


		$users = new UserModel();
		$data['users']=$users->getSingleUser($id);
        $data['loginusers']=$users->getSingleUser($id);
		$data['userfriend']=$users->getSingleUserFriend($id);
       $data['friendrequest']=$users->getFriendRequest($id);

		$recipes=new ReceipeModel();
		$data['racipeall_profile']=$recipes->getAllRacipeByUserForProfile($id);



		$blog= new BlogModel();
		$data['blogall_profile']=$blog->getAllPostByUserForProfile($id);


		$rm = new EventModel();
		$data['event_data']=$rm->getEventByUser($id);

       

		$vegan= new PostModel();

		$veganpost=$vegan->getSingleUserPost($id);


		$veganphoto=$vegan->getUserPhotos($id);
		$i=0;
		foreach($veganpost as $values){
		$veganpost[$i]['comments_data']=$vegan->getPostComment($values['id']);
		$veganpost[$i]['likes_data']=$vegan->getPostLike($values['id']);
		$veganpost[$i]['liked_by_user']=$vegan->getPostLikeByUser($values['id'],$session->get('idUserH'));
		$i++;
		}
		
		$data['posts']=$veganpost;
		//$veganphoto=$vegan->getUserAllPhotos($session->get('idUserH'));
		
		$data['photos']=$veganphoto;
		$data['public_url']=base_url()."/public/frontend/";
		$data['baseurl']=base_url()."/";
        $data['userfriend']=$users->getSingleUserFriend($id);
		$data['friendrequest']=$users->getFriendRequest($id);
		$data['birthday']=$users->getUserFriendBirthday($id);
		$data['friends']=$users->Friends($id);
		$data['friend_request_send_by_me']=$users->friendRequestSendByMe($id);
		$data['friend_request_received_by_me']=$users->friendRequestReceivedByMe($id);

		return view('user/post/postsUser_recipe',$data);

	}


	


	public function recipes_user(){
		$session = session();
		 $users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$data['session'] =$session;


		$users = new UserModel();
		$data['users']=$users->getSingleUser($session->get('idUserH'));
        $data['loginusers']=$users->getSingleUser($session->get('idUserH'));
		$data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
         $data['friendrequest']=$users->getFriendRequest($session->get('idUserH'));

		$recipes=new ReceipeModel();
		$data['racipeall_profile']=$recipes->getAllRacipeByUserForProfile($session->get('idUserH'));



		$blog= new BlogModel();
		$data['blogall_profile']=$blog->getAllPostByUserForProfile($session->get('idUserH'));


		$rm = new EventModel();
		$data['event_data']=$rm->getEventByUser($session->get('idUserH'));

       

		$vegan= new PostModel();
		$veganphoto=$vegan->getUserPhotos($session->get('idUserH'));
		$data['photos']=$veganphoto;
		$data['public_url']=base_url()."/public/frontend/";
		$data['baseurl']=base_url()."/";
        $data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
		$data['friendrequest']=$users->getFriendRequest($session->get('idUserH'));
		$data['birthday']=$users->getUserFriendBirthday($session->get('idUserH'));
		return view('user/profile/profileUser_racipe',$data);

	}

	public function event_profile($id){
		$session = session();
		 $users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
	$data['session'] =$session;

		$users = new UserModel();
		$data['users']=$users->getSingleUser($id);
        $data['loginusers']=$users->getSingleUser($id);
		$data['userfriend']=$users->getSingleUserFriend($id);
        $data['friendrequest']=$users->getFriendRequest($id);

		$blog= new BlogModel();
		$data['blogall_profile']=$blog->getAllPostByUserForProfile($id);


		$rm = new EventModel();
		$data['event_data']=$rm->getEventByUser($id);
		$data['eventall_profile']=$rm->getAllEventByUserForProfile($id);




       

		$vegan= new PostModel();

		$veganpost=$vegan->getSingleUserPost($id);


		$veganphoto=$vegan->getUserPhotos($id);
		$i=0;
		foreach($veganpost as $values){
		$veganpost[$i]['comments_data']=$vegan->getPostComment($values['id']);
		$veganpost[$i]['likes_data']=$vegan->getPostLike($values['id']);
		$veganpost[$i]['liked_by_user']=$vegan->getPostLikeByUser($values['id'],$session->get('idUserH'));
		$i++;
		}
		
		$data['posts']=$veganpost;
		
		$data['photos']=$veganphoto;
		$data['public_url']=base_url()."/public/frontend/";
		$data['baseurl']=base_url()."/";
        $data['userfriend']=$users->getSingleUserFriend($id);
		$data['friendrequest']=$users->getFriendRequest($id);
		$data['birthday']=$users->getUserFriendBirthday($id);
		$data['friends']=$users->Friends($id);
		$data['friend_request_send_by_me']=$users->friendRequestSendByMe($id);
		$data['friend_request_received_by_me']=$users->friendRequestReceivedByMe($id);


		return view('user/post/postsUser_event',$data);

	}

	public function event_user(){
		
		$session = session();
		 $users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$data['session'] =$session;


		$users = new UserModel();
		$data['users']=$users->getSingleUser($session->get('idUserH'));
        $data['loginusers']=$users->getSingleUser($session->get('idUserH'));
		$data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
        $data['friendrequest']=$users->getFriendRequest($session->get('idUserH'));

		$blog= new BlogModel();
		$data['blogall_profile']=$blog->getAllPostByUserForProfile($session->get('idUserH'));


		$rm = new EventModel();
		$data['event_data']=$rm->getEventByUser($session->get('idUserH'));
		$data['eventall_profile']=$rm->getAllEventByUserForProfile($session->get('idUserH'));

       

		$vegan= new PostModel();
		$veganpost=$vegan->getSingleUserPost($session->get('idUserH'));
		$veganphoto=$vegan->getUserPhotos($session->get('idUserH'));
		$data['photos']=$veganphoto;
		$data['posts']=$veganpost;
		$data['public_url']=base_url()."/public/frontend/";
		$data['baseurl']=base_url()."/";
        $data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
		$data['friendrequest']=$users->getFriendRequest($session->get('idUserH'));
		$data['birthday']=$users->getUserFriendBirthday($session->get('idUserH'));
		return view('user/profile/profileUser_event',$data);

	}

	public function post_pofile($id){
		$session = session();
		$data['session'] =$session;
		 $users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));


		$users = new UserModel();
		$data['users']=$users->getSingleUser($id);
        $data['loginusers']=$users->getSingleUser($session->get('idUserH'));
		$data['userfriend']=$users->getSingleUserFriend($id);
        $data['friendrequest']=$users->getFriendRequest($id);

		$rm = new EventModel();
		$data['event_data']=$rm->getEventByUser($id);
		

		$vegan= new PostModel();
		$veganpost=$vegan->getSingleUserPost($id);


		$veganphoto=$vegan->getUserPhotos($id);
		$i=0;
		foreach($veganpost as $values){
		$veganpost[$i]['comments_data']=$vegan->getPostComment($values['id']);
		$veganpost[$i]['likes_data']=$vegan->getPostLike($values['id']);
		$veganpost[$i]['liked_by_user']=$vegan->getPostLikeByUser($values['id'],$session->get('idUserH'));
		$i++;
		}
		
		$data['posts']=$veganpost;
		$data['photos']=$veganphoto;
		
		
        //$data['comment']=$vegan->getPostCommentByid($session->get('idUserH'));
        $data['public_url']=base_url()."/public/frontend/";
		$data['baseurl']=base_url()."/";
		$data['friends']=$users->Friends($session->get('idUserH'));
		$data['friend_request_send_by_me']=$users->friendRequestSendByMe($session->get('idUserH'));
		$data['friend_request_received_by_me']=$users->friendRequestReceivedByMe($session->get('idUserH'));
		$data['birthday']=$users->getUserFriendBirthday($session->get('idUserH'));


		return view('user/post/postsUser',$data);

	}



	public function countryData(){
		$session = session();
        $users = new UserChatModel();
		// $data['chatusers'] =$users->getChatUsers();
		// $data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		// $data['session'] =$session;
		// $events = new EventModel();
  //       $data['event_latest']=$events->getLatestEventByUser($session->get('idUserH'));
		// $rm = new RecommendationModel();
		// $data['recats']=$rm->getAllReRequestsByUser();
		// $data['rereceipe']=$rm->getReReceipesByUser($session->get('idUserH'));
         $postdata=$this->input->post();
		$users = new UserModel();

		$data['cout']=$users->country($postdata);

		echo json_encode($data);
		
	}


	





	
	

	public function recommendationUser(){
		$session = session();
        $users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$data['session'] =$session;
		$events = new EventModel();
        $data['event_latest']=$events->getLatestEventByUser($session->get('idUserH'));
		$rm = new RecommendationModel();
		$data['recats']=$rm->getAllReRequestsByUser();
		$data['rereceipe']=$rm->getReReceipesByUser($session->get('idUserH'));
		return view('user/recommendation/recommendationUser',$data);
	}


	public function restaurantUser(){
		$session = session();
        $users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$data['session'] =$session;
		$rm = new RecommendationModel();
		$data['recats']=$rm->getAllReRequestsByUser();

		$rest = new RestaurantsModel();
		$data['restaurant']=$rest->getAllPost();


		return view('user/restaurant/restaurantUser',$data);
	}
	public function productUser(){
		$session = session();
        $users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$data['session'] =$session;
			$rm = new RecommendationModel();
		$data['recats']=$rm->getAllReRequestsByUser();

		 $product= new ProductModel();
		$data['productall']=$product->getAllPost();

		return view('user/product/productUser',$data);
	}
	public function cookUser(){
		$session = session();
        $users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$data['session'] =$session;
		$rm = new RecommendationModel();
		$data['recats']=$rm->getAllReRequestsByUser();

    $cooks= new CooksModel();
		$data['cooksall']=$cooks->getAllPost();

		return view('user/cooks/cooksUser',$data);
	}


	public function profileEdit(){
		$session = session();
		 $users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));	
		$data['session'] =$session;
		$users = new UserModel();
		$data['users']=$users->getSingleUser($session->get('idUserH'));
		$data['loginusers']=$users->getSingleUser($session->get('idUserH'));
		$data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
		$data['friendrequest']=$users->getFriendRequest($session->get('idUserH'));
		$rm = new EventModel();
		$data['event_data']=$rm->getAllEventByUser($session->get('idUserH'));
		$vegan= new PostModel();
		$veganpost=$vegan->getSingleUserPost($session->get('idUserH'));
			$veganphoto=$vegan->getUserPhotos($session->get('idUserH'));
		
		$i=0;
		foreach($veganpost as $values){
		$veganpost[$i]['comments_data']=$vegan->getPostComment($values['id']);
		$i++;
		}	
		$data['posts']=$veganpost;
		$data['photos']=$veganphoto;
        //$data['comment']=$vegan->getPostCommentByid($session->get('idUserH'));
  
		return view('user/profile/edit_profile',$data);
	}



	public function questionUser(){
		$session = session();
        $users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$data['session'] =$session;
		$rm = new RecommendationModel();
		$data['recats']=$rm->getAllReRequestsByUser();

    $cooks= new CooksModel();
		$data['cooksall']=$cooks->getAllPost();

		return view('user/question/questionUser',$data);
	}

	public function ask_questionUser(){
		$session = session();
        $users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$data['session'] =$session;
		$rm = new RecommendationModel();
		$data['recats']=$rm->getAllReRequestsByUser();

    $cooks= new CooksModel();
		$data['cooksall']=$cooks->getAllPost();

		return view('user/question/ask_question',$data);
	}

	public function answerUser(){
		$session = session();
        $users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$data['session'] =$session;
		$rm = new RecommendationModel();
		$data['recats']=$rm->getAllReRequestsByUser();

    $cooks= new CooksModel();
		$data['cooksall']=$cooks->getAllPost();

		return view('user/question/answer',$data);
	}





	// public function profileUser(){
	// 	$session = session();
 //        $users = new UserChatModel();
	// 	$data['chatusers'] =$users->getChatUsers();
	// 	$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
	// 	$data['session'] =$session;
	// 	return view('user/profile/profileUser',$data);
	// }


	public function postDetailUser(){
		$session = session();
		 $users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
         $data['session'] =$session;

		$users = new UserModel();
		$data['users']=$users->getSingleUser($session->get('idUserH'));
         $data['loginusers']=$users->getSingleUser($session->get('idUserH'));
		$data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
        $data['friendrequest']=$users->getFriendRequest($session->get('idUserH'));

		$rm = new EventModel();
		$data['event_data']=$rm->getSingleEvent($session->get('idUserH'));



		$vegan= new PostModel();
		$veganpost=$vegan->getSingleUserPost($session->get('idUserH'));
		
		$i=0;
		foreach($veganpost as $values){
		$veganpost[$i]['comments_data']=$vegan->getPostComment($values['id']);
		$i++;
		}
		
		$data['posts']=$veganpost;

		return view('user/post/postsUser',$data);

	}

	public function postfriendlist(){
		$session = session();
		 $users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
        $data['session'] =$session;

		$users = new UserModel();
		$data['users']=$users->getSingleUser($session->get('idUserH'));
        $data['loginusers']=$users->getSingleUser($session->get('idUserH'));
		$data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
        $data['friendrequest']=$users->getFriendRequest($session->get('idUserH'));

		$rm = new EventModel();
		$data['event_data']=$rm->getSingleEvent($session->get('idUserH'));



		$vegan= new PostModel();
		$veganpost=$vegan->getSingleUserPost($session->get('idUserH'));
		
		$i=0;
		foreach($veganpost as $values){
		$veganpost[$i]['comments_data']=$vegan->getPostComment($values['id']);
		$i++;
		}
		
		$data['posts']=$veganpost;

		return view('user/friend/friendList',$data);

	}


	public function profileUser(){
		$session = session();
		 $users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
$data['session'] =$session;		
		$users = new UserModel();
		$data['users']=$users->getSingleUser($session->get('idUserH'));
		$data['loginusers']=$users->getSingleUser($session->get('idUserH'));
		$data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
		$data['friendrequest']=$users->getFriendRequest($session->get('idUserH'));
		$rm = new EventModel();
		$data['event_data']=$rm->getAllEventByUser($session->get('idUserH'));
		$vegan= new PostModel();
		$veganpost=$vegan->getSingleUserPost($session->get('idUserH'));
		
		$i=0;
		foreach($veganpost as $values){
		$veganpost[$i]['comments_data']=$vegan->getPostComment($values['id']);
		$i++;
		}	
		$data['posts']=$veganpost;
        //$data['comment']=$vegan->getPostCommentByid($session->get('idUserH'));
  
		return view('user/profile/profileUser',$data);
	}


	public function public_profileUser($id){
		$session = session();
		 $users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($id);	
		$data['session'] =$session;
		$users = new UserModel();
		$data['users']=$users->getSingleUser($id);
		$data['loginusers']=$users->getSingleUser($session->get('idUserH'));
		$data['userfriend']=$users->getSingleUserFriend($id);
		$data['friendrequest']=$users->getFriendRequest($id);
		$rm = new EventModel();
		$data['event_data']=$rm->getEventByUser($id);
		$vegan= new PostModel();
		$veganpost=$vegan->getSingleUserPost($id);
		
		$i=0;
		foreach($veganpost as $values){
		$veganpost[$i]['comments_data']=$vegan->getPostComment($values['id']);
		$i++;
		}	
		$data['posts']=$veganpost;
        //$data['comment']=$vegan->getPostCommentByid($session->get('idUserH'));
  
		return view('user/profile/public_profile',$data);
	}





	 public function aboutUser(){
	 	$session = session();
        $users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$data['session'] =$session;
		$post_vegan= new PostModel();
		$data['vaganpost'] =$post_vegan->getVeganPost($session->get('idUserH'));
		$data['session'] =$session;
		$events = new EventModel();
        $data['event_latest']=$events->getLatestEventByUser($session->get('idUserH'));
		$rm = new RecommendationModel();
		$data['recats']=$rm->getAllReRequestsByUser();

		return view('user/about/about');
	} 


	public function contactUser(){
	 	$session = session();


		return view('user/contact/contact');
	} 

		public function termUser(){
	 	$session = session();

		return view('user/term/term');
	}

	public function cookiesUser(){
	 	$session = session();

		return view('user/term/cookies');
	}

	public function advertisingUser(){
	 	$session = session();

		return view('user/term/advertising');
	}

		public function privacyUser(){
	 	$session = session();

		return view('user/privacy/privacy');
	}
	
	public function dashboardUser(){
		$session = session();
        $users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$data['session'] =$session;
		$post_vegan= new PostModel();
		$data['vaganpost'] =$post_vegan->getVeganPost($session->get('idUserH'));
		$data['session'] =$session;
		$events = new EventModel();
        $data['event_latest']=$events->getLatestEventByUser($session->get('idUserH'));
    $users = new UserModel();
		$data['users']=$users->getSingleUser($session->get('idUserH'));
		$data['loginusers']=$users->getSingleUser($session->get('idUserH'));
		$rm = new RecommendationModel();
		$data['recats']=$rm->getAllReRequestsByUser();
		$news= new NewsModel();
		$data['newsall']=$news->getAllPostByUser();
		$blog= new BlogModel();
		$data['blogall']=$blog->getAllPostByUser($session->get('idUserH'));
		$data['blogdashboard']=$blog->getAllPostfor_dasbord($session->get('idUserH'));
		
		return view('user/dashboard/dashboardUser',$data);
	}
	public function friendList(){
		$data=[];
		return view('user/friend/friendList',$data);
	}
	public function eventUser(){
		$session = session();
        $users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$data['session'] =$session;
		$events= new EventModel();
		$data['events']=$events->getAllEventByUser($session->get('idUserH'));
		$data['event_latest']=$events->getLatestEventByUser($session->get('idUserH'));
		$data['event_category']=$events->getAllEventCategories();
		$rm = new RecommendationModel();
		$data['recats']=$rm->getAllReRequestsByUser();
		$news= new NewsModel();
		$data['newsall']=$news->getAllPostByUser();
		$blog= new BlogModel();
		$data['blogall']=$blog->getAllPostByUser($session->get('idUserH'));
		return view('user/event/eventUser',$data);
	}
	public function eventByCategory($categoryId){
		$session = session();
        $users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$data['session'] =$session;
		$events= new EventModel();
		$data['events']=$events->getAllEventByCategory($session->get('idUserH'),$categoryId);
		
		$data['event_latest']=$events->getLatestEventByCategory($session->get('idUserH'),$categoryId);
		
		$data['event_category']=$events->getAllEventCategories();
		
		$rm = new RecommendationModel();
		$data['recats']=$rm->getAllReRequestsByUser();
		$news= new NewsModel();
		$data['newsall']=$news->getAllPostByUser();
		$blog= new BlogModel();
		$data['blogall']=$blog->getAllPostByUser($session->get('idUserH'));
		return view('user/event/eventUser',$data);
	}
	public function eventDetailsUser($id){
		$session = session();
        $users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$data['session'] =$session;
		$events= new EventModel();
		$data['event_details']=$events->getSingleEvent($id);
		$data['event_category']=$events->getAllEventCategories();
		$data['event_latest']=$events->getLatestEventByUser($session->get('idUserH'));
		$rm = new RecommendationModel();
		$data['recats']=$rm->getAllReRequestsByUser();
		$news= new NewsModel();
		$data['newsall']=$news->getAllPostByUser();
		$blog= new BlogModel();
		$data['blogall']=$blog->getAllPostByUser($session->get('idUserH'));
		return view('user/event/eventDetailsUser',$data);
	}
	public function addEvent(){
		$session = session();
		
		$users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$data['session'] =$session;
		
		$events = new EventModel();
		$data['event_cats']=$events->getAllEventCategories();
		$data['event_users']=$events->getAllUsers();
		$data['event_category']=$events->getAllEventCategories();
		$data['event_latest']=$events->getLatestEventByUser($session->get('idUserH'));
		$rm = new RecommendationModel();
		$data['recats']=$rm->getAllReRequestsByUser();
		$news= new NewsModel();
		$data['newsall']=$news->getAllPostByUser();
		$blog= new BlogModel();
		$data['blogall']=$blog->getAllPostByUser($session->get('idUserH'));
		return view('user/event/eventAdd',$data);
	}
	public function insertEvent(){
		
		$session = session();
		
		$post_image_db_data='';
		$post_image = $this->request->getFile('image');
		$post_image_name = $post_image->getName();
		if($post_image_name!=''){
			$post_image_name=time().$post_image_name;
			$post_image->move(ROOTPATH.'public/uploads/event/post/',$post_image_name);
			$post_image_db_data='public/uploads/event/post/'.$post_image_name;
		}
		/* $post_video_db_data='';
		$post_video = $this->request->getFile('video');
		$post_video_name = $post_video->getName();
		if($post_video_name!=''){
			$post_video_name=time().$post_video_name;
			$post_video->move(ROOTPATH.'public/uploads/event/post/',$post_video_name);
			$post_video_db_data='public/uploads/event/post/'.$post_video_name;
		} */
		$post_video_db_data=$this->request->getPost('video');
		$data=[
		'category'=>$this->request->getPost('category'),
		'name'=>$this->request->getPost('name'),
		'location'=>$this->request->getPost('location'),
		'posted_by'=>$session->get('idUserH'),
		'event_start_date'=>$this->request->getPost('event_start_date').' '.$this->request->getPost('event_start_time'),
		'event_end_date'=>$this->request->getPost('event_end_date').' '.$this->request->getPost('event_end_time'),
		'details'=>$this->request->getPost('details'),
		'image'=>$post_image_db_data,
		'video'=>$post_video_db_data,
	    
		]; 
		 $rm = new EventModel();
		 $result=$rm->insertEvent($data);
		 $session->setFlashdata('msgevent', 'Event Added Successfully');
		 if($result['status']==1){
		 return redirect()->to('user/event/add-event');
		 }else{
		  return redirect()->to('user/event/add-event');	 
		 }
	}


		public function getSingleEvent($id){
		$session = session();
		$going=1;
		$notgoing=0;
        $data['session'] =$session;
		$events= new EventModel();
		$data=$events->getSingleEvent($id);

		$da=$events->getEventCommentUser($id);
		$das=$events->getEventCommentdetail($id);
		$posted_by='';
		if(isset($data['user_name'])){
		if($data['user_name']!=''){
			$posted_by=$data['user_name'];
		}
		if($data['au_user_name']!=''){
			$posted_by='Admin';
		}	
		}
		
		$image=base_url().'/'.$data['image'];
		$event_name=$data['user_name'];
		$user_phone=$data['user_phone'];
		$user_email=$data['user_email'];
		$location=$data['location'];
		$event_start_date=date('M d,Y h:i a',strtotime($data['event_start_date']));
		$event_end_date=date('M d,Y h:i a',strtotime($data['event_end_date']));
		$details=$data['details'];
		$detail1=substr($data['details'],50,400);
		$detail2=substr($data['details'],400,1000);
		$video=$data['video'];
		$videos='';
		if($video!=''){
			$videos='<div class="video_blog"><iframe height="280" width="500"  
             src="'.$video.'" title="YouTube video player"></iframe></div>';
		}
		$html='
  <div class="modal fade add_custom_field_pop" id="add_custom_blog" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content modal-lg">
      <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLongTitle">Event <span>by '.$posted_by.'</span></h5> 
         
        <button type="button" onclick="hidepopup()" class="close-video" data-dismiss="modal" aria-label="Close"> </button>
      </div>
      <div class="modal-body">
        <div class="custom_fields_pop">
         <div class="blog_ppup">
                  <div class="blog_images"><img src="'.$image.'"></div>
                  <h2 class="hidding_one_middel">'.$event_name.'</h2>
                  <div class="blog_date">
              <ul>
                <li><a href="#">'.$event_start_date.'</a></li>
      
              </ul>
            </div>
            <p>'.$detail1.'</p>'.$videos.'

            <div class="tribe-events-single-section tribe-events-event-meta primary tribe-clearfix">
  <div class="tribe-events-meta-group tribe-events-meta-group-details">
    <h2 class="tribe-events-single-section-title"> Details </h2>
    <dl>
    <dt class="tribe-events-end-date-label"> Address: </dt>
      <dd> <abbr class="tribe-events-abbr tribe-events-end-date dtend" title="2022-01-04"> '.$location.' </abbr> </dd>
      <dt class="tribe-events-start-date-label"> Start: </dt>
       <dd> <abbr class="tribe-events-abbr tribe-events-start-date published dtstart" title="2021-12-15"> '.$event_start_date.'</abbr> </dd>
      <dt class="tribe-events-end-date-label"> End: </dt>
      <dd> <abbr class="tribe-events-abbr tribe-events-end-date dtend" title="2022-01-04"> '.$event_end_date.' </abbr> </dd>
      <dt class="tribe-events-event-categories-label">Event Category:</dt>
      <dd class="tribe-events-event-categories"><a href="#" rel="tag">Events</a></dd>
    </dl>
  </div>
  <div class="tribe-events-meta-group tribe-events-meta-group-organizer">
    <h2 class="tribe-events-single-section-title">Organizer</h2>
    <dl>
      <dt style="display:none;"></dt>
      <dd class="tribe-organizer"> '.$posted_by.'  </dd>
      <dt class="tribe-organizer-tel-label"> Phone: </dt>
      <dd class="tribe-organizer-tel"> '.$user_phone.'  </dd>
      <dt class="tribe-organizer-email-label"> Email: </dt>
      <dd class="tribe-organizer-email"> '.$user_email.'  </dd>
      <dt class="tribe-organizer-url-label"> Website: </dt>
      <dd class="tribe-organizer-url"> <a href="#" target="_blank" rel="external">www.hellovegans.com</a> </dd>
    </dl>
  </div>
</div>   
       <p>'.$detail2.'</p>';

       if($data['event_status']==0){
		
					$html.='    <div class="row">
         <div class="col-md-4 col-6">

         <form class="form-inline" role="form" method="post" id="Eventcommentform" name="eventcommentform">
         <div class="form-group">

         <input type="hidden" class="" id="commented_by" name="commented_by"  value="'.$session->get('idUserH').'" size="30" aria-required="true">
		<input type="hidden" class="" id="post_id" name="post_id"  value="'.$id.'" size="30" aria-required="true">

       <button class="post_comment btn btn-outline-primary btn-lg" id="going_'.$id.'" type="button" id="submitcomment"  onclick="submitEventGoing('.$id.','.$going.')">Going </button>
         <button class="post_comment btn btn-danger" style="display:none" type="button"  id="notGoing_'.$id.'"  onclick="submitEventGoing('.$id.','.$notgoing.')">Not Going </button>
       </div>
      </form>
        </div>

         <div class="col-md-4 col-6">

        <button class="post_comment btn btn-outline-primary btn-lg" type="button" id="submitcomment"  onclick="eventNotintersted('.$id.')">Not Interested</button>
        
         </div> 

        
     </div>



        </div>';
					 
					}else{

						$html.='    <div class="row">
         <div class="col-md-4 col-6">

         <form class="form-inline" role="form" method="post" id="eventcommentform" name="eventcommentform">
         <div class="form-group">

         <input type="hidden" class="" id="commented_by" name="commented_by"  value="'.$session->get('idUserH').'" size="30" aria-required="true">
		<input type="hidden" class="" id="post_id" name="post_id"  value="'.$id.'" size="30" aria-required="true">

       <button class="post_comment btn btn-outline-primary btn-lg"  id="going_'.$id.'"  style="display:none"  type="button" id="submitcomment"  onclick="submitEventGoing('.$id.','.$going.')"> Going </button>
       <button class="post_comment btn btn-danger" type="button"  id="notGoing_'.$id.'"  onclick="submitEventGoing('.$id.','.$notgoing.')">Not Going </button>
       </div>
      </form>
        </div>

         <div class="col-md-4 col-6">

        <button class="post_comment btn btn-outline-primary btn-lg" type="button" id="submitcomment"  onclick="eventNotintersted('.$id.')">Not Interested</button>
        
         </div> 

        
     </div>



        </div>';

					} 


		
		$html.='
		<div class="blog_comment">
		<div class="detailBox">
					 <div class="titleBox">
                        <label>Comment </label>';
		
		if(count($da)!=0){
			
			if(count($das)>2){
			$commentscount=count($das)-count($da);
			$html.='<button id="viewold" onclick="showoldercomments('.$id.')" class="viewoldcommetns">View Old '.$commentscount.' Commetns</button>';
			}
		}	
			$html.='</div>
			     <div class="actionBox">
                    <ul class="commentList">';
		if(count($da)!=0){			
			foreach($da as $datas){
			
			$commented_by='Admin';
			$userimage=base_url().'/'.'public/frontend/images/logo.png';
		      if($datas['users_name']!=''){
			    $commented_by=$datas['users_name'];
			    $userimage=base_url().'/'.$datas['users_profile_image'];
		      }
		$html.='<li>
          <div class="commenterImage"> <img src="'.$userimage.'" /> </div>
          <div class="commentText">
            <h2>'.$commented_by.'</h2>
            <p class="">'.$datas['message'].'</p>
            <span class="date sub-text">on '.date('M d, Y',strtotime($datas['created_at'])).'</span> </div>
        </li>';
			
			}
		}
	   $html.='</ul>';
     
        $html.='
           
		    <form class="form-inline" role="form" method="post" id="blogcommentform" name="blogcommentform">
        <div class="form-group">
          <h2>LEAVE A REPLY </h2>
          <textarea id="messagecomments" name="message"  class="form-control comment_here" rows="5" cols="3" placeholder="Enter your comment here..."></textarea>
        </div>
        <div class="form-group">
		<input type="hidden" class="" id="commented_by" name="commented_by"  value="'.$session->get('idUserH').'" size="30" aria-required="true">
		<input type="hidden" class="" id="post_id" name="post_id"  value="'.$id.'" size="30" aria-required="true">
          <button class="post_comment" type="button" id="submitcomment"  onclick="submitEventcomments()">Post Comment</button>
        </div>
      </form>';



     	$html.='

 


      

       </div>
      </div>
    </div>
  </div></div>';


echo $html;
	}

	public function insertPostCommentUser(){
		$id=$this->request->getPost('post_id');
		$data=[
		'post_id'=>$this->request->getPost('post_id'),
		'commented_by'=>$this->request->getPost('commented_by'),
		'message'=>$this->request->getPost('message'),
		'created_at'=>date('Y-m-d H:i:s'),
		'status'=>1
		]; 
		 $blog = new BlogModel();
		 $id=$blog->insertPostComment($data);
		 $data=$blog->getPostCommentByid($id);
		
		 if($data['users_name']==''){
			$commented_by='Admin';
			$userimage=base_url().'/'.'public/frontend/images/logo.png';
		}else{
			$commented_by=$data['users_name'];
			$userimage=base_url().'/'.$data['users_profile_image'];
		}
		 //$data=$blogs->getSingleblogs($id);
		$html='<li><span><img src="'.$userimage.'"></span><p>'.$data['message'].'</p> <div class="time_commnet">'.date('H:i',strtotime($data['created_at'])).'</div></li>';
		  
	
		 echo $html;
		die;
	}
	


	public function insertEventCommentUser(){
		$id=$this->request->getPost('post_id');
		$data=[
		'event_id'=>$this->request->getPost('post_id'),
		'comment_by'=>$this->request->getPost('commented_by'),
		'message'=>$this->request->getPost('message'),
		'created_at'=>date('Y-m-d H:i:s'),
		'status'=>1
		]; 
		 $event = new EventModel();
		 $id=$event->insertEventComment($data);
		 $data=$event->getEventCommentByid($id);
		
		 if($data['users_name']==''){
			$commented_by='Admin';
			$userimage=base_url().'/'.'public/frontend/images/logo.png';
		}else{
			$commented_by=$data['users_name'];
			$userimage=base_url().'/'.$data['users_profile_image'];
		}
		 //$data=$blogs->getSingleblogs($id);
		 $html='<li>
          <div class="commenterImage"> <img src="'.$userimage.'" /> </div>
          <div class="commentText">
            <h2>'.$commented_by.'</h2>
            <p class="">'.$data['message'].'</p>
            <span class="date sub-text">on '.date('M d, Y',strtotime($data['created_at'])).'</span> </div>
        </li>';
		
	
		 echo $html;
		die;
	}



	public function insertEventGoing(){
		$session = session();
		$id=$this->request->getPost('event_id');
		$data=[
		'event_id'=>$this->request->getPost('event_id'),
		'user_id'=>$session->get('idUserH'),
		'created_at'=>date('Y-m-d H:i:s'),
		'status'=>$this->request->getPost('status')
		]; 
		 $post = new EventModel();
		 $post->insertEventGoing($data);
		 if($this->request->getPost('status')==0){
		echo "Going";	 
		 }else{
		echo "not Going";	 
		 }
		 
		die;
	}


	public function insertNotIntersted(){
		$session = session();
		    $users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$data['session'] =$session;
		$events= new EventModel();
		$data['events']=$events->getAllEventByUser($session->get('idUserH'));
		$data['event_latest']=$events->getLatestEventByUser($session->get('idUserH'));
		$data['event_category']=$events->getAllEventCategories();
		$data['event_attendent']=$events->getAllEventAttendent();

		$users = new UserModel();
		$data['users']=$users->getSingleUser($session->get('idUserH'));
		$data['loginusers']=$users->getSingleUser($session->get('idUserH'));
		$rm = new RecommendationModel();
		$data['recats']=$rm->getAllReRequestsByUser();
		$news= new NewsModel();
		$data['newsall']=$news->getAllPostByUser();
		$blog= new BlogModel();
		$data['blogall']=$blog->getAllPostByUser($session->get('idUserH'));
		$data['public_url']=base_url()."/public/frontend/";
		$data['baseurl']=base_url()."/";




		$id=$this->request->getPost('event_id');
		$data=[
		'event_id'=>$this->request->getPost('event_id'),
		'user_id'=>$session->get('idUserH'),
		'created_at'=>date('Y-m-d H:i:s'),
		'status'=>1
		]; 
		 $post = new EventModel();
		 $result= $post->insertNotinterstedEvent($data);
       // if($result['status']==1){
       // 	return view('user/event/eventUser',$data);
       // }
       die;

		 //return view('user/event/eventUser',$data);
	}


	// public function insertEventGoing(){
	// 	$id=$this->request->getPost('post_id');
	// 	$data=[
	// 	'event_id'=>$this->request->getPost('post_id'),
	// 	'user_id'=>$this->request->getPost('commented_by'),
	// 	'created_at'=>date('Y-m-d H:i:s'),
	// 	'status'=>1
	// 	]; 
	// 	 $event = new EventModel();
	// 	 $result=$event->insertEventGoingUser($data);
	// 	 return $result;
		 
	// 	die;
	// }

	public function EventGoingUpdate(){
		$event_id=$this->request->getPost('post_id');
		$user_id=$this->request->getPost('commented_by');
		 $event = new EventModel();
		 $result=$event->updateEventGoingStatus($user_id,$event_id);
		 return $result;
		 
		die;
	}



		public function getSinglePost($id){
		$session = session();
        $data['session'] =$session;
		$post= new PostModel();
		$data=$post->getSinglepostById($id);
		
    $posted_by='';
		if(isset($data['user_name'])){
		if($data['user_name']!=''){
			$posted_by=$data['user_name'];
		}
		else if($data['admin_id'] ==0 ){
			$posted_by='Admin';
		}	
		}else if(isset($data['au_user_name'])){

				$posted_by='Admin';

		}


		$image=base_url().'/'.$data['image'];
		$post_name=$data['title'];
		$event_start_date=date('M d,Y h:i a',strtotime($data['updated_at']));
		// $event_end_date=date('M d,Y h:i a',strtotime($data['event_end_date']));
		$details=$data['content'];
		// $video=$data['video'];
		// $videos='';
		// if($video!=''){
		// 	$videos='<div class="video_blog"><iframe height="280" width="500"  
  //            src="'.$video.'" title="YouTube video player"></iframe></div>';
		// }
		$html='
  <div class="modal fade add_custom_field_pop" id="add_custom_blog" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content modal-lg">
      <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLongTitle">Post<span>by '.$posted_by.'</span></h5> 
         
        <button type="button" onclick="hidepopup()" class="close-video" data-dismiss="modal" aria-label="Close"> </button>
      </div>
      <div class="modal-body">
        <div class="custom_fields_pop">
         <div class="blog_ppup">
                  <div class="blog_images"><img src="'.$image.'"></div>
                  <h2 class="hidding_one_middel">'.$post_name.'</h2>
                  <div class="blog_date">
              <ul>
                <li><a href="#">'.$event_start_date.'</a></li>
                
                <li> Blog</li>
              </ul>
            </div>
            <p>'.$details.'</p>
        </div>
       </div>
      </div>
    </div>
  </div></div>';
echo $html;
	}

	public function getSinglecook($id){
		$session = session();
        $data['session'] =$session;
		$cook= new CooksModel();
		$data=$cook->getSinglecooks_detail($id);
		
    $name='';
		if(isset($data['name'])){
		if($data['name']!=''){
			$name=$data['name'];
		}
		
		}

		$image=base_url().'/'.$data['image'];
		// $blogs_name=$data['title'];
		$event_start_date=date('M d,Y h:i a',strtotime($data['updated_at']));
		// $event_end_date=date('M d,Y h:i a',strtotime($data['event_end_date']));
		$details=$data['content'];
		// $video=$data['video'];
		// $videos='';
		// if($video!=''){
		// 	$videos='<div class="video_blog"><iframe height="280" width="500"  
  //            src="'.$video.'" title="YouTube video player"></iframe></div>';
		// }
		$html='


<div class="modal fade add_recommendation_pop" id="add_cook_profile" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content modal-lg">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Cook Profile </h5>
        <button type="button" class="close-video" data-dismiss="modal" aria-label="Close"> </button>
      </div>
      <div class="modal-body">
        <div class="page-wrapper ">
          <div class="bgcolor_profile">
            <div class="cover_images panel"> <img src="'.$image.'">
              <div class="profile-header profile_usermian">
                <div class=" panel-xl">
                  <div class="row">
                    <div class="col-md-9 col-12 col-sm-12">
                      <div class="profile-header-main">
                        <div class="avatar avatar-normal has-aura text-center"><img class="avatar img-responsive" alt="admin_profile" src="'.$image.'"></div>
                        <div class="profile-contact">
                          <div class="profile-main-top">
                            <h1 class="name">'.$name.'</h1>
                          </div>
                          <div class="speciality">Jaipur, Rajasthan, India </div>
                          <div class="speciality">johnquil@gmail.com, (+91) 0000-000-000</div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="profile-button-actions my-15"> <a class="btn-floating" href="#">
                        <div class="after-span ripple"></div>
                        <span> </span> Connect </a></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="profile_middel">
          <div class="row">
            <div class="col-md-12">
              <div class="right_side">
                <div class="post_rightside">
                  <div class="one_bx ">
                    <div class="topbar_post ">
                      <div class="topbar_icon"><img src="'.$image.'"></div>
                      <h2>'.$name.'</h2>
                      <p>10 Aug 2022, 20 Aug</p>
                    </div>
                    <p class="post_one_pdding">Lorem Ipsum is simply dummy text of the printing and type setting 
                      industry. LoremIpsum has been the industrys standard  dummy text 
                      ever since the 1500s, when an unknown </p>
                    <div class="post_images "> <img src="images/post_img.jpg"> </div>
                    <div class="like_comments post_one_pdding">
                      <p class="like_comments_f"><a href="#">20 <i class="fa fa-thumbs-o-up" aria-hidden="true"></i> </a></p>
                      <p class="like_comments_se"><a href="#">10 <i class="fa fa-comment-o" aria-hidden="true"></i> </a></p>
                    </div>
                    <div class="comment_post">
                      <div class="commentcomment_post ">
                        <div class="comment_icon"><img src="images/user_topbar.jpg"></div>
                        <h2>Raushel </h2>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                          Lorem Ipsum has been the industrys standard dummy text ever since the </p>
                      </div>
                    </div>
                    <div class="comments_form post_one_pdding">
                      <input class="effect-1" type="text" placeholder="Write here. . . . . .">
                      <!--<span class="focus-border"><i class="fa fa-send-o" aria-hidden="true"></i> </span> --></div>
                  </div>
                  <div class="one_bx ">
                    <div class="topbar_post ">
                      <div class="topbar_icon"><img src="images/user_topbar.jpg"></div>
                      <h2>John Quil</h2>
                      <p>10 Aug 2022, 20 Aug</p>
                    </div>
                    <p class="post_one_pdding">Lorem Ipsum is simply dummy text of the printing and type setting 
                      industry. LoremIpsum has been the industrys standard  dummy text 
                      ever since the 1500s, when an unknown </p>
                    <div class="post_images "> <img src="images/post_img2.jpg"> </div>
                    <div class="like_comments post_one_pdding">
                      <p class="like_comments_f"><a href="#">20 <i class="fa fa-thumbs-o-up" aria-hidden="true"></i> </a></p>
                      <p class="like_comments_se"><a href="#">10 <i class="fa fa-comment-o" aria-hidden="true"></i> </a></p>
                    </div>
                    <div class="comment_post">
                      <div class="commentcomment_post ">
                        <div class="comment_icon"><img src="images/user_topbar.jpg"></div>
                        <h2>Raushel </h2>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                          Lorem Ipsum has been the industrys standard dummy text ever since the </p>
                      </div>
                    </div>
                    <div class="comments_form post_one_pdding">
                      <input class="effect-1" type="text" placeholder="Write here. . . . . .">
                      <!--<span class="focus-border"><i class="fa fa-send-o" aria-hidden="true"></i> </span> --></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>';
echo $html;
	}



public function getSingleProduct($id){
		$session = session();
        $data['session'] =$session;
		$pro= new ProductModel();
		$data=$pro->getSingleProduct_detail($id);
		
    $name='';
		if(isset($data['title'])){
		if($data['title']!=''){
			$name=$data['title'];
		}
		
		}

		$image=base_url().'/'.$data['image'];
		// $blogs_name=$data['title'];
		$event_start_date=date('M d,Y h:i a',strtotime($data['updated_at']));
		// $event_end_date=date('M d,Y h:i a',strtotime($data['event_end_date']));
		$details=$data['content'];
		// $video=$data['video'];
		// $videos='';
		// if($video!=''){
		// 	$videos='<div class="video_blog"><iframe height="280" width="500"  
  //            src="'.$video.'" title="YouTube video player"></iframe></div>';
		// }
		$html='
  <div class="modal fade add_custom_field_pop" id="add_custom_blog" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content modal-lg">
      <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLongTitle">Product Name<span>   '.$name.'</span></h5> 
         
        <button type="button" onclick="hidepopup()" class="close-video" data-dismiss="modal" aria-label="Close"> </button>
      </div>
      <div class="modal-body">
        <div class="custom_fields_pop">
         <div class="blog_ppup">
                  <div class="blog_images"><img src="'.$image.'"></div>
                  <h2 class="hidding_one_middel">'.$name.'</h2>
                  <div class="blog_date">
              <ul>
                <li><a href="#">'.$event_start_date.'</a></li>
                
                <li> Blog</li>
              </ul>
            </div>
            <p>'.$details.'</p>
         </div>
        </div>
       </div>
     </div>
   </div>
  </div>';
echo $html;
	}


	






public function getSingleblog($id){
		$session = session();
        $data['session'] =$session;
		$blogs= new BlogModel();
		$data=$blogs->getSingleblogs($id);
		$public_url=base_url()."/public/frontend/";
        $baseurl=base_url()."/";

		if($data['posted_by']==0){
			$posted_by='Admin';
		}else{
			$posted_by=$data['user_name'];
		}
		
		$blogs_name=$data['title'];
		$createddate=date('M d,Y h:i a',strtotime($data['created_at']));
		$details=$data['content'];
		$detail1=substr($data['content'],50,200);
		$detail2=substr($data['content'],200,400);
		$detail3=substr($data['content'],400,600);
		$detail4=substr($data['content'],600,800);
		$detail5=substr($data['content'],800,1200);
		 $curr_time =$data['created_at'];

		if($data['galleryimage']!=''){
		$ex=explode(",",$data['galleryimage']);
         if(isset($ex[0])){
			$image_galary1=base_url().'/'.$ex[0]; 
		 }
		}
		
		$html='
		<div class="modal fade add_custom_field_pop" id="add_custom_blog" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered" role="document">
		  <div class="modal-content modal-lg">
             <div class="modal-header">
			     <header class="common-post-header u-flex"> <img src="'.$baseurl.$data['user_profile'].'" class="user-image" alt="" width="40" height="40">
  <div class="common-post-info">
    <div class="user-and-group u-flex "> <a href="/user/public_profile/26">'.$posted_by.' </a> </div>
    <div class="username_time"> <a href="#"> '.$curr_time.' </a> </div>
  </div>
</header>
				<button type="button" class="close-video" data-dismiss="modal" aria-label="Close"> </button>
			  </div>
			  <div class="modal-body">
			    <div class="custom_fields_pop">
			     <div class="blog_ppup">
                   <div class="blog_images">
				   <h2 class="hidding_one_middel">'.$blogs_name.'</h2>
					<div class="blog_date">
					<ul>
					 
					</ul>
					<p>'.$detail1.'</p>
				   ';
		            if($data['image']!=''){
					$image=base_url().'/'.$data['image'];
					$html.='<img src="'.$image.'">';
					}
		            $html.='</div>
					
					</div>
					
					<div class="blog_text">
					  <div class="row">
					    <div class="col-md-12">
						  <p>'.$detail2.'</p>
						</div>
						<div class="col-md-8">
						<p>'.$detail3.' </p>
						</div>
						<div class="col-md-4">
						<div class="blog_images">';
						if($data['galleryimage']!=''){
						$ex=explode(",",$data['galleryimage']);
						$image=base_url().'/'.$ex[0];	
						$html.='<img height="150" src="'.$image.'">';	
						}
						$html.='</div>
					  </div>
					</div>
					</div>';
					
					if($data['video']!=''){
					$videos=base_url().'/'.$data['video'];
					$html.='<div class="embed-responsive embed-responsive-16by9 col-xs-4 text-center">';
					  $html.='<video src="'.$videos.'" controls></video>';
					  $html.='</div>';
					}  
					$html.='<p>'.$detail4.'</p>';
			if($data['galleryimage']!=''){
			   $ex=explode(",",$data['galleryimage']);
				if(isset($ex[0])){
				  $image_galary1=base_url().'/'.$ex[0];
					$html.='<section class="slider-section">
					        <div id="owl-demo" class="owl-carousel  owl-theme">';
								foreach($ex as $val){
								  $image_galarys=base_url().'/'.$val;
								  $html.='<div class="item col-md-14"><img width="150" height="200" src="'.$image_galarys.'"></div>';
								}
					$html.='</div></div>';			
				}
			}
		$html.='<p>'.$detail5.'</p>';
		$html.='</div>';
		
		$da=$blogs->getPostCommentUser($id);
		$das=$blogs->getPostComment($id);
		$html.='
		<div class="blog_comment">
		<div class="detailBox">
					 <div class="titleBox">
                        <label>Comments </label>';
		
		if(count($da)!=0){
			
			if(count($das)>2){
			$commentscount=count($das)-count($da);
			$html.='<button id="viewold" onclick="showoldercomments('.$id.')" class="viewoldcommetns">View Old '.$commentscount.' Commetns</button>';
			}
		}	
			$html.='</div>
			     <div class="actionBox">
                    <ul class="commentList">';
		if(count($da)!=0){			
			foreach($da as $datas){
			
			$commented_by='Admin';
			$userimage=base_url().'/'.'public/frontend/images/logo.png';
		      if($datas['users_name']!=''){
			    $commented_by=$datas['users_name'];
			    $userimage=base_url().'/'.$datas['users_profile_image'];
		      }
		$html.='<li>
          <div class="commenterImage"> <img src="'.$userimage.'" /> </div>
          <div class="commentText">
            <h2>'.$commented_by.'</h2>
            <p class="">'.$datas['message'].'</p>
            <span class="date sub-text">on '.date('M d, Y',strtotime($datas['created_at'])).'</span> </div>
        </li>';
			
			}
		}
	   $html.='</ul>';
     
        $html.='
           
		    <form class="form-inline" role="form" method="post" id="blogcommentform" name="blogcommentform">
        <div class="form-group">
          <h2>LEAVE A REPLY </h2>
          <textarea id="messagecomments" name="message"  class="form-control comment_here" rows="5" cols="3" placeholder="Enter your comment here..."></textarea>
        </div>
        <div class="form-group">
		<input type="hidden" class="" id="commented_by" name="commented_by"  value="'.$session->get('idUserH').'" size="30" aria-required="true">
		<input type="hidden" class="" id="post_id" name="post_id"  value="'.$id.'" size="30" aria-required="true">
          <button class="post_comment" type="button" id="submitcomment"  onclick="submitblogcomments()">Post Comment</button>
        </div>
      </form>
		   
    </div>
  </div>
</div>';
echo $html;
	}


	public function getSingleRestaurant($id){
		$session = session();
        $data['session'] =$session;
		 

     $rest= new RestaurantsModel();
		$data=$rest->getSingleRest_detail($id);


    $name='';
		if(isset($data['name'])){
		if($data['name']!=''){
			$name=$data['name'];
		}
		
		}


		$image=base_url().'/'.$data['image'];
		$event_start_date=date('M d,Y h:i a',strtotime($data['updated_at']));
		// $event_end_date=date('M d,Y h:i a',strtotime($data['event_end_date']));
		$details=$data['detail'];
		// $video=$data['video'];
		// $videos='';
		// if($video!=''){
		// 	$videos='<div class="video_blog"><iframe height="280" width="500"  
  //            src="'.$video.'" title="YouTube video player"></iframe></div>';
		// }
		$html='
  <div class="modal fade add_custom_field_pop" id="add_custom_blog" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content modal-lg">
      <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLongTitle">Restaurants Name<span>   '.$name.'</span></h5> 
         
        <button type="button" onclick="hidepopup()" class="close-video" data-dismiss="modal" aria-label="Close"> </button>
      </div>
      <div class="modal-body">
        <div class="custom_fields_pop">
         <div class="blog_ppup">
                  <div class="blog_images"><img src="'.$image.'"></div>
                  <h2 class="hidding_one_middel">'.$name.'</h2>
                  <div class="blog_date">
              <ul>
                <li><a href="#">'.$event_start_date.'</a></li>
                
                <li> Blog</li>
              </ul>
            </div>
            <p>'.$details.'</p>
        </div>
       </div>
      </div>
    </div>
  </div></div>';
echo $html;
	}



	public function getSingleReceipe($id){
		$session = session();
        $data['session'] =$session;
		$receipe= new ReceipeModel();
		$receipe=new ReceipeModel();
		$data=$receipe->getSingleReceipe($id);

		 $posted_by='';
		if(isset($data['user_name'])){
		if($data['user_name']!=''){
			$posted_by=$data['user_name'];
		}
		else if($data['posted_by'] ==0 ){
			$posted_by='Admin';
		}	
		}else if(isset($data['au_user_name'])){

				$posted_by='Admin';

		}
		
		$image=base_url().'/'.$data['image'];
		$event_name=$data['title'];
		$event_start_date=date('M d,Y h:i a',strtotime($data['updated_at']));
		// $event_end_date=date('M d,Y h:i a',strtotime($data['event_end_date']));
		$details=$data['content'];
			$video=$data['video'];
		// $video=$data['video'];
		// $videos='';
		// if($video!=''){
		// 	$videos='<div class="video_blog"><iframe height="280" width="500"  
  //            src="'.$video.'" title="YouTube video player"></iframe></div>';
		// }
		$html='

		  <div class="modal fade add_custom_field_pop" id="add_custom_blog" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content modal-lg">
      <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLongTitle">Recipes<span>by '.$posted_by.'</span></h5> 
         
        <button type="button" onclick="hidepopup()" class="close-video" data-dismiss="modal" aria-label="Close"> </button>
      </div>
      <div class="modal-body">
              <div class="restaurants_imag"><img src="'.$image.'"></div>
                    <div class="d_all">
          <div class="bg-white grey about_rel_info padding-b-0">
            <div class="align-v-center flex flex-between margin-b-15">
              <h2 class="font-20 bold grey">'.$event_name.'</h2>
              <div class="flex align-v-center">
                
                <div class="flex align-v-center padding-l-5"> <span class="grey-darker">'.$event_start_date.'</span> <span class="padding-l-5 padding-r-5"> | </span> <span class="text-blue pointer review_tab"></span> </div>
              </div>
            </div>
             
            <hr class="hr-grey-light margin-t-20">
          </div>
          
          <div class="direction">
            <h2>Video</h2>
              <div class="o-video">
                <iframe src="'.$video.'"  allowfullscreen></iframe>
             </div>
          </div>
          <div class="restaurant_fa">
            <div class="padding-b-30 ">
               
               <p>'.$details.'</p>
               

          </div>
           
        </div>
        
       
        
        
       
      </div>
    </div>
   </div>
  </div>

  ';
echo $html;
	}








	public function newsDetailsById($id){
		$session = session();
        $users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$data['session'] =$session;
			$users = new UserModel();
		$data['users']=$users->getSingleUser($session->get('idUserH'));
        $data['loginusers']=$users->getSingleUser($session->get('idUserH'));
			$rm = new RecommendationModel();
		$data['recats']=$rm->getAllReRequestsByUser();

		$news= new NewsModel();
		$data['news_details']=$news->getSinglebNewById($id);
		$news->updateCount($id);
		$data['news_category']=$news->getAllNewsCategory();
		$data['new_comment']=$news->getcommentByPostId($id);
     $data['news_latest']=$news->getLatestNewsByUser($session->get('idUserH'));
		return view('user/news/newsDetailsUser',$data);
	}


	public function insertNewsPostComment(){
		

		$id=$this->request->getPost('post_id');
		$data=[
		'post_id'=>$this->request->getPost('post_id'),
		//'post_id'=>$id,
		'admin_id'=>1,
		'user_id'=>$this->request->getPost('user_id'),
		'message'=>$this->request->getPost('message'),
		'created_at'=>date('Y-m-d H:i:s'),
		'status'=>1
		]; 
		 $news = new NewsModel();
		 $news->insertNewsComment($data);
		//  $data['news_details']=$news->getSinglebNewById($id);
		// $data['news_category']=$news->getAllNewsCategory();

		
		return redirect()->to('user/news/details/'.$id);
		
	}

	public function recipeUser(){

		$session = session();
        $users = new UserChatModel();
			$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$data['session'] =$session;
		$vegan= new PostModel();
		$data['vaganpost'] =$vegan->getVeganPost($session->get('idUserH'));
		$data['session'] =$session;
		$events = new EventModel();
        $data['event_latest']=$events->getLatestEventByUser($session->get('idUserH'));
		$rm = new RecommendationModel();
		$data['recats']=$rm->getAllReRequestsByUser();
		$news= new NewsModel();
		$data['newsall']=$news->getAllPostByUser();
    $users = new UserModel();
		$data['users']=$users->getSingleUser($session->get('idUserH'));
         $data['loginusers']=$users->getSingleUser($session->get('idUserH'));
		$receipe=new ReceipeModel();
		$data['receipe']=$receipe->getAllBlogReceipesByUser($session->get('idUserH'));
		$data['receipe_category']=$receipe->getAllReceipeCategory();

		return view('user/recipe/recipesUser',$data);
	}


	public function recipeByCategory($categoryId){
	$session = session();
       $users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$data['session'] =$session;
		$events = new EventModel();
        $data['event_latest']=$events->getLatestEventByUser($session->get('idUserH'));
		$rm = new RecommendationModel();
		$data['recats']=$rm->getAllReRequestsByUser();
		
		$blog= new BlogModel();
		$data['blogall']=$blog->getAllPostByUser($session->get('idUserH'));

		 $users = new UserModel();
		$data['users']=$users->getSingleUser($session->get('idUserH'));
        $data['loginusers']=$users->getSingleUser($session->get('idUserH'));
		$receipe=new ReceipeModel();
		$data['receipe_category']=$receipe->getAllReceipeCategory();
		
		$data['receipe']=$receipe->getAllReceipeByCategory($session->get('idUserH'),$categoryId);

	return view('user/recipe/recipesUser',$data);
	}




	
	public function newsUser(){
		$session = session();
        $users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$data['session'] =$session;
		$events = new EventModel();
        $data['event_latest']=$events->getLatestEventByUser($session->get('idUserH'));
		$rm = new RecommendationModel();
		$data['recats']=$rm->getAllReRequestsByUser();
		$users = new UserModel();
		$data['users']=$users->getSingleUser($session->get('idUserH'));
		$data['loginusers']=$users->getSingleUser($session->get('idUserH'));
		$news= new NewsModel();
		$data['newsall']=$news->getAllPostByUser();
		$blog= new BlogModel();
		$data['blogall']=$blog->getAllPostByUser($session->get('idUserH'));

		$news= new NewsModel();
		$data['news']=$news->getAllNewstByUser($session->get('idUserH'));
		$data['news_latest']=$news->getLatestNewsByUser($session->get('idUserH'));
		$data['news_category']=$news->getAllNewsCategory();
		$data['news_traval_guide']=$news->getnews_of_traval_guide($session->get('idUserH'));
		$data['news_gadgets_guide']=$news->getnews_of_gadgets_guide($session->get('idUserH'));
		$data['getlatestGadgatnews']=$news->getlatestGadgatnews();


		return view('user/news/newsUser',$data);
	}

	public function newsByCategory($categoryId){
	$session = session();
        $users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$data['session'] =$session;
		$users = new UserModel();
		$data['users']=$users->getSingleUser($session->get('idUserH'));
		$data['loginusers']=$users->getSingleUser($session->get('idUserH'));
		$events = new EventModel();
        $data['event_latest']=$events->getLatestEventByUser($session->get('idUserH'));
		$rm = new RecommendationModel();
		$data['recats']=$rm->getAllReRequestsByUser();
		
		$blog= new BlogModel();
		$data['blogall']=$blog->getAllPostByUser($session->get('idUserH'));

		$news= new NewsModel();
		
		$data['news_latest']=$news->getLatestNewsByCategory($session->get('idUserH'),$categoryId);
		$data['news_category']=$news->getAllNewsCategory();
		$data['news']=$news->getAllNewsByCategory($session->get('idUserH'),$categoryId);

	return view('user/news/newCategory',$data);
	}


	public function blogUser(){
		$session = session();
        $users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$data['session'] =$session;
		$posts = new BlogModel();
		$data['posts']=$posts->getAllPost();
		$events = new EventModel();
        $data['event_latest']=$events->getLatestEventByUser($session->get('idUserH'));
		$rm = new RecommendationModel();
		$data['recats']=$rm->getAllReRequestsByUser();
		$news= new NewsModel();
		$data['newsall']=$news->getAllPostByUser();

		$blog= new BlogModel();
		$data['blogall']=$blog->getAllPostByUser($session->get('idUserH'));
		$data['latest_blog']=$blog->getLatestBlogByUser($session->get('idUserH'));
		$data['blog_category']=$blog->getAllPostCategory();

		$receipe=new ReceipeModel();
		$data['blogRECIPES']=$receipe->getAllBlogReceipes_blog($session->get('idUserH'));
		return view('user/blog/blogUser',$data);
	}
	public function loginUser(){
		return view('user/login/loginUser');
	}

	public function blogByCategory($categoryId){
		$session = session();
        $users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$data['session'] =$session;
		$events= new EventModel();
		$data['events']=$events->getAllEventByCategory($session->get('idUserH'),$categoryId);
		
		$data['event_latest']=$events->getLatestEventByCategory($session->get('idUserH'),$categoryId);
		
		$data['event_category']=$events->getAllEventCategories();
		
		$rm = new RecommendationModel();
		$data['recats']=$rm->getAllReRequestsByUser();
		$news= new NewsModel();
		$data['newsall']=$news->getAllPostByUser();

		$blog= new BlogModel();
	  $data['blogall']=$blog->getAllBlogByCategory($session->get('idUserH'),$categoryId);
		$data['latest_blog']=$blog->getLatestBlogByCategory($session->get('idUserH'),$categoryId);
		$data['blog_category']=$blog->getAllPostCategory();

		return view('user/blog/blogCategory_detail',$data);
	}

	public function blogDetailsUser($id){
		$session = session();
        $users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$data['session'] =$session;
		$events= new EventModel();
		$data['event_details']=$events->getSingleEvent($id);
		$data['event_category']=$events->getAllEventCategories();
		$data['event_latest']=$events->getLatestEventByUser($session->get('idUserH'));
		$rm = new RecommendationModel();
		$data['recats']=$rm->getAllReRequestsByUser();
		$news= new NewsModel();
		$data['newsall']=$news->getAllPostByUser();
		$blog= new BlogModel();
		$data['blogall']=$blog->getAllPostByUser($session->get('idUserH'));
		$data['blog_details']=$blog->getSingleblogs($id);
			$data['latest_blog']=$blog->getLatestBlogByUser($session->get('idUserH'));
		$data['blog_category']=$blog->getAllPostCategory();
		
		return view('user/blog/blogDetailsUser',$data);
	}

	
	
	public function registerUser(){
		$users = new UserModel();
		$data['country'] =$users->getAllCountry();
		return view('user/register/registerUser',$data);
	}
	public function accountVerification(){
		$session = session();
		$users = new UserModel();
		$query=$users->where('verificationCode', $_GET['code'])->set('status', '1')->update();

		$session->setFlashdata('msg', 'Your verification process has been completed');
		return redirect()->to('user/login');
	}
	public function forgotPassword(){
		return view('user/register/forgotPasswordUser');
	}
	public function resendmail(){
		return view('user/register/resendmailUser');
	}
	public function resetPassword(){
		return view('user/register/resetPasswordUser');
	}
	public function resetForgotPassword(){
	  $session = session();
		$users = new UserModel();
	  $code=$this->request->getPost('code');
	  $query=$users->where('verificationCode',$code)->set('password',password_hash($this->request->getPost('password'), PASSWORD_BCRYPT))->update();
     $session->setFlashdata('msg', 'Password has been reset successfully.');
	 return redirect()->to('/user/login');	  
	}
	public function sendForgotPasswordLink(){
		//send email
        $session = session();
		$users = new UserModel();
		$emailId=$this->request->getPost('email');
		$data=$users->getSingleUserByEmail($emailId);
		$send=0;
		$vcode=0;
		if($data['vc']==0){
		$session->setFlashdata('msg', 'This Email id is Not exists Please try another email ');	
		}else{
			if($data['verificationCode']==''){
			  $data['verificationCode']=time().rand(10,100);
			  $query=$users->where('email',$emailId)->set('verificationCode',$data['verificationCode'])->update();	
			}
			$send=1;
			$vcode=$data['verificationCode'];
		}
		if($send==1){
		$email = \Config\Services::email();
        $to=$this->request->getPost('email');
		$link="/user/reset-password?code=".$vcode;
        $email->setTo($to);
        $email->setFrom('info@projectstatus.co.in', 'Reset Password');
        $subject="Reset Password Link from hello vegans";
        $message='<table border="0" align="center" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;border:1px solid #FFA73B">
		          <tr>
				     <td bgcolor="#ffffff" align="center" valign="top" style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family:normal normal 600 40px/40px Open Sans; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;">
					    <h1 style="font-size: 48px; font-weight: 400; margin: 2;">Welcome!</h1> 
						<img src="/public/hello_vegans/commingsoon/images/logo.png" width="125" height="120" style="display: block; border: 0px;border: 0;height: auto;line-height: 100%;outline: none;text-decoration: none;" />
					</td>
				  </tr>
				  <tr>
				    <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 40px 30px; color: #666666; font-family: normal normal 600 40px/40px Open Sans; font-size: 18px; font-weight: 400; line-height: 25px;">
				    <p style="margin: 0;">To reset  your  Password. Just press the button below.</p>
				    </td>
				  </tr>
				  <tr>
				    <td bgcolor="#ffffff" align="left">
                     <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
						 <td bgcolor="#ffffff" align="center" style="padding: 20px 30px 60px 30px;">
						   <table border="0" cellspacing="0" cellpadding="0">
                              <tr>
							    <td align="center" style="border-radius: 3px;" bgcolor="#FFA73B"><a href="'.$link.'" target="_blank" style="font-size: 20px; font-family: normal normal 600 40px/40px Open Sans; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; padding: 15px 25px; border-radius: 2px; border: 1px solid #FFA73B; display: inline-block;">Reset Password</a>
								</td>   
							   </tr>
							</table>
						   </td>
						  </tr>
					   </table>
					</td>
				  </tr>
				  <tr>
					<td bgcolor="#ffffff" align="left" style="padding: 0px 30px 0px 30px; color: #666666; font-family:normal normal 600 40px/40px Open Sans; font-size: 18px; font-weight: 400; line-height: 25px;">
                      <p style="margin: 0;">If that does not work, copy and paste the following link in your browser:</p>
					</td>
				   </tr>
				  <tr>
				   <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 20px 30px; color: #666666; font-family:normal normal 600 40px/40px Open Sans, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
				    <p style="margin: 0;">
					 <a href="#" target="_blank" style="color: #FFA73B;">'.$link.'</a>
					</p>
				   </td>
				  </tr>
				</table>';
        $email->setSubject($subject);
        $email->setMessage($message);

        if ($email->send()) 
		{
            $session->setFlashdata('msg', 'A reset password link has been sent to your email account');
        } 
		else 
		{
           $session->setFlashdata('msg', 'A reset password link has been sent to your email account');
		   // $data = $email->printDebugger(['headers']);
           // print_r($data);
        }	
		}
		return redirect()->to('user/forgot-password');
	}
	public function resendVerification(){
		//send email
        $session = session();
		$users = new UserModel();
		$emailId=$this->request->getPost('email');
		$data=$users->getSingleUserByEmail($emailId);
		$send=0;
		$vcode=0;
		if($data['vc']==0){
		$session->setFlashdata('msg', 'This Email id is Not exists Please try another email ');	
		}else{
			if($data['verificationCode']==''){
			  $data['verificationCode']=time().rand(10,100);
			  $query=$users->where('email',$emailId)->set('verificationCode',$data['verificationCode'])->update();	
			}
			$send=1;
			$vcode=$data['verificationCode'];
		}
		if($send==1){
		$email = \Config\Services::email();
        $to=$this->request->getPost('email');
		$link="https://vegan.sidhauli.co.in/user/accountVerification?code=".$vcode;
        $email->setTo($to);
        $email->setFrom('info@projectstatus.co.in', 'Confirm Registration');
        $subject="Account Verification from hello vegans";
        $message='<table border="0" align="center" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;border:1px solid #FFA73B">
		          <tr>
				     <td bgcolor="#ffffff" align="center" valign="top" style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family:normal normal 600 40px/40px Open Sans; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;">
					    <h1 style="font-size: 48px; font-weight: 400; margin: 2;">Welcome!</h1> 
						<img src="https://vegan.sidhauli.co.in/public/hello_vegans/commingsoon/images/logo.png" width="125" height="120" style="display: block; border: 0px;border: 0;height: auto;line-height: 100%;outline: none;text-decoration: none;" />
					</td>
				  </tr>
				  <tr>
				    <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 40px 30px; color: #666666; font-family: normal normal 600 40px/40px Open Sans; font-size: 18px; font-weight: 400; line-height: 25px;">
				    <p style="margin: 0;">We are excited to have you get started. First, you need to confirm your account. Just press the button below.</p>
				    </td>
				  </tr>
				  <tr>
				    <td bgcolor="#ffffff" align="left">
                     <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
						 <td bgcolor="#ffffff" align="center" style="padding: 20px 30px 60px 30px;">
						   <table border="0" cellspacing="0" cellpadding="0">
                              <tr>
							    <td align="center" style="border-radius: 3px;" bgcolor="#FFA73B"><a href="'.$link.'" target="_blank" style="font-size: 20px; font-family: normal normal 600 40px/40px Open Sans; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; padding: 15px 25px; border-radius: 2px; border: 1px solid #FFA73B; display: inline-block;">Confirm Account</a>
								</td>   
							   </tr>
							</table>
						   </td>
						  </tr>
					   </table>
					</td>
				  </tr>
				  <tr>
					<td bgcolor="#ffffff" align="left" style="padding: 0px 30px 0px 30px; color: #666666; font-family:normal normal 600 40px/40px Open Sans; font-size: 18px; font-weight: 400; line-height: 25px;">
                      <p style="margin: 0;">If that does not work, copy and paste the following link in your browser:</p>
					</td>
				   </tr>
				  <tr>
				   <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 20px 30px; color: #666666; font-family:normal normal 600 40px/40px Open Sans, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
				    <p style="margin: 0;">
					 <a href="#" target="_blank" style="color: #FFA73B;">'.$link.'</a>
					</p>
				   </td>
				  </tr>
				</table>';
        $email->setSubject($subject);
        $email->setMessage($message);
     
        if ($email->send()) 
		{
            $session->setFlashdata('msg', 'A verification link has been sent to your email account');
        } 
		else 
		{
           $session->setFlashdata('msg', 'A verification link has been sent to your email account');
		   // $data = $email->printDebugger(['headers']);
           // print_r($data);
        }	
		}
		
		return redirect()->to('user/resendmail');
	}
	public function insertUser(){
		$session = session();
		
		$users = new UserModel();
		$rand=time().rand(10,100);
		$data=[
		'name'=>$this->request->getPost('name'),
		'email'=>$this->request->getPost('email'),
		'mobile_no'=>$this->request->getPost('countrycode').'-'.$this->request->getPost('mobile_no'),
		'password'=>password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
		'status'=>0,
		'verificationCode'=>$rand,
		'created_at'=>date('Y-m-d H:i'),
		'updated_at'=>date('Y-m-d H:i')
		]; 
		//google captcha code
		$recaptchaResponse = trim($this->request->getVar('g-recaptcha-response'));
       
        $secret='6LeRgIMdAAAAAItQnO31Va5YDAYH5rbbta8lH8XG';
        $credential = array(
            'secret' => $secret,
            'response' => $this->request->getVar('g-recaptcha-response')
        );
 
       $verify = curl_init();
       curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
       curl_setopt($verify, CURLOPT_POST, true);
       curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($credential));
       curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
       curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
       $response = curl_exec($verify);
       $status= json_decode($response, true);
	  
	   if($status['success']){ 
		   $users->save($data);
		   
		   //send email
		   $email = \Config\Services::email();
        $to=$this->request->getPost('email');
		$link="https://vegan.sidhauli.co.in/user/accountVerification?code=".$rand;
        $email->setTo($to);
        $email->setFrom('info@projectstatus.co.in', 'Confirm Registration');
        $subject="Account Verification from hello vegans";
        $message='<table border="0" align="center" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;border:1px solid #FFA73B">
		          <tr>
				     <td bgcolor="#ffffff" align="center" valign="top" style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family:normal normal 600 40px/40px Open Sans; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;">
					    <h1 style="font-size: 48px; font-weight: 400; margin: 2;">Welcome!</h1> 
						<img src="https://vegan.sidhauli.co.in/public/hello_vegans/commingsoon/images/logo.png" width="125" height="120" style="display: block; border: 0px;border: 0;height: auto;line-height: 100%;outline: none;text-decoration: none;" />
					</td>
				  </tr>
				  <tr>
				    <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 40px 30px; color: #666666; font-family: normal normal 600 40px/40px Open Sans; font-size: 18px; font-weight: 400; line-height: 25px;">
				    <p style="margin: 0;">We are excited to have you get started. First, you need to confirm your account. Just press the button below.</p>
				    </td>
				  </tr>
				  <tr>
				    <td bgcolor="#ffffff" align="left">
                     <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
						 <td bgcolor="#ffffff" align="center" style="padding: 20px 30px 60px 30px;">
						   <table border="0" cellspacing="0" cellpadding="0">
                              <tr>
							    <td align="center" style="border-radius: 3px;" bgcolor="#FFA73B"><a href="'.$link.'" target="_blank" style="font-size: 20px; font-family: normal normal 600 40px/40px Open Sans; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; padding: 15px 25px; border-radius: 2px; border: 1px solid #FFA73B; display: inline-block;">Confirm Account</a>
								</td>   
							   </tr>
							</table>
						   </td>
						  </tr>
					   </table>
					</td>
				  </tr>
				  <tr>
					<td bgcolor="#ffffff" align="left" style="padding: 0px 30px 0px 30px; color: #666666; font-family:normal normal 600 40px/40px Open Sans; font-size: 18px; font-weight: 400; line-height: 25px;">
                      <p style="margin: 0;">If that does not work, copy and paste the following link in your browser:</p>
					</td>
				   </tr>
				  <tr>
				   <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 20px 30px; color: #666666; font-family:normal normal 600 40px/40px Open Sans, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
				    <p style="margin: 0;">
					 <a href="#" target="_blank" style="color: #FFA73B;">'.$link.'</a>
					</p>
				   </td>
				  </tr>
				</table>';
        $email->setSubject($subject);
        $email->setMessage($message);

        if ($email->send()) 
		{
            $session->setFlashdata('msg', 'User has been registerd successfully<br> A verification link has been sent to your email account');
        } 
		else 
		{
           $session->setFlashdata('msg', 'User has been registerd successfully<br> A verification link has been sent to your email account');
		   // $data = $email->printDebugger(['headers']);
           // print_r($data);
        }
		   //send email
      }else{
			$session->setFlashdata('msg', 'Please Select Capthca');
      }	

		 return redirect()->to('user/register');
	}
    public function checkemailf(){
		$users = new UserModel();
		$email=$this->request->getPost('email');
		$data=$users->getUserCountByEmail($email);
		echo $data;
	}
	public function loginAuth()
    {
        
		$session = session();

        $users = new UserModel();

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        
        $data = $users->where('email', $email)->first();
        if($data){
		    $pass = $data['password'];
            $checkStatus = $users->where('email', $email)->where('status',1)->first();
			/* $q=$users->getLastQuery();
			echo "<pre>";
			print_r($q);
			die; */
			if($checkStatus){
				
			$authenticatePassword = password_verify($password, $pass);
				/* echo "<pre>";
				print_r($authenticatePassword);
				die; */
				if($authenticatePassword){
					$ses_data = [
						'idUserH' => $data['id'],
						'nameUserH' => $data['name'],
						'emailUserH' => $data['email'],
						'profileUserH' => $data['profile_image'],
						'isLoggedInUserH' => TRUE
					];

					$session->set($ses_data);
					return redirect()->to('/user/dashboard');
				
				}else{
					$session->setFlashdata('msg', 'Password is incorrect.');
					return redirect()->to('/user/login');
				}	
			}else{
			   $session->setFlashdata('msg', 'Please Verify Your email address if you did not get e-mail please click here to resend mail <br><a href="https://vegan.sidhauli.co.in/user/resendmail">click here</a>');
			   /* $session->setFlashdata('msg', 'Please Verify Your email address'); */
               return redirect()->to('/user/login');			   
			}
			

        }else{
            $session->setFlashdata('msg', 'Email does not exist.');
            return redirect()->to('/user/login');
        }
    }
	 public function logout()
    {
        $session = session();
		$array_items = ['idUserH', 'nameUserH','emailUserH','isLoggedInUserH'];
		$session->remove($array_items);
		//$session->destroy();
        
        return redirect()->to('/user/login');
    }
	public function logoutUser()
    {
        $session = session();
		$array_items = ['idUserH', 'nameUserH','emailUserH','isLoggedInUserH'];
		$session->remove($array_items);
		//$session->destroy();
        
        return redirect()->to('/user/login');
    }
	public function insertVeganPost(){
		
		$session = session();
		$post_image_db_data='';
		$post_image = $this->request->getFile('create_post_image');
		
		$post_image_name = $post_image->getName();
		if($post_image_name!=''){
			$post_image_name=time().$post_image_name;
			$post_image->move(ROOTPATH.'public/uploads/user/veganpost/',$post_image_name);
			$post_image_db_data='public/uploads/user/veganpost/'.$post_image_name;
		}
		$data=[
		'content'=>$this->request->getPost('create_post_content'),
		'image'=>$post_image_db_data,
		'created_at'=>date('Y-m-d H:i'),
		'updated_at'=>date('Y-m-d H:i'),
		'status'=>1,
		'user_id'=>$session->get('idUserH')
		]; 
		 
		 $posts = new PostModel();
		 $posts->insertPost($data);
		 $vegan= new PostModel();
	   	 $result=$vegan->getVeganPost($session->get('idUserH'));
		$val=$result[0];
		$public_url=base_url()."/public/frontend/";
        $baseurl=base_url()."/";
		/*  print_r($categories->getLastQuery());
		 die; */
		 $curr_time =$val['post_created_at'];
         $time_ago = strtotime($curr_time);
		 echo '<li class="main-feed-item">
          <article class="common-post">
            <div class="row">
              <div class="col-sm-6 col-md-6 padding-right">
                <div class="common-post-content common-content"> <a class="embed-content" href="#" target="_blank"> <img class="embed-content-image" src="'.$baseurl.$val['post_image'].'" alt=""> </a> </div>
              </div>
              <div class="col-sm-6 col-md-6">
                <header class="common-post-header u-flex"> <img src="'. $baseurl.$val['user_image'].'" class="user-image" width="40" height="40" alt="">
                  <div class="common-post-info">
                    <div class="user-and-group u-flex"> <a href="#" target="_blank">'.$val['user_name'].' </a> </div>
                  </div>
                  <button class="icon-button-2 u-margin-inline-start" aria-label="more options"><span class="icon-menu"></span></button>
                </header>
                <div class="embed-content-text">
                  <p class="embed-content-paragraph">'.$val['post_content'].'</p>
                </div>
                <div class="summary u-flex"> <a href="#">
                  <div class="reactions">❤️</div>
                  </a> <a href="#"> <span class="icon"><i class="fa fa-comment-o" aria-hidden="true"></i></span></a> <a href="#"> <span class="icon"><i class="fa fa-share-alt" aria-hidden="true"></i> </span></a> </div>
                <div class="summary u-flex">
                  <div class="total-comments u-margin-inline-start time_btm"> <a href="#">'.$this->time_Ago($time_ago).'
				  </a> </div>
                </div>
              </div>
            </div>
          </article>
        </li>';
		 //echo "success";
		die;
		}
		public function time_Ago($time) {
  
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
        echo "$sec seconds ago";
    }
      
    // Check for minutes
    else if($min <= 60) {
        if($min==1) {
            echo "one minute ago";
        }
        else {
            echo "$min minutes ago";
        }
    }
      
    // Check for hours
    else if($hrs <= 24) {
        if($hrs == 1) { 
            echo "an hour ago";
        }
        else {
            echo "$hrs hours ago";
        }
    }
      
    // Check for days
    else if($days <= 7) {
        if($days == 1) {
            echo "Yesterday";
        }
        else {
            echo "$days days ago";
        }
    }
      
    // Check for weeks
    else if($weeks <= 4.3) {
        if($weeks == 1) {
            echo "a week ago";
        }
        else {
            echo "$weeks weeks ago";
        }
    }
      
    // Check for months
    else if($mnths <= 12) {
        if($mnths == 1) {
            echo "a month ago";
        }
        else {
            echo "$mnths months ago";
        }
    }
      
    // Check for years
    else {
        if($yrs == 1) {
            echo "one year ago";
        }
        else {
            echo "$yrs years ago";
        }
    }
}
}
