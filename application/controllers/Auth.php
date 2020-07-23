<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct(){
		parent::__construct();
		// $this->load->model('m_login');
		$this->load->library('form_validation');
	}

	function registration(){
		
		$this->form_validation->set_rules('nama', 'Nama', 'required', [
			'required'			=> '*Nama harus diisi'
		]);
		$this->form_validation->set_rules('no_hp', 'No handphone', 'required|is_unique[tb_user.no_hp]', [
			'required'			=> '*No Handphone harus diisi',
			'is_unique'			=> 'No Handphone ini sudah terdaftar, silahkan gunakan nomor lain!!'
		]);
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[tb_user.email]', [
			'required'			=> '*Nama email harus diisi',
			'is_unique'			=> 'Alamat email ini sudah terdaftar, silahkan gunakan alamat email lain!!',
			'valid_email'		=> 'Format email tidak sesuai'
		]);
		$this->form_validation->set_rules('password1', 'Password', 'required|min_length[6]|matches[password2]', [
			'required'			=> '*Password harus diisi',
			'min_length'		=> 'Password terlalu singkat',
			'matches'			=> 'Password tidak sama'
		]);
			$this->form_validation->set_rules('password2', 'Password', 'required|min_length[6]|matches[password1]', [
			'required'			=> '*Password harus diisi',
			'min_length'		=> 'Password terlalu singkat',
			'matches'			=> 'Password tidak sama'
		]);

		if($this->form_validation->run() == false){
			$data['title']		= 'Halaman registrasi';
			$this->load->view('auth/v_registration', $data);
		}else{
			$nama 			= htmlspecialchars($this->input->post('nama', true));
			$no_hp 			= htmlspecialchars($this->input->post('no_hp', true));
			$email 			= htmlspecialchars($this->input->post('email', true));
			$password1 		= password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
			$password2 		= htmlspecialchars($this->input->post('password2', true));

			$data = [
				'nama'			=> $nama,
				'no_hp'			=> $no_hp,
				'email'			=> $email,
				'password'		=> $password1,
				'user_access'	=> 'user',
				'date_created'	=> time()
			];

			$this->db->insert('tb_user', $data);
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
			  <strong>Selamat!</strong> Kamu berhasil registrasi.
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
			</div>');
			redirect('auth/login');

		}
	}

	function login(){
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email', [
			'required'			=> '*Nama email harus diisi',
			'valid_email'		=> 'Format email tidak sesuai'
		]);
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]', [
			'required'			=> '*Password harus diisi',
			'min_length'		=> 'Password terlalu singkat'
		]);

		if($this->form_validation->run() == false){
			$data['title']		= 'Halaman Login';
			$this->load->view('auth/login', $data);
		} else {
			$this->_setSessionUser();
			$this->_prosesLogin();
			}
		}
	

	function _prosesLogin(){

		$email 			= htmlspecialchars($this->input->post('email', true));
		$password 		= htmlspecialchars($this->input->post('password', true));
		$query = $this->db->get_where('tb_user', ['email' => $email])->row_array();

		if($email != $query['email']){
		$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			  <strong>Ups!</strong> Email Anda salah.
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
			</div>');
		$this->load->view('auth/login');
		}
		if(password_verify($password, $query['password'])){
		$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
			  <strong>Yeay!</strong> Selamat datang dihalaman Dashboard!!
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
			</div>');
		redirect('dashboard');
		}
		$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			  <strong>Ups....!</strong> Password Anda Salah!
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
			</div>');
		$this->load->view('auth/login');
	}

	function _setSessionUser(){
		$email = $this->input->post('email');
		$query = $this->db->get_where('tb_user', ['email' => $email])->row_array();

		$data = [
			'nama' => $query['nama'],
			'email' => $query['email'],
			'foto' => $query['foto'],
			'user_access' => $query['user_access']
		];

		$this->session->set_userdata($data);
	}

	function logout(){
		$email = $this->session->userdata('email');
		$query = $this->db->get_where('tb_user', ['email' =>  $email])->row_array();
		$this->session->unset_userdata('name');
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('image');
		$this->session->unset_userdata('password');
		$this->session->unset_userdata('role_id');
		$this->session->unset_userdata('user_access');
		$this->session->unset_userdata('is_active');
		$this->session->unset_userdata('date_create');
		$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
					  <strong>Terimakasih!</strong> Anda berhasil logout
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					</div>');
	redirect('auth/login');
	}

	function logoutUser2(){
		$email = $this->session->userdata('email');
		$query = $this->db->get_where('tb_user', ['email' =>  $email])->row_array();
		$this->session->unset_userdata('name');
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('image');
		$this->session->unset_userdata('password');
		$this->session->unset_userdata('role_id');
		$this->session->unset_userdata('is_active');
		$this->session->unset_userdata('date_create');
		$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
					  <strong>Terimakasih!</strong> Anda berhasil logout
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					</div>');
	redirect('auth/login');
	}

	function logoutUser3(){
		$email = $this->session->userdata('email');
		$query = $this->db->get_where('tb_user', ['email' =>  $email])->row_array();
		$this->session->unset_userdata('name');
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('image');
		$this->session->unset_userdata('password');
		$this->session->unset_userdata('role_id');
		$this->session->unset_userdata('is_active');
		$this->session->unset_userdata('date_create');
		$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
					  <strong>Terimakasih!</strong> Anda berhasil logout
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					</div>');
	redirect('auth/login');
	}
}

