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
use App\Models\CooksModel;
use App\Models\ProductModel;
use App\Models\RestaurantsModel;

class UserController extends BaseController
{
	public function index()
	{

	}
	public function liveSearch($id){
		$user_details=[];
		$db = db_connect();
		$search='<div class="search_iteam_all">';
		//get details of notifications
		$sql=$db->query("select id,profile_image,name from users where name like '%".$id."%'");
		$array=$sql->getResult();
		if(isset($array[0])){
			$search.='<div class="search_iteam_title"> Peoples </div>';
			foreach($array as $val){
				$url=base_url().'/user/public_profile/'.$val->id;
				$imgurl=base_url().'/'.$val->profile_image;
				if($val->profile_image==''){
					$imgurl=base_url().'/public/frontend/images/f_icon_user.jpg';
				}
				$search.='<div class="search_iteam_one">';
            	$search.='<a href="'.$url.'"><span><img src="'.$imgurl.'"></span>';
                $search.='<p>'.$val->name.'</p></a>';
                $search.='</div>';
				
			}
			
		}
		
		$sql=$db->query("select image,title from blog_posts where title like '%".$id."%'");
		$array=$sql->getResult();
		if(isset($array[0])){
		$search.='<div class="search_iteam_title"> Blogs </div>';	
			foreach($array as $val){
				$url=base_url().'/user/blog';
				$imgurl=base_url().'/'.$val->image;
				if($val->image==''){
					$imgurl=base_url().'/public/frontend/images/f_icon_user.jpg';
				}
				$search.='<div class="search_iteam_one">';
            	$search.='<a href="'.$url.'"><span><img src="'.$imgurl.'"></span>';
                $search.='<p>'.$val->title.' </p></a>';
                $search.='</div>';
				
			}
		}
		
		$sql=$db->query("select image,name from cooks where name like '%".$id."%'");
		$array=$sql->getResult();
		if(isset($array[0])){
			$search.='<div class="search_iteam_title"> Cooks </div>';
			foreach($array as $val){
				$url=base_url().'/user/cook';
				$imgurl=base_url().'/'.$val->image;
				if($val->image==''){
					$imgurl=base_url().'/public/frontend/images/f_icon_user.jpg';
				}
				$search.='<div class="search_iteam_one">';
            	$search.='<a href="'.$url.'"><span><img src="'.$imgurl.'"></span>';
                $search.='<p>'.$val->name.' </p></a>';
                $search.='</div>';
				
			}
		}
		$sql=$db->query("select image,name from events where name like '%".$id."%'");
		$array=$sql->getResult();
		if(isset($array[0])){
			$search.='<div class="search_iteam_title"> Events </div>';
			foreach($array as $val){
				$url=base_url().'/user/cook';
				$imgurl=base_url().'/'.$val->image;
				if($val->image==''){
					$imgurl=base_url().'/public/frontend/images/f_icon_user.jpg';
				}
				$search.='<div class="search_iteam_one">';
            	$search.='<a href="'.$url.'"><span><img src="'.$imgurl.'"></span>';
                $search.='<p>'.$val->name.'</p></a>';
                $search.='</div>';
				
			}
		}
		
		$sql=$db->query("select image,title from news_posts where title like '%".$id."%'");
		$array=$sql->getResult();
		if(isset($array[0])){
			$search.='<div class="search_iteam_title"> News </div>';
			foreach($array as $val){
				$url=base_url().'/user/news';
				$imgurl=base_url().'/'.$val->image;
				if($val->image==''){
					$imgurl=base_url().'/public/frontend/images/f_icon_user.jpg';
				}
				$search.='<div class="search_iteam_one">';
            	$search.='<a href="'.$url.'"><span><img src="'.$imgurl.'"></span>';
                $search.='<p>'.$val->title.'</p></a>';
                $search.='</div>';
				
			}
		}
		$search.='</div>';
		//notifications data
		echo $search;
		die;
	}
	public function dashboard(){
		$session = session();
        $users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$post_vegan= new PostModel();
		//$data['vaganpost'] =$post_vegan->getVeganPost($session->get('idUserH'));
		$data['vaganpost'] =$post_vegan->getVeganPostLimit($session->get('idUserH'),7,0);
		$data['session'] =$session;
		$events = new EventModel();
        $data['event_latest']=$events->getLatestEventByUser($session->get('idUserH'));
        $data['event_comment']=$events->getEventComment();
        $data['events']=$events->getTopFiveEventByUser($session->get('idUserH'));

        $users = new UserModel();
		$data['users']=$users->getSingleUser($session->get('idUserH'));
		$data['loginusers']=$users->getSingleUser($session->get('idUserH'));
		$rm = new RecommendationModel();
		$data['recats']=$rm->getAllReRequestsByUser();
		$news= new NewsModel();
		$data['newsall']=$news->getAllPostByUser();
		$blog= new BlogModel();
		$data['blogall']=$blog->getAllPostByUser($session->get('idUserH'));
		$data['blogdashboard']=$blog->getAllPostfor_dasbord($session->get('idUserH'));
		$data['public_url']=base_url()."/public/frontend/";
		$data['baseurl']=base_url()."/";
		$data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
		$data['friendrequest']=$users->getFriendRequest($session->get('idUserH'));
		$data['birthday']=$users->getUserFriendBirthday($session->get('idUserH'));
		$data['limit']=7;
		$data['start']=7;
		return view('user/dashboard/dashboardUser',$data);
	}
	public function dashboardLoadMore(){
		$session = session();
        $users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$post_vegan= new PostModel();
		//$data['vaganpost'] =$post_vegan->getVeganPost($session->get('idUserH'));
		$data['vaganpost'] =$post_vegan->getVeganPostLimit($session->get('idUserH'),$this->request->getPost('limit'), $this->request->getPost('start'));
		$data['session'] =$session;
		$events = new EventModel();
        $data['event_latest']=$events->getLatestEventByUser($session->get('idUserH'));
        $data['event_comment']=$events->getEventComment();
        $data['events']=$events->getTopFiveEventByUser($session->get('idUserH'));

        $users = new UserModel();
		$data['users']=$users->getSingleUser($session->get('idUserH'));
		$data['loginusers']=$users->getSingleUser($session->get('idUserH'));
		$rm = new RecommendationModel();
		$data['recats']=$rm->getAllReRequestsByUser();
		$news= new NewsModel();
		$data['newsall']=$news->getAllPostByUser();
		$blog= new BlogModel();
		$data['blogall']=$blog->getAllPostByUser($session->get('idUserH'));
		$data['blogdashboard']=$blog->getAllPostfor_dasbord($session->get('idUserH'));
		$data['public_url']=base_url()."/public/frontend/";
		$data['baseurl']=base_url()."/";
		$data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
		$data['friendrequest']=$users->getFriendRequest($session->get('idUserH'));
		$data['birthday']=$users->getUserFriendBirthday($session->get('idUserH'));
		
		
		return view('user/dashboard/dashboardLoadMore',$data);
	}
	public function public_profileUser($id){
		$session = session();
		$data['session'] =$session;
		 $users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($id);	
		$users = new UserModel();
		$data['users']=$users->getSingleUser($id);
		$data['loginusers']=$users->getSingleUser($session->get('idUserH'));
		
		$data['userfriend']=$users->getSingleUserFriend($id);
		$data['friendrequest']=$users->getFriendRequest($id);
		$rm = new EventModel();
		$data['event_data']=$rm->getEventByUser($id);
		$vegan= new PostModel();
		$veganpost=$vegan->getSingleUserPost($id);


		$veganphoto=$vegan->getUserPhotos($id);
		$i=0;
		foreach($veganpost as $values){
		$veganpost[$i]['comments_data']=$vegan->getPostComment($values['id']);
		$veganpost[$i]['likes_data']=$vegan->getPostLike($values['id']);
		$veganpost[$i]['liked_by_user']=$vegan->getPostLikeByUser($values['id'],$session->get('idUserH'));
		$i++;
		}
		
		$data['posts']=$veganpost;
		$data['photos']=$veganphoto;
		
		
        //$data['comment']=$vegan->getPostCommentByid($session->get('idUserH'));
        $data['public_url']=base_url()."/public/frontend/";
		$data['baseurl']=base_url()."/";
		$data['friends']=$users->Friends($session->get('idUserH'));
		$data['friend_request_send_by_me']=$users->friendRequestSendByMe($session->get('idUserH'));
		$data['friend_request_received_by_me']=$users->friendRequestReceivedByMe($session->get('idUserH'));
		
		$data['birthday']=$users->getUserFriendBirthday($session->get('idUserH'));
		return view('user/profile/public_profile',$data);
	}
	public function recipeUser(){

		$session = session();
        $users = new UserChatModel();
			$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$vegan= new PostModel();
		$data['vaganpost'] =$vegan->getVeganPost($session->get('idUserH'));
		$data['session'] =$session;
		$events = new EventModel();
        $data['event_latest']=$events->getLatestEventByUser($session->get('idUserH'));
		 $data['event_comment']=$events->getEventComment();
		 $data['events']=$events->getTopFiveEventByUser($session->get('idUserH'));
		$rm = new RecommendationModel();
		$data['recats']=$rm->getAllReRequestsByUser();
		$news= new NewsModel();
		$data['newsall']=$news->getAllPostByUser();
    $users = new UserModel();
		$data['users']=$users->getSingleUser($session->get('idUserH'));
        $data['loginusers']=$users->getSingleUser($session->get('idUserH'));
		$receipe=new ReceipeModel();
		$data['receipe']=$receipe->getAllBlogReceipesByUser($session->get('idUserH'));
		$data['receipe_category']=$receipe->getAllReceipeCategory();
		$data['public_url']=base_url()."/public/frontend/";
		$data['baseurl']=base_url()."/";
		$data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
		$data['friendrequest']=$users->getFriendRequest($session->get('idUserH'));
		$data['birthday']=$users->getUserFriendBirthday($session->get('idUserH'));
		return view('user/recipe/recipesUser',$data);
	}

	
	public function recommendationUser(){
		$session = session();
        $users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$data['session'] =$session;

		$news= new NewsModel();
		$data['newsall']=$news->getAllPostByUser();

		$users = new UserModel();
		$data['users']=$users->getSingleUser($session->get('idUserH'));
        $data['loginusers']=$users->getSingleUser($session->get('idUserH'));

		$events = new EventModel();
		$data['events']=$events->getTopFiveEventByUser($session->get('idUserH'));
        $data['event_latest']=$events->getLatestEventByUser($session->get('idUserH'));
		 $data['event_comment']=$events->getEventComment();
		$rm = new RecommendationModel();
		$data['recats']=$rm->getAllReRequestsByUser();
			$data['reRestudent']=$rm->recommendationRestutent();
			$data['reProduct']=$rm->recommendationProduct();
			$data['reCooks']=$rm->recommendationCook();
			$data['reRecipe']=$rm->recommendationRecipe();

			 $product= new ProductModel();
		$data['productall']=$product->getAllPost();
		$data['product_category']=$product->productCategories();
			

		$data['public_url']=base_url()."/public/frontend/";
		$data['baseurl']=base_url()."/";
		$data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
		$data['friendrequest']=$users->getFriendRequest($session->get('idUserH'));
		$data['birthday']=$users->getUserFriendBirthday($session->get('idUserH'));
		return view('user/recommendation/recommendationUser',$data);
	}
	public function restaurantUser(){
		$session = session();
        $users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$data['session'] =$session;
		$rm = new RecommendationModel();
		$data['recats']=$rm->getAllReRequestsByUser();


		$news= new NewsModel();
		$data['newsall']=$news->getAllPostByUser();

		$events = new EventModel();
		$data['events']=$events->getTopFiveEventByUser($session->get('idUserH'));
		$data['event_latest']=$events->getLatestEventByUser($session->get('idUserH'));
		$data['event_comment']=$events->getEventComment();

		

		$rest = new RestaurantsModel();
		$data['restaurant']=$rest->getAllPost();
        $users = new UserModel();
		$data['users']=$users->getSingleUser($session->get('idUserH'));
		$data['loginusers']=$users->getSingleUser($session->get('idUserH'));
        $data['public_url']=base_url()."/public/frontend/";
		$data['baseurl']=base_url()."/";
		$data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
		$data['friendrequest']=$users->getFriendRequest($session->get('idUserH'));
		$data['birthday']=$users->getUserFriendBirthday($session->get('idUserH'));
		return view('user/restaurant/restaurantUser',$data);
	}
	public function getSingleProduct($id){
		$session = session();
        $data['session'] =$session;
		$pro= new ProductModel();
		$data=$pro->getSingleProduct_detail($id);
		
    $name='';
		if(isset($data['title'])){
		if($data['title']!=''){
			$name=$data['title'];
		}
		
		}

		$image=base_url().'/'.$data['image'];
		// $blogs_name=$data['title'];
		$event_start_date=date('M d,Y h:i a',strtotime($data['updated_at']));
		// $event_end_date=date('M d,Y h:i a',strtotime($data['event_end_date']));
		$details=$data['content'];
		// $video=$data['video'];
		// $videos='';
		// if($video!=''){
		// 	$videos='<div class="video_blog"><iframe height="280" width="500"  
  //            src="'.$video.'" title="YouTube video player"></iframe></div>';
		// }
		$html='
  <div class="modal fade add_custom_field_pop product_popup_page" id="add_custom_blog" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content modal-lg">
      
	    
	  <div class="modal-header">
          <header class="common-post-header u-flex">   
  <div class="common-post-info">
    <div class="user-and-group u-flex hidding_one_middel">  '.$name.'   </div>
    <div class="username_time"> <a href="#">'.$event_start_date.'</a> </div>
  </div>
</header>
         
        <button type="button" onclick="hidepopup()" class="close-video" data-dismiss="modal" aria-label="Close"> </button>
      </div>
	  
      <div class="modal-body">
        <div class="custom_fields_pop">
         <div class="blog_ppup">
		 
		 
 		  
		  <div class="product_recipes">
        <ul>
          <h3> Tags :- </h3>
                    <li><a href="#"> qqqqqqqqq</a></li>
         

                   <li><a href="#"> asfsdgfs</a></li>
         

         

        </ul>
      </div>
		  
                  <div class="blog_images"><img src="'.$image.'"></div>
                 
                   
             
			
			<div class="product_detail_category">
        <ul>
		<li> <span><img src="https://vegan.sidhauli.co.in/public/frontend/images/rating.png"></span>
            <h2>Rating</h2>
            <p> 4.4/5 | 122 Reviews </p>
          </li>
          <li> <span><img src="https://vegan.sidhauli.co.in/public/frontend/images/countryorigin.png"></span>
            <h2>Country of Origin</h2>
            <p>India</p>
          </li>
          <li> <span><img src="https://vegan.sidhauli.co.in/public/frontend/images/manufacturing.png"></span>
            <h2>Manufacturing By</h2>
            <p>Manufacturing</p>
          </li>
           
        </ul>
      </div>
	  <h2>Details</h2> 
		<p>'.$details.'</p>	
<div class="tribe-events-single-section tribe-events-event-meta primary tribe-clearfix">
<h2 class="tribe-product-single-section-title"> Details </h2>
  <div class="tribe-events-meta-group tribe-events-meta-group-details tribe_product">
     <dl>
      <dt class="tribe-events-end-date-label"> Phone: </dt>
      <dd> <abbr class="tribe-events-abbr tribe-events-end-date dtend" title="2022-01-04"> 9460642007 </abbr> </dd>
     
    </dl>
  </div>
  <div class="tribe-events-meta-group tribe-events-meta-group-organizer tribe_product">
     
    <dl>
      <dt class="tribe-events-start-date-label"> Email: </dt>
      <dd> <abbr class="tribe-events-abbr tribe-events-start-date published dtstart" title="2021-12-15"> soni.pradeep27@gmail.com </abbr> </dd>
    </dl>
  </div>
  <div class="tribe-events-meta-group tribe-events-meta-group-details tribe_product">
     
    <dl>
      <dt class="tribe-events-end-date-label"> Website: </dt>
      <dd> <abbr class="tribe-events-abbr tribe-events-end-date dtend" title="2022-01-04"> <a href="#" target="_blank" rel="external">www.hellovegans.com</a> </abbr> </dd>
    </dl>
  </div>
</div>


         </div>
        </div>
       </div>
     </div>
   </div>
  </div>';
echo $html;
	}
	public function productUser(){
		$session = session();
        $users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$data['session'] =$session;
			$rm = new RecommendationModel();
		$data['recats']=$rm->getAllReRequestsByUser();

		$news= new NewsModel();
		$data['newsall']=$news->getAllPostByUser();

		$events = new EventModel();
		$data['events']=$events->getTopFiveEventByUser($session->get('idUserH'));
		$data['event_latest']=$events->getLatestEventByUser($session->get('idUserH'));
		$data['event_comment']=$events->getEventComment();

		 $product= new ProductModel();
		$data['productall']=$product->getAllPost();
		$data['product_category']=$product->productCategories();

        $data['public_url']=base_url()."/public/frontend/";
		$data['baseurl']=base_url()."/";
		 $users = new UserModel();
		$data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
		$data['friendrequest']=$users->getFriendRequest($session->get('idUserH'));
		$data['birthday']=$users->getUserFriendBirthday($session->get('idUserH'));
	
		$data['users']=$users->getSingleUser($session->get('idUserH'));
		$data['loginusers']=$users->getSingleUser($session->get('idUserH'));
		return view('user/product/productUser',$data);
	}
	public function ask_questionUser(){
		$session = session();
        $users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$data['session'] =$session;
		$rm = new RecommendationModel();
		$data['recats']=$rm->getAllReRequestsByUser();

    $cooks= new CooksModel();
		$data['cooksall']=$cooks->getAllPost();
		$data['public_url']=base_url()."/public/frontend/";
		$data['baseurl']=base_url()."/";
         $users = new UserModel();
		$data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
		$data['friendrequest']=$users->getFriendRequest($session->get('idUserH'));
		$data['birthday']=$users->getUserFriendBirthday($session->get('idUserH'));
		$data['loginusers']=$users->getSingleUser($session->get('idUserH'));
		return view('user/question/ask_question',$data);
	}
	public function answerUser(){
		$session = session();
        $users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$data['session'] =$session;
		$rm = new RecommendationModel();
		$data['recats']=$rm->getAllReRequestsByUser();

    $cooks= new CooksModel();
		$data['cooksall']=$cooks->getAllPost();
		$data['public_url']=base_url()."/public/frontend/";
		$data['baseurl']=base_url()."/";
         $users = new UserModel();
		$data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
		$data['friendrequest']=$users->getFriendRequest($session->get('idUserH'));
		$data['birthday']=$users->getUserFriendBirthday($session->get('idUserH'));
		$data['loginusers']=$users->getSingleUser($session->get('idUserH'));
		return view('user/question/answer',$data);
	}
	public function questionUser(){
		$session = session();
        $users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$data['session'] =$session;
		$rm = new RecommendationModel();
		$data['recats']=$rm->getAllReRequestsByUser();

    $cooks= new CooksModel();
		$data['cooksall']=$cooks->getAllPost();
		$data['public_url']=base_url()."/public/frontend/";
		$data['baseurl']=base_url()."/";
         $users = new UserModel();
		$data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
		$data['friendrequest']=$users->getFriendRequest($session->get('idUserH'));
		$data['birthday']=$users->getUserFriendBirthday($session->get('idUserH'));
		$data['loginusers']=$users->getSingleUser($session->get('idUserH'));
		return view('user/question/questionUser',$data);
	}
	public function aboutUser(){
	 	$session = session();
		$users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$data['session'] =$session;
		
		$users = new UserModel();
		$data['users']=$users->getSingleUser($session->get('idUserH'));
        $data['loginusers']=$users->getSingleUser($session->get('idUserH'));
		$data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
        $data['friendrequest']=$users->getFriendRequest($session->get('idUserH'));

		$rm = new EventModel();
		$data['event_data']=$rm->getEventByUser($session->get('idUserH'));

		$vegan= new PostModel();
		$veganpost=$vegan->getSingleUserPost($session->get('idUserH'));
		$veganphoto=$vegan->getUserPhotos($session->get('idUserH'));
		$i=0;
		foreach($veganpost as $values){
		$veganpost[$i]['comments_data']=$vegan->getPostComment($values['id']);
		$veganpost[$i]['likes_data']=$vegan->getPostLike($values['id']);
		$veganpost[$i]['liked_by_user']=$vegan->getPostLikeByUser($values['id'],$session->get('idUserH'));
		$i++;
		}
		
		$data['posts']=$veganpost;
		$data['photos']=$veganphoto;
	
         $data['public_url']=base_url()."/public/frontend/";
		$data['baseurl']=base_url()."/";
		$data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
		$data['friendrequest']=$users->getFriendRequest($session->get('idUserH'));
		$data['birthday']=$users->getUserFriendBirthday($session->get('idUserH'));
		return view('user/about/about',$data);
	}
	public function contactUser(){
	 	$session = session();
		$users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$data['session'] =$session;
		
		$users = new UserModel();
		$data['users']=$users->getSingleUser($session->get('idUserH'));
        $data['loginusers']=$users->getSingleUser($session->get('idUserH'));
		$data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
        $data['friendrequest']=$users->getFriendRequest($session->get('idUserH'));

		$rm = new EventModel();
		$data['event_data']=$rm->getEventByUser($session->get('idUserH'));

		$vegan= new PostModel();
		$veganpost=$vegan->getSingleUserPost($session->get('idUserH'));
		$veganphoto=$vegan->getUserPhotos($session->get('idUserH'));
		$i=0;
		foreach($veganpost as $values){
		$veganpost[$i]['comments_data']=$vegan->getPostComment($values['id']);
		$veganpost[$i]['likes_data']=$vegan->getPostLike($values['id']);
		$veganpost[$i]['liked_by_user']=$vegan->getPostLikeByUser($values['id'],$session->get('idUserH'));
		$i++;
		}
		
		$data['posts']=$veganpost;
		$data['photos']=$veganphoto;
	
         $data['public_url']=base_url()."/public/frontend/";
		$data['baseurl']=base_url()."/";
		$data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
		$data['friendrequest']=$users->getFriendRequest($session->get('idUserH'));
		$data['birthday']=$users->getUserFriendBirthday($session->get('idUserH'));


		return view('user/contact/contact',$data);
	}
	public function contactUserL(){
	 	$session = session();
		
		$users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$data['session'] =$session;
		
		$users = new UserModel();
		$data['users']=$users->getSingleUser($session->get('idUserH'));
        $data['loginusers']=$users->getSingleUser($session->get('idUserH'));
		$data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
        $data['friendrequest']=$users->getFriendRequest($session->get('idUserH'));

		$rm = new EventModel();
		$data['event_data']=$rm->getEventByUser($session->get('idUserH'));

		$vegan= new PostModel();
		$veganpost=$vegan->getSingleUserPost($session->get('idUserH'));
		$veganphoto=$vegan->getUserPhotos($session->get('idUserH'));
		$i=0;
		foreach($veganpost as $values){
		$veganpost[$i]['comments_data']=$vegan->getPostComment($values['id']);
		$veganpost[$i]['likes_data']=$vegan->getPostLike($values['id']);
		$veganpost[$i]['liked_by_user']=$vegan->getPostLikeByUser($values['id'],$session->get('idUserH'));
		$i++;
		}
		
		$data['posts']=$veganpost;
		$data['photos']=$veganphoto;
	
         $data['public_url']=base_url()."/public/frontend/";
		$data['baseurl']=base_url()."/";
		$data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
		$data['friendrequest']=$users->getFriendRequest($session->get('idUserH'));
		$data['birthday']=$users->getUserFriendBirthday($session->get('idUserH'));


		return view('user/contact/contactlandingpage',$data);
	}
	public function privacyUser(){
	 	$session = session();
		$users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$data['session'] =$session;
		
		$users = new UserModel();
		$data['users']=$users->getSingleUser($session->get('idUserH'));
        $data['loginusers']=$users->getSingleUser($session->get('idUserH'));
		$data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
        $data['friendrequest']=$users->getFriendRequest($session->get('idUserH'));

		$rm = new EventModel();
		$data['event_data']=$rm->getEventByUser($session->get('idUserH'));

		$vegan= new PostModel();
		$veganpost=$vegan->getSingleUserPost($session->get('idUserH'));
		$veganphoto=$vegan->getUserPhotos($session->get('idUserH'));
		$i=0;
		foreach($veganpost as $values){
		$veganpost[$i]['comments_data']=$vegan->getPostComment($values['id']);
		$veganpost[$i]['likes_data']=$vegan->getPostLike($values['id']);
		$veganpost[$i]['liked_by_user']=$vegan->getPostLikeByUser($values['id'],$session->get('idUserH'));
		$i++;
		}
		
		$data['posts']=$veganpost;
		$data['photos']=$veganphoto;
	
        //$data['comment']=$vegan->getPostCommentByid($session->get('idUserH'));
      /*  echo "<pre>";
       print_r($data);
	   die; */
         $data['public_url']=base_url()."/public/frontend/";
		$data['baseurl']=base_url()."/";
		$data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
		$data['friendrequest']=$users->getFriendRequest($session->get('idUserH'));
		$data['birthday']=$users->getUserFriendBirthday($session->get('idUserH'));

		return view('user/privacy/privacy',$data);
	}
	public function termUser(){
		$session = session();
		$users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$data['session'] =$session;
		
		$users = new UserModel();
		$data['users']=$users->getSingleUser($session->get('idUserH'));
        $data['loginusers']=$users->getSingleUser($session->get('idUserH'));
		$data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
        $data['friendrequest']=$users->getFriendRequest($session->get('idUserH'));

		$rm = new EventModel();
		$data['event_data']=$rm->getEventByUser($session->get('idUserH'));

		$vegan= new PostModel();
		$veganpost=$vegan->getSingleUserPost($session->get('idUserH'));
		$veganphoto=$vegan->getUserPhotos($session->get('idUserH'));
		$i=0;
		foreach($veganpost as $values){
		$veganpost[$i]['comments_data']=$vegan->getPostComment($values['id']);
		$veganpost[$i]['likes_data']=$vegan->getPostLike($values['id']);
		$veganpost[$i]['liked_by_user']=$vegan->getPostLikeByUser($values['id'],$session->get('idUserH'));
		$i++;
		}
		
		$data['posts']=$veganpost;
		$data['photos']=$veganphoto;
	
        //$data['comment']=$vegan->getPostCommentByid($session->get('idUserH'));
      /*  echo "<pre>";
       print_r($data);
	   die; */
         $data['public_url']=base_url()."/public/frontend/";
		$data['baseurl']=base_url()."/";
		$data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
		$data['friendrequest']=$users->getFriendRequest($session->get('idUserH'));
		$data['birthday']=$users->getUserFriendBirthday($session->get('idUserH'));
	 	$session = session();

		return view('user/term/term',$data);
	}
	public function cookiesUser(){
		$session = session();
		$users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$data['session'] =$session;
		
		$users = new UserModel();
		$data['users']=$users->getSingleUser($session->get('idUserH'));
        $data['loginusers']=$users->getSingleUser($session->get('idUserH'));
		$data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
        $data['friendrequest']=$users->getFriendRequest($session->get('idUserH'));

		$rm = new EventModel();
		$data['event_data']=$rm->getEventByUser($session->get('idUserH'));

		$vegan= new PostModel();
		$veganpost=$vegan->getSingleUserPost($session->get('idUserH'));
		$veganphoto=$vegan->getUserPhotos($session->get('idUserH'));
		$i=0;
		foreach($veganpost as $values){
		$veganpost[$i]['comments_data']=$vegan->getPostComment($values['id']);
		$veganpost[$i]['likes_data']=$vegan->getPostLike($values['id']);
		$veganpost[$i]['liked_by_user']=$vegan->getPostLikeByUser($values['id'],$session->get('idUserH'));
		$i++;
		}
		
		$data['posts']=$veganpost;
		$data['photos']=$veganphoto;
	
        //$data['comment']=$vegan->getPostCommentByid($session->get('idUserH'));
      /*  echo "<pre>";
       print_r($data);
	   die; */
         $data['public_url']=base_url()."/public/frontend/";
		$data['baseurl']=base_url()."/";
		$data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
		$data['friendrequest']=$users->getFriendRequest($session->get('idUserH'));
		$data['birthday']=$users->getUserFriendBirthday($session->get('idUserH'));
	 	$session = session();

		return view('user/term/cookies',$data);
	}
	public function advertisingUser(){
	 	$session = session();
		$users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$data['session'] =$session;
		
		$users = new UserModel();
		$data['users']=$users->getSingleUser($session->get('idUserH'));
        $data['loginusers']=$users->getSingleUser($session->get('idUserH'));
		$data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
        $data['friendrequest']=$users->getFriendRequest($session->get('idUserH'));

		$rm = new EventModel();
		$data['event_data']=$rm->getEventByUser($session->get('idUserH'));

		$vegan= new PostModel();
		$veganpost=$vegan->getSingleUserPost($session->get('idUserH'));
		$veganphoto=$vegan->getUserPhotos($session->get('idUserH'));
		$i=0;
		foreach($veganpost as $values){
		$veganpost[$i]['comments_data']=$vegan->getPostComment($values['id']);
		$veganpost[$i]['likes_data']=$vegan->getPostLike($values['id']);
		$veganpost[$i]['liked_by_user']=$vegan->getPostLikeByUser($values['id'],$session->get('idUserH'));
		$i++;
		}
		
		$data['posts']=$veganpost;
		$data['photos']=$veganphoto;
	
        //$data['comment']=$vegan->getPostCommentByid($session->get('idUserH'));
      /*  echo "<pre>";
       print_r($data);
	   die; */
         $data['public_url']=base_url()."/public/frontend/";
		$data['baseurl']=base_url()."/";
		$data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
		$data['friendrequest']=$users->getFriendRequest($session->get('idUserH'));
		$data['birthday']=$users->getUserFriendBirthday($session->get('idUserH'));

		return view('user/term/advertising',$data);
	}
	
