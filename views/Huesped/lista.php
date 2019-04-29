<button class="btn btn-success" onclick="nuevo()" style="z-index:2; position: absolute;margin-top:-5px !important;">
	<i class="fa fa-plus-square"></i> Nuevo huesped
</button>
<table class="table table-bordered data-table table-data">
	<thead>
		<tr>
			<th>Documento</th>
			<th>Nombres y Apellidos</th>
			<th>Direccion</th>
			<th>Nacionalidad</th>
			<th>Celular</th>
			<th>Acción</th>
		</tr>
	</thead>
	<tbody>
		<?php 
			foreach ($lista as $value) {?>
				<tr>
					<td><?php echo $value["h_documento"]; ?></td>
					<td><?php echo $value["h_nombres"]; ?></td>
					<td><?php echo $value["h_direccion"]; ?></td>
					<td><?php echo $value["p_descripcion"].' - '.$value["c_descripcion"]; ?></td>
					<td><?php echo $value["h_celular"]; ?></td>
					<td>
						<button type="button" class="btn btn-warning btn-xs" onclick="modificar('<?php echo $value["h_id"]; ?>')">
							<i class="fa fa-edit"></i> Editar
						</button>
						<button type="button" class="btn btn-danger btn-xs" onclick="confirmar('<?php echo $value["h_id"]; ?>')">
							<i class="fa fa-trash-o"></i> Eliminar
						</button>
					</td>
				</tr>
			<?php }
		?>
	</tbody>
</table>