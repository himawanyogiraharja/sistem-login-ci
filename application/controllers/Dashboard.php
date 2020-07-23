<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct(){
		parent::__construct();
		if(empty($this->session->userdata('email'))){
			redirect('auth/login');
		}
	}

function index(){
		$data['title']			= 'Halaman Dasboard';
		$data['contents']		= 'dashboard/v_dashboard';

		$this->load->view('templates/core', $data);
	}

}