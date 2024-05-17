<?php
$baseurl=base_url()."/public/landingpage/";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title> Hello Vegans</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Poppins:wght@200;600;700&display=swap"
        rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@6.11.0/css/flag-icons.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Libraries Stylesheet -->
    <link href="<?php echo $baseurl;?>lib/animate/animate.min.css" rel="stylesheet">
    <link href="<?php echo $baseurl;?>lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?php echo $baseurl;?>css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="<?php echo $baseurl;?>css/style.css" rel="stylesheet">
    <link href="/public/khalid/css/custom.css" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->




    <!-- Hero Start -->
    <div class="container-fluid  bg_top hero-header mb-5">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="text-right">
                        <div id="google_translate_element" class="mt-5"></div>
                        <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
                        <script type="text/javascript">
                            function googleTranslateElementInit() {
                                new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
                            }
                        </script>
                    </div>
                </div>
            </div>
            <div class="row g-5 align-items-center">
                <div class="col-lg-6  col-md-6 text-center text-lg-start">
                <div class="logo_page"> <img src="<?php echo $baseurl;?>images/logo.png"></div>
                     <h1 class="topbanner animated slideInRight"><?= lang('app.homepage._1'); ?></h1>

                 </div>
                <div class="col-lg-6  col-md-6 ">
                <div class="form_login">
                   <form >

            <button class="login" onclick="return redirect_url('<?php echo base_url();?>/user/login')"><?= lang('app.global.log_in'); ?></button>

            <hr>
            <button class="create-account" onclick="return  redirect_url('<?php echo base_url();?>/user/register')"><?= lang('app.global.create_new_account'); ?></button>
          </form></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->


    <!-- Feature Start -->
    <div class="container-fluid py-5">
        <div class="container">
  <div class="mx-auto text-center wow fadeIn" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="text-primary mb-3"><span class="fw-light text-dark"> <?=lang('app.homepage.explore_the')?> </span> <?=lang('app.homepage._2')?> </h1>
             </div><br>

            <div class="row g-4">
                <div class="col-lg-4 col-md-6 wow fadeIn" data-wow-delay="0.1s">
                    <a href="/user/dashboard" class="">
                        <div class="feature-item position-relative bg-primary text-center p-3">
                            <div class="border py-5 px-3">
                                <i class="fa fa-leaf fa-3x text-dark mb-4"></i>
                                <h5 class="text-white mb-0"><?=lang('app.homepage._3')?></h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeIn" data-wow-delay="0.3s">
                    <a href="/user/blog" class="">
                        <div class="feature-item position-relative bg-primary text-center p-3">
                            <div class="border py-5 px-3">
                                <i class="fa fa-blog fa-3x text-dark mb-4"></i>
                                <h5 class="text-white mb-0"> <?=lang('app.global.blog')?> </h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeIn" data-wow-delay="0.5s">
                    <a href="/user/news" class="">
                        <div class="feature-item position-relative bg-primary text-center p-3">
                            <div class="border py-5 px-3">
                                <i class="fa fa-newspaper-o fa-3x text-dark mb-4"></i>
                                <h5 class="text-white mb-0"> <?=lang('app.global.news')?> </h5>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-4 col-md-6 wow fadeIn" data-wow-delay="0.5s">
                    <a href="/user/event" class="">
                        <div class="feature-item position-relative bg-primary text-center p-3">
                            <div class="border py-5 px-3">
                                <i class="fa fa-calendar-o fa-3x text-dark mb-4"></i>
                                <h5 class="text-white mb-0">  <?=lang('app.global.event')?>  </h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeIn" data-wow-delay="0.5s">
                    <a href="/user/userrecipelist" class="">
                        <div class="feature-item position-relative bg-primary text-center p-3">
                            <div class="border py-5 px-3">
                                <i class="fa fa-birthday-cake fa-3x text-dark mb-4"></i>
                                <h5 class="text-white mb-0"> <?=lang('app.global.recipe')?> </h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeIn" data-wow-delay="0.5s">
                    <a href="/user/recommendation" class="">
                        <div class="feature-item position-relative bg-primary text-center p-3">
                            <div class="border py-5 px-3">
                                <i class="fa fa-thumbs-up fa-3x text-dark mb-4"></i>
                                <h5 class="text-white mb-0"> <?=lang('app.global.recommendation')?> </h5>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Feature End -->


    <!-- About Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <img class="img-fluid animated pulse infinite" src="<?php echo $baseurl;?>images/logo.png">
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <h1 class="text-primary mb-4"><span class="fw-light text-dark"><?=lang('app.homepage._4')?> </span> Hello Vegans.</h1>
                    <p class="mb-4"><?=lang('app.homepage._5')?></p>
                    <a class="btn btn-primary py-2 px-4" href="<?php echo base_url();?>/user/register"><?= lang('app.global.create_new_account'); ?></a>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->



    <!-- Blog Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="mx-auto text-center wow fadeIn" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="text-primary mb-3"><span class="fw-light text-dark"><?=lang('app.homepage._6')?></span> <?=lang('app.homepage._7')?></h1>
                <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis aliquet, erat non malesuada consequat, nibh erat tempus risus.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay="0.1s">
                    <div class="blog-item border h-100 p-4">
                        <img class="img-fluid mb-4" src="<?php echo $baseurl;?>images/blog-1.jpg" alt="">
                        <a href="" class="h5 lh-base d-inline-block">Foods that are good for your hair growing</a>
                        <div class="d-flex text-black-50 mb-2">
                            <div class="pe-3">
                                <small class="fa fa-eye me-1"></small>
                                <small>9999 Views</small>
                            </div>
                            <div class="pe-3">
                                <small class="fa fa-comments me-1"></small>
                                <small>9999 Comments</small>
                            </div>
                        </div>
                        <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis aliquet, erat non malesuada consequat.</p>
                        <a href="<?php echo base_url();?>/user/login" class="btn btn-outline-primary px-3">Read More</a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay="0.3s">
                    <div class="blog-item border h-100 p-4">
                        <img class="img-fluid mb-4" src="<?php echo $baseurl;?>images/blog-2.jpg" alt="">
                        <a href="" class="h5 lh-base d-inline-block">How to take care of hair naturally</a>
                        <div class="d-flex text-black-50 mb-2">
                            <div class="pe-3">
                                <small class="fa fa-eye me-1"></small>
                                <small>9999 Views</small>
                            </div>
                            <div class="pe-3">
                                <small class="fa fa-comments me-1"></small>
                                <small>9999 Comments</small>
                            </div>
                        </div>
                        <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis aliquet, erat non malesuada consequat.</p>
                        <a href="<?php echo base_url();?>/user/login" class="btn btn-outline-primary px-3">Read More</a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay="0.5s">
                    <div class="blog-item border h-100 p-4">
                        <img class="img-fluid mb-4" src="<?php echo $baseurl;?>images/blog-3.jpg" alt="">
                        <a href="" class="h5 lh-base d-inline-block">How to use our natural & organic shampoo</a>
                        <div class="d-flex text-black-50 mb-2">
                            <div class="pe-3">
                                <small class="fa fa-eye me-1"></small>
                                <small>9999 Views</small>
                            </div>
                            <div class="pe-3">
                                <small class="fa fa-comments me-1"></small>
                                <small>9999 Comments</small>
                            </div>
                        </div>
                        <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis aliquet, erat non malesuada consequat.</p>
                        <a href="<?php echo base_url();?>/user/login" class="btn btn-outline-primary px-3">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Blog End -->


    <!-- Newsletter Start -->
    <div class="container-fluid newsletter bg-primary py-5 my-5">
        <div class="container py-5">
            <div class="mx-auto text-center wow fadeIn" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="text-white mb-3"><span class="fw-light text-dark"><?=lang('app.homepage._8')?></span> <?=lang('app.homepage._9')?></h1>
                <p class="text-white mb-4">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-7 wow fadeIn" data-wow-delay="0.5s">
                    <div class="position-relative w-100 mt-3 mb-2">
                        <input id="newslatter_email" class="form-control w-100 py-4 ps-4 pe-5" type="text" placeholder="Enter Your Email"
                            style="height: 48px;">
                        <button type="button" id="send_news_latter" class="btn shadow-none position-absolute top-0 end-0 mt-1 me-2"><i
                                class="fa fa-paper-plane text-white fs-4"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Newsletter End -->


    <!-- Footer Start -->
    <div class="container-fluid bg-white footer">
         <div class="container wow fadeIn" data-wow-delay="0.1s">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-7 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="#">Hello Vegans</a>, All Right Reserved.
                         Designed By <a class="border-bottom" href="https://www.acentriatech.com/"> Hello Vegan</a>
                    </div>
                    <div class="col-md-5 text-center text-md-end">
                        <div class="footer-menu">

							<a href="<?php echo base_url();?>">Home</a>
                            <a href="<?php echo base_url();?>/about">About</a>
							<a href="<?php echo base_url();?>/cookies">Cookies</a>
                            <a href="<?php echo base_url();?>/privacy">Privacy</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo $baseurl;?>lib/wow/wow.min.js"></script>
    <script src="<?php echo $baseurl;?>lib/easing/easing.min.js"></script>
    <script src="<?php echo $baseurl;?>lib/waypoints/waypoints.min.js"></script>
    <script src="<?php echo $baseurl;?>lib/owlcarousel/owl.carousel.min.js"></script>
    <!-- Template Javascript -->
    <script src="<?php echo $baseurl;?>js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

