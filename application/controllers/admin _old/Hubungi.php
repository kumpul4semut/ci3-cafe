<?php
defined('BASEPATH') Or exit('No Direct Script Access Allowed');


/**
* 
*/
class Hubungi extends CI_Controller{

function __construct(){
parent::__construct();
//cek login
if ($this->session->userdata('status') != "login" ){

redirect(base_url().'admin/auth?pesan=belumlogin');
}
$this->id_admin = $this->session->userdata('id_admin');
$this->nama_admin = $this->session->userdata('nama_admin');
$this->load->model('m_master', 'mm');

}


function index(){

	$data['hubungi'] = $this->mm->get_data('kontak')->result();

	$this->load->view('admin/inc/v_header');
	$this->load->view('admin/v_hubungi',$data);
	$this->load->view('admin/inc/v_footer');

}




}