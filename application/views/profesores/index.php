<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<h3><?= $title; ?></h3>
<br>
<a href="<?php echo base_url(); ?>profesores/nuevo" class="btn btn-secondary btn-light active" role="button" aria-pressed="true"><span class="glyphicon glyphicon-plus"></span> Nuevo</a>
<table class="table table-hover table-stripped">
	<thead>
		<tr>
			<th scope="col">#</th>
			<th scope="col">Nombre</th>
			<th scope="col">Tipo</th>
			<th scope="col">Comite</th>
			<th scope="col">Protocolos activos</th>
			<th scope="col">Acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php  foreach($profesores as $prof) : ?>
			<tr>
				<td><?php echo $prof['pro_ID'] ?></td>
				<td><?php echo $prof['pro_nombre'] ?></td>
				<td><?php echo $prof['pro_tipo'] ?></td>
				<td><span class="<?php if($prof['pro_comite']) echo 'glyphicon glyphicon-ok'; else echo 'glyphicon glyphicon-minus'; ?>"></span></td>
				<td><?php echo $prof['pro_trabajosActivos'] ?></td>
				<td>
					<a class="btn btn-default btn-xs" href="profesores/editar/<?php echo $prof['pro_ID'] ?>"><span class="glyphicon glyphicon-pencil"></span> Editar</a>
				</td>
				<td>
					<?php  echo form_open('profesores/borrar/'.$prof['pro_ID']); ?>
						<button type="submit" class="btn btn-default btn-xs">
							<span class="glyphicon glyphicon-trash"></span> Borrar 
				        </button>
					</form>
				</td>
			</tr>
		<?php  endforeach; ?>
	</tbody>
</table>