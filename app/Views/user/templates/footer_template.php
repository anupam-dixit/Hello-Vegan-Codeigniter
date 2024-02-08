 <footer>
  <div class="container">
 <p>© Copyright <a href="#"> K2K IT Support and Solutions </a>2023. <?=lang('app.global.all_rights_reserved')?> </p>
  
  </div>
  
  </footer>
 
<?php echo  $this->include('user/templates/chat_template'); ?>
<script>
$('body').click(function(evt){
       if(evt.target.id == "livese")
      //showResult();    
	  return;
       //For descendants of menu_content being clicked, remove this check if you do not want to put constraint on descendants.
     /*   if($(evt.target).closest('#menu_content').length)
          return;  */            
        try{
            document.getElementById("livesearch").innerHTML="";
        } catch (e) {
            console.log(e)
        }
      //Do processing of click event here for every element except with id menu_content

});
</script>

 