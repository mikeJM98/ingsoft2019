<form class="form-horizontal" id="formulario" onsubmit="return guardar()">
	<input type="hidden" name="id" id="id">
	<div class="form-group">
		<label class="col-lg-2 control-label">Nombre producto</label>
		<div class="col-lg-5">
			<input type="text" class="form-control" placeholder="Descripcion" name="descripcion" id="descripcion" required="true" maxlength="100">
		</div>
		<label class="col-lg-1 control-label">Categoria</label>
		<div class="col-lg-3">
			<select class="form-control" name="categoria" id="categoria" required="true">
				<option value="">Seleccione</value>
				<?php 
					foreach ($categorias as $value) { ?>
						<option value="<?php echo $value["c_id"]; ?>"> 
							<?php echo $value["c_descripcion"]; ?> 
						</option>
					<?php }
				?>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="col-lg-2 control-label">S/. Precio</label>
		<div class="col-lg-2">
			<input type="text" class="form-control" placeholder="Precio" name="precio" id="precio" required="true" maxlength="8" onkeypress="return numeric(event)">
		</div>
		<label class="col-lg-1 control-label">Stock</label>
		<div class="col-lg-2">
			<input type="text" class="form-control" placeholder="Stock" name="stock" id="stock" required="true" maxlength="10" onkeypress="return numeric(event)" >
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