	public function cookUser(){
		$session = session();
        $users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$data['session'] =$session;
		$rm = new RecommendationModel();
		$data['recats']=$rm->getAllReRequestsByUser();

		$news= new NewsModel();
		$data['newsall']=$news->getAllPostByUser();

		$events = new EventModel();
		$data['events']=$events->getTopFiveEventByUser($session->get('idUserH'));
		$data['event_latest']=$events->getLatestEventByUser($session->get('idUserH'));
		$data['event_comment']=$events->getEventComment();
        
		$cooks= new CooksModel();
		$data['cooksall']=$cooks->getAllPost();
		$data['public_url']=base_url()."/public/frontend/";
		$data['baseurl']=base_url()."/";
         $users = new UserModel();
		
		$data['users']=$users->getSingleUser($session->get('idUserH'));
		$data['loginusers']=$users->getSingleUser($session->get('idUserH'));
		$data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
		$data['friendrequest']=$users->getFriendRequest($session->get('idUserH'));
		$data['birthday']=$users->getUserFriendBirthday($session->get('idUserH'));
		return view('user/cooks/cooksUser',$data);
	}
	public function getSingleRestaurant($id){
		$session = session();
        $data['session'] =$session;
		 

     $rest= new RestaurantsModel();
		$data=$rest->getSingleRest_detail($id);


    $name='';
		if(isset($data['name'])){
		if($data['name']!=''){
			$name=$data['name'];
		}
		
		}


		$image=base_url().'/'.$data['image'];
		$event_start_date=date('M d,Y h:i a',strtotime($data['updated_at']));
		// $event_end_date=date('M d,Y h:i a',strtotime($data['event_end_date']));
		$details=$data['detail'];
		$address=$data['address'];
		$rating=$data['rating'];
		$discount=$data['discount'];
		$address=$data['address'];
		$price=$data['price'];
		$opening_time=$data['opening_time'];
		$closing_time=$data['closing_time'];
		$mobile=$data['contact_no'];
		$das=$rest->getPostComment($id);
			$reviewcount=count($das);
		// $video=$data['video'];
		// $videos='';
		// if($video!=''){
		// 	$videos='<div class="video_blog"><iframe height="280" width="500"  
  //            src="'.$video.'" title="YouTube video player"></iframe></div>';
		// }
		$html='
  


  <div class="modal fade add_recommendation_pop" id="add_custom_blog" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content modal-lg">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">'.$name.' </h5>

        <button type="button" class="close-video" data-dismiss="modal" aria-label="Close"> </button>
      </div>
      <div class="modal-body">
        <div class="restaurants_imag"> <img src="'.$image.'"> </div>
        <div class="d_all">
          <div class="bg-white grey about_rel_info padding-b-0">
            <div class="align-v-center flex flex-between margin-b-15">
              <h2 class="font-20 bold grey">Dragon House</h2>
              <div class="flex align-v-center" > <i class="fa fa-star-half-o" aria-hidden="true"></i>
  <div class="flex align-v-center padding-l-5" style="width: 133px;"> <span class="grey-darker">'.$rating.'/5</span> | <span class="grey-darker">'.$reviewcount.' Reviews</span> </div>
</div>
</div>
            <div class="flex align-f-end flex-between">
              <div>
                <div class="flex align-v-center padding-b-5">
                  <div class="flex">
                    <svg width="14" height="18">
                      <use xlink:href="<?php echo $public_url;?>/images/icons.svg?refresh=10Aug21#res_loc"></use>
                    </svg>
                  </div>
                  <div class="padding-l-10 grey-another flex"> <span class="padding-r-5">'.$address.'</span> </div>
                </div>
                <div class="flex align-v-center padding-b-5">
                  <div class="flex">
                    <svg width="15" height="15">
                      <use xlink:href="<?php echo $public_url;?>/images/icons.svg?refresh=10Aug21#res_rupee"></use>
                    </svg>
                  </div>
                  <div class="cost_cuis padding-l-10 grey-another social_share relative"> <span class="block relative " data-tooltip="Pan Asian">'.$price.' for two approx | Pan Asian</span> 
                    <!--  --> 
                  </div>
                </div>
                <div class="flex align-v-center relative padding-b-5">
                  <div class="flex">
                    <svg width="15" height="15">
                      <use xlink:href="<?php echo $public_url;?>/images/icons.svg?refresh=10Aug21#res_time"></use>
                    </svg>
                  </div>
                  <div class="padding-l-10 grey-another flex"> <span class="ellipsis rest_time"> <span class="light-green">Open from</span> <span>'.$opening_time.' PM - '.$closing_time.' PM </span>  </div>
                </div>
              </div>
              <div class="flex">
                <div class="pointer wishlist-restaurant relative social_share non_login">
                  <svg id="res_favourite" width="32" height="32">
                    <g fill="none" fill-rule="evenodd">
                      <path fill="white" fill-rule="nonzero" stroke="#cccccc" d="M15 0c8.284 0 15 6.716 15 15 0 8.284-6.716 15-15 15-8.284 0-15-6.716-15-15C0 6.716 6.716 0 15 0z" transform="translate(-338.000000, -146.000000) translate(338.000000, 146.000000) translate(1.000000, 1.000000)"></path>
                      <path fill="#FFF" stroke="#4A90E2" d="M21.96 13.786c0 1.821-1.67 3.347-1.738 3.415l-4.728 4.554c-.091.09-.213.136-.334.136-.121 0-.243-.045-.334-.136l-4.736-4.569c-.06-.053-1.73-1.579-1.73-3.4 0-2.224 1.358-3.552 3.628-3.552 1.328 0 2.572 1.048 3.172 1.64.6-.592 1.844-1.64 3.172-1.64 2.27 0 3.628 1.328 3.628 3.552z" transform="translate(-338.000000, -146.000000) translate(338.000000, 146.000000) translate(1.000000, 1.000000) translate(15.160008, 16.062851) rotate(-360.000000) translate(-15.160008, -16.062851)"></path>
                    </g>
                  </svg>
                </div>
              </div>
            </div>
            <hr class="hr-grey-light margin-t-20">
          </div>';

          if($data['gallary']!=''){
			   $ex=explode(",",$data['gallary']);
				if(isset($ex[0])){
				  $image_galary1=base_url().'/'.$ex[0];
					$html.='<div class="photos">
            <h2>Photos</h2>
            <div class="gallery_main">
              <div class="gallery_main_all">';

								foreach($ex as $val){
								  $image_galarys=base_url().'/'.$val;
								  $html.='

								  <div class="gallery_card">
                  <div class="card-image"> <a href="#" data-fancybox="gallery" data-caption="Caption Images 1"> <img src="'.$image_galarys.'" alt="Image Gallery"> </a> </div>
                </div>


								  ';
								}
					$html.='</div></div></div>';			
				}
			}


          $html.='

          <div class="direction">
            <h2>Direction</h2>
            <div class="direction_main">
              <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14229.959407887223!2d75.794494!3d26.919681!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x7e5efda0da3ed53e!2zMjbCsDU1JzEwLjkiTiA3NcKwNDcnNDAuMiJF!5e0!3m2!1sen!2sus!4v1642742612782!5m2!1sen!2sus" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
              <div class="flex align-v-center flex-between padding-20">
                <div class="grey-another">'.$address.'</div>
                <button class="get_dir bg-white radius-4">
                <a class="text-blue padding-10 flex align-v-center nowrap" href="https://www.google.com/maps/dir//26.91968080,75.79449440" target="_blank">
                <svg class="margin-r-10" width="16" height="16">
                  <use xlink:href="<?php echo $public_url;?>/images/icons.svg?refresh=12Aug21#dir_map"></use>
                </svg>
                Get Directions </a>
                </button>
              </div>
            </div>
          </div>';
		  if($data['menu']!=''){
			$fileNameParts = explode('.', $data['menu']);
            $ext = end($fileNameParts); 
			$urls=base_url()."/".$data['menu'];
			$html.='<div class="restaurant_fa">
            <div class="padding-b-30 ">
              <h2>Menus</h2>';
			if($ext=='pdf'){
				 $html.=' <div class="feature_main">
                <div class="flex align-v-center">
                 
                  <div class="padding-l-10"> <a href="'.$urls.'" download>View Menu As PDF</a> </div>
                </div>
               
              </div>';  
			}else{
			$html.=' <div class="feature_main">
                <div class="flex align-v-center">
                 
                  <div class="padding-l-10"> <img  src="'.$urls.'" height="150" width="150"></div>
                </div>
               
              </div>'; 	
			}
			
			 $html.=' </div></div>';   
		  }
		  
		  $fe=$rest->getPostFeaturesByPostid($id);
		  
		  $html.='
          <div class="restaurant_fa">
            <div class="padding-b-30 ">
              <h2>Restaurant Features</h2>';
			   foreach($fe as $vfe){
		  $html.='	  
              <div class="feature_main">
                <div class="flex align-v-center">
                  <div class="feature_svg flex ico ico-xs">
                   <img src="'.base_url().'/'.$vfe['svgData'].'">
                  </div>
                  <div class="padding-l-10">'.$vfe['name'].'</div>
                </div>
               
              </div>';
	          }
			 
		  
		$html.='	  
            </div>
          </div>';
		  
		  $html.='
          <div class="continue_table"> 
		  <div class="restaurant_fa">
            <div class="padding-b-30 ">
              <h2>Contact for Reservation </h2>
 		  <span class="restaurant_contact">
 <i class="fa fa-phone" aria-hidden="true"></i> '.$mobile.'</span>		  
		   </div>
        </div>
      </div>';

      $html.='</div>';
    $da=$rest->getPostCommentUser($id);
		$das=$rest->getPostComment($id);
		$html.='
		<div class="blog_comment">
		<div class="detailBox">
					 <div class="titleBox">
                        <label>Comments </label>';
		
		if(count($da)!=0){
			
			if(count($das)>2){
			$commentscount=count($das)-count($da);
			$html.='<button id="viewold" onclick="showoldercomments('.$id.')" class="viewoldcommetns">View Old '.$commentscount.' Commetns</button>';
			}
		}	
			$html.='</div>
			     <div class="actionBox">
                    <ul class="commentList">';
		if(count($da)!=0){			
			foreach($da as $datas){
			
			$commented_by='Admin';
			$userimage=base_url().'/'.'public/frontend/images/logo.png';
		      if($datas['users_name']!=''){
			    $commented_by=$datas['users_name'];
			    $userimage=base_url().'/'.$datas['users_profile_image'];
		      }
		$html.='<li>
          <div class="commenterImage"> <img src="'.$userimage.'" /> </div>
          <div class="commentText">
            <h2>'.$commented_by.'</h2>
            <p class="">'.$datas['message'].'</p>
            <span class="date sub-text">on '.date('M d, Y',strtotime($datas['created_at'])).'</span> </div>
        </li>';
			
			}
		}
	   $html.='</ul>';
     
        $html.='
           
		    <form class="form-inline" role="form" method="post" id="postcommentform" name="postcommentform">
        <div class="form-group">
          <h2>LEAVE A REPLY </h2>
          <textarea id="messagecomments" name="message" class="form-control comment_here" rows="5" cols="3" placeholder="Enter your comment here..."></textarea>
        </div>
        <div class="form-group">
		<input type="hidden" class="" id="commented_by" name="commented_by" value="'.$session->get('idUserH').'" size="30" aria-required="true">
		<input type="hidden" class="" id="post_id" name="post_id"  value="'.$id.'" size="30" aria-required="true">
          <button class="post_comment" type="button" id="submitcomment" onclick="submitRestudentcomments()">Post Comment</button>
        </div>
      </form>
		   
    </div>
  </div>
</div>
	  
	  
		  
		   </div>
        </div>
      </div>
    </div>
  </div>
</div>





  ';
echo $html;
	}
	public function recipeByCategory($categoryId){
	$session = session();
       $users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$data['session'] =$session;
		$events = new EventModel();
		$data['events']=$events->getTopFiveEventByUser($session->get('idUserH'));
        $data['event_latest']=$events->getLatestEventByUser($session->get('idUserH'));
		 $data['event_comment']=$events->getEventComment();
		$rm = new RecommendationModel();
		$data['recats']=$rm->getAllReRequestsByUser();
		
		$blog= new BlogModel();
		$data['blogall']=$blog->getAllPostByUser($session->get('idUserH'));

		 $users = new UserModel();
		$data['users']=$users->getSingleUser($session->get('idUserH'));
        $data['loginusers']=$users->getSingleUser($session->get('idUserH'));
		$receipe=new ReceipeModel();
		$data['receipe_category']=$receipe->getAllReceipeCategory();
		
		$data['receipe']=$receipe->getAllReceipeByCategory($session->get('idUserH'),$categoryId);
		$data['public_url']=base_url()."/public/frontend/";
		$data['baseurl']=base_url()."/";
        $data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
		$data['friendrequest']=$users->getFriendRequest($session->get('idUserH'));
		$data['birthday']=$users->getUserFriendBirthday($session->get('idUserH'));
	return view('user/recipe/recipesUser',$data);
	}
	// public function profileUser(){
	// 	$session = session();
 //        $users = new UserChatModel();
	// 	$data['chatusers'] =$users->getChatUsers();
	// 	$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
	// 	$data['session'] =$session;
	// 	return view('user/profile/profileUser',$data);
	// }
    public function Notification(){
		$session = session();
        $users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$data['session'] =$session;
		$posts = new BlogModel();
		$data['posts']=$posts->getAllPost();
		$events = new EventModel();
		 
		$data['events']=$events->getTopFiveEventByUser($session->get('idUserH'));
        $data['event_latest']=$events->getLatestEventByUser($session->get('idUserH'));
		 $data['event_comment']=$events->getEventComment();
		$rm = new RecommendationModel();
		$data['recats']=$rm->getAllReRequestsByUser();
		$news= new NewsModel();
		$data['newsall']=$news->getAllPostByUser();


		$users = new UserModel();
		$data['users']=$users->getSingleUser($session->get('idUserH'));
        $data['loginusers']=$users->getSingleUser($session->get('idUserH'));
		$blog= new BlogModel();
		$data['blogall']=$blog->getAllPostByUser($session->get('idUserH'));
		$data['latest_blog']=$blog->getLatestBlogByUser($session->get('idUserH'));
		$data['blog_category']=$blog->getAllPostCategoryByUser();
		$data['blogdashboard']=$blog->getAllPostfor_dasbord($session->get('idUserH'));

		$receipe=new ReceipeModel();
		$data['blogRECIPES']=$receipe->getAllBlogReceipes_blog($session->get('idUserH'));
		//notifications data
			$data['public_url']=base_url()."/public/frontend/";
		$data['baseurl']=base_url()."/";
		$data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
		$data['friendrequest']=$users->getFriendRequest($session->get('idUserH'));
		$data['birthday']=$users->getUserFriendBirthday($session->get('idUserH'));
		$public_url=base_url()."/";
		$user_details=[];
		$db = db_connect();
		
		//get details of notifications
		
		$notification_sql=$db->query("select us.name,us.profile_image,un.created_at,un.type,un.type_name,un.sender_id from user_notifications un 
		left join users us on un.sender_id=us.id 
		where un.status=0 and un.receiver_id='".$session->get('idUserH')."' order by un.id desc");
		$notification_array=$notification_sql->getResult();
		$i=0;
		if(isset($notification_array[0])){
			foreach($notification_array as $n_val){
				$name=$n_val->name;
			    $image=$n_val->profile_image;
			    $time=$n_val->created_at;
			    $type=$n_val->type;
			    $type_name=$n_val->type_name;
			      if($name==''){
				   $name='Admin';
				   $image='public/frontend/images/logo.png';
				 }
				 $id=$n_val->sender_id;
				 $user_details[$i]['id']=$id;
				 $user_details[$i]['name']=$name;
				 $user_details[$i]['profile_image']=base_url()."/".$image;
				 $user_details[$i]['notification_pageicon']=base_url()."/".'public/frontend/images/notification_pageicon.png';
				 if($type=='Request_Send'){
				   $user_details[$i]['message']="send you friend request";	 
				 }else if($type=='Request_Confirm'){
				  $user_details[$i]['message']="confirm your friend request";	 
				 }else{
				 $user_details[$i]['message']=$type.' on your '.$type_name;	 
				 }
				 
				 $user_details[$i]['timeview']=$this->time_Agos(strtotime($time));	
				 $i++;
			}
		}
		
		//notifications data
		$data['user_details']=$user_details;
		
		return view('user/notification/notificationUser',$data);
	}
	
    public function getNotifications(){
		
		$session = session();
		$db = db_connect();
		$tot=0;
		$blog=$db->query("SELECT count(bp.id) as cnt FROM `blog_posts` bp left join blog_post_comments bpc on bpc.post_id=bp.id where bpc.notification_status=0 and bp.posted_by='".$session->get('idUserH')."'");
		$blog_array=$blog->getResult();
		$tot+=$blog_array[0]->cnt;
		$array=array('totalcount'=>$tot);
		echo json_encode($array);
		die;
		
	}
	
	public function photoUser(){
		$session = session();
		 $users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));


