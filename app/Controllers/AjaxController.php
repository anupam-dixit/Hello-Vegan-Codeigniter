<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\BlogModel;
use App\Models\UserChatModel;
use App\Models\VeganPostModel;
use App\Models\EventModel;
use App\Models\RecommendationModel;
use App\Models\NewsModel;
use App\Models\ReceipeModel;
use App\Models\PostModel;
use App\Models\PageModel;
use App\Models\CooksModel;
use App\Models\ProductModel;
use App\Models\RestaurantsModel;

class AjaxController extends BaseController{
    public function deletePost($id)
    {
        $postModal = new PostModel();
        $data = $postModal->deletePost($id);
        return $this->response->setJSON(['status'=>$data,'message'=>($data)?'Deleted successfully':'Unable to perform this action','data'=>null]);
    }
}
?>