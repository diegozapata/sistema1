

 <div id="someDiv" class="container" style="margin-left: 13%">
<h1>Usuarios</h1>
  <a  href="<?=base_url()?>index.php/Usuarios/add"  class= "btn btnUCM">Agregar Usuario </a>
 <table id="grid" class="table table-striped table-bordered dt-responsive nowrap" border="1" align="center">
  <thead>
    <tr>
      <th scope="col">RUT</th>
      <th scope="col">NOMBRE</th>
      <th scope="col">APELLIDO</th>
      <th scope="col">CARGO</th>
      <th scope="col">PERFIL</th>
      <th>Editar</th>
      <th>Eliminar</th>
        


    </tr>
  </thead>
  <tbody>
   <?php foreach($usuarios as $item):?>
    <tr>
     
      <td ><?php echo $item['RUT'];?></td>
      <td ><?php echo $item['NOMBRE'];?></td>
      <td ><?php echo $item['APELLIDOS'];?></td>
      <td ><?php echo $item['CARGO'];?></td>
      <?php if ($item['ID_PERFIL'] === '24'):?>
          <td>Administrador</td> 
      <?php elseif($item['ID_PERFIL'] === '25') :?>
          <td>Super Administrador</td>

      <?php elseif($item['ID_PERFIL'] === '26') :?>
          <td>Vendedor</td> 
      <?php endif;?>
      


      
      
     <td><a href="<?=base_url()?>index.php/Usuarios/edit/<?=$item['RUT'];?>" >Editar</a></td> 
     <td><a href="<?=base_url()?>index.php/Usuarios/eliminar/<?=$item['RUT'];?>" class="delete">Eliminar</a></td> 

     </td>

    </tr>  
 <?php endforeach; ?>
  </tbody>


</table>

  <a href="<?php echo base_url(); ?>" class="btn btn-danger" >Volver</a>
</div>