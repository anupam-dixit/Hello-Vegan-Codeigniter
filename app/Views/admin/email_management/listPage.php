<?php echo  $this->extend('admin/templates/email_management_template'); ?>

<?php echo  $this->section('content'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Email
        <small>panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>admin/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Emails</li>
      </ol>
    </section>
	
	

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
               <div class="box">
              <div class="box-header">
                <h3 class="box-title">Email List</h3>
              </div>
              <!-- /.box-header -->
			 
              <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                 	<th>Sr No</th>
					<th>Email</th>
					<th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
				  $i=1;
				  foreach($emaillists as $val) { ?>
				  <tr>
				    
                    <td><?php echo $i;?></td>
                    <td><?php echo $val['title'];?></td>
                   <td >
					 <a href="<?php echo base_url();?>/admin/email-management/edit/<?php echo $val['id'];?>"  class="btn btn-warning btn-xs" >
					Edit
					</a>
					</td>
				  </tr>
				  
			    <?php 
				  $i++;
				  } ?>
                  
                  </tbody>
                  <tfoot>
                  <tr>
                 	<th>Sr No</th>
					<th>Email</th>
					<th>Actions</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.box-body -->
            </div>
              </div>
              <!-- /.tab-pane -->
             
              <!-- /.tab-pane -->
             
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
        </div>
		 <div class="col-xs-12">
            
            <!-- /.box -->

            
       
          <!-- /.col -->
        </div>
        
		
		
		
       </div>
     
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>


<?php echo  $this->endSection(); ?>
