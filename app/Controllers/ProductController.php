<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\AdminModel;
use App\Models\ProductModel;
class ProductController extends BaseController
{
	public function index()
	{

	}
	public function listReProductCategory(){
		$rm = new ProductModel();
		$data['recats']=$rm->getAllReProductCategories();
		return view('admin/recommendation/listReProductCategory',$data);
	}
	public function addReProductCategory(){
		
		return view('admin/recommendation/addReProductCategory');
	}
	public function editReProductCategory($id){
		
		$rm = new ProductModel();
		$data['recats']=$rm->getSingleReProductCategory($id);
		return view('admin/recommendation/editReProductCategory',$data);
	}
	public function deleteReProductCategory($id){
		$rm = new ProductModel();
		$rm->deleteReProductCategory($id);
	}
	public function insertReProductCategory(){
		
		$session = session();
		
		$data=[
		'name'=>$this->request->getPost('category_name'),
		'created_at'=>date('Y-m-d H:i'),
		'updated_at'=>date('Y-m-d H:i'),
		'status'=>1
		]; 
		 $rm = new ProductModel();
		 $result=$rm->insertReProductCategory($data);
		 if($result['status']==1){
		 return redirect()->to('admin/recommendation/product-category');
		 }else{
		  $session->setFlashdata('msg', 'Category name already taken Please try other name');
		  $session->setFlashdata('rc_name', $this->request->getPost('category_name'));
		  return redirect()->to('admin/recommendation/add-product-category');	 
		 }
	}
	public function updateReProductCategory(){
		$session = session();
		$id=$this->request->getPost('id');
		$data['name']=$this->request->getPost('category_name');
		$data['status']=1;
		$data['updated_at']=date('Y-m-d H:i');
		$rm = new ProductModel();
		$result=$rm->updateReProductCategory($id,$data);
		if($result['status']==1){
		 return redirect()->to('admin/recommendation/product-category');
		 }else{
		  $session->setFlashdata('msg', 'Category name already taken Please try other name');
		  $session->setFlashdata('rc_name', $this->request->getPost('category_name'));
		  return redirect()->to('admin/recommendation/edit-product-category/'.$id);	 
		 }
	}
	//users requests
	public function changeReProductStatus(){
	   if ($this->request->isAJAX()) {
        $id = service('request')->getPost('id');
        $status=service('request')->getPost('status');
		$data['status']=$status;
		$rq = new ProductModel();
		 $rq->updateReProductStatus($id,$data);
        }
	}
    public function listReProducts(){
		$rm = new ProductModel();
//		$data['reproducts']=$rm->getAllReProducts();
		$data['reproducts']=$rm->getAllPost();
		return view('admin/recommendation/listReProducts',$data);
	}
	public function addReProduct(){
		
		$rm = new ProductModel();
		$data['recats']=$rm->getAllReProductCategories();
		
		$data['reusers']=$rm->getAllUsers();
		return view('admin/recommendation/addReProduct',$data);
	}
	public function editReProduct($id){
		
		$rm = new ProductModel();
		$data['recats']=$rm->getAllReProductCategories();
		$data['reproduct']=$rm->getSingleReProduct($id);
		$data['reusers']=$rm->getAllUsers();
		
		return view('admin/recommendation/editReProduct',$data);
	}
	public function deleteReProduct($id){
		$rm = new ProductModel();
		$rm->deleteReProduct($id);
	}
	public function viewReProduct($id){
		$rm = new ProductModel();
		$data['reproduct']=$rm->getSingleReProduct($id);
		return view('admin/recommendation/viewReProduct',$data);
	}
	public function insertReProduct(){
		
		$session = session();
		$post_image_db_data='';
		$post_image = $this->request->getFile('image');
		
		$post_image_name = $post_image->getName();
		if($post_image_name!=''){
			$post_image_name=time().$post_image_name;
			$post_image->move(ROOTPATH.'public/uploads/recommendation/product/',$post_image_name);
			$post_image_db_data='public/uploads/recommendation/product/'.$post_image_name;
		}
		$post_galleryimage_db_data='';
		
		if($this->request->getFileMultiple('galleryimage')){
			 foreach($this->request->getFileMultiple('galleryimage') as $file)
             { 
			 if($file->getClientName()!=''){
			 $post_galleryimage_name=$file->getClientName();
			 $post_galleryimage_name=time().$post_galleryimage_name;
			 $file->move(ROOTPATH.'public/uploads/recommendation/product/',$post_galleryimage_name);
			 
			 $post_galleryimage_db_data.='public/uploads/recommendation/product/'.$post_galleryimage_name.",";
			 }
			 }
		}
		$post_galleryimage_db_data=rtrim($post_galleryimage_db_data,",");
		$data=[
		'product_category_id'=>$this->request->getPost('product_category_id'),
		'title'=>$this->request->getPost('title'),
	    'content'=>$this->request->getPost('content'),
		'image'=>$post_image_db_data,
		'location'=>$this->request->getPost('location'),
		'posted_by'=>0,
		'product_link'=>$this->request->getPost('product_link'),
		'price'=>$this->request->getPost('price'),
		'rating'=>$this->request->getPost('rating'),
		'mobile_no'=>$this->request->getPost('mobile_no'),
		'website_link'=>$this->request->getPost('website_link'),
		'galleryimage'=>$post_galleryimage_db_data,
		'created_at'=>date('Y-m-d H:i'),
		'updated_at'=>date('Y-m-d H:i'),
		'status'=>0
		]; 
		 $rm = new ProductModel();
		 $result=$rm->insertReProduct($data);
		 if($result['status']==1){
		 return redirect()->to('admin/recommendation/products');
		 }else{
		  return redirect()->to('admin/recommendation/add-product');	 
		 }
	}
	public function updateReProduct(){
		$session = session();
		$id=$this->request->getPost('id');
		$post_image_db_data='';
		$post_image = $this->request->getFile('image');
		$data['image']='';
		
		$post_image_name = $post_image->getName();
		if($post_image_name!=''){
			$post_image_name=time().$post_image_name;
			$post_image->move(ROOTPATH.'public/uploads/recommendation/product/',$post_image_name);
			$post_image_db_data='public/uploads/recommendation/product/'.$post_image_name;
			$data['image']=$post_image_db_data;
		}
		$data['galleryimage']='';
		$post_galleryimage_db_data='';
		
		if($this->request->getFileMultiple('galleryimage')){
			 foreach($this->request->getFileMultiple('galleryimage') as $file)
             { 
			 if($file->getClientName()!=''){
			 $post_galleryimage_name=$file->getClientName();
			 $post_galleryimage_name=time().$post_galleryimage_name;
			 $file->move(ROOTPATH.'public/uploads/recommendation/product/',$post_galleryimage_name);
			 
			 $post_galleryimage_db_data.='public/uploads/recommendation/product/'.$post_galleryimage_name.",";
			 }
			 }
			 $post_galleryimage_db_data=rtrim($post_galleryimage_db_data,",");
			 $data['galleryimage']=$post_galleryimage_db_data;
		}
		
		$data['product_category_id']=$this->request->getPost('product_category_id');
		$data['title']=$this->request->getPost('title');
		$data['content']=$this->request->getPost('content');
		$data['location']=$this->request->getPost('location');
		//$data['posted_by']=$this->request->getPost('posted_by');
		$data['posted_by']=0;
		$data['product_link']=$this->request->getPost('product_link');
		$data['price']=$this->request->getPost('price');
		$data['rating']=$this->request->getPost('rating');
		$data['mobile_no']=$this->request->getPost('mobile_no');
		$data['website_link']=$this->request->getPost('website_link');
		$data['updated_at']=date('Y-m-d H:i');
		$rm = new ProductModel();
		$result=$rm->updateReProduct($id,$data);
		
		if($result['status']==1){
		 return redirect()->to('admin/recommendation/products');
		 }else{
		  $session->setFlashdata('msg', 'User name already taken Please try other name');
		
		  return redirect()->to('admin/recommendation/edit-product/'.$id);	 
		 }
	}

    
	
}
