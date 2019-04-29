<?php
	require_once 'Conexion.php';
	class Habitacion_model{
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
				$sql = "select *from habitacion inner join tipo_habitacion on(habitacion.h_tipohabitacion=tipo_habitacion.th_id) where habitacion.h_estado>0";
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
					$sql = "insert into habitacion(h_descripcion,h_nro,h_precio,h_tipohabitacion) values(
						'".$_POST["descripcion"]."',
						'".$_POST["nro"]."',
						'".$_POST["precio"]."',
						'".$_POST["tipo_habitacion"]."'
					)";
				}else{
					$sql = "delete from enseres where e_habitacion=".$_POST["id"];
					$query = $this->dbh->prepare($sql);
					$query->execute();

					$sql = "update habitacion set 
						h_descripcion='".$_POST["descripcion"]."',
						h_nro='".$_POST["nro"]."',
						h_precio='".$_POST["precio"]."',
						h_tipohabitacion='".$_POST["tipo_habitacion"]."'
					where h_id='".$_POST["id"]."'";
				}
				$query = $this->dbh->prepare($sql);
				$query->execute();

				if($_POST["id"]==""){
					$sql = "select MAX(h_id) as idhabitacion from habitacion";
					$query = $this->dbh->prepare($sql);
					$query->execute();

					if($query->rowCount() == 1){
						$fila  = $query->fetch();
						$idhabitacion = $fila['idhabitacion'];
					}
				}else{
					$idhabitacion = $_POST["id"];
				}

				if(isset($_POST["categoria_id"])){
					foreach ($_POST["categoria_id"] as $key => $value) {
						$sql = "insert into enseres(e_habitacion,e_categoria,e_descripcion) values(
							'".$idhabitacion."',
							'".$_POST["categoria_id"][$key]."',
							'".$_POST["descripcion_enser"][$key]."'
						)";
						$query = $this->dbh->prepare($sql);
						$query->execute(); 
					}
				}
				$this->dbh = null; return 1;
			}catch(PDOException $e){
				print "Error en la base de datos:" . $e->getMessage();	
			}				
		}
		public function info($id){
			try {				
				$sql = "select *from habitacion where h_id=".$id;
				$query = $this->dbh->prepare($sql);
				$query->execute();

				$info=array(); $data=array(); 
				while( $datos = $query->fetch()){
	    				$info[]=$datos;	
	    			}
	    			$data["data"] = $info;

	    			$sql = "select *from enseres inner join categoria on(enseres.e_categoria=categoria.c_id) where enseres.e_habitacion=".$id;
				$query = $this->dbh->prepare($sql);
				$query->execute(); $this->dbh = null;

				$info=array();
				while( $datos = $query->fetch()){
	    				$info[]=$datos;	
	    			}
	    			$data["enseres"] = $info;
				return $data;			
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