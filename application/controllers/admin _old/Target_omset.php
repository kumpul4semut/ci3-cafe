<?php
defined('BASEPATH') Or exit('No Direct Script Access Allowed');


/**
* 
*/
class Target_omset extends CI_Controller{

function __construct(){
parent::__construct();
//cek login
if ($this->session->userdata('status') != "login" ){

redirect(base_url().'auth/v2?pesan=belumlogin');
}
$this->id_sales = $this->session->userdata('id_sales');
$this->nama_sales = $this->session->userdata('nama_sales');
$this->level = $this->session->userdata('level');
$this->load->model('m_master', 'mm');
}


function index(){

	$data['target'] = $this->mm->get_data('atur_target_omset')->result();
	$id_sales = $this->id_sales;
	$data['po_notif'] = $this->mm->get_potoko($id_sales)->result();


	$this->load->view('admin/inc/v_header',$data);
	$this->load->view('admin/v_ato',$data);
	$this->load->view('admin/inc/v_footer');

}


function save_target(){

$this->form_validation->set_rules('waktu_omset', 'Waktu Omset', 'required');
$this->form_validation->set_rules('target_omset', 'Target Omset', 'required');



if($this->form_validation->run()==FALSE){
$this->session->set_flashdata('error',"Data Gagal Di Tambahkan");
redirect('admin/target_omset');
}else{

$data=array(
'waktu_omset'=>$_POST['waktu_omset'],
'target_omset'=>$_POST['target_omset'],
'pembuat'=>$this->nama_sales

);
}

$this->mm->insert_data($data,'atur_target_omset');
$this->session->set_flashdata('sukses',"Data Berhasil Disimpan");
redirect('admin/target_omset');

}

function edit_target(){
$id_omset = $this->input->post('id_omset');
$this->form_validation->set_rules('waktu_omset', 'Waktu Omset', 'required');
$this->form_validation->set_rules('target_omset', 'Target Omset', 'required');
if($this->form_validation->run() != false){
$data = array(
'waktu_omset'=>$_POST['waktu_omset'],
'target_omset'=>$_POST['target_omset'],
'pembuat'=>$this->nama_sales
);

}
$where = array('id_omset' => $id_omset);
$this->mm->update_data($where,$data,'atur_target_omset');
$this->session->set_flashdata('sukses',"Data Berhasil Di ubah");
redirect(base_url().'admin/target_omset');
}


function hapus_target($id_omset)

{

if($id_omset==""){

$this->session->set_flashdata('error',"Data Anda Gagal Di Hapus");

redirect('admin/target_omset');

}else{

$this->db->where('id_omset', $id_omset);

$this->db->delete('atur_target_omset');

$this->session->set_flashdata('sukses',"Data Berhasil Dihapus");

redirect('admin/target_omset');

}

}





}