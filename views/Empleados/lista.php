<button class="btn btn-success" onclick="nuevo()" style="z-index:2; position: absolute;margin-top:-5px !important;">
	<i class="fa fa-plus-square"></i> Nuevo usuario
</button>
<table class="table table-bordered data-table table-data">
	<thead>
		<tr>
			<th>DNI</th>
			<th>Nombres y Apellidos</th>
			<th>Usuario</th>
			<th>Direccion</th>
			<th>Celular</th>
			<th>Acción</th>
		</tr>
	</thead>
	<tbody>
		<?php 
			foreach ($lista as $value) {?>
				<tr>
					<td><?php echo $value["e_dni"]; ?></td>
					<td><?php echo $value["e_nombres"].' '.$value["e_apellidos"]; ?></td>
					<td><?php echo $value["e_usuario"];?></td>
					<td><?php echo $value["e_direccion"]; ?></td>
					<td><?php echo $value["e_celular"]; ?></td>
					<td>
						<button type="button" class="btn btn-success btn-xs" onclick="modificar('<?php echo $value["e_id"]; ?>')">
							<i class="fa fa-edit"></i> Editar
						</button>
						<?php if($value['e_tipoempleado']!=1) {?>							 
							<button type="button" class="btn btn-danger btn-xs" onclick="confirmar('<?php echo $value["e_id"]; ?>')">
								<i class="fa fa-trash-o"></i> Eliminar
							</button>
						<?php }?>
						<?php if($value['e_bloqueado']==1 && $value['e_tipoempleado']!=1) {?>							 
							<button type="button" class="btn btn-warning btn-xs" onclick="bloquea('<?php echo $value["e_id"]; ?>')">
								<i class="fa fa-trash-o"></i> Bloquear
							</button>
						<?php }
						if($value['e_bloqueado']!=1 && $value['e_tipoempleado']!=1){?>
							<button type="button" class="btn btn-danger btn-xs" onclick="desbloquea('<?php echo $value["e_id"]; ?>')">
								<i class="fa fa-trash-o"></i> Des-Bloquear
							</button>
						<?php }?>
					</td>
				</tr>
			<?php }
		?>
	</tbody>
</table>