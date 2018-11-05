<?php defined('BASEPATH') OR exit('No direct script access allowed');
	class Profesores extends CI_Controller{

		public function index(){
			if(!$this->session->userdata('logged_in')){
				redirect('cred/login');
			}
			if(!in_array(Array ( 'role' => 'adminC' ), $this->session->userdata('roles'))){
				redirect('cred/e403');
			}
			$data['title'] = 'Administración de profesores';
			$data['profesores'] = $this->profesores_model->get_profesores();
			
			$this->load->view('templates/header');
			$this->load->view('profesores/index', $data);
			$this->load->view('templates/footer');
		}

		public function nuevo(){
			if(!$this->session->userdata('logged_in')){
				redirect('cred/login');
			}
			if(!in_array(Array ( 'role' => 'adminC' ), $this->session->userdata('roles'))){
				redirect('cred/e403');
			}
			$data['title'] = 'Registrar nuevo profesor';

			$this->form_validation->set_rules('pro_nombre', 'Nombre', 'required');
			$this->form_validation->set_rules('pro_ap', 'Apellido Paterno', 'required');
			$this->form_validation->set_rules('pro_correoE', 'Correo Electronico', 'required');
			$this->form_validation->set_rules('pro_user', 'Usuario', 'required|callback_revisar_usuario_disponible');
			$this->form_validation->set_rules('pro_tipo', 'Tipo de profesor', 'required');

			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('profesores/nuevo', $data);
				$this->load->view('templates/footer');
			} else {
				$this->profesores_model->nuevo_profesor();
				$this->session->set_flashdata('profesor_creado','Profesor creado exitosamente.');
				redirect('profesores');
			}
		}

		public function borrar($id){
			if(!$this->session->userdata('logged_in')){
				redirect('cred/login');
			}
			if(!in_array(Array ( 'role' => 'adminC' ), $this->session->userdata('roles'))){
				redirect('cred/e403');
			}
			$this->profesores_model->borra_profesor($id);
			$this->session->set_flashdata('profesor_borrado','Profesor borrado exitosamente.');
			redirect('profesores');
		}

		public function editar($id){
			if(!$this->session->userdata('logged_in')){
				redirect('cred/login');
			}
			if(!in_array(Array ( 'role' => 'adminC' ), $this->session->userdata('roles'))){
				redirect('cred/e403');
			}
			$data['profesor'] = $this->profesores_model->get_profesor($id);
			if(empty($data['profesor'])){
				show_404();
			}
			$data['title'] = 'Editar Profesor';
			$this->load->view('templates/header');
			$this->load->view('profesores/editar', $data);
			$this->load->view('templates/footer');
		}

		public function actualizar(){
			if(!$this->session->userdata('logged_in')){
				redirect('cred/login');
			}
			if(!in_array(Array ( 'role' => 'adminC' ), $this->session->userdata('roles'))){
				redirect('cred/e403');
			}

			$this->profesores_model->actualizar();
			$this->session->set_flashdata('profesor_editado','Profesor editado exitosamente.');
			redirect('profesores');
		}

		public function revisar_usuario_disponible($username){
			if(!$this->session->userdata('logged_in')){
				redirect('cred/login');
			}
			if(!in_array(Array ( 'role' => 'adminC' ), $this->session->userdata('roles'))){
				redirect('cred/e403');
			}
			$this->form_validation->set_message('revisar_usuario_disponible','Usuario no disponible. Elige uno diferente');
			if($this->credenciales_model->credencial_existente($username)){
				return true;
			}else{
				return false;
			}
		}
	}