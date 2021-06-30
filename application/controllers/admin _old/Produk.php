<?php
defined('BASEPATH') Or exit('No Direct Script Access Allowed');


/**
* 
*/
class Produk extends CI_Controller{

function __construct(){
parent::__construct();
//cek login
if ($this->session->userdata('status') != "login" ){
redirect(base_url().'auth?pesan=belumlogin');
}
$this->id_sales = $this->session->userdata('id_sales');
$this->nama = $this->session->userdata('nama');
$this->level = $this->session->userdata('level');
$this->load->model('M_master', 'mm');
$this->load->library('upload');
}


function index(){

	$data['produk'] = $this->mm->get_data('produk')->result();
	$data['kode_produk']=$this->mm->ambil_kodeproduk();

	$id_sales = $this->id_sales;
	$data['po_notif'] = $this->mm->get_potoko($id_sales)->result();


	$this->load->view('admin/inc/v_header',$data);

	$this->load->view('admin/v_produk',$data);
	$this->load->view('admin/inc/v_footer');

}

function save_produk(){

$this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required');
$this->form_validation->set_rules('hargapen', 'Harga Penjualan', 'required');
$this->form_validation->set_rules('hargapem', 'Harga Pembelian', 'required');
$this->form_validation->set_rules('stok', 'Stok', 'required');


if($this->form_validation->run()==FALSE){
$this->session->set_flashdata('error',"Data Gagal Di Tambahkan");
redirect('admin/produk');
}else{

//konfigurasi upload gambar
$config['upload_path'] = './uploads/gambar_produk/';
$config['allowed_types'] = '*';
$config['max_size'] = '*';
$config['file_name'] = 'produk'.time();
$this->load->library('upload',$config);
$this->upload->initialize($config);
if($this->upload->do_upload('gambar_produk')){
$image=$this->upload->data();

$data=array(
'kode_produk'=>$_POST['kode_produk'],
'nama_produk'=>$_POST['nama_produk'],
'hargapem'=>$_POST['hargapem'],
'hargapen'=>$_POST['hargapen'],
'stok'=>$_POST['stok'],
'gambar_produk' => $image['file_name']

);
}

$this->mm->insert_data($data,'produk');
$this->session->set_flashdata('sukses',"Data Berhasil Disimpan");
redirect('admin/produk');

	}
}
      

function edit_produk(){
$id_produk = $this->input->post('id_produk');
$old_pict =  $this->input->post('old_pict');
$this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required');
$this->form_validation->set_rules('hargapen', 'Harga Penjualan', 'required');
$this->form_validation->set_rules('hargapem', 'Harga Pembelian', 'required');
$this->form_validation->set_rules('stok', 'Stok', 'required');
if($this->form_validation->run() != false){

//konfigurasi upload gambar
$config['upload_path'] = './uploads/gambar_produk/';
$config['allowed_types'] = '*';
$config['max_size'] = '*';
$config['file_name'] = 'produk'.time();
$this->load->library('upload',$config);
$this->upload->initialize($config);

$data = array(
'kode_produk'=>$_POST['kode_produk'],
'nama_produk'=>$_POST['nama_produk'],
'hargapem'=>$_POST['hargapem'],
'hargapen'=>$_POST['hargapen'],
'hargapcs'=>$_POST['hargapcs'],
'stok'=>$_POST['stok']
);
}

$cek_gambar = $_FILES['gambar_produk']['size'];
if($cek_gambar > 0){
//proses upload edit gambar produk
$this->upload->do_upload('gambar_produk');
@unlink('./uploads/gambar_produk/',$old_pict);
$gambar_produk = $this->upload->data();
$data['gambar_produk'] = $gambar_produk['file_name'];
$this->db->where('id_produk', $_POST['id_produk']);
}

$where = array('id_produk' => $id_produk);
$this->mm->update_data($where,$data,'produk');
$this->session->set_flashdata('sukses',"Data Berhasil Di ubah");
redirect(base_url().'admin/produk');
}


function hapus_produk($id_produk)

{

if($id_produk==""){

$this->session->set_flashdata('error',"Data Anda Gagal Di Hapus");

redirect('admin/produk');

}else{

$this->db->where('id_produk', $id_produk);

$this->db->delete('produk');

$this->session->set_flashdata('sukses',"Data Berhasil Dihapus");

redirect('admin/produk');

}

}


}