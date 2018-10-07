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
/*		public function edit($slug){
			// Check login
			if(!$this->session->userdata('logged_in')){
				redirect('users/login');
			}

			$data['post'] = $this->post_model->get_posts($slug);

			// Check user
			if($this->session->userdata('user_id') != $this->post_model->get_posts($slug)['user_id']){
				redirect('posts');

			}

			$data['categories'] = $this->post_model->get_categories();

			if(empty($data['post'])){
				show_404();
			}

			$data['title'] = 'Edit Post';

			$this->load->view('templates/header');
			$this->load->view('posts/edit', $data);
			$this->load->view('templates/footer');
		}

		public function update(){
			// Check login
			if(!$this->session->userdata('logged_in')){
				redirect('users/login');
			}

			$this->post_model->update_post();

			// Set message
			$this->session->set_flashdata('post_updated', 'Your post has been updated');

			redirect('posts');
		}*/
	}