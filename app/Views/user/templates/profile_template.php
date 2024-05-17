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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="<?=base_url()?>/public/khalid/css/custom.css" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<?php
/* echo "<pre>";
print_r(session()->get());
die; */
?>
<style type="text/css">
    body{
        direction: <?=lang('app.global.direction')?>;
    }
    .box {
    padding: 0.5em;
    width: 100%;
    margin:0.5em;
}

.box-2 {
    padding: 0.5em;
    width: calc(100%/2 - 1em);
}

.btn{
    background:white;
    color:black;
    border:1px solid black;
    padding: 0.5em 1em;
    text-decoration:none;
    margin:0.8em 0.3em;
    display:inline-block;
    cursor:pointer;
}

.hide {
    display: none;
}

img {
    max-width: 100%;
}


</style>

<!-- Bootstrap -->
<!--<link href="--><?php //echo $public_url;?><!--css/bootstrap.css" rel="stylesheet">-->
<link href="<?php echo $public_url;?>css/style.css" rel="stylesheet">
<link href="<?php echo $public_url;?>css/home_page.css" rel="stylesheet">
<link href="<?php echo $public_url;?>css/responsive.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel='stylesheet' href='<?php echo base_url().'/public/frontend/';?>css/owl.carousel.min.css'>
<link rel='stylesheet' href='<?php echo base_url().'/public/khalid/css/profile.css';?>'>
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link href="https://cdn.jsdelivr.net/gh/lokesh/lightbox2@2.11.4/dist/css/lightbox.min.css" rel="stylesheet" />
</head>
<style> #owl-demo .item{
  margin: 3px;
}
 .owl-carousel .owl-nav button.owl-prev{
   color: grey; !important;
   position: absolute;
   top: 30%;
   left: 0;
   font-size: 30px;
   background: no-repeat 50% / 100% 100% !important;
 }
 .owl-carousel .owl-nav button.owl-next{
  color: grey !important;
  font-size: 30px;
  position: absolute;
   top: 30%;
   right: 10px;
   background: no-repeat 50% / 100% 100% !important;

 }
/*.owl-carousel{
   width: 50% !important;
   display: block;
}*/

/*.slider-section {
    width: 50% !important%;
    float: left;
}*/
/*.owl-carousel.owl-drag .owl-item {
 width: 200px !important;
 height: 300px ! !important;
}*/
.owl-stage {
  width: 700% !important;
  display: block;
  transform: translate3d(-460px, 0px, 0px);
    transition: all 0s ease 0s;

    
}
/*#owl-demo .item img{
  display: block;
  width: 100%;
  height: auto;
} */ </style>
<body>
      <?= $this->renderSection('content') ?>
<?php echo  $this->include('user/templates/chat_template'); ?>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 

<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/0.8.1/cropper.min.js"></script> 
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<!--<script src="--><?php //echo $public_url;?><!--js/bootstrap.min.js"></script> -->
<script src='<?php echo base_url().'/public/frontend/';?>js/owl.carousel.min.js'></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="<?php echo $public_url;?>js/slider/photoswipe.css">
      <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<script src="https://cdn.jsdelivr.net/gh/lokesh/lightbox2@2.11.4/dist/js/lightbox.min.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/gustavosmanc/cute-alert@master/style.css" />
      <script src="https://cdn.jsdelivr.net/gh/gustavosmanc/cute-alert@master/cute-alert.js"></script>
      <script>
    $(document).ready(function (e) {
        $("#veganpostform").on('submit',(function(e) {
            e.preventDefault();
            var imgs=document.getElementById('create_post_image').files.length;

            if($("#create_post_content").val()=='' && imgs==0){
                alert("Please Enter Content or Add a image");
                return false;
            }

            $('#loading').show();
            $.ajax({
                url: "/user/insertProfilePost",
                type: "POST",
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                beforeSend : function()
                {
                    //$("#preview").fadeOut();
                    //$("#err").fadeOut();
                },
                success: function(data)
                {
                    console.log(data);
                    alert('Post submit');
                    createpostpopup_close();
                    $('#loading').hide();
                    //alert(data);
                    $('.post_rightside').prepend(data);
                    return false;

                },
                error: function(e)
                {
                    $('#loading').hide();
                    createpostpopup_close();
                }
            });
            return false;
        }));
    });

    // vars
