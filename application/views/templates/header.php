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
		<ul class="sidenav">
			<li><a href="<?php echo base_url(); ?>">Home</a></li>
			<li class="dropdown">
				<a href="javascript:void(0)" class="dropbtn">Administración</a>
				<span class="dropdown-content">
					<a href="">Protocolos</a>
					<a href="">Solicitudes</a>
					<a href="<?php echo base_url(); ?>alumnos">Alumnos</a>
				</span>
			</li>
			<li class="dropdown">
				<a href="javascript:void(0)" class="dropbtn">Sesión</a>
				<span class="dropdown-content">
					<a href="">Administrar cuenta</a>
					<a href="">Cerrar sesión</a>
				</span>
			</li>
		</ul>
		<div class="page_content"><!--PAGE_CONTENT-->
			<div id="container">