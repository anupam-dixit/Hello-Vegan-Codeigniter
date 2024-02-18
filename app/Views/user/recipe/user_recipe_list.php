<?php echo  $this->extend('user/templates/recipes_all_template');

 ?>
<?php
$public_url=base_url()."/public/frontend/";
$public_url_bower=base_url()."/public/";
$baseurl=base_url()."/";
?>
<?php echo  $this->section('content'); ?>

	<main class="main-feed">
      <ul class="main-feed-list">
       <div class="notfy">
         <?php echo  $this->include('user/templates/notf_header_template'); ?>
        </div>
        <div class="news_page"><div class="subhadding_news"><h2></h2></div>
            <div class="row">
                <div class="col">
                    <div class="hadding_main">Recipes</div>
                </div>
                <div class="col">
                    <a onclick="$('#adddReceipeModal').modal('show')" class="add_recipe_button float-end">Add Recipe</a>
                </div>
            </div>


         <!-- <div class="subhadding_news">Lorem Ipsum is simply dummy text </div>-->

          <div class="recipes_bx_page">
             <div class="row">
                <?php
           foreach($receipeall as $val){

        ?>

             <div class="col-md-6">

               <article class="post-summary primary"><a class="post-summary__image" href="<?php echo base_url();?>/user/user-recipe-details/<?php echo $val['id'];?>"> <img src="<?php echo $baseurl.$val['image'];?>" class="attachment-thumbnail size-thumbnail entered lazyloaded" /> </a>

            <!--  <article class="post-summary primary"><a class="post-summary__image" onclick="getSinglerecipesall('<?php echo $val['id'];?>')"> <img src="<?php echo $baseurl.$val['image'];?>" class="attachment-thumbnail size-thumbnail entered lazyloaded" /> </a> -->



  <div class="post-summary__content">
    <p class="post-summary__recipe-meta"> <span class="wprm-recipe-difficulty wprm-block-text-bold">Cooking Time</span> • <span class="wprm-recipe-time wprm-block-text-bold"> <span class="wprm-recipe-details wprm-recipe-details-minutes wprm-recipe-total_time wprm-recipe-total_time-minutes"><?php echo $val['cooking_time'];?></span> <span class="wprm-recipe-details-unit wprm-recipe-details-minutes wprm-recipe-total_time-unit wprm-recipe-total_timeunit-minutes">mins</span> </span></p>

    <p class="entry-category entry_username">
   <a href="<?php echo base_url();?>/user/public_profile/<?php echo $val['user_id'];?>">  <img src="<?php echo $baseurl.$val['users_profile_image'];?>"></a>

      By - <a href="<?php echo base_url();?>/user/public_profile/<?php echo $val['user_id'];?> "> <?php echo $val['user_name'];?></a></p>

       <p class="entry-category">
     <img src="<?php echo $baseurl.$val['image'];?>">

      <?php
	  if($val['category_name']==''){
		  echo 'Veagn Recipe';
	  }else{
		echo $val['category_name'];
	  }
	  ?></p>


    <h2 class="post-summary__title"><a href="#"><?php echo $val['title'];?></a></h2>
  </div>

</article>

             </div>
              <?php } ?>

             </div>
          </div>
        </div>
      </ul>
    </main>
    <span id="showmodel" style="display:none"></span>
