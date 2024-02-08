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

class ApiController extends BaseController
{
    
    // For login   API
    public function sendForgotPasswordLink(){
		//send email
        $session = session();
		$users = new UserModel();
		$emailId=$this->request->getPost('email');
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
        $to=$this->request->getPost('email');
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
	public function login(){
         header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
		$session = session();
        $db = db_connect();
            $data = array(); 
            $_POST = $_REQUEST;   

            $session = session();

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


    // For SignUp   API
    public function signup(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
        $session = session();
        
        $users = new UserModel();
        $rand=time().rand(10,100);


        

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
           

            $result["status"] = "success"; 
             $result["responce"] = true; 
             $result["message"] = "User Register Sucessfully..";

       }else{
             $result["status"] = "fail"; 
             $result["responce"] = false; 

       }
        echo json_encode($result);
    }

     public function recipes(){

        header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
        $session = session();

        $receipe= new ReceipeModel();
         $data["responce"] = true; 
       $data['receipeall']=$receipe->user_recipe_list($session->get('idUserH'));
        $data['receipe_category']=$receipe->user_recipe_category();

        echo json_encode($data);
    }

     public function recipesDetailsById(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
        $session = session();

         $id = $this->request->getVar('id');
       $receipe=new ReceipeModel();
         $data["responce"] = true;
         
        $data['receipe_detail']=$receipe->user_recipe_single($id);
         
        echo json_encode($data);
    }



    public function product(){

        header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
        $session = session();

       $product= new ProductModel();
        $data["responce"] = true; 
        $data['productall']=$product->getAllPost();
        $data['product_category']=$product->productCategories();

        echo json_encode($data);
    }

     public function productDetailsById(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
        $session = session();

         $id = $this->request->getVar('id');
        $pro= new ProductModel();
         $data["responce"] = true;
         $data['product_details']=$pro->getSingleProduct_detail($id);
         
        echo json_encode($data);
    }



     public function restaurant(){

        header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
        $session = session();

        $rest = new RestaurantsModel();
         $data["responce"] = true; 
        $data['restaurant']=$rest->getAllPost();

        echo json_encode($data);
    }

    public function restaurantDetailsById(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
        $session = session();

         $id = $this->request->getVar('id');
        $rest= new RestaurantsModel();
         $data["responce"] = true;
         $data['restudent_details']=$rest->getSingleRest_detail($id);
         
        echo json_encode($data);
    }



    public function blog(){

        header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
		$session = session();

        $blog= new BlogModel();
         $data["responce"] = true; 
        $data['blogall']=$blog->getAllPostByUser($session->get('idUserH'));
        $data['latest_blog']=$blog->getLatestBlogByUser($session->get('idUserH'));

        echo json_encode($data);
    }

    public function blog_category(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
        $session = session();

       $blog= new BlogModel();
         $data["responce"] = true; 
        $data['blog_category']=$blog->getAllPostCategoryByUser();

        echo json_encode($data);
    }

     public function blog_by_category(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
        $session = session();

        $month = $this->request->getVar('month');
        $year = $this->request->getVar('year');

       $blog= new BlogModel();
         $data["responce"] = true; 
        $data['blogall']=$blog->getAllPostYearByUser($session->get('idUserH'),$month,$year);

        echo json_encode($data);
    }

     public function blog_show_latest_two_comment(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
        $session = session();

       $post_id = $this->request->getVar('post_id');

       $blog= new BlogModel();
         $data["responce"] = true; 
        $data['comment']=$blog->getPostCommentUser($post_id);

        echo json_encode($data);
    }

    public function blog_show_all_comment(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
       

       $post_id = $this->request->getVar('post_id');

       $blog= new BlogModel();
         $data["responce"] = true; 
        $data['comment']=$blog->getPostComment($post_id);

        echo json_encode($data);
    }

     public function blog_comment(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
        $session = session();

       $id=$this->request->getVar('post_id');
        $data=[
        'post_id'=>$this->request->getVar('post_id'),
        'commented_by'=>$this->request->getVar('user_id'),
        'message'=>$this->request->getVar('message'),
        'created_at'=>date('Y-m-d H:i:s'),
        'status'=>1
        ]; 
         $blog = new BlogModel();
         $blog->insertPostComment($data);

           $result["responce"] = true; 
          $result["message"] = 'Data been inserted successfully'; 

        echo json_encode($result);
    }





     public function add_blog(){

        header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');

       $post_image_db_data='';
        $post_image = $this->request->getFile('image');
        $post_image_name = $post_image->getName();
        if($post_image_name!=''){
            $post_image_name=time().$post_image_name;
            $post_image->move(ROOTPATH.'public/uploads/blog/post/',$post_image_name);
            $post_image_db_data='public/uploads/blog/post/'.$post_image_name;
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
        $post_video_name = $post_video->getName();
        if($post_video_name!=''){
            $post_video_name=time().$post_video_name;
            $post_video->move(ROOTPATH.'public/uploads/blog/post/',$post_video_name);
            $post_videofile_db_data='public/uploads/blog/post/'.$post_video_name;
        }
        


        
        $post_video_db_data=$this->request->getVar('video');
        $data=[
        // 'post_category_id'=>date('m'),
       'post_category_id'=>$this->request->getVar('post_category_id'),
       'title'=>$this->request->getVar('title'),
        // 'hastag'=>$this->request->getPost('hastag'),
        'tags'=>$this->request->getVar('tags'),
        'galleryimage'=>$post_galleryimage_db_data,
        'video'=>$post_videofile_db_data,
        'location'=>$this->request->getVar('location'),
        'content'=>$this->request->getVar('detail'),
        'posted_by'=>$this->request->getVar('user_id'),
        'image'=>$post_image_db_data,
        // 'video'=>$post_video_db_data,
        'status'=>0,
        
        ]; 
         $rm = new BlogModel();
         $rm->insertBlog($data);

           $result["responce"] = true; 
          $result["message"] = 'Data been inserted successfully'; 

        echo json_encode($result);
    }


     public function blogDetailsById(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
        $session = session();

         $id = $this->request->getVar('id');
        $blog= new BlogModel();
         $data["responce"] = true; 
        $data['blog_details']=$blog->getSingleblogs($id);

        echo json_encode($data);
    }


     public function dashboard(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
        $session = session();

      $post_vegan= new PostModel();
         $data["responce"] = true; 
        $data['vaganpost'] =$post_vegan->getVeganPostLimit($session->get('idUserH'),7,0);

      

        echo json_encode($data);
    }


     public function dashboard_like(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
        $session = session();

        $id=$this->request->getVar('post_id');
        $data=[
        'post_id'=>$this->request->getVar('post_id'),
        'liked_by'=>$this->request->getVar('user_id'),
        'created_at'=>date('Y-m-d H:i:s'),
        'status'=>$this->request->getVar('status')
        ]; 

         $post = new PostModel();
         $post->insertPostLike($data);
     
         $result["responce"] = true; 
          $result["message"] = 'Data been inserted successfully'; 
        echo json_encode($result);
    }


     public function dashboard_comment(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
        $session = session();

       $data=[
        'post_id'=>$this->request->getVar('post_id'),
        'commented_by'=>$this->request->getVar('commented_by'),
        'message'=>$this->request->getVar('message'),
        'created_at'=>date('Y-m-d H:i:s'),
        'status'=>1
        ]; 
         $post = new PostModel();
         $post->insertPostComment($data);

         $result["responce"] = true; 
          $result["message"] = 'Data been inserted successfully'; 
        echo json_encode($result);
    }


     public function dashboard_show_comment(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
        $session = session();
        $id = $this->request->getVar('id');
        $post = new PostModel();
         $data["responce"] = true;
         $data['comment']=$post->getPostComment($id);
        echo json_encode($data);
    }

    public function dashboard_show_last_two_comment(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
        $session = session();
        $id = $this->request->getVar('id');
        $post = new PostModel();
         $data["responce"] = true;
         $data['comment']=$post->getPostCommentUser($id);
        echo json_encode($data);
    }


     public function dashboard_add_post(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
        $session = session();

       $post_image_db_data='';
        $post_image = $this->request->getFile('create_post_image');
        
        $post_image_name = $post_image->getName();
        if($post_image_name!=''){
            $post_image_name=time().$post_image_name;
            $post_image->move(ROOTPATH.'public/uploads/user/veganpost/',$post_image_name);
            $post_image_db_data='public/uploads/user/veganpost/'.$post_image_name;
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
        $posts->insertPost($data);

        

         $result["responce"] = true; 
          $result["message"] = 'Data been inserted successfully'; 
        echo json_encode($result);
    }








     public function event(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
        $session = session();

       $events = new EventModel();
         $data["responce"] = true; 
        $data['events']=$events->getAllEventByUser($session->get('idUserH'));

       $data['event_latest']=$events->getLatestEventByUser($session->get('idUserH'));

        echo json_encode($data);
    }


     public function eventCategory(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
        $session = session();

       $events = new EventModel();
         $data["responce"] = true; 
       $data['event_category']=$events->getAllEventCategories();

        echo json_encode($data);
    }

    public function eventByCategory(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
        $session = session();


        $categoryId = $this->request->getVar('cat_id');
       $events = new EventModel();
         $data["responce"] = true; 
       $data['events']=$events->getAllEventByCategory($session->get('idUserH'),$categoryId);

        echo json_encode($data);
    }


     public function eventShowLastTwoComment(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
        $session = session();


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
        $session = session();


        $id = $this->request->getVar('post_id');
       $events = new EventModel();
         $data["responce"] = true; 
       $data['events_comment']=$events->getEventCommentdetail($id);

        echo json_encode($data);
    }

     public function eventComment(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');

       $id=$this->request->getPost('post_id');
        $data=[
        'event_id'=>$this->request->getPost('post_id'),
        'comment_by'=>$this->request->getPost('user_id'),
        'message'=>$this->request->getPost('message'),
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


     public function eventNotIntersted(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');

      $id=$this->request->getPost('event_id');
        $data=[
        'event_id'=>$this->request->getPost('event_id'),
        'user_id'=>$this->request->getPost('user_id'),
        'created_at'=>date('Y-m-d H:i:s'),
        'status'=>1
        ]; 
         $event = new EventModel();
         $event->insertNotinterstedEvent($data);

          $result["responce"] = true; 
          $result["message"] = 'event is successfully remove'; 

        echo json_encode($result);
    }


    public function eventGoing(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');

       $id=$this->request->getPost('event_id');
        $data=[
        'event_id'=>$this->request->getPost('event_id'),
        'user_id'=>$this->request->getPost('user_id'),
        'created_at'=>date('Y-m-d H:i:s'),
        'status'=>$this->request->getPost('status')
        ]; 
         $post = new EventModel();
         $post->insertEventGoing($data);

          $result["responce"] = true; 
          $result["message"] = 'Data been inserted successfully'; 

        echo json_encode($result);
    }

     public function addEvent(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');

      $post_image_db_data='';
        $post_image = $this->request->getFile('image');
        $post_image_name = $post_image->getName();
        if($post_image_name!=''){
            $post_image_name=time().$post_image_name;
            $post_image->move(ROOTPATH.'public/uploads/event/post/',$post_image_name);
            $post_image_db_data='public/uploads/event/post/'.$post_image_name;
        }
        
        $post_video_db_data=$this->request->getPost('video');
        $data=[
        'category'=>$this->request->getPost('category_id'),
        'name'=>$this->request->getPost('name'),
        'location'=>$this->request->getPost('location'),
        'posted_by'=>$this->request->getPost('user_id'),
        'event_start_date'=>$this->request->getPost('event_start_date').' '.$this->request->getPost('event_start_time'),
        'event_end_date'=>$this->request->getPost('event_end_date').' '.$this->request->getPost('event_end_time'),
        'details'=>$this->request->getPost('details'),
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
        $session = session();

         $id = $this->request->getVar('id');
        $events = new EventModel();
         $data["responce"] = true;
         $data['event_details']=$events->getSingleEvent($id);
         
        echo json_encode($data);
    }


    public function newsCategory(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
      
         $news= new NewsModel();
         $data["responce"] = true; 
       $data['news_category']=$news->getAllNewsCategory();

        echo json_encode($data);
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
        $data['news_by_category']=$news->getAllNewsByCategoryLimitForApi($cat_id,$start,$limit);

        echo json_encode($data);
    }

     public function newsShowComment(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
        $session = session();
        $id = $this->request->getVar('id');
      $news= new NewsModel();
         $data["responce"] = true;
        $data['new_comment']=$news->getcommentByPostId($id);
        echo json_encode($data);
    }

    public function newsComment(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
        $session = session();

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

     public function newsDetailsById(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
        $session = session();

         $id = $this->request->getVar('id');
         $news= new NewsModel();

         $data["responce"] = true; 
         $data['news_details']=$news->getSinglebNewById($id);
        echo json_encode($data);
    }


    //this is for profile api for the user


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
        $users = new UserModel();
        $data['users_details']=$users->getSingleUser($id);
		$data['userfriend']=$users->getSingleUserFriend($id,); 
        
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
         
         $veganProfileBlog=$blog->getAllPostByUserForProfileForApi($id,$limit,$start);
          $data["responce"] = true; 
        $data['blogall_profile']=$veganProfileBlog;
        echo json_encode($data);

    }


  
    
    
   
}
?>