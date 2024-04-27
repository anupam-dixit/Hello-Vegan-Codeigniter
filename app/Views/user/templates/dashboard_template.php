<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Hello-Vegans</title>
<!-- Bootstrap -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<link href="<?php use App\Models\SubscriptionPurchaseModel;

$sm = new SubscriptionPurchaseModel();
$current_subscription = $sm->userActiveSubscription($session->get('idUserH'));

echo base_url().'/public/frontend/';?>css/style.css" rel="stylesheet">
<link href="<?php echo base_url().'/public/frontend/';?>css/home_page.css" rel="stylesheet">
<link href="<?php echo base_url().'/public/frontend/';?>css/responsive.css" rel="stylesheet">
<link href="<?=base_url()?>/public/pitesh/css/custom.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<style>
#owl-demo .item {
	margin: 3px;
}
#owl-demo .item img {
	display: block;
	width: 100%;
}
body {
    direction: <?=lang('app.global.direction')?>;
}
.nav_crumb{
    margin-top: 12px !important;
}
</style>
</head>
<body>
<main>
  <button class="icon-button e-dark-mode-button u-animation-click" id="darkMode" aria-label="Dark Mode"><span class="icon" aria-hidden="true">🌜</span></button>
  <div class="common-structure"> <?php echo  $this->include('user/templates/common_left_menu_dashboard_template'); ?>
      <?= $this->renderSection('content') ?>
    <aside class="side-b">
      <section class="common-section user_right_homepage">
        <div class="notfy">
          <?php
	  echo  $this->include('user/templates/show_logout'); ?>
        </div>
      </section>
      <section class="common-section">
        <h2 class="section-title"><?=lang('app.global.events')?></h2>
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
        <h2 class="section-title"><?=lang('app.global.news')?></h2>
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
      <section class="common-section">
        <h2 class="section-title">Friends</h2>
        <div class="common-sectionchat">
          <div id="chat-bar">
            <div id="cts">
              <?php
			  if(count($userfriend)!=0){
				  foreach($userfriend as $val){
				?>

              <div class="on-ct active jd-online_user_right" id="<?php echo $val['id'];?>" > <a ><span><img src="<?php echo base_url().'/';?><?php echo $val['profile_image'];?>"></span>
                <h2><?php echo $val['name'];?></h2>
                </a> </div>
              <?php
				  }
				?>
              <?php
			  }
			  ?>
            </div>
          </div>
        </div>
      </section>
      <section class="common-section">
        <h2 class="section-title"><?=lang('app.global.blog')?></h2>
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
  <?php echo  $this->include('user/templates/footer_template'); ?> </main>
