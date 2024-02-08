<?php echo  $this->extend('admin/templates/users_list_template'); ?>
<?php echo  $this->section('content'); ?>
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>View Users</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">View Users</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
	<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"></h3>
              </div>
              <!-- /.card-header -->
			  <table class="table table-bordered" style="width:400px">
			  <tr>
			  <td>Filters:</td>
			  <td><input type="text" placeholder="Search by Name" id="search_name"></td>
			  <td>
			 
			  
			  </td>
			  </tr>
			  </table>
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                     
					<th>Sr No</th>
					<th>Name</th>
                    <th>Email</th>
					
					<th>Actions</th>
                   
                
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
				  $i=1;
				  foreach($users as $val) { ?>
				  <tr>
				    
                    <td><?php echo $i;?></td>
                    <td><?php echo $val['name'];?></td>
                    <td><?php echo $val['email'];?></td>
                    
					
				
					<td style="width:110px;">
					
					
				    
					 <a href="<?php echo base_url();?>/admin/view-user-deleted/<?php echo $val['id'];?>" target="_blank">
					<i class="fas fa-user mr-1"></i>
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
					<th>Name</th>
                    <th>Email</th>
					
					<th>Actions</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
 
<script>


</script>
</script> 
<?php echo  $this->endSection(); ?>
