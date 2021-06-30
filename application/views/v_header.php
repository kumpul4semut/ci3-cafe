<!DOCTYPE html>
<html lang="zxx">
	<head>
        <!-- All Meta -->
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php foreach ($pengaturan as $p) { ?>
        <!-- faviocn -->
        <link rel="shortcut icon" href="<?= base_url()?>uploads/pengaturan/<?= $p->icon ?>">
        <!-- page title -->
        
        <title><?= $p->nama_website ?></title>
        <?php } ?>
        <!--All Css here -->
        <!--Bootstrap  css-->
        <link rel="stylesheet" href="<?= base_url()?>public/assets/css/bootstrap/css/bootstrap.min.css">
        <!-- Fontaweome css -->
        <link rel="stylesheet" href="<?= base_url()?>public/assets/fonts/fontawesome/css/all.css">
        <!--slick slider css -->
        <link rel="stylesheet" href="<?= base_url()?>public/assets/css/slick/slick.css">
        <link rel="stylesheet" href="<?= base_url()?>public/assets/css/slick/slick-theme.css">
        <!--nice-number css-->
        <link rel="stylesheet" href="<?= base_url()?>public/assets/css/jquery.nice-number.css">
        <!--animate css-->
        <link rel="stylesheet" href="<?= base_url()?>public/assets/css/animate.css">
        <!--meanmenu css-->
        <link rel="stylesheet" href="<?= base_url()?>public/assets/css/meanmenu.css">
        <!--magnific-popup css-->
        <link rel="stylesheet" href="<?= base_url()?>public/assets/css/magnific-popup.css">
        <!--sidebar-menu css-->
        <link rel="stylesheet" href="<?= base_url()?>public/assets/css/sidebar-menu.css">
        <!--Style css-->
        <link rel="stylesheet" href="<?= base_url()?>public/assets/css/style.css">
        <!--Responsive css-->
        <link rel="stylesheet" href="<?= base_url()?>public/assets/css/responsive.css">
        <style type="text/css">
        .ml11 {
        font-weight: 700;
        font-size: 3.5em;
        }

        .ml11 .text-wrapper {
        position: relative;
        display: inline-block;
        padding-top: 0.1em;
        padding-right: 0.05em;
        padding-bottom: 0.15em;
        }

        .ml11 .line {
        opacity: 0;
        position: absolute;
        left: 0;
        height: 100%;
        width: 3px;
        background-color: #fff;
        transform-origin: 0 50%;
        }

        .ml11 .line1 { 
        top: 0; 
        left: 0;
        }

        .ml11 .letter {
        display: inline-block;
        line-height: 1em;
        }
        </style>
    </head>
	<body>
        <!-- Start Preloader Area -->
        <div class="preloader_area">
            <div class="lodar">
                <ul>
                    <li>S</li>
                    <li>M</li>
                    <li>P</li>
                    <li>N</li>
                    <li>2</li>
                    <li>7</li>
                </ul>
            </div>
        </div><!-- End Preloader Area -->
        <!-- Satrt seomun_header  -->
        <header class="seomun_header seomun_header_2">
            <div class="header_container_2">
                <div class="row align-items-center">
                    <div class="col-lg-2">
                        <div class="seomun_logo brand_icon">
                            <?php foreach ($pengaturan as $p) { ?>
                            <a href="<?= base_url()?>uploads/pengaturan/<?= $p->logo ?>" target="_blank"><img src="<?= base_url()?>uploads/pengaturan/<?= $p->logo ?>" class="img-fluid" alt=""></a>
                             <?php }?>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="seomun_menu">
                            <nav class="main_menu">
                                <ul>

                                <?php foreach ($menu as $data)  {  ?>

                                <li><a href="<?php echo $data->link ?>"><?php echo $data->nama_menu ?></a></li>
                               
                               
                                <?php } ?>



                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-sm-12"><div class="mobile_menu"></div></div>
                </div>
            </div>
        </header><!-- End seomun_header  -->