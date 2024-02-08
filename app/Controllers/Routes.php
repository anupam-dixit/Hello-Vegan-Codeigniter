<?php

namespace Config;

// Create a new instance of our RouteCollection class.
use App\Controllers\UserController;

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
$routes->setAutoRoute(true);
//admin routes


//admin routes

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'ComingsoonController::index');
//users  controller
/* $routes->get('/user/dashboard', 'UserController::dashboardUser',['filter' => 'authGuardUser']); */
$routes->get('/user/friendlist/(:any)', 'UserController::friendlist/$1',['filter' => 'authGuardUser']);
$routes->get('/user/dashboard', 'UserController::dashboardUser',['filter' => 'authGuardUser']);

//$routes->get('/user/profile/(:any)', 'UserController::profile/$1',['filter' => 'authGuardUser']);

$routes->get('/user/photo', 'UserController::postDetailUser');

$routes->get('/user/dashboardchat', 'UserChatController::dashboardchatUser');
$routes->post('/user/chatClassPhp', 'UserChatController::chatClassPhp');
$routes->post('/user/chatGroupClassPhp', 'UserChatController::chatGroupClassPhp');
$routes->get('/user/recipe', 'User1Controller::recipeUser');
$routes->get('/user/recommendation', 'UserController::recommendationUser');
$routes->get('/user/restaurant', 'UserController::restaurantUser');
$routes->get('/user/product', 'UserController::productUser');
$routes->get('/user/cook', 'UserController::cookUser');

$routes->get('/user/news', 'User1Controller::newsUser');
$routes->get('/user/news/details/(:any)', 'User1Controller::newsDetailsById/$1',['filter' => 'authGuardUser']);
$routes->get('/user/news/category/(:any)', 'User1Controller::newsByCategory/$1',['filter' => 'authGuardUser']);
$routes->post('/user/news/insert-news-comment', 'User1Controller::insertNewsPostComment',['filter' => 'authGuard']);

// $routes->get('/user/blog', 'UserController::blogUser');
$routes->get('/user/blog', 'User1Controller::blogUser');
$routes->get('/user/get-single-blog/(:any)', 'User1Controller::getSingleblog/$1');
$routes->get('/user/blog/category/(:any)', 'User1Controller::blogByCategory/$1',['filter' => 'authGuardUser']);
$routes->get('/user/blog/details/(:any)', 'User1Controller::blogDetailsUser/$1',['filter' => 'authGuardUser']);
$routes->post('/user/blog/insert-blog-comment', 'User1Controller::insertPostCommentUser',['filter' => 'authGuardUser']);

$routes->get('/user/get-single-recipes/(:any)', 'User1Controller::getSingleReceipe/$1');

