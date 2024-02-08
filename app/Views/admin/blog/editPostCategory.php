<?php echo  $this->extend('admin/templates/blog_template'); ?>

<?php echo  $this->section('content'); ?>
<div class="content-wrapper">
<section class="content-header">
      <h1>
         Edit Blog Category
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>admin/blog/post/categories"><i class="fa fa-dashboard"></i> Categories</a></li>
        <li class="active">Edit</li>
      </ol>
    </section>
	
	

    <!-- Main content -->
    <section class="content">
 <div class="box box-default">
  <div class="box-header">
   <h3 class="box-title"></h3>
  </div>
  
    <form action="<?php echo base_url('admin/blog/post/update-category');?>" method="post" enctype="multipart/form-data">		  
 	   <div class="box-body">
           <div class="form-group">
             <label class="col-sm-2" style="width:150px;margin-top: 4px;font-size: 14px;">Category Name</label>
             <div class="col-sm-3">
			  <input type="text"  id="category_name" name="category_name" class="form-control" placeholder="Enter ..." value="<?php echo $categories['name'];?>">
			  <input type="hidden" id="id" name="id" value="<?php echo $categories['id'];?>">
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
