<html>

<head>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>

<body>
    <h1>Pesanan #<?php echo $pesanan['kode_pesanan']  ?> status terbooking</h1>
    <br>
    <ul>
        <li>Jumlah Bayar: <?php echo rp_format($pesanan['jumlah_bayar']) ?></li>
        <li>Tanggal Pemesanan: <?php echo $pesanan['tgl_pemesanan'] ?></li>
        <li>Jam Pesan: <?php echo $pesanan['jam_pesan'] ?></li>
        <li>Meja Pesan: <?php echo $pesanan['nama_meja'] ?></li>
    </ul>
    <br>
    <table>
        <thead>
            <tr>
                <th>Nama Menu</th>
                <th>Harga</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($menu_select as $data) : ?>
                <tr>
                    <td><?php echo $data['nama_menu'] ?></td>
                    <td><?php echo rp_format($data['harga']) ?></td>
                    <td><?php echo $data['jumlah'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>