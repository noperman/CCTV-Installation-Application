<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller{
	function __construct(){
		parent::__construct();
		
		loged();
		$this->load->model('Model_', 'main');
		$this->load->model('Model_setting', 'users');
	}
	
	public function users(){
		if ($this->input->post('simpanUser') == "tambah") {			
			$this->form_validation->set_rules('fullname', 'Nama', 'required|trim');
			$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]');
			$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[5]|max_length[12]|matches[confirmPassword]');
			$this->form_validation->set_rules('confirmPassword', 'Password', 'required|trim|min_length[5]|max_length[12]|matches[password]');
			$this->form_validation->set_rules('level', 'Level', 'required|trim');
			$this->form_validation->set_rules('alamat', 'Alamat', 'required|trim|max_length[200]');
			$this->form_validation->set_rules('notelp', 'Nomor telepon', 'required|trim|numeric|max_length[14]');
		}elseif($this->input->post('perbaruiUser') == "perbarui"){
			$this->form_validation->set_rules('user_id', 'Id user','required|trim');
			$this->form_validation->set_rules('fullname', 'Nama', 'required|trim');
			$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
			$this->form_validation->set_rules('level', 'Level', 'required|trim');
			$this->form_validation->set_rules('alamat', 'Alamat', 'required|trim|max_length[200]');
			$this->form_validation->set_rules('notelp', 'Nomor telepon', 'required|trim|numeric|max_length[14]');
		}
		elseif($this->input->post('simpanLevelUser') == "tambah"){
			$this->form_validation->set_rules('nama_level', 'Nama level','required|trim|min_length[3]|max_length[50]|is_unique[level_user.level_user]');
		}elseif($this->input->post('perbaruiLevelUser') == "perbarui"){
			$this->form_validation->set_rules('level_user_id', 'Id level','required|trim');
			$this->form_validation->set_rules('nama_level', 'Nama level','required|trim|min_length[3]|max_length[50]|is_unique[level_user.level_user]');
		}
		if($this->form_validation->run() == false){
			$this->template->set('title','Setting Users');
			$this->template->set('breadcrumb', [
				['link' => base_url(), 'text' => 'Home', 'active' => false],
				['link' => "#", 'text' => 'Setting', 'active' => true],
				['link' => "#", 'text' => 'Users', 'active' => true]
			]);
			$this->template->set('css', [
				['src' => base_url().'assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.css']
			]);
			$this->template->set('js', [
				['src' => base_url().'assets/adminlte/plugins/datatables/jquery.dataTables.js'],
				['src' => base_url().'assets/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.js'],
				['src' => base_url().'assets/js/main.js'],
				['src' => base_url().'assets/js/users.js']
			]);
			$this->template->set('menu',$this->main->Menu($this->session->userdata('level_user')));
			$data['users'] = $this->users->getAllUsers();
			$data['level_user'] = $this->users->getAlllevel();
			$this->template->load('template/base','admin/setting/users', $data);
		}else{
			if ($this->input->post('simpanLevelUser') == "tambah") {
				$data = [
					"id" => '',
					"level_user" => htmlspecialchars($this->input->post('nama_level', true))
				];
				$this->main->insert($data,'level_user');
				$this->session->set_flashdata('message', '<div id="message" class="alert alert-success alert-dismissible fade show" role="alert">
					<i class="far fa-check-circle"></i> Data berhasil disimpan.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					</div>');
				redirect('setting/users');
			}elseif($this->input->post('perbaruiLevelUser') == "perbarui"){
				$id=$this->input->post('level_user_id');
				$where = ['id' => $id];
				$data = [
					"level_user" => htmlspecialchars($this->input->post('nama_level', true))
				];
				$this->main->update($where,$data,'level_user');
				$this->session->set_flashdata('message', '<div id="message" class="alert alert-success alert-dismissible fade show" role="alert">
					<i class="far fa-check-circle"></i> Data berhasil diperbarui.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					</div>');
				redirect('setting/users');
			}elseif ($this->input->post('simpanUser') == "tambah"){
				$data = [
					"id" => '',
					"id_level" => htmlspecialchars($this->input->post('level', true)),
					"fullname" => htmlspecialchars($this->input->post('fullname', true)),
					"password" => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
					"foto" => 'default_avatar.png',
					"email" => htmlspecialchars($this->input->post('email', true)),
					"alamat" => htmlspecialchars($this->input->post('alamat', true)),
					"no_t" => htmlspecialchars($this->input->post('notelp', true)),
					"status" => htmlspecialchars($this->input->post('customCheck', true)),
				];
				$this->main->insert($data,'user');
				$this->session->set_flashdata('message', '<div id="message" class="alert alert-success alert-dismissible fade show" role="alert">
					<i class="far fa-check-circle"></i> Data berhasil disimpan.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					</div>');
				redirect('setting/users');
			}elseif($this->input->post('perbaruiUser') == "perbarui"){
				$id=$this->input->post('user_id');
				$where = ['id' => $id];
				$data = [
					"id_level" => htmlspecialchars($this->input->post('level', true)),
					"fullname" => htmlspecialchars($this->input->post('fullname', true)),
					"foto" => 'default_avatar.png',
					"email" => htmlspecialchars($this->input->post('email', true)),
					"alamat" => htmlspecialchars($this->input->post('alamat', true)),
					"no_t" => htmlspecialchars($this->input->post('notelp', true)),
					"status" => htmlspecialchars($this->input->post('customCheck', true)),
				];
				$this->main->update($where,$data,'user');
				$this->session->set_flashdata('message', '<div id="message" class="alert alert-success alert-dismissible fade show" role="alert">
					<i class="far fa-check-circle"></i> Data berhasil diperbarui.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					</div>');
				redirect('setting/users');
			}
		}
	}

	function getUserById(){
		if($this->input->post('id')){
			$id=$this->input->post('id');
			$where = ['id' => $id ];
			$data = $this->main->getWhere('user',$where)->result();

			echo json_encode($data);
		}else{
			redirect('setting/users');
		}
	}

	function hapusUser(){
		if($this->input->post('id')){
			$id = $this->input->post('id');
			$where = ['id' => $id];
			$this->main->delete($where,'user');
			$this->session->set_flashdata('message', '<div id="message" class="alert alert-warning alert-dismissible fade show" role="alert">
                <i class="far fa-check-circle"></i> Data telah dihapus.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
		}else{
			redirect('setting/users');
		}
	}

	function getLevelUserById(){
		if($this->input->post('id')){
			$id=$this->input->post('id');
			$where = ['id' => $id ];
			$data = $this->main->getWhere('level_user',$where)->result();

			echo json_encode($data);
		}else{
			redirect('setting/users');
		}
	}

	function hapusLevelUser(){
		if($this->input->post('id')){
			$id = $this->input->post('id');
			$where = ['id' => $id];
			$this->main->delete($where,'level_user');
			$this->session->set_flashdata('message', '<div id="message" class="alert alert-warning alert-dismissible fade show" role="alert">
                <i class="far fa-check-circle"></i> Data telah dihapus.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
		}else{
			redirect('setting/users');
		}
	}
}
