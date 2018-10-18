<h2><?= $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open_multipart('protocolos/compendio'); ?>
	<input type="hidden" name="proc_ID" value="<?php echo $proc_ID ?>">
	<div class="form-group">
    	<label>Nombre</label>
    	<input type="text" class="form-control" name="proc_nombre" placeholder="Nombre" value="<?php echo $proc['proc_nombre']; ?>" required disabled>
  	</div>
  	<div class="form-group">
    	<label>Fecha</label>
    	<input type="date" class="form-control" name="proc_nombre" placeholder="Nombre" value="<?php echo $proc['proc_iniciado']; ?>" disabled>
  	</div>
  	<div class="form-group">
		<label>Estatus</label>
		<select name="proc_estatus" class="form-control">
			<?php foreach($estatus as $est): ?>
				<option value="<?php echo $est['est_ID']; ?>"><?php echo $est['est_descripcion']; ?></option>
			<?php endforeach; ?>
		</select>
	</div>
	<div class="form-group">
  		<label>Observaciones</label>
  		<textarea name="obs_descripcion"></textarea>
  	</div>
  	<button type="submit" class="btn btn-default">Solicitar</button>
</form>