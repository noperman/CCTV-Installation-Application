<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {
  function __construct(){
		parent::__construct();
		
		loged();
		$this->load->model('Model_', 'main');
		$this->load->model('Model_laporan', 'laporan');
  }
  
  public function index(){
    $this->template->set('title','Laporan');
    $this->template->set('breadcrumb', [
      ['link' => base_url(), 'text' => 'Home', 'active' => false],
      ['link' => "#", 'text' => 'Laporan', 'active' => true]
    ]);
    $this->template->set('css', [
      ['src' => base_url().'assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.css'],
      ['src' => base_url().'assets/adminlte/plugins/daterangepicker/daterangepicker.css'],
      ['src' => base_url().'assets/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css']      
    ]);
    $this->template->set('js', [
      ['src' => base_url().'assets/adminlte/plugins/datatables/jquery.dataTables.js'],
      ['src' => base_url().'assets/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.js'],
      ['src' => base_url().'assets/adminlte/plugins/moment/moment.min.js'],
      ['src' => base_url().'assets/adminlte/plugins/daterangepicker/daterangepicker.js'],
      ['src' => base_url().'assets/adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js'],
      ['src' => base_url().'assets/adminlte/plugins/datatables-buttons/js/buttons.html5.min.js'],
      ['src' => base_url().'assets/adminlte/plugins/datatables-buttons/js/jszip.min.js'],
      ['src' => base_url().'assets/js/main.js'],
      ['src' => base_url().'assets/js/laporan.js']
    ]);
    $this->template->set('menu',$this->main->Menu($this->session->userdata('level_user')));

    $this->template->load('template/base','laporan/index');
  }

  public function getLaporan($tgl1,$tgl2){
    $parts = explode('-',$tgl1);
    $parts2 = explode('-',$tgl2);
    $tglMulai = $parts[2] . '-' . $parts[0] . '-' . $parts[1];
    $tglSelesai = $parts2[2] . '-' . $parts2[0] . '-' . $parts2[1];

		echo json_encode([
			'data' => $this->laporan->laporan($tglMulai,$tglSelesai)
		]);
  }
}