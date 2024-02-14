<?php
namespace Config;
// Create a new instance of our RouteCollection class.
$routes = Services::routes();
// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}
/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
//$routes->setAutoRoute(true);
$routes->set404Override(function(){
    return view('404.html');
});
$routes->get('/lang/{locale}', 'LanguageController::index');
//admin routes
//login
$routes->get('/admin/login', 'AdminLoginController::login');
$routes->get('admin/logout', 'AdminLoginController::logout');
//chat
$routes->get('/admin/chat', 'ChatController::ChatPage');
$routes->get('/admin/chat/view-all-chat/(:any)', 'ChatController::viewAllChat');
$routes->get('/admin/chat/view-group-chat/(:any)', 'ChatController::viewGroupChat');
$routes->get('/admin/chatuserslist', 'ChatController::listChatUser');
$routes->get('/admin/chat/chat-page/', 'ChatController::chatPage',['filter' => 'authGuard']);

//dashboard
$routes->get('/admin/dashboard', 'AdminController::dashboard');
//users
$routes->get('/admin/users', 'AdminController::listUser',['filter' => 'authGuard']);
$routes->get('/admin/add-user', 'AdminController::addUser',['filter' => 'authGuard']);
$routes->get('/admin/edit-user/(:any)', 'AdminController::editUser/$1',['filter' => 'authGuard']);
$routes->get('/admin/view-user/(:any)', 'AdminController::viewUser/$1',['filter' => 'authGuard']);
$routes->post('/admin/insert-user', 'AdminController::insertUser',['filter' => 'authGuard']);
$routes->post('/admin/update-user', 'AdminController::updateUser',['filter' => 'authGuard']);
$routes->post('/admin/change-user-status', 'AdminController::changeUserStatus',['filter' => 'authGuard']);

$routes->post('/admin/check-user-email', 'AdminController::checkemailf',['filter' => 'authGuard']);
$routes->post('/admin/check-user-email_edit', 'AdminController::checkemailf_edit',['filter' => 'authGuard']);
$routes->get('/admin/delete-user/(:any)', 'AdminController::deleteUser/$1',['filter' => 'authGuard']);
$routes->get('/admin/view-user-deleted/(:any)', 'AdminController::viewUserDeleted/$1',['filter' => 'authGuard']);
$routes->get('/admin/users-deleted', 'AdminController::listDeletedUser');
$routes->get('/admin/user-friends/(:any)', 'AdminController::listFriend/$1');
$routes->get('/admin/user-friend-posts/(:any)', 'AdminController::frontUserFriendPosts/$1');
//news
$routes->get('/admin/news/post/categories', 'NewsController::listPostCategory');
$routes->get('/admin/news/post/add-category', 'NewsController::addPostCategory',['filter' => 'authGuard']);
$routes->get('/admin/news/post/edit-category/(:any)', 'NewsController::editPostCategory/$1',['filter' => 'authGuard']);
$routes->get('/admin/news/post/delete-category/(:any)', 'NewsController::deletePostCategory/$1',['filter' => 'authGuard']);
$routes->post('/admin/news/post/insert-category', 'NewsController::insertPostCategory',['filter' => 'authGuard']);
$routes->post('/admin/news/post/update-category', 'NewsController::updatePostCategory',['filter' => 'authGuard']);
$routes->get('/admin/news/posts', 'NewsController::listPosts');
$routes->get('/admin/news/add-post', 'NewsController::addPost',['filter' => 'authGuard']);
$routes->get('/admin/news/edit-post/(:any)', 'NewsController::editPost/$1',['filter' => 'authGuard']);
$routes->get('/admin/news/delete-post/(:any)', 'NewsController::deletePost/$1',['filter' => 'authGuard']);
$routes->post('/admin/news/insert-post', 'NewsController::insertPost',['filter' => 'authGuard']);
$routes->post('/admin/news/update-post', 'NewsController::updatePost',['filter' => 'authGuard']);
$routes->get('/admin/news/view-post/(:any)', 'NewsController::viewPost/$1',['filter' => 'authGuard']);
$routes->get('/admin/news/post/manage-comments/(:any)', 'NewsController::managePostComment/$1',['filter' => 'authGuard']);
$routes->post('/admin/news/post/insert-comment', 'NewsController::insertPostComment',['filter' => 'authGuard']);

//blogs
$routes->get('/admin/blog/post/categories', 'BlogController::listPostCategory');
$routes->get('/admin/blog/post/add-category', 'BlogController::addPostCategory',['filter' => 'authGuard']);
$routes->get('/admin/blog/post/edit-category/(:any)', 'BlogController::editPostCategory/$1',['filter' => 'authGuard']);
$routes->get('/admin/blog/post/delete-category/(:any)', 'BlogController::deletePostCategory/$1',['filter' => 'authGuard']);
$routes->post('/admin/blog/post/insert-category', 'BlogController::insertPostCategory',['filter' => 'authGuard']);
$routes->post('/admin/blog/post/update-category', 'BlogController::updatePostCategory',['filter' => 'authGuard']);

