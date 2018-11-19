<?php defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require dirname( __FILE__ ) . '/../../vendor/autoload.php';

	class Alumnos_model extends CI_Model{
		public function __construct(){
			$this->load->database();
		}

		public function get_alumnos(){
			$this->db->where('alu_activo', 1);
			$this->db->select('alu_ID, alu_nombre, alu_ap, alu_am, alu_numCuenta, alu_credencial, cre_user, alu_correoE, alu_egresado, lic_ID,  lic_nombre');
			$this->db->order_by('alumnos.alu_numCuenta','DESC');
			$this->db->from('alumnos');
			$this->db->join('licenciaturas', 'alumnos.alu_licenciatura = licenciaturas.lic_ID');
			$this->db->join('credenciales', 'alumnos.alu_credencial = credenciales.cre_ID');
			$query = $this->db->get();
			return $query->result_array();
		}

		public function get_alumno($id){
			$this->db->where('alu_ID', $id);
			$this->db->select('alu_ID, alu_nombre, alu_unidad, uni_ID, uni_nombre, alu_ap, alu_am, alu_licenciatura, alu_numCuenta, alu_credencial, cre_user as alu_user, alu_correoE, alu_egresado, lic_ID,  lic_nombre');
			$this->db->from('alumnos');
			$this->db->join('licenciaturas', 'alumnos.alu_licenciatura = licenciaturas.lic_ID');
			$this->db->join('credenciales', 'alumnos.alu_credencial = credenciales.cre_ID');
			$this->db->join('unidadacademica', 'alumnos.alu_unidad = unidadacademica.uni_ID');
			$query = $this->db->get();
			return $query->row_array();
		}

		public function nuevo_alumno(){
			$data = array(
				'alu_nombre' => $this->input->post('alu_nombre'),
				'alu_ap' => $this->input->post('alu_ap'),
				'alu_am' => $this->input->post('alu_am'),
				'alu_numCuenta' => $this->input->post('alu_numCuenta'),
				'alu_correoE' => $this->input->post('alu_correoE'),
				'alu_licenciatura' => $this->input->post('alu_licenciatura'),
				'alu_unidad' => $this->input->post('alu_unidad')
			);
			if($this->input->post('alu_egresado') == 1){
				$data['alu_egresado'] = 1;
			}else{
				$data['alu_egresado'] = 0;
			}
			$data['alu_activo'] = 1;
			$resul = $this->nueva_credencial();
			$idC = $resul['resultado'];
			$pass = $resul['pass'];
			$data['alu_credencial'] = $idC['cre_ID'];
			$this->db->insert('alumnos', $data);
			if ($this->sendMail($this->input->post('alu_correoE'), "Credenciales de Acceso", "Usuario: ".$this->input->post('alu_user')." Constraseña: ".$pass)){
				return true;
			}else{
				return false;
			}
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
			$data['alu_ap'] = $this->input->post('alu_ap');
			$data['alu_am'] = $this->input->post('alu_am');
			$data['alu_numCuenta'] = $this->input->post('alu_numCuenta');
			$data['alu_correoE'] = $this->input->post('alu_correoE');
			$data['alu_licenciatura'] = $this->input->post('alu_licenciatura');
			$data['alu_unidad'] = $this->input->post('alu_unidad');
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
			$pass = date(time());
			$data['cre_pass'] = $pass;
			$this->db->insert('credenciales', $data);
			$this->db->select_max('cre_ID');
			$query = $this->db->get('credenciales');
			$id = $query->row_array();
			$this->db->where('cre_user', $data['cre_user']);
			$this->db->where('cre_pass', $data['cre_pass']);
			$this->db->where('cre_ID', $id['cre_ID']);
			$this->db->from('credenciales');
			$query = $this->db->get();
			$resultado = $query->row_array();
			$idC = $resultado['cre_ID'];
			$data = array(
				'cre_ID_ref' => $idC,
				'per_ID_ref' => 1
			);
			$this->db->insert('credencialpermisos', $data);
			$datar['resultado'] = $resultado;
			$datar['pass'] = $pass;
			return $datar;
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

		private function sendMail($para, $asunto, $text){
			try {
				$mail = new PHPMailer(TRUE);
				$mail->setFrom('sgpt.noreply@gmail.com', 'FI-Uaemex Proceso de Titulacion');
				$mail->isSMTP();
				$mail->Host = 'smtp.gmail.com';
				$mail->SMTPAuth = TRUE;
				$mail->SMTPSecure = 'tls';
				$mail->Username = 'sgpt.noreply@gmail.com';
				$mail->Password = '644835MIKE';
				$mail->Port = 587;

				$mail->addAddress($para);
				$mail->Subject = $asunto;
				$mail->Body = $text;

				$mail->send();
			}catch (Exception $e){
				return false;
			}catch (\Exception $e){
				return false;
			}
			return true;
		}
	}