<?php
defined('BASEPATH') Or exit('No Direct Script Access Allowed');


/**
* 
*/
class Slide extends CI_Controller{

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

	$data['slide'] = $this->mm->get_data('slide')->result();

	$this->load->view('admin/inc/v_header');
	$this->load->view('admin/v_slide',$data);
	$this->load->view('admin/inc/v_footer');

}

 

function edit(){
$id_slide = $this->input->post('id_slide');
$old_pict =  $this->input->post('old_pict');
$this->form_validation->set_rules('judul_text', 'judul text', 'required');
$this->form_validation->set_rules('tulisan_berjalan', 'tulisan berjalan', 'required');
$this->form_validation->set_rules('deskripsi_text', 'deskripsi text', 'required');
$this->form_validation->set_rules('nama_button1', 'nama button 1', 'required');
$this->form_validation->set_rules('link_button1', 'link button 1', 'required');
$this->form_validation->set_rules('nama_button2', 'nama button 2', 'required');
$this->form_validation->set_rules('link_button2', 'link button 2', 'required');
if($this->form_validation->run() != false){

//konfigurasi upload gambar
$config['upload_path'] = './uploads/slide/';
$config['allowed_types'] = '*';
$config['max_size'] = '*';
$config['file_name'] = 'slide'.time();
$this->load->library('upload',$config);
$this->upload->initialize($config);


$data = array(
'judul_text'=>$_POST['judul_text'],
'tulisan_berjalan'=>$_POST['tulisan_berjalan'],
'deskripsi_text'=>$_POST['deskripsi_text'],
'nama_button1'=>$_POST['nama_button1'],
'link_button1'=>$_POST['link_button1'],
'nama_button2'=>$_POST['nama_button2'],
'link_button2'=>$_POST['link_button2']
);
}

$cek_gambar = $_FILES['gambar_slide']['size'];
if($cek_gambar > 0){
//proses upload edit gambar slide
$this->upload->do_upload('gambar_slide');
@unlink('./uploads/slide/',$old_pict);
$gambar_slide = $this->upload->data();
$data['gambar_slide'] = $gambar_slide['file_name'];
$this->db->where('id_slide', $_POST['id_slide']);
}

$where = array('id_slide' => $id_slide);
$this->mm->update_data($where,$data,'slide');
$this->session->set_flashdata('sukses',"Data Berhasil Di ubah");
redirect(base_url().'admin/slide');
}



}