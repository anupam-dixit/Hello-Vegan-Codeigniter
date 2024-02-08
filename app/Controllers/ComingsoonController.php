<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\UserModel;
class ComingsoonController extends BaseController
{
	public function index()
	{
		return view('comingsoon/coming_soon_message');
	}
}
