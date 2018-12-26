<body>     
  <div class="container" style="margin-left: 13%">
      <h2>Editar proveedor</h2>

    
<form id="form" name="form" action="<?=base_url()?>index.php/Proveedores/editarProveedor/<?=$RUT_PROVEEDOR?>" method="POST">
      <input type="button" class="btn btn-default" style="margin-left: 70%" value="volver" name="volver" onclick="history.back()" /><br>
       <label for="RUT_PROVEEDOR">RUT Proveedor: <?= $RUT_PROVEEDOR?></label><br />
       <input type="hidden" name="RUT_PROVEEDOR" value="<?=$RUT_PROVEEDOR?>" /><br />
       <label for="NOMBRE_P">Nombre</label><br />
       <input type="input" name="NOMBRE_P" value="<?=$NOMBRE_P?>" required /><br />
       <label for="TELEFONO">Teléfono</label><br />
       <input type="input" name="TELEFONO" value="<?=$TELEFONO?>" required/><br />
       <label for="DIRECCION">Dirección</label><br />
       <input type="input" name="DIRECCION" value="<?=$DIRECCION?>" required/><br />
       <input type="submit" name="editar" class="btn btn-default" value="Actualizar proveedor" />
</form>
 
  </div>

</body>