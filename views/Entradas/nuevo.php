<form class="form-horizontal" id="formulario" onsubmit="return guardar()">
	<div class="row">
     		<div class="col-xs-6">
    			<div class="box box-success">
    				<div class="box-header with-border">
	              		<h3 class="box-title">Datos del Huesped</h3>
	            	</div>
	           		<div class="box-body">
	           			<div class="form-group">
						<label class="col-lg-2 control-label">Tipo_Doc.</label>
						<div class="col-lg-4">
							<select class="form-control" name="tipo_documento" id="tipo_documento" onchange="tipodoc()" required="true">
								<option value="1">DNI</option>
								<option value="2">RUC</option>
							</select>
						</div>
						<label class="col-lg-1 control-label" id="doc">DNI</label>
						<div class="col-lg-5">
							<input type="text" class="form-control" name="dni" id="dni" maxlength="8" minlength="8" required onkeypress="return numeric(event)" onkeyup="buscarcliente()" placeholder="Nro DNI">
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label" id="name">Nombres</label>
						<div class="col-lg-10">
							<input type="text" class="form-control" name="nombres" id="nombres" required maxlength="100" onkeypress="return letter(event)">
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label" id="name">Pais</label>
						<div class="col-lg-5">
							<div class="input-group m-b-10">
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
								<span style="cursor:pointer" class="input-group-addon" onclick="agregarpais()"><i class="fa fa-plus"></i></span>
							</div>
						</div>
						<div class="col-lg-5">
							<div class="input-group m-b-10">
								<select class="form-control" name="ciudad" id="ciudad" required="true">
									<option value="">Seleccione Ciudad</option>
								</select>
								<span style="cursor:pointer" class="input-group-addon" onclick="agregarciudad()"><i class="fa fa-plus"></i></span>
							</div>
						</div>
					</div>
	           		</div>
    			</div>
     		</div>
     		<div class="col-xs-6">
    			<div class="box box-warning">
    				<div class="box-header with-border">
	              		<h3 class="box-title">Seleccionar Habitacion</h3>
	            	</div>
	           		<div class="box-body">
	           			<div class="form-group">
						<label class="col-lg-5 control-label">Tipo Habitacion</label>
						<div class="col-lg-6">
							<select class="form-control" name="tipo_hab" id="tipo_hab" onchange="traerhabitaciones()" required="true">
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
					</div>
					<div class="form-group">
						<label class="col-lg-5 control-label">Seleccione Habitacion</label>
						<div class="col-lg-6">
							<select class="form-control" name="habitacion" id="habitacion" onchange="infohab()" required="true">
								<option value="">Seleccione</value>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">Fecha_inicio</label>
						<div class="col-lg-4">
							<input type="date" class="form-control" name="fechaini" id="fechaini" min="<?php echo date('Y-m-d');?>" value="<?php echo date('Y-m-d');?>" required="true" readonly="true">
						</div>
						<label class="col-lg-2 control-label">Fecha_fin</label>
						<div class="col-lg-4">
						  	<?php $act = date('Y-m-d'); $fin = date('Y-m-d',strtotime('+1 days', strtotime($act))); ?>
							<input type="date" class="form-control" name="fechafin" id="fechafin" min="<?php echo date('Y-m-d');?>" value="<?php echo $fin;?>" required="true" onchange="dias_est()">
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-3 control-label">S/. Precio Hab.</label>
						<div class="col-lg-3">
							<input class="form-control" name="preciohab" id="preciohab" value="0.00" readonly="true">
						</div>
						<label class="col-lg-2 control-label">C. dias</label>
						<div class="col-lg-4">
							<input class="form-control" name="dias" id="dias" value="1" readonly="true">
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-8 control-label">S/. Total_Estadia</label>
						<div class="col-lg-4">
							<input class="form-control" style="border: 2px solid #54C42F" name="total" id="total" value="0.00" readonly="true">
						</div>
					</div>
	           		</div>
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