		$users = new UserModel();
		$data['users']=$users->getSingleUser($session->get('idUserH'));
        $data['loginusers']=$users->getSingleUser($session->get('idUserH'));
		$data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
        $data['friendrequest']=$users->getFriendRequest($session->get('idUserH'));

		$rm = new EventModel();
		$data['event_data']=$rm->getEventByUser($session->get('idUserH'));

       

		$vegan= new PostModel();
		$veganphotoall=$vegan->getUserAllPhotos($session->get('idUserH'));
		$veganphoto=$vegan->getUserPhotos($session->get('idUserH'));
		$data['photosall']=$veganphotoall;
		$data['photos']=$veganphoto;
		$data['public_url']=base_url()."/public/frontend/";
		$data['baseurl']=base_url()."/";
        $data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
		$data['friendrequest']=$users->getFriendRequest($session->get('idUserH'));
		$data['birthday']=$users->getUserFriendBirthday($session->get('idUserH'));
		return view('user/post/postsUser_photo',$data);

	}
	public function public_photoUser($id){
		$session = session();
		 $users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($id);


		$users = new UserModel();
		$data['users']=$users->getSingleUser($id);
        $data['loginusers']=$users->getSingleUser($id);
		$data['userfriend']=$users->getSingleUserFriend($id);
        $data['friendrequest']=$users->getFriendRequest($id);

		$rm = new EventModel();
		$data['event_data']=$rm->getEventByUser($id);

       

		$vegan= new PostModel();
		$veganphoto=$vegan->getUserAllPhotos($id);
		$data['photos']=$veganphoto;
		$data['public_url']=base_url()."/public/frontend/";
		$data['baseurl']=base_url()."/";
        $data['userfriend']=$users->getSingleUserFriend($id);
		$data['friendrequest']=$users->getFriendRequest($id);
		$data['birthday']=$users->getUserFriendBirthday($id);
		return view('user/post/postsUser_photo',$data);

	}


	public function insertEventCommentUser(){
		
		$id=$this->request->getPost('post_id');
		$data=[
		'event_id'=>$this->request->getPost('post_id'),
		'comment_by'=>$this->request->getPost('commented_by'),
		'message'=>$this->request->getPost('message'),
		'created_at'=>date('Y-m-d H:i:s'),
		'status'=>1
		]; 
		
		 $post = new EventModel();
		 $id=$post->insertEventComment($data);
		 $data=$post->getEventCommentByid($id);
		
		  
		 
		 if($data['users_name']==''){
			$commented_by='Admin';
			$userimage=base_url().'/'.'public/frontend/images/logo.png';
		}else{
			$commented_by=$data['users_name'];
			
			if($data['users_profile_image']==''){
			  $userimage=base_url().'/public/frontend/images/f_icon_user.jpg';
		  }else{
			 $userimage=base_url()."/".$data['users_profile_image']; 
		  }
			
		}
		 //$data=$blogs->getSingleblogs($id);
		 $html='<li><span><img src="'.$userimage.'"></span><p>'.$data['message'].'</p> <div class="time_commnet">'.date('H:i',strtotime($data['created_at'])).'</div></li>';
		  
	
		 echo $html;
		die;
	}