$routes->get('/admin/blog/posts', 'BlogController::listPosts');
$routes->get('/admin/blog/posts-request', 'BlogController::blogPostRequest');
$routes->get('/admin/blog/approve-request/(:any)', 'BlogController::approveBlogRequest/$1',['filter' => 'authGuard']);
$routes->get('/admin/blog/decline-request/(:any)', 'BlogController::declineBlogRequest/$1',['filter' => 'authGuard']);
$routes->get('/admin/recipe/approve/(:any)', 'ReceipeController::approveRecipe/$1',['filter' => 'authGuard']);

$routes->get('/admin/blog/add-post', 'BlogController::addPost',['filter' => 'authGuard']);
$routes->get('/admin/blog/edit-post/(:any)', 'BlogController::editPost/$1',['filter' => 'authGuard']);
$routes->get('/admin/blog/delete-post/(:any)', 'BlogController::deletePost/$1',['filter' => 'authGuard']);
$routes->post('/admin/blog/insert-post', 'BlogController::insertPost',['filter' => 'authGuard']);
$routes->post('/admin/blog/update-post', 'BlogController::updatePost',['filter' => 'authGuard']);
$routes->get('/admin/blog/view-post/(:any)', 'BlogController::viewPost/$1',['filter' => 'authGuard']);
$routes->get('/admin/blog/post/manage-comments/(:any)', 'BlogController::managePostComment/$1',['filter' => 'authGuard']);
$routes->post('/admin/blog/post/insert-comment', 'BlogController::insertPostComment',['filter' => 'authGuard']);
$routes->post('/user/blog/post/insert-comment', 'BlogController::insertPostCommentUser',['filter' => 'authGuardUser']);
$routes->post('/user/blog/insert-blog-comment', 'User1Controller::insertPostCommentUser',['filter' => 'authGuardUser']);
//forum
$routes->get('/admin/forum/post/tags', 'ForumController::listPostTag');
$routes->get('/admin/forum/post/add-tag', 'ForumController::addPostTag',['filter' => 'authGuard']);
$routes->get('/admin/forum/post/edit-tag/(:any)', 'ForumController::editPostTag/$1',['filter' => 'authGuard']);
$routes->get('/admin/forum/post/delete-tag/(:any)', 'ForumController::deletePostTag/$1',['filter' => 'authGuard']);
$routes->post('/admin/forum/post/insert-tag', 'ForumController::insertPostTag',['filter' => 'authGuard']);
$routes->post('/admin/forum/post/update-tag', 'ForumController::updatePostTag',['filter' => 'authGuard']);
$routes->get('/admin/forum/posts', 'ForumController::listPosts');
$routes->get('/admin/forum/add-post', 'ForumController::addPost',['filter' => 'authGuard']);
$routes->get('/admin/forum/edit-post/(:any)', 'ForumController::editPost/$1',['filter' => 'authGuard']);
$routes->get('/admin/forum/delete-post/(:any)', 'ForumController::deletePost/$1',['filter' => 'authGuard']);
$routes->post('/admin/forum/insert-post', 'ForumController::insertPost',['filter' => 'authGuard']);
$routes->post('/admin/forum/update-post', 'ForumController::updatePost',['filter' => 'authGuard']);
$routes->get('/admin/forum/view-post/(:any)', 'ForumController::viewPost/$1',['filter' => 'authGuard']);
$routes->get('/admin/forum/post/manage-comments/(:any)', 'ForumController::managePostComment/$1',['filter' => 'authGuard']);
$routes->post('/admin/forum/post/insert-comment', 'ForumController::insertPostComment',['filter' => 'authGuard']);
$routes->get('/admin/forum/question/tags', 'ForumController::listQuestionTag');
$routes->get('/admin/forum/question/add-tag', 'ForumController::addQuestionTag',['filter' => 'authGuard']);
$routes->get('/admin/forum/question/edit-tag/(:any)', 'ForumController::editQuestionTag/$1',['filter' => 'authGuard']);
$routes->get('/admin/forum/question/delete-tag/(:any)', 'ForumController::deleteQuestionTag/$1',['filter' => 'authGuard']);
$routes->post('/admin/forum/question/insert-tag', 'ForumController::insertQuestionTag',['filter' => 'authGuard']);
$routes->post('/admin/forum/question/update-tag', 'ForumController::updateQuestionTag',['filter' => 'authGuard']);
$routes->get('/admin/forum/questions', 'ForumController::listQuestions');
$routes->get('/admin/forum/add-question', 'ForumController::addQuestion',['filter' => 'authGuard']);
$routes->get('/admin/forum/edit-question/(:any)', 'ForumController::editQuestion/$1',['filter' => 'authGuard']);
$routes->get('/admin/forum/delete-question/(:any)', 'ForumController::deleteQuestion/$1',['filter' => 'authGuard']);
$routes->post('/admin/forum/insert-question', 'ForumController::insertQuestion',['filter' => 'authGuard']);
$routes->post('/admin/forum/update-question', 'ForumController::updateQuestion',['filter' => 'authGuard']);
$routes->get('/admin/forum/view-question/(:any)', 'ForumController::viewQuestion/$1',['filter' => 'authGuard']);
$routes->get('/admin/forum/question/manage-comments/(:any)', 'ForumController::manageQuestionComment/$1',['filter' => 'authGuard']);
$routes->post('/admin/forum/question/insert-comment', 'ForumController::insertQuestionComment',['filter' => 'authGuard']);




