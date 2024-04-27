<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Hello-Vegans</title>
<?php
$public_url=base_url()."/public/frontend/";
$public_url_bower=base_url()."/public/";
$baseurl=base_url()."/";

use App\Models\SubscriptionPurchaseModel;

$sm = new SubscriptionPurchaseModel();
$current_subscription = $sm->userActiveSubscription($session->get('idUserH'));


?>
<!-- Bootstrap -->
<!--<link href="--><?php //echo $public_url;?><!--css/bootstrap.css" rel="stylesheet">-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <link href="<?php echo $public_url;?>css/style.css" rel="stylesheet">
<link href="<?php echo $public_url;?>css/home_page.css" rel="stylesheet">
<link href="<?php echo $public_url;?>css/responsive.css" rel="stylesheet">
<link href="<?php echo $public_url;?>css/userme.css" rel="stylesheet">
    <link href="<?=base_url()?>/public/pitesh/css/custom.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
<link rel='stylesheet' href='<?php echo base_url().'/public/frontend/';?>css/owl.carousel.min.css'>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel='stylesheet' href='<?php echo base_url().'/public/frontend/';?>css/owl.carousel.min.css'>
   <style> #owl-demo .item{
  margin: 3px;
}
#owl-demo .item img{
  display: block;
  width: 100%;
}  </style>


</head>
<body>



<main>
  <button class="icon-button e-dark-mode-button u-animation-click" id="darkMode" aria-label="Dark Mode"><span class="icon" aria-hidden="true">🌜</span></button>
  <div class="common-structure">
   <?php echo  $this->include('user/templates/common_left_menu_dashboard_template'); ?>

      <?php echo  $this->renderSection('content') ?>

          <aside class="side-b">
		<section class="common-section user_right_homepage">
        <div class="notfy">
       <?php
	  echo  $this->include('user/templates/show_logout'); ?>
	</div>
    </section>
      <section class="common-section">
        <div class="comment_all">
		 <h2 class="section-title">Topic </h2>
		<div class="blog_sidebar">


		<ul>

            <?php
      foreach($receipe_category_topic as $cats){
      ?>


            <li><a href="<?php echo base_url();?>/user/userrecipelist/category/<?php echo $cats['id'];?>"><?php echo $cats['name'];?></a></li>

            <?php
      }
      ?>

          </ul>
        </div>
        </div>
      </section>
          <section class="common-section">
        <h2 class="section-title">Events</h2>
        <div class="comment_all">
          <ul class="common-list">
            <?php
    if(count($events)!=0){
      foreach($events as $newsval){
    ?>
            <li class="common-list-item "> <a onclick="getSingleEvent('<?php echo $newsval['id'];?>')"
  target="_blank"  class="common-list-button is-ads">
              <div class="image"><img src="<?php echo base_url()."/".$newsval['image'];?>" width="115" alt=""></div>
              <div class="text event_rightside">
                <h2><?php echo $newsval['name'];?></h2>
                <h4><?php echo $newsval['details'];?></h4>
                <p class="ads-url">See More </p>
                <div class="going_p"> <span > <?php echo $newsval['event_attend'];?> Going </span> </div>
              </div>
              </a> </li>
            <?php
      }
    }
     ?>
          </ul>
          <button class="common-more">
          <a href="<?php echo base_url();?>/user/event"><span class="text">See More</a></span>
          </button>

        </div>
      </section>
    </aside>
     </div>
  <?php echo  $this->include('user/templates/footer_template'); ?>
</main>
<div class="modal fade add_custom_field_pop" id="modal_001" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-sm">
            <div class="modal-header bg-theme-primary-dark">
                <h5 class="modal-title" id="exampleModalLongTitle">User Menu</h5>

                <button type="button" onclick="$('#modal_001').modal('hide')" class="close-video" data-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col"></div>
                    <div class="col">
                        <a class="w3-button w3-large w3-purple w3-round-xlarge m-2" href="/user/profile">User Profile <i class="fa-solid fa-user ms-2"></i></a>
                        <a class="w3-button w3-large w3-purple w3-round-xlarge m-2" href="/user/profile-edit">Edit Profile <i class="fa-solid fa-pencil ms-2"></i></a>
                        <a class="w3-button w3-large w3-red w3-round-xlarge m-2" href="/user/logout">User Logout <i class="fa-solid fa-right-from-bracket ms-2"></i></a>
                    </div>
                    <div class="col"></div>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="purchaseSubscriptionModal" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Subscription Limits exceed</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                You can post upto <?=$current_subscription->subscription->data->recipe?> Recipe in your
                <b><?=$current_subscription->subscription->title?> Membership</b> ! Please upgrade your plan to increase limits.
            </div>
            <div class="modal-footer">
                <a type="button" class="btn btn-success" href="/subscription/list">See Plans</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!--<script src="--><?php //echo $public_url;?><!--js/bootstrap.min.js"></script> -->

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
	<script src='<?php echo $public_url;?>js/owl.carousel.min.js'></script>
<script>
  $(document).ready(function() {

  $("#owl-demo").owlCarousel({

      autoPlay: 3000, //Set AutoPlay to 3 seconds

      items : 4,
      itemsDesktop : [1199,3],
      itemsDesktopSmall : [979,3]

  });

});
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





