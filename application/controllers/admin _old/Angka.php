<?php
defined('BASEPATH') Or exit('No Direct Script Access Allowed');


/**
* 
*/
class Angka extends CI_Controller{

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

	$data['angka'] = $this->mm->get_data('data_angka')->result();

	$this->load->view('admin/inc/v_header');
	$this->load->view('admin/v_angka',$data);
	$this->load->view('admin/inc/v_footer');

}


function save(){

$this->form_validation->set_rules('nama_angka', 'nama angka', 'required');
$this->form_validation->set_rules('nilai', 'nilai', 'required');

if($this->form_validation->run()==FALSE){
$this->session->set_flashdata('error',"Data Gagal Di Tambahkan");
redirect('admin/angka');
}else{

$data=array(
'nama_angka'=>$_POST['nama_angka'],
'nilai'=>$_POST['nilai']
);
}

$this->mm->insert_data($data,'data_angka');
$this->session->set_flashdata('sukses',"Data Berhasil Disimpan");
redirect('admin/angka');

}

 

function edit(){
$id_angka = $this->input->post('id_angka');
$this->form_validation->set_rules('nama_angka', 'nama angka', 'required');
$this->form_validation->set_rules('nilai', 'nilai', 'required');
if($this->form_validation->run() != false){

$data = array(
'nama_angka'=>$_POST['nama_angka'],
'nilai'=>$_POST['nilai']
);
}


$where = array('id_angka' => $id_angka);
$this->mm->update_data($where,$data,'data_angka');
$this->session->set_flashdata('sukses',"Data Berhasil Di ubah");
redirect(base_url().'admin/angka');
}


function hapus($id_angka)

{

if($id_angka==""){

$this->session->set_flashdata('error',"Data Anda Gagal Di Hapus");

redirect('admin/angka');

}else{

$this->db->where('id_angka', $id_angka);

$this->db->delete('data_angka');

$this->session->set_flashdata('sukses',"Data Berhasil Dihapus");

redirect('admin/angka');

}

}



}