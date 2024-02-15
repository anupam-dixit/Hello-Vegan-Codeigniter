<?php
echo  $this->extend('user/templates/profile_template'); ?>
<?php echo  $this->section('content'); ?>
<?php
$public_url=base_url()."/public/frontend/";
$baseurl=base_url()."/";
?>
<?php
$id=$users['id'];
$name=$users['name'];
$address=$users['address'];
$description=$users['description'];
$profile_image=$users['profile_image'];
$cover_image=$users['cover_image'];
$email=$users['email'];
$mobile=$users['mobile_no'];
$password=$users['password'];
$location=$users['location'];
?>
    <style>
        .subs{
            transition: 0.3s;
            box-shadow: 10px 10px lightblue !important;
        }
        .subs:hover{
            margin: 20px;
        }
    </style>
    <main>
        <button class="icon-button e-dark-mode-button u-animation-click" id="darkMode" aria-label="Dark Mode"><span class="icon" aria-hidden="true">🌜</span></button>
        <div class="common-structure">
            <?php echo  $this->include('user/templates/comman_header_profile'); ?>
        </div>
    </main>
    <section class="middle_wraper">
    <div class="page-wrapper ">
    <div class="prodile_page_bg">
        <div class="container">
            <div class="bgcolor_profile">
                <?php

                if(file_exists($users['cover_image'])){ ?>

                <div class="cover_images panel"> <img src="<?php echo $baseurl.$users['cover_image'];?>">


                    <?php }else{ ?>

                    <div class="cover_images panel"> <img src="<?php echo $public_url;?>images/profile_banner.jpg">



                        <?php }


                        ?>
                        <div class="profile-header">
                            <div class=" panel-xl">
                                <div class="row">
                                    <div class="col-md-9 col-12 col-sm-12">
                                        <div class="profile-header-main">
                                            <div class="avatar avatar-normal has-aura text-center">

                                                <!--  <a href="<?php echo base_url();?>/user/public_profile/<?php echo $users['id'];?>"> -->

                                                <?php

                                                if(file_exists($users['profile_image'])){ ?>

                                                    <div class="avatar avatar-normal has-aura text-center public_profile_page_login"><img class="avatar img-responsive" alt="admin_profile" src="<?php echo  $baseurl.$users['profile_image'];?>"></div>


                                                <?php }else{ ?>

                                                    <div class="avatar avatar-normal has-aura text-center public_profile_page_login"><img class="avatar img-responsive" alt="admin_profile" src="<?php echo $public_url;?>images/user-icon.png"></div>



                                                <?php }


                                                ?>
                                                <!--  </a> -->

                                            </div>
                                            <div class="profile-contact">
                                                <div class="profile-main-top">
                                                    <h1 class="name"><?php echo $name;?></h1>
                                                </div>
                                                <div class="speciality"><?php echo $address;?> </div>
                                                <div class="speciality"><?php echo $email;?>, <?php echo $mobile;?></div>
                                                <div class="topfred_list">
                                                    <ul>
                                                        <?php
                                                        // print_r($posts);

                                                        if(count($userfriend)!=0){
                                                            foreach($userfriend as $uf){
                                                                ?>
                                                                <li><a href="#"><img src="<?php echo $baseurl.$uf['profile_image'];?>"></a></li>
                                                                <?php
                                                            }}
                                                        ?>

                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="profile-button-actions my-15">
                                            <a class="btn-floating" onclick="createpostpopup_open()">
                                                <div class="after-span ripple"></div>
                                                <span> </span> <?=lang('app.profile._2')?></a>

                                            <a class="btn-floating" href="<?php echo base_url();?>/user/profile-edit">
                                                <div class="after-span ripple"></div>
                                                <span> </span> <?=lang('app.profile._3')?> </a></div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="profile_middel">
        <div class="container">
            <div class="row mt-5">
                <?php
                foreach ($subscriptions as $s) {
                    ?>
                    <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-3">
                        <div class="card subs p-4">
                            <a href="/subscription/purchase/<?=$s->id?>">
                                <div class="row">
                                    <div class="col-4">
                                        <img src="<?=$s->icon?>" class="img-fluid">
                                    </div>
                                    <div class="col">
                                        <h1><?=$s->title?></h1>
                                        <h5>
                                            <?php
                                            $limits=json_decode($s->data)
                                            ?>
                                            <b><?=$limits->blog?> </b>Blog posts.
                                            <br>
                                            <b><?=$limits->recipe?> </b>Recipe.
                                        </h5>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <div class="" style="text-align: left">
                                                <h2 class="text-success"><i class="fa-solid fa-dollar-sign me-5"></i><?=$s->price?></h2>
                                                <h5 class="text-primary"> For <?=$s->validity?> days.</h5>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="" style="text-align: right">
                                                <button class="w3-button w3-purple w3-round-xxlarge">Buy <i class="fa-solid fa-angles-right"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <?php
                }
                ?>

            </div>
        </div>
    </div>


    <script>



    </script>

<?php echo  $this->endSection(); ?>