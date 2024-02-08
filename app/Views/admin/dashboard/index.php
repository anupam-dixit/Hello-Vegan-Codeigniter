<?= $this->extend('admin/templates/admin_template') ?>
<?= $this->section('content') ?>
<?php
$public_url=base_url()."/public/";
$mon=$tue=$wed=$thu=$fri=$sat=$sun=1;
if(count($total_active_users_day_wise)!=0){
	foreach($total_active_users_day_wise as $vals){
		if($vals['Day']=='Monday'){
			$mon=$vals['Count'];
		}
		if($vals['Day']=='Tuesday'){
			$tue=$vals['Count'];
		}
		if($vals['Day']=='Wednesday'){
			$wed=$vals['Count'];
		}
		if($vals['Day']=='Thursday'){
			$thu=$vals['Count'];
		}
		if($vals['Day']=='Friday'){
			$fri=$vals['Count'];
		}
		if($vals['Day']=='Saturday'){
			$sat=$vals['Count'];
		}
		if($vals['Day']=='Sunday'){
			$sun=$vals['Count'];
		}
	}
}
?>
 <link rel="stylesheet" href="<?php echo  $public_url;?>bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="#"><i class="fa fa-dashboard"></i> Home</a>
            </li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-2 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>
                            <?php 
				echo $total_active_users;
				?>
                        </h3>

                        <p>Users</p>
                    </div>
                    <div class="icon">
                        <img src="<?php echo site_url();?>public/dashboard_icon/user.png" width="55">
                    </div>
                    <a href="<?php echo site_url();?>admin/users" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-2 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>
                            <?php 
				echo $total_active_blogs;
				?>
                        </h3>

                        <p>Blogs</p>
                    </div>
                    <div class="icon">
                        <img src="<?php echo site_url();?>public/dashboard_icon/blog.png" width="55">
                    </div>
                    <a href="<?php echo site_url();?>admin/blog/posts" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-2 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>
                            <?php 
				echo $total_active_events;
				?>
                        </h3>

                        <p>Events</p>
                    </div>
                    <div class="icon">
                        <img src="<?php echo site_url();?>public/dashboard_icon/event.png" width="55">
                    </div>
                    <a href="<?php echo site_url();?>admin/event/list" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-2 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>
                            <?php 
				echo $total_active_news;
				?>
                        </h3>

                        <p>News</p>
                    </div>
                    <div class="icon">
                        <img src="<?php echo site_url();?>public/dashboard_icon/news.png" width="55">
                    </div>
                    <a href="<?php echo site_url();?>admin/news/posts" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-2 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>
                            <?php 
				echo $total_active_recipes;
				?>
                        </h3>

                        <p>Recipe</p>
                    </div>
                    <div class="icon">
            <img src="<?php echo site_url();?>public/dashboard_icon/ReceipeManagement.png" width="55">
                    </div>
                    <a href="<?php echo site_url();?>admin/receipe/list" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-2 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>
                            <?php 
				echo $total_active_recommendations;
				?>
                        </h3>

                        <p>Recommendation</p>
                    </div>
                    <div class="icon">
                         <img src="<?php echo site_url();?>public/dashboard_icon/RecommendationManagement.png" width="55">
                    </div>
                    <a href="<?php echo site_url();?>admin/recommendation/requests" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="wrapper_performance">
                    <div class="widget-container">
                        <div class="widget">
                            <div class="widget-header">
                                <div class="widget-header-left">
                                    <h5 class="widget-title">
                                        Daily Users
                                    </h5>
                                </div>
                                <div class="widget-header-right"></div>
                            </div>
                            <div class="widget-body">
                                <canvas id="myChart4"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->

            <div class="col-lg-6 col-md-6">
                <div class="wrapper_performance">
                    <div class="widget-container">
                        <div class="widget">
                            <div class="widget-header">
                                <div class="widget-header-left">
                                    <h5 class="widget-title">
                                        Statistics
                                    </h5>
                                </div>
                                <div class="widget-header-right"></div>
                            </div>
                            <div class="widget-body">
                                <canvas id="myChart5"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-30">Pending Blog Requests</h4>

                    <div class="table-responsive">
                        <table  id="pending_blogs" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Category Name</th>
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Date</th>
                                    <th>Posted By</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
								$i=1;
								foreach($pending_request_blogs as $val){
								?>
								<tr>
                                    <td><?php echo $i;?></td>
                                    <td><?php echo $val['category_name'];?></td>
                                    <td><?php echo $val['title'];?></td>
                                    <td><?php 
										if($val['image']!=''){
										?>
										<img src="<?php echo base_url();?>/<?php echo $val['image'];?>" width="70" height="70">
										<?php 
										}
										?>
										</td>
                                    <td><?php echo $val['created_at'];?></td>
                                    <td>
									<?php 
									echo $val['user_name'];	
									
									?>
									
									</td>
                                    <td>
									<a  href="#" class="btn btn-warning btn-xs" target="_blank" data-toggle="modal" data-target="#modal-accept-blog-<?php echo $i;?>">
					                Accept
					                 </a>
									 <div class="modal fade" id="modal-accept-blog-<?php echo $i;?>">
                                            <div class="modal-dialog">
											<div class="modal-content">
											  <div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												  <span aria-hidden="true">&times;</span></button>
												<h4 class="modal-title">Are you sure you want to Accept Request</h4>
											  </div>
              
											  <div class="modal-footer" style="width: 365px;">
												
												<button type="button" class="btn btn-primary" onclick="return approve_blog_request('<?php echo site_url();?>','<?php echo $val['id'];?>');">Yes</button>
												<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
											  </div>
											</div>
											
										  </div>
										 
										</div>
									<a  href="#" class="btn btn-info btn-xs" target="_blank" data-toggle="modal" data-target="#modal-decline-blog-<?php echo $i;?>">
					                Decline
					                 </a>
                                    <div class="modal fade" id="modal-decline-blog-<?php echo $i;?>">
                                            <div class="modal-dialog">
											<div class="modal-content">
											  <div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												  <span aria-hidden="true">&times;</span></button>
												<h4 class="modal-title">Are you sure you want to deline Request</h4>
											  </div>
              
											  <div class="modal-footer" style="width: 365px;">
												
												<button type="button" class="btn btn-primary" onclick="return decline_blog_request('<?php echo site_url();?>','<?php echo $val['id'];?>');">Yes</button>
												<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
											  </div>
											</div>
											
										  </div>
										 
										</div>									 
									 <a  href="#" class="btn btn-danger btn-xs" target="_blank" data-toggle="modal" data-target="#modal-danger-blog-<?php echo $i;?>">
					                        Delete
					                   </a>
									   <div class="modal fade" id="modal-danger-blog-<?php echo $i;?>">
                                            <div class="modal-dialog">
											<div class="modal-content">
											  <div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												  <span aria-hidden="true">&times;</span></button>
												<h4 class="modal-title">Are you sure you want to delete Request</h4>
											  </div>
              
											  <div class="modal-footer" style="width: 365px;">
												
												<button type="button" class="btn btn-primary" onclick="return delete_blog_request('<?php echo site_url();?>','<?php echo $val['id'];?>');">Yes</button>
												<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
											  </div>
											</div>
											
										  </div>
										 
										</div>
					                </td>
                                </tr>
								<?php 
								$i++;
								}
								?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
