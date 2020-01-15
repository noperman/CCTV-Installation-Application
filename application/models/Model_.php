<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_ extends CI_Model {
  function insert($data,$table){
		$this->db->insert($table, $data);
	}

	function update($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table, $data);
	}

	function delete($where,$table){
		$this->db->where($where);
		$this->db->delete($table);
	}

	function getWhere($table,$where){
		return $this->db->get_where($table,$where);
	}

	function Menu($level_user){
		$menu = $this->db->distinct()->select('menu.id as id_menu, menu.*')
								->from('user_access_menu')
								->join('menu','menu.id = user_access_menu.id_menu')
								->where('user_access_menu.id_level', $level_user)
								->get()->result_array();
		
		foreach($menu as $row => $data){
			array_push($menu[$row],$this->db->distinct()->select('sub_menu.id as id_submenu, sub_menu.*')
														->from('user_access_menu')
														->join('sub_menu','sub_menu.id = user_access_menu.id_submenu')
														->where('sub_menu.id_menu', $data['id_menu'])
														->where('user_access_menu.id_level', $level_user)
														->get()->result_array());
		}
		return $menu;
	}

	function getTeknisi(){
		return $this->db->select('user.id, fullname, status_teknisi')
								->from('user')
								->join('level_user','level_user.id = user.id_level')
								->where('status_teknisi', 'OFF JOB')
								->where('level_user !=','Admin')
								->get()->result_array();
	}
}