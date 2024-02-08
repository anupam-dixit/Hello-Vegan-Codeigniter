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

class ApiCheckController extends BaseController
{
	public function sendForgotPasswordLink(){
		//send email
		$users = new UserModel();
		$emailId=$this->request->getVar('email');
		
		$data=$users->getSingleUserByEmail($emailId);
		$send=0;
		$vcode=0;
		if($data['vc']==0){
		 $datas["responce"] = true; 
         $datas['message']='This Email id is Not exists Please try another email';
         echo json_encode($datas);
		}else{
			if($data['verificationCode']==''){
			  $data['verificationCode']=time().rand(10,100);
			  $query=$users->where('email',$emailId)->set('verificationCode',$data['verificationCode'])->update();	
			}
			$send=1;
			$vcode=$data['verificationCode'];
		}
		if($send==1){
		$email = \Config\Services::email();
        $to=$this->request->getVar('email');
		$link="/user/reset-password?code=".$vcode;
        $email->setTo($to);
        $email->setFrom('info@projectstatus.co.in', 'Reset Password');
        $subject="Reset Password Link from hello vegans";
        $message='<table border="0" align="center" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;border:1px solid #FFA73B">
		          <tr>
				     <td bgcolor="#ffffff" align="center" valign="top" style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family:normal normal 600 40px/40px Open Sans; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;">
					    <h1 style="font-size: 48px; font-weight: 400; margin: 2;">Welcome!</h1> 
						<img src="/public/hello_vegans/commingsoon/images/logo.png" width="125" height="120" style="display: block; border: 0px;border: 0;height: auto;line-height: 100%;outline: none;text-decoration: none;" />
					</td>
				  </tr>
				  <tr>
				    <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 40px 30px; color: #666666; font-family: normal normal 600 40px/40px Open Sans; font-size: 18px; font-weight: 400; line-height: 25px;">
				    <p style="margin: 0;">To reset  your  Password. Just press the button below.</p>
				    </td>
				  </tr>
				  <tr>
				    <td bgcolor="#ffffff" align="left">
                     <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
						 <td bgcolor="#ffffff" align="center" style="padding: 20px 30px 60px 30px;">
						   <table border="0" cellspacing="0" cellpadding="0">
                              <tr>
							    <td align="center" style="border-radius: 3px;" bgcolor="#FFA73B"><a href="'.$link.'" target="_blank" style="font-size: 20px; font-family: normal normal 600 40px/40px Open Sans; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; padding: 15px 25px; border-radius: 2px; border: 1px solid #FFA73B; display: inline-block;">Reset Password</a>
								</td>   
							   </tr>
							</table>
						   </td>
						  </tr>
					   </table>
					</td>
				  </tr>
				  <tr>
					<td bgcolor="#ffffff" align="left" style="padding: 0px 30px 0px 30px; color: #666666; font-family:normal normal 600 40px/40px Open Sans; font-size: 18px; font-weight: 400; line-height: 25px;">
                      <p style="margin: 0;">If that does not work, copy and paste the following link in your browser:</p>
					</td>
				   </tr>
				  <tr>
				   <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 20px 30px; color: #666666; font-family:normal normal 600 40px/40px Open Sans, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
				    <p style="margin: 0;">
					 <a href="#" target="_blank" style="color: #FFA73B;">'.$link.'</a>
					</p>
				   </td>
				  </tr>
				</table>';
        $email->setSubject($subject);
        $email->setMessage($message);

        $email->send(); 
		$datas["responce"] = true; 
        $datas['message']='A reset password link has been sent to your email account';
        echo json_encode($datas);	
		}
		
	}
	public function checkUserEmail(){
		 header('Access-Control-Allow-Origin: *');
         header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
         header('Access-Control-Allow-Headers: token, Content-Type');
		 $users = new UserModel();
		$email=$this->request->getVar('email');
		$data=$users->getUserCountByEmail($email);
		$datas['count']=$data;
		echo json_encode($datas);
	}
	public function signup(){
         header('Access-Control-Allow-Origin: *');
         header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
         header('Access-Control-Allow-Headers: token, Content-Type');
         $users = new UserModel();
         $rand=time().rand(10,100);
         $email=$this->request->getVar('email');
		 $email_already=$users->getUserCountByEmail($email);
		 if($email_already==0){
			$data=$users->getUserCountByEmail($email);
		 $data=[
        'name'=>$this->request->getVar('name'),
        'last_name'=>$this->request->getVar('last_name'),
        'email'=>$this->request->getVar('email'),
        'country'=>$this->request->getVar('country'),
        'state'=>$this->request->getVar('state'),
        'mobile_no'=>$this->request->getVar('countrycode').'-'.$this->request->getVar('mobile_no'),
        'password'=>password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
        'status'=>0,
        'verificationCode'=>$rand,
        'created_at'=>date('Y-m-d H:i'),
        'updated_at'=>date('Y-m-d H:i')
        ]; 
        if($users->save($data)){
$email = \Config\Services::email();
        $to=$this->request->getVar('email');
		$link="/user/accountVerification?code=".$rand;
        $email->setTo($to);
        $email->setFrom('info@projectstatus.co.in', 'Confirm Registration');
        $subject="Account Verification from hello vegans";
        $message='<table border="0" align="center" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;border:1px solid #FFA73B">
		          <tr>
				     <td bgcolor="#ffffff" align="center" valign="top" style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family:normal normal 600 40px/40px Open Sans; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;">
					    <h1 style="font-size: 48px; font-weight: 400; margin: 2;">Welcome!</h1> 
						<img src="/public/hello_vegans/commingsoon/images/logo.png" width="125" height="120" style="display: block; border: 0px;border: 0;height: auto;line-height: 100%;outline: none;text-decoration: none;" />
					</td>
				  </tr>
				  <tr>
				    <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 40px 30px; color: #666666; font-family: normal normal 600 40px/40px Open Sans; font-size: 18px; font-weight: 400; line-height: 25px;">
				    <p style="margin: 0;">We are excited to have you get started. First, you need to confirm your account. Just press the button below.</p>
				    </td>
				  </tr>
				  <tr>
				    <td bgcolor="#ffffff" align="left">
                     <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
						 <td bgcolor="#ffffff" align="center" style="padding: 20px 30px 60px 30px;">
						   <table border="0" cellspacing="0" cellpadding="0">
                              <tr>
							    <td align="center" style="border-radius: 3px;" bgcolor="#FFA73B"><a href="'.$link.'" target="_blank" style="font-size: 20px; font-family: normal normal 600 40px/40px Open Sans; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; padding: 15px 25px; border-radius: 2px; border: 1px solid #FFA73B; display: inline-block;">Confirm Account</a>
								</td>   
							   </tr>
							</table>
						   </td>
						  </tr>
					   </table>
					</td>
				  </tr>
				  <tr>
					<td bgcolor="#ffffff" align="left" style="padding: 0px 30px 0px 30px; color: #666666; font-family:normal normal 600 40px/40px Open Sans; font-size: 18px; font-weight: 400; line-height: 25px;">
                      <p style="margin: 0;">If that does not work, copy and paste the following link in your browser:</p>
					</td>
				   </tr>
				  <tr>
				   <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 20px 30px; color: #666666; font-family:normal normal 600 40px/40px Open Sans, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
				    <p style="margin: 0;">
					 <a href="#" target="_blank" style="color: #FFA73B;">'.$link.'</a>
					</p>
				   </td>
				  </tr>
				</table>';
            $email->setSubject($subject);
            $email->setMessage($message);
            $email->send();		
              $result["status"] = "success"; 
             $result["responce"] = true; 
             $result["message"] = "User has been registerd successfully<br> A verification link has been sent to your email account";

       }else{
             $result["status"] = "fail"; 
             $result["responce"] = false; 

       }
		 }
		 else{
		   $result["status"] = "fail"; 
             $result["responce"] = false; 
             $result["message"] = "Email already exists";
	   } 
		
		 
        echo json_encode($result);
    }
    public function login(){
         header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
		
        $db = db_connect();
            $data = array(); 
            $_POST = $_REQUEST;   

        $users = new UserModel();

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');


                  $res = $users->where('email', $email)->first();

                   if($res){

                    $pass = $res['password'];
                   
                   
                     $checkStatus = $users->where('email', $email)->where('status',1)->first();
                    
                    
                    if ($checkStatus)
                    {
                        $authenticatePassword = password_verify($password, $pass);
                        if($authenticatePassword)
                        {


                            $data["responce"] = true;  
                              $data["data"] = array(
                                "id"=>$res['id'],
                                "name"=>$res['name'],
                                "last_name"=>$res['last_name'],
                                "dob"=>$res['dob'],
                                "city"=>$res['city'],
                                "pin_code"=>$res['pin_code'],
                                "state"=>$res['state'],
                                "country"=>$res['country'],
                                "address"=>$res['address'],
                                "description"=>$res['description'],
                                "profile_image"=>$res['profile_image'],
                                "cover_image"=>$res['cover_image'],
                                "email"=>$res['email'],
                                "status"=>$res['status'],
                                "location"=>$res['location'],
                                "mobile_no"=>$res['mobile_no'],
                                "verificationCode"=>$res['verificationCode']

                            ) ;
                               
                            
                        }
                       
                        else
                        {
                             $data["responce"] = false;  
                              $data["error"] = 'Invalide Username or Passwords';
                              
                               
                        }
                    }
                    else
                    {
                              $data["responce"] = false;  
                              
                              $data["error"] = 'Your account currently inactive.Please Contact Admin';
                    }
                }
                else{

                     $data["responce"] = false;  
                              $data["error"] = 'Email does not exist';


            
                   }
                   
                    
                
           echo json_encode($data);
            
    }
    public function dashboard(){
		 header('Access-Control-Allow-Origin: *');
		 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
		 header('Access-Control-Allow-Headers: token, Content-Type');
		 $post_vegan= new PostModel();
		 $data["responce"] = true; 
		 $limit=7;
		 $start=0;
		 if($this->request->getVar('limit')!=null){
			 $limit=$this->request->getVar('limit');
		 }
		 if($this->request->getVar('start')!=null){
			 $start=$this->request->getVar('start');
		 }
		 $user_id=$this->request->getVar('user_id');
		 $data['vaganpost'] =$post_vegan->getVeganPostLimit($user_id,$limit,$start);
		 $news= new NewsModel();
		 $data['news']=$news->news_dashboard_api();
		 $rm = new RecommendationModel();
		 $data['recommendations']=$rm->getAllReRequestsByUser();
		 $blog= new BlogModel();
		 $data['blogs']=$blog->getAllPostfor_dasbord($user_id);
		   echo json_encode($data);
    }
	public function dashboardDetailsById(){
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
		header('Access-Control-Allow-Headers: token, Content-Type');
		$id=$this->request->getVar('post_id');
		$post_vegan= new PostModel();
		$data['vaganpost_details']=$post_vegan->getSinglePostUser($id);
		$data['comment']=$post_vegan->getPostComment($id);
		echo json_encode($data);
	}
	public function dashboardInsertLike(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
  $data=[
        'post_id'=>$this->request->getVar('post_id'),
        'liked_by'=>$this->request->getVar('user_id'),
        'created_at'=>date('Y-m-d H:i:s'),
        'status'=>$this->request->getVar('status')
        ]; 

         $post = new PostModel();
         $post->insertPostLike($data);
     
         $result["responce"] = true; 
         $liked="Like";
		 if($this->request->getVar('status')==0){
	 	  $liked="UnLike";	 
		 }
		 $result["message"] = $liked.' Successfully!'; 
         echo json_encode($result);
    }
	public function dashboardInsertComment(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');

       $data=[
        'post_id'=>$this->request->getVar('post_id'),
        'commented_by'=>$this->request->getVar('user_id'),
        'message'=>$this->request->getVar('message'),
        'created_at'=>date('Y-m-d H:i:s'),
        'status'=>1
        ]; 
         $post = new PostModel();
         $getid=$post->insertPostComment($data);
         $datac=$post->getPostCommentByid($getid); 
         		 
         $result["responce"] = true; 
          $result["message"] = 'Data been inserted successfully'; 
          $result["insertcommetdata"] = $datac; 
        echo json_encode($result);
    }
	public function dashboardShowAllComment(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
        $id = $this->request->getVar('post_id');
        $post = new PostModel();
         $data["responce"] = true;
         $data['comment']=$post->getPostComment($id);
        echo json_encode($data);
    }
	public function dashboardShowLastTwoComment(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
        $id = $this->request->getVar('post_id');
        $post = new PostModel();
         $data["responce"] = true;
         $data['comment']=$post->getPostCommentUser($id);
         echo json_encode($data);
    }
    public function dashboardAddPost(){
		 header('Access-Control-Allow-Origin: *');
		 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
		 header('Access-Control-Allow-Headers: token, Content-Type');
         $post_image_db_data='';
        if($this->request->getFile('create_post_image')!=null){
		$post_image = $this->request->getFile('create_post_image');
        
        $post_image_name = $post_image->getName();
        if($post_image_name!=''){
            $post_image_name=time().$post_image_name;
            $post_image->move(ROOTPATH.'public/uploads/user/veganpost/',$post_image_name);
            $post_image_db_data='public/uploads/user/veganpost/'.$post_image_name;
        }	
		}
		
        $data=[
        'content'=>$this->request->getVar('create_post_content'),
        'image'=>$post_image_db_data,
        'created_at'=>date('Y-m-d H:i'),
        'updated_at'=>date('Y-m-d H:i'),
        'status'=>1,
        'posted_by'=>$this->request->getVar('user_id')
        ]; 
         
         $posts = new PostModel();
         $insertId=$posts->insertPost($data);
		 $datas=$posts->getSinglePostUser($insertId);
		
         $result["responce"] = true; 
         $result["message"] = 'Data been inserted successfully'; 
         $result["getPostdata"] = $datas; 
         echo json_encode($result);
    }
    public function dashboardDeletePost(){
		 header('Access-Control-Allow-Origin: *');
		 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
		 header('Access-Control-Allow-Headers: token, Content-Type');
		  $posts = new PostModel();
		  $id=$this->request->getVar('post_id');
		  $posts->deletePost($id);
		  $result["responce"] = true; 
          $result["message"] = 'Data been Deleted successfully'; 
          echo json_encode($result);
	}
//blog apis
	public function blog(){
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
    header('Access-Control-Allow-Headers: token, Content-Type');
	 $blog= new BlogModel();
     $data["responce"] = true; 
	 $id=1;
	 $limit=7;
	 $start=0;
	if($this->request->getVar('limit')!=null){
			 $limit=$this->request->getVar('limit');
	}
		 if($this->request->getVar('start')!=null){
			 $start=$this->request->getVar('start');
	}
     $data['blogs']=$blog->getAllPostByUserLimit($id,$start,$limit);
	 $data['blog_category']=$blog->getAllPostCategory();
     $rm = new RecommendationModel();
	 $data['recommendations']=$rm->getAllReRequestsByUser(); 
    	 
	 echo json_encode($data);
    }
	public function blogCategoryList(){
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
    header('Access-Control-Allow-Headers: token, Content-Type');
	 $blog= new BlogModel();
     $data["responce"] = true; 
	 
	 $data['blog_category']=$blog->getAllPostCategory();
     	 
	 echo json_encode($data);
    }
	public function blogByCategory(){
	header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
    header('Access-Control-Allow-Headers: token, Content-Type');
	 $blog= new BlogModel();
     $data["responce"] = true; 
	 $id=1;
	 $limit=7;
	 $start=0;
	if($this->request->getVar('limit')!=null){
			 $limit=$this->request->getVar('limit');
	}
		 if($this->request->getVar('start')!=null){
			 $start=$this->request->getVar('start');
	}
	$categoryId=$this->request->getVar('cat_id');
     
	 $data['blogs']=$blog->getAllBlogByCategoryLimit($categoryId,$start,$limit);
	 $data['blog_category']=$blog->getAllPostCategory();
     $rm = new RecommendationModel();
	 $data['recommendations']=$rm->getAllReRequestsByUser(); 
	  echo json_encode($data);
}
	public function blogDetailsById(){
	header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');

         $id = $this->request->getVar('post_id');
        $blog= new BlogModel();
         $data["responce"] = true; 
        $data['blog_details']=$blog->getSingleblogs($id);
		$data['blog_category']=$blog->getAllPostCategory();
        $data['comment']=$blog->getPostComment($id);
        echo json_encode($data);
}
	public function blogInsertComment(){
	header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
    header('Access-Control-Allow-Headers: token, Content-Type');
    
        $data=[
        'post_id'=>$this->request->getVar('post_id'),
        'commented_by'=>$this->request->getVar('user_id'),
        'message'=>$this->request->getVar('message'),
        'created_at'=>date('Y-m-d H:i:s'),
        'status'=>1
        ]; 
         $blog = new BlogModel();
         $getid=$blog->insertPostComment($data);
         $datac=$blog->getPostCommentByid($getid); 
         $result["responce"] = true; 
         $result["message"] = 'Data been inserted successfully'; 
         $result["insertcommetdata"] = $datac; 
         echo json_encode($result);
}
	public function blogShowAllComment(){
	header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
    header('Access-Control-Allow-Headers: token, Content-Type');
    $post_id = $this->request->getVar('post_id');
    $blog= new BlogModel();
     $data["responce"] = true; 
     $data['comment']=$blog->getPostComment($post_id);
     echo json_encode($data);
}
	public function blogShowLastTwoComment(){
	 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');

       $post_id = $this->request->getVar('post_id');

       $blog= new BlogModel();
         $data["responce"] = true; 
        $data['comment']=$blog->getPostCommentUser($post_id);

        echo json_encode($data);
}
	public function blogAdd(){
	header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
    header('Access-Control-Allow-Headers: token, Content-Type');

       $post_image_db_data='';
       $post_image = $this->request->getFile('image');
         if($post_image!=null){
			$post_image_name = $post_image->getName();
       
		if($post_image_name!=''){
            $post_image_name=time().$post_image_name;
            $post_image->move(ROOTPATH.'public/uploads/blog/post/',$post_image_name);
            $post_image_db_data='public/uploads/blog/post/'.$post_image_name;
        } 
		 }
		

        $post_galleryimage_db_data='';
        
        if($this->request->getFileMultiple('galleryimage')){
             foreach($this->request->getFileMultiple('galleryimage') as $file)
             { 
             if($file->getClientName()!=''){
             $post_galleryimage_name=$file->getClientName();
             $post_galleryimage_name=time().$post_galleryimage_name;
             $file->move(ROOTPATH.'public/uploads/blog/post/',$post_galleryimage_name);
             
             $post_galleryimage_db_data.='public/uploads/blog/post/'.$post_galleryimage_name.",";
             }
             }
        }
        $post_galleryimage_db_data=rtrim($post_galleryimage_db_data,",");
        $post_videofile_db_data='';
		$post_video = $this->request->getFile('videofile');
		if($post_video!=null){
			$post_video_name = $post_video->getName();
        if($post_video_name!=''){
            $post_video_name=time().$post_video_name;
            $post_video->move(ROOTPATH.'public/uploads/blog/post/',$post_video_name);
            $post_videofile_db_data='public/uploads/blog/post/'.$post_video_name;
        }
		}
        
        
        

        $data=[
       'post_category_id'=>$this->request->getVar('post_category_id'),
       'title'=>$this->request->getVar('title'),
        'tags'=>$this->request->getVar('tags'),
        'galleryimage'=>$post_galleryimage_db_data,
        'video'=>$post_videofile_db_data,
        'location'=>$this->request->getVar('location'),
        'content'=>$this->request->getVar('detail'),
        'posted_by'=>$this->request->getVar('user_id'),
        'image'=>$post_image_db_data,
        'status'=>0,
        
        ]; 
		
         $rm = new BlogModel();
         $insertId=$rm->insertBlogApi($data);
          $datas=$rm->getSinglePost($insertId);
           $result["responce"] = true; 
          $result["message"] = 'Data has been inserted successfully'; 
         $result["getPostdata"] = $datas;
        echo json_encode($result);
}
	public function blogDelete(){
	header('Access-Control-Allow-Origin: *');
		 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
		 header('Access-Control-Allow-Headers: token, Content-Type');
		  $posts = new BlogModel();
		  $id=$this->request->getVar('post_id');
		  $posts->deletePost($id);
		  $result["responce"] = true; 
          $result["message"] = 'Data has been Deleted successfully'; 
          echo json_encode($result);
}
//events 
	public function event(){
	 header('Access-Control-Allow-Origin: *');
	 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
	 header('Access-Control-Allow-Headers: token, Content-Type');
		   $events = new EventModel();
		   $data["responce"] = true; 
		   $id=$this->request->getVar('user_id');
		   $limit=7;
		   $start=0;
		   if($this->request->getVar('limit')!=null){
				 $limit=$this->request->getVar('limit');
		}
			 if($this->request->getVar('start')!=null){
				 $start=$this->request->getVar('start');
		}
		  
		   $data['upcoming_events']=$events->getUpcomingEvents();
		   $data['event_category']=$events->getAllEventCategories();
		   $data['events']=$events->getAllEventApi($id,$start,$limit);
		   echo json_encode($data);
		}
	public function eventCategoryList(){
	 header('Access-Control-Allow-Origin: *');
	 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
	 header('Access-Control-Allow-Headers: token, Content-Type');
		   $events = new EventModel();
		   $data["responce"] = true; 
		   
		   $data['event_category']=$events->getAllEventCategories();
		  
		   echo json_encode($data);
		}		
	public function eventByCategory(){
	  header('Access-Control-Allow-Origin: *');
	  header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
	  header('Access-Control-Allow-Headers: token, Content-Type');
	   $categoryId = $this->request->getVar('cat_id');
		   $events = new EventModel();
		   $data["responce"] = true; 
		   $data['event_category']=$events->getAllEventCategories();
		   $data['upcoming_events']=$events->getUpcomingEvents();
		   $limit=7;
		   $start=0;
		   $id=$this->request->getVar('user_id'); 
			if($this->request->getVar('limit')!=null){
				 $limit=$this->request->getVar('limit');
			}
			if($this->request->getVar('start')!=null){
				 $start=$this->request->getVar('start');
			}
			$data['events']=$events->getAllEventByCategoryApi($id,$categoryId,$start,$limit);
			echo json_encode($data);
		}
	public function eventShowLastTwoComment(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
        $id = $this->request->getVar('post_id');
       $events = new EventModel();
         $data["responce"] = true; 
       $data['events_comment']=$events->getEventCommentUser($id);

        echo json_encode($data);
    }
	public function eventShowAllComment(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');


        $id = $this->request->getVar('post_id');
       $events = new EventModel();
         $data["responce"] = true; 
       $data['events_comment']=$events->getEventCommentdetail($id);

        echo json_encode($data);
    }
	public function eventInsertComment(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');

      
        $data=[
        'event_id'=>$this->request->getVar('post_id'),
        'comment_by'=>$this->request->getVar('user_id'),
        'message'=>$this->request->getVar('message'),
        'created_at'=>date('Y-m-d H:i:s'),
        'status'=>1
        ]; 
         $event = new EventModel();
         $eventId=$event->insertEventComment($data);
          $output=$event->getEventCommentByid($eventId);

          $result["responce"] = true; 
          $result["message"] = 'Data been inserted successfully'; 
           $result["insertedComment"] = $output;

        echo json_encode($result);
    }
	public function eventAdd(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');

      $post_image_db_data='';
	  if($this->request->getFile('image')!=null){
		$post_image = $this->request->getFile('image');
        $post_image_name = $post_image->getName();
        if($post_image_name!=''){
            $post_image_name=time().$post_image_name;
            $post_image->move(ROOTPATH.'public/uploads/event/post/',$post_image_name);
            $post_image_db_data='public/uploads/event/post/'.$post_image_name;
        }  
	  }
        
         $post_video_db_data='';
        $data=[
        'category'=>$this->request->getVar('category_id'),
        'name'=>$this->request->getVar('name'),
        'location'=>$this->request->getVar('location'),
        'posted_by'=>$this->request->getVar('user_id'),
        'event_start_date'=>$this->request->getVar('event_start_date').' '.$this->request->getVar('event_start_time'),
        'event_end_date'=>$this->request->getVar('event_end_date').' '.$this->request->getVar('event_end_time'),
        'details'=>$this->request->getVar('details'),
        'image'=>$post_image_db_data,
        'video'=>$post_video_db_data,
        'status'=>0,
        
        ]; 
         $rm = new EventModel();
         $eventId=$rm->insertEventApi($data);
         $output=$rm->getSingleEvent($eventId);

          $result["responce"] = true; 
          $result["message"] = 'Data been inserted successfully'; 
          $result["insertedEvent"] = $output;

        echo json_encode($result);
    }
	public function eventDetailsById(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');


         $eventid = $this->request->getVar('post_id');
		 $id=$this->request->getVar('user_id');
         $events = new EventModel();
         $data["responce"] = true;
		  
          $data['upcoming_events']=$events->getUpcomingEvents();
         $data['event_details']=$events->getSingleEventApi($id,$eventid);
		 $data['event_category']=$events->getAllEventCategories();
         
        echo json_encode($data);
    }
	public function eventInsertNotIntersted(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');

      
        $data=[
        'event_id'=>$this->request->getVar('event_id'),
        'user_id'=>$this->request->getVar('user_id'),
        'created_at'=>date('Y-m-d H:i:s'),
        'status'=>1
        ]; 
         $event = new EventModel();
         $event->insertNotinterstedEvent($data);

          $result["responce"] = true; 
          $result["message"] = 'event is successfully remove'; 

        echo json_encode($result);
    }
	public function eventInsertGoingNotGoing(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
  $data=[
        'event_id'=>$this->request->getVar('event_id'),
        'user_id'=>$this->request->getVar('user_id'),
        'created_at'=>date('Y-m-d H:i:s'),
        'status'=>$this->request->getVar('status')
        ]; 
         $post = new EventModel();
         $post->insertEventGoing($data);

          $result["responce"] = true; 
          $result["message"] = 'Data been inserted successfully'; 

        echo json_encode($result);
    }
	public function eventDelete(){
	header('Access-Control-Allow-Origin: *');
		 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
		 header('Access-Control-Allow-Headers: token, Content-Type');
		  $posts = new EventModel();
		  $id=$this->request->getVar('post_id');
		  $posts->deleteEvent($id);
		  $result["responce"] = true; 
          $result["message"] = 'Data has been Deleted successfully'; 
          echo json_encode($result);
}
//news
	public function news(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
       
         $news= new NewsModel();
         $data["responce"] = true; 
         $id=1;
        $limit=7;
        $start=0;

        if($this->request->getVar('limit')!=null){
             $limit=$this->request->getVar('limit');
        }
         if($this->request->getVar('start')!=null){
             $start=$this->request->getVar('start');
        }
         
        $data['news_latest']=$news->getLatestNewsByUser($id);
        $data['news_category']=$news->getAllNewsCategory();
        $data['news']=$news->getAllNewstBylimitForApi($id,$start,$limit);

        echo json_encode($data);
    }
	public function newsCategoryList(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
       
         $news= new NewsModel();
         $data["responce"] = true; 
         
        $data['news_category']=$news->getAllNewsCategory();
        
        echo json_encode($data);
    }
	public function newsDetailsById(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
        $session = session();

         $id = $this->request->getVar('news_id');
         $news= new NewsModel();

         $data["responce"] = true; 
         $data['news_details']=$news->getSinglebNewById($id);
		 $data['comment']=$news->getcommentByPostId($id);
		 $data['news_category']=$news->getAllNewsCategory();
        echo json_encode($data);
    }	
	public function newsShowAllComment(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
        $session = session();
        $id = $this->request->getVar('news_id');
      $news= new NewsModel();
         $data["responce"] = true;
        $data['new_comment']=$news->getcommentByPostId($id);
        echo json_encode($data);
    }
	public function newsShowLastTwoComment(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
        $session = session();
        $id = $this->request->getVar('news_id');
      $news= new NewsModel();
         $data["responce"] = true;
        $data['new_comment']=$news->getAllPostByUser($id);
        echo json_encode($data);
    }
	
