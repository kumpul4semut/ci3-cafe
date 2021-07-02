<div class="col-sm-12 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

<div class="row">
<ol class="breadcrumb">
<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
<li class="active">Daftar Menu</li>
</ol>
</div><!--/.row-->

<br>


<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-heading"><svg class="glyph stroked male user "><use xlink:href="#stroked-male-user"/></svg>
<a type="button" data-toggle="modal" data-target="#modal-tambah" style="text-decoration:none;cursor: pointer;">Tambah Daftar Menu</a></div>
<div class="panel-body">
<div class="box">
<!-- /.box-header -->
<div class="box-body">
<?php $data=$this->session->flashdata('sukses'); 
if($data!=""){ ?>
<div id="notifikasi" class="alert alert-success rounded-md px-5 py-4 mb-2 bg-theme-9 text-white">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Sukses! </strong> <?=$data;?>
</div>

<?php } ?>
<?php 
$data2=$this->session->flashdata('error');
if($data2!=""){ ?>

<div id="notifikasi" class="alert alert-danger rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong> Error! </strong> <?=$data2;?>
</div>
<?php } ?>

</div>
</div>

<table data-toggle="table" data-show-refresh="false" data-show-toggle="true" data-show-columns="true" data-search="true"  data-pagination="true" data-sort-name="name" data-sort-order="desc">
<thead>
<tr>
<th data-field="no" data-sortable="true" width="10px"> No</th>
<th data-field="nama_kategori" data-sortable="true">Kategori</th>
<th data-field="nama_menu" data-sortable="true">Nama Menu</th>
<th data-field="stok" data-sortable="true">Stok</th>
<th data-field="harga" data-sortable="true">Harga</th>
<th data-field="status" data-sortable="true">Status</th>
<th>Aksi</th>
</tr>
</thead>
<tbody>
<?php $no = 0; foreach($daftar_menu as $row) : $no++;?>
<tr>
<td data-field="no" width="10px"><?php echo $no;?></td>
<td data-field="nama_kategori"><?php echo $row->nama_kategori;?></td>
<td data-field="nama_menu"><?php echo $row->nama_menu;?></td>
<td data-field="stok"><?php echo $row->stok;?></td>
<td data-field="harga"><?php echo $row->harga;?></td>
<td data-field="status"><?php echo $row->status;?></td>


<td> 

<a type="button" data-toggle="modal" data-target="#modal-edit<?=$row->id_menu;?>" class="ubah btn btn-primary btn-xs" style="cursor: pointer;"><i class="glyphicon glyphicon-edit"></i></a>
<a class="hapus btn btn-danger btn-xs" href="<?php echo site_url('admin/daftar_menu/hapus/'.$row->id_menu); ?>" onclick="return confirm('Apakah Anda Ingin Menghapus Data <?=$row->id_menu;?> ?');" class="btn btn-danger btn-circle" data-popup="tooltip" data-placement="top" title="Hapus Data"><i class="glyphicon glyphicon-trash"></i></a>
</td>

</tr>
<?php endforeach;?>
</tbody>

</table>
</div></div></div></div></div>


<!-- Daftar Menu modal -->

<div class="modal fade bs-example-modal-lg" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="myLargeModalLabel">Tambah</h4>
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
<form action="<?php echo base_url()?>admin/daftar_menu/simpan" method="POST" enctype="multipart/form-data">

<div class="p-5 grid grid-cols-12 gap-4 row-gap-3">


<div class="row">
<div class="col-md-6">
<div class="form-group">
<label align="left">Kategori :</label>
<select class="form-control" name="id_kategori">
	<option value="0">Pilih * kategori</option>
	<?php foreach ($kategori as $k) { ?>
		<option value="<?=$k->id_kategori?>"><?=$k->nama_kategori?></option>
	<?php } ?>
</select>
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label align="left">Nama Menu :</label>
<input type="text" name="nama_menu" class="form-control">
</div>
</div>
</div>


<div class="row">
<div class="col-md-6">
<div class="form-group">
<label align="left">Stok :</label>
<input type="number" name="stok" class="form-control">
</div> 
</div>
<div class="col-md-6">
<div class="form-group">
<label align="left">Harga :</label>
<input type="number" name="harga" class="form-control">
</div>
</div>
</div>


<div class="row">
<div class="col-md-12">
<div class="form-group">
<label align="left">Status :</label>
<select class="form-control" name="status">
	<option value="0">Pilih * Status</option>
	<option value="tersedia">Tersedia</option>
	<option value="habis">Habis</option>
</select></div>
</div>

</div>

<center><button type="submit"  class="btn btn-success">Simpan</button></center>


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




<!-- Daftar Menu modal -->
<?php $no=0; foreach($daftar_menu as $row): $no++; ?>
<div class="modal fade bs-example-modal-lg" id="modal-edit<?=$row->id_menu?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="myLargeModalLabel">Ubah</h4>
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
<form action="<?php echo base_url()?>admin/daftar_menu/edit" method="POST" enctype="multipart/form-data">

<div class="p-5 grid grid-cols-12 gap-4 row-gap-3">


<div class="row">
<div class="col-md-6">
<div class="form-group">
<label align="left">Kategori :</label>
<select class="form-control" name="id_kategori">
	<option value="<?=$row->id_kategori?>"><?=$row->nama_kategori?> (Kategori Terpilih)</option>
	<?php foreach ($kategori as $k) { ?>
		<option value="<?=$k->id_kategori?>"><?=$k->nama_kategori?></option>
	<?php } ?>
</select>
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label align="left">Nama Menu :</label>
<input type="text" name="nama_menu" value="<?=$row->nama_menu?>" class="form-control">
</div>
</div>
</div>


<div class="row">
<div class="col-md-6">
<div class="form-group">
<label align="left">Stok :</label>
<input type="number" name="stok" value="<?=$row->stok?>" class="form-control">
</div> 
</div>
<div class="col-md-6">
<div class="form-group">
<label align="left">Harga :</label>
<input type="number" name="harga" value="<?=$row->harga?>" class="form-control">
</div>
</div>
</div>


<div class="row">
<div class="col-md-12">
<div class="form-group">
<label align="left">Status :</label>
<select class="form-control" name="status">
	<option value="<?=$row->status?>"><?=$row->status?> (Status Terpilih)</option>
	<option value="tersedia">Tersedia</option>
	<option value="habis">Habis</option>
</select></div>
</div>

</div>

<center><button type="submit"  class="btn btn-success">Simpan</button></center>


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







<?php echo $this->session->flashdata("msg");?>


<script>
$(function () {
$('#hover, #striped, #condensed').click(function () {
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


