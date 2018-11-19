<?php defined('BASEPATH') OR exit('No direct script access allowed');
	class Unidades_model extends CI_Model{
		public function __construct(){
			$this->load->database();
		}

		public function get_unidades(){
			$this->db->order_by('unidadacademica.uni_ID');
			$query = $this->db->get('unidadacademica');
			return $query->result_array();
		}
	}