	public function newsInsertComment(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');

      $id=$this->request->getVar('post_id');
        $user_id=$this->request->getVar('user_id');
        $data=[
        'post_id'=>$id,
        'commented_by'=>$user_id,
        'message'=>$this->request->getVar('message'),
        'created_at'=>date('Y-m-d H:i:s'),
        'status'=>1
        ]; 
         $news = new NewsModel();
         $newsId=$news->insertNewsComment($data);
         $output=$news->getNewsCommentByid($newsId);

         $result["responce"] = true; 
          $result["message"] = 'Data been inserted successfully'; 
           $result["comment"] = $output;

        echo json_encode($result);
    }
	public function newsByCategory(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
       $id=1;
       $limit=7;
       $start=0;
       if($this->request->getVar('limit')!=null){
             $limit=$this->request->getVar('limit');
       }
         if($this->request->getVar('start')!=null){
             $start=$this->request->getVar('start');
      }

        $cat_id = $this->request->getVar('cat_id');

         $news= new NewsModel();
         $data["responce"] = true; 
        $data['news']=$news->getAllNewsByCategoryLimitForApi($cat_id,$start,$limit);
       $data['news_latest']=$news->getLatestNewsByUser($id);
        $data['news_category']=$news->getAllNewsCategory();
        echo json_encode($data);
    }
	public function newsDelete(){
	header('Access-Control-Allow-Origin: *');
		 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
		 header('Access-Control-Allow-Headers: token, Content-Type');
		  $posts = new NewsModel();
		  $id=$this->request->getVar('post_id');
		  $posts->deletePost($id);
		  $result["responce"] = true; 
          $result["message"] = 'Data has been Deleted successfully'; 
          echo json_encode($result);
}
	
