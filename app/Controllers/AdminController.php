<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\BlogModel;
use App\Models\EventModel;
use App\Models\DashBoardModel;
use App\Models\AdminModel;
use App\Models\ReceipeModel;
class AdminController extends BaseController
{
	public function index()
	{

	}
	public function dashboard(){
		$dbm = new DashBoardModel();
		$data['total_active_users'] =$dbm->getAllUsers();
		$data['total_active_blogs'] =$dbm->getAllBlogs();
		$data['total_blog_notifications'] =$dbm->getBlogNotifications();
		$data['total_active_events'] =$dbm->getAllEvents();
		$data['total_event_notifications'] =$dbm->getEventNotifications();
		$data['total_active_news'] =$dbm->getAllNews();
		$data['total_active_recipes'] =$dbm->getAllRecipes();
		$data['total_recipe_notifications'] =$dbm->getRecipeNotifications();
		$data['total_active_users_day_wise'] =$dbm->getUsersDayWise();
		$data['total_active_recommendations'] =$dbm->getAllRecommendations();
		$bm= new BlogModel();
		$data['pending_request_blogs'] =$bm->getAllPostRequest();
		$em= new EventModel();
		$data['pending_request_events'] =$em->getEventRequest();
		$rm= new ReceipeModel();
		$data['pending_request_receipes'] =$rm->user_recipe_request();
//		die(json_encode($data));
		return view('admin/dashboard/index',$data);	
	}
	public function frontUserFriendPosts($id){
		$users = new UserModel();
		$data['posts'] =$users->getFrontUserFriendPosts($id);
		return view('admin/users/listFriendPosts',$data);
	}
	public function listFriend($id){
	$users = new UserModel();
	$data['users_friend'] =$users->getSingleUserFriend($id);
	return view('admin/users/listFriend',$data);	
	}
	public function listUser(){
		$users = new UserModel();
		$data['countallusers'] =count($users->getAllUsers());
		$data['users'] =$users->getAllUsers();
		return view('admin/users/listUser',$data);
	}
	
	public function addUser(){
		return view('admin/users/addUser');
	}
	
	public function editUser($id){
		$users = new UserModel();
		$data['users']=$users->getSingleUser($id);
		$data['questions']=$users->getSecurityQuestions($id);
		return view('admin/users/editUser',$data);
	}
	
	public function viewUser($id){
		$users = new UserModel();
		$data['users']=$users->getSingleUser($id);
		$data['questions']=$users->getSecurityQuestions($id);
		return view('admin/users/viewUser',$data);
	}
	
	public function insertUser(){
		
		$profile_image_db_data='';
		$profile_image = $this->request->getFile('profile_image');
		
		$profile_image_name = $profile_image->getName();
		if($profile_image_name!=''){
			$profile_image_name=time().$profile_image_name;
			$profile_image->move(ROOTPATH.'public/uploads/users/profileImage',$profile_image_name);
			$profile_image_db_data='public/uploads/users/profileImage/'.$profile_image_name;
		}
		$cover_image_db_data='';
		$cover_image = $this->request->getFile('cover_image');
		$cover_image_name = $cover_image->getName();
		if($cover_image_name!=''){
			$cover_image_name=time().$cover_image_name;
			$cover_image->move(ROOTPATH.'public/uploads/users/coverImage',$cover_image_name);
			$cover_image_db_data='public/uploads/users/coverImage/'.$cover_image_name;
		}
		
		$data=[
		'name'=>$this->request->getPost('name'),
		'location'=>$this->request->getPost('location'),
		'address'=>$this->request->getPost('address'),
		'description'=>$this->request->getPost('description'),
		'profile_image'=>$profile_image_db_data,
		'cover_image'=>$cover_image_db_data,
		'email'=>$this->request->getPost('email'),
		'password'=>password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
		'status'=>1,
		'created_at'=>date('Y-m-d H:i'),
		'updated_at'=>date('Y-m-d H:i'),
		'location'=>$this->request->getPost('location')
		]; 
		
	     $users = new UserModel();
		 $users->save($data);
		 $seq[0]['sq1']=$this->request->getPost('sq1');
		 $seq[0]['sa1']=$this->request->getPost('sa1');
		 $seq[1]['sq2']=$this->request->getPost('sq2');
		 $seq[1]['sa2']=$this->request->getPost('sa2');
		 $seq[2]['sq3']=$this->request->getPost('sq3');
		 $seq[2]['sa3']=$this->request->getPost('sa3');
		 $insertId = $users->insertID();
		 $userId=$users->find($insertId);
		 $users->saveSecurityQuestions($userId['id'],$seq);
		 return redirect()->to('admin/users');
	}
	public function updateUser(){
		$cover_image_db_data='';
		$cover_image = $this->request->getFile('cover_image');
		$cover_image_name = $cover_image->getName();
		$profile_image_db_data='';
		$profile_image = $this->request->getFile('profile_image');
		$profile_image_name = $profile_image->getName();
		$id=$this->request->getPost('id');
		$data['name']=$this->request->getPost('name');
		$data['location']=$this->request->getPost('location');
		$data['address']=$this->request->getPost('address');
		$data['description']=$this->request->getPost('description');
		$data['email']=$this->request->getPost('email');
		if($this->request->getPost('password')!=''){
		$data['password']=password_hash($this->request->getPost('password'), PASSWORD_BCRYPT);
		}
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
		 $seq[0]['sq1']=$this->request->getPost('sq1');
		 $seq[0]['sa1']=$this->request->getPost('sa1');
		 $seq[1]['sq2']=$this->request->getPost('sq2');
		 $seq[1]['sa2']=$this->request->getPost('sa2');
		 $seq[2]['sq3']=$this->request->getPost('sq3');
		 $seq[2]['sa3']=$this->request->getPost('sa3');
		 $users->updateSecurityQuestions($id,$seq);
		 return redirect()->to('admin/edit-user/'.$id);
	}
	public function changeUserStatus(){ 
		if ($this->request->isAJAX()) {
        $id = service('request')->getPost('id');
        $status=service('request')->getPost('status');
		$data['status']=$status;
		$users = new UserModel();
		 $users->update($id,$data);
        }
			
	}

    public function checkemailf(){
		$users = new UserModel();
		$email=$this->request->getPost('email');
		$data=$users->getUserCountByEmail($email);
		echo $data;
	}
    public function checkemailf_edit(){
		$users = new UserModel();
		$email=$this->request->getPost('email');
		$id=$this->request->getPost('id');
		$data=$users->getEditUserCountByEmail($email,$id);
		echo $data;
	}
	public function listDeletedUser(){
		$users = new UserModel();
		$data['countallusers'] =count($users->getAllDeletedUsers());
		$data['users'] =$users->getAllDeletedUsers();
		return view('admin/users/listDeletedUser',$data);
	}
	
	public function viewUserDeleted($id){
		$users = new UserModel();
		$result=$users->getSingleDeletedUser($id);
		$data['users']=$result;
		$data['questions']=$users->getSecurityQuestionsForDeletedUser($result['deleted_user_id']);
		
		return view('admin/users/viewUserDeleted',$data);
	}
	
	public function deleteUser($id){
		$users = new UserModel();
        try {
            $users->deleteUser($id);
        } catch (\Exception $exception){
            echo  $exception->getMessage();
        }
	}

}
