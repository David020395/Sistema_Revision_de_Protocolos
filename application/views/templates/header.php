<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Sistema de administración de protocolos</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
		<link rel="stylesheet" type="text/css" href='<?php echo base_url('assets/css/menu.css'); ?>' />
	</head>
	<body> <!--Este BODY se cierra en footer.php-->
		<img class="imgprimbanner" src="<?php echo base_url(); ?>assets/img/bannerFI.png">
		<?php if($this->session->userdata('logged_in')): ?>
			<div class="menudesplegable">
				<button onclick="location.href ='<?php echo base_url(); ?>';" class="accordion1">Inicio</button><br/>
				<?php if(in_array(Array ( 'role' => 'adminT' ), $this->session->userdata('roles'))): ?>
					<button class="accordion">Administración</button>
					<div class="panel">
					  	<?php echo '<a href="'.base_url().'protocolos">Protocolos</a>' ?><br/>
						<?php echo '<a href="'.base_url().'protocolos/solicitudes">Solicitudes</a>' ?><br/>
						<?php echo '<a href="'.base_url().'alumnos">Alumnos</a>' ?>
					</div><br/>
				<?php endif; ?>
				<?php if(in_array(Array ( 'role' => 'adminC' ), $this->session->userdata('roles'))): ?>
					<button class="accordion">Administración</button>
					<div class="panel">
					  	<?php echo '<a href="'.base_url().'protocolos">Protocolos</a>' ?><br/>
						<!--<?php echo '<a href="'.base_url().'protocolos/asignados">Protocolos para preparar</a>' ?>-->
						<?php echo '<a href="'.base_url().'profesores">Profesores</a>' ?>
					</div><br/>
				<?php endif; ?>
				<?php if(in_array(Array ( 'role' => 'alumno' ), $this->session->userdata('roles'))): ?>
					<button class="accordion">Protocolos</button>
					<div class="panel">
					  	<?php echo '<a href="'.base_url().'protocolos/nuevo">Registrar nuevo</a>' ?><br/>
						<?php echo '<a href="'.base_url().'protocolos">Mis protocolos</a>' ?>
					</div><br/>
				<?php endif; ?>
				<?php if(in_array(Array ( 'role' => 'revisor' ), $this->session->userdata('roles'))): ?>
					<button class="accordion">Protocolos</button>
					<div class="panel">
					  	<?php echo '<a href="'.base_url().'protocolos">Protocolos para revision</a>' ?>
					</div><br/>
				<?php endif; ?>
				<button class="accordion">Sesión</button>
				<div class="panel">
				  	<a href="<?php echo base_url(); ?>cred/change_user_fields">Administrar cuenta</a><br/>
					<a href="<?php echo base_url(); ?>cred/logout">Cerrar sesión</a>
				</div>
				<script>
					var acc = document.getElementsByClassName("accordion");
					var i;
					for (i = 0; i < acc.length; i++) {
					    acc[i].addEventListener("click", function() {
					        this.classList.toggle("active");
					        var panel = this.nextElementSibling;
					        if (panel.style.display === "block") {
					            panel.style.display = "none";
					        } else {
					            panel.style.display = "block";
					        }
					    });
					}
				</script>
			</div>
		<?php endif; ?>
		<div class="page_content"><!--PAGE_CONTENT-->
			<div id="container">
				<?php if($this->session->flashdata('alumno_creado')): ?>
					<?php echo '<p class="alert alert-success">'.$this->session->flashdata('alumno_creado').'</p>' ?>
				<?php endif; ?>
				<?php if($this->session->flashdata('alumno_editado')): ?>
					<?php echo '<p class="alert alert-success">'.$this->session->flashdata('alumno_editado').'</p>' ?>
				<?php endif; ?>
				<?php if($this->session->flashdata('alumno_borrado')): ?>
					<?php echo '<p class="alert alert-success">'.$this->session->flashdata('alumno_borrado').'</p>' ?>
				<?php endif; ?>
				<?php if($this->session->flashdata('login_correcto')): ?>
					<?php echo '<p class="alert alert-success">'.$this->session->flashdata('login_correcto').'</p>' ?>
				<?php endif; ?>
				<?php if($this->session->flashdata('login_failo')): ?>
					<?php echo '<p class="alert alert-danger">'.$this->session->flashdata('login_failo').'</p>' ?>
				<?php endif; ?>
				<?php if($this->session->flashdata('logout')): ?>
					<?php echo '<p class="alert alert-success">'.$this->session->flashdata('logout').'</p>' ?>
				<?php endif; ?>