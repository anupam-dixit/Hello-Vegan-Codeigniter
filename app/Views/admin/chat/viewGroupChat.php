<?php echo  $this->extend('admin/templates/chat_template'); ?>

<?php echo  $this->section('content'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Chat
        <small>panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>admin/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Chat</li>
      </ol>
    </section>
	
	

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        
		 <div class="col-xs-12">
            
          <div class="box">
              <div class="box-header">
                <h3 class="box-title">Group Chats</h3>
              </div>
              <!-- /.box-header -->
			 
              <div class="box-body">
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                 	<th>Sr No</th>
					<th>User</th>
					<th>Message</th>
					
                   
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
				  $i=1;
				  foreach($groups_message as $val) { ?>
				  <tr>
				    
                    <td><?php echo $i;?></td>
                    <td><?php echo $val['uname'];?></td>
                  
                    <td><?php echo $val['msg'];?></td>
                  
                   
					
				  </tr>
				  
			    <?php 
				  $i++;
				  } ?>
                  
                  </tbody>
                  <tfoot>
                  <tr>
                 	<th>Sr No</th>
					<th>User</th>
					<th>Message</th>
				 </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.box-body -->
            </div>  <!-- /.box -->

            
       
          <!-- /.col -->
        </div>
        
		
		
		
       </div>
     
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>


<?php echo  $this->endSection(); ?>
