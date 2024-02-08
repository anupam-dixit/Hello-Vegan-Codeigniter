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
use App\Models\PageModel;
use App\Models\CooksModel;
use App\Models\ProductModel;
use App\Models\RestaurantsModel;

class ApiController extends BaseController
{
	public function sendForgotPasswordLink(){
		header('Access-Control-Allow-Origin: *');
         header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
         header('Access-Control-Allow-Headers: token, Content-Type');
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
                  if (!$res){
                      $res=$users->where("mobile_no like '%$email%'")->first();
                  }
                   if($res){

                    $pass = $res['password'];
                   
                   
                     $checkStatus = $users->where('email', $email)->orWhere("mobile_no like '%$email%'")->where('status',1)->first();
                    
                    
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
	public function pages(){
		header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
        die();
        }
		//$pageName='about';
		$pageName=$_GET['pageName'];
		if($_GET['pageName']==''){
			$pageName='about';
		}
		 $page_model= new PageModel();
		 $data['page_details'] =$page_model->getPageContent($pageName);
		 echo json_encode($data);
		 
	}
	public function contactInsert(){
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
        die();
        }
       $data=[
        'name'=>$this->request->getVar('name'),
        'email'=>$this->request->getVar('email'),
        'country'=>$this->request->getVar('country'),
        'message'=>$this->request->getVar('message'),
        'mobile'=>$this->request->getVar('mobile'),
        'created_at'=>date('Y-m-d H:i:s'),
        'status'=>1
        ]; 
         $post = new VeganPostModel();
         $getid=$post->insertContact($data);
    
         		 
         $result["responce"] = true; 
          $result["message"] = 'Data been inserted successfully'; 
        echo json_encode($result);
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
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
        die();
        }
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
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
        die();
        }
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
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
        die();
        }
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
        die();
        }
         $post_image_db_data='';
        if($this->request->getVar('create_post_image')!=null){

            $base64Data = $this->request->getVar('create_post_image'); // Assuming the base64 data is sent as 'data'

// Convert base64 to binary data
            $binaryData = base64_decode($base64Data);
            $post_image_name=uniqid().$this->request->getVar('file_extension');
// Save the binary data to a file or process it as needed
            file_put_contents(ROOTPATH. 'public/uploads/user/veganpost/' . $post_image_name, $binaryData);
            $post_image_db_data='public/uploads/user/veganpost/'.$post_image_name;



            $post_image = $this->request->getFile('create_post_image');

        if($post_image_name!=''){

//            $post_image_name=time().$post_image_name;
//            $post_image->move(ROOTPATH.'public/uploads/user/veganpost/',$post_image_name);
//            $post_image_db_data='public/uploads/user/veganpost/'.$post_image_name;
        }
		} else {
            die('n');
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
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
        die();
        }
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
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
        die();
        }
    
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
         $result["insertcommetdata"] = $getid; 
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
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
        die();
        }

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
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
        die();
        }
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
		  
		   $data['upcoming_events']=$events->getUpcomingEvents($id);
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
		   $id=$this->request->getVar('user_id'); 
		   $data["responce"] = true; 
		   $data['event_category']=$events->getAllEventCategories();
		   $data['upcoming_events']=$events->getUpcomingEvents($id);
		   $limit=7;
		   $start=0;
		   
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
    public function eventDetailsById(){
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
        header('Access-Control-Allow-Headers: token, Content-Type');
       
       
                $eventid = $this->request->getVar('post_id');
                $id=$this->request->getVar('user_id');
                $events = new EventModel();
                $data["responce"] = true;
                 
                 $data['upcoming_events']=$events->getUpcomingEvents($id);
                
				$data['event_details']=$events->getSingleEventApi($id,$eventid);
                //$data['event_data']=$events->getSingleEventApi($id,$eventid);
                $data['event_category']=$events->getAllEventCategories();
                $data['events_comment']=$events->getEventCommentdetail($eventid);
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

    public function productShowAllComment(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');


        $id = $this->request->getVar('post_id');
       $product = new ProductModel();
         $data["responce"] = true; 
       $data['product_comment']=$product->getProductCommentdetail($id);

        echo json_encode($data);
    }

    public function productInsertComment(){
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
        die();
        }

      
        $data=[
        'post_id'=>$this->request->getVar('post_id'),
        'comment_by'=>$this->request->getVar('user_id'),
        'message'=>$this->request->getVar('message'),
        'created_date'=>date('Y-m-d H:i:s'),
        // 'status'=>1
        ]; 
         $product = new ProductModel();
         $productId=$product->insertProductComment($data);
          $output=$product->getProductCommentByid($productId);

          $result["responce"] = true; 
          $result["message"] = 'Data been inserted successfully'; 
           $result["insertedComment"] = $output;

        echo json_encode($result);
    }


	public function eventInsertComment(){
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
        die();
        }

      
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
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
        die();
        }

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
        'category'=>$this->request->getVar('category'),
        'name'=>$this->request->getVar('name'),
        'location'=>$this->request->getVar('location'),
        'posted_by'=>$this->request->getVar('user_id'),
        'event_start_date'=>$this->request->getVar('event_start_date').' '.$this->request->getVar('event_start_time'),
        'event_end_date'=>$this->request->getVar('event_end_date').' '.$this->request->getVar('event_end_time'),
        //'details'=>$this->request->getVar('details'),
        'details'=>$this->request->getVar('detail'),
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
	
	public function eventInsertNotIntersted(){
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
        die();
        }

      
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
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
        die();
        }
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
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
        die();
        }
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
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
        die();
        }

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
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
        die();
        }
		  $posts = new NewsModel();
		  $id=$this->request->getVar('post_id');
		  $posts->deletePost($id);
		  $result["responce"] = true; 
          $result["message"] = 'Data has been Deleted successfully'; 
          echo json_encode($result);
}
	public function unfriend(){
		
		 header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
        die();
        }
		$db = db_connect();

		$userid=$this->request->getVar('userid');
		$touserid=$this->request->getVar('touserid');
		$created_at=date('Y-m-d H:i:s');
		$request=$db->query("delete from users_friend where (sender_id='".$userid."' and receiver_id='".$touserid."')");
		$request=$db->query("delete from users_friend where (receiver_id='".$touserid."' and sender_id='".$userid."')");
		
		$sql="insert into user_notifications set sender_id='".$userid."',receiver_id='".$touserid."',table_name='friend_request',table_id='".$touserid."',type='Unfriend',type_name='Account',created_at='".$created_at."'";
		$db->query($sql);
		$result["responce"] = true; 
          $result["message"] = 'Unfriend successfully'; 
          echo json_encode($result);
		die;
		
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
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
        die();
        }
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
	    'receipe_category_id'=>$this->request->getVar('post_category_id'),
		'title'=>$this->request->getVar('title'),
		'content'=>$this->request->getVar('detail'),
		'image'=>$post_image_db_data,
		'video'=>$post_videofile_db_data,
		'moderate'=>0,
		'status'=>0,
		'created_at'=>date('Y-m-d H:i:s'),
		'updated_at'=>date('Y-m-d H:i:s'),
		'posted_by'=>$this->request->getVar('user_id'),
		'location'=>$this->request->getVar('location'),
		'tags'=>$this->request->getVar('tags'),
		'steps'=>$this->request->getVar('steps'),
		'galleryimage'=>$post_galleryimage_db_data,
		'ingredients'=>$this->request->getVar('ingredients'),
		'cooking_time'=>$this->request->getVar('cooking_time'),
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
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
        die();
        }

      
        $data=[
		'post_id'=>$this->request->getVar('post_id'),
		'commented_by'=>$this->request->getVar('user_id'),
		'message'=>$this->request->getVar('message'),
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
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
        die();
        }
		  $posts = new ReceipeModel();
		  $id=$this->request->getVar('post_id');
		  $posts->deleteReceipeUser($id);
		  $result["responce"] = true; 
          $result["message"] = 'Data has been Deleted successfully'; 
          echo json_encode($result);
}

