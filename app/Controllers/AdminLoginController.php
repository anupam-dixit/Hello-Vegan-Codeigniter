<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\AdminModel;
class AdminLoginController extends BaseController
{
	public function index()
	{
		
	}
	public function login(){
		return view('admin/admin_login/login');
	}
	public function loginAuth()
    {
        
		$session = session();

        $adminModel = new AdminModel();

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        
        $data = $adminModel->where('email', $email)->first();
        if($data){
            $pass = $data['password'];
            $authenticatePassword = password_verify($password, $pass);
            if($authenticatePassword){
                $ses_data = [
                    'id' => $data['id'],
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'isLoggedIn' => TRUE
                ];

                $session->set($ses_data);
                return redirect()->to('/admin/dashboard');
            
            }else{
                $session->setFlashdata('msg', 'Password is incorrect.');
                return redirect()->to('/admin/login');
            }

        }else{
            $session->setFlashdata('msg', 'Email does not exist.');
            return redirect()->to('/admin/login');
        }
    }
	 public function logout()
    {
        $session = session();
		$array_items = ['id', 'name','email','isLoggedIn'];
		$session->remove($array_items);
		//$session->destroy();
        return redirect()->to('/admin/login');
    }
}
