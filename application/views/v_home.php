
        <!-- Start seomun_header section -->
        <?php foreach ($slide as $s) { ?>
        <section class="seomun_welcome seomun_welcome_2" style="background-image: url(<?= base_url()?>uploads/slide/<?= $s->gambar_slide?>);background-repeat: no-repeat;background-size: cover;">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12" style="background-color:black;opacity: 0.6;filter: alpha(opacity=40); /* For IE8 and earlier */">
                        <div class="header_content_box seomun_content_box header_content_box_2 wow fadeInLeft" data-wow-delay=".3s">
                            <h1 style="color:white"><span><?= $s->judul_text?></span></h1>
                            <h1 class="ml11" style="color: white">
                            <span class="text-wrapper">
                            <span class="line line1"></span>
                            <span class="letters"><?= $s->tulisan_berjalan?></span>
                            </span>
                            </h1>
                            <h5 style="color: white"><?= $s->deskripsi_text?></h5>
                            <a href="<?= $s->link_button1?>" class="seomun_btn_2" style="background-color:blue"><?= $s->nama_button1?></a>
                            <a href="<?= $s->link_button2?>" class="video_btn"><span style="background-color: blue"><i class="fas fa-play" style="color:white"></i></span><?= $s->nama_button2 ?></a>
                        </div>
                    </div>
                    
                </div>
            </div>
        </section><!-- End seomun_header section -->
        <?php } ?>
        <!-- Start seomun_about section -->
        <?php foreach ($sambutan_kepsek as $sk) { ?>
        <section class="seomun_about seomun_about2 section_padding">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="seomun_content_box about_content_box wow fadeInLeft" data-wow-delay=".3s">
                            <h5 style="font-family: 'Poppins', sans-serif;font-weight: bold;color: black"><span><?= $sk->judul_sambutan?></span></h5>
                            <p style="text-align: justify;"><?= $sk->isi_sambutan?></p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="seomun_img_box about_img_box about_img_box_2 wow fadeInRight" data-wow-delay=".5s">
                            <img src="<?= base_url()?>public/assets/images/<?= $sk->gambar_sambutan?>" alt="">
                            <p style="font-family: 'Poppins', sans-serif;font-weight: bold;color: black"><?= $sk->nama_kepsek?></p>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- End seomun_about section -->
        <?php } ?>

        <!-- Satrt seomun_features_2 section -->
       
        <section class="seomun_features_2 features_2 gray_bg section_padding">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="seomun_section_title text-center">
                            <h2 style="color:white">Sambutan Wakil Kepala Sekolah</h2>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">

                    <?php foreach ($sambutan_wakil as $sw) { ?>
                    <div class="col-lg-4 col-md-6 col-sm-8">
                        <div class="seomun_box features_box_2 feature_box_3 wow fadeInUp" data-wow-delay=".3s">
                            <div class="seomun_info" style="">
                                <h4><?= $sw->nama_wakil?></h4>
                                <p><?= $sw->isi_sambutan2?></p>
                            </div>
                        </div>
                    </div>
                     <?php } ?>
                    
                </div>
            </div>
        </section><!-- End seomun_features_2 section -->
       
       
        <!-- Start Seomun_Service section -->

        <section class="seomun_service secomun_service_2 section_padding">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="seomun_section_title text-center">
                            <h2>Data Angka</h2>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                     <?php foreach ($angka as $a) { ?>
                    <div class="col-lg-4 col-md-6 col-sm-8">
                        <div class="seomun_box service_box_2 text-center wow fadeInUp" data-wow-delay=".3s">
                            <div class="seomun_icon">
                                
                               
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="skill_box skill_box_1">
                                        <div class="chart_2" data-percent="<?= $a->nilai?>" data-bar-color="#132fda">
                                            <div class="circle_info">
                                                <h2><span style="color:blue" class="counter"><?= $a->nilai?></span></h2>
                                                <h6></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              


                            </div>
                          
                            <div class="seomun_info">
                                <h3><?= $a->nama_angka?></h3>
                            </div>
                        </div>
                    </div>
                      <?php } ?>
                   


                </div>
            </div>
        </section>
        <!-- End Seomun_Service section -->
        
        
        <!-- Start seomun_works section -->
        
        <section class="seomun_works seomun_works_2 gray_bg section_padding" id="seomun_works">
            <div class="container"> 
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="seomun_section_title text-center">
                            <h2 style="color:white">Galeri Prestasi</h2>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="works_button work_button_2 text-center"> 
                                            
                            <button style="color:white" class="work_btn btn_active" data-filter="*">Semua</button>
                            <?php foreach ($galeri as $g) { ?> 
                            <button style="color:white" class="work_btn" data-filter=".<?=$g->kategori?> "><?=$g->kategori?></button>
                            <?php }?>
                          
                      
                        </div>
                    </div>
                </div>

                <div class="row grid">
                    <?php foreach ($galeri as $g) { ?> 
                    <div class="col-lg-4 col-md-6 col-sm-12 <?=$g->kategori?> All work_item">
                        <div class="seomun_box work_box">
                            <div class="seomun_img">
                                <img src="<?= base_url()?>uploads/galeri/<?=$g->gambar_galeri?>" class="img-fluid" alt="">
                            </div>
                        </div>
                    </div>
                   <?php }?>
                </div>
               
            </div>
        </section>
         
        <!-- End seomun_works section -->
        <!-- Start seomun_blog section -->
        <section class="seomun_blog seomun_blog_2 dark_bg section_padding">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="seomun_section_title dark_section_title text-center">
                            <h2>Berita Informasi</h2>

                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                <?php foreach ($berita as $b) { ?> 
                    <div class="col-lg-4 col-md-6 col-sm-8">
                        <div class="seomun_box blog_box_2 wow fadeInUp" data-wow-delay=".3s">
                            <div class="seomun_img_box">
                                <img src="<?= base_url()?>uploads/berita/<?=$b->gambar_berita?>" class="img-fluid" alt="">
                            </div>
                            <div class="blog_content_box">
                                <div class="post_meta">
                                    <ul>
                                        <li><span><i class="far fa-comments"></i></span> <a href="#">33 Comments</a></li>
                                    </ul>        
                                </div>
                                <div class="seomun_info blog_info">
                                    <h3><a href="<?=base_url()?>berita/baca/<?=$b->id_berita?>"><?=$b->judul_berita?></a></h3>
                                    <p><?= substr($b->isi_berita, 0,100).'.......'?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }?>
                  
                </div>
            </div>
        </section><!-- End seomun_blog section -->



        