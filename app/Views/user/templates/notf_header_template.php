<div class="row align-items-center">
    <div class="col">

    </div>
    <div class="col-2">
        <ul class="notification_page_drop">
            <div class="notification-drop">

                <li class="item icon-container ButtonGroup " onclick="removeNotification()">
                    <div class="topicon">
                        <img src="<?php echo base_url().'/public/frontend/';?>images/notification_b.png" />
                        <?php /*?>        <img src="<?php echo base_url().'/public/frontend/';?>images/notification.png" /> </div>
<?php */?>        <span class="btn__badge pulse-button " id="notification_count">0</span>

                        <ul id="notification_popup" class="notification_popup parent_notification_popup">

                        </ul>
                </li>
            </div>

            <li>
                <div class="icon-container">
                    <a href="#">
                        <img id="showchat1" src="<?php echo base_url().'/public/frontend/';?>images/chat_b.png" /> <?php /*?><img id="showchat" src="<?php echo base_url().'/public/frontend/';?>images/chat.png" /><?php */?>
                    </a>
                </div>
            </li>
        </ul>

    </div>
</div>
<div class="row nav_crumb">
    <div class="col">
        <a class="text-success" href="/user/dashboard">
            <div class="text-center">
                <i class="fa-solid fa-house fa-2x"></i>
                <div class="mt-2">
                    <?=lang('app.user_dashboard._18')?>
                </div>
            </div>
        </a>
    </div>
    <div class="col">
        <a class="text-success" href="/user/blog">
            <div class="text-center">
                <i class="fa-solid fa-blog fa-2x"></i>
                <div class="mt-2">
                    <?=lang('app.global.blog')?>
                </div>
            </div>
        </a>
    </div>
    <div class="col">
        <a class="text-success" href="/user/news">
            <div class="text-center">
                <i class="fa-solid fa-newspaper fa-2x"></i>
                <div class="mt-2">
                    <?=lang('app.global.news')?>
                </div>
            </div>
        </a>
    </div>
    <div class="col">
        <a class="text-success" href="/user/event">
            <div class="text-center">
                <i class="fa-solid fa-calendar-days fa-2x"></i>
                <div class="mt-2">
                    <?=lang('app.global.event')?>
                </div>
            </div>
        </a>
    </div>
    <div class="col">
        <a class="text-success" href="/user/userrecipelist">
            <div class="text-center">
                <i class="fa-solid fa-bowl-rice fa-2x"></i>
                <div class="mt-2">
                    <?=lang('app.global.recipe')?>
                </div>
            </div>
        </a>
    </div>
    <div class="col">
        <a class="text-success" href="/user/recommendation">
            <div class="text-center">
                <i class="fa-solid fa-check-to-slot fa-2x"></i>
                <div class="mt-2">
                    <?=lang('app.global.recommendation')?>
                </div>
            </div>
        </a>
    </div>
</div>

	    <span id="showmodel" style="display:none"></span>  
	  

<!--    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->

	  <script>
           function getSingleEvent(id){
  $.ajax({
    url:'/user/get-single-event/'+id,
    type:'GET',
    success:function(data){
      console.log(data);
      $("#showmodel").css('display','block');
      $("#showmodel").html(data);
      $('#add_custom_blog').modal('show');
    },
    error:function(e){
      
    }
  }); 
  }
function hidepopup(){
  $("#showmodel").css('display','none');
}


function getSingleblog(id){
  $.ajax({
    url:'<?php echo base_url();?>/user/get-single-blog/'+id,
    type:'GET',
    success:function(data){
      console.log(data);
    
      $("#showmodel").css('display','block');
      $("#showmodel").html(data);
      $('#add_custom_blog').modal('show');
    $('.owl-carousel').owlCarousel({
     // loop:true,
    margin:5,
    nav:true,
    navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
      // autoplay:true,
      // autoplayTimeout:2000,
       dots: false,
    responsive:{
        0:{
            items:1
        },
        400:{
            items:2
        },
        800:{
            items:3
        }
    }
});
    },
    error:function(e){
      
    }
  }); 
  }
 
$(document).ready(function() {
  $(".notification-drop .item").on('click',function() {
    $(this).find('ul').toggle();
  });
});
$(window).click(function() {
  //Hide the menus if visible
  //removeNotification();
});

$('.notification_page_drop').click(function(event){
  event.stopPropagation();
});
</script>