public function profileUpdate(){
	header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
        die();
        }
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
 public function friendReqestList(){
	header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == "OPTIONS") {
    die();
    } 
	$id=$this->request->getVar('user_id');
	$result["responce"] = true;
    $users = new UserModel();	
	
	$result['friend_request_received_by_me']=$users->friendRequestReceivedByMeApi($id);
	$result['friend_request_send_by_me']=$users->friendRequestSendByMeApi($id);
	  echo json_encode($result);
	
 }

 public function friendReqestSend(){
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == "OPTIONS") {
    die();
    }
	    $db = db_connect();
		$toid=$this->request->getVar('touserId');
		$id=$this->request->getVar('user_id');
		$created_at=date('Y-m-d H:i:s');
		
		$data1=$db->query("select id from  friend_request  where sender_id='".$id."' and receiver_id='".$toid."'");
		$result1=$data1->getResult();
		$data2=$db->query("select id from  users_friend  where receiver_id='".$id."' and sender_id='".$toid."'");
		$result2=$data2->getResult();
		if(count($result1)==0 && count($result2)==0){
		$request=$db->query("insert into friend_request set sender_id='".$id."',receiver_id='".$toid."',created_at='".$created_at."' ");
		$lastid=$db->mysqli->insert_id;
		$sql="insert into user_notifications set sender_id='".$id."',receiver_id='".$toid."',table_name='friend_request',table_id='".$lastid."',type='Request_Send',type_name='Friend Request',created_at='".$created_at."'";
		$db->query($sql);
		 $result["responce"] = true; 
          $result["message"] = 'Friend Request send successfully'; 	
		}else{
		$result["responce"] = true; 
          $result["message"] = 'Friend Request send already'; 	
		}
		
		
          echo json_encode($result);
}
public function friendRequestConfirm(){
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == "OPTIONS") {
    die();
    }
		$db = db_connect();
		$user_id=$this->request->getVar('user_id');
		$id=$this->request->getVar('fromuserId');
		$created_at=date('Y-m-d H:i:s');
		$request=$db->query("delete from friend_request where  receiver_id='".$user_id."' and sender_id='".$id."'");
		$data1=$db->query("select id from  users_friend  where receiver_id='".$user_id."' and sender_id='".$id."'");
		$result1=$data1->getResult();
		$data2=$db->query("select id from  users_friend  where sender_id='".$user_id."' and receiver_id='".$id."'");
		$result2=$data2->getResult();
		if(count($result1)==0 && count($result2)==0){
		$request=$db->query("insert into  users_friend  set receiver_id='".$user_id."',sender_id='".$id."'");
		$lastid=$db->mysqli->insert_id;
		$sql="insert into user_notifications set sender_id='".$user_id."',receiver_id='".$id."',table_name='users_friend',table_id='".$lastid."',type='Request_Confirm',type_name='Friend',created_at='".$created_at."'";
		$db->query($sql);
		$result["responce"] = true; 
        $result["message"] = 'Friend Request Confirm successfully';	
		}else{
		$result["responce"] = true; 
        $result["message"] = 'Friend Request Confirm already';	
		}
		 
          echo json_encode($result);
		
	}
public function friendRequestCancel(){
		
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == "OPTIONS") {
    die();
    }
		$db = db_connect();
		$id=$this->request->getVar('touserId');
		$user_id=$this->request->getVar('user_id');
		$created_at=date('Y-m-d H:i:s');
		$db->query("delete from friend_request where  receiver_id='".$user_id."' and sender_id='".$id."'");
		$request=$db->query("delete from friend_request where sender_id='".$user_id."' and receiver_id='".$id."'");
		$result["responce"] = true; 
          $result["message"] = 'Friend Request Cancel successfully'; 
          echo json_encode($result);
		
	}
