<?php defined('BASEPATH') OR exit('No direct script access allowed');
	class Profesores_model extends CI_Model{
		public function __construct(){
			$this->load->database();
		}

		public function get_profesores_revisores(){
			$this->db->where('pro_activo', 1);
			$this->db->from('profesores');
			$query = $this->db->get();
			return $query->result_array();
		}

		public function get_profesores_coordinadores(){
			$this->db->where('pro_activo', 1);
			$this->db->where('pro_comite', 1);
			$this->db->from('profesores');
			$query = $this->db->get();
			return $query->result_array();
		}

		public function get_profesores(){
			$this->db->where('pro_activo', 1);
			$this->db->from('profesores');
			$query = $this->db->get();
			return $query->result_array();
		}

		public function nuevo_profesor(){
			$data = array(
				'pro_nombre' => $this->input->post('alu_nombre'),
				'pro_tipo' => $this->input->post('pro_tipo'),
				'pro_correoE' => $this->input->post('alu_correoE'),
				'pro_indicadorExito' => 50,
				'pro_indicadorDesapego' => 0,
				'pro_trabajosActivos' => 0,
				'pro_activo' => 1
			);
			if($this->input->post('pro_comite') == 1){
				$data['pro_comite'] = 1;
			}else{
				$data['pro_comite'] = 0;
			}
			$idC = $this->nueva_credencial();
			$data['pro_credencial'] = $idC['cre_ID'];
			return $this->db->insert('profesores', $data);
		}

		public function nueva_credencial(){
			$data = array(
				'cre_user' => $this->input->post('pro_user'),
				'cre_type' => 2
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

		public function borra_profesor($id){
			$this->db->where('pro_ID', $id);
			$this->db->from('profesores');
			$query = $this->db->get();
			$data = $query->row_array();
			$data['pro_activo'] = 0;
			$this->db->where('pro_ID', $id);
			$this->db->update('profesores', $data);
			return true;
		}

		public function get_profesor($id){
			$this->db->where('pro_ID', $id);
			$this->db->select('pro_ID, pro_nombre, pro_credencial, cre_user as pro_user, pro_correoE, pro_comite, pro_tipo,  pro_trabajosActivos');
			$this->db->from('profesores');
			$this->db->join('credenciales', 'profesores.pro_credencial = credenciales.cre_ID');
			$query = $this->db->get();
			return $query->row_array();
		}

		public function actualizar(){
			$this->db->where('pro_ID', $this->input->post('pro_ID'));
			$this->db->from('profesores');
			$query = $this->db->get();
			$data = $query->row_array();
			$data['pro_nombre'] = $this->input->post('pro_nombre');
			$data['pro_correoE'] = $this->input->post('pros_correoE');
			$data['pro_tipo'] = $this->input->post('pro_tipo');
			if($this->input->post('pro_comite') == 1){
				$data['pro_comite'] = 1;
			}else{
				$data['pro_comite'] = 0;
			}
			$this->db->where('pro_ID', $this->input->post('pro_ID'));
			return $this->db->update('profesores', $data);
		}

		public function get_id_for_cred($id){
			$this->db->where('pro_credencial', $id);
			$this->db->select('pro_ID');
			$this->db->from('profesores');
			$query = $this->db->get();
			return $query->row_array();
		}

		public function get_email_profesor($id){
			$this->db->where('pro_ID', $id);
			$this->db->select('pro_correoE');
			$this->db->from('profesores');
			$query = $this->db->get();
			return $query->row_array();
		}

		public function actualizarEmail($id){
			$this->db->where('pro_ID', $id);
			$this->db->from('profesores');
			$query = $this->db->get();
			$data = $query->row_array();
			$data['pro_correoE'] = $this->input->post('correoE');
			$this->db->where('pro_ID', $id);
			return $this->db->update('profesores', $data);
		}
	}