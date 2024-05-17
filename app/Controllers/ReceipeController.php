<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\BlogModel;
use App\Models\UserChatModel;
use App\Models\VeganPostModel;
use App\Models\EventModel;
use App\Models\RecommendationModel;
use App\Models\NewsModel;
use App\Models\ReceipeModel;
use App\Models\PostModel;
use App\Models\CooksModel;
use App\Models\ProductModel;
use App\Models\RestaurantsModel;
class ReceipeController extends BaseController
{
	public function index()
	{

	}
	public function listReceipeCategory(){
		$categories = new ReceipeModel();
		$data['categories']=$categories->getAllReceipeCategory();
//        echo json_encode($data['categories']);die();
		return view('admin/receipe/listReceipeCategory',$data);
	}
	public function addReceipeCategory(){
		return view('admin/receipe/addReceipeCategory');
	}
	public function editReceipeCategory($id){
		$categories = new ReceipeModel();
		$data['categories']=$categories->getSingleReceipeCategory($id);
		return view('admin/receipe/editReceipeCategory',$data);
	}
	public function deleteReceipeCategory($id){
		$categories = new ReceipeModel();
		$categories->deleteReceipeCategory($id);
	}
	public function user_recipe_accept_request($id){
		$categories = new ReceipeModel();
		$categories->userRecipeAcceptRequest($id);
	}
	public function user_recipe_decline_request($id){
		$categories = new ReceipeModel();
		$categories->userRecipeDeclineRequest($id);
	}
	public function user_recipe_delete_request($id){
		$categories = new ReceipeModel();
		$categories->userRecipeDeleteRequest($id);
	}
	public function insertReceipeCategory(){
		
		$data=[
		'name'=>$this->request->getPost('category_name'),
		'created_at'=>date('Y-m-d H:i'),
		'updated_at'=>date('Y-m-d H:i'),
		'status'=>1
		]; 
		 $categories = new ReceipeModel();
		 $categories->insertReceipeCategory($data);
		 return redirect()->to('admin/receipe/categories');
	}
	public function updateReceipeCategory(){
		
		$id=$this->request->getPost('id');
		$data['name']=$this->request->getPost('category_name');
		$data['status']=1;
		$data['updated_at']=date('Y-m-d H:i');
		
		$categories = new ReceipeModel();
		$categories->updateReceipeCategory($id,$data);
		return redirect()->to('admin/receipe/categories');
	}
	//receipes functions
	public function listReceipes(){
		$receipes = new ReceipeModel();
		$data['receipes']=$receipes->getAllReceipe();
		return view('admin/receipe/listReceipes',$data);
	}
	public function addReceipe(){
		$categories = new ReceipeModel();
		$data['categories']=$categories->getAllReceipeCategory();
		return view('admin/receipe/addReceipe',$data);
	}
	public function editReceipe($id){
 	    $blog = new ReceipeModel();
		$data['categories']=$blog->getAllReceipeCategory();
		$data['receipes']=$blog->getSingleReceipe($id);
		return view('admin/receipe/editReceipe',$data);	
	}
	public function viewReceipe($id){
		$blog = new ReceipeModel();
		$data['categories']=$blog->getAllReceipeCategory();
		$data['receipes']=$blog->getSingleReceipe($id);
		return view('admin/receipe/viewReceipe',$data);
	}
	public function deleteReceipe($id){
		$receipes = new ReceipeModel();
//        Khalid
//		$receipes->deleteReceipe($id);
		$receipes->deleteReceipeUser($id);
	}
	public function insertReceipe(){
		$receipe_image_db_data='';
		$receipe_image = $this->request->getFile('image');
		
		$receipe_image_name = $receipe_image->getName();
		if($receipe_image_name!=''){
			$receipe_image_name=time().$receipe_image_name;
			$receipe_image->move(ROOTPATH.'public/uploads/receipe/',$receipe_image_name);
			$receipe_image_db_data='public/uploads/receipe/'.$receipe_image_name;
		}
		$data=[
		'receipe_category_id'=>$this->request->getPost('receipe_category_id'),
		'title'=>$this->request->getPost('title'),
		'content'=>$this->request->getPost('content'),
		'image'=>$receipe_image_db_data,
		'created_at'=>date('Y-m-d H:i'),
		'updated_at'=>date('Y-m-d H:i'),
		'location'=>$this->request->getPost('location'),
		'status'=>1
		]; 
		 $categories = new ReceipeModel();
		 $categories->insertReceipe($data);
		/*  print_r($categories->getLastQuery());
		 die; */
		 return redirect()->to('admin/receipe/list');
	}
	public function updateReceipe(){
		$receipe_image_db_data='';
		$receipe_image = $this->request->getFile('image');
		$data['image']='';
		
		$receipe_image_name = $receipe_image->getName();
		if($receipe_image_name!=''){
			$receipe_image_name=time().$receipe_image_name;
			$receipe_image->move(ROOTPATH.'public/uploads/receipe/',$receipe_image_name);
			$receipe_image_db_data='public/uploads/receipe/'.$receipe_image_name;
			$data['image']=$receipe_image_db_data;
		}
		$id=$this->request->getPost('id');
		$data['receipe_category_id']=$this->request->getPost('post_category_id');
		$data['title']=$this->request->getPost('title');
		$data['content']=$this->request->getPost('content');
		$data['location']=$this->request->getPost('location');
		$data['status']=1;
		$data['updated_at']=date('Y-m-d H:i');
		$receipes = new ReceipeModel();
		$receipes->updateReceipe($id,$data);
		return redirect()->to('admin/receipe/list');
	}
	public function manageReceipeComment($id){
		$blog = new ReceipeModel();
		$data['categories']=$blog->getSingleReceipeCategory($id);
		$data['receipes']=$blog->getSingleReceipe($id);
		$data['comments']=$blog->getPostComment($id);
		return view('admin/receipe/manageReceipeComment',$data);
	}
	public function insertReceipeComment(){
		$id=$this->request->getPost('receipe_id');
		$data=[
		'receipe_id'=>$this->request->getPost('receipe_id'),
		'commented_by'=>0,
		'message'=>$this->request->getPost('message'),
		'created_at'=>date('Y-m-d H:i:s'),
		'status'=>1
		]; 
		 $blog = new ReceipeModel();
		 $blog->insertReceipeComment($data); 
		 return redirect()->to('admin/receipe/manage-comments/'.$id);
		
	}
	//all recipe for users
	
