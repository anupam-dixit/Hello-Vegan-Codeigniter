<?php
$public_url=base_url()."/public/";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Hello Vegans | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
 
  <link rel="stylesheet" href="<?php echo $public_url;?>other/css/map.css">
  <link rel="stylesheet" href="<?php echo  $public_url;?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo  $public_url;?>bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo  $public_url;?>bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo  $public_url;?>dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo  $public_url;?>dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo  $public_url;?>bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo  $public_url;?>bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo  $public_url;?>bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo  $public_url;?>bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo  $public_url;?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

</head>
<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>H</b>VG</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Hello</b>Vegans</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li><a href="<?php echo site_url();?>admin/logout"><i class="fa fa-sign-out"></i>  Logout</a></li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo  $public_url;?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Admin</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
     
      <!-- /.search form -->
	  <?php echo  $this->include('admin/templates/left_template'); ?>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      
    </section>
    <!-- /.sidebar -->
  </aside>
<?php echo  $this->renderSection('content') ?>
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy;  <a href="http://acentriatech.com"> Acentria Technologies Pvt Ltd</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      
    </div>
  </aside>
  
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?php echo  $public_url;?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo  $public_url;?>bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo  $public_url;?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="<?php echo  $public_url;?>bower_components/raphael/raphael.min.js"></script>
<script src="<?php echo  $public_url;?>bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo  $public_url;?>bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?php echo  $public_url;?>plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo  $public_url;?>plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo  $public_url;?>bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo  $public_url;?>bower_components/moment/min/moment.min.js"></script>
<script src="<?php echo  $public_url;?>bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?php echo  $public_url;?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo  $public_url;?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="<?php echo  $public_url;?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo  $public_url;?>bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo  $public_url;?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo  $public_url;?>dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo  $public_url;?>dist/js/demo.js"></script>
<script src="<?php echo  $public_url;?>bower_components/ckeditor/ckeditor.js"></script>
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('description')
    //bootstrap WYSIHTML5 - text editor
    //$('.textarea').wysihtml5()
  })
</script>
<script src="<?php echo  $public_url;?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo  $public_url;?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script>
  $(function () {
   
    $('#pending_blogs').DataTable({
    })
  })
  $(function () {
   
    $('#pending_events').DataTable({
    })
  })
  $(function () {
   
    $('#pending_receipes').DataTable({
    })
  })
  


function approve_blog_request(baseurl,ids){
$.ajax({
    url : baseurl+"admin/blog/approve-request/"+ids,
    type: "GET",
    data : { },
    success: function(data)
    {
		alert('Request Approved');
		location.reload(); 
		console.log(data);
    },
    error: function (e)
    {
      console.log(e);
    }
});	
}
function decline_blog_request(baseurl,ids){
$.ajax({
    url : baseurl+"admin/blog/decline-request/"+ids,
    type: "GET",
    data : { },
    success: function(data)
    {
		alert('Request Declined');
		location.reload(); 
		console.log(data);
    },
    error: function (e)
    {
      console.log(e);
    }
});	
}  
function delete_blog_request(baseurl,ids){
$.ajax({
    url : baseurl+"admin/blog/delete-post/"+ids,
    type: "GET",
    data : { },
    success: function(data)
    {
		alert('Request Deleted');
		location.reload(); 
		console.log(data);
    },
    error: function (e)
    {
      console.log(e);
    }
});	
}



function approve_event_request(baseurl,ids){
$.ajax({
    url : baseurl+"admin/event/approve-request/"+ids,
    type: "GET",
    data : { },
    success: function(data)
    {
		alert('Request Approved');
		location.reload(); 
		console.log(data);
    },
    error: function (e)
    {
      console.log(e);
    }
});	
}
function decline_event_request(baseurl,ids){
$.ajax({
    url : baseurl+"admin/event/decline-request/"+ids,
    type: "GET",
    data : { },
    success: function(data)
    {
		alert('Request Declined');
		location.reload(); 
		console.log(data);
    },
    error: function (e)
    {
      console.log(e);
    }
});	
}  
function delete_event_request(baseurl,ids){
$.ajax({
    url : baseurl+"admin/event/delete-event/"+ids,
    type: "GET",
    data : { },
    success: function(data)
    {
		alert('Request Deleted');
		location.reload(); 
		console.log(data);
    },
    error: function (e)
    {
      console.log(e);
    }
});	
}

function approve_recipe_request(baseurl,ids){
$.ajax({
    url : baseurl+"admin/recipe/approve-request/"+ids,
    type: "GET",
    data : { },
    success: function(data)
    {
		alert('Request Approved');
		location.reload(); 
		console.log(data);
    },
    error: function (e)
    {
      console.log(e);
    }
});	
}
function decline_recipe_request(baseurl,ids){
$.ajax({
    url : baseurl+"admin/recipe/decline-request/"+ids,
    type: "GET",
    data : { },
    success: function(data)
    {
		alert('Request Declined');
		location.reload(); 
		console.log(data);
    },
    error: function (e)
    {
      console.log(e);
    }
});	
}  
function delete_recipe_request(baseurl,ids){
$.ajax({
    url : baseurl+"admin/recipe/delete-request/"+ids,
    type: "GET",
    data : { },
    success: function(data)
    {
		alert('Request Deleted');
		location.reload(); 
		console.log(data);
    },
    error: function (e)
    {
      console.log(e);
    }
});	
}

  </script>
</body>
</html>
