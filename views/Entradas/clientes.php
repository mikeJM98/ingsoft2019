<button type="button" data-dismiss="modal" class="btn btn-danger" style="z-index:2; position: absolute;margin-top:-5px !important;">
	Cerrar
</button>
<table class="table table-bordered data-table table-clientes">
	<thead>
		<tr>
			<th>DNI</th>
			<th>Nombres y Apellidos</th>
			<th>Acción</th>
		</tr>
	</thead>
	<tbody>
		<?php 
			foreach ($clientes as $value) {?>
				<tr>
					<td><?php echo $value["c_dni"]; ?></td>
					<td><?php echo $value["c_nombres"]; ?></td>
					<td>
						<button type="button" class="btn btn-success btn-xs" onclick="clientesel('<?php echo $value["c_id"]; ?>','<?php echo $value["c_nombres"]; ?>')">
							<i class="fa fa-ok"></i> Seleccionar
						</button>
					</td>
				</tr>
			<?php }
		?>
	</tbody>
</table>