$routes->get('/user/event', 'UserController::eventUser',['filter' => 'authGuardUser']);
$routes->get('/user/event1', 'UserController::eventUser1',['filter' => 'authGuardUser']);
$routes->get('/user/event/category/(:any)', 'UserController::eventByCategory/$1',['filter' => 'authGuardUser']);
$routes->get('/user/event/details/(:any)', 'UserController::eventDetailsUser/$1',['filter' => 'authGuardUser']);
$routes->get('/user/get-single-event/(:any)', 'User1Controller::getSingleEvent/$1');
$routes->get('/user/event/add-event', 'UserController::addEvent',['filter' => 'authGuardUser']);
$routes->post('/user/event/insert-event', 'UserController::insertEvent');
$routes->get('/user/profile', 'UserController::profileUser');
$routes->get('/user/profile-edit', 'User1Controller::profileEdit');
$routes->get('/user/register', 'UserController::registerUser');
$routes->get('/user/login', 'UserController::loginUser');
$routes->get('/user/logout', 'UserController::logoutUser');
$routes->post('/user/insert-user', 'UserController::insertUser');
$routes->post('/user/loginAuth', 'UserController::loginAuth');
$routes->post('/user/resendVerification', 'UserController::resendVerification');
$routes->post('/user/check-user-email', 'UserController::checkemailf');
$routes->get('/user/accountVerification', 'UserController::accountVerification');
$routes->get('/user/resendmail', 'UserController::resendmail');
$routes->get('/user/forgot-password', 'UserController::forgotPassword');
$routes->get('/user/reset-password', 'UserController::resetPassword');
$routes->post('/user/sendForgotPasswordLink', 'UserController::sendForgotPasswordLink');
$routes->post('/user/resetForgotPassword', 'UserController::resetForgotPassword');
$routes->post('/user/insertVeganPost', 'UserController::insertVeganPost');
//users  controller
//admin login controller
$routes->get('/admin/login', 'AdminLoginController::login');
$routes->get('admin/logout', 'AdminLoginController::logout');
//chat controller
$routes->get('/admin/chat', 'ChatController::ChatPage');
$routes->get('/admin/chat/view-all-chat/(:any)', 'ChatController::viewAllChat');
$routes->get('/admin/chat/view-group-chat/(:any)', 'ChatController::viewGroupChat');
$routes->get('/admin/chatuserslist', 'ChatController::listChatUser');
//admin controller
$routes->get('/admin/dashboard', 'AdminController::dashboard');
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
//news controller
//news category
$routes->get('/admin/news/post/categories', 'NewsController::listPostCategory');
$routes->get('/admin/news/post/add-category', 'NewsController::addPostCategory',['filter' => 'authGuard']);
$routes->get('/admin/news/post/edit-category/(:any)', 'NewsController::editPostCategory/$1',['filter' => 'authGuard']);
$routes->get('/admin/news/post/delete-category/(:any)', 'NewsController::deletePostCategory/$1',['filter' => 'authGuard']);
$routes->post('/admin/news/post/insert-category', 'NewsController::insertPostCategory',['filter' => 'authGuard']);
$routes->post('/admin/news/post/update-category', 'NewsController::updatePostCategory',['filter' => 'authGuard']);
//news posts
$routes->get('/admin/news/posts', 'NewsController::listPosts');
$routes->get('/admin/news/add-post', 'NewsController::addPost',['filter' => 'authGuard']);
$routes->get('/admin/news/edit-post/(:any)', 'NewsController::editPost/$1',['filter' => 'authGuard']);
$routes->get('/admin/news/delete-post/(:any)', 'NewsController::deletePost/$1',['filter' => 'authGuard']);
$routes->post('/admin/news/insert-post', 'NewsController::insertPost',['filter' => 'authGuard']);
$routes->post('/admin/news/update-post', 'NewsController::updatePost',['filter' => 'authGuard']);
$routes->get('/admin/news/view-post/(:any)', 'NewsController::viewPost/$1',['filter' => 'authGuard']);
//news post comments
$routes->get('/admin/news/post/manage-comments/(:any)', 'NewsController::managePostComment/$1',['filter' => 'authGuard']);
$routes->post('/admin/news/post/insert-comment', 'NewsController::insertPostComment',['filter' => 'authGuard']);

//blog controller
//blog category
$routes->get('/admin/blog/post/categories', 'BlogController::listPostCategory');
$routes->get('/admin/blog/post/add-category', 'BlogController::addPostCategory',['filter' => 'authGuard']);
$routes->get('/admin/blog/post/edit-category/(:any)', 'BlogController::editPostCategory/$1',['filter' => 'authGuard']);
$routes->get('/admin/blog/post/delete-category/(:any)', 'BlogController::deletePostCategory/$1',['filter' => 'authGuard']);
$routes->post('/admin/blog/post/insert-category', 'BlogController::insertPostCategory',['filter' => 'authGuard']);
$routes->post('/admin/blog/post/update-category', 'BlogController::updatePostCategory',['filter' => 'authGuard']);
//blog posts
$routes->get('/admin/blog/posts', 'BlogController::listPosts');
$routes->get('/admin/blog/add-post', 'BlogController::addPost',['filter' => 'authGuard']);
$routes->get('/admin/blog/edit-post/(:any)', 'BlogController::editPost/$1',['filter' => 'authGuard']);
$routes->get('/admin/blog/delete-post/(:any)', 'BlogController::deletePost/$1',['filter' => 'authGuard']);
$routes->post('/admin/blog/insert-post', 'BlogController::insertPost',['filter' => 'authGuard']);
$routes->post('/admin/blog/update-post', 'BlogController::updatePost',['filter' => 'authGuard']);
$routes->get('/admin/blog/view-post/(:any)', 'BlogController::viewPost/$1',['filter' => 'authGuard']);
//blog post comments
$routes->get('/admin/blog/post/manage-comments/(:any)', 'BlogController::managePostComment/$1',['filter' => 'authGuard']);
$routes->post('/admin/blog/post/insert-comment', 'BlogController::insertPostComment',['filter' => 'authGuard']);

