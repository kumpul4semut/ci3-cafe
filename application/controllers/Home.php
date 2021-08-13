<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_master', 'mm');
		$this->load->helper('captcha');
		$this->data['profile'] = $this->db->get_where('profil', ['id_profil' => 1])->row();
	}

	public function index()
	{
		session_destroy();
		unset($_SESSION);
		$this->load->view('v_header', $this->data);
		$this->load->view('v_home', $this->data);
		$this->load->view('v_footer', $this->data, $this->data);
	}

	public function cari_jadwal()
	{
		$this->form_validation->set_rules('tgl_pemesanan', 'Tanggal Pemesanan', 'required');
		$this->form_validation->set_rules('jam_pesan', 'Jam Pesan', 'required');

		if ($this->session->userdata('tgl_pemesanan') != '') {
			// $pesanan = $this->db->get_where('pesanan', ['tgl_pemesanan' => $this->session->userdata('tgl_pemesanan'), 'jam_pesan' => $this->session->userdata('jam_pesan')])->result();
			$this->db->where('status', 'terbooking');
			$this->db->or_where('status', 'proses');
			$pesanan = $this->db->get('pesanan')->result();
			$this->data['meja'] = $this->mm->get_data('meja')->result();
			foreach ($pesanan as $d_psn) {
				foreach ($this->data['meja'] as $key => $d_meja) {
					if ($d_psn->id_meja == $d_meja->id_meja) {
						$this->data['meja'][$key]->terbooking = true;
					}
				}
			}

			$this->data['tgl_pemesanan'] = $this->session->userdata('tgl_pemesanan');
			$this->data['jam_pesan'] = $this->session->userdata('jam_pesan');
			$this->data['daftar_menu'] = $this->mm->get_data('daftar_menu')->result();

			$this->load->view('v_header', $this->data);
			$this->load->view('v_meja', $this->data);
			$this->load->view('v_footer', $this->data);
		} else {
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', "Ada Error");
				$this->index();
			} else {
				// cek pesanan berdasarkan cari tadi
				$tgl_pemesanan = $_POST['tgl_pemesanan'];
				$jam_pesan = $_POST['jam_pesan'];


				$array = array(
					'tgl_pemesanan' => $tgl_pemesanan,
					'jam_pesan' => $jam_pesan,
				);

				$this->session->set_userdata($array);


				// $pesanan = $this->db->get_where('pesanan', ['tgl_pemesanan' => $tgl_pemesanan, 'jam_pesan' => $jam_pesan])->result();
				$this->db->where('status', 'terbooking');
				$this->db->or_where('status', 'proses');
				$pesanan = $this->db->get('pesanan')->result();
				$this->data['meja'] = $this->mm->get_data('meja')->result();
				foreach ($pesanan as $d_psn) {
					foreach ($this->data['meja'] as $key => $d_meja) {
						if ($d_psn->id_meja == $d_meja->id_meja) {
							$this->data['meja'][$key]->terbooking = true;
						}
					}
				}

				$this->data['tgl_pemesanan'] = $_POST['tgl_pemesanan'];
				$this->data['jam_pesan'] = $_POST['jam_pesan'];
				$this->data['daftar_menu'] = $this->mm->get_data('daftar_menu')->result();

				$this->load->view('v_header', $this->data);
				$this->load->view('v_meja', $this->data);
				$this->load->view('v_footer', $this->data);
			}
		}
	}

	public function checkout()
	{
		$this->form_validation->set_rules('id_meja', 'Meja', 'required');
		$this->form_validation->set_rules('menu[]', 'Menu', 'required');

		if ($this->session->userdata('total_bayar')) {
			$config_captcha = array(
				'img_path'  => './captcha/',
				'img_url'  => base_url() . 'captcha/',
				'img_width'  => 200,
				'img_height' => 40,
				'word_length'  => 3,
				'font_size'     => 40,
				'border' => 0,
				'expiration' => 7200,
				'pool'   => '0123456789',
				'colors' => array(
					'background' => array(9, 9, 9),
					'border' => array(252, 3, 33),
					'text' => array(255, 255, 255),
					'grid' => array(252, 3, 33)
				)
			);

			// create captcha image
			$cap = create_captcha($config_captcha);

			// store image html code in a variable
			$this->data['img'] = $cap['image'];

			// store the captcha word in a session
			$this->session->set_userdata('mycaptcha', $cap['word']);


			$this->data['total_bayar'] = $this->session->userdata('total_bayar');
			$this->data['meja_select'] = $this->session->userdata('meja_select');
			$this->data['daftar_menu'] = $this->session->userdata('daftar_menu');
			// $this->data['metode'] = $this->session->userdata('metode');

			$array = array(
				'total_bayar' => $this->data['total_bayar'],
				'meja_select' => $this->data['meja_select'],
			);

			$this->session->set_userdata($array);


			$this->load->view('v_header', $this->data);
			$this->load->view('v_bayar', $this->data);
			$this->load->view('v_footer', $this->data);
		} else {
			if ($this->form_validation->run() == FALSE) {
				redirect($_SERVER["HTTP_REFERER"]);
			} else {
				$config_captcha = array(
					'img_path'  => './captcha/',
					'img_url'  => base_url() . 'captcha/',
					'img_width'  => 200,
					'img_height' => 40,
					'word_length'  => 3,
					'font_size'     => 40,
					'border' => 0,
					'expiration' => 7200,
					'pool'   => '0123456789',
					'colors' => array(
						'background' => array(9, 9, 9),
						'border' => array(252, 3, 33),
						'text' => array(255, 255, 255),
						'grid' => array(252, 3, 33)
					)
				);

				// create captcha image
				$cap = create_captcha($config_captcha);

				// store image html code in a variable
				$this->data['img'] = $cap['image'];

				// store the captcha word in a session
				$this->session->set_userdata('mycaptcha', $cap['word']);

				$menu_select = $_POST['menu'];
				$menus = [];
				foreach ($menu_select as $id_menu) {
					$menu = $this->db->get_where('daftar_menu', ['id_menu' => $id_menu])->row();
					$menu->jumlah = $_POST['jumlah_' . $id_menu];
					array_push($menus, $menu);
				}
				$total_bayar = 0;
				foreach ($menu_select as $id_menu) {
					$daftar_menu = $this->db->get_where('daftar_menu', ['id_menu' => $id_menu])->row();
					if ($_POST['jumlah_' . $id_menu] > $daftar_menu->stok) {
						$this->session->set_flashdata('error', "Jumlah pesanan melebihi stok");
						redirect('home/cari_jadwal');
					}
					$total_bayar += ($daftar_menu->harga * $_POST['jumlah_' . $id_menu]);
				}
				$this->data['total_bayar'] = $total_bayar;
				$this->data['meja_select'] = $this->db->get_where('meja', ['id_meja' => $_POST['id_meja']])->row();
				$this->data['daftar_menu'] = $menus;
				// $this->data['metode'] = $this->db->get_where('metode')->result();;

				$array = array(
					'total_bayar' => $this->data['total_bayar'],
					'meja_select' => $this->data['meja_select'],
					'daftar_menu' => $this->data['daftar_menu'],
					// 'metode' => $this->data['metode'],
				);

				$this->session->set_userdata($array);


				$this->load->view('v_header', $this->data);
				$this->load->view('v_bayar', $this->data);
				$this->load->view('v_footer', $this->data);
			}
		}
	}

	public function getNewCaptcha()
	{
		$config_captcha = array(
			'img_path'  => './captcha/',
			'img_url'  => base_url() . 'captcha/',
			'img_width'  => 200,
			'img_height' => 40,
			'word_length'  => 3,
			'font_size'     => 40,
			'border' => 0,
			'expiration' => 7200,
			'pool'   => '0123456789',
			'colors' => array(
				'background' => array(9, 9, 9),
				'border' => array(252, 3, 33),
				'text' => array(255, 255, 255),
				'grid' => array(252, 3, 33)
			)
		);

		// create captcha image
		$cap = create_captcha($config_captcha);
		$this->session->set_userdata('mycaptcha', $cap['word']);

		// store image html code in a variable
		echo $cap['image'];
	}

	public function bayar()
	{
		$secutity_code = $this->input->post('secutity_code');
		$mycaptcha = $this->session->userdata('mycaptcha');

		if ($this->input->post() && ($secutity_code == $mycaptcha)) {

			// create pelanggan
			$id_pelanggan = $this->save_pelanggan();

			//create pesanan 
			$id_pesanan = $this->save_pesanan($id_pelanggan);

			// create notifikasi
			$meja = $this->db->get_where('meja', ['id_meja' =>  $this->db->get_where('pesanan', ['id_pesanan' => $id_pesanan])->row()->id_meja])->row()->nama_meja;

			$isi = 'Pesanan ' . $meja . ' menunggu konfirmasi';

			// create notif
			$data_notif = [
				'dari' => 'pelanggan',
				'ke' => $this->db->get_where('user', ['level' => 'kasir'])->row()->id_user,
				'judul' => 'Pesanan online menunggu',
				'isi' => $isi,
				'status_read' => 0,
			];
			$this->db->insert('notifikasi', $data_notif);


			$where_pesanan['id_pesanan'] = $id_pesanan;
			$pesanan = $this->db->get_where('pesanan', $where_pesanan)->row();
			$kode_pesanan = $pesanan->kode_pesanan;
			$this->save_detail_pesanan($kode_pesanan);

			// pesan akan muncul jika captcha benar
			$this->session->set_flashdata('sukses', '<p style="color:green;"><b>Data Berhasil di simpan</b></p>');
			redirect('home/checkout');
		} else {
			// pesan akan muncul jika captcha salah
			$this->session->set_flashdata('error', '<p style="color:red;"><b>Captcha salah </b></p>');
			redirect('home/checkout');
		}
	}

	protected function save_pelanggan()
	{
		$data['nama_pelanggan'] = $_POST['nama_pelanggan'];
		$data['email'] = $_POST['email'];
		$data['no_tlp'] = $_POST['no_tlp'];
		return $this->mm->insert($data, 'pelanggan');
	}

	protected function save_pesanan($id_pelanggan)
	{
		$jumlah_pesan = 0;
		$menu_select = $this->session->userdata('daftar_menu');
		foreach ($menu_select as $data) {
			$jumlah_pesan += $data->jumlah;
		}

		// kode_pesanan
		$config_psn['kolom'] = 'kode_pesanan';
		$config_psn['table'] = 'pesanan';
		$config_psn['kode'] = 'PSN';

		// kode_transaksi
		$config_trx['kolom'] = 'kode_transaksi';
		$config_trx['table'] = 'transaksi';
		$config_trx['kode'] = 'TRX';

		// save ke table transaksi
		// $data_trx['id_metode'] =  $_POST['id_metode'];
		$data_trx['kode_transaksi'] =  $this->mm->genkode($config_trx);
		$data_trx['jumlah_pesan'] = $jumlah_pesan;
		$data_trx['jumlah_harga'] = rp_to_number($_POST['total_bayar']);
		// $data_trx['jumlah_bayar'] = $_POST['jumlah_bayar'];
		$data_trx['bukti_bayar'] = $this->_uploadImage();
		$id_transaksi = $this->mm->insert($data_trx, 'transaksi');
		$kode_transaksi =  $this->db->get_where('transaksi', ['id_transaksi' => $id_transaksi])->row()->kode_transaksi;

		// save ke table pesanan
		$data = [
			'id_pelanggan' => $id_pelanggan,
			'id_meja' => $_POST['id_meja'],
			'kode_pesanan' => $this->mm->genkode($config_psn),
			'kode_transaksi' => $kode_transaksi,
			'tgl_pemesanan' =>  $_POST['tgl_pemesanan'],
			'jam_pesan' => $_POST['jam_pesan'],
			'jumlah_pesan' => $jumlah_pesan,
			'jumlah_bayar' => rp_to_number($_POST['total_bayar']),
			'status' => 'menunggu',
		];


		// $data['id_pelanggan'] = $id_pelanggan;
		// $data['id_meja'] = $_POST['id_meja'];
		// $data['kode_pesanan'] = $this->mm->genkode($config_psn);
		// $data['kode_transaksi'] =  $kode_transaksi;
		// $data['tgl_pemesanan'] = $_POST['tgl_pemesanan'];
		// $data['jam_pesan'] = $_POST['jam_pesan'];
		// $data['jumlah_pesan'] = $jumlah_pesan;
		// $data['jumlah_bayar'] = rp_to_number($_POST['total_bayar']);
		// $data['status'] = 'menunggu';  //'menunggu', 'terbooking', 'proses', 'selesai'

		return $this->mm->insert($data, 'pesanan');
	}

	protected function save_detail_pesanan($kode_pesanan)
	{

		$menu_selecteds = $this->session->userdata('daftar_menu');
		foreach ($menu_selecteds as $d_menu) {
			// cek stoknya jika melebihi error ya 
			$where_menu['id_menu'] = $d_menu->id_menu;
			$daftar_menu = $this->db->get_where('daftar_menu', $where_menu)->row();


			$data['id_menu'] = $d_menu->id_menu;
			$data['kode_pesanan'] = $kode_pesanan;
			$data['jumlah'] = $d_menu->jumlah;
			$this->mm->insert($data, 'detail_pesanan');
		}
	}

	private function _uploadImage()
	{
		$config['upload_path']          = './uploads';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['file_name']            = $_FILES["upload_bukti"]["name"];
		$config['overwrite']            = true;
		$config['max_size']             = 5024; // 5MB

		$this->load->library('upload');
		$this->upload->initialize($config);
		if (!$this->upload->do_upload('upload_bukti')) {
			return false;
		} else {
			return $_FILES["upload_bukti"]["name"];
		}
	}
}
