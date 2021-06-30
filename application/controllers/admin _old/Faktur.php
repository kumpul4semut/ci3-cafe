<?php
defined('BASEPATH') Or exit('No Direct Script Access Allowed');


/**
* 
*/
class Faktur extends CI_Controller{

function __construct(){
parent::__construct();
//cek login
if ($this->session->userdata('status') != "login" ){
redirect(base_url().'auth?pesan=belumlogin');
}
$this->nama = $this->session->userdata('nama');
$this->id_sales = $this->session->userdata('id_sales');
$this->id = $this->session->userdata('id_pengguna');
$this->level = $this->session->userdata('level');
$this->load->model('m_master', 'mm');
}


function index(){

	
	$id_sales = $this->id_sales;
	$data['po']=$this->mm->get_potoko($id_sales)->result();
	$data['faktur']=$this->mm->get_faktur()->result();
	$data['kode_faktur']=$this->mm->ambil_kodefaktur();

	$id_sales = $this->id_sales;
	$data['po_notif'] = $this->mm->get_potoko($id_sales)->result();


	$this->load->view('admin/inc/v_header',$data);
	$this->load->view('admin/v_faktur',$data);
	$this->load->view('admin/inc/v_footer');

}

function print_faktur($kode_po){

error_reporting(0);
require FCPATH . "vendor/autoload.php";

$faktur = $this->mm->pdf($kode_po);

//print_r($faktur);

//exit();



$dompdf = new Dompdf\Dompdf();
$html = $this->load->view("admin/v_print_faktur", [
"faktur" => $faktur
], true);

$dompdf->loadHTML($html);
$dompdf->render();
$filename = "Faktur";
$dompdf->stream($filename . '.pdf',array('Attachment'=>0));

}

function save_faktur(){

$this->form_validation->set_rules('kode_po', 'Kode PO', 'required');
$this->form_validation->set_rules('jatuh_tempo', 'Jatuh Tempo', 'required');



if($this->form_validation->run()==FALSE){
$this->session->set_flashdata('error',"Data Gagal Di Tambahkan");
redirect('admin/faktur_sales');
}else{


$data=array(
'kode_faktur'=>$_POST['kode_faktur'],
'kode_po'=>$_POST['kode_po'],
'jatuh_tempo'=>$_POST['jatuh_tempo'],
'pembuat'=>$this->nama


);
}

$this->mm->insert_data($data,'faktur');
$this->session->set_flashdata('sukses',"Data Berhasil Disimpan");
redirect('admin/faktur_sales');

	
}

function bayar_faktur(){

$this->form_validation->set_rules('dibayar', 'Bayar', 'required');

$data['po']=$this->mm->get_data('po')->result();



$kode_faktur = $this->input->post("kode_faktur");

$bayar  = $this->db->query('select sum(dibayar) as dibayar from faktur_pembayaran')->result();

foreach ($bayar as $b) {
	$total_bayar = $b->dibayar +  $this->input->post("dibayar");
	$blmdibayar = $this->input->post("total_harga") - $total_bayar;
}


if ($blmdibayar == 0) {
	$status = "LUNAS";
} 

if ($blmdibayar > 0) {
	$status = "TAGIHAN";
} 



if($this->form_validation->run()==FALSE){
$this->session->set_flashdata('error',"Data Gagal Di Tambahkan");
redirect('admin/faktur');
}else{


$data=array(
'kode_faktur'=>$_POST['kode_faktur'],
'kode_po'=>$_POST['kode_po'],
'tgl_bayar'=>date('Y-m-d'),
'dibayar'=>$_POST['dibayar'],
'blm_dibayar'=>$blmdibayar,
'pembuat'=>$this->nama


);

}

$this->mm->insert_data($data,'faktur_pembayaran');

$data2=array(
'kode_faktur'=>$_POST['kode_faktur'],
'kode_po'=>$_POST['kode_po'],
'jatuh_tempo'=>$_POST['jatuh_tempo'],
'pembuat'=>$_POST['pembuat'],
'status'=>$status
);


//print_r($data2);
//die();

$where = array('kode_faktur' => $kode_faktur);

$this->mm->update_data($where,$data2,'faktur');

$data_notif = array(
		'from_id' => $this->id , 
		'to_id' => $_POST['id_sales'] ,
		'rel_id'=>$_POST['kode_po'], 
		'tipe_notifikasi' => 'BAYAR' , 
		'deskripsi_notifikasi' => $this->nama.' Membayar '.$_POST['kode_faktur'] , 
		'read' => '0' , 

	);

$this->mm->insert_data($data_notif,'notifikasi');	

$this->session->set_flashdata('sukses',"Data Berhasil Disimpan");
redirect('admin/faktur');

}


function hapus_faktur($id_faktur)

{

if($id_faktur==""){

$this->session->set_flashdata('error',"Data Anda Gagal Di Hapus");

redirect('admin/faktur_sales');

}else{

$this->db->where('id_faktur', $id_faktur);

$this->db->delete('faktur');

$this->session->set_flashdata('sukses',"Data Berhasil Dihapus");

redirect('admin/faktur_sales');

}

}







}