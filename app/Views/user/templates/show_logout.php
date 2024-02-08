<?php /*?><style>
#menuToggle {
	display: block;
	position: absolute;
	top: 50px;
	right: 50px;
	z-index: 1;
	-webkit-user-select: none;
	user-select: none;
}

#menuToggle input {
	display: block;
	width: 40px;
	height: 32px;
	position: absolute;
	top: -7px;
	left: -5px;
	cursor: pointer;
	opacity: 0;
	z-index: 2;
	-webkit-touch-callout: none;
}

#menuToggle span {
	display: block;
	width: 33px;
	height: 4px;
	margin-bottom: 5px;
	position: relative;
	background: #cdcdcd;
	border-radius: 3px;
	z-index: 1;
	transform-origin: 4px 0px;
	transition: transform 0.5s cubic-bezier(0.77, 0.2, 0.05, 1.0),
	background 0.5s cubic-bezier(0.77, 0.2, 0.05, 1.0),
	opacity 0.55s ease;
}

#menuToggle span:first-child {
	transform-origin: 0% 0%;
}

#menuToggle span:nth-last-child(2) {
	transform-origin: 0% 100%;
}

#menuToggle input:checked~span {
	opacity: 1;
	transform: rotate(45deg) translate(-2px, -1px);
	background: #232323;
}

#menuToggle input:checked~span:nth-last-child(3) {
	opacity: 0;
	transform: rotate(0deg) scale(0.2, 0.2);
}

#menuToggle input:checked~span:nth-last-child(2) {
	opacity: 1;
	transform: rotate(-45deg) translate(0, -1px);
}

#menu {
	position: absolute;
	width: 300px;
	margin: -100px 0 0 0;
	padding: 50px;
	padding-top: 125px;
	right: -100px;
	background: #ededed;
	list-style-type: none;
	-webkit-font-smoothing: antialiased;
	transform-origin: 0% 0%;
	transform: translate(100%, 0);

	transition: transform 0.5s cubic-bezier(0.77, 0.2, 0.05, 1.0);
}

#menu li {
	padding: 10px 0;
	font-size: 22px;
}

#menuToggle input:checked~ul {
	transform: scale(1.0, 1.0);
	opacity: 1;
}
a {
	text-decoration: none !important;
	color: #232323;
	transition: color 0.3s ease;
}

a:hover {
	color: #2ecc71;
}
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<ul class="notification_page_drop" >  
      

      
    <li class="item">
     <div class="user_name_commnet" onclick="openNav()"><a class="common-list-button" ><span><img src="<?php echo  base_url().'/'.$users['profile_image'];?>"></span><p><?php echo $name=$_SESSION['nameUserH'] ?> </p> <div class="user_name_commnet_down_icon"><i class="fa fa-angle-down" aria-hidden="true" ></i> </div></a></div>
         
     
    </li>
	
	 <li><nav role='navigation'>
		<div id="menuToggle">
			<input type="checkbox" />
			<span></span>
			<span></span>
			<span></span>
			<ul id="menu">
				<a href="<?php echo base_url();?>/user/profile">
					<li>View Profile</li>
				</a>
				<a href="<?php echo base_url();?>/user/logout">
					<li>Logout</li>
				</a>
				
			</ul>
		</div>
	</nav></li>
	 </ul><?php */?>

	
<?php 

?>
<ul class="notification_page_drop" >
      
      <div class="notification-drop">
      
    <li class="item">
     <div class="user_name_commnet" onclick="openNav()"><a class="common-list-button" >

     	  <?php

                  if(file_exists($users['profile_image'])){ ?>

                 	<span><img src="<?php echo  base_url().'/'.$users['profile_image'];?>"></span>


                  <?php }else{ ?>

	                   <span><img src="<?php echo $public_url;?>images/user-icon.png"></span>

                   

                  <?php }


                    ?>


     

     	<p><?php echo $name=$_SESSION['nameUserH'] ?> </p> <div class="user_name_commnet_down_icon"><i class="fa fa-angle-down" aria-hidden="true" ></i> </div></a></div>

     
    </li>
  </div>
      </ul>
	   <ul id="mySidenav"  class="sidenav">
      <li> <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a></li>
      <li><a href="<?php echo base_url();?>/user/profile"><?=lang('app.global.view_profile')?></a></li>
      <li><a href="<?php echo base_url();?>/user/logout"><?=lang('app.global.logout')?></a></li>

       </ul>

	  <style>


.sidenav {
	height: 100%;
	width: 0;
	position: fixed;
	z-index: 1;
	top: 0;
	right: 0;
	background-color: #70cac8f2;
	overflow-x: hidden;
	transition: 0.5s;
	padding-top: 60px;
	left: auto;
	border-radius: 10px;
}
#mySidenav li {
	width: 100%;
	float: left;
	padding: 0;border-bottom: 1px solid #83d3d2;
}
/*#mySidenav li:last-child {
  border: none;
}*/


#mySidenav {
	padding: 33px 0 9px;
	height: auto;
	margin-top: 70px;
}
.sidenav a {
	padding: 2px 8px 8px 32px;
	text-decoration: none;
	font-size: 18px;
	color: #fff;
	display: block;text-align: left;
	transition: 0.3s;
}

.sidenav a:hover {
  color: #f1f1f1;
}

.sidenav .closebtn {
	position: absolute;
	top: -40px;
	right: -1px;
	font-size: 36px;
	margin-left: 0;
	color: #fff;
}

 
</style>

<script>
function openNav() {
  // document.getElementById("mySidenav").style.width = "267px";
    $("#modal_001").modal('show');
}

function closeNav() {
  // document.getElementById("mySidenav").style.width = "0";
    $("#modal_001").modal('hide');
}
</script>
<?php  ?>
