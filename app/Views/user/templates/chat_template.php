<?php
$getUserId=$session->get('idUserH');
$getUserName=$session->get('nameUserH');
$public_url=base_url()."/public/frontend/";
?>
<!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" >-->
<link rel="stylesheet" href="<?php echo $public_url;?>css/chat.css">




<div class="modal fade add_custom_field_pop" id="add_custom_blog_chat" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content modal-lg">
      <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLongTitle">Create Group</h5>

        <button type="button" onclick="hidepopup()" class="close-video" data-dismiss="modal" aria-label="Close"> </button>
      </div>
      <div class="modal-body">
        <div class="custom_fields_pop">
	<div class="create_group_chat_popup">
   <div class="form-group">
<label>Group Name</label>
<input type="text" name="group_name" id="group_name" placeholder="Group Name">
</div>
<h2>Add Members</h2>
<div class="blog_ppup">
              <?php
$i=1;
foreach($chatusers as $row_u) {
?>
<div class="member_name_all_list">
	<input id="member<?php echo $i;?>" value="<?php echo $row_u['id'];?> " type="checkbox" name="member_name">
	<label for="member<?php echo $i;?>"><?php echo $row_u['name'];?></label>
</div>
<?php
$i++;
}
?>
<div>
<input type="button" class="create_group_button" onclick="return create_group()" name="create" id="create" value="create">

</div>
         </div>
</div>

        </div>
       </div>
     </div>
   </div>
  </div>




<div id="jd-chat" style="display:none">
<div id="jd-chat-div"></div>
	<div class="jd-online">
		<div class="jd-header">Chat</div>

		<div class="jd-body" style="display:none">
		<div class="view-create-group"> <a onclick="op()">
Create Group
</a></span> <a onclick="showgroup()">View Group</a></div>
		<?php
		$name='';

		$friend_ids='';
		foreach($chatusers as $row) {
		if($row['id']!=$getUserId){
		$friend_ids.=$row['id'].",";
		//print_r($row);
		$image="https://hello-vegans.com/public/frontend/images/f_icon_user.jpg";
		if($row['profile_image']!=''){
			$image="https://hello-vegans.com/".$row['profile_image'];
		}
		?>
        <div class="on-ct active"> <span class="jd-online_user"  id="<?php echo $row['id'];?>"><span><img src="<?php echo $image;?>"></span> <?php echo $row['name'];?></span></div>
		<?php
		}else{
			$name=$row['name'];

		}
		}
		if($friend_ids!=''){
			$friend_ids=trim($friend_ids,",");
		}
        ?>



		<input type="hidden" id="loginuser" value="<?php echo $getUserId;?>">
		<input type="hidden" id="loginuser_friends_ids" value="<?php echo $friend_ids;?>">
		<input type="hidden" id="username" value="<?php echo $name;?>">
		</div>
		<div class="jd-footer" style="display:none"><input style="width:100% !important" id="search_chat" placeholder="Serach"></div>
		<div >
		<div class="jd-body-group"  id="group-jd-chat1" style="display:none">
	    <div class="group-back">
	    <i class="fa fa-chevron-left" aria-hidden="true" onclick="hidegroup()"></i>
		</div>
		<?php

		$group_ids='';
		foreach($chatgroups as $row) {
		$group_ids.=$row['group_id'].",";
		?>
       <div class="on-ct active" >  <span class="jd-online_user1 "  id="group_<?php echo $row['group_id'];?>"> <span><img src="https://hello-vegans.com/public/frontend/images/f_icon_user.jpg"></span>
		 <?php echo $row['group_name'];?> </span></div>
		<?php
		}
		if($group_ids!=''){
			$group_ids=trim($group_ids,",");
		}

		?>
		<input type="hidden" id="loginuser" value="<?php echo $getUserId;?>">
		<input type="hidden" id="loginuser_group_ids" value="<?php echo $group_ids;?>">

		<input type="hidden" id="group_username" value="<?php echo $getUserName;?>">
   </div>
		</div>
	</div>

</div>
<?php /*?><div style="margin-left:200px;font-size:20px">
<?php
echo "Your are <b>".$name."</b>";
?>
</div><?php */?>
<script>
function op(){
	$('#add_custom_blog_chat').modal('show');
}
function showgroup(){
	$(".jd-body").css('display','none');
	$(".jd-footer").css('display','none');
	$(".jd-body-group").css('display','block');

}
function hidegroup(){
	$(".jd-body").css('display','block');
	$(".jd-footer").css('display','block');
	$(".jd-body-group").css('display','none');

}
</script>
<style>
.jd-body-group{
	min-height: 200px;
background: #fff;
height: 200px;
overflow-y: scroll;
border-right: 1px solid #c3c3c3;
border-left: 1px solid #c3c3c3;
}
</style>
<link href="<?php echo $public_url;?>css/jd_group.css" rel="stylesheet" />
<link href="<?php echo $public_url;?>css/jd.css" rel="stylesheet" />
<script src="<?php echo $public_url;?>js/jd_group.js" ></script>
<script src="<?php echo $public_url;?>js/jd.js" ></script>
