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
        <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">Single Chat Users</a></li>
              <li><a href="#tab_2" data-toggle="tab">Group Chat Users</a></li>
              
              
              <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
               <div class="box">
              <div class="box-header">
                <h3 class="box-title">Chat Users  List</h3>
              </div>
              <!-- /.box-header -->
			 
              <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                 	<th>Sr No</th>
					<th>User1</th>
					<th>User2</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
				  $i=1;
				  foreach($chatusers as $val) { ?>
				  <tr>
				    
                    <td><?php echo $i;?></td>
                    <td><?php echo $val['sender_name'];?></td>
                    <td><?php echo $val['reciever_name'];?></td>
                   
					<td >
					
					
				    <a href="<?php echo base_url();?>/admin/chat/view-all-chat/<?php echo $val['sender'].'-'.$val['reciever'];?>"  class="btn btn-warning btn-xs" >
					View
					</a>
					 
					
				
					</td>
				  </tr>
				  
			    <?php 
				  $i++;
				  } ?>
                  
                  </tbody>
                  <tfoot>
                  <tr>
                 	<th>Sr No</th>
					<th>User1</th>
					<th>User2</th>
                    <th>Actions</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.box-body -->
            </div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
               <div class="box">
              <div class="box-header">
                <h3 class="box-title">Group List</h3>
              </div>
              <!-- /.box-header -->
			 
              <div class="box-body">
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                 	<th>Sr No</th>
					<th>Group Name</th>
					
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
				  $i=1;
				  foreach($chatgroups as $val) { ?>
				  <tr>
				    
                    <td><?php echo $i;?></td>
                    <td><?php echo $val['group_name'];?></td>
                    <td>
					<a href="<?php echo base_url();?>/admin/chat/view-group-chat/<?php echo $val['group_id'];?>"  class="btn btn-warning btn-xs" >
					View
					</a>
					</td>
				  </tr>
				  
			    <?php 
				  $i++;
				  } ?>
                  
                  </tbody>
                  <tfoot>
                  <tr>
                 	<th>Sr No</th>
					<th>Group Name</th>
					
                    <th>Actions</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.box-body -->
            </div>
              </div>
              <!-- /.tab-pane -->
             
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
        </div>
		 <div class="col-xs-12">
            
            <!-- /.box -->

            
       
          <!-- /.col -->
        </div>
        
		
		
		
       </div>
     
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>


<?php echo  $this->endSection(); ?>
