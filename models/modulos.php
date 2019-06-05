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
				$sql = "select *from modulos";
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
				$sql = "INSERT INTO `modulos` (`m_id`, `m_descripcion`, `m_estado`) VALUES (3,'." $_POST['descripcion'].", 1)";
				echo "$sql";
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

	    	public function __clone(){
	 		trigger_error('No Puede Clonar Este Objeto', E_USER_ERROR); 
	    	} 
	}
?>