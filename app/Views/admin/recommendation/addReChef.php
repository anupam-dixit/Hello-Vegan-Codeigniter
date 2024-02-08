<?php echo  $this->extend('admin/templates/recommendation_chef_template'); ?>

<?php echo  $this->section('content'); ?>
<div class="content-wrapper">
<section class="content-header">
      <h1>
         Add Chef
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>admin/recommendation/chefs"><i class="fa fa-dashboard"></i> Chefs</a></li>
        <li class="active">Add New</li>
      </ol>
    </section>
	
	

    <!-- Main content -->
    <section class="content">
 <div class="box box-default">
  <div class="box-header">
   <h3 class="box-title"></h3>
  </div>
   
    <form action="<?php echo base_url('admin/recommendation/insert-chef');?>" method="post" enctype="multipart/form-data">		  
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
		   <div class="col-sm-6">
		   <div class="form-group">
             <label>Category</label>
               <select  id="product_category_id" name="chef_category_id" class="form-control">
			   <option >Select Category</option>
			  <?php 
				  foreach($recats as $val){
			      ?>
				  <option  
				  value="<?php echo $val['id'];?>"><?php echo $val['name'];?></option>
                  <?php
                  }				  
                  ?>	
			  </select>
			</div>
		   </div>
		   <div class="col-sm-6">
		   <div class="form-group">
             <label>Name</label>
              <input type="text"  id="name" name="name" class="form-control" placeholder="Name" value="">
			</div>
		   </div>
		   </div>
		   <div class="col-sm-12">
		   
		   <div class="col-sm-6">
		   <div class="form-group">
             <label>Email</label>
              <input type="text"  id="email" name="email" class="form-control" placeholder="Email" value="">
			</div>
		   </div>
		   <div class="col-sm-6">
		   <div class="form-group">
             <label>Address</label>
              <input type="text"  id="address" name="address" class="form-control" placeholder="Address" value="">
			</div>
		   </div>
		   </div>
		   <div class="col-sm-12">
		   <div class="col-sm-6">
		   <div class="form-group">
             <label>location</label>
              <input type="text"  id="pac-input" name="location" class="form-control" placeholder="Location" value="">
			</div>
		   </div>
		   <div class="col-sm-6">
		   
		   <div class="form-group">
             <label>Rating</label>
              <input type="text"  id="rating" name="rating" class="form-control" placeholder="Rating" value="">
			</div>
		   </div>
		   
		   </div>
		   
		   
		   <div class="col-sm-12">
		    <div class="col-sm-6">
		   <div class="form-group">
             <label>Contact No</label>
              <input type="text"  id="contact_no" name="contact_no" class="form-control" placeholder="Contact No" value="">
			</div>
		   </div>
		   <div class="col-sm-6">
		   <div class="form-group">
             <label>Image</label>
              <input type="file"  id="image" name="image" class="form-control" placeholder="Image" value="">
			  
			</div>
		   </div>
		 
		   </div>
		   
		    
		   <div class="col-sm-12">
		   
		   <div class="form-group">
             <label>Description</label>
              <textarea  id="content" name="content" class="form-control" placeholder="Description"></textarea>
			</div>
		  
		   </div>
		 
			<div class="col-sm-6">
			 <button type="submit" class="btn btn-primary">Submit</button>
			 </div>	
	   </div>

    </form>
   
  </div>

 </section>
</div>
<?php
$key="AIzaSyBlf2VfOx5bL5rwlTP4hG5luZxZaLV6xEI";
$googleWeb="https://maps.googleapis.com/maps/api/js";
$googleAddress=$googleWeb."?key=".$key."&libraries=places&callback=initMap";
?>
<script src="<?php echo $googleAddress;?>"   async defer></script>
<script>
function initMap() {
  var input = document.getElementById('pac-input');
  var autocomplete = new google.maps.places.Autocomplete(input);
}
</script>
<?php echo  $this->endSection(); ?>
