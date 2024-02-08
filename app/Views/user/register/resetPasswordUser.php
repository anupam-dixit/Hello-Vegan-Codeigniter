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
                <h2>Reset Password</h2>
                
                <!--Form with header-->
                <div class="form">
				
<form action="<?php echo base_url('user/resetForgotPassword');?>" method="post" enctype="multipart/form-data" id="resetPasswordForm" name="resetPasswordForm" onsubmit="return submitResetForm()" >                 
				 <div class="form-group">
                    <input type="hidden" name="code" value="<?php echo $_GET['code'];?>">
					<input id="password-field" type="password" class="form-control" name="password" placeholder="Password" onkeypress="return valueonchange(this.id)">
                    <div class="form_icon pwsicon"> <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span> </div>
					<span class="error_class" id="error_password_field">Please fill Password</span>
					<span class="error_class" id="error_less_password_field">Please fill Password at least 6 characters</span>
                  </div>
					<div class="form-group">
                    <input id="rpassword-field" type="password" class="form-control" name="password" placeholder="Retype Password" onkeypress="return valueonchange(this.id)">
                    <div class="form_icon pwsicon"> <span toggle="#rpassword-field" class="fa fa-fw fa-eye field-icon toggle-password"></span> </div>
					<span class="error_class" id="error_rpassword_field">Please fill retype password</span>
								 <span class="error_class" id="error_same_password_field">Password and Retype Password should be same</span>
                  </div>		
                  <div class="text-xs-center"> 
				    <a  class="btn loginbutton "> 
					<input style="background:none;border:none;color:#fff" type="submit" name="submit" id="submit" value="submit">
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
