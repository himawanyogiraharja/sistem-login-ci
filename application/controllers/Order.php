<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_order');
		$this->load->library('form_validation');
		if (empty($this->session->userdata('email'))) {
			redirect('auth/login');
		}
	}

	function index()
	{
		$data['title']		= 'Halaman Form Order';
		$data['contents']	= 'order/v_form_order';
		$data['getMobil']	= $this->m_order->getMobil();

		$this->load->view('templates/core', $data);
	}

	function tambah()
	{
		$this->form_validation->set_rules('nama', 'Nama', 'required', [
			'required'	=> '*Nama Customer belum diisi!'
		]);
		$this->form_validation->set_rules('mobil', 'Mobil', 'required', [
			'required'	=> '*Tipe mobil belum diisi!'
		]);
		$this->form_validation->set_rules('durasi_pinjaman', 'Durasi Pinjaman', 'required', [
			'required'	=> '*Silahkan isi durasi pinjaman!'
		]);
		$this->form_validation->set_rules('tujuan', 'Tujuan', 'required', [
			'required'	=> '*Silahkan isi tujuan anda!'
		]);
		$this->form_validation->set_rules('harga_sewa_mobil', 'Harga Sewa', 'required', [
			'required'	=> '*Harga mobil belum terisi!'
		]);

		if ($this->form_validation->run() == false) {
			$data['title']		= 'Halaman Form Order';
			$data['contents']	= 'order/v_form_order';
			$data['getMobil']	= $this->m_order->getMobil();

			$this->load->view('templates/core', $data);
		} else {
			$nama 						= htmlspecialchars($this->input->post('nama'), true);
			$mobil 						= htmlspecialchars($this->input->post('mobil'), true);
			$durasi_pinjaman 	= htmlspecialchars($this->input->post('durasi_pinjaman'), true);
			$tujuan 					= htmlspecialchars($this->input->post('tujuan'), true);
			$harga_sewa_mobil = htmlspecialchars($this->input->post('harga_sewa_mobil'), true);

			$data = [

				'nama'							=> $nama,
				'mobil'							=> $mobil,
				'durasi_pinjaman'		=> $durasi_pinjaman,
				'harga_sewa_mobil'	=> $harga_sewa_mobil,
				'tujuan'						=> $tujuan,
				'date_created'			=> time()
			];

			$this->db->insert('tb_order', $data);
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Yeay!</h4>Berhasil!. Order sudah tersimpan!</div>');
			redirect('dashboard');
		}
	}
}
