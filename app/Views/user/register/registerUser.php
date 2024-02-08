<?php echo  $this->extend('user/templates/register_template'); ?>

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
          <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 right-side card rounded p-3">
            <div class="logo_login"><img src="<?php echo $public_url;?>images/logo.png" alt="Company Logo"></div>
                <h2>Sign-up</h2>
                <!--Form with header-->
                <div class="form">

				<form action="<?php echo base_url('user/insert-user');?>" method="post" enctype="multipart/form-data" id="registerForm" name="registerForm" >
                  <div class="sign_up">
                    <div id="tabs">
                      <div class="row">
                        <div class="sign_uptab">
                        <div class="tab_contentform">
                          <div class="row">
                           <div class="col-lg-6 col-md-12 col-sm-12 form_mobilepadding">
                            <div class="form-group">
                              <label for="Name">Name <span>*</span></label>
                              <input type="text" name="name" id="name"  class="form-control" placeholder="Name" onkeypress="return valueonchange(this.id)">
							  <span class="error_class" id="error_name">Please fill name</span>
                            </div>
                           </div>
                           <div class="col-lg-6 col-md-12 col-sm-12 form_mobilepadding">
                             <div class="form-group">
                               <label for="Username">Email<span>*</span></label>
                                <input type="text" name="email" id="email"  class="form-control" placeholder="Email" onblur="return checkEmail('<?php echo site_url();?>');" onkeypress="return valueonchange(this.id)" autocomplete="off">
								<span class="error_class" id="error_email">Please fill email</span>
								<span class="error_class" id="error_email_valid">Please fill valid email</span>
								<span style="display:none;color:red" id="error_same_email">Email is already taken</span>
                              </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12 form_mobilepadding">
                              <div class="form-group">
                               <label for="Number">Password <span>*</span></label>
                               <input id="password-field" name="password" type="password" class="form-control" name="password" value="" onkeypress="return valueonchange(this.id)" placeholder="Password">
							   <span class="error_class" id="error_password_field">Please fill Password</span>
							   <span class="error_class" id="error_less_password_field">Please fill Password at least 6 characters</span>
                               <div class="form_icon pwsicon">
							     <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
							    </div>
                              </div>
                             </div>
                             <div class="col-lg-6 col-md-12 col-sm-12 form_mobilepadding">
                                <div class="form-group">
                                 <label for="Number">Retype Password <span>*</span></label>
                                 <input id="rpassword-field" type="password" class="form-control"  value="" onkeypress="return valueonchange(this.id)" placeholder="Retype Password">
								 <span class="error_class" id="error_rpassword_field">Please fill password</span>
								 <span class="error_class" id="error_same_password_field">Password and Retype Password should be same</span>
                                 <div class="form_icon pwsicon">
								   <span toggle="#rpassword-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
								 </div>
                                </div>
                              </div>
							<div class="col-lg-6 col-md-12 col-sm-12 form_mobilepadding">
                                    <div class="form-group">
                                      <label for="Number">Mobile No <span>*</span></label>
                                      <div class="row pading_rightbx">

                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 padinlogin form_mobilepadding">
                                          <input type="text"  name="mobile_no" id="mobile_no" class="form-control" placeholder="Mobile No">
										  <input id="callingcode" type="hidden" name="callingcode" value="+91">
                                        </div>
                                      </div>
                                    </div>
                                  </div>

							<div class="col-lg-6 col-md-12 col-sm-12 form_mobilepadding">
                             <div class="form-group">
							 <label for="Username">&nbsp;</label>
                               <div class="g-recaptcha" data-sitekey="<?=RECAPTCHA_SITE_KEY?>"></div>
                              </div>
                            </div>
							<div class="col-md-12 col-sm-12">
                             <div class="tacbox">
							  <input id="checkbox" type="checkbox" onchange="valueonchange(this.id)" />
							  <label for="checkbox"> I agree to the Terms and Conditions<br>By clicking Sign Up, you agree to our <a href="<?php echo base_url().'/terms';?>">Terms and Conditions.</a> </label>
							</div>
                             <span class="error_class" id="error_check_term">Please Check this</span>
                            </div>
							 </div>
							   <div class="text-xs-center loginbuttonsignup loginbuttonsignup_mobile ">
								 <a  onclick="submitForm();"  class="btn loginbutton ">Register
								  <span>
								 <img src="<?php echo $public_url;?>images/back_arrow.svg" alt="img">
								 </span>
								 </a>
								</div>
								<div class="alreadyaccount alreadyaccount_ipad">Already have an account?
								<a href="<?php echo site_url();?>user/login">Login</a>
								</div>
                        </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="btmtext">
                    <h6>**Please insert authentic data; it will send to admin for approval</h6>
                  </div>
				  </form>
                </div>
                <!--/Form with header-->
                
              </div>
              <div class="col">
                  <div id="animation-container"></div>
                  <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.12.2/lottie.min.js" integrity="sha512-jEnuDt6jfecCjthQAJ+ed0MTVA++5ZKmlUcmDGBv2vUI/REn6FuIdixLNnQT+vKusE2hhTk2is3cFvv5wA+Sgg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                  <script>
                      // Replace 'animation.json' with the path to your animation JSON file.
                      lottie.loadAnimation({
                          container: document.getElementById('animation-container'), // The ID of the container div
                          renderer: 'svg', // You can use 'canvas' or 'html' as well
                          loop: true, // Set to true if you want the animation to loop
                          autoplay: true, // Set to true if you want the animation to start automatically
                          path: '/public/pitesh/json/_5.json' // Path to your animation JSON file
                      });
                  </script>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
   
