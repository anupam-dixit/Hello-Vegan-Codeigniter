$(document).ready(function(){
	
	var open=Array();
	
	$("#group-jd-chat .group-jd-online_user").click(function(){
	
		
		var user_name = $.trim($(this).text());
		var id = $.trim($(this).attr("id"));
		if($.inArray(id,open) !== -1 )
			return
		
		open.push(id);
		
	    var prevar="<div class='group-jd-user' id='group-jd-user-"+id+"'>";
	    prevar+="<div class='group-jd-header' id='"+id+"'>";
		prevar+=user_name;
		prevar+="<span class='group-close-this'>X</span>";
		prevar+="</div>";
		prevar+="<div class='group-jd-body'></div>";
		prevar+="<div class='group-jd-footer'>";
		prevar+="<input type='text' placeholder='Write A Message' id='group_chatbox_"+id+"'>";
		replaceid=id.replace('group_','');
		prevar+="<input type='image' src='send-message.png' onclick='return group_sendmessage("+replaceid+")'>";
		prevar+="</div>";
		prevar+="</div>";
		
		$("#group-jd-chat").prepend(prevar);
		$.ajax({
			url:'chat_group.class.php',
			type:'POST',
			data:'get_all_msg=true&user='+replaceid ,
			success:function(data){
				$("#group-jd-chat").find(".group-jd-user:first .group-jd-body").append(data);
			}
		});
	});
	
	$("#group-jd-chat").delegate(".group-close-this","click",function(){
		removeItem = $(this).parents(".group-jd-header").attr("id");
		$(this).parents(".group-jd-user").remove();

		open = $.grep(open, function(value) {
		  return value != removeItem;
		});	
	});
		
	$("#group-jd-chat").delegate(".group-jd-header","click",function(){
		var box=$(this).parents(".group-jd-user,.group-jd-online");
		$(box).find(".group-jd-body,.group-jd-footer").slideToggle();
	});
	
	$("#group_search_chat").keyup(function(){
		var val =  $.trim($(this).val());
		$(".group-jd-online .group-jd-body").find("span").each(function(){
			if ($(this).text().search(new RegExp(val, "i")) < 0 ) 
			{
                $(this).fadeOut(); 
            } 
			else 
			{
                $(this).show();              
            }
		});
	});

});
window.onload = function() { window.location.hash = ''; };
function group_message_cycle()
	{	
		
		var group_array=$("#loginuser_group_ids").val().split(',');
		var getIds='';
		$.each(group_array, function(index,value) { 
			   		getIds+=value+',';			
		});
		if(getIds!=''){
			getIds=getIds.replace(/,\s*$/, "");
			$.ajax({
			  url:'chat_group.class.php',
              type:'POST',
              data:'get_update_message=true&ids='+getIds,
              dataType:'JSON',
              success:function(data){
				$.each(data,function(index,obj){
				 $.each(obj, function(key,value) {
					 
					 if($('#group-jd-user-group_'+index+':visible').length==1){
						 if($("#group-jd-user-group_"+index).find(".group-jd-body").css('display')=='none'){
							$('#group_'+index).trigger('click'); 
						 }
						htmldata="<div class='group-received-chats'>";
						htmldata+="<div class='group-received-msg'>";
						htmldata+="<div class='group-received-msg-inbox'>";
						htmldata+="<p>"+value+"</p>";
						htmldata+="</div>";
						htmldata+="</div>";
						htmldata+="</div>";
                         $("#group-jd-user-group_"+index).find(".group-jd-body").append(htmldata); 
					 }
					 if($('#group-jd-user-group_'+index+':visible').length==0){
						
						 $('#group_'+index).trigger('click'); 	
						
						
					 }
					 
				   				  
				 });	
				});  
			  }			  
			}); 
		}
		
} 
//setInterval(group_message_cycle,3000);
function group_sendmessage(id){
		console.log(id);
		group_id=id;
		msg=$("#group_chatbox_group_"+id).val();
		nameofuser=$("#group_username").val();
		
	    if(msg==''){
			alert('Please Type a message');
		}else{
				$.ajax({
				url:'chat_group.class.php',
				type:'POST',
				data:'send=true&group_id=' + group_id + '&msg=' + msg,
				success:function(data){	
                    var htmldata="<div class='group-outgoing-chats'>";
					htmldata+="<div class='group-outgoing-chats-msg'>";
					htmldata+="<p><b>"+nameofuser+"</b><br>"+msg+"<br>"+data+"</p>";
					htmldata+="</div>";
					htmldata+="</div>";
			        $("#group-jd-user-group_"+id).find(".group-jd-body").append(htmldata);
					
					  $('html, body').animate({
						 scrollTop: $(".group-jd-user").offset().top
					 }, 1000);
					$("#group_chatbox_group_"+id).val('');
					$("#group_chatbox_group_"+id).focus();
				}
		});		
		}

	} 
function create_group(){
	var group_name=$("#group_name").val();
	var group_member='';
	$("input:checkbox[name=member_name]:checked").each(function(){
       group_member+=$(this).val()+",";
    });
	if(group_name==''){
		alert('Please Type a Group Name');
	}else if(group_member==''){
		alert('Please Add  Group Members');
	}
	else{
		group_member=group_member.replace(/,\s*$/, "");
		$.ajax({
			url:'chat_group.class.php',
			type:'POST',
			data:'create_group=true&group_name='+group_name+'&group_member='+group_member,
			success:function(data){	
			if(data=='alreay taken'){
			   alert('Group '+group_name+' already created pls choose other name');
               return false;			
			}else{
				alert('Group '+group_name+' has been created successfully');
				location.reload();
			}
			
			
					}
		});		
	}
}