public function friendRequestDelete(){
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == "OPTIONS") {
    die();
    }
		
		$db = db_connect();
		$id=$this->request->getVar('fromuserId');
		$user_id=$this->request->getVar('user_id');
		$created_at=date('Y-m-d H:i:s');
		$request=$db->query("delete from friend_request where  receiver_id='".$user_id."' and sender_id='".$id."'");
		$db->query("delete from friend_request where sender_id='".$user_id."' and receiver_id='".$id."'");
		$lastid=$db->mysqli->insert_id;
		$sql="insert into user_notifications set sender_id='".$user_id."',receiver_id='".$id."',table_name='friend_request',table_id='".$lastid."',type='RequestsDelete',type_name='Profile',created_at='".$created_at."'";
		$db->query($sql);
		$result["responce"] = true; 
          $result["message"] = 'Friend Request Deleted successfully'; 
          echo json_encode($result);
		
	}
	public function removedPeopleYouMayKnow(){
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
        die();
        }
		$db = db_connect();
		$id=$this->request->getVar('touserId');
		$user_id=$this->request->getVar('user_id');
		$request=$db->query("insert into  users_remove  set removed_by_user_id='".$user_id."',removed_user_id='".$id."'");
		$result["responce"] = true; 
          $result["message"] = 'People Remove From you may know'; 
          echo json_encode($result);
	}
   public function profilePostDetailsById(){
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
		header('Access-Control-Allow-Headers: token, Content-Type');
		$id=$this->request->getVar('post_id');
		$post_vegan= new PostModel();
		$data['vaganpost_details']=$post_vegan->getSinglePostUser($id);
		$data['comment']=$post_vegan->getPostComment($id);
		echo json_encode($data);
	}
	public function profilePostInsertLike(){
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
        die();
        }
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
	public function profilePostInsertComment(){
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
        die();
        }

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
	public function profilePostShowAllComment(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
        $id = $this->request->getVar('post_id');
        $post = new PostModel();
         $data["responce"] = true;
         $data['comment']=$post->getPostComment($id);
        echo json_encode($data);
    }
	public function profilePostShowLastTwoComment(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
        $id = $this->request->getVar('post_id');
        $post = new PostModel();
         $data["responce"] = true;
         $data['comment']=$post->getPostCommentUser($id);
         echo json_encode($data);
    }
	 public function profilePostDeletePost(){
		header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
        die();
        }
		  $posts = new PostModel();
		  $id=$this->request->getVar('post_id');
		  $posts->deletePost($id);
		  $result["responce"] = true; 
          $result["message"] = 'Data been Deleted successfully'; 
          echo json_encode($result);
	}
   public function profileBlogDetailsById(){
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
public function profileBlogInsertComment(){
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == "OPTIONS") {
    die();
    }
    
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
public function profileBlogShowAllComment(){
	header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
    header('Access-Control-Allow-Headers: token, Content-Type');
    $post_id = $this->request->getVar('post_id');
    $blog= new BlogModel();
     $data["responce"] = true; 
     $data['comment']=$blog->getPostComment($post_id);
     echo json_encode($data);
}
public function profileBlogShowLastTwoComment(){
	 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');

       $post_id = $this->request->getVar('post_id');

       $blog= new BlogModel();
         $data["responce"] = true; 
        $data['comment']=$blog->getPostCommentUser($post_id);

        echo json_encode($data);
}
public function profileBlogDelete(){
	header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
        die();
        }
		  $posts = new BlogModel();
		  $id=$this->request->getVar('post_id');
		  $posts->deletePost($id);
		  $result["responce"] = true; 
          $result["message"] = 'Data has been Deleted successfully'; 
          echo json_encode($result);
}
public function profileBlogCategoryList(){
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
    header('Access-Control-Allow-Headers: token, Content-Type');
	 $blog= new BlogModel();
     $data["responce"] = true; 
	 
	 $data['blog_category']=$blog->getAllPostCategory();
     	 
	 echo json_encode($data);
    }
     public function profileEventCategoryList(){
	 header('Access-Control-Allow-Origin: *');
	 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
	 header('Access-Control-Allow-Headers: token, Content-Type');
		   $events = new EventModel();
		   $data["responce"] = true; 
		   
		   $data['event_category']=$events->getAllEventCategories();
		  
		   echo json_encode($data);
		}
    public function profileEventShowLastTwoComment(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
        $id = $this->request->getVar('post_id');
       $events = new EventModel();
         $data["responce"] = true; 
       $data['events_comment']=$events->getEventCommentUser($id);

        echo json_encode($data);
    }
	public function profileEventShowAllComment(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');


        $id = $this->request->getVar('post_id');
       $events = new EventModel();
         $data["responce"] = true; 
       $data['events_comment']=$events->getEventCommentdetail($id);

        echo json_encode($data);
    }
	public function profileEventInsertComment(){
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
        die();
        }

      
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
	public function profileEventDetailsById(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');


         $eventid = $this->request->getVar('post_id');
		 $id=$this->request->getVar('user_id');
         $events = new EventModel();
         $data["responce"] = true;
		  
          $data['upcoming_events']=$events->getUpcomingEvents($id);
         $data['event_details']=$events->getSingleEventApi($id,$eventid);
		 $data['event_category']=$events->getAllEventCategories();
         
        echo json_encode($data);
    }
	public function prfoileEventInsertNotIntersted(){
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
        die();
        }

      
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
	public function prfoileEventInsertGoingNotGoing(){
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
        die();
        }
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
	public function prfoileEventDelete(){
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
        die();
        }
		  $posts = new EventModel();
		  $id=$this->request->getVar('post_id');
		  $posts->deleteEvent($id);
		  $result["responce"] = true; 
          $result["message"] = 'Data has been Deleted successfully'; 
          echo json_encode($result);
}
	public function prfoileRecipeCategoryList(){
      header('Access-Control-Allow-Origin: *');
      header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
      header('Access-Control-Allow-Headers: token, Content-Type');
      $receipe= new ReceipeModel();
      
	  $data["responce"] = true; 	
     
      $data['receipe_category']=$receipe->user_recipe_category();
       echo json_encode($data);
    }
public function prfoileRecipeDetailsById(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
   $id = $this->request->getVar('id');
   $receipe=new ReceipeModel();
   $data["responce"] = true;
   $data['receipes']=$receipe->user_recipe_single($id);
   echo json_encode($data);
    }
public function prfoileRecipeInsertComment(){
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == "OPTIONS") {
    die();
    }

      
        $data=[
		'post_id'=>$this->request->getVar('post_id'),
		'commented_by'=>$this->request->getVar('user_id'),
		'message'=>$this->request->getVar('message'),
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
	public function prfoileRecipeShowAllComment(){
	header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
    header('Access-Control-Allow-Headers: token, Content-Type');
    $post_id = $this->request->getVar('post_id');
    $rm= new ReceipeModel();
     $data["responce"] = true; 
     $data['comment']=$rm->recipe_comment_all($post_id);
     echo json_encode($data);
}
	public function prfoileRecipeShowLastTwoComment(){
	 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');

       $post_id = $this->request->getVar('post_id');

       $rm= new ReceipeModel();
         $data["responce"] = true; 
        $data['comment']=$rm->user_recipe_comment($post_id);

        echo json_encode($data);
}
	public function prfoileRecipeDelete(){
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
        die();
        }
		  $posts = new ReceipeModel();
		  $id=$this->request->getVar('post_id');
		  $posts->deleteReceipeUser($id);
		  $result["responce"] = true; 
          $result["message"] = 'Data has been Deleted successfully'; 
          echo json_encode($result);
}	
  public function profile(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
         $session = session();
		
         
		 if(isset($_GET['id'])){
			$id = $_GET['id']; 
			
		 }
		 if(isset($_POST['id'])){
			$id = $_POST['id'];
            		
		 }
		 if(isset($_GET['login_user_id'])){
		
			$login_user_id = $_GET['login_user_id']; 
		 }
		 if(isset($_POST['login_user_id'])){
			
            $login_user_id = $_GET['login_user_id'];			
		 }
        $users = new UserModel();
        
		$data['users_details']=$users->getSingleUser($id,$login_user_id);
		$data['users_details']['friend_request_sent_status']=$users->friendRequestSent($id,$login_user_id);
		$data['users_details']['friend_request_received_status']=$users->friendRequestRec($id,$login_user_id);
		$data['users_details']['total_friend_request_received']=$users->friendRequestRecTotal($id,$login_user_id);
		$data['users_details']['total_friend_request_send']=$users->friendRequestSentTotal($id,$login_user_id);
		$data['userfriend']=$users->getSingleUserFriend($id); 
        
         $vegan= new PostModel();
        $veganpost=$vegan->getSingleUserPost($id);
        $veganphoto=$vegan->getUserPhotos($id);
        $data['photos']=$veganphoto;
        $data['vegan_posts']=$veganpost;

        $rm = new EventModel();
        $data['event_data']=$rm->getEventByUser($id);

        

        $recipes=new ReceipeModel();
        $data['racipeall_profile']=$recipes->getAllRacipeByUserForProfile($id);

        $blog= new BlogModel();
        $data['blogall_profile']=$blog->getAllPostByUserForProfile($id);


        echo json_encode($data);

 }
