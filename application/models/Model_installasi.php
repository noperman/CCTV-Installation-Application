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

	public function get_count_admin() {
		return $this->db->count_all('installasi');
	}

	public function get_count($user) {
		return $this->db->select('*')->from('installasi')->where('id_user',$user)->get()->num_rows();
	}
	
	function getAllInstallasi($limit, $start, $id_user){
		$installasi = $this->db->select('installasi.*,tgl_survei,permintaan_installasi.id as id_permintaan, fullname,nama,instansi,jk,no_telp,permintaan_installasi.alamat,keterangan,tgl_permintaan')
								->from('installasi')
								->join('user', 'user.id = installasi.id_user')
								->join('survei','survei.id = installasi.id_survei')
								->join('permintaan_installasi','permintaan_installasi.id = survei.id_permintaan')
								->where('installasi.status !=','Belum ACC')
								->where('installasi.id_user', $id_user)
								->limit($limit,$start)
								->get()->result_array();
		
		foreach($installasi as $row => $data){
			$installasi[$row]['alat'] = $this->db->select('detail_alat')
								->from('m_alat_detail')
								->where('m_alat_detail.id_alat', $data['id_alat'])
								->get()->result_array();
			$installasi[$row]['bahan'] = $this->db->select('bahan,jumlah,satuan')->from('bahan')->where('id_installasi',$data['id'])->get()->result_array();
		}
		return $installasi;
	}

	function getAllInstallasiAdmin($limit, $start){
		$installasi = $this->db->select('installasi.*,tgl_survei,permintaan_installasi.id as id_permintaan, fullname,nama,instansi,jk,no_telp,permintaan_installasi.alamat,keterangan,tgl_permintaan')
								->from('installasi')
								->join('user', 'user.id = installasi.id_user')
								->join('survei','survei.id = installasi.id_survei')
								->join('permintaan_installasi','permintaan_installasi.id = survei.id_permintaan')
								->where('installasi.status !=','Belum ACC')
								->limit($limit,$start)
								->get()->result_array();
		
		foreach($installasi as $row => $data){
			$installasi[$row]['alat'] = $this->db->select('detail_alat')
								->from('m_alat_detail')
								->where('m_alat_detail.id_alat', $data['id_alat'])
								->get()->result_array();
			$installasi[$row]['bahan'] = $this->db->select('bahan,jumlah,satuan')->from('bahan')->where('id_installasi',$data['id'])->get()->result_array();
		}
		return $installasi;
	}

	// function getHasilInstallasi(){
	// 	$survei = $this->db->select('installasi.catatan')
	// 								->from('installasi')
	// 								->join('installasi','installasi.id_survei = survei.id')
	// 								->where('survei.id',$id_survei)
	// 								->get()->result_array();
		
	// 	$installasi = $this->db->select('id, id_alat')->from('installasi')->where('id_survei', $id_survei)->get()->result_array();

	// 	foreach($survei as $row => $data){
	// 		array_push($survei[$row],
	// 													$this->db->select('detail_alat')
	// 													->from('m_alat_detail')
	// 													->where('m_alat_detail.id_alat', $installasi[0]['id_alat'])
	// 													->get()->result_array(),
	// 													$this->db->select('bahan, jumlah, satuan')
	// 													->from('bahan')
	// 													->where('bahan.id_installasi', $installasi[0]['id'])
	// 													->get()->result_array());
	// 	}
	// 	return $survei;
	// }
}