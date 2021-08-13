<!-- Start seomun_footer area -->
<div class="container-fluid mt-5 bg-dark">
    <div class="mx-5">
        <div class="row mb-4 ">
            <div class="col-md-4 col-sm-11 col-xs-11">
                <div class="footer-text pull-left">
                    <div class="d-flex">
                        <h1 class="font-weight-bold mr-2 px-3" style="color:#16151a; background-color:#957bda"> B </h1>
                        <h1 style="color: #957bda">Bugel Corner</h1>
                    </div>
                    <p class="card-text text-white"><?php echo $profile->alamat ?></p>
                    <div class="social mt-2 mb-3"> <i class="fa fa-facebook-official fa-lg"></i> <i class="fa fa-instagram fa-lg"></i> <i class="fa fa-twitter fa-lg"></i> <i class="fa fa-linkedin-square fa-lg"></i> <i class="fa fa-facebook"></i> </div>
                </div>
            </div>
            <div class="col-md-2 col-sm-1 col-xs-1 mb-2"></div>

        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
<script>
    //Get the button
    var mybutton = document.getElementById("myBtn");

    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function() {
        scrollFunction()
    };

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
    }

    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }

    // Wrap every letter in a span
    var textWrapper = document.querySelector('.ml11 .letters');
    textWrapper.innerHTML = textWrapper.textContent.replace(/([^\x00-\x80]|\w)/g, "<span class='letter'>$&</span>");

    anime.timeline({
            loop: true
        })
        .add({
            targets: '.ml11 .line',
            scaleY: [0, 1],
            opacity: [0.5, 1],
            easing: "easeOutExpo",
            duration: 700
        })
        .add({
            targets: '.ml11 .line',
            translateX: [0, document.querySelector('.ml11 .letters').getBoundingClientRect().width + 10],
            easing: "easeOutExpo",
            duration: 700,
            delay: 100
        }).add({
            targets: '.ml11 .letter',
            opacity: [0, 1],
            easing: "easeOutExpo",
            duration: 600,
            offset: '-=775',
            delay: (el, i) => 34 * (i + 1)
        }).add({
            targets: '.ml11',
            opacity: 0,
            duration: 1000,
            easing: "easeOutExpo",
            delay: 1000
        });
</script>

<!-- jquery  -->
<script src="<?= base_url() ?>public/assets/js/vendor/jquery-1.12.4.min.js"></script>
<!--modernizr js-->
<script src="<?= base_url() ?>public/assets/js/vendor/modernizr-3.6.0.min.js"></script>
<!-- Bootstrap js  -->
<script src="<?= base_url() ?>public/assets/css/bootstrap/js/bootstrap.min.js"></script>
<script src="<?= base_url() ?>public/assets/css/bootstrap/js/popper.min.js"></script>
<!--meanmenu js-->
<script src="<?= base_url() ?>public/assets/js/jquery.meanmenu.js"></script>
<!--slick slider js -->
<script src="<?= base_url() ?>public/assets/css/slick/slick.min.js"></script>
<!-- isotope min.js  -->
<script src="<?= base_url() ?>public/assets/js/isotope.min.js"></script>
<!-- imagesloaded min.js  -->
<script src="<?= base_url() ?>public/assets/js/imagesloaded.min.js"></script>
<!--magnific-popup js-->
<script src="<?= base_url() ?>public/assets/js/jquery.magnific-popup.min.js"></script>
<!--jquery counterup js-->
<script src="<?= base_url() ?>public/assets/js/jquery.counterup.min.js"></script>
<script src="<?= base_url() ?>public/assets/js/jquery.waypoints.min.js"></script>
<!--wow js-->
<script src="<?= base_url() ?>public/assets/js/wow.min.js"></script>
<!--easypiechart js-->
<script src="<?= base_url() ?>public/assets/js/jquery.easypiechart.js"></script>
<!--nice-number js-->
<script src="<?= base_url() ?>public/assets/js/jquery.nice-number.min.js"></script>
<!--sidebar-menu js-->
<script src="<?= base_url() ?>public/assets/js/sidebar-menu.js"></script>
<!-- custom js  -->
<script src="<?= base_url() ?>public/assets/js/custom.js"></script>
<script type="text/javascript">
    function getNewCaptcha() {
        // body...
        $.ajax({
            url: "<?php echo base_url('home/getNewCaptcha'); ?>",
            success: function(response) {
                $('#Captcha-image').html(response);
            }
        });
    }
    getNewCaptcha();

    function onSelectMenu(id_menu = null) {
        var name = `jumlah_${id_menu}`
        if ($("input[name=" + name + "]").prop('required')) {
            // $("input[name=" + name + "]").hide()
            $("input[name=" + name + "]").prop("required", false)
        } else {
            // $("input[name=" + name + "]").show()
            $("input[name=" + name + "]").prop("required", true)
        }

    }
    $(document).ready(function() {
        $('#pilih-meja').on('click', function() {
            $('#input-jumlah').valid();
        });
    })
</script>
</body>

</html>