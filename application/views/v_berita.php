<!-- Start seomun_breadcrumb section -->
        
        <section class="seomun_breadcrumb" style="background-image: url(assets/images/breadcrumb_bg.jpg);">
            <div class="seomun_overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="breadcrumb_title" >
                            <span style="color:white" class="seomun_span">SMPN 27 TANGERANG</span>
                            <h2>Berita</h2>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="breadcrumb_link">
                            <ul>
                               
                                <li><a style="color:white" href="<?= base_url()?>">SMPN 27 TANGERANG</a></li>
                                
                                <li><a style="color:white" class="active" href="<?=base_url()?>berita">Berita</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- End seomun_breadcrumb section -->

        <!-- Start seomun_blog_grid section -->
        <section class="seomun_blog_grid blog_grid section_padding">
            <div class="container">
                <div class="row">
                      <?php foreach ($berita as $b) { ?>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="seomun_box blog_box">
                            <div class="seomun_img_box">
                                <img src="<?=base_url()?>uploads/berita/<?=$b->gambar_berita?>" class="img-fluid" alt="">
                            </div>
                            <div class="seomun_info blog_info">
                                <span class="tag"><?=$b->kategori_berita?></span>
                                <h3><a href="<?=base_url()?>berita/baca/<?=$b->id_berita?>"><?=$b->judul_berita?></a></h3>
                            </div>
                            <div class="post_meta">
                                <ul>
                                   
                                    <li><span><i class="far fa-user"></i> by </span><a ><?=$b->nama_admin?></a></li>
                                </ul>        
                            </div>
                        </div>
                    </div>
                   <?php }?>
                </div>
               
            </div>
        </section><!-- End seomun_blog_grid section -->
        