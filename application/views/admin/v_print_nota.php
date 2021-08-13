<html>

<head>
    <title>Print Nota</title>
    <style type="text/css">
        .lead {
            font-family: "Verdana";
            font-weight: bold;
        }

        .value {
            /* margin-right: 150px; */
            font-family: "Verdana";
        }

        .value-big {
            font-family: "Verdana";
            font-weight: bold;
            font-size: large;
        }

        .title {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>

</head>

<body>
    <table border="1px" style="margin:auto">
        <tr>
            <td>
                <div class="title">
                    <h1>Cafe Bugel Corner</h1>
                    <br>
                    <p style="margin: -30px;">Jl. KH. Abdul Wahid</p>
                </div>
                <table cellpadding="4">

                    <tr>
                        <td width="200px">
                            <div class="lead">Kode Pesanan
                        </td>
                        <td>:</td>
                        <td>
                            <div class="value">#<?php echo $pesanan->kode_pesanan ?></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="lead">Tanggal Pemesanan</div>
                        </td>
                        <td>:</td>
                        <td>
                            <div class="value"><?php echo $pesanan->tgl_pemesanan ?></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="lead">Jam Pesan</div>
                        </td>
                        <td>:</td>
                        <td>
                            <div class="value"><?php echo $pesanan->jam_pesan ?></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="lead">Jumlah Harga</div>
                        </td>
                        <td>:</td>
                        <td>
                            <div class="value"><?php echo rp_format($transaksi->jumlah_harga) ?></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="lead">Jumlah Bayar</div>
                        </td>
                        <td>:</td>
                        <td>
                            <div class="value"><?php echo rp_format($transaksi->jumlah_bayar) ?></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="lead">Kembalian</div>
                        </td>
                        <td>:</td>
                        <td>
                            <div class="value"><?php if ($transaksi->jumlah_bayar > 0) {
                                                    echo rp_format($transaksi->jumlah_bayar - $transaksi->jumlah_harga);
                                                } else {
                                                    echo 'Rp 0';
                                                } ?></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="lead">Menu dipilih:</div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table class="value" style="border: 1px solid #000000; margin:auto;">
                                <thead>
                                    <tr>
                                        <th style="border: 1px solid #000000;padding:20px;">Nama Menu</th>
                                        <th style="border: 1px solid #000000; padding:20px;">Harga</th>
                                        <th style="border: 1px solid #000000; padding:20px;">Jumlah</th>
                                    </tr>
                                </thead>
                                <br>
                                <tbody>
                                    <?php foreach ($menu_select as $data) : ?>
                                        <tr>
                                            <td style="border: 1px solid #000000;"><?php echo $data->nama_menu ?></td>
                                            <td style="border: 1px solid #000000;"><?php echo rp_format($data->harga) ?></td>
                                            <td style="border: 1px solid #000000;"><?php echo $data->jumlah ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </table>
                <footer>
                    <span style="font-style:italic;text-align: left;">
                        Printed Date & Time <?= date('d-m-Y H:i:s'); ?>
                    </span>
                    <span style="font-style:italic;text-align: right;margin-left: 180px">
                        Printed by <?= $this->session->userdata('nama'); ?>
                    </span>
                </footer>
            </td>
        </tr>
    </table>

</html>