//Tutorial
$routes->get('/admin/tutorials/posts', 'TutorialController::listPosts');
$routes->get('/admin/tutorials/add-post', 'TutorialController::addPost',['filter' => 'authGuard']);
$routes->get('/admin/tutorials/edit-post/(:any)', 'TutorialController::editPost/$1',['filter' => 'authGuard']);
$routes->get('/admin/tutorials/delete-post/(:any)', 'TutorialController::deletePost/$1',['filter' => 'authGuard']);
$routes->post('/admin/tutorials/insert-post', 'TutorialController::insertPost',['filter' => 'authGuard']);
$routes->post('/admin/tutorials/update-post', 'TutorialController::updatePost',['filter' => 'authGuard']);
$routes->get('/admin/tutorials/view-post/(:any)', 'TutorialController::viewPost/$1',['filter' => 'authGuard']);

//vegan post
$routes->get('/admin/post/categories', 'PostController::listPostCategory');
$routes->get('/admin/post/add-category', 'PostController::addPostCategory',['filter' => 'authGuard']);
$routes->get('/admin/post/edit-category/(:any)', 'PostController::editPostCategory/$1',['filter' => 'authGuard']);
$routes->get('/admin/post/delete-category/(:any)', 'PostController::deletePostCategory/$1',['filter' => 'authGuard']);
$routes->post('/admin/post/insert-category', 'PostController::insertPostCategory',['filter' => 'authGuard']);
$routes->post('/admin/post/update-category', 'PostController::updatePostCategory',['filter' => 'authGuard']);
$routes->get('/admin/post/list', 'PostController::listPosts');
$routes->get('/admin/post/add', 'PostController::addPost',['filter' => 'authGuard']);
$routes->get('/admin/post/edit/(:any)', 'PostController::editPost/$1',['filter' => 'authGuard']);
$routes->get('/admin/post/delete/(:any)', 'PostController::deletePost/$1',['filter' => 'authGuard']);
$routes->post('/admin/post/insert', 'PostController::insertPost',['filter' => 'authGuard']);
$routes->post('/admin/post/update', 'PostController::updatePost',['filter' => 'authGuard']);
$routes->get('/admin/post/view/(:any)', 'PostController::viewPost/$1',['filter' => 'authGuard']);
$routes->get('/admin/post/manage-comments/(:any)', 'PostController::managePostComment/$1',['filter' => 'authGuard']);
$routes->post('/admin/post/insert-comment', 'PostController::insertPostComment',['filter' => 'authGuard']);
//Masters
$routes->get('/admin/masters/tutorials/location-list', 'MasterController::tutorial');
$routes->get('/admin/masters/tutorials/add-location', 'MasterController::addPost',['filter' => 'authGuard']);
$routes->get('/admin/masters/tutorials/edit-location/(:any)', 'MasterController::editPostTag/$1',['filter' => 'authGuard']);
$routes->get('/admin/masters/tutorials/delete-location/(:any)', 'MasterController::deletePost/$1',['filter' => 'authGuard']);
$routes->post('/admin/masters/tutorials/insert-location', 'MasterController::insertPost',['filter' => 'authGuard']);
$routes->post('/admin/masters/tutorials/update-location', 'MasterController::updatePostTag',['filter' => 'authGuard']);
$routes->get('/admin/masters/tutorials/view-location/(:any)', 'MasterController::viewPost/$1',['filter' => 'authGuard']);
//Recommendation
$routes->get('/admin/recommendation/category', 'RecommendationController::listReCategory',['filter' => 'authGuard']);
$routes->get('/admin/recommendation/add-category', 'RecommendationController::addReCategory',['filter' => 'authGuard']);
$routes->get('/admin/recommendation/edit-category/(:any)', 'RecommendationController::editReCategory/$1',['filter' => 'authGuard']);
$routes->get('/admin/recommendation/delete-category/(:any)', 'RecommendationController::deleteReCategory/$1',['filter' => 'authGuard']);
$routes->post('/admin/recommendation/insert-category', 'RecommendationController::insertReCategory',['filter' => 'authGuard']);
$routes->post('/admin/recommendation/update-category', 'RecommendationController::updateReCategory',['filter' => 'authGuard']);
$routes->get('/admin/recommendation/requests', 'RecommendationController::listReRequests',['filter' => 'authGuard']);
$routes->get('/admin/recommendation/add-request', 'RecommendationController::addReRequest',['filter' => 'authGuard']);
$routes->get('/admin/recommendation/edit-request/(:any)', 'RecommendationController::editReRequest/$1',['filter' => 'authGuard']);
$routes->get('/admin/recommendation/view-request/(:any)', 'RecommendationController::viewReRequest/$1',['filter' => 'authGuard']);
$routes->get('/admin/recommendation/delete-request/(:any)', 'RecommendationController::deleteReRequest/$1',['filter' => 'authGuard']);
$routes->post('/admin/recommendation/insert-request', 'RecommendationController::insertReRequest',['filter' => 'authGuard']);
$routes->post('/admin/recommendation/update-request', 'RecommendationController::updateReRequest',['filter' => 'authGuard']);
$routes->post('/admin/change-rerequest-status', 'RecommendationController::changeReRequestStatus',['filter' => 'authGuard']);
//products
$routes->get('/admin/recommendation/product-category', 'ProductController::listReProductCategory',['filter' => 'authGuard']);
$routes->get('/admin/recommendation/add-product-category', 'ProductController::addReProductCategory',['filter' => 'authGuard']);
$routes->get('/admin/recommendation/edit-product-category/(:any)', 'ProductController::editReProductCategory/$1',['filter' => 'authGuard']);
$routes->get('/admin/recommendation/delete-product-category/(:any)', 'ProductController::deleteReProductCategory/$1',['filter' => 'authGuard']);
$routes->post('/admin/recommendation/insert-product-category', 'ProductController::insertReProductCategory',['filter' => 'authGuard']);
$routes->post('/admin/recommendation/update-product-category', 'ProductController::updateReProductCategory',['filter' => 'authGuard']);
$routes->get('/admin/recommendation/products', 'ProductController::listReProducts',['filter' => 'authGuard']);
$routes->get('/admin/recommendation/add-product', 'ProductController::addReProduct',['filter' => 'authGuard']);
$routes->get('/admin/recommendation/edit-product/(:any)', 'ProductController::editReProduct/$1',['filter' => 'authGuard']);
$routes->get('/admin/recommendation/view-product/(:any)', 'ProductController::viewReProduct/$1',['filter' => 'authGuard']);
$routes->get('/admin/recommendation/delete-product/(:any)', 'ProductController::deleteReProduct/$1',['filter' => 'authGuard']);
$routes->post('/admin/recommendation/insert-product', 'ProductController::insertReProduct',['filter' => 'authGuard']);
$routes->post('/admin/recommendation/update-product', 'ProductController::updateReProduct',['filter' => 'authGuard']);
$routes->post('/admin/change-reproduct-status', 'ProductController::changeReProductStatus',['filter' => 'authGuard']);

