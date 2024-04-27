<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>Hello-Vegans</title>
    <?php use App\Models\SubscriptionPurchaseModel;

    $sm = new SubscriptionPurchaseModel();
    $current_subscription = $sm->userActiveSubscription($session->get('idUserH'));

    ?>
<!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel='stylesheet' href='<?php echo base_url().'/public/frontend/';?>css/owl.carousel.min.css'>
   <style> #owl-demo .item{
  margin: 3px;
}
#owl-demo .item img{
  display: block;
  width: 100%;
}  </style>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
      <script src="<?php echo  base_url().'/public/';?>bower_components/ckeditor/ckeditor.js"></script>
      
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
        <h2 class="section-title"><?=lang('app.global.category')?></h2>
		<div class="blog_sidebar">
          <ul>
            <?php
			
      foreach($blog_category as $cats){
		  $month=$cats['BlogMonth'];
		  $monthname=$cats['BlogMonthName'];
		  $year=$cats['BlogYear'];
      ?>
      <li><a href="<?php echo base_url();?>/user/blog/category/<?php echo $month;?>/<?php echo $year; ?>"><?php echo $monthname.' '.$year;?></a></li>
            <?php 
      }
      ?>
          </ul>
        </div>
      </section>
        <section class="common-section">
        <h2 class="section-title"><?=lang('app.profile.events')?></h2>
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
                <p class="ads-url"><?=lang('app.global.see_more')?> </p>
                <div class="going_p"> <span > <?php echo $newsval['event_attend'];?> Going </span> </div>
              </div>
              </a> </li>
            <?php 
      }
    }
     ?>
          </ul>
          <button class="common-more">
          <a href="<?php echo base_url();?>/user/event"><span class="text"><?=lang('app.global.see_more')?></a></span>
          </button>
          
        </div>
      </section>
         <section class="common-section ">
        <h2 class="section-title">News</h2>
        <ul class="common-list marquee">
          <?php 
        if(count($newsall)!=0){
            foreach($newsall as $newsval){
        ?>
          <li class="common-list-item "> <a href="<?php echo base_url();?>/user/news/details/<?php echo $newsval['id'];?>" target="_blank" class="common-list-button is-ads">
            <div class="image"><img src="<?php echo base_url()."/".$newsval['image'];?>" width="115" alt=""></div>
            <div class="text">
              <h4 class="ads-title"><?php echo $newsval['content'];?></h4>
              <p class="ads-url"><?=lang('app.global.see_more')?> </p>
            </div>
            </a> </li>
          <?php 
            }
        }
         ?>
        </ul>
        <button class="common-more">
        <a href="<?php echo base_url();?>/user/news"><span class="text"><?=lang('app.global.see_more')?></a></span>
        </button>
      </section>
    </aside>
     </div>
  <?php echo  $this->include('user/templates/footer_template'); ?>
</main>
 <span id="showmodel" style="display:none"></span>  
<div class="modal fade" id="addBlogModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
  <form onsubmit="return checkLimit()" action="<?php echo base_url('user/blog/insert-blog');?>" method="post" enctype="multipart/form-data" id="blogForm" name="blogForm">
    <div class="modal-content model_add_event">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?=lang('app.profile._7')?></h5>
      </div>
      <div class="modal-body">
       <div class="row" style="margin-right: 0;margin-left: 0;">
            
              
              <!--col-sm-6-->
              
              <div class="col-md-12 col-sm-6 col--12 right-side">
              
              <?php if(session()->getFlashdata('msgblog')):?>
                    <div class="alert alert-success">
                       <p><?= session()->getFlashdata('msgblog') ?></p>
                    </div>
      <?php endif;?>
          
                 
                <!--Form with header-->
                <div class="form">
				
 
				  <div class="form-group">
				   <label>Title</label>
                    <input type="hidden" id="video" name="video" class="form_control_event" placeholder="Video" >
                    <input type="text" id="title" name="title" class="form_control_event" placeholder="Title" >
                  </div>

                

                <div class="form-group">
            <label><?=lang('app.global.category')?></label>
              
                  <select name="post_category_id" class="form_control_event form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                  <option >Select Category</option>
          <?php 
          foreach($categories as $val){
            ?>
          <option  
          value="<?php echo $val['id'];?>"><?php echo $val['name'];?></option>
                  <?php
                  }         
                  ?>          
          
                </select>
                </div>

                <div class="form-group">
                 <label>Tags</label>
                   
                    <input type="text" id="tags" name="tags" class="form_control_event" placeholder="Tags" >
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
          <label>Add Gallery Image</label>
                    <input type="file" multiple onchange="return valueonchange(this.id)"  id="galleryimage" name="galleryimage[]" class="form_control_event" placeholder="Gallery Image" >
          </div>

           <div class="form-group">
          <label>Video</label>
                    <input type="file"   class="form_control_event" name="videofile" id="videofile">
          </div>




				  <div class="form-group">
				  <label>Details</label>
                    <textarea  id="detail"  name="detail" class="form_control_event" placeholder="Description"></textarea>
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
        <button type="button" class="sumbit_event close_event" onclick="$('.modal').modal('hide')"><?=lang('app.global.close')?></button> &nbsp;  &nbsp;
        <button type="submit" class="sumbit_event"><?=lang('app.global.save')?></button>
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
          <h4 class="modal-title" id="document_name"><?=lang('app.global.message')?></h4>
        </div>
        <div class="modal-body">
                 <div id="ErrorMessage" style="text-align:center;margin-bottom:13px;">
                     
                </div>
         </div>
        <div class="modal-footer">
          <button type="button" onclick="location.reload()" class="sumbit_event close_event" data-dismiss="modal"><?=lang('app.global.close')?></button>
        </div>
      </div>
      
    </div>
  </div>
  <div id="loader"></div>


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
                You can post upto <?=$current_subscription->subscription->data->blog?> Blogs in your
                <b><?=$current_subscription->subscription->title?> Membership</b> ! Please upgrade your plan to increase limits.
            </div>
            <div class="modal-footer">
                <a type="button" class="btn btn-success" href="/subscription/list">See Plans</a>
            </div>
        </div>
    </div>
