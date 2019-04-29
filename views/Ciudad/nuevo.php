<form class="form-horizontal" id="formulario" onsubmit="return guardar()">
	<input type="hidden" name="id" id="id">
	<div class="form-group">
		<label class="col-lg-3 control-label">Nombre ciudad</label>
		<div class="col-lg-6">
			<input type="text" class="form-control" placeholder="Descripcion" name="descripcion" id="descripcion" required="true" maxlength="100">
		</div>
	</div>
	<div class="form-group">
		<label class="col-lg-3 control-label">Pais</label>
		<div class="col-lg-6">
			<select class="form-control" name="pais" id="pais" required="true">
				<option value="">Seleccione</value>
				<?php 
					foreach ($paises as $value) { ?>
						<option value="<?php echo $value["p_id"]; ?>"> 
							<?php echo $value["p_descripcion"]; ?> 
						</option>
					<?php }
				?>
			</select>
		</div>
	</div>
	<div style="height:1px;background:#f2f2f2;"></div>
	<div class="form-group">
		<center>
			<button class="btn btn-danger" type="button" onclick="listado()">Cerrar</button>
			<button class="btn btn-success" type="submit" id="botonguardar">Guardar</button>
		</center>
	</div>
</form>