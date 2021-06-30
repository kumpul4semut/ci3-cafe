
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
        Pengaturan
    </h2>
     <a href="" class="ml-auto flex text-theme-1"> <i data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i> </a>
    <div class="w-full sm:w-auto flex mt-4 sm:mt-0"></div>
</div>

 <div class="intro-y datatable-wrapper box p-5 mt-5">

<?php $no=0; foreach($pengaturan as $data): $no++; ?>

<form action="<?php echo base_url()?>admin/pengaturan/edit" method="POST" enctype="multipart/form-data">

<input type="hidden" name="id_pengaturan" value="<?php echo $data->id_pengaturan ?>" class="input w-full border mt-2 flex-1" >

<div class="col-span-12 sm:col-span-6">
<label align="left">Nama Website :</label>
<input type="text" name="nama_website" value="<?php echo $data->nama_website ?>" class="input w-full border mt-2 flex-1" >
</div>

<div class="col-span-12 sm:col-span-6">
<label align="left">Kata Kunci / Seo (Key pisah koma ya) :</label>
<input type="text" name="kata_kunci" value="<?php echo $data->kata_kunci ?>" class="input w-full border mt-2 flex-1" >
</div>

<div class="col-span-12 sm:col-span-6">
<label align="left">Tentang</label>
<textarea name="tentang"  class="input w-full border mt-2 flex-1" height="900"><?php echo $data->tentang ?></textarea>
</div>

<div class="col-span-12 sm:col-span-6">
<label align="left">Alamat</label>
<textarea name="alamat" class="input w-full border mt-2 flex-1" height="900"><?php echo $data->alamat ?></textarea>
</div>

<div class="col-span-12 sm:col-span-6">
<label align="left">Email :</label>
<input type="email" name="email" value="<?php echo $data->email ?>" class="input w-full border mt-2 flex-1" >
</div>

<div class="col-span-12 sm:col-span-6">
<label align="left">Telepon / Hp :</label>
<input type="number" name="telepon" value="<?php echo $data->telepon ?>" class="input w-full border mt-2 flex-1" >
</div>

<div class="col-span-12 sm:col-span-6">
<label align="left">Maps</label>
<textarea name="maps" class="input w-full border mt-2 flex-1" height="900"><?php echo $data->maps ?></textarea>
</div>

<div class="col-span-12 sm:col-span-6">
<label align="left">Copyright :</label>
<input type="text" name="copyright" value="<?php echo $data->copyright ?>" class="input w-full border mt-2 flex-1" >
</div>

<div class="col-span-12 sm:col-span-6">
<label align="left">Color 1 :</label>
<input type="text" name="color1" value="<?php echo $data->color1 ?>" class="input w-full border mt-2 flex-1" >
</div>

<div class="col-span-12 sm:col-span-6">
<label align="left">Color 2 :</label>
<input type="text" name="color2" value="<?php echo $data->color2 ?>" class="input w-full border mt-2 flex-1" >
</div>

<div class="col-span-12 sm:col-span-6">
<label align="left">Color 3 :</label>
<input type="text" name="color3" value="<?php echo $data->color3 ?>" class="input w-full border mt-2 flex-1" >
</div>

<div class="col-span-12 sm:col-span-6">
<label align="left">Logo :</label>
<img src="<?php echo base_url().'uploads/pengaturan/'.$data->logo; ?>" width="150" height="150" alt="gambar tidak ada">
<input type="hidden" name="old_pict" class="input w-full border mt-2 flex-1" value="<?php echo $data->logo ?>">
<input type="file" name="logo" class="input w-full border mt-2 flex-1" >
</div>

<div class="col-span-12 sm:col-span-6">
<label align="left">Icon :</label>
<img src="<?php echo base_url().'uploads/pengaturan/'.$data->icon; ?>" width="150" height="150" alt="gambar tidak ada">
<input type="hidden" name="old_pict2" class="input w-full border mt-2 flex-1" value="<?php echo $data->icon ?>">
<input type="file" name="icon" class="input w-full border mt-2 flex-1" >
</div>


<br>

<div class="col-span-12 sm:col-span-12 align text-right">
<button type="submit" class="button w-24 bg-theme-1 text-white">Simpan</button>
</div>



</div>

</form>

<?php endforeach; ?>

</form>