</div>

<script src='<?php echo base_url().'/public/frontend/';?>js/owl.carousel.min.js'></script> 
<script>
    /*JS isn't my expertise 😉*/
function checkLimit() {
    var ispermitted=<?=($current_subscription->usage['blog'] < $current_subscription->subscription->data->blog)?'true':'false'?>;
    if (!ispermitted){
        $("#purchaseSubscriptionModal").modal('show')
    }
    return ispermitted
}
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

      $(document).ready(function() {
 
  $("#owl-demo").owlCarousel({
 
      autoPlay: 3000, //Set AutoPlay to 3 seconds
 
      items : 4,
      itemsDesktop : [1199,3],
      itemsDesktopSmall : [979,3]
 
  });
 
});


      
function getSingleblog(id){
  $.ajax({
    url:'<?php echo base_url();?>/user/get-single-blog/'+id,
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

  function getSinglerecipes(id){
  $.ajax({
    url:'<?php echo base_url();?>/user/get-single-recipes/'+id,
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

 var spinner = $('#loader');
 jQuery("#blogForm").submit('on',function(e){
	var detail = CKEDITOR.instances['detail'].getData();
	 $("#detail").val(detail);
	 
					e.preventDefault();
					spinner.show();
					jQuery('#ErrorMessage').html('');
					
					var form = $('#blogForm')[0];
					var form_data = new FormData(form);
			     	jQuery.ajax({
					  dataType : "json",
					  type : "post",
					  cache: false,
					  contentType: false,
					  processData: false,
					  data : form_data,
					  url: jQuery('#blogForm').attr('action'),
					  success:function(data)
							{
								//console.log(data);
								//jQuery("#element_overlap").LoadingOverlay("hide", true);
								$('#blogForm')[0].reset();
								spinner.hide();
								$('#myModal2').modal({ backdrop: 'static' });
								$('#addBlogModal').modal('hide');
								if(data.code == 400) { $('#ErrorMessage').html(data.error); }
 								if(data.status == 0)
								{
								  jQuery('#ErrorMessage').html(data.msgblog);
								}
								if(data.status == 1)
								{
 									  jQuery('#ErrorMessage').html(data.msgblog);
									  jQuery('#blogForm').trigger('reset');
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
    CKEDITOR.replace('detail')
  })
</script>
<script>
function showoldercomments(id){
	$.ajax({
         url: "<?php echo base_url();?>/user/blog/show-older-comment",
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

function submitblogcomments(){
	const form = document.querySelector('#blogcommentform');
	//$('#loading').show();
  var messagecomments=document.getElementById('messagecomments').value;
  if(messagecomments==''){
	  alert("Please enter message");
	  return false;
  }
  $.ajax({
         url: "<?php echo base_url();?>/user/blog/post/insert-comment",
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
<style> #owl-demo .item{
  margin: 3px;
}
 .owl-carousel .owl-nav button.owl-prev{
   color: darkcyan; !important;
   position: absolute;
   top: 30%;
   left: 0;
   font-size: 30px;
   background: no-repeat 50% / 100% 100% !important;
 }
 .owl-carousel .owl-nav button.owl-next{
  color: darkcyan !important;
  font-size: 30px;
  position: absolute;
   top: 30%;
   right: 10px;
   background: no-repeat 50% / 100% 100% !important;

 }


.owl-stage {
  width: 700% !important;
  display: block;
  transform: translate3d(-460px, 0px, 0px);
    transition: all 0s ease 0s;

    
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
<script src="<?php echo base_url();?>/public/frontend/js/jquery.marquee.js"></script>
<script src="<?php echo base_url();?>/public/frontend/js/jquery.marquee.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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
  #loading {
  position: fixed;
  display: none;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  text-align: center;
  opacity: 0.7;
  background-color: #fff;
  z-index: 99;
}

#loading-image {
  position: absolute;
  top: 100px;
  left: 577px;
  z-index: 100;
}


  </style>
</body>
</html>