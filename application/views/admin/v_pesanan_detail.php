<div class="col-sm-12 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg></a></li>
            <li class="active">Pesanan kasir</li>
        </ol>
    </div>
    <!--/.row-->

    <br>


    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Detail Pesanan</h3>
                </div>
                <div class="panel-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                <div class="row justify-content-between">
                                    <div class="col">
                                        <h4 style="margin-left: 20px;"><b>#<?php echo $pesanan->kode_pesanan ?></b></h4>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Pelanggan
                                    </div>
                                    <div class="panel-body">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Nama</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">Nomor Telepon</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><?php echo $pelanggan->nama_pelanggan ?></td>
                                                    <td><?php echo $pelanggan->email ?></td>
                                                    <td><?php echo $pelanggan->no_tlp ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="panel panel-default" style="margin-top: 40x;">
                                    <div class="panel-heading">
                                        Pesanan
                                    </div>
                                    <div class="panel-body">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Nama Meja</th>
                                                    <th scope="col">Tanggal Pemesanan</th>
                                                    <th scope="col">Jam Pesan</th>
                                                    <th scope="col">Jumlah Pesan</th>
                                                    <th scope="col">Jumlah Bayar</th>
                                                    <th scope="col">status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><?php echo $pesanan->nama_meja ?></td>
                                                    <td><?php echo $pesanan->tgl_pemesanan ?></td>
                                                    <td><?php echo $pesanan->jam_pesan ?></td>
                                                    <td><?php echo $pesanan->jumlah_pesan ?></td>
                                                    <td><?php echo rp_format($pesanan->jumlah_bayar) ?></td>
                                                    <td><?php echo $pesanan->status ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="panel panel-default" style="margin-top: 40x;">
                                    <div class="panel-heading">
                                        Menu Dipesan
                                    </div>
                                    <div class="panel-body">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Nama Menu</th>
                                                    <th scope="col">Harga</th>
                                                    <th scope="col">Jumlah</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($menu_select as $data) : ?>
                                                    <tr>
                                                        <td><?php echo $data->nama_menu ?></td>
                                                        <td><?php echo rp_format($data->harga) ?></td>
                                                        <td><?php echo $data->jumlah ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="panel panel-default" style="margin-top: 40x;">
                                    <div class="panel-heading">
                                        Transaksi
                                    </div>
                                    <div class="panel-body">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Kode Transaksi</th>
                                                    <th scope="col">Jumlah Pesan</th>
                                                    <th scope="col">Jumlah Harga</th>
                                                    <th scope="col">Jumlah bayar</th>
                                                    <th scope="col">Bukti Bayar</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <tr>
                                                    <td><?php echo $transaksi->kode_transaksi ?></td>
                                                    <td><?php echo $transaksi->jumlah_pesan ?></td>
                                                    <td><?php echo rp_format($transaksi->jumlah_harga) ?></td>
                                                    <td><?php echo rp_format($transaksi->jumlah_bayar) ?></td>
                                                    <?php if (isset($transaksi->bukti_bayar)) : ?>
                                                        <td>
                                                            <a href="<?php echo base_url('uploads/' . $transaksi->bukti_bayar) ?>" target="_blank" rel="noopener noreferrer"><img src="<?php echo base_url('uploads/' . $transaksi->bukti_bayar) ?>" class="rounded float-left" widtd="60" height="100"></a>

                                                        </td>
                                                    <?php else : ?>
                                                        <td>Kosong</td>
                                                    <?php endif; ?>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>




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