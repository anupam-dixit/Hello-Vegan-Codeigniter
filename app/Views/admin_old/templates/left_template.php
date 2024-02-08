 <?php
$public_url=base_url()."/public/";
?>
<style>
.nav-link img {
	width: 16px;
	margin-right: 5px;
    margin-bottom: 4px;
}
</style>
 <!-- Brand Logo -->
    <a href="index3.html" class="brand-link" style="display:none">
      <img src="<?php echo $public_url;?>dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div  class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo $public_url;?>dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Hello Vegans</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
	  <ul class="nav nav-pills nav-sidebar flex-column nav-collapse-hide-child " data-widget="treeview" role="menu" data-accordion="false">
         
          <li class="nav-item menu-open">
            <a href="<?php echo site_url();?>admin/dashboard"  class="nav-link active">
              <img src="<?php echo $public_url;?>lefticons/dashboard.png">
			  <!--<i class="nav-icon fas fa-tachometer-alt"></i>-->
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <img src="<?php echo $public_url;?>lefticons/user.png">
              <p>
                User Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            
			  <li class="nav-item">
                <a href="<?php echo site_url();?>admin/users" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Users</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="<?php echo site_url();?>admin/add-user" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add User</p>
                </a>
              </li>
			   <li class="nav-item">
                <a href="<?php echo site_url();?>admin/users-deleted" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Deleted User</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="<?php echo site_url();?>admin/logout" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Logout</p>
                </a>
              </li>
            </ul>
          </li>
		  <li class="nav-item menu-open">
            <a href="#" class="nav-link">
              <img src="<?php echo $public_url;?>lefticons/forum.png">
              <p>
                Forum Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
           
          </li>
		  <li class="nav-item menu-open">
            <a href="#" class="nav-link">
              <img src="<?php echo $public_url;?>lefticons/blogging.png">
              <p>
                Blogs Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
           
          </li>
		  <li class="nav-item menu-open">
            <a href="#" class="nav-link">
              <img src="<?php echo $public_url;?>lefticons/news.png">
              <p>
                News Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
           
          </li>
		  <li class="nav-item menu-open">
            <a href="#" class="nav-link">
              <img src="<?php echo $public_url;?>lefticons/bubble-chat.png">
              <p>
                Chat Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
           
          </li> 
        </ul>
        <?php /* ?><ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         
          <li class="nav-item menu-open">
            <a href="<?php echo site_url();?>admin/dashboard" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            
          </li>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-laptop"></i>
              <p>
                User Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            
			  <li class="nav-item">
                <a href="<?php echo site_url();?>admin/users" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Users</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="<?php echo site_url();?>admin/add-user" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add User</p>
                </a>
              </li>
			   <li class="nav-item">
                <a href="<?php echo site_url();?>admin/users-deleted" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Deleted User</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="<?php echo site_url();?>admin/logout" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Logout</p>
                </a>
              </li>
            </ul>
          </li>
		  <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-folder"></i>
              <p>
                Forum Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
           
          </li>
		  <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Blogs Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
           
          </li>
		  <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-folder"></i>
              <p>
                News Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
           
          </li>
		  <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Chat Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
           
          </li> 
        </ul><?php  */?>
      </nav>
	  
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->