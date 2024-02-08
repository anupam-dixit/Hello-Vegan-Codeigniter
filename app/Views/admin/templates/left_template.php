 <?php
use App\Models\DashBoardModel as DashBoardModel;
$dbm = new DashBoardModel();
$b_n=$dbm->getBlogNotifications();
$e_n=$dbm->getEventNotifications();
$r_n=$dbm->getRecipeNotifications();
$total_n=$b_n+$e_n+$r_n;
$public_url=base_url()."/public/";
?>

<style>
.sidebar-menu img {
	width: 16px;
	margin-right: 5px;
    margin-bottom: 4px;
}
  .badge { 
	padding: 3px 4px; background-color: red;
}
.treeview-menu > li {
	margin: 0;
	position: relative; 
}
.sidebar-menu > li .badge {
	margin-top: 3px;
	width: 20px;
	height: 20px;
	text-align: center;
	position: absolute;
	right: 8%;
	z-index: 999;
	top: 10px;
} .sidebar-menu > li .badge {
	margin-top: 3px;
	width: 20px;
	height: 20px;
	text-align: center;
	position: absolute;
	right: 8%;
	z-index: 999;
	top: 0px;
}.small-box.bg-aqua .icon img {
	width: 30px;
}
</style>
<ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active">
          <a href="<?php echo site_url();?>admin/dashboard">
            <!--<i class="fa fa-th"></i> --> 
			<img src="<?php echo $public_url;?>lefticons/dashboard.png">
			<span>Dashboard</span>
            
          </a>
        </li>
		
		<li class="treeview">
          <a href="#">
           <!-- <i class="fa fa-dashboard"></i> --> 
		   <img src="<?php echo $public_url;?>lefticons/user.png">
		   <span>User Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="<?php echo site_url();?>admin/users"><i class="fa fa-circle-o"></i> Users</a></li>
            <li><a href="<?php echo site_url();?>admin/add-user"><i class="fa fa-circle-o"></i>Add User</a></li>
			<li><a href="<?php echo site_url();?>admin/users-deleted"><i class="fa fa-circle-o"></i>Deleted User</a></li>
			
          </ul>
        </li>
		<li>
          <a href="<?php echo site_url();?>admin/email-management">
            <img src="<?php echo $public_url;?>lefticons/EmailManagement.png"> <span>Email Management</span>
            
          </a>
        </li>
		<li class="treeview">
          <a href="#">
           <!-- <i class="fa fa-dashboard"></i> --> 
		   <img src="<?php echo $public_url;?>lefticons/forum.png">
		   <span>Event Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            <ul class="treeview-menu">
            <li class="active"><a href="<?php echo site_url();?>admin/event/category"><i class="fa fa-circle-o"></i> Category</a></li>
			<li class="active"><a href="<?php echo site_url();?>admin/event/add-category"><i class="fa fa-circle-o"></i> Add Category</a></li>
            
			<li class="active"><a href="<?php echo site_url();?>admin/event/list"><i class="fa fa-circle-o"></i> Events</a></li>
            <li><a href="<?php echo site_url();?>admin/event/add-event"><i class="fa fa-circle-o"></i>Add Event</a></li>
			
		  </ul>
          </a>
          
        </li>


        <li class="treeview">
          <a href="#">
           <!-- <i class="fa fa-dashboard"></i> --> 
       <img src="<?php echo $public_url;?>lefticons/PendingRequest.png">
	  
       <span>Pending Request</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            <ul class="treeview-menu">
           
            
      <li>
	  <a class="notification" href="<?php echo site_url();?>admin/blog/posts-request"><i class="fa fa-circle-o"></i>Blog Request <?php if($b_n!=0){?><span class="badge"><?php echo $b_n;?></span> <?php }?> </a></li>
      <li class="active">
	  <a class="notification" href="<?php echo site_url();?>admin/event/request"><i class="fa fa-circle-o"></i> Events Request <?php if($e_n!=0){?><span class="badge"><?php echo $e_n;?></span> <?php }?></a></li>
      <li class="active">
	  <a class="notification" href="<?php echo site_url();?>admin/recipe/user-recipe-request"><i class="fa fa-circle-o"></i> Recipe Request<?php if($r_n!=0){?><span class="badge"><?php echo $r_n;?></span> <?php }?></a></li>
    
      
      </ul>
          <?php if($r_n!=0){?><span class="badge"><?php echo $total_n;?></span> <?php }?>
		  </a>
          
        </li>



       <li class="treeview" style="display:none">
          <a href="#">
           <!-- <i class="fa fa-dashboard"></i> --> 
		   <img src="<?php echo $public_url;?>lefticons/forum.png">
		   <span>Forum Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            <ul class="treeview-menu">
            <li class="active"><a href="<?php echo site_url();?>admin/forum/post/tags"><i class="fa fa-circle-o"></i> Tags</a></li>
            <li><a href="<?php echo site_url();?>admin/forum/post/add-tag"><i class="fa fa-circle-o"></i>Add Tag</a></li>
			<li><a href="<?php echo site_url();?>admin/forum/posts"><i class="fa fa-circle-o"></i>Posts</a></li>
			<li><a href="<?php echo site_url();?>admin/forum/add-post"><i class="fa fa-circle-o"></i>Add Post</a></li>
		  </ul>
          </a>
          
        </li>
		
        
       
		<li class="treeview"> 
          <a href="#">
            <img src="<?php echo $public_url;?>lefticons/blogging.png"><span>Blogs Management</span>
			<span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            <ul class="treeview-menu">
            <li class="active"><a href="<?php echo site_url();?>admin/blog/post/categories"><i class="fa fa-circle-o"></i> Category</a></li>
            <li><a href="<?php echo site_url();?>admin/blog/post/add-category"><i class="fa fa-circle-o"></i>Add Category</a></li>
			<li><a href="<?php echo site_url();?>admin/blog/posts"><i class="fa fa-circle-o"></i>Posts</a></li>
      
			<li><a href="<?php echo site_url();?>admin/blog/add-post"><i class="fa fa-circle-o"></i>Add Post</a></li>
		  </ul>
          </a>
        </li>
		<li class="treeview"> 
          <a href="#">
            <img src="<?php echo $public_url;?>lefticons/NewsManagement.png"><span>News Management</span>
			<span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            <ul class="treeview-menu">
            <li class="active"><a href="<?php echo site_url();?>admin/news/post/categories"><i class="fa fa-circle-o"></i> Category</a></li>
            <li><a href="<?php echo site_url();?>admin/news/post/add-category"><i class="fa fa-circle-o"></i>Add Category</a></li>
			<li><a href="<?php echo site_url();?>admin/news/posts"><i class="fa fa-circle-o"></i>Posts</a></li>
			<li><a href="<?php echo site_url();?>admin/news/add-post"><i class="fa fa-circle-o"></i>Add Post</a></li>
		  </ul>
          </a>
   </li>
		<li>
          <a href="<?php echo site_url();?>admin/chat">
            <img src="<?php echo $public_url;?>lefticons/bubble-chat.png"> <span>Chat Management</span>
            
          </a>
        </li>
