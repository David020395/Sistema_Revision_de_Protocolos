<?php defined('BASEPATH') OR exit('No direct script access allowed');
	class Protocolos_model extends CI_Model{
		public function __construct(){
			$this->load->database();
		}

		public function get_protocolos_for_adminT_S(){
			$this->db->where('proc_estatus', 7);
			$this->db->where('proc_activo', 1);
			$this->db->select('proc_ID, proc_ID, alu_nombre, alu_numCuenta, proc_nombre, proc_iniciado, proc_estatus, est_ID, est_descripcion');
			$this->db->order_by('proc_iniciado','DESC');
			$this->db->from('procesotitulacion');
			$this->db->join('alumnos', 'alumnos.alu_ID = procesotitulacion.alu_ID_ref');
			$this->db->join('estatusprotocolo', 'estatusprotocolo.est_ID = procesotitulacion.proc_estatus');
			$query = $this->db->get();
			return $query->result_array();
		}

		public function get_protocolos_for_adminT(){
			$this->db->where('proc_estatus <', 9);
			$this->db->where('proc_estatus >', 0);
			$this->db->where('proc_estatus !=', 7);
			$this->db->where('proc_activo', 1);
			$this->db->select('proc_ID, alu_nombre, alu_numCuenta, proc_nombre, proc_iniciado, proc_estatus, est_ID, est_descripcion');
			$this->db->order_by('proc_iniciado','DESC');
			$this->db->from('procesotitulacion');
			$this->db->join('alumnos', 'alumnos.alu_ID = procesotitulacion.alu_ID_ref');
			$this->db->join('estatusprotocolo', 'estatusprotocolo.est_ID = procesotitulacion.proc_estatus');
			$query = $this->db->get();
			return $query->result_array();
		}

		public function get_protocolos_for_alumno(){
			$this->db->where('alu_ID_ref', $this->session->userdata('user_dbn'));
			$this->db->select('proc_ID, proc_nombre, proc_iniciado, proc_estatus, est_ID, est_descripcion');
			$this->db->order_by('proc_iniciado','DESC');
			$this->db->from('procesotitulacion');
			$this->db->join('alumnos', 'alumnos.alu_ID = procesotitulacion.alu_ID_ref');
			$this->db->join('estatusprotocolo', 'estatusprotocolo.est_ID = procesotitulacion.proc_estatus');
			$query = $this->db->get();
			return $query->result_array();
		}

		public function get_protocolos_for_adminC(){
			$this->db->where('proc_estatus', 8);
			$this->db->select('proc_ID, proc_nombre, proc_iniciado');
			$this->db->order_by('proc_iniciado','DESC');
			$this->db->from('procesotitulacion');
			$this->db->join('estatusprotocolo', 'estatusprotocolo.est_ID = procesotitulacion.proc_estatus');
			$query = $this->db->get();
			return $query->result_array();
		}

		public function get_protocolos_for_revisor(){
			$this->db->where('proc_estatus', 10);
			$this->db->select('proc_ID, proc_nombre, proc_iniciado, proc_estatus, est_ID, est_descripcion');
			$this->db->order_by('proc_iniciado','DESC');
			$this->db->from('procesotitulacion');
			$this->db->join('estatusprotocolo', 'estatusprotocolo.est_ID = procesotitulacion.proc_estatus');
			$query = $this->db->get();
			return $query->result_array();
		}

		public function get_protocolo_by_id($id){
			$this->db->where('proc_ID', $id);
			$this->db->from('procesotitulacion');
			$query = $this->db->get();
			return $query->row_array();
		}

		public function nuevo_protocolo(){
			$data = array(
				'proc_nombre' => $this->input->post('proc_nombre'),
				'proc_estatus' => 7,
				'proc_activo' => 1,
				'alu_ID_ref' => $this->session->userdata('user_dbn')
			);
			$this->db->insert('procesotitulacion',$data);
			$this->db->where($data);
			$this->db->order_by('proc_ID','DESC');
			$this->db->select('proc_ID');
			$this->db->from('procesotitulacion');
			$query = $this->db->get();
			return $query->row_array();
		}

		public function cambia_estatus_protocolo($id,$estatus){
			$this->db->where('proc_ID', $id);
			$this->db->from('procesotitulacion');
			$query = $this->db->get();
			$data = $query->row_array();
			$data['proc_estatus'] = $estatus;
			$this->db->where('proc_ID', $id);
			return $this->db->update('procesotitulacion', $data);
		}

		public function cambia_iniciado_protocolo($id,$iniciado){
			$this->db->where('proc_ID', $id);
			$this->db->from('procesotitulacion');
			$query = $this->db->get();
			$data = $query->row_array();
			$data['proc_iniciado'] = $iniciado;
			$this->db->where('proc_ID', $id);
			return $this->db->update('procesotitulacion', $data);
		}

		public function gen_secuence($id){
			$this->db->where('proc_ID', $id);
			$this->db->from('procesotitulacion');
			$query = $this->db->get();
			$data = $query->row_array();
			$data['proc_sec'] = $data['proc_sec']+1;
			$this->db->where('proc_ID', $id);
			$this->db->update('procesotitulacion', $data);
			return $data['proc_sec'];
		}

		public function nuevo_archivo($nom_arch, $ext, $id, $arc_fecha, $sec, $arcP){
			$data = array(
				'arc_nombre' => $nom_arch,
				'arc_ext' => $ext,
				'proc_ID_ref' => $id,
				'arc_fecha' => $arc_fecha,
				'arc_sec' => $sec,
				'arc_P' => $arcP
			);
			return $this->db->insert('archivos',$data);
		}

		public function get_last_archivoP($proc_id){
			$this->db->where('proc_ID_ref', $proc_id);
			$this->db->where('arc_P', 1);
			$this->db->order_by('arc_sec','DESC');
			$query = $this->db->get('archivos');
			return $query->row_array();
		}

		public function get_last_archivo($proc_id){
			$this->db->where('proc_ID_ref', $proc_id);
			$this->db->where('arc_P', 0);
			$this->db->order_by('arc_sec','DESC');
			$query = $this->db->get('archivos');
			return $query->row_array();
		}

		public function get_protocolos_status_for_me($status, $id, $cord){
			$this->db->where('proc_estatus', $status);
			$this->db->where('pro_ID_ref', $id);
			if($cord){
				$this->db->where('rev_coordinador', 1);
			}
			$this->db->select('proc_ID, proc_nombre, proc_iniciado, proc_estatus, est_ID, est_descripcion');
			$this->db->order_by('proc_iniciado','DESC');
			$this->db->from('procesotitulacion');
			$this->db->join('estatusprotocolo', 'estatusprotocolo.est_ID = procesotitulacion.proc_estatus');
			$this->db->join('revisorproc', 'revisorproc.proc_ID_ref = procesotitulacion.proc_ID');
			$query = $this->db->get();
			return $query->result_array();
		}

		public function get_rev($proc, $prof){
			$this->db->where('proc_ID_ref', $proc);
			$this->db->where('pro_ID_ref', $prof);
			$this->db->where('rev_activo', 1);
			$this->db->select('rev_ID');
			$this->db->from('revisorproc');
			$query = $this->db->get();
			return $query->row_array();
		}

		public function nuevo_observacion(){
			$proc_ID = $this->input->post('proc_ID');
			$rev_ID = $this->get_rev($proc_ID, $this->session->userdata('user_dbn'));
			$rev_ID = $rev_ID['rev_ID'];
			$obs_descripcion = $this->input->post('obs_descripcion');
			$data = array(
				'rev_ID_ref' => $rev_ID,
				'obs_descripcion' => $obs_descripcion
			);
			return $this->db->insert('observaciones',$data); 
		}

		public function get_observaciones(){
			$proc_ID = $this->input->post('proc_ID');
			$this->db->where('proc_ID_ref', $proc_ID);
			$this->db->select('obs_ID, pro_nombre as obs_autor, pro_ap as obs_autorap, pro_am as obs_autoram, obs_fecha, obs_descripcion, rev_ID_ref');
			$this->db->order_by('obs_fecha','DESC');
			$this->db->from('observaciones');
			$this->db->join('revisorproc', 'revisorproc.rev_ID = observaciones.rev_ID_ref');
			$this->db->join('profesores', 'revisorproc.pro_ID_ref = profesores.pro_ID');
			$query = $this->db->get();
			return $query->result_array();
		}

		public function get_estatus(){
			$this->db->where('est_ID !=', 7);
			$this->db->where('est_ID !=', 8);
			$this->db->where('est_ID !=', 9);
			$this->db->where('est_ID !=', 10);
			$this->db->from('estatusprotocolo');
			$query = $this->db->get();
			return $query->result_array();
		}

		public function nuevo_asignacion($proc_ID){
			$data = array(
				'proc_ID_ref' => $proc_ID,
				'pro_ID_ref' => $this->input->post('proc_c'),
				'rev_coordinador' => 1,
				'rev_activo' => 1
			);
			$this->db->insert('revisorproc',$data);
			if($this->input->post('proc_r1')!=""){
				$data = array(
					'proc_ID_ref' => $proc_ID,
					'pro_ID_ref' => $this->input->post('proc_r1'),
					'rev_coordinador' => 0,
					'rev_activo' => 1
				);
				$this->db->insert('revisorproc',$data);
			}
			if($this->input->post('proc_r2')!=""){
				$data = array(
					'proc_ID_ref' => $proc_ID,
					'pro_ID_ref' => $this->input->post('proc_r2'),
					'rev_coordinador' => 0,
					'rev_activo' => 1
				);
				$this->db->insert('revisorproc',$data);
			}
			if($this->input->post('proc_r3')!=""){
				$data = array(
					'proc_ID_ref' => $proc_ID,
					'pro_ID_ref' => $this->input->post('proc_r3'),
					'rev_coordinador' => 0,
					'rev_activo' => 1
				);
				$this->db->insert('revisorproc',$data);
			}
			if($this->input->post('proc_r4')!=""){
				$data = array(
					'proc_ID_ref' => $proc_ID,
					'pro_ID_ref' => $this->input->post('proc_r4'),
					'rev_coordinador' => 0,
					'rev_activo' => 1
				);
				$this->db->insert('revisorproc',$data);
			}
			if($this->input->post('proc_r5')!=""){
				$data = array(
					'proc_ID_ref' => $proc_ID,
					'pro_ID_ref' => $this->input->post('proc_r5'),
					'rev_coordinador' => 0,
					'rev_activo' => 1
				);
				$this->db->insert('revisorproc',$data);
			}
			return true;
		}
	}