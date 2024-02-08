<?php echo  $this->extend('admin/templates/chat_template'); ?>

<?php echo  $this->section('content'); ?>

<div class="content-wrapper">
 
      <section class="content-header">
      <h1>
        Chat Pannel
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Chats</li>
        <li class="active">Users</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
          
          <div class="green-background"></div>
		<div class="wrap">
				<section class="left">
						<div class="profile">
								<img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/1089577/user.jpg">
								<div class="icons">
										
								</div>
						</div>
						<div class="wrap-search">
								<div class="search">
										<i class="fa fa-search fa" aria-hidden="true"></i>
										<input type="text" class="input-search" placeholder="Search">
								</div>
						</div>
						<div class="contact-list"></div>
				</section>

				<section class="right">
						<div class="chat-head">
								<img>
								<div class="chat-name">
										<h1 class="font-name"></h1>
										<p class="font-online"></p>
								</div>
								
								
								<i class="fa fa-bars fa-lg" aria-hidden="true" id="show-contact-information"></i>
								<i class="fa fa-times fa-lg" aria-hidden="true" id="close-contact-information"></i>
						</div>
						<div class="wrap-chat">
								<div class="chat"></div>
								<div class="information"></div>
						</div>
						<div class="wrap-message">
								<i class="fa fa-smile-o fa-lg" aria-hidden="true"></i>
								<div class="message">
										<input type="text" class="input-message" placeholder="Schreibe eine Nachricht">
								</div>
								<i class="fa fa-microphone fa-lg" aria-hidden="true"></i>
						</div>
				</section>
		</div>
         </div>
      
</section>
    <!-- /.content -->
  </div>

<?php echo  $this->endSection(); ?>
