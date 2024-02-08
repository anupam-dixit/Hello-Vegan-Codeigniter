<?php echo  $this->extend('admin/templates/news_template'); ?>
<?php echo  $this->section('content'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Friend Posts
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
					<th>Posted</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
				  $i=1;
				  foreach($posts as $val) { ?>
				  <tr>
				    
                    <td><?php echo $i;?></td>
                    <td><?php echo $val['name'];?></td>
					<td><?php echo $val['title'];?></td>
                    <td>
					<?php 
					if($val['image']!=''){
					?>
					<img src="<?php echo base_url();?>/<?php echo $val['image'];?>" width="70" height="70">
					<?php 
					}
					?>
					<div style="display:none"><?php echo $val['post_type'];?></div>
					</td>
                    <td>
					<?php echo $val['created_at'];?>
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
					<th>Posted</th>
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
