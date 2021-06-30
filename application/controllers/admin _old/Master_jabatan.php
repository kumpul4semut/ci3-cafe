<?php
defined('BASEPATH') Or exit('No Direct Script Access Allowed');


/**
* 
*/
class Master_jabatan extends CI_Controller{

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

	$data['jabatan'] = $this->mm->get_data('jabatan')->result();

	$this->load->view('admin/inc/v_header');
	$this->load->view('admin/v_jabatan',$data);
	$this->load->view('admin/inc/v_footer');

}


function save(){

$this->form_validation->set_rules('nama_menu', 'Nama Menu', 'required');
$this->form_validation->set_rules('kategori', 'Kategori', 'required');
$this->form_validation->set_rules('link', 'Link', 'required');
$this->form_validation->set_rules('status', 'Status', 'required');

if($this->form_validation->run()==FALSE){
$this->session->set_flashdata('error',"Data Gagal Di Tambahkan");
redirect('admin/menu');
}else{

$data=array(
'nama_menu'=>$_POST['nama_menu'],
'kategori'=>$_POST['kategori'],
'link'=>$_POST['link'],
'status'=>$_POST['status']
);
}

$this->mm->insert_data($data,'menu');
$this->session->set_flashdata('sukses',"Data Berhasil Disimpan");
redirect('admin/menu');

}
      

function edit(){
$id_menu = $this->input->post('id_menu');
$this->form_validation->set_rules('nama_menu', 'Nama Menu', 'required');
$this->form_validation->set_rules('kategori', 'Kategori', 'required');
$this->form_validation->set_rules('link', 'Link', 'required');
$this->form_validation->set_rules('status', 'Status', 'required');
if($this->form_validation->run() != false){
$data = array(
'nama_menu'=>$_POST['nama_menu'],
'kategori'=>$_POST['kategori'],
'link'=>$_POST['link'],
'status'=>$_POST['status']
);

}
$where = array('id_menu' => $id_menu);
$this->mm->update_data($where,$data,'menu');
$this->session->set_flashdata('sukses',"Data Berhasil Di ubah");
redirect(base_url().'admin/menu');
}


function hapus($id_menu)

{

if($id_menu==""){

$this->session->set_flashdata('error',"Data Anda Gagal Di Hapus");

redirect('admin/menu');

}else{

$this->db->where('id_menu', $id_menu);

$this->db->delete('menu');

$this->session->set_flashdata('sukses',"Data Berhasil Dihapus");

redirect('admin/menu');

}

}





}