<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_survei extends CI_Model {
	protected $table = 'survei';

	function getAllSurveiAdmin($limit, $start){
		return $this->db->select('survei.status as status_survei, survei.id as id_survei, survei.*, permintaan_installasi.id as permintaan, permintaan_installasi.status as status_permintaan, permintaan_installasi.*,user.fullname')
								->from('survei')
								->join('permintaan_installasi', 'permintaan_installasi.id = survei.id_permintaan')
								->join('user','user.id = survei.id_user')
								->limit($limit,$start)
								->get()->result_array();
	}

	function getAllSurvei($limit, $start, $id_user){
		return $this->db->select('survei.status as status_survei, survei.id as id_survei, survei.*, permintaan_installasi.id as permintaan, permintaan_installasi.status as status_permintaan, permintaan_installasi.*,user.fullname')
								->from('survei')
								->join('permintaan_installasi', 'permintaan_installasi.id = survei.id_permintaan')
								->join('user','user.id = survei.id_user')
								->where('survei.id_user', $id_user)
								->limit($limit,$start)
								->get()->result_array();
		
		// foreach($head as $row => $data){
		// 	array_push($head[$row],$this->db->select('detail_alat')
		// 												->from('m_alat_detail')
		// 												->where('m_alat_detail.id_alat', $data['id_alat'])
		// 												->get()->result_array(), $this->db->select('detail_bahan')
		// 												->from('m_bahan_detail')
		// 												->where('m_bahan_detail.id_bahan', $data['id_bahan'])
		// 												->get()->result_array());
		// }
		// return $head;
	}
	
	public function get_count() {
		return $this->db->count_all($this->table);
	}

	public function getAllImagesSurvei($id_images,$limit,$start){
		return $this->db->select('images_detail.path,images_detail.name')
									->from('images')
									->join('images_detail', 'images_detail.id_images = images.id')
									->where('id_images', $id_images)
									->limit($limit,$start)
									->get()->result_array();
	}

	public function get_countImages($id_images) {
		return $this->db->select('*')
									->from('images_detail')
									->where('id_images', $id_images)
									->get()->num_rows();
	}

	public function dataBahan($id){
		return $this->db->select('*')->from('bahan')->where('id_survei', $id)->get()->result();
	}
	
	public function hapusBahan($data) {
		$this->db->where_in('id', $data)->delete('bahan');
	}

	public function getHasilSurvei($id_survei){
		$survei = $this->db->select('survei.catatan,tgl_installasi')
									->from('survei')
									->join('installasi','installasi.id_survei = survei.id')
									->where('survei.id',$id_survei)
									->get()->result_array();
		
		$installasi = $this->db->select('id, id_alat')->from('installasi')->where('id_survei', $id_survei)->get()->result_array();

		foreach($survei as $row => $data){
			array_push($survei[$row],
														$this->db->select('detail_alat')
														->from('m_alat_detail')
														->where('m_alat_detail.id_alat', $installasi[0]['id_alat'])
														->get()->result_array(),
														$this->db->select('bahan, jumlah, satuan')
														->from('bahan')
														->where('bahan.id_installasi', $installasi[0]['id'])
														->get()->result_array());
		}
		return $survei;
	}
}