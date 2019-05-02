<?php
	session_start();
	require_once ('../models/login.php');
	$var = Login::Conectandome();
	$temp=false;
 	$error = array();
	if(isset($_POST['usuario'])){ 
		$usuario= $_POST['usuario'];
		$password = $_POST['clave'];

		$usuario = $var->Login_usuario($usuario,$password);
		if ($usuario==true) {
			header("Location: ../controllers/principal.php");
		}else{/*
			if ($res=$var->Estado_cuenta($_POST['usuario'],$_POST['clave'])==0) {
				$_SESSION['intentos']=1;
			}*/
			$temp=true;
			
			if (($_SESSION['user']!=$_POST['usuario'])) {
				$_SESSION['user']=$_POST['usuario'];
				$_SESSION['intentos']=4;
			}/*
			if ($_SESSION['intentos']==1) {
				$bloquear=$var->bloquear_cuenta($_POST['usuario']);
				echo $bloquear . 'cuenta bloqueada' ;
			}*/
			
			$_SESSION['intentos']=$_SESSION['intentos'] - 1;
			$error[]="su cuenta a sido bloqueada. comuniquece con el administrador";
			$error[]="usuario y/o contraceña incorrecta";
			$error[]="sole le quedan " . $_SESSION['intentos'] . " intento";
			require_once("../views/login.php");
			#header("Location: index.php");
		}
	}else{
		require_once("../views/login.php");
	}
?> 