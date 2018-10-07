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

		public function get_alumno($id){
			$this->db->where('alu_ID', $id);
			$this->db->select('alu_ID, alu_nombre, alu_licenciatura, alu_numCuenta, alu_user, alu_correoE, alu_egresado, lic_ID,  lic_nombre');
			$this->db->from('alumnos');
			$this->db->join('licenciaturas', 'alumnos.alu_licenciatura = licenciaturas.lic_ID');
			$query = $this->db->get();
			return $query->row_array();
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

		public function actualizar(){
			$this->db->where('alu_ID', $this->input->post('alu_ID'));
			$this->db->from('alumnos');
			$query = $this->db->get();
			$data = $query->row_array();
			$data['alu_nombre'] = $this->input->post('alu_nombre');
			$data['alu_numCuenta'] = $this->input->post('alu_numCuenta');
			$data['alu_correoE'] = $this->input->post('alu_correoE');
			$data['alu_licenciatura'] = $this->input->post('alu_licenciatura');
			if($this->input->post('alu_egresado') == 1){
				$data['alu_egresado'] = 1;
			}else{
				$data['alu_egresado'] = 0;
			}
			$this->db->where('alu_ID', $this->input->post('alu_ID'));
			return $this->db->update('alumnos', $data);
		}
	}