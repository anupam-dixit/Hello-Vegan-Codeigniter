<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>Hello-Vegans</title>

<!-- Bootstrap -->
<link href="<?php echo base_url().'/public/frontend/';?>css/bootstrap.css" rel="stylesheet">
<link href="<?php echo base_url().'/public/frontend/';?>css/style.css" rel="stylesheet">
<link href="<?php echo base_url().'/public/frontend/';?>css/home_page.css" rel="stylesheet">
<link href="<?php echo base_url().'/public/frontend/';?>css/responsive.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&family=Poppins:ital,wght@0,400;0,600;0,700;1,600&display=swap" rel="stylesheet">
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link href="<?=base_url()?>/public/pitesh/css/custom.css" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>
<button class="icon-button e-dark-mode-button u-animation-click" id="darkMode" aria-label="Dark Mode"><span class="icon" aria-hidden="true">🌜</span></button>
<div class="common-structure">
<?php 
echo  $this->include('user/templates/comman_header_profile'); 

?>
</div>
<?php echo  $this->renderSection('content');?>
<?php echo  $this->include('user/templates/chat_template'); ?>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="<?php echo base_url().'/public/frontend/';?>js/bootstrap.min.js"></script> 

<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo base_url().'/public/frontend/';?>js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="<?php echo base_url().'/public/frontend/';?>js/slider/photoswipe.css">
<script>
$(document).ready(function() {
  $(".noti").on('click',function() {
    $(this).find('ul').toggle();
  });
});
$(document).ready(function() {
    $("#menuButton").on("click", function(){
        $(".side-a").toggleClass("is-open");
        $("html").toggleClass("is-nav-open");
    });
      $("#darkMode").on("click", function(){
        $("html").toggleClass("is-dark");
    });
});
function friend_request_send(id){
	$.ajax({
   url: "<?php echo base_url();?>/user/friend-request-send",
   type: "POST",
   data:  'id='+id,
   beforeSend : function()
   {
   },
   success: function(data)
      {
		 alert("Request Send");
		 $('#requestsend_'+id).css('display','block');
		 $('#addfriend_'+id).css('display','none');
		  return false;
    
      },
     error: function(e) 
      {
		  $('#loading').hide();

      }          
    });
}
function cancel_request(id){
	$.ajax({
   url: "<?php echo base_url();?>/user/cancel-request",
   type: "POST",
   data:  'id='+id,
   beforeSend : function()
   {
   },
   success: function(data)
      {
		 alert("Request Cancel");
		 $('#requestsend_'+id).css('display','none');
		 $('#addfriend_'+id).css('display','block');
		  return false;
    
      },
     error: function(e) 
      {
		  $('#loading').hide();

      }          
    });
}
function removed_people_you_may_know(id){
	$.ajax({
   url: "<?php echo base_url();?>/user/removed-people-you-may-know",
   type: "POST",
   data:  'id='+id,
   beforeSend : function()
   {
   },
   success: function(data)
      {
		 $('#removed_'+id).remove();
		
		  return false;
    
      },
     error: function(e) 
      {
		  $('#loading').hide();

      }          
    });
}
function friend_request_confrim(id){
	$.ajax({
   url: "<?php echo base_url();?>/user/friend-request-confirm",
   type: "POST",
   data:  'id='+id,
   beforeSend : function()
   {
   },
   success: function(data)
      {
		 alert("Request confirm");
		 $("#confirm_"+id).remove();
		/*  $('#requestsend').css('display','inline-block');
		 $('#addfriend').css('display','inline-block'); */
		  return false;
    
      },
     error: function(e) 
      {
		  $('#loading').hide();

      }          
    });
}
function friend_request_delete(id){
	$.ajax({
   url: "<?php echo base_url();?>/user/friend-request-delete",
   type: "POST",
   data:  'id='+id,
   beforeSend : function()
   {
   },
   success: function(data)
      {
		 alert("Request Deleted");
		 $("#confirm_"+id).remove();
		/*  $('#requestsend').css('display','inline-block');
		 $('#addfriend').css('display','inline-block'); */
		  return false;
    
      },
     error: function(e) 
      {
		  $('#loading').hide();

      }          
    });
}
</script>
<script type="module">
import PhotoSwipeLightbox from '<?php echo base_url().'/public/frontend/';?>js/slider/photoswipe-lightbox.esm.js';
const lightbox = new PhotoSwipeLightbox({
  gallery: '#gallery--getting-started',
  children: 'a',
  pswpModule: () => import('<?php echo base_url().'/public/frontend/';?>js/slider/photoswipe.esm.js')
});
lightbox.init();
</script>
</body>
</html>



