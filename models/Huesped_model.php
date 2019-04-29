<?php
	require_once 'Conexion.php';
	class Huesped_model{
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
				$sql = "select *from huesped inner join ciudad on(huesped.h_nacionalidad=ciudad.c_id) inner join pais on(pais.p_id=ciudad.c_pais) where h_estado=1";
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
		public function infosql($sql){	
			try {
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
		public function traer($tabla,$ini){	
			try {				
				$sql = "select *from ".$tabla." where ".$ini."_estado=1";
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
					$sql = "insert into huesped(h_tipodocumento,h_nacionalidad,h_documento,h_nombres,h_direccion,h_celular,h_fechareg) values(
						'".$_POST["tipo_documento"]."',
						'".$_POST["ciudad"]."',
						'".$_POST["dni"]."',
						'".$_POST["nombres"]."',
						'".$_POST["direccion"]."',
						'".$_POST["celular"]."',
						'".date('Y-m-d')."'
					)";
				}else{
					$sql = "update huesped set 
						h_tipodocumento='".$_POST["tipo_documento"]."',
						h_nacionalidad='".$_POST["ciudad"]."',
						h_documento='".$_POST["dni"]."',
						h_nombres='".$_POST["nombres"]."',
						h_direccion='".$_POST["direccion"]."',
						h_celular='".$_POST["celular"]."'
					where h_id=".$_POST["id"];
				}
				$query = $this->dbh->prepare($sql);
				$query->execute(); $this->dbh = null; return 1;
			}catch(PDOException $e){
				print "Error en la base de datos:" . $e->getMessage();	
			}				
		}
		public function info($id){
			try {
				$sql = "select *from huesped inner join ciudad on(huesped.h_nacionalidad=ciudad.c_id) inner join pais on(pais.p_id=ciudad.c_pais) where h_id=".$id;
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
				$sql = "update huesped set h_estado=0 where h_id=".$_POST["id"];
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