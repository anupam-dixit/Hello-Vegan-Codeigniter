<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\AdminModel;
use App\Models\RestaurantsModel;
class RestaurantController extends BaseController
{
	public function index()
	{

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
		 $rest = new RestaurantsModel();
		 $id=$rest->insertPostComment($data);
		 $data=$rest->getPostCommentByid($id);
		
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
		$rest= new RestaurantsModel();
		$id=$this->request->getPost('id');
		$html='';
		$da=$rest->getPostCommentOlder($id);
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




	public function listReCategory(){
		$rm = new RestaurantsModel();
		$data['recats']=$rm->getAllReCategories();
		return view('admin/recommendation/restaurant/listReCategory',$data);
	}
	public function addReCategory(){
		
		return view('admin/recommendation/restaurant/addReCategory');
	}
	public function editReCategory($id){
		
		$rm = new RestaurantsModel();
		$data['recats']=$rm->getSingleReCategory($id);
		return view('admin/recommendation/restaurant/editReCategory',$data);
	}
	public function deleteReCategory($id){
		$rm = new RestaurantsModel();
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
		 $rm = new RestaurantsModel();
		 $result=$rm->insertReCategory($data);
		 if($result['status']==1){
		 return redirect()->to('admin/recommendation/restaurant/category');
		 }else{
		  $session->setFlashdata('msg', 'Category name already taken Please try other name');
		  $session->setFlashdata('rc_name', $this->request->getPost('category_name'));
		  return redirect()->to('admin/recommendation/restaurant/add-category');	 
		 }
	}
	public function updateReCategory(){
		$session = session();
		$id=$this->request->getPost('id');
		$data['name']=$this->request->getPost('category_name');
		$data['status']=1;
		$data['updated_at']=date('Y-m-d H:i');
		$rm = new RestaurantsModel();
		$result=$rm->updateReCategory($id,$data);
		if($result['status']==1){
		 return redirect()->to('admin/recommendation/restaurant/category');
		 }else{
		  $session->setFlashdata('msg', 'Category name already taken Please try other name');
		  $session->setFlashdata('rc_name', $this->request->getPost('category_name'));
		  return redirect()->to('admin/recommendation/restaurant/edit-category/'.$id);	 
		 }
	}
	//users requests
	public function changeReRestaurantStatus(){
	   if ($this->request->isAJAX()) {
        $id = service('request')->getPost('id');
        $status=service('request')->getPost('status');
		$data['status']=$status;
		$rq = new RestaurantsModel();
		 $rq->updateReRestaurantStatus($id,$data);
        }
	}
    public function listReRestaurants(){
		$rm = new RestaurantsModel();
		$data['rerestaurants']=$rm->getAllRestaurants();
		return view('admin/recommendation/restaurant/listReRestaurants',$data);
	}
	public function addReRestaurant(){
		
		$rm = new RestaurantsModel();
		$data['recats']=$rm->getAllReCategories();
		$data['reusers']=$rm->getAllUsers();
		$data['refeatures']=$rm->getAllFeatures();
		return view('admin/recommendation/restaurant/addReRestaurant',$data);
	}
	public function editReRestaurant($id){
		
		$rm = new RestaurantsModel();
		$data['recats']=$rm->getAllReCategories();
		$data['rerestaurant']=$rm->getSingleReRestaurant($id);
		$data['reusers']=$rm->getAllUsers();
		$data['refeatures']=$rm->getAllFeatures();
		return view('admin/recommendation/restaurant/editReRestaurant',$data);
	}
	public function deleteReRestaurant($id){
		$rm = new RestaurantsModel();
		$rm->deleteReRestaurant($id);
	}
	public function viewReRestaurant($id){
		$rm = new RestaurantsModel();
		$data['rerestaurant']=$rm->getSingleReRestaurant($id);
		return view('admin/recommendation/restaurant/viewReRestaurant',$data);
	}
	public function insertReRestaurant(){
		
		$session = session();
		
		$post_menu_db_data='';
		$post_menu = $this->request->getFile('menu');
		
		$post_menu_name = $post_menu->getName();
		if($post_menu_name!=''){
			$post_menu_name=time().$post_menu_name;
			$post_menu->move(ROOTPATH.'public/uploads/recommendation/restaurant/',$post_menu_name);
			$post_menu_db_data='public/uploads/recommendation/restaurant/'.$post_menu_name;
		}
		$post_image_db_data='';
		$post_image = $this->request->getFile('image');
		
		$post_image_name = $post_image->getName();
		if($post_image_name!=''){
			$post_image_name=time().$post_image_name;
			$post_image->move(ROOTPATH.'public/uploads/recommendation/restaurant/',$post_image_name);
			$post_image_db_data='public/uploads/recommendation/restaurant/'.$post_image_name;
		}
		
		$post_gallary_db_data='';
		if($this->request->getFileMultiple('gallary')){
			 foreach($this->request->getFileMultiple('gallary') as $file)
             { 
			 if($file->getClientName()!=''){
			 $post_gallary_name=$file->getClientName();
			 $post_gallary_name=time().$post_gallary_name;
			 $file->move(ROOTPATH.'public/uploads/recommendation/restaurant/',$post_gallary_name);
			 
			 $post_gallary_db_data.='public/uploads/recommendation/restaurant/'.$post_gallary_name.",";
			 }
			 }
		}
		$post_gallary_db_data=rtrim($post_gallary_db_data,",");
		
		
		
		
		$data=[
		'category_id'=>$this->request->getPost('category_id'),
		'posted_by'=>0,
	    'name'=>$this->request->getPost('name'),
		'image'=>$post_image_db_data,
		'gallary'=>$post_gallary_db_data,
		'detail'=>$this->request->getPost('detail'),
		'address'=>$this->request->getPost('address'),
		'discount'=>$this->request->getPost('discount'),
		'rating'=>$this->request->getPost('rating'),
		'price'=>$this->request->getPost('price'),
		'opening_time'=>$this->request->getPost('opening_time'),
		'closing_time'=>$this->request->getPost('closing_time'),
		'menu'=>$post_menu_db_data,
		'location'=>$this->request->getPost('location'),
		'approx'=>$this->request->getPost('approx'),
		'features'=>implode(",",$this->request->getPost('features')),
		'contact_no'=>$this->request->getPost('contact_no'),
		'latitude'=>$this->request->getPost('latitude'),
		'longitude'=>$this->request->getPost('longitude'),
		'created_at'=>date('Y-m-d H:i'),
		'updated_at'=>date('Y-m-d H:i'),
		'status'=>1
		]; 
		 $rm = new RestaurantsModel();
		 $result=$rm->insertReRestaurant($data);
		 if($result['status']==1){
		 return redirect()->to('admin/recommendation/restaurants');
		 }else{
		  return redirect()->to('admin/recommendation/restaurant/add-restaurant');	 
		 }
	}
	public function updateReRestaurant(){
		
		
      
		
		$session = session();
		$id=$this->request->getPost('id');
		
		$data['menu']='';
		$post_menu_db_data='';
		$post_menu = $this->request->getFile('menu');
		$data['menu']=$post_menu_db_data;
		$post_menu_name = $post_menu->getName();
		if($post_menu_name!=''){
			$post_menu_name=time().$post_menu_name;
			$post_menu->move(ROOTPATH.'public/uploads/recommendation/restaurant/',$post_menu_name);
			$post_menu_db_data='public/uploads/recommendation/restaurant/'.$post_menu_name;
			$data['menu']=$post_menu_db_data;
		}
		
		$post_image_db_data='';
		$post_image = $this->request->getFile('image');
		$data['image']='';
		$post_image_name = $post_image->getName();
		if($post_image_name!=''){
			$post_image_name=time().$post_image_name;
			$post_image->move(ROOTPATH.'public/uploads/recommendation/restaurant/',$post_image_name);
			$post_image_db_data='public/uploads/recommendation/restaurant/'.$post_image_name;
			$data['image']=$post_image_db_data;
		}
		
		$post_galleryimage_db_data='';
		$data['gallary']='';
		if($this->request->getFileMultiple('galleryimage')){
			 foreach($this->request->getFileMultiple('galleryimage') as $file)
             { 
			 if($file->getClientName()!=''){
			 $post_galleryimage_name=$file->getClientName();
			 $post_galleryimage_name=time().$post_galleryimage_name;
			 $file->move(ROOTPATH.'public/uploads/recommendation/restaurant/',$post_galleryimage_name);
			 
			 $post_galleryimage_db_data.='public/uploads/recommendation/restaurant/'.$post_galleryimage_name.",";
			 }
			 }
			 $post_galleryimage_db_data=rtrim($post_galleryimage_db_data,",");
			 $data['gallary']=$post_galleryimage_db_data;
		}
		
		$data['category_id']=$this->request->getPost('category_id');
		$data['name']=$this->request->getPost('name');
		$data['detail']=$this->request->getPost('detail');
		$data['address']=$this->request->getPost('address');
		$data['discount']=$this->request->getPost('discount');
		$data['rating']=$this->request->getPost('rating');
		$data['price']=$this->request->getPost('price');
		$data['opening_time']=date('h:i A', strtotime($this->request->getPost('opening_time')));
		$data['closing_time']=date('h:i A', strtotime($this->request->getPost('closing_time')));
		$data['location']=$this->request->getPost('location');
		$data['approx']=$this->request->getPost('approx');
		$data['latitude']=$this->request->getPost('latitude');
		$data['longitude']=$this->request->getPost('longitude');
		if($this->request->getPost('features')!=null){
		$data['features']=implode(",",$this->request->getPost('features'));	
		}
		
		$data['contact_no']=$this->request->getPost('contact_no');
		
		//$data['status']=1;
		$data['updated_at']=date('Y-m-d H:i');
		$rm = new RestaurantsModel();
		
		$result=$rm->updateReRestaurant($id,$data);
		
		  return redirect()->to('admin/recommendation/restaurant/edit-restaurant/'.$id);	 
		
	}
	//RestaurantFeatures
	
	 public function listReRestaurantFeatures(){
		$rm = new RestaurantsModel();
		$data['refeatures']=$rm->getAllFeatures();
		return view('admin/recommendation/restaurant/listReRestaurantFeatures',$data);
	}
	public function addReRestaurantFeature(){
		
		$rm = new RestaurantsModel();
		$data['refeatures']=$rm->getAllFeatures();
		return view('admin/recommendation/restaurant/addReRestaurantFeature',$data);
	}
	public function editReRestaurantFeature($id){
		
		$rm = new RestaurantsModel();
		$data['refeatures']=$rm->getAllFeaturesEdit($id);
		return view('admin/recommendation/restaurant/editReRestaurantFeature',$data);
	}
	public function deleteReRestaurantFeature($id){
		$rm = new RestaurantsModel();
		$rm->deleteReRestaurantFeature($id);
	}
	public function insertReRestauranFeature(){
		$session = session();
		$post_image_db_data='';
		$post_image = $this->request->getFile('svgData');
		$post_image_name = $post_image->getName();
		if($post_image_name!=''){
			$post_image_name=time().$post_image_name;
			$post_image->move(ROOTPATH.'public/uploads/recommendation/restaurant/features/',$post_image_name);
			$post_image_db_data='public/uploads/recommendation/restaurant/features/'.$post_image_name;
		}
		$data=[
	    'name'=>$this->request->getPost('name'),
		'svgData'=>$post_image_db_data		
		]; 
		 $rm = new RestaurantsModel();
		 $result=$rm->insertReRestauranFeature($data);
		 if($result['status']==1){
		 return redirect()->to('admin/recommendation/restaurant/features');
		 }else{
		  return redirect()->to('admin/recommendation/restaurant/add-restaurant-feature');	 
		 }
	}
	public function updateReRestauranFeature(){
		
	
		
		$session = session();
		$id=$this->request->getPost('id');
		
		
		$post_image_db_data='';
		$post_image = $this->request->getFile('svgData');
		$data['svgData']='';
		$post_image_name = $post_image->getName();
		if($post_image_name!=''){
			$post_image_name=time().$post_image_name;
			$post_image->move(ROOTPATH.'public/uploads/recommendation/restaurant/features/',$post_image_name);
			$post_image_db_data='public/uploads/recommendation/restaurant/features/'.$post_image_name;
			$data['svgData']=$post_image_db_data;
		}
		
		$data['name']=$this->request->getPost('name');
		$rm = new RestaurantsModel();
		$result=$rm->updateReRestauranFeature($id,$data);
		return redirect()->to('admin/recommendation/restaurant/edit-restaurant-feature/'.$id);	 
		
	}
}
