<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_installasi extends CI_Model {
  function getAllPermintaanInstallasi(){
		return $this->db->select('permintaan_installasi.*, survei.tgl_survei')
								->from('permintaan_installasi')
								->join('survei','survei.id_permintaan = permintaan_installasi.id','left')
								->order_by('tgl_permintaan','desc')
		            ->get()->result_array();
	}

	function getAllSurvei(){
		return $this->db->select('installasi.id as id_installasi, installasi.*')
								->from('installasi')
								->join('user', 'user.id = installasi.id_user')
								->survei
								->limit($limit,$start)
								->get()->result_array();
	}
}