<li class="treeview"> 
          <a href="<?php echo site_url();?>admin/recommendation/users">
            <img src="<?php echo $public_url;?>lefticons/RecommendationManagement.png"><span>Recommendation Management</span>
			<span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            <ul class="treeview-menu">
            <li class="active"><a href="<?php echo site_url();?>admin/recommendation/category"><i class="fa fa-circle-o"></i> Category</a></li>
            <li><a href="<?php echo site_url();?>admin/recommendation/add-category"><i class="fa fa-circle-o"></i>Add Category</a></li>
			<li><a href="<?php echo site_url();?>admin/recommendation/requests"><i class="fa fa-circle-o"></i>Requests</a></li>
			<li><a href="<?php echo site_url();?>admin/recommendation/add-request"><i class="fa fa-circle-o"></i>Add Request</a></li>
			<li><a href="<?php echo site_url();?>admin/recommendation/plans"><i class="fa fa-circle-o"></i>Plans</a></li>
			<li><a href="<?php echo site_url();?>admin/recommendation/plans/add-plan"><i class="fa fa-circle-o"></i>Add Plan</a></li>
			<li><a href="<?php echo site_url();?>admin/recommendation/products"><i class="fa fa-circle-o"></i>Products</a></li>
			<li><a href="<?php echo site_url();?>admin/recommendation/add-product"><i class="fa fa-circle-o"></i>Add Product</a></li>
			<li><a href="<?php echo site_url();?>admin/recommendation/restaurants"><i class="fa fa-circle-o"></i>Restaurant </a></li>
			<li><a href="<?php echo site_url();?>admin/recommendation/restaurant/add-restaurant"><i class="fa fa-circle-o"></i>Add Restaurant </a></li>
			<li><a href="<?php echo site_url();?>admin/recommendation/restaurant/features"><i class="fa fa-circle-o"></i>Features </a></li>
		  </ul>
          </a>
   </li>
       
       
   <li class="treeview"> 
          <a href="#">
            <img src="<?php echo $public_url;?>lefticons/TutorialManagement.png"><span>Tutorial Management</span>
			<span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i> 
            </span>
            <ul class="treeview-menu">
           
			<li><a href="<?php echo site_url();?>admin/tutorials/posts"><i class="fa fa-circle-o"></i>Posts</a></li>
			<li><a href="<?php echo site_url();?>admin/tutorials/add-post"><i class="fa fa-circle-o"></i>Add Post</a></li>
		  </ul>
          </a>
   </li>
   
     <li class="treeview"> 
          <a href="#">
            <img src="<?php echo $public_url;?>lefticons/VeganPostManagement.png"><span>Vegan Post Management</span>
			<span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i> 
            </span>
            <ul class="treeview-menu">
            <li class="active"><a href="<?php echo site_url();?>admin/post/categories"><i class="fa fa-circle-o"></i> Category</a></li>
            <li><a href="<?php echo site_url();?>admin/post/add-category"><i class="fa fa-circle-o"></i>Add Category</a></li>
            <li><a href="<?php echo site_url();?>admin/post/list"><i class="fa fa-circle-o"></i>Posts</a></li>
            <li><a href="<?php echo site_url();?>admin/post/add"><i class="fa fa-circle-o"></i>Add Post</a></li>
             </ul>
          </a>
   </li>
    
         <li class="treeview"> 
          <a href="#">
            <img src="<?php echo $public_url;?>lefticons/MastersManagement.png"><span>Masters Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i> 
            </span>
            <ul class="treeview-menu">
            <li class="active"><a href="<?php echo site_url();?>admin/masters/tutorials/location-list"><i class="fa fa-circle-o"></i> Tutorial Master</a></li>