function hidepopup(){
      $("#showmodel").css('display','none');
}
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
 <?php
$key="AIzaSyBlf2VfOx5bL5rwlTP4hG5luZxZaLV6xEI";
$googleWeb="https://maps.googleapis.com/maps/api/js";
$googleAddress=$googleWeb."?key=".$key."&libraries=places&callback=initMap";
?>
<script src="<?php echo $googleAddress;?>"   async defer></script>
<script>
function initMap() {
  var input = document.getElementById('location');
  var autocomplete = new google.maps.places.Autocomplete(input);
}
</script>
<script>
    function checkLimit() {
        var ispermitted=<?=($current_subscription->usage['recipe'] < $current_subscription->subscription->data->recipe)?'true':'false'?>;
        if (!ispermitted){
            $("#purchaseSubscriptionModal").modal('show')
        }
        return ispermitted
    }
 var spinner = $('#loader');
 jQuery("#ReceipeeForm").submit('on',function(e){
	 var detail = CKEDITOR.instances['detail'].getData();
      var steps = CKEDITOR.instances['steps'].getData();
	 var ingredients = CKEDITOR.instances['ingredients'].getData();
	 $("#detail").val(detail);
      $("#steps").val(steps);
	 $("#ingredients").val(ingredients);
					e.preventDefault();
					spinner.show();
					jQuery('#ErrorMessage').html('');

					var form = $('#ReceipeeForm')[0];
					var form_data = new FormData(form);
			     	jQuery.ajax({
					  dataType : "json",
					  type : "post",
					  cache: false,
					  contentType: false,
					  processData: false,
					  data : form_data,
					  url: jQuery('#ReceipeeForm').attr('action'),
					  success:function(data)
							{
								//console.log(data);
								//jQuery("#element_overlap").LoadingOverlay("hide", true);
								$('#ReceipeeForm')[0].reset();
								spinner.hide();
								$('#myModal2').modal({ backdrop: 'static' });
								$('#adddReceipeModal').modal('hide');
								if(data.code == 400) { $('#ErrorMessage').html(data.error); }
 								if(data.status == 0)
								{
								  jQuery('#ErrorMessage').html(data.msgblog);
								}
								if(data.status == 1)
								{
 									  jQuery('#ErrorMessage').html(data.msgblog);
									  jQuery('#ReceipeeForm').trigger('reset');
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
  function getSinglerecipesall(id){

  $.ajax({
    url:'<?php echo base_url();?>/user/user-recipe-single/'+id,
    type:'GET',
    success:function(data){
      console.log(data);
      $("#showmodel").css('display','block');
      $("#showmodel").html(data);
      $('#add_custom_blog').modal('show');
	   $('.owl-carousel').owlCarousel({
     // loop:true,
    margin:5,
    nav:true,
    navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
      // autoplay:true,
      // autoplayTimeout:2000,
       dots: false,
    responsive:{
        0:{
            items:1
        },
        400:{
            items:2
        },
        800:{
            items:3
        }
    }
});
    },
    error:function(e){

    }
  });
  }
  function submitrecipecomments(){
	const form = document.querySelector('#recipecommentform');
	//$('#loading').show();
  var messagecomments=document.getElementById('messagecomments').value;
  if(messagecomments==''){
	  alert("Please enter message");
	  return false;
  }
  $.ajax({
         url: "<?php echo base_url();?>/user/user-recipe-insert-comments",
   type: "POST",
   data:  new FormData(form),
   contentType: false,
         cache: false,
   processData:false,
   beforeSend : function()
   {
   },
   success: function(data)
      {

		  alert('Comments submit');
		 $('.commentList').prepend(data);
		  //$('#aftercomments').html(data);

		  document.getElementById('messagecomments').value='';
		 //$(".commentList").animate({ scrollTop: $(".commentList")[0].scrollHeight}, 1000);
		 $(".commentList").animate({ scrollTop: 0}, 1000);

		  return false;

      },
     error: function(e)
      {
		  $('#loading').hide();

      }
    });

}
function showoldercomments(id){
	$.ajax({
         url: "<?php echo base_url();?>/user/user-recipe-old-comments",
   type: "POST",
   data:  'id='+id,
   beforeSend : function()
   {
   },
   success: function(data)
      {
		 //$('.aftercomments').after(data);
		 $('#viewold').css('display','none');
		 $('.commentList').append(data);
		 $('.commentList').css({"overflow-y": "scroll", "height": "300px", "width": "100%"});
		  return false;

      },
     error: function(e)
      {
		  $('#loading').hide();

      }
    });
}
</script>
<script src="<?php echo  $public_url_bower;?>bower_components/ckeditor/ckeditor.js"></script>
<script>
 $(function () {
    CKEDITOR.replace('detail')
  })
  $(function () {
    CKEDITOR.replace('ingredients')
  })
  $(function () {
    CKEDITOR.replace('steps')
  })
</script>
<script src="<?php echo base_url();?>/public/frontend/js/jquery.marquee.js"></script>
<script src="<?php echo base_url();?>/public/frontend/js/jquery.marquee.min.js"></script>
<script type="text/javascript">

    $(document).ready(function () {
        $('.marquee').marquee({
            duration: 5000,
            gap: 10,
            direction: 'up',
            duplicated: true,
			pauseOnHover:true
        });

    });
</script>
</body>
</html>