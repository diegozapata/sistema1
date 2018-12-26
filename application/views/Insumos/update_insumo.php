<body>     
  <div class="container" style="margin-left: 13%">
      <h2>Editar insumo</h2>

  
    
<form id="form" name="form" action="<?=base_url()?>index.php/Insumos/editarInsumo/<?=$id?>" method="POST">
      <input type="button" class="btn btn-default" style="margin-left: 70%" value="volver" name="volver" onclick="history.back()" /><br>
       <label for="NOMBRE_I">Nombre</label><br />
       <input type="input" name="NOMBRE_I" value="<?=$NOMBRE_I?>" required/><br />
       <label for="PRECIO_C">Precio de compra</label><br />
       <input type="input" name="PRECIO_C" value="<?=$PRECIO_C?>" required/><br />
       <label for="MARCA">Marca</label><br />
       <input type="input" name="MARCA" value="<?=$MARCA?>" required/><br />
       <label for="STOCK">Stock</label><br />
       <input type="input" name="STOCK" value="<?=$STOCK?>" required/><br />
  
       <label> Proveedor </label>
        <select style="display: block;width:40%" name="selectProveedores" >
        <?php foreach ($proveedor as $f) {?>
    

        <option type="input" value="<?php echo $f["RUT_PROVEEDOR"] ?>"><?php echo $f["NOMBRE_P"]?> </option>  
        <?php
        }
        ?>
       <?php foreach ($proveedores as $k => $v): ?>
        <option type="input" value="<?php echo $v["RUT_PROVEEDOR"] ?>"><?php echo $v["NOMBRE_P"] ?></option>
        <?php endforeach ?>

</select>
<br>

       
       <input type="submit" name="editar" class="btn btn-default" value="Modificar" />
</form>
 
  </div>

</body>