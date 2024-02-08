/*$(document).ready(function(){
	var website_url='/';
	var open=Array();
	
	$("#group-jd-chat1 .group-jd-online_user").click(function(){
	
		
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
		prevar+="<input type='image' src='"+website_url+"public/frontend/images/send-message.png' onclick='return group_sendmessage("+replaceid+")'>";
		prevar+="</div>";
		prevar+="</div>";
		
		$("#group-jd-chat1").prepend(prevar);
		$.ajax({
			url:website_url+'user/chatGroupClassPhp',
			type:'POST',
			data:'get_all_msg=true&user='+replaceid ,
			success:function(data){
				$("#group-jd-chat1").find(".group-jd-user:first .group-jd-body").append(data);
			}
		});
	});
	
	$("#group-jd-chat1").delegate(".group-close-this","click",function(){
		removeItem = $(this).parents(".group-jd-header").attr("id");
		$(this).parents(".group-jd-user").remove();

		open = $.grep(open, function(value) {
		  return value != removeItem;
		});	
	});
		
	$("#group-jd-chat1").delegate(".group-jd-header","click",function(){
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
		var website_url='/';
		
		var group_array=$("#loginuser_group_ids").val().split(',');
		var getIds='';
		$.each(group_array, function(index,value) { 
			   		getIds+=value+',';			
		});
		if(getIds!=''){
			getIds=getIds.replace(/,\s*$/, "");
			$.ajax({
			  url:website_url+'user/chatGroupClassPhp',
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
		var website_url='/';
		//console.log(id);
		group_id=id;
		msg=$("#group_chatbox_group_"+id).val();
		nameofuser=$("#group_username").val();
		
	    if(msg==''){
			alert('Please Type a message');
		}else{
				$.ajax({
				url:website_url+'user/chatGroupClassPhp',
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
	var website_url='/';
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
			url:website_url+'user/chatGroupClassPhp',
			type:'POST',
			data:'create_group=true&group_name='+group_name+'&group_member='+group_member,
			success:function(data){	
			console.log(data);
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
*/
$(document).ready(function(){
	var website_url='/';
	var open=Array();
	$(document).delegate('#group-jd-chat1  .jd-online_user1', 'click', function()
{
 var user_name = $.trim($(this).text());
		var id = $.trim($(this).attr("id"));
		
		if($.inArray(id,open) !== -1 )
			return
		
		open.push(id);
		replaceid=id.replace('group_','');
	    var prevar="<div class='jd-user' id='group-jd-user-"+id+"'>";
	    prevar+="<div class='jd-header' id='"+id+"'>";
		prevar+=user_name;
		prevar+="<span class='g-close-this'>X</span>";
		prevar+="</div>";
		prevar+="<div class='jd-body'></div>";
		prevar+="<div class='jd-footer'><form method='post' onsubmit='return group_sendmessage("+replaceid+")'>";
		prevar+="<input type='text' placeholder='Write A Message' id='group_chatbox_"+id+"'>";
		
		prevar+="<input type='image' src='"+website_url+"public/frontend/images/send-message.png' onclick='return group_sendmessage("+replaceid+")'></form>";
		prevar+="</div>";
		prevar+="</div>";
		
		$("#jd-chat-div").prepend(prevar);
		
		//$("#group-jd-chat1").prepend(prevar);
		$.ajax({
			url:website_url+'user/chatGroupClassPhp',
			type:'POST',
			data:'get_all_msg=true&user='+replaceid ,
			success:function(data){
				
				$("#jd-chat-div").find(".jd-user:first .jd-body").append(data);
				$("#group-jd-user-group_"+replaceid).find(".jd-body").stop().animate({ scrollTop: $("#group-jd-user-group_"+replaceid).find(".jd-body")[0].scrollHeight}, 1000);
				//$("#group-jd-chat1").find(".jd-user:first .jd-body").append(data);
			}
		});
});
	
	
	$("#jd-chat").delegate(".g-close-this","click",function(){
		removeItem = $(this).parents(".jd-header").attr("id");
		$(this).parents(".jd-user").remove();

		open = $.grep(open, function(value) {
		  return value != removeItem;
		});	
	});
		
	/* $("#group-jd-chat1").delegate(".jd-header","click",function(){
		var box=$(this).parents(".jd-user,.jd-online");
		$(box).find(".jd-body,.jd-footer").slideToggle();
	}); */
	
	$("#group_search_chat").keyup(function(){
		var val =  $.trim($(this).val());
		$(".jd-online .jd-body").find("span").each(function(){
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
		var website_url='/';
		
		var group_array=$("#loginuser_group_ids").val().split(',');
		var getIds='';
		$.each(group_array, function(index,value) { 
			   		getIds+=value+',';			
		});
		if(getIds!=''){
			getIds=getIds.replace(/,\s*$/, "");
			$.ajax({
			  url:website_url+'user/chatGroupClassPhp',
              type:'POST',
              data:'get_update_message=true&ids='+getIds,
              dataType:'JSON',
              success:function(data){
				$.each(data,function(index,obj){
				 $.each(obj, function(key,value) {
					 
					 if($('#group-jd-user-group_'+index+':visible').length==1){
						 if($("#group-jd-user-group_"+index).find(".jd-body").css('display')=='none'){
							$('#group_'+index).trigger('click'); 
						 }
						htmldata="<div class='received-chats'>";
						htmldata+="<div class='received-msg'>";
						htmldata+="<div class='received-msg-inbox'>";
						htmldata+="<p>"+value+"</p>";
						htmldata+="</div>";
						htmldata+="</div>";
						htmldata+="</div>";
                         $("#group-jd-user-group_"+index).find(".jd-body").append(htmldata); 
						 $("#group-jd-user-group_"+index).find(".jd-body").stop().animate({ scrollTop: $("#group-jd-user-group_"+index).find(".jd-body")[0].scrollHeight}, 1000);
					 }
					 if($('#group-jd-user-group_'+index+':visible').length==0){
						
						 $('#group_'+index).trigger('click'); 	
						 document.getElementById('jd-chat').style.display='block';
						
					 }
					 
				   				  
				 });	
				});  
			  }			  
			}); 
		}
		
} 
//setInterval(group_message_cycle,3000);
function group_sendmessage(id){
		var website_url='/';
		//console.log(id);
		group_id=id;
		msg=$("#group_chatbox_group_"+id).val();
		nameofuser=$("#group_username").val();
		
	    if(msg==''){
			alert('Please Type a message');
		}else{
				$.ajax({
				url:website_url+'user/chatGroupClassPhp',
				type:'POST',
				data:'send=true&group_id=' + group_id + '&msg=' + msg,
				success:function(data){	
                    var htmldata="<div class='outgoing-chats'>";
					htmldata+="<div class='outgoing-chats-msg'>";
					htmldata+="<p class='out-title'>"+nameofuser+"</p><p class='out-time'>"+data+"</p><p class='out-msg'>"+msg+"</p>";
					htmldata+="</div>";
					htmldata+="</div>";
			        $("#group-jd-user-group_"+id).find(".jd-body").append(htmldata);
					$("#group_chatbox_group_"+id).val('');
					$("#group_chatbox_group_"+id).focus();
					$("#group-jd-user-group_"+id).find(".jd-body").stop().animate({ scrollTop: $("#group-jd-user-group_"+id).find(".jd-body")[0].scrollHeight}, 1000);
				}
		});		
		}
return false;
	} 
function create_group(){
	var website_url='/';
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
			url:website_url+'user/chatGroupClassPhp',
			type:'POST',
			data:'create_group=true&group_name='+group_name+'&group_member='+group_member,
			success:function(data){	
			console.log(data);
			if(data=='alreay taken'){
			   alert('Group '+group_name+' already created pls choose other name');
               return false;			
			}else{
				alert('Group '+group_name+' has been created successfully');
				//location.reload();
				$('#add_custom_blog_chat').modal('hide');
				var htmldata='<div class="on-ct active">  <span class="jd-online_user1 " id="group_'+data+'">';
                htmldata+='<span><img src="/public/frontend/images/f_icon_user.jpg">';
				htmldata+='</span>';
                htmldata+=''+group_name+' </span></div>';
				$("#group-jd-chat1").append(htmldata);
				
			}
			
			
					}
		});		
	}
	return false;
}
