<?php
$public_url=base_url()."/public/frontend/";
$baseurl=base_url()."/";
?>
<link rel="icon" href="<?php echo base_url();?>/public/frontend/images/favicon.png" type="image/x-icon"/>
<link rel="shortcut icon" href="<?php echo base_url();?>/public/frontend/images/favicon.png" type="image/x-icon"/>

<div class="header_allpage">
<header class="main-header u-flex">
    <div class="start u-flex">
        <a class="logo" href="<?php echo base_url();?>"><img src="<?php echo base_url().'/public/frontend/';?>images/mobilelogo.png"></a>
        <div class="search-box-wrapper">
            <input type="search" class="search-box" id="livese" onkeyup="showResult()" placeholder="<?=lang('app.profile._1')?>" />
            <span class="icon-search" aria-label="hidden"><img src="<?php echo $public_url;?>images/search_icon.png" /></span>
			
        </div>
		<div id="livesearch"></div>
    </div>
	
    <nav class="main-nav">
        <ul class="main-nav-list u-flex">
            <li class="main-nav-item u-only-wide">
                <a aria-label="<?=lang('app.user_dashboard._18')?>" href="<?php echo base_url();?>/user/dashboard" class="main-nav-button alt-text is-selected">
                    <span class="icon" aria-hidden="true"><img src="https://cdn-icons-png.flaticon.com/128/1946/1946436.png" /></span>
                </a>
				
            </li>
            
            <li class="main-nav-item u-only-wide">
                <a aria-label="<?=lang('app.global.blog')?>" href="<?php echo base_url();?>/user/blog" class="main-nav-button alt-text">
                    <span class="icon" aria-hidden="true"><img src="https://cdn-icons-png.flaticon.com/128/4922/4922073.png" /></span>
                </a>
            </li>
            <li class="main-nav-item u-only-wide">
                <a aria-label="<?=lang('app.global.news')?>" href="<?php echo base_url();?>/user/news" class="main-nav-button alt-text">
                    <span class="icon" aria-hidden="true"><img src="https://cdn-icons-png.flaticon.com/128/81/81460.png" /></span>
                </a>
            </li>
            <li class="main-nav-item u-only-wide">
                <a aria-label="<?=lang('app.global.event')?>" href="<?php echo base_url();?>/user/event" class="main-nav-button alt-text">
                    <span class="icon" aria-hidden="true"><img src="https://cdn-icons-png.flaticon.com/128/839/839888.png" /></span>
                </a>
            </li>

           
            <li class="main-nav-item u-only-wide">
                <a href="<?php echo base_url();?>/user/recipe" aria-label="<?=lang('app.global.recipe')?>" class="main-nav-button alt-text">
                    <span class="icon" aria-hidden="true"><img src="https://cdn-icons-png.flaticon.com/128/5402/5402889.png" /></span>
                </a>
            </li>
            
            
            <li class="main-nav-item u-only-wide">
                <a href="<? echo base_url();?>/user/recommendation" aria-label="<?=lang('app.global.recommendation')?>" class="main-nav-button alt-text">
                    <span class="phpicon" aria-hidden="true"><img src="https://cdn-icons-png.flaticon.com/128/5126/5126846.png" /></span>
                </a>
            </li>


            
             <li class="user-nav-item menu_mobile_nav" id="showchat">
            <button class="icon-button alt-text" aria-label="Messenger"><span class="icon" aria-hidden="true"><i class="fa fa-comments-o" aria-hidden="true"></i></span></button>
          </li>
            <li>
                <div id="google_translate_element"></div>
            </li>


          





          <li class="user-nav-item notifications_mobile menu_mobile_nav">
            <button class="icon-button alt-text " onclick="removeNotification()" aria-label="Notifications"><span class="icon" aria-hidden="true"><i class="fa fa-bell-o" aria-hidden="true"></i>
</span></button>
<div class="notif_count_notifications">0</div>
 <ul class="notification_popup" id="notification_popup"></ul>
          </li>

            <li class="user-nav-item menu_mobile_nav" onclick="openNav()"> <a class="user" > <img class="user-image" src="<?php echo  base_url().'/'.$users['profile_image'];?>" height="28" width="28" alt="">   </a>
            
            
        
            
             </li>
            
            </ul>
	   <ul id="mySidenav"  class="sidenav">
      <li> <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a></li>
      
      
            <li><a href="<?php echo base_url();?>/user/profile">Post </a></li>
            <li><a href="<?php echo base_url();?>/user/event_user"><?=lang('app.global.event')?> </a></li>
            <li><a href="<?php echo base_url();?>/user/recipes_user"><?=lang('app.global.recipe')?> </a></li>
            <li><a href="<?php echo base_url();?>/user/blog_user"><?=lang('app.global.blog')?> </a></li>
            <li><a href="<?php echo base_url();?>/user/photo"><?=lang('app.global.photo')?> </a></li>
            <li><a href="<?php echo base_url();?>/user/friendlist"><?=lang('app.global.friend')?>  </a></li>
            <li><a href="<?php echo base_url();?>/user/friendrequestlist"><?=lang('app.global.friend_request')?></a></li>
            <li><a href="<?php echo base_url();?>/user/privacy"><?=lang('app.global.privacy_policy')?></a></li>
            <li><a href="<?php echo base_url();?>/user/terms"><?=lang('app.global.terms_of_Service')?></a></li>
            <li><a href="<?php echo base_url();?>/user/logout"><?=lang('app.global.logout')?></a></li>
            

       </ul>
	  <style>


