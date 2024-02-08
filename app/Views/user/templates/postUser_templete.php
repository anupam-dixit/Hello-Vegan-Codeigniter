<?php
$public_url=base_url()."/public/frontend/";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>Hello-Vegans</title>
<?php
/* echo "<pre>";
print_r(session()->get());
die; */
?>
<!-- Bootstrap -->
<link href="<?php echo $public_url;?>css/bootstrap.css" rel="stylesheet">
<link href="<?php echo $public_url;?>css/style.css" rel="stylesheet">
<link href="<?php echo $public_url;?>css/home_page.css" rel="stylesheet">
<link href="<?php echo $public_url;?>css/responsive.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel='stylesheet' href='<?php echo base_url().'/public/frontend/';?>css/owl.carousel.min.css'>
   <style> #owl-demo .item{
  margin: 3px;
}
#owl-demo .item img{
  display: block;
  width: 100%;
}  </style>

<style> #owl-demo .item{
  margin: 3px;
}
 .owl-carousel .owl-nav button.owl-prev{
   color: darkcyan; !important;
   position: absolute;
   top: 30%;
   left: 0;
   font-size: 30px;
   background: no-repeat 50% / 100% 100% !important;
 }
 .owl-carousel .owl-nav button.owl-next{
  color: darkcyan !important;
  font-size: 30px;
  position: absolute;
   top: 30%;
   right: 10px;
   background: no-repeat 50% / 100% 100% !important;

 }


.owl-stage {
  width: 700% !important;
  display: block;
  transform: translate3d(-460px, 0px, 0px);
    transition: all 0s ease 0s;

    
}
 </style>
 
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
      <?= $this->renderSection('content') ?>
<link rel="stylesheet" href="<?php echo $public_url;?>js/slider/photoswipe.css">
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="<?php echo $public_url;?>js/bootstrap.min.js"></script> 
 <script type="module">
import PhotoSwipeLightbox from '<?php echo $public_url;?>js/slider/photoswipe-lightbox.esm.js';
const lightbox = new PhotoSwipeLightbox({
  gallery: '#gallery--getting-started',
  children: 'a',
  pswpModule: () => import('<?php echo $public_url;?>js/slider/photoswipe.esm.js')
});
lightbox.init();
</script>
</body>
</html>