<div class="col-sm-12 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg></a></li>
            <li class="active">Laporan</li>
        </ol>
    </div>
    <!--/.row-->

    <br>


    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Laporan</h3>
                </div>
                <div class="panel-body">
                    <div class="box">
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <?php $data = $this->session->flashdata('sukses');
                                if ($data != "") { ?>
                                    <div id="notifikasi" class="col-md-12 alert alert-success text-black">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <strong>Sukses! </strong> <?= $data; ?>
                                    </div>

                                <?php } ?>
                                <?php
                                $data2 = $this->session->flashdata('error');
                                if ($data2 != "") { ?>

                                    <div id="notifikasi" class="col-md-12 alert alert-danger text-black">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <strong> Error! </strong> <?= $data2; ?>
                                    </div>
                                <?php } ?>
                                <div class="col-md-6 col-lg-3">
                                    <form action="<?= base_url('admin/laporan/print_laporan') ?> " method="post">
                                        <div class="form-group">
                                            <select name="bln" class="form-control">
                                                <option value="01">Januari</option>
                                                <option value="02">Februari</option>
                                                <option value="03">Maret</option>
                                                <option value="04">April</option>
                                                <option value="05">Mei</option>
                                                <option value="06">Juni</option>
                                                <option value="07">Juli</option>
                                                <option value="08">Agustus</option>
                                                <option value="09">September</option>
                                                <option value="10">Oktober</option>
                                                <option value="12">November</option>
                                                <option value="12">Desember</option>
                                            </select>
                                        </div>
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <select name="tahun" id="tahun" class="form-control">
                                        <?php
                                        $tg_awal = date('Y') - 5;
                                        $tgl_akhir = date('Y') + 5;
                                        for ($i = $tgl_akhir; $i >= $tg_awal; $i--) {
                                            echo "
                                            <option value='$i'";
                                            if (date('Y') == $i) {
                                                echo "selected";
                                            }
                                            echo ">$i</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <button type="submit" class="btn btn-secondary">Export</button>
                                </div>
                                </form>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>