<?php
defined('BASEPATH') Or exit('No Direct Script Access Allowed');


/**
* 
*/
class Beranda extends CI_Controller{

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


	$this->load->view('admin/inc/v_header');
	$this->load->view('admin/v_beranda');
	$this->load->view('admin/inc/v_footer');

}


function logout(){

$this->session->sess_destroy();

redirect(base_url().'admin/auth?pesan=logout');


}


}