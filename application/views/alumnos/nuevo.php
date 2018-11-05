<h2><?= $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open_multipart('alumnos/nuevo'); ?>
  <div class="form-group">
    <label>Numero de cuenta</label>
    <input type="text" class="form-control" name="alu_numCuenta" placeholder="Numero de cuenta">
  </div>
  <div class="form-group">
    <label>Apellido Paterno</label>
    <input type="text" class="form-control" name="alu_ap" placeholder="Apellido Paterno">
  </div>
  <div class="form-group">
    <label>Apellido Materno</label>
    <input type="text" class="form-control" name="alu_am" placeholder="Apellido Materno">
  </div>
  <div class="form-group">
    <label>Nombre(s)</label>
    <input type="text" class="form-control" name="alu_nombre" placeholder="Nombre(s)">
  </div>
  <div class="form-group">
    <label>Usuario</label>
    <input type="text" class="form-control" name="alu_user" placeholder="Usuario">
  </div>
  <div class="form-group">
    <label>Correo Electronico</label>
    <input type="email" class="form-control" name="alu_correoE" placeholder="Correo Electronico">
  </div>
  <div class="form-group">
	  <label>Licenciatura</label>
	  <select name="alu_licenciatura" class="form-control">
		  <?php foreach($licenciaturas as $licenciatura): ?>
		  	<option value="<?php echo $licenciatura['lic_ID']; ?>"><?php echo $licenciatura['lic_nombre']; ?></option>
		  <?php endforeach; ?>
	  </select>
  </div>
  <div class="form-group">
    <label>Unidad Academica</label>
    <select name="alu_unidad" class="form-control">
      <?php foreach($unidades as $unidad): ?>
        <option value="<?php echo $unidad['uni_ID']; ?>"><?php echo $unidad['uni_nombre']; ?></option>
      <?php endforeach; ?>
    </select>
  </div>
  <div class="form-group">
    <label>Egresado</label>
    <input type="checkbox" class="form-control" value="1" name="alu_egresado">
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>