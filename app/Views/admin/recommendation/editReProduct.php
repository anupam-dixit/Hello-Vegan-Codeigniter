<?php echo  $this->extend('admin/templates/recommendation_product_template'); ?>

<?php echo  $this->section('content'); ?>
<div class="content-wrapper">
<section class="content-header">
      <h1>
         Update Product        
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>admin/recommendation/products"><i class="fa fa-dashboard"></i> Products</a></li>
        <li class="active">Update</li>
      </ol>
    </section>
	
	

    <!-- Main content -->
    <section class="content">
 <div class="box box-default">
  <div class="box-header">
   <h3 class="box-title"></h3>
  </div>
   
    <form action="<?php echo base_url('admin/recommendation/update-product');?>" method="post" enctype="multipart/form-data">		  
 	   <div class="box-body">
	    <?php 
		 
		$name='';
		if(session()->getFlashdata('msg')):?>
                    <div class="alert alert-danger" style="width:32%">
                       <?= session()->getFlashdata('msg') ?>
                    </div>
      <?php $name=session()->getFlashdata('rc_name') ?>
	  <?php endif;?>
	  <input type="hidden" name="id" id="id" value="<?php echo $reproduct['id'];?>">
           <div class="col-sm-12">
		   <div class="col-sm-6">
		   <div class="form-group">
             <label>Category</label>
              <select  id="product_category_id" name="product_category_id" class="form-control">
			   <option >Select Category</option>
			  <?php 
				  foreach($recats as $val){
					  $selected='';
					  if($val['id']==$reproduct['category_id']){
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
             <label>Title</label>
              <input type="text"  id="title" name="title" class="form-control" placeholder="Title" value="<?php echo $reproduct['title'];?>">
			</div>
		   </div>
		   </div>
		  <div class="col-sm-12">
		   
		   <div class="col-sm-6">
		   <div class="form-group">
             <label>Link</label>
              <input type="text"  id="product_link" name="product_link" class="form-control" placeholder="Link" value="<?php echo $reproduct['product_link'];?>">
			</div>
		   </div>
		   <div class="col-sm-6">
		   <div class="form-group">
             <label>location</label>
              <input type="text"  id="pac-input" name="location" class="form-control" placeholder="Location" value="<?php echo $reproduct['location'];?>">
			</div>
		   </div>
		   </div>
		   <div class="col-sm-12">
		   
		   <div class="col-sm-6">
		   <div class="form-group">
             <label>Price</label>
              <input type="text"  id="price" name="price" class="form-control" placeholder="Price" value="<?php echo $reproduct['price'];?>">
			</div>
		   </div> 
		   <div class="col-sm-6">
		   <div class="form-group">
             <label>Rating</label>
              <input type="text"  id="rating" name="rating" class="form-control" placeholder="Rating" value="<?php echo $reproduct['rating'];?>">
			</div>
		   </div>
		   
		   </div>
		   
		  
		   
		    <div class="col-sm-12">
		   <div class="col-sm-6">
		   <div class="form-group">
             <label>Image</label>
              <input type="file"  id="image" name="image" class="form-control" placeholder="Image" value="">
			  <?php
			  $image=base_url()."/".$reproduct['image'];
				  if($reproduct['image']!=''){
					 ?>
                 <img src="<?php echo $image;?>" height="100" width="100"> 
				 <?php 					 
				  }
				  
				  ?>
				
			</div>
		   </div>
		   <div class="col-sm-6">
		   <div class="form-group">
             <label>Gallery Image</label>
              <input type="file" multiple  id="galleryimage" name="galleryimage[]" class="form-control" placeholder="Gallery Image" value="">
			   <?php
			     if($reproduct['galleryimage']!=''){
					 $ex=explode(",",$reproduct['galleryimage']);
                      foreach($ex as $val){
			            $image=base_url()."/".$val;			
             		?>
						<img src="<?php echo $image;?>" height="100" width="100"><br>  
						  <?php
					  }					 
				  }
			    ?>
				
			</div>
		   </div>
		   </div>
		   <div class="col-sm-12">
		   
		   <div class="col-sm-6">
		   <div class="form-group">
             <label>Mobile No</label>
              <input type="text"  id="mobile_no" name="mobile_no" class="form-control" placeholder="Mobile No" value="<?php echo $reproduct['mobile_no'];?>">
			</div>
		   </div>
		   <div class="col-sm-6">
		   <div class="form-group">
             <label>Website Link</label>
              <input type="text"  id="website_link" name="website_link" class="form-control" placeholder="Website Link" value="<?php echo $reproduct['website_link'];?>">
			</div>
		   </div>
		   </div>
		   <div class="col-sm-12">
		   
		   <div class="form-group">
             <label>Description</label>
              <textarea  id="content" name="content" class="form-control" placeholder="Description"><?php echo $reproduct['content'];?></textarea>
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
