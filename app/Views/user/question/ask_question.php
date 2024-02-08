<?php echo  $this->extend('user/templates/question_template');
$public_url=base_url()."/public/frontend/";
$baseurl=base_url()."/";
 ?>

<?php echo  $this->section('content'); ?> 

 <main class="main-feed">
      <ul class="main-feed-list">
         <div class="notfy">
         <?php echo  $this->include('user/templates/notf_header_template'); ?>
        </div>
        <div class="news_page">
          <div class="questions_page">
            <div class="button_questions">
              <h2>Ask a public question </h2>
             
            </div>
            <div class="questions_all">
                <div class="questions_form">
                    <form>
                    <div class="form-group">
                    <label>Title <span>Be specific and imagine you're asking a question to another person</span></label>
                      <input type="text" placeholder="Title " class="input" />
                        
                     </div>  
                      <div class="form-group">
                    <label>Body <span>Include all the information someone would need to answer your question</span></label>
                      
                        <div class=" ">
                            <div id="app">
                        <ckeditor :editor="editor" v-model="editorData" :config="editorConfig"></ckeditor>
                    </div>
                        </div>
                        
                     </div>
                     <div class="form-group">
                    <label>Tags <span>Add up to 5 tags to describe what your question is about</span></label>
                      
                        <input type="text" value="" data-role="tagsinput" placeholder="Add tags" />
                        
                     </div>
                     
                     <button> Review your question</button>
                      
                    </form>
                </div>
             </div>
          </div>
        </div>
      </ul>
    </main>
  <?php echo  $this->endSection(); ?>