	 public function user_recipe_list(){
		$session = session();
        $data['public_url']=base_url()."/public/frontend/";
		$data['baseurl']=base_url()."/";
		$users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$vegan= new PostModel();
		$data['vaganpost'] =$vegan->getVeganPost($session->get('idUserH'));
		$data['session'] =$session;
		$events = new EventModel();
        $data['event_latest']=$events->getLatestEventByUser($session->get('idUserH'));
		$data['event_comment']=$events->getEventComment();
		$data['events']=$events->getTopFiveEventByUser($session->get('idUserH'));
     	$rm = new RecommendationModel();
		$data['recats']=$rm->getAllReRequestsByUser();
		$news= new NewsModel();
		$data['newsall']=$news->getAllPostByUser();
        $users = new UserModel();
		$data['users']=$users->getSingleUser($session->get('idUserH'));
        $data['loginusers']=$users->getSingleUser($session->get('idUserH'));
		$data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
		$data['birthday']=$users->getUserFriendBirthday($session->get('idUserH'));
		$receipe=new ReceipeModel();
		$data['receipeall']=$receipe->user_recipe_list($session->get('idUserH'));
		$data['receipe_category']=$receipe->getAllReceipeCategory();
//		$data['receipe_category']=$receipe->user_recipe_category();
		$data['receipe_category_topic']=$receipe->user_recipe_category_topic();
//        echo json_encode($data['receipeall']);die();
		
		return view('user/recipe/user_recipe_list',$data);
	}


