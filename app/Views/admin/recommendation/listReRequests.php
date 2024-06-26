<?php echo  $this->extend('admin/templates/recommendation_template'); ?>
<?php echo  $this->section('content'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Recommendation Requests
        <small>panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>admin/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Requests</li>
      </ol>
    </section>
	
	

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        
		 <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title"></h3>
              </div>
              <!-- /.box-header -->
			 
              <div class="box-body">
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                 	<th>Sr No</th>
					<th>Location</th>
					<th>Plan</th>
					<th>Category</th>
					<th>User Name</th>
					<th>Email</th>
					
					<th>Title</th>
					<th>Image</th>
					<th>Status</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
				  $i=1;
				  foreach($rerequests as $val) { 
				  $image=base_url()."/".$val['image'];
				  if($val['image']==''){
					 $image=base_url()."/public/noimage.jpg";  
				  }
				  ?>
				  <tr>
				    
                    <td><?php echo $i;?></td>
                    <td><?php echo $val['location_city'];?></td>
                    <td><?php echo $val['user_plan'];?></td>
                    <td><?php echo $val['category_name'];?></td>
                    <td><?php echo $val['user_name'];?></td>
                    <td><?php echo $val['user_email'];?></td>
                   
                    <td><?php echo $val['title'];?></td>
                    <td><img src="<?php echo $image;?>" height="100" width="100"></td>
                   <td>
					<?php 
					$checked="checked";
					if($val['status']==0){
						$checked='';
					}
					?>
					
						<input style="width:100px" id="<?php echo $val['id'];?>"  type="checkbox" name="my-checkbox" <?php echo $checked;?> 
						data-toggle="toggle"  data-on="Active" data-off="Deactive" data-size="mini" >
					
					</td>
					<td >
					
					
				    <a href="<?php echo base_url();?>/admin/recommendation/edit-request/<?php echo $val['id'];?>"  class="btn btn-warning btn-xs" >
					Edit
					</a>
					 
					<a  href="#" class="btn btn-danger btn-xs"  data-toggle="modal" data-target="#modal-danger<?php echo $i;?>">
					Delete
					</a>
				    <a href="<?php echo base_url();?>/admin/recommendation/view-request/<?php echo $val['id'];?>"  class="btn btn-info btn-xs">
					View
					</a>
					</td>
				  </tr>
				   <div class="modal fade" id="modal-danger<?php echo $i;?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Are you sure you want to delete</h4>
              </div>
              
              <div class="modal-footer" style="width: 365px;">
                
                <button type="button" class="btn btn-primary" onclick="return delete_request('<?php echo site_url();?>','<?php echo $val['id'];?>');">Yes</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
			    <?php 
				  $i++;
				  } ?>
                  
                  </tbody>
                  <tfoot>
                  <tr>
                 	<th>Sr No</th>
					<th>Location</th>
					<th>Plan</th>
					<th>Category</th>
					<th>User Name</th>
					<th>Email</th>
					
					<th>Title</th>
					<th>Image</th>
					<th>Status</th>
                    <th>Actions</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->

            
       
          <!-- /.col -->
        </div>
        
		
		
		
       </div>
     
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
<script>
    function delete_request(a,b) {
        pitFetch('GET','/admin/recommendation/delete-request/'+b).then(d=>{
            location.reload()
        })
    }
</script>
<?php echo  $this->endSection(); ?>
