<?php
$public_url=base_url()."/public/frontend/";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>Hello-Vegans</title>
<?php
/* echo "<pre>";
print_r(session()->get());
die; */
?>
<!-- Bootstrap -->
<link href="<?php echo $public_url;?>css/bootstrap.css" rel="stylesheet">
<link href="<?php echo $public_url;?>css/style.css" rel="stylesheet">
<link href="<?php echo $public_url;?>css/home_page.css" rel="stylesheet">
<link href="<?php echo $public_url;?>css/responsive.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

 
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
  <button class="icon-button e-dark-mode-button u-animation-click" id="darkMode" aria-label="Dark Mode"><span class="icon" aria-hidden="true">🌜</span></button>
<div class="common-structure">
  <header class="main-header u-flex">
    <div class="start u-flex">
       <a class="logo" href="<?php echo base_url();?>/user/dashboard">HV</a>
       <div class="search-box-wrapper">
         <input type="search" class="search-box" placeholder="Search Vegan log">
         <span class="icon-search" aria-label="hidden"><img src="<?php echo $public_url;?>images/search_icon.png"></span>
      </div>
    </div>
    <nav class="main-nav">
      <ul class="main-nav-list u-flex">
        <li class="main-nav-item u-only-wide"><a aria-label="Vegan log"  href="<?php echo base_url();?>/user/dashboard" class="main-nav-button alt-text is-selected"><span class="icon" aria-hidden="true"><img src="<?php echo $public_url;?>images/vegan_g.png" /></span></a></li>

        <li class="main-nav-item u-only-wide"><a aria-label="About Us" href="<?php echo base_url();?>/user/about" class="main-nav-button alt-text"><span class="icon" aria-hidden="true"><img src="<?php echo $public_url;?>images/about_icon_g.png" /></span></a></li>

        <li class="main-nav-item u-only-wide"><a aria-label="Connect" href="<?php echo base_url();?>/user/connect" class="main-nav-button alt-text"><span class="icon" aria-hidden="true"> <img src="<?php echo $public_url;?>images/connect_icon_g.png" /></span></a></li>

        <li class="main-nav-item u-only-wide"><a aria-label="Let's Discuss " class="main-nav-button alt-text"><span class="icon" aria-hidden="true"><img src="<?php echo $public_url;?>images/discuss_icon_g.png" /></span></a></li>

        <li class="main-nav-item u-only-wide"><a aria-label="Recommendation" href="<?php echo base_url();?>/user/recommendation" class="main-nav-button alt-text"><span class="icon" aria-hidden="true"><img src="<?php echo $public_url;?>images/recommendation_icon_g.png" /></span></a></li>

         <li class="main-nav-item u-only-wide"><a aria-label="Questions" class="main-nav-button alt-text"><span class="icon" aria-hidden="true"><img src="<?php echo $public_url;?>images/questions_icon_g.png" /></span></a></li>

        <li class="main-nav-item u-only-small"><button aria-label="Menu" class="main-nav-button u-animation-click" id="menuButton"><span class="icon icon-hamburger" aria-hidden="true"></span></button></li>
      </ul>
    </nav>
    <div class="end"></div>
  </header>  <nav class="user-nav">
      <ul class="user-nav-list u-flex">
        <li class="user-nav-item">
          <a class="user">
            <img class="user-image" src="https://assets.codepen.io/65740/internal/avatars/users/default.png" height="28" width="28" alt="">
            <span class="user-name">Elad</span>
          </a>
        </li>
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
    
    
    
    
    
</div>
<?= $this->renderSection('content') ?>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="<?php echo $public_url;?>js/bootstrap.min.js"></script> 
<script src="js/jquery.min.js"></script> 
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="js/bootstrap.min.js"></script> 
<script src='js/owl.carousel.min.js'></script> 
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
 <script>


  $(document).ready(function(){
    $('#country').autocomplete({
    minLength: 0,
    source: function(request, response) {
       $.ajax({
                url: "https://hello-vegans.com/user/get-country-list",
                dataType:'json',
                type : "post",
                data: {
                    search: request.term
                },
        success: function (datas) {
           if (datas.length > 0){
            var data = $.grep(datas, function(value) {
                    return value;
                        });
                    response(datas);            
           }else{
            
           } 
                        
                }
            });   

    },
  select: function (e, u) {
   // console.log(u.item.id);
    $("#State").val('');
        $("#countryId").val(u.item.id);
    if (u.item.value == -1) {
                    $("#country").val('');
          return false;
                }
            }
}).focus(function () {
      $(this).autocomplete("search", "");
  
  
});

});
  

const next = document.querySelector(".next");
const prev = document.querySelector(".previous");
const slides = document.querySelectorAll(".slide");

let index = 0;
display(index);

function display(index) {
  slides.forEach((slide) => {
    slide.style.display = "none";
  });
  slides[index].style.display = "flex";
}

function nextSlide() {
  index++;
  if (index > slides.length - 1) {
    index = 0;
  }
  display(index);
}

function prevSlide() {
  index--;
  if (index < 0) {
    index = slides.length - 1;
  }
  display(index);
}

next.addEventListener("click", nextSlide);
prev.addEventListener("click", prevSlide);




</script> 
 
</body>
</html>