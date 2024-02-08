<?php
        if(count($blogall)!=0){
		foreach($blogall as $val){
        ?>
		<div class="col-md-6 col-sm-6 padding_right_left">
                <div class="blog_one_top blog_one_tetbtm">

                  <div class="blog_images2"><a onclick="getSingleblog('<?php echo $val['id'];?>')"><img src="<?php echo base_url().'/'.$val['image'];?>"></a></div>

               <!--    <div class="blog_images"><img src="<?php echo base_url().'/'.$val['image'];?>"></div> -->
                  <h2 class="hidding_one_middel"><a onclick="getSingleblog('<?php echo $val['id'];?>')"><?php echo $val['title'];?> </a></h2>
                  <p><?php echo $val['content'];?></p>
                  <div class="read_more"> <a onclick="getSingleblog('<?php echo $val['id'];?>')">Read More</a> </div>
                  <!-- <div class="read_more"> <a data-toggle="modal" data-target="#add_custom_blog">Read More</a> </div> -->
                </div>
              </div>
		<?php 
		}}
		?>