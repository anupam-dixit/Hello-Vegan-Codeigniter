<?php echo  $this->extend('user/templates/about_template'); ?>

<?php echo  $this->section('content'); ?>
<?php
$public_url=base_url()."/public/frontend/";
$baseurl=base_url()."/";
?>
<main>
 
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
    <div class="middle_bg">
      <div class="login_bx">
        <div class="container_user">
          <div class=" main">
            <div class="row" style="margin-right: 0;margin-left: 0;">
            
              
              <!--col-sm-6-->
              
              <div class="col-md-7 col-sm-6 right-side">
			   <?php if(session()->getFlashdata('msgblog')):?>
                    <div class="alert alert-success" style="margin-left: 47px;">
                       <p><?= session()->getFlashdata('msgblog') ?></p>
                    </div>
      <?php endif;?>
                 <h2>Contact</h2>
                
                <!--Form with header-->
                <div class="form contact_page">
                  <div class="sign_up">
                    <div id="tabs">
                      <div class="row">
                        <div class="sign_uptab">
                       <form action="<?php echo base_url('user/contact/insert');?>" method="post" enctype="multipart/form-data" id="blogForm" name="blogForm"> 
                        <div class="tab_contentform">
                                <div class="row">
                                  <div class="col-lg-6 col-md-12 col-sm-12 form_mobilepadding">
                                    <div class="form-group">
                                      <label for="Name">Name  </label>
                                      <input type="text" name="name"  class="form-control" placeholder="Name">
                                    </div>
                                  </div>
                                   
                                  <div class="col-lg-6 col-md-12 col-sm-12 form_mobilepadding">
                                    <div class="form-group">
                                      <label for="email">Email ID  </label>
                                      <input type="email" name="email" class="form-control" placeholder="Email ID">
                                    </div>
                                  </div>
                                  <div class="col-lg-6 col-md-12 col-sm-12 form_mobilepadding">
                                   <div class="form-group">
                                      <label for="Country">Country</label>
                                      <input type="text" placeholder="Country" id="country" name="country" class="form-control">
                                    <input type="hidden" id="countryId" value="0">
                                    </div>
                                  </div>
                                  <div class="col-lg-6 col-md-12 col-sm-12 form_mobilepadding">
                                    <div class="form-group">
                                      <label for="Number">  Number  </label>
                                      <div class="row pading_rightbx">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-3 pading_rightbxcol">
                                          <select class="form-control" id="Number" style="padding: 10px 5px;">
                                            <option selected="selected">+91</option>
                                            <option>+91</option>
                                            <option>+91</option>
                                            <option>+91</option>
                                          </select>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8 col-9 padinlogin form_mobilepadding" >
                                          <input type="text" name="number" class="form-control" placeholder="000 000 0000">
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                   
                                  <div class="col-lg-12 col-md-12 col-sm-12 form_mobilepadding">
                                    <div class="form-group">
                                      <label for="Number">Massages  </label>
                                      <textarea class="form-control" name ="message" id="exampleFormControlTextarea1" rows="6"></textarea>
                                       
                                    </div>
                                  </div>
                                 </div>
                                 
                                 <button type="submit" class="sumbit_event">Save changes</button>
                                 
                              </div>


                               </form>
                        
                        
                        
                           
                           
                        </div>
                      </div>
                    </div>
                  </div>
                 </div>
                <!--/Form with header--> 
                
              </div>
              <!--col-sm-6-->
              
              <div class="col-md-5 col-sm-6  contact_map">
                 
                <iframe src="https://www.google.com/maps/embed?pb=!1m28!1m12!1m3!1d70678.6631560838!2d8.671635849395384!3d47.34212970886895!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m13!3e6!4m5!1s0x479aa4a6077615b5%3A0x26a443cd74dca38a!2sHello%20Vegan%20%7C%20Ladengesch%C3%A4ft%20und%20Onlineshop%2C%20Zentralstrasse%2018%2C%208610%20Uster%2C%20Switzerland!3m2!1d47.3472551!2d8.717711399999999!4m5!1s0x479aa4a6077615b5%3A0x26a443cd74dca38a!2sHello-Vegans%20map!3m2!1d47.3472551!2d8.717711399999999!5e0!3m2!1sen!2sin!4v1660301627145!5m2!1sen!2sin" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="js/jquery.min.js"></script> 
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="js/bootstrap.min.js"></script> 
<script src='js/owl.carousel.min.js'></script> 
 <script>

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





<?php echo  $this->endSection(); ?>