//Restaurants
$routes->get('/admin/recommendation/restaurant/category', 'RestaurantController::listReCategory',['filter' => 'authGuard']);
$routes->get('/admin/recommendation/restaurant/add-category', 'RestaurantController::addReCategory',['filter' => 'authGuard']);
$routes->get('/admin/recommendation/restaurant/edit-category/(:any)', 'RestaurantController::editReCategory/$1',['filter' => 'authGuard']);
$routes->get('/admin/recommendation/restaurant/delete-category/(:any)', 'RestaurantController::deleteReCategory/$1',['filter' => 'authGuard']);
$routes->post('/admin/recommendation/restaurant/insert-category', 'RestaurantController::insertReCategory',['filter' => 'authGuard']);
$routes->post('/admin/recommendation/restaurant/update-category', 'RestaurantController::updateReCategory',['filter' => 'authGuard']);
$routes->get('/admin/recommendation/restaurants', 'RestaurantController::listReRestaurants',['filter' => 'authGuard']);
$routes->get('/admin/recommendation/restaurant/add-restaurant', 'RestaurantController::addReRestaurant',['filter' => 'authGuard']);
$routes->get('/admin/recommendation/restaurant/edit-restaurant/(:any)', 'RestaurantController::editReRestaurant/$1',['filter' => 'authGuard']);
$routes->get('/admin/recommendation/restaurant/view-restaurant/(:any)', 'RestaurantController::viewReRestaurant/$1',['filter' => 'authGuard']);
$routes->get('/admin/recommendation/restaurant/delete-restaurant/(:any)', 'RestaurantController::deleteReRestaurant/$1',['filter' => 'authGuard']);
$routes->post('/admin/recommendation/restaurant/insert-restaurant', 'RestaurantController::insertReRestaurant',['filter' => 'authGuard']);
$routes->post('/admin/recommendation/restaurant/update-restaurant', 'RestaurantController::updateReRestaurant',['filter' => 'authGuard']);
$routes->post('/admin/recommendation/restaurant/change-rerestaurant-status', 'RestaurantController::changeReRestaurantStatus',['filter' => 'authGuard']);

