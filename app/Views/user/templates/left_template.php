<?php
$public_url=base_url()."/public/frontend/";
?>
 
<aside class="side-a">
      <section class="common-section">
        <h2 class="section-title u-hide">User Navigation</h2>
        <ul class="common-list menu">
          <div class="logo_images"><img onclick="redirectfun()" style="cursor:pointer" src="<?php echo $public_url;?>images/logo.png"></div>
          <div class="search-box-wrapper">
            <input type="search" class="search-box" placeholder="Search Hello Vegans">
            <span class="icon-search" aria-label="hidden"> <img src="<?php echo $public_url;?>images/search_icon.png"></span> </div>
          <li class="common-list-item">
            <div class="icon-container"> <a class="common-list-button" href="<?php echo base_url();?>/user/dashboard"> <span class="icon" aria-hidden="true"> <img src="<?php echo $public_url;?>images/vegan_g.png"/> <img src="<?php echo $public_url;?>images/vegan.png"/> </span> <span class="text">Vegan log</span> </a></div>
          </li>
          <li class="common-list-item">
            <div class="icon-container"><a class="common-list-button" href="<?php echo base_url();?>/user/about"> <span class="icon"> <img src="<?php echo $public_url;?>images/about_icon_g.png" /> <img src="<?php echo $public_url;?>images/about_icon.png" /> </span> <span class="text"> About Us</span> </a> </div>
          </li>
          <li class="common-list-item">
            <div class="icon-container"><a class="common-list-button" href="<?php echo base_url();?>/user/connect"> <span class="icon"> <img src="<?php echo $public_url;?>images/connect_icon_g.png" /> <img src="<?php echo $public_url;?>images/connect_icon.png" /> </span> <span class="text"> Connect </span> </a> </div>
          </li>
           <li class="common-list-item">
            <div class="icon-container"><a class="common-list-button" href="<?php echo base_url();?>/user/blog"> <span class="icon"> <img src="<?php echo $public_url;?>images/blog_icon_g.png" /> <img src="<?php echo $public_url;?>images/blog_icon.png" /> </span> <span class="text"> Blog </span> </a> </div>
          </li>
           <li class="common-list-item">
            <div class="icon-container"><a class="common-list-button" href="<?php echo base_url();?>/user/news"> <span class="icon"> <img src="<?php echo $public_url;?>images/news_icon_g.png" /> <img src="<?php echo $public_url;?>images/news_icon.png" /> </span> <span class="text"> News </span> </a> </div>
          </li>
           <li class="common-list-item">
            <div class="icon-container"><a class="common-list-button" href="<?php echo base_url();?>/user/event"> <span class="icon"> <img src="<?php echo $public_url;?>images/event_icon_g.png" /> <img src="<?php echo $public_url;?>images/event_icon.png" /> </span> <span class="text"> Event </span> </a> </div>
          </li>
          <li class="common-list-item">
            <div class="icon-container"><a class="common-list-button" href="<?php echo base_url();?>/user/question"> <span class="icon"> <img src="<?php echo $public_url;?>images/discuss_icon_g.png" /> <img src="<?php echo $public_url;?>images/discuss_icon.png" /> </span> <span class="text"> Let's Discuss </span> </a> </div>
          </li>
          <li class="common-list-item">
            <div class="icon-container"> <a class="common-list-button" href="<?php echo base_url();?>/user/recommendation"> <span class="icon"> <img src="<?php echo $public_url;?>images/recommendation_icon_g.png" /> <img src="<?php echo $public_url;?>images/recommendation_icon.png" /> </span> <span class="text"> Recommendation </span> </a> </div>
          </li>
         
        </ul>
      </section>
      <section class="common-section">
        <h2 class="section-title">Recommendation</h2>
        <div class="recommendation">
          <ul class="common-list">
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
              </a> 
			</li>
            <?php
				}			
			}
			?>
			
           
          </ul>
        </div>
      </section>
      <section class="common-section">
        <div class="birthdays">
          <h2 class="section-title">Birthdays</h2>
          <ul class="common-list">
            <li class="common-list-item"> <a href="#">
              <p><span><img src="<?php echo $public_url;?>images/gift.png"></span><b>Kishor Jung Thakuri's</b> Birthday is todya</p>
              </a> </li>
          </ul>
        </div>
      </section>
      <section class="common-section">
        <div class="birthdays">
          <h2 class="section-title">Your shortcuts</h2>
          <ul class="common-list">
            <li class="common-list-item"> <a href="<?php echo base_url();?>/user/privacy">Privacy</a> </li>
            <li class="common-list-item"><a href="<?php echo base_url();?>/user/terms"> Terms </a></li>
            <li class="common-list-item"><a href="<?php echo base_url();?>/user/advertising"> Advertising </a></li>
             <li class="common-list-item"><a href="<?php echo base_url();?>/user/cookies"> Cookies </a> </li>
          </ul>
        </div>
      </section>
    </aside>
	<script>
	function redirectfun(){
		window.location.href="<?php echo base_url();?>/user/dashboard";
	}
	</script>