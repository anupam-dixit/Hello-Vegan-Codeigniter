<?php echo  $this->extend('admin/templates/forum_template'); ?>

<?php echo  $this->section('content'); ?>
<div class="content-wrapper">
<section class="content-header">
      <h1>
         Edit Forum Category
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>admin/forum/post/tags"><i class="fa fa-dashboard"></i> Tags</a></li>
        <li class="active">Edit</li>
      </ol>
    </section>
	
	

    <!-- Main content -->
    <section class="content">
 <div class="box box-default">
  <div class="box-header">
   <h3 class="box-title"></h3>
  </div>
  
    <form action="<?php echo base_url('admin/forum/post/update-tag');?>" method="post" enctype="multipart/form-data">		  
 	   <div class="box-body">
           <div class="form-group">
             <label class="col-sm-2" style="width:150px;margin-top: 4px;font-size: 14px;">Tag Name</label>
             <div class="col-sm-3">
			  <input type="text"  id="tag_name" name="tag_name" class="form-control" placeholder="Enter ..." value="<?php echo $tags['name'];?>">
			  <input type="hidden" id="id" name="id" value="<?php echo $tags['id'];?>">
			 </div>
            <div class="col-sm-6">
			 <button type="submit" class="btn btn-primary">Submit</button>
			 </div>			 
           </div>
	   </div>

    </form>
   
  </div>
  </section>
</div>

<?php echo  $this->endSection(); ?>
