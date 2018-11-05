<h2><?= $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open_multipart('profesores/actualizar'); ?>
  <input type="hidden" name="pro_ID" value="<?php echo $profesor['pro_ID']; ?>">
  <div class="form-group">
    <label>Apellido Paterno</label>
    <input type="text" class="form-control" name="pro_ap" placeholder="Apellido Paterno" value="<?php echo $profesor['pro_ap']; ?>">
  </div>
  <div class="form-group">
    <label>Apellido Materno</label>
    <input type="text" class="form-control" name="pro_am" placeholder="Apellido Materno" value="<?php echo $profesor['pro_am']; ?>">
  </div>
  <div class="form-group">
    <label>Nombre</label>
    <input type="text" class="form-control" name="pro_nombre" placeholder="Nombre" value="<?php echo $profesor['pro_nombre']; ?>">
  </div>
  <div class="form-group">
    <label>Correo Electronico</label>
    <input type="email" class="form-control" name="pro_correoE" placeholder="Correo Electronico"  value="<?php echo $profesor['pro_correoE']; ?>">
  </div>
  <div class="form-group">
    <label>Usuario</label>
    <input type="text" class="form-control" name="pro_user" placeholder="Usuario"  value="<?php echo $profesor['pro_user']; ?>" disabled>
  </div>
  <div class="form-group">
    <label>Tipo</label>
    <input type="text" class="form-control" name="pro_tipo" placeholder="Usuario"  value="<?php echo $profesor['pro_tipo']; ?>">
  </div>
  <div class="form-group">
    <label>Miembro del comite</label>
    <input type="checkbox" class="form-control"  value="<?php echo $profesor['pro_comite']; ?>" name="pro_comite">
  </div>
  <button type="submit" class="btn btn-default">Ingresar</button>
</form>