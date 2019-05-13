<?php
	session_start();
	require_once ('../models/Login.php');
	$var = Login::Conectandome();
	$temp=false;
	$error = array();
	$error[1]='';

	if(isset($_POST['usuario'])){ 
		$usuario= $_POST['usuario'];
		$password = $_POST['clave'];
		
		
		$user=pdo("select e_usuario, e_bloqueado, e_tipoempleado from empleado where e_usuario='". $_POST['usuario']."'");
		if (!empty($user)) {
			#print_r($user[0]['e_bloqueado']." mike ");
			if ($user[0]['e_bloqueado']==1 || $user[0]['e_tipoempleado']==1) {
				if (($_SESSION['user']!=$_POST['usuario'])) {
					$_SESSION['user']=$_POST['usuario'];
					$_SESSION['intentos']=4;
					$error[2]='';
					$error[3]="usuario y/o contraceña incorrecta";
				}else{
					$_SESSION['intentos']=$_SESSION['intentos'] - 1;
					$error[2]="sole le quedan " . $_SESSION['intentos'] . " intentos";

					if ($_SESSION['intentos']==0) {
						$bloqueado=pdo("UPDATE `empleado` SET `e_bloqueado` = b'0' where e_usuario='". $_POST['usuario']."'");
						if (empty($bloqueado)) {
							#echo "cuenta del usuario ".$_POST['usuario'] . ' bloqueada' ;
							$error[1]="su cuenta a sido bloqueada. comuniquece con el administrador";
						}
					}
					$usuario = $var->Login_usuario($usuario,$password);
					if ($usuario==true) {
						$sql = "select m.m_descripcion, te.te_descripcion FROM permisos p, modulos m, tipo_empleado te where p.m_id=m.m_id and p.m_tipo_usuario=te.te_id and te.te_id=".$_SESSION['perfil'];
						$msg=pdo($sql);
						$modulos = array();
						foreach ($msg[0] as $key => $value) {
							#if (in_array($value, $modulos)) {
							#}else {
								$modulos[]=$value;
							#}
						}
						$_SESSION['modulos']=$modulos;
						$_SESSION['perfil']=$msg[0]['te_descripcion'];
						header("Location: ../controllers/principal.php");
												
					}else{
						$temp=true;	
						require_once("../views/login.php");
						#header("Location: index.php");
					}
				}
			}else{
				$_SESSION['intentos']=0;
				if ($_SESSION['intentos']==0) {
					#echo "cuenta del usuario ".$_POST['usuario'] . ' bloqueada' ;
					$error[1]="su cuenta esta bloqueada. comuniquece con el administrador";
					
				}
				require_once("../views/login.php");
			}
			
		}else{
			$error[3]="usuario y/o contraceña incorrecta";
			require_once("../views/login.php");
		}
		#header("Location: ../controllers/login.php");
		
	}else{
		require_once("../views/login.php");
	}

	function pdo($sql)
	{
		try{
			$db = new PDO('mysql:host=localhost;dbname=hotel', 'root', '');
			$res=$db->query($sql);

			$list = array();
				if($res){
				foreach ($res as $key => $value ) {
					$list[]=$value;
				}
			}

			return $list;
		}catch(PDOException  $e ){
			echo "Error: ".$e;
		}
	}
?> 