
<div id="someDiv" class="container" style="margin-left: 13%">
	<h1>BECAS</h1>
		<div id="body">
			<table id="grid" class="table table-striped table-bordered dt-responsive nowrap" border="1" align="center">
				<thead>
					<tr>
						<th>ID Beca</th>
						<th>N° Beca</th>
						<th>Cantidad</th>
						<th>Fecha Compra</th>
						<th>Estado</th>
					</tr>
				</thead>
			<tbody>
	<?php 
		foreach ($Becas as $fila) {
	?>
		
			
				<tr>
					<td><?=	$fila['ID_BECA'];?></td>
					<td><?= $fila['N_BECA'];?></td>
					<td><?= $fila['CANTIDAD'];?></td>
					<td><?= $fila['FECHA_INGRESO'];?></td>
					<?php if ($fila['ESTADO'] === '1'|| $fila['ESTADO'] === null):?>
          			<td><a href="<?php echo base_url();?>index.php/Becas/desactivar/<?=$fila['ID_BECA'];?>">Activo</a></td> 
      				<?php elseif($fila['ESTADO'] === '0' ) :?>
          			<td><a href="<?php echo base_url();?>index.php/Becas/activar/<?=$fila['ID_BECA'];?>">Inactivo</a></td> 
      				<?php endif;?>
		
				</tr>
			
	<?php
		} 
	?>
			</tbody>

			</table>
		
		</div>	
</div>

	<script language="JavaScript" type="text/javascript">
		$(document).ready(function(){

			$("#grid").DataTable();

    		$("a.delete").click(function(e){
        		if(!confirm('¿Está seguro que desea eliminar este elemento?')){
        	    	e.preventDefault();
        	    	return false;
        		}
        		return true;
    		});
		});
	</script>