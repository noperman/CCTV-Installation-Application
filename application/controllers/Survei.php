<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Survei extends CI_Controller{
	function __construct(){
		parent::__construct();
		
		loged();
		$this->load->model('Model_', 'main');
		$this->load->model('Model_survei', 'survei');
		$this->load->model('Model_master', 'master');
    $this->load->library("pagination");
    date_default_timezone_set('Asia/Jakarta');
  }

  public function index(){
    if($this->input->post('simpan') == 'on'){
      $this->form_validation->set_rules('id', 'ID', 'required|trim');
      $this->form_validation->set_rules('jadwal_installasi', 'Jadwal Installasi', 'required|trim');
      $this->form_validation->set_rules('alat', 'Alat', 'required|trim');
      $this->form_validation->set_rules('catatan', 'Catatan', 'required|trim|max_length[200]');
      if($_FILES['foto']['name'][0] == NULL){
        $this->form_validation->set_rules('foto[]', 'Foto', 'required|trim');
      }
    }elseif($this->input->post('simpan_jadwal_installasi') == 'on'){
      $this->form_validation->set_rules('id_permintaan', 'ID Permintaan', 'required|trim');
      $this->form_validation->set_rules('id_survei', 'ID Survei', 'required|trim');
      $this->form_validation->set_rules('jadwal_installasi', 'Jadwal installasi', 'required|trim');
    }

    if($this->form_validation->run() == FALSE){
      $this->template->set('title','Survei');
      $this->template->set('breadcrumb', [
        ['link' => base_url(), 'text' => 'Home', 'active' => false],
        ['link' => "#", 'text' => 'Survei', 'active' => true]
      ]);
      $this->template->set('css', [
        ['src' => base_url().'assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.css'],
        ['src' => base_url().'assets/adminlte/plugins/datatables-select/css/select.bootstrap4.min.css'],
      ]);
      $this->template->set('js', [
        ['src' => base_url().'assets/adminlte/plugins/datatables/jquery.dataTables.js'],
        ['src' => base_url().'assets/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.js'],
        ['src' => base_url().'assets/adminlte/plugins/datatables-select/js/select.bootstrap4.min.js'],
        ['src' => base_url().'assets/js/main.js'],
        ['src' => base_url().'assets/js/survei.js']
      ]);
      $this->template->set('menu',$this->main->Menu($this->session->userdata('level_user')));

      $config = array();
      $config["base_url"] = base_url() . "survei/index/";
      $config["total_rows"] = $this->survei->get_count();
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
      $data['survei'] = $this->survei->getAllSurvei($config["per_page"], $page, $this->session->userdata('id_user'));
      if($this->session->userdata('level_user') == "1" ){
        $data['survei_admin'] = $this->survei->getAllSurveiAdmin($config["per_page"], $page);
      }
      $data['master_alat'] = $this->master->getAllAlat();

      $this->template->load('template/base','survei/index', $data);
    }else{
      if($this->input->post('simpan') == 'on'){
        $id = $this->input->post('id', true);
        $bahan_where = ['id_survei' => $id];
        $bahan = $this->main->getWhere('bahan',$bahan_where)->num_rows();

        if($bahan <= 0){
          $this->session->set_flashdata('message', '<div id="message" class="alert alert-danger alert-dismissible fade show" role="alert">
          <i class="far fa-times-circle"></i> Isi bahan installasi!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          </div>');
          redirect('survei');
        }else{
          $today_start = strtotime('today');
          $today_end = strtotime('tomorrow');
          $tgl_installasi = $this->input->post('jadwal_installasi');
  
          $date_timestamp = strtotime($tgl_installasi);
  
          if ($date_timestamp >= $today_end) {
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
              'type' => 'Survei',
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

            # Proses Survei
            $survei_where = ['id' => $id];
            $survei_date_selesai = date('Y-m-d H:i:s');
            $data_survei = [
              "selesai" => $survei_date_selesai,
              "id_photos" => $image_id,
              "catatan" => htmlspecialchars($this->input->post('catatan', true)),
              "status" => "Selesai",
            ];
            $this->main->update($survei_where,$data_survei,'survei');
            # Proses Survei

            # Proses Installasi
            $user = $this->session->userdata('id_user');

            $data = [
              "id_user" => htmlspecialchars($user),
              "id_survei" => htmlspecialchars($id),
              "tgl_installasi" => htmlspecialchars($tgl_installasi),
              "id_alat" => htmlspecialchars($this->input->post('alat')),
              "status" => "Belum Dikerjakan"
            ];
            
            $this->main->insert($data,'installasi');
            # Proses Installasi
            
            # Update Bahan->id_installasi
            $installasi = $this->main->getWhere('installasi',$bahan_where)->result_array();
            $id_installasi = $installasi[0]['id'];

            $where_survei = ["id_survei" => $id_installasi];
            $data_bahan = ["id_installasi" => $id_installasi];
            $this->main->update($where_survei,$data_bahan,'bahan');
            # Update Bahan->id_installasi

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
            redirect('survei');  
          } elseif ($date_timestamp < $today_start) {
            $this->session->set_flashdata('message', '<div id="message" class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="far fa-times-circle"></i> Tanggal installasi tidak valid!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('survei');
          } else {
            $this->session->set_flashdata('message', '<div id="message" class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="far fa-times-circle"></i> Tanggal installasi tidak valid!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('survei');
          }
        }
      }elseif($this->input->post('simpan_jadwal_installasi') == 'on'){
        $today_start = strtotime('today');
        $today_end = strtotime('tomorrow');
        $date = $this->input->post('jadwal_installasi');

        $date_timestamp = strtotime($date);

        if ($date_timestamp >= $today_end) {
          $where = ['email' => $this->session->userdata('email') ];
          $user = $this->main->getWhere('user',$where)->result_array();

          $data = [
            "id_user" => htmlspecialchars($user[0]['id']),
            "id_survei" => htmlspecialchars($this->input->post('id_survei', true)),
            "tgl_installasi" => htmlspecialchars($date),
            "status" => "Belum Dikerjakan"
          ];
        
          $this->main->insert($data,'installasi');
          
          $id=$this->input->post('id_survei');
          $where_survei = ['id' => $id];
          $data_survei = [
            "status" => 'Diterima'
          ];
          $this->main->update($where_survei,$data_survei,'survei');

          $id_permintaan=$this->input->post('id_permintaan');
          $where_permintaan = ['id' => $id_permintaan];
          $data_permintaan = [
            "status" => 'Installasi'
          ];
          $this->main->update($where_permintaan,$data_permintaan,'permintaan_installasi');

          $this->session->set_flashdata('message', '<div id="message" class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="far fa-check-circle"></i> Data berhasil disimpan.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>');
          redirect('survei');
        } elseif ($date_timestamp < $today_start) {
          $this->session->set_flashdata('message', '<div id="message" class="alert alert-danger alert-dismissible fade show" role="alert">
          <i class="far fa-times-circle"></i> Tanggal survei tidak valid!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          </div>');
          redirect('survei');
        } else {
          echo 'today';
        }
      }
    }
  }

  public function hasil($survei,$images){
    echo $this->input->post('survei');
    $this->template->set('title','Hasil Survei');
    $this->template->set('breadcrumb', [
      ['link' => base_url(), 'text' => 'Home', 'active' => false],
      ['link' => base_url('survei'), 'text' => 'Survei', 'active' => false],
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
    $config["base_url"] = base_url() . "survei/hasil/".$survei."/".$images."/";
    $config["total_rows"] = $this->survei->get_countImages($images);
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
    $data['images'] = $this->survei->getAllImagesSurvei($images,$config["per_page"], $page);
    $data['hasil_survei'] = $this->survei->getHasilSurvei($survei);
    
    $this->template->load('template/base','survei/hasil', $data);
  }

  function mulaiSurvei(){
    if($this->input->post('id')){
      $id = $this->input->post('id');
      $where = ['id' => $id];
      $date = date('Y-m-d H:i:s');
      $data = [
        "mulai" => $date,
        "status" => "Dimulai",
      ];
      $this->main->update($where,$data,'survei');

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
      redirect('survei');
    }
  }

  function getAlatsById(){
		if($this->input->post('id')){
			$id=$this->input->post('id');
			$where = ['id_alat' => $id ];
			$data = $this->main->getWhere('m_alat_detail',$where)->result();

			echo json_encode($data);
		}else{
      redirect('survei');
		}
  }

  function dataBahan($id){
    echo json_encode([
      'data' => $this->survei->dataBahan($id)
    ]);
  }

  function tambahBahan(){
    if($this->input->post('id_survei')){
      $data = [
        "id_survei" => htmlspecialchars($this->input->post('id_survei'), TRUE),
        "bahan" => htmlspecialchars($this->input->post('bahan'), TRUE),
        "jumlah" => htmlspecialchars($this->input->post('jumlah'), TRUE),
        "satuan" => htmlspecialchars($this->input->post('satuan'), TRUE),
      ];
      $this->main->insert($data,'bahan');
    }else{
      redirect('survei');
    }
  }

  function hapusBahan(){
		$post = $this->input->post();
		$data = (array) json_decode($post['data']);
		echo json_encode($this->survei->hapusBahan($data));
  }

  function getSurvei(){
		if($this->input->post('id')){
			$id=$this->input->post('id');
			$where = ['id' => $id ];
			$data = $this->main->getWhere('survei',$where)->result();

			echo json_encode($data);
		}else{
      redirect('survei');
		}
  }
}