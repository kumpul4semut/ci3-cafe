<?php
defined('BASEPATH') Or exit('No Direct Script Access Allowed');


/**
* 
*/
class Pengaturan extends CI_Controller{

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

	$data['pengaturan'] = $this->mm->get_data('pengaturan')->result();

	$this->load->view('admin/inc/v_header');
	$this->load->view('admin/v_pengaturan',$data);
	$this->load->view('admin/inc/v_footer');

}

function edit(){
$id_pengaturan= $this->input->post('id_pengaturan');
$old_pict =  $this->input->post('old_pict');
$old_pict2 =  $this->input->post('old_pict2');


$this->form_validation->set_rules('nama_website', 'nama_website', 'required');
if($this->form_validation->run() != false){

//konfigurasi upload gambar
$config['upload_path'] = './uploads/pengaturan/';
$config['allowed_types'] = '*';
$config['max_size'] = '*';
$config['file_name'] = 'pengaturan'.time();
$this->load->library('upload',$config);
$this->upload->initialize($config);

$data = array(
'nama_website'=>$_POST['nama_website'],
'kata_kunci'=>$_POST['kata_kunci'],
'tentang'=>$_POST['tentang'],
'alamat'=>$_POST['alamat'],
'email'=>$_POST['email'],
'telepon'=>$_POST['telepon'],
'maps'=>$_POST['maps'],
'copyright'=>$_POST['copyright'],
'color1'=>$_POST['color1'],
'color2'=>$_POST['color2'],
'color3'=>$_POST['color3']
);
}

$cek_gambar = $_FILES['logo']['size'];
if($cek_gambar > 0){
//proses upload edit gambar produk
$this->upload->do_upload('logo');
@unlink('./uploads/pengaturan/',$old_pict);
$logo= $this->upload->data();
$data['logo'] = $logo['file_name'];
$this->upload->do_upload('icon');
@unlink('./uploads/pengaturan/',$old_pict2);
$icon= $this->upload->data();
$data['icon'] = $icon['file_name'];
$this->db->where('id_pengaturan', $_POST['id_pengaturan']);
}




$where = array('id_pengaturan' => $id_pengaturan);
$this->mm->update_data($where,$data,'pengaturan');
$this->session->set_flashdata('sukses',"Data Berhasil Di ubah");
redirect(base_url().'admin/pengaturan');
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