	public function userProfileAllData(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
         $session = session();
         if(isset($_GET['user_id'])){
			$id = $_GET['user_id']; 
		 }
		 if(isset($_POST['user_id'])){
			$id = $_POST['user_id']; 
		 }
        $users = new UserModel();
        $data['users_details']=$users->getSingleUser($id);
		$data['userfriend']=$users->getSingleUserFriend($id); 
        
         $vegan= new PostModel();
        $veganpost=$vegan->getSingleUserPost($id);
        $veganphoto=$vegan->getUserPhotos($id);
        $data['photos']=$veganphoto;
        $data['vegan_posts']=$veganpost;

        $rm = new EventModel();
        $data['profile_event_data']=$rm->getEventByUser($id);

        

        $recipes=new ReceipeModel();
        $data['profile_receipe_data']=$recipes->getAllRacipeByUserForProfile($id);

        $blog= new BlogModel();
        $data['profile_blog_data']=$blog->getAllPostByUserForProfile($id);


        echo json_encode($data);





    }	
//receipes
    public function recipes(){
      header('Access-Control-Allow-Origin: *');
      header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
      header('Access-Control-Allow-Headers: token, Content-Type');
      $receipe= new ReceipeModel();
      $id=1;
	  $limit=7;
	  $start=0;
		   if($this->request->getVar('limit')!=null){
				 $limit=$this->request->getVar('limit');
		}
			 if($this->request->getVar('start')!=null){
				 $start=$this->request->getVar('start');
		}
	  $data["responce"] = true; 	
      $data['receipes']=$receipe->user_recipe_list_api($id,$start,$limit);
      $data['receipe_category']=$receipe->user_recipe_category();
       echo json_encode($data);
    }
	
