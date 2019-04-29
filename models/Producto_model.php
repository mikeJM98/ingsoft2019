<?php
	require_once 'Conexion.php';
	class Producto_model{
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
				$sql = "select *from producto inner join categoria on(producto.p_categoria=categoria.c_id) where producto.p_estado=1";
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
					$sql = "insert into producto(p_descripcion,p_categoria,p_stock,p_precio) values(
						'".$_POST["descripcion"]."','".$_POST["categoria"]."',
						'".$_POST["stock"]."','".$_POST["precio"]."'
					)";
				}else{
					$sql = "update producto set 
						p_descripcion='".$_POST["descripcion"]."',
						p_categoria='".$_POST["categoria"]."',
						p_stock='".$_POST["stock"]."',
						p_precio='".$_POST["precio"]."'
					where p_id='".$_POST["id"]."'";
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
				$sql = "select *from producto where p_id=".$id;
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
				$sql = "update producto set p_estado=0 where p_id=".$_POST["id"];
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