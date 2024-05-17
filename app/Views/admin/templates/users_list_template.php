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
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo  $public_url;?>bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Bootstrap 3.3.7 -->
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
<link href="<?php echo  $public_url;?>plugins/others/css/bootstrap-toggle.css" rel="stylesheet">

 
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
    <strong>Copyright &copy;  <a href="#"> Hello Vegan</a>.</strong> All rights
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
<script src="<?php echo  $public_url;?>plugins1/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo  $public_url;?>bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo  $public_url;?>bower_components/moment/min/moment.min.js"></script>
<script src="<?php echo  $public_url;?>bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?php echo  $public_url;?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo  $public_url;?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- DataTables -->
<script src="<?php echo  $public_url;?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo  $public_url;?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
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
<script src="<?php echo  $public_url;?>plugins/others/js/bootstrap-toggle.js"></script>

  <script>
  $(function () {
   
    $('#example2').DataTable({
     /*  'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false */
    })
  })
</script>
<script>
var baseUrl="<?php echo base_url('admin/change-user-status'); ?>";
$('input[data-toggle]').on('change', function (event, state) {
	
	var getId=$(this).attr('id');
	
	 var st=1;
	if($(this).prop("checked")!=true){
	 st=0;	
	}
	$.ajax({  
			url:baseUrl,
			type: 'post',
            data:{'id':getId,'status':st},
			success:function(data){
				console.log(data);
				alert('Status has been updated');
			}  
        }); 
}); 


</script>
<script>
function valueonchange(ids){
	if(ids=='email'){
		document.getElementById('error_email').style.display='none';
		document.getElementById('error_same_email').style.display='none';
	}
	if(ids=='profile_image'){
		document.getElementById('error_profile_image').style.display='none';
	}
	if(ids=='cover_image'){
		document.getElementById('error_cover_image').style.display='none';
	}
	
	
}	
function validation(){/* 
	var eVar=document.getElementById('email').value;
	var piVar=document.getElementById('profile_image').value;
	var ciVar=document.getElementById('cover_image').value;
	var dVar = CKEDITOR.instances['description'].getData().replace(/<[^>]*>/gi, '').length;

	var flag=0;
	if(eVar==''){
		document.getElementById('error_email').style.display='block';
		document.getElementById("email").focus();
		flag=1;
	}
	if(piVar==''){
		document.getElementById('error_profile_image').style.display='block';
		flag=1;
	}
	if(ciVar==''){
		document.getElementById('error_cover_image').style.display='block';
		flag=1;
	}
	if(dVar==0){
		document.getElementById('error_description').style.display='block';
		flag=1;
	}
	
	if(alreadyTaken==1){
		$("#error_same_email").css('display','block');
		document.getElementById("email").focus();
		flag=1;
	}
	if(flag==1){
		return false;
	} */
	
}
function validationEdit(){
	/* var eVar=document.getElementById('email').value;
	var piVar=document.getElementById('profile_image').value;
	var ciVar=document.getElementById('cover_image').value;
	var dVar = CKEDITOR.instances['description'].getData().replace(/<[^>]*>/gi, '').length;
	
	var flag=0;
	if(eVar==''){
		document.getElementById('error_email').style.display='block';
		document.getElementById("email").focus();
		flag=1;
		
	}
	if(piVar==''){
		
		var profile_val_var=document.getElementById('profile_val').value;
		if(profile_val_var==0){
		document.getElementById('error_profile_image').style.display='block';
		flag=1;	
		}
		
	}
	if(ciVar==''){
		
		var cover_val_var=document.getElementById('cover_val').value;
		if(cover_val_var==0){
		document.getElementById('error_cover_image').style.display='block';
		flag=1;	
		}

	}
	if(dVar==0){
		document.getElementById('error_description').style.display='block';
		flag=1;
	}
	
	if(alreadyTakenEdit==1){
		$("#error_same_email").css('display','block');
		document.getElementById("email").focus();
		flag=1;
	}
	if(flag==1){
		return false;
	} */
	
}
var alreadyTaken=0;
function checkEmail(baseurl){
	alreadyTaken=0;
$.ajax({
    url : baseurl+"admin/checkemailf",
    type: "POST",
    data : { email: $("#email").val()},
    success: function(data)
    {
		if(data!=0){
			alreadyTaken=1;
			$("#error_same_email").css('display','block');
		}
		else{
			$("#error_same_email").css('display','none');
		}
		console.log(data);
    },
    error: function (e)
    {
      console.log(e);
    }
});
}
var alreadyTakenEdit=0;
function checkEmailEdit(baseurl,ids){
	alreadyTakenEdit=0;
$.ajax({
    url : baseurl+"admin/checkemailf_edit",
    type: "POST",
    data : { email: $("#email").val(),id:ids},
    success: function(data)
    {
		if(data!=0){
			alreadyTakenEdit=1;
			$("#error_same_email").css('display','block');
		}else{
			$("#error_same_email").css('display','none');
		}
		console.log(data);
    },
    error: function (e)
    {
      console.log(e);
    }
});
}
function delete_user(baseurl,ids){
$.ajax({
    url : baseurl+"admin/delete-user/"+ids,
    type: "GET",
    data : { },
    success: function(data)
    {
		alert('User Deleted Successfully');
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
