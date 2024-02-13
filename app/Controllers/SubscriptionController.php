<?php
namespace App\Controllers;
use App\Models\EventModel;
use App\Models\PostModel;
use App\Models\RestaurantsModel;
use App\Models\UserChatModel;
use App\Models\UserModel;
use CodeIgniter\Controller;
use App\Models\SubscriptionModel;
class SubscriptionController extends BaseController
{
    protected $subscriptionModel;
    public function __construct()
    {
        $this->subscriptionModel=new SubscriptionModel();
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
        require_once('app/Libraries/stripe-php/init.php');
        \Stripe\Stripe::setApiKey(getenv('STRIPE_SECRET_KEY'));
        $customerList = \Stripe\Customer::all(['email' => session()->get('emailUserH')]);
        $customer=null;
        $u=new UserModel();
        $u=(object)$u->getSingleUser(session()->get('idUserH'));
        if (count($customerList->data)==0){
            // New Customer
            $customer = \Stripe\Customer::create([
                'email' => $u->email,
                'name' => "$u->name $u->last_name",
                'phone' => $u->mobile_no,
                'address' => [
                    'line1' => $u->address,
                    'city' => $u->city,
                    'state' => $u->state,
                    'postal_code' => $u->pin_code,
//                    'country' => 'IN',
                ],
            ]);
        } else{
            $customer=$customerList->first();
        }
        $d= \Stripe\Checkout\Session::create([
            'customer' => $customer->id,
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'unit_amount' => 2000, // Amount in cents
                        'product_data' => [
                            'name' => 'Your Product Name',
                        ],
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => 'https://example.com/success',
            'cancel_url' => 'https://example.com/cancel',
        ]);
        return json_encode($d);
    }
}