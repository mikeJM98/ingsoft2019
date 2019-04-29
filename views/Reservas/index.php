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
								<h4 class="modal-title">Seguro que desea anular reserva ? </h4>
							</div>
							<div class="modal-body">
								<center>
									<button data-dismiss="modal" class="btn btn-danger" type="button">No, Cerrar</button>
									<button class="btn btn-success" type="button" onclick="eliminar()">Si, Anular</button>
								</center>
							</div>
						</div>
					</div>
				</div>

				<!-- Lista Clientes-->
	                	<div class="modal fade" tabindex="-1" role="dialog" id="lista_clientes">
	                    	<div class="modal-dialog">
	                        	<div class="modal-content">
	                            	<div class="modal-body">
	                                		<div id="conten_clientes"></div>
	                            	</div>
	                        	</div>
	                    	</div>
	                	</div>
	                	<!-- Para agregar cliente-->
				<div class="modal fade" tabindex="-1" role="dialog" id="agregarcliente">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">Ingresar cliente </h4>
							</div>
							<div class="modal-body">
								<form class="form-horizontal" id="form_cliente" onsubmit="return guardar_cli()">
									<div class="form-group">
										<label class="col-lg-2 control-label">Descripcion</label>
										<div class="col-lg-10">
											<input type="text" class="form-control" placeholder="Descripcion" name="descripcion" id="descripcion" required="true" maxlength="100">
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label">Marca</label>
										<div class="col-lg-4">
											<select class="form-control" name="marca" id="marca" required="true">
												<option value="">Seleccione</value>
												<?php 
													foreach ($marcas as $value) { ?>
														<option value="<?php echo $value["m_id"]; ?>"> 
															<?php echo $value["m_descripcion"]; ?> 
														</option>
													<?php }
												?>
											</select>
										</div>
										<label class="col-lg-2 control-label">Categoria</label>
										<div class="col-lg-4">
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
									<div style="height:1px;background:#f2f2f2;"></div>
									<div class="form-group">
										<center>
											<button data-dismiss="modal" class="btn btn-danger" type="button">Cerrar</button>
											<button class="btn btn-success" type="submit" id="botonproducto">Guardar</button>
										</center>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>

		  	<footer class="main-footer">
			    	<div class="pull-right hidden-xs">
			      	<b>CURSO: </b> SOFTWARE II - FISI - UNSM
			    	</div>
		    		<strong>Copyright &copy; Verano 2017</strong>
		  	</footer>
		</div>

		<?php include("../views/layout/js.php"); ?>

		<script type="text/javascript">
       		var modulo="ESTADIAS"; 
       		var submodulo = "reserva"; 
       		var tabla = "reserva";
                	var campos = ["c_id", "c_descripcion", "c_pais"];
                	var form = ["id","descripcion","pais"];
       	</script>
       	<script src="../public/app/reserva.js"></script>
	</body>
</html>
