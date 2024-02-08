<?php echo  $this->extend('admin/templates/admin_template'); ?>

<?php echo  $this->section('content'); ?>
<?php
$id=$users['id'];
$name=$users['name'];
$address=$users['address'];
$description=$users['description'];
$profile_image=$users['profile_image'];
$cover_image=$users['cover_image'];
$email=$users['email'];
$password=$users['password'];
?>
 
 <div class="content-wrapper">
 <section class="content-header">
      <h1>
         View Deleted Users
        <small>panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>admin/users-deleted"><i class="fa fa-dashboard"></i> Users</a></li>
        <li class="active">View</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
   
		<div class="row">
       <!-- /.col -->
        <div class="col-md-9">
		 <div class="box box-default">
        <div class="box-body">
          <div class="nav-tabs-custom">
           
            <div class="tab-content">
           <div class="active tab-pane" id="activity">
                <!-- Post -->
               
               
                <!-- Post -->
                <div class="post">
                  <div class="user-block">
				  
                    <span class="username" style="margin-left:0px;">
                     Name: <span style="font-weight:100"><?php echo $name;?></span>
                    </span>
					 <span class="username" style="margin-left:0px;">
                     Email: <span style="font-weight:100"><?php echo $email;?></span>
                    </span>
					 <span class="username" style="margin-left:0px;">
                     Address: <span style="font-weight:100"><?php echo $address;?></span>
                    </span>
				</div>
				  <div class="user-block">
				  <span class="username" style="margin-left:0px;">
				  Security questions and answers
				  </span>
					<?php 
						$k=0;
						for($ii=1;$ii<4;$ii++){
							$sq='';
							$sa='';
							if(isset($questions[$k]['secret_question'])){
								$sq=$questions[$k]['secret_question'];
							}
							if(isset($questions[$k]['secret_answer'])){
								$sa=$questions[$k]['secret_answer'];
							}
					?>
                    <span class="username" style="margin-left:0px;">
                     Q<?php echo $ii;?>: <span style="font-weight:100"><?php echo $sq; ?></span>
                    </span>
					<span class="username" style="margin-left:0px;">
                     Ans<?php echo $ii;?>: <span style="font-weight:100"><?php echo $sa; ?></span>
                    </span>
				<?php $k++; }  ?>	
				</div>
                  <!-- /.user-block -->
				   <p>
				   <span  style="margin-left:0px;font-weight:600;font-size:16px;">Description:</span>
                   <?php echo $description;?>
                  </p>
                  <div class="row margin-bottom">
                    <div class="col-sm-3">
                     <span  style="margin-left:0px;font-weight:600;font-size:16px;">Profile Image:</span>
					  <?php if($profile_image!=''){
					 ?>
				<img class="img-responsive" src="<?php echo base_url();?>/<?php echo $profile_image;?>" >	 
					 <?php
				 }?>
                    </div>
					<div class="col-sm-3">
                     <span  style="margin-left:0px;font-weight:600;font-size:16px;">Cover Image:</span>
					  <?php if($cover_image!=''){
					 ?>
				<img class="img-responsive" src="<?php echo base_url();?>/<?php echo $cover_image;?>" >	 
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
<!-- /.content -->
 
<!-- /.content -->
<?php echo  $this->endSection(); ?>