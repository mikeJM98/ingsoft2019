<form class="form-horizontal" id="formulario" onsubmit="return guardar()">
	<input type="hidden" name="id" id="id">
	<div class="form-group">
		<label class="col-lg-4 control-label">Nombre pais</label>
		<div class="col-lg-5">
			<input type="text" class="form-control" name="descripcion" id="descripcion" maxlength="50" required>
		</div>
	</div>
	<div class="form-group">
		<center>
			<button class="btn btn-danger" type="button" onclick="listado()">Cerrar</button>
			<button class="btn btn-success" type="submit" id="botonguardar">Guardar</button>
		</center>
	</div>
</form>