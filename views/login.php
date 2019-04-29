<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>POSADA FLOR DEL VALLE</title>
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<link rel="stylesheet" href="public/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="public/dist/css/AdminLTE.min.css">
	</head>
	<body class="hold-transition login-page">
		<div class="login-box">
		  	<div class="login-logo">
		    		<a><b>POSADA</b>FLOR DEL VALLE</a>
		  	</div>
		  	<div class="login-box-body">
		    		<p class="login-box-msg">Ingresa Usuario y Clave</p>

			    	<form action="controllers/login.php" method="POST">
				     	<div class="form-group has-feedback">
				        	<input type="text" class="form-control" name="usuario" placeholder="Nombre usuario">
				        	<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
				     	</div>
				     	<div class="form-group has-feedback">
				        	<input type="password" class="form-control" name="clave" placeholder="Clave usuario">
				        	<span class="glyphicon glyphicon-lock form-control-feedback"></span>
				     	</div>
					<div class="row">
					     	<div class="col-xs-12">
					       	<button type="submit" class="btn btn-success btn-block btn-flat">Acceder</button>
					     	</div>
			      	</div>
			    	</form>
 
		    		<center> <br><br>
		    			<a href="#">SOFWARE DE HOTEL</a> Curso: Software II - FISI<br>
		    		</center>
		  	</div>
		</div>
		<script src="public/plugins/jQuery/jquery-2.2.3.min.js"></script>
		<script src="public/bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>
