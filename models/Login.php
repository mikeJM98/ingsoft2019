<?php
	require_once 'Conexion.php'; 
	
	class Login{ 
	    	private static $instancia;
	    	private $dbh;
	 
	    	private function __construct(){
	 		$this->dbh = Conexion::singleton_conexion();
	    	}
	 
	    	public static function Conectandome(){ 
        		if (!isset(self::$instancia)) {
            			$miclase = __CLASS__;
            			self::$instancia = new $miclase; 
        		}
	 		return self::$instancia; 
	    	}
		
		public function Login_usuario($usuario,$clave){	
			try {				
				$sql = "select * from empleado where e_usuario = ? and e_clave = ?";
				$query = $this->dbh->prepare($sql);
				$query->bindParam(1,$usuario); $query->bindParam(2,$clave);
				$query->execute(); $this->dbh = null;

				if($query->rowCount() == 1){
					session_destroy();
					session_start();
					$fila  = $query->fetch();
					$_SESSION['idusuario'] = $fila['e_id'];
					$_SESSION['usuario'] = $fila['e_nombres'].' '.$fila['e_apellidos'];	
					if ($fila['e_tipoempleado']==1) {
						$_SESSION['perfil'] = 'Administrador';	
					}else{
						$_SESSION['perfil'] = 'Recepcionista';	
					}	 
					return true;
				}			
			}catch(PDOException $e){
				print "Error!: " . $e->getMessage();	
			}				
		}
		/*
		public function bloquear_cuenta($user){
			$sql = "UPDATE `empleado` SET `e_bloqueado` = '0' WHERE `e_usuario` = ?";
			$query = $this->dbh->query($sql);
			#$query->bindParam(1,$user); 
			#$query->execute(); $this->dbh = null;
	    }*/
	    /*
	    public function Estado_cuenta($usuario, $bloqueado){
			try {				
				$sql = "SELECT * from empleado where e_usuario = ".$usuario."and e_bloqueado =".$bloqueado;
				$query = $this->dbh->prepare("SELECT * from empleado where e_usuario = $usuario and e_bloqueado = $bloqueado");
				$query->execute(); $this->dbh = null;

				if($query->rowCount() == 1){
					$fila  = $query->fetch();
					$_SESSION['idusuario'] = $fila['e_id'];	 
					return true;
				}			
			}catch(PDOException $e){
				print "Error!: " . $e->getMessage();	
			}		
		}*/
	    	public function __clone(){
	 		trigger_error('No Puede Clonar Este Objeto', E_USER_ERROR); 
	    	} 
	}
?>