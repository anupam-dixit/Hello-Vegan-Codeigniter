<?php echo  $this->extend('user/templates/question_template');
$public_url=base_url()."/public/frontend/";
$baseurl=base_url()."/";
 ?><?php echo  $this->section('content'); ?>

<main class="main-feed">
  <ul class="main-feed-list">
    <div class="notfy"> <?php echo  $this->include('user/templates/notf_header_template'); ?> </div>
    <div class="news_page">
      <div class="questions_page">
        <div class="button_questions">
          <h2>All Questions</h2>
          <button>
          <a href="<?php echo base_url();?>/user/ask_question">Ask Question</a>
          </button>
        </div>
        <div class="questions_all">
		<?php 
		if(count($questions)!=0){
			foreach($questions as $val){
		?>
		<div class="questions_one">
            <h2><a href="<?php echo base_url();?>/user/answer"><?php echo $val['title'];?></a></h2>
            <div class="row">
              <div class="col-md-5">
                <div class="quest_all">
                  <ul>
                    <li> 3 votes </li>
                    <li> 0 answers</li>
                    <li> 2 views </li>
                  </ul>
                </div>
              </div>
              <div class="col-md-7">
                <div class="abdulrahman_all">
                  <ul>
                    <li>Abdulrahman Falyoun  3,326</li>
                    <li> Asked 35 secs ago </li>
                  </ul>
                </div>
              </div>
              <div class="tag_all">
                <ul>
                  <li><a href="#"> python </a></li>
                  <li><a href="#"> python-3 </a></li>
                  <li><a href="#"> .xmongod </a></li>
                  <li><a href="#"> bmongodb-query </a></li>
                </ul>
              </div>
            </div>
            
            <!--<div class="comment_page">
                <p></p>
                
                </div>--> 
          </div>
		<?php 
			}
		}
		?>
          
          </div>
      </div>
    </div>
  </ul>
</main>
<?php echo  $this->endSection(); ?> 