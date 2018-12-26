<div class="container" style="margin-left: 13%">
	<h1>VENTAS</h1>
		<div id="body">
			<table id="grid" class="table table-striped table-bordered dt-responsive nowrap" border="1" align="center">
				<thead>
				<tr>
					<th>ID Producto</th>
					<th>Cantidad</th>
				</tr>
				</thead>
	<tbody>
	<?php 
		foreach ($Detalle as $fila) {
	?>
		
			<tr>
				<td><?=	$fila['NOMBRE'];?></td>
				<td><?= $fila['CANTIDAD'];?></td>
			</tr>
	<?php
		} 
	?>
	</tbody>
			</table>
		
		</div>	
</div>