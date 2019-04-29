<?php
	require_once 'Conexion.php';
	class Cliente_model{
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
				$sql = "select *from cliente where c_estado=1";
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
					$sql = "insert into cliente(c_tipocliente,c_dni,c_nombres,c_direccion,c_celular,c_fechareg) values(
						'".$_POST["tipo_cliente"]."',
						'".$_POST["dni"]."',
						'".$_POST["nombres"]."',
						'".$_POST["direccion"]."',
						'".$_POST["celular"]."',
						'".date('Y-m-d')."'
					)";
				}else{
					$sql = "update cliente set 
						c_tipocliente='".$_POST["tipo_cliente"]."',
						c_dni='".$_POST["dni"]."',
						c_nombres='".$_POST["nombres"]."',
						c_direccion='".$_POST["direccion"]."',
						c_celular='".$_POST["celular"]."'
					where c_id=".$_POST["id"];
				}
				$query = $this->dbh->prepare($sql);
				$query->execute(); $this->dbh = null; return 1;
			}catch(PDOException $e){
				print "Error en la base de datos:" . $e->getMessage();	
			}				
		}
		public function info($id){
			try {				
				$sql = "select *from cliente where c_id=".$id;
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
				$sql = "update cliente set c_estado=0 where c_id=".$_POST["id"];
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