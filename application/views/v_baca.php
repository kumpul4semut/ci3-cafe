 <!-- Start seomun_breadcrumb section -->
      <?php foreach ($berita_id as $id) { ?>
        <section class="seomun_breadcrumb" style="background-image: url(assets/images/breadcrumb_bg.jpg);">
            <div class="seomun_overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="breadcrumb_title" >
                            <span style="color:white" class="seomun_span">SMPN 27 TANGERANG</span>
                            <h2><?=$id->judul_berita?></h2>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="breadcrumb_link">
                            <ul>
                               
                                <li><a style="color:white" href="<?= base_url()?>">SMPN 27 TANGERANG</a></li>
                                
                                <li><a style="color:white" class="active" href="<?=base_url()?>tentang">Baca Berita</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
             <div class="box">
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
        </section><!-- End seomun_breadcrumb section -->


        
 <!-- Start seomun_single_blog section -->
        <section class="seomun_single_blog single_blog section_padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="single_blog_content">
                            <div class="single_content_box">
                                <div class="post_meta">
                                    <ul>
                                        <li><span><i class="far fa-comments"></i>by <a href="#"><?=$id->nama_admin?></a></span></li>
                                        <?php foreach ($total_komentar as $total) { ?>
                                        <li><span><i class="far fa-user"></i><a href="#"><?= $total->total?> Komentar</a></span></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                                <h2><?=$id->judul_berita?></h2>
                                <center><img src="<?php echo base_url().'uploads/berita/'.$id->gambar_berita; ?>" style="width: 50%;height: 50%" alt="gambar tidak ada"></center>
                                <br><br>
                                <h5 style="text-align: justify;"><?=$id->isi_berita?></h5>
                            </div>
                            <div class="content_share_area">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="tags_area">
                                            <h4>Kategori</h4>
                                            <ul class="tags_list">
                                                <li><a ><?=$id->kategori_berita?></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="tags_area text-right">
                                            <h4>Social Share</h4>
                                            <div class="a2a_kit a2a_kit_size_32 a2a_default_style" style="margin-left: 180px;">
                                            <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
                                            <a class="a2a_button_facebook"></a>
                                            <a class="a2a_button_twitter"></a>
                                            <a class="a2a_button_email"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="blog_admin">
                                <div class="row">
                                    <div class="col-lg-12 justify-content-center">
                                        <div class="about_admin_area text-center">
                                            <div class="admin_images">
                                                <img src="<?php echo base_url().'uploads/admin/'.$id->foto; ?>" class="images-fluid" alt="">
                                            </div>
                                            <div class="admin_bio">
                                                <h4><?=$id->nama_admin?></h4>
                                                
                                                <p><?=$id->jabatan?> </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="comment_area">
                                <div class="comment_title">
                                    <h4>Komentar</h4>
                                </div>
                                <?php foreach ($komentar as $k) { ?>
                                <div class="comment_list_area">
                                    <div class="single_comment">
                                        <div class="comment_text">
                                            <h5><?=$k->nama?></h5>
                                            <h6><?=$k->date?></h6>
                                            <p><?=$k->komentar?></p>
                                        </div>
                                    </div>
                                <?php } ?>
                                </div>
                            </div>
                            <div class="post_comment">
                                <div class="post_title">
                                    <h4>Kirim Komentar</h4>
                                </div>
                                <form class="post_form" action="<?=base_url()?>berita/simpan_komentar/<?=$id->id_berita?>" method="POST">

                                    <input type="hidden" name="id_berita" value="<?=$id->id_berita?>">

                                    <div class="form_list">
                                        <textarea class="form_control" name="komentar" id="message" placeholder="Tuliskan komentar anda disini...."></textarea>
                                        <i class="fal fa-pencil-alt"></i>
                                    </div>
                                    <div class="form_list">
                                        <input type="text" class="form_control" placeholder="Nama Lengkap" id="name" name="nama">
                                        <i class="fal fa-user"></i>
                                    </div>
                                    <div class="form_list">
                                        <input type="email" class="form_control" placeholder="Email" id="email" name="email">
                                        <i class="fal fa-envelope"></i>
                                    </div>
                                    <div class="form_list">
                                        <input type="text" class="form_control" placeholder="No Telepon / HP" id="website" name="nohp">
                                        <i class="fal fa-phone"></i>
                                    </div>
                                    <div class="post_button">
                                        <button class="seomun_btn" type="submit" value="submit">Kirim</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                   
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- End seomun_single_blog section -->
        <?php } ?>


        <!-- AddToAny BEGIN -->

<script>
var a2a_config = a2a_config || {};
a2a_config.onclick = 1;
a2a_config.locale = "id";
</script>
<script async src="https://static.addtoany.com/menu/page.js"></script>
<!-- AddToAny END -->