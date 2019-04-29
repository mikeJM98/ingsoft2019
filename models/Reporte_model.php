<?php
	require_once 'Conexion.php';
	class Reporte_model{
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
		
		public function listar($sql){	
			try {						
				$query = $this->dbh->prepare($sql); $query->execute();
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