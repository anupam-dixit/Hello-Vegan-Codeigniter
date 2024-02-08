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

                <!--Form with header-->
                <div class="form">
				
<form action="<?php echo base_url('user/sendForgotPasswordLink');?>" method="post" enctype="multipart/form-data" id="forgotPasswordForm" name="forgotPasswordForm" onsubmit="return submitForgotForm()" >                 
				 <div class="row">
                     <div class="col-0 col-xs-0 col-sm-0 col-md-2 col-lg-2 col-xl-2"></div>
                     <div class="col">
                         <h2>Forgot Password</h2>
                         <div class="form-group">
                             <input type="text" id="email" name="email" class="form-control" placeholder="Email ID" onkeypress="return valueonchange(this.id)">
                             <div class="form_icon">
                                 <img src="<?php echo $public_url;?>images/usericon.svg" alt="icon"> </div>
                             <span class="error_class" id="error_email">Please fill email</span>
                             <span class="error_class" id="error_email_valid">Please fill valid email</span>
                         </div>
                     </div>
                     <div class="col-0 col-xs-0 col-sm-0 col-md-2 col-lg-2 col-xl-2"></div>
                 </div>
                  <div class="row">
                      <div class="col-0 col-xs-0 col-sm-0 col-md-2 col-lg-2 col-xl-2"></div>
                      <div class="col">
                          <button type="submit" name="submit" id="submit" style="background: #365819" class="btn btn-block btn-lg rounded-pill text-white">Send Link<i class="fas fa-angles-right float-right"></i></button>
                      </div>
                      <div class="col-0 col-xs-0 col-sm-0 col-md-2 col-lg-2 col-xl-2"></div>
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
