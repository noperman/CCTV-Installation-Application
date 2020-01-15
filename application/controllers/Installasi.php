<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Installasi extends CI_Controller {
  function __construct(){
    parent::__construct();

    loged();
		$this->load->model('Model_', 'main');
		$this->load->model('Model_installasi', 'installasi');
  }

  public function index(){
    if($this->form_validation->run() == FALSE){
      $this->template->set('title','Installasi');
      $this->template->set('breadcrumb', [
        ['link' => base_url(), 'text' => 'Home', 'active' => false],
        ['link' => "#", 'text' => 'Installasi', 'active' => true]
      ]);
      $this->template->set('css', [
        ['src' => base_url().'assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.css']
      ]);
      $this->template->set('js', [
        ['src' => base_url().'assets/adminlte/plugins/datatables/jquery.dataTables.js'],
        ['src' => base_url().'assets/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.js'],
        ['src' => base_url().'assets/js/main.js'],
        ['src' => base_url().'assets/js/installasi.js']
      ]);
      $this->template->set('menu',$this->main->Menu($this->session->userdata('level_user')));

      $config = array();
      $config["base_url"] = base_url() . "installasi/index/";
      $config["total_rows"] = $this->installasi->get_count();
      $config["per_page"] = 8;
      $config["uri_segment"] = 3;
      $config['num_links'] = 3;

      // Style Pagination
      // Agar bisa mengganti stylenya sesuai class2 yg ada di bootstrap
      $config['full_tag_open']   = '<ul class="pagination pagination-sm m-0 float-right">';
      $config['full_tag_close']  = '</ul>';
      
      $config['first_link']      = 'First'; 
      $config['first_tag_open']  = '<li class="page-item">';
      $config['first_tag_close'] = '</li>';
      
      $config['last_link']       = 'Last'; 
      $config['last_tag_open']   = '<li class="page-item">';
      $config['last_tag_close']  = '</li>';
      
      $config['next_link']       = '>'; 
      $config['next_tag_open']   = '<li class="page-item">';
      $config['next_tag_close']  = '</li>';
      
      $config['prev_link']       = '<'; 
      $config['prev_tag_open']   = '<li class="page-item">';
      $config['prev_tag_close']  = '</li>';

      $config['cur_tag_open']    = '<li class="page-item active"><a class="page-link" href="#">';
      $config['cur_tag_close']   = '</a></li>';
        
      $config['num_tag_open']    = '<li class="page-item">';
      $config['num_tag_close']   = '</li>';
      // End style pagination

      $this->pagination->initialize($config);

      $page = ($this->uri->segment($config["uri_segment"])) ? $this->uri->segment($config["uri_segment"]) : 0;
      $data["links"] = $this->pagination->create_links();
      $data["installasi"] = $this->installasi->getAllInstallasi($config["per_page"], $page);

      $this->template->load('template/base','installasi/index', $data);
    }
  }

  public function permintaan_installasi(){
		if ($this->input->post('simpan') == "on") {
      $this->form_validation->set_rules('nama', 'Nama', 'required|trim|max_length[50]');
      $this->form_validation->set_rules('jk', 'Jenis Kelamin', 'required|trim');
      $this->form_validation->set_rules('instansi', 'Instansi', 'required|trim|max_length[50]');
      $this->form_validation->set_rules('notelp', 'Nomor telepon', 'required|trim|numeric|max_length[14]');
      $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim|max_length[200]');
      $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim|max_length[200]');
    }elseif($this->input->post('perbarui') == "on"){
      $this->form_validation->set_rules('id', 'ID', 'required|trim');
      $this->form_validation->set_rules('nama', 'Nama', 'required|trim|max_length[50]');
      $this->form_validation->set_rules('jk', 'Jenis Kelamin', 'required|trim');
      $this->form_validation->set_rules('instansi', 'Instansi', 'required|trim|max_length[50]');
      $this->form_validation->set_rules('notelp', 'Nomor telepon', 'required|trim|numeric|max_length[14]');
      $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim|max_length[200]');
      $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim|max_length[200]');
    }elseif($this->input->post('simpan_jadwal_survei') == "on"){
      $this->form_validation->set_rules('id_permintaan', 'ID Permintaan', 'required|trim');
      $this->form_validation->set_rules('jadwal_survei', 'Jadwal survei', 'required|trim');
      $this->form_validation->set_rules('teknisi', 'Teknisi', 'required|trim');
    }

		if($this->form_validation->run() == false){
      $this->template->set('title','Permintaan Installasi');
      $this->template->set('breadcrumb', [
        ['link' => base_url(), 'text' => 'Home', 'active' => false],
        ['link' => "#", 'text' => 'Installasi', 'active' => true],
        ['link' => "#", 'text' => 'Permintaan Installasi', 'active' => true]
      ]);
      $this->template->set('css', [
        ['src' => base_url().'assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.css']
      ]);
      $this->template->set('js', [
        ['src' => base_url().'assets/adminlte/plugins/datatables/jquery.dataTables.js'],
        ['src' => base_url().'assets/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.js'],
        ['src' => base_url().'assets/js/main.js'],
        ['src' => base_url().'assets/js/permintaan_installasi.js']
      ]);
      $this->template->set('menu',$this->main->Menu($this->session->userdata('level_user')));
      $data['permintaan_installasi'] = $this->installasi->getAllPermintaanInstallasi();
      $data['teknisi'] = $this->main->getTeknisi();
      $this->template->load('template/base','installasi/permintaan_installasi', $data);
    }else{
      if ($this->input->post('simpan') == "on") {
        $where = ['email' => $this->session->userdata('email') ];
        $user = $this->main->getWhere('user',$where)->result_array();
        
        date_default_timezone_set('Asia/Jakarta');
				$tgl_input = date('Ymd');
				$data = [
					"id" => '',
					"id_user" => $user[0]['id'],
					"nama" => htmlspecialchars($this->input->post('nama', true)),
					"instansi" => htmlspecialchars($this->input->post('instansi')),
					"jk" => htmlspecialchars($this->input->post('jk')),
					"no_telp" => htmlspecialchars($this->input->post('notelp', true)),
					"alamat" => htmlspecialchars($this->input->post('alamat', true)),
					"keterangan" => htmlspecialchars($this->input->post('keterangan', true)),
					"tgl_permintaan" => $tgl_input,
					"status" => 'Permintaan',
        ];
        
				$this->main->insert($data,'permintaan_installasi');
				$this->session->set_flashdata('message', '<div id="message" class="alert alert-success alert-dismissible fade show" role="alert">
					<i class="far fa-check-circle"></i> Data berhasil disimpan.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					</div>');
				redirect('installasi/permintaan_installasi');
      }elseif($this->input->post('perbarui') == "on"){
				$id=$this->input->post('id');
				$where = ['id' => $id];
				$data = [
					"nama" => htmlspecialchars($this->input->post('nama', true)),
					"instansi" => htmlspecialchars($this->input->post('instansi')),
					"jk" => htmlspecialchars($this->input->post('jk')),
					"no_telp" => htmlspecialchars($this->input->post('notelp', true)),
					"alamat" => htmlspecialchars($this->input->post('alamat', true)),
					"keterangan" => htmlspecialchars($this->input->post('keterangan', true)),
				];
				$this->main->update($where,$data,'permintaan_installasi');
				$this->session->set_flashdata('message', '<div id="message" class="alert alert-success alert-dismissible fade show" role="alert">
					<i class="far fa-check-circle"></i> Data berhasil diperbarui.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					</div>');
          redirect('installasi/permintaan_installasi');
      }elseif($this->input->post('simpan_jadwal_survei') == "on"){
        date_default_timezone_set('Asia/Jakarta');        
        $today_start = strtotime('today');
        $today_end = strtotime('tomorrow');
        $date = $this->input->post('jadwal_survei');

        $date_timestamp = strtotime($date);

        if ($date_timestamp >= $today_end) {
          $data = [
            "id_user" => htmlspecialchars($this->input->post('teknisi', true)),
            "id_permintaan" => htmlspecialchars($this->input->post('id_permintaan', true)),
            "tgl_survei" => htmlspecialchars($date)
          ];
        
          $this->main->insert($data,'survei');

          
          $id=$this->input->post('id_permintaan');
          $where_update = ['id' => $id];
          $data_update = [
            "status" => 'Survei'
          ];
          $this->main->update($where_update,$data_update,'permintaan_installasi');

          $this->session->set_flashdata('message', '<div id="message" class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="far fa-check-circle"></i> Data berhasil disimpan.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>');
          redirect('installasi/permintaan_installasi');
        } elseif ($date_timestamp < $today_start) {
          $this->session->set_flashdata('message', '<div id="message" class="alert alert-danger alert-dismissible fade show" role="alert">
          <i class="far fa-times-circle"></i> Tanggal survei tidak valid!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          </div>');
          redirect('installasi/permintaan_installasi');
        } else {
          $this->session->set_flashdata('message', '<div id="message" class="alert alert-danger alert-dismissible fade show" role="alert">
          <i class="far fa-times-circle"></i> Tanggal survei tidak valid!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          </div>');
          redirect('installasi/permintaan_installasi');
        }
      }
    }
  }

  function getPermintaanInstallasiById(){
		if($this->input->post('id')){
			$id=$this->input->post('id');
			$where = ['id' => $id ];
			$data = $this->main->getWhere('permintaan_installasi',$where)->result();

			echo json_encode($data);
		}else{
      redirect('installasi/permintaan_installasi');
		}
  }

	function hapusPermintaanInstallasi(){
		if($this->input->post('id')){
			$id = $this->input->post('id');
			$where = ['id' => $id];
			$this->main->delete($where,'permintaan_installasi');
			$this->session->set_flashdata('message', '<div id="message" class="alert alert-warning alert-dismissible fade show" role="alert">
                <i class="far fa-check-circle"></i> Data telah dihapus.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
		}else{
      redirect('installasi/permintaan_installasi');
		}
  }

  function getBahansById(){
		if($this->input->post('id')){
			$id=$this->input->post('id');
			$where = ['id_bahan' => $id ];
			$data = $this->main->getWhere('m_bahan_detail',$where)->result();

			echo json_encode($data);
		}else{
      redirect('installasi/permintaan_installasi');
		}
  }
}