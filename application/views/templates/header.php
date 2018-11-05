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
		<img src="<?php echo base_url(); ?>assets/img/bannerFI.png" style="width:100%;">
		<?php if($this->session->userdata('logged_in')): ?>
			<button class="accordion">Section 1</button>
			<div class="panel">
			  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
			</div>
			<br/>
			<button class="accordion">Section 2</button>
			<div class="panel">
			  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
			</div>
			<br/>
			<button class="accordion">Section 3</button>
			<div class="panel">
			  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
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
			<ul class="sidenav">
				<li><a href="<?php echo base_url(); ?>">Inicio</a></li>
				<?php if(in_array(Array ( 'role' => 'adminT' ), $this->session->userdata('roles'))): ?>
					<li class="dropdown">
						<a href="javascript:void(0)" class="dropbtn">Administración</a>
						<span class="dropdown-content">
							<?php echo '<a href="'.base_url().'protocolos">Protocolos</a>' ?>
							<?php echo '<a href="'.base_url().'protocolos/solicitudes">Solicitudes</a>' ?>
							<?php echo '<a href="'.base_url().'alumnos">Alumnos</a>' ?>
						</span>
					</li>
				<?php endif; ?>
				<?php if(in_array(Array ( 'role' => 'adminC' ), $this->session->userdata('roles'))): ?>
					<li class="dropdown">
						<a href="javascript:void(0)" class="dropbtn">Administración</a>
						<span class="dropdown-content">
							<?php echo '<a href="'.base_url().'protocolos">Protocolos</a>' ?>
							<!--<?php echo '<a href="'.base_url().'protocolos/asignados">Protocolos para preparar</a>' ?>-->
							<?php echo '<a href="'.base_url().'profesores">Profesores</a>' ?>
						</span>
					</li>
				<?php endif; ?>
				<?php if(in_array(Array ( 'role' => 'alumno' ), $this->session->userdata('roles'))): ?>
					<li class="dropdown">
						<a href="javascript:void(0)" class="dropbtn">Protocolos</a>
						<span class="dropdown-content">
							<?php echo '<a href="'.base_url().'protocolos/nuevo">Registrar nuevo</a>' ?>
							<?php echo '<a href="'.base_url().'protocolos">Mis protocolos</a>' ?>
						</span>
					</li>
				<?php endif; ?>
				<?php if(in_array(Array ( 'role' => 'revisor' ), $this->session->userdata('roles'))): ?>
					<li class="dropdown">
						<a href="javascript:void(0)" class="dropbtn">Protocolos</a>
						<span class="dropdown-content">
							<?php echo '<a href="'.base_url().'protocolos">Protocolos para revision</a>' ?>
						</span>
					</li>
				<?php endif; ?>
				<li class="dropdown">
					<a href="javascript:void(0)" class="dropbtn">Sesión</a>
					<span class="dropdown-content">
						<a href="<?php echo base_url(); ?>cred/change_user_fields">Administrar cuenta</a>
						<a href="<?php echo base_url(); ?>cred/logout">Cerrar sesión</a>
					</span>
				</li>
			</ul>
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