let result = document.querySelector('.result'),
img_result = document.querySelector('.img-result'),
img_w = document.querySelector('.img-w'),
img_h = document.querySelector('.img-h'),
options = document.querySelector('.options'),
save = document.querySelector('.save'),
cropped = document.querySelector('.cropped'),
dwn = document.querySelector('.download'),
upload = document.querySelector('#create_post_image'),
cropper = '';

// on change show image with crop options
upload.addEventListener('change', (e) => {
  if (e.target.files.length) {
        // start file reader
    const reader = new FileReader();
    reader.onload = (e)=> {
      if(e.target.result){
                // create new image
                let img = document.createElement('img');
                img.id = 'image';
                img.src = e.target.result
                // clean result before
                result.innerHTML = '';
                // append new image
        result.appendChild(img);
                // show save btn and options
                save.classList.remove('hide');
                options.classList.remove('hide');
                // init cropper
                cropper = new Cropper(img);
      }
    };
    reader.readAsDataURL(e.target.files[0]);
  }
});

// save on click
save.addEventListener('click',(e)=>{
  e.preventDefault();
  // get result to data uri
  let imgSrc = cropper.getCroppedCanvas({
        width: img_w.value // input value
    }).toDataURL();
  // remove hide class of img
  cropped.classList.remove('hide');
    img_result.classList.remove('hide');
    // show image cropped
  cropped.src = imgSrc;
  dwn.classList.remove('hide');
  dwn.download = 'imagename.png';
  dwn.setAttribute('href',imgSrc);
});





$(document).ready(function() {
    setTimeout(function() {
        googleTranslateElementInit()
    },500);
  $(".noti").on('click',function() {
    $(this).find('ul').toggle();
  });
});
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
    }
$(document).ready(function() {
    $("#menuButton").on("click", function(){
        $(".side-a").toggleClass("is-open");
        $("html").toggleClass("is-nav-open");
    });
      $("#darkMode").on("click", function(){
        $("html").toggleClass("is-dark");
    });
});
function submitpostcomments(id){
	const form = document.querySelector('#postcommentform_'+id);
	//$('#loading').show();
  var messagecomments=document.getElementById('messagecomments_'+id).value;
  if(messagecomments==''){
	  alert("Please enter message");
	  return false;
  }
  $.ajax({
         url: "/user/insert-post-comment-user",
   type: "POST",
   data:  new FormData(form),
   contentType: false,
         cache: false,
   processData:false,
   beforeSend : function()
   {
   },
   success: function(data)
      {
		 
		  alert('Comments submit');
		 $('.commentList_'+id).prepend(data);
		  //$('#aftercomments').html(data);
		 var cnts=parseInt($("#cnt_"+id).html());
		 cnts+=1;
		 $("#cnt_"+id).html(cnts);
		  document.getElementById('messagecomments_'+id).value='';
		 //$(".commentList").animate({ scrollTop: $(".commentList")[0].scrollHeight}, 1000);
		 $(".commentList"+id).animate({ scrollTop: 0}, 1000);
		  return false;
    
      },
     error: function(e) 
      {
		  $('#loading').hide();

      }          
    });
	return false;

}
$(document).ready(function(){
    $('#country').autocomplete({
    minLength: 0,
    source: function(request, response) {
       $.ajax({
                url: "/user/get-country-list",
                dataType:'json',
                type : "post",
                data: {
                    search: request.term
                },
        success: function (datas) {
           if (datas.length > 0){
            var data = $.grep(datas, function(value) {
                    return value;
                        });
                    response(datas);            
           }else{
            
           } 
                        
                }
            });   

    },
  select: function (e, u) {
	 // console.log(u.item.id);
	  $("#State").val('');
        $("#countryId").val(u.item.id);
		if (u.item.value == -1) {
                    $("#country").val('');
          return false;
                }
            }
}).focus(function () {
      $(this).autocomplete("search", "");
  
  
});

});
$(document).ready(function(){
    $('#State').autocomplete({
    minLength: 0,
    source: function(request, response) {
       $.ajax({
                url: "https://hello-vegans.com/user/get-state-list",
                dataType:'json',
                type : "post",
                data: {
                    search: request.term,
					countryId:$("#countryId").val()
                },
        success: function (datas) {
           if (datas.length > 0){
            var data = $.grep(datas, function(value) {
                    return value;
                        });
                    response(datas);            
           }else{
            
           } 
                        
                }
            });   

    },
  select: function (e, u) {
        if (u.item.value == -1) {
                    $("#State").val('');
          return false;
                }
            }
}).focus(function () {
      $(this).autocomplete("search", "");
  
  
});

});
function addpostlike(id,likestatus){
		$.ajax({
         url: "/user/insert-post-like-user",
   type: "POST",
   data:  'post_id='+id+'&status='+likestatus,
   beforeSend : function()
   {
   },
   success: function(data)
      {
         var likecnt=parseInt($('#like_cnt_'+id).html());
		 
		if(likestatus==1){
			likecnt=likecnt+1;
			document.getElementById('like_'+id).style.display="none";
			document.getElementById('unlike_'+id).style.display="inline-block";
		}else{
			likecnt=likecnt-1;
			document.getElementById('like_'+id).style.display="inline-block";
			document.getElementById('unlike_'+id).style.display="none";
		}
      $('#like_cnt_'+id).html(likecnt);
      },
     error: function(e) 
      {
		  //$('#loading').hide();

      }          
    });
	}
