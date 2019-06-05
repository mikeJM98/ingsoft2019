<form class="form-horizontal" id="formulario" onsubmit="return guardar()">
	<input type="hidden" name="id" id="id">
	<div class="form-group">
		<label class="col-lg-3 control-label">Tipo habitacion</label>
		<div class="col-lg-3">
			<select class="form-control" name="tipo_habitacion" id="tipo_habitacion" required="true">
				<option value="">Seleccione</value>
				<?php 
					foreach ($tipos as $value) { ?>
						<option value="<?php echo $value["th_id"]; ?>"> 
							<?php echo $value["th_descripcion"]; ?> 
						</option>
					<?php }
				?>
			</select>
		</div>
		<label class="col-lg-1 control-label">Nro. Hab.</label>
		<div class="col-lg-2">
			<input type="text" class="form-control" placeholder="Nro" name="nro" id="nro" required="true" maxlength="5">
		</div>
	</div>
	<div class="form-group">
		<label class="col-lg-3 control-label">Descripcion</label>
		<div class="col-lg-3">
			<input type="text" class="form-control" placeholder="Descripcion de la habitacion (no requerida)" name="descripcion" id="descripcion" maxlength="100">
		</div>
		<label class="col-lg-1 control-label">S/.precio</label>
		<div class="col-lg-2">
			<input type="text" class="form-control" onkeypress="return numeric(event)" name="precio" id="precio" required="true" placeholder="Precio">
		</div>
	</div>
	<div style="height:1px;background:#f2f2f2;"></div>
	<center><h4>Lista de enseres en la habitacion</h4></center>
	<div style="height:1px;background:#f2f2f2;"></div> <br>

	<div class="form-group">
		<label class="col-lg-2 control-label">Categoria</label>
		<div class="col-lg-2">
			<select class="form-control" name="categoria" id="categoria">
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
		<label class="col-lg-2 control-label">Descripcion del enser</label>
		<div class="col-lg-3">
			<input type="text" class="form-control" placeholder="Descripcion del enser" name="descr" id="descr">
		</div>
		<div class="col-lg-2">
			<button type="button" class="btn btn-success" onclick="agregar()"> Agregar Enser</button>
		</div>
	</div>
	<div class="form-group">
		<label class="col-lg-2 control-label"></label>
		<div class="col-lg-8">
			<table class="table table-bordered table-condensed">
				<thead>
					<tr>
						<th>Categoria</th>
						<th>Descripcion Enser</th>
						<th>Accion</th>
					</tr>
				</thead>
				<tbody id="lista"></tbody>
			</table>
		</div>
	</div>
	<div class="form-group">
		<center>
			<button class="btn btn-success" type="submit" id="botonguardar">Guardar</button>
			<button class="btn btn-danger" type="button" onclick="listado()">Cerrar</button>		
		</center>
	</div>
</form>