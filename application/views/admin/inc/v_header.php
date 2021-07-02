<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>BUGEL CORNER</title>

<link href="<?php echo base_url(); ?>public/admin/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>public/admin/css/datepicker3.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>public/admin/css/bootstrap-table.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>public/admin/css/styles.css" rel="stylesheet">

<!--Icons-->
<script src="<?php echo base_url(); ?>public/admin/js/lumino.glyphs.js"></script>


<script src="<?php echo base_url(); ?>public/admin/js/jquery-1.11.1.min.js"></script>
<script src="<?php echo base_url(); ?>public/admin/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>public/admin/js/chart.min.js"></script>
<script src="<?php echo base_url(); ?>public/admin/js/chart-data.js"></script>
<script src="<?php echo base_url(); ?>public/admin/js/easypiechart.js"></script>
<script src="<?php echo base_url(); ?>public/admin/js/easypiechart-data.js"></script>
<script src="<?php echo base_url(); ?>public/admin/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url(); ?>public/admin/js/bootstrap-table.js"></script>



<script>
    ! function($) {
        $(document).on("click", "ul.nav li.parent > a > span.icon", function() {
            $(this).find('em:first').toggleClass("glyphicon-minus");
        });
        $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
    }(window.jQuery);

    $(window).on('resize', function() {
        if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
    })
    $(window).on('resize', function() {
        if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
    })
</script>

<script>
    $('#calendar').datepicker({});

    ! function($) {
        $(document).on("click", "ul.nav li.parent > a > span.icon", function() {
            $(this).find('em:first').toggleClass("glyphicon-minus");
        });
        $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
    }(window.jQuery);

    $(window).on('resize', function() {
        if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
    })
    $(window).on('resize', function() {
        if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
    })
</script>


<nav class="navbar navbar-light navbar-fixed-top" style="background-color: blueviolet;" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo base_url(); ?>admin/beranda"><span>BUGEL</span> CORNER</a>
            <ul class="user-menu">
                <li class="dropdown pull-right">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user">
                            <use xlink:href="#stroked-male-user"></use>
                        </svg> <?php echo $this->session->userdata('nama'); ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo base_url(); ?>profile/view"><svg class="glyph stroked male-user">
                                    <use xlink:href="#stroked-male-user"></use>
                                </svg> Profile</a></li>
                        <li><a href="<?php echo base_url(); ?>admin/beranda/logout"><svg class="glyph stroked cancel">
                                    <use xlink:href="#stroked-cancel"></use>
                                </svg> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>

    </div><!-- /.container-fluid -->
</nav>


<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">

    <ul class="nav menu">

        <!-- LEVEL ADMIN2 : OWNER -->


        <li class="<?php if ($this->uri->uri_string() == 'admin/beranda') {
                        echo 'active';
                    } ?>"><a href="<?php echo base_url(); ?>admin/beranda"><svg class="glyph stroked dashboard-dial">
                    <use xlink:href="#stroked-dashboard-dial"></use>
                </svg> Dashboard</a></li>
        <li class="<?php if ($this->uri->uri_string() == 'admin/profil') {
                        echo 'active';
                    } ?>"><a href="<?php echo base_url(); ?>admin/profil"><svg class="glyph stroked calendar">
                    <use xlink:href="#stroked-male-user"></use>
                </svg>Profil Resto</a></li>
        <li class="<?php if ($this->uri->uri_string() == 'admin/daftar_menu') {
                        echo 'active';
                    } ?>"><a href="<?php echo base_url(); ?>admin/daftar_menu"><svg class="glyph stroked calendar">
                    <use xlink:href="#stroked-male-user"></use>
                </svg>Daftar Menu</a></li>
        <li class="<?php if ($this->uri->uri_string() == 'admin/meja') {
                        echo 'active';
                    } ?>"><a href="<?php echo base_url(); ?>admin/meja"><svg class="glyph stroked open folder">
                    <use xlink:href="#stroked-male-user" />
                </svg>Meja</a></li>
        <li class="<?php if ($this->uri->uri_string() == 'admin/kategori') {
                        echo 'active';
                    } ?>"><a href="<?php echo base_url(); ?>admin/kategori"><svg class="glyph stroked calendar">
                    <use xlink:href="#stroked-pen-tip"></use>
                </svg>Kategori</a></li>
        <li class="<?php if ($this->uri->uri_string() == 'admin/metode') {
                        echo 'active';
                    } ?>"><a href="<?php echo base_url(); ?>admin/metode"><svg class="glyph stroked calendar">
                    <use xlink:href="#stroked-pen-tip"></use>
                </svg>Metode</a></li>
        <li><a href="<?php echo base_url(); ?>admin/pesanan"><svg class="glyph stroked sound on">
                    <use xlink:href="#stroked-sound-on" />
                </svg>Pesanan</a></li>
        <li><a href="<?php echo base_url(); ?>admin/list_pesanan"><svg class="glyph stroked calendar">
                    <use xlink:href="#stroked-male-user"></use>
                </svg>List Pesanan</a></li>
        <li><a href="<?php echo base_url(); ?>admin/laporan"><svg class="glyph stroked sound on">
                    <use xlink:href="#stroked-sound-on" />
                </svg>Laporan</a></li>
        <li role="presentation" class="divider"></li>



    </ul>

</div>
<!--/.sidebar-->