function createpostpopup_open(){
	 $("#createpost").css({"visibility": "visible", "opacity": "1"});
 }   
 function createpostpopup_close(){
	 $("#createpost").css({"visibility": "hidden", "opacity": "0"});
	 $('#veganpostform')[0].reset();
 }


 function createPost() {

 }


function showoldercomments(id,types){
	if(types=='hide'){
	$.ajax({
         url: "<?php echo base_url();?>/user/post/show-older-comment",
   type: "POST",
   data:  'id='+id,
   beforeSend : function()
   {
   },
   success: function(data)
      {
		 $('#showall_'+id).css('display','none');
		 $('#hideall_'+id).css('display','inline-block');
		 $('.commentList_'+id).append(data);
		  return false;
    
      },
     error: function(e) 
      {
		  $('#loading').hide();

      }          
    });
	}else{
	$('.commentList_'+id+'>li:gt(2)').remove();	
	$('#showall_'+id).css('display','inline-block');	
	$('#hideall_'+id).css('display','none');	
	}
}
function unfriend(id){
	$.ajax({
   url: "<?php echo base_url();?>/user/unfriend",
   type: "POST",
   data:  'id='+id,
   beforeSend : function()
   {
   },
   success: function(data)
      {
		 alert("Unfriend Successfully");
		 $('#addfriend').css('display','inline-block');
		 $('#unfriend').css('display','none');
		  return false;
    
      },
     error: function(e) 
      {
		  $('#loading').hide();

      }          
    });
}
function friend_request_send(id){
	$.ajax({
   url: "<?php echo base_url();?>/user/friend-request-send",
   type: "POST",
   data:  'id='+id,
   beforeSend : function()
   {
   },
   success: function(data)
      {
		 alert("Request Send");
		  $('#addfriend').css('display','none');
		 $('#cancel').css('display','inline-block');
		
		  return false;
    
      },
     error: function(e) 
      {
		  $('#loading').hide();

      }          
    });
}
function cancel_request(id){
	$.ajax({
   url: "<?php echo base_url();?>/user/cancel-request",
   type: "POST",
   data:  'id='+id,
   beforeSend : function()
   {
   },
   success: function(data)
      {
		 alert("Request Cancel");
		 // $('#requestsend').css('display','none');
          $('#cancel').css('display','none');
		 $('#addfriend').css('display','inline-block');
		  return false;
    
      },
     error: function(e) 
      {
		  $('#loading').hide();

      }          
    });
}

</script>
<script>
/* $('.home_silder1').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
      autoplay:true,
      autoplayTimeout:5000,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1000:{
            items:3
        }
    }
}); */

  /*     $(document).ready(function() {
 
  $("#owl-demo").owlCarousel({
 
      autoPlay: 3000, //Set AutoPlay to 3 seconds
 
      items : 4,
      itemsDesktop : [1199,3],
      itemsDesktopSmall : [979,3]
 
  });
 
}); */
function friend_request_delete(id){
	$.ajax({
   url: "<?php echo base_url();?>/user/friend-request-delete",
   type: "POST",
   data:  'id='+id,
   beforeSend : function()
   {
   },
   success: function(data)
      {
		 alert("Request Deleted");
		 $("#confirm_"+id).remove();
		/*  $('#requestsend').css('display','inline-block');
		 $('#addfriend').css('display','inline-block'); */
		  return false;
    
      },
     error: function(e) 
      {
		  $('#loading').hide();

      }          
    });
}
</script>
</body>
</html>