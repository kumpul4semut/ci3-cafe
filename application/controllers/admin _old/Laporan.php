<?php
defined('BASEPATH') Or exit('No Direct Script Access Allowed');


/**
* 
*/
class Laporan extends CI_Controller{

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
$this->load->helper('tgl_indo');
}


function index(){

	$data['target'] = $this->mm->get_data('atur_target_penjualan')->result();
	$id_sales = $this->id_sales;
	$data['po_notif'] = $this->mm->get_potoko($id_sales)->result();


	$this->load->view('admin/inc/v_header',$data);
	$this->load->view('admin/v_laporan',$data);
	$this->load->view('admin/inc/v_footer');

}


public function laporan_pen(){



error_reporting(0);
require FCPATH . "vendor/autoload.php";

$date1 = $this->input->post('date1');
$date2 = $this->input->post('date2');

$lpp = $this->mm->pdf_pen($date1,$date2);

$lpp->periode1 = $this->input->post('date1');
$lpp->periode2 = $this->input->post('date2');



//print_r($lpp);
//die();



$dompdf = new Dompdf\Dompdf();
$html = $this->load->view("admin/v_print_laporan_pen", [
"lpp" => $lpp
], true);

$dompdf->loadHTML($html);
$dompdf->render();
$filename = "Laporan Penjualan";
$dompdf->stream($filename . '.pdf',array('Attachment'=>0));



}



public function laporan_pem(){



error_reporting(0);
require FCPATH . "vendor/autoload.php";

$date1 = $this->input->post('date1');
$date2 = $this->input->post('date2');

$lpp = $this->mm->pdf_pem($date1,$date2);

$lpp->periode1 = $this->input->post('date1');
$lpp->periode2 = $this->input->post('date2');



//print_r($lpp);
//die();



$dompdf = new Dompdf\Dompdf();
$html = $this->load->view("admin/v_print_laporan_pem", [
"lpp" => $lpp
], true);

$dompdf->loadHTML($html);
$dompdf->render();
$filename = "Laporan Pembelian";
$dompdf->stream($filename . '.pdf',array('Attachment'=>0));



}



public function target_pen(){



error_reporting(0);
require FCPATH . "vendor/autoload.php";

$date1 = $this->input->post('date1');

//$q = $this->db->query("select  atp.* from atur_target_penjualan atp where DATE_FORMAT(waktu_tpenjualan ,'%Y-%m')='2020-12' ")->row();

//print_r($q);
//die();

$lpp = $this->mm->pdf_target_pen($date1);

//$lpp->periode1 = $this->input->post('date1');




//print_r($lpp);
//die();



$dompdf = new Dompdf\Dompdf();
$html = $this->load->view("admin/v_print_target_pen", [
"lpp" => $lpp
], true);

$dompdf->loadHTML($html);
$dompdf->render();
$filename = "Laporan Target Penjualan";
$dompdf->stream($filename . '.pdf',array('Attachment'=>0));



}


public function target_omset(){



error_reporting(0);
require FCPATH . "vendor/autoload.php";

$date1 = $this->input->post('date1');

//$q = $this->db->query("select  atp.* from atur_target_penjualan atp where DATE_FORMAT(waktu_tpenjualan ,'%Y-%m')='2020-12' ")->row();

//print_r($q);
//die();

$lpp = $this->mm->pdf_target_omset($date1);

//$lpp->periode1 = $this->input->post('date1');




//print_r($lpp);
//die();



$dompdf = new Dompdf\Dompdf();
$html = $this->load->view("admin/v_print_target_omset", [
"lpp" => $lpp
], true);

$dompdf->loadHTML($html);
$dompdf->render();
$filename = "Laporan Target Omset";
$dompdf->stream($filename . '.pdf',array('Attachment'=>0));



}






}