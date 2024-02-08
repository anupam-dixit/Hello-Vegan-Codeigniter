<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\AdminModel;
use App\Models\ChatModel;
class ChatController extends BaseController
{
	public function index()
	{

	}
	public function chatPage(){
		$users = new ChatModel();
		$data['chatusers'] =$users->getAllChatUsers();
		$data['chatgroups'] =$users->getAllChatGroups();
		/* echo "<pre>";
		print_r($data);
		die; */
		return view('admin/chat/chatPage',$data);
	}
	public function viewAllChat(){
   	$users = new ChatModel();
	$ex=explode("-",$this->request->uri->getSegment(4));
  	
	$data['users_message'] =$users->getUsersMessage($ex[0],$ex[1]);

	return view('admin/chat/viewAllChat',$data);	
	}
	public function viewGroupChat(){
	$users = new ChatModel();
	$data['groups_message'] =$users->getGroupsMessage($this->request->uri->getSegment(4));	
	return view('admin/chat/viewGroupChat',$data);	
	}
	/* public function listChatUser(){
		$users = new ChatModel();
		$data['elements'] =$users->getAllChatUser();
		return view('admin/chat/usersChat',$data);
	} */
	
}
