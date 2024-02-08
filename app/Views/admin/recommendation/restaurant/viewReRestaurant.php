<?php echo  $this->extend('admin/templates/restaurant_template'); ?>

<?php echo  $this->section('content'); ?>
<div class="content-wrapper">
      <section class="content-header">
      <h1>
        View Recommendation Requests
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>admin/recommendation/requests"><i class="fa fa-dashboard"></i> Requests</a></li>
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
                     Title: <span style="font-weight:100"><?php echo $rerequest['title'];?></span>
                    </span>
                    <span class="username" style="margin-left:0px;">
                     Category Name: <span style="font-weight:100"><?php echo $rerequest['category_name'];?></span>
                    </span>
					
					<span class="username" style="margin-left:0px;">
                     User Name: <span style="font-weight:100"><?php echo $rerequest['user_name'];?></span> 
                    </span>
					<span class="username" style="margin-left:0px;">
                     User Email: <span style="font-weight:100"><?php echo $rerequest['user_email'];?></span> 
                    </span>
					<span class="username" style="margin-left:0px;">
                     User Phone: <span style="font-weight:100"><?php echo $rerequest['user_phone'];?></span> 
                    </span>
					<span class="username" style="margin-left:0px;">
                     URL: <span style="font-weight:100"><?php echo $rerequest['url'];?></span> 
                    </span>
					<span class="username" style="margin-left:0px;">
                     Plan: <span style="font-weight:100"><?php echo $rerequest['plan_name'];?></span> 
                    </span>
					<span class="username" style="margin-left:0px;">
                     Date From: <span style="font-weight:100"><?php echo $rerequest['date_from'];?></span> 
                    </span>
					<span class="username" style="margin-left:0px;">
                     Date To: <span style="font-weight:100"><?php echo $rerequest['date_to'];?></span> 
                    </span>
					<span class="username" style="margin-left:0px;">
                     Location: <span style="font-weight:100"><?php echo $rerequest['location_where'];?></span> 
                    </span>
					
					
					<span class="username" style="margin-left:0px;">
                     Created: <span style="font-weight:100"><?php echo $rerequest['created_at'];?></span> 
                    </span>
                  
                    
                  </div>
                  <!-- /.user-block -->
				   <p>
				   <span  style="margin-left:0px;font-weight:600;font-size:16px;">Description:</span>
                   <?php echo $rerequest['description'];?>
                  </p>
                  <div class="row margin-bottom">
                    <div class="col-sm-6">
                     
					  <?php if($rerequest['image']!=''){
					 ?>
				<img class="img-responsive" src="<?php echo base_url();?>/<?php echo $rerequest['image'];?>" >	 
					 <?php
				 }?>
                    </div>
                    <!-- /.col -->
                  
                  </div>
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
