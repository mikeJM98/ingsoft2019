<form class="form-horizontal" id="formulario" onsubmit="return guardar()">
	<input type="hidden" name="id" id="id">
	<div class="form-group">
		<label class="col-lg-1 control-label"></label>
		<label class="col-lg-1 control-label">DNI*</label>
		<div class="col-lg-2">
			<div class="iconic-input">
				<i class="fa fa-bookmark-o"></i>
				<input type="text" class="form-control" name="dni" id="dni" maxlength="8" minlength="8" required onkeypress="return numeric(event)" onkeyup="buscarcliente()">
			</div>
		</div>
		<label class="col-lg-2 control-label">Nombres completos*</label>
		<div class="col-lg-5">
			<input type="text" class="form-control" name="nombres" id="nombres" required maxlength="40" onkeypress="return letter(event)">
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
		<label class="col-lg-2 control-label">Direccion cliente</label>
		<div class="col-lg-2">
			<div class="iconic-input">
				<i class="fa fa-map-marker"></i>
				<input type="text" class="form-control" name="direccion" id="direccion" maxlength="100" required>
			</div>
		</div>
		<label class="col-lg-1 control-label">Tipo_cliente</label>
		<div class="col-lg-2">
			<select class="form-control" name="tipo_cliente" id="tipo_cliente" required="true">
				<option value="">Seleccione</option>
				<?php 
					foreach ($tipos as $value) { ?>
						<option value="<?php echo $value["tc_id"]; ?>"> 
							<?php echo $value["tc_descripcion"]; ?> 
						</option>
					<?php }
				?>
			</select>
		</div>
	</div>
	<div class="form-group">
		<center>
			<button class="btn btn-danger" type="button" onclick="listado()">Cerrar</button>
			<button class="btn btn-success" type="submit" id="botonguardar">Guardar</button>
		</center>
	</div>
</form>