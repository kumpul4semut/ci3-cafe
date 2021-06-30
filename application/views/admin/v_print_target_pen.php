<style type="text/css">
  #inventory-invoice{
    padding: 30px;
}
#inventory-invoice a{text-decoration:none ! important;}
.invoice {
    position: relative;
    background-color: #FFF;
    min-height: 680px;
    padding: 15px
}

.invoice header {
    padding: 10px 0;
    margin-bottom: 20px;
    border-bottom: 1px solid #3989c6
}

.invoice .company-details {
    text-align: right
}

.invoice .company-details .name {
    margin-top: 0;
    margin-bottom: 0
}

.invoice .contacts {
    margin-bottom: 20px
}

.invoice .invoice-to {
    text-align: left
}

.invoice .invoice-to .to {
    margin-top: 0;
    margin-bottom: 0
}

.invoice .invoice-details {
    text-align: right
}

.invoice .invoice-details .invoice-id {
    margin-top: 0;
    color: #3989c6
}

.invoice main {
    padding-bottom: 50px
}

.invoice main .thanks {
    margin-top: -100px;
    font-size: 2em;
    margin-bottom: 50px
}

.invoice main .notices {
    padding-left: 6px;
    border-left: 6px solid #3989c6
}

.invoice main .notices .notice {
    font-size: 1.2em
}

.invoice table {
    width: 100%;
    border-collapse: collapse;
    border-spacing: 0;
    margin-bottom: 20px
}

.invoice table td,.invoice table th {
    padding: 15px;
    background: #eee;
    border-bottom: 1px solid #fff
}

.invoice table th{
    white-space: nowrap;
    font-weight: 400;
    font-size: 16px;
    border:1px solid #fff;
}
.invoice table td{
    border:1px solid #fff;
}
.invoice table td h3 {
    margin: 0;
    font-weight: 400;
    color: #3989c6;
    font-size: 1.2em
}

.invoice table .tax,.invoice table .total,.invoice table .unit {
    text-align: right;
    font-size: 1.2em
}

.invoice table .no {
    color: #fff;
    font-size: 1.6em;
    background: #17a2b8
}

.invoice table .unit {
    background: #ddd
}

.invoice table .total {
    background: #17a2b8;
    color: #fff
}

.invoice table tfoot td {
    background: 0 0;
    border-bottom: none;
    white-space: nowrap;
    text-align: right;
    padding: 10px 20px;
    font-size: 1.2em;
    border-top: 1px solid #aaa
}

.invoice table tfoot tr:first-child td {
    border-top: none
}

.invoice table tfoot tr:last-child td {
    color: #3989c6;
    font-size: 1.4em;
    border-top: 1px solid #3989c6
}

.invoice table tfoot tr td:first-child {
    border: none
}

.invoice footer {
    width: 100%;
    text-align: center;
    color: #777;
    border-top: 1px solid #aaa;
    padding: 8px 0
}

@media print {
    .invoice {
        font-size: 11px!important;
        overflow: hidden!important
    }

    .invoice footer {
        position: absolute;
        bottom: 10px;
        page-break-after: always
    }

    .invoice>div:last-child {
        page-break-before: always
    }
}
</style>

<head>
  <title>Laporan Target Penjualan</title>
</head>

<div id="inventory-invoice">

    <div class="toolbar hidden-print">
       
        <hr>
    </div>
    <div class="invoice overflow-auto">
        <div style="min-width: 600px">
           
            <main>

              <center><h1>Laporan Target Penjualan</h1></center>

              <p align="center">Periode <?= bulan(date('m', strtotime($lpp->waktu_tpenjualan)));  ?></p>

                <div class="row contacts">
                    <div class="col invoice-to">
                        <span class="text-gray-light">Laporan Untuk:</span>  <span style="padding-left: 400px">Laporan Dari:</span>
                        <span class="to">Kepala Toko</span><span style="padding-left: 425px">Admin</span> 
                        

                    </div>

                    
                   
                </div>
                    <table width="100%">
                    <thead style="background-color: lightgray;">

                    <tr>

                    <th align="center">Target</th>
                    <th align="center">Pencapaian</th>
                    <th align="center">% Pencapaian</th>

                    </tr>
                    </thead>
                    <tbody>
                    <tr>

                    <td align="center">Rp. <?= number_format($lpp->target_penjualan,'0','.','.') ?></td>

                    <?php  
                    foreach ($lpp->pencapaian as $data2){ 
                    ?>
                    <td align="center">Rp. <?= number_format($data2->total_penjualan,'0','.','.') ?></td>
                    <td align="center"><?= $data2->pencapaian ?>%</td>
                    <?php } ?>
                    </tr>
                    </tbody>
                    </table>
            </main>
            <footer>
                <span style="font-style:italic;text-align: left;">
    Printed Date & Time <?= date('d-m-Y H:i:s'); ?>
  </span>
<span style="font-style:italic;text-align: right;margin-left: 180px">
    Printed by <?= $this->session->userdata('nama');?>
  </span>
            </footer>
        </div>
        <div></div>
    </div>
</div>