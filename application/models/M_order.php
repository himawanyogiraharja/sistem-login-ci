<?php 

class M_order extends CI_Model{

	function getMobil(){
		return $this->db->query("SELECT * FROM `tb_mobil` ORDER BY `id` DESC")->result_array();
	}
}