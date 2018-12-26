
<div id="someDiv" class="container" style="margin-left: 13%">
	<h1>COMPRAS</h1>
		<div id="body">
			<table id="grid" class="table table-striped table-bordered dt-responsive nowrap" border="1" align="center">
				<thead>
					<tr>
						<th>ID Compra</th>
						<th>ID Usuario</th>
						<th>RUT Proveedor</th>
						<th>N° Factura</th>
						<th>Fecha Compra</th>
						<th>SubTotal</th>
						<th>Total c/IVA</th>
						<th>Estado</th>
						<th>Detalle</th>
					</tr>
				</thead>
			<tbody>
	<?php 
		foreach ($Compras as $fila) {
	?>
		
			
				<tr>
					<td><?=	$fila['ID_COMPRA'];?></td>
					<td><?= $fila['ID_USUARIO'];?></td>
					<td><?= $fila['RUT_PROVEEDOR']?></td>
					<td><?= $fila['N_FACTURA'];?></td>
					<td><?= $fila['FECHA_INGRESO'];?></td>
					<td><?= $fila['SUBTOTAL'];?></td>
					<td><?= $fila['TOTAL'];?></td>
					<?php if ($fila['ESTADO'] === '1'|| $fila['ESTADO'] === null):?>
          			<td><a href="<?php echo base_url();?>index.php/Compras/desactivar/<?=$fila['ID_COMPRA'];?>">Activo</a></td> 
      				<?php elseif($fila['ESTADO'] === '0' ) :?>
          			<td><a href="<?php echo base_url();?>index.php/Compras/activar/<?=$fila['ID_COMPRA'];?>">Inactivo</a></td> 
      				<?php endif;?>
					<td><a href="<?php echo base_url();?>index.php/Compras/detalle_compra/<?=$fila['ID_COMPRA'];?>">Detalle</a></td>
					
		
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