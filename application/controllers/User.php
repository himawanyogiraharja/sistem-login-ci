<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('m_user');
		$this->load->library('form_validation');
		if(empty($this->session->userdata('email'))){
			redirect('auth/login');
		}
}
	function index(){
		$data['title']			= 'Halaman User';
		$data['contents']		= 'user/list_user';
		$data['ambilDataUser']	= $this->m_user->ambilDataUser();

		$this->load->view('templates/core', $data);
	}

	function tambahUser(){
		$this->form_validation->set_rules('nama', 'Nama User', 'required', [
			'required'	=> '*Nama harus Diisi']);
		$this->form_validation->set_rules('no_hp', 'No HP', 'required', [
			'required'	=> '*No HP harus diisi']);
		$this->form_validation->set_rules('email', 'Email', 'required|trim', [
			'required'	=> '*Nama email harus diisi']);
		$this->form_validation->set_rules('password', 'Password', 'required|trim', [
			'required'	=> '*Password anda harus diisi']);
	
		if($this->form_validation->run() == false){

		$data['title']		= 'Form Tambah User';
		$data['contents']	= 'user/form_user';

		$this->load->view('templates/core', $data);
		} else {
		$nama 			= htmlspecialchars($this->input->post('nama'), true);
		$no_hp			= htmlspecialchars($this->input->post('no_hp'), true);
		$email 			= htmlspecialchars($this->input->post('email'), true);
		$password 		= htmlspecialchars($this->input->post('password'), true);
		$uploadGambar 	= $_FILES['foto']['name'];

		if($uploadGambar){
			$config['max_size']			= '2048';
			$config['allowed_types']		= 'png|jpg|pdf|gif';
			$config['upload_path']		= './assets/img/user';
			$this->load->library('upload', $config);

			if($this->upload->do_upload('foto')){
				$this->upload->data('file_name');
			}else{
				echo $this->upload->display_errors();
			}
		}else{
			$uploadGambar = 'default.jpg';
		}

		$data = [
		'nama'			=> $nama,
		'no_hp'			=> $no_hp,
		'email'			=> $email,
		'password'		=> $password,
		'foto'			=> $uploadGambar,
		'date_created'	=> time(),
		'user_access'	=> 1
		];

		$this->db->insert('tb_user', $data);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
					  <strong>Yeay!</strong> Data user berhasil diinput
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					</div>');
		redirect('user');
		}
	}

	function updateDataUser($id){
		$data['title']			= 'Halaman update user';
		$data['contents']		= 'user/form_update';
		$data['ambilEditDataUser']	= $this->m_user->ambilEditDataUser($id);

		$this->load->view('templates/core', $data);
	}

	function update(){
		$id 			= htmlspecialchars($this->input->post('id'), true);
		$nama 			= htmlspecialchars($this->input->post('nama'), true);
		$no_hp			= htmlspecialchars($this->input->post('no_hp'), true);
		$email 			= htmlspecialchars($this->input->post('email'), true);
		$password 		= htmlspecialchars($this->input->post('password'), true);

		$uploadGambar 	= $_FILES['foto']['name'];

		if($uploadGambar){
			$config['max_size']				= '2048';
			$config['allowed_types']		= 'png|jpg|pdf|gif';
			$config['upload_path']			= './assets/img/user';
			$this->load->library('upload', $config);

			if($this->upload->do_upload('foto')){
				$this->upload->data('file_name');
			}else{
				echo $this->upload->display_errors();
			}
		}else{
			$uploadGambar = 'default.jpg';
		}

		$data = [
		'nama'			=> $nama,
		'no_hp'			=> $no_hp,
		'email'			=> $email,
		'password'		=> $password,
		'foto'			=> $uploadGambar,
		'date_created'	=> time(),
		'user_access'	=> 1

		];

		$this->db->where('id', $id);
		$this->db->update('tb_user', $data);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Yeay!</h4>Berhasil!. Data user sudah diupdate!</div>');
		redirect('user');
		}
		
		function delete($id){
			$this->m_user->delete($id);
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-ban"></i> Alert!</h4>Berhasil!. Data user sudah berhasil dihapus!</div>');
			redirect('user');
		}

}
