<?php
	require_once 'Conexion.php';
	class Ciudad_model{
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
				$sql = "select *from ciudad inner join pais on(ciudad.c_pais=pais.p_id) where ciudad.c_id>0 and ciudad.c_estado=1";
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
					$sql = "insert into ciudad(c_descripcion,c_pais) values(
						'".$_POST["descripcion"]."',
						'".$_POST["pais"]."'
					)";
				}else{
					$sql = "update ciudad set 
						c_descripcion='".$_POST["descripcion"]."',
						c_pais='".$_POST["pais"]."'
					where c_id='".$_POST["id"]."'";
				}
				$query = $this->dbh->prepare($sql);
				$query->execute();
				$this->dbh = null; return 1;
			}catch(PDOException $e){
				print "Error en la base de datos:" . $e->getMessage();	
			}				
		}
		public function info($id){
			try {				
				$sql = "select *from ciudad where c_id=".$id;
				$query = $this->dbh->prepare($sql);
				$query->execute();

				$info=array(); $data=array(); 
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
				$sql = "update ciudad set c_estado=0 where c_id=".$_POST["id"];
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