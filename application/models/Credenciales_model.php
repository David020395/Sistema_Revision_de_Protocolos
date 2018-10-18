<?php defined('BASEPATH') OR exit('No direct script access allowed');
	class Credenciales_model extends CI_Model{
		public function __construct(){
			$this->load->database();
		}

		public function credencial_existente($username){
			$query = $this->db->get_where('credenciales',array('cre_user' => $username));
			if(empty($query->row_array())){
				return true;
			}else{
				return false;
			}
		}

		public function login($username, $password){
			$this->db->where('cre_user', $username);
			$this->db->where('cre_pass', $password);
			$result = $this->db->get('credenciales');
			if($result->num_rows()==1){
				return $result->row(0)->cre_ID;
			}else{
				return false;
			}
		}

		public function get_rolesForUser($id){
			$this->db->where('cre_ID', $id);
			$this->db->select('per_nombre as role');
			$this->db->from('credenciales');
			$this->db->join('credencialpermisos', 'credenciales.cre_ID = credencialpermisos.cre_ID_ref');
			$this->db->join('permisos', 'credencialpermisos.per_ID_ref = permisos.per_ID');
			$query = $this->db->get();
			return $query->result_array();
		}

		public function get_cretype($id){
			$this->db->where('cre_ID', $id);
			$this->db->select('cre_type');
			$this->db->from('credenciales');
			$query = $this->db->get();
			return $query->row_array();
		}

		public function actualizarPass($id){
			$this->db->where('cre_ID', $id);
			$this->db->from('credenciales');
			$query = $this->db->get();
			$data = $query->row_array();
			$data['cre_pass'] = $this->input->post('password');
			$this->db->where('cre_ID', $id);
			return $this->db->update('credenciales', $data);
		}
	}