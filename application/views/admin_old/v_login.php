<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Administrator</title>


    <link href="<?php echo base_url(); ?>public/admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>public/admin/css/datepicker3.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>public/admin/css/styles.css" rel="stylesheet">

    <!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

    <style>
        body {
            background-color: darkslateblue;
        }
    </style>
</head>

<body>

    <div class="col-xs-20 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-3">
        <img src="<?php echo base_url(); ?>asset/img/0001-removebg-preview.png" width="150%" height="150">
        &nbsp;

    </div>

    <div class="row">
        <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">Log in</div>
                <?php if (isset($_GET['pesan'])){

                if ($_GET['pesan'] == "gagal" ){
                echo "<div class='alert alert-danger alert-danger'>";
                echo $this->session->flashdata('alert');
                echo "</div>";
                }else if ($_GET['pesan'] == "logout") {
                if ($this->session->flashdata())
                {
                echo "<div class='alert alert-danger alert-success'>";
                echo $this->session->flashdata('Anda Telah Keluar');
                echo "</div>";

                }

                echo "<div class='alert alert-success'>Anda Telah Keluar</div>";


                }else if ($_GET['pesan'] == "belumlogin") {
                if ($this->session->flashdata())
                {
                echo "<div class='alert alert-success alert-primary'>";
                echo $this->session->flashdata('alert');
                echo "</div>";

                }
                echo "<div class='alert alert-success alert-primary'>Silahkan login dahulu </div>";

                }
                }else {
                if ($this->session->flashdata())
                {

                echo "<div class='alert alert-danger alert-message'>";
                echo $this->session->flashdata('alert');
                echo "</div>";


                }
                }

                ?>
                <div class="panel-body">
                    <form action="<?php echo base_url(); ?>admin/auth/login" method="post">

                        <div class="form-group">
                            <input class="form-control" placeholder="Username" name="username" type="text" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Password" name="password" type="password" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Login</button>

                    </form>
                </div>
            </div>

            <?php echo $this->session->flashdata("msg"); ?>
        </div><!-- /.col-->
    </div><!-- /.row -->



    <script src="<?php echo base_url(); ?>public/admin/js/jquery-1.11.1.min.js"></script>
    <script src="<?php echo base_url(); ?>public/admin/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>public/admin/js/chart.min.js"></script>
    <script src="<?php echo base_url(); ?>public/admin/js/chart-data.js"></script>
    <script src="<?php echo base_url(); ?>public/admin/js/easypiechart.js"></script>
    <script src="<?php echo base_url(); ?>public/admin/js/easypiechart-data.js"></script>
    <script src="<?php echo base_url(); ?>public/admin/js/bootstrap-datepicker.js"></script>
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
</body>

</html>