<?php defined('BASEPATH') OR exit('No direct script access allowed');
	class Licenciaturas_model extends CI_Model{
		public function __construct(){
			$this->load->database();
		}

		public function get_licenciaturas(){
			$this->db->order_by('licenciaturas.lic_ID');
			$query = $this->db->get('licenciaturas');
			return $query->result_array();
		}
	}