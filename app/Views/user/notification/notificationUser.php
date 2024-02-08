<?php echo  $this->extend('user/templates/notification_page_template');
$public_url=base_url()."/public/frontend/";
$baseurl=base_url()."/";
 ?>

<?php echo  $this->section('content'); ?>
	<main class="main-feed notifications_page_info">
      <ul class="main-feed-list">
      <div class="notfy">
      <?php echo  $this->include('user/templates/notf_header_template'); ?>
      </div>


        <h2>Notifications</h2>
		<?php
		foreach($user_details as $val){
		?>
        <li class="main-feed-item">
          <article class=" ">
            <div class="row">
               <div class="notifications_list">
               <div class="icon_notifications  notifications_icon">
			   <a href="<?php echo base_url();?>/user/public_profile/<?php echo $val['id'] ?>"><img src="<?php echo $val['profile_image'];?>"></a>

               <div class="icon_noti">
               <img src="<?php echo $val['notification_pageicon'];?>">
               </div>
               </div>
               <div class="text_notifications">

               <p> <b><?php echo $val['name'];?></b> <?php echo $val['message'];?></p>
               <span><?php echo $val['timeview'];?></span>
               </div>
               </div>
             </div>
          </article>
        </li>
		<?php } ?>
       </ul>
         <span id="showmodel" style="display:none"></span>
    </main>
      <span id="showmodel" style="display:none"></span>
  <?php
$key="AIzaSyBlf2VfOx5bL5rwlTP4hG5luZxZaLV6xEI";
$googleWeb="https://maps.googleapis.com/maps/api/js";
$googleAddress=$googleWeb."?key=".$key."&libraries=places&callback=initMap";
?>
<script src="<?php echo $googleAddress;?>"   async defer></script>
<script>
function initMap() {
  var input = document.getElementById('location');
  var autocomplete = new google.maps.places.Autocomplete(input);
}




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
</script>
  <?php echo  $this->endSection(); ?>
  <span id="showmodel" style="display:none"></span>