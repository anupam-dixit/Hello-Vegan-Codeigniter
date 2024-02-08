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
			 
			  <select id="search_status" style="height:30px">
			  <option value="2">Status</option>
			  <option value="1">Activate</option>
			  <option value="0">Deactivate</option>
			  </select> 
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
					<th>Status</th>
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
                    
					
					<td>
					<?php 
					$checked="checked";
					if($val['status']==0){
						$checked='';
					}
					?>
					<div class="card-body">
						<input style="width:100px" id="<?php echo $val['id'];?>"  type="checkbox" name="my-checkbox" <?php echo $checked;?> data-bootstrap-switch 
						data-on-text="Active "
                        data-off-text="Deactive"
						>
					</div>
					</td>
					<td style="width:110px;">
					
					
				    <a href="<?php echo base_url();?>/admin/edit-user/<?php echo $val['id'];?>" target="_blank" style="float: left;">
					<i class="fas fa-pencil-alt mr-1"></i>
					</a>
					 <a href="<?php echo base_url();?>/admin/view-user/<?php echo $val['id'];?>" target="_blank" style="float: left;margin-left: 11px;">
					<i class="fas fa-user mr-1"></i>
					</a>
					<a style="float: left;margin-left: 20px;" href="<?php echo base_url();?>/admin/view-user/<?php echo $val['id'];?>" target="_blank" data-toggle="modal" data-target="#modal-danger<?php echo $i;?>">
					<i class="fas  fa-times mr-1"></i>
					</a>
					 
					</td>
				  </tr>
				   <div class="modal fade" id="modal-danger<?php echo $i;?>">
        <div class="modal-dialog">
          <div class="modal-content bg-danger">
            <div class="modal-header">
              <h4 class="modal-title">Are you sure you want to delete user</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            
            <div class="modal-footer justify-content-between" style="width: 32%;margin-left: 29%;border-top:none;">
              <button type="button" class="btn btn-outline-light" onclick="return delete_user('<?php echo site_url();?>','<?php echo $val['id'];?>');">Yes</button>
			  <button type="button" class="btn btn-outline-light" data-dismiss="modal">No</button>
              
            </div>
          </div>
        </div>
      </div>
                  <?php 
				  $i++;
				  } ?>
                  
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Sr No</th>
					<th>Name</th>
                    <th>Email</th>
					<th>Status</th>
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
