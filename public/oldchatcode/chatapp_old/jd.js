$(document).ready(function(){
	
	var open=Array();
	
	$("#jd-chat .jd-online_user").click(function(){
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
		prevar+="<div class='jd-footer'>";
		prevar+="<input placeholder='Write A Message' id='chatbox_"+id+"'>";
		prevar+="<input type='button' value='send' onclick='return sendmessage("+id+")'>";
		prevar+="</div>";
		prevar+="</div>";
		$("#jd-chat").prepend(prevar);
		$.ajax({
			url:'chat.class.php',
			type:'POST',
			data:'get_all_msg=true&user=' + id ,
			success:function(data){
				$("#jd-chat").find(".jd-user:first .jd-body").append(data);
			}
		});
	});
	
	$("#jd-chat").delegate(".close-this","click",function(){
		removeItem = $(this).parents(".jd-header").attr("id");
		$(this).parents(".jd-user").remove();
		
		open = $.grep(open, function(value) {
		  return value != removeItem;
		});	
	});
		
	$("#jd-chat").delegate(".jd-header","click",function(){
		var box=$(this).parents(".jd-user,.jd-online");
		$(box).find(".jd-body,.jd-footer").slideToggle();
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
		
		var friends_array=$("#loginuser_friends_ids").val().split(',');
		var getIds='';
		
		$.each(friends_array, function(index,value) { 
			//if($('#jd-user-'+value+':visible').length==1){
			//	if($("#jd-user-"+value).find(".jd-body").css('display')=='block'){
               		getIds+=value+',';			
			//	}
			//}
		});
		if(getIds!=''){
			getIds=getIds.replace(/,\s*$/, "");
			
			$.ajax({
			  url:'chat.class.php',
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
						htmldata="<span class='other'>"+value+"</span>";
                         $("#jd-user-"+index).find(".jd-body").append(htmldata); 
					 }
					 if($('#jd-user-'+index+':visible').length==0){
						
						 $('#'+index).trigger('click'); 	
						
						
					 }
					 
				   				  
				 });	
				});  
			  }			  
			});
		}
		
} 
/* function message_cycle()
	{	
		var loginuserVar=$("#loginuser").val();
		$.ajax({
			url:'chat.class.php',
			type:'POST',
			data:'get_update_message=true',
			dataType:'JSON',
			success:function(data){					
				$.each(data , function( index, obj ) {
				 var cl='other';
				 if(index==loginuserVar){
					cl='me';
				 }
				 if($('#jd-user-'+index+':visible').length==1){
					if($("#jd-user-"+index).find(".jd-body").css('display')=='block'){
						$.each(obj, function( key, value ) {
						htmldata="<span class='"+cl+"'> " + value + "</span>";
						$("#jd-user-"+index).find(".jd-body").append(htmldata);
					});	
						}
				 }
					
					
				});				
			}
		});
		

	} */
	
	setInterval(message_cycle,3000);
function sendmessage(id){
		
		to=id;
		msg=$("#chatbox_"+id).val();
	    if(msg==''){
			alert('Please Type a message');
		}else{
				$.ajax({
				url:'chat.class.php',
				type:'POST',
				data:'send=true&to=' + to + '&msg=' + msg,
				success:function(data){					
					$("#jd-user-"+id).find(".jd-body").append("<span class='me'> " + msg + "</span>");
					$("#chatbox_"+id).val('');
					$("#chatbox_"+id).focus();
				}
		});		
		}

	} 