<div class="col-lg-12">
                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-30">Pending Event Requests</h4>

                    <div class="table-responsive">
                        <table  id="pending_events" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Category Name</th>
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Date</th>
                                    <th>Posted By</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
								$i=1;
								foreach($pending_request_events as $val){
								?>
								<tr>
                                    <td><?php echo $i;?></td>
                                    <td><?php echo $val['category_name'];?></td>
                                    <td><?php echo $val['name'];?></td>
                                    <td><?php 
										if($val['image']!=''){
										?>
										<img src="<?php echo base_url();?>/<?php echo $val['image'];?>" width="70" height="70">
										<?php 
										}
										?>
										</td>
                                    <td><?php echo $val['created_at'];?></td>
                                    <td><?php 
									if($val['au_user_name']==''){
									echo $val['user_name'];	
									}else{
									echo $val['au_user_name'];	
									}
									?></td>
                                    <td>
									<a  href="#" class="btn btn-warning btn-xs" target="_blank" data-toggle="modal" data-target="#modal-accept-event-<?php echo $i;?>">
					                Accept
					                 </a>
									 <div class="modal fade" id="modal-accept-event-<?php echo $i;?>">
                                            <div class="modal-dialog">
											<div class="modal-content">
											  <div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												  <span aria-hidden="true">&times;</span></button>
												<h4 class="modal-title">Are you sure you want to Accept Request</h4>
											  </div>
              
											  <div class="modal-footer" style="width: 365px;">
												
												<button type="button" class="btn btn-primary" onclick="return approve_event_request('<?php echo site_url();?>','<?php echo $val['id'];?>');">Yes</button>
												<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
											  </div>
											</div>
											
										  </div>
										 
										</div>
									<a  href="#" class="btn btn-info btn-xs" target="_blank" data-toggle="modal" data-target="#modal-decline-event-<?php echo $i;?>">
					                Decline
					                 </a>
                                    <div class="modal fade" id="modal-decline-event-<?php echo $i;?>">
                                            <div class="modal-dialog">
											<div class="modal-content">
											  <div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												  <span aria-hidden="true">&times;</span></button>
												<h4 class="modal-title">Are you sure you want to deline Request</h4>
											  </div>
              
											  <div class="modal-footer" style="width: 365px;">
												
												<button type="button" class="btn btn-primary" onclick="return decline_event_request('<?php echo site_url();?>','<?php echo $val['id'];?>');">Yes</button>
												<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
											  </div>
											</div>
											
										  </div>
										 
										</div>									 
									 <a  href="#" class="btn btn-danger btn-xs" target="_blank" data-toggle="modal" data-target="#modal-danger-event-<?php echo $i;?>">
					                        Delete
					                   </a>
									   <div class="modal fade" id="modal-danger-event-<?php echo $i;?>">
                                            <div class="modal-dialog">
											<div class="modal-content">
											  <div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												  <span aria-hidden="true">&times;</span></button>
												<h4 class="modal-title">Are you sure you want to delete Request</h4>
											  </div>
              
											  <div class="modal-footer" style="width: 365px;">
												
												<button type="button" class="btn btn-primary" onclick="return delete_event_request('<?php echo site_url();?>','<?php echo $val['id'];?>');">Yes</button>
												<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
											  </div>
											</div>
											
										  </div>
										 
										</div>
					                </td>
                                </tr>
								<?php 
								$i++;
								}
								?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
        
		
		<div class="col-lg-12">
                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-30">Pending Receipe Requests</h4>

                    <div class="table-responsive">
                        <table  id="pending_receipes" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Category Name</th>
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Date</th>
                                    <th>Posted By</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
								$i=1;
								foreach($pending_request_receipes as $val){
								?>
								<tr>
                                    <td><?php echo $i;?></td>
                                    <td><?php echo $val['category_name'];?></td>
                                    <td><?php echo $val['title'];?></td>
                                    <td><?php 
										if($val['image']!=''){
										?>
										<img src="<?php echo base_url();?>/<?php echo $val['image'];?>" width="70" height="70">
										<?php 
										}
										?>
										</td>
                                    <td><?php echo $val['created_at'];?></td>
                                    <td><?php 
									if($val['au_user_name']==''){
									echo $val['user_name'];	
									}else{
									echo $val['au_user_name'];	
									}
									?></td>
                                    <td>
									<a  href="#" class="btn btn-warning btn-xs" target="_blank" data-toggle="modal" data-target="#modal-accept-recipe-<?php echo $i;?>">
					                Accept
					                 </a>
									 <div class="modal fade" id="modal-accept-recipe-<?php echo $i;?>">
                                            <div class="modal-dialog">
											<div class="modal-content">
											  <div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												  <span aria-hidden="true">&times;</span></button>
												<h4 class="modal-title">Are you sure you want to Accept Request</h4>
											  </div>
              
											  <div class="modal-footer" style="width: 365px;">
												
												<button type="button" class="btn btn-primary" onclick="return approve_recipe_request('<?php echo site_url();?>','<?php echo $val['id'];?>');">Yes</button>
												<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
											  </div>
											</div>
											
										  </div>
										 
										</div>
									<a  href="#" class="btn btn-info btn-xs" target="_blank" data-toggle="modal" data-target="#modal-decline-recipe-<?php echo $i;?>">
					                Decline
					                 </a>
                                    <div class="modal fade" id="modal-decline-recipe-<?php echo $i;?>">
                                            <div class="modal-dialog">
											<div class="modal-content">
											  <div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												  <span aria-hidden="true">&times;</span></button>
												<h4 class="modal-title">Are you sure you want to deline Request</h4>
											  </div>
              
											  <div class="modal-footer" style="width: 365px;">
												
												<button type="button" class="btn btn-primary" onclick="return decline_recipe_request('<?php echo site_url();?>','<?php echo $val['id'];?>');">Yes</button>
												<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
											  </div>
											</div>
											
										  </div>
										 
										</div>									 
									 <a  href="#" class="btn btn-danger btn-xs" target="_blank" data-toggle="modal" data-target="#modal-danger-recipe-<?php echo $i;?>">
					                        Delete
					                   </a>
									   <div class="modal fade" id="modal-danger-recipe-<?php echo $i;?>">
                                            <div class="modal-dialog">
											<div class="modal-content">
											  <div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												  <span aria-hidden="true">&times;</span></button>
												<h4 class="modal-title">Are you sure you want to delete Request</h4>
											  </div>
              
											  <div class="modal-footer" style="width: 365px;">
												
												<button type="button" class="btn btn-primary" onclick="return delete_recipe_request('<?php echo site_url();?>','<?php echo $val['id'];?>');">Yes</button>
												<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
											  </div>
											</div>
											
										  </div>
										 
										</div>
					                </td>
                                </tr>
								<?php 
								$i++;
								}
								?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
  
		
		
		
		</div>

        <!-- /.row (main row) -->
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>

    <!-- /.content -->
