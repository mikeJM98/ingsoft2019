<button class="btn btn-success" onclick="nuevo()" style="z-index:2; position: absolute;margin-top:-5px !important;">
	<i class="fa fa-plus-square"></i> Nuevo Modulo
</button>
<table class="table table-bordered data-table table-data">
	<thead>
		<tr>
			<th>#</th>
			<th>Nombre Modulo</th>
			<th>Acción</th>
		</tr>
	</thead>
	<tbody>
		<?php 
			foreach ($lista as $value) {?>
				<tr>
					<td><?php echo $value["m_id"]; ?></td>
					<td><?php echo $value["m_descripcion"]; ?></td>
					<td>
						<button type="button" class="btn btn-warning btn-xs" onclick="modificar('<?php echo $value["m_id"]; ?>')">
							<i class="fa fa-edit"></i> Editar
						</button>
						<button type="button" class="btn btn-danger btn-xs" onclick="confirmar('<?php echo $value["m_id"]; ?>')">
							<i class="fa fa-trash-o"></i> Eliminar
						</button>
					</td>
				</tr>
			<?php }
		?>
	</tbody>
</table>