//Features
$routes->get('/admin/recommendation/restaurant/features', 'RestaurantController::listReRestaurantFeatures',['filter' => 'authGuard']);
$routes->get('/admin/recommendation/restaurant/add-restaurant-feature', 'RestaurantController::addReRestaurantFeature',['filter' => 'authGuard']);
$routes->get('/admin/recommendation/restaurant/edit-restaurant-feature/(:any)', 'RestaurantController::editReRestaurantFeature/$1',['filter' => 'authGuard']);
$routes->get('/admin/recommendation/restaurant/delete-restaurant-feature/(:any)', 'RestaurantController::deleteReRestaurantFeature/$1',['filter' => 'authGuard']);
$routes->post('/admin/recommendation/restaurant/insert-restaurant-feature', 'RestaurantController::insertReRestauranFeature',['filter' => 'authGuard']);
$routes->post('/admin/recommendation/restaurant/update-restaurant-feature', 'RestaurantController::updateReRestauranFeature',['filter' => 'authGuard']);
//Event
$routes->get('/admin/event/category', 'EventController::listEventCategory',['filter' => 'authGuard']);
$routes->get('/admin/event/add-category', 'EventController::addEventCategory',['filter' => 'authGuard']);
$routes->get('/admin/event/edit-category/(:any)', 'EventController::editEventCategory/$1',['filter' => 'authGuard']);
$routes->get('/admin/event/delete-category/(:any)', 'EventController::deleteEventCategory/$1',['filter' => 'authGuard']);
$routes->post('/admin/event/insert-category', 'EventController::insertEventCategory',['filter' => 'authGuard']);
$routes->post('/admin/event/update-category', 'EventController::updateEventCategory',['filter' => 'authGuard']);
$routes->get('/admin/event/list', 'EventController::listEvent',['filter' => 'authGuard']);
$routes->get('/admin/event/request', 'EventController::requestEvent',['filter' => 'authGuard']);
$routes->get('/admin/event/add-event', 'EventController::addEvent',['filter' => 'authGuard']);
$routes->get('/admin/event/edit-event/(:any)', 'EventController::editEvent/$1',['filter' => 'authGuard']);
$routes->get('/admin/event/view-event/(:any)', 'EventController::viewEvent/$1',['filter' => 'authGuard']);
$routes->get('/admin/event/delete-event/(:any)', 'EventController::deleteEvent/$1',['filter' => 'authGuard']);
$routes->get('/admin/event/decline-request/(:any)', 'EventController::declineEventRequest/$1',['filter' => 'authGuard']);
$routes->get('/admin/event/approve-request/(:any)', 'EventController::approveEventRequest/$1',['filter' => 'authGuard']);
$routes->post('/admin/event/insert-event', 'EventController::insertEvent',['filter' => 'authGuard']);
$routes->post('/admin/event/update-event', 'EventController::updateEvent',['filter' => 'authGuard']);
$routes->post('/admin/change-event-status', 'EventController::changeEventStatus',['filter' => 'authGuard']);

//Receipe
$routes->get('/admin/receipe/categories', 'ReceipeController::listReceipeCategory');
$routes->get('/admin/receipe/add-category', 'ReceipeController::addReceipeCategory',['filter' => 'authGuard']);
$routes->get('/admin/receipe/edit-category/(:any)', 'ReceipeController::editReceipeCategory/$1',['filter' => 'authGuard']);
$routes->get('/admin/receipe/delete-category/(:any)', 'ReceipeController::deleteReceipeCategory/$1',['filter' => 'authGuard']);
$routes->post('/admin/receipe/insert-category', 'ReceipeController::insertReceipeCategory',['filter' => 'authGuard']);
$routes->post('/admin/receipe/update-category', 'ReceipeController::updateReceipeCategory',['filter' => 'authGuard']);

