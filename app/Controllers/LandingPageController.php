<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\LandingPageModel;
class LandingPageController extends BaseController
{

   public function index()
	{
        return view('landingpage/index');
	}
	public function sendNewsLatter(){
		if($this->request->getPost('email')!=''){
		$data=[
		'email'=>$this->request->getPost('email'),
		'created_at'=>date('Y-m-d H:i')
		]; 
		 
		 $posts = new LandingPageModel();
		 $id=$posts->insertNewsLatter($data);	
		}
		
		 die;
	}
}	