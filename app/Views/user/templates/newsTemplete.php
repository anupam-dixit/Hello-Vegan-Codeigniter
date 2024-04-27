<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>Hello-Vegans</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />


<link href="owl.carousel.css" rel="stylesheet">
<link href="owl.theme.css" rel="stylesheet">
<!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <!--<link href="--><?php //echo base_url().'/public/frontend/';?><!--css/bootstrap.css" rel="stylesheet">-->
<link href="<?php echo base_url().'/public/frontend/';?>css/style.css" rel="stylesheet">
<link href="<?php echo base_url().'/public/frontend/';?>css/home_page.css" rel="stylesheet">
<link href="<?php echo base_url().'/public/frontend/';?>css/responsive.css" rel="stylesheet">
<link href="<?php echo base_url().'/public/frontend/';?>css/userme.css" rel="stylesheet">
    <link href="<?=base_url()?>/public/pitesh/css/custom.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
<link rel='stylesheet' href='<?php echo base_url().'/public/frontend/';?>css/owl.carousel.min.css'>
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
      <script src="<?php echo  base_url().'/public/';?>bower_components/ckeditor/ckeditor.js"></script>
      <style> #owl-demo .item{
  margin: 3px;
}
 .owl-carousel .owl-nav button.owl-prev{
   color: grey; !important;
   position: absolute;
   top: 30%;
   left: 0;
   font-size: 30px;
   background: no-repeat 50% / 100% 100% !important;
 }
 .owl-carousel .owl-nav button.owl-next{
  color: grey !important;
  font-size: 30px;
  position: absolute;
   top: 30%;
   right: 10px;
   background: no-repeat 50% / 100% 100% !important;

 }
/*.owl-carousel{
   width: 50% !important;
   display: block;
}*/

/*.slider-section {
    width: 50% !important%;
    float: left;
}*/
/*.owl-carousel.owl-drag .owl-item {
 width: 200px !important;
 height: 300px ! !important;
}*/
.owl-stage {
  width: 700% !important;
  display: block;
  transform: translate3d(-460px, 0px, 0px);
    transition: all 0s ease 0s;

    
}
/*#owl-demo .item img{
  display: block;
  width: 100%;
  height: auto;
} */ </style>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
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
        <h2 class="section-title">Category</h2>
	 
        <div class="blog_sidebar">
          <ul>
            <!-- <h2 class="section-title">Topic </h2> -->
             <?php
      foreach($news_category as $cats){
      ?>
      <li><a href="<?php echo base_url();?>/user/news/category/<?php echo $cats['id'];?>"><?php echo $cats['name'];?></a></li>
            <?php 
      }
      ?>
         
          </ul>
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

         <section class="common-section">
        <h2 class="section-title">Blog</h2>
        <div class="todaystripe">
          <ul class="marquee">
            <?php 
    if(count($blogdashboard)!=0){
      foreach($blogdashboard as $blogval){
    ?>
            <li> <a onclick="getSingleblog('<?php echo $blogval['id'];?>')">
              <div class="images_blog"> <img src="<?php echo base_url()."/".$blogval['image'];?>">
                <div class="images_text">
                  <div class="caption">
                    <div class="news_logo_icon"><img src="<?php echo base_url().'/public/frontend/';?>images/news_logo_icon.png"/><span><?php echo $blogval['title'];?></span></div>
                    <h2><?php echo $blogval['content']; ?> </h2>
                    <header class="common-post-header u-flex"> <img src="<?php echo base_url().'/public/frontend/';?>images/smile_icon.png" class="user-image" width="20" height="20" alt="">
                      <button class="icon-button-2 u-margin-inline-start" aria-label="more options"><span class="icon-menu"></span></button>
                    </header>
                  </div>
                </div>
              </div>
              </a> </li>
            <?php }} ?>
          </ul>
        </div>
      </section>
    </aside>
          
     </div>
  <?php echo  $this->include('user/templates/footer_template'); ?>
</main>

 <div class="modal fade" id="addNewsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
  <form action="<?php echo base_url('user/news/insert-news');?>" method="post" enctype="multipart/form-data" id="newsForm" name="newsForm"> 
    <div class="modal-content model_add_event">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add News</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="row" style="margin-right: 0;margin-left: 0;">
            
              
              <!--col-sm-6-->
              
              <div class="col-md-12 col-sm-6 col--12 right-side">
              
              <?php if(session()->getFlashdata('msgnews')):?>
                    <div class="alert alert-success">
                       <p><?= session()->getFlashdata('msgnews') ?></p>
                    </div>
      <?php endif;?>
          
                 
                <!--Form with header-->
                <div class="form">
				<div class="form-group">
                    <label>Topic</label>
					<select name="post_category_id" id="post_category_id" class="form_control_event">
					  <option value="">Select Topic</option>
					<?php
                     foreach($news_category as $val){
					?>
					<option value="<?php echo $val['id'];?>"><?php echo $val['name'];?></option>
                    <?php					
					}
					?>
					</select>
                  </div>
 
				  <div class="form-group">
				   <label>Title</label>
                    <input type="hidden" id="video" name="video" class="form_control_event" placeholder="Video" >
                    <input type="text" id="title" name="title" class="form_control_event" placeholder="Title" >
                  </div>
                  <div class="form-group">
                    <label>Location</label>
					<input type="text" id="location" name="location" class="form_control_event" placeholder="Location" >
                  </div>
				  
				  <div class="form-group">
				  <label>Image</label>
                    <input type="file" id="image" name="image" class="form_control_event" placeholder="Image" >
                  </div>
				  <div class="form-group">
				  <label>Details</label>
                    <textarea  id="details" name="details" class="form_control_event" placeholder="Description"></textarea>
                  </div>
                  <div class="text-xs-center"> 
				 <a  class="btn loginbutton "> <input style="background:none;border:none;color:#fff" type="submit" name="submit" id="submit" value="Submit"><span>
				    <img style="display:inline" src="<?php echo base_url().'/public/frontend/';?>images/back_arrow.svg" alt="img">
				  </span></a>
				  </div>
			
                  
                </div>
                <!--/Form with header--> 
                
              </div>
              <!--col-sm-6-->
              
             
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="sumbit_event close_event" data-dismiss="modal">Close</button> &nbsp;  &nbsp;
        <button type="submit" class="sumbit_event">Save changes</button>
      </div>
    </div>
		  </form>
  </div>
