<?php echo  $this->extend('admin/templates/recommendation_template'); ?>

<?php echo  $this->section('content'); ?>

<div class="content-wrapper">
<section class="content-header">
      <h1>
         Add Recommendation Plans
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>admin/recommendation/plans"><i class="fa fa-dashboard"></i> Plans</a></li>
        <li class="active">Add New</li>
      </ol>
    </section>
	
	

    <!-- Main content -->
    <section class="content">
 <div class="box box-default">
  <div class="box-header">
   <h3 class="box-title"></h3>
  </div>
   
    <form action="<?php echo base_url('admin/recommendation/plans/insert-plan');?>" method="post" enctype="multipart/form-data">		  
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
             <label>Plan Name</label>
              <input type="text"  id="plan_name" name="plan_name" class="form-control" placeholder="Plan Name" value="">
			</div>
		   </div>
		   <div class="col-sm-6">
		   <div class="form-group">
             <label>Title</label>
              <input type="text"  id="title" name="title" class="form-control" placeholder="Title" value="">
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
             <label>Image</label>
              <input type="file"  id="image" name="image" class="form-control" placeholder="Image" value="">
			</div>
		   </div>
		   </div>
		   <div class="col-sm-12">
		   <div class="col-sm-6">
		   <label>-----Add Time Slot------</label>
		   </div>
		   </div>
		   <div class="col-sm-12">
		  <div class="col-sm-6">
		   <div class="form-group">
             
             <label>From</label>
              <input type="text"   name="time_from[]" class="form-control timepicker" placeholder="From" value="">
			</div>
		   </div>
		   <div class="col-sm-6">
		   <div class="form-group">
             <label>To</label>
              <input type="text"   name="time_to[]" class="form-control timepicker" placeholder="To" value="">
			</div>
		   </div>
		   </div>
		   <div id="time_slot_div"></div>
		   <div class="col-sm-12">
		   <div class="col-sm-6"></div>
		   <div class="col-sm-6" style="text-align:right">
		   <input  type="button" class="btn btn-primary" value="AddMoreTimeSlot" onclick="addMoreTimeSlot()">
		   </div>
		   </div>
		   
		   <div class="col-sm-12">
		   <div class="col-sm-12">
		   <div class="form-group">
             <label>Description</label>
              <textarea  id="description" name="description" class="form-control" placeholder="Description"></textarea>
			</div>
			</div>
		  
		   </div>
		 <div class="col-sm-12">
		 <div class="col-sm-6"></div>
		 <div class="col-sm-6" style="text-align:right">
			 <button type="submit" class="btn btn-primary">Submit</button>
			 </div>	
		 </div>
			
	   </div>

    </form>
   
  </div>

 </section>
</div>

<script>
function addMoreTimeSlot(){
	var html='<div class="col-sm-12">';
	html+='<div class="col-sm-6"><div class="form-group"><label>From</label><input type="text"   name="time_from[]" class="form-control timepicker" placeholder="From" value=""></div></div>';
	html+='<div class="col-sm-4"><div class="form-group"><label>To</label><input type="text"   name="time_to[]" class="form-control timepicker" placeholder="To" value=""></div></div>';
	html+='<div class="col-sm-2"><input style="margin-top:25px"  type="button" class="btn btn-primary" value="DeleteRow" onclick="DeleteRow(this)"></div>';
	html+='</div>';	
    $("#time_slot_div").append(html);
    $('input.timepicker').timepicker({});	
}
function DeleteRow(str){
	
	$(str).parent().parent().remove();
}





</script>
<?php echo  $this->endSection(); ?>
