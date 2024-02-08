<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\AdminModel;
use App\Models\RecommendationModel;
class RecommendationController extends BaseController
{
	public function index()
	{

	}
	public function listReCategory(){
		$rm = new RecommendationModel();
		$data['recats']=$rm->getAllReCategories();
		return view('admin/recommendation/listReCategory',$data);
	}
	public function addReCategory(){
		
		return view('admin/recommendation/addReCategory');
	}
	public function editReCategory($id){
		
		$rm = new RecommendationModel();
		$data['recats']=$rm->getSingleReCategory($id);
		return view('admin/recommendation/editReCategory',$data);
	}
	public function deleteReCategory($id){
		$rm = new RecommendationModel();
		$rm->deleteReCategory($id);
	}
	public function insertReCategory(){
		
		$session = session();
		
		$data=[
		'name'=>$this->request->getPost('category_name'),
		'created_at'=>date('Y-m-d H:i'),
		'updated_at'=>date('Y-m-d H:i'),
		'status'=>1
		]; 
		 $rm = new RecommendationModel();
		 $result=$rm->insertReCategory($data);
		 if($result['status']==1){
		 return redirect()->to('admin/recommendation/category');
		 }else{
		  $session->setFlashdata('msg', 'Category name already taken Please try other name');
		  $session->setFlashdata('rc_name', $this->request->getPost('category_name'));
		  return redirect()->to('admin/recommendation/add-category');	 
		 }
	}
	public function updateReCategory(){
		$session = session();
		$id=$this->request->getPost('id');
		$data['name']=$this->request->getPost('category_name');
		$data['status']=1;
		$data['updated_at']=date('Y-m-d H:i');
		$rm = new RecommendationModel();
		$result=$rm->updateReCategory($id,$data);
		if($result['status']==1){
		 return redirect()->to('admin/recommendation/category');
		 }else{
		  $session->setFlashdata('msg', 'Category name already taken Please try other name');
		  $session->setFlashdata('rc_name', $this->request->getPost('category_name'));
		  return redirect()->to('admin/recommendation/edit-category/'.$id);	 
		 }
	}
	//users requests
	public function changeReRequestStatus(){
	   if ($this->request->isAJAX()) {
        $id = service('request')->getPost('id');
        $status=service('request')->getPost('status');
		$data['status']=$status;
		$rq = new RecommendationModel();
		 $rq->updateReRequestStatus($id,$data);
        }
	}
    public function listReRequests(){
		$rm = new RecommendationModel();
		$data['rerequests']=$rm->getAllReRequests();
		return view('admin/recommendation/listReRequests',$data);
	}
	public function addReRequest(){
		
		$rm = new RecommendationModel();
		$data['recats']=$rm->getAllReCategories();
		$data['replans']=$rm->getAllRePlans();
		$data['reusers']=$rm->getAllUsers();
		return view('admin/recommendation/addReRequest',$data);
	}
	public function editReRequest($id){
		
		$rm = new RecommendationModel();
		$data['recats']=$rm->getAllReCategories();
		$data['rerequest']=$rm->getSingleReRequest($id);
		$data['reusers']=$rm->getAllUsers();
		$data['replans']=$rm->getAllRePlans();
		return view('admin/recommendation/editReRequest',$data);
	}
	public function deleteReRequest($id){
		$rm = new RecommendationModel();
		$rm->deleteReRequest($id);
	}
	public function viewReRequest($id){
		$rm = new RecommendationModel();
		$data['rerequest']=$rm->getSingleReRequest($id);
		return view('admin/recommendation/viewReRequest',$data);
	}
	public function insertReRequest(){
		
		$session = session();
		$post_image_db_data='';
		$post_image = $this->request->getFile('image');
		
		$post_image_name = $post_image->getName();
		if($post_image_name!=''){
			$post_image_name=time().$post_image_name;
			$post_image->move(ROOTPATH.'public/uploads/recommendation/post/',$post_image_name);
			$post_image_db_data='public/uploads/recommendation/post/'.$post_image_name;
		}
		$data=[
		'category'=>$this->request->getPost('category'),
		'user_id'=>$this->request->getPost('user_id'),
	    'title'=>$this->request->getPost('title'),
		'image'=>$post_image_db_data,
		'url'=>$this->request->getPost('url'),
		'plan'=>$this->request->getPost('plan'),
		'location_where'=>$this->request->getPost('location_where'),
		'location_city'=>$this->request->getPost('location_city'),
		'date_from'=>$this->request->getPost('date_from'),
		'date_to'=>$this->request->getPost('date_to'),
		'description'=>$this->request->getPost('description'),
		'created_at'=>date('Y-m-d H:i'),
		'updated_at'=>date('Y-m-d H:i'),
		'status'=>0
		]; 
		 $rm = new RecommendationModel();
		 $result=$rm->insertReRequest($data);
		 if($result['status']==1){
		 return redirect()->to('admin/recommendation/requests');
		 }else{
		  return redirect()->to('admin/recommendation/add-request');	 
		 }
	}
	public function updateReRequest(){
		$session = session();
		$id=$this->request->getPost('id');
		$post_image_db_data='';
		$post_image = $this->request->getFile('image');
		$data['image']='';
		
		$post_image_name = $post_image->getName();
		if($post_image_name!=''){
			$post_image_name=time().$post_image_name;
			$post_image->move(ROOTPATH.'public/uploads/recommendation/post/',$post_image_name);
			$post_image_db_data='public/uploads/recommendation/post/'.$post_image_name;
			$data['image']=$post_image_db_data;
		}
		$data['category']=$this->request->getPost('category');
		$data['user_id']=$this->request->getPost('user_id');
		
		$data['title']=$this->request->getPost('title');
		$data['url']=$this->request->getPost('url');
		$data['plan']=$this->request->getPost('plan');
		$data['location_where']=$this->request->getPost('location_where');
		$data['location_city']=$this->request->getPost('location_city');
		$data['date_from']=$this->request->getPost('date_from');
		$data['date_to']=$this->request->getPost('date_to');
		$data['description']=$this->request->getPost('description');
		//$data['status']=1;
		$data['updated_at']=date('Y-m-d H:i');
		$rm = new RecommendationModel();
		$result=$rm->updateReRequest($id,$data);
		
		if($result['status']==1){
		 return redirect()->to('admin/recommendation/requests');
		 }else{
		  $session->setFlashdata('msg', 'User name already taken Please try other name');
		  //$session->setFlashdata('rc_name', $this->request->getPost('user_name'));
		  return redirect()->to('admin/recommendation/edit-request/'.$id);	 
		 }
	}
	//plans
    public function listRePlan(){
		$rm = new RecommendationModel();
		$data['replans']=$rm->getAllRePlans();
		return view('admin/recommendation/listRePlan',$data);
	}
	public function addRePlan(){
		
		$rm = new RecommendationModel();
		$data['replans']=$rm->getAllRePlans();
		return view('admin/recommendation/addRePlan',$data);
	}
	public function editRePlan($id){
		
		$rm = new RecommendationModel();
		
		$data['replans']=$rm->getSingleRePlan($id);
		$data['replan_time_slot']=$rm->getSingleRePlanTimeSlot($id);
		return view('admin/recommendation/editRePlan',$data);
	}
	public function deleteRePlan($id){
		$rm = new RecommendationModel();
		$rm->deleteRePlan($id);
	}
	public function viewRePlan($id){
		$rm = new RecommendationModel();
		
		$data['replans']=$rm->getSingleRePlan($id);
		return view('admin/recommendation/viewRePlan',$data);
	}
	public function insertRePlan(){
		
		$session = session();
		$post_image_db_data='';
		$post_image = $this->request->getFile('image');
		
		$post_image_name = $post_image->getName();
		if($post_image_name!=''){
			$post_image_name=time().$post_image_name;
			$post_image->move(ROOTPATH.'public/uploads/recommendation/plan/',$post_image_name);
			$post_image_db_data='public/uploads/recommendation/plan/'.$post_image_name;
		}
		$data=[
		'plan_name'=>$this->request->getPost('plan_name'),
		'title'=>$this->request->getPost('title'),
		'price'=>$this->request->getPost('price'),
		'description'=>$this->request->getPost('description'),
		'image'=>$post_image_db_data,
		'created_at'=>date('Y-m-d H:i'),
		'updated_at'=>date('Y-m-d H:i'),
		'status'=>1
		]; 
		 $rm = new RecommendationModel();
		$result=$rm->insertRePlan($data);
		$timefromarray=$this->request->getPost('time_from');
		$timetoarray=$this->request->getPost('time_to');
		
		 $i=0;
		 foreach($timefromarray as $val){
		      $data1[$i]['plan_id']=$result['inserID'];
		      $data1[$i]['time_from']=$timefromarray[$i];
		      $data1[$i]['time_to']=$timetoarray[$i];
			  
		 $i++;	 
		 }
		 
		 $results=$rm->insertRePlanF($data1);
		
		 if($result['status']==1){
		 return redirect()->to('admin/recommendation/plans');
		 }else{
		  $session->setFlashdata('msg', 'Plan name already taken Please try other name');
		  
		  return redirect()->to('admin/recommendation/add-plan');	 
		 }
	}
	public function updateRePlan(){
		$session = session();
		$id=$this->request->getPost('id');
		$post_image_db_data='';
		$post_image = $this->request->getFile('image');
		$data['image']='';
		
		$post_image_name = $post_image->getName();
		if($post_image_name!=''){
			$post_image_name=time().$post_image_name;
			$post_image->move(ROOTPATH.'public/uploads/recommendation/plan/',$post_image_name);
			$post_image_db_data='public/uploads/recommendation/plan/'.$post_image_name;
			$data['image']=$post_image_db_data;
		}
		$data['plan_name']=$this->request->getPost('plan_name');
		$data['title']=$this->request->getPost('title');
		$data['price']=$this->request->getPost('price');
		$data['description']=$this->request->getPost('description');
		$data['status']=1;
		$data['updated_at']=date('Y-m-d H:i');
		$rm = new RecommendationModel();
		$result=$rm->updateRePlan($id,$data);
		$timefromarray=$this->request->getPost('time_from');
		$timetoarray=$this->request->getPost('time_to');
		$i=0;
		 foreach($timefromarray as $val){
		      $data1[$i]['plan_id']=$id;
		      $data1[$i]['time_from']=$timefromarray[$i];
		      $data1[$i]['time_to']=$timetoarray[$i];
			  
		 $i++;	 
		 }
		 
		 $results=$rm->updateRePlanF($data1);
		if($result['status']==1){
		 return redirect()->to('admin/recommendation/plans');
		 }else{
		  $session->setFlashdata('msg', 'Plan name already taken Please try other name');
		  
		  return redirect()->to('admin/recommendation/edit-plan/'.$id);	 
		 }
	}
}
