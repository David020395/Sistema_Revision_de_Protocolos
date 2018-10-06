<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title><?php echo $titulo_de_pagina; ?></title>
		<link rel="stylesheet" type="text/css" href='<?php echo base_url('assets/css/menu.css'); ?>' />
	</head>
	<body> <!--Este BODY se cierra en footer.php-->
		<ul class="sidenav">
			<li><a href="">Home</a></li>
			<li class="dropdown">
				<a href="javascript:void(0)" class="dropbtn">Administración</a>
				<span class="dropdown-content">
					<a href="">Protocolos</a>
					<a href="">Solicitudes</a>
					<a href="">Alumnos</a>
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