</body>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-QB0C51JNRM"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'G-QB0C51JNRM');
</script>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-5HGQSW7M');</script>
<!-- End Google Tag Manager -->
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5HGQSW7M"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<script type="text/javascript">
    _linkedin_partner_id = "6163036";
    window._linkedin_data_partner_ids = window._linkedin_data_partner_ids || [];
    window._linkedin_data_partner_ids.push(_linkedin_partner_id);
</script><script type="text/javascript">
    (function(l) {
        if (!l){window.lintrk = function(a,b){window.lintrk.q.push([a,b])};
            window.lintrk.q=[]}
        var s = document.getElementsByTagName("script")[0];
        var b = document.createElement("script");
        b.type = "text/javascript";b.async = true;
        b.src = "https://snap.licdn.com/li.lms-analytics/insight.min.js";
        s.parentNode.insertBefore(b, s);})(window.lintrk);
</script>

<script>
function redirect_url(urls){;
	window.location.href =urls;
	return false;
}
$(document).ready(function(){
    $(".select2-init").select2();
  $("#send_news_latter").click(function(){
  if($("#newslatter_email").val()==''){
	  alert("Please insert email");
	  return false;
  }
jQuery.ajax({
url: '<?php echo base_url();?>/landingpage/sendNewsLatter',
type: 'POST',
data:{'email':$("#newslatter_email").val()},
  success: function(data) {
  $("#newslatter_email").val('');
    alert("Subscribe Successfully");
  }
});
  });
});
</script>
</html>