<?php echo validation_errors(); ?>

<?php echo form_open_multipart('cred/actualizar'); ?>
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
      <h2 class="text-center"><?= $title; ?></h2>
      <div class="form-group">
        <label>Nueva Contraseña</label>
        <input type="password" class="form-control" name="password" placeholder="Contraseña">
      </div>
      <div class="form-group">
        <label>Confirmar Contraseña</label>
        <input type="password" class="form-control" name="password2" placeholder="Confirmar contraseña">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
      <div class="form-group">
        <label>Correo Electronico</label>
        <input type="email" class="form-control" name="correoE" placeholder="Correo Electronico" value="<?php echo $email; ?>">
      </div>
      <button type="submit" class="btn btn-success btn-block">Actualizar</button>
    </div>
  </div>
</form>