<span id="showpostmodel" style="display:none"></span>
<div id="loading"> <img id="loading-image" src="<?php echo base_url().'/public/frontend/';?>images/ajax-loader.gif" alt="Loading..." /> </div>
<div class=" share_your_thoughts_popup_text add_custom_field_pop overlay" id="createpost" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered" role="document">
    <div class="modal-content ">
      <div class="modal-body">
        <h5 class="modal-title share_your_thoughts_popup_title" id="exampleModalLongTitle"><?=lang('app.user_dashboard._13')?> </h5>
        <a class="close" href="#" onclick="createpostpopup_close()">&times;</a>
        <div class="frame__container">
          <div class="frame__headline"> <img class="headline__image" src="<?php echo  base_url().'/'.$users['profile_image'];?>">
            <div class="frame__column">
              <p class="headline__title"> <?php echo $_SESSION['nameUserH'];?> </p>
            </div>
          </div>
          <div class="frame__content">
            <form onsubmit="return checkLimit()" id="veganpostform" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <textarea  rows="4" cols="50" class="form-control" name="create_post_content" id="create_post_content" placeholder="<?=lang('app.user_dashboard._13')?>"></textarea>
              </div>
              <div class="form-group">
                <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label class="control-label"><?=lang('app.global.upload_file')?></label>
            <div class="preview-zone hidden">
              <div class="box box-solid">
                <div class="box-header with-border">
                  <div><b><?=lang('app.global.preview')?></b></div>
                  <div class="box-tools pull-right">

                  </div>
                </div>
                <div class="box-body"></div>
              </div>
            </div>
            <div class="dropzone-wrapper">
              <div class="dropzone-desc">
                <i class="glyphicon glyphicon-download-alt"></i>
                <p><?=lang('app.user_dashboard._14')?></p>
              </div>
              <input type="file" id="create_post_image" name="create_post_image" class="dropzone">
            </div>
          </div>
        </div>
      </div>
				<?php /* ?>
				<input type="file" name="create_post_image" class="form-control" id="create_post_image" accept="image/*,video/webm,video/ogg,video/mp4,video/3gp" >
				<?php */ ?>
              </div>
                <div class="row">
                    <div class="col">
                        <button type="button" class="btn btn-danger btn-xs remove-preview">
                            <i class="fa fa-times"></i> <?=lang('app.global.reset_form')?>
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <input type="submit" name="create" id="create" value="<?=lang('app.global.post')?>" class="create_button">
                    </div>
                </div>
            </form>
          </div>
        </div>
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
<div id="purchaseSubscriptionModal" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Subscription Limits exceed</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                You can post upto <?=$current_subscription->subscription->data->post?> Posts in your
                <b><?=$current_subscription->subscription->title?> Membership</b> ! Please upgrade your plan to increase limits.
            </div>
            <div class="modal-footer">
                <a type="button" class="btn btn-success" href="/subscription/list">See Plans</a>
            </div>
        </div>
    </div>
</div>

<script src='<?php echo base_url().'/public/frontend/';?>js/owl.carousel.min.js'></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    function checkLimit() {
        var ispermitted=<?=($current_subscription->usage['post'] < $current_subscription->subscription->data->post)?'true':'false'?>;
        if (!ispermitted){
            createpostpopup_close()
            $("#purchaseSubscriptionModal").modal('show')
        }
        return ispermitted
    }
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
    }
$(document).ready(function() {
    $('.select-2-init').select2();
    $("#menuButton").on("click", function(){
        $(".side-a").toggleClass("is-open");
        $("html").toggleClass("is-nav-open");
    });
      $("#darkMode").on("click", function(){
        $("html").toggleClass("is-dark");
    });
});

 function createpostpopup_open(){
	 $("#createpost").css({"visibility": "visible", "opacity": "1"});
 }
 function createpostpopup_close(){
	 $("#createpost").css({"visibility": "hidden", "opacity": "0"});
	 $('#veganpostform')[0].reset();
 }

