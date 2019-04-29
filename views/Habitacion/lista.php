<button class="btn btn-success" onclick="nuevo()" style="z-index:2; position: absolute;margin-top:-5px !important;">
	<i class="fa fa-plus-square"></i> Nueva habitacion
</button>
<table class="table table-bordered data-table table-data">
	<thead>
		<tr>
			<th>Codigo</th>
			<th>Nro Habitacion</th>
			<th>Tipo habitacion</th>
			<th>S/. Precio</th>
			<th>Acción</th>
		</tr>
	</thead>
	<tbody>
		<?php 
			foreach ($lista as $value) {?>
				<tr>
					<td><?php echo $value["h_id"]; ?></td>
					<td>Habitacion Nro. <b> <?php echo $value["h_nro"]; ?></b> </td>
					<td><?php echo $value["th_descripcion"]; ?></td>
					<td>S/. <b> <?php echo $value["h_precio"]; ?></b> </td>
					<td>
						<button type="button" class="btn btn-warning btn-xs" onclick="modificar('<?php echo $value["h_id"]; ?>')">
							<i class="fa fa-edit"></i> Editar
						</button>
						<!--<button type="button" class="btn btn-danger btn-xs" onclick="confirmar('<?php echo $value["h_id"]; ?>')">
							<i class="fa fa-trash-o"></i> Eliminar
						</button> -->
					</td>
				</tr>
			<?php }
		?>
	</tbody>
</table>