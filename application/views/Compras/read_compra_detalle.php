<div class="container" style="margin-left: 13%">
	<h1>COMPRAS</h1>
		<div id="body">
			<table id="grid" class="table table-striped table-bordered dt-responsive nowrap" border="1" align="center">
				<thead>
					<tr>
						<th>ID Insumo</th>
						<th>Cantidad</th>
					</tr>
				</thead>
<tbody>
	<?php 
		foreach ($Detalle as $fila) {
	?>
			
				<tr>
					<td><?=	$fila['NOMBRE_I'];?></td>
					<td><?= $fila['CANTIDAD'];?></td>
				</tr>
			
	<?php
		} 
	?>
		</tbody>
			</table>
		
		</div>	
</div>
