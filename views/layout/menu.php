<?php 
	if (!isset($_SESSION['usuario'])){
		header("Location:../");
	}
?>
<aside class="main-sidebar">
    	<section class="sidebar">
	     	<div class="user-panel">
	        	<div class="pull-left image">
	          		<img src="../public/dist/img/usuario2.jpg.png" class="user-image" alt="User Image">
	        	</div>
	        	<div class="pull-left info">
	          		<p><?php echo $_SESSION['usuario'];?></p>
	          		<span class="hidden-xs"><?php echo $_SESSION['perfil'];?></span>
	        	</div>
	     	</div>

	     	<ul class="sidebar-menu">
	        	<li class="header">LISTA OPCIONES</li>
	        	<li class="treeview">
		          	<a href="#">
		            	<i class="fa fa-dashboard"></i> <span>PRINCIPAL</span>
		          	</a>
	        	</li>
	        	<li class="treeview ESTADIAS">
		          	<a href="#">
		            	<i class="fa fa-bed"></i> <span>ESTADIAS</span>
		            	<span class="pull-right-container">
		              		<i class="fa fa-angle-left pull-right"></i>
		            	</span>
		          	</a>
		          	<ul class="treeview-menu" id="ESTADIAS">
		            	<li><a href="#entrada.php"><i class="fa fa-circle-o"></i> Entradas</a></li>
		            	<li><a href="#reserva.php"><i class="fa fa-circle-o"></i> Reservas</a></li>
		            	<li><a href="#huesped.php"><i class="fa fa-circle-o"></i> Huesped</a></li>
		            	<!--<li><a href="#cliente.php"><i class="fa fa-circle-o"></i> Cliente</a></li>-->
		          	</ul>
	        	</li>
	        	<li class="treeview HABITACION">
		          	<a href="#">
		            	<i class="fa fa-home"></i> <span>Habitaciones</span>
		            	<span class="pull-right-container">
		              		<i class="fa fa-angle-left pull-right"></i>
		            	</span>
		          	</a>
		          	<ul class="treeview-menu" id="HABITACION">
		            	<li><a href="#habitacion.php"><i class="fa fa-circle-o"></i> Habitacion</a></li>
		            	<li><a href="#tipo_habitacion.php"><i class="fa fa-circle-o"></i> Tipo habitacion</a></li>
		          	</ul>
	        	</li>
	        
	        	<li class="treeview">
		          	<a href="#">
		            	<i class="fa fa-print"></i> <span>REPORTES</span>
		            	<span class="pull-right-container">
		              		<i class="fa fa-angle-left pull-right"></i>
		            	</span>
		          	</a>
		          	<ul class="treeview-menu">
		            	<li><a href="#reporte.php?accion=1"><i class="fa fa-circle-o"></i> Reserva por dia</a></li>
		            	<li><a href="#reporte.php?accion=2"><i class="fa fa-circle-o"></i> Entrada por dia</a></li>
		          	</ul>
	        	</li>
	        	<li class="treeview">
		          	<a href="#">
		            	<i class="fa fa-print"></i><span>Mantenimiento</span>
		            	<span class="pull-right-container">
		              		<i class="fa fa-angle-left pull-right"></i>
		            	</span>
		          	</a>
		          	<ul class="treeview-menu">
		          		<li><a href="#tipo_documento.php"><i class="fa fa-circle-o"></i> Tipo documento</a></li>
		          		<li><a href="#producto.php"><i class="fa fa-circle-o"></i> Producto</a></li>
		            	<li><a href="#categorias.php"><i class="fa fa-circle-o"></i> Categorias</a></li>
		            	
		            	<li><a href="#ciudad.php"><i class="fa fa-circle-o"></i> Ciudad</a></li>
		            	<li><a href="#pais.php"><i class="fa fa-circle-o"></i> Pais</a></li>
		            	<li><a href="#tipo_cliente.php"><i class="fa fa-circle-o"></i> Tipo cliente</a></li>
		            	<li><a href="#tipo_servicio.php"><i class="fa fa-circle-o"></i> Tipo servicio</a></li>
		          	</ul>
	        	</li>
	        	<li class="treeview">
		          	<a href="#">
		            	<i class="fa fa-print"></i> <span>Usuarios</span>
		            	<span class="pull-right-container">
		              		<i class="fa fa-angle-left pull-right"></i>
		            	</span>
		          	</a>
		          	<ul class="treeview-menu">
		            	<li><a href="empleados.php"><i class="fa fa-circle-o"></i> Usuarios</a></li>
		            	<li><a href="modulos.php"><i class="fa fa-circle-o"></i> Modulos</a></li>
		            	<li><a href="tipo_empleado.php"><i class="fa fa-circle-o"></i> Tipo usuario</a></li>
		            	<!--li><a href="permisos.php"><i class="fa fa-circle-o"></i> Permisos</a></li-->
		          	</ul>
	        	</li>
	        	<li class="header">OTRAS OPCIONES</li>
	        	<li><a href="#../index.php"><i class="fa fa-circle-o text-red"></i> 
	        		<span>CERRAR SESION</span></a>
	        	</li>
	     	</ul>
    	</section>
</aside>