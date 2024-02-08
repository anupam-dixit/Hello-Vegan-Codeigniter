<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\AdminModel;
use App\Models\TutorialsModel;
class TutorialController extends BaseController
{
	public function index()
	{

	}
	public function listPostCategory(){
		$categories = new TutorialsModel();
		$data['categories']=$categories->getAllPostCategory();
		return view('admin/tutorials/listPostCategory',$data);
	}
	public function addPostCategory(){
		return view('admin/tutorials/addPostCategory');
	}
	public function editPostCategory($id){
		$categories = new TutorialsModel();
		$data['categories']=$categories->getSinglePostCategory($id);
		return view('admin/tutorials/editPostCategory',$data);
	}
	public function deletePostCategory($id){
		$categories = new TutorialsModel();
		$categories->deletePostCategory($id);
	}
	public function insertPostCategory(){
		
		$data=[
		'name'=>$this->request->getPost('category_name'),
		'created_at'=>date('Y-m-d H:i'),
		'updated_at'=>date('Y-m-d H:i'),
		'status'=>1
		]; 
		 $categories = new TutorialsModel();
		 $categories->insertPostCategory($data);
		 return redirect()->to('admin/tutorials/post/categories');
	}
	public function updatePostCategory(){
		
		$id=$this->request->getPost('id');
		$data['name']=$this->request->getPost('category_name');
		$data['status']=1;
		$data['updated_at']=date('Y-m-d H:i');
		
		$categories = new TutorialsModel();
		$categories->updatePostCategory($id,$data);
		return redirect()->to('admin/tutorials/post/categories');
	}
	//posts functions
	public function listPosts(){
		$posts = new TutorialsModel();
		$data['posts']=$posts->getAllPost();
		return view('admin/tutorials/listPosts',$data);
	}
	public function addPost(){
		$categories = new TutorialsModel();
		//$data['categories']=$categories->getAllPostCategory();
		return view('admin/tutorials/addPost');
	}
	public function editPost($id){
 	    $tutorials = new TutorialsModel();
		//$data['categories']=$tutorials->getAllPostCategory();
		$data['posts']=$tutorials->getSinglePost($id);
		return view('admin/tutorials/editPost',$data);	
	}
	public function viewPost($id){
		$tutorials = new TutorialsModel();
		//$data['categories']=$tutorials->getAllPostCategory();
		$data['posts']=$tutorials->getSinglePost($id);
		return view('admin/tutorials/viewPost',$data);
	}
	public function deletePost($id){
		$posts = new TutorialsModel();
		$posts->deletePost($id);
	}
	public function insertPost(){
		$post_image_db_data='';
		$post_image = $this->request->getFile('image');
		
		$post_image_name = $post_image->getName();
		if($post_image_name!=''){
			$post_image_name=time().$post_image_name;
			$post_image->move(ROOTPATH.'public/uploads/tutorials/post/',$post_image_name);
			$post_image_db_data='public/uploads/tutorials/post/'.$post_image_name;
		}
		$data=[
		'title'=>$this->request->getPost('title'),
		'content'=>$this->request->getPost('content'),
		'file'=>$post_image_db_data,
		'created_at'=>date('Y-m-d H:i'),
		'location'=>$this->request->getPost('location'),
		'status'=>1
		]; 
		 $categories = new TutorialsModel();
		 $categories->insertPost($data);
		 return redirect()->to('admin/tutorials/posts');
	}
	public function updatePost(){
		$post_image_db_data='';
		$post_image = $this->request->getFile('file');
		$data['file']='';
		
		$post_image_name = $post_image->getName();
		if($post_image_name!=''){
			$post_image_name=time().$post_image_name;
			$post_image->move(ROOTPATH.'public/uploads/tutorials/post/',$post_image_name);
			$post_image_db_data='public/uploads/tutorials/post/'.$post_image_name;
			$data['file']=$post_image_db_data;
		}
		$id=$this->request->getPost('id');
		$data['post_category_id']=$this->request->getPost('post_category_id');
		$data['title']=$this->request->getPost('title');
		$data['content']=$this->request->getPost('content');
		$data['location']=$this->request->getPost('location');
		$data['status']=1;
		$data['updated_at']=date('Y-m-d H:i');
		$posts = new TutorialsModel();
		$posts->updatePost($id,$data);
		return redirect()->to('admin/tutorials/posts');
	}
	public function managePostComment($id){
		$tutorials = new TutorialsModel();
		$data['categories']=$tutorials->getSinglePostCategory($id);
		$data['posts']=$tutorials->getSinglePost($id);
		$data['comments']=$tutorials->getPostComment($id);
		return view('admin/tutorials/managePostComment',$data);
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
		 $tutorials = new TutorialsModel();
		 $tutorials->insertPostComment($data);
		 return redirect()->to('admin/tutorials/post/manage-comments/'.$id);
		
	}
	

}
