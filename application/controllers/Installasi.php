<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Installasi extends CI_Controller {
  function __construct(){
    parent::__construct();

    loged();
		$this->load->model('Model_', 'main');
		$this->load->model('Model_installasi', 'installasi');
		$this->load->model('Model_images', 'images');
    $this->load->library("pagination");
    date_default_timezone_set('Asia/Jakarta');
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

  public function index(){
    if($this->input->post('simpan') == 'on'){
      $this->form_validation->set_rules('id', 'ID', 'required|trim');
      $this->form_validation->set_rules('id_permintaan', 'ID', 'required|trim');
      $this->form_validation->set_rules('catatan', 'Catatan', 'required|trim|max_length[200]');
      if($_FILES['foto']['name'][0] == NULL){
        $this->form_validation->set_rules('foto[]', 'Foto', 'required|trim');
      }
    }

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
      
      $getCount = $this->installasi->get_count_admin();
      if($this->session->userdata('level_user') !== "1" ){
        $getCount = $this->installasi->get_count($this->session->userdata('id_user'));
      }
      $config = array();
      $config["base_url"] = base_url() . "installasi/index/";
      $config["total_rows"] = $getCount;
      $config["per_page"] = 4;
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
      $data["installasi"] = $this->installasi->getAllInstallasi($config["per_page"], $page, $this->session->userdata('id_user'));
      if($this->session->userdata('level_user') == "1" ){
        $data['installasi_admin'] = $this->installasi->getAllInstallasiAdmin($config["per_page"], $page);
      }

      $this->template->load('template/base','installasi/index', $data);
    }else{
      if($this->input->post('simpan') == 'on'){
        # Proses Foto
        $foto = $_FILES['foto']['name'];
        $files = $_FILES;

        $new_name = 'survei_'.date("Y-m-d(h-i-sa)");
        $config['file_name'] = $new_name;
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']      = '5120';
        $config['upload_path']   = 'assets/images/survei';
        $this->load->library('upload', $config);
        
        foreach($foto as $row => $name){
          $_FILES['foto']['name'] = $files['foto']['name'][$row];
          $_FILES['foto']['type'] = $files['foto']['type'][$row];
          $_FILES['foto']['tmp_name'] = $files['foto']['tmp_name'][$row];
          $_FILES['foto']['error'] = $files['foto']['error'][$row];
          $_FILES['foto']['size'] = $files['foto']['size'][$row];    

          $this->upload->initialize($config);
          $this->upload->do_upload('foto');
          $dataInfo[] = $this->upload->data('file_name');
        }

        $image_name = substr($dataInfo[0], 7, 22);

        $data_images = [
          'id' => '',
          'type' => 'Installasi',
          'name' => $image_name,
        ];

        $this->main->insert($data_images,'images');
        
        $images_where = ['name' => $image_name ];
        $image = $this->main->getWhere('images',$images_where)->result_array();
        $image_id = $image[0]['id'];

        foreach($dataInfo as $row => $data){
          $data_images_detail = [
            "id_images" => $image_id,
            "path" => "assets/images/survei/",
            "name" => $data,
          ];
          $this->main->insert($data_images_detail,'images_detail');
        }
        # Proses Foto

        # Proses Installasi
        $where_installasi = ['id' => $this->input->post('id')];
        $tgl_selesai_installasi = date('Y-m-d H:i:s');
        $data_installasi = [
          "selesai" => $tgl_selesai_installasi,
          "id_photos" => $image_id,
          "catatan" => htmlspecialchars($this->input->post('catatan', true)),
          "status" => "Selesai",
        ];
        $this->main->update($where_installasi,$data_installasi,'installasi');
        # Proses Installasi

        # Proses Permintaan Installasi
        $where_permintaan = ['id' => $this->input->post('id_permintaan')];
        $data_permintaan = [
          "status" => "Selesai",
        ];
        $this->main->update($where_permintaan,$data_permintaan,'permintaan_installasi');
        # Proses Permintaan Installasi

        # Update User OFF JOB
        $id_user = $this->session->userdata('id_user');
        $where_user = ['id'=>$id_user];
        $data_user = [ "status_teknisi" => 'OFF JOB'];
        $this->main->update($where_user,$data_user,'user');
        # Update User OFF JOB

        $this->session->set_flashdata('message', '<div id="message" class="alert alert-success alert-dismissible fade show" role="alert">
          <i class="far fa-check-circle"></i> Data berhasil diperbarui.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          </div>');
        redirect('installasi');
      }
    }
  }

  public function hasil($installasi,$images){
    $this->template->set('title','Hasil Installasi');
    $this->template->set('breadcrumb', [
      ['link' => base_url(), 'text' => 'Home', 'active' => false],
      ['link' => base_url('installasi'), 'text' => 'Installasi', 'active' => false],
      ['link' => "#", 'text' => 'Hasil', 'active' => true]
    ]);
    $this->template->set('css', [
      ['src' => base_url().'assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.css']
    ]);
    $this->template->set('js', [
      ['src' => base_url().'assets/adminlte/plugins/datatables/jquery.dataTables.js'],
      ['src' => base_url().'assets/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.js'],
      ['src' => base_url().'assets/js/main.js'],
      ['src' => base_url().'assets/js/survei.js']
    ]);
    $this->template->set('menu',$this->main->Menu($this->session->userdata('level_user')));
    
    $config = array();
    $config["base_url"] = base_url() . "installasi/hasil/".$installasi."/".$images."/";
    $config["total_rows"] = $this->images->get_countImages($images);
    $config["per_page"] = 8;
    $config["uri_segment"] = 5;
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
    $data['images'] = $this->images->getAllImages($images,$config["per_page"], $page);
    // $data['hasil_installasi'] = $this->installasi->getHasilInstallasi($installasi);
    
    $this->template->load('template/base','installasi/hasil', $data);
  }

  function mulaiInstallasi(){
    if($this->input->post('id')){
      $id = $this->input->post('id');
      $where = ['id' => $id];
      $date = date('Y-m-d H:i:s');
      $data = [
        "mulai" => $date,
        "status" => "Proses Installasi",
      ];
      $this->main->update($where,$data,'installasi');

      $id_user = $this->session->userdata('id_user');
      $where2 = ['id'=>$id_user];
      $data2 = [ "status_teknisi" => 'ON JOB'];
      $this->main->update($where2,$data2,'user');

      $this->session->set_flashdata('message', '<div id="message" class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="far fa-check-circle"></i> Survei dimulai.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>');
    }else{
      redirect('installasi');
    }
  }
}