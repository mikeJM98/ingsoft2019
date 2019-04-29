<button class="btn btn-success" onclick="nuevo()" style="z-index:2; position: absolute;margin-top:-5px !important;">
	<i class="fa fa-plus-square"></i> Nueva reserva
</button>
<table class="table table-bordered data-table table-data">
	<thead>
		<tr>
			<th>Codigo</th>
			<th>Fecha reserva</th>
			<th>Cliente</th>
			<th>Acción</th>
		</tr>
	</thead>
	<tbody>
		<?php 
			foreach ($lista as $value) {?>
				<tr>
					<td><?php echo $value["r_id"]; ?></td>
					<td><b> <?php echo $value["r_fecha"]; ?></b> </td>
					<td><?php echo $value["c_nombres"]; ?></td>
					<td>
						<button type="button" class="btn btn-danger btn-xs" onclick="confirmar('<?php echo $value["r_id"]; ?>')">
							<i class="fa fa-trash-o"></i> Anular
						</button>
					</td>
				</tr>
			<?php }
		?>
	</tbody>
</table>