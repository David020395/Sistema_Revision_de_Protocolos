<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<h3><?= $title; ?></h3>
<br>
<table class="table table-hover table-stripped">
	<thead>
		<tr>
			<?php if(in_array(Array ( 'role' => 'adminT' ), $this->session->userdata('roles'))): ?>
				<th>Cuenta</th>
				<th>Alumno</th>
				<th>Protocolo</th>
				<th>Iniciado</th>
				<th>Estatus</th>
				<th>Acciones</th>
			<?php endif; ?>
			<?php if(in_array(Array ( 'role' => 'alumno' ), $this->session->userdata('roles'))): ?>
				<th>Protocolo</th>
				<th>Iniciado</th>
				<th>Estatus</th>
				<th>Acciones</th>
			<?php endif; ?>
			<?php if(in_array(Array ( 'role' => 'adminC' ), $this->session->userdata('roles'))): ?>
				<th>Protocolo</th>
				<th>Iniciado</th>
				<th>Acciones</th>
			<?php endif; ?>
			<?php if(in_array(Array ( 'role' => 'revisor' ), $this->session->userdata('roles'))): ?>
				<th>Protocolo</th>
				<th>Iniciado</th>
				<th>Estatus</th>
				<th>Acciones</th>
			<?php endif; ?>
		</tr>
	</thead>
	<tbody>
		<?php if(in_array(Array ( 'role' => 'adminT' ), $this->session->userdata('roles'))): ?>
			<?php  foreach($protocolos as $protocolo) : ?>
				<tr>
					<td><?php echo $protocolo['alu_numCuenta'] ?></td>
					<td><?php echo $protocolo['alu_nombre'] ?></td>
					<td><?php echo $protocolo['proc_nombre'] ?></td>
					<td><?php echo $protocolo['proc_iniciado'] ?></td>
					<td><?php echo $protocolo['est_descripcion'] ?></td>
					<?php if($solicitudes): ?>
						<td>
							<?php  echo form_open(base_url().'protocolos/set_status'); ?>
								<input type="hidden" name="proc_ID" value="<?php echo $protocolo['proc_ID'] ?>">
								<input type="hidden" name="proc_estatus" value="8">
								<button type="submit" class="btn btn-default btn-xs">
									<span class="glyphicon glyphicon-ok"></span> Comenzar 
						        </button>
							</form>
						</td>
					<?php endif; ?>
					<td>
						<?php  echo form_open(base_url().'protocolos/download'); ?>
							<input type="hidden" name="proc_ID" value="<?php echo $protocolo['proc_ID'] ?>">
							<button type="submit" class="btn btn-default btn-xs">
								<span class="glyphicon glyphicon-download-alt"></span> Descargar
					        </button>
						</form>
					</td>
				</tr>
			<?php  endforeach; ?>
		<?php endif; ?>
		<?php if(in_array(Array ( 'role' => 'alumno' ), $this->session->userdata('roles'))): ?>
			<?php  foreach($protocolos as $protocolo) : ?>
				<tr>
					<td><?php echo $protocolo['proc_nombre'] ?></td>
					<td><?php echo $protocolo['proc_iniciado'] ?></td>
					<td><?php echo $protocolo['est_descripcion'] ?></td>
					<td>
						<?php  echo form_open(base_url().'protocolos/check_comments'); ?>
							<input type="hidden" name="proc_ID" value="<?php echo $protocolo['proc_ID'] ?>">
							<button type="submit" class="btn btn-default btn-xs">
								<span class="glyphicon glyphicon-eye-open"></span> Revisar
					        </button>
						</form>
						<?php  echo form_open(base_url().'protocolos/download'); ?>
							<input type="hidden" name="proc_ID" value="<?php echo $protocolo['proc_ID'] ?>">
							<button type="submit" class="btn btn-default btn-xs">
								<span class="glyphicon glyphicon-download-alt"></span> Descargar
					        </button>
						</form>
						<?php if($protocolo['proc_estatus']==11 || $protocolo['proc_estatus']==7 || $protocolo['proc_estatus']==3): ?>
							<?php  echo form_open(base_url().'protocolos/editar'); ?>
								<input type="hidden" name="proc_ID" value="<?php echo $protocolo['proc_ID'] ?>">
								<button type="submit" class="btn btn-default btn-xs">
									<span class="glyphicon glyphicon-pencil"></span> Editar
						        </button>
							</form>
						<?php endif; ?>
					</td>
				</tr>
			<?php  endforeach; ?>
		<?php endif; ?>
		<?php if(in_array(Array ( 'role' => 'adminC' ), $this->session->userdata('roles'))): ?>
			<?php  foreach($protocolos as $protocolo) : ?>
				<tr>
					<td><?php echo $protocolo['proc_nombre'] ?></td>
					<td><?php echo $protocolo['proc_iniciado'] ?></td>
					<td>
						<?php  echo form_open(base_url().'protocolos/asignar'); ?>
							<input type="hidden" name="proc_ID" value="<?php echo $protocolo['proc_ID'] ?>">
							<button type="submit" class="btn btn-default btn-xs">
								<span class="glyphicon glyphicon-th-list"></span> Asignar
					        </button>
						</form>
					</td>
					<td>
						<?php  echo form_open(base_url().'protocolos/download'); ?>
							<input type="hidden" name="proc_ID" value="<?php echo $protocolo['proc_ID'] ?>">
							<button type="submit" class="btn btn-default btn-xs">
								<span class="glyphicon glyphicon-download-alt"></span> Descargar
					        </button>
						</form>
					</td>
				</tr>
			<?php  endforeach; ?>
		<?php endif; ?>
		<?php if(in_array(Array ( 'role' => 'revisor' ), $this->session->userdata('roles'))): ?>
			<?php  foreach($protocolos as $protocolo) : ?>
				<tr>
					<td><?php echo $protocolo['proc_nombre'] ?></td>
					<td><?php echo $protocolo['proc_iniciado'] ?></td>
					<td><?php echo $protocolo['est_descripcion'] ?></td>
					<td>
						<?php  echo form_open(base_url().'protocolos/downloadP'); ?>
							<input type="hidden" name="proc_ID" value="<?php echo $protocolo['proc_ID'] ?>">
							<button type="submit" class="btn btn-default btn-xs">
								<span class="glyphicon glyphicon-cloud-download"></span> Descargar
					        </button>
						</form>
					</td>
					<?php if(in_array(Array ( 'role' => 'crevisor' ), $this->session->userdata('roles'))): ?>
						<td>
							<?php  echo form_open(base_url().'protocolos/observaciones'); ?>
								<input type="hidden" name="proc_ID" value="<?php echo $protocolo['proc_ID'] ?>">
								<button type="submit" class="btn btn-default btn-xs">
									<span class="glyphicon glyphicon-comment"></span> Observaciones
						        </button>
							</form>
						</td>
					<?php endif; ?>
					<td>
						<?php  echo form_open(base_url().'protocolos/revisar'); ?>
							<input type="hidden" name="proc_ID" value="<?php echo $protocolo['proc_ID'] ?>">
							<button type="submit" class="btn btn-default btn-xs">
								<span class="glyphicon glyphicon-edit"></span> Revisar
					        </button>
						</form>
					</td>
					<?php if(!in_array(Array ( 'role' => 'crevisor' ), $this->session->userdata('roles'))): ?>
						<td>
							<?php  echo form_open(base_url().'protocolos/enviarRevision'); ?>
								<input type="hidden" name="proc_ID" value="<?php echo $protocolo['proc_ID'] ?>">
								<button type="submit" class="btn btn-default btn-xs">
									<span class="glyphicon glyphicon-ok"></span> Enviar
						        </button>
							</form>
						</td>
					<?php endif; ?>
					<?php if(in_array(Array ( 'role' => 'crevisor' ), $this->session->userdata('roles'))): ?>
						<td>
							<?php  echo form_open(base_url().'protocolos/compendio'); ?>
								<input type="hidden" name="proc_ID" value="<?php echo $protocolo['proc_ID'] ?>">
								<button type="submit" class="btn btn-default btn-xs">
									<span class="glyphicon glyphicon-ok"></span> Enviar
						        </button>
							</form>
						</td>
					<?php endif; ?>
				</tr>
			<?php  endforeach; ?>
		<?php endif; ?>
	</tbody>
</table>