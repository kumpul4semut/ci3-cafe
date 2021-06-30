<?php
defined('BASEPATH') Or exit('No Direct Script Access Allowed');


/**
* 
*/
class Sambutan_waksek extends CI_Controller{

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

	$data['sambutan'] = $this->mm->get_data('sambutan_wakil')->result();

	$this->load->view('admin/inc/v_header');
	$this->load->view('admin/v_sambutanwaksek',$data);
	$this->load->view('admin/inc/v_footer');

}


function save(){

$this->form_validation->set_rules('nama_wakil', 'nama wakil', 'required');
$this->form_validation->set_rules('isi_sambutan2', 'isi sambutan', 'required');

if($this->form_validation->run()==FALSE){
$this->session->set_flashdata('error',"Data Gagal Di Tambahkan");
redirect('admin/sambutan_waksek');
}else{

$data=array(
'nama_wakil'=>$_POST['nama_wakil'],
'isi_sambutan2'=>$_POST['isi_sambutan2']
);
}

$this->mm->insert_data($data,'sambutan_wakil');
$this->session->set_flashdata('sukses',"Data Berhasil Disimpan");
redirect('admin/sambutan_waksek');

}

 

function edit(){
$id_sambutan2 = $this->input->post('id_sambutan2');
$this->form_validation->set_rules('nama_wakil', 'nama wakil', 'required');
$this->form_validation->set_rules('isi_sambutan2', 'isi sambutan2', 'required');
if($this->form_validation->run() != false){

$data = array(
'nama_wakil'=>$_POST['nama_wakil'],
'isi_sambutan2'=>$_POST['isi_sambutan2']
);
}


$where = array('id_sambutan2' => $id_sambutan2);
$this->mm->update_data($where,$data,'sambutan_wakil');
$this->session->set_flashdata('sukses',"Data Berhasil Di ubah");
redirect(base_url().'admin/sambutan_waksek');
}

function hapus($id_sambutan2)

{

if($id_sambutan2==""){

$this->session->set_flashdata('error',"Data Anda Gagal Di Hapus");

redirect('admin/sambutan_waksek');

}else{

$this->db->where('id_sambutan2', $id_sambutan2);

$this->db->delete('sambutan_wakil');

$this->session->set_flashdata('sukses',"Data Berhasil Dihapus");

redirect('admin/sambutan_waksek');

}

}



}