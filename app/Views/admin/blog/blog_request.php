<?php echo  $this->extend('admin/templates/blog_template'); ?>
<?php echo  $this->section('content'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Blog Posts
        <small>panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>admin/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Post</li>
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
                                    <th>#</th>
                                    <th>Category Name</th>
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Date</th>
                                    <th>Posted By</th>
                                    <th>Action</th>
                                </tr>
                  </thead>
                  <tbody>
                  <?php 
				  $i=1;
				  foreach($posts as $val) { 
				  $category_name=$val['category_name'];
				  
				  ?>
				 <tr>
                                    <td><?php echo $i;?></td>
                                    <td><?php echo $val['category_name'];?></td>
                                    <td><?php echo $val['title'];?></td>
                                    <td><?php 
										if($val['image']!=''){
										?>
										<img src="<?php echo base_url();?>/<?php echo $val['image'];?>" width="70" height="70">
										<?php 
										}
										?>
										</td>
                                    <td><?php echo $val['created_at'];?></td>
                                    <td>
									<?php 
									echo $val['user_name'];	
									
									?>
									
									</td>
                                    <td>
									<a  href="#" class="btn btn-warning btn-xs" target="_blank" data-toggle="modal" data-target="#modal-accept-blog-<?php echo $i;?>">
					                Accept
					                 </a>
									 <div class="modal fade" id="modal-accept-blog-<?php echo $i;?>">
                                            <div class="modal-dialog">
											<div class="modal-content">
											  <div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												  <span aria-hidden="true">&times;</span></button>
												<h4 class="modal-title">Are you sure you want to Accept Request</h4>
											  </div>
              
											  <div class="modal-footer" style="width: 365px;">
												
												<button type="button" class="btn btn-primary" onclick="return approve_blog_request('<?php echo site_url();?>','<?php echo $val['id'];?>');">Yes</button>
												<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
											  </div>
											</div>
											
										  </div>
										 
										</div>
									<a  href="#" class="btn btn-info btn-xs" target="_blank" data-toggle="modal" data-target="#modal-decline-blog-<?php echo $i;?>">
					                Decline
					                 </a>
                                    <div class="modal fade" id="modal-decline-blog-<?php echo $i;?>">
                                            <div class="modal-dialog">
											<div class="modal-content">
											  <div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												  <span aria-hidden="true">&times;</span></button>
												<h4 class="modal-title">Are you sure you want to deline Request</h4>
											  </div>
              
											  <div class="modal-footer" style="width: 365px;">
												
												<button type="button" class="btn btn-primary" onclick="return decline_blog_request('<?php echo site_url();?>','<?php echo $val['id'];?>');">Yes</button>
												<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
											  </div>
											</div>
											
										  </div>
										 
										</div>									 
									 <a  href="#" class="btn btn-danger btn-xs" target="_blank" data-toggle="modal" data-target="#modal-danger-blog-<?php echo $i;?>">
					                        Delete
					                   </a>
									   <div class="modal fade" id="modal-danger-blog-<?php echo $i;?>">
                                            <div class="modal-dialog">
											<div class="modal-content">
											  <div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												  <span aria-hidden="true">&times;</span></button>
												<h4 class="modal-title">Are you sure you want to delete Request</h4>
											  </div>
              
											  <div class="modal-footer" style="width: 365px;">
												
												<button type="button" class="btn btn-primary" onclick="return delete_blog_request('<?php echo site_url();?>','<?php echo $val['id'];?>');">Yes</button>
												<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
											  </div>
											</div>
											
										  </div>
										 
										</div>
					                </td>
                                </tr>
				  <?php 
				  $i++;
				  } ?>
                  
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Sr No</th>
					<th>Category Name</th>
                    <th>Title</th>
					<th>Image</th>
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

<?php echo  $this->endSection(); ?>
