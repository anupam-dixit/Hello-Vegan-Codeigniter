<?php
$public_url=base_url()."/public/frontend/";
?>
<header class="main-header u-flex">
      <div class="start u-flex"> <a class="logo" href="<?php echo base_url();?>/user/dashboard">HV</a>
        <div class="search-box-wrapper">
          <input type="search" class="search-box" placeholder="Search Vegan log">
          <span class="icon-search" aria-label="hidden"><img src="<?php echo $public_url;?>images/search_icon.png"></span> </div>
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
    </header>
    <nav class="user-nav">
      <ul class="user-nav-list u-flex">
        <li class="user-nav-item"> <a class="user"> <img class="user-image" src="https://assets.codepen.io/65740/internal/avatars/users/default.png" height="28" width="28" alt=""> <span class="user-name">Elad</span> </a> </li>
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