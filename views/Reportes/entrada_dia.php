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
			      		<div class="col-xs-3"></div>
			        		<div class="col-xs-6">
			          			<div class="box">
			          				<div class="box-header with-border">
					              		<h3 class="box-title" id="titulo">Reporte De Entradas Realizadas - Seleccione Rango</h3>
					            	</div>
						           	<div class="box-body" id="content">
						           		<div class="row">
										<div class="col-md-4">
											<h5><i class="fa fa-calendar"></i> Entradas Desde</h5>
										</div>
										<div class="col-md-8">
											<?php 
												$act = date('Y-m-d'); 
												$fin = date('Y-m-d',strtotime('-1 month', strtotime($act))); 
											?>
											<input class="form-control" type="date" name="rango1" id="rango1" value="<?php echo $fin;?>">
										</div>
									</div> <br>
									<div class="row">
										<div class="col-md-4">
											<h5><i class="fa fa-calendar"></i> Entradas Hasta</h5>
										</div>
										<div class="col-md-8">
											<input class="form-control" type="date" name="rango2" id="rango2" value="<?php echo $act;?>">
										</div>
									</div> <br>
									<div class="row">
										<div class="col-md-12"> <center>
											<button type="button" class="btn btn-success" onclick="imprimir_entradas()">Listar entradas PDF</button> </center>
										</div>
									</div>
						           	</div>
			          			</div>
			        		</div>
			      	</div>
			    	</section>
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
       		var modulo="REPORTES"; 
       		var submodulo = "reporte"; 
       		var tabla = "reporte";
                	var campos = ["r_id", "r_descripcion", "r_pais"];
                	var form = ["id","descripcion","pais"];
       	</script>
       	<script src="../public/app/reporte.js"></script>
	</body>
</html>
