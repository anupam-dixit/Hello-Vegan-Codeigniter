<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\AdminModel;
use App\Models\ForumModel;
use App\Models\UserChatModel;
use App\Models\RecommendationModel;
use App\Models\CooksModel;
class ForumController extends BaseController
{
	public function index()
	{

	}
	public function listPostTag(){
		$tags = new ForumModel();
		$data['tags']=$tags->getAllPostTag();
		return view('admin/forum/listPostTag',$data);
	}
	public function addPostTag(){
		return view('admin/forum/addPostTag');
	}
	public function editPostTag($id){
		$tags = new ForumModel();
		$data['tags']=$tags->getSinglePostTag($id);
		return view('admin/forum/editPostTag',$data);
	}
	public function deletePostTag($id){
		$tags = new ForumModel();
		$tags->deletePostTag($id);
	}
	public function insertPostTag(){
		
		$data=[
		'name'=>$this->request->getPost('tag_name'),
		'created_at'=>date('Y-m-d H:i'),
		'updated_at'=>date('Y-m-d H:i'),
		'status'=>1
		]; 
		 $tags = new ForumModel();
		 $tags->insertPostTag($data);
		 return redirect()->to('admin/forum/post/tags');
	}
	public function updatePostTag(){
		
		$id=$this->request->getPost('id');
		$data['name']=$this->request->getPost('tag_name');
		$data['status']=1;
		$data['updated_at']=date('Y-m-d H:i');
		$tags = new ForumModel();
		$tags->updatePostTag($id,$data);
		return redirect()->to('admin/forum/post/tags');
	}
	//posts functions
	public function listPosts(){
		$posts = new ForumModel();
		$data['posts']=$posts->getAllPost();
		return view('admin/forum/listPosts',$data);
	}
	public function addPost(){
		$tags = new ForumModel();
		$data['tags']=$tags->getAllPostTag();
		return view('admin/forum/addPost',$data);
	}
	public function editPost($id){
 	    $forum = new ForumModel();
		$data['tags']=$forum->getAllPostTag();
		$data['posts']=$forum->getSinglePost($id);
		return view('admin/forum/editPost',$data);	
	}
	public function viewPost($id){
		$forum = new ForumModel();
		$data['posts']=$forum->getSinglePost($id);
		return view('admin/forum/viewPost',$data);
	}
	public function deletePost($id){
		$posts = new ForumModel();
		$posts->deletePost($id);
	}
	public function insertPost(){
		$post_image_db_data='';
		$post_image = $this->request->getFile('image');
		
		$post_image_name = $post_image->getName();
		if($post_image_name!=''){
			$post_image_name=time().$post_image_name;
			$post_image->move(ROOTPATH.'public/uploads/forum/post/',$post_image_name);
			$post_image_db_data='public/uploads/forum/post/'.$post_image_name;
		}
		$data=[
		'post_tag_id'=>$this->request->getPost('post_tag_id'),
		'title'=>$this->request->getPost('title'),
		'content'=>$this->request->getPost('content'),
		'location'=>$this->request->getPost('location'),
		'image'=>$post_image_db_data,
		'created_at'=>date('Y-m-d H:i'),
		'updated_at'=>date('Y-m-d H:i'),
		'status'=>1
		]; 
		 $tags = new ForumModel();
		 $tags->insertPost($data);
		 return redirect()->to('admin/forum/posts');
	}
	public function updatePost(){
		$post_image_db_data='';
		$post_image = $this->request->getFile('image');
		$data['image']='';
		
		$post_image_name = $post_image->getName();
		if($post_image_name!=''){
			$post_image_name=time().$post_image_name;
			$post_image->move(ROOTPATH.'public/uploads/forum/post/',$post_image_name);
			$post_image_db_data='public/uploads/forum/post/'.$post_image_name;
			$data['image']=$post_image_db_data;
		}
		$id=$this->request->getPost('id');
		$data['post_tag_id']=$this->request->getPost('post_tag_id');
		$data['title']=$this->request->getPost('title');
		$data['content']=$this->request->getPost('content');
		$data['location']=$this->request->getPost('location');
		
		$data['status']=1;
		$data['updated_at']=date('Y-m-d H:i');
		$posts = new ForumModel();
		$posts->updatePost($id,$data);
		return redirect()->to('admin/forum/posts');
	}
	public function managePostComment($id){
		$forum = new ForumModel();
		$data['posts']=$forum->getSinglePost($id);
		$data['comments']=$forum->getPostComment($id);
		return view('admin/forum/managePostComment',$data);
		
	}
	public function insertPostComment(){
		$id=$this->request->getPost('post_id');
		$data=[
		'post_id'=>$this->request->getPost('post_id'),
		'admin_id'=>1,
		'user_id'=>'',
		'message'=>$this->request->getPost('message'),
		'created_at'=>date('Y-m-d H:i:s'),
		'status'=>1
		]; 
		 $forum = new ForumModel();
		 $forum->insertPostComment($data);
		 return redirect()->to('admin/forum/post/manage-comments/'.$id);
		
	}
	//questions
	public function listQuestionTag(){
		$tags = new ForumModel();
		$data['tags']=$tags->getAllQuestionTag();
		return view('admin/forum/listQuestionTag',$data);
	}
	public function addQuestionTag(){
		return view('admin/forum/addQuestionTag');
	}
	public function editQuestionTag($id){
		$tags = new ForumModel();
		$data['tags']=$tags->getSingleQuestionTag($id);
		return view('admin/forum/editQuestionTag',$data);
	}
	public function deleteQuestionTag($id){
		$tags = new ForumModel();
		$tags->deleteQuestionTag($id);
	}
	public function insertQuestionTag(){
		
		$data=[
		'name'=>$this->request->getPost('tag_name'),
		'created_at'=>date('Y-m-d H:i'),
		'updated_at'=>date('Y-m-d H:i'),
		'status'=>1
		]; 
		 $tags = new ForumModel();
		 $tags->insertQuestionTag($data);
		 return redirect()->to('admin/forum/question/tags');
	}
	public function updateQuestionTag(){
		
		$id=$this->request->getPost('id');
		$data['name']=$this->request->getPost('tag_name');
		$data['status']=1;
		$data['updated_at']=date('Y-m-d H:i');
		$tags = new ForumModel();
		$tags->updatePostTag($id,$data);
		return redirect()->to('admin/forum/question/tags');
	}
	//questions functions
	public function listQuestions(){
		$questions = new ForumModel();
		$data['questions']=$questions->getAllQuestion();
		return view('admin/forum/listQuestion',$data);
	}
	public function addQuestion(){
		$tags = new ForumModel();
		$data['tags']=$tags->getAllQuestionTag();
		return view('admin/forum/addQuestion',$data);
	}
	public function editQuestion($id){
 	    $forum = new ForumModel();
		$data['tags']=$forum->getAllQuestionTag();
		$data['questions']=$forum->getSingleQuestion($id);
		return view('admin/forum/editQuestion',$data);	
	}
	public function viewQuestion($id){
		$forum = new ForumModel();
		$data['questions']=$forum->getSingleQuestion($id);
		return view('admin/forum/viewQuestion',$data);
	}
	public function deleteQuestion($id){
		$questions = new ForumModel();
		$questions->deleteQuestion($id);
	}
	public function insertQuestion(){
		$question_image_db_data='';
		$question_image = $this->request->getFile('image');
		
		$question_image_name = $question_image->getName();
		if($question_image_name!=''){
			$question_image_name=time().$question_image_name;
			$question_image->move(ROOTPATH.'public/uploads/forum/question/',$question_image_name);
			$question_image_db_data='public/uploads/forum/question/'.$question_image_name;
		}
		$data=[
		'question_tag_id'=>$this->request->getPost('question_tag_id'),
		'title'=>$this->request->getPost('title'),
		'content'=>$this->request->getPost('content'),
		'image'=>$post_image_db_data,
		'created_at'=>date('Y-m-d H:i'),
		'updated_at'=>date('Y-m-d H:i'),
		'status'=>1
		]; 
		 $tags = new ForumModel();
		 $tags->insertQuestion($data);
		 return redirect()->to('admin/forum/questions');
	}
	public function updateQuestion(){
		$question_image_db_data='';
		$question_image = $this->request->getFile('image');
		$data['image']='';
		
		$question_image_name = $question_image->getName();
		if($question_image_name!=''){
			$question_image_name=time().$question_image_name;
			$question_image->move(ROOTPATH.'public/uploads/forum/question/',$question_image_name);
			$question_image_db_data='public/uploads/forum/question/'.$question_image_name;
			$data['image']=$question_image_db_data;
		}
		$id=$this->request->getPost('id');
		$data['question_tag_id']=$this->request->getPost('question_tag_id');
		$data['title']=$this->request->getPost('title');
		$data['content']=$this->request->getPost('content');
		
		$data['status']=1;
		$data['updated_at']=date('Y-m-d H:i');
		$posts = new ForumModel();
		$posts->updateQuestion($id,$data);
		return redirect()->to('admin/forum/questions');
	}
	public function manageQuestionComment($id){
		$forum = new ForumModel();
		$data['questions']=$forum->getSingleQuestion($id);
		$data['comments']=$forum->getQuestionComment($id);
		return view('admin/forum/manageQuestionComment',$data);
		
	}
	public function insertQuestionComment(){
		$id=$this->request->getPost('question_id');
		$data=[
		'question_id'=>$this->request->getPost('question_id'),
		'admin_id'=>1,
		'user_id'=>'',
		'message'=>$this->request->getPost('message'),
		'created_at'=>date('Y-m-d H:i:s'),
		'status'=>1
		]; 
		 $forum = new ForumModel();
		 $forum->insertQuestionComment($data);
		 return redirect()->to('admin/forum/question/manage-comments/'.$id);
		
	}
	//frontend code
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
		$data['public_url']=base_url()."/public/frontend/";
		$data['baseurl']=base_url()."/";
        $usersdata = new UserModel();
		$data['users']=$usersdata->getSingleUser($session->get('idUserH'));
		$data['loginusers']=$usersdata->getSingleUser($session->get('idUserH'));
		$data['userfriend']=$usersdata->getSingleUserFriend($session->get('idUserH'));
		$data['birthday']=$usersdata->getUserFriendBirthday($session->get('idUserH'));
		$data['loginusers']=$usersdata->getSingleUser($session->get('idUserH'));
		$forumdata = new ForumModel();
		$data['tags']=$forumdata->getAllPostTag();
		$data['questions']=$forumdata->getAllPost();
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
		$data['public_url']=base_url()."/public/frontend/";
		$data['baseurl']=base_url()."/";
        $usersdata = new UserModel();
		$data['users']=$usersdata->getSingleUser($session->get('idUserH'));
		$data['loginusers']=$usersdata->getSingleUser($session->get('idUserH'));
		$data['userfriend']=$usersdata->getSingleUserFriend($session->get('idUserH'));
		$data['birthday']=$usersdata->getUserFriendBirthday($session->get('idUserH'));
		$data['loginusers']=$usersdata->getSingleUser($session->get('idUserH'));
		$forumdata = new ForumModel();
		$data['tags']=$forumdata->getAllPostTag();
		$data['questions']=$forumdata->getAllPost();
		return view('user/question/answer',$data);
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
		$data['public_url']=base_url()."/public/frontend/";
		$data['baseurl']=base_url()."/";
        $usersdata = new UserModel();
		$data['users']=$usersdata->getSingleUser($session->get('idUserH'));
		$data['loginusers']=$usersdata->getSingleUser($session->get('idUserH'));
		$data['userfriend']=$usersdata->getSingleUserFriend($session->get('idUserH'));
		$data['birthday']=$usersdata->getUserFriendBirthday($session->get('idUserH'));
		$data['loginusers']=$usersdata->getSingleUser($session->get('idUserH'));
		$forumdata = new ForumModel();
		$data['tags']=$forumdata->getAllPostTag();
		$data['questions']=$forumdata->getAllPost();
		
		return view('user/question/questionUser',$data);
	}

}
