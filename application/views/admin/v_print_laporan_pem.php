<head>
<meta charset="UTF-8">
<span style="font-style:italic;text-align: left;">
    Printed Date & Time <?= date('d-m-Y H:i:s'); ?>
  </span>
<span style="font-style:italic;text-align: right;margin-left: 250px">
    Printed by <?= $this->session->userdata('nama');?><
  </span>
<title>Laporan Pembelian</title>

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

<h1 align="center"> Laporan Pembelian</h1>
 
<p align="center">Periode <?=  bulan(date('m', strtotime($lpp->periode1)))  ?> -  <?= bulan(date('m', strtotime($lpp->periode2)))  ?></p>
   

 Pembelian
  <table width="100%">
    <thead style="background-color: lightgray;">
    
      <tr>
        <?php foreach ($lpp->pen as $bulan) { ?>
        <th align="center"><?= bulan($bulan->bulan);  ?></th>
        <?php } ?>
      </tr>
    </thead><tbody>
      <tr>
        <?php  
        foreach ($lpp->pen as $data){ 
        ?>
        <td align="center">Rp. <?= number_format($data->total_harga,'0','.','.') ?></td>
         <?php } ?>
      </tr>
    </tbody></table>

  <br>

 



