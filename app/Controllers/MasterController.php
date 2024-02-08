<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\AdminModel;
use App\Models\MasterModel;
class MasterController extends BaseController
{
	public function index()
	{

	}
	public function tutorial(){
		$tags = new MasterModel();
		$data['tags']=$tags->getAllPostTag();
		return view('admin/master/listPostTag',$data);
	}
	public function addPostTag(){
		return view('admin/master/addPostTag');
	}
	public function editPostTag($id){
		$tags = new MasterModel();
		$data['tags']=$tags->getSinglePostTag($id);
		return view('admin/master/editPostTag',$data);
	}
	public function deletePostTag($id){
		$tags = new MasterModel();
		$tags->deletePostTag($id);
	}
	public function insertPostTag(){
		
		$data=[
		'name'=>$this->request->getPost('tag_name'),
		'created_at'=>date('Y-m-d H:i'),
		'updated_at'=>date('Y-m-d H:i'),
		'status'=>1
		]; 
		 $tags = new MasterModel();
		 $tags->insertPostTag($data);
		 return redirect()->to('admin/master/post/tags');
	}
	public function updatePostTag(){
		
		$id=$this->request->getPost('id');
		$data['name']=$this->request->getPost('tag_name');
		$data['status']=1;
		$data['updated_at']=date('Y-m-d H:i');
		$tags = new MasterModel();
		$tags->updatePostTag($id,$data);
		return redirect()->to('admin/masters/tutorials/location-list');
	}
	//posts functions
	
}
