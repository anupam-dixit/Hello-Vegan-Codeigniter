<?php 

namespace App\Models;  
use CodeIgniter\Model;

  
class LandingPageModel extends Model{



	public function insertNewsLatter($data){
		$this->db->table('newslatter')->insert($data);
		return $this->db->insertID();
	}
	
	
}