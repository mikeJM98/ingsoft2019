<form class="form-horizontal" id="formulario" onsubmit="return guardar()">
	<div class="form-group">
		<label class="col-lg-2 control-label">Cliente</label>
		<div class="col-lg-4">
            	<div class="input-group m-b-10">
                		<input type="hidden" class="form-control" name="cliente" id="cliente">
                		<input type="text" class="form-control" readonly="true" id="clientename" placeholder="Debe buscar un cliente">
                		<span style="cursor:pointer" class="input-group-addon" onclick="listaclientes()"><i class="fa fa-search"></i></span>
                		<!--<span style="cursor:pointer" class="input-group-addon" onclick="agregar_cliente();"><i class="fa fa-user"></i></span> -->
            	</div>
        	</div>
		<label class="col-lg-2 control-label">Fecha reserva</label>
		<div class="col-lg-2">
			<input type="date" class="form-control" name="fecha" id="fecha" min="<?php echo date('Y-m-d');?>" value="<?php echo date('Y-m-d');?>" required="true" onchange="traerhabitaciones()">
		</div>
	</div>

	<div style="height:1px;background:#f2f2f2;"></div>
	<center><h4>Seleccione habitacion(es) a reservar</h4></center>
	<div style="height:1px;background:#f2f2f2;"></div> <br>

	<div class="form-group">
		<label class="col-lg-2 control-label">Tipo Habitacion</label>
		<div class="col-lg-3">
			<select class="form-control" name="tipo_hab" id="tipo_hab" onchange="traerhabitaciones()">
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
		<label class="col-lg-2 control-label">Seleccione Habitacion</label>
		<div class="col-lg-3">
			<select class="form-control" name="habitacion" id="habitacion">
				<option value="">Seleccione</value>
			</select>
		</div>
		<div class="col-lg-1">
			<button type="button" class="btn btn-success" onclick="agregar()">Reservar</button>
		</div>
	</div>
	<div class="form-group">
		<label class="col-lg-2 control-label"></label>
		<div class="col-lg-8">
			<table class="table table-bordered table-condensed">
				<thead>
					<tr>
						<th>Nro. habitacion</th>
						<th>Tipo habitacion</th>
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