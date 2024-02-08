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
 <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Users</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo site_url();?>dashboard">Home</a></li>
              <li class="breadcrumb-item active">
			  Users</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">View User</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
          
<input type="hidden" name="id" id="id" value="<?php echo $id;?>">		   
 		  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Name</label>
                        <?php echo $name;?>
						
                      </div>
                    </div>
					<div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Email</label>
                        <?php echo $email;?>
						
                      </div>
                    </div>
					
					
					<div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Address</label>
                    <?php echo $address;?>
                      </div>
                    </div>
					
                   
                     
            </div>
			
			<div class="row">
			<div class="col-sm-12">
						  <!-- textarea -->
						  <div class="form-group">
							<label>Description</label>
						
							<?php echo $description;?>
						  </div>
				</div>
			
		
			</div>
			
			<div class="row">
			 <div class="col-md-6">
			  <div class="form-group"> 
			  <label>Profile Image</label>
                <div class="custom-file">
                
				 <?php 
				 if($profile_image!=''){?>
				 <img src="<?php echo base_url();?>/<?php echo $profile_image;?>" width="100" height="100">
				 <?php 
				 } 
				 ?>
                </div>
              </div>
             </div>
			 <div class="col-md-6">
			  <div class="form-group">
			  <label>Cover Image</label>
                <div class="custom-file">
               
				
				 <?php 
				 if($cover_image!=''){?>
				 <img src="<?php echo base_url();?>/<?php echo $cover_image;?>" width="100" height="100">
				 <?php 
				 } 
				 ?>
                </div>
              </div>
             </div>
			
			</div> 
			<div style="clear:both;margin-top:5%"></div>
			<div class="row">
			<label>Security questions and answers</label>
			</div>
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
			<div class="row">
			 <div class="col-md-6">
			  <div class="form-group">
			   <label>Q<?php echo $ii;?> </label>
               <?php echo $sq; ?>
			  </div>
			 </div>
			 <div class="col-md-6">
			  <div class="form-group">
			   <label>Ans<?php echo $ii;?></label>
               <?php echo $sa; ?>
			  </div>
			 </div>
			</div>
			<?php
$k++;	
	
			}
			?>
			<div class="row">
			
			 <div class="col-md-12" style="text-align:right;">
			  <div class="form-group">
                
                  
                
              </div>
             </div>
			</div>
		
           </div>
         </div>
      </div>
    </section>

<!-- /.content -->
<?php echo  $this->endSection(); ?>