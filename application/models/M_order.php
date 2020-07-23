<?php 

class M_order extends CI_Model{

	function getMobil(){
		return $this->db->query("SELECT `nama` FROM `tb_mobil`")->result_array();
	}
}