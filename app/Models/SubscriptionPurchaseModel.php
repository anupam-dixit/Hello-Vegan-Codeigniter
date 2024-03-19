<?php 
namespace App\Models;  
use CodeIgniter\Model;
use DateTime;

class SubscriptionPurchaseModel extends Model{
    protected $table='subscription_purchase';
	public function all(){
		$sql="select * from $this->table";
        return $this->db->query($sql)->getResult();
	}
    public function byId($id){
        $sql="select * from $this->table where id=$id";
        return $this->db->query($sql)->getResult();
    }
    public function insertPayment($apiResp,$queryParams){
        $userId=(session()->get('idUserH'))?session()->get('idUserH'):convert_uudecode($queryParams->i);
        $sql="insert into subscription_purchase (subscription_id, amount_paid, payment_id, payment_link_id, payment_link_reference_id, status, created_by, expire_at) 
                values (
                        '".explode("_",$apiResp->reference_id)[2]."',
                        '".($apiResp->amount_paid/100)."',
                        '".$queryParams->razorpay_payment_id."',
                        '".$queryParams->razorpay_payment_link_id."',
                        '".$queryParams->razorpay_payment_link_reference_id."',
                        '".$apiResp->status."',
                        '".$userId."',
                        (select ADDDATE(NOW(),(select subscriptions.validity from subscriptions where id=".explode("_",$apiResp->reference_id)[2].")))
                        )";
        return $this->db->query($sql);
    }

    function userActiveSubscription($userId)
    {
        $sql=$this->db()->table($this->table)->where('created_by',$userId)->orderBy('created_at','desc')->limit(1);

        $purchase=(object)[];
        $execute=$sql->get()->getFirstRow();
        $purchase->purchase=($execute)?$execute:[];
        if($purchase->purchase&&(new DateTime($purchase->purchase->expire_at)>=new DateTime("today"))){
//            $purchase->subscription=$sql->join('subscriptions','subscriptions.id=subscription_purchase.subscription_id')->get()->getFirstRow();
            $purchase->subscription=$this->db->table('subscriptions')->where('id',$purchase->purchase->subscription_id)->get()->getFirstRow();
        }
        else{
            $purchase->subscription=$this->db->table('subscriptions')->where('id',0)->get()->getFirstRow();
        }
        $purchase->usage['post']=$this->db()->table("posts")->where('posted_by',$userId)->countAll();
        $purchase->usage['blog']=$this->db()->table("blog_posts")->where('posted_by',$userId)->countAll();
        $purchase->usage['recipe']=$this->db()->table("receipe_user")->where('posted_by',$userId)->countAll();
        $purchase->subscription->data=json_decode($purchase->subscription->data);
        return $purchase;
    }
    function userLastSubscriptionPurchase($userId)
    {
        $sql=$this->db()->table($this->table)->where('created_by',$userId)->orderBy('created_at','desc')->limit(1);
        $purchase=($sql->get()->getFirstRow())?$sql->get()->getFirstRow():null;
        if($purchase){
            $purchase->subscription=$sql->join('subscriptions','subscriptions.id=subscription_purchase.subscription_id')->get()->getFirstRow();
        }
        return $purchase;
    }
}