<div class="modal fade" id="adddReceipeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
  <form onsubmit="return checkLimit()" action="<?php echo base_url('/user/user-recipe-insert');?>" method="post" enctype="multipart/form-data" id="ReceipeeForm" name="ReceipeeForm">
    <div class="modal-content model_add_event">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Recipe</h5>
      </div>
      <div class="modal-body">
       <div class="row" style="margin-right: 0;margin-left: 0;">


              <!--col-sm-6-->

              <div class="col-md-12 col-sm-6 col--12 right-side">

              <?php if(session()->getFlashdata('msgblog')):?>
                    <div class="alert alert-success">
                       <p><?= session()->getFlashdata('msgblog') ?></p>
                    </div>
      <?php endif;?>


                <!--Form with header-->
                <div class="form">


				  <div class="form-group">
				   <label>Title</label>
                    <input type="hidden" id="video" name="video" class="form_control_event" placeholder="Video" >
                    <input type="text" id="title" name="title" class="form_control_event" placeholder="Title" >
                  </div>



                <div class="form-group">
            <label>Category</label>

                  <select name="post_category_id" class="form_control_event form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                  <option >Select Category</option>
          <?php
          foreach($receipe_category as $val){
            ?>
          <option
          value="<?php echo $val['id'];?>"><?php echo $val['name'];?></option>
                  <?php
                  }
                  ?>

                </select>
                </div>

                <div class="form-group">
                 <label>Tags</label>

                    <input type="text" id="tags" name="tags" class="form_control_event" placeholder="Tags" >
                  </div>






                  <div class="form-group">
                    <label>Location</label>
					<input type="text" id="location" name="location" class="form_control_event" placeholder="Location" >
                  </div>

				  <div class="form-group">
				  <label>Image</label>
                    <input type="file" id="image" name="image" class="form_control_event" placeholder="Image" >
          </div>
           <div class="form-group">
          <label>Add Gallery Image</label>
                    <input type="file" multiple onchange="return valueonchange(this.id)"  id="galleryimage" name="galleryimage[]" class="form_control_event" placeholder="Gallery Image" >
          </div>

           <div class="form-group">
          <label>Video</label>
                    <input type="file"   class="form_control_event" name="videofile" id="videofile">
          </div>

           <div class="form-group">
          <label>Detail</label>
                    <textarea  id="detail"  name="detail" class="form_control_event" placeholder="detail"></textarea>
                  </div>


				  <div class="form-group">
				  <label>Steps</label>
                    <textarea  id="steps"  name="steps" class="form_control_event" placeholder="Steps"></textarea>
                  </div>




                 <div class="form-group">
				  <label>Ingredients</label>
                    <textarea  id="ingredients"  name="ingredients" class="form_control_event" placeholder="Ingredients"></textarea>
                  </div>
            <div class="form-group">
				  <label>Cooking Time</label>
                    <input type="text"  id="cooking_time"  name="cooking_time" class="form_control_event" placeholder="cooking_time">
                  </div>




                  <div class="text-xs-center">
				 <a  class="btn loginbutton "> <input style="background:none;border:none;color:#fff" type="submit" name="submit" id="submit" value="Submit"><span>
				    <img style="display:inline" src="<?php echo base_url().'/public/frontend/';?>images/back_arrow.svg" alt="img">
				  </span></a>
				  </div>


                </div>
                <!--/Form with header-->

              </div>
              <!--col-sm-6-->


            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="sumbit_event close_event" onclick="$('#adddReceipeModal').modal('hide')">Close</button> &nbsp;  &nbsp;
        <button type="submit" class="sumbit_event">Save changes</button>
      </div>
    </div>
		  </form>
  </div>
</div>
<div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog modal-sm">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" onclick="location.reload()" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="document_name">Message</h4>
        </div>
        <div class="modal-body">
                 <div id="ErrorMessage" style="text-align:center;margin-bottom:13px;">

                </div>
         </div>
        <div class="modal-footer">
          <button type="button" onclick="location.reload()" class="sumbit_event close_event" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>
  <div id="loader"></div>
  <style>
div.pac-container {
   z-index: 1050 !important;
}
#loader {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  width: 100%;
  background: rgba(0,0,0,0.75) url(../public/frontend/images/ajax-loader.gif) no-repeat center center;
  z-index: 10000;
}
</style>
<style> #owl-demo .item{
  margin: 3px;
}
 .owl-carousel .owl-nav button.owl-prev{
   color: darkcyan; !important;
   position: absolute;
   top: 30%;
   left: 0;
   font-size: 30px;
   background: no-repeat 50% / 100% 100% !important;
 }
 .owl-carousel .owl-nav button.owl-next{
  color: darkcyan !important;
  font-size: 30px;
  position: absolute;
   top: 30%;
   right: 10px;
   background: no-repeat 50% / 100% 100% !important;

 }


.owl-stage {
  width: 700% !important;
  display: block;
  transform: translate3d(-460px, 0px, 0px);
    transition: all 0s ease 0s;


}
 </style>



  <?php echo  $this->endSection(); ?>