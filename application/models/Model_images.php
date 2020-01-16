<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_images extends CI_Model {
	public function getAllImages($id_images,$limit,$start){
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
}