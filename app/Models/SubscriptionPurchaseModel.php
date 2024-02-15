<?php 
namespace App\Models;  
use CodeIgniter\Model;

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
        $sql="insert into subscription_purchase (subscription_id, amount_paid, payment_id, payment_link_id, payment_link_reference_id, status, created_by, expire_at) 
                values (
                        '".explode("_",$apiResp->reference_id)[2]."',
                        '".($apiResp->amount_paid/100)."',
                        '".$queryParams->razorpay_payment_id."',
                        '".$queryParams->razorpay_payment_link_id."',
                        '".$queryParams->razorpay_payment_link_reference_id."',
                        '".$apiResp->status."',
                        '".session()->get('idUserH')."',
                        (SELECT FROM_UNIXTIME(".$apiResp->expire_by."))
                        )";
        return $this->db->query($sql);
    }
}