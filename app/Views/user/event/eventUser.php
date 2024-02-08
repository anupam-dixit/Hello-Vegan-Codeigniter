<?php echo  $this->extend('user/templates/event_template');
$public_url=base_url()."/public/frontend/";
$baseurl=base_url()."/";
 ?>

<?php echo  $this->section('content'); ?>
<main class="main-feed">
      <ul class="main-feed-list">
        <div class="notfy">
         <?php echo  $this->include('user/templates/notf_header_template'); ?>
        </div>
        <div class="blog_page">
          <div class="blog_one_top">
          <div class="event_page">

          <div class="event_page_main_haddeing">

            <div class="hadding_main">
                <div class="row">
                    <div class="col-6">
                        Events
                    </div>
                    <div class="col-6">
                        <a onclick="$('#addEventModal').modal('show')" class="add_event_button">Add Event</a>
                    </div>
                </div>
            </div>

			<?php

			if(count($event_latest)!=0)
			{
			?>
          <div class="subhadding_news"><?php echo $event_latest['category_name'];?> </div>
          </div>
          <div class="top_blog_">
            <div class="blog_images">
			<?php
				if(!empty($event_latest['image'])){?>
          <a onclick="getSingleEvent('<?php echo $event_latest['id'];?>')">
			<!-- <a href="<?php echo base_url();?>/user/event/details/<?php echo $event_latest['id'];?>"> -->
        <img src="<?php echo $baseurl.$event_latest['image'];?>">
      </a>
			<?php
				}
			?>

			</div>

            <div class="event_page_main_posthaddeing">
            <h2>
              <a onclick="getSingleEvent('<?php echo $event_latest['id'];?>')">
             <!--  <a href="<?php echo base_url();?>/user/event/details/<?php echo $event_latest['id'];?>"> -->
                <?php echo $event_latest['name'];?>
                  </a>
              </h2>
            <div class="loc_event"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $event_latest['location'];?></div>
            <div class="date_event"><?php echo date('M d,Y h:i a',strtotime($event_latest['event_start_date']));?></div>
            <?php echo $event_latest['details'];?>
            <div class="read_more"> <a onclick="getSingleEvent('<?php echo $event_latest['id'];?>')">Read More</a> </div>

            </div>
          </div>
          <div class="blog_one_btm">
            <div class="row">
                <?php
				foreach($events as $val){
				?>
				<div class="col-md-6 col-sm-6  padding_right_left">
                <div class="blog_one_top blog_one_tetbtm">
                <div class="blog_images2">
				<?php
				if(!empty($val['image'])){?>
				<a onclick="getSingleEvent('<?php echo $val['id'];?>')">
				<!-- <a href="<?php echo base_url();?>/user/event/details/<?php echo $val['id'];?>"> -->
          <img src="<?php echo $baseurl.$val['image'];?>">
        </a>
				<?php  }?>
				</div>
                <div class="text_upc">
                <h2>
                    <a onclick="getSingleEvent('<?php echo $val['id'];?>')">
                  <!-- <a href="<?php echo base_url();?>/user/event/details/<?php echo $val['id'];?>"> -->

                    <?php echo $val['name'];?></a></h2>

                <div class="loc_event"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $val['location'];?></div>
                <div class="date_event"><?php echo date('M d,Y h:i a',strtotime($val['event_start_date']));?></div>
                <p><?php
				if($val['details']!=''){

				echo truncate($val['details']);
				?>
				<div class="read_more"> <a onclick="getSingleEvent('<?php echo $val['id'];?>')">Read More</a> </div>
				<?php
				}

				?></p>

                </div>
                </div>
                </div>
				<?php
				}
				?>




            </div>
          </div>
          <?php }else{ ?>
          <div class="subhadding_news"><?php echo 'Not Event Listed Yet';?> </div>
		  <?php
		  }
		  ?>
		 </div>
          </div>


        </div>
      </ul>
    </main>
	<?php
	function truncate($text, $length = 150, $ending = '...', $exact = true, $considerHtml = false) {
 if ($considerHtml) {
  // if the plain text is shorter than the maximum length, return the whole text
  if (strlen(preg_replace('/<.*?>/', '', $text)) <= $length) {
   return $text;
  }

  // splits all html-tags to scanable lines
  preg_match_all('/(<.+?>)?([^<>]*)/s', $text, $lines, PREG_SET_ORDER);

  $total_length = strlen($ending);
  $open_tags = array();
  $truncate = '';

  foreach ($lines as $line_matchings) {
   // if there is any html-tag in this line, handle it and add it (uncounted) to the output
   if (!empty($line_matchings[1])) {
    // if it’s an “empty element” with or without xhtml-conform closing slash (f.e.)
    if (preg_match('/^<(\s*.+?\/\s*|\s*(img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param)(\s.+?)?)>$/is', $line_matchings[1])) {
    // do nothing
    // if tag is a closing tag (f.e.)
    } else if (preg_match('/^<\s*\/([^\s]+?)\s*>$/s', $line_matchings[1], $tag_matchings)) {
     // delete tag from $open_tags list
     $pos = array_search($tag_matchings[1], $open_tags);
     if ($pos !== false) {
      unset($open_tags[$pos]);
     }
     // if tag is an opening tag (f.e. )
    } else if (preg_match('/^<\s*([^\s>!]+).*?>$/s', $line_matchings[1], $tag_matchings)) {
     // add tag to the beginning of $open_tags list
     array_unshift($open_tags, strtolower($tag_matchings[1]));
    }
    // add html-tag to $truncate’d text
    $truncate .= $line_matchings[1];
   }

   // calculate the length of the plain text part of the line; handle entities as one character
   $content_length = strlen(preg_replace('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', ' ', $line_matchings[2]));
   if ($total_length+$content_length > $length) {
    // the number of characters which are left
    $left = $length - $total_length;
    $entities_length = 0;
    // search for html entities
    if (preg_match_all('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', $line_matchings[2], $entities, PREG_OFFSET_CAPTURE)) {
     // calculate the real length of all entities in the legal range
     foreach ($entities[0] as $entity) {
      if ($entity[1]+1-$entities_length <= $left) {
       $left--;
       $entities_length += strlen($entity[0]);
      } else {
       // no more characters left
       break;
      }
     }
    }
    $truncate .= substr($line_matchings[2], 0, $left+$entities_length);
    // maximum lenght is reached, so get off the loop
    break;
   } else {
    $truncate .= $line_matchings[2];
    $total_length += $content_length;
   }

   // if the maximum length is reached, get off the loop
   if($total_length >= $length) {
    break;
   }
  }
 } else {
  if (strlen($text) <= $length) {
   return $text;
  } else {
   $truncate = substr($text, 0, $length - strlen($ending));
  }
 }

 // if the words shouldn't be cut in the middle...
 if (!$exact) {
  // ...search the last occurance of a space...
  $spacepos = strrpos($truncate, ' ');
  if (isset($spacepos)) {
   // ...and cut the text in this position
   $truncate = substr($truncate, 0, $spacepos);
  }
 }

 // add the defined ending to the text
 $truncate .= $ending;

 if($considerHtml) {
  // close all unclosed html-tags
  foreach ($open_tags as $tag) {
   $truncate .= '';
  }
 }

return $truncate;

}
	?>
