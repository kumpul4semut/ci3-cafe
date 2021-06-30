<?php
defined('BASEPATH') Or exit('No Direct Script Access Allowed');


/**
* 
*/
class Profil extends CI_Controller{

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

	$data['profil'] = $this->mm->get_data('profil')->result();

	$this->load->view('admin/inc/v_header');
	$this->load->view('admin/v_profil',$data);
	$this->load->view('admin/inc/v_footer');

}

     

function edit(){
$id_profil = $this->input->post('id_profil');
$this->form_validation->set_rules('nama_resto', 'Nama resto', 'required');


if($this->form_validation->run() != false){
$data = array(
'nama_resto'=>$_POST['nama_resto'],
'alamat'=>$_POST['alamat'],
'tentang'=>$_POST['tentang'],
'nama_pemilik'=>$_POST['nama_pemilik']
);

}
$where = array('id_profil' => $id_profil);
$this->mm->update_data($where,$data,'profil');
$this->session->set_flashdata('sukses',"Data Berhasil Di ubah");
redirect(base_url().'admin/profil');
}



}