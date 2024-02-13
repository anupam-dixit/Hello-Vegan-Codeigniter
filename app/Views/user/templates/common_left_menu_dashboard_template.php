<link rel="icon" href="<?php echo base_url();?>/public/frontend/images/favicon.png" type="image/x-icon"/>
<link rel="shortcut icon" href="<?php echo base_url();?>/public/frontend/images/favicon.png" type="image/x-icon"/>
<div class="header_allpage">
<header class="main-header u-flex header_hidden">
<div class="start u-flex"> <a class="logo" href="#"><img src="<?php echo base_url().'/public/frontend/';?>images/mobilelogo.png"></a>
  <div class="search-box-wrapper">
    <input type="search"  class="search-box" placeholder="Search Vegan log">
    <span class="icon-search" aria-label="hidden"><img src="<?php echo base_url().'/public/frontend/';?>images/search_icon.png"></span> </div>
</div>
<nav class="main-nav">
  <ul class="main-nav-list u-flex">
    <li class="main-nav-item u-only-wide"><a aria-label="Vegan log" class="main-nav-button alt-text is-selected"><span class="icon" aria-hidden="true"><img src="<?php echo base_url().'/public/frontend/';?>images/vegan_g.png" /></span></a></li>
    <li class="main-nav-item u-only-wide"><a aria-label="About Us" class="main-nav-button alt-text"><span class="icon" aria-hidden="true"><img src="<?php echo base_url().'/public/frontend/';?>images/about_icon_g.png" /></span></a></li>
    <li class="main-nav-item u-only-wide"><a aria-label="Connect" class="main-nav-button alt-text"><span class="icon" aria-hidden="true"> <img src="<?php echo base_url().'/public/frontend/';?>images/connect_icon_g.png" /></span></a></li>
    <li class="main-nav-item u-only-wide"><a aria-label="Let's Discuss " class="main-nav-button alt-text"><span class="icon" aria-hidden="true"><img src="<?php echo base_url().'/public/frontend/';?>images/discuss_icon_g.png" /></span></a></li>
    <li class="main-nav-item u-only-wide"><a aria-label="Recommendation" class="main-nav-button alt-text"><span class="icon" aria-hidden="true"><img src="<?php echo base_url().'/public/frontend/';?>images/recommendation_icon_g.png" /></span></a></li>
    <li class="main-nav-item u-only-wide"><a aria-label="Questions" class="main-nav-button alt-text"><span class="icon" aria-hidden="true"><img src="<?php echo base_url().'/public/frontend/';?>images/questions_icon_g.png" /></span></a></li>

  <li class="user-nav-item menu_mobile_nav" id="showchat">
            <button class="icon-button alt-text" aria-label="Messenger"><span class="icon" aria-hidden="true"><i class="fa fa-comments-o" aria-hidden="true"></i>
</span></button>
          </li>

    <li class="user-nav-item notifications_mobile menu_mobile_nav">
            <button class="icon-button alt-text " onclick="removeNotification()" aria-label="Notifications"><span class="icon" aria-hidden="true"><i class="fa fa-bell-o" aria-hidden="true"></i>
</span></button>
<div class="notif_count_notifications">0</div>
 <ul class="notification_popup" id="notification_popup"></ul>
          </li>


    <li class="user-nav-item"> <a onclick="openNav()" class="user"> <img class="user-image" src="<?php echo  base_url().'/'.$users['profile_image'];?>" height="28" width="28" alt=""> </a> </li>

    <li class="main-nav-item u-only-small">
      <button aria-label="Menu" class="main-nav-button u-animation-click" id="menuButton"><i class="fa fa-bars" aria-hidden="true"></i> <!--<span class="icon icon-hamburger" aria-hidden="true"></span>--></button>
    </li>
  </ul>
