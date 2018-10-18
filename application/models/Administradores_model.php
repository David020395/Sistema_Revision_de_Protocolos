<?php defined('BASEPATH') OR exit('No direct script access allowed');
	class Administradores_model extends CI_Model{
		public function __construct(){
			$this->load->database();
		}

		public function get_id_for_cred($id){
			$this->db->where('adm_credencial', $id);
			$this->db->select('adm_ID');
			$this->db->from('administradores');
			$query = $this->db->get();
			return $query->row_array();
		}

		public function get_email_admin($id){
			$this->db->where('adm_ID', $id);
			$this->db->select('adm_correoE');
			$this->db->from('administradores');
			$query = $this->db->get();
			return $query->row_array();
		}

		public function actualizarEmail($id){
			$this->db->where('adm_ID', $id);
			$this->db->from('administradores');
			$query = $this->db->get();
			$data = $query->row_array();
			$data['adm_correoE'] = $this->input->post('correoE');
			$this->db->where('adm_ID', $id);
			return $this->db->update('administradores', $data);
		}
	}