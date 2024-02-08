<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\AdminModel;
use App\Models\NewsModel;
class NewsController extends BaseController
{
	public function index()
	{

	}
	public function listPostCategory(){
		$categories = new NewsModel();
		$data['categories']=$categories->getAllPostCategory();
		return view('admin/news/listPostCategory',$data);
	}
	public function addPostCategory(){
		return view('admin/news/addPostCategory');
	}
	public function editPostCategory($id){
		$categories = new NewsModel();
		$data['categories']=$categories->getSinglePostCategory($id);
		return view('admin/news/editPostCategory',$data);
	}
	public function deletePostCategory($id){
		$categories = new NewsModel();
		$categories->deletePostCategory($id);
	}
	public function insertPostCategory(){
		
		$data=[
		'name'=>$this->request->getPost('category_name'),
		'created_at'=>date('Y-m-d H:i'),
		'updated_at'=>date('Y-m-d H:i'),
		'status'=>1
		]; 
		 $categories = new NewsModel();
		 $categories->insertPostCategory($data);
		 return redirect()->to('admin/news/post/categories');
	}
	public function updatePostCategory(){
		
		$id=$this->request->getPost('id');
		$data['name']=$this->request->getPost('category_name');
		$data['status']=1;
		$data['updated_at']=date('Y-m-d H:i');
		
		$categories = new NewsModel();
		$categories->updatePostCategory($id,$data);
		return redirect()->to('admin/news/post/categories');
	}
	//posts functions
	public function listPosts(){
		
		$posts = new NewsModel();
		$data['posts']=$posts->getAllPost();
		
		return view('admin/news/listPosts',$data);
	}
	public function addPost(){
		$categories = new NewsModel();
		$data['categories']=$categories->getAllPostCategory();
		return view('admin/news/addPost',$data);
	}
	public function editPost($id){
 	    $news = new NewsModel();
		$data['categories']=$news->getAllPostCategory();
		$data['posts']=$news->getSinglePost($id);
		return view('admin/news/editPost',$data);	
	}
	public function viewPost($id){
		$news = new NewsModel();
		$data['categories']=$news->getAllPostCategory();
		$data['posts']=$news->getSinglePost($id);
		return view('admin/news/viewPost',$data);
	}
	public function deletePost($id){
		$posts = new NewsModel();
		$posts->deletePost($id);
	}
	public function insertPost(){
		
		$post_image_db_data='';
		$post_image = $this->request->getFile('image');
		$post_image_name = $post_image->getName();
		if($post_image_name!=''){
			$post_image_name=time().$post_image_name;
			$post_image->move(ROOTPATH.'public/uploads/news/post/',$post_image_name);
			$post_image_db_data='public/uploads/news/post/'.$post_image_name;
		}
		$post_galleryimage_db_data='';
		
		if($this->request->getFileMultiple('galleryimage')){
			 foreach($this->request->getFileMultiple('galleryimage') as $file)
             { 
			 if($file->getClientName()!=''){
			 $post_galleryimage_name=$file->getClientName();
			 $post_galleryimage_name=time().$post_galleryimage_name;
			 $file->move(ROOTPATH.'public/uploads/news/post/',$post_galleryimage_name);
			 
			 $post_galleryimage_db_data.='public/uploads/news/post/'.$post_galleryimage_name.",";
			 }
			 }
		}
		$post_galleryimage_db_data=rtrim($post_galleryimage_db_data,",");
		$post_videofile_db_data='';
		$post_videourl_db_data='';
		$post_video = $this->request->getFile('videofile');
		$post_video_name = $post_video->getName();
		if($post_video_name!=''){
			$post_video_name=time().$post_video_name;
			$post_video->move(ROOTPATH.'public/uploads/news/post/',$post_video_name);
			$post_videofile_db_data='public/uploads/news/post/'.$post_video_name;
		}
		if($post_video==''){
			$post_videourl_db_data = $this->request->getFile('videourl');
		}
		$data=[
		'post_category_id'=>$this->request->getPost('post_category_id'),
		'title'=>$this->request->getPost('title'),
		'content'=>$this->request->getPost('content'),
		'image'=>$post_image_db_data,
		'galleryimage'=>$post_galleryimage_db_data,
		'videofile'=>$post_videofile_db_data,
		'videourl'=>$post_videourl_db_data,
		'created_at'=>date('Y-m-d H:i'),
		'updated_at'=>date('Y-m-d H:i'),
		'location'=>$this->request->getPost('location'),
		'status'=>1
		]; 
		 $categories = new NewsModel();
		 $categories->insertPost($data);
		 return redirect()->to('admin/news/posts');
	}
	public function updatePost(){
		$post_image_db_data='';
		
		$data['image']='';
		$data['galleryimage']='';
		$data['videofile']='';
		$post_image = $this->request->getFile('image');
		$post_image_name = $post_image->getName();
		if($post_image_name!=''){
			$post_image_name=time().$post_image_name;
			$post_image->move(ROOTPATH.'public/uploads/news/post/',$post_image_name);
			$post_image_db_data='public/uploads/news/post/'.$post_image_name;
			$data['image']=$post_image_db_data;
		}
		$post_galleryimage_db_data='';
		if($this->request->getPost('galleryimage')!=''){
			foreach($this->request->getPost('galleryimage') as $val){
				$post_galleryimage_db_data.=$val.",";
			}
		}
		
		if($this->request->getFileMultiple('galleryimage')){
			 foreach($this->request->getFileMultiple('galleryimage') as $file)
             { 
			 if($file->getClientName()!=''){
			 $post_galleryimage_name=$file->getClientName();
			 $post_galleryimage_name=time().$post_galleryimage_name;
			 $file->move(ROOTPATH.'public/uploads/news/post/',$post_galleryimage_name);
			 
			$post_galleryimage_db_data.='public/uploads/news/post/'.$post_galleryimage_name.",";
			}
			 }
		}
		
		$post_galleryimage_db_data=rtrim($post_galleryimage_db_data,",");
		$data['galleryimage']=$post_galleryimage_db_data;
		$post_videofile = $this->request->getFile('videofile');
		if(isset($post_videofile)){
		$post_videofile_name = $post_videofile->getName();
		if($post_videofile_name!=''){
			$post_videofile_name=time().$post_videofile_name;
			$post_videofile->move(ROOTPATH.'public/uploads/news/post/',$post_videofile_name);
			$post_videofile_db_data='public/uploads/news/post/'.$post_videofile_name;
			$data['videofile']=$post_videofile_db_data;
		}	
		}
		
		$id=$this->request->getPost('id');
		$data['post_category_id']=$this->request->getPost('post_category_id');
		$data['title']=$this->request->getPost('title');
		$data['videourl']=$this->request->getPost('videourl');
		$data['content']=$this->request->getPost('content');
		$data['location']=$this->request->getPost('location');
		$data['status']=1;
		$data['updated_at']=date('Y-m-d H:i');
		
		$posts = new NewsModel();
		$posts->updatePost($id,$data);
		return redirect()->to('admin/news/posts');
	}
	public function managePostComment($id){
		$news = new NewsModel();
		$data['categories']=$news->getSinglePostCategory($id);
		$data['posts']=$news->getSinglePost($id);
		$data['comments']=$news->getPostComment($id);
		return view('admin/news/managePostComment',$data);
	}
	public function insertPostComment(){
		$id=$this->request->getPost('post_id');
		$data=[
		'post_id'=>$this->request->getPost('post_id'),
		'commented_by'=>1,
		'commented_by'=>'',
		'message'=>$this->request->getPost('message'),
		'created_at'=>date('Y-m-d H:i:s'),
		'status'=>1
		]; 
		 $news = new NewsModel();
		 $news->insertPostComment($data);
		 return redirect()->to('admin/news/post/manage-comments/'.$id);
		
	}
	public function insertPostCommentUser(){
		$session = session();
		$id=$this->request->getPost('post_id');
		$user_id=$this->request->getPost('user_id');
		$data=[
		'post_id'=>$this->request->getPost('post_id'),
		'commented_by'=>0,
		'commented_by'=>$user_id,
		'message'=>$this->request->getPost('message'),
		'created_at'=>date('Y-m-d H:i:s'),
		'status'=>1
		]; 
		 $news = new NewsModel();
		 $result=$news->insertPostComment($data);
		 $session->setFlashdata('msgcomments', 'Comments Added Successfully');
		 /* $response='';
			if($result['status']==1){
			  $response = ['status' => 1 ,'msgcomments' => '<span style="color:#090;">Comments Added Successfully</span>' ];
			}else{
			  $response = ['status' => 0 ,'msgcomments' => '<span style="color:#900;">sorry we re having some technical problems. please try again !</span>' 						];
			}
		
			 echo json_encode($response); */
		return redirect()->to('/user/news/details/'.$id);
	}
	

}
