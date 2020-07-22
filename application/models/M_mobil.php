<?php 

class M_mobil extends CI_Model {
	function getAllMobil(){
		return $this->db->query("SELECT * FROM `tb_mobil`")->result_array();
}
	
	function ambilDataMobil($id){
		return $this->db->query("SELECT * FROM `tb_mobil` WHERE `id` = $id")->result_array();
	}

	function deleteMobil($id){
		return $this->db->query("DELETE FROM `tb_mobil` WHERE `id` = $id");
	}

}