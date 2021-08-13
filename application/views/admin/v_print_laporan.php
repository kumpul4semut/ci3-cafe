<!DOCTYPE html>
<html>

<head>
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }

        .container {
            position: relative;
            margin-bottom: 30px;
        }

        .logo {
            position: absolute;
            width: 90px;
            height: 90px;
            margin-top: -100px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 style="text-align: center;">Laporan Pesanan</h1>
        <h3 style="text-align: center;">Periode <?php echo $bulan ?></h3>
    </div>

    <table id="customers">
        <tr>
            <th>Kode Pesanan</th>
            <th>Nama Pelanggan</th>
            <th>Meja</th>
            <th>Tanggal Pemesanan</th>
            <th>Jam Pesan</th>
            <th>Jumlah Pesan</th>
            <th>Jumlah Bayar</th>
            <th>Menu</th>
            <th>Status</th>
        </tr>
        <?php print_r($pesanan) ?>
        <?php foreach ($pesanan as $data) : ?>
            <tr>
                <td><?php echo $data->kode_pesanan ?></td>
                <td><?php echo $data->nama_pelanggan ?></td>
                <td><?php echo $data->nama_meja ?></td>
                <td><?php echo $data->tgl_pemesanan ?></td>
                <td><?php echo $data->jam_pesan ?></td>
                <td><?php echo $data->jumlah_pesan ?></td>
                <td><?php echo rp_format($data->jumlah_bayar) ?></td>
                <td><?php foreach ($data->menu_select as $d_menu) {
                        echo $d_menu->nama_menu . ' ( ' . 'jumlah:' . $d_menu->jumlah . ' ) ' . ' , ';
                    } ?></td>
                <td><?php echo $data->status ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <footer style="margin-top: 10px;">
        <span style="font-style:italic;text-align: left;">
            Printed Date & Time <?= date('d-m-Y H:i:s'); ?>
        </span>
        <span style="font-style:italic;text-align: right;margin-left: 180px">
            Printed by <?= $this->session->userdata('nama'); ?>
        </span>
    </footer>
</body>

</html>