function valueonchange(ids){
	if(ids=='email'){
		document.getElementById('error_email').style.display='none';
		document.getElementById('error_same_email').style.display='none';
	}
	if(ids=='profile_image'){
		document.getElementById('error_profile_image').style.display='none';
	}
	if(ids=='cover_image'){
		document.getElementById('error_cover_image').style.display='none';
	}
	
	
}	
function validation(){/* 
	var eVar=document.getElementById('email').value;
	var piVar=document.getElementById('profile_image').value;
	var ciVar=document.getElementById('cover_image').value;
	var dVar = CKEDITOR.instances['description'].getData().replace(/<[^>]*>/gi, '').length;

	var flag=0;
	if(eVar==''){
		document.getElementById('error_email').style.display='block';
		document.getElementById("email").focus();
		flag=1;
	}
	if(piVar==''){
		document.getElementById('error_profile_image').style.display='block';
		flag=1;
	}
	if(ciVar==''){
		document.getElementById('error_cover_image').style.display='block';
		flag=1;
	}
	if(dVar==0){
		document.getElementById('error_description').style.display='block';
		flag=1;
	}
	
	if(alreadyTaken==1){
		$("#error_same_email").css('display','block');
		document.getElementById("email").focus();
		flag=1;
	}
	if(flag==1){
		return false;
	} */
	
}
function validationEdit(){
	/* var eVar=document.getElementById('email').value;
	var piVar=document.getElementById('profile_image').value;
	var ciVar=document.getElementById('cover_image').value;
	var dVar = CKEDITOR.instances['description'].getData().replace(/<[^>]*>/gi, '').length;
	
	var flag=0;
	if(eVar==''){
		document.getElementById('error_email').style.display='block';
		document.getElementById("email").focus();
		flag=1;
		
	}
	if(piVar==''){
		
		var profile_val_var=document.getElementById('profile_val').value;
		if(profile_val_var==0){
		document.getElementById('error_profile_image').style.display='block';
		flag=1;	
		}
		
	}
	if(ciVar==''){
		
		var cover_val_var=document.getElementById('cover_val').value;
		if(cover_val_var==0){
		document.getElementById('error_cover_image').style.display='block';
		flag=1;	
		}

	}
	if(dVar==0){
		document.getElementById('error_description').style.display='block';
		flag=1;
	}
	
	if(alreadyTakenEdit==1){
		$("#error_same_email").css('display','block');
		document.getElementById("email").focus();
		flag=1;
	}
	if(flag==1){
		return false;
	} */
	
}
var alreadyTaken=0;
function checkEmail(baseurl){
	alreadyTaken=0;
$.ajax({
    url : baseurl+"admin/checkemailf",
    type: "POST",
    data : { email: $("#email").val()},
    success: function(data)
    {
		if(data!=0){
			alreadyTaken=1;
			$("#error_same_email").css('display','block');
		}
		else{
			$("#error_same_email").css('display','none');
		}
		console.log(data);
    },
    error: function (e)
    {
      console.log(e);
    }
});
}
var alreadyTakenEdit=0;
function checkEmailEdit(baseurl,ids){
	alreadyTakenEdit=0;
$.ajax({
    url : baseurl+"admin/checkemailf_edit",
    type: "POST",
    data : { email: $("#email").val(),id:ids},
    success: function(data)
    {
		if(data!=0){
			alreadyTakenEdit=1;
			$("#error_same_email").css('display','block');
		}else{
			$("#error_same_email").css('display','none');
		}
		console.log(data);
    },
    error: function (e)
    {
      console.log(e);
    }
});
}
function delete_user(baseurl,ids){
$.ajax({
    url : baseurl+"admin/deleteUser/"+ids,
    type: "GET",
    data : { },
    success: function(data)
    {
		alert('User Deleted Successfully');
		location.reload(); 
		console.log(data);
    },
    error: function (e)
    {
      console.log(e);
    }
});	
}