public function profilePhoto(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
         
        
         $limit=10;
         $start=0;

        if($this->request->getVar('limit')!=null){
             $limit=$this->request->getVar('limit');
         }
         if($this->request->getVar('start')!=null){
             $start=$this->request->getVar('start');
       }

        $id=$this->request->getVar('user_id');

        $users = new UserModel();
        
         $vegan= new PostModel();
        $veganphoto=$vegan->getUserPhotosForApi($id,$limit,$start);
        $data["responce"] = true; 
        $data['photos']=$veganphoto;
        echo json_encode($data);

    }
   public function profileBlog(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
         
        
         $limit=10;
         $start=0;

        if($this->request->getVar('limit')!=null){
             $limit=$this->request->getVar('limit');
         }
         if($this->request->getVar('start')!=null){
             $start=$this->request->getVar('start');
       }

        $id=$this->request->getVar('user_id');
         $blog= new BlogModel();
         
         $veganProfileBlog=$blog->getAllPostByUserForProfileForApi($id,$start,$limit);
          $data["responce"] = true; 
        $data['blogall_profile']=$veganProfileBlog;
        echo json_encode($data);

    }
    public function profilePost(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
         
        
         $limit=10;
         $start=0;

        if($this->request->getVar('limit')!=null){
             $limit=$this->request->getVar('limit');
         }
         if($this->request->getVar('start')!=null){
             $start=$this->request->getVar('start');
       }

        $id=$this->request->getVar('user_id');
          $post_vegan= new PostModel();
         
         $veganProfilePost=$post_vegan->getProfilePostLimit($id,$limit,$start);
          $data["responce"] = true; 
        $data['Postall_profile']=$veganProfilePost;
        echo json_encode($data);

    }	
	public function profileRecipe(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
         
        
         $limit=10;
         $start=0;

        if($this->request->getVar('limit')!=null){
             $limit=$this->request->getVar('limit');
         }
         if($this->request->getVar('start')!=null){
             $start=$this->request->getVar('start');
       }

        $id=$this->request->getVar('user_id');

         $recipes=new ReceipeModel();
         $data["responce"] = true;  
        $data['receipes']=$recipes->user_profile_recipe_list_api($id,$start,$limit);

         
        echo json_encode($data);

    }
	public function profileEvent(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
         
        
         $limit=10;
         $start=0;

        if($this->request->getVar('limit')!=null){
             $limit=$this->request->getVar('limit');
         }
         if($this->request->getVar('start')!=null){
             $start=$this->request->getVar('start');
       }

        $id=$this->request->getVar('user_id');

       $events = new EventModel();
         $data["responce"] = true;  
        $data['events']=$events->getAllEventProfileApi($id,$start,$limit);

         
        echo json_encode($data);

    }
	public function friendYouMayKnow(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
       

       $id = $this->request->getVar('user_id');
      
        $users = new UserModel();
        $result["responce"] = true; 
        $result['people_you_may_know']=$users->getAllUsersList($id);

        echo json_encode($result);
    }
     public function userFriendList(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
       

       $id = $this->request->getVar('user_id');
      
        $users = new UserModel();
        $result["responce"] = true; 
        $result['friend_list']=$users->getSingleUserFriend($id);

        echo json_encode($result);
    }
     //Recommendation 

     public function recommendation(){
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
        header('Access-Control-Allow-Headers: token, Content-Type');
              
       
              //$id = $this->request->getVar('user_id');
             
               $rm = new RecommendationModel();
               $result["responce"] = true; 
               $result['recommendationRestaurants']=$rm->recommendationRestutent();
               $result['recommendationProduct']=$rm->recommendationProductForApi();
                $result['recommendationCook']=$rm->recommendationCookForApi();
                 $result['recommendationRecipe']=$rm->recommendationRecipeForApi();
       
               echo json_encode($result);
           }
       
       
       
       
           public function recipesRecommendation(){
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
       
            public function recommendationRecipesDetailsById(){
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
        header('Access-Control-Allow-Headers: token, Content-Type');
               
       
                $id = $this->request->getVar('id');
              $receipe=new ReceipeModel();
                $data["responce"] = true;
                
               $data['receipe_detail']=$receipe->user_recipe_single($id);
                
               echo json_encode($data);
           }
    public function cook(){

        header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
       // $session = session();

         $id=1;
      $limit=7;
      $start=0;
           if($this->request->getVar('limit')!=null){
                 $limit=$this->request->getVar('limit');
        }
             if($this->request->getVar('start')!=null){
                 $start=$this->request->getVar('start');
        }



        $cooks = new CooksModel();
         $data["responce"] = true; 
        $data['cooks']=$cooks->getAllPostForApi($id,$start,$limit);

        echo json_encode($data);
    }
    public function cookDetailsById(){

        header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
       // $session = session();

       $id = $this->request->getVar('id');
      $cooks = new CooksModel();
         $data["responce"] = true; 
        $data['cooks']=$cooks->getSinglecooks_detail($id);

        echo json_encode($data);
    }

    public function countryCode(){

        header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
       // $session = session();

       
      $cooks = new UserModel();
         $data["responce"] = true; 
        $data['countries']=$cooks->getAllCountry();

        echo json_encode($data);
    }
     public function restaurant(){

        header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
       // $session = session();

         $id=1;
      $limit=7;
      $start=0;
           if($this->request->getVar('limit')!=null){
                 $limit=$this->request->getVar('limit');
        }
             if($this->request->getVar('start')!=null){
                 $start=$this->request->getVar('start');
        }



        $rest = new RestaurantsModel();
         $data["responce"] = true; 
        $data['restaurant']=$rest->getAllPostForApi($id,$start,$limit);

        echo json_encode($data);
    }

    public function restaurantDetailsById(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
        $session = session();

         $id = $this->request->getVar('post_id');
         $userid = $this->request->getVar('user_id');
        $rest= new RestaurantsModel();
         $data["responce"] = true;
         $data['restudent_details']=$rest->getSingleRest_detail($id,$userid);
         $data['restudent_features']=$rest->getPostFeaturesByPostid($id);
         $data['restudent_comments']=$rest->getPostCommentByPostid($id);
         $data['restudent_liked']=$rest->getPostLikeByPostid($id,$userid);
         
        echo json_encode($data);
    }

    public function restudentInsertLike(){
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
        die();
        }
    
         
        $rest = new RestaurantsModel();
        
         $result["responce"] = true; 
          
		 if($this->request->getVar('status')==1){
			 $result["message"] = 'Restaurant Like Successfully';
			 $id=$rest->insertRestaurantLike($this->request->getVar('post_id'),$this->request->getVar('user_id'));
			 $result["liked_status"] = 1;  
		 }else{
			 $result["message"] = 'Restaurant UnLike Successfully';
			  $id=$rest->deleteRestaurantLike($this->request->getVar('post_id'),$this->request->getVar('user_id'));
			$result["liked_status"] = 0;  
		 }
        
         echo json_encode($result);
    }
	public function restudentDeleteLike(){
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
        die();
        }
        $rest = new RestaurantsModel();
        $id=$rest->deleteRestaurantLike($this->request->getVar('post_id'),$this->request->getVar('user_id'));          
		$result["responce"] = true; 
         $result["message"] = 'Restaurant UnLike Successfully'; 
         $result["liked_status"] = 0; 
         echo json_encode($result);
    }
    public function restudentInsertComment(){
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
        die();
        }
    
        $data=[
        'post_id'=>$this->request->getVar('post_id'),
        'commented_by'=>$this->request->getVar('user_id'),
        'message'=>$this->request->getVar('message'),
        'created_at'=>date('Y-m-d H:i:s'),
        'status'=>1
        ]; 
        $rest = new RestaurantsModel();
        $id=$rest->insertPostComment($data);
        $data_inserted=$rest->getPostCommentByid($id);
         $result["responce"] = true; 
         $result["message"] = 'Data been inserted successfully'; 
         $result["insertcommetdata"] = $data_inserted; 
         echo json_encode($result);
}