<!--            <li><a href="<?php echo site_url();?>admin/post/add-category"><i class="fa fa-circle-o"></i>Add Category</a></li>
            <li><a href="<?php echo site_url();?>admin/post/list"><i class="fa fa-circle-o"></i>Posts</a></li>
            <li><a href="<?php echo site_url();?>admin/post/add"><i class="fa fa-circle-o"></i>Add Post</a></li>-->
             </ul>
          </a>
        </li>   
         <li class="treeview"> 
          <a href="#">
            <img src="<?php echo $public_url;?>lefticons/ReceipeManagement.png"><span>Receipe Management</span>
			<span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i> 
            </span>
            <ul class="treeview-menu">
            <li class="active"><a href="<?php echo site_url();?>admin/receipe/categories"><i class="fa fa-circle-o"></i> Category</a></li>
            <li><a href="<?php echo site_url();?>admin/receipe/add-category"><i class="fa fa-circle-o"></i>Add Category</a></li>
            <li><a href="<?php echo site_url();?>admin/receipe/list"><i class="fa fa-circle-o"></i>Receipes</a></li>
            <li><a href="<?php echo site_url();?>admin/receipe/add"><i class="fa fa-circle-o"></i>Add Receipe</a></li>
             </ul>
          </a>
   </li>
       
       
       

      </ul>