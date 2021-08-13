<div class="col-sm-12 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg></a></li>
            <li class="active">Pesanan</li>
        </ol>
    </div>
    <!--/.row-->

    <br>


    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>List Pesanan</h3>
                </div>
                <div class="panel-body">
                    <div class="box">
                        <!-- /.box-header -->
                        <div class="box-body">
                            <?php echo validation_errors('<div id="notifikasi" class="alert alert-danger rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong> Error! </strong> ', '</div>'); ?>
                            <?php if ($this->session->flashdata('sukses')) : ?>
                                <div id="notifikasi" class="alert alert-success rounded-md px-5 py-4 mb-2 bg-theme-9 text-white">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Sukses! </strong> <?= $this->session->flashdata('sukses'); ?>
                                </div>
                            <?php endif; ?>
                            <?php if ($this->session->flashdata('error')) : ?>
                                <div id="notifikasi" class="alert alert-danger rounded-md px-5 py-4 mb-2 bg-theme-9 text-white">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Sukses! </strong> <?= $this->session->flashdata('error'); ?>
                                </div>
                            <?php endif; ?>
                            <table data-toggle="table" data-show-refresh="false" data-show-toggle="true" data-show-columns="true" data-search="true" data-pagination="true" data-sort-name="name" data-sort-order="desc">
                                <thead>
                                    <tr>
                                        <th data-field="no" data-sortable="true" width="10px"> No</th>
                                        <th data-field="nama_pelanggan" data-sortable="true">Nama Pelanggan</th>
                                        <th data-field="meja" data-sortable="true">Meja</th>
                                        <th data-field="kode_pesanan" data-sortable="true">Kode Pesanan</th>
                                        <th data-field="kode_transaksi" data-sortable="true">Kode transaksi</th>
                                        <th data-field="tgl_pemesanan" data-sortable="true">Tanggal Pemesanan</th>
                                        <th data-field="jam_pesan" data-sortable="true">Jam Pesan</th>
                                        <th data-field="jumlah_pesan" data-sortable="true">Jumlah Pesan</th>
                                        <th data-field="jumlah_bayar" data-sortable="true">Jumlah Bayar</th>
                                        <th data-field="status" data-sortable="true">Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 0;
                                    foreach ($pesanan as $row) : $no++; ?>
                                        <tr>
                                            <td data-field="no" width="10px"><?php echo $no; ?></td>
                                            <td data-field="nama_pelanggan"><?php echo $row->nama_pelanggan; ?></td>
                                            <td data-field="meja"><?php echo $row->nama_meja; ?></td>
                                            <td data-field="kode_pesanan"><?php echo $row->kode_pesanan; ?></td>
                                            <td data-field="kode_transaksi"><?php echo $row->kode_transaksi; ?></td>
                                            <td data-field="tgl_pemesanan	"><?php echo $row->tgl_pemesanan; ?></td>
                                            <td data-field="jam_pesan"><?php echo $row->jam_pesan; ?></td>
                                            <td data-field="jumlah_pesan"><?php echo $row->jumlah_pesan; ?></td>
                                            <td data-field="jumlah_bayar"><?php echo rp_format($row->jumlah_bayar); ?></td>
                                            <td data-field="status"><?php echo $row->status; ?></td>
                                            <td>
                                                <a data-toggle="modal" data-target="#modal-ubah-status<?= $row->id_pesanan; ?>" class="ubah btn btn-primary btn-xs" style="cursor: pointer;">Ubah Status</a>
                                            </td>

                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>



                <!-- modal bayar -->
                <?php $no = 0;
                foreach ($pesanan as $row) : $no++; ?>
                    <div class="modal fade bs-example-modal-lg" id="modal-ubah-status<?= $row->id_pesanan ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myLargeModalLabel">Ubah Status</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?php echo base_url() ?>admin/list_pesanan/ubah_status" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="id_pesanan" value="<?= $row->id_pesanan ?>">
                                        <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
                                            <div class="radio">
                                                <label><input type="radio" name="status[]" value="dimasak" <?php if ($row->status == 'dimasak') {
                                                                                                                echo "checked";
                                                                                                            } ?>>Dimasak</label>
                                            </div>
                                            <div class="radio">
                                                <label><input type="radio" name="status[]" value="siap antar" <?php if ($row->status == 'siap antar') {
                                                                                                                    echo "checked";
                                                                                                                } ?>>Siap Antar</label>
                                            </div>
                                            <div class="radio">
                                                <label><input type="radio" name="status[]" value="selesai" <?php if ($row->status == 'selesai') {
                                                                                                                echo "checked";
                                                                                                            } ?>>Selesai</label>
                                            </div>
                                            <center><button type="submit" class="btn btn-success">Simpan</button></center>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger text-left" data-dismiss="modal">Tutup</button>

                                </div>

                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
                <?php endforeach; ?>

                <!-- modal edit -->
                <?php $no = 0;
                foreach ($pesanan as $row) : $no++; ?>
                    <div class="modal fade bs-example-modal-lg" id="modal-edit<?= $row->id_pesanan ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myLargeModalLabel">Ubah Pesanan</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?php echo base_url() ?>admin/pesanan/edit" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="id_pesanan" value="<?= $row->id_pesanan ?>">
                                        <input type="hidden" name="id_pelanggan" value="<?= $row->id_pelanggan ?>">
                                        <div class="form-group">
                                            <label for="nama_pelanggan">Nama pelanggan</label>
                                            <input type="text" class="form-control" id="nama_pelanggan" placeholder="Nama pelanggan" name="nama_pelanggan" value="<?= $row->nama_pelanggan ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="<?= $row->email ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Nomor telepon</label>
                                            <input type="number" class="form-control" id="email" placeholder="Nomor telepon" name="no_tlp" value="<?= $row->no_tlp ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Meja</label>
                                            <select class="form-control" name="id_meja">
                                                <option value="<?= $row->id_meja ?>"><?= $row->nama_meja . ' (Terpilih)' ?></option>
                                                <?php foreach ($meja as $data) : ?>
                                                    <option value="<?php echo $data->id_meja ?>"><?php echo $data->nama_meja ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="tanggal">Tanggal</label>
                                            <input type="date" class="form-control" placeholder="Tanggal" name="tgl_pemesanan" value="<?= $row->tgl_pemesanan ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="jam">Jam Booking</label>
                                            <input type="time" class="form-control" id="jam" placeholder="Nomor telepon" name="jam_pesan" value="<?= $row->jam_pesan ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Pilih Menu</label>
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th style="padding: 10px;">Nama menu</th>
                                                        <th style="padding: 10px;">Jumlah Pesanan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($daftar_menu as $data) : ?>
                                                        <tr>
                                                            <td>
                                                                <div class="checkbox">
                                                                    <label>
                                                                        <input type="checkbox" name="menu[]" value="<?php echo $data->id_menu ?>" <?php foreach ($row->detail_pesanan as $d_detail) {
                                                                                                                                                        if ($d_detail->id_menu == $data->id_menu) {
                                                                                                                                                            echo 'checked';
                                                                                                                                                        }
                                                                                                                                                    } ?>> <?php echo ($data->nama_menu . ' | ' . rp_format($data->harga) . ' | Tersedia ' . $data->stok . ' stok') ?>
                                                                    </label>

                                                                </div>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" id="jam" placeholder="Jumlah" name="jumlah_<?php echo $data->id_menu ?>" value="<?php foreach ($row->detail_pesanan as $d_detail) {
                                                                                                                                                                                            if ($d_detail->id_menu == $data->id_menu) {
                                                                                                                                                                                                echo $d_detail->jumlah;
                                                                                                                                                                                            }
                                                                                                                                                                                        } ?>">
                                                            </td>
                                                        </tr>
                                                    <?php endforeach ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <center><button type="submit" class="btn btn-default">Submit</button></center>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger text-left" data-dismiss="modal">Tutup</button>

                                </div>

                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
                <?php endforeach; ?>


                <?php echo $this->session->flashdata("msg"); ?>


                <script>
                    $(function() {
                        $('#hover, #striped, #condensed').click(function() {
                            var classes = 'table';

                            if ($('#hover').prop('checked')) {
                                classes += ' table-hover';
                            }
                            if ($('#condensed').prop('checked')) {
                                classes += ' table-condensed';
                            }
                            $('#table-style').bootstrapTable('destroy')
                                .bootstrapTable({
                                    classes: classes,
                                    striped: $('#striped').prop('checked')
                                });
                        });
                    });

                    function rowStyle(row, index) {
                        var classes = ['active', 'success', 'info', 'warning', 'danger'];

                        if (index % 2 === 0 && index / 2 < classes.length) {
                            return {
                                classes: classes[index / 2]
                            };
                        }
                        return {};
                    }
                </script>