public function restudentShowLastTwoComment(){
         header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');

       $id = $this->request->getVar('post_id');

      	$rest= new RestaurantsModel();
         $data["responce"] = true; 
        $data['comment']=$rest->getPostCommentUser($id);

        echo json_encode($data);
}

public function restudentShowAllComment(){
        header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
    header('Access-Control-Allow-Headers: token, Content-Type');
    $post_id = $this->request->getVar('post_id');
   	$rest= new RestaurantsModel();
     $data["responce"] = true; 
     $data['comment']=$rest->getPostComment($post_id);
     echo json_encode($data);
}









    public function product(){

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

       $product= new ProductModel();
        $data["responce"] = true; 
        $data['productall']=$product->getAllPostForApi($id,$start,$limit);
        $data['product_category']=$product->productCategories();

        echo json_encode($data);
    }

     public function productDetailsById(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
        

         $id = $this->request->getVar('id');
        $pro= new ProductModel();
         $data["responce"] = true;
         $data['product_details']=$pro->getSingleProduct_detail($id);
         
        echo json_encode($data);
    }
    //chat apis
    public function getChatGroups(){
        header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
header('Access-Control-Allow-Headers: token, Content-Type');
       $users = new UserChatModel();
       $userId=$this->request->getVar('userId');
       $data['chatgroups'] =$users->getChatGroups($userId);
       echo json_encode($data);
       
   }
   public function getChatUsers(){
       header('Access-Control-Allow-Origin: *');
       header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
       header('Access-Control-Allow-Headers: token, Content-Type');
       $users = new UserChatModel();
       $userId=$this->request->getVar('userId');
       $data['chatusers'] =$users->getChatUsers($userId);
       echo json_encode($data);
       
   }
   public function messageSend(){
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == "OPTIONS") {
    die();
    }
   $me = $this->request->getVar('userId');
   $db = db_connect();
   $to = $this->request->getVar('touserId');
   $msg = $db->escapeString($this->request->getVar('msg'));
   $date   = date("Y-m-d H:i:s");
   $db->query("INSERT INTO chat(`id`, `sender`, `reciever`, `msg`, `time`)  VALUES(0,'$me','$to','$msg','$date')" );
    $data['msg']='successfully inserted';
    $data['time']=date('H:i',strtotime($date));
    echo json_encode($data);	
   }
   public function messageReceiveSingle(){
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == "OPTIONS") {
    die();
    }
     $db = db_connect();
     $me = $this->request->getVar('userId');
     $to = $this->request->getVar('touserId');
       $return_string['result']=array();
       $return_strings['results']=array();
       $set_unread="";
       
       $data=$db->query("SELECT * FROM chat WHERE reciever = '".$me."' and sender='".$to."'  and status=0");
       $k=0;
       foreach($data->getResult() as $row){
           if($row->sender!=''){
           $data_user=$db->query("SELECT name,profile_image FROM users WHERE id='".$row->sender."'");
           $data_user_array=$data_user->getResult();
           if(isset($data_user_array[0])){
              $return_string['result'][$row->sender][$row->id]="<p class='in-title'>".$data_user_array[0]->name."<p><p class='in-time'>".date('H:i',strtotime($row->time))."</p><p class='in-msg'>".$row->msg."</p>";
              $set_unread.="'".$row->id."',";
                         
           }
               
           }
       $k++;	 
       }
       
       if($set_unread!=''){
           foreach($return_string['result'] as $key=>$value){
               sort($value);
               $return_strings['results'][$key]=$value;
           }
       
       
       $set_unread = trim($set_unread , ",");
       //$db->query("UPDATE chat SET status=1 WHERE id IN($set_unread)");
           
       }
       echo json_encode($return_strings); 	
   }
   public function messageReceiveAll(){
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == "OPTIONS") {
    die();
    }
     $db = db_connect();
     $me = $this->request->getVar('userId');
       $return_string['result']=array();
       $return_strings['results']=array();
       $set_unread="";
       
       $data=$db->query("SELECT * FROM chat WHERE reciever = '".$me."'  and status=0");
       $k=0;
       foreach($data->getResult() as $row){
           if($row->sender!=''){
           $data_user=$db->query("SELECT name,profile_image FROM users WHERE id='".$row->sender."'");
           $data_user_array=$data_user->getResult();
           if(isset($data_user_array[0])){
              $return_string['result'][$row->sender][$row->id]="<p class='in-title'>".$data_user_array[0]->name."<p><p class='in-time'>".date('H:i',strtotime($row->time))."</p><p class='in-msg'>".$row->msg."</p>";
              $set_unread.="'".$row->id."',";
                         
           }
               
           }
       $k++;	 
       }
       
       if($set_unread!=''){
           foreach($return_string['result'] as $key=>$value){
               sort($value);
               $return_strings['results'][$key]=$value;
           }
       
       
       $set_unread = trim($set_unread , ",");
       //$db->query("UPDATE chat SET status=1 WHERE id IN($set_unread)");
           
       }
       echo json_encode($return_strings); 	
   }
   public function messageSendReceiveAllOld(){
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == "OPTIONS") {
    die();
    }
       $db = db_connect();
   
       $set_unread="";
       $me = $this->request->getVar('userId');
       $user = $this->request->getVar('touserId');
       $data=$db->query("SELECT * FROM chat WHERE (sender = '$me' AND reciever = '$user') OR (sender = '$user' AND reciever = '$me') ORDER BY (time) ASC");
       $flag='';
       $i=0;
       $r_string='';
       $return_string['result']=array();
       foreach($data->getResult() as $row)
       {
          
          
          if($flag!=date('M d Y',strtotime($row->time))){
          $r_string.="<div class='chat-date-heading' >".date('M d Y',strtotime($row->time))."</div>";
          $flag=date('M d Y',strtotime($row->time));
          
          }
           if($row->sender == $me){
               $data_user=$db->query("SELECT name,profile_image FROM users WHERE id='".$row->sender."'");
               $data_user_array=$data_user->getResult();
               $r_string.="<div class='outgoing-chats' _ngcontent-skx-c173=''>
           <div class='outgoing-chats-msg'>
              
               <p class='out-title'>".$data_user_array[0]->name."</p>
               <p class='out-time'>".date('H:i',strtotime($row->time))."</p>
               <p class='out-msg'>".$row->msg."</p>
               
               
           </div>
           
        </div>";
               
           }else{
               $data_user=$db->query("SELECT name,profile_image FROM users WHERE id='".$row->sender."'");
               $data_user_array=$data_user->getResult();
               $r_string.= "<div class='received-chats'>
         
           <div class='received-msg'>
             <div class='received-msg-inbox'>
                <p class='in-title'>".$data_user_array[0]->name."</p>
               <p class='in-time'>".date('H:i',strtotime($row->time))."</p>
               <p class='in-msg'>".$row->msg."</p>
             </div>
           </div>
        </div>";	
           } 
           
            
           $set_unread.="'".$row->id."',";
           $i++;
       }
       $set_unread = trim($set_unread , ",");
       //$db->query("UPDATE chat SET status=1 WHERE id IN($set_unread)");
       $return_string['result']=$r_string;
       
       echo json_encode($return_string); 	
   }
   public function messageSendReceiveAll(){
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == "OPTIONS") {
    die();
    }
       $db = db_connect();
   
       $set_unread="";
       $me = $this->request->getVar('userId');
       $user = $this->request->getVar('touserId');
       $data=$db->query("SELECT * FROM chat WHERE (sender = '$me' AND reciever = '$user') OR (sender = '$user' AND reciever = '$me') ORDER BY (time) ASC");
       $flag='';
       $i=0;
       $r_string='';
       $return_string['result']=array();
       foreach($data->getResult() as $row)
       {
          
          
          if($flag!=date('M d Y',strtotime($row->time))){
          $r_string.="<div class='chat-date-heading'>".date('M d Y',strtotime($row->time))."</div>";
          $flag=date('M d Y',strtotime($row->time));
          
          }
           if($row->sender == $me){
               $data_user=$db->query("SELECT name,profile_image FROM users WHERE id='".$row->sender."'");
               $data_user_array=$data_user->getResult();
               $r_string.="<div class='outgoing-chats'>
           <div class='outgoing-chats-msg'>
              
               <p class='out-title'>".$data_user_array[0]->name."</p>
               <p class='out-time'>".date('H:i',strtotime($row->time))."</p>
               <p class='out-msg'>".$row->msg."</p>
               
               
           </div>
           
        </div>";
               
           }else{
               $data_user=$db->query("SELECT name,profile_image FROM users WHERE id='".$row->sender."'");
               $data_user_array=$data_user->getResult();
               $r_string.= "<div class='received-chats'>
         
           <div class='received-msg'>
             <div class='received-msg-inbox'>
                <p class='in-title'>".$data_user_array[0]->name."</p>
               <p class='in-time'>".date('H:i',strtotime($row->time))."</p>
               <p class='in-msg'>".$row->msg."</p>
             </div>
           </div>
        </div>";	
           } 
           
            
           $set_unread.="'".$row->id."',";
           $i++;
       }
       $set_unread = trim($set_unread , ",");
       //$db->query("UPDATE chat SET status=1 WHERE id IN($set_unread)");
	   
       $return_string['result']=$r_string;
       
       echo json_encode($return_string); 	
   }
   public function groupMessageSend(){
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == "OPTIONS") {
    die();
    }
      
       $me = $this->request->getVar('userId');
       $db = db_connect();
       $group_id     = $this->request->getVar('groupId');
       $msg    = $db->escapeString($this->request->getVar('msg'));
       $date   = date("Y-m-d H:i:s");
       
       $db->query("INSERT INTO chat_group_data(`id`, `group_id`, `user_id`, `msg`, `time`,`status_ids`)  VALUES(0,'".$group_id."','".$me."','".$msg."','".$date."','".$me."')" );
       $data['msg']='successfully inserted';
       $data['time']=date('H:i',strtotime($date));
       echo json_encode($data);		
   }
   public function groupMessageReceive(){
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == "OPTIONS") {
    die();
    }
       $db = db_connect();
       $return_string=array();
       $me = $this->request->getVar('userId');
       $group_id = $this->request->getVar('groupId');
       $set_unread ='';
       if($group_id!=''){
       $data=$db->query("SELECT * FROM chat_group_data 
       where group_id IN(".$group_id.")  and FIND_IN_SET(".$me.",status_ids) = 0 ");
       
       $set_unread='';
        foreach($data->getResult() as $row){
           $data_user=$db->query("SELECT name,profile_image FROM users WHERE id='".$row->user_id."'");
           $data_user_array=$data_user->getResult();
           $return_string[$row->group_id][$row->id]="<b>".$data_user_array[0]->name."</b><br>".$row->msg."<br>".date('H:i',strtotime($row->time))."</b>";
           $set_unread.="'".$row->id."',";
       }
       if($set_unread!=''){
       $set_unread = trim($set_unread , ",");
       
       //$db->query("UPDATE chat_group_data  set status_ids=CONCAT(status_ids,',".$me."') WHERE id IN($set_unread)");	
       }
   
       }
       
       echo json_encode($return_string);
   }
   public function groupMessageSendReceiveAll(){
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == "OPTIONS") {
    die();
    }
       $db = db_connect();
       $return_string="";
       $set_unread="";
       $me = $this->request->getVar('userId');
       $group_id = $this->request->getVar('groupId');
       $data=$db->query("SELECT * FROM chat_group_data WHERE 
       group_id = '".$group_id."'  ORDER BY (time) ASC");
	   $flag='';
        foreach($data->getResult() as $row){
			 if($flag!=date('M d Y',strtotime($row->time))){
          $return_string.="<div class='chat-date-heading'>".date('M d Y',strtotime($row->time))."</div>";
          $flag=date('M d Y',strtotime($row->time));
          
          }
           if($row->user_id == $me){
               $data_user=$db->query("SELECT name,profile_image FROM users WHERE id='".$row->user_id."'");
               $data_user_array=$data_user->getResult();
               $return_string.="<div class='outgoing-chats'>
           <div class='outgoing-chats-msg'>
               <p class='out-title'>".$data_user_array[0]->name."</p>
               <p class='out-time'>".date('H:i',strtotime($row->time))."</p>
               <p class='out-msg'>".$row->msg."</p> 				
           </div></div>";
               
           }else{
               $data_user=$db->query("SELECT name,profile_image FROM users WHERE id='".$row->user_id."'");
               $data_user_array=$data_user->getResult();
           $return_string.= "<div class='received-chats'>
         
           <div class='received-msg'>
             <div class='received-msg-inbox'>
               <p class='in-title'>".$data_user_array[0]->name."</p>
               <p class='in-time'>".date('H:i',strtotime($row->time))."</p>
               <p class='in-msg'>".$row->msg."</p>
               
             </div>
           </div>
        </div>";	
           } 
           
       }
       $return_strings['result']=$return_string;
       echo json_encode($return_strings);
       
   }
   public function createGroup(){
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == "OPTIONS") {
    die();
    }
       $db = db_connect();
       $group_name=$db->escapeString($this->request->getVar('groupName'));
       $group_member=explode(",",$this->request->getVar('groupMember'));
       $group_member[]=$this->request->getVar('userId');
       
       $date=date("Y-m-d H:i:s");
       $sql_already=$db->query("select group_id from chat_group where group_name='".$group_name."'");
       
               $db->query("INSERT INTO chat_group(`group_id`, `group_name`, `created_at`, `updated_at`, `created_by`, `status`)  VALUES(0,'".$group_name."','".$date."','".$date."','1','1')");
                $group_id=$db->insertID();
                foreach($group_member as $memberval){
                   $db->query("INSERT INTO chat_group_member(`id`, `user_id`, `group_id`, `created_at`)  VALUES(0,'".$memberval."','".$group_id."','".$date."')"); 	
                }
          $data['msg']='successfully created';
    $data['time']=date('Y-m-d H:i',strtotime($date));
    echo json_encode($data);
       
   }
   public function liveSearch(){
    header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
header('Access-Control-Allow-Headers: token, Content-Type');
   $user_details=[];
   $db = db_connect();
   $id=$this->request->getVar('term');
   $sql=$db->query("select id,profile_image,name from users where name like '%".$id."%'");
   $search=array();
   $search['Peoples']=array();
   $array=$sql->getResult();
   if(isset($array[0])){
       $i=0;
       foreach($array as $val){
           $imgurl=base_url().'/'.$val->profile_image;
           if($val->profile_image==''){
               $imgurl=base_url().'/public/frontend/images/f_icon_user.jpg';
           }
           $url=base_url().'/user/public_profile/'.$val->id;
           $search['Peoples'][$i]['id']=$val->id;
           $search['Peoples'][$i]['url']=$url;
           $search['Peoples'][$i]['imgurl']=$imgurl;
           $search['Peoples'][$i]['name']=$val->name;
           $search['Peoples'][$i]['type']='profile';
		   $search['Peoples'][$i]['type_id']=$val->id;
       $i++;	
       }
       
   }
   $search['Blogs']=array();
   $sql=$db->query("select id,image,title from blog_posts where title like '%".$id."%'");
   $array=$sql->getResult();
   if(isset($array[0])){
       $i=0;
       foreach($array as $val){
           $url=base_url().'/user/blog';
           $imgurl=base_url().'/'.$val->image;
           if($val->image==''){
               $imgurl=base_url().'/public/frontend/images/f_icon_user.jpg';
           }
           $search['Blogs'][$i]['id']=$val->id;
           $search['Blogs'][$i]['url']=$url;
           $search['Blogs'][$i]['imgurl']=$imgurl;
           $search['Blogs'][$i]['name']=$val->title;
           $search['Blogs'][$i]['type']='blog';
           $search['Blogs'][$i]['type_id']=$val->id;
           $i++;
       }
   }
   $search['Cooks']=array();
   $sql=$db->query("select id,image,name from cooks where name like '%".$id."%'");
   $array=$sql->getResult();
   if(isset($array[0])){
       $i=0;
       foreach($array as $val){
           $url=base_url().'/user/cook';
           $imgurl=base_url().'/'.$val->image;
           if($val->image==''){
               $imgurl=base_url().'/public/frontend/images/f_icon_user.jpg';
           }
           $search['Cooks'][$i]['id']=$val->id;
           $search['Cooks'][$i]['url']=$url;
           $search['Cooks'][$i]['imgurl']=$imgurl;
           $search['Cooks'][$i]['name']=$val->name;
           $search['Cooks'][$i]['type']='cook';
		   $search['Cooks'][$i]['type_id']=$val->id;
           $i++;
       }
   }
   $search['Events']=array();
   $sql=$db->query("select id,image,name from events where name like '%".$id."%'");
   $array=$sql->getResult();
   if(isset($array[0])){
       $i=0;
       foreach($array as $val){
           $url=base_url().'/user/cook';
           $imgurl=base_url().'/'.$val->image;
           if($val->image==''){
               $imgurl=base_url().'/public/frontend/images/f_icon_user.jpg';
           }
           $search['Events'][$i]['id']=$val->id;
           $search['Events'][$i]['url']=$url;
           $search['Events'][$i]['imgurl']=$imgurl;
           $search['Events'][$i]['name']=$val->name;
           $search['Events'][$i]['type']='event';
		   $search['Events'][$i]['type_id']=$val->id;
       $i++;	
       }
   }
   $search['News']=array();
   $sql=$db->query("select id,image,title from news_posts where title like '%".$id."%'");
   $array=$sql->getResult();
   if(isset($array[0])){
       $i=0;
       foreach($array as $val){
           $url=base_url().'/user/news';
           $imgurl=base_url().'/'.$val->image;
           if($val->image==''){
               $imgurl=base_url().'/public/frontend/images/f_icon_user.jpg';
           }
           $search['News'][$i]['id']=$val->id;
           $search['News'][$i]['url']=$url;
           $search['News'][$i]['imgurl']=$imgurl;
           $search['News'][$i]['name']=$val->title;
           $search['News'][$i]['type']='news';
           $search['News'][$i]['type_id']=$val->id;
           $i++;
       }
   }

   //notifications data
   echo json_encode($search);
   die;
}
public function notificationCount(){
   header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == "OPTIONS") {
    die();
    }
   $id=$this->request->getVar('userId');
   $db = db_connect();
   $tot=0;
   
   $notification_sql=$db->query("select count(un.id) as cnt from user_notifications un where un.read_status=0 and un.receiver_id='".$id."'");
   $notification_array=$notification_sql->getResult();
   if(isset($notification_array[0])){
    $tot=$notification_array[0]->cnt;	
   }
   
   $array=array('totalcount'=>$tot);
   echo json_encode($array);
   die;
   
}
public function notificationShow(){
   
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == "OPTIONS") {
    die();
    }
   $id=$this->request->getVar('userId');
   
   $user_details=[];
   $db = db_connect();
   //get details of notifications
   
   $notification_sql=$db->query("select us.name,us.profile_image,un.created_at,un.type,un.type_name,un.sender_id from user_notifications un 
   left join users us on un.sender_id=us.id 
   where un.read_status=0 and un.receiver_id='".$id."' order by un.id desc limit 0,3");
   $notification_array=$notification_sql->getResult();
   $i=0;
   if(isset($notification_array[0])){
       foreach($notification_array as $n_val){
           $name=$n_val->name;
           
           $image=$n_val->profile_image;
           $time=$n_val->created_at;
           $type=$n_val->type;
           $type_name=$n_val->type_name;
             if($name==''){
              $name='Admin';
              $image='public/frontend/images/logo.png';
            }
            $id=$n_val->sender_id;
            $user_details[$i]['id']=$id;
            $user_details[$i]['name']=$name;
            $user_details[$i]['profile_image']=base_url()."/".$image;
            $user_details[$i]['notification_pageicon']=base_url()."/".'public/frontend/images/notification_pageicon.png';
            if($type=='Request_Send'){
              $user_details[$i]['message']="send you friend request";	 
            }else if($type=='Request_Confirm'){
             $user_details[$i]['message']="confirm your friend request";	 
            }else{
            $user_details[$i]['message']=$type.' on your '.$type_name;	 
            }
                
            $user_details[$i]['timeview']=$this->time_Agos(strtotime($time));	
            $i++;
       }
   }
   //$db->query("update user_notifications set read_status=1 where receiver_id='".$id."'");
   echo json_encode($user_details);
   die;
   
}
public function notificationList(){
   
   header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == "OPTIONS") {
    die();
    }
   $id=$this->request->getVar('userId');
   
   $user_details=[];
   $db = db_connect();
   //get details of notifications
   
   $notification_sql=$db->query("select us.name,us.profile_image,un.created_at,un.type,un.type_name,un.sender_id from user_notifications un 
   left join users us on un.sender_id=us.id 
   where un.status=0 and un.receiver_id='".$id."' order by un.id desc");
   $notification_array=$notification_sql->getResult();
   $i=0;
   if(isset($notification_array[0])){
       foreach($notification_array as $n_val){
           $name=$n_val->name;
           
           $image=$n_val->profile_image;
           $time=$n_val->created_at;
           $type=$n_val->type;
           $type_name=$n_val->type_name;
             if($name==''){
              $name='Admin';
              $image='public/frontend/images/logo.png';
            }
            $id=$n_val->sender_id;
            $user_details[$i]['id']=$id;
            $user_details[$i]['name']=$name;
            $user_details[$i]['profile_image']=$image;
            $user_details[$i]['notification_pageicon']='public/frontend/images/notification_pageicon.png';
            if($type=='Request_Send'){
              $user_details[$i]['message']="send you friend request";	 
            }else if($type=='Request_Confirm'){
             $user_details[$i]['message']="confirm your friend request";	 
            }else{
            $user_details[$i]['message']=$type.' on your '.$type_name;	 
            }
                
            $user_details[$i]['timeview']=$this->time_Agos(strtotime($time));	
            $i++;
       }
   }
   //$db->query("update user_notifications set read_status=1 where receiver_id='".$id."'");
   echo json_encode($user_details);
   die;
   
}


