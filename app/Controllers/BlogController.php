<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\AdminModel;
use App\Models\BlogModel;
class BlogController extends BaseController
{
	public function index()
	{

	}
	public function listPostCategory(){
		$categories = new BlogModel();
		$data['categories']=$categories->getAllPostCategory();
		return view('admin/blog/listPostCategory',$data);
	}
	public function addPostCategory(){
		return view('admin/blog/addPostCategory');
	}
	public function editPostCategory($id){
		$categories = new BlogModel();
		$data['categories']=$categories->getSinglePostCategory($id);
		return view('admin/blog/editPostCategory',$data);
	}
	public function deletePostCategory($id){
		$categories = new BlogModel();
		$categories->deletePostCategory($id);
	}
	public function insertPostCategory(){
		
		$data=[
		'name'=>$this->request->getPost('category_name'),
		'created_at'=>date('Y-m-d H:i'),
		'updated_at'=>date('Y-m-d H:i'),
		'status'=>1
		]; 
		 $categories = new BlogModel();
		 $categories->insertPostCategory($data);
		 return redirect()->to('admin/blog/post/categories');
	}
	public function updatePostCategory(){
		
		$id=$this->request->getPost('id');
		$data['name']=$this->request->getPost('category_name');
		$data['status']=1;
		$data['updated_at']=date('Y-m-d H:i');
		
		$categories = new BlogModel();
		$categories->updatePostCategory($id,$data);
		return redirect()->to('admin/blog/post/categories');
	}
	//posts functions
	public function listPosts(){
		$posts = new BlogModel();
		$data['posts']=$posts->getAllPost();
		return view('admin/blog/listPosts',$data);
	}

	public function blogPostRequest(){
		$posts = new BlogModel();
		$posts->updateReadStatus();
		$data['posts']=$posts->getAllPostRequest();
		return view('admin/blog/blog_request',$data);
	}

	public function addPost(){
		$categories = new BlogModel();
		$data['categories']=$categories->getAllPostCategory();
		return view('admin/blog/addPost',$data);
	}
	public function editPost($id){
 	    $blog = new BlogModel();
		$data['categories']=$blog->getAllPostCategory();
		$data['posts']=$blog->getSinglePost($id);
		
		return view('admin/blog/editPost',$data);	
	}
	public function viewPost($id){
		$blog = new BlogModel();
		$data['categories']=$blog->getAllPostCategory();
		$data['posts']=$blog->getSinglePost($id);
		return view('admin/blog/viewPost',$data);
	}
	public function deletePost($id){
		$posts = new BlogModel();
		$posts->deletePost($id);
	}

	public function approveBlogRequest($id){
		$posts = new BlogModel();
		$posts->updateBlogStatus($id);
		return redirect()->to('admin/blog/posts-request');
	}
	public function declineBlogRequest($id){
		$posts = new BlogModel();
		$posts->updateBlogDeclineStatus($id);
		return redirect()->to('admin/blog/posts-request');
	}


	public function insertPost(){
		$post_image_db_data='';
		$post_image = $this->request->getFile('image');
		
		$post_image_name = $post_image->getName();
		if($post_image_name!=''){
			$post_image_name=time().$post_image_name;
			$post_image->move(ROOTPATH.'public/uploads/blog/post/',$post_image_name);
			$post_image_db_data='public/uploads/blog/post/'.$post_image_name;
		}
		$data=[
		'post_category_id'=>$this->request->getPost('post_category_id'),
		'title'=>$this->request->getPost('title'),
		'content'=>$this->request->getPost('content'),
		'image'=>$post_image_db_data,
		'created_at'=>date('Y-m-d H:i'),
		'updated_at'=>date('Y-m-d H:i'),
		'location'=>$this->request->getPost('location'),
		'status'=>1
		]; 
		 $categories = new BlogModel();
		 $categories->insertPost($data);
		/*  print_r($categories->getLastQuery());
		 die; */
		 return redirect()->to('admin/blog/posts');
	}
	public function updatePost(){
		$post_image_db_data='';
		$post_image = $this->request->getFile('image');
		$data['image']='';
		
		$post_image_name = $post_image->getName();
		if($post_image_name!=''){
			$post_image_name=time().$post_image_name;
			$post_image->move(ROOTPATH.'public/uploads/blog/post/',$post_image_name);
			$post_image_db_data='public/uploads/blog/post/'.$post_image_name;
			$data['image']=$post_image_db_data;
		}
		$id=$this->request->getPost('id');
		$data['post_category_id']=$this->request->getPost('post_category_id');
		$data['title']=$this->request->getPost('title');
		$data['content']=$this->request->getPost('content');
		$data['location']=$this->request->getPost('location');
		$data['status']=1;
		$data['updated_at']=date('Y-m-d H:i');
		$posts = new BlogModel();
		$posts->updatePost($id,$data);
		return redirect()->to('admin/blog/posts');
	}
	public function managePostComment($id){
		$blog = new BlogModel();
		$data['categories']=$blog->getSinglePostCategory($id);
		$data['posts']=$blog->getSinglePost($id);
		$data['comments']=$blog->getPostComment($id);
		return view('admin/blog/managePostComment',$data);
	}
	public function insertPostComment(){
		$id=$this->request->getPost('post_id');
		$data=[
		'post_id'=>$this->request->getPost('post_id'),
		'commented_by'=>0,
		'message'=>$this->request->getPost('message'),
		'created_at'=>date('Y-m-d H:i:s'),
		'status'=>1
		]; 
		 $blog = new BlogModel();
		 $blog->insertPostComment($data);
		 return redirect()->to('admin/blog/post/manage-comments/'.$id);
		
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
    public function showOlderBlogComments(){
		$session = session();
        $data['session'] =$session;
		$blogs= new BlogModel();
		$id=$this->request->getPost('id');
		$html='';
		$da=$blogs->getPostCommentOlder($id);
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
		echo $html;
		die;
	}
}
