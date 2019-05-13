<?php
	require_once 'Conexion.php';
	class Empleado_model{
	    	private static $instancia; private $dbh;
	 
	    	private function __construct(){
	 		$this->dbh = Conexion::singleton_conexion();
	    	}
	 
	    	public static function conectar(){ 
        		if (!isset(self::$instancia)) {
         			$miclase = __CLASS__;
         			self::$instancia = new $miclase; 
        		}
	 		return self::$instancia;
	    	}
		
		public function listar(){	
			try {	
				$sql = "select *from empleado where e_estado=1";
				$query = $this->dbh->prepare($sql);
				$query->execute(); $this->dbh = null;

				$info=array();
					while( $datos = $query->fetch()){
	    				$info[]=$datos;	
	    			}
				return $info;		
			}catch(PDOException $e){
				print "Error!: " . $e->getMessage();	
			}				
		}
		public function traer($tabla,$ini){	
			try {				
				$sql = "select *from ".$tabla." where ".$ini."_estado='1'";
				$query = $this->dbh->prepare($sql);
				$query->execute();

				$info=array();
					while( $datos = $query->fetch()){
	    				$info[]=$datos;	
	    			}
				return $info;		
			}catch(PDOException $e){
				print "Error!: " . $e->getMessage();	
			}				
		}
		public function guardar(){	
			try {	
				if($_POST["id"]==""){
					$sql = "insert into empleado(e_tipoempleado,e_dni,e_nombres,e_apellidos,e_direccion,e_usuario,e_clave,e_celular,e_sexo,e_fechareg) values(
						'".$_POST["tipo_empleado"]."',
						'".$_POST["dni"]."',
						'".$_POST["nombres"]."',
						'".$_POST["apellidos"]."',
						'".$_POST["direccion"]."',
						'".$_POST["usuario"]."',
						'".$_POST["clave"]."',
						'".$_POST["celular"]."',
						'".$_POST["sexo"]."',
						'".date('Y-m-d')."'
					)";
				}else{
					$sql = "update empleado set 
						e_tipoempleado='".$_POST["tipo_empleado"]."',
						e_dni='".$_POST["dni"]."',
						e_nombres='".$_POST["nombres"]."',
						e_apellidos='".$_POST["apellidos"]."',
						e_direccion='".$_POST["direccion"]."',
						e_usuario='".$_POST["usuario"]."',
						e_clave='".$_POST["clave"]."',
						e_sexo='".$_POST["sexo"]."',
						e_celular='".$_POST["celular"]."'
					where e_id=".$_POST["id"];
				}
				$query = $this->dbh->prepare($sql);
				$query->execute(); $this->dbh = null; return 1;
			}catch(PDOException $e){
				print "Error en la base de datos:" . $e->getMessage();	
			}				
		}
		public function info($id){
			try {				
				$sql = "select *from empleado where e_id=".$id;
				$query = $this->dbh->prepare($sql);
				$query->execute(); $this->dbh = null;

				$info=array();
				while( $datos = $query->fetch()){
	    				$info[]=$datos;	
	    			}
				return $info;			
			}catch(PDOException $e){
				print "Error!: " . $e->getMessage();	
			}		
		}
	    	public function eliminar($id){	
				try {				
					$sql = "update empleado set e_estado=0 where e_id=".$_POST["id"];
					$query = $this->dbh->prepare($sql);
					$query->execute(); $this->dbh = null; return 1;
				}catch(PDOException $e){
					print "Error!: " . $e->getMessage();	
				}			
			}
			public function bloquear($id){	
				try {				
					$sql = "update empleado set e_bloqueado=0 where e_id=".$_POST["id"];
					$query = $this->dbh->prepare($sql);
					$query->execute(); $this->dbh = null; return 1;
				}catch(PDOException $e){
					print "Error!: " . $e->getMessage();	
				}			
			}
			public function desbloquear($id){	
				try {				
					$sql = "update empleado set e_bloqueado=1 where e_id=".$_POST["id"];
					$query = $this->dbh->prepare($sql);
					$query->execute(); $this->dbh = null; return 1;
				}catch(PDOException $e){
					print "Error!: " . $e->getMessage();	
				}			
			}

	    	public function __clone(){
	 		trigger_error('No Puede Clonar Este Objeto', E_USER_ERROR); 
	    } 
	}
?>