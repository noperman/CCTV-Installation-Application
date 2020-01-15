<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
  function __construct(){
    parent::__construct();
    loged();
		$this->load->model('Model_', 'main');
  }

  public function index(){
    $this->template->set('title','Dashboard');
    $this->template->set('breadcrumb', [
      ['link' => "#", 'text' => 'Home', 'active' => true]
    ]);
    $this->template->set('menu',$this->main->Menu($this->session->userdata('level_user')));
		$this->template->load('template/base','admin/index');
  }
}