//forum controller
//forum post tag
$routes->get('/admin/forum/post/tags', 'ForumController::listPostTag');
$routes->get('/admin/forum/post/add-tag', 'ForumController::addPostTag',['filter' => 'authGuard']);
$routes->get('/admin/forum/post/edit-tag/(:any)', 'ForumController::editPostTag/$1',['filter' => 'authGuard']);
$routes->get('/admin/forum/post/delete-tag/(:any)', 'ForumController::deletePostTag/$1',['filter' => 'authGuard']);
$routes->post('/admin/forum/post/insert-tag', 'ForumController::insertPostTag',['filter' => 'authGuard']);
$routes->post('/admin/forum/post/update-tag', 'ForumController::updatePostTag',['filter' => 'authGuard']);
//forum posts
$routes->get('/admin/forum/posts', 'ForumController::listPosts');
$routes->get('/admin/forum/add-post', 'ForumController::addPost',['filter' => 'authGuard']);
$routes->get('/admin/forum/edit-post/(:any)', 'ForumController::editPost/$1',['filter' => 'authGuard']);
$routes->get('/admin/forum/delete-post/(:any)', 'ForumController::deletePost/$1',['filter' => 'authGuard']);
$routes->post('/admin/forum/insert-post', 'ForumController::insertPost',['filter' => 'authGuard']);
$routes->post('/admin/forum/update-post', 'ForumController::updatePost',['filter' => 'authGuard']);
$routes->get('/admin/forum/view-post/(:any)', 'ForumController::viewPost/$1',['filter' => 'authGuard']);
//forum post comments
$routes->get('/admin/forum/post/manage-comments/(:any)', 'ForumController::managePostComment/$1',['filter' => 'authGuard']);
$routes->post('/admin/forum/post/insert-comment', 'ForumController::insertPostComment',['filter' => 'authGuard']);

//forum question tag
$routes->get('/admin/forum/question/tags', 'ForumController::listQuestionTag');
$routes->get('/admin/forum/question/add-tag', 'ForumController::addQuestionTag',['filter' => 'authGuard']);
$routes->get('/admin/forum/question/edit-tag/(:any)', 'ForumController::editQuestionTag/$1',['filter' => 'authGuard']);
$routes->get('/admin/forum/question/delete-tag/(:any)', 'ForumController::deleteQuestionTag/$1',['filter' => 'authGuard']);
$routes->post('/admin/forum/question/insert-tag', 'ForumController::insertQuestionTag',['filter' => 'authGuard']);
$routes->post('/admin/forum/question/update-tag', 'ForumController::updateQuestionTag',['filter' => 'authGuard']);
//forum questions
$routes->get('/admin/forum/questions', 'ForumController::listQuestions');
$routes->get('/admin/forum/add-question', 'ForumController::addQuestion',['filter' => 'authGuard']);
$routes->get('/admin/forum/edit-question/(:any)', 'ForumController::editQuestion/$1',['filter' => 'authGuard']);
$routes->get('/admin/forum/delete-question/(:any)', 'ForumController::deleteQuestion/$1',['filter' => 'authGuard']);
$routes->post('/admin/forum/insert-question', 'ForumController::insertQuestion',['filter' => 'authGuard']);
$routes->post('/admin/forum/update-question', 'ForumController::updateQuestion',['filter' => 'authGuard']);
$routes->get('/admin/forum/view-question/(:any)', 'ForumController::viewQuestion/$1',['filter' => 'authGuard']);
//forum question comments
$routes->get('/admin/forum/question/manage-comments/(:any)', 'ForumController::manageQuestionComment/$1',['filter' => 'authGuard']);
$routes->post('/admin/forum/question/insert-comment', 'ForumController::insertQuestionComment',['filter' => 'authGuard']);
//chat system
$routes->get('/admin/chat/chat-page/', 'ChatController::chatPage',['filter' => 'authGuard']);




