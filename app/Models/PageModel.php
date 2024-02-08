<?php 
namespace App\Models;  
use CodeIgniter\Model;
class PageModel extends Model{

	public function getPageContent($pageName) {
        $sql="select * from pages where page_name='".$pageName."'"; 
		$query=$this->db->query($sql);
		$result=$query->getResultArray();
		return $result;
    }
}