<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\AdminModel;
use App\Models\EmailManagementModel;
class EmailManagementController extends BaseController
{
	public function index()
	{

	}
	public function ListPage(){
		$users = new EmailManagementModel();
		$data['emaillists'] =$users->getAllEmailList();
		return view('admin/email_management/listPage',$data);
	}
	public function EditEmailContent(){
	$users = new EmailManagementModel();	
	$data['email_details'] =$users->getSingleEmail($this->request->uri->getSegment(4));
   	return view('admin/email_management/editPage',$data);
	
	}
	
	
}
