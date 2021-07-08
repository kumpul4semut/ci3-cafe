<div class="row">
<div class="col-sm-12 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

<div class="row">
<ol class="breadcrumb">
<li><a href="<?=base_url()?>admin/beranda"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
<li class="active">Profil Resto</li>
</ol>
</div><!--/.row-->

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

<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-body">

					<?php $no=0; foreach($profil as $data): $no++; ?>

						<form method="post" action="<?=base_url()?>admin/profil/edit" enctype="multipart/form-data">

						<input type="hidden" class="form-control" name="id_profil" value="<?=$data->id_profil?>">

						<div class="col-md-6">
						<div class="form-group">
								<label>Nama Resto</label>
								<input class="form-control" name="nama_resto" value="<?=$data->nama_resto?>" required>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Alamat</label>
								<textarea class="form-control" name="alamat"><?=$data->alamat?></textarea>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Nama Pemilik</label>
								<input class="form-control" name="nama_pemilik" value="<?=$data->nama_pemilik?>" required>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Tentang</label>
								<textarea class="form-control" name="tentang"><?=$data->tentang?></textarea>
							</div>
						</div>

							<div align="center">
							<button type="submit" class="btn btn-primary">Simpan</button>
							<a href="<?php echo base_url(); ?>admin/profil" class="btn btn-default">Batal</a>
							</div>

					</form>
				<?php endforeach; ?>



				</div>
			</div>
		</div>
	</div>
	<!--/.row-->




</div>
</div>