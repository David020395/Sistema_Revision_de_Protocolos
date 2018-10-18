<h2><?= $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open_multipart('profesores/nuevo'); ?>
  <div class="form-group">
    <label>Nombre</label>
    <input type="text" class="form-control" name="pro_nombre" placeholder="Nombre">
  </div>
  <div class="form-group">
    <label>Correo Electronico</label>
    <input type="email" class="form-control" name="pro_correoE" placeholder="Correo Electronico">
  </div>
  <div class="form-group">
    <label>Usuario</label>
    <input type="text" class="form-control" name="pro_user" placeholder="Usuario">
  </div>
  <div class="form-group">
    <label>Tipo</label>
    <input type="text" class="form-control" name="pro_tipo" placeholder="Usuario">
  </div>
  <div class="form-group">
    <label>Miembro del comite</label>
    <input type="checkbox" class="form-control" value="1" name="pro_comite">
  </div>
  <button type="submit" class="btn btn-default">Ingresar</button>
</form>