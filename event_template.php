<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>Hello-Vegans</title>
<?php
$public_url=base_url()."/public/frontend/";
$public_url_bower=base_url()."/public/";
?>
<!-- Bootstrap -->
<link href="<?php echo $public_url;?>css/bootstrap.css" rel="stylesheet">
<link href="<?php echo $public_url;?>css/style.css" rel="stylesheet">
<link href="<?php echo $public_url;?>css/home_page.css" rel="stylesheet">
<link href="<?php echo $public_url;?>css/responsive.css" rel="stylesheet">
<link href="<?php echo $public_url;?>css/userme.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel='stylesheet' href='<?php echo $public_url;?>css/owl.carousel.min.css'>
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<script src="<?php echo  $public_url_bower;?>bower_components/ckeditor/ckeditor.js"></script>
	
</head>
<body>

<main>
  <button class="icon-button e-dark-mode-button u-animation-click" id="darkMode" aria-label="Dark Mode"><span class="icon" aria-hidden="true">🌜</span></button>
  <div class="common-structure">
    <header class="main-header u-flex header_hidden">
      <div class="start u-flex"> <a class="logo">HV</a>
        <div class="search-box-wrapper">
          <input type="search" class="search-box" placeholder="Search Vegan log">
          <span class="icon-search" aria-label="hidden"><img src="<?php echo $public_url;?>images/search_icon.png"></span> </div>
      </div>
      <nav class="main-nav">
        <ul class="main-nav-list u-flex">
          <li class="main-nav-item u-only-wide"><a aria-label="Vegan log" class="main-nav-button alt-text is-selected"><span class="icon" aria-hidden="true"><img src="<?php echo $public_url;?>images/vegan_g.png" /></span></a></li>
          <li class="main-nav-item u-only-wide"><a aria-label="About Us" class="main-nav-button alt-text"><span class="icon" aria-hidden="true"><img src="<?php echo $public_url;?>images/about_icon_g.png" /></span></a></li>
          <li class="main-nav-item u-only-wide"><a aria-label="Connect" class="main-nav-button alt-text"><span class="icon" aria-hidden="true"> <img src="<?php echo $public_url;?>images/connect_icon_g.png" /></span></a></li>
          <li class="main-nav-item u-only-wide"><a aria-label="Let's Discuss " class="main-nav-button alt-text"><span class="icon" aria-hidden="true"><img src="<?php echo $public_url;?>images/discuss_icon_g.png" /></span></a></li>
          <li class="main-nav-item u-only-wide"><a aria-label="Recommendation" class="main-nav-button alt-text"><span class="icon" aria-hidden="true"><img src="<?php echo $public_url;?>images/recommendation_icon_g.png" /></span></a></li>
          <li class="main-nav-item u-only-wide"><a aria-label="Questions" class="main-nav-button alt-text"><span class="icon" aria-hidden="true"><img src="<?php echo $public_url;?>images/questions_icon_g.png" /></span></a></li>
          <li class="main-nav-item u-only-small">
            <button aria-label="Menu" class="main-nav-button u-animation-click" id="menuButton"><span class="icon icon-hamburger" aria-hidden="true"></span></button>
          </li>
        </ul>
      </nav>
      <div class="end"></div>
    </header>
    <nav class="user-nav header_hidden">
      <ul class="user-nav-list u-flex">
        <li class="user-nav-item"> <a class="user"> <img class="user-image" src="https://assets.codepen.io/65740/internal/avatars/users/default.png" height="28" width="28" alt=""> <span class="user-name">Elad</span> </a> </li>
        <li class="user-nav-item">
          <button class="icon-button alt-text" aria-label="Create"><span class="icon" aria-hidden="true">➕</span></button>
        </li>
        <li class="user-nav-item">
          <button class="icon-button alt-text" aria-label="Messenger"><span class="icon" aria-hidden="true">💬</span></button>
        </li>
        <li class="user-nav-item">
          <button class="icon-button alt-text" aria-label="Notifications"><span class="icon" aria-hidden="true">🔔</span></button>
        </li>
        <li class="user-nav-item">
          <button class="icon-button alt-text" aria-label="Account"><span class="icon" aria-hidden="true">🔻</span></button>
        </li>
      </ul>
    </nav>
     <?php echo  $this->include('user/templates/left_template'); ?>
	
	<?php echo  $this->renderSection('content') ?>
	<aside class="side-b">
      <section class="common-section">
        <div class="blog_sidebar">
          <ul>
            <?php
			foreach($event_category as $cats){
			?>
			<li><a href="<?php echo base_url();?>/user/event/category/<?php echo $cats['id'];?>"><?php echo $cats['name'];?></a></li>
            <?php 
			}
			?>
           </ul>
        </div>
      </section>
      <section class="common-section">
        <div class="user_name_commnet"><span><img src="<?php echo $public_url;?>images/commnet_icon1.png"></span>
          <p>Neil Sharma </p>
          <div class="user_name_commnet_down_icon"><i class="fa fa-angle-down" aria-hidden="true"></i> </div>
        </div>
        <div class="comment_all">
          <h2 class="section-title">Events</h2>
          <div class="events">
            <div class="events_images"> 
			<?php 
             if(count($event_latest)!=0){
			?>
			<a href="<?php echo base_url();?>/user/event/details/<?php echo $event_latest['id'];?>"><img src="<?php echo base_url().'/'.$event_latest['image'];?>"></a>
            <?php 			
			 }else{
				?> 
			<img src="<?php echo $public_url;?>images/events_images.jpg"> 
			 <?php
			 }
			?>
			
              <div class="live_text">
                <div class="live_bg">
                  <div class="live_left">
                    <h2>Live</h2>
                    <h3><i class="fa fa-users" aria-hidden="true"></i> 3K People</h3>
                  </div>
                  <div class="live_right"> <a href="#"><img src="<?php echo $public_url;?>images/share.png"></a> <a href="#"><img src="images/close.png"></a> </div>
                </div>
              </div>
            </div>
            <div class="commnet_events">
              <ul>
                <li><span><img src="<?php echo $public_url;?>images/commnet_icon1.png"></span>
                  <p>Great teamwork</p>
                  <div class="time_commnet">11:00AM</div>
                </li>
                <li><span><img src="<?php echo $public_url;?>images/commnet_icon2.png"></span>
                  <p>Lovely Receple, Thank You so much Would love to try it </p>
                  <div class="time_commnet">11:00AM</div>
                </li>
                <li><span><img src="<?php echo $public_url;?>images/commnet_icon3.png"></span>
                  <p>Amazing..... D</p>
                  <div class="time_commnet">11:00AM</div>
                </li>
                <li><span><img src="<?php echo $public_url;?>images/commnet_icon4.png"></span>
                  <p>Can We Add Cherry Tomatos?</p>
                  <div class="time_commnet">11:00AM</div>
                </li>
              </ul>
              <div class="comment_input">
                <div class="search-box-wrapper">
                  <input type="search" class="search-box" placeholder="Comment">
                  <span class="icon-search" aria-label="hidden"><img src="<?php echo $public_url;?>images/chat_input.png"></span> </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </aside>
  </div>
  <?php echo  $this->include('user/templates/footer_template'); ?>
