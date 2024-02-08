$(document).ready(function(){
	var open=Array();
	$(".chat_group_name").click(function(){
	    var user_name = $.trim($(this).text());
		var id = $.trim($(this).attr("id"));
		if($.inArray(id,open) !== -1 )
			return
		
		open.push(id);
		
	    var prevar="<div class='chat_group_item' id='chat_group_item_"+id+"'>";
	    prevar+="<div class='chat_group_item_header' id='"+id+"'>";
		prevar+=user_name;
		prevar+="<span class='chat_group_item_close'>X</span>";
		prevar+="</div>";
		prevar+="<div class='chat_group_item_body'></div>";
		prevar+="<div class='chat_group_item_footer'>";
		prevar+="<input type='text' placeholder='Write A Message' id='chat_group_textbox_"+id+"'>";
		replaceid=id.replace('group_','');
		prevar+="<input type='image' src='image/send-message.png' onclick='return chat_group_send_message("+replaceid+")'>";
		prevar+="</div>";
		prevar+="</div>";
		
		$("#chat_group_list").prepend(prevar);
		$.ajax({
			url:'chat_ajax.php',
			type:'POST',
			data:'chat_group_get_all_msg=true&chat_group_user='+replaceid ,
			success:function(data){
				$("#chat_group_list").find(".chat_group_item:first .chat_group_item_body").append(data);
			}
		});
	});
	
	$("#chat_group_list").delegate(".chat_group_item_close","click",function(){
		removeItem = $(this).parents(".chat_group_item_header").attr("id");
		$(this).parents(".chat_group_item").remove();

		open = $.grep(open, function(value) {
		  return value != removeItem;
		});	
	});
		
	$("#chat_group_list").delegate(".chat_group_item_header","click",function(){
		var box=$(this).parents(".chat_group_item");
		$(box).find(".chat_group_item_body,.chat_group_item_footer").slideToggle();
	});
	
	$("#chat_group_item_search").keyup(function(){
		var val =  $.trim($(this).val());
		$(".chat_group_list_body").find("span").each(function(){
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
			url:'chat_ajax.php',
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

function chat_group_send_message(id){
		group_id=id;
		msg=$("#chat_group_textbox_group_"+id).val();
		nameofuser=$("#login_user_name").val();
		
	    if(msg==''){
			alert('Please Type a message');
		}else{
				$.ajax({
				url:'chat_ajax.php',
				type:'POST',
				data:'chat_group_send=true&group_id='+group_id+'&msg='+msg,
				success:function(data){	
                    var htmldata="<div class='outgoing-chats'>";
					htmldata+="<div class='outgoing-chats-msg'>";
					htmldata+="<p><b>"+nameofuser+"</b><br>"+msg+"<br>"+data+"</p>";
					htmldata+="</div>";
					htmldata+="</div>";
			        $("#chat_group_item_group_"+id).find(".chat_group_item_body").append(htmldata);
					
					  $('html, body').animate({
						 scrollTop: $(".chat_group_item").offset().top
					 }, 1000);
					$("#chat_group_textbox_group_"+id).val('');
					$("#chat_group_textbox_group_"+id).focus();
				}
		});		
		}

}

function message_cycle(){
	
		
		var group_array=$("#chat_group_ids").val().split(',');
		var getIds='';
		$.each(group_array, function(index,value) { 
			   		getIds+=value+',';			
		});
		if(getIds!=''){
			getIds=getIds.replace(/,\s*$/, "");
			$.ajax({
			  url:'chat_ajax.php',
              type:'POST',
              data:'chat_group_get_update_message=true&ids='+getIds,
              dataType:'JSON',
              success:function(data){
				  console.log(data);
				$.each(data,function(index,obj){
				 $.each(obj, function(key,value) {
					 console.log('#chat_group_item_group_'+index);
					 if($('#chat_group_item_group_'+index+':visible').length==1){
						 if($("#chat_group_item_group_"+index).find(".chat_group_item_body").css('display')=='none'){
							$('#group_'+index).trigger('click'); 
						 }
						htmldata="<div class='received-chats'>";
						htmldata+="<div class='received-msg'>";
						htmldata+="<div class='received-msg-inbox'>";
						htmldata+="<p>"+value+"</p>";
						htmldata+="</div>";
						htmldata+="</div>";
						htmldata+="</div>";
                         $("#chat_group_item_group_"+index).find(".chat_group_item_body").append(htmldata); 
					 }
					 if($('#chat_group_item_group_'+index+':visible').length==0){
						
						 $('#group_'+index).trigger('click'); 	
						
						
					 }
					 
				   				  
				 });	
				});  
			  }			  
			}); 
		}
			
} 
setInterval(message_cycle,3000);