<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<a href="<?php echo base_url(); ?>alumnos/nuevo" class="btn btn-secondary btn-light active" role="button" aria-pressed="true">Nuevo</a>
<table class="table table-hover table-stripped">
	<thead>
		<tr>
			<th scope="col">#</th>
			<th scope="col">Cuenta</th>
			<th scope="col">Nombre</th>
			<th scope="col">Licenciatura</th>
			<th scope="col">Correo</th>
			<th scope="col">Egresado</th>
			<th scope="col">Acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php  foreach($alumnos as $alumno) : ?>
			<tr>
				<th scope="row"><?php echo $alumno['alu_ID'] ?></th>
				<td><?php echo $alumno['alu_numCuenta'] ?></td>
				<td><?php echo $alumno['alu_nombre'] ?></td>
				<td><?php echo $alumno['alu_licenciatura'] ?></td>
				<td><?php echo $alumno['alu_correoE'] ?></td>
				<td><?php echo $alumno['alu_egresado'] ?></td>
			</tr>
		<?php  endforeach; ?>
	</tbody>
</table>