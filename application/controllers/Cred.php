<?php defined('BASEPATH') OR exit('No direct script access allowed');
	class Cred extends CI_Controller{

		public function login(){
			$data['title'] = 'Ingresar';

			$this->form_validation->set_rules('username','Usuario','required');
			$this->form_validation->set_rules('password','Contraseña','required');

			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('pages/login',$data);
				$this->load->view('templates/footer');
			}else{
				$username = $this->input->post('username');
				//$password = md5($this->input->post('password'));
				$password = $this->input->post('password');

				$user_id = $this->credenciales_model->login($username, $password);
				if($user_id){
					$user_data = array('user_id' => $user_id, 'username' => $username, 'logged_in' => true);
					$this->session->set_userdata($user_data);
					$this->session->set_flashdata('login_correcto','Sesion iniciada correctamente.');
					redirect('');
				}else{
					$this->session->set_flashdata('login_failo','Error al iniciar sesion. Intente nuevamente.');
					redirect('cred/login');
				}
			}
		}

		public function logout(){
			$this->session->unset_userdata('logged_in');
			$this->session->unset_userdata('username');
			$this->session->unset_userdata('user_id');
			$this->session->set_flashdata('logout','Sesion cerrada correctamente');
			redirect('cred/login');
		}
	}