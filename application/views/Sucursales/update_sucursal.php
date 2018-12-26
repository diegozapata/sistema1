<body>     
  <div class="container" style="margin-left: 13%">
      <h2>Editar sucursal</h2>

    
<form id="form" name="form" action="<?=base_url()?>index.php/Sucursales/editarSucursal/<?=$id?>" method="POST">
      <input type="button" class="btn btn-default" style="margin-left: 70%" value="volver" name="volver" onclick="history.back()" /><br>
       <label for="NOMBRE_S">Nombre</label><br />
       <input type="input" name="NOMBRE_S" value="<?=$NOMBRE_S?>" required /><br />
       <label for="CIUDAD">Ciudad</label><br />
       <input type="input" name="CIUDAD" value="<?=$CIUDAD?>" required/><br />
       <br>
       
       <input type="submit" name="editar" class="btn btn-default" value="Agregar sucursal" />
</form>
 
  </div>

</body>