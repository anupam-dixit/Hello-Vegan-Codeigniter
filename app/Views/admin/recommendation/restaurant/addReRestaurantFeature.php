<?php echo  $this->extend('admin/templates/restaurant_template'); ?>

<?php echo  $this->section('content'); ?>
<div class="content-wrapper">
<section class="content-header">
      <h1>
         Add Restaurant Features 
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>/admin/recommendation/restaurant/features"><i class="fa fa-dashboard"></i> Restaurants</a></li>
        <li class="active">Add Restaurant Features</li>
      </ol>
    </section>
	
	

    <!-- Main content -->
    <section class="content">
 <div class="box box-default">
  <div class="box-header">
   <h3 class="box-title"></h3>
  </div>
   
    <form action="<?php echo base_url('/admin/recommendation/restaurant/insert-restaurant-feature');?>" method="post" enctype="multipart/form-data">		
<input type="hidden" name="id" value="<?php echo $refeatures[0]['id'];?>">	
 	   <div class="box-body">
	    <?php 
		$name='';
		if(session()->getFlashdata('msg')):?>
                    <div class="alert alert-danger" style="width:32%">
                       <?= session()->getFlashdata('msg') ?>
                    </div>
      <?php $name=session()->getFlashdata('rc_name') ?>
	  <?php endif;?>
	  
           <div class="col-sm-12">
		   <div class="col-sm-4">
		  <div class="form-group">
             <label>Features  Name</label>
              <input type="text"  id="name" name="name" class="form-control" placeholder="Name" value="">
			</div>
		   </div>
		    <div class="col-sm-4">
		    <div class="form-group">
			<label>Image</label>
              <input type="file"  id="svgData" name="svgData" class="form-control" placeholder="Image" value="">
			 
			</div>
		   </div>
		   <div class="col-sm-3">
		   <label>&nbsp;</label>
			 <button type="submit" class="btn btn-primary" style="margin-top:26px;">Submit</button>
			 </div>
		   </div>
		 
				 
	   </div>
      
    </form>
   
  </div>

 </section>
</div>


<?php echo  $this->endSection(); ?>
