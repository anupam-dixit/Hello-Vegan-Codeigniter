<?php echo  $this->extend('admin/templates/recommendation_template'); ?>

<?php echo  $this->section('content'); ?>
<div class="content-wrapper">
      <section class="content-header">
      <h1>
        View Recommendation Plan
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>admin/recommendation/plans"><i class="fa fa-dashboard"></i> Plans</a></li>
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
                     Plan Name: <span style="font-weight:100"><?php echo $replans['plan_name'];?></span>
                    </span>
					
					<span class="username" style="margin-left:0px;">
                     Title: <span style="font-weight:100"><?php echo $replans['title'];?></span> 
                    </span>
					<span class="username" style="margin-left:0px;">
                     Price: <span style="font-weight:100"><?php echo $replans['price'];?></span> 
                    </span>
					<span class="username" style="margin-left:0px;">
                     Created: <span style="font-weight:100"><?php echo $replans['created_at'];?></span> 
                    </span>
                  
                    
                  </div>
                  <!-- /.user-block -->
				   <p>
				   <span  style="margin-left:0px;font-weight:600;font-size:16px;">Description:</span>
                   <?php echo $replans['description'];?>
                  </p>
                  <div class="row margin-bottom">
                    <div class="col-sm-6">
                     
					  <?php if($replans['image']!=''){
					 ?>
				<img class="img-responsive" src="<?php echo base_url();?>/<?php echo $replans['image'];?>" >	 
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
