<form class="form-horizontal" id="formulario" onsubmit="return guardar()">
	<input type="hidden" name="id" id="id">
	<div class="form-group">
		<label class="col-lg-1 control-label"></label>
		<label class="col-lg-1 control-label">DNI*</label>
		<div class="col-lg-2">
			<div class="iconic-input">
				<i class="fa fa-bookmark-o"></i>
				<input type="text" class="form-control" name="dni" id="dni" maxlength="8" minlength="8" required onkeypress="return numeric(event)" onkeyup="buscarempleado()">
			</div>
		</div>
		<label class="col-lg-1 control-label">Nombres*</label>
		<div class="col-lg-2">
			<input type="text" class="form-control" name="nombres" id="nombres" required maxlength="40" onkeypress="return letter(event)">
		</div>
		<label class="col-lg-1 control-label">Apellidos*</label>
		<div class="col-lg-3">
			<input type="text" class="form-control" name="apellidos" id="apellidos" required maxlength="100" onkeypress="return letter(event)">
		</div>
	</div>
	<div class="form-group">
		<label class="col-lg-1 control-label"></label>
		<label class="col-lg-1 control-label">Celular</label>
		<div class="col-lg-2">
			<div class="iconic-input">
				<i class="fa fa-mobile"></i>
				<input type="text" class="form-control" name="celular" id="celular" maxlength="10" onkeypress="return numeric(event)">
			</div>
		</div>
		<label class="col-lg-1 control-label">T.empleado</label>
		<div class="col-lg-2">
			<select class="form-control" name="tipo_empleado" id="tipo_empleado" required="true">
				<option value="">Seleccione</option>
				<?php 
					foreach ($tipos as $value) { ?>
						<option value="<?php echo $value["te_id"]; ?>"> 
							<?php echo $value["te_descripcion"]; ?> 
						</option>
					<?php }
				?>
			</select>
		</div>
		<label class="col-lg-1 control-label">Direccion</label>
		<div class="col-lg-3">
			<div class="iconic-input">
				<i class="fa fa-map-marker"></i>
				<input type="text" class="form-control" name="direccion" id="direccion" maxlength="100" required>
			</div>
		</div>
	</div>
	<div class="form-group">
		<label class="col-lg-1 control-label"></label>
		<label class="col-lg-1 control-label">Sexo</label>
		<div class="col-lg-2">
			<select class="form-control" name="sexo" id="sexo" required="true">
				<option value="">Seleccione</option>
				<option value="MASCULINO">MASCULINO</option>
				<option value="FEMENINO">FEMENINO</option>
			</select>
		</div>
		<label class="col-lg-1 control-label">Usuario</label>
		<div class="col-lg-2">
			<div class="iconic-input">
				<i class="fa fa-map-marker"></i>
				<input type="text" class="form-control" name="usuario" id="usuario" maxlength="100" required>
			</div>
		</div>
		<label class="col-lg-1 control-label">Clave</label>
		<div class="col-lg-3">
			<div class="iconic-input">
				<i class="fa fa-map-marker"></i>
				<input type="password" class="form-control" name="clave" id="clave" maxlength="100" required>
			</div>
		</div>
	</div>
	<div class="form-group">
		<center>
			<button class="btn btn-danger" type="button" onclick="listado()">Cerrar</button>
			<button class="btn btn-success" type="submit" id="botonguardar">Guardar</button>
		</center>
	</div>
</form>