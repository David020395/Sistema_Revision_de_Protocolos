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
	}