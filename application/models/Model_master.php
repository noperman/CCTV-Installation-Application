<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_master extends CI_Model {
  function getAllAlat(){
		return $this->db->select('*')
                ->from('m_alat')
		            ->get()->result_array();
	}
  function getAllDetailAlat(){
		return $this->db->select('m_alat_detail.id, m_alat_detail.id_alat, nama_alat, detail_alat')
                ->from('m_alat_detail')
                ->join('m_alat','m_alat.id = m_alat_detail.id_alat')
		            ->get()->result_array();
	}
  function getAllBahan(){
		return $this->db->select('*')
                ->from('m_bahan')
		            ->get()->result_array();
	}
  function getAllDetailBahan(){
		return $this->db->select('m_bahan_detail.id, m_bahan_detail.id_bahan, nama_bahan, detail_bahan')
                ->from('m_bahan_detail')
                ->join('m_bahan','m_bahan.id = m_bahan_detail.id_bahan')
		            ->get()->result_array();
	}
}