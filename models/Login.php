<?php
	require_once 'Conexion.php';
	session_start();
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
	    	public function __clone(){
	 		trigger_error('No Puede Clonar Este Objeto', E_USER_ERROR); 
	    	} 
	}
?>