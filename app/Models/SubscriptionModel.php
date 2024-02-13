<?php 
namespace App\Models;  
use CodeIgniter\Model;
class SubscriptionModel extends Model{
//    protected $table = 'subscriptions';
//    protected $allowedFields = [
//        'title',
//        'price',
//        'validity',
//        'data'
//    ];
	public function all(){
		$sql="select * from subscriptions";
        return $this->db->query($sql)->getResult();
	}
    public function byId($id){
        $sql="select * from subscriptions where id=$id";
        return $this->db->query($sql)->getResult();
    }
}