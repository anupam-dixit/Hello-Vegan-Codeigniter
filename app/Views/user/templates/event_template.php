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
$baseurl=base_url()."/";
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
<link rel='stylesheet' href='<?php echo $public_url;?>css/owl.carousel.min.css'>
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<script src="<?php echo  $public_url_bower;?>bower_components/ckeditor/ckeditor.js"></script>
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
              <p class="ads-url">See More </p>
            </div>
            </a> </li>
          <?php 
            }
        }
         ?>
        </ul>
        <button class="common-more">
        <a href="<?php echo base_url();?>/user/news"><span class="text">See More</a></span>
        </button>
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
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<!--<script src="--><?php //echo $public_url;?><!--js/bootstrap.min.js"></script> -->
<script src='<?php echo $public_url;?>js/owl.carousel.min.js'></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

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



function submitblogcomments(id){
  const form = document.querySelector('#postcommentform_'+id);

  //$('#loading').show();
  var messagecomments=document.getElementById('messagecomments_'+id).value;
  if(messagecomments==''){
    alert("Please enter message");
    return false;
  }
  $.ajax({
         url: "<?php echo base_url();?>/user/blog/insert-blog-comment",
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





function submitEventcomments(){
  const form = document.querySelector('#blogcommentform');
  //$('#loading').show();
  var messagecomments=document.getElementById('messagecomments').value;
  if(messagecomments==''){
    alert("Please enter message");
    return false;
  }
  $.ajax({
         url: "<?php echo base_url();?>/user/event/insert-comment",
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



// function submitEventGoing(id){
//   const form = document.querySelector('#blogcommentform'); 
//   $.ajax({

//     // url: "https://hello-vegans.com/user/insert-event-going/"+id,
//          url: "https://hello-vegans.com/user/event/going/insert",
//    type: "POST",
//     data:  new FormData(form),
//    // data:  'id='+id,
//    contentType: false,
//          cache: false,
//    processData:false,
//    beforeSend : function()
//    {
//    },
//    success: function(data)
//       {    
//      alert('Event Going');
//      $('.commentList').prepend(data);
//      $(".commentList").animate({ scrollTop: 0}, 1000);
     
//       return false;
    
//       },
//      error: function(e) 
//       {
//       $('#loading').hide();

//       }          
//     });
// }

function submitEventGoingUpdate(id){
  const form = document.querySelector('#blogcommentform'); 
  $.ajax({

    // url: "https://hello-vegans.com/user/insert-event-going/"+id,
         url: "https://hello-vegans.com/user/event/going/update",
   type: "POST",
    data:  new FormData(form),
   // data:  'id='+id,
   contentType: false,
         cache: false,
   processData:false,
   beforeSend : function()
   {
   },
   success: function(data)
      {    
     alert('Event Going');
     $('.commentList').prepend(data);
     $(".commentList").animate({ scrollTop: 0}, 1000);
     
      return false;
    
      },
     error: function(e) 
      {
      $('#loading').hide();

      }          
    });
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
</style>
</body>
</html>