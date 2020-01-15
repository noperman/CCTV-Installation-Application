<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct(){
		parent::__construct();
		
		if($this->session->userdata('level_user') == 1){
			redirect('admin');
		}elseif($this->session->userdata('level_user') == 2){
			redirect('admin');
		}elseif($this->session->userdata('level_user') >= 3){
			redirect('teknisi');
		}
	}

	public function index()
	{
		$this->form_validation->set_rules('email', 'Email','trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password','trim|required');
		if($this->form_validation->run() == false){
		$this->template->set('title','Sign In');
		$this->template->load('template/auth_base','auth/index');
		}else{
			$this->_login();
		}
	}

	public function register(){
		$this->template->set('title','Register');
		$this->template->load('template/auth_base','auth/register');
	}

	private function _login(){
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$user = $this->db->get_where('user', ['email' => $email])->row_array();

		//jika user aad
		if($user != NULL){
			//jika user aktif
			if($user['status'] == 1){
				//cek password
				if(password_verify($password, $user['password'])){
					$data = [
						'id_user' => $user['id'],
						'username' => $user['fullname'],
						'email' => $user['email'],
						'level_user' => $user['id_level'],
						'status' => $user['status']
					];
					$this->session->set_userdata($data);
					if($user['id_level'] == 1){
						redirect('admin');
					}elseif($user['id_level'] == 2){
						redirect('admin');
					}elseif($user['id_level'] >= 3){
						redirect('teknisi');
					}else{
						$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">ID Invalid!</div>');
						redirect();
					}
				}else{
					$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Password salah!</div>');
					redirect();
				}
			}else{
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Email belum diaktivasi!</div>');
				redirect();
			}

		}else{
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Email tidak terdaftar!</div>');
			redirect();
		}
	}
}
