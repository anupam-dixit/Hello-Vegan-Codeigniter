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

class DemoA extends BaseController
{
    
    
 public function login(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
 $session = session();
 $db = db_connect();
 $data = array(); 
 $users = new UserModel();
 $email = $this->request->getVar('email');
 $password = $this->request->getVar('password');
  $res = $users->where('email', $email)->first();
 
  if($res){
        $pass = $res['password'];
        $checkStatus = $users->where('email', $email)->where('status',1)->first();
        if ($checkStatus){
            $authenticatePassword = password_verify($password, $pass);
              if($authenticatePassword){
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
                                "mobile_no"=>$res['mobile_no']
                             ) ;
                }
       else{
        $data["responce"] = false;  
        $data["error"] = 'Invalide Username or Passwords';
    }
}else{
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


    public function news(){
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
 header('Access-Control-Allow-Headers: token, Content-Type');
        $session = session();
         $news= new NewsModel();
         $data["responce"] = true; 
         $data['news']=$news->getAllNewstByUser(1);
        $data['news_latest']=$news->getLatestNewsByUser(1);
        $data['news_category']=$news->getAllPostCategory();

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


   
}
?>