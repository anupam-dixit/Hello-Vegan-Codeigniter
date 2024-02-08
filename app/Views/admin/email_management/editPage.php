<?php echo  $this->extend('admin/templates/email_management_template'); ?>

<?php echo  $this->section('content'); ?>
<div class="content-wrapper">
 
      <section class="content-header">
      <h1>
        Edit Email Content
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>/admin/email-management"><i class="fa fa-dashboard"></i> email</a></li>
        <li class="active">List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
          <div class="box-header">
            <h3 class="box-title"></h3>
          </div>
          <!-- /.box-header -->
          
           <form action="<?php echo base_url('admin/email-management/update');?>" method="post" enctype="multipart/form-data">
<div class="box-body">		   
 		  <div class="row">
                   
			
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Title</label>
                        <input type="text"  id="title" name="title" class="form-control" placeholder="Enter ..." readonly value="<?php echo $email_details[0]['title'];?>">
						
                      </div>
                    </div>
			</div>
			
			<div class="row">
			<div class="col-sm-12">
						  <!-- textarea -->
						  <div class="form-group">
							<label>Content</label>
							<span style="display:none;color:red" id="error_long_description">Please fill  Content</span>
							<textarea  class="form-control" id="content" 
							name="content" rows="3" placeholder="Enter ..."></textarea>
						  </div>
				</div>
			
		
			</div>
			
		 
			
			<div class="row">
			
			 <div class="col-md-12" style="text-align:right;">
			  <div class="form-group">
                
                  <button onclick="return validation()" type="submit" class="btn btn-primary">Submit</button>
                
              </div>
             </div>
			</div>
			
           </div>
		   </form>
         </div>
      
</section>
    <!-- /.content -->
  </div>

<?php echo  $this->endSection(); ?>
