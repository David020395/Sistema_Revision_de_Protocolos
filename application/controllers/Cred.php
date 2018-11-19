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
					$roles = $this->credenciales_model->get_rolesForUser($user_id);
					$cred_type = $this->credenciales_model->get_cretype($user_id);
					$cred_type = $cred_type['cre_type'];
					if($cred_type==1){
						$user_dbn = $this->administradores_model->get_id_for_cred($user_id);
						$user_dbn = $user_dbn['adm_ID'];
					}else if($cred_type==2){
						$user_dbn = $this->profesores_model->get_id_for_cred($user_id);
						$user_dbn = $user_dbn['pro_ID'];
					}else if($cred_type==3){
						$user_dbn = $this->alumnos_model->get_id_for_cred($user_id);
						$user_dbn = $user_dbn['alu_ID'];
					}
					$user_data = array('user_id' => $user_id, 'username' => $username, 'cre_type' => $cred_type, 'roles' => $roles, 'user_dbn' => $user_dbn, 'logged_in' => true);
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
			$this->session->unset_userdata('roles');
			$this->session->set_flashdata('logout','Sesion cerrada correctamente');
			redirect('cred/login');
		}

		public function e403(){
			$data['title'] = 'Acceso prohibido';
			$this->load->view('templates/header');
			$this->load->view('errors/html/error_403',$data);
			$this->load->view('templates/footer');
		}

		public function change_user_fields(){
			if(!$this->session->userdata('logged_in')){
				redirect('cred/login');
			}
			$cre_type = $this->session->userdata('cre_type');
			if($cre_type==1){ //cambio para administrador
				$data['email'] = $this->administradores_model->get_email_admin($this->session->userdata('user_dbn'));
				$data['email'] = $data['email']['adm_correoE'];
			}else if($cre_type==2){ //cambio para profesor
				$data['email'] = $this->profesores_model->get_email_profesor($this->session->userdata('user_dbn'));
				$data['email'] = $data['email']['pro_correoE'];
			}else if($cre_type==3){ //cambio para alumno
				$data['email'] = $this->alumnos_model->get_email_alumno($this->session->userdata('user_dbn'));
				$data['email'] = $data['email']['alu_correoE'];
			}

			if(empty($data['email'])){
				show_404();
			}

			$data['title'] = 'Administrar cuenta personal';

			$this->load->view('templates/header');
			$this->load->view('cred/editar', $data);
			$this->load->view('templates/footer');
		}

		public function actualizar(){
			if(!$this->session->userdata('logged_in')){
				redirect('cred/login');
			}
			$cre_type = $this->session->userdata('cre_type');
			if($cre_type==1){ //cambio para administrador
				$this->administradores_model->actualizarEmail($this->session->userdata('user_dbn'));
			}else if($cre_type==2){ //cambio para profesor
				$this->profesores_model->actualizarEmail($this->session->userdata('user_dbn'));
			}else if($cre_type==3){ //cambio para alumno
				$this->alumnos_model->actualizarEmail($this->session->userdata('user_dbn'));
			}
			if(!empty($this->input->post('password'))){
				$this->credenciales_model->actualizarPass($this->session->userdata('user_id'));
			}
			$this->session->set_flashdata('cuenta_actualizada','Cuenta actualizada exitosamente.');
			redirect('');
		}
	}