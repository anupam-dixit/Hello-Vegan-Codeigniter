<?php
$public_url=base_url()."/public/frontend/";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>Hello-Vegans</title>
<style>
.error_class{
	color: red;font-size: 14px;margin-top: 3px;font-weight: bold;display:none;
}
</style>
<!-- Bootstrap -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
<link href="<?php echo $public_url;?>css/bootstrap.css" rel="stylesheet">
<link href="<?php echo $public_url;?>css/style.css" rel="stylesheet">
<link href="<?php echo $public_url;?>css/responsive.css" rel="stylesheet">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
 <link rel="stylesheet" href="/public/frontend/css/custom/login_page.css">


</head>
  <body class="font-poppins">
 <?= $this->renderSection('content') ?>
<div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Message</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <?php if(session()->getFlashdata('msg')): ?>
                <?= session()->getFlashdata('msg') ?>
                <?php endif; ?>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="<?php echo $public_url;?>js/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo $public_url;?>js/bootstrap.min.js"></script>
<?php if(session()->getFlashdata('msg')): ?>
<script>
 $(document).ready(function(){
     $("#myModal").modal('show');
    });
</script>
<?php endif; ?>

    <script>

 $(".toggle-password").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});
function submitLoginForm(){
var flag=0;
var email=$("#email").val();
var password_field=$("#password-field").val();

	if(email==''){
		document.getElementById('error_email').style.display='block';
		document.getElementById("email").focus();
		flag=1;
	}
	if(email!=''){
	  if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)){

       }else{
		document.getElementById('error_email_valid').style.display='block';
	    document.getElementById("email").focus();
        flag=1;
	   }

	}
	if(password_field==''){
	document.getElementById('error_password_field').style.display='block';
	document.getElementById("password-field").focus();
    flag=1;
	}
	if(flag==1){
		return false;
	}else{
	return true;
	}

}
 function submitForgotForm(){
	var flag=0;
	var email=$("#email").val();


	if(email==''){
	document.getElementById('error_email').style.display='block';
	document.getElementById("email").focus();
    flag=1;
	}
	if(email!=''){
	  if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)){

       }else{
		document.getElementById('error_email_valid').style.display='block';
	    document.getElementById("email").focus();
        flag=1;
	   }

	}

	if(flag==1){
		return false;
	}else{
	return true;
	}

}
function submitResetForm(){
	var flag=0;
	var password_field=$("#password-field").val();
	var rpassword_field=$("#rpassword-field").val();

	if(password_field==''){
	document.getElementById('error_password_field').style.display='block';
	document.getElementById("password-field").focus();
    flag=1;
	}
	if(rpassword_field==''){
	document.getElementById('error_rpassword_field').style.display='block';
	document.getElementById("rpassword-field").focus();
    flag=1;
	}
	if(password_field!='' && rpassword_field!=''){
		if(password_field.length<6){
		document.getElementById('error_less_password_field').style.display='block';
		document.getElementById("password-field").focus();
		}
		if(password_field!=rpassword_field){
		document.getElementById('error_same_password_field').style.display='block';
		document.getElementById("password-field").focus();
		flag=1;
		}

	}

	if(flag==1){
		return false;
	}else{
	return true;
	}

}
function valueonchange(ids){
	if(ids=='email'){
		document.getElementById('error_email').style.display='none';
		document.getElementById('error_email_valid').style.display='none';
	}

	if(ids=='password-field'){
		document.getElementById('error_password_field').style.display='none';
		document.getElementById('error_less_password_field').style.display='none';
		document.getElementById('error_same_password_field').style.display='none';
	}
	if(ids=='rpassword-field'){
		document.getElementById('error_rpassword_field').style.display='none';
		document.getElementById('error_same_password_field').style.display='none';
	}


}
 </script>
  </body>
</html>