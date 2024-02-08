<?php echo  $this->extend('admin/templates/restaurant_template'); ?>

<?php echo  $this->section('content'); ?>
<div class="content-wrapper">
<section class="content-header">
      <h1>
         Add Restaurant 
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>admin/recommendation/restaurants"><i class="fa fa-dashboard"></i> Restaurants</a></li>
        <li class="active">Add New</li>
      </ol>
    </section>
	
	

    <!-- Main content -->
    <section class="content">
 <div class="box box-default">
  <div class="box-header">
   <h3 class="box-title"></h3>
  </div>
   
    <form action="<?php echo base_url('admin/recommendation/restaurant/insert-restaurant');?>" method="post" enctype="multipart/form-data">		  
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
               <select  id="category" name="category_id" class="form-control">
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
             <label>Restaurant  Name</label>
              <input type="text"  id="name" name="name" class="form-control" placeholder="Name" value="">
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
             <label>Rating</label>
              <input type="text"  id="rating" name="rating" class="form-control" placeholder="Rating" value="">
			</div>
		   </div>
		   
		   </div>
		   <div class="col-sm-12">
		   <div class="col-sm-6">
		   <div class="form-group">
             <label>Price</label>
              <input type="text"  id="price" name="price" class="form-control" placeholder="Price" value="">
			</div>
		   </div>
		   
		   <div class="col-sm-6">
		   <div class="form-group">
             <label>Price For Approx People</label>
              <input type="text"  id="approx" name="approx" class="form-control" placeholder="approx" value="">
			(for example : Two,Three,Four)
			</div>
		   </div>
		   </div>
		   <div class="col-sm-12">
		   <div class="col-sm-6">
		   <div class="form-group">
             <label>Discount</label>
              <input type="text"  id="discount" name="discount" class="form-control" placeholder="Discount" value="">
			</div>
		   </div>
		   <div class="col-sm-6">
		   <div class="form-group">
             <label>Location</label>
              <input type="text"  id="pac-input" name="location" class="form-control" placeholder="Location" value="">
			</div>
		   </div>
		   </div>
		   
		   <div class="col-sm-12">
		   <div class="col-sm-6">
		   <div class="form-group">
             <label>Opening Time</label>
           
			  <input type="time"  id="opening_time" name="opening_time" class="form-control" placeholder="Opening Time" value="">
			</div>
		   </div>
		   <div class="col-sm-6">
		   <div class="form-group">
             <label>Closing Time</label>
           
			  <input type="time"  id="closing_time" name="closing_time" class="form-control" placeholder="Closing Time" value="">
			</div>
		   </div>
		   </div> 
		   <div class="col-sm-12">
		   
		   <div class="form-group">
             <label>Description</label>
              <textarea  id="detail" name="detail" class="form-control" placeholder="Description"></textarea>
			</div>
		  
		   </div>
		    <div class="col-sm-12">
		   <div class="col-sm-4">
		   <div class="form-group">
             <label>Image</label>
              <input type="file"  id="image" name="image" class="form-control" placeholder="Image" value="">
			</div>
		   </div>
		   <div class="col-sm-4">
		   <div class="form-group">
             <label>Upload Menu(PDF)</label>
              <input type="file"  id="menu" name="menu" class="form-control" placeholder="Upload Menu(PDF)" value="">
			</div>
		   </div>
		   <div class="col-sm-4">
		   <div class="form-group">
             <label>Add Gallery Images</label>
              <input type="file"  id="gallary" multiple name="gallary" class="form-control" placeholder="Image" value="">
			</div>
		   </div>
		   </div>
		 <div class="col-sm-12">
		   <div class="col-sm-6">
		   <div class="form-group">
             <label>Feature Name</label>
              <?php 
			  foreach($refeatures as $val){
			  ?>
			  <p style="padding-right:25px;"><input  type="checkbox"   name="features[]"  placeholder="Feature Name" value="<?php echo $val['id'];?>">
			  <?php echo $val['name'];?></p> 
			  <?php 
			  }
			  ?>
			</div>
			</div>
		 
		   </div>
		 <div class="col-sm-12"><div class="col-sm-9"></div>
			<div class="col-sm-3">
			 <button type="submit" class="btn btn-primary">Submit</button>
			 </div>
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

  function deleteRowSlip(id){
	   document.getElementById("fieldslip_"+id).remove();
  }
</script>
<?php echo  $this->endSection(); ?>