$(document).ready(function (e) {
 $("#veganpostform").on('submit',(function(e) {
	 var imgs=document.getElementById('create_post_image').files.length;

	 if($("#create_post_content").val()=='' && imgs==0){
		 alert("<?=lang('app.user_dashboard._15')?>");
		 return false;
	 }
  e.preventDefault();
  $('#loading').show();
  $.ajax({
   url: "<?php echo base_url();?>/user/insert-vegan-post",
   type: "POST",
   data:  new FormData(this),
   contentType: false,
         cache: false,
   processData:false,
   beforeSend : function()
   {

   },
   success: function(data)
      {
		  alert('Post submit');
		  createpostpopup_close();
		  $('#loading').hide();
		  $("#nopost").remove();
		  $('.addli').after(data);
		  return false;
      },
     error: function(e)
      {
		  $('#loading').hide();
		  createpostpopup_close();
      }
    });
 }));
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

function submitEventcomments(){
  const form = document.querySelector('#blogcommentform');
  //$('#loading').show();
  var messagecomments=document.getElementById('messagecomments').value;
  if(messagecomments==''){
    alert("<?=lang('app.user_dashboard._16')?>");
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

      alert('<?=lang('app.user_dashboard._20')?>');
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
  $("#showmodel").modal('hide').css('display','none');
}


function submitEventcomments(id){
  const form = document.querySelector('#postcommentform_'+id);

  //$('#loading').show();
  var messagecomments=document.getElementById('messagecomments_'+id).value;
  if(messagecomments==''){
    alert("<?=lang('app.user_dashboard._16')?>");
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
function showcommentmodal(postid){
	$.ajax({
    url:'<?php echo base_url();?>/user/get-single-post-comment',
    type:'POST',
	data:"postid="+postid,
    success:function(data){
      console.log(data);
	  $("#showpostmodel").css('display','block');
      $("#showpostmodel").html(data);
      $('#add_custom_post').modal('show');

    },
    error:function(e){

    }
  });
}
function addpostlike(id,likestatus){
		$.ajax({
         url: "<?php echo base_url();?>/user/insert-post-like-user",
   type: "POST",
   data:  'post_id='+id+'&status='+likestatus,
   beforeSend : function()
   {
   },
   success: function(data)
      {
         var likecnt=parseInt($('#like_cnt_'+id).html());

		if(likestatus==1){
      likecnt=likecnt+1;
			document.getElementById('like_'+id).style.display="none";
			document.getElementById('unlike_'+id).style.display="block";
		}else{
      likecnt=likecnt-1;
			document.getElementById('like_'+id).style.display="block";
			document.getElementById('unlike_'+id).style.display="none";
		}
     $('#like_cnt_'+id).html(likecnt);


      },
     error: function(e)
      {

      }
    });
	}
function showoldercomments(id){
	$.ajax({
         url: "<?php echo base_url();?>/user/post/show-older-comment",
   type: "POST",
   data:  'id='+id,
   beforeSend : function()
   {
   },
   success: function(data)
      {
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

function submitpostcomments(){
	const form = document.querySelector('#postcommentform');
  var messagecomments=document.getElementById('messagecomments').value;
  if(messagecomments==''){
	  alert("<?=lang('app.user_dashboard._16')?>");
	  return false;
  }
  $.ajax({
         url: "<?php echo base_url();?>/user/insert-post-comment-user",
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

		  document.getElementById('messagecomments').value='';
		 $(".commentList").animate({ scrollTop: 0}, 1000);
		  return false;

      },
     error: function(e)
      {
		  $('#loading').hide();

      }
    });

}
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
<style>
#owl-demo .item{
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
 <script>
 function readFile(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      var htmlPreview =
        '<img width="200" src="' + e.target.result + '" />' +
        '<p>' + input.files[0].name + '</p>';
      var wrapperZone = $(input).parent();
      var previewZone = $(input).parent().parent().find('.preview-zone');
      var boxZone = $(input).parent().parent().find('.preview-zone').find('.box').find('.box-body');

      wrapperZone.removeClass('dragover');
      previewZone.removeClass('hidden');
      boxZone.empty();
      boxZone.append(htmlPreview);
    };

    reader.readAsDataURL(input.files[0]);
  }
}

function reset(e) {
  e.wrap('<form>').closest('form').get(0).reset();
  e.unwrap();
}

$(".dropzone").change(function() {
  readFile(this);
});

$('.dropzone-wrapper').on('dragover', function(e) {
  e.preventDefault();
  e.stopPropagation();
  $(this).addClass('dragover');
});

$('.dropzone-wrapper').on('dragleave', function(e) {
  e.preventDefault();
  e.stopPropagation();
  $(this).removeClass('dragover');
});

$('.remove-preview').on('click', function() {
  var boxZone = $(this).parents('.preview-zone').find('.box-body');
  var previewZone = $(this).parents('.preview-zone');
  var dropzone = $(this).parents('.form-group').find('.dropzone');
  boxZone.empty();
  previewZone.addClass('hidden');
  reset(dropzone);
});
</script>
</body>
</html>