<h2><?= $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open_multipart('protocolos/upload'); ?>
	<input type="hidden" name="proc_ID" value="<?php echo $proc['proc_ID'] ?>">
    <div class="form-group">
      <label>Nombre</label>
      <input type="text" class="form-control" name="proc_nombre" placeholder="Nombre" value="<?php echo $proc['proc_nombre']; ?>" disabled>
    </div>
    <div class="form-group">
      <label>Protocolo</label>
      <input type="file" name="protocolo_archivo" id="protocolo_archivo">
    </div>
    <button type="submit" class="btn btn-default">Subir versión</button>
</form>