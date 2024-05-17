<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\AdminModel;
use App\Models\EventModel;
class EventController extends BaseController
{
	public function index()
	{

	}
	public function listEventCategory(){
		$rm = new EventModel();
		$data['event_cats']=$rm->getAllEventCategories();
		return view('admin/event/listEventCategory',$data);
	}
	public function addEventCategory(){
		return view('admin/event/addEventCategory');
	}
	public function editEventCategory($id){
		
		$rm = new EventModel();
		$data['event_cats']=$rm->getSingleEventCategory($id);
		return view('admin/event/editEventCategory',$data);
	}
	public function deleteEventCategory($id){
		$rm = new EventModel();
		$rm->deleteEventCategory($id);
	}
	public function insertEventCategory(){
		
		$session = session();
		
		$data=[
		'name'=>$this->request->getPost('category_name'),
		'created_at'=>date('Y-m-d H:i'),
		'updated_at'=>date('Y-m-d H:i'),
		'status'=>1
		]; 
		 $rm = new EventModel();
		 $result=$rm->insertEventCategory($data);
		 if($result['status']==1){
		 return redirect()->to('admin/event/category');
		 }else{
		  $session->setFlashdata('msg', 'Category name already taken Please try other name');
		  $session->setFlashdata('event_category_name', $this->request->getPost('category_name'));
		  return redirect()->to('admin/event/add-category');	 
		 }
	}
	public function updateEventCategory(){
		$session = session();
		$id=$this->request->getPost('id');
		$data['name']=$this->request->getPost('category_name');
		$data['status']=1;
		$data['updated_at']=date('Y-m-d H:i');
		$rm = new EventModel();
		$result=$rm->updateEventCategory($id,$data);
		if($result['status']==1){
		 return redirect()->to('admin/event/category');
		 }else{
		  $session->setFlashdata('msg', 'Category name already taken Please try other name');
		  $session->setFlashdata('event_category_name', $this->request->getPost('category_name'));
		  return redirect()->to('admin/event/edit-category/'.$id);	 
		 }
	}
	//users requests
	public function changeEventStatus(){
	   if ($this->request->isAJAX()) {
        $id = service('request')->getPost('id');
        $status=service('request')->getPost('status');
		$data['status']=$status;
		$rq = new EventModel();
		 $rq->updateEventStatus($id,$data);
        }
	}
    public function listEvent(){
		$rm = new EventModel();
		$data['event_data']=$rm->getAllEvent();
		return view('admin/event/listEvent',$data);
	}

	public function requestEvent(){
		$rm = new EventModel();
		$rm->updateReadStatus();
		$data['event_data']=$rm->getEventRequest();
		return view('admin/event/event_request',$data);
	}

	public function addEvent(){
		$rm = new EventModel();
		$data['event_cats']=$rm->getAllEventCategories();
		$data['event_users']=$rm->getAllUsers();
		return view('admin/event/addEvent',$data);
	}
	public function editEvent($id){
		
		$rm = new EventModel();
		$data['event_cats']=$rm->getAllEventCategories();
		$data['event_data']=$rm->getSingleEvent($id);
		$data['event_users']=$rm->getAllUsers();
		return view('admin/event/editEvent',$data);
	}
	public function deleteEvent($id){
		$rm = new EventModel();
		$rm->deleteEvent($id);
        return redirect()->back();
	}
	public function declineEventRequest($id){
		$rm = new EventModel();
		$rm->declineEventRequest($id);
	}
	public function approveEventRequest($id){
		$rm = new EventModel();
		$rm->approveEventRequest($id);
        return redirect()->back();
	}
	public function viewEvent($id){
		$rm = new EventModel();
		$data['event_data']=$rm->getSingleEvent($id);
		return view('admin/event/viewEvent',$data);
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
		'posted_by'=>$this->request->getPost('posted_by'),
		'event_start_date'=>$this->request->getPost('event_start_date').' '.$this->request->getPost('event_start_time'),
		'event_end_date'=>$this->request->getPost('event_end_date').' '.$this->request->getPost('event_end_time'),
		'details'=>$this->request->getPost('details'),
		'image'=>$post_image_db_data,
		'video'=>$post_video_db_data,
	    
		]; 
		 $rm = new EventModel();
		 $result=$rm->insertEvent($data);
		 if($result['status']==1){
		 return redirect()->to('admin/event/list');
		 }else{
		  return redirect()->to('admin/event/add-event');	 
		 }
	}
	public function updateEvent(){
		$session = session();
		$id=$this->request->getPost('id');
		$post_image_db_data='';
		$post_image = $this->request->getFile('image');
		$data['image']='';
		$post_image_name = $post_image->getName();
		if($post_image_name!=''){
			$post_image_name=time().$post_image_name;
			$post_image->move(ROOTPATH.'public/uploads/event/post/',$post_image_name);
			$post_image_db_data='public/uploads/event/post/'.$post_image_name;
			$data['image']=$post_image_db_data;
		}
		$post_video_db_data='';
		$post_video = $this->request->getFile('video');
		/* $data['video']='';
		$post_video_name = $post_video->getName();
		if($post_video_name!=''){
			$post_video_name=time().$post_video_name;
			$post_video->move(ROOTPATH.'public/uploads/event/post/',$post_video_name);
			$post_video_db_data='public/uploads/event/post/'.$post_video_name;
			$data['video']=$post_video_db_data;
		} */
		$data['video']=$this->request->getPost('video');
		$data['category']=$this->request->getPost('category');
		$data['name']=$this->request->getPost('name');
		$data['location']=$this->request->getPost('location');
		$data['posted_by']=$this->request->getPost('posted_by');
		$data['event_start_date']=$this->request->getPost('event_start_date');
		$data['event_start_time']=$this->request->getPost('event_start_time');
		$data['event_end_date']=$this->request->getPost('event_end_date');
		$data['event_end_time']=$this->request->getPost('event_end_time');
		$data['details']=$this->request->getPost('details');
		
		//$data['status']=1;
		$data['updated_at']=date('Y-m-d H:i');
		$rm = new EventModel();
		$result=$rm->updateEvent($id,$data);
		
		
		
		if($result['status']==1){
		 return redirect()->to('admin/event/list');
		 }else{
		  return redirect()->to('admin/event/edit-event');	 
		 }
	}
	
    
	
}