		 public function user_recipe_details($id){
		$session = session();
        $data['public_url']=base_url()."/public/frontend/";
		$data['baseurl']=base_url()."/";
		$users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$vegan= new PostModel();
		$data['vaganpost'] =$vegan->getVeganPost($session->get('idUserH'));
		$data['session'] =$session;
		$events = new EventModel();
        $data['event_latest']=$events->getLatestEventByUser($session->get('idUserH'));
		$data['event_comment']=$events->getEventComment();
		$data['events']=$events->getTopFiveEventByUser($session->get('idUserH'));
     	$rm = new RecommendationModel();
		$data['recats']=$rm->getAllReRequestsByUser();
		$news= new NewsModel();
		$data['newsall']=$news->getAllPostByUser();
        $users = new UserModel();
		$data['users']=$users->getSingleUser($session->get('idUserH'));
        $data['loginusers']=$users->getSingleUser($session->get('idUserH'));
		$data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
		$data['birthday']=$users->getUserFriendBirthday($session->get('idUserH'));
		$receipe=new ReceipeModel();
		$data['receipe_detail']=$receipe->user_recipe_single($id);
		$data['receipeall']=$receipe->user_recipe_list($session->get('idUserH'));
		$data['receipe_category']=$receipe->user_recipe_category();
		$data['receipe_category_topic']=$receipe->user_recipe_category_topic();

		$data['receipe_comment']=$receipe->user_recipe_comment($id);
		$data['receipe_comment_all']=$receipe->user_recipe_comment_all($id);
		
		return view('user/recipe/user_recipe_detail',$data);
	}


	 public function recipe_details($id){
		$session = session();
        $data['public_url']=base_url()."/public/frontend/";
		$data['baseurl']=base_url()."/";
		$users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$vegan= new PostModel();
		$data['vaganpost'] =$vegan->getVeganPost($session->get('idUserH'));
		$data['session'] =$session;
		$events = new EventModel();
        $data['event_latest']=$events->getLatestEventByUser($session->get('idUserH'));
		$data['event_comment']=$events->getEventComment();
		$data['events']=$events->getTopFiveEventByUser($session->get('idUserH'));
     	$rm = new RecommendationModel();
		$data['recats']=$rm->getAllReRequestsByUser();
		$news= new NewsModel();
		$data['newsall']=$news->getAllPostByUser();
        $users = new UserModel();
		$data['users']=$users->getSingleUser($session->get('idUserH'));
        $data['loginusers']=$users->getSingleUser($session->get('idUserH'));
		$data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
		$data['birthday']=$users->getUserFriendBirthday($session->get('idUserH'));
		$receipe=new ReceipeModel();
		$data['receipe_detail']=$receipe->recipe_single($id);
		$data['receipeall']=$receipe->user_recipe_list($session->get('idUserH'));
		$data['receipe_category']=$receipe->user_recipe_category();
		$data['receipe_category_topic']=$receipe->user_recipe_category_topic();

		$data['receipe_comment']=$receipe->recipe_comment($id);
		$data['receipe_comment_all']=$receipe->recipe_comment_all($id);
		
		return view('user/recipe/recipe_detail',$data);
	}

