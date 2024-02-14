<?php
namespace App\Controllers;
use App\Models\EventModel;
use App\Models\PostModel;
use App\Models\RestaurantsModel;
use App\Models\SubscriptionPurchaseModel;
use App\Models\UserChatModel;
use App\Models\UserModel;
use CodeIgniter\Controller;
use App\Models\SubscriptionModel;
use Razorpay\Api\Api;

class SubscriptionController extends BaseController
{
    protected $subscriptionModel;
    protected $subscriptionPurchaseModel;
    protected $api;
    public function __construct()
    {
        $this->api= new Api(getenv('RZP_KEY_TEST'), getenv('RZP_KEY_SECRET_TEST'));
        $this->subscriptionModel=new SubscriptionModel();
        $this->subscriptionPurchaseModel=new SubscriptionPurchaseModel();
    }

    public function index()
    {
        $session = session();
        $users = new UserChatModel();
        $data['chatusers'] =$users->getChatUsers();
        $data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
        $data['session'] =$session;

        $users = new UserModel();
        $data['users']=$users->getSingleUser($session->get('idUserH'));
        $data['loginusers']=$users->getSingleUser($session->get('idUserH'));
        $data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
        $data['subscriptions']=$this->subscriptionModel->all();
        return view('user/subscription/list',$data);
    }

    function purchase($id)
    {
        $s=new SubscriptionModel();
        $u=new UserModel();
        $s=$s->byId($id)[0];
        $u=(object)$u->getSingleUser(session()->get('idUserH'));
        $order=$this->api->paymentLink->create([
            'reference_id'=>'ref_'.uniqid().'_'.$s->id,
            'amount'=>$s->price*100,
            'currency'=>'INR',
            'accept_partial'=>false,
            'expire_by' => time()+20*60,
            'description' => getenv("APP_NAME")." ".$s->title." Membership",
            'customer' => [
                'name'=>$u->name,
                'email' => $u->email,
//                'contact'=>$u->mobile_no
            ],
//            'notify'=>[
//                'sms'=>true,
//                'email'=>true
//            ] ,
            'callback_url' => base_url('subscription/handler'),
        ]);
        if (isset($order->short_url)){
            header("Location: $order->short_url");
            die();
        }
    }
    function handlePurchase()
    {
        try {
            $apiResponse=$this->api->paymentLink->fetch($this->request->getGet('razorpay_payment_link_id'));
            echo ($this->subscriptionPurchaseModel->insertPayment($apiResponse,(object)$this->request->getGet()))?'Ok':'No';
        } catch (Exception $exception){
            die("Invalid Operation");
        }
    }
}