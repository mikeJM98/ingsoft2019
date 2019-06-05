<form class="form-horizontal" id="formulario" onsubmit="return guardar()">
	<input type="hidden" name="id" id="id">
	<div class="form-group">
		<label class="col-md-1 control-label">Tipo_Doc.</label>
		<div class="col-md-2">
			<select class="form-control" name="tipo_documento" id="tipo_documento" onchange="tipodoc()" required="true">
				<?php 
					foreach ($tipos as $value) { ?>
						<option value="<?php echo $value["td_id"]; ?>"> 
							<?php echo $value["td_descripcion"]; ?> 
						</option>
					<?php }
				?>
			</select>
		</div>
		<label class="col-md-1 control-label" id="doc"># DNI <i class="fa fa-bookmark-o"></i></label>
		<div class="col-md-2">
			<div class="iconic-input">
				<input type="text" class="form-control" name="dni" id="dni" maxlength="8" minlength="8" required onkeypress="return numeric(event)" onkeyup="buscarcliente()" placeholder="Nro DNI">
			</div>
		</div>
		<label class="col-md-2 control-label">Nombres completos</label>
		<div class="col-md-4">
			<input type="text" class="form-control" name="nombres" id="nombres" required maxlength="40" onkeypress="return letter(event)">
		</div>
	</div>
	<div class="form-group">
		<label class="col-md-1 control-label">Celular <i class="fa fa-mobile"></i></label>
		<div class="col-md-2">
			<div class="iconic-input bg-danger">
				<input type="text" class="form-control" name="celular" id="celular" maxlength="10" onkeypress="return numeric(event)">
			</div>
		</div>
		<label class="col-md-1 control-label">Pais</label>
		<div class="col-md-2">
			<select class="form-control" name="pais" id="pais" required="true" onchange="traerciudad()">
				<option value="">Seleccione</option>
				<?php 
					foreach ($paises as $value) { ?>
						<option value="<?php echo $value["p_id"]; ?>"> 
							<?php echo $value["p_descripcion"]; ?> 
						</option>
					<?php }
				?>
			</select>
		</div>
		<label class="col-md-2 control-label">Ciudad Huesped</label>
		<div class="col-md-4">
			<select class="form-control" name="ciudad" id="ciudad" required="true">
				<option value="">Seleccione Ciudad</option>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="col-md-1 control-label">Dir. <i class="fa fa-map-marker"></i></label>
		<div class="col-md-5">
			<div class="iconic-input">
				<input type="text" class="form-control" name="direccion" id="direccion" maxlength="100" required>
			</div>
		</div>
	</div>
	<div class="form-group">
		<center>
			<button class="btn btn-success" type="submit" id="botonguardar">Guardar</button>
			<button class="btn btn-danger" type="button" onclick="listado()">Cerrar</button>
		</center>
	</div>
</form>