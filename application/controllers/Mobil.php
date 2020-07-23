<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mobil extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('m_mobil');
		$this->load->library('form_validation');
		if(empty($this->session->userdata('email'))){
			redirect('auth/login');
		}
	}

function index(){
		$data['title']			= 'Daftar Mobil';
		$data['contents']		= 'mobil/list_mobil';
		$data['list_mobil']		= $this->m_mobil->getAllMobil();

		$this->load->view('templates/core', $data);
	}


	function tambah(){
		$this->form_validation->set_rules('nama', 'Nama', 'required', [
			'required'	=> '*Nama mobil belum diisi!'
		]);
		$this->form_validation->set_rules('type', 'Type', 'required' , [
			'required'	=> '*Tipe mobil belum diisi!'
		]);
		$this->form_validation->set_rules('no_pol', 'No Plat', 'required', [
			'required'	=> '*No plat mobil belum terisi!']);
		$this->form_validation->set_rules('tahun_mobil', 'Tahun Mobil', 'required', [
			'required'	=> '*Tahun mobil belum terisi!']);
		$this->form_validation->set_rules('harga', 'Harga Mobil', 'required', [
			'required'	=> '*Harga mobil belum terisi!']);
		$this->form_validation->set_rules('produsen', 'Produsen Mobil', 'required', [
			'required'	=> '*Produsen mobil belum terisi!']);

		if($this->form_validation->run() == false){
		$data['title']			= 'Halaman Form Tambah';
		$data['contents']		= 'mobil/form_tambah';

		$this->load->view('templates/core', $data);
	} else {
		$nama 			= htmlspecialchars($this->input->post('nama'), true);
		$type 			= htmlspecialchars($this->input->post('type'), true);
		$no_pol			= htmlspecialchars($this->input->post('no_pol'), true);
		$tahun_mobil 	= htmlspecialchars($this->input->post('tahun_mobil'), true);
		$harga 			= htmlspecialchars($this->input->post('harga'), true);
		$produsen 		= htmlspecialchars($this->input->post('produsen'), true);

		$data = [
			'nama'			=> $nama,
			'type'			=> $type,
			'no_pol'		=> $no_pol,
			'tahun_mobil'	=> $tahun_mobil,
			'harga'			=> $harga,
			'produsen'		=> $produsen,
			'date_created'	=> time()
		];

		$this->db->insert('tb_mobil', $data);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
					  <strong>Yeay!</strong> Data mobil berhasil diinput
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					</div>');
	redirect('mobil');
		
		}
	}

		function editDataMobil($id){
		$data['title']			= 'Halaman edit mobil';
		$data['contents']		= 'mobil/form_update';
		$data['ambilDataMobil']	= $this->m_mobil->ambilDataMobil($id);

		$this->load->view('templates/core', $data);
	}

		function updateMobil(){
			$id 			= htmlspecialchars($this->input->post('id'), true);
			$nama 			= htmlspecialchars($this->input->post('nama'), true);
			$type 			= htmlspecialchars($this->input->post('type'), true);
			$no_pol			= htmlspecialchars($this->input->post('no_pol'), true);
			$tahun_mobil 	= htmlspecialchars($this->input->post('tahun_mobil'), true);
			$harga 			= htmlspecialchars($this->input->post('harga'), true);
			$produsen 		= htmlspecialchars($this->input->post('produsen'), true);

			$data = [
				'nama'			=> $nama,
				'type'			=> $type,
				'no_pol'		=> $no_pol,
				'no_pol'		=> $no_pol,
				'tahun_mobil'	=> $tahun_mobil,
				'harga'			=> $harga,
				'produsen'		=> $produsen
			];

			$this->db->where('id', $id);
			$this->db->update('tb_mobil', $data);

			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Yeay!</h4>Berhasil!. Data pengemudi sudah diupdate!</div>');
			redirect('mobil');
		}

		function deleteMobil($id){
			$this->m_mobil->deleteMobil($id);
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-ban"></i> Alert!</h4>Berhasil!. Data mobil sudah berhasil dihapus!</div>');
			redirect('mobil');
		}

}