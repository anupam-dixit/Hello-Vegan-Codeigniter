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
              <div class="row mb-3">
                  <div class="col"></div>
                  <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                      <div class="text-center">
                          <?=lang('app.global.follow_us')?>
                          <a target="_blank" href="https://facebook.com" class="ml-1 mr-1">
                              <img src="https://cdn-icons-png.flaticon.com/128/1384/1384053.png" height="25" width="25">
                          </a>
                          <a target="_blank" href="https://instagram.com" class="ml-1 mr-1">
                              <img src="https://cdn-icons-png.flaticon.com/128/1409/1409946.png" height="25" width="25">
                          </a>
                          <a target="_blank" href="https://linkedin.com" class="ml-1 mr-1">
                              <img src="https://cdn-icons-png.flaticon.com/128/3536/3536505.png" height="25" width="25">
                          </a>
                          <a target="_blank" href="https://youtube.com" class="ml-1 mr-1">
                              <img src="https://cdn-icons-png.flaticon.com/128/174/174883.png" height="25" width="25">
                          </a>
                      </div>
                  </div>
              </div>
            <div class="row" style="margin-right: 0;margin-left: 0;">


              <!--col-sm-6-->

              <div class="col-md-7 col-sm-6 col-12">
              <div class="logo_login"><img src="<?php echo $public_url;?>images/logo.png" alt="Company Logo"></div>
                <center>
                    <h2 class="font-poppins animate__animated animate__zoomIn" style="color: #40590B;text-align: center;"><?= lang('app.global.welcome_back'); ?> </h2>
                    <!--Form with header-->
                    <div class="form">


                        <form action="<?php echo base_url('user/loginAuth');?>" method="post" enctype="multipart/form-data" id="loginForm" name="loginForm" onsubmit="return submitLoginForm()">

                            <div class="row">
                                <div class="col"></div>
                                <div class="col-12 col-xs-12 col-sm-12 col-md-10 col-lg-8">
                                    <div class="input-group animate__animated animate__fadeInLeft mb-3 w-100">
                                        <input type="text" id="email" name="email" class="form-control" placeholder="Username" onkeypress="return valueonchange(this.id)">
                                        <div class="form_icon email ml-2"> <img height="20" width="20" src="https://cdn-icons-png.flaticon.com/128/1144/1144760.png" alt="icon"> </div>
                                        <span class="error_class" id="error_email"><?= lang('app.login._2'); ?></span>
                                        <span class="error_class" id="error_email_valid"><?= lang('app.login._3'); ?></span>
                                    </div>
                                </div>
                                <div class="col"></div>
                            </div>
                            <div class="row">
                                <div class="col"></div>
                                <div class="col-12 col-xs-12 col-sm-12 col-md-10 col-lg-8">
                                    <div class="form-group animate__animated animate__fadeInRight">
                                        <input placeholder="Password" id="password-field" type="password" class="form-control" name="password" value="" onkeypress="return valueonchange(this.id)">
                                        <div class="form_icon pwsicon"> <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span> </div>
                                        <span class="error_class" id="error_password_field"><?= lang('app.login._4'); ?></span>
                                    </div>
                                </div>
                                <div class="col"></div>
                            </div>
                            <div class="row">
                                <div class="col"></div>
                                <div class="col-12 col-xs-12 col-sm-12 col-md-10 col-lg-8">
                                    <div class="forgot_password mb-3">
                                        <a style="color: #365819" class="text-right mb-3" href="<?php echo site_url();?>user/forgot-password"><?= lang('app.global.forgot_password'); ?></a>
                                    </div>
                                    <div class="text-xs-center">
                                        <button type="submit" name="submit" id="submit" style="background: #365819" class="btn btn-block btn-lg rounded-pill text-white"><?= lang('app.global.log_in'); ?><i class="fas fa-angles-right float-right"></i></button>
                                        <!--				 <a  class="btn loginbutton "> <input style="background:none;border:none;color:#fff" type="submit" name="submit" id="submit" value="Login"><span>-->
                                        <!--				    <img src="--><?php //echo $public_url;?><!--images/back_arrow.svg" alt="img">-->
                                        <!--				  </span></a>-->
                                    </div>
                                </div>
                                <div class="col"></div>
                            </div>

                        </form>
                        <div class="dontaccount text-center"><?= lang('app.login._1'); ?> <a href="<?php echo site_url();?>user/register"><?= lang('app.global.sign_up'); ?></a></div>

                    </div>
                    <!--/Form with header-->
                </center>


              </div>
              <!--col-sm-6-->

              <div class="col-md-5 col-sm-6 left-side_ border-left">
                  <center>
                      <div id="animation-container"></div>

                      <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.12.2/lottie.min.js" integrity="sha512-jEnuDt6jfecCjthQAJ+ed0MTVA++5ZKmlUcmDGBv2vUI/REn6FuIdixLNnQT+vKusE2hhTk2is3cFvv5wA+Sgg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                      <script>
                          // Replace 'animation.json' with the path to your animation JSON file.
                          lottie.loadAnimation({
                              container: document.getElementById('animation-container'), // The ID of the container div
                              renderer: 'svg', // You can use 'canvas' or 'html' as well
                              loop: true, // Set to true if you want the animation to loop
                              autoplay: true, // Set to true if you want the animation to start automatically
                              path: '/public/pitesh/json/_<?=rand(1,4)?>.json' // Path to your animation JSON file
                          });
                      </script>

                  </center>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

</main>

<?php echo  $this->endSection(); ?>
