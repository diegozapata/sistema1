
<div class="container" style="margin-left: 13% ">
	<h1>Sucursales</h1>
	
	<div id="body">
	<a href="<?php echo base_url();?>index.php/Sucursales/add" class="btn btn-default">Añadir nueva sucursal</a>
		<table id="grid" class="table table-striped table-bordered dt-responsive nowrap" border="1" align="center">
			<thead>
			<tr>
				<th>ID</th>
				<th>Nombre</th>
				<th>Ciudad</th>
				<th>Editar</th>
				<th>Eliminar</th>
			</tr>
			</thead>
<tbody>
<?php 

	foreach ($Sucursales as $fila) {?>
		
		<tr>
			<td><?=	$fila['ID_SUCURSAL'];?></td>
			<td><?= $fila['NOMBRE_S'];?></td>
			<td><?= $fila['CIUDAD'];?></td>
	
			<td><a href="<?php echo base_url();?>index.php/Sucursales/editar/<?=$fila['ID_SUCURSAL'];?>">Editar</a></td>
			<td><a class="delete" href="<?php echo base_url();?>index.php/Sucursales/delete/<?=$fila['ID_SUCURSAL'];?> ">Eliminar</a></td>

		</tr>
<?php
} 
?>
</tbody>
		</table>
		
	</div>	
</div>