public function time_Agos($time) {
$msg='';
// Calculate difference between current
// time and given timestamp in seconds
$diff     = time() - $time;
 
// Time difference in seconds
$sec     = $diff;
 
// Convert time difference in minutes
$min     = round($diff / 60 );
 
// Convert time difference in hours
$hrs     = round($diff / 3600);
 
// Convert time difference in days
$days     = round($diff / 86400 );
 
// Convert time difference in weeks
$weeks     = round($diff / 604800);
 
// Convert time difference in months
$mnths     = round($diff / 2600640 );
 
// Convert time difference in years
$yrs     = round($diff / 31207680 );
 
// Check for seconds
if($sec <= 60) {
   $msg= "$sec seconds ago";
}
 
// Check for minutes
else if($min <= 60) {
   if($min==1) {
       $msg= "one minute ago";
   }
   else {
       $msg= "$min minutes ago";
   }
}
 
// Check for hours
else if($hrs <= 24) {
   if($hrs == 1) { 
       $msg= "an hour ago";
   }
   else {
       $msg= "$hrs hours ago";
   }
}
 
// Check for days
else if($days <= 7) {
   if($days == 1) {
       $msg= "Yesterday";
   }
   else {
       $msg= "$days days ago";
   }
}
 
// Check for weeks
else if($weeks <= 4.3) {
   if($weeks == 1) {
       $msg= "a week ago";
   }
   else {
       $msg= "$weeks weeks ago";
   }
}
 
// Check for months
else if($mnths <= 12) {
   if($mnths == 1) {
       $msg= "a month ago";
   }
   else {
       $msg= "$mnths months ago";
   }
}
 
// Check for years
else {
   if($yrs == 1) {
       $msg= "one year ago";
   }
   else {
       $msg= "$yrs years ago";
   }
}
return $msg;
}

    public function test($lang)
    {
        $languageFile = ROOTPATH . "app/Language/$lang/app.php";
        if (file_exists($languageFile)) {
            $languageData = include($languageFile);
            return $this->response->setJSON($languageData);
        } else {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'Language file not found']);
        }
    }

}
?>