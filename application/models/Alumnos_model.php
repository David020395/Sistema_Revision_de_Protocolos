<?php defined('BASEPATH') OR exit('No direct script access allowed');
	class Alumnos_model extends CI_Model{
		public function __construct(){
			$this->load->database();
		}

		public function get_alumnos(){
			$this->db->where('alu_activo', 1);
			$this->db->select('alu_ID, alu_nombre, alu_numCuenta, alu_user, alu_correoE, alu_egresado, lic_ID,  lic_nombre');
			$this->db->order_by('alumnos.alu_numCuenta');
			$this->db->from('alumnos');
			$this->db->join('licenciaturas', 'alumnos.alu_licenciatura = licenciaturas.lic_ID');
			$query = $this->db->get();
			return $query->result_array();
		}

		public function nuevo_alumno(){
			$data = array(
				'alu_nombre' => $this->input->post('alu_nombre'),
				'alu_numCuenta' => $this->input->post('alu_numCuenta'),
				'alu_user' => $this->input->post('alu_user'),
				'alu_correoE' => $this->input->post('alu_correoE'),
				'alu_licenciatura' => $this->input->post('alu_licenciatura')
			);
			if($this->input->post('alu_egresado') == 1){
				$data['alu_egresado'] = 1;
			}else{
				$data['alu_egresado'] = 0;
			}
			$data['alu_activo'] = 1;
			$data['alu_pass'] = 'panyqueso';
			return $this->db->insert('alumnos', $data);
		}

		public function borra_alumno($id){
			$this->db->where('alu_ID', $id);
			$this->db->from('alumnos');
			$query = $this->db->get();
			$data = $query->row_array();
			$data['alu_activo'] = 0;
			$this->db->where('alu_ID', $id);
			$this->db->update('alumnos', $data);
			return true;
		}

		/*
		public function update_post(){
			$slug = url_title($this->input->post('title'));

			$data = array(
				'title' => $this->input->post('title'),
				'slug' => $slug,
				'body' => $this->input->post('body'),
				'category_id' => $this->input->post('category_id')
			);

			$this->db->where('id', $this->input->post('id'));
			return $this->db->update('posts', $data);
		}

		public function get_categories(){
			$this->db->order_by('name');
			$query = $this->db->get('categories');
			return $query->result_array();
		}

		public function get_posts_by_category($category_id){
			$this->db->order_by('posts.id', 'DESC');
			$this->db->join('categories', 'categories.id = posts.category_id');
				$query = $this->db->get_where('posts', array('category_id' => $category_id));
			return $query->result_array();
		}*/
	}