</main>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="<?php echo $public_url;?>js/bootstrap.min.js"></script> 
<script src='<?php echo $public_url;?>js/owl.carousel.min.js'></script>





<script>
    /*JS isn't my expertise 😉*/
$(document).ready(function() {
    $("#menuButton").on("click", function(){
        $(".side-a").toggleClass("is-open");
        $("html").toggleClass("is-nav-open");
    });
      $("#darkMode").on("click", function(){
        $("html").toggleClass("is-dark");
    });
});
    
    
    
    </script> 
<script>
	$('.home_silder1').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
	autoplay:true,
	autoplayTimeout:5000,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1000:{
            items:3
        }
    }
});
function getSingleEvent(id){
	$.ajax({
		url:'https://projectstatus.co.in/Hello-Vegans/user/get-single-event/'+id,
		type:'GET',
		success:function(data){
			console.log(data);
			$("#showmodel").css('display','block');
			$("#showmodel").html(data);
			$('#add_custom_blog').modal('show');
		},
		error:function(e){
			
		}
	});	
	}
function hidepopup(){
	$("#showmodel").css('display','none');
}	
function submitEventForm(){}	
 var spinner = $('#loader');
 jQuery("#eventForm").submit('on',function(e){
	
					e.preventDefault();
					spinner.show();
					jQuery('#ErrorMessage').html('');
					
					var form = $('#eventForm')[0];
					var form_data = new FormData(form);
			     	jQuery.ajax({
					  dataType : "json",
					  type : "post",
					  cache: false,
					  contentType: false,
					  processData: false,
					  data : form_data,
					  url: jQuery('#eventForm').attr('action'),
					  success:function(data)
							{
								//console.log(data);
								//jQuery("#element_overlap").LoadingOverlay("hide", true);
								$('#eventForm')[0].reset();
								spinner.hide();
								$('#myModal2').modal({ backdrop: 'static' });
								$('#addEventModal').modal('hide');
								if(data.code == 400) { $('#ErrorMessage').html(data.error); }
 								if(data.status == 0)
								{
								  jQuery('#ErrorMessage').html(data.msgevent);
								}
								if(data.status == 1)
								{
 									  jQuery('#ErrorMessage').html(data.msgevent);
									  jQuery('#eventForm').trigger('reset');
 								}
 					  },
					  error: function (jqXHR, status, err) {
						//  alert();
						spinner.hide();
						  jQuery('#ErrorMessage').html("Local error callback.");
 					  }
				
					});
					//} //else	
					
					
});
	</script>
	
<script>
 $(function () {
    CKEDITOR.replace('details')
  })
</script>
<style>
div.pac-container {
   z-index: 1050 !important;
}
#loader {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  width: 100%;
  background: rgba(0,0,0,0.75) url(../public/frontend/images/ajax-loader.gif) no-repeat center center;
  z-index: 10000;
}
</style>
</body>
</html>