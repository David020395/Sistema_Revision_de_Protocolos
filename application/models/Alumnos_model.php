<?php defined('BASEPATH') OR exit('No direct script access allowed');
	class Alumnos_model extends CI_Model{
		public function __construct(){
			$this->load->database();
		}

		public function get_alumnos(){
			$this->db->where('alu_activo', 1);
			$this->db->select('alu_ID, alu_nombre, alu_numCuenta, alu_credencial, cre_user, alu_correoE, alu_egresado, lic_ID,  lic_nombre');
			$this->db->order_by('alumnos.alu_numCuenta');
			$this->db->from('alumnos');
			$this->db->join('licenciaturas', 'alumnos.alu_licenciatura = licenciaturas.lic_ID');
			$this->db->join('credenciales', 'alumnos.alu_credencial = credenciales.cre_ID');
			$query = $this->db->get();
			return $query->result_array();
		}

		public function get_alumno($id){
			$this->db->where('alu_ID', $id);
			$this->db->select('alu_ID, alu_nombre, alu_licenciatura, alu_numCuenta, alu_credencial, cre_user as alu_user, alu_correoE, alu_egresado, lic_ID,  lic_nombre');
			$this->db->from('alumnos');
			$this->db->join('licenciaturas', 'alumnos.alu_licenciatura = licenciaturas.lic_ID');
			$this->db->join('credenciales', 'alumnos.alu_credencial = credenciales.cre_ID');
			$query = $this->db->get();
			return $query->row_array();
		}

		public function nuevo_alumno(){
			$data = array(
				'alu_nombre' => $this->input->post('alu_nombre'),
				'alu_numCuenta' => $this->input->post('alu_numCuenta'),
				'alu_correoE' => $this->input->post('alu_correoE'),
				'alu_licenciatura' => $this->input->post('alu_licenciatura')
			);
			if($this->input->post('alu_egresado') == 1){
				$data['alu_egresado'] = 1;
			}else{
				$data['alu_egresado'] = 0;
			}
			$data['alu_activo'] = 1;
			$idC = $this->nueva_credencial();
			$data['alu_credencial'] = $idC['cre_ID'];
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

		public function nueva_credencial(){
			$data = array(
				'cre_user' => $this->input->post('alu_user'),
				'cre_type' => 3
			);
			$data['cre_pass'] = 'panyqueso';
			$this->db->insert('credenciales', $data);
			$this->db->select_max('cre_ID');
			$query = $this->db->get('credenciales');
			$id = $query->row_array();
			$this->db->where('cre_user', $data['cre_user']);
			$this->db->where('cre_pass', $data['cre_pass']);
			$this->db->where('cre_ID', $id['cre_ID']);
			$this->db->from('credenciales');
			$query = $this->db->get();
			return $query->row_array();
		}

		public function get_id_for_cred($id){
			$this->db->where('alu_credencial', $id);
			$this->db->select('alu_ID');
			$this->db->from('alumnos');
			$query = $this->db->get();
			return $query->row_array();
		}

		public function get_email_alumno($id){
			$this->db->where('alu_ID', $id);
			$this->db->select('alu_correoE');
			$this->db->from('alumnos');
			$query = $this->db->get();
			return $query->row_array();
		}

		public function actualizarEmail($id){
			$this->db->where('alu_ID', $id);
			$this->db->from('alumnos');
			$query = $this->db->get();
			$data = $query->row_array();
			$data['alu_correoE'] = $this->input->post('correoE');
			$this->db->where('alu_ID', $id);
			return $this->db->update('alumnos', $data);
		}
	}