public function profileUser1(){
		$session = session();
		$users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$data['session'] =$session;
		
		$users = new UserModel();
		$data['users']=$users->getSingleUser($session->get('idUserH'));
        $data['loginusers']=$users->getSingleUser($session->get('idUserH'));
		$data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
        $data['friendrequest']=$users->getFriendRequest($session->get('idUserH'));

		$rm = new EventModel();
		$data['event_data']=$rm->getEventByUser($session->get('idUserH'));

		$vegan= new PostModel();
		$veganpost=$vegan->getSingleUserPost($session->get('idUserH'));
		$veganphoto=$vegan->getUserPhotos($session->get('idUserH'));
		$i=0;
		foreach($veganpost as $values){
		$veganpost[$i]['comments_data']=$vegan->getPostComment($values['id']);
		$veganpost[$i]['likes_data']=$vegan->getPostLike($values['id']);
		$veganpost[$i]['liked_by_user']=$vegan->getPostLikeByUser($values['id'],$session->get('idUserH'));
		$i++;
		}
		
		$data['posts']=$veganpost;
		$data['photos']=$veganphoto;
	
        //$data['comment']=$vegan->getPostCommentByid($session->get('idUserH'));
      /*  echo "<pre>";
       print_r($data);
	   die; */
         $data['public_url']=base_url()."/public/frontend/";
		$data['baseurl']=base_url()."/";
		$data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
		$data['friendrequest']=$users->getFriendRequest($session->get('idUserH'));
		$data['birthday']=$users->getUserFriendBirthday($session->get('idUserH'));
		return view('user/profile/profileUser1',$data);
	}

	public function profileUser(){
		$session = session();
		$users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$data['session'] =$session;
		
		$users = new UserModel();
		$data['users']=$users->getSingleUser($session->get('idUserH'));
        $data['loginusers']=$users->getSingleUser($session->get('idUserH'));
		$data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
        $data['friendrequest']=$users->getFriendRequest($session->get('idUserH'));

		$rm = new EventModel();
		$data['event_data']=$rm->getEventByUser($session->get('idUserH'));

		$vegan= new PostModel();
		$veganpost=$vegan->getSingleUserPost($session->get('idUserH'));
		$veganphoto=$vegan->getUserPhotos($session->get('idUserH'));
		$i=0;
		foreach($veganpost as $values){
		$veganpost[$i]['comments_data']=$vegan->getPostComment($values['id']);
		$veganpost[$i]['likes_data']=$vegan->getPostLike($values['id']);
		$veganpost[$i]['liked_by_user']=$vegan->getPostLikeByUser($values['id'],$session->get('idUserH'));
		$i++;
		}
		
		$data['posts']=$veganpost;
		$data['photos']=$veganphoto;
	
        //$data['comment']=$vegan->getPostCommentByid($session->get('idUserH'));
      /*  echo "<pre>";
       print_r($data);
	   die; */
         $data['public_url']=base_url()."/public/frontend/";
		$data['baseurl']=base_url()."/";
		$data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
		$data['friendrequest']=$users->getFriendRequest($session->get('idUserH'));
		$data['birthday']=$users->getUserFriendBirthday($session->get('idUserH'));
		return view('user/profile/profileUser',$data);
	}


	public function insertEventGoing($id){
		$session = session();
		$data=[
		'event_id'=>$id,
		'user_id'=>$session->get('idUserH'),
		'status'=>1
		]; 
		 $post = new EventModel();
		 $post->insertEventAttending($data);
		
		 
		
	}




	public function friendList(){
		$session = session();
		$users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$data['session'] =$session;
		
		$users = new UserModel();
		$data['users']=$users->getSingleUser($session->get('idUserH'));
        $data['loginusers']=$users->getSingleUser($session->get('idUserH'));
		$data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
        $data['friendrequest']=$users->getFriendRequest($session->get('idUserH'));

		$rm = new EventModel();
		$data['event_data']=$rm->getEventByUser($session->get('idUserH'));

    
   

		$vegan= new PostModel();
		$veganpost=$vegan->getSingleUserPost($session->get('idUserH'));
		//$veganphoto=$vegan->getUserPhotos($session->get('idUserH'));
		//$vegan= new PostModel();
		//$veganphoto=$vegan->getUserAllPhotos($session->get('idUserH'));
		$veganphoto=$vegan->getUserPhotos($session->get('idUserH'));
		$i=0;
		foreach($veganpost as $values){
		$veganpost[$i]['comments_data']=$vegan->getPostComment($values['id']);
		$veganpost[$i]['likes_data']=$vegan->getPostLike($values['id']);
		$veganpost[$i]['liked_by_user']=$vegan->getPostLikeByUser($values['id'],$session->get('idUserH'));
		$i++;
		}
		
		$data['posts']=$veganpost;
		$data['photos']=$veganphoto;
		$data['public_url']=base_url()."/public/frontend/";
		$data['baseurl']=base_url()."/";
		$data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
		$data['friendrequest']=$users->getFriendRequest($session->get('idUserH'));
		$data['birthday']=$users->getUserFriendBirthday($session->get('idUserH'));
		return view('user/friend/friendList',$data);
	}
	public function friendRequestList(){
		$session = session();
		$users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$data['session'] =$session;
		
		$users = new UserModel();
		$data['users']=$users->getSingleUser($session->get('idUserH'));
        $data['loginusers']=$users->getSingleUser($session->get('idUserH'));
		$data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
		$data['friendrequest']=$users->getFriendRequest($session->get('idUserH'));
		$data['people_you_may_know']=$users->getAllUsersList($session->get('idUserH'));
        $data['friend_request_send_by_me']=$users->friendRequestSendByMe($session->get('idUserH'));
		$rm = new EventModel();
		$data['event_data']=$rm->getEventByUser($session->get('idUserH'));

    
   

		$vegan= new PostModel();
		$veganpost=$vegan->getSingleUserPost($session->get('idUserH'));
		$veganphoto=$vegan->getUserPhotos($session->get('idUserH'));
		//$veganphoto=$vegan->getUserAllPhotos($session->get('idUserH'));
		$i=0;
		foreach($veganpost as $values){
		$veganpost[$i]['comments_data']=$vegan->getPostComment($values['id']);
		$veganpost[$i]['likes_data']=$vegan->getPostLike($values['id']);
		$veganpost[$i]['liked_by_user']=$vegan->getPostLikeByUser($values['id'],$session->get('idUserH'));
		$i++;
		}
		
		$data['posts']=$veganpost;
		$data['photos']=$veganphoto;
		$data['public_url']=base_url()."/public/frontend/";
		$data['baseurl']=base_url()."/";
		$data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
		$data['friendrequest']=$users->getFriendRequest($session->get('idUserH'));
		$data['birthday']=$users->getUserFriendBirthday($session->get('idUserH'));
		return view('user/friend/friendRequestList',$data);
	}
	public function eventUser(){
		$session = session();
        $users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$data['session'] =$session;
		$events= new EventModel();
		$data['events']=$events->getAllEventByUser($session->get('idUserH'));
		$data['event_latest']=$events->getLatestEventByUser($session->get('idUserH'));
		 $data['event_comment']=$events->getEventComment();
		$data['event_category']=$events->getAllEventCategories();
		$data['event_attendent']=$events->getAllEventAttendent();

		$users = new UserModel();
		$data['users']=$users->getSingleUser($session->get('idUserH'));
		$data['loginusers']=$users->getSingleUser($session->get('idUserH'));
		$rm = new RecommendationModel();
		$data['recats']=$rm->getAllReRequestsByUser();
		$news= new NewsModel();
		$data['newsall']=$news->getAllPostByUser();

		$blog= new BlogModel();
		$data['blogdashboard']=$blog->getAllPostfor_dasbord($session->get('idUserH'));
		 $data['latest_blog_comment']=$blog->getBlogsComment();
		$data['latest_blog']=$blog->getLatestBlogByUser($session->get('idUserH'));
		$data['blogall']=$blog->getAllPostByUser($session->get('idUserH'));
		$data['public_url']=base_url()."/public/frontend/";
		$data['baseurl']=base_url()."/";
		$data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
		$data['friendrequest']=$users->getFriendRequest($session->get('idUserH'));
		$data['birthday']=$users->getUserFriendBirthday($session->get('idUserH'));
		return view('user/event/eventUser',$data);
	}
	public function eventUser1(){
		$session = session();
        $users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$data['session'] =$session;
		$events= new EventModel();
		$data['events']=$events->getAllEventByUser($session->get('idUserH'));
		$data['event_latest']=$events->getLatestEventByUser($session->get('idUserH'));
		 $data['event_comment']=$events->getEventComment();
		$data['event_category']=$events->getAllEventCategories();
		
		$rm = new RecommendationModel();
		$data['recats']=$rm->getAllReRequestsByUser();
		$news= new NewsModel();
		$data['newsall']=$news->getAllPostByUser();
		$blog= new BlogModel();
		$data['blogall']=$blog->getAllPostByUser($session->get('idUserH'));
		$data['public_url']=base_url()."/public/frontend/";
		$data['baseurl']=base_url()."/";
		 $users = new UserModel();
		$data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
		$data['friendrequest']=$users->getFriendRequest($session->get('idUserH'));
		$data['birthday']=$users->getUserFriendBirthday($session->get('idUserH'));
		$data['loginusers']=$users->getSingleUser($session->get('idUserH'));
		return view('user/event/eventUser1',$data);
	}
	public function eventByCategory($categoryId){
		$session = session();
        $users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$data['session'] =$session;
		$users = new UserModel();
		$data['users']=$users->getSingleUser($session->get('idUserH'));
        $data['loginusers']=$users->getSingleUser($session->get('idUserH'));
		$events= new EventModel();
		$data['events']=$events->getAllEventByCategory($session->get('idUserH'),$categoryId);
		$data['event_attendent']=$events->getAllEventAttendent();
		$data['event_latest']=$events->getLatestEventByCategory($session->get('idUserH'),$categoryId);
		 $data['event_comment']=$events->getEventComment();
		$data['event_category']=$events->getAllEventCategories();
		
		$rm = new RecommendationModel();
		$data['recats']=$rm->getAllReRequestsByUser();
		$news= new NewsModel();
		$data['newsall']=$news->getAllPostByUser();
		$blog= new BlogModel();
			 $data['latest_blog_comment']=$blog->getBlogsComment();
			 	$data['blogdashboard']=$blog->getAllPostfor_dasbord($session->get('idUserH'));
		$data['latest_blog']=$blog->getLatestBlogByUser($session->get('idUserH'));
		$data['blogall']=$blog->getAllPostByUser($session->get('idUserH'));
		$data['public_url']=base_url()."/public/frontend/";
		$data['baseurl']=base_url()."/";
		 $users = new UserModel();
		$data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
		$data['friendrequest']=$users->getFriendRequest($session->get('idUserH'));
		$data['birthday']=$users->getUserFriendBirthday($session->get('idUserH'));
		$data['loginusers']=$users->getSingleUser($session->get('idUserH'));
		return view('user/event/eventUser',$data);
	}
	public function eventDetailsUser($id){
		$session = session();
        $users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$data['session'] =$session;
		$events= new EventModel();
		$data['event_details']=$events->getSingleEvent($id);
		$data['event_category']=$events->getAllEventCategories();
		$data['event_latest']=$events->getLatestEventByUser($session->get('idUserH'));
		 $data['event_comment']=$events->getEventComment();
		$rm = new RecommendationModel();
		$data['recats']=$rm->getAllReRequestsByUser();
		 $users = new UserModel();
		$data['users']=$users->getSingleUser($session->get('idUserH'));
		$data['loginusers']=$users->getSingleUser($session->get('idUserH'));
		$news= new NewsModel();
		$data['newsall']=$news->getAllPostByUser($session->get('idUserH'));
		$blog= new BlogModel();
		$data['blogall']=$blog->getAllPostByUser($session->get('idUserH'));
		$data['public_url']=base_url()."/public/frontend/";
		$data['baseurl']=base_url()."/";
		$data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
		$data['friendrequest']=$users->getFriendRequest($session->get('idUserH'));
		$data['birthday']=$users->getUserFriendBirthday($session->get('idUserH'));
		return view('user/event/eventDetailsUser',$data);
	}
	public function addEvent(){
		$session = session();
		
		$users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$data['session'] =$session;
		
		$events = new EventModel();
		$data['event_cats']=$events->getAllEventCategories();
		$data['event_users']=$events->getAllUsers();
		$data['event_category']=$events->getAllEventCategories();
		$data['event_latest']=$events->getLatestEventByUser($session->get('idUserH'));
		 $data['event_comment']=$events->getEventComment();
		$rm = new RecommendationModel();
		$data['recats']=$rm->getAllReRequestsByUser();
		$news= new NewsModel();
		$data['newsall']=$news->getAllPostByUser();
		$blog= new BlogModel();
		$data['blogall']=$blog->getAllPostByUser($session->get('idUserH'));
		$data['public_url']=base_url()."/public/frontend/";
		$data['baseurl']=base_url()."/";
		 $users = new UserModel();
		$data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
		$data['friendrequest']=$users->getFriendRequest($session->get('idUserH'));
		$data['birthday']=$users->getUserFriendBirthday($session->get('idUserH'));
		$data['loginusers']=$users->getSingleUser($session->get('idUserH'));
		return view('user/event/eventAdd',$data);
	}
	public function insertEvent(){
		
		$session = session();
		
		$post_image_db_data='';
		$post_image = $this->request->getFile('image');
		$post_image_name = $post_image->getName();
		if($post_image_name!=''){
			$post_image_name=time().$post_image_name;
			$post_image->move(ROOTPATH.'public/uploads/event/post/',$post_image_name);
			$post_image_db_data='public/uploads/event/post/'.$post_image_name;
		}
		/* $post_video_db_data='';
		$post_video = $this->request->getFile('video');
		$post_video_name = $post_video->getName();
		if($post_video_name!=''){
			$post_video_name=time().$post_video_name;
			$post_video->move(ROOTPATH.'public/uploads/event/post/',$post_video_name);
			$post_video_db_data='public/uploads/event/post/'.$post_video_name;
		} */
		$post_video_db_data=$this->request->getPost('video');
		$data=[
		'category'=>$this->request->getPost('category'),
		'name'=>$this->request->getPost('name'),
		'location'=>$this->request->getPost('location'),
		'posted_by'=>$session->get('idUserH'),
		'event_start_date'=>$this->request->getPost('event_start_date').' '.$this->request->getPost('event_start_time'),
		'event_end_date'=>$this->request->getPost('event_end_date').' '.$this->request->getPost('event_end_time'),
		'details'=>$this->request->getPost('details'),
		'image'=>$post_image_db_data,
		'video'=>$post_video_db_data,
		'status'=>0,
	    
		]; 
		 $rm = new EventModel();
		 $result=$rm->insertEvent($data);
		 $session->setFlashdata('msgevent', 'Event Added Successfully');
		 $response='';
			if($result['status']==1){
			  $response = ['status' => 1 ,'msgevent' => '<span style="color:#090;">Event Added Successfully</span>' ];
			}else{
			  $response = ['status' => 0 ,'msgevent' => '<span style="color:#900;">sorry we re having some technical problems. please try again !</span>' 						];
			}
		
			 echo json_encode($response);
		 /* if($result['status']==1){
		 return redirect()->to('user/event/add-event');
		 }else{
		  return redirect()->to('user/event/add-event');	 
		 } */
	}
	public function getSingleEvent($id){
		$session = session();
		$going=1;
		$notgoing=0;
        $data['session'] =$session;
		$events= new EventModel();
		$data=$events->getSingleEvent($id);
        
		$da=$events->getEventCommentUser($id);
		$das=$events->getEventCommentdetail($id);
			$public_url=base_url()."/public/frontend/";
        $baseurl=base_url()."/";
		$posted_by='';
		if(isset($data['user_name'])){
		if($data['user_name']!=''){
			$posted_by=$data['user_name'];
		}
		if($data['au_user_name']!=''){
			$posted_by='Admin';
		}	
		}
		
		 $curr_time =$data['created_at'];
		$image=base_url().'/'.$data['image'];
		$event_name=$data['name'];
		$user_phone=$data['user_phone'];
		$user_email=$data['user_email'];
		$location=$data['location'];
		$event_start_date=date('M d,Y h:i a',strtotime($data['event_start_date']));
		$event_end_date=date('M d,Y h:i a',strtotime($data['event_end_date']));
		$details=$data['details'];
		$detail1=substr($data['details'],20,100);
		$detail2=substr($data['details'],100,1000);
		$video=$data['video'];
		$videos='';
		if($video!=''){
			$videos='<div class="video_blog"><iframe height="280" width="500"  
             src="'.$video.'" title="YouTube video player"></iframe></div>';
		}
		$html='
  <div class="modal fade add_custom_field_pop" id="add_custom_blog" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content modal-lg">
      <div class="modal-header">
          <header class="common-post-header u-flex"> <img src="'.$baseurl.$data['user_profile'].'" class="user-image" alt="" width="40" height="40">
  <div class="common-post-info">
    <div class="user-and-group u-flex "> <a href="https://vegan.sidhauli.co.in/user/public_profile/26">'.$posted_by.' </a> </div>
    <div class="username_time"> <a href="#"> '.$curr_time.' </a> </div>
  </div>
</header>
         
        <button type="button" onclick="hidepopup()" class="close-video" data-dismiss="modal" aria-label="Close"> </button>
      </div>
      <div class="modal-body">
        <div class="custom_fields_pop">
         <div class="blog_ppup">
                  <h2 class="hidding_one_middel">'.$event_name.'</h2>
				  <ul>
               
                <p>'.$detail1.'</p>
              </ul>
				  <div class="blog_images"><img src="'.$image.'"></div>
                  <p>'.$detail2.'</p>
                  <div class="blog_date">
              
            </div>
            '.$videos.'

            <div class="tribe-events-single-section tribe-events-event-meta primary tribe-clearfix">
  <div class="tribe-events-meta-group tribe-events-meta-group-details">
    <h2 class="tribe-events-single-section-title"> Details </h2>
    <dl>
    <dt class="tribe-events-end-date-label"> Address: </dt>
      <dd> <abbr class="tribe-events-abbr tribe-events-end-date dtend" title="2022-01-04"> '.$location.' </abbr> </dd>
      <dt class="tribe-events-start-date-label"> Start: </dt>
       <dd> <abbr class="tribe-events-abbr tribe-events-start-date published dtstart" title="2021-12-15"> '.$event_start_date.'</abbr> </dd>
      <dt class="tribe-events-end-date-label"> End: </dt>
      <dd> <abbr class="tribe-events-abbr tribe-events-end-date dtend" title="2022-01-04"> '.$event_end_date.' </abbr> </dd>
      <dt class="tribe-events-event-categories-label">Event Category:</dt>
      <dd class="tribe-events-event-categories"><a href="#" rel="tag">Events</a></dd>
    </dl>
  </div>
  <div class="tribe-events-meta-group tribe-events-meta-group-organizer">
    <h2 class="tribe-events-single-section-title">Organizer</h2>
    <dl>
      <dt style="display:none;"></dt>
      <dd class="tribe-organizer"> '.$posted_by.'  </dd>
      <dt class="tribe-organizer-tel-label"> Phone: </dt>
      <dd class="tribe-organizer-tel"> '.$user_phone.'  </dd>
      <dt class="tribe-organizer-email-label"> Email: </dt>
      <dd class="tribe-organizer-email"> '.$user_email.'  </dd>
      <dt class="tribe-organizer-url-label"> Website: </dt>
      <dd class="tribe-organizer-url"> <a href="#" target="_blank" rel="external">www.hellovegans.com</a> </dd>
    </dl>
  </div>
</div>   
       <p>'.$detail2.'</p>';

       if($data['event_status']==0){
		
					$html.='    <div class="row">
         <div class="col-md-12 col-12 notgoingnot_interested">

         <form class="form-inline" role="form" method="post" id="Eventcommentform" name="eventcommentform">
         <div class="form-group">

         <input type="hidden" class="" id="commented_by" name="commented_by"  value="'.$session->get('idUserH').'" size="30" aria-required="true">
		<input type="hidden" class="" id="post_id" name="post_id"  value="'.$id.'" size="30" aria-required="true">

       <button class="notgoing_button post_comment btn btn-outline-primary btn-lg" id="going_'.$id.'" type="button" id="submitcomment"  onclick="submitEventGoing('.$id.','.$going.')"><i class="fa fa-check-circle-o" aria-hidden="true"></i>
 Going </button>
         <button class="notgoing_button post_comment btn btn-danger" style="display:none" type="button"  id="notGoing_'.$id.'"  onclick="submitEventGoing('.$id.','.$notgoing.')"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Not 
 Going </button>
       </div>
      </form>
	  
	   <button class="not_interested_button post_comment btn btn-outline-primary btn-lg" type="button" id="submitcomment"  onclick="eventNotintersted('.$id.')"><i class="fa fa-times" aria-hidden="true"></i> Not Interested</button>
        </div>

          

        
     </div>



        </div>';
					 
					}else{

						$html.='    <div class="row">
         <div class="col-md-12 col-12 notgoingnot_interested">

         <form class="form-inline" role="form" method="post" id="eventcommentform" name="eventcommentform">
         <div class="form-group">

         <input type="hidden" class="" id="commented_by" name="commented_by"  value="'.$session->get('idUserH').'" size="30" aria-required="true">
		<input type="hidden" class="" id="post_id" name="post_id"  value="'.$id.'" size="30" aria-required="true">

       <button class="notgoing_button post_comment btn btn-outline-primary btn-lg"  id="going_'.$id.'"  style="display:none"  type="button" id="submitcomment"  onclick="submitEventGoing('.$id.','.$going.')"> <i class="fa fa-check-circle-o" aria-hidden="true"></i>Going </button>
       <button class="notgoing_button post_comment btn btn-danger" type="button"  id="notGoing_'.$id.'"  onclick="submitEventGoing('.$id.','.$notgoing.')"><i class="fa fa-check-circle-o" aria-hidden="true"></i>  Not Going </button>
       </div>
      </form>
	   <button class="not_interested_button post_comment btn btn-outline-primary btn-lg" type="button" id="submitcomment"  onclick="eventNotintersted('.$id.')"> <i class="fa fa-check-circle-o" aria-hidden="true"></i> Not Interested</button>
        </div>

          

        
     </div>



        </div>';

					} 


		
		$html.='
		<div class="blog_comment">
		<div class="detailBox">
					 <div class="titleBox">
                        <label>Comments </label>';
		
		if(count($da)!=0){
			
			if(count($das)>2){
			$commentscount=count($das)-count($da);
			$html.='<button id="viewold" onclick="showoldercomments('.$id.')" class="viewoldcommetns">View Old '.$commentscount.' Commetns</button>';
			}
		}	
			$html.='</div>
			     <div class="actionBox">
                    <ul class="commentList">';
		if(count($da)!=0){			
			foreach($da as $datas){
			
			$commented_by='Admin';
			$userimage=base_url().'/'.'public/frontend/images/logo.png';
		      if($datas['users_name']!=''){
			    $commented_by=$datas['users_name'];
			    $userimage=base_url().'/'.$datas['users_profile_image'];
		      }
		$html.='<li>
          <div class="commenterImage"> <img src="'.$userimage.'" /> </div>
          <div class="commentText">
            <h2>'.$commented_by.'</h2>
            <p class="">'.$datas['message'].'</p>
            <span class="date sub-text">on '.date('M d, Y',strtotime($datas['created_at'])).'</span> </div>
        </li>';
			
			}
		}
	   $html.='</ul>';
     
        $html.='
           
		    <form class="form-inline" role="form" method="post" id="blogcommentform" name="blogcommentform">
        <div class="form-group">
          <h2>LEAVE A REPLY </h2>
          <textarea id="messagecomments" name="message"  class="form-control comment_here" rows="5" cols="3" placeholder="Enter your comment here..."></textarea>
        </div>
        <div class="form-group">
		<input type="hidden" class="" id="commented_by" name="commented_by"  value="'.$session->get('idUserH').'" size="30" aria-required="true">
		<input type="hidden" class="" id="post_id" name="post_id"  value="'.$id.'" size="30" aria-required="true">
          <button class="post_comment" type="button" id="submitcomment"  onclick="submitEventcomments()">Post Comment</button>
        </div>
      </form>';



     	$html.='

 


      

       </div>
      </div>
    </div>
  </div></div>';


echo $html;
	}
	public function getSingleEventolds($id){
		$session = session();
        $data['session'] =$session;
		$events= new EventModel();
		$data=$events->getSingleEvent($id);
		$posted_by='';
		if(isset($data['user_name'])){
		if($data['user_name']!=''){
			$posted_by=$data['user_name'];
		}
		if($data['au_user_name']!=''){
			$posted_by='Admin';
		}	
		}
		
		$image=base_url().'/'.$data['image'];
		$event_name=$data['name'];
		$location=$data['location'];
		$event_start_date=date('M d,Y h:i a',strtotime($data['event_start_date']));
		$event_end_date=date('M d,Y h:i a',strtotime($data['event_end_date']));
		$details=$data['details'];
		$detail1=substr($data['details'],50,400);
		$detail2=substr($data['details'],400,1000);
		$video=$data['video'];
		$videos='';
		if($video!=''){
			$videos='<div class="video_blog"><iframe height="280" width="500"  
             src="'.$video.'" title="YouTube video player"></iframe></div>';
		}
		$html='
  <div class="modal fade add_custom_field_pop" id="add_custom_blog" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content modal-lg">
      <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLongTitle">Event <span>by '.$posted_by.'</span></h5> 
         
        <button type="button" onclick="hidepopup()" class="close-video" data-dismiss="modal" aria-label="Close"> </button>
      </div>
      <div class="modal-body">
        <div class="custom_fields_pop">
         <div class="blog_ppup">
                  <div class="blog_images"><img src="'.$image.'"></div>
                  <h2 class="hidding_one_middel">'.$event_name.'</h2>
                  <div class="blog_date">
              <ul>
                <li><a href="#">'.$event_start_date.'</a></li>
      
              </ul>
            </div>
            <p>'.$detail1.'</p>'.$videos.'

            <div class="tribe-events-single-section tribe-events-event-meta primary tribe-clearfix">
  <div class="tribe-events-meta-group tribe-events-meta-group-details">
    <h2 class="tribe-events-single-section-title"> Details </h2>
    <dl>
    <dt class="tribe-events-end-date-label"> Address: </dt>
      <dd> <abbr class="tribe-events-abbr tribe-events-end-date dtend" title="2022-01-04"> '.$location.' </abbr> </dd>
      <dt class="tribe-events-start-date-label"> Start: </dt>
       <dd> <abbr class="tribe-events-abbr tribe-events-start-date published dtstart" title="2021-12-15"> '.$event_start_date.'</abbr> </dd>
      <dt class="tribe-events-end-date-label"> End: </dt>
      <dd> <abbr class="tribe-events-abbr tribe-events-end-date dtend" title="2022-01-04"> '.$event_end_date.' </abbr> </dd>
      <dt class="tribe-events-event-categories-label">Event Category:</dt>
      <dd class="tribe-events-event-categories"><a href="#" rel="tag">Events</a></dd>
    </dl>
  </div>
  <div class="tribe-events-meta-group tribe-events-meta-group-organizer">
    <h2 class="tribe-events-single-section-title">Organizer</h2>
    <dl>
      <dt style="display:none;"></dt>
      <dd class="tribe-organizer"> John Miller </dd>
      <dt class="tribe-organizer-tel-label"> Phone: </dt>
      <dd class="tribe-organizer-tel"> +91 000 000 0000 </dd>
      <dt class="tribe-organizer-email-label"> Email: </dt>
      <dd class="tribe-organizer-email"> hellovegans@mail.com </dd>
      <dt class="tribe-organizer-url-label"> Website: </dt>
      <dd class="tribe-organizer-url"> <a href="#" target="_blank" rel="external">www.hellovegans.com</a> </dd>
    </dl>
  </div>
</div>   
       <p>'.$detail2.'</p>
     

     <div class="row">
         <div class="col-md-4 col-6">

       <button class="post_comment btn btn-outline-primary btn-lg" type="button" id="submitcomment"  onclick="submitEventGoing('.$id.')">Going </button>

        </div>

         <div class="col-md-4 col-6">

        <button class="post_comment btn btn-outline-primary btn-lg" type="button" id="submitcomment"  onclick=" ">Not Interested</button>
        
         </div> 

        
     </div>



        </div>


      

       </div>
      </div>
    </div>
  </div></div>';
echo $html;
	}
	public function newsUser(){
		$session = session();
        $users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$data['session'] =$session;
		$events = new EventModel();
        $data['event_latest']=$events->getLatestEventByUser($session->get('idUserH'));
		$data['event_comment']=$events->getEventComment();
		  $data['events']=$events->getTopFiveEventByUser($session->get('idUserH'));

		$rm = new RecommendationModel();
		$data['recats']=$rm->getAllReRequestsByUser();
		$users = new UserModel();
		$data['users']=$users->getSingleUser($session->get('idUserH'));
		$data['loginusers']=$users->getSingleUser($session->get('idUserH'));
		$news= new NewsModel();
		$data['newsall']=$news->getAllPostByUser();
		$blog= new BlogModel();
		$data['blogall']=$blog->getAllPostByUser($session->get('idUserH'));
			$data['blogdashboard']=$blog->getAllPostfor_dasbord($session->get('idUserH'));

		$news= new NewsModel();
		$data['news']=$news->getAllNewstByUser($session->get('idUserH'));
		$data['news_latest']=$news->getLatestNewsByUser($session->get('idUserH'));
		$data['news_category']=$news->getAllNewsCategory();
		$data['news_traval_guide']=$news->getnews_of_traval_guide($session->get('idUserH'));
		
		$data['news_gadgets_guide']=$news->getnews_of_gadgets_guide($session->get('idUserH'));
		$data['getlatestGadgatnews']=$news->getlatestGadgatnews();
        
		$data['news_receipes_guide']=$news->getnews_of_receipes_guide($session->get('idUserH'));
		$data['getlatestReceipenews']=$news->getlatestReceipenews();
        $data['public_url']=base_url()."/public/frontend/";
		$data['baseurl']=base_url()."/";
		$data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
		$data['friendrequest']=$users->getFriendRequest($session->get('idUserH'));
		$data['birthday']=$users->getUserFriendBirthday($session->get('idUserH'));
		return view('user/news/newsUser',$data);
	}
	public function newsDetailsById($id){
		$session = session();
        $users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$data['session'] =$session;
			$users = new UserModel();
		$data['users']=$users->getSingleUser($session->get('idUserH'));
        $data['loginusers']=$users->getSingleUser($session->get('idUserH'));
			$rm = new RecommendationModel();
		$data['recats']=$rm->getAllReRequestsByUser();


		$blog= new BlogModel();
		$data['blogdashboard']=$blog->getAllPostfor_dasbord($session->get('idUserH'));

		$news= new NewsModel();
		$data['news_details']=$news->getSinglebNewById($id);
		$news->updateCount($id);
		$data['news_category']=$news->getAllNewsCategory();
		$data['new_comment']=$news->getcommentByPostId($id);
     $data['news_latest']=$news->getLatestNewsByUser($session->get('idUserH'));
		$data['public_url']=base_url()."/public/frontend/";
		$data['baseurl']=base_url()."/";
		$data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
		$data['friendrequest']=$users->getFriendRequest($session->get('idUserH'));
		$data['birthday']=$users->getUserFriendBirthday($session->get('idUserH'));
		$events = new EventModel();
        $data['event_latest']=$events->getLatestEventByUser($session->get('idUserH'));
		$data['event_comment']=$events->getEventComment();
		$data['events']=$events->getTopFiveEventByUser($session->get('idUserH'));
		return view('user/news/newsDetailsUser',$data);
	}

	public function getReceipeDetail($id){
		$session = session();
        $users = new UserChatModel();
			$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$vegan= new PostModel();
		$data['vaganpost'] =$vegan->getVeganPost($session->get('idUserH'));
		$data['session'] =$session;
		$events = new EventModel();
        $data['event_latest']=$events->getLatestEventByUser($session->get('idUserH'));
		 $data['event_comment']=$events->getEventComment();
		 $data['events']=$events->getTopFiveEventByUser($session->get('idUserH'));
		$rm = new RecommendationModel();
		$data['recats']=$rm->getAllReRequestsByUser();
		$news= new NewsModel();
		$data['newsall']=$news->getAllPostByUser();

	 //  $receipe=new ReceipeModel();
		// $data=$receipe->getSingleReceipe($id);
    $users = new UserModel();

		$data['users']=$users->getSingleUser($session->get('idUserH'));
        $data['loginusers']=$users->getSingleUser($session->get('idUserH'));
		$receipe=new ReceipeModel();
		$data['receipe']=$receipe->getAllBlogReceipesByUser($session->get('idUserH'));
		$data['receipe_category']=$receipe->getAllReceipeCategory();
		$data['receipe_detail']=$receipe->getSingleReceipe($id);
		
		$data['public_url']=base_url()."/public/frontend/";
		$data['baseurl']=base_url()."/";
		$data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
		$data['friendrequest']=$users->getFriendRequest($session->get('idUserH'));
		$data['birthday']=$users->getUserFriendBirthday($session->get('idUserH'));
		return view('user/recipe/recipe_detail',$data);
	}



	public function getSinglecook($id){
		$session = session();
        $data['session'] =$session;
		$cook= new CooksModel();
		$data=$cook->getSinglecooks_detail($id);
		
    $name='';
		if(isset($data['name'])){
		if($data['name']!=''){
			$name=$data['name'];
		}
		
		}

		$image=base_url().'/'.$data['image'];
		// $blogs_name=$data['title'];
		$event_start_date=date('M d,Y h:i a',strtotime($data['updated_at']));
		// $event_end_date=date('M d,Y h:i a',strtotime($data['event_end_date']));
		$details=$data['content'];
		$rating=$data['rating'];
		$phone=$data['phone'];
		$website=$data['website'];
		$email=$data['email'];
		$experience=$data['experience'];
		$specialization=$data['specialization'];
			$address=$data['address'];
		// $video=$data['video'];
		// $videos='';
		// if($video!=''){
		// 	$videos='<div class="video_blog"><iframe height="280" width="500"  
  //            src="'.$video.'" title="YouTube video player"></iframe></div>';
		// }
		$html='


<div class="modal fade add_recommendation_pop" id="add_cook_profile" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content modal-lg">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Cook Profile </h5>
        <button type="button" class="close-video" data-dismiss="modal" aria-label="Close"> </button>
      </div>
      <div class="modal-body">
<div class="page-wrapper ">
   <div class="cook_opupprofile">
   <div class="cook_img"><img class="avatar img-responsive" alt="admin_profile" src="'.$image.'"></div>
   <h2>'.$name.'</h2>
   <p>'.$address.' </p>
   </div>
   
<div class="product_detail_category">
        <ul>
		<li> <span><img src="https://vegan.sidhauli.co.in/public/frontend/images/rating.png"></span>
            <h2>Rating</h2>
            <p> '.$rating.'/5 | 122 Reviews </p>
          </li>
          <li> <span><img src="https://vegan.sidhauli.co.in/public/frontend/images/experience.png"></span>
            <h2>Experience</h2>
            <p>'.$experience.' Years</p>
          </li>
          <li> <span><img src="https://vegan.sidhauli.co.in/public/frontend/images/specialization.png"></span>
            <h2>Specialization</h2>
            <p>'.$specialization.'</p>
          </li>
           
        </ul>
      </div>
	  
	     <div class="cook_opupabout"> 
   <h2>About Us</h2>
   <p> '.$details.'</p>
   
   </div>
   <div class="tribe-events-single-section tribe-events-event-meta primary tribe-clearfix">
<h2 class="tribe-product-single-section-title"> Details </h2>
  <div class="tribe-events-meta-group tribe-events-meta-group-details tribe_product">
     <dl>
      <dt class="tribe-events-end-date-label"> Phone : </dt>
      <dd> <abbr class="tribe-events-abbr tribe-events-end-date dtend" title="2022-01-04"> '.$phone.'</abbr> </dd>
     
    </dl>
  </div>
  <div class="tribe-events-meta-group tribe-events-meta-group-organizer tribe_product">
     
    <dl>
      <dt class="tribe-events-start-date-label"> Email : </dt>
      <dd> <abbr class="tribe-events-abbr tribe-events-start-date published dtstart" title="2021-12-15"> '.$email.' </abbr> </dd>
    </dl>
  </div>
  <div class="tribe-events-meta-group tribe-events-meta-group-details tribe_product">
     
    <dl>
      <dt class="tribe-events-end-date-label"> Website : </dt>
      <dd> <abbr class="tribe-events-abbr tribe-events-end-date dtend" title="2022-01-04"> <a href="#" target="_blank" rel="external">'.$website.'</a> </abbr> </dd>
    </dl>
  </div>
</div>
</div>

         
            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>';
echo $html;
	}
	public function getSinglePost($id){
		$session = session();
        $data['session'] =$session;
		$post= new PostModel();
		$data=$post->getSinglepostById($id);
		
    $posted_by='';
		if(isset($data['user_name'])){
		if($data['user_name']!=''){
			$posted_by=$data['user_name'];
		}
		else if($data['admin_id'] ==0 ){
			$posted_by='Admin';
		}	
		}else if(isset($data['au_user_name'])){

				$posted_by='Admin';

		}


		$image=base_url().'/'.$data['image'];
		$post_name=$data['title'];
		$event_start_date=date('M d,Y h:i a',strtotime($data['updated_at']));
		// $event_end_date=date('M d,Y h:i a',strtotime($data['event_end_date']));
		$details=$data['content'];
		// $video=$data['video'];
		// $videos='';
		// if($video!=''){
		// 	$videos='<div class="video_blog"><iframe height="280" width="500"  
  //            src="'.$video.'" title="YouTube video player"></iframe></div>';
		// }
		$html='
  <div class="modal fade add_custom_field_pop" id="add_custom_blog" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content modal-lg">
      <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLongTitle">Post<span>by '.$posted_by.'</span></h5> 
         
        <button type="button" onclick="hidepopup()" class="close-video" data-dismiss="modal" aria-label="Close"> </button>
      </div>
      <div class="modal-body">
        <div class="custom_fields_pop">
         <div class="blog_ppup">
                  <div class="blog_images"><img src="'.$image.'"></div>
                  <h2 class="hidding_one_middel">'.$post_name.'</h2>
                  <div class="blog_date">
              <ul>
                <li><a href="#">'.$event_start_date.'</a></li>
                
                <li> Blog</li>
              </ul>
            </div>
            <p>'.$details.'</p>
        </div>
       </div>
      </div>
    </div>
  </div></div>';
echo $html;
	}
	public function getSingleReceipe($id){
		$session = session();
        $data['session'] =$session;
		$receipe= new ReceipeModel();
		$receipe=new ReceipeModel();
		$data=$receipe->getSingleReceipe($id);

		 $posted_by='';
		if(isset($data['user_name'])){
		if($data['user_name']!=''){
			$posted_by=$data['user_name'];
		}
		else if($data['posted_by'] ==0 ){
			$posted_by='Admin';
		}	
		}else if(isset($data['au_user_name'])){

				$posted_by='Admin';

		}
		
		$image=base_url().'/'.$data['image'];
		$event_name=$data['title'];
		$event_start_date=date('M d,Y h:i a',strtotime($data['updated_at']));
		// $event_end_date=date('M d,Y h:i a',strtotime($data['event_end_date']));
		$details=$data['content'];
			$video=$data['video'];
		// $video=$data['video'];
		// $videos='';
		// if($video!=''){
		// 	$videos='<div class="video_blog"><iframe height="280" width="500"  
  //            src="'.$video.'" title="YouTube video player"></iframe></div>';
		// }
		$html='

		  <div class="modal fade add_custom_field_pop" id="add_custom_blog" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content modal-lg">
      <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLongTitle">Recipes<span>by '.$posted_by.'</span></h5> 
         
        <button type="button" onclick="hidepopup()" class="close-video" data-dismiss="modal" aria-label="Close"> </button>
      </div>
      <div class="modal-body">
              <div class="restaurants_imag"><img src="'.$image.'"></div>
                    <div class="d_all">
          <div class="bg-white grey about_rel_info padding-b-0">
            <div class="align-v-center flex flex-between margin-b-15">
              <h2 class="font-20 bold grey">'.$event_name.'</h2>
              <div class="flex align-v-center">
                
                <div class="flex align-v-center padding-l-5"> <span class="grey-darker">'.$event_start_date.'</span> <span class="padding-l-5 padding-r-5"> | </span> <span class="text-blue pointer review_tab"></span> </div>
              </div>
            </div>
             
            <hr class="hr-grey-light margin-t-20">
          </div>
          
          <div class="direction">
            <h2>Video</h2>
              <div class="o-video">
                <iframe src="'.$video.'"  allowfullscreen></iframe>
             </div>
          </div>
          <div class="restaurant_fa">
            <div class="padding-b-30 ">
               
               <p>'.$details.'</p>
               

          </div>
           
        </div>
        
       
        
        
       
      </div>
    </div>
   </div>
  </div>

  ';
echo $html;
	}
	public function newsByCategory($categoryId){
	$session = session();
        $users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$data['session'] =$session;
		$events = new EventModel();
        $data['event_latest']=$events->getLatestEventByUser($session->get('idUserH'));
		 $data['event_comment']=$events->getEventComment();
		 $data['events']=$events->getTopFiveEventByUser($session->get('idUserH'));
		$rm = new RecommendationModel();
		$data['recats']=$rm->getAllReRequestsByUser();
		$users = new UserModel();
		$data['users']=$users->getSingleUser($session->get('idUserH'));
		$data['loginusers']=$users->getSingleUser($session->get('idUserH'));
		$blog= new BlogModel();
		$data['blogall']=$blog->getAllPostByUser($session->get('idUserH'));
			$data['blogdashboard']=$blog->getAllPostfor_dasbord($session->get('idUserH'));

		$news= new NewsModel();
		
		$data['news_latest']=$news->getLatestNewsByCategory($session->get('idUserH'),$categoryId);
		$data['news_category']=$news->getAllNewsCategory();
		$data['news']=$news->getAllNewsByCategory($session->get('idUserH'),$categoryId);
      $data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
	  $data['friendrequest']=$users->getFriendRequest($session->get('idUserH'));
		$data['birthday']=$users->getUserFriendBirthday($session->get('idUserH'));
		$data['public_url']=base_url()."/public/frontend/";
		$data['baseurl']=base_url()."/";	
	return view('user/news/newsByCategory',$data);
	}
	public function insertNewsPostComment(){
		

		$id=$this->request->getPost('post_id');
		$data=[
		'post_id'=>$this->request->getPost('post_id'),
		//'post_id'=>$id,
		'posted_by'=>$this->request->getPost('user_id'),
		'message'=>$this->request->getPost('message'),
		'created_at'=>date('Y-m-d H:i:s'),
		'status'=>1
		]; 
		 $news = new NewsModel();
		 $news->insertNewsComment($data);
		//  $data['news_details']=$news->getSinglebNewById($id);
		// $data['news_category']=$news->getAllNewsCategory();

		
		return redirect()->to('user/news/details/'.$id);
		
	}
	public function newsUserolds(){
		$session = session();
        $users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$data['session'] =$session;
		$events = new EventModel();
        $data['event_latest']=$events->getLatestEventByUser($session->get('idUserH'));
		 $data['event_comment']=$events->getEventComment();
		$rm = new RecommendationModel();
		$data['recats']=$rm->getAllReRequestsByUser();
		$news= new NewsModel();
		$data['newsall']=$news->getAllPostByUser();
		$blog= new BlogModel();
		$data['blogall']=$blog->getAllPostByUser($session->get('idUserH'));
		 $users = new UserModel();
		$data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
		$data['friendrequest']=$users->getFriendRequest($session->get('idUserH'));
		$data['birthday']=$users->getUserFriendBirthday($session->get('idUserH'));
		$data['loginusers']=$users->getSingleUser($session->get('idUserH'));
		return view('user/news/newsUser',$data);
	}
	public function newsDetailsUser(){
		$session = session();
        $users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$data['session'] =$session;
		 $users = new UserModel();
		$data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
		$data['friendrequest']=$users->getFriendRequest($session->get('idUserH'));
		$data['birthday']=$users->getUserFriendBirthday($session->get('idUserH'));
		$data['loginusers']=$users->getSingleUser($session->get('idUserH'));
		return view('user/news/newsDetailsUser',$data);
	}
   public function blogDetails($id){

		$session = session();
        $data['session'] =$session;
		$blogs= new BlogModel();
		$data=$blogs->getSingleblogs($id);
		if($data['posted_by']==0){
			$posted_by='Admin';
		}else{
			$posted_by=$data['user_name'];
		}
		
		$blogs_name=$data['title'];
		$createddate=date('M d,Y h:i a',strtotime($data['created_at']));
		$details=$data['content'];
		$detail1=substr($data['content'],50,200);
		$detail2=substr($data['content'],200,400);
		$detail3=substr($data['content'],400,600);
		$detail4=substr($data['content'],600,800);
		$detail5=substr($data['content'],800,1200);
		if($data['galleryimage']!=''){
		$ex=explode(",",$data['galleryimage']);
         if(isset($ex[0])){
			$image_galary1=base_url().'/'.$ex[0]; 
		 }
		}
		$da=$blogs->getPostCommentUser($id);
		$das=$blogs->getPostComment($id);
		$data['data']=$data;
		$data['da']=$da;
		$data['das']=$das;
		$users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$data['session'] =$session;
		$posts = new BlogModel();
		$data['posts']=$posts->getAllPost();
		$events = new EventModel();
        $data['event_latest']=$events->getLatestEventByUser($session->get('idUserH'));
		 $data['event_comment']=$events->getEventComment();
		 $data['events']=$events->getTopFiveEventByUser($session->get('idUserH'));
		$rm = new RecommendationModel();
		$data['recats']=$rm->getAllReRequestsByUser();
		$news= new NewsModel();
		$data['newsall']=$news->getAllPostByUser();

		$users = new UserModel();
		$data['users']=$users->getSingleUser($session->get('idUserH'));
        $data['loginusers']=$users->getSingleUser($session->get('idUserH'));
		$blog= new BlogModel();
		$data['blogall']=$blog->getAllPostByUser($session->get('idUserH'));
		$data['latest_blog']=$blog->getLatestBlogByUser($session->get('idUserH'));
		$data['blog_category']=$blog->getAllPostCategoryByUser();
		$data['categories']=$blog->getAllPostCategory();

		$receipe=new ReceipeModel();
		$data['blogRECIPES']=$receipe->getAllBlogReceipes_blog($session->get('idUserH'));
		$data['public_url']=base_url()."/public/frontend/";
		$data['baseurl']=base_url()."/";
		$data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
		$data['friendrequest']=$users->getFriendRequest($session->get('idUserH'));
		$data['birthday']=$users->getUserFriendBirthday($session->get('idUserH'));
		$events = new EventModel();
		$data['events']=$events->getTopFiveEventByUser($session->get('idUserH'));
        $data['event_latest']=$events->getLatestEventByUser($session->get('idUserH'));
        $data['event_comment']=$events->getEventComment();
return view('user/blog/blogDetails',$data);
   }

