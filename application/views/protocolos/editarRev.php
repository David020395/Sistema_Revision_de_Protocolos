<h2><?= $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open_multipart('protocolos/erevisar'); ?>
	<input type="hidden" name="proc_ID" value="<?php echo $proc_ID ?>">
	<input type="hidden" name="obs_ID" value="<?php echo $observacion['obs_ID']; ?>">
	<input type="hidden" name="obs_enviado" value="<?php echo $observacion['obs_enviado']; ?>">
  	<div class="form-group">
  		<label>Observaciones</label>
  		<textarea name="obs_descripcion" value="<?php echo $observacion['obs_descripcion']; ?>"></textarea>
  	</div>
  	<button type="submit" class="btn btn-default">Enviar</button>
</form>