<?php
defined('BASEPATH') or exit('No Direct Script Access Allowed');


/**
 * 
 */
class Laporan extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		//cek login
		if ($this->session->userdata('status') != "login") {

			redirect(base_url() . 'admin/auth?pesan=belumlogin');
		}
		$this->level = $this->session->userdata('level');
		$this->id_user = $this->session->userdata('id_user');
		$this->nama = $this->session->userdata('nama');
		$this->load->model('m_master', 'mm');
	}


	function index()
	{

		$this->load->view('admin/inc/v_header');
		$this->load->view('admin/v_laporan');
		$this->load->view('admin/inc/v_footer');
	}

	public function print_laporan()
	{
		$bulan = $this->input->post('bln');
		$tahun = $this->input->post('tahun');
		$monthName = date('F', mktime(0, 0, 0, $bulan, 10));
		$this->data['pesanan'] = $this->db->select('pesanan.*, meja.nama_meja, pelanggan.nama_pelanggan')
			->from('pesanan')
			->join('meja', 'pesanan.id_meja	 = meja.id_meja', 'left')
			->join('pelanggan', 'pesanan.id_pelanggan	 = pelanggan.id_pelanggan', 'left')
			->where('MONTH(pesanan.tgl_pemesanan)', $bulan)
			->where('YEAR(pesanan.tgl_pemesanan)', $tahun)
			->get()->result();
		foreach ($this->data['pesanan'] as $key =>  $d_pesanan) {
			$this->db->select('detail_pesanan.*, daftar_menu.nama_menu, daftar_menu.harga');
			$this->db->from('detail_pesanan');
			$this->db->join('daftar_menu', 'detail_pesanan.id_menu = daftar_menu.id_menu', 'left');
			$this->db->where('detail_pesanan.kode_pesanan', $d_pesanan->kode_pesanan);
			$this->data['pesanan'][$key]->menu_select = $this->db->get()->result();
		}

		$this->data['bulan'] = $monthName;
		error_reporting(0);
		require FCPATH . "vendor/autoload.php";

		$dompdf = new Dompdf\Dompdf();
		$html = $this->load->view("admin/v_print_laporan", $this->data, true);

		$dompdf->loadHTML($html);
		$dompdf->render();
		$filename = "Laporan";
		$dompdf->stream($filename . '.pdf', array('Attachment' => 0));
	}
}
