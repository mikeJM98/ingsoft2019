<!DOCTYPE html>
<html>
	<?php include("../views/layout/css.php"); ?>
	<body class="hold-transition skin-blue sidebar-mini">
		<div class="wrapper">
		  	<?php include("../views/layout/cabecera.php"); ?>
		 	<?php include("../views/layout/menu.php"); ?>
		  
		  	<div class="content-wrapper">
			    	<section class="content">
			      	<div class="row">
			        		<div class="col-xs-12">
			          			<div class="box">
			          				<div class="box-header with-border">
					              		<h3 class="box-title" id="titulo"></h3>
					              		<div class="box-tools pull-right" id="alerta">
					                			<div class="alert alert-danger alerta">
								                	<b>ATENCION USUARIO:</b> 
								                	<b id="alerta_text"></b>
								           	</div>
					              		</div>
					            	</div>
						           	<div class="box-body" id="content"></div>
			          			</div>
			        		</div>
			      	</div>
			    	</section>

			    	<div class="modal fade" tabindex="-1" role="dialog" id="confirmar">
					<div class="modal-dialog modal-sm">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">Seguro que desea eliminar ? </h4>
							</div>
							<div class="modal-body">
								<center>
									<button data-dismiss="modal" class="btn btn-danger" type="button">No, Cerrar</button>
									<button class="btn btn-success" type="button" onclick="eliminar()">Si, Continuar</button>
								</center>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Para agregar pais-->
			<div class="modal fade" tabindex="-1" role="dialog" id="agregarpais">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">Agregar Pais </h4>
							</div>
							<div class="modal-body">
								<form class="form-horizontal" id="form_pais" onsubmit="return guardar_pais()">
									<div class="form-group">
										<label class="col-lg-2 control-label">Descripcion</label>
										<div class="col-lg-10">
											<input type="text" class="form-control" placeholder="Nombre pais" name="des_pais" id="des_pais" required="true" maxlength="100">
										</div>
									</div>
									<div style="height:1px;background:#f2f2f2;"></div>
									<div class="form-group">
										<center>
											<button data-dismiss="modal" class="btn btn-danger" type="button">Cerrar</button>
											<button class="btn btn-success" type="submit" id="botonpais">Guardar</button>
										</center>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>

				<!-- Para agregar ciudad-->
				<div class="modal fade" tabindex="-1" role="dialog" id="agregarciudad">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">Agregar Ciudad </h4>
							</div>
							<div class="modal-body">
								<form class="form-horizontal" id="form_ciudad" onsubmit="return guardar_ciudad()">
									<div class="form-group">
										<label class="col-lg-2 control-label">Descripcion</label>
										<div class="col-lg-10">
											<input type="text" class="form-control" placeholder="Nombre ciudad" name="des_ciudad" id="des_ciudad" required="true" maxlength="100">
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label">Pais</label>
										<div class="col-lg-10">
											<select class="form-control" name="pais_id" id="pais_id"> </select>
										</div>
									</div>
									<div style="height:1px;background:#f2f2f2;"></div>
									<div class="form-group">
										<center>
											<button data-dismiss="modal" class="btn btn-danger" type="button">Cerrar</button>
											<button class="btn btn-success" type="submit" id="botonciudad">Guardar</button>
										</center>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>

			<?php include("../views/layout/footer.php"); ?>
		</div>

		<?php include("../views/layout/js.php"); ?>

		<script type="text/javascript">
       		var modulo="ESTADIAS"; 
       		var submodulo = "huesped"; 
       		var tabla = "huesped";
                	var campos = ["c_id", "c_nombres", "c_tipocliente"];
                	var form = ["id","nombres","tipo"];
       	</script>
       	<script src="../public/app/huesped.js"></script>
		
		   
	                	
	</body>
</html>