//Tutorial posts
$routes->get('/admin/tutorials/posts', 'TutorialController::listPosts');
$routes->get('/admin/tutorials/add-post', 'TutorialController::addPost',['filter' => 'authGuard']);
$routes->get('/admin/tutorials/edit-post/(:any)', 'TutorialController::editPost/$1',['filter' => 'authGuard']);
$routes->get('/admin/tutorials/delete-post/(:any)', 'TutorialController::deletePost/$1',['filter' => 'authGuard']);
$routes->post('/admin/tutorials/insert-post', 'TutorialController::insertPost',['filter' => 'authGuard']);
$routes->post('/admin/tutorials/update-post', 'TutorialController::updatePost',['filter' => 'authGuard']);
$routes->get('/admin/tutorials/view-post/(:any)', 'TutorialController::viewPost/$1',['filter' => 'authGuard']);

//posts controller
//post category
$routes->get('/admin/post/categories', 'PostController::listPostCategory');
$routes->get('/admin/post/add-category', 'PostController::addPostCategory',['filter' => 'authGuard']);
$routes->get('/admin/post/edit-category/(:any)', 'PostController::editPostCategory/$1',['filter' => 'authGuard']);
$routes->get('/admin/post/delete-category/(:any)', 'PostController::deletePostCategory/$1',['filter' => 'authGuard']);
$routes->post('/admin/post/insert-category', 'PostController::insertPostCategory',['filter' => 'authGuard']);
$routes->post('/admin/post/update-category', 'PostController::updatePostCategory',['filter' => 'authGuard']);

//posts
$routes->get('/admin/post/list', 'PostController::listPosts');
$routes->get('/admin/post/add', 'PostController::addPost',['filter' => 'authGuard']);
$routes->get('/admin/post/edit/(:any)', 'PostController::editPost/$1',['filter' => 'authGuard']);
$routes->get('/admin/post/delete/(:any)', 'PostController::deletePost/$1',['filter' => 'authGuard']);
$routes->post('/admin/post/insert', 'PostController::insertPost',['filter' => 'authGuard']);
$routes->post('/admin/post/update', 'PostController::updatePost',['filter' => 'authGuard']);
$routes->get('/admin/post/view/(:any)', 'PostController::viewPost/$1',['filter' => 'authGuard']);

$routes->get('/admin/post/manage-comments/(:any)', 'PostController::managePostComment/$1',['filter' => 'authGuard']);
$routes->post('/admin/post/insert-comment', 'PostController::insertPostComment',['filter' => 'authGuard']);
//posts controller


//Masters Controller
$routes->get('/admin/masters/tutorials/location-list', 'MasterController::tutorial');
$routes->get('/admin/masters/tutorials/add-location', 'MasterController::addPost',['filter' => 'authGuard']);
$routes->get('/admin/masters/tutorials/edit-location/(:any)', 'MasterController::editPostTag/$1',['filter' => 'authGuard']);
$routes->get('/admin/masters/tutorials/delete-location/(:any)', 'MasterController::deletePost/$1',['filter' => 'authGuard']);
$routes->post('/admin/masters/tutorials/insert-location', 'MasterController::insertPost',['filter' => 'authGuard']);
$routes->post('/admin/masters/tutorials/update-location', 'MasterController::updatePostTag',['filter' => 'authGuard']);
$routes->get('/admin/masters/tutorials/view-location/(:any)', 'MasterController::viewPost/$1',['filter' => 'authGuard']);
//Masters Controller

//RecommendationController
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
//RecommendationController

