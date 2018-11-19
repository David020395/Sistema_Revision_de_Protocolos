<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<h3 class="text-center"><?= $title; ?></h3><br/>
		<?php echo form_open_multipart('protocolos/repObservaciones'); ?>
		  	<input type="hidden" name="proc_ID" value="<?php echo $proc_ID ?>">
		  	<button type="submit" class="btn btn-default">Generar Reporte</button>
		</form>
		<table class="table table-hover table-stripped">
			<tbody>
				<?php  foreach($observaciones as $obs) : ?>
					<tr>
						<td><?php echo $obs['obs_autor'] ?></td>
						<td><?php echo $obs['obs_fecha'] ?></td>
					</tr>
					<tr>
						<td><?php echo $obs['obs_descripcion'] ?></td>
					</tr>
				<?php  endforeach; ?>
			</tbody>
		</table>
	</div>
</div>