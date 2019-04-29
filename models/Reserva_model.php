<?php
	require_once 'Conexion.php';
	class Reserva_model{
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
				$sql = "select *from reserva inner join cliente on(reserva.r_cliente=cliente.c_id) where r_estado=1";
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
				$sql = "insert into reserva(r_cliente,r_fecha) values(
					'".$_POST["cliente"]."',
					'".$_POST["fecha"]."'
				)";
				$query = $this->dbh->prepare($sql);
				$query->execute();

				$sql = "select MAX(r_id) as idreserva from reserva";
				$query = $this->dbh->prepare($sql);
				$query->execute();

				$fila  = $query->fetch();
				$idreserva = $fila['idreserva'];

				if(isset($_POST["habitacion_id"])){
					foreach ($_POST["habitacion_id"] as $key => $value) {
						$sql = "insert into detalle_reserva(dr_reserva,dr_habitacion,dr_monto) values(
							'".$idreserva."',
							'".$_POST["habitacion_id"][$key]."',0
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
				$sql = "update reserva set r_estado=2 where r_id=".$_POST["id"];
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