   public function user_recipe_details_popup($id){
		$session = session();
        $data['public_url']=base_url()."/public/frontend/";
		$data['baseurl']=base_url()."/";
		$users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$vegan= new PostModel();
		$data['vaganpost'] =$vegan->getVeganPost($session->get('idUserH'));
		$data['session'] =$session;
		$events = new EventModel();
        $data['event_latest']=$events->getLatestEventByUser($session->get('idUserH'));
		$data['event_comment']=$events->getEventComment();
		$data['events']=$events->getTopFiveEventByUser($session->get('idUserH'));
     	$rm = new RecommendationModel();
		$data['recats']=$rm->getAllReRequestsByUser();
		$news= new NewsModel();
		$data['newsall']=$news->getAllPostByUser();
        $users = new UserModel();
		$data['users']=$users->getSingleUser($session->get('idUserH'));
        $data['loginusers']=$users->getSingleUser($session->get('idUserH'));
		$data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
		$data['birthday']=$users->getUserFriendBirthday($session->get('idUserH'));
		$receipe=new ReceipeModel();
		$data['receipe_detail']=$receipe->user_recipe_single($id);
		$data['receipeall']=$receipe->user_recipe_list($session->get('idUserH'));
		$data['receipe_category']=$receipe->user_recipe_category();
		$data['receipe_category_topic']=$receipe->user_recipe_category_topic();

		$data['receipe_comment']=$receipe->user_recipe_comment($id);
		$data['receipe_comment_all']=$receipe->user_recipe_comment_all($id);
		
		return view('user/recipe/recipe_detail_popup',$data);
	}
	public function user_recipe_list_by_category($categoryId){
		$session = session();
        $data['public_url']=base_url()."/public/frontend/";
		$data['baseurl']=base_url()."/";
		$users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$vegan= new PostModel();
		$data['vaganpost'] =$vegan->getVeganPost($session->get('idUserH'));
		$data['session'] =$session;
		$events = new EventModel();
        $data['event_latest']=$events->getLatestEventByUser($session->get('idUserH'));
		$data['event_comment']=$events->getEventComment();
		$data['events']=$events->getTopFiveEventByUser($session->get('idUserH'));
     	$rm = new RecommendationModel();
		$data['recats']=$rm->getAllReRequestsByUser();
		$news= new NewsModel();
		$data['newsall']=$news->getAllPostByUser();
        $users = new UserModel();
		$data['users']=$users->getSingleUser($session->get('idUserH'));
        $data['loginusers']=$users->getSingleUser($session->get('idUserH'));
		$data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
		$data['birthday']=$users->getUserFriendBirthday($session->get('idUserH'));
		$receipe=new ReceipeModel();
		$data['receipeall']=$receipe->user_recipe_list_by_category($session->get('idUserH'),$categoryId);
		$data['receipe_category']=$receipe->user_recipe_category();
		$data['receipe_category_topic']=$receipe->user_recipe_category_topic();
		
		
		return view('user/recipe/user_recipe_list',$data);
	}
	public function user_recipe_insert(){
		$session = session();
		
		$post_image_db_data='';
		$post_image = $this->request->getFile('image');
		$post_image_name = $post_image->getName();
		if($post_image_name!=''){
			$post_image_name=time().$post_image_name;
			$post_image->move(ROOTPATH.'public/uploads/receipe/post/',$post_image_name);
			$post_image_db_data='public/uploads/receipe/post/'.$post_image_name;
		}

		$post_galleryimage_db_data='';
		
		if($this->request->getFileMultiple('galleryimage')){
			 foreach($this->request->getFileMultiple('galleryimage') as $file)
             { 
			 if($file->getClientName()!=''){
			 $post_galleryimage_name=$file->getClientName();
			 $post_galleryimage_name=time().$post_galleryimage_name;
			 $file->move(ROOTPATH.'public/uploads/receipe/post/',$post_galleryimage_name);
			 
			 $post_galleryimage_db_data.='public/uploads/receipe/post/'.$post_galleryimage_name.",";
			 }
			 }
		}
		$post_galleryimage_db_data=rtrim($post_galleryimage_db_data,",");
		$post_videofile_db_data='';
		$post_video = $this->request->getFile('videofile');
		$post_video_name = $post_video->getName();
		if($post_video_name!=''){
			$post_video_name=time().$post_video_name;
			$post_video->move(ROOTPATH.'public/uploads/receipe/post/',$post_video_name);
			$post_videofile_db_data='public/uploads/receipe/post/'.$post_video_name;
		}
		$data=[
	    'receipe_category_id'=>$this->request->getPost('post_category_id'),
		'title'=>$this->request->getPost('title'),
		'content'=>$this->request->getPost('detail'),
		'image'=>$post_image_db_data,
		'video'=>$post_videofile_db_data,
		'moderate'=>0,
		'status'=>0,
		'created_at'=>date('Y-m-d H:i:s'),
		'updated_at'=>date('Y-m-d H:i:s'),
		'posted_by'=>$session->get('idUserH'),
		'location'=>$this->request->getPost('location'),
		'tags'=>$this->request->getPost('tags'),
		'steps'=>$this->request->getPost('steps'),
		'galleryimage'=>$post_galleryimage_db_data,
		'ingredients'=>$this->request->getPost('ingredients'),
		'cooking_time'=>$this->request->getPost('cooking_time'),
		]; 
		
	   $rm = new ReceipeModel();
		 $result=$rm->user_recipe_insert($data);
		 $session->setFlashdata('msgblog', 'Receipe Request Added Successfully');
		 $response='';
			if($result['status']==1){
			  $response = ['status' => 1 ,'msgblog' => '<span style="color:#090;">Receipe Request Added Successfully</span>' ];
			}else{
			  $response = ['status' => 0 ,'msgblog' => '<span style="color:#900;">sorry we re having some technical problems. please try again !</span>' 						];
			}
		
			 echo json_encode($response);
	}
	public function user_recipe_insert_comments(){
		$id=$this->request->getPost('post_id');
		$data=[
		'post_id'=>$this->request->getPost('post_id'),
		'commented_by'=>$this->request->getPost('commented_by'),
		'message'=>$this->request->getPost('message'),
		'created_at'=>date('Y-m-d H:i:s'),
		'status'=>1
		]; 
		 $blog = new ReceipeModel();
		 $id=$blog->user_recipe_insert_comments($data);
		 $data=$blog->user_recipe_comment_by_id($id);
		
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

		public function recipe_insert_comments(){
		$id=$this->request->getPost('post_id');
		$data=[
		'post_id'=>$this->request->getPost('post_id'),
		'commented_by'=>$this->request->getPost('commented_by'),
		'message'=>$this->request->getPost('message'),
		'created_at'=>date('Y-m-d H:i:s'),
		'status'=>1
		]; 
		 $blog = new ReceipeModel();
		 $id=$blog->recipe_insert_comments($data);
		 $data=$blog->recipe_comment_by_id($id);
		
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

	public function user_recipe_single($id){
	
		
		$session = session();
        $data['session'] =$session;
		$blogs= new ReceipeModel();
		$data=$blogs->user_recipe_single($id);
			$public_url=base_url()."/public/frontend/";
        $baseurl=base_url()."/";
		
		if(isset($data['posted_by'])){
		if($data['posted_by']==0){
			$posted_by='Admin';
		}else{
			$posted_by=$data['user_name'];
		}
		}
		
		$blogs_name=$data['title'];
		$location=$data['location'];
		$createddate=date('M d,Y h:i a',strtotime($data['created_at']));
		$details=$data['content'];
		$curr_time =$data['created_at'];
		$detail1=substr($data['content'],50,200);
		$detail2=substr($data['content'],200,400);
		$detail3=substr($data['content'],400,550);
		$detail4=substr($data['content'],550,800);
		$detail5=substr($data['content'],800,1200);
		if($data['galleryimage']!=''){
		$ex=explode(",",$data['galleryimage']);
         if(isset($ex[0])){
			$image_galary1=base_url().'/'.$ex[0]; 
		 }
		}
		
		$html='
		<div class="modal fade add_custom_field_pop" id="add_custom_blog" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered" role="document"><div class="modal-content modal-lg">
             <div class="modal-header">
			  
				<header class="common-post-header u-flex"> <img src="'.$baseurl.$data['user_profile'].'" class="user-image" alt="" width="40" height="40">
  <div class="common-post-info">
    <div class="user-and-group u-flex "> <a href="/user/public_profile/26">'.$posted_by.' </a> </div>
    <div class="username_time"> <a href="#"> '.$curr_time.' </a> </div>
  </div>
</header>
        <button type="button" class="close-video" data-dismiss="modal" aria-label="Close"> </button>
			  </div>
			  <div class="modal-body">
			    <div class="custom_fields_pop">
			     <div class="blog_ppup">
                   <div class="blog_images">
				   <h2 class="hidding_one_middel">'.$blogs_name.'</h2>
					<div class="blog_date">
					<ul>
					
					</ul>
					<p>'.$detail1.'</p>
				   ';
		            if($data['image']!=''){
					$image=base_url().'/'.$data['image'];
					$html.='<img src="'.$image.'">';
					 $html.='<h3> Location</h3>';
					  $html.='<spam>'.$location.'</spam>';
					}
		            $html.='</div>
					
					</div>
					
					<div class="blog_text">
					  <div class="row">
					    <div class="col-md-12">
						  <p>'.$detail2.'</p>
						</div>
						<div class="col-md-8">
						<p>'.$detail3.' </p>
						</div>
						<div class="col-md-4">
						<div class="blog_images">';
						if($data['galleryimage']!=''){
						$ex=explode(",",$data['galleryimage']);
						$image=base_url().'/'.$ex[0];	
						$html.='<img height="150" src="'.$image.'">';	
						}
						$html.='</div>
					  </div>
					</div>
					</div>';
					
					if($data['video']!=''){
						 $html.='<h3> Video</h3>';
					$videos=base_url().'/'.$data['video'];
					$html.='<div class="embed-responsive embed-responsive-16by9 col-xs-4 text-center">';
					  $html.='<video src="'.$videos.'" controls></video>';
					  $html.='</div>';
					}  
					$html.='<p>'.$detail4.'</p>';
					
			if($data['galleryimage']!=''){
			   $ex=explode(",",$data['galleryimage']);
				if(isset($ex[0])){
				  $image_galary1=base_url().'/'.$ex[0];
				  $html.='<h3> Image Gallery</h3>';
					$html.='<section class="slider-section">
					        <div id="owl-demo" class="owl-carousel  owl-theme">';
								foreach($ex as $val){
								  $image_galarys=base_url().'/'.$val;
								  $html.='<div class="item col-md-14"><img width="150" height="200" src="'.$image_galarys.'"></div>';
								}
					$html.='</div></div>';			
				}
			}
			
		$html.='<p>'.$detail5.'</p>';
		$html.='</div>';
		
		$da=$blogs->user_recipe_comment($id);
		$das=$blogs->user_recipe_comment_all($id);
		$html.='
		<div class="blog_comment">
		<div class="detailBox">
					 <div class="titleBox">
                        <label>Comments </label>';
		
		if(count($da)!=0){
			
			if(count($das)>2){
			$commentscount=count($das)-count($da);
			$html.='<button id="viewold" onclick="showoldercomments('.$id.')" class="viewoldcommetns">View Old '.$commentscount.' Commetns</button>';
			}
		}	
			$html.='</div>
			     <div class="actionBox">
                    <ul class="commentList">';
		if(count($da)!=0){			
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
		}
	   $html.='</ul>';
     
        $html.='
           
		    <form class="form-inline" role="form" method="post" id="recipecommentform" name="recipecommentform">
        <div class="form-group">
          <h2>LEAVE A REPLY </h2>
          <textarea id="messagecomments" name="message"  class="form-control comment_here" rows="5" cols="3" placeholder="Enter your comment here..."></textarea>
        </div>
        <div class="form-group">
		<input type="hidden" class="" id="commented_by" name="commented_by"  value="'.$session->get('idUserH').'" size="30" aria-required="true">
		<input type="hidden" class="" id="post_id" name="post_id"  value="'.$id.'" size="30" aria-required="true">
          <button class="post_comment" type="button" id="submitcomment"  onclick="submitrecipecomments()">Post Comment</button>
        </div>
      </form>
		   
    </div>
  </div>
</div>';
echo $html;	
	}
	public function user_recipe_old_comments(){
		$session = session();
        $data['session'] =$session;
		$blogs= new ReceipeModel();
		$id=$this->request->getPost('id');
		$html='';
		$da=$blogs->user_recipe_old_comments($id);
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
   public function user_recipe_request(){
	   $posts = new ReceipeModel();
	   $posts->updateReadStatus();
		$data['posts']=$posts->user_recipe_request();
		
		return view('admin/receipe/userRecipeRequest',$data);
   }
   public function approveRecipe($id){
	   $posts = new ReceipeModel();
		$posts->updateRecipeStatus($id);
		return redirect()->to('admin/recipe/user-recipe-request');
   }
}
