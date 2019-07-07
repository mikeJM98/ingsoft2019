<?php
	require_once 'Conexion.php';
	class Entrada_model{
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
				$sql = "select detalle_reserva.dr_habitacion from reserva inner join detalle_reserva on(reserva.r_id=detalle_reserva.dr_reserva) where reserva.r_estado=1 and reserva.r_fecha='".date('Y-m-d')."'";
				$query = $this->dbh->prepare($sql);
				$query->execute();

				$info=array();
				while( $datos = $query->fetch()){
	    				$info[]=$datos;	
	    			}
	    			if (count($info)==0) {
	    				$sql = "update habitacion set h_estado=1 where h_estado=3";
					$query = $this->dbh->prepare($sql); $query->execute();
	    			}else{
	    				foreach ($info as $key => $value) {
		    				$sql = "update habitacion set h_estado=3 where h_id=".$value["dr_habitacion"];
						$query = $this->dbh->prepare($sql); $query->execute();
		    			}
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

		public function insertar($sql){	
			try {
				$query = $this->dbh->prepare($sql);
				$query->execute(); 
				return '1';		
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
				$sql = "select *from huesped where h_documento='".$_POST["dni"]."' ";
				$query = $this->dbh->prepare($sql);
				$query->execute();

				if($query->rowCount() > 0){
					$fila  = $query->fetch(); $huesped = $fila['h_id'];
				}else{
					$sql = "insert into huesped(h_tipodocumento,h_nacionalidad,h_documento,h_nombres,h_fechareg) values(
						'".$_POST["tipo_documento"]."',
						'".$_POST["ciudad"]."',
						'".$_POST["dni"]."',
						'".$_POST["nombres"]."',
						'".date('Y-m-d')."'
					)";
					$query = $this->dbh->prepare($sql);
					$query->execute();

					$sql = "select MAX(h_id) as idhuesped from huesped";
					$query = $this->dbh->prepare($sql); $query->execute();

					$fila  = $query->fetch(); $huesped = $fila['idhuesped'];
				}			

				$sql = "insert into entrada(e_huesped,e_empleado,e_habitacion,e_ciudad,e_fechaini,e_fechafin,e_dias,e_total) values(
					'".$huesped."',
					'".$_SESSION['idusuario']."',
					'".$_POST["habitacion"]."',
					'".$_POST["ciudad"]."',
					'".$_POST["fechaini"]."',
					'".$_POST["fechafin"]."',
					'".$_POST["dias"]."',
					'".$_POST["total"]."'
				)";
				$query = $this->dbh->prepare($sql);
				$query->execute();

				$sql = "update habitacion set h_estado=2 where h_id=".$_POST["habitacion"];
				$query = $this->dbh->prepare($sql); $query->execute();

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
				$sql = "update habitacion set h_estado=1 where h_id=".$_POST["id"];
				$query = $this->dbh->prepare($sql); $query->execute(); 

				$sql = "update entrada set e_estado=0 where e_habitacion=".$_POST["id"];
				$query = $this->dbh->prepare($sql); $query->execute(); 

				$this->dbh = null; return 1;
			}catch(PDOException $e){
				print "Error!: " . $e->getMessage();	
			}				
		}

	    	public function __clone(){
	 		trigger_error('No Puede Clonar Este Objeto', E_USER_ERROR); 
	    	} 
	}
?>