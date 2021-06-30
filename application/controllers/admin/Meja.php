<?php
defined('BASEPATH') Or exit('No Direct Script Access Allowed');


/**
* 
*/
class Meja extends CI_Controller{

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

	$data['meja'] = $this->mm->get_data('meja')->result();

	$this->load->view('admin/inc/v_header');
	$this->load->view('admin/v_meja',$data);
	$this->load->view('admin/inc/v_footer');

}


function simpan(){

$this->form_validation->set_rules('nama_meja', 'Nama Meja', 'required');

if($this->form_validation->run()==FALSE){
$this->session->set_flashdata('error',"Data Gagal Di Tambahkan");
redirect('admin/meja');
}else{

$data=array(
'nama_meja'=>$_POST['nama_meja']
);
}

$this->mm->insert_data($data,'meja');
$this->session->set_flashdata('sukses',"Data Berhasil Disimpan");
redirect('admin/meja');

}
      

function edit(){
$id_meja = $this->input->post('id_meja');
$this->form_validation->set_rules('nama_meja', 'Nama meja', 'required');
if($this->form_validation->run() != false){
$data = array(
'nama_meja'=>$_POST['nama_meja'],
);

}
$where = array('id_meja' => $id_meja);
$this->mm->update_data($where,$data,'meja');
$this->session->set_flashdata('sukses',"Data Berhasil Di ubah");
redirect(base_url().'admin/meja');
}


function hapus($id_meja)

{

if($id_meja==""){

$this->session->set_flashdata('error',"Data Anda Gagal Di Hapus");

redirect('admin/meja');

}else{

$this->db->where('id_meja', $id_meja);

$this->db->delete('meja');

$this->session->set_flashdata('sukses',"Data Berhasil Dihapus");

redirect('admin/meja');

}

}





}