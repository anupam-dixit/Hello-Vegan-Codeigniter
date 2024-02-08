<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\AdminModel;
use App\Models\ChefModel;
class ChefController extends BaseController
{
	public function index()
	{

	}
	public function listReChefCategory(){
		$rm = new ChefModel();
		$data['recats']=$rm->getAllReChefCategories();
		return view('admin/recommendation/listReChefCategory',$data);
	}
	public function addReChefCategory(){
		
		return view('admin/recommendation/addReChefCategory');
	}
	public function editReChefCategory($id){
		
		$rm = new ChefModel();
		$data['recats']=$rm->getSingleReChefCategory($id);
		return view('admin/recommendation/editReChefCategory',$data);
	}
	public function deleteReChefCategory($id){
		$rm = new ChefModel();
		$rm->deleteReChefCategory($id);
	}
	public function insertReChefCategory(){
		
		$session = session();
		
		$data=[
		'name'=>$this->request->getPost('category_name'),
		'created_at'=>date('Y-m-d H:i'),
		'updated_at'=>date('Y-m-d H:i'),
		'status'=>1
		]; 
		 $rm = new ChefModel();
		 $result=$rm->insertReChefCategory($data);
		 if($result['status']==1){
		 return redirect()->to('admin/recommendation/chef-category');
		 }else{
		  $session->setFlashdata('msg', 'Category name already taken Please try other name');
		  $session->setFlashdata('rc_name', $this->request->getPost('category_name'));
		  return redirect()->to('admin/recommendation/add-chef-category');	 
		 }
	}
	public function updateReChefCategory(){
		$session = session();
		$id=$this->request->getPost('id');
		$data['name']=$this->request->getPost('category_name');
		$data['status']=1;
		$data['updated_at']=date('Y-m-d H:i');
		$rm = new ChefModel();
		$result=$rm->updateReChefCategory($id,$data);
		if($result['status']==1){
		 return redirect()->to('admin/recommendation/chef-category');
		 }else{
		  $session->setFlashdata('msg', 'Category name already taken Please try other name');
		  $session->setFlashdata('rc_name', $this->request->getPost('category_name'));
		  return redirect()->to('admin/recommendation/edit-chef-category/'.$id);	 
		 }
	}
	//users requests
	public function changeReChefStatus(){
	   if ($this->request->isAJAX()) {
        $id = service('request')->getPost('id');
        $status=service('request')->getPost('status');
		$data['status']=$status;
		$rq = new ChefModel();
		 $rq->updateReChefStatus($id,$data);
        }
	}
    public function listReChefs(){
		$rm = new ChefModel();
		$data['rechefs']=$rm->getAllReChefs();
		return view('admin/recommendation/listReChefs',$data);
	}
	public function addReChef(){
		
		$rm = new ChefModel();
		$data['recats']=$rm->getAllReChefCategories();
		
		$data['reusers']=$rm->getAllUsers();
		return view('admin/recommendation/addReChef',$data);
	}
	public function editReChef($id){
		
		$rm = new ChefModel();
		$data['recats']=$rm->getAllReChefCategories();
		$data['rechef']=$rm->getSingleReChef($id);
		$data['reusers']=$rm->getAllUsers();
		
		return view('admin/recommendation/editReChef',$data);
	}
	public function deleteReChef($id){
		$rm = new ChefModel();
		$rm->deleteReChef($id);
	}
	public function viewReChef($id){
		$rm = new ChefModel();
		$data['rechef']=$rm->getSingleReChef($id);
		return view('admin/recommendation/viewReChef',$data);
	}
	public function insertReChef(){
		
		$session = session();
		$post_image_db_data='';
		$post_image = $this->request->getFile('image');
		
		$post_image_name = $post_image->getName();
		if($post_image_name!=''){
			$post_image_name=time().$post_image_name;
			$post_image->move(ROOTPATH.'public/uploads/recommendation/chef/',$post_image_name);
			$post_image_db_data='public/uploads/recommendation/chef/'.$post_image_name;
		}
		
		$post_galleryimage_db_data=rtrim($post_galleryimage_db_data,",");
		$data=[
		'chef_category_id'=>$this->request->getPost('chef_category_id'),
		'name'=>$this->request->getPost('name'),
	    'email'=>$this->request->getPost('email'),
		'address'=>$this->request->getPost('address'),
		'location'=>$this->request->getPost('location'),
		'image'=>$post_image_db_data,
		'rating'=>$this->request->getPost('rating'),
		'contact_no'=>$this->request->getPost('contact_no'),
		'created_at'=>date('Y-m-d H:i'),
		'updated_at'=>date('Y-m-d H:i')
		]; 
		 $rm = new ChefModel();
		 $result=$rm->insertReChef($data);
		 if($result['status']==1){
		 return redirect()->to('admin/recommendation/chefs');
		 }else{
		  return redirect()->to('admin/recommendation/add-chef');	 
		 }
	}
	public function updateReChef(){
		$session = session();
		$id=$this->request->getPost('id');
		$post_image_db_data='';
		$post_image = $this->request->getFile('image');
		$data['image']='';
		
		$post_image_name = $post_image->getName();
		if($post_image_name!=''){
			$post_image_name=time().$post_image_name;
			$post_image->move(ROOTPATH.'public/uploads/recommendation/chef/',$post_image_name);
			$post_image_db_data='public/uploads/recommendation/chef/'.$post_image_name;
			$data['image']=$post_image_db_data;
		}
		
		
		$data['chef_category_id']=$this->request->getPost('chef_category_id');
		$data['name']=$this->request->getPost('name');
		$data['email']=$this->request->getPost('email');
		$data['address']=$this->request->getPost('address');
		$data['location']=$this->request->getPost('location');
		$data['rating']=$this->request->getPost('rating');
		$data['contact_no']=$this->request->getPost('contact_no');
		$data['updated_at']=date('Y-m-d H:i');
		$rm = new ChefModel();
		$result=$rm->updateReChef($id,$data);
		
		if($result['status']==1){
		 return redirect()->to('admin/recommendation/chefs');
		 }else{
		  $session->setFlashdata('msg', 'User name already taken Please try other name');
		
		  return redirect()->to('admin/recommendation/edit-chef/'.$id);	 
		 }
	}

    
	
}
