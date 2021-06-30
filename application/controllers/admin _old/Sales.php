<?php
defined('BASEPATH') Or exit('No Direct Script Access Allowed');


/**
* 
*/
class Sales extends CI_Controller{

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

	$data['sales'] = $this->mm->get_data('sales')->result();
	$data['kode_sales']=$this->mm->ambil_kodesales();
	$id_sales = $this->id_sales;
	$data['po_notif'] = $this->mm->get_potoko($id_sales)->result();


	$this->load->view('admin/inc/v_header',$data);
	$this->load->view('admin/v_sales',$data);
	$this->load->view('admin/inc/v_footer');

}


function save_sales(){

$this->form_validation->set_rules('email_sales', 'Email Sales', 'required');
$this->form_validation->set_rules('pwd', 'Password', 'required');
$this->form_validation->set_rules('nama_sales', 'Nama Sales', 'required');
$this->form_validation->set_rules('nohp', 'No. Hp', 'required');
$this->form_validation->set_rules('alamat', 'Alamat', 'required');


if($this->form_validation->run()==FALSE){
$this->session->set_flashdata('error',"Data Gagal Di Tambahkan");
redirect('admin/sales');
}else{

$data=array(
'kode_sales'=>$_POST['kode_sales'],
'email_sales'=>$_POST['email_sales'],
'password_encrypt'=>sha1($_POST['pwd']),
'password_text'=>$_POST['pwd'],
'nama_sales'=>$_POST['nama_sales'],
'nohp'=>$_POST['nohp'],
'alamat'=>$_POST['alamat'],
'pembuat'=>$this->nama

);
}

$this->mm->insert_data($data,'sales');
$this->session->set_flashdata('sukses',"Data Berhasil Disimpan");
redirect('admin/sales');

}
      

function edit_sales(){
$id_sales = $this->input->post('id_sales');
$this->form_validation->set_rules('email_sales', 'Email Sales', 'required');
$this->form_validation->set_rules('nama_sales', 'Nama Sales', 'required');
$this->form_validation->set_rules('nohp', 'No. Hp', 'required');
$this->form_validation->set_rules('alamat', 'Alamat', 'required');
if($this->form_validation->run() != false){
$data = array(
'kode_sales'=>$_POST['kode_sales'],
'email_sales'=>$_POST['email_sales'],
'password_encrypt'=>sha1($_POST['pwd']),
'password_text'=>$_POST['pwd'],
'nama_sales'=>$_POST['nama_sales'],
'nohp'=>$_POST['nohp'],
'alamat'=>$_POST['alamat'],
'pembuat'=>$this->nama
);

}
$where = array('id_sales' => $id_sales);
$this->mm->update_data($where,$data,'sales');
$this->session->set_flashdata('sukses',"Data Berhasil Di ubah");
redirect(base_url().'admin/sales');
}


function hapus_sales($id_sales)

{

if($id_sales==""){

$this->session->set_flashdata('error',"Data Anda Gagal Di Hapus");

redirect('admin/sales');

}else{

$this->db->where('id_sales', $id_sales);

$this->db->delete('sales');

$this->session->set_flashdata('sukses',"Data Berhasil Dihapus");

redirect('admin/sales');

}

}


}