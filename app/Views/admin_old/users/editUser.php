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
/* echo "<pre>";
print_r($questions);
echo "</pre>"; */
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
            <h3 class="card-title">Edit User</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
           <form action="<?php echo base_url('admin/updateUser');?>" method="post" enctype="multipart/form-data">	
<input type="hidden" name="id" id="id" value="<?php echo $id;?>">		   
 		  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Name</label>
                        <input type="text"  id="name" name="name" class="form-control" placeholder="Enter ..." value="<?php echo $name;?>">
						
                      </div>
                    </div>
					<div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Email</label>
                        <input type="text"  id="email" name="email" class="form-control" placeholder="Enter ..." value="<?php echo $email;?>">
						<span style="display:none;color:red" id="error_email">Please fill email</span>
						<span style="display:none;color:red" id="error_same_email">Email is already taken</span>
                      </div>
                    </div>
					<div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Password</label>
                        <input type="password"  id="password" name="password" class="form-control" placeholder="Enter ...">
						<span style="display:none;color:red" id="error_password">Please fill password</span>
						
                      </div>
                    </div>
					
					<div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Address</label>
                     <textarea class="form-control" id="address" 
						name="address" rows="3" placeholder="Enter ..."><?php echo $address;?></textarea>
                      </div>
                    </div>
					<div class="col-sm-6">
                      <!-- text input -->
                      <div id="map"></div>
                    </div>
                   
                     
            </div>
			
			<div class="row">
			<div class="col-sm-12">
						  <!-- textarea -->
						  <div class="form-group">
							<label>Description</label>
							<span style="display:none;color:red" id="error_long_description">Please fill  Description</span>
							<textarea  class="form-control" id="description" 
							name="description" rows="3" placeholder="Enter ..."><?php echo $description;?></textarea>
						  </div>
				</div>
			
		
			</div>
			
			<div class="row">
			 <div class="col-md-6">
			  <div class="form-group"> 
			  <label>Profile Image</label>
                <div class="custom-file">
                 <input type="file" onchange="return valueonchange(this.id)" class="custom-file-input" name="profile_image" id="profile_image">
                 <label class="custom-file-label" id="profile_image_label" 
                 for="profile_image">Profile Image</label>
				 <span style="display:none;color:red" id="error_profile_image">Please select profile image</span>
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
                 <input type="file" onchange="return valueonchange(this.id)" class="custom-file-input" name="cover_image" id="cover_image">
                 <label class="custom-file-label" for="cover_image">Cover Image</label>
				 <span style="display:none;color:red" id="error_cover_image">Please select cover image</span>
				
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
			<label>Enter security questions and answers</label>
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
               <input type="text"  id="sq<?php echo $ii;?>" name="sq<?php echo $ii;?>" class="form-control" placeholder="Enter ..." value="<?php echo $sq; ?>">
			  </div>
			 </div>
			 <div class="col-md-6">
			  <div class="form-group">
			   <label>Ans<?php echo $ii;?></label>
               <input type="text"  id="sa<?php echo $ii;?>" name="sa<?php echo $ii;?>" class="form-control" placeholder="Enter ..." value="<?php echo $sa; ?>">
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
                
                  <button onclick="return validation()" type="submit" class="btn btn-primary">Submit</button>
                
              </div>
             </div>
			</div>
			</form>
           </div>
         </div>
      </div>
    </section>

<!-- /.content -->
<?php echo  $this->endSection(); ?>