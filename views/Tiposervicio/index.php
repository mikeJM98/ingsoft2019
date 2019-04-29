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

		  	<footer class="main-footer">
			    	<div class="pull-right hidden-xs">
			      	<b>CURSO: </b> SOFTWARE II - FISI - UNSM
			    	</div>
		    		<strong>Copyright &copy; Verano 2017</strong>
		  	</footer>
		</div>

		<?php include("../views/layout/js.php"); ?>

		<script type="text/javascript">
       		var modulo="MAESTRAS"; 
       		var submodulo = "tipo_servicio"; 
       		var tabla = "tipo servicio";
                	var campos = ["ts_id", "ts_descripcion"];
                	var form = ["id","descripcion"];
       	</script>
       	<script src="../public/app/mantenimiento.js"></script>
	</body>
</html>
