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
<!--<link href="--><?php //echo $public_url;?><!--css/bootstrap.css" rel="stylesheet">-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<link href="<?php echo $public_url;?>css/style.css" rel="stylesheet">
<link href="<?php echo $public_url;?>css/home_page.css" rel="stylesheet">
<link href="<?php echo $public_url;?>css/responsive.css" rel="stylesheet">
<link href="<?php echo $public_url;?>css/userme.css" rel="stylesheet">
    <link href="<?=base_url()?>/public/khalid/css/custom.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel='stylesheet' href='<?php echo $public_url;?>css/owl.carousel.min.css'>
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
      <script src="<?php echo  $public_url_bower;?>bower_components/ckeditor/ckeditor.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
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
      foreach($product_category as $cats){
      ?>
      <li><a href="#"><?php echo $cats['name'];?></a></li>
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
          <!-- <h2 class="section-title">Events</h2>
         <div class="events">
         <div class="events_images">
     <?php 
             if(count($event_latest)!=0){
      ?>
      <a href="<?php echo base_url();?>/user/event"><img src="<?php echo base_url().'/'.$event_latest['image'];?>"></a>
            <?php       
       }else{
        ?> 
      <img src="<?php echo base_url().'/public/frontend/';?>images/events_images.jpg">  
       <?php
       }
      ?>
         
         <div class="live_text">
         <div class="live_bg">
         <div class="live_left">
         <h2>Live</h2>
         <h3><i class="fa fa-users" aria-hidden="true"></i> 3K People</h3></div>
         <div class="live_right">
         <a href="#"><img src="<?php echo base_url().'/public/frontend/';?>images/share.png"></a>
         <a href="#"><img src="<?php echo base_url().'/public/frontend/';?>images/close.png"></a>
         </div>
         </div>
         </div>
         
         </div> --> 
          
          <!--      <div class="commnet_events">
       <ul class="commentList_<?php echo $event_latest['id'];?>">
 <?php 
            if(count($event_comment)!=0){
      foreach($event_comment as $comment){
      if($comment['users_profile_image']==''){
        $imagesrc=base_url().'/public/frontend/images/f_icon_user.jpg';
      }else{
       $imagesrc=base_url()."/".$comment['users_profile_image']; 
      }
      ?>

         <li><span><img src="<?php echo $imagesrc ;?>"></span><p><?php echo $comment['message'];?></p> <div class="time_commnet"><?php echo date('h:i ',strtotime($comment['created_at']));?></div></li>

  <?php 
      }
    }
     ?> 
  </ul>
         <div class="comment_input">
         <div class="search-box-wrapper">
          <form class="form-inline" role="form" method="post" id="postcommentform_<?php echo $event_latest['id'];?>" name="postcommentform" onsubmit="return submitEventcomments('<?php echo $event_latest['id'];?>')">
           <input type="hidden" class="" id="commented_by"  name="commented_by"  value="<?php echo $_SESSION['idUserH'];?>" size="30" aria-required="true">
                  <input type="hidden" class="" id="post_id" name="post_id"  value="<?php echo $event_latest['id'];?>" size="30" aria-required="true">

            <input type="search" name="message" id="messagecomments_<?php echo $event_latest['id'];?>" class="search-box" placeholder="Comment">
             <span class="icon-search" aria-label="hidden"><img src="<?php echo base_url().'/public/frontend/';?>images/chat_input.png"></span> 
                <span class="focus-border" onclick="submitEventcomments('<?php echo $event_latest['id'];?>')"></span>
          </form> 
        </div>
       </div>
         </div> --> 
          
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
    </aside>
     </div>
  <?php echo  $this->include('user/templates/footer_template'); ?>
</main>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<!--<script src="--><?php //echo $public_url;?><!--js/bootstrap.min.js"></script> -->
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
      
function getSingleProduct(id){
  $.ajax({
    url:'https://hello-vegans.com/user/get-single-product/'+id,
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
      
<script>
 $(function () {
    try {
        CKEDITOR.replace('details')
    } catch (e) {
        // console.log(e)
    }
  })
var spinner = $('#loader');
 jQuery("#newsForm").submit('on',function(e){
  
          e.preventDefault();
          spinner.show();
          jQuery('#ErrorMessage').html('');
          
          var form = $('#newsForm')[0];
          var form_data = new FormData(form);
            jQuery.ajax({
            dataType : "json",
            type : "post",
            cache: false,
            contentType: false,
            processData: false,
            data : form_data,
            url: jQuery('#newsForm').attr('action'),
            success:function(data)
              {
                //console.log(data);
                //jQuery("#element_overlap").LoadingOverlay("hide", true);
                $('#newsForm')[0].reset();
                spinner.hide();
                $('#myModal2').modal({ backdrop: 'static' });
                $('#addNewsModal').modal('hide');
                if(data.code == 400) { $('#ErrorMessage').html(data.error); }
                if(data.status == 0)
                {
                  jQuery('#ErrorMessage').html(data.msgnews);
                }
                if(data.status == 1)
                {
                    jQuery('#ErrorMessage').html(data.msgnews);
                    jQuery('#newsForm').trigger('reset');
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