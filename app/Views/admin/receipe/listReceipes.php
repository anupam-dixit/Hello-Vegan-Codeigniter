<?php echo  $this->extend('admin/templates/receipe_template'); ?>
<?php echo  $this->section('content'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Receipe's
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
                     
					<th>Sr No</th>
					<th>Category Name</th>
          <th>Title</th>
					<th>Image</th>
					<th>Actions</th>
                   
                
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
				  $i=1;
				  foreach($receipes as $val) { ?>
				  <tr>
				    
                    <td><?php echo $i;?></td>
                    <td><?php echo $val['category_name'];?></td>
					<td><?php echo $val['title'];?></td>
                    <td>
					<?php 
					if($val['image']!=''){
					?>
					<img src="<?php echo base_url();?>/<?php echo $val['image'];?>" width="70" height="70">
					<?php 
					}
					?>
					</td>
                    
					
					
					<td >
					
					
				    <a href="<?php echo base_url();?>/admin/receipe/edit/<?php echo $val['id'];?>"  class="btn btn-warning btn-xs" >
					Edit
					</a>
					 <a href="<?php echo base_url();?>/admin/receipe/view/<?php echo $val['id'];?>"  class="btn btn-info btn-xs">
					View
					</a>
					<a  href="#" class="btn btn-danger btn-xs" target="_blank" data-toggle="modal" data-target="#modal-danger<?php echo $i;?>">
					Delete
					</a>
			<!--	     <a href="<?php echo base_url();?>/admin/receipe/manage-comments/<?php echo $val['id'];?>"  class="btn btn-primary btn-xs">
					Manage Comments
					</a>-->
					</td>
				  </tr>
				   <div class="modal fade" id="modal-danger<?php echo $i;?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Are you sure you want to delete Post</h4>
              </div>
              
              <div class="modal-footer" style="width: 365px;">
                
                <button type="button" class="btn btn-primary" onclick="return delete_post('<?php echo site_url();?>','<?php echo $val['id'];?>');">Yes</button>
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
