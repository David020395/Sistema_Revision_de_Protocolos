<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<h3><?= $title; ?></h3>
<br>
<p>Atencion: es de vital importancia prepare los siguientes protocolos para su lectura por otros revisores, manteniendo confidencial la información personal del aspirante.</p>
<p>Debera descargar el protocolo, eliminar la información personal, y subir el documento preparado.</p>
<table class="table table-hover table-stripped">
	<thead>
		<tr>
			<th>Protocolo</th>
			<th>Iniciado</th>
			<th>Estatus</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php  foreach($protocolos as $protocolo) : ?>
			<tr>
				<td><?php echo $protocolo['proc_nombre'] ?></td>
				<td><?php echo $protocolo['proc_iniciado'] ?></td>
				<td><?php echo $protocolo['est_descripcion'] ?></td>
				<td>
					<?php  echo form_open(base_url().'protocolos/download'); ?>
						<input type="hidden" name="proc_ID" value="<?php echo $protocolo['proc_ID'] ?>">
						<button type="submit" class="btn btn-default btn-xs">
							<span class="glyphicon glyphicon-cloud-download"></span> Descargar
				        </button>
					</form>
				</td>
				<td>
					<?php  echo form_open(base_url().'protocolos/editarP'); ?>
						<input type="hidden" name="proc_ID" value="<?php echo $protocolo['proc_ID'] ?>">
						<button type="submit" class="btn btn-default btn-xs">
							<span class="glyphicon glyphicon-cloud-upload"></span> Cargar
				        </button>
					</form>
				</td>
			</tr>
		<?php  endforeach; ?>
	</tbody>
</table>