<?php
defined('BASEPATH') Or exit('No Direct Script Access Allowed');


/**
* 
*/
class Grafik extends CI_Controller{

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



	$data['grafik_pem'] = $this->db->query("select month(tgl_po) as bulan , count(id_po) as total, sum(total_harga) harga from po group by month(tgl_po)")->result();

	$data['grafik_pen'] = $this->db->query("select month(tgl_penjualan) as bulan , count(id_penjualan) as total, sum(total_harga) harga from penjualan group by month(tgl_penjualan)")->result();

	$data['target_pen'] = $this->db->query("select month(waktu_tpenjualan) as bulan , sum(p.total_harga) / atp.target_penjualan * 100 as pencapaian, count(id_penjualan) as total from penjualan p left join atur_target_penjualan atp on month(atp.waktu_tpenjualan) =  month(p.tgl_penjualan) group by month(waktu_tpenjualan)")->result();


	$data['target_omset'] = $this->db->query("select month(waktu_omset) as bulan , sum(p.total_harga) / atp.target_omset * 100 as pencapaian, count(id_po) as total from po p left join atur_target_omset atp on month(atp.waktu_omset) =  month(p.tgl_po) group by month(waktu_omset)")->result();

	$id_sales = $this->id_sales;
	$data['po_notif'] = $this->mm->get_potoko($id_sales)->result();


	$this->load->view('admin/inc/v_header',$data);
	$this->load->view('admin/v_grafik',$data);
	$this->load->view('admin/inc/v_footer');

}









}