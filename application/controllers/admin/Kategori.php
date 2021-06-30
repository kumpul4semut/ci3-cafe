<?php
defined('BASEPATH') Or exit('No Direct Script Access Allowed');


/**
* 
*/
class Kategori extends CI_Controller{

function __construct(){
parent::__construct();
//cek login
if ($this->session->userdata('status') != "login" ){

redirect(base_url().'admin/auth?pesan=belumlogin');
}
$this->level = $this->session->userdata('level');
$this->id_user = $this->session->userdata('id_user');
$this->nama = $this->session->userdata('nama');
$this->load->model('m_master', 'mm');

}


function index(){

	$data['kategori'] = $this->mm->get_data('kategori')->result();

	$this->load->view('admin/inc/v_header');
	$this->load->view('admin/v_kategori',$data);
	$this->load->view('admin/inc/v_footer');

}


function simpan(){

$this->form_validation->set_rules('nama_kategori', 'Nama kategori', 'required');

if($this->form_validation->run()==FALSE){
$this->session->set_flashdata('error',"Data Gagal Di Tambahkan");
redirect('admin/kategori');
}else{

$data=array(
'nama_kategori'=>$_POST['nama_kategori']
);
}

$this->mm->insert_data($data,'kategori');
$this->session->set_flashdata('sukses',"Data Berhasil Disimpan");
redirect('admin/kategori');

}
      

function edit(){
$id_kategori = $this->input->post('id_kategori');
$this->form_validation->set_rules('nama_kategori', 'Nama kategori', 'required');
if($this->form_validation->run() != false){
$data = array(
'nama_kategori'=>$_POST['nama_kategori'],
);

}
$where = array('id_kategori' => $id_kategori);
$this->mm->update_data($where,$data,'kategori');
$this->session->set_flashdata('sukses',"Data Berhasil Di ubah");
redirect(base_url().'admin/kategori');
}


function hapus($id_kategori)

{

if($id_kategori==""){

$this->session->set_flashdata('error',"Data Anda Gagal Di Hapus");

redirect('admin/kategori');

}else{

$this->db->where('id_kategori', $id_kategori);

$this->db->delete('kategori');

$this->session->set_flashdata('sukses',"Data Berhasil Dihapus");

redirect('admin/kategori');

}

}





}