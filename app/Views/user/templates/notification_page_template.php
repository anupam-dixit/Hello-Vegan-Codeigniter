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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<link href="<?php echo $public_url;?>css/style.css" rel="stylesheet">
<link href="<?php echo $public_url;?>css/home_page.css" rel="stylesheet">
<link href="<?php echo $public_url;?>css/chat.css" rel="stylesheet">
<link href="<?php echo $public_url;?>css/responsive.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <link href="<?php echo $public_url;?>css/group.css" rel="stylesheet" />
<link href="<?php echo $public_url;?>css/jd.css" rel="stylesheet" />
    <link href="<?=base_url()?>/public/pitesh/css/custom.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
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

      <section class="common-section">
        <div class="notfy">
          <?php 
    echo  $this->include('user/templates/show_logout'); ?>
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
   <span id="showmodel" style="display:none"></span>
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

</main>
 <span id="showmodel" style="display:none"></span> 
<!-- Include all compiled plugins (below), or include individual files as needed -->

<script src="<?php echo $public_url;?>js/group.js" ></script> 
<!--<script src="--><?php //echo $public_url;?><!--js/jd.js" ></script>-->
<script>
var main = function() {
  $('.notification img').click(function() {
    $('.notification-menu').toggle(); 
  }); 
  
  $('.post .btn').click(function() {
    $(this).toggleClass('btn-like'); 
  }); 
}; 
$(document).ready(main); 





</script>
<script src='<?php echo base_url().'/public/frontend/';?>js/owl.carousel.min.js'></script>

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


 /* $(document).ready(function() {
  $(".notification-drop .item").on('click',function() {
    $(this).find('ul').toggle();
  });
}); */
    
    
    </script>
    <span id="showmodel" style="display:none"></span> 
</body>
</html>