
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

<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
        Halaman Tentang
    </h2>
     <a href="" class="ml-auto flex text-theme-1"> <i data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i> </a>
    <div class="w-full sm:w-auto flex mt-4 sm:mt-0"></div>
</div>

 <div class="intro-y datatable-wrapper box p-5 mt-5">

<?php $no=0; foreach($tentang as $data): $no++; ?>

<form action="<?php echo base_url()?>admin/tentang/edit" method="POST" enctype="multipart/form-data">

<input type="hidden" name="id_tentang" value="<?php echo $data->id_tentang ?>" class="input w-full border mt-2 flex-1" >

<div class="col-span-12 sm:col-span-6">
<label align="left">Judul Tentang :</label>
<input type="text" name="judul_tentang" value="<?php echo $data->judul_tentang ?>" class="input w-full border mt-2 flex-1" >
</div>

<div class="col-span-12 sm:col-span-6">
<label align="left">Slogan Tentang :</label>
<input type="text" name="slogan_tentang" value="<?php echo $data->slogan_tentang ?>" class="input w-full border mt-2 flex-1" >
</div>

<div class="col-span-12 sm:col-span-6">
<label align="left">Isi Tentang</label>
<textarea name="isi_tentang"  class="input w-full border mt-2 flex-1" height="900"><?php echo $data->isi_tentang ?></textarea>
</div>

<div class="col-span-12 sm:col-span-6">
<label align="left">Tujuan</label>
<textarea name="tujuan" class="input w-full border mt-2 flex-1" height="900"><?php echo $data->tujuan ?></textarea>
</div>

<div class="col-span-12 sm:col-span-6">
<label align="left">Tujuan</label>
<textarea name="visi" class="input w-full border mt-2 flex-1" height="900"><?php echo $data->visi ?></textarea>
</div>


<div class="col-span-12 sm:col-span-6">
<label align="left">Misi</label>
<textarea name="misi" class="input w-full border mt-2 flex-1" height="900"><?php echo $data->misi ?></textarea>
</div>


<div class="col-span-12 sm:col-span-6">
<label align="left">Gambar :</label>
<img src="<?php echo base_url().'uploads/tentang/'.$data->gambar_tentang; ?>" width="150" height="150" alt="gambar tidak ada">
<input type="hidden" name="old_pict" class="input w-full border mt-2 flex-1" value="<?php echo $data->gambar_tentang ?>">
<input type="file" name="gambar_tentang" class="input w-full border mt-2 flex-1" >
</div>

<br>

<div class="col-span-12 sm:col-span-12 align text-right">
<button type="submit" class="button w-24 bg-theme-1 text-white">Simpan</button>
</div>



</div>

</form>

<?php endforeach; ?>

</form>