.sidenav {
	height: 100%;
	width: 0;
	position: fixed;
	z-index: 1;
	top: 0;
	right: 0;
	background-color: #70cac8f2;
	overflow-x: hidden;
	transition: 0.5s;
	padding-top: 60px;
	left: auto;
	border-radius: 0px 0px 10px 10px;
}
#mySidenav li {
	width: 100%;
	float: left;
	padding: 0;
	border-bottom: 1px solid #83d3d2;
	display: block;
	float: left;
}
#mySidenav {
	padding: 13px 0 9px;
	height: 100%;
	margin-top: 57px;
}
.sidenav a {
	padding: 10px 8px 10px 32px;
	text-decoration: none;
	font-size: 18px;
	text-align: left;
	color: #fff;
	display: block;
	transition: 0.3s;
}

.sidenav a:hover {
  color: #f1f1f1;
}

.sidenav .closebtn {
	position: absolute;
	top: -12px;
	right: -1px;
	font-size: 36px;
	margin-left: 0;
	color: #fff;
}

 @media(max-width:575.5px) {
#mySidenav {
 	height: 100%; 
}
}
 
</style>

<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "267px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}
</script>
            
            <!-- <li class="main-nav-item u-only-small">
              <button aria-label="Menu" class="main-nav-button u-animation-click" id="menuButton"><span class="icon icon-hamburger" aria-hidden="true"></span></button>
            </li>--> 
            
        </ul>
    </nav>
    <div class="end"></div>
</header> 
<nav class="user-nav">
    <ul class="user-nav-list u-flex">
        
        <!--<li class="user-nav-item ">
            <button class="icon-button alt-text" aria-label="Create"><span class="icon" aria-hidden="true">➕</span></button>
        </li>-->
        <li class="user-nav-item" id="showchat">
            <button class="icon-button icon_profile_button alt-text" aria-label="<?=lang('app.global.messenger')?>"><span class="icon" aria-hidden="true"><i class="fa fa-comments-o" aria-hidden="true"></i>
</span></button>
        </li>
        <li class="user-nav-item noti profle___and_top">
            <button onclick="removeNotification()" class="icon-button icon_profile_button alt-text" aria-label=" "><span class="icon" aria-hidden="true"><i class="fa fa-bell-o" aria-hidden="true"></i>
</span></button>

			<div class="notif_count_notifications">0</div>
			<ul class="notification_popup" id="notification_popup"></ul>
			
        </li>

        <li class="user-nav-item"  onclick="openNav()">
            <a class="user"> <img class="user-image" src="<?php echo  $baseurl.$loginusers['profile_image'];?>" height="28" width="28" alt="" /> <span class="user-name"><?php echo $loginusers['name'];?></span> </a>
			<div class="notfy">
      <?php echo  $this->include('user/templates/profile_show_logout'); ?>
      </div>
        </li>
        
		
       <?php /*?> <li class="user-nav-item noti droplog profle___and_top">
            <button class="icon-button alt-text" aria-label=" "><span class="icon" aria-hidden="true">🔻</span></button>
			<ul style="display: none;" class="drop_log_opan_type">
      <li><a href="<?php echo base_url();?>/user/profile">View Profile</a></li>
      <li><a href="<?php echo base_url();?>/user/logout">Logout</a></li>
      
       </ul>
        </li><?php */?>
    </ul>
</nav>
 <span id="showmodel" style="display:none"></span>  
</div>
<script>
$(window).scroll(function() {
    if ($(this).scrollTop() > 200){  
        $('div.common-structure').addClass("sticky");
    }
    else{
        $('div.common-structure').removeClass("sticky");
    }
});
var $ = jQuery.noConflict();

$(document).ready(function() {
    jQuery('ul.sf-menu').superfish({
        animation: {
            height: 'show'
        },  
        delay: 100 
    }); 
    $("#toggle-btn").click(function() {
        $(".sf-menu").slideToggle("slow"); 
    });

    $('.toggle-subarrow').click(
        function() {
            $(this).parent().toggleClass("mob-drop");
    });
		
		var header = $(".header-inner");
    $(window).scroll(function() {
        var scroll = $(window).scrollTop();
        if (scroll >= 100 && $(this).width() > 769) {
            header.addClass("navbar-fixed-top");
        } else {
            header.removeClass('navbar-fixed-top');
        }
    });	  
	  $(this).find(".h4 i").each(function(){
            $(this).addClass("green");
    }); 
});  
 

</script> 
<script>

function showResult() {
  var str=document.getElementById("livese").value;
  if (str.length>=0 && str.length<=2) {
    document.getElementById("livesearch").innerHTML="";
   // document.getElementById("livesearch").style.border="0px";
    return;
  }
  
  if (str.length>2) {
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("livesearch").innerHTML=this.responseText;
      //document.getElementById("livesearch").style.border="1px solid #A5ACB2";
    }
  }
  xmlhttp.open("GET","<?php echo base_url();?>/user/live-search/"+str,true);
  xmlhttp.send();
  }
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

 function getSinglerecipes(id){
  $.ajax({
    url:'https://hello-vegans.com/user/get-single-recipes/'+id,
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


        

</script>
