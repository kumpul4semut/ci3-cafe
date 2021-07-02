<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<span style="font-style:italic;text-align: left;">
    Printed Date & Time <?= date('d-m-Y H:i:s'); ?>
  </span>
<span style="font-style:italic;text-align: right;margin-left: 250px">
    Printed by : <?= $this->session->userdata('nama_sales');?><
  </span>
<title><?= $faktur->kode_faktur  ?></title>

<style type="text/css">
    * {
        font-family: Verdana, Arial, sans-serif;
    }
    table{
        font-size: x-small;
    }
    tfoot tr td{
        font-weight: bold;
        font-size: x-small;
    }
    .gray {
        background-color: lightgray
    }
</style>

</head>
<body>
<h1><?= $faktur->status ?></h1>
  <table width="100%">
    <tr>
        <td valign="top"><h1>Tk. Sahabat Balaraja</h1></td>
        <td align="right">
            <h3 align="right"><?= $faktur->kode_faktur  ?><br>Jatuh Tempo : <?php echo date('d-m-y', strtotime($faktur->jatuh_tempo));  ?><br>Kode PO : <?= $faktur->kode_po  ?></h3>
        </td>
    </tr>

  </table>

  

  <table width="100%">
    <tr>
        <td><strong>Dari:</strong> <?= $faktur->details->dari ?></td>
        <td><strong>Untuk:</strong> <?= $faktur->details->ke ?></td>
    </tr>

  </table>

  <br/>

  <table width="100%">
    <thead style="background-color: lightgray;">
      <tr>
        <th align="center">#</th>
        <th align="center">Kode</th>
        <th align="center">Nama Produk</th>
        <th align="center">Jumlah</th>
        <th align="center">Harga</th>
      </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        foreach ($faktur->produk as $data){ 
        ?>
      <tr>
        <th align="center"> <?= $no++; ?></th>
        <td align="center"><?= $data->kode_produk  ?></td>
        <td align="center"><?= $data->nama_psales  ?></td>
        <td align="center"><?= $data->jumlah_po ?></td>
        <td align="center">Rp. <?php echo number_format($data->harga_po,'0','.','.') ?></td>
      </tr>
      <?php } ?>
    </tbody>

    <tfoot>
        <tr>
            <td colspan="3"></td>
            <td align="right"></td>
            <td align="right"></td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td align="right"></td>
            <td align="right"></td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td align="right">Total</td>
            <td align="right" class="gray">Rp. <?php echo number_format($faktur->details->total_harga,'0','.','.') ?></td>
        </tr>
    </tfoot>
  </table>

  History Pembayaran
  <table width="100%">
    <thead style="background-color: lightgray;">
      <tr>
        <th align="center">#</th>
        <th align="center">Tgl Bayar</th>
        <th align="center">Di bayar</th>
        <th align="center">Kurang Bayar</th>
      </tr>
    </thead>
    <tbody>
        <?php 
        $no =1; 
        foreach ($faktur->bayar as $bayar){ 
        ?>
      <tr>
        <th align="center"><?= $no++; ?></th>
        <td align="center"><?= $bayar->tgl_bayar  ?></td>
        <td align="center"><?= $bayar->dibayar  ?></td>
        <td align="center"><?= $bayar->blm_dibayar  ?></td>
      </tr>
      <?php } ?>
    </tbody>

    <tfoot>
        <tr>
            <td colspan="3"></td>
            <td align="right"></td>
            <td align="right"></td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td align="right"></td>
            <td align="right"></td>
        </tr>

         <tr>
            <td colspan="2"></td>
            <td align="right">Total Harga</td>

            <td align="right" class="gray">Rp. <?php echo number_format($faktur->details->total_harga,'0','.','.') ?></td>
        </tr>

         <tr>
            <td colspan="2"></td>
            <td align="right">Total Bayar</td>
           
            <td align="right" class="gray">Rp. <?php echo number_format($faktur->lastbayar->bayar,'0','.','.') ?></td>
        </tr>
        
        <tr>
            <td colspan="2"></td>
            <td align="right">Total Tagihan</td>
             <?php $total_tagihan = $faktur->details->total_harga - $faktur->lastbayar->bayar  ?>
            <td align="right" class="gray">Rp. <?php echo number_format($total_tagihan,'0','.','.') ?></td>
        </tr>
        
    </tfoot>
  </table>

</body>
</html>