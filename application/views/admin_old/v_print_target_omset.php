<head>
<meta charset="UTF-8">
<span style="font-style:italic;text-align: left;">
    Printed Date & Time <?= date('d-m-Y H:i:s'); ?>
  </span>
<span style="font-style:italic;text-align: right;margin-left: 250px">
    Printed by <?= $this->session->userdata('nama');?><
  </span>

<title>Laporan Target Omset</title>

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

<h1 align="center"> Laporan Target Omset</h1>
 
 
<p align="center">Periode <?= bulan(date('m', strtotime($lpp->waktu_omset)));  ?></p>

 
  
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
        
        <td align="center">Rp. <?= number_format($lpp->target_omset,'0','.','.') ?></td>
        
        <?php  
        foreach ($lpp->pencapaian as $data2){ 
        ?>
        <td align="center">Rp. <?= number_format($data2->total_omset,'0','.','.') ?></td>
        <td align="center"><?= $data2->pencapaian ?>%</td>
         <?php } ?>
      </tr>
    </tbody>
  </table>

  <br>

  
 



