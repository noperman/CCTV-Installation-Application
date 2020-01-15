<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_setting extends CI_Model {
  function getAllUsers(){
		return $this->db->select('user.id, fullname, email, status, level_user, status_teknisi')
                ->from('user')
                ->join('level_user','level_user.id = user.id_level')
		            ->get()->result_array();
	}
  function getAlllevel(){
		return $this->db->select('*')
		            ->from('level_user')
		            ->get()->result_array();
	}
}