</nav>
<div class="end"></div>
<nav class="user-nav header_hidden">
  <ul class="user-nav-list u-flex">
    <li class="user-nav-item"> <a class="user"> <img class="user-image" src="https://assets.codepen.io/65740/internal/avatars/users/default.png" height="28" width="28" alt=""> <span class="user-name">Elad</span> </a> </li>
    <li class="user-nav-item">
      <button class="icon-button alt-text" aria-label="Create"><span class="icon" a$('body').click(function(evt){ria-hidden="true">➕</span></button>
    </li>
    <li class="user-nav-item">
      <button class="icon-button alt-text" aria-label="Messenger"><span class="icon" aria-hidden="true">💬</span></button>
    </li>
    <li class="user-nav-item">
      <button class="icon-button alt-text" aria-label="Notifications"><span class="icon" aria-hidden="true">??</span></button>
    </li>
    <li class="user-nav-item">
      <button class="icon-button alt-text" aria-label="Account"><span class="icon" aria-hidden="true">🔻</span></button>
    </li>
  </ul>
</nav>
</header>
</div>

<aside class="side-a">
  <section class="common-section">
      <div class="row">
              <div class="col">
                  <a href="/user/dashboard">
                  <img width="150" src="/public/frontend/images/logo.png" class="img-fluid">
                  </a>
              </div>
      </div>
      <ul class="common-list menu">
          <div class="search-box-wrapper">
              <input type="search" class="search-box" id="livese" onkeyup="showResult()" placeholder="Search Hello Vegans">
              <span class="icon-search" aria-label="hidden"> <img src="/public/frontend/images/search_icon.png"></span> </div>
          <div id="livesearch"></div>
      </ul>
      <div class="row">
          <div class="col"></div>
          <div class="col">
              <div id="google_translate_element"></div>
          </div>
          <div class="col"></div>
      </div>
    <h2 class="section-title u-hide"><?=lang('app.user_dashboard._17')?></h2>
      <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
      <script type="text/javascript">
          $(document).ready(function(){
              setTimeout(function () {
                  googleTranslateElementInit();
              },200);
          });
          function googleTranslateElementInit() {
              new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
          }
      </script>
  </section>
  <section class="common-section">
    <h2 class="section-title"><?=lang('app.global.recommendation')?></h2>
    <div class="recommendation">
      <ul class="common-list marquee">
        <?php
			if(count($recats)!=0){
				foreach($recats as $val){
			?>
        <li class="common-list-item"> <a href="<?php echo base_url();?>/user/recommendation" target="_blank" class="common-list-button is-ads">
          <div class="image"><img src="<?php echo base_url()."/".$val['image'];?>" width="115" alt=""></div>
          <div class="text">
            <h4 class="ads-title"><?php echo $val['title'];?></h4>
            <p class="ads-url"><?php echo $val['url'];?></p>
          </div>
          </a> </li>
        <?php
				}
			}
			?>
      </ul>
    </div>
  </section>
  <section class="common-section">
    <div class="birthdays">
      <!--     <h2 class="section-title">Birthdays</h2> -->
      <ul class="common-list">
        <?php

	  if(count($birthday)!=0){
		  foreach($birthday as $val){



	  ?>
        <li class="common-list-item"> <a href="#">
          <p><span><img src="<?php echo base_url().'/public/frontend/';?>images/gift.png"></span><b><?php echo $val['name'];?></b> <?=lang('app.user_dashboard._19')?></p>
          </a> </li>
        <?php
	  }
	  } ?>
      </ul>
    </div>
  </section>
  <section class="common-section">
    <div class="birthdays">
      <!--   <h2 class="section-title">Your shortcuts</h2> -->
      <ul class="common-list">
        <li class="common-list-item"> <a  href="<?php echo base_url();?>/user/about"><?=lang('app.global.about_us')?></a> </li>
        <li class="common-list-item"> <a href="<?php echo base_url();?>/user/connect"><?=lang('app.global.contact_us')?></a> </li>
        <li class="common-list-item"> <a href="<?php echo base_url();?>/user/privacy"><?=lang('app.global.privacy')?></a> </li>
        <li class="common-list-item"><a href="<?php echo base_url();?>/user/terms"> <?=lang('app.global.terms')?> </a></li>
        <li class="common-list-item"><a href="<?php echo base_url();?>/user/advertising"> <?=lang('app.global.advertising')?> </a></li>
        <li class="common-list-item"><a href="<?php echo base_url();?>/user/cookies">  <?=lang('app.global.cookies')?> </a> </li>
      </ul>
    </div>
  </section>
</aside>
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
</script> 
<script>
$(window).scroll(function() {
    //Pitesh
    // if ($(this).scrollTop() > 200){
    //     $('.common-structure').addClass("sticky");
    // }
    // else{
    //     $('.common-structure').removeClass("sticky");
    // }
});


</script> 