public function getSingleblog($id){
		$session = session();
        $data['session'] =$session;
		$blogs= new BlogModel();
		$data=$blogs->getSingleblogs($id);
		$public_url=base_url()."/public/frontend/";
        $baseurl=base_url()."/";

		if($data['posted_by']==0){
			$posted_by='Admin';
		}else{
			$posted_by=$data['user_name'];
		}
		
		$blogs_name=$data['title'];
		$createddate=date('M d,Y h:i a',strtotime($data['created_at']));
		$details=$data['content'];
		
		 $curr_time =$data['created_at'];

		if($data['galleryimage']!=''){
		$ex=explode(",",$data['galleryimage']);
         if(isset($ex[0])){
			$image_galary1=base_url().'/'.$ex[0]; 
		 }
		}
		
		$html='
		<div class="modal fade add_custom_field_pop" id="add_custom_blog" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered" role="document">
		  <div class="modal-content modal-lg">
             <div class="modal-header">
			     <header class="common-post-header u-flex"> <img src="'.$baseurl.$data['user_profile'].'" class="user-image" alt="" width="40" height="40">
  <div class="common-post-info">
    <div class="user-and-group u-flex "> <a href="https://vegan.sidhauli.co.in/user/public_profile/26">'.$posted_by.' </a> </div>
    <div class="username_time"> <a href="#"> '.$curr_time.' </a> </div>
  </div>
</header>
				<button type="button" class="close-video" data-dismiss="modal" aria-label="Close"> </button>
			  </div>
			  <div class="modal-body">
			    <div class="custom_fields_pop">
			     <div class="blog_ppup">
                   <div class="blog_images">
				   <h2 class="hidding_one_middel">'.$blogs_name.'</h2>
					<div class="blog_date">
					<ul>
					 
					</ul>
					
				   ';
		            if($data['image']!=''){
					$image=base_url().'/'.$data['image'];
					$html.='<img src="'.$image.'">';
					}
		            $html.='</div>
					
					</div>
					
					<div class="blog_text">
					  <div class="row">
					    <div class="col-md-12">
						  <p>'.$details.'</p>
						</div>
						
						
					</div>
					</div>';
					
					if($data['video']!=''){
					$videos=base_url().'/'.$data['video'];
					$html.='<div class="embed-responsive embed-responsive-16by9 col-xs-4 text-center">';
					  $html.='<video src="'.$videos.'" controls></video>';
					  $html.='</div>';
					}  
					
			if($data['galleryimage']!=''){
			   $ex=explode(",",$data['galleryimage']);
				if(isset($ex[0])){
				  $image_galary1=base_url().'/'.$ex[0];
					$html.='<section class="slider-section">
					        <div id="owl-demo" class="owl-carousel  owl-theme">';
								foreach($ex as $val){
								  $image_galarys=base_url().'/'.$val;
								  $html.='<div class="item col-md-14"><img width="150" height="200" src="'.$image_galarys.'"></div>';
								}
					$html.='</div></div>';			
				}
			}
		
		$html.='</div>';
		
		$da=$blogs->getPostCommentUser($id);
		$das=$blogs->getPostComment($id);
		$html.='
		<div class="blog_comment">
		<div class="detailBox">
					 <div class="titleBox">
                        <label>Comments </label>';
		
		if(count($da)!=0){
			
			if(count($das)>2){
			$commentscount=count($das)-count($da);
			$html.='<button id="viewold" onclick="showoldercomments('.$id.')" class="viewoldcommetns">View Old '.$commentscount.' Commetns</button>';
			}
		}	
			$html.='</div>
			     <div class="actionBox">
                    <ul class="commentList">';
		if(count($da)!=0){			
			foreach($da as $datas){
			
			$commented_by='Admin';
			$userimage=base_url().'/'.'public/frontend/images/logo.png';
		      if($datas['users_name']!=''){
			    $commented_by=$datas['users_name'];
			    $userimage=base_url().'/'.$datas['users_profile_image'];
		      }
		$html.='<li>
          <div class="commenterImage"> <img src="'.$userimage.'" /> </div>
          <div class="commentText">
            <h2>'.$commented_by.'</h2>
            <p class="">'.$datas['message'].'</p>
            <span class="date sub-text">on '.date('M d, Y',strtotime($datas['created_at'])).'</span> </div>
        </li>';
			
			}
		}
	   $html.='</ul>';
     
        $html.='
           
		    <form class="form-inline" role="form" method="post" id="blogcommentform" name="blogcommentform">
        <div class="form-group">
          <h2>LEAVE A REPLY </h2>
          <textarea id="messagecomments" name="message"  class="form-control comment_here" rows="5" cols="3" placeholder="Enter your comment here..."></textarea>
        </div>
        <div class="form-group">
		<input type="hidden" class="" id="commented_by" name="commented_by"  value="'.$session->get('idUserH').'" size="30" aria-required="true">
		<input type="hidden" class="" id="post_id" name="post_id"  value="'.$id.'" size="30" aria-required="true">
          <button class="post_comment" type="button" id="submitcomment"  onclick="submitblogcomments()">Post Comment</button>
        </div>
      </form>
		   
    </div>
  </div>
</div>';
echo $html;
	}
	public function getSingleblog_today($id){
		$session = session();
        $data['session'] =$session;
		$blogs= new BlogModel();
		$data=$blogs->getSingleblogs($id);
		$public_url=base_url()."/public/frontend/";
        $baseurl=base_url()."/";

		if($data['posted_by']==0){
			$posted_by='Admin';
		}else{
			$posted_by=$data['user_name'];
		}
		
		$blogs_name=$data['title'];
		$createddate=date('M d,Y h:i a',strtotime($data['created_at']));
		$details=$data['content'];
		$detail1=substr($data['content'],50,200);
		$detail2=substr($data['content'],200,400);
		$detail3=substr($data['content'],400,600);
		$detail4=substr($data['content'],600,800);
		$detail5=substr($data['content'],800,1200);
		 $curr_time =$data['created_at'];

		if($data['galleryimage']!=''){
		$ex=explode(",",$data['galleryimage']);
         if(isset($ex[0])){
			$image_galary1=base_url().'/'.$ex[0]; 
		 }
		}
		
		$html='
		<div class="modal fade add_custom_field_pop" id="add_custom_blog" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered" role="document">
		  <div class="modal-content modal-lg">
             <div class="modal-header">
			     <header class="common-post-header u-flex"> <img src="'.$baseurl.$data['user_profile'].'" class="user-image" alt="" width="40" height="40">
  <div class="common-post-info">
    <div class="user-and-group u-flex "> <a href="https://vegan.sidhauli.co.in/user/public_profile/26">'.$posted_by.' </a> </div>
    <div class="username_time"> <a href="#"> '.$curr_time.' </a> </div>
  </div>
</header>
				<button type="button" class="close-video" data-dismiss="modal" aria-label="Close"> </button>
			  </div>
			  <div class="modal-body">
			    <div class="custom_fields_pop">
			     <div class="blog_ppup">
                   <div class="blog_images">
				   <h2 class="hidding_one_middel">'.$blogs_name.'</h2>
					<div class="blog_date">
					<ul>
					 
					</ul>
					<p>'.$detail1.'</p>
				   ';
		            if($data['image']!=''){
					$image=base_url().'/'.$data['image'];
					$html.='<img src="'.$image.'">';
					}
		            $html.='</div>
					
					</div>
					
					<div class="blog_text">
					  <div class="row">
					    <div class="col-md-12">
						  <p>'.$detail2.'</p>
						</div>
						<div class="col-md-8">
						<p>'.$detail3.' </p>
						</div>
						<div class="col-md-4">
						<div class="blog_images">';
						if($data['galleryimage']!=''){
						$ex=explode(",",$data['galleryimage']);
						$image=base_url().'/'.$ex[0];	
						$html.='<img height="150" src="'.$image.'">';	
						}
						$html.='</div>
					  </div>
					</div>
					</div>';
					
					if($data['video']!=''){
					$videos=base_url().'/'.$data['video'];
					$html.='<div class="embed-responsive embed-responsive-16by9 col-xs-4 text-center">';
					  $html.='<video src="'.$videos.'" controls></video>';
					  $html.='</div>';
					}  
					$html.='<p>'.$detail4.'</p>';
			if($data['galleryimage']!=''){
			   $ex=explode(",",$data['galleryimage']);
				if(isset($ex[0])){
				  $image_galary1=base_url().'/'.$ex[0];
					$html.='<section class="slider-section">
					        <div id="owl-demo" class="owl-carousel  owl-theme">';
								foreach($ex as $val){
								  $image_galarys=base_url().'/'.$val;
								  $html.='<div class="item col-md-14"><img width="150" height="200" src="'.$image_galarys.'"></div>';
								}
					$html.='</div></div>';			
				}
			}
		$html.='<p>'.$detail5.'</p>';
		$html.='</div>';
		
		$da=$blogs->getPostCommentUser($id);
		$das=$blogs->getPostComment($id);
		$html.='
		<div class="blog_comment">
		<div class="detailBox">
					 <div class="titleBox">
                        <label>Comments </label>';
		
		if(count($da)!=0){
			
			if(count($das)>2){
			$commentscount=count($das)-count($da);
			$html.='<button id="viewold" onclick="showoldercomments('.$id.')" class="viewoldcommetns">View Old '.$commentscount.' Commetns</button>';
			}
		}	
			$html.='</div>
			     <div class="actionBox">
                    <ul class="commentList">';
		if(count($da)!=0){			
			foreach($da as $datas){
			
			$commented_by='Admin';
			$userimage=base_url().'/'.'public/frontend/images/logo.png';
		      if($datas['users_name']!=''){
			    $commented_by=$datas['users_name'];
			    $userimage=base_url().'/'.$datas['users_profile_image'];
		      }
		$html.='<li>
          <div class="commenterImage"> <img src="'.$userimage.'" /> </div>
          <div class="commentText">
            <h2>'.$commented_by.'</h2>
            <p class="">'.$datas['message'].'</p>
            <span class="date sub-text">on '.date('M d, Y',strtotime($datas['created_at'])).'</span> </div>
        </li>';
			
			}
		}
	   $html.='</ul>';
     
        $html.='
           
		    <form class="form-inline" role="form" method="post" id="blogcommentform" name="blogcommentform">
        <div class="form-group">
          <h2>LEAVE A REPLY </h2>
          <textarea id="messagecomments" name="message"  class="form-control comment_here" rows="5" cols="3" placeholder="Enter your comment here..."></textarea>
        </div>
        <div class="form-group">
		<input type="hidden" class="" id="commented_by" name="commented_by"  value="'.$session->get('idUserH').'" size="30" aria-required="true">
		<input type="hidden" class="" id="post_id" name="post_id"  value="'.$id.'" size="30" aria-required="true">
          <button class="post_comment" type="button" id="submitcomment"  onclick="submitblogcomments()">Post Comment</button>
        </div>
      </form>
		   
    </div>
  </div>
</div>';
echo $html;
	}
	
  public function getSinglePostComment(){
	  $session = session();
        $data['session'] =$session;
		$posts= new PostModel();
		$id=$this->request->getPost('postid');
		$data=$posts->getSinglePostUser($id);
		$public_url=base_url()."/public/frontend/";
        $baseurl=base_url()."/";
		if($data['posted_by']==0){
			$posted_by='Admin';
		}else{
			$posted_by=$data['user_name'];
		}
		
		$title=$data['title'];
		$name=$data['user_name'];
		$date=date('M d,Y h:i a',strtotime($data['created_at']));
		$details=strip_tags($data['content']);
		$profile_image=$data['user_profile'];
		$user_id=$data['posted_by'];
		 $curr_time =$data['created_at'];
                  $time_ago = strtotime($curr_time);
                    // $time=time_Ago($time_ago);

		
		$html='
		<div class="modal fade add_custom_field_pop" id="add_custom_post" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered" role="document">
		  <div class="modal-content modal-lg">
             <div class="modal-header">
			 <header class="common-post-header u-flex"> <img src="'.$baseurl.$data['user_profile'].'" class="user-image" alt="" width="40" height="40">
  <div class="common-post-info">
    <div class="user-and-group u-flex "> <a href="/user/public_profile/26">'.$posted_by.' </a> </div>
    <div class="username_time"> <a href="#"> '.$curr_time.' </a> </div>
  </div>
</header>
			   <!-- <h5 class="modal-title" id="exampleModalLongTitle">Posted <span>by '.$posted_by.','.$date.'</span></h5>-->
				<button type="button" onclick="$(\'#add_custom_post\').modal(\'hide\')" class="close-video" data-dismiss="modal" aria-label="Close"> </button>
			  </div>
			  <div class="modal-body">
			    <div class="custom_fields_pop">
			     <div class="blog_ppup">
                   <div class="blog_images">';
		          
					if($data['image']!=''){
					$mime = mime_content_type($data['image']);
					 if(strstr($mime, "video/")){
						 $html.='<video  height="400" controls> 
					  <source src="'.$baseurl.$data['image'].'" type="video/webm"> 
					  <source src="'.$baseurl.$data['image'].'" type="video/ogg"> 
					  <source src="'.$baseurl.$data['image'].'" type="video/mp4">
					  <source src="'.$baseurl.$data['image'].'" type="video/3gp">
					</video>';
					 }else{
						 $html.='<img src="'.$baseurl.$data['image'].'">';
					 }
					}else{
					//$html.='<img src="'.$public_url.'images/no_img.jpg'.'">';	
					}
					
					
		            $html.='</div>
					<h2 class="hidding_one_middel">'.$title.'</h2>
					<div class="blog_date">
					<ul>
					
					  
					
					</ul>
					</div>
					<div class="blog_text">
					 <p>'.$details.'</p>
					</div></div></div></div>';
		$da=$posts->getPostCommentUser($id);
		$das=$posts->getPostComment($id);
		$html.='
		<div class="blog_comment">
		<div class="detailBox">
					 <div class="titleBox">
                        <label>Comments </label>';
		
		if(count($da)!=0){
			
			if(count($das)>2){
			$commentscount=count($das)-count($da);
			$html.='<button id="viewold" onclick="showoldercomments('.$id.')" class="viewoldcommetns">View Old '.$commentscount.' Commetns</button>';
			}
		}	
			$html.='</div>
			     <div class="actionBox">
                    <ul class="commentList">';
		if(count($da)!=0){			
			foreach($da as $datas){
			
			$commented_by='Admin';
			$userimage=base_url().'/'.'public/frontend/images/logo.png';
		      if($datas['users_name']!=''){
			    $commented_by=$datas['users_name'];
			    $userimage=base_url().'/'.$datas['users_profile_image'];
		      }
		$html.='<li>
          <div class="commenterImage"> <img src="'.$userimage.'" /> </div>
          <div class="commentText">
            <h2>'.$commented_by.'</h2>
            <p class="">'.$datas['message'].'</p>
            <span class="date sub-text">on '.date('M d, Y',strtotime($datas['created_at'])).'</span> </div>
        </li>';
			
			}
		}
	   $html.='</ul>';
     
        $html.='
           
		    <form class="form-inline" role="form" method="post" id="postcommentform" name="postcommentform">
        <div class="form-group">
          <h2>LEAVE A REPLY </h2>
          <textarea id="messagecomments" name="message"  class="form-control comment_here" rows="5" cols="3" placeholder="Enter your comment here..."></textarea>
        </div>
        <div class="form-group">
		<input type="hidden" class="" id="commented_by" name="commented_by"  value="'.$session->get('idUserH').'" size="30" aria-required="true">
		<input type="hidden" class="" id="post_id" name="post_id"  value="'.$id.'" size="30" aria-required="true">
          <button class="post_comment" type="button" id="submitcomment"  onclick="submitpostcomments()">Post Comment</button>
        </div>
      </form>
		   
    </div>
  </div>
</div>';
echo $html;
  }
	
	
	public function blogUser(){
		$session = session();
        $users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$data['session'] =$session;
		$posts = new BlogModel();
		$data['posts']=$posts->getAllPost();
		$events = new EventModel();
        $data['event_latest']=$events->getLatestEventByUser($session->get('idUserH'));
		 $data['event_comment']=$events->getEventComment();
		$rm = new RecommendationModel();
		$data['recats']=$rm->getAllReRequestsByUser();
		$news= new NewsModel();
		$data['newsall']=$news->getAllPostByUser();

		$users = new UserModel();
		$data['users']=$users->getSingleUser($session->get('idUserH'));
        $data['loginusers']=$users->getSingleUser($session->get('idUserH'));
		

		$receipe=new ReceipeModel();
		$data['blogRECIPES']=$receipe->getAllBlogReceipes_blog($session->get('idUserH'));
		$data['public_url']=base_url()."/public/frontend/";
		$data['baseurl']=base_url()."/";
		$data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
		$data['friendrequest']=$users->getFriendRequest($session->get('idUserH'));
		$data['birthday']=$users->getUserFriendBirthday($session->get('idUserH'));
		$events = new EventModel();
		$data['events']=$events->getTopFiveEventByUser($session->get('idUserH'));
        $data['event_latest']=$events->getLatestEventByUser($session->get('idUserH'));
        $data['event_comment']=$events->getEventComment();
		$blog= new BlogModel();
		$data['blogall']=$blog->getAllPostByUserLimit($session->get('idUserH'),0,4);
		$data['latest_blog']=$blog->getLatestBlogByUser($session->get('idUserH'));
		$data['blog_category']=$blog->getAllPostCategoryByUser();
		$data['categories']=$blog->getAllPostCategory();
		$data['start']=4;
		$data['limit']=4;
		
		return view('user/blog/blogUser',$data);
	}
	public function blogUserLoadMore(){
		$session = session();
        $users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$data['session'] =$session;
		$posts = new BlogModel();
		$data['posts']=$posts->getAllPost();
		$events = new EventModel();
        $data['event_latest']=$events->getLatestEventByUser($session->get('idUserH'));
		 $data['event_comment']=$events->getEventComment();
		$rm = new RecommendationModel();
		$data['recats']=$rm->getAllReRequestsByUser();
		$news= new NewsModel();
		$data['newsall']=$news->getAllPostByUser();

		$users = new UserModel();
		$data['users']=$users->getSingleUser($session->get('idUserH'));
        $data['loginusers']=$users->getSingleUser($session->get('idUserH'));
		

		$receipe=new ReceipeModel();
		$data['blogRECIPES']=$receipe->getAllBlogReceipes_blog($session->get('idUserH'));
		$data['public_url']=base_url()."/public/frontend/";
		$data['baseurl']=base_url()."/";
		$data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
		$data['friendrequest']=$users->getFriendRequest($session->get('idUserH'));
		$data['birthday']=$users->getUserFriendBirthday($session->get('idUserH'));
		$events = new EventModel();
		$data['events']=$events->getTopFiveEventByUser($session->get('idUserH'));
        $data['event_latest']=$events->getLatestEventByUser($session->get('idUserH'));
        $data['event_comment']=$events->getEventComment();
		$blog= new BlogModel();
		$data['blogall']=$blog->getAllPostByUserLimit($session->get('idUserH'),$this->request->getPost('start'),$this->request->getPost('limit'));
		$data['latest_blog']=$blog->getLatestBlogByUser($session->get('idUserH'));
		$data['blog_category']=$blog->getAllPostCategoryByUser();
		$data['categories']=$blog->getAllPostCategory();
		return view('user/blog/blogUserLoadMore',$data);
	}
	public function blogByYear($month,$year){
        $session = session();
        $users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$data['session'] =$session;
		$events= new EventModel();
		$data['events']=$events->getTopFiveEventByUser($session->get('idUserH'));
		$data['event_latest']=$events->getLatestEventByUser($session->get('idUserH'));
		 $data['event_comment']=$events->getEventComment();
		$rm = new RecommendationModel();
		$data['recats']=$rm->getAllReRequestsByUser();
		$news= new NewsModel();
		$data['newsall']=$news->getAllPostByUser();

		$users = new UserModel();
		$data['users']=$users->getSingleUser($session->get('idUserH'));
        $data['loginusers']=$users->getSingleUser($session->get('idUserH'));
		$blog= new BlogModel();
		$data['blogall']=$blog->getAllPostYearByUser($session->get('idUserH'),$month,$year);
		$data['latest_blog']=$blog->getLatestBlogYearByUser($session->get('idUserH'),$month,$year);
		$data['blog_category']=$blog->getAllPostCategoryByUser();
		$receipe=new ReceipeModel();
		$data['blogRECIPES']=$receipe->getAllBlogReceipes_blog($session->get('idUserH'));
		$data['categories']=$blog->getAllPostCategory();
		$data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
		$data['friendrequest']=$users->getFriendRequest($session->get('idUserH'));
		$data['birthday']=$users->getUserFriendBirthday($session->get('idUserH'));
		$events = new EventModel();
        $data['event_latest']=$events->getLatestEventByUser($session->get('idUserH'));
        $data['event_comment']=$events->getEventComment();
		return view('user/blog/blogByyearUser',$data);
	}

	
	public function insertBlog(){
		
		$session = session();
		
		$post_image_db_data='';
		$post_image = $this->request->getFile('image');
		$post_image_name = $post_image->getName();
		if($post_image_name!=''){
			$post_image_name=time().$post_image_name;
			$post_image->move(ROOTPATH.'public/uploads/blog/post/',$post_image_name);
			$post_image_db_data='public/uploads/blog/post/'.$post_image_name;
		}

		$post_galleryimage_db_data='';
		
		if($this->request->getFileMultiple('galleryimage')){
			 foreach($this->request->getFileMultiple('galleryimage') as $file)
             { 
			 if($file->getClientName()!=''){
			 $post_galleryimage_name=$file->getClientName();
			 $post_galleryimage_name=time().$post_galleryimage_name;
			 $file->move(ROOTPATH.'public/uploads/blog/post/',$post_galleryimage_name);
			 
			 $post_galleryimage_db_data.='public/uploads/blog/post/'.$post_galleryimage_name.",";
			 }
			 }
		}
		$post_galleryimage_db_data=rtrim($post_galleryimage_db_data,",");
		$post_videofile_db_data='';
		$post_video = $this->request->getFile('videofile');
		$post_video_name = $post_video->getName();
		if($post_video_name!=''){
			$post_video_name=time().$post_video_name;
			$post_video->move(ROOTPATH.'public/uploads/blog/post/',$post_video_name);
			$post_videofile_db_data='public/uploads/blog/post/'.$post_video_name;
		}
		


		
		$post_video_db_data=$this->request->getPost('video');
		$data=[
		// 'post_category_id'=>date('m'),
	  'post_category_id'=>$this->request->getPost('post_category_id'),
		'title'=>$this->request->getPost('title'),
		// 'hastag'=>$this->request->getPost('hastag'),
		'tags'=>$this->request->getPost('tags'),
		'galleryimage'=>$post_galleryimage_db_data,
		'video'=>$post_videofile_db_data,
		'location'=>$this->request->getPost('location'),
		'content'=>$this->request->getPost('detail'),
		'posted_by'=>$session->get('idUserH'),
		'image'=>$post_image_db_data,
		// 'video'=>$post_video_db_data,
		'status'=>0,
	    
		]; 
		 $rm = new BlogModel();
		 $result=$rm->insertBlog($data);
		 $session->setFlashdata('msgblog', 'Blog Request Added Successfully');
		 $response='';
			if($result['status']==1){
			  $response = ['status' => 1 ,'msgblog' => '<span style="color:#090;">Blog Request Added Successfully</span>' ];
			}else{
			  $response = ['status' => 0 ,'msgblog' => '<span style="color:#900;">sorry we re having some technical problems. please try again !</span>' 						];
			}
		
			 echo json_encode($response);
		 /* if($result['status']==1){
		 return redirect()->to('user/event/add-event');
		 }else{
		  return redirect()->to('user/event/add-event');	 
		 } */
	}


	public function insertNews(){
		
		$session = session();
		
		$post_image_db_data='';
		$post_image = $this->request->getFile('image');
		$post_image_name = $post_image->getName();
		if($post_image_name!=''){
			$post_image_name=time().$post_image_name;
			$post_image->move(ROOTPATH.'public/uploads/news/post/',$post_image_name);
			$post_image_db_data='public/uploads/news/post/'.$post_image_name;
		} 
		
		$post_video_db_data=$this->request->getPost('video');
		$data=[
		'post_category_id'=>$this->request->getPost('post_category_id'),
		'title'=>$this->request->getPost('title'),
		'location'=>$this->request->getPost('location'),
		'posted_by'=>$session->get('idUserH'),
		'content'=>$this->request->getPost('details'),
		'image'=>$post_image_db_data,
		'video'=>$post_video_db_data,
		'status'=>1,
	    
		]; 
		 $rm = new NewsModel();
		 $result=$rm->insertNews($data);
		 $session->setFlashdata('msgnews', 'News Added Successfully');
		 $response='';
			if($result['status']==1){
			  $response = ['status' => 1 ,'msgnews' => '<span style="color:#090;">News Added Successfully</span>' ];
			}else{
			  $response = ['status' => 0 ,'msgnews' => '<span style="color:#900;">sorry we re having some technical problems. please try again !</span>' 						];
			}
		
			 echo json_encode($response);
		
	}
	public function blogDetailsUser($id){
		$session = session();
        $users = new UserChatModel();
		$data['chatusers'] =$users->getChatUsers();
		$data['chatgroups'] =$users->getChatGroups($session->get('idUserH'));
		$data['session'] =$session;
		$events= new EventModel();
		$data['event_details']=$events->getSingleEvent($id);
		$data['event_category']=$events->getAllEventCategories();
		$data['event_latest']=$events->getLatestEventByUser($session->get('idUserH'));
		 $data['event_comment']=$events->getEventComment();
		$rm = new RecommendationModel();
		$data['recats']=$rm->getAllReRequestsByUser();
		$news= new NewsModel();
		$data['newsall']=$news->getAllPostByUser();
		$blog= new BlogModel();
		$data['blogall']=$blog->getAllPostByUser($session->get('idUserH'));
		$data['blog_details']=$blog->getSingleblogs($id);
			$data['latest_blog']=$blog->getLatestBlogByUser($session->get('idUserH'));
		$data['blog_category']=$blog->getAllPostCategoryByUser();
		 $users = new UserModel();
		$data['userfriend']=$users->getSingleUserFriend($session->get('idUserH'));
		$data['friendrequest']=$users->getFriendRequest($session->get('idUserH'));
		$data['birthday']=$users->getUserFriendBirthday($session->get('idUserH'));
		$data['loginusers']=$users->getSingleUser($session->get('idUserH'));
		return view('user/blog/blogDetailsUser',$data);
	}
	public function loginUser(){
		return view('user/login/loginUser');
	}
	
	
	public function registerUser(){
		$users = new UserModel();
		$data['country'] =$users->getAllCountry();
		return view('user/register/registerUser',$data);
	}
	public function accountVerification(){
		$session = session();
		$users = new UserModel();
		$query=$users->where('verificationCode', $_GET['code'])->set('status', '1')->update();

		$session->setFlashdata('msg', 'Your verification process has been completed');
		return redirect()->to('user/login');
	}
	public function forgotPassword(){
		return view('user/register/forgotPasswordUser');
	}
	public function resendmail(){
		return view('user/register/resendmailUser');
	}
	public function resetPassword(){
		return view('user/register/resetPasswordUser');
	}
	public function resetForgotPassword(){
	  $session = session();
		$users = new UserModel();
	  $code=$this->request->getPost('code');
	  $query=$users->where('verificationCode',$code)->set('password',password_hash($this->request->getPost('password'), PASSWORD_BCRYPT))->update();
     $session->setFlashdata('msg', 'Password has been reset successfully.');
	 return redirect()->to('/user/login');	  
	}
	public function sendForgotPasswordLink(){
		//send email
        $session = session();
		$users = new UserModel();
		$emailId=$this->request->getPost('email');
		$data=$users->getSingleUserByEmail($emailId);
		$send=0;
		$vcode=0;
		if($data['vc']==0){
		$session->setFlashdata('msg', 'This Email id is Not exists Please try another email ');	
		}else{
			if($data['verificationCode']==''){
			  $data['verificationCode']=time().rand(10,100);
			  $query=$users->where('email',$emailId)->set('verificationCode',$data['verificationCode'])->update();	
			}
			$send=1;
			$vcode=$data['verificationCode'];
		}
		if($send==1){
		$email = \Config\Services::email();
        $to=$this->request->getPost('email');
		$link=base_url()."/user/reset-password?code=".$vcode;
        $email->setTo($to);
        $email->setFrom('info@projectstatus.co.in', 'Reset Password');
        $subject="Reset Password Link from hello vegans";
        $message='<table border="0" align="center" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;border:1px solid #FFA73B">
		          <tr>
				     <td bgcolor="#ffffff" align="center" valign="top" style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family:normal normal 600 40px/40px Open Sans; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;">
					    <h1 style="font-size: 48px; font-weight: 400; margin: 2;">Welcome!</h1> 
						<img src=" https://vegan.sidhauli.co.in/public/hello_vegans/commingsoon/images/logo.png" width="125" height="120" style="display: block; border: 0px;border: 0;height: auto;line-height: 100%;outline: none;text-decoration: none;" />
					</td>
				  </tr>
				  <tr>
				    <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 40px 30px; color: #666666; font-family: normal normal 600 40px/40px Open Sans; font-size: 18px; font-weight: 400; line-height: 25px;">
				    <p style="margin: 0;">To reset  your  Password. Just press the button below.</p>
				    </td>
				  </tr>
				  <tr>
				    <td bgcolor="#ffffff" align="left">
                     <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
						 <td bgcolor="#ffffff" align="center" style="padding: 20px 30px 60px 30px;">
						   <table border="0" cellspacing="0" cellpadding="0">
                              <tr>
							    <td align="center" style="border-radius: 3px;" bgcolor="#FFA73B"><a href="'.$link.'" target="_blank" style="font-size: 20px; font-family: normal normal 600 40px/40px Open Sans; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; padding: 15px 25px; border-radius: 2px; border: 1px solid #FFA73B; display: inline-block;">Reset Password</a>
								</td>   
							   </tr>
							</table>
						   </td>
						  </tr>
					   </table>
					</td>
				  </tr>
				  <tr>
					<td bgcolor="#ffffff" align="left" style="padding: 0px 30px 0px 30px; color: #666666; font-family:normal normal 600 40px/40px Open Sans; font-size: 18px; font-weight: 400; line-height: 25px;">
                      <p style="margin: 0;">If that does not work, copy and paste the following link in your browser:</p>
					</td>
				   </tr>
				  <tr>
				   <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 20px 30px; color: #666666; font-family:normal normal 600 40px/40px Open Sans, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
				    <p style="margin: 0;">
					 <a href="#" target="_blank" style="color: #FFA73B;">'.$link.'</a>
					</p>
				   </td>
				  </tr>
				</table>';
        $email->setSubject($subject);
        $email->setMessage($message);

        if ($email->send()) 
		{
            $session->setFlashdata('msg', 'A reset password link has been sent to your email account');
        } 
		else 
		{
           $session->setFlashdata('msg', 'A reset password link has been sent to your email account');
		   // $data = $email->printDebugger(['headers']);
           // print_r($data);
        }	
		}
		return redirect()->to('user/forgot-password');
	}
	public function resendVerification(){
		//send email
        $session = session();
		$users = new UserModel();
		$emailId=$this->request->getPost('email');
		$data=$users->getSingleUserByEmail($emailId);
		$send=0;
		$vcode=0;
		if($data['vc']==0){
		$session->setFlashdata('msg', 'This Email id is Not exists Please try another email ');	
		}else{
			if($data['verificationCode']==''){
			  $data['verificationCode']=time().rand(10,100);
			  $query=$users->where('email',$emailId)->set('verificationCode',$data['verificationCode'])->update();	
			}
			$send=1;
			$vcode=$data['verificationCode'];
		}
		if($send==1){
		$email = \Config\Services::email();
        $to=$this->request->getPost('email');
		$link="https://vegan.sidhauli.co.in/user/accountVerification?code=".$vcode;
        $email->setTo($to);
        $email->setFrom('info@projectstatus.co.in', 'Confirm Registration');
        $subject="Account Verification from hello vegans";
        $message='<table border="0" align="center" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;border:1px solid #FFA73B">
		          <tr>
				     <td bgcolor="#ffffff" align="center" valign="top" style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family:normal normal 600 40px/40px Open Sans; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;">
					    <h1 style="font-size: 48px; font-weight: 400; margin: 2;">Welcome!</h1> 
						<img src=" https://vegan.sidhauli.co.in/public/hello_vegans/commingsoon/images/logo.png" width="125" height="120" style="display: block; border: 0px;border: 0;height: auto;line-height: 100%;outline: none;text-decoration: none;" />
					</td>
				  </tr>
				  <tr>
				    <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 40px 30px; color: #666666; font-family: normal normal 600 40px/40px Open Sans; font-size: 18px; font-weight: 400; line-height: 25px;">
				    <p style="margin: 0;">We are excited to have you get started. First, you need to confirm your account. Just press the button below.</p>
				    </td>
				  </tr>
				  <tr>
				    <td bgcolor="#ffffff" align="left">
                     <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
						 <td bgcolor="#ffffff" align="center" style="padding: 20px 30px 60px 30px;">
						   <table border="0" cellspacing="0" cellpadding="0">
                              <tr>
							    <td align="center" style="border-radius: 3px;" bgcolor="#FFA73B"><a href="'.$link.'" target="_blank" style="font-size: 20px; font-family: normal normal 600 40px/40px Open Sans; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; padding: 15px 25px; border-radius: 2px; border: 1px solid #FFA73B; display: inline-block;">Confirm Account</a>
								</td>   
							   </tr>
							</table>
						   </td>
						  </tr>
					   </table>
					</td>
				  </tr>
				  <tr>
					<td bgcolor="#ffffff" align="left" style="padding: 0px 30px 0px 30px; color: #666666; font-family:normal normal 600 40px/40px Open Sans; font-size: 18px; font-weight: 400; line-height: 25px;">
                      <p style="margin: 0;">If that does not work, copy and paste the following link in your browser:</p>
					</td>
				   </tr>
				  <tr>
				   <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 20px 30px; color: #666666; font-family:normal normal 600 40px/40px Open Sans, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
				    <p style="margin: 0;">
					 <a href="#" target="_blank" style="color: #FFA73B;">'.$link.'</a>
					</p>
				   </td>
				  </tr>
				</table>';
        $email->setSubject($subject);
        $email->setMessage($message);
     
        if ($email->send()) 
		{
            $session->setFlashdata('msg', 'A verification link has been sent to your email account');
        } 
		else 
		{
           $session->setFlashdata('msg', 'A verification link has been sent to your email account');
		   // $data = $email->printDebugger(['headers']);
           // print_r($data);
        }	
		}
		
		return redirect()->to('user/resendmail');
	}
	public function insertUser(){
		$session = session();
		
		$users = new UserModel();
		$rand=time().rand(10,100);
		$data=[
		'name'=>$this->request->getPost('name'),
		'email'=>$this->request->getPost('email'),
		'mobile_no'=>$this->request->getPost('callingcode').'-'.$this->request->getPost('mobile_no'),
		'password'=>password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
		'status'=>0,
		'verificationCode'=>$rand,
		'created_at'=>date('Y-m-d H:i'),
		'updated_at'=>date('Y-m-d H:i')
		]; 
		/* echo "<pre>";
		print_r($data);
		die; */
		//google captcha code
		$recaptchaResponse = trim($this->request->getVar('g-recaptcha-response'));
       
        $secret=RECAPTCHA_SECRET_KEY;
        $credential = array(
            'secret' => $secret,
            'response' => $this->request->getVar('g-recaptcha-response')
        );
 
       $verify = curl_init();
       curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
       curl_setopt($verify, CURLOPT_POST, true);
       curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($credential));
       curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
       curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
       $response = curl_exec($verify);
       $status= json_decode($response, true);

	   if($status['success']){ 
		   $users->save($data);
		   
		   //send email
		   $email = \Config\Services::email();
        $to=$this->request->getPost('email');
		$link="https://vegan.sidhauli.co.in/user/accountVerification?code=".$rand;
        $email->setTo($to);
        $email->setFrom('info@projectstatus.co.in', 'Confirm Registration');
        $subject="Account Verification from hello vegans";
        $message='<table border="0" align="center" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;border:1px solid #FFA73B">
		          <tr>
				     <td bgcolor="#ffffff" align="center" valign="top" style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family:normal normal 600 40px/40px Open Sans; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;">
					    <h1 style="font-size: 48px; font-weight: 400; margin: 2;">Welcome!</h1> 
						<img src=" https://vegan.sidhauli.co.in/public/hello_vegans/commingsoon/images/logo.png" width="125" height="120" style="display: block; border: 0px;border: 0;height: auto;line-height: 100%;outline: none;text-decoration: none;" />
					</td>
				  </tr>
				  <tr>
				    <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 40px 30px; color: #666666; font-family: normal normal 600 40px/40px Open Sans; font-size: 18px; font-weight: 400; line-height: 25px;">
				    <p style="margin: 0;">We are excited to have you get started. First, you need to confirm your account. Just press the button below.</p>
				    </td>
				  </tr>
				  <tr>
				    <td bgcolor="#ffffff" align="left">
                     <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
						 <td bgcolor="#ffffff" align="center" style="padding: 20px 30px 60px 30px;">
						   <table border="0" cellspacing="0" cellpadding="0">
                              <tr>
							    <td align="center" style="border-radius: 3px;" bgcolor="#FFA73B"><a href="'.$link.'" target="_blank" style="font-size: 20px; font-family: normal normal 600 40px/40px Open Sans; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; padding: 15px 25px; border-radius: 2px; border: 1px solid #FFA73B; display: inline-block;">Confirm Account</a>
								</td>   
							   </tr>
							</table>
						   </td>
						  </tr>
					   </table>
					</td>
				  </tr>
				  <tr>
					<td bgcolor="#ffffff" align="left" style="padding: 0px 30px 0px 30px; color: #666666; font-family:normal normal 600 40px/40px Open Sans; font-size: 18px; font-weight: 400; line-height: 25px;">
                      <p style="margin: 0;">If that does not work, copy and paste the following link in your browser:</p>
					</td>
				   </tr>
				  <tr>
				   <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 20px 30px; color: #666666; font-family:normal normal 600 40px/40px Open Sans, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
				    <p style="margin: 0;">
					 <a href="#" target="_blank" style="color: #FFA73B;">'.$link.'</a>
					</p>
				   </td>
				  </tr>
				</table>';
        $email->setSubject($subject);
        $email->setMessage($message);

        if ($email->send()) 
		{
            $session->setFlashdata('msg', 'User has been registerd successfully<br> A verification link has been sent to your email account');
        } 
		else 
		{
           $session->setFlashdata('msg', 'User has been registerd successfully<br> A verification link has been sent to your email account.');
		    /* $data = $email->printDebugger(['headers']);
            print_r($data);
			die; */
        }
		   //send email
      }else{
			$session->setFlashdata('msg', 'Please Select Capthca');
      }	

		 return redirect()->to('user/register');
	}
    public function checkemailf(){
		$users = new UserModel();
		$email=$this->request->getPost('email');
		$data=$users->getUserCountByEmail($email);
		echo $data;
	}
	public function loginAuth()
    {
        
		$session = session();

        $users = new UserModel();

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        
        $data = $users->where('email', $email)->first();
        if($data){
		    $pass = $data['password'];
            $checkStatus = $users->where('email', $email)->where('status',1)->first();
			/* $q=$users->getLastQuery();
			echo "<pre>";
			print_r($q);
			die; */
			if($checkStatus){
				
			$authenticatePassword = password_verify($password, $pass);
				/* echo "<pre>";
				print_r($authenticatePassword);
				die; */
				if($authenticatePassword){
					$ses_data = [
						'idUserH' => $data['id'],
						'nameUserH' => $data['name'],
						'emailUserH' => $data['email'],
						'isLoggedInUserH' => TRUE
					];

					$session->set($ses_data);
					return redirect()->to('/user/dashboard');
				
				}else{
					$session->setFlashdata('msg', 'Password is incorrect.');
					return redirect()->to('/user/login');
				}	
			}else{
			   $session->setFlashdata('msg', 'Please Verify Your email address if you did not get e-mail please click here to resend mail <br><a href="https://vegan.sidhauli.co.in/user/resendmail">click here</a>');
			   /* $session->setFlashdata('msg', 'Please Verify Your email address'); */
               return redirect()->to('/user/login');			   
			}
			

        }else{
            $session->setFlashdata('msg', 'Email does not exist.');
            return redirect()->to('/user/login');
        }
    }
	 public function logout()
    {
        $session = session();
		$array_items = ['idUserH', 'nameUserH','emailUserH','isLoggedInUserH'];
		$session->remove($array_items);
		//$session->destroy();
        
        return redirect()->to('/user/login');
    }
	public function logoutUser()
    {
        $session = session();
		$array_items = ['idUserH', 'nameUserH','emailUserH','isLoggedInUserH'];
		$session->remove($array_items);
		//$session->destroy();
        
        return redirect()->to('/user/login');
    }
	public function insertProfilePost(){
		
		$session = session();
		$post_image_db_data='';
		$post_image = $this->request->getFile('create_post_image');
		
		$post_image_name = $post_image->getName();
		if($post_image_name!=''){
			$post_image_name=time().$post_image_name;
			$post_image->move(ROOTPATH.'public/uploads/user/veganpost/',$post_image_name);
			$post_image_db_data='public/uploads/user/veganpost/'.$post_image_name;
		}
		$data=[
		'content'=>$this->request->getPost('create_post_content'),
		'image'=>$post_image_db_data,
		'created_at'=>date('Y-m-d H:i'),
		'updated_at'=>date('Y-m-d H:i'),
		'status'=>1,
		'posted_by'=>$session->get('idUserH')
		]; 
		 
		 $posts = new PostModel();
		 $id=$posts->insertPost($data);
		 $vegan= new PostModel();
	   	 $result=$vegan->getVeganPostUser($id);
		$val=$result[0];
		$public_url=base_url()."/public/frontend/";
        $baseurl=base_url()."/";
		/*  print_r($categories->getLastQuery());
		 die; */
		 $curr_time =$val['post_created_at'];
         $time_ago = strtotime($curr_time);
		 $usersdata = new UserModel();
		$users=$usersdata->getSingleUser($session->get('idUserH'));
		$data['loginusers']=$usersdata->getSingleUser($session->get('idUserH'));
		$html='<div class="one_bx ">
                <div class="topbar_post ">
                  <div class="topbar_icon"><img src="'.$baseurl.$users['profile_image'].'"></div>
                  <h2>'.$_SESSION['nameUserH'].'</h2>
                  <p>'.date('d M Y',strtotime($val['created_at'])).'</p>
                </div>
                <p class="post_one_pdding">'.$val['content'].'</p>';
			if(file_exists($val['image'])){ 
			$mime = mime_content_type($val['image']);
				if(strstr($mime, "video/")){
					$html.='<video  height="400" controls> 
					  <source src="'.$baseurl.$val['image'].'" type="video/webm"> 
					  <source src="'.$baseurl.$val['image'].'" type="video/ogg"> 
					  <source src="'.$baseurl.$val['image'].'" type="video/mp4">
					  <source src="'.$baseurl.$val['image'].'" type="video/3gp">
					</video>';
				}else{
					$html.='<div class="post_images "> 
					<img src="'.$baseurl.$val['image'].'"> 
					</div>';
				}
			}else{
					$html.='<div class="post_images "> 
				<img src="'.$public_url.'images/no_img.jpg'.'"> 
				</div>';
				  	
				}
	        $html.='       
                <div class="like_comments post_one_pdding">
                  <p class="like_comments_f">
				  <a>
				  <span id="like_cnt_'.$val['id'].'">0</span>
				  <i class="fa fa-thumbs-o-up" aria-hidden="true" id="like_'.$val['id'].'" style="color:#0080ff"  onclick="addpostlike('.$val['id'].',1)"></i> 
				 <i class="fa fa-thumbs-o-up"  aria-hidden="true" id="unlike_'.$val['id'].'" style="display:none;color:#ff0000"  onclick="addpostlike('.$val['id'].',0))"></i> 
				</a>
				  </p>
                  <p class="like_comments_se"><a href="#"><span id="cnt_'.$val['id'].'">0</span><i class="fa fa-comment-o" aria-hidden="true"></i> </a></p>
                </div>
                <!-- form here comment section -->
				
                <div class="blog_comment" style="<?php echo $commentcss;?>">
                  <div class="detailBox">
				  <div class="titleBox">
				  <label>Comments </label>
				</div>
				 <div class="actionBox">
				<ul class="commentList commentList_'.$val['id'].'">
                
				 </ul>
                <form class="form-inline" role="form" method="post" id="postcommentform_'.$val['id'].'" name="postcommentform" onsubmit="return submitpostcomments('.$val['id'].')">
				<div class="comments_form post_one_pdding">
				<input type="hidden" class="" id="commented_by" name="commented_by"  value="'.$_SESSION['idUserH'].'" size="30" aria-required="true">
                  <input type="hidden" class="" id="post_id" name="post_id"  value="'.$val['id'].'" size="30" aria-required="true">
				  <input class="effect-1" id="messagecomments_'.$val['id'].'" name="message" type="text" placeholder="Write here. . . . . .">
                  <span class="focus-border" onclick="submitpostcomments('.$val['id'].')"><i class="fa fa-send-o" aria-hidden="true"></i> </span>
				</div>
                 </form>				

				</div>
				  </div>
              </div>
			  </div>';
			  echo $html;
		 //echo "success";
		die;
		}
	public function insertVeganPost(){
		
		$session = session();
		$post_image_db_data='';
		$post_image = $this->request->getFile('create_post_image');
		
		$post_image_name = $post_image->getName();
		if($post_image_name!=''){
			$post_image_name=time().$post_image_name;
			$post_image->move(ROOTPATH.'public/uploads/user/veganpost/',$post_image_name);
			$post_image_db_data='public/uploads/user/veganpost/'.$post_image_name;
		}
		$data=[
		'content'=>$this->request->getPost('create_post_content'),
		'image'=>$post_image_db_data,
		'created_at'=>date('Y-m-d H:i'),
		'updated_at'=>date('Y-m-d H:i'),
		'status'=>1,
		'posted_by'=>$session->get('idUserH')
		]; 
		 
		 $posts = new PostModel();
		$id=$posts->insertPost($data);
		 $vegan= new PostModel();
	   	 $result=$vegan->getVeganPostUser($id);
		
		$val=$result[0];
		$public_url=base_url()."/public/frontend/";
        $baseurl=base_url()."/";
		/*  print_r($categories->getLastQuery());
		 die; */
		 $curr_time =$val['post_created_at'];
         $time_ago = strtotime($curr_time);
		 $t=$this->time_Agos($time_ago);
		 $html= '<li class="main-feed-item">
          <article class="common-post">
            <div class="">
              <div class="col-sm-12 col-md-12 padding_left_home">
              <header class="common-post-header u-flex">';
				if(file_exists($val['user_image'])){
					$html.='<img src="'.base_url().'/'.$val['user_image'].'" class="user-image" width="40" height="40" alt="">';
				}else{
					$html.='<img src="'.$public_url.'/images/user-icon.png'.'" class="user-image" width="40" height="40" alt="">';
				}
				$html.=' <div class="common-post-info">
                    <div class="user-and-group u-flex "> <a href="'.base_url().'/user/public_profile/'.$val['user_id'].'">'.$val['user_name'].' </a> </div>
                     <div class="username_time"> <a href="#">'.$t.'</a> </div></div></header>';
				
				
				 $html.='<div class="embed-content-text">
                  <p onclick="showcommentmodal('.$val['id'].')" class="embed-content-paragraph">'.$val['post_content'].'</p>
                </div></div>';
				$html.='<div class="col-sm-12 col-md-12 padding-right">
                <div class="common-post-content common-content">';
				if(file_exists($val['post_image'])){ 
			$mime = mime_content_type($val['post_image']);
				if(strstr($mime, "video/")){
					$html.='<video width="320" height="240" controls> 
					  <source src="'.$baseurl.$val['post_image'].'" type="video/webm"> 
					  <source src="'.$baseurl.$val['post_image'].'" type="video/ogg"> 
					  <source src="'.$baseurl.$val['post_image'].'" type="video/mp4">
					  <source src="'.$baseurl.$val['post_image'].'" type="video/3gp">
					</video>';
				}else{
					$html.='<a class="embed-content" href="#" target="_blank"> <img class="embed-content-image" onclick="showcommentmodal('.$val['id'].')" src="'.$baseurl.$val['post_image'].'" alt=""> </a>';
				}
			}
		
        $html.='
		</div>
              <div class="btm_common_allblog">
                <div class="summary u-flex "> 
				<div class="vegan-post-like-share">
				
                 
                  <a>
                   
                   <span id="like_cnt_'.$val['id'].'">0</span>
				  <div class="reactions like_icon" id="like_'.$val['id'].'"  onclick="addpostlike('.$val['id'].',1)"><span><i class="fa fa-heart" aria-hidden="true"></i> Like</span></div>
				  <div class="reactions" style="display:none" id="unlike_'.$val['id'].'"   onclick="addpostlike('.$val['id'].',0)"><span><i class="fa fa-heart" aria-hidden="true"></i></span><span> UnLike </span></div>
                  </a>
				  <a class="comment_right_home_page" onclick="showcommentmodal('.$val['id'].')" > <span id="comment_'.$val['id'].'">0</span><span class="icon"><i class="fa fa-comment-o" aria-hidden="true" ></i></span><span>Comments </span></a> 
				  <a href="#"> <span class="icon" style="display:none"><i class="fa fa-share-alt" style="display:none" aria-hidden="true"></i><span>Share</span> </span>
				  </a> 
				  </div>
				  </div>
                
                
                </div>
                       </div>

               
				 
              
            </div>
          </article>
        </li>';
		 //echo "success";
		echo $html;
		die;
		}
		
		public function getCountryList(){
		$session = session();
		$db = db_connect();
		$term = $this->request->getPost('search');
		
		if($term==""){
		$sql=$db->query("SELECT * FROM countries");
		$data=$sql->getResult();	
		$resultArr = array();
        
		foreach($data as $result) {
               $resultArr[] = array('id'=>$result->id,'label' =>$result->name , 'value' => $result->name );
        }	
		}else{
		$sql=$db->query("SELECT * FROM countries where name like '".$term."%'");
		$data=$sql->getResult();
        $resultArr = array();
        foreach($data as $result) {
                $resultArr[] = array('id'=>$result->id,'label' =>$result->name , 'value' => $result->name );
        }	
		}
        
            echo json_encode($resultArr); 
		
	}
	public function notificationShow(){
		
		$session = session();
		
		$user_details=[];
		$db = db_connect();
		//get details of notifications
		
		$notification_sql=$db->query("select us.name,us.profile_image,un.created_at,un.type,un.type_name,un.sender_id from user_notifications un 
		left join users us on un.sender_id=us.id 
		where un.read_status=0 and un.receiver_id='".$session->get('idUserH')."' order by un.id desc limit 0,3");
		$notification_array=$notification_sql->getResult();
		$i=0;
		if(isset($notification_array[0])){
			foreach($notification_array as $n_val){
				$name=$n_val->name;
				
			    $image=$n_val->profile_image;
			    $time=$n_val->created_at;
			    $type=$n_val->type;
			    $type_name=$n_val->type_name;
			      if($name==''){
				   $name='Admin';
				   $image='public/frontend/images/logo.png';
				 }
				 $id=$n_val->sender_id;
				 $user_details[$i]['id']=$id;
				 $user_details[$i]['name']=$name;
				 $user_details[$i]['profile_image']=base_url()."/".$image;
				 $user_details[$i]['notification_pageicon']=base_url()."/".'public/frontend/images/notification_pageicon.png';
				 if($type=='Request_Send'){
				   $user_details[$i]['message']="send you friend request";	 
				 }else if($type=='Request_Confirm'){
				  $user_details[$i]['message']="confirm your friend request";	 
				 }else{
				 $user_details[$i]['message']=$type.' on your '.$type_name;	 
				 }
				 	
				 $user_details[$i]['timeview']=$this->time_Agos(strtotime($time));	
				 $i++;
			}
		}
		$db->query("update user_notifications set read_status=1 where receiver_id='".$session->get('idUserH')."'");
		echo json_encode($user_details);
		die;
	}
	
	 public function notificationCount(){
		
		$session = session();
		$db = db_connect();
		$tot=0;
		
		$notification_sql=$db->query("select count(un.id) as cnt from user_notifications un where un.read_status=0 and un.receiver_id='".$session->get('idUserH')."'");
		$notification_array=$notification_sql->getResult();
		if(isset($notification_array[0])){
		 $tot=$notification_array[0]->cnt;	
		}
		
		$array=array('totalcount'=>$tot);
		echo json_encode($array);
		die;
		
	}
	public function getStateList(){
		$session = session();
		$db = db_connect();
		$term = $this->request->getPost('search');
		$countryId = $this->request->getPost('countryId');
		
		if($term==""){
		$sql=$db->query("SELECT * FROM states where country_id='".$countryId."'");
		$data=$sql->getResult();	
		$resultArr = array();
        
		foreach($data as $result) {
               $resultArr[] = array('id'=>$result->id,'label' =>$result->name , 'value' => $result->name );
        }	
		}else{
		$sql=$db->query("SELECT * FROM states where country_id='".$countryId."' and name like '".$term."%'");
		$data=$sql->getResult();
        $resultArr = array();
        foreach($data as $result) {
                $resultArr[] = array('id'=>$result->id,'label' =>$result->name , 'value' => $result->name );
        }	
		}
        
            echo json_encode($resultArr); 
		
	}	
		public function time_Ago($time) {
  
    // Calculate difference between current
    // time and given timestamp in seconds
    $diff     = time() - $time;
      
    // Time difference in seconds
    $sec     = $diff;
      
    // Convert time difference in minutes
    $min     = round($diff / 60 );
      
    // Convert time difference in hours
    $hrs     = round($diff / 3600);
      
    // Convert time difference in days
    $days     = round($diff / 86400 );
      
    // Convert time difference in weeks
    $weeks     = round($diff / 604800);
      
    // Convert time difference in months
    $mnths     = round($diff / 2600640 );
      
    // Convert time difference in years
    $yrs     = round($diff / 31207680 );
      
    // Check for seconds
    if($sec <= 60) {
        echo "$sec seconds ago";
    }
      
    // Check for minutes
    else if($min <= 60) {
        if($min==1) {
            echo "one minute ago";
        }
        else {
            echo "$min minutes ago";
        }
    }
      
    // Check for hours
    else if($hrs <= 24) {
        if($hrs == 1) { 
            echo "an hour ago";
        }
        else {
            echo "$hrs hours ago";
        }
    }
      
    // Check for days
    else if($days <= 7) {
        if($days == 1) {
            echo "Yesterday";
        }
        else {
            echo "$days days ago";
        }
    }
      
    // Check for weeks
    else if($weeks <= 4.3) {
        if($weeks == 1) {
            echo "a week ago";
        }
        else {
            echo "$weeks weeks ago";
        }
    }
      
    // Check for months
    else if($mnths <= 12) {
        if($mnths == 1) {
            echo "a month ago";
        }
        else {
            echo "$mnths months ago";
        }
    }
      
    // Check for years
    else {
        if($yrs == 1) {
            echo "one year ago";
        }
        else {
            echo "$yrs years ago";
        }
    }
}
public function time_Agos($time) {
  $msg='';
    // Calculate difference between current
    // time and given timestamp in seconds
    $diff     = time() - $time;
      
    // Time difference in seconds
    $sec     = $diff;
      
    // Convert time difference in minutes
    $min     = round($diff / 60 );
      
    // Convert time difference in hours
    $hrs     = round($diff / 3600);
      
    // Convert time difference in days
    $days     = round($diff / 86400 );
      
    // Convert time difference in weeks
    $weeks     = round($diff / 604800);
      
    // Convert time difference in months
    $mnths     = round($diff / 2600640 );
      
    // Convert time difference in years
    $yrs     = round($diff / 31207680 );
      
    // Check for seconds
    if($sec <= 60) {
        $msg= "$sec seconds ago";
    }
      
    // Check for minutes
    else if($min <= 60) {
        if($min==1) {
            $msg= "one minute ago";
        }
        else {
            $msg= "$min minutes ago";
        }
    }
      
    // Check for hours
    else if($hrs <= 24) {
        if($hrs == 1) { 
            $msg= "an hour ago";
        }
        else {
            $msg= "$hrs hours ago";
        }
    }
      
    // Check for days
    else if($days <= 7) {
        if($days == 1) {
            $msg= "Yesterday";
        }
        else {
            $msg= "$days days ago";
        }
    }
      
    // Check for weeks
    else if($weeks <= 4.3) {
        if($weeks == 1) {
            $msg= "a week ago";
        }
        else {
            $msg= "$weeks weeks ago";
        }
    }
      
    // Check for months
    else if($mnths <= 12) {
        if($mnths == 1) {
            $msg= "a month ago";
        }
        else {
            $msg= "$mnths months ago";
        }
    }
      
    // Check for years
    else {
        if($yrs == 1) {
            $msg= "one year ago";
        }
        else {
            $msg= "$yrs years ago";
        }
    }
	return $msg;
}
public function unfriend(){
		
		$session = session();
		$db = db_connect();
		$id=$this->request->getPost('id');
		$created_at=date('Y-m-d H:i:s');
		$request=$db->query("delete from users_friend where (sender_id='".$session->get('idUserH')."' and receiver_id='".$id."')");
		$request=$db->query("delete from users_friend where (receiver_id='".$session->get('idUserH')."' and sender_id='".$id."')");
		
		$sql="insert into user_notifications set sender_id='".$session->get('idUserH')."',receiver_id='".$id."',table_name='friend_request',table_id='".$id."',type='Unfriend',type_name='Account',created_at='".$created_at."'";
		$db->query($sql);
		die;
		
	}
public function friendRequestSend(){
		
		$session = session();
		$db = db_connect();
		$id=$this->request->getPost('id');
		$created_at=date('Y-m-d H:i:s');
		$request=$db->query("insert into friend_request set sender_id='".$session->get('idUserH')."',receiver_id='".$id."',created_at='".$created_at."' ");
		$lastid=$db->mysqli->insert_id;
		$sql="insert into user_notifications set sender_id='".$session->get('idUserH')."',receiver_id='".$id."',table_name='friend_request',table_id='".$lastid."',type='Request_Send',type_name='Friend Request',created_at='".$created_at."'";
		$db->query($sql);
		die;
		
	}
	public function cancelRequest(){
		
		$session = session();
		$db = db_connect();
		$id=$this->request->getPost('id');
		$created_at=date('Y-m-d H:i:s');
		$request=$db->query("delete from friend_request where sender_id='".$session->get('idUserH')."' and receiver_id='".$id."'");
		
		die;
		
	}
	public function friendRequestConfirm(){
		
		$session = session();
		$db = db_connect();
		$id=$this->request->getPost('id');
		$created_at=date('Y-m-d H:i:s');
		$request=$db->query("delete from friend_request where  receiver_id='".$session->get('idUserH')."' and sender_id='".$id."'");
		$request=$db->query("insert into  users_friend  set receiver_id='".$session->get('idUserH')."',sender_id='".$id."'");
		$lastid=$db->mysqli->insert_id;
		$sql="insert into user_notifications set sender_id='".$session->get('idUserH')."',receiver_id='".$id."',table_name='users_friend',table_id='".$lastid."',type='Request_Confirm',type_name='Friend',created_at='".$created_at."'";
		$db->query($sql);
		die;
		
	}
	public function friendRequestDelete(){
		
		$session = session();
		$db = db_connect();
		$id=$this->request->getPost('id');
		$created_at=date('Y-m-d H:i:s');
		$request=$db->query("delete from friend_request where  receiver_id='".$session->get('idUserH')."' and sender_id='".$id."'");
		
		$lastid=$db->mysqli->insert_id;
		$sql="insert into user_notifications set sender_id='".$session->get('idUserH')."',receiver_id='".$id."',table_name='friend_request',table_id='".$lastid."',type='RequestsDelete',type_name='Profile',created_at='".$created_at."'";
		$db->query($sql);
		die;
		
	}
	public function removedPeopleYouMayKnow(){
		$session = session();
		$db = db_connect();
		$id=$this->request->getPost('id');
		$request=$db->query("insert into  users_remove  set removed_by_user_id='".$session->get('idUserH')."',removed_user_id='".$id."'");
		die;
	}
}
