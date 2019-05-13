<button class="btn btn-success" onclick="nuevo()" style="z-index:2; position: absolute;margin-top:-5px !important;">
	<i class="fa fa-plus-square"></i> Nuevo tipo empleado
</button>
<table class="table table-bordered data-table table-data">
	<thead>
		<tr>
			<th>Codigo</th>
			<th>Descripcion</th>
			<th>Acción</th>
		</tr>
	</thead>
	<tbody>
		<?php 
			foreach ($lista as $value) { ?>
				<tr>
					<td><?php echo $value["te_id"]; ?></td>
					<td><?php echo $value["te_descripcion"]; ?></td>
					<td>
						<?php if ($value['te_id']!=1) {?>
							
							<button type="button" class="btn btn-warning btn-xs" onclick="modificar('<?php echo $value["te_id"]; ?>')">
								<i class="fa fa-edit"></i> Editar
							</button>
							<button type="button" class="btn btn-danger btn-xs" onclick="confirmar('<?php echo $value["te_id"]; ?>')">
								<i class="fa fa-trash-o"></i> Eliminar
							</button>
						<?php } ?>
					</td>
				</tr>
			<?php }
		?>
	</tbody>
</table>