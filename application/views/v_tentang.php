<!-- Start seomun_breadcrumb section -->
        <?php foreach ($tentang as $t) { ?>
        <section class="seomun_breadcrumb" style="background-image: url(assets/images/breadcrumb_bg.jpg);">
            <div class="seomun_overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="breadcrumb_title" >
                            <span style="color:white" class="seomun_span"><?= $t->slogan_tentang?></span>
                            <h2><?= $t->judul_tentang?></h2>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="breadcrumb_link">
                            <ul>
                               
                                <li><a style="color:white" href="<?= base_url()?>"><?= $t->slogan_tentang?></a></li>
                                
                                <li><a style="color:white" class="active" href="<?=base_url()?>tentang"><?= $t->judul_tentang?></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- End seomun_breadcrumb section -->
        <!-- Start seomun_about_1 section -->
        <section class="seomun_about_1 about_1 about_2 section_padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div  class="about_text_1 seomun_content_box">
                            <span class="seomun_span">tentang</span>
                            <h4><?= $t->isi_tentang?></h4>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="about_text_1 seomun_content_box">
                            <span class="seomun_span">tujuan</span>
                            <h4><?= $t->tujuan?></h4>
                        </div>
                    </div>
                    <br><br><br>
                     <div class="col-lg-6">
                        <div class="about_text_1 seomun_content_box">
                            <span class="seomun_span">visi</span>
                            <h4><?= $t->visi?></h4>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="about_text_1 seomun_content_box">
                            <span class="seomun_span">misi</span>
                            <h4><?= $t->misi?></h4>
                        </div>
                    </div>
                     
                    <div style="padding: 50px" class="col-lg-12">
                        <div class="about_img_box">
                            <img src="<?=base_url()?>public/assets/images/about_1.png" style="width: 100%;height: 100%" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- End seomun_about_1 section -->
        <?php } ?>

         <section class="seomun_features_2 features_2 gray_bg section_padding">
            <div class="container">
                <div class="row justify-content-center">
                    
                    
                </div>
            </div>
        </section><!-- End seomun_features_2 section -->