<?php
defined('BASEPATH') Or exit('No Direct Script Access Allowed');


/**
* 
*/
class Sambutan_kepsek extends CI_Controller{

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

	$data['sambutan'] = $this->mm->get_data('sambutan_kepsek')->result();

	$this->load->view('admin/inc/v_header');
	$this->load->view('admin/v_sambutankepsek',$data);
	$this->load->view('admin/inc/v_footer');

}

 

function edit(){
$id_sambutan1 = $this->input->post('id_sambutan1');
$old_pict =  $this->input->post('old_pict');
$this->form_validation->set_rules('judul_sambutan', 'judul sambutan', 'required');
$this->form_validation->set_rules('isi_sambutan', 'isi sambutan', 'required');
$this->form_validation->set_rules('nama_kepsek', 'nama kepsek', 'required');
if($this->form_validation->run() != false){

//konfigurasi upload gambar
$config['upload_path'] = './uploads/sambutan_kepsek/';
$config['allowed_types'] = '*';
$config['max_size'] = '*';
$config['file_name'] = 'sambutan'.time();
$this->load->library('upload',$config);
$this->upload->initialize($config);


$data = array(
'judul_sambutan'=>$_POST['judul_sambutan'],
'isi_sambutan'=>$_POST['isi_sambutan'],
'nama_kepsek'=>$_POST['nama_kepsek']
);
}

$cek_gambar = $_FILES['gambar_sambutan']['size'];
if($cek_gambar > 0){
//proses upload edit gambar slide
$this->upload->do_upload('gambar_sambutan');
@unlink('./uploads/sambutan_kepsek/',$old_pict);
$gambar_sambutan = $this->upload->data();
$data['gambar_sambutan'] = $gambar_sambutan['file_name'];
$this->db->where('id_sambutan1', $_POST['id_sambutan1']);
}

$where = array('id_sambutan1' => $id_sambutan1);
$this->mm->update_data($where,$data,'sambutan_kepsek');
$this->session->set_flashdata('sukses',"Data Berhasil Di ubah");
redirect(base_url().'admin/sambutan_kepsek');
}



}