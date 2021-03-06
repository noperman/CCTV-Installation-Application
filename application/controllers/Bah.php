<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller{
	function __construct(){
		parent::__construct();
		
		loged();
		$this->load->model('Model_', 'main');
		$this->load->model('Model_master', 'master');
  }

  public function alat(){
    if($this->input->post('simpan_alat') == 'on'){
      $this->form_validation->set_rules('alat', 'Kelompok Alat', 'required|trim');
      $this->form_validation->set_rules('detail_alat', 'Nama Alat', 'required|trim|max_length[50]');
    }elseif($this->input->post('perbarui_alat') == 'on'){
      $this->form_validation->set_rules('alat_id', 'ID', 'required|trim');
      $this->form_validation->set_rules('alat', 'Kelompok Alat', 'required|trim');
      $this->form_validation->set_rules('detail_alat', 'Nama Alat', 'required|trim|max_length[50]');
    }elseif($this->input->post('simpan') == 'on'){
      $this->form_validation->set_rules('kelompok_alat', 'Nama Kelompok Alat', 'required|trim|max_length[50]');
    }elseif($this->input->post('perbarui') == 'on'){
      $this->form_validation->set_rules('kelompok_alat_id', 'ID', 'required|trim');
      $this->form_validation->set_rules('kelompok_alat', 'Nama Kelompok Alat', 'required|trim|max_length[50]');
    }

    if($this->form_validation->run() == FALSE){
      $this->template->set('title','Master Alat');
			$this->template->set('breadcrumb', [
				['link' => base_url(), 'text' => 'Home', 'active' => false],
				['link' => "#", 'text' => 'Master', 'active' => true],
				['link' => "#", 'text' => 'Alat', 'active' => true]
			]);
			$this->template->set('css', [
				['src' => base_url().'assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.css']
			]);
			$this->template->set('js', [
				['src' => base_url().'assets/adminlte/plugins/datatables/jquery.dataTables.js'],
				['src' => base_url().'assets/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.js'],
				['src' => base_url().'assets/js/main.js'],
				['src' => base_url().'assets/js/alat.js']
			]);
			$data['alat'] = $this->master->getAllAlat();
			$data['detail_alat'] = $this->master->getAllDetailAlat();
      $this->template->load('template/base','master/alat', $data);
    }else{
      if($this->input->post('simpan_alat') == 'on'){
				$data = [
					"id" => '',
					"id_alat" => htmlspecialchars($this->input->post('alat', true)),
					"detail_alat" => htmlspecialchars($this->input->post('detail_alat', true))
				];
				$this->main->insert($data,'m_alat_detail');
				$this->session->set_flashdata('message', '<div id="message" class="alert alert-success alert-dismissible fade show" role="alert">
					<i class="far fa-check-circle"></i> Data berhasil diperbarui.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					</div>');
				redirect('master/alat');
      }elseif($this->input->post('perbarui_alat') == 'on'){
				$id=$this->input->post('alat_id');
				$where = ['id' => $id];
				$data = [
					"id_alat" => htmlspecialchars($this->input->post('alat', true)),
					"detail_alat" => htmlspecialchars($this->input->post('detail_alat', true))
				];
				$this->main->update($where,$data,'m_alat_detail');
				$this->session->set_flashdata('message', '<div id="message" class="alert alert-success alert-dismissible fade show" role="alert">
					<i class="far fa-check-circle"></i> Data berhasil diperbarui.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					</div>');
        redirect('master/alat');
      }elseif($this->input->post('simpan') == 'on'){
				$data = [
					"id" => '',
					"nama_alat" => htmlspecialchars($this->input->post('kelompok_alat', true))
				];
				$this->main->insert($data,'m_alat');
				$this->session->set_flashdata('message', '<div id="message" class="alert alert-success alert-dismissible fade show" role="alert">
					<i class="far fa-check-circle"></i> Data berhasil diperbarui.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					</div>');
				redirect('master/alat');
      }elseif($this->input->post('perbarui') == 'on'){
				$id=$this->input->post('kelompok_alat_id');
				$where = ['id' => $id];
				$data = [
					"nama_alat" => htmlspecialchars($this->input->post('kelompok_alat', true))
				];
				$this->main->update($where,$data,'m_alat');
				$this->session->set_flashdata('message', '<div id="message" class="alert alert-success alert-dismissible fade show" role="alert">
					<i class="far fa-check-circle"></i> Data berhasil diperbarui.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					</div>');
				redirect('master/alat');
      }
    }
  }

  function getKelompokAlatById(){
		if($this->input->post('id')){
			$id=$this->input->post('id');
			$where = ['id' => $id ];
			$data = $this->main->getWhere('m_alat',$where)->result();

			echo json_encode($data);
		}else{
      redirect('master/alat');
		}
  }

	function hapusKelompokAlat(){
		if($this->input->post('id')){
			$id = $this->input->post('id');
			$where = ['id' => $id];
			$this->main->delete($where,'m_alat');
			$this->session->set_flashdata('message', '<div id="message" class="alert alert-warning alert-dismissible fade show" role="alert">
                <i class="far fa-check-circle"></i> Data telah dihapus.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
		}else{
      redirect('master/alat');
		}
	}

  function getAlatById(){
		if($this->input->post('id')){
			$id=$this->input->post('id');
			$where = ['id' => $id ];
			$data = $this->main->getWhere('m_alat_detail',$where)->result();

			echo json_encode($data);
		}else{
      redirect('master/alat');
		}
  }

	function hapusAlat(){
		if($this->input->post('id')){
			$id = $this->input->post('id');
			$where = ['id' => $id];
			$this->main->delete($where,'m_alat_detail');
			$this->session->set_flashdata('message', '<div id="message" class="alert alert-warning alert-dismissible fade show" role="alert">
                <i class="far fa-check-circle"></i> Data telah dihapus.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
		}else{
      redirect('master/alat');
		}
	}
}