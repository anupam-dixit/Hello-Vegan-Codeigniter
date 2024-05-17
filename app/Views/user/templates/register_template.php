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

<!-- Bootstrap -->
<link href="<?php echo  $public_url;?>css/bootstrap.css" rel="stylesheet">
<link href="<?php echo  $public_url;?>css/style.css" rel="stylesheet">
<link href="<?php echo  $public_url;?>css/responsive.css" rel="stylesheet">
    <link href="<?=base_url()?>/public/khalid/css/custom.css" rel="stylesheet">
    <link rel="stylesheet" href="/public/frontend/css/custom/login_page.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>


<body class="bg-theme">
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
<script src="<?php echo  $public_url;?>js/jquery.min.js"></script> 
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="<?php echo  $public_url;?>js/bootstrap.min.js"></script>  
<script src='https://www.google.com/recaptcha/api.js'></script>
<?php if(session()->getFlashdata('msg')): ?>
<script>
 $(document).ready(function(){
     $("#myModal").modal('show');
    });
</script>
<?php endif; ?> 

<script>  
function valueonchange(ids){
	if(ids=='email'){
		document.getElementById('error_email').style.display='none';
		document.getElementById('error_same_email').style.display='none';
		document.getElementById('error_email_valid').style.display='none';
	}
	if(ids=='name'){
		document.getElementById('error_name').style.display='none';
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
	if(ids=='checkbox'){
		document.getElementById('error_check_term').style.display='none';
	}
	
}
</script>

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

 var alreadyTaken=0;
function checkEmail(baseurl){
	alreadyTaken=0;
$.ajax({
    url : baseurl+"user/check-user-email",
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

 </script>
</body>
</html>