	 public function recipeByCategory(){
	  header('Access-Control-Allow-Origin: *');
      header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
      header('Access-Control-Allow-Headers: token, Content-Type');
      $receipe= new ReceipeModel();
      $id=1;
	  $limit=7;
	  $start=0;
		   if($this->request->getVar('limit')!=null){
				 $limit=$this->request->getVar('limit');
		}
			 if($this->request->getVar('start')!=null){
				 $start=$this->request->getVar('start');
		}
	  $data["responce"] = true; 
     $category_id=$this->request->getVar('cat_id');	  
      $data['receipes']=$receipe->user_recipe_list_by_category_api($category_id,$start,$limit);
      $data['receipe_category']=$receipe->user_recipe_category();
       echo json_encode($data); 
	 }
	
	
	public function recipeCategoryList(){
      header('Access-Control-Allow-Origin: *');
      header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
      header('Access-Control-Allow-Headers: token, Content-Type');
      $receipe= new ReceipeModel();
      
	  $data["responce"] = true; 	
     
      $data['receipe_category']=$receipe->user_recipe_category();
       echo json_encode($data);
    }
	public function recipesDetailsById(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
   $id = $this->request->getVar('id');
   $receipe=new ReceipeModel();
   $data["responce"] = true;
   $data['receipes']=$receipe->user_recipe_single($id);
   echo json_encode($data);
    }
	public function recipeAdd(){
	header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
    header('Access-Control-Allow-Headers: token, Content-Type');
$post_image_db_data='';
if($this->request->getFile('image')!=null){
	$post_image = $this->request->getFile('image');
		$post_image_name = $post_image->getName();
		if($post_image_name!=''){
			$post_image_name=time().$post_image_name;
			$post_image->move(ROOTPATH.'public/uploads/receipe/post/',$post_image_name);
			$post_image_db_data='public/uploads/receipe/post/'.$post_image_name;
		}
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
		if($this->request->getFile('videofile')!=null){
		$post_video = $this->request->getFile('videofile');
		$post_video_name = $post_video->getName();
		if($post_video_name!=''){
			$post_video_name=time().$post_video_name;
			$post_video->move(ROOTPATH.'public/uploads/receipe/post/',$post_video_name);
			$post_videofile_db_data='public/uploads/receipe/post/'.$post_video_name;
		}	
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
		'posted_by'=>$this->request->getVar('user_id'),
		'location'=>$this->request->getVar('location'),
		'tags'=>$this->request->getPost('tags'),
		'steps'=>$this->request->getPost('steps'),
		'galleryimage'=>$post_galleryimage_db_data,
		'ingredients'=>$this->request->getPost('ingredients'),
		'cooking_time'=>$this->request->getPost('cooking_time'),
		]; 
		
	   $rm = new ReceipeModel();
		 $insertId=$rm->user_recipe_insert_api($data);
          $datas=$rm->user_recipe_single_apis($insertId);
           $result["responce"] = true; 
          $result["message"] = 'Data has been inserted successfully'; 
         $result["getPostdata"] = $datas;
        echo json_encode($result);
}
	public function recipeInsertComment(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');

      
        $data=[
		'post_id'=>$this->request->getPost('post_id'),
		'commented_by'=>$this->request->getPost('user_id'),
		'message'=>$this->request->getPost('message'),
		'created_at'=>date('Y-m-d H:i:s'),
		'status'=>1
		];  
         $rm = new ReceipeModel();
		 $id=$rm->user_recipe_insert_comments($data);
          $output=$rm->user_recipe_comment_by_id($id);

          $result["responce"] = true; 
          $result["message"] = 'Data been inserted successfully'; 
           $result["insertedComment"] = $output;

        echo json_encode($result);
    }
	public function recipeShowAllComment(){
	header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
    header('Access-Control-Allow-Headers: token, Content-Type');
    $post_id = $this->request->getVar('post_id');
    $rm= new ReceipeModel();
     $data["responce"] = true; 
     $data['comment']=$rm->recipe_comment_all($post_id);
     echo json_encode($data);
}
	public function recipeShowLastTwoComment(){
	 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');

       $post_id = $this->request->getVar('post_id');

       $rm= new ReceipeModel();
         $data["responce"] = true; 
        $data['comment']=$rm->user_recipe_comment($post_id);

        echo json_encode($data);
}
	public function recipeDelete(){
	header('Access-Control-Allow-Origin: *');
		 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
		 header('Access-Control-Allow-Headers: token, Content-Type');
		  $posts = new ReceipeModel();
		  $id=$this->request->getVar('post_id');
		  $posts->deleteReceipeUser($id);
		  $result["responce"] = true; 
          $result["message"] = 'Data has been Deleted successfully'; 
          echo json_encode($result);
}

 public function profileUpdate(){
	 $cover_image_db_data='';
	 $cover_image_name='';
	   if($this->request->getFile('cover_image')!=null){
		 $cover_image = $this->request->getFile('cover_image');
		$cover_image_name = $cover_image->getName();  
	   }
		
		$profile_image_db_data='';
		$profile_image_name='';
		if($this->request->getFile('profile_image')!=null){
		$profile_image = $this->request->getFile('profile_image');
		$profile_image_name = $profile_image->getName();	
		}
		
		$id=$this->request->getVar('user_id');
		$data['name']=$this->request->getVar('name');
		$data['last_name']=$this->request->getVar('last_name');
		$data['mobile_no']=$this->request->getVar('mobile');
		$data['address']=$this->request->getVar('address');
		$data['dob']=$this->request->getVar('dob');
		$data['city']=$this->request->getVar('city');
		$data['pin_code']=$this->request->getVar('pin');
		$data['country']=$this->request->getVar('country');
		$data['state']=$this->request->getVar('state');
		$data['description']=$this->request->getVar('description');
		
		
		if($profile_image_name!=''){
			$profile_image_name=time().$profile_image_name;
			$profile_image->move(ROOTPATH.'public/uploads/users/profileImage',$profile_image_name);
			$profile_image_db_data='public/uploads/users/profileImage/'.$profile_image_name;
			$data['profile_image']=$profile_image_db_data;
		}
		if($cover_image_name!=''){
			$cover_image_name=time().$cover_image_name;
			$cover_image->move(ROOTPATH.'public/uploads/users/coverImage',$cover_image_name);
			$cover_image_db_data='public/uploads/users/coverImage/'.$cover_image_name;
			$data['cover_image']=$cover_image_db_data;
		}
		
		$data['status']=1;
		$data['updated_at']=date('Y-m-d H:i');
		
		 $users = new UserModel();
		 $users->update($id,$data);
		 $result["responce"] = true; 
          $result["message"] = 'Profile has been Updated successfully'; 
          echo json_encode($result);
 }
public function friendReqestSend(){
	    $db = db_connect();
		$toid=$this->request->getVar('touserId');
		$id=$this->request->getVar('user_id');
		$created_at=date('Y-m-d H:i:s');
		$request=$db->query("insert into friend_request set sender_id='".$id."',receiver_id='".$toid."',created_at='".$created_at."' ");
		$lastid=$db->mysqli->insert_id;
		$sql="insert into user_notifications set sender_id='".$id."',receiver_id='".$toid."',table_name='friend_request',table_id='".$lastid."',type='Request_Send',type_name='Friend Request',created_at='".$created_at."'";
		$db->query($sql);
		 $result["responce"] = true; 
          $result["message"] = 'Friend Request send successfully'; 
          echo json_encode($result);
}
public function friendRequestConfirm(){
		$db = db_connect();
		$user_id=$this->request->getVar('user_id');
		$id=$this->request->getVar('fromuserId');
		$created_at=date('Y-m-d H:i:s');
		$request=$db->query("delete from friend_request where  receiver_id='".$user_id."' and sender_id='".$id."'");
		$request=$db->query("insert into  users_friend  set receiver_id='".$user_id."',sender_id='".$id."'");
		$lastid=$db->mysqli->insert_id;
		$sql="insert into user_notifications set sender_id='".$user_id."',receiver_id='".$id."',table_name='users_friend',table_id='".$lastid."',type='Request_Confirm',type_name='Friend',created_at='".$created_at."'";
		$db->query($sql);
		$result["responce"] = true; 
          $result["message"] = 'Friend Request Cofirm successfully'; 
          echo json_encode($result);
		
	}
}
?>