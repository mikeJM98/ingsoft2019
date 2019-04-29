<?php
	require_once 'Conexion.php'; session_start();
	class Base_model{
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

	    	public function listar($tabla,$ini){	
			try {				
				$sql = "select *from ".$tabla." where ".$ini."_estado=1";
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
		public function guardar($tabla,$ini){	
			try {	
				if($_POST["id"]==""){
					$sql = "insert into ".$tabla."(".$ini."_descripcion) values('".$_POST["descripcion"]."')";
				}else{
					$sql = "update ".$tabla." set ".$ini."_descripcion='".$_POST["descripcion"]."' where ".$ini."_id='".$_POST["id"]."'";
				}
				$query = $this->dbh->prepare($sql);
				$query->execute(); $this->dbh = null; return 1;
			}catch(PDOException $e){
				print "Error en la base de datos:" . $e->getMessage();	
			}				
		}
		public function info($tabla,$ini,$id){
			try {				
				$sql = "select *from ".$tabla." where ".$ini."_id=".$id;
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
	    	public function eliminar($tabla,$ini,$id){	
			try {				
				$sql = "update ".$tabla." set ".$ini."_estado=0 where ".$ini."_id=".$id;
				$query = $this->dbh->prepare($sql);
				$query->execute(); $this->dbh = null; return 1;
			}catch(PDOException $e){
				print "Error!: " . $e->getMessage();	
			}				
		}
		public function buscar($sql){
			try {
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

	    	public function __clone(){
	 		trigger_error('No Puede Clonar Este Objeto', E_USER_ERROR); 
	    	} 
	}
?>