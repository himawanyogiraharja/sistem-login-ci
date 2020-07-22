<?php 

class M_user extends CI_Model {
	function ambilDataUser(){
		return $this->db->query("SELECT * FROM `tb_user` ORDER BY `id` DESC")->result_array();
	}

	function ambilEditDataUser($id){
		return $this->db->query("SELECT * FROM `tb_user` WHERE `id` = '$id'")->result_array();
	}

	function delete($id){
		return $this->db->query("DELETE FROM `tb_user` WHERE `id` = $id");
	}
}