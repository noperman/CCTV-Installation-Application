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

	function getTeknisi(){
		return $this->db->select('user.id, fullname, status_teknisi')
								->from('user')
								->join('level_user','level_user.id = user.id_level')
								->where('status_teknisi', 'OFF JOB')
								->where('level_user !=','Admin')
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