</div>
<div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog modal-sm">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" onclick="location.reload()" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="document_name">Message</h4>
        </div>
        <div class="modal-body">
                 <div id="ErrorMessage" style="text-align:center;margin-bottom:13px;">
                     
                </div>
         </div>
        <div class="modal-footer">
          <button type="button" onclick="location.reload()" class="sumbit_event close_event" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
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
  <div id="loader"></div>
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
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<!--<script src="--><?php //echo base_url().'/public/frontend/';?><!--js/bootstrap.min.js"></script> -->
<script src='<?php echo base_url().'/public/frontend/';?>js/owl.carousel.min.js'></script> 

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="owl-carousel/owl.carousel.js"></script> 

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

// $(document).ready(function() {
 
//   $("#owl-demo").owlCarousel({
 
//       autoPlay: 3000, //Set AutoPlay to 3 seconds
 
//       items : 4,
//       itemsDesktop : [1199,3],
//       itemsDesktopSmall : [979,3]
 
//   });
 
// });

    
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
})
    
    
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

      function eventNotintersted(id){
    $.ajax({
         url: "<?php echo base_url();?>/user/event/not-intersted",
   type: "POST",
   data:  'event_id='+id,
   beforeSend : function()
   {
   },
   success: function(data)
      {

      alert('Event Not Intersted');
     $('.commentList').prepend(data);
     $(".commentList").animate({ scrollTop: 0}, 1000);
     
      return false;
      },
     error: function(e) 
      {

      }          
    });
  }




function submitEventGoing(id,status){
    $.ajax({
         url: "<?php echo base_url();?>/user/event/going/insert",
   type: "POST",
   data:  'event_id='+id+'&status='+status,
   beforeSend : function()
   {
   },
   success: function(data)
      {

    if(status==1){
      document.getElementById('going_'+id).style.display="none";
      document.getElementById('notGoing_'+id).style.display="block";
    }else{
      document.getElementById('going_'+id).style.display="block";
      document.getElementById('notGoing_'+id).style.display="none";
    }
    
    
      },
     error: function(e) 
      {

      }          
    });
  }



      function getSingleEvent(id){
  $.ajax({
    url:'/user/get-single-event/'+id,
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


       


function getSingleblog(id){
  $.ajax({
    url:'https://hello-vegans.com/user/get-single-blog/'+id,
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
 
      </script>
      
<script>
 $(function () {
    CKEDITOR.replace('details')
  })

function newformsubmit(newsformid,newsmodalid){

	var spinner = $('#loader');
					spinner.show();
					jQuery('#ErrorMessage').html('');
				
					var form = $('#'+newsformid)[0];
					var form_data = new FormData(form);
			     	jQuery.ajax({
					  dataType : "json",
					  type : "post",
					  cache: false,
					  contentType: false,
					  processData: false,
					  data : form_data,
					  url: jQuery('#'+newsformid).attr('action'),
					  success:function(data)
							{
								//console.log(data);
								//jQuery("#element_overlap").LoadingOverlay("hide", true);
								$('#'+newsformid)[0].reset();
								spinner.hide();
								$('#myModal2').modal({ backdrop: 'static' });
								$('#'+newsmodalid).modal('hide');
								if(data.code == 400) { $('#ErrorMessage').html(data.error); }
 								if(data.status == 0)
								{
								  jQuery('#ErrorMessage').html(data.msgcomments);
								}
								if(data.status == 1)
								{
 									  jQuery('#ErrorMessage').html(data.msgcomments);
									  jQuery('#'+newsmodalid).trigger('reset');
 								}
 					  },
					  error: function (jqXHR, status, err) {
						//  alert();
						spinner.hide();
						  jQuery('#ErrorMessage').html("Local error callback.");
 					  }
				
					});
	return false;	
}
	
					
function submitEventcomments(id){
  const form = document.querySelector('#postcommentform_'+id);

  //$('#loading').show();
  var messagecomments=document.getElementById('messagecomments_'+id).value;
  if(messagecomments==''){
    alert("Please enter message");
    return false;
  }
  $.ajax({
         url: "<?php echo base_url();?>/user/insert-event-comment-user",
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
     
     // alert('Comments submit');
     $('.commentList_'+id).prepend(data);
     var cnts=parseInt($("#cnt_"+id).html());
     cnts+=1;
     $("#cnt_"+id).html(cnts);
      document.getElementById('messagecomments_'+id).value='';
     $(".commentList"+id).animate({ scrollTop: 0}, 1000);
      return false;
    
      },
     error: function(e) 
      {
      $('#loading').hide();

      }          
    });
  return false;

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
  background: rgba(0,0,0,0.75) url(<?php echo base_url()."/";?>public/frontend/images/ajax-loader.gif) no-repeat center center;
  z-index: 10000;
}
</style>
</body>
</html>