$routes->get('/admin/receipe/list', 'ReceipeController::listReceipes');
$routes->get('/admin/receipe/add', 'ReceipeController::addReceipe',['filter' => 'authGuard']);
$routes->get('/admin/receipe/edit/(:any)', 'ReceipeController::editReceipe/$1',['filter' => 'authGuard']);
$routes->get('/admin/receipe/delete/(:any)', 'ReceipeController::deleteReceipe/$1',['filter' => 'authGuard']);
$routes->post('/admin/receipe/insert', 'ReceipeController::insertReceipe',['filter' => 'authGuard']);
$routes->post('/admin/receipe/update', 'ReceipeController::updateReceipe',['filter' => 'authGuard']);
$routes->get('/admin/receipe/view/(:any)', 'ReceipeController::viewReceipe/$1',['filter' => 'authGuard']);
//plan
$routes->get('/admin/recommendation/plans', 'RecommendationController::listRePlan');
$routes->get('/admin/recommendation/plans/add-plan', 'RecommendationController::addRePlan',['filter' => 'authGuard']);
$routes->get('/admin/recommendation/plans/edit-plan/(:any)', 'RecommendationController::editRePlan/$1',['filter' => 'authGuard']);
$routes->get('/admin/recommendation/plans/delete-plan/(:any)', 'RecommendationController::deleteRePlan/$1',['filter' => 'authGuard']);
$routes->post('/admin/recommendation/plans/insert-plan', 'RecommendationController::insertRePlan',['filter' => 'authGuard']);
$routes->post('/admin/recommendation/plans/update-plan', 'RecommendationController::updateRePlan',['filter' => 'authGuard']);
$routes->get('/admin/recommendation/plans/view-plan/(:any)', 'RecommendationController::viewRePlan/$1',['filter' => 'authGuard']);
$routes->get('/admin/recommendation/view-users/(:any)', 'RecommendationController::viewReUsers/$1',['filter' => 'authGuard']);
//email
$routes->get('/admin/email-management', 'EmailManagementController::ListPage');
$routes->get('/admin/email-management/edit/(:any)', 'EmailManagementController::EditEmailContent');
//admin routes

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
//$routes->get('/', 'ComingsoonController::index');
$routes->get('/', 'LandingPageController::index');
$routes->post('/landingpage/sendNewsLatter', 'LandingPageController::sendNewsLatter');
//user routes
//country and state
$routes->post('/user/get-country-list', 'UserController::getCountryList',['filter' => 'authGuardUser']);
$routes->post('/user/get-state-list', 'UserController::getStateList',['filter' => 'authGuardUser']);
//dashboard
$routes->get('/user/dashboard', 'UserController::dashboard',['filter' => 'authGuardUser']);
$routes->post('/user/dashboardLoadMore', 'UserController::dashboardLoadMore',['filter' => 'authGuardUser']);
$routes->get('/user/dashboard1', 'DemoController::dashboard',['filter' => 'authGuardUser']);
$routes->post('/user/dashboardScroll', 'DemoController::dashboardScroll',['filter' => 'authGuardUser']);
$routes->post('/user/insert-vegan-post', 'UserController::insertVeganPost');
//post user
$routes->post('/user/get-single-post-comment', 'UserController::getSinglePostComment',['filter' => 'authGuardUser']);
$routes->post('/user/insert-post-comment-user', 'PostController::insertPostCommentUser',['filter' => 'authGuardUser']);
$routes->post('/user/insert-post-like-user', 'PostController::insertPostLikeUser',['filter' => 'authGuardUser']);
$routes->post('/user/post/show-older-comment', 'PostController::showOlderPostComments',['filter' => 'authGuardUser']);
$routes->get('/user/get-single-post/(:any)', 'UserController::getSinglePost/$1');

//blog
$routes->get('/user/blog', 'UserController::blogUser');
$routes->post('/user/blogUserLoadMore', 'UserController::blogUserLoadMore');
$routes->post('/user/blog/insert-blog', 'UserController::insertBlog');
$routes->post('/user/blog/show-older-comment', 'BlogController::showOlderBlogComments');
$routes->get('/user/blog/category/(:any)/(:any)', 'UserController::blogByYear/$1/$2');
$routes->get('/user/blog/details/(:any)', 'UserController::blogDetails/$1',['filter' => 'authGuardUser']);
$routes->get('/user/get-single-blog/(:any)', 'UserController::getSingleblog/$1');
//profile
$routes->get('/user/profile', 'UserController::profileUser',['filter' => 'authGuardUser']);

$routes->get('/user/post_pofile/(:any)', 'User1Controller::post_pofile/$1',['filter' => 'authGuardUser']);
$routes->get('/user/event_profile/(:any)', 'User1Controller::event_profile/$1',['filter' => 'authGuardUser']);
$routes->get('/user/event_user', 'User1Controller::event_user',['filter' => 'authGuardUser']);

$routes->get('/user/recipes_profile/(:any)', 'User1Controller::recipes_profile/$1',['filter' => 'authGuardUser']);
$routes->get('/user/recipes_user', 'User1Controller::recipes_user',['filter' => 'authGuardUser']);
$routes->get('/user/blog_profile/(:any)', 'User1Controller::blog_profile/$1',['filter' => 'authGuardUser']);
$routes->get('/user/blog_user', 'User1Controller::blog_user',['filter' => 'authGuardUser']);