//EventController
$routes->get('/admin/event/category', 'EventController::listEventCategory',['filter' => 'authGuard']);
$routes->get('/admin/event/add-category', 'EventController::addEventCategory',['filter' => 'authGuard']);
$routes->get('/admin/event/edit-category/(:any)', 'EventController::editEventCategory/$1',['filter' => 'authGuard']);
$routes->get('/admin/event/delete-category/(:any)', 'EventController::deleteEventCategory/$1',['filter' => 'authGuard']);
$routes->post('/admin/event/insert-category', 'EventController::insertEventCategory',['filter' => 'authGuard']);
$routes->post('/admin/event/update-category', 'EventController::updateEventCategory',['filter' => 'authGuard']);
$routes->get('/admin/event/list', 'EventController::listEvent',['filter' => 'authGuard']);
$routes->get('/admin/event/add-event', 'EventController::addEvent',['filter' => 'authGuard']);
$routes->get('/admin/event/edit-event/(:any)', 'EventController::editEvent/$1',['filter' => 'authGuard']);
$routes->get('/admin/event/view-event/(:any)', 'EventController::viewEvent/$1',['filter' => 'authGuard']);
$routes->get('/admin/event/delete-event/(:any)', 'EventController::deleteEvent/$1',['filter' => 'authGuard']);
$routes->post('/admin/event/insert-event', 'EventController::insertEvent',['filter' => 'authGuard']);
$routes->post('/admin/event/update-event', 'EventController::updateEvent',['filter' => 'authGuard']);
$routes->post('/admin/change-event-status', 'EventController::changeEventStatus',['filter' => 'authGuard']);

//EventController

//Receipe controller
//Receipe category
$routes->get('/admin/receipe/categories', 'ReceipeController::listReceipeCategory');
$routes->get('/admin/receipe/add-category', 'ReceipeController::addReceipeCategory',['filter' => 'authGuard']);
$routes->get('/admin/receipe/edit-category/(:any)', 'ReceipeController::editReceipeCategory/$1',['filter' => 'authGuard']);
$routes->get('/admin/receipe/delete-category/(:any)', 'ReceipeController::deleteReceipeCategory/$1',['filter' => 'authGuard']);
$routes->post('/admin/receipe/insert-category', 'ReceipeController::insertReceipeCategory',['filter' => 'authGuard']);
$routes->post('/admin/receipe/update-category', 'ReceipeController::updateReceipeCategory',['filter' => 'authGuard']);

//Receipes
$routes->get('/admin/receipe/list', 'ReceipeController::listReceipes');
$routes->get('/admin/receipe/add', 'ReceipeController::addReceipe',['filter' => 'authGuard']);
$routes->get('/admin/receipe/edit/(:any)', 'ReceipeController::editReceipe/$1',['filter' => 'authGuard']);
$routes->get('/admin/receipe/delete/(:any)', 'ReceipeController::deleteReceipe/$1',['filter' => 'authGuard']);
$routes->post('/admin/receipe/insert', 'ReceipeController::insertReceipe',['filter' => 'authGuard']);
$routes->post('/admin/receipe/update', 'ReceipeController::updateReceipe',['filter' => 'authGuard']);
$routes->get('/admin/receipe/view/(:any)', 'ReceipeController::viewReceipe/$1',['filter' => 'authGuard']);
//Receipe controller




//plan details
$routes->get('/admin/recommendation/plans', 'RecommendationController::listRePlan');
$routes->get('/admin/recommendation/plans/add-plan', 'RecommendationController::addRePlan',['filter' => 'authGuard']);
$routes->get('/admin/recommendation/plans/edit-plan/(:any)', 'RecommendationController::editRePlan/$1',['filter' => 'authGuard']);
$routes->get('/admin/recommendation/plans/delete-plan/(:any)', 'RecommendationController::deleteRePlan/$1',['filter' => 'authGuard']);
$routes->post('/admin/recommendation/plans/insert-plan', 'RecommendationController::insertRePlan',['filter' => 'authGuard']);
$routes->post('/admin/recommendation/plans/update-plan', 'RecommendationController::updateRePlan',['filter' => 'authGuard']);
$routes->get('/admin/recommendation/plans/view-plan/(:any)', 'RecommendationController::viewRePlan/$1',['filter' => 'authGuard']);
$routes->get('/admin/recommendation/view-users/(:any)', 'RecommendationController::viewReUsers/$1',['filter' => 'authGuard']);
//plan details
//email management
$routes->get('/admin/email-management', 'EmailManagementController::ListPage');
$routes->get('/admin/email-management/edit/(:any)', 'EmailManagementController::EditEmailContent');
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
