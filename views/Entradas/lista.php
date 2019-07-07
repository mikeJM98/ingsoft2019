<div class="row">
	<div class="col-md-3">
		<div class="box box-success">
			<div class="box-header with-border" align="center"> <br><br>
				<button class="btn btn-success" onclick="nuevo()" >
					<i class="fa fa-plus-square"></i> Nueva estadia
				</button> <br><br><br>
		     	</div>
		</div>
	</div>
	<?php 
		//Habitaciones estados = 0: Inabilitada, 1: Libre, 2: Ocupada, 3: Reservada hoy
		foreach ($habitaciones as $value) { 
			if ($value["h_estado"]==1) {
				$color = 'success'; $letra = '#00a65a';
			}else{
				if ($value["h_estado"]==2) {
					$color = 'danger'; $letra = '#dd4b39';
				}else{
					$color = 'warning'; $letra = '#f39c12';
				}
			} ?>
			<div class="col-md-3">
				<div class="box box-<?php echo $color;?>">
					<div class="box-header with-border" align="center">
						<h3 class="box-title">Habitacion Nro: <?php echo $value["h_nro"]?></h3>
						<p><?php echo $value["th_descripcion"]; ?></p>
						<?php 
							if ($value["h_estado"]==1) { ?>
								<h3 class="box-title" style="color: <?php echo $letra;?>; font-weight: bold;">HAB. LIBRE</h3><br><br>
								<button type="button" class="btn btn-success">Precio S/. <?php echo $value["h_precio"];?></button>
							<?php }else{
								if ($value["h_estado"]==2) { ?>
									<h3 class="box-title" style="color: <?php echo $letra;?>; font-weight: bold;">OCUPADA</h3><br><br>
									<button type="button" class="btn btn-danger" onclick="confirmar(<?php echo $value['h_id'];?>)">Finalizar</button>
									<button type="button" class="btn btn-warning" name="ver" id="ver" onclick="infoentrada(<?php echo $value['h_id'];?>)">Ver</button>
									<button type="button" class="btn btn-success" onclick="agregar_servicio(<?php echo $value['h_id'];?>)"><i class="fa fa-plus"></i> Servicio</button>
								<?php }else{ ?>
									<h3 class="box-title" style="color: <?php echo $letra;?>; font-weight: bold;">RESERVADA HOY</h3><br><br>
									<button type="button" class="btn btn-warning">Precio S/. <?php echo $value["h_precio"];?></button>
								<?php }
							}
						?>
						
				     	</div>
				</div>
			</div>
		<?php }
	?>
</div>