<?php defined('BASEPATH') OR exit('No direct script access allowed');
	class Alumnos extends CI_Controller{

		public function index(){	
			$data['title'] = 'Administración de alumnos';

			$data['alumnos'] = $this->alumnos_model->get_alumnos();
			
			$this->load->view('templates/header');
			$this->load->view('alumnos/index', $data);
			$this->load->view('templates/footer');
		}

		public function nuevo(){
			$data['title'] = 'Registrar nuevo alumno';

			$data['licenciaturas'] = $this->licenciaturas_model->get_licenciaturas();

			$this->form_validation->set_rules('alu_nombre', 'Nombre', 'required');
			$this->form_validation->set_rules('alu_numCuenta', 'Numero de Cuenta', 'required');
			$this->form_validation->set_rules('alu_user', 'Usuario', 'required');
			$this->form_validation->set_rules('alu_correoE', 'Correo Electronico', 'required');
			$this->form_validation->set_rules('alu_licenciatura', 'Licenciatura', 'required');

			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('alumnos/nuevo', $data);
				$this->load->view('templates/footer');
			} else {
				$this->alumnos_model->nuevo_alumno();
				redirect('alumnos');
			}
		}

		public function borrar($id){
			$this->alumnos_model->borra_alumno($id);
			redirect('alumnos');
		}

		public function editar($id){
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
			$this->alumnos_model->actualizar();
			redirect('alumnos');
		}
	}