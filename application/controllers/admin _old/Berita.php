<?php
defined('BASEPATH') Or exit('No Direct Script Access Allowed');


/**
* 
*/
class Berita extends CI_Controller{

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

	$data['berita'] = $this->mm->get_data('berita')->result();

	$this->load->view('admin/inc/v_header');
	$this->load->view('admin/v_berita',$data);
	$this->load->view('admin/inc/v_footer');

}


function save(){

$this->form_validation->set_rules('judul_berita', 'judul berita', 'required');

if($this->form_validation->run()==FALSE){
$this->session->set_flashdata('error',"Data Gagal Di Tambahkan");
redirect('admin/berita');
}else{

//konfigurasi upload gambar
$config['upload_path'] = './uploads/berita/';
$config['allowed_types'] = '*';
$config['max_size'] = '*';
$config['file_name'] = 'berita'.time();
$this->load->library('upload',$config);
$this->upload->initialize($config);
if($this->upload->do_upload('gambar_berita')){
$image=$this->upload->data();

$data=array(
'judul_berita'=>$_POST['judul_berita'],
'kategori_berita'=>$_POST['kategori_berita'],
'isi_berita'=>$_POST['isi_berita'],
'gambar_berita' => $image['file_name']

);
}}

$this->mm->insert_data($data,'berita');
$this->session->set_flashdata('sukses',"Data Berhasil Disimpan");
redirect('admin/berita');

}

 

function edit(){
$id_berita= $this->input->post('id_berita');
$old_pict =  $this->input->post('old_pict');

$this->form_validation->set_rules('judul_berita', 'judul berita', 'required');
if($this->form_validation->run() != false){

//konfigurasi upload gambar
$config['upload_path'] = './uploads/berita/';
$config['allowed_types'] = '*';
$config['max_size'] = '*';
$config['file_name'] = 'berita'.time();
$this->load->library('upload',$config);
$this->upload->initialize($config);

$data = array(
'judul_berita'=>$_POST['judul_berita'],
'kategori_berita'=>$_POST['kategori_berita'],
'isi_berita'=>$_POST['isi_berita'],
'gambar_berita' => $image['file_name']
);
}

$cek_gambar = $_FILES['gambar_berita']['size'];
if($cek_gambar > 0){
//proses upload edit gambar produk
$this->upload->do_upload('gambar_berita');
@unlink('./uploads/berita/',$old_pict);
$gambar_berita = $this->upload->data();
$data['gambar_berita'] = $gambar_berita['file_name'];
$this->db->where('id_berita', $_POST['id_berita']);
}


$where = array('id_berita' => $id_berita);
$this->mm->update_data($where,$data,'berita');
$this->session->set_flashdata('sukses',"Data Berhasil Di ubah");
redirect(base_url().'admin/berita');
}


function hapus($id_berita)

{

if($id_berita==""){

$this->session->set_flashdata('error',"Data Anda Gagal Di Hapus");

redirect('admin/berita');

}else{

$this->db->where('id_berita', $id_berita);

$this->db->delete('berita');

$this->session->set_flashdata('sukses',"Data Berhasil Dihapus");

redirect('admin/berita');

}

}



}