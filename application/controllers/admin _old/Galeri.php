<?php
defined('BASEPATH') Or exit('No Direct Script Access Allowed');


/**
* 
*/
class Galeri extends CI_Controller{

function __construct(){
parent::__construct();
//cek login
if ($this->session->userdata('status') != "login" ){

redirect(base_url().'admin/auth?pesan=belumlogin');
}
$this->id_admin = $this->session->userdata('id_admin');
$this->nama_admin = $this->session->userdata('nama_admin');
$this->load->model('m_master', 'mm');
$this->load->library('upload');
}


function index(){

	$data['galeri'] = $this->mm->get_data('galeri')->result();

	$this->load->view('admin/inc/v_header');
	$this->load->view('admin/v_galeri',$data);
	$this->load->view('admin/inc/v_footer');

}


function save(){

$this->form_validation->set_rules('nama_galeri', 'nama galeri', 'required');
$this->form_validation->set_rules('kategori', 'kategori', 'required');

if($this->form_validation->run()==FALSE){
$this->session->set_flashdata('error',"Data Gagal Di Tambahkan");
redirect('admin/galeri');
}else{

//konfigurasi upload gambar
$config['upload_path'] = './uploads/galeri/';
$config['allowed_types'] = '*';
$config['max_size'] = '*';
$config['file_name'] = 'galeri'.time();
$this->load->library('upload',$config);
$this->upload->initialize($config);
if($this->upload->do_upload('gambar_galeri')){
$image=$this->upload->data();

$data=array(
'nama_galeri'=>$_POST['nama_galeri'],
'kategori'=>$_POST['kategori'],
'gambar_galeri' => $image['file_name']

);
}}

$this->mm->insert_data($data,'galeri');
$this->session->set_flashdata('sukses',"Data Berhasil Disimpan");
redirect('admin/galeri');

}

 

function edit(){
$id_galeri = $this->input->post('id_galeri');
$old_pict =  $this->input->post('old_pict');

$this->form_validation->set_rules('nama_galeri', 'nama galeri', 'required');
$this->form_validation->set_rules('kategori', 'kategori', 'required');
if($this->form_validation->run() != false){

//konfigurasi upload gambar
$config['upload_path'] = './uploads/galeri/';
$config['allowed_types'] = '*';
$config['max_size'] = '*';
$config['file_name'] = 'galeri'.time();
$this->load->library('upload',$config);
$this->upload->initialize($config);

$data = array(
'nama_galeri'=>$_POST['nama_galeri'],
'kategori'=>$_POST['kategori']
);
}

$cek_gambar = $_FILES['gambar_galeri']['size'];
if($cek_gambar > 0){
//proses upload edit gambar produk
$this->upload->do_upload('gambar_galeri');
@unlink('./uploads/gambar_galeri/',$old_pict);
$gambar_berita = $this->upload->data();
$data['gambar_galeri'] = $gambar_galeri['file_name'];
$this->db->where('id_galeri', $_POST['id_galeri']);
}


$where = array('id_galeri' => $id_galeri);
$this->mm->update_data($where,$data,'galeri');
$this->session->set_flashdata('sukses',"Data Berhasil Di ubah");
redirect(base_url().'admin/galeri');
}


function hapus($id_galeri)

{

if($id_galeri==""){

$this->session->set_flashdata('error',"Data Anda Gagal Di Hapus");

redirect('admin/galeri');

}else{

$this->db->where('id_galeri', $id_galeri);

$this->db->delete('galeri');

$this->session->set_flashdata('sukses',"Data Berhasil Dihapus");

redirect('admin/galeri');

}

}



}