<?php defined('BASEPATH') OR exit('No direct script access allowed');
	class Alumnos extends CI_Controller{

		public function index(){
			if(!$this->session->userdata('logged_in')){
				redirect('cred/login');
			}

			$data['title'] = 'Administración de alumnos';

			$data['alumnos'] = $this->alumnos_model->get_alumnos();
			
			$this->load->view('templates/header');
			$this->load->view('alumnos/index', $data);
			$this->load->view('templates/footer');
		}

		public function nuevo(){
			if(!$this->session->userdata('logged_in')){
				redirect('cred/login');
			}

			$data['title'] = 'Registrar nuevo alumno';

			$data['licenciaturas'] = $this->licenciaturas_model->get_licenciaturas();

			$this->form_validation->set_rules('alu_nombre', 'Nombre', 'required');
			$this->form_validation->set_rules('alu_numCuenta', 'Numero de Cuenta', 'required');
			$this->form_validation->set_rules('alu_user', 'Usuario', 'required|callback_revisar_usuario_disponible');
			$this->form_validation->set_rules('alu_correoE', 'Correo Electronico', 'required');
			$this->form_validation->set_rules('alu_licenciatura', 'Licenciatura', 'required');

			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('alumnos/nuevo', $data);
				$this->load->view('templates/footer');
			} else {
				$this->alumnos_model->nuevo_alumno();
				$this->session->set_flashdata('alumno_creado','Alumno creado exitosamente.');
				redirect('alumnos');
			}
		}

		public function borrar($id){
			if(!$this->session->userdata('logged_in')){
				redirect('cred/login');
			}

			$this->alumnos_model->borra_alumno($id);
			$this->session->set_flashdata('alumno_borrado','Alumno borrado exitosamente.');
			redirect('alumnos');
		}

		public function editar($id){
			if(!$this->session->userdata('logged_in')){
				redirect('cred/login');
			}

			$data['alumno'] = $this->alumnos_model->get_alumno($id);

			$data['licenciaturas'] = $this->licenciaturas_model->get_licenciaturas();

			if(empty($data['alumno'])){
				show_404();
			}

			$data['title'] = 'Editar Alumno';

			$this->load->view('templates/header');
			$this->load->view('alumnos/editar', $data);
			$this->load->view('templates/footer');
		}

		public function actualizar(){
			if(!$this->session->userdata('logged_in')){
				redirect('cred/login');
			}

			$this->alumnos_model->actualizar();
			$this->session->set_flashdata('alumno_editado','Alumno editado exitosamente.');
			redirect('alumnos');
		}

		public function revisar_usuario_disponible($username){
			if(!$this->session->userdata('logged_in')){
				redirect('cred/login');
			}

			$this->form_validation->set_message('revisar_usuario_disponible','Usuario no disponible. Elige uno diferente');
			if($this->credenciales_model->credencial_existente($username)){
				return true;
			}else{
				return false;
			}
		}
	}