<span id="showmodel" style="display:none"></span>
<div class="modal fade" id="addEventModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
  <form action="<?php echo base_url('user/event/insert-event');?>" method="post" enctype="multipart/form-data" id="eventForm" name="eventForm">
    <div class="modal-content model_add_event">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Event</h5>
      </div>
      <div class="modal-body">
       <div class="row" style="margin-right: 0;margin-left: 0;">


              <!--col-sm-6-->

              <div class="col-md-12 col-sm-6 col--12 right-side">

              <?php if(session()->getFlashdata('msgevent')):?>
                    <div class="alert alert-success">
                       <p><?= session()->getFlashdata('msgevent') ?></p>
                    </div>
      <?php endif;?>
               <?php /*?> <h2><a href="<?php echo base_url();?>/user/event">Events</a></h2>
				<h2>Event Add </h2><?php */?>

                <!--Form with header-->
                <div class="form">


<div class="form-group">
                    <label>Category</label>
					<select name="category" id="category" class="form_control_event">
					  <option value="">Select Category</option>
					<?php
                     foreach($event_category as $val){
					?>
					<option value="<?php echo $val['id'];?>"><?php echo $val['name'];?></option>
                    <?php
					}
					?>
					</select>
                  </div>
				  <div class="form-group">
				   <label>Name</label>
                    <input type="hidden" id="video" name="video" class="form_control_event" placeholder="Video" >
                    <input type="text" id="name" name="name" class="form_control_event" placeholder="Event Name" >
                  </div>
                  <div class="form-group">
                    <label>Location</label>
					<input type="text" id="location" name="location" class="form_control_event" placeholder="Event Location" >
                  </div>
				  <div class="form-group">
				  <label>Event Start Date</label>
                    <input type="date" id="event_start_date" name="event_start_date" class="form_control_event" placeholder="Event Start Date" >
                  </div>
				  <div class="form-group">
                    <label>Event Start Time (H:M AM/PM)</label>
					<input type="time" id="event_start_time" name="event_start_time" class="form_control_event" placeholder="Event Start Time" >
                  </div>
				  <div class="form-group">
				  <label>Event End Date</label>
                    <input type="date" id="event_end_date" name="event_end_date" class="form_control_event" placeholder="Event End Date" >
                  </div>
				  <div class="form-group">
				  <label>Event End Time (H:M AM/PM)</label>
                    <input type="time" id="event_end_time" name="event_end_time" class="form_control_event" placeholder="Event End Time" >
                  </div>
				  <div class="form-group">
				  <label>Image</label>
                    <input type="file" id="image" name="image" class="form_control_event" placeholder="Event Image" >
                  </div>
				  <div class="form-group">
				  <label>Details</label>
                    <textarea  id="details" name="details" class="form_control_event" placeholder="Description"></textarea>
                  </div>
                  <div class="text-xs-center">
				 <a  class="btn loginbutton "> <input style="background:none;border:none;color:#fff" type="submit" name="submit" id="submit" value="Submit"><span>
				    <img style="display:inline" src="<?php echo $public_url;?>images/back_arrow.svg" alt="img">
				  </span></a>
				  </div>


                </div>
                <!--/Form with header-->

              </div>
              <!--col-sm-6-->


            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="sumbit_event close_event" onclick="$('.modal').modal('hide')">Close</button> &nbsp;  &nbsp;
        <button type="submit" class="sumbit_event">Save changes</button>
      </div>
    </div>
		  </form>
  </div>
</div>
<div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog modal-sm">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" onclick="location.reload()" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="document_name">Message</h4>
        </div>
        <div class="modal-body">
                 <div id="ErrorMessage" style="text-align:center;margin-bottom:13px;">

                </div>
         </div>
        <div class="modal-footer">
          <button type="button" onclick="location.reload()" class="sumbit_event close_event" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>
  <div id="loader"></div>
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
</script>
	<?php echo  $this->endSection(); ?>
