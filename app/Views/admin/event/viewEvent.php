<?php echo  $this->extend('admin/templates/event_template'); ?>

<?php echo  $this->section('content'); ?>
<div class="content-wrapper">
      <section class="content-header">
      <h1>
        View Event
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>admin/event/list"><i class="fa fa-dashboard"></i> Events</a></li>
        <li class="active">View</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="box box-default">
        <div class="box-body">
		<div class="row">
       <!-- /.col -->
        <div class="col-md-6">
          <div class="nav-tabs-custom">
           
            <div class="tab-content">
           <div class="active tab-pane" id="activity">
                <!-- Post -->
               
               
                <!-- Post -->
                <div class="post">
                  <div class="user-block">
				     <span class="username" style="margin-left:0px;">
                     Name: <span style="font-weight:100"><?php echo $event_data['name'];?></span>
                    </span>
                    <span class="username" style="margin-left:0px;">
                     Category Name: <span style="font-weight:100"><?php echo $event_data['category_name'];?></span>
                    </span>
					
					<span class="username" style="margin-left:0px;">
                     User Name: <span style="font-weight:100"><?php echo $event_data['user_name'];?></span> 
                    </span>
					<span class="username" style="margin-left:0px;">
                     User Email: <span style="font-weight:100"><?php echo $event_data['user_email'];?></span> 
                    </span>
					<span class="username" style="margin-left:0px;">
                     User Phone: <span style="font-weight:100"><?php echo $event_data['user_phone'];?></span> 
                    </span>
					
					
					<span class="username" style="margin-left:0px;">
                     Event Start Date : <span style="font-weight:100"><?php echo $event_data['event_start_date'];?></span> 
                    </span>
					
					<span class="username" style="margin-left:0px;">
                     Event End Date : <span style="font-weight:100"><?php echo $event_data['event_end_date'];?></span> 
                    </span>
					<span class="username" style="margin-left:0px;">
                     Location: <span style="font-weight:100"><?php echo $event_data['location'];?></span> 
                    </span>
					
					
					<span class="username" style="margin-left:0px;">
                     Created: <span style="font-weight:100"><?php echo $event_data['created_at'];?></span> 
                    </span>
                  
                    
                  </div>
                  <!-- /.user-block -->
				   <p>
				   <span  style="margin-left:0px;font-weight:600;font-size:16px;">Details:</span>
                   <?php echo $event_data['details'];?>
                  </p>
                  <div class="row margin-bottom">
                    <div class="col-sm-6">
                     
					  <?php if($event_data['image']!=''){
					 ?>
				<img class="img-responsive" src="<?php echo base_url();?>/<?php echo $event_data['image'];?>" >	 
					 <?php
				 }?>
                    </div>
                    <!-- /.col -->
                  
                  </div>
				  <?php
				  if($event_data['video']){
					  ?>
				  <div class="video_blog row margin-bottom">
            <iframe height="280" width="500" src="<?php echo $event_data['video'];?>" title="YouTube video player" ></iframe>
            
            </div>
				  <?php  }?>
                  <!-- /.row -->

                  
                </div>
                <!-- /.post -->
             </div>
             
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      </div>
	  </div>
     </section> 

    <!-- /.content -->
  </div>
<?php echo  $this->endSection(); ?>