$routes->get('/user/profile-edit', 'User1Controller::profileEdit');
$routes->get('/user/profile-update', 'User1Controller::updateUserProfile');
$routes->post('/user/insertProfilePost', 'UserController::insertProfilePost');

$routes->get('/subscription/list', 'SubscriptionController::index');
$routes->get('/subscription/purchase/(:any)', 'SubscriptionController::purchase/$1');
$routes->get('/subscription/handler', 'SubscriptionController::handlePurchase');

//friend
$routes->get('/user/friendlist', 'UserController::friendList',['filter' => 'authGuardUser']);
$routes->get('/user/friendrequestlist', 'UserController::friendRequestList',['filter' => 'authGuardUser']);

$routes->get('/user/friend-request/(:any)', 'UserController::friendRequest/$1',['filter' => 'authGuardUser']);
$routes->post('/user/friend-request-confirm', 'UserController::friendRequestConfirm',['filter' => 'authGuardUser']);
$routes->post('/user/friend-request-delete', 'UserController::friendRequestDelete',['filter' => 'authGuardUser']);
$routes->post('/user/friend-request-send', 'UserController::friendRequestSend',['filter' => 'authGuardUser']);
$routes->post('/user/unfriend', 'UserController::unfriend',['filter' => 'authGuardUser']);
$routes->post('/user/cancel-request', 'UserController::cancelRequest',['filter' => 'authGuardUser']);
$routes->post('/user/removed-people-you-may-know', 'UserController::removedPeopleYouMayKnow',['filter' => 'authGuardUser']);
//photo
$routes->get('/user/photo', 'UserController::photoUser');
$routes->get('/user/public_photo/(:any)', 'UserController::public_photoUser/$1');
//public profile
$routes->get('/user/public_profile/(:any)', 'UserController::public_profileUser/$1',['filter' => 'authGuardUser']);

//event
$routes->get('/user/event', 'UserController::eventUser',['filter' => 'authGuardUser']);
$routes->post('/user/insert-event-comment-user', 'UserController::insertEventCommentUser',['filter' => 'authGuardUser']);
$routes->get('/user/insert-event-going/(:any)', 'UserController::insertEventGoing/$1');
$routes->get('/user/event/category/(:any)', 'UserController::eventByCategory/$1',['filter' => 'authGuardUser']);
$routes->get('/user/event/details/(:any)', 'UserController::eventDetailsUser/$1',['filter' => 'authGuardUser']);
$routes->get('/user/get-single-event/(:any)', 'UserController::getSingleEvent/$1');
$routes->get('/user/event/add-event', 'UserController::addEvent',['filter' => 'authGuardUser']);
$routes->post('/user/event/insert-event', 'UserController::insertEvent');
$routes->post('/user/event/going/insert', 'User1Controller::insertEventGoing',['filter' => 'authGuardUser']);
$routes->post('/user/event/not-intersted', 'User1Controller::insertNotIntersted',['filter' => 'authGuardUser']);
$routes->post('/user/event/going/update', 'User1Controller::EventGoingUpdate',['filter' => 'authGuardUser']);
$routes->post('/user/event/insert-comment', 'User1Controller::insertEventCommentUser',['filter' => 'authGuardUser']);
//notification
$routes->get('/user/notifications', 'UserController::Notification',['filter' => 'authGuardUser']);
$routes->post('/user/notificationCount', 'UserController::notificationCount',['filter' => 'authGuardUser']);
$routes->post('/user/notificationShow', 'UserController::notificationShow',['filter' => 'authGuardUser']);
//chat
$routes->get('/user/dashboardchat', 'UserChatController::dashboardchatUser');
$routes->post('/user/chatClassPhp', 'UserChatController::chatClassPhp');
$routes->post('/user/chatGroupClassPhp', 'UserChatController::chatGroupClassPhp');
//recipe
$routes->get('/admin/recipe/user-recipe-request', 'ReceipeController::user_recipe_request');

$routes->get('/admin/recipe/approve-request/(:any)', 'ReceipeController::user_recipe_accept_request/$1');
$routes->get('/admin/recipe/decline-request/(:any)', 'ReceipeController::user_recipe_decline_request/$1');
$routes->get('/admin/recipe/delete-request/(:any)', 'ReceipeController::user_recipe_delete_request/$1');



$routes->get('/user/recipe', 'UserController::recipeUser');
$routes->get('/user/userrecipelist', 'ReceipeController::user_recipe_list');
$routes->get('/user/userrecipelist/category/(:any)', 'ReceipeController::user_recipe_list_by_category/$1');
$routes->post('/user/user-recipe-insert', 'ReceipeController::user_recipe_insert');
$routes->get('/user/recipe/category/(:any)', 'UserController::recipeByCategory/$1',['filter' => 'authGuardUser']);
$routes->get('/user/get-single-recipes/(:any)', 'UserController::getSingleReceipe/$1');
$routes->get('/user/get-single-detail/(:any)', 'UserController::getReceipeDetail/$1');
$routes->get('/user/user-recipe-single/(:any)', 'ReceipeController::user_recipe_single/$1');

