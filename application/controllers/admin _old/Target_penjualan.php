<?php
defined('BASEPATH') Or exit('No Direct Script Access Allowed');


/**
* 
*/
class Target_penjualan extends CI_Controller{

function __construct(){
parent::__construct();
//cek login
if ($this->session->userdata('status') != "login" ){

redirect(base_url().'auth?pesan=belumlogin');
}
$this->id_sales = $this->session->userdata('id_sales');
$this->nama = $this->session->userdata('nama');
$this->level = $this->session->userdata('level');
$this->load->model('m_master', 'mm');
}


function index(){

	$data['target'] = $this->mm->get_data('atur_target_penjualan')->result();
	$id_sales = $this->id_sales;
	$data['po_notif'] = $this->mm->get_potoko($id_sales)->result();


	$this->load->view('admin/inc/v_header',$data);
	$this->load->view('admin/v_atp',$data);
	$this->load->view('admin/inc/v_footer');

}


function save_target(){

$this->form_validation->set_rules('waktu_tpenjualan', 'Waktu Penjualan', 'required');
$this->form_validation->set_rules('target_penjualan', 'Target Penjualan', 'required');



if($this->form_validation->run()==FALSE){
$this->session->set_flashdata('error',"Data Gagal Di Tambahkan");
redirect('admin/target_penjualan');
}else{

$data=array(
'waktu_tpenjualan'=>$_POST['waktu_tpenjualan'],
'target_penjualan'=>$_POST['target_penjualan'],
'pembuat'=>$this->nama

);
}

$this->mm->insert_data($data,'atur_target_penjualan');
$this->session->set_flashdata('sukses',"Data Berhasil Disimpan");
redirect('admin/target_penjualan');

}

function edit_target(){
$id_tpenjualan = $this->input->post('id_tpenjualan');
$this->form_validation->set_rules('waktu_tpenjualan', 'Waktu Penjualan', 'required');
$this->form_validation->set_rules('target_penjualan', 'Target Penjualan', 'required');
if($this->form_validation->run() != false){
$data = array(
'waktu_tpenjualan'=>$_POST['waktu_tpenjualan'],
'target_penjualan'=>$_POST['target_penjualan'],
'pembuat'=>$this->nama
);

}
$where = array('id_tpenjualan' => $id_tpenjualan);
$this->mm->update_data($where,$data,'atur_target_penjualan');
$this->session->set_flashdata('sukses',"Data Berhasil Di ubah");
redirect(base_url().'admin/target_penjualan');
}


function hapus_target($id_tpenjualan)

{

if($id_tpenjualan==""){

$this->session->set_flashdata('error',"Data Anda Gagal Di Hapus");

redirect('admin/target_penjualan');

}else{

$this->db->where('id_tpenjualan', $id_tpenjualan);

$this->db->delete('atur_target_penjualan');

$this->session->set_flashdata('sukses',"Data Berhasil Dihapus");

redirect('admin/target_penjualan');

}

}





}