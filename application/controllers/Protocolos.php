<?php defined('BASEPATH') OR exit('No direct script access allowed');
	class Protocolos extends CI_Controller{

		public function index(){
			if(!$this->session->userdata('logged_in')){
				redirect('cred/login');
			}
			$data['title'] = 'Administración de protocolos';
			if(in_array(Array ( 'role' => 'adminT' ), $this->session->userdata('roles'))){
				$data['protocolos'] = $this->protocolos_model->get_protocolos_for_adminT();
			}
			if(in_array(Array ( 'role' => 'alumno' ), $this->session->userdata('roles'))){
				$data['protocolos'] = $this->protocolos_model->get_protocolos_for_alumno();
			}
			if(in_array(Array ( 'role' => 'adminC' ), $this->session->userdata('roles'))){
				$data['protocolos'] = $this->protocolos_model->get_protocolos_for_adminC();
			}
			if(in_array(Array ( 'role' => 'revisor' ), $this->session->userdata('roles'))){
				$data['protocolos'] = $this->protocolos_model->get_protocolos_for_revisor();
			}
			$data['solicitudes']=false;
			$this->load->view('templates/header');
			$this->load->view('protocolos/index', $data);
			$this->load->view('templates/footer');
		}

		public function solicitudes(){
			if(!$this->session->userdata('logged_in')){
				redirect('cred/login');
			}
			$data['title'] = 'Administración de solicitudes de protocolos';
			if(in_array(Array ( 'role' => 'adminT' ), $this->session->userdata('roles'))){
				$data['protocolos'] = $this->protocolos_model->get_protocolos_for_adminT_S();
			}
			$data['solicitudes']=true;
			$this->load->view('templates/header');
			$this->load->view('protocolos/index', $data);
			$this->load->view('templates/footer');
		}

		public function nuevo(){
			if(!$this->session->userdata('logged_in')){
				redirect('cred/login');
			}
			if(!in_array(Array ( 'role' => 'alumno' ), $this->session->userdata('roles'))){
				redirect('cred/e403');
			}

			$data['title'] = 'Registrar nuevo protocolo';

			$this->form_validation->set_rules('proc_nombre', 'Nombre', 'required');

			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('protocolos/nuevo', $data);
				$this->load->view('templates/footer');
			} else {
				$id = $this->protocolos_model->nuevo_protocolo();
				$id = $id['proc_ID'];
				$sec = $this->protocolos_model->gen_secuence($id);
				$ext = $this->archivo($id,$sec);
				$nom_arch =  'protocolo-'.$id.'-'.$sec.'.'.$ext;
				date_default_timezone_set('America/Mexico_City');
				$arc_fecha = date("Y-m-d h:i:sa", time());
				$this->protocolos_model->nuevo_archivo($nom_arch, $ext, $id, $arc_fecha, $sec, 0);
				$this->session->set_flashdata('protocolo_creado','Protocolo solicitado exitosamente. Será comenzado en cuanto sea validado por un administrador. Consulta a tu administrador en caso de dudas');
				redirect('protocolos');
			}
		}

		public function set_status(){
			if(!$this->session->userdata('logged_in')){
				redirect('cred/login');
			}
			if(!in_array(Array ( 'role' => 'adminT' ), $this->session->userdata('roles'))){
				redirect('cred/e403');
			}
			$proc_ID = $this->input->post('proc_ID');
			date_default_timezone_set('America/Mexico_City');
			$proc_iniciado = date("Y-m-d h:i:sa", time());
			$proc_estatus = $this->input->post('proc_estatus');
			$this->protocolos_model->cambia_iniciado_protocolo($proc_ID,$proc_iniciado);
			$this->protocolos_model->cambia_estatus_protocolo($proc_ID,$proc_estatus);
			$this->session->set_flashdata('protocolo_comenzado','Este protocolo ha sido validado y dara comienzo su proceso de revision');
			redirect('protocolos');
		}

		public function archivo($id,$sec){
			$target_dir = __DIR__."\\..\\..\\assets\\files\\";
			$target_file = $target_dir . basename($_FILES["protocolo_archivo"]["name"]);
			$uploadOk = 1;
			$wordFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			// Archivo en existencia
			if (file_exists($target_file)) {
				$this->session->set_flashdata('error_carga_archivo_1','Error: Archivo ya existente.');
			    $uploadOk = 0;
			}
			// Tamaño del archivo
			$max_file_size = 20*1048576; //20MB
			if ($_FILES["protocolo_archivo"]["size"] > $max_file_size) {
				$this->session->set_flashdata('error_carga_archivo_2','Error: El archivo excede el tamaño limite');
			    $uploadOk = 0;
			}
			// Allow certain file formats
			if($wordFileType != "doc" && $wordFileType != "docx") {
				$this->session->set_flashdata('error_carga_archivo_3','Error: Solo se permiten archivos tipo DOC & DOCX.');
			    $uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				$this->session->set_flashdata('error_carga_archivo_0','Atención: el archivo no ha sido cargado.');
			// if everything is ok, try to upload file
			} else {
			    if (move_uploaded_file($_FILES["protocolo_archivo"]["tmp_name"], $target_file) && rename($target_file, $target_dir.'protocolo-'.$id.'-'.$sec.'.'.$wordFileType)) {
			    	$this->session->set_flashdata('exito_carga_archivo','Atención: Archivo cargado exitosamente.');
			    } else {
			    	$this->session->set_flashdata('error_carga_archivo_4','Atención: Falló la carga del archivo. Intente nuevamente.');
			    }
			}
			return $wordFileType;
		}

		public function archivoP($id,$sec){
			$target_dir = __DIR__."\\..\\..\\assets\\files\\";
			$target_file = $target_dir . basename($_FILES["protocolo_archivo"]["name"]);
			$uploadOk = 1;
			$wordFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			// Archivo en existencia
			if (file_exists($target_file)) {
				$this->session->set_flashdata('error_carga_archivo_1','Error: Archivo ya existente.');
			    $uploadOk = 0;
			}
			// Tamaño del archivo
			$max_file_size = 20*1048576; //20MB
			if ($_FILES["protocolo_archivo"]["size"] > $max_file_size) {
				$this->session->set_flashdata('error_carga_archivo_2','Error: El archivo excede el tamaño limite');
			    $uploadOk = 0;
			}
			// Allow certain file formats
			if($wordFileType != "doc" && $wordFileType != "docx") {
				$this->session->set_flashdata('error_carga_archivo_3','Error: Solo se permiten archivos tipo DOC & DOCX.');
			    $uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				$this->session->set_flashdata('error_carga_archivo_0','Atención: el archivo no ha sido cargado.');
			// if everything is ok, try to upload file
			} else {
			    if (move_uploaded_file($_FILES["protocolo_archivo"]["tmp_name"], $target_file) && rename($target_file, $target_dir.'protocolo-'.$id.'-'.$sec.'-P.'.$wordFileType)) {
			    	$this->session->set_flashdata('exito_carga_archivo','Atención: Archivo cargado exitosamente.');
			    } else {
			    	$this->session->set_flashdata('error_carga_archivo_4','Atención: Falló la carga del archivo. Intente nuevamente.');
			    }
			}
			return $wordFileType;
		}

		public function editar(){
			if(!$this->session->userdata('logged_in')){
				redirect('cred/login');
			}
			if(!in_array(Array ( 'role' => 'alumno' ), $this->session->userdata('roles'))){
				redirect('cred/e403');
			}
			//VALIDAR EDITABLE, NO COMENZADO
			$proc_ID = $this->input->post('proc_ID');
			$data['proc'] = $this->protocolos_model->get_protocolo_by_id($proc_ID);
			if(empty($data['proc'])){
				show_404();
			}
			$data['title'] = 'Editar Protocolo';
			$this->load->view('templates/header');
			$this->load->view('protocolos/editar', $data);
			$this->load->view('templates/footer');
		}

		public function editarP(){
			if(!$this->session->userdata('logged_in')){
				redirect('cred/login');
			}
			if(!in_array(Array ( 'role' => 'crevisor' ), $this->session->userdata('roles'))){
				redirect('cred/e403');
			}
			$proc_ID = $this->input->post('proc_ID');
			$data['proc'] = $this->protocolos_model->get_protocolo_by_id($proc_ID);
			if(empty($data['proc'])){
				show_404();
			}
			$data['title'] = 'Editar Protocolo';
			$this->load->view('templates/header');
			$this->load->view('protocolos/editarP', $data);
			$this->load->view('templates/footer');
		}

		public function upload(){
			$proc_ID = $this->input->post('proc_ID');
			$sec = $this->protocolos_model->gen_secuence($proc_ID);
			$ext = $this->archivo($proc_ID,$sec);
			$nom_arch =  'protocolo-'.$proc_ID.'-'.$sec.'.'.$ext;
			date_default_timezone_set('America/Mexico_City');
			$arc_fecha = date("Y-m-d h:i:sa", time());
			$this->protocolos_model->nuevo_archivo($nom_arch, $ext, $proc_ID, $arc_fecha, $sec, 0);
			$this->session->set_flashdata('protocolo_modificado','Protocolo actualizado exitosamente.');
			redirect('protocolos');
		}

		public function uploadP(){
			$proc_ID = $this->input->post('proc_ID');
			$archivo = $this->protocolos_model->get_last_archivo($proc_ID);
			$sec = $archivo['arc_sec'];
			$ext = $this->archivoP($proc_ID,$sec);
			$nom_arch =  'protocolo-'.$proc_ID.'-'.$sec.'-P.'.$ext;
			date_default_timezone_set('America/Mexico_City');
			$arc_fecha = date("Y-m-d h:i:sa", time());
			$this->protocolos_model->nuevo_archivo($nom_arch, $ext, $proc_ID, $arc_fecha, $sec, 1);
			$this->protocolos_model->cambia_estatus_protocolo($proc_ID,10);
			$this->session->set_flashdata('protocolo_modificado','Protocolo actualizado exitosamente. Se notificara a los revisores su trabajo pendiente');
			redirect('protocolos/asignados');
		}

		public function downloadP(){
			$target_dir = "assets/files/";
			//get file data
			$proc_ID = $this->input->post('proc_ID');
			$archivo = $this->protocolos_model->get_last_archivoP($proc_ID);
			$filename = 'protocolo-'.$archivo['proc_ID_ref'].'-'.$archivo['arc_sec'].'-P.'.$archivo['arc_ext'];
			$file = $target_dir.$filename;
			if(!file_exists($file)){ // file does not exist
			    die('no implementado file not found');
			} else {
			    header("Cache-Control: public");
			    header("Content-Description: File Transfer");
			    header("Content-Disposition: attachment; filename=$filename");
			    if($archivo['arc_ext']=="doc"){
			    	header("Content-Type: application/msword");
			    }else if($archivo['arc_ext']=="docx"){
			    	header("Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document");
			    }else{
			    	header("Content-Type: application/octet-stream");
			    }
			    header("Content-Transfer-Encoding: binary");
			    // read the file from disk
			    readfile($file);
			    die('redirect');
			}
		}

		public function download(){
			$target_dir = "assets/files/";
			//get file data
			$proc_ID = $this->input->post('proc_ID');
			$archivo = $this->protocolos_model->get_last_archivo($proc_ID);
			$filename = 'protocolo-'.$archivo['proc_ID_ref'].'-'.$archivo['arc_sec'].'.'.$archivo['arc_ext'];
			$file = $target_dir.$filename;
			if(!file_exists($file)){ // file does not exist
			    die('no implementado file not found');
			} else {
			    header("Cache-Control: public");
			    header("Content-Description: File Transfer");
			    header("Content-Disposition: attachment; filename=$filename");
			    if($archivo['arc_ext']=="doc"){
			    	header("Content-Type: application/msword");
			    }else if($archivo['arc_ext']=="docx"){
			    	header("Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document");
			    }else{
			    	header("Content-Type: application/octet-stream");
			    }
			    header("Content-Transfer-Encoding: binary");
			    // read the file from disk
			    readfile($file);
			    die('redirect');
			}
		}

		public function asignar(){
			if(!$this->session->userdata('logged_in')){
				redirect('cred/login');
			}
			if(!in_array(Array ( 'role' => 'adminC' ), $this->session->userdata('roles'))){
				redirect('cred/e403');
			}
			$proc_ID = $this->input->post('proc_ID');
			$data['proc'] = $this->protocolos_model->get_protocolo_by_id($proc_ID);
			$data['profesores'] = $this->profesores_model->get_profesores_revisores();
			$data['coordinadores'] = $this->profesores_model->get_profesores_coordinadores();
			$data['title'] = 'Asignación de Revisores';
			$this->load->view('templates/header');
			$this->load->view('protocolos/asignar', $data);
			$this->load->view('templates/footer');
		}

		public function assign(){
			$proc_ID = $this->input->post('proc_ID');
			$this->protocolos_model->nuevo_asignacion($proc_ID);
			$this->protocolos_model->cambia_estatus_protocolo($proc_ID,9);
			$this->session->set_flashdata('protocolo_asignado','Protocolo asignado exitosamente.');
			redirect('protocolos');
		}

		public function asignados(){
			if(!$this->session->userdata('logged_in')){
				redirect('cred/login');
			}
			$data['title'] = 'Preparación de protocolos';
			if(!in_array(Array ( 'role' => 'crevisor' ), $this->session->userdata('roles'))){
				redirect('cred/e403');
			}
			$data['protocolos'] = $this->protocolos_model->get_protocolos_status_for_me(9,$this->session->userdata('user_dbn'), true);
			$this->load->view('templates/header');
			$this->load->view('protocolos/asignados', $data);
			$this->load->view('templates/footer');
		}

		public function revisar(){
			if(!$this->session->userdata('logged_in')){
				redirect('cred/login');
			}
			if(!in_array(Array ( 'role' => 'revisor' ), $this->session->userdata('roles'))){
				redirect('cred/e403');
			}
			$data['proc_ID'] = $this->input->post('proc_ID');
			$data['title'] = 'Observaciones sobre protocolo';
			$this->form_validation->set_rules('obs_descripcion', 'Observaciones', 'required');
			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('protocolos/revisar', $data);
				$this->load->view('templates/footer');
			} else {
				$this->protocolos_model->nuevo_observacion();
				$this->session->set_flashdata('revision_enviada','Observacion generada exitosamente');
				redirect('protocolos');
			}
		}

		public function observaciones(){
			if(!$this->session->userdata('logged_in')){
				redirect('cred/login');
			}
			if(!in_array(Array ( 'role' => 'crevisor' ), $this->session->userdata('roles'))){
				redirect('cred/e403');
			}
			$data['title'] = 'Observaciones';
			$data['proc_ID'] = $this->input->post('proc_ID');
			$data['observaciones'] = $this->protocolos_model->get_observaciones();
			$this->load->view('templates/header');
			$this->load->view('protocolos/observaciones', $data);
			$this->load->view('templates/footer');
		}

		public function repObservaciones(){
			if(!$this->session->userdata('logged_in')){
				redirect('cred/login');
			}
			if(!in_array(Array ( 'role' => 'crevisor' ), $this->session->userdata('roles'))){
				redirect('cred/e403');
			}
			$data['title'] = 'Observaciones';
			$data['proc_ID'] = $this->input->post('proc_ID');
			$data['observaciones'] = $this->protocolos_model->get_observaciones();
			$this->genObservacionesRep($data);
			//$this->load->view('templates/header');
			//$this->load->view('protocolos/observaciones', $data);
			//$this->load->view('templates/footer');
		}

		public function compendio(){
			if(!$this->session->userdata('logged_in')){
				redirect('cred/login');
			}
			if(!in_array(Array ( 'role' => 'crevisor' ), $this->session->userdata('roles'))){
				redirect('cred/e403');
			}
			$data['title'] = 'Resultado de revisión';
			$data['proc_ID'] = $this->input->post('proc_ID');
			$data['proc'] = $this->protocolos_model->get_protocolo_by_id($data['proc_ID']);
			$this->form_validation->set_rules('proc_estatus', 'Estatus', 'required');
			$data['estatus'] = $this->protocolos_model->get_estatus();
			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('protocolos/compendio', $data);
				$this->load->view('templates/footer');
			} else {
				$obs = $this->input->post('obs_descripcion');
				if($obs!=""){
					$this->protocolos_model->nuevo_observacion();
				}
				$this->protocolos_model->cambia_estatus_protocolo($data['proc_ID'],$this->input->post('proc_estatus'));
				//CODIGO PARA CAMBIO DE ESTATUS
				$this->session->set_flashdata('revision_confirmada','Revision confirmada exitosamente');
				redirect('protocolos');
			}
		}

		public function asinc(){
		}

		private function genObservacionesRep($data){
			require dirname( __FILE__ ) . '/FPDF/fpdf.php';
			$pdf=new FPDF();
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',16);
			$pdf->Cell(40,10,'Observaciones');
			$pdf->Ln(10);
			$pdf->SetFont('Arial','',12);
			foreach ($data['observaciones'] as $obs) {
				$pdf->Ln(10);
				$str1 = iconv('UTF-8', 'windows-1252', $obs['obs_autorap'].' '.$obs['obs_autoram'].' '.$obs['obs_autor']);
				$pdf->Cell(40,10,$str1);
				$pdf->Ln(10);
				$pdf->Cell(40,10,$obs['obs_fecha']);
				$pdf->Ln(10);
				$str2 = iconv('UTF-8', 'windows-1252', $obs['obs_descripcion']);
				$pdf->Write(10,$str2);
				$pdf->Ln(10);
			}
			$pdf->Output('File.pdf','D');
		}
	}