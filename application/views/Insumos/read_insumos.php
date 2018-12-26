
<div id="someDiv" class="container" style="margin-left: 13%">
	<h1>INSUMOS</h1>
	
	<body>
	<a href="<?php echo base_url();?>index.php/Insumos/add" class="btn btn-default">Añadir nuevo insumo</a>
		<table id="grid" class="table table-striped table-bordered dt-responsive nowrap" border="1" align="center">
			<thead>
			<tr>
				<th>ID</th>
				<th>Nombre</th>
				<th>Precio de compra</th>
				<th>Marca</th>
				<th>Stock</th>
				<th>Proveedor</th>
				<th>Editar</th>
				<th>Eliminar</th>
			</tr>
			</thead>
<tbody>
<?php 
	foreach ($Insumos as $fila) {?>
		
		<tr>
			<td><?=	$fila['ID_INSUMO'];?></td>
			<td><?= $fila['NOMBRE_I'];?></td>
			<td><?= $fila['PRECIO_C'];?></td>
			<td><?= $fila['MARCA'];?></td>
			<td><?= $fila['STOCK'];?></td>
			<td><?= $fila['NOMBRE_P'];?></td>

	
			<td><a href="<?php echo base_url();?>index.php/Insumos/editar/<?=$fila['ID_INSUMO'];?>">Editar</a></td>
			<td><a class="delete" href="<?php echo base_url();?>index.php/Insumos/delete/<?=$fila['ID_INSUMO'];?> ">Eliminar</a></td>
		</tr>
<?php
} 
?>
</tbody>
		</table>
		
	</body>
</div>