</main>
<style> 
.g-recaptcha {
    transform:scale(0.79);
    transform-origin:0 0;
} 
.tacbox {
display: block;
padding: 1em;
background-color: #fff;
max-width: 818px;
border-radius:5px;
}

#checkbox {
  height: 20px;
  width: 20px;
  vertical-align: top;
margin-right: 7px;
}
.error_class{
	color: red;font-size: 14px;margin-top: 3px;font-weight: bold;display:none;
}
</style>

 
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css"> 
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput-jquery.min.js"></script>
<script>
// -----Country Code Selection
$("#mobile_no").intlTelInput({
	initialCountry: "in",
	separateDialCode: true,
	// utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.4/js/utils.js"
});

function submitForm(){
	
	$("#callingcode").val($(".iti__selected-dial-code").html());
	
	var flag=0;
	var name=$("#name").val();
	var email=$("#email").val();
	var password_field=$("#password-field").val();
	var rpassword_field=$("#rpassword-field").val();
	
	if(name==''){
	document.getElementById('error_name').style.display='block';
	document.getElementById("name").focus();
    flag=1;	
	}
	if(email==''){
	document.getElementById('error_email').style.display='block';
	document.getElementById("email").focus();
    flag=1;	
	}
	if(password_field==''){
	document.getElementById('error_password_field').style.display='block';
	document.getElementById("password-field").focus();
    flag=1;	
	}
	if(rpassword_field==''){
	document.getElementById('error_rpassword_field').style.display='block';
	document.getElementById("rpassword-field").focus();
    flag=1;	
	}
	if(password_field!='' && rpassword_field!=''){
		if(password_field.length<6){
		document.getElementById('error_less_password_field').style.display='block';
		document.getElementById("password-field").focus();
          flag=1;		
		}
		if(password_field!=rpassword_field){
		document.getElementById('error_same_password_field').style.display='block';
		document.getElementById("password-field").focus();
		flag=1;
		}
		
	}
	if(email!=''){
	  if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)){
        
       }else{
		document.getElementById('error_email_valid').style.display='block';
	    document.getElementById("email").focus();
        flag=1;	   
	   }

	}
	if(alreadyTaken==1){
		$("#error_same_email").css('display','block');
		document.getElementById("email").focus();
		flag=1;
	}
    if(document.getElementById('checkbox').checked==false){
		$("#error_check_term").css('display','block');
		flag=1;
	}
	if(flag==1){
		return false;
	}else{
	document.getElementById("registerForm").submit(); 	
	}
	
}
</script>
<?php echo  $this->endSection(); ?>
