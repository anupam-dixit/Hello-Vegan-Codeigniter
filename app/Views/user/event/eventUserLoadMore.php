<?php
if(count($events)!=0){
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
}
?>				