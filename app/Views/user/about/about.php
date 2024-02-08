<?php echo  $this->extend('user/templates/about_template'); ?>

<?php echo  $this->section('content'); ?>
<?php
$public_url=base_url()."/public/frontend/";
$baseurl=base_url()."/";
?>
<main>
"Dark Mode"><span class="icon" aria-hidden="true">🌜</span></button>
  <div class="common-structure">
    <?php 
	if(isset($_SESSION['nameUserH'])){
	echo  $this->include('user/templates/comman_header_profile');
    }else{
	echo  $this->include('user/templates/comman_header_pages');	
	}
	?>
  </div>
  <section class="middle_wraper">
<div class="privacy_page">
    <div id="about">
      <div class="container">
        <div class="section-header aboutpage">
          <h2>About Us</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
        <div class="row about-container">
          <div class="col-lg-6 content order-lg-1 order-2">
            <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
            <div class="icon-box ">
              <div class="icon"><i class="fa fa-shopping-bag"></i></div>
              <h4 class="title"><a href="">Eiusmod Tempor</a></h4>
              <p class="description">Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi</p>
            </div>
            <div class="icon-box " data-wow-delay="0.2s">
              <div class="icon"><i class="fa fa-photo"></i></div>
              <h4 class="title"><a href="">Magni Dolores</a></h4>
              <p class="description">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
            </div>
            <div class="icon-box " data-wow-delay="0.4s">
              <div class="icon"><i class="fa fa-bar-chart"></i></div>
              <h4 class="title"><a href="">Dolor Sitema</a></h4>
              <p class="description">Minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat tarad limino ata</p>
            </div>
          </div>
          <div class="col-lg-6 background order-lg-2 order-1  "> <img src="<?php echo $public_url;?>images/about-extra-1.jpg" class="img-fluid" alt=""> </div>
        </div>
        <div class="row about-extra">
          <div class="col-lg-6 "> <img src="<?php echo $public_url;?>images/about-extra-2.jpg" class="img-fluid" alt=""> </div>
          <div class="col-lg-6  pt-5 pt-lg-0">
            <h2>What is Lorem Ipsum?</h2>
            <p> Ipsum in aspernatur ut possimus sint. Quia omnis est occaecati possimus ea. Quas molestiae perspiciatis occaecati qui rerum. Deleniti quod porro sed quisquam saepe. Numquam mollitia recusandae non ad at et a. </p>
            <p> Ad vitae recusandae odit possimus. Quaerat cum ipsum corrupti. Odit qui asperiores ea corporis deserunt veritatis quidem expedita perferendis. Qui rerum eligendi ex doloribus quia sit. Porro rerum eum eum. </p><p> Ipsum in aspernatur ut possimus sint. Quia omnis est occaecati possimus ea. Quas molestiae perspiciatis occaecati qui rerum. Deleniti quod porro sed quisquam saepe. Numquam mollitia recusandae non ad at et a. </p>
             
          </div>
        </div>
        <div class="row about-extra">
          <div class="col-lg-6  order-1 order-lg-2"> <img src="<?php echo $public_url;?>images/about-extra-3.jpg" class="img-fluid" alt=""> </div>
          <div class="col-lg-6  pt-4 pt-lg-0 order-2 order-lg-1">
            <h2>What is Lorem Ipsum?</h2>
            <p> Delectus alias ut incidunt delectus nam placeat in consequatur. Sed cupiditate quia ea quis. Voluptas nemo qui aut distinctio. Cumque fugit earum est quam officiis numquam. Ducimus corporis autem at blanditiis beatae incidunt sunt. </p>
            <p> Voluptas saepe natus quidem blanditiis. Non sunt impedit voluptas mollitia beatae. Qui esse molestias. Laudantium libero nisi vitae debitis. Dolorem cupiditate est perferendis iusto. </p>
          <p> Delectus alias ut incidunt delectus nam placeat in consequatur. Sed cupiditate quia ea quis. Voluptas nemo qui aut distinctio. Cumque fugit earum est quam officiis numquam. Ducimus corporis autem at blanditiis beatae incidunt sunt. </p>
            
          </div>
        </div>
      </div>
    </div>
    <div class="testimonial_box">
      <div class="container">
        <div class="slider">
          <div class="buttons">
            <div class="previous"></div>
            <div class="next"></div>
          </div>
          <div class="slide">
            <div class="testimonial">
              <blockquote>" I've been interested in coding for a while but never
                taken the jump, until now.
                I couldn't recommend this course enough. I'm now in the job of my
                dreams and so excited about the future. "</blockquote>
              <p class="author">Tanya Sinclair <span>UX Engineer</span> </p>
            </div>
            <div class="slider-img"> <img src="<?php echo $public_url;?>images/image-tanya.jpg" alt="Author Image"> </div>
          </div>
          <div class="slide">
            <div class="testimonial">
              <blockquote>" If you want to lay the best foundation possible I'd
                recommend taking this course.
                The depth the instructors go into is incredible. I now feel so
                confident about
                starting up as a professional developer. "</blockquote>
              <p class="author">John Tarkpor <span>Junior Front-end Developer</span> </p>
            </div>
            <div class="slider-img"> <img src="<?php echo $public_url;?>images/image-john.jpg" alt="Author Image"> </div>
          </div>
        </div>
      </div>
    </div>
    </div>


</section>



</main>
<?php echo  $this->endSection(); ?>