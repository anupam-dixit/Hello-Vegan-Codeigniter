<?php echo  $this->extend('user/templates/login_template'); ?>

<?php echo  $this->section('content'); ?>
<?php
$public_url=base_url()."/public/frontend/";
?>
<main>
   
  <section class="middle_wraper">
    <div class="middle_bg">
      <div class="login_bx">
        <div class="container_user">
          <div class=" main">
            <div class="row" style="margin-right: 0;margin-left: 0;">
            
              
              <!--col-sm-6-->
              
              <div class="col-md-7 col-sm-6 col--12 right-side">
              <div class="logo_login"><img src="<?php echo $public_url;?>images/logo.png" alt="Company Logo"></div>
              <p>Lorem Ipsum is simply dummy text of the printing and 
                 typesetting industry.
              </p>
                <h2>Verification Mail send </h2>
                
                <!--Form with header-->
                <div class="form">
				
<form action="<?php echo base_url('user/resendVerification');?>" method="post" enctype="multipart/form-data" id="loginForm" name="loginForm" >                 
				 <div class="form-group">
                    <input type="text" id="email" name="email" class="form-control" placeholder="Email ID">
                    <div class="form_icon"> <img src="<?php echo $public_url;?>images/usericon.svg" alt="icon"> </div>
                  </div>
                  <div class="text-xs-center"> 
				    <a  class="btn loginbutton "> 
					<input style="background:none;border:none;color:#fff" type="submit" name="submit" id="submit" value="Send">
					<span>
				    <img src="<?php echo $public_url;?>images/back_arrow.svg" alt="img">
				  </span>
				  </a>
				  </div>
				  </form>
				  <div class="dontaccount">Already have an account?
				  <a href="user/login">Login</a>
				  </div>
                </div>
                <!--/Form with header--> 
                
              </div>
              <!--col-sm-6-->
              
              <div class="col-md-5 col-sm-6 left-side">
                 
                <div class="text_login">
                  <h2>Hello, Friend</h2>
                  <ul>
                    <li>Lorem Ipsum is simply dummy text of the 
                          printing and typesetting industry.</li>
                    
                  </ul>
                  <div class="login_social_icon">   
				  <a href="<?php echo site_url();?>user/login">Login</a>     
				  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
   
</main>
<?php echo  $this->endSection(); ?>
