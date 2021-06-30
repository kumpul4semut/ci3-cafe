<!-- Start seomun_breadcrumb section -->
        
        <section class="seomun_breadcrumb" style="background-image: url(assets/images/breadcrumb_bg.jpg);">
            <div class="seomun_overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="breadcrumb_title" >
                            <span style="color:white" class="seomun_span">SMPN 27 TANGERANG</span>
                            <h2>HUBUNGI</h2>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="breadcrumb_link">
                            <ul>
                               
                                <li><a style="color:white" href="<?= base_url()?>">SMPN 27 TANGERANG</a></li>
                                
                                <li><a style="color:white" class="active" href="<?=base_url()?>hubungi">Hubungi</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- End seomun_breadcrumb section -->

         <!-- /.box-header -->
        <div class="box-body">
        <?php $data=$this->session->flashdata('sukses'); 
        if($data!=""){ ?>
        <div id="notifikasi" class="alert alert-success rounded-md px-5 py-4 mb-2 bg-theme-9 text-black">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Sukses! </strong> <?=$data;?>
        </div>

        <?php } ?>
        <?php 
        $data2=$this->session->flashdata('error');
        if($data2!=""){ ?>

        <div id="notifikasi" class="alert alert-danger rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-red">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong> Error! </strong> <?=$data2;?>
        </div>
        <?php } ?>

        </div>
        </div>
          <!-- Start contact_section section -->
        <?php foreach ($pengaturan as $p) { ?>
        <section class="contact_section seomun_contact_section section_padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="contact_info_box">
                            <div class="info_title">
                                <span><?=$p->tentang?></span>
                                <h2>Hubungi kami</h2>
                            </div>
                            <div class="info_area">
                                <div class="info_single_box">
                                    <div class="info_icon">
                                        <i class="fal fa-map"></i>
                                    </div>
                                    <div class="info_text">
                                        <h5>SMPN 27 Tangerang</h5>
                                        <p><i class="fal fa-phone"></i><a href="tel:<?=$p->telepon?>"><?=$p->telepon?></a>;</p>
                                        <p><i class="fal fa-envelope"></i><a href="mailto:info@yourbusiness.com"><?=$p->email?></a></p>
                                        <p><i class="fal fa-map-marker-alt"></i><?=$p->alamat?></p>
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="contact_form">
                            
                            <div class="form_area">
                                <form action="<?=base_url()?>hubungi/simpan" method="POST">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="seomun_group">
                                                <input type="text" name="nama_kontak" class="form_control seomun_input" placeholder="Nama Lengkap" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="seomun_group">
                                                <input type="email" name="email_kontak" class="form_control seomun_input" placeholder="Email" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="seomun_group">
                                                <textarea class="form_control seomun_textarea" placeholder="Tulis Pesan" name="text_kontak"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="seomun_group">
                                                <button type="submit" class="seomun_btn">kirim</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php } ?>
        <!-- End contact_section section -->
        <!-- Start contact_map section -->
        <section class="contact_map">
            <div class="contact_map_area">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31733.345458563505!2d106.59117746812099!3d-6.175158063873215!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69ff0fcaeb074d%3A0x5cd3cb71f56a99ae!2sSMPN%2027%20KOTA%20TANGERANG!5e0!3m2!1sen!2sid!4v1622441620907!5m2!1sen!2sid"  style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </section><!-- End contact_map section -->