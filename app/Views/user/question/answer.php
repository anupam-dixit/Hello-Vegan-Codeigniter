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
              <h2>Answer </h2>
              <button><a href="<?php echo base_url();?>/user/ask_question">Ask Question</a></button>
            </div>
            <div class="questions_all">
              <div class="questions_one">
                <h2> Sharing link on WhatsApp from mobile website (not application) for Android </h2>
                <div class="row">
                  <div class="col-md-12">
                    <div class="quest_all">
                      <ul>
                        <li> Asked 8 years, 7 months ago</li>
                        <li> Modified 10 months ago</li>
                        <li>Viewed 660k times </li>
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
                <p>
                <p>I have developed a website which is mainly used in mobile phones. 
                  I want to allow users to share information directly from the web page into WhatsApp.</p>
                <p>Using UserAgent detection I can distinguish between Android and iOS. 
                  I was able to discover that in order to implement the above in iOS I can use the URL:</p>
                <div class="demo_test"> href="whatsapp://send?text=http://www.example.com" </div>
                <p>I'm still looking for the solution to be used when the OS is Android (as the above doesn't work). 
                  I guess it is somehow related to using "intent" in Android, but I couldn't figure out how to do it as parameter for href.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="news_page">
          <div class="questions_page">
            <div class="button_questions">
              <h2>Answer </h2>
            </div>
            <div class="questions_all">
              <div class="questions_one">
                <p>Just saw it on a website and seems to work on latest Android with latest chrome and whatsapp now too! Give the link a new shot!.</p>
                <div class="demo_test"> <a href="whatsapp://send?text=The text to share!" data-action="share/whatsapp/share">Share via Whatsapp</a> </div>
                <p>Rechecked it today (17th April 2015):
                  Works for me on iOS 8 (iPhone 6, latest versions) Android 5 (Nexus 5, latest versions).
                  
                  It also works on Windows Phone.</p>
                  
              
                <div class="questions_form anws_apge">
                    <form>
                       
                      <div class="form-group">
                    <label>Body <span>Include all the information someone would need to answer your question</span></label>
                      
                        <div class=" ">
                            <div id="app">
                        <ckeditor :editor="editor" v-model="editorData" :config="editorConfig"></ckeditor>
                    </div>
                        </div>
                        
                     </div>
                      
                     
                     <button> Review your question</button>
                      
                    </form>
                </div>
           
                  
                <div class="windows_commnet">
                  <div class="bg-light text-dark">
                    <div class="appcomment ">
                       
                          <h4>7 Comments</h4>
                          
                          <!-- Comment #1 //-->
                          <div class="">
                            <div class="pycomments">
                              <div class="d-flex comment"> <img class="rounded-circle comment-img"
                          src="<?php echo base_url();?>/images/name.png" />
                                <div class="flex-grow-1 ms-3">
                                  <div class="mb-1"><a href="#" class="fw-bold link-dark me-1">Studio KonKon</a> <span class="text-muted text-nowrap">2 days ago</span></div>
                                  <div class="mb-2">Lorem ipsum dolor sit amet, ut qui commodo sensibus, id utinam inermis constituto vim. In nam dolorum interesset, per fierent ponderum ea. Eos aperiri feugiat democritum ne.</div>
                                  <div class="hstack align-items-center mb-2"> <a class="link-primary me-2" href="#"><i class="zmdi zmdi-thumb-up"></i></a> <span class="me-3 small">55</span> <a class="link-secondary me-4" href="#"><i class="zmdi zmdi-thumb-down"></i></a> <a class="link-secondary small" href="#">REPLY</a> <a class="link-danger small ms-3" href="#">DELETE</a> </div>
                                  <a class="fw-bold d-flex align-items-center" href="#"> <i class="zmdi zmdi-chevron-down fs-4 me-3"></i> <span>Hide Replies</span> </a> </div>
                              </div>
                              <div class="comment-replies mt-4 bg-dark p-3 rounded"
                       style="--bs-bg-opacity:.025;">
                                <div class="d-flex py-2 onecomment"> <img class="rounded-circle comment-img"
                             src="<?php echo base_url();?>/images/name.png" />
                                  <div class="flex-grow-1 ms-3">
                                    <div class="mb-1"><a href="#" class="fw-bold link-dark pe-1">Shinobu KonKon</a> <span class="text-muted text-nowrap">1 day ago</span></div>
                                    <div class="mb-2">Disputando voluptatibus ei sit. Et veri deserunt theophrastus pri, at mutat choro eum.</div>
                                    <div class="hstack align-items-center"> <a class="link-secondary me-2" href="#"><i class="zmdi zmdi-thumb-up"></i></a> <span class="me-3 small">1</span> <a class="link-secondary me-4" href="#"><i class="zmdi zmdi-thumb-down"></i></a> <a class="link-secondary small" href="#">REPLY</a> </div>
                                  </div>
                                </div>
                                <div class="d-flex py-2 onecomment"> <img class="rounded-circle comment-img"
                             src="<?php echo base_url();?>/images/name.png" />
                                  <div class="flex-grow-1 ms-3">
                                    <div class="mb-1"><a href="#" class="fw-bold link-dark pe-1">Oomiya Yuki</a> <span class="text-muted text-nowrap">1 minute ago</span></div>
                                    <div class="mb-2">Munere consetetur an usu, vis quot maiestatis concludaturque at. Ne etiam indoctum referrentur eum, vix legimus nominati eu. Epicurei quaestio sea ut, munere deserunt adipiscing qui te.</div>
                                    <div class="hstack align-items-center"> <a class="link-secondary me-2" href="#"><i class="zmdi zmdi-thumb-up"></i></a> <span class="me-3 small"></span> <a class="link-primary me-4" href="#"><i class="zmdi zmdi-thumb-down"></i></a> <a class="link-secondary small" href="#">REPLY</a> </div>
                                  </div>
                                </div>
                                <div class="d-flex py-2 onecomment"> <img class="rounded-circle comment-img"
                             src="<?php echo base_url();?>/images/name.png" />
                                  <div class="flex-grow-1 ms-3">
                                    <div class="mb-1"><a href="#" class="fw-bold link-light bg-primary py-1 px-2 rounded-pill me-1">Kamisato Mugi</a> <span class="text-muted text-nowrap">just now</span></div>
                                    <div class="mb-2"><a href="#">@Shinobu_KonKon</a> Vivamus ac varius augue. Curabitur luctus convallis lorem, vitae convallis dui volutpat nec.</div>
                                    <div class="hstack align-items-center"> <a class="link-secondary me-2" href="#"><i class="zmdi zmdi-thumb-up"></i></a> <span class="me-3 small">2</span> <a class="link-secondary me-4" href="#"><i class="zmdi zmdi-thumb-down"></i></a> <a class="link-secondary small" href="#">REPLY</a> </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            
                            <!-- Comment #2 //-->
                            <div class="pycomments">
                              <div class="d-flex comment"> <img class="rounded-circle comment-img"
                          src="<?php echo base_url();?>/images/name.png" />
                                <div class="flex-grow-1 ms-3">
                                  <div class="mb-1"><a href="#" class="fw-bold link-dark pe-1">Asai Kazuma</a> <span class="text-muted text-nowrap">8 hours ago</span></div>
                                  <div class="mb-2">Ei saepe abhorreant temporibus cum, hinc praesent voluptatum ea has.<br />
                                    <br />
                                    Vis nihil tacimates senserit ut, quo posse labores honestatis te. Ex duo nullam posidonium deterruisset, altera aeterno duo.</div>
                                  <div class="hstack align-items-center"> <a class="link-secondary me-2" href="#"><i class="zmdi zmdi-thumb-up"></i></a> <span class="me-3 small">26</span> <a class="link-secondary me-4" href="#"><i class="zmdi zmdi-thumb-down"></i></a> <a class="link-secondary small" href="#">REPLY</a> </div>
                                </div>
                              </div>
                            </div>
                            
                            <!-- Comment #3 //-->
                            <div class="pycomments">
                              <div class="d-flex comment"> <img class="rounded-circle comment-img"
                          src="<?php echo base_url();?>/images/name.png" />
                                <div class="flex-grow-1 ms-3">
                                  <div class="mb-1"><a href="#" class="fw-bold link-light bg-primary py-1 px-2 rounded-pill me-1">Kamisato Mugi</a> <span class="text-muted text-nowrap">10 hours ago</span></div>
                                  <div class="mb-2">Aenean non tellus sed erat ultrices rutrum. Sed ac dolor tempus, efficitur diam vitae, sagittis nisi. Morbi bibendum congue nisl eu congue. Mauris eu eros bibendum, pretium ex ac, aliquam lorem.</div>
                                  <div class="hstack align-items-center mb-2"> <a class="link-primary me-2" href="#"><i class="zmdi zmdi-thumb-up"></i></a> <span class="me-3 small">8</span> <a class="link-secondary me-4" href="#"><i class="zmdi zmdi-thumb-down"></i></a> <a class="link-secondary small" href="#">REPLY</a> </div>
                                  <a class="fw-bold d-flex align-items-center" href="#"> <i class="zmdi zmdi-chevron-down fs-4 me-3"></i> <span>Hide Replies</span> </a> </div>
                              </div>
                              <div class="comment-replies mt-4 bg-dark p-3 rounded"
                       style="--bs-bg-opacity:.025;">
                                <div class="d-flex py-2 onecomment"> <img class="rounded-circle comment-img"
                             src="<?php echo base_url();?>/images/name.png" />
                                  <div class="flex-grow-1 ms-3">
                                    <div class="mb-1">
                                      <div><a href="#" class="fw-bold link-dark">Studio KonKon</a></div>
                                      <div class="text-muted small">Replying to @Kamisato_Mugi</div>
                                    </div>
                                   </div>
                                </div>
                                <div class="d-flex py-2 onecomment"> <img class="rounded-circle comment-img"
                             src="<?php echo base_url();?>/images/name.png" />
                                  <div class="flex-grow-1 ms-3">
                                    <div class="mb-1"><a href="#" class="fw-bold link-dark pe-1">Oomiya Yuki</a> <span class="text-muted text-nowrap">5 mintues ago</span></div>
                                    <div class="mb-2">Integer et lorem lacus. Aenean bibendum ex sem, at pretium metus mollis sit amet. Morbi quis egestas ante. Praesent diam odio, fermentum non sapien vitae, fringilla placerat diam.</div>
                                    <div class="hstack align-items-center"> <a class="link-secondary me-2" href="#"><i class="zmdi zmdi-thumb-up"></i></a> <span class="me-3 small"></span> <a class="link-secondary me-4" href="#"><i class="zmdi zmdi-thumb-down"></i></a> <a class="link-secondary small" href="#">REPLY</a> </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                       
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </ul>
    </main>
  <?php echo  $this->endSection(); ?>


