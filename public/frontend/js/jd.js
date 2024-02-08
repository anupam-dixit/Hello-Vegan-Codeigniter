$(document).ready(function(){
	var website_url=window.location.origin+'/';
	var open=Array();
	
	$("#jd-chat  .jd-online_user").click(function(){
		
		var user_name = $.trim($(this).text());
		var id = $.trim($(this).attr("id"));
		
		if($.inArray(id,open) !== -1 )
			return
		
		open.push(id);
	    var prevar="<div class='jd-user' id='jd-user-"+id+"'>";
	    prevar+="<div aria-hidden='true' class='jd-header' id='"+id+"'>";
		prevar+="<a class='tooltip' target='_blank'  data-tooltip='View Profile' data-tooltip-pos='down' data-tooltip-length='fit class='inner' href='"+website_url+"/user/public_profile/"+id+"'>"+user_name+'</a>';
		prevar+="<span class='close-this'>X</span>";
		prevar+="</div>";
		prevar+="<div class='jd-body'></div>";
		prevar+="<div class='jd-footer'><form method='post' onsubmit='return sendmessage(\""+id+"\")'>";
		prevar+="<input type='text' placeholder='Write A Message' id='chatbox_"+id+"'>";
		prevar+="<input type='image' src='"+website_url+"public/frontend/images/send-message.png' onclick='return sendmessage(\""+id+"\")'></form>";
		prevar+="</div>";
		prevar+="</div>";
		$("#jd-chat-div").prepend(prevar);
		$.ajax({
			url:website_url+'user/chatClassPhp',
			type:'POST',
			data:'get_all_msg=true&user=' + id ,
			success:function(data){
				$("#jd-chat-div").find(".jd-user:first .jd-body").append(data);
				$("#jd-user-"+id).find(".jd-body").stop().animate({ scrollTop: $("#jd-user-"+id).find(".jd-body")[0].scrollHeight}, 1000);
			}
		});
	});
	/* $(".jd-online_user_right").click(function(){
		document.getElementById('jd-chat').style.display='block'; 
		var user_name = $.trim($(this).text());
		var id = $.trim($(this).attr("id"));
		if($.inArray(id,open) !== -1 )
			return
		
		open.push(id);
	    var prevar="<div class='jd-user' id='jd-user-"+id+"'>";
	    prevar+="<div class='jd-header' id='"+id+"'>";
		prevar+=user_name;
		prevar+="<span class='close-this'>X</span>";
		prevar+="</div>";
		prevar+="<div class='jd-body'></div>";
		prevar+="<div class='jd-footer'><form method='post' onsubmit='return sendmessage(\""+id+"\")'>";
		prevar+="<input type='text' placeholder='Write A Message' id='chatbox_"+id+"'>";
		prevar+="<input type='image' src='"+website_url+"public/frontend/images/send-message.png' onclick='return sendmessage(\""+id+"\")'></form>";
		prevar+="</div>";
		prevar+="</div>";
		$("#jd-chat-div").prepend(prevar);
		$.ajax({
			url:website_url+'user/chatClassPhp',
			type:'POST',
			data:'get_all_msg=true&user='+id ,
			success:function(data){
				$("#jd-chat-div").find(".jd-user:first .jd-body").append(data);
			}
		});
	}); */
	$("#jd-chat").delegate(".close-this","click",function(){
		removeItem = $(this).parents(".jd-header").attr("id");
		$(this).parents(".jd-user").remove();
		
		open = $.grep(open, function(value) {
		  return value != removeItem;
		});	
	});
		
	$("#jd-chat").delegate(".jd-header","click",function(){
		var box=$(this).parents(".jd-user,.jd-online");
		$( ".inner" ).click(function(ev) {
              ev.stopPropagation(); 
        });  
		$(box).find(".jd-body,.jd-footer").slideToggle();
		$("#group-jd-chat1").css('display','none');
	});
	    // jQuery 1.7+ 
   
       $("#showchat").click(function(){
		   $("#jd-chat,.jd-body,.jd-footer").slideToggle(200);
		   // if(document.getElementById('jd-chat').style.display=='block'){
			//   document.getElementById('jd-chat').style.display='none';
		   // }else{
			//   document.getElementById('jd-chat').style.display='block';
			//
		   // }
		   /* var box=$('.jd-header').parents(".jd-user,.jd-online");
		      $(box).find(".jd-body,.jd-footer").slideToggle(); */
		
	});
	 $("#showchat1").click(function(){
		 $("#jd-chat,.jd-body,.jd-footer").slideToggle(200);
		   // if(document.getElementById('jd-chat').style.display=='block'){
			//   document.getElementById('jd-chat').style.display='none';
		   // }else{
			//   document.getElementById('jd-chat').style.display='block';
			//
		   // }
		   /* var box=$('.jd-header').parents(".jd-user,.jd-online");
		      $(box).find(".jd-body,.jd-footer").slideToggle(); */
		
	});
	$(".showchats").click(function(){
		if(document.getElementById('jd-chat').style.display=='block'){
			  document.getElementById('jd-chat').style.display=='none'; 
		   }else{
			  document.getElementById('jd-chat').style.display=='block'; 
			 
		   }
		   
		   /* var box=$('.jd-header').parents(".jd-user,.jd-online");
		$(box).find(".jd-body,.jd-footer").slideToggle(); */
		
	});
	$("#search_chat").keyup(function(){
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
function message_cycle()
	{	
		
		var website_url='/';
		var friends_array=$("#loginuser_friends_ids").val().split(',');
		var getIds='';
		$.each(friends_array, function(index,value) { 
			   		getIds+=value+',';			
		});
		if(getIds!=''){
			getIds=getIds.replace(/,\s*$/, "");
			
			$.ajax({
			  url:website_url+'user/chatClassPhp',
              type:'POST',
              data:'get_update_message=true&ids='+getIds,
              dataType:'JSON',
              success:function(data){
				$.each(data,function(index,obj){
				 $.each(obj, function(key,value) {
					 console.log($('#jd-user-'+index+':visible').length);
					 if($('#jd-user-'+index+':visible').length==1){
						 
						 if($("#jd-user-"+index).find(".jd-body").css('display')=='none'){
							
							$('#'+index).trigger('click'); 
						 }
						htmldata="<div class='received-chats'>";
						htmldata+="<div class='received-msg'>";
						htmldata+="<div class='received-msg-inbox'>";
						htmldata+=value;
						htmldata+="</div>";
						htmldata+="</div>";
						htmldata+="</div>";
						$("#jd-user-"+index).find(".jd-body").append(htmldata);
						
						 $("#jd-user-"+index).find(".jd-body").stop().animate({ scrollTop:$("#jd-user-"+index).find(".jd-body")[0].scrollHeight}, 1000);
                     }
					 if($('#jd-user-'+index+':visible').length==0){
						 
						 $('#'+index).trigger('click'); 	
						 document.getElementById('jd-chat').style.display='block';
						
					 }
					 
				   			  
				 });
 				 
				}); 
				
              group_message_cycle();    					
			  }			  
			});
		}
		
}
function notification_cycle()
	{
var website_url=window.location.origin+'/';
	$.ajax({
			  url:website_url+'user/notificationCount',
              type:'POST',
              dataType:'JSON',
              success:function(data){
				  //console.log(data.totalcount);
				  $("#notification_count").html(data.totalcount); 					
			  }			  
			});
}
function removeNotification()
	{
	var website_url='/';
	$.ajax({
			  url:website_url+'user/notificationShow',
              type:'POST',
              dataType:'JSON',
              success:function(data){

				   var htmldata='<h2>Notification <a href="'+website_url+'user/notifications">See All </a></h2>';
				  var flag=1;
				  $.each(data, function(index, item) {
                 flag=2;
				   htmldata+='<li>';
				  htmldata+='<div class="notifications_list">';
				  htmldata+='<div class="icon_notifications">';
				  htmldata+='<img src="'+item.profile_image+'">';
				  htmldata+='<div class="icon_noti">';
				  htmldata+='<img src="'+item.notification_pageicon+'">';
				  htmldata+='</div>';
				  htmldata+='</div>';
				  htmldata+='<div class="text_notifications">';
				  htmldata+='<p>';
				  htmldata+='<b>'+item.name+'</b>';
				  htmldata+='  '+item.message+'';
				  htmldata+='</p>';
				  htmldata+='<span>'+item.timeview+'</span>';
				  htmldata+='</div>';
				  htmldata+='</div>';
				  htmldata+='</li>';
				  
                  });
				 
				  if(flag==1){
					htmldata='<h2>Notification <a href="'+website_url+'user/notifications">See All </a></h2><li><div class="notifications_list"><p>You have no  new notifications</p></div></li>';  
				  }
                  $(".notification_popup").html(htmldata);
                  $("#notification_count").html(0); 					
			  }			  
			});
} 

	//message_cycle();
	setInterval(message_cycle,3000);
	setInterval(notification_cycle,4000);
function sendmessage(id){
		
		var website_url='/';
		to=id;
		msg=$("#chatbox_"+id).val();
		
		nameofuser=$("#username").val();
	    if(msg==''){
			alert('Please Type a message');
		}else{
				$.ajax({
				url:website_url+'user/chatClassPhp',
				type:'POST',
				data:'send=true&to=' + to + '&msg=' + msg,
				success:function(data){	
                    var htmldata="<div class='outgoing-chats'>";
					htmldata+="<div class='outgoing-chats-msg'>";
					htmldata+="<p class='out-title'>"+nameofuser+"</p><p class='out-time'>"+data+"</p><p class='out-msg'>"+msg+"</p>";
					htmldata+="</div>";
					htmldata+="</div>";
			        $("#jd-user-"+id).find(".jd-body").append(htmldata);
					$("#chatbox_"+id).val('');
					$("#chatbox_"+id).focus();
					$("#jd-user-"+id).find(".jd-body").stop().animate({ scrollTop: $("#jd-user-"+id).find(".jd-body")[0].scrollHeight}, 1000);
					 
				}
		});		
		}
return false;
	} 