$routes->get('/user/user-recipe-details/(:any)', 'ReceipeController::user_recipe_details/$1');
$routes->get('/user/recipe-details/(:any)', 'ReceipeController::recipe_details/$1');

$routes->post('/user/user-recipe-insert-comments', 'ReceipeController::user_recipe_insert_comments',['filter' => 'authGuardUser']);
$routes->post('/user/recipe-insert-comments', 'ReceipeController::recipe_insert_comments',['filter' => 'authGuardUser']);

$routes->post('/user/user-recipe-old-comments', 'ReceipeController::user_recipe_old_comments',['filter' => 'authGuardUser']);
//recommendation
$routes->get('/user/recommendation', 'UserController::recommendationUser');
//restaurant
$routes->get('/user/restaurant', 'UserController::restaurantUser');
$routes->get('/user/get-single-restaurant/(:any)', 'UserController::getSingleRestaurant/$1');
$routes->post('/user/restaurant/post/insert-comment', 'RestaurantController::insertPostCommentUser',['filter' => 'authGuardUser']);
$routes->post('/user/restaurant/show-older-comment', 'RestaurantController::showOlderBlogComments');

//news
$routes->get('/user/news', 'UserController::newsUser');
$routes->get('/user/news/details/(:any)', 'UserController::newsDetailsById/$1',['filter' => 'authGuardUser']);
$routes->get('/user/news/category/(:any)', 'UserController::newsByCategory/$1',['filter' => 'authGuardUser']);
/* $routes->post('/user/news/insert-news-comment', 'UserController::insertNewsPostComment',['filter' => 'authGuardUser']); */
$routes->post('/user/news/post/insert-comment', 'NewsController::insertPostCommentUser',['filter' => 'authGuardUser']);
$routes->post('/user/blog/insert-news', 'UserController::insertNews');
//product
$routes->get('/user/product', 'UserController::productUser');
$routes->get('/user/get-single-product/(:any)', 'UserController::getSingleProduct/$1');
//cook
$routes->get('/user/cook', 'UserController::cookUser');
$routes->get('/user/get-single-cook/(:any)', 'UserController::getSinglecook/$1');
//forum
$routes->get('/user/ask_question', 'ForumController::ask_questionUser');
$routes->get('/user/answer', 'ForumController::answerUser');
$routes->get('/user/question', 'ForumController::questionUser');
//about us
$routes->get('/user/about', 'UserController::aboutUser');
$routes->get('/about', 'UserController::aboutUser');
//connect
$routes->get('/connect', 'UserController::contactUser');
$routes->get('/contact', 'UserController::contactUserL');
$routes->get('/user/connect', 'UserController::contactUser');
$routes->post('/user/contact/insert', 'User1Controller::insertcontact');
$routes->post('contact/insert', 'User1Controller::insertcontactlanding');
//privacy
$routes->get('/user/privacy', 'UserController::privacyUser');
$routes->get('/privacy', 'UserController::privacyUser');
//terms
$routes->get('/user/terms', 'UserController::termUser');
$routes->get('/terms', 'UserController::termUser');
//cookies
$routes->get('/user/cookies', 'UserController::cookiesUser');
$routes->get('/cookies', 'UserController::cookiesUser');
//advertising
$routes->get('/user/advertising', 'UserController::advertisingUser');
$routes->get('/advertising', 'UserController::advertisingUser');
//login
$routes->get('/user/login', 'UserController::loginUser');
$routes->get('/user/logout', 'UserController::logoutUser');
$routes->post('/user/loginAuth', 'UserController::loginAuth');
//register
$routes->get('/user/register', 'UserController::registerUser');
$routes->post('/user/insert-user', 'UserController::insertUser');
$routes->post('/user/resendVerification', 'UserController::resendVerification');
$routes->post('/user/check-user-email', 'UserController::checkemailf');
$routes->get('/user/accountVerification', 'UserController::accountVerification');
$routes->get('/user/resendmail', 'UserController::resendmail');
//password
$routes->get('/user/forgot-password', 'UserController::forgotPassword');
$routes->get('/user/reset-password', 'UserController::resetPassword');
$routes->post('/user/sendForgotPasswordLink', 'UserController::sendForgotPasswordLink');
$routes->post('/user/resetForgotPassword', 'UserController::resetForgotPassword');
//live search
$routes->get('/user/live-search/(:any)', 'UserController::liveSearch/$1');
//user routes
$routes->get('api/lang/(:any)', 'ApiController::test/$1');


$routes->get('ajax/post/delete/(:any)', 'AjaxController::deletePost/$1');



//users  controller




//email management

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