</div>
<script>
var ctx = document.getElementById("myChart4").getContext('2d');
var myChart = new Chart(ctx, {
	type: 'line',
	data: {
		labels: ["Sun","Mon","Tues","Wens","Thurs","Fri","Satur"],
		datasets: [
			{
			label: 'Users',
			borderColor: '#FF3BFF',
			fill: false,
			data: [<?php echo $sun;?>,<?php echo $mon;?>,<?php echo $tue;?>,<?php echo $wed;?>,<?php echo $thu;?>,<?php echo $fri;?>,<?php echo $sat?>],
			borderWidth: 0,
				pointStyle: 'line',
		    },
		]
	},
    options: {
	plugins: {
		maintainAspectRatio: false,
        tooltip: {
				displayColors: true,
				backgroundColor: 'red',
					mode: 'index',
					intersect: false,
          callbacks: {}
        },
	},
    scales: {
      xAxes: [{
        stacked: true,
				barThickness: 10,
                maxBarThickness: 10,
				borderRadius: 5,
				gridLines: {
				  display: false,
				  zeroLineWidth:0.5
				}
      }],
      yAxes: [{
        stacked: true,
        ticks: {
          beginAtZero: true,
        },
                type: 'linear',
				gridLines: {
                display: true,
				lineWidth: 0.3,
				zeroLineWidth:0.3
        }
      }],
			x: {
        stacked: true,
      },
      y: {
        stacked: true
      }
			
    },
		responsive: true,
		maintainAspectRatio: false,
		legend: { position: 'bottom',labels: {
      } },
	}
});
</script>
<script>
  var ctx = document.getElementById("myChart5").getContext('2d');
  var myChart = new Chart(ctx, {
	type: 'doughnut',
	data: {
		labels: ['Blog', 'News', 'Events'],
		datasets: [{
			data: [<?php echo $total_active_blogs;?>,<?php echo $total_active_news;?>, <?php echo $total_active_events;?>],
		 backgroundColor: [
      '#FF3BFF',
      '#08C0F3',
      '#563BFF'
    ],
    hoverOffset: 4,
}]},
options: {
	plugins: {
        tooltip: {
				displayColors: true,
				backgroundColor: 'red',
					mode: 'index',
					intersect: false,
          callbacks: {
          }
        },
	},
	  cutoutPercentage: 80,
		responsive: true,
		maintainAspectRatio: false,
		legend: { position: 'bottom', 			  labels: {
         // usePointStyle: true,
      } },
	}
});
  

 
  </script>
 
   
<?= $this->endSection() ?>