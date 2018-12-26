<body>     
  <div class="container" style="margin-left: 13%">
      <h2>Editar insumo</h2>

  
    
<form id="form" name="form" action="<?=base_url()?>index.php/Insumos/editarInsumo/<?=$id?>" method="POST">
      
       <label for="NOMBRE_I">Nombre</label>
       <input type="input" name="NOMBRE_I" value="<?=$NOMBRE_I?>" required/><br />
       <label for="PRECIO_C">Precio de compra</label>
       <input type="input" name="PRECIO_C" value="<?=$PRECIO_C?>" required/><br />
       <label for="MARCA">Marca</label>
       <input type="input" name="MARCA" value="<?=$MARCA?>" required/><br />
       <label for="STOCK">Stock</label>
       <input type="input" name="STOCK" value="<?=$STOCK?>" required/><br />
       <br>
       <label> Proveedor </label>
        <select style="display: block;" name="selectProveedores">
        <?php foreach ($proveedor as $f) {?>
    

        <option type="input" value="<?php echo $f["ID_PROVEEDOR"] ?>"><?php echo $f["NOMBRE_P"]?> </option>  
        <?php
        }
        ?>
       <?php foreach ($proveedores as $k => $v): ?>
        <option type="input" value="<?php echo $v["ID_PROVEEDOR"] ?>"><?php echo $v["NOMBRE_P"] ?></option>
        <?php endforeach ?>

</select>
<br>
<label> Sucursal </label>
<select style="display: block;" name="selectSucursales" >
   <?php foreach ($sucursal as $g) {?>
    

        <option type="input" value="<?php echo $g["ID_SUCURSAL"] ?>"><?php echo $g["NOMBRE_S"]?> </option>  
        <?php
        }
        ?>
  <?php foreach ($sucursales as $p => $q): ?>
    <option type="input"  value="<?php echo $q["ID_SUCURSAL"] ?>"><?php echo $q["NOMBRE_S"] ?></option>
  <?php endforeach ?>
</select> 
       
       <input type="submit" name="editar" value="Modificar" />
</form>
 
  </div>

</body>