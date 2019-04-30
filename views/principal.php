<!DOCTYPE html>
<html>
	<?php include("layout/css.php"); ?>
	<body class="hold-transition skin-blue sidebar-mini">
		<div class="wrapper">
		  	<?php include("layout/cabecera.php"); ?>
		 	<?php include("layout/menu.php"); ?>
		  
		  	<div class="content-wrapper">
			    	<section class="content">
			      	<div class="row">
			        		<div class="col-xs-12"> <br><br><br><br>
			          			<center><img src="../public/img/fondo.png"></center>
			        		</div>
			      	</div>
			    	</section>
			</div>

			<?php include("layout/footer.php"); ?>
		</div>

		<?php include("layout/js.php"); ?>

		<script>
		  	$(function () {
		    		$("#example1").DataTable();
		  	});
		</script>
	</body>
</html>
