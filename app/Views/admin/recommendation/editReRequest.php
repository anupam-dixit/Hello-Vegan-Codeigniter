<?php echo  $this->extend('admin/templates/recommendation_template'); ?>

<?php echo  $this->section('content'); ?>
<div class="content-wrapper">
<section class="content-header">
      <h1>
         Add Recommendation Requests
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>admin/recommendation/requests"><i class="fa fa-dashboard"></i> Requests</a></li>
        <li class="active">Add New</li>
      </ol>
    </section>
	
	

    <!-- Main content -->
    <section class="content">
 <div class="box box-default">
  <div class="box-header">
   <h3 class="box-title"></h3>
  </div>
   
    <form action="<?php echo base_url('admin/recommendation/update-request');?>" method="post" enctype="multipart/form-data">		  
 	   <div class="box-body">
	    <?php 
		 
		$name='';
		if(session()->getFlashdata('msg')):?>
                    <div class="alert alert-danger" style="width:32%">
                       <?= session()->getFlashdata('msg') ?>
                    </div>
      <?php $name=session()->getFlashdata('rc_name') ?>
	  <?php endif;?>
	  <input type="hidden" name="id" id="id" value="<?php echo $rerequest['id'];?>">
           <div class="col-sm-12">
		   <div class="col-sm-6">
		   <div class="form-group">
             <label>Category</label>
              <select  id="category" name="category" class="form-control">
			   <option >Select Category</option>
			  <?php 
				  foreach($recats as $val){
					  $selected='';
					  if($val['id']==$rerequest['category_id']){
					  $selected='selected';	  
					  }
			      ?>
				  <option  
				  value="<?php echo $val['id'];?>" <?php echo $selected;?>><?php echo $val['name'];?></option>
                  <?php
                  }				  
                  ?>	
			  </select>
			</div>
		   </div>
		    <div class="col-sm-6">
		   <div class="form-group">
             <label>User Name</label>
               <select  id="user_id" name="user_id" class="form-control">
			   <option >Select User</option>
			  <?php 
				  foreach($reusers as $val){
					  $selected='';
					  if($val['id']==$rerequest['user_id']){
					  $selected='selected';	  
					  }
			      ?>
				  <option  
				  value="<?php echo $val['id'];?>" <?php echo $selected;?>><?php echo $val['name'];?></option>
                  <?php
                  }				  
                  ?>	
			  </select>
			</div>
		   </div>
		   </div>
		  
		   <div class="col-sm-12">
		   <div class="col-sm-6">
		   <div class="form-group">
             <label>Title</label>
              <input type="text"  id="title" name="title" class="form-control" placeholder="Title" value="<?php echo $rerequest['title'];?>">
			</div>
		   </div>
		   <div class="col-sm-6">
		   <div class="form-group">
             <label>Image</label>
              <input type="file"  id="image" name="image" class="form-control" placeholder="Image" value="">
			  <?php
			  $image=base_url()."/".$rerequest['image'];
				  if($rerequest['image']==''){
					 $image=base_url()."/public/noimage.jpg";  
				  }
				  
				  ?>
				<img src="<?php echo $image;?>" height="100" width="100">  
			</div>
		   </div>
		   </div>
		   <div class="col-sm-12">
		   <div class="col-sm-6">
		   <div class="form-group">
             <label>URL</label>
              <input type="text"  id="url" name="url" class="form-control" placeholder="URL" value="<?php echo $rerequest['url'];?>">
			</div>
		   </div>
		   <div class="col-sm-6">
		   <div class="form-group">
             <label>Plan Details</label>
            
			  <select  id="plan" name="plan" class="form-control">
			   <option >Select Plan</option>
			  <?php 
				  foreach($replans as $val){
					  $selected='';
					  if($val['id']==$rerequest['plan_id']){
					  $selected='selected';	  
					  }
			      ?>
				  <option  
				  value="<?php echo $val['id'];?>" <?php echo $selected;?>><?php echo $val['plan_name'];?></option>
                  <?php
                  }				  
                  ?>	
			  </select>
			</div>
		   </div>
		   </div>
		   <div class="col-sm-12">
		   
		   <div class="col-sm-6">
		   <div class="form-group">
             <label>Location</label>
              <input type="text"  id="location_where" name="location_where" class="form-control" placeholder="Location" value="<?php echo $rerequest['location_where'];?>">
			</div>
		   </div>
		    <div class="col-sm-6">
		   <div class="form-group">
             <label>City Location</label>
              <input type="text"  id="pac-input" name="location_city" class="form-control" placeholder="City Location" value="<?php echo $rerequest['location_city'];?>">
			</div>
		   </div>
		   </div>
		   <div class="col-sm-12">
		   <div class="col-sm-6">
		   <div class="form-group">
             <label>Date From</label>
           
			  <input type="date"  id="date_from" name="date_from" class="form-control" placeholder="Date From" value="<?php echo $rerequest['date_from'];?>">
			</div>
		   </div>
		   <div class="col-sm-6">
		   <div class="form-group">
             <label>Date To</label>
              <input type="date"  id="date_to" name="date_to" class="form-control" placeholder="Date From" value="<?php echo $rerequest['date_to'];?>">
			</div>
		   </div>
		   </div> 
		   <div class="col-sm-12">
		   
		   <div class="form-group">
             <label>Description</label>
              <textarea  id="description" name="description" class="form-control" placeholder="Description"><?php echo $rerequest['description'];?></textarea>
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
