<div id="someDiv" class="container" style="margin-left: 13%">
	<h1>UCC</h1>

	<body>
	<a href="<?php echo base_url();?>index.php/Ucc/add" class="btn btn-default">Añadir nueva unidad</a>
		<table id="grid" class="table table-striped table-bordered dt-responsive nowrap" border="1" align="center">
			<thead>
			<tr>
				<th>ID</th>
				<th>Numero_UCC</th>
				<th>Nombre</th>
				<th>Tipo de Material</th>
				<th>Anexo</th>
				<th>Editar</th>
				<th>Eliminar</th>

			</tr>
			</thead>


<tbody>
<?php 

	foreach ($UCC as $fila) {?>
		
		<tr>
			<td><?=	$fila['ID_UCC'];?></td>
			<td><?= $fila['NUMERO_UCC'];?></td>
			<td><?= $fila['NOMBRE'];?></td>
	
			<?php if ($fila['TIPO_MATERIAL'] === '0'|| $fila['TIPO_MATERIAL'] === null):?>
          	<td>Administrativo</a></td> 
      		<?php elseif($fila['TIPO_MATERIAL'] === '1' ) :?>
          	<td>Enseñanza</a></td> 
      		<?php endif;?>

			
			<td><?= $fila['ANEXO'];?></td>
			<td><a href="<?php echo base_url();?>index.php/Ucc/editar/<?=$fila['ID_UCC'];?>">Editar</a></td>
			<td><a href="<?php echo base_url();?>index.php/Ucc/delete/<?=$fila['ID_UCC'];?>" class="delete">Eliminar</a>

		</tr>
<?php
} 
?>
</tbody>
		</table>
		
	</body>	
</div>
