<?php
defined('BASEPATH') Or exit('No Direct Script Access Allowed');


/**
* 
*/
class Tentang extends CI_Controller{

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

	$data['tentang'] = $this->mm->get_data('tentang')->result();

	$this->load->view('admin/inc/v_header');
	$this->load->view('admin/v_tentang',$data);
	$this->load->view('admin/inc/v_footer');

}

function edit(){
$id_tentang= $this->input->post('id_tentang');
$old_pict =  $this->input->post('old_pict');



$this->form_validation->set_rules('judul_tentang', 'judul tentang', 'required');
if($this->form_validation->run() != false){

//konfigurasi upload gambar
$config['upload_path'] = './uploads/tentang/';
$config['allowed_types'] = '*';
$config['max_size'] = '*';
$config['file_name'] = 'tentang'.time();
$this->load->library('upload',$config);
$this->upload->initialize($config);

$data = array(
'judul_tentang'=>$_POST['judul_tentang'],
'slogan_tentang'=>$_POST['slogan_tentang'],
'isi_tentang'=>$_POST['isi_tentang'],
'tujuan'=>$_POST['tujuan'],
'visi'=>$_POST['visi'],
'misi'=>$_POST['misi'],
'gambar_tentang' => $image['file_name']
);
}

$cek_gambar = $_FILES['gambar_tentang']['size'];
if($cek_gambar > 0){
//proses upload edit gambar produk
$this->upload->do_upload('gambar_tentang');
@unlink('./uploads/tentang/',$old_pict);
$gambar_tentang= $this->upload->data();
$data['gambar_tentang'] = $gambar_tentang['file_name'];
$this->db->where('id_tentang', $_POST['id_tentang']);
}




$where = array('id_tentang' => $id_tentang);
$this->mm->update_data($where,$data,'tentang');
$this->session->set_flashdata('sukses',"Data Berhasil Di ubah");
redirect(base_url().'admin/tentang');
}



}