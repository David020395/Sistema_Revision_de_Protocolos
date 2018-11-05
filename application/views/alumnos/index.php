<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<h3><?= $title; ?></h3>
<br>
<a href="<?php echo base_url(); ?>alumnos/nuevo" class="btn btn-secondary btn-light active" role="button" aria-pressed="true"><span class="glyphicon glyphicon-plus"></span> Nuevo</a>
<table class="table table-hover table-stripped">
	<thead>
		<tr>
			<th scope="col">Cuenta</th>
			<th scope="col">Nombre</th>
			<th scope="col"></th>
			<th scope="col"></th>
			<th scope="col">Licenciatura</th>
			<th scope="col">Correo</th>
			<th scope="col">Egresado</th>
			<th scope="col">Acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php  foreach($alumnos as $alumno) : ?>
			<tr>
				<td><?php echo $alumno['alu_numCuenta'] ?></td>
				<td><?php echo $alumno['alu_ap'] ?></td>
				<td><?php echo $alumno['alu_am'] ?></td>
				<td><?php echo $alumno['alu_nombre'] ?></td>
				<td><?php echo $alumno['lic_nombre'] ?></td>
				<td><?php echo $alumno['alu_correoE'] ?></td>
				<td><span class="<?php if($alumno['alu_egresado']) echo 'glyphicon glyphicon-ok'; else echo 'glyphicon glyphicon-minus'; ?>"></span></td>
				<td>
					<a class="btn btn-default btn-xs" href="alumnos/editar/<?php echo $alumno['alu_ID'] ?>"><span class="glyphicon glyphicon-pencil"></span> Editar</a>
				</td>
				<td>
					<?php  echo form_open('alumnos/borrar/'.$alumno['alu_ID']); ?>
						<button type="submit" class="btn btn-default btn-xs">
							<span class="glyphicon glyphicon-trash"></span> Borrar 
				        </button>
					</form>
				</td>
			</tr>
		<?php  endforeach; ?>
	</tbody>
</table>