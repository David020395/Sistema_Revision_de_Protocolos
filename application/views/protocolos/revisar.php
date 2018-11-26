<h2><?= $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open_multipart('protocolos/revisar'); ?>
	<input type="hidden" name="proc_ID" value="<?php echo $proc_ID ?>">
  	<div class="form-group">
  		<label>Observaciones</label>
  		<textarea name="obs_descripcion"></textarea>
  	</div>
  	<button type="submit" class="btn btn-default">Guardar</button>
</form>