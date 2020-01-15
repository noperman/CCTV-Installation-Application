<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class signout extends CI_Controller {
	public function index(){
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('level_user');
		$this->session->unset_userdata('status');
		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Anda telah keluar, silahkan masuk kembali!</div>');
		redirect(base_url());
		$this->session->sess_destroy();
		$this->cache->clean();
	}
}