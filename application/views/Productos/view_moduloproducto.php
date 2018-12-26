<!doctype html>
<html lang="en">

<div id="someDiv" class="container" style="margin-left: 13%">
  <h1>PRODUCTOS</h1>
<body>     
  <a  href="<?php echo base_url(); ?>index.php/Productos/add"  class="btn btn-default">Añadir nuevo producto</a>
 <table id="grid" class="table table-striped table-bordered dt-responsive nowrap" border="1" align="center">
  <thead>
    <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>Precio venta</th>
      <th>Insumo</th>
      <th>Estado</th>
      <th>Editar</th>
      <th>Eliminar</th>

    </tr>
  </thead>
  <tbody>
    
   <?php foreach($productos as $item):?>
    <tr>
     
      <td ><?php echo $item['ID_PRODUCTO'];?></td>
      <td ><?php echo $item['NOMBRE'];?></td>
      <td ><?php echo $item['PRECIO_V'];?></td>
      <td ><?php echo $item['NOMBRE_I'];?></td>
      <?php if ($item['ESTADO'] === '1'):?>
          <td><a href="<?php echo base_url();?>index.php/Productos/desactivar/<?=$item['ID_PRODUCTO'];?>">Activo</a></td> 
      <?php elseif($item['ESTADO'] === '0') :?>
          <td><a href="<?php echo base_url();?>index.php/Productos/activar/<?=$item['ID_PRODUCTO'];?>">Inactivo</a></td> 
      <?php endif;?>
      

  
      
      
     <td><a href="<?php echo base_url();?>index.php/Productos/edit/<?=$item['ID_PRODUCTO'];?>">Editar</a> 
     <td><a href="<?php echo base_url();?>index.php/Productos/eliminar/<?=$item['ID_PRODUCTO'];?>" class="delete">Eliminar</a> </td>

     </td>

    </tr>  
 <?php endforeach; ?>
  </tbody>


</table>

  </div>
<!-- Begin page content -->
</body>
</html>