<body>     
  <div class="container" style="margin-left: 13%">
      <h2>Crear nuevo insumo</h2>

    
<form id="form" name="form" action="<?=base_url()?>index.php/Insumos/addInsumo" method="POST">
      
                            
        <input type="button" class="btn btn-default" style="margin-left: 70%" value="volver" name="volver" onclick="history.back()" />
        <br>              
                        
       <label for="NOMBRE_I">Nombre del insumo</label><br>
       <input type="input" name="NOMBRE_I" style=" width: 40%; padding: 10px 20px; border: 1px solid #ccc; border-radius: 4px;  box-sizing: border-box;"required /><br />
       <label for="PRECIO_C">Precio de compra</label><br>
       <input type="number" name="PRECIO_C" style=" width: 40% ;padding: 10px 20px; border: 1px solid #ccc; border-radius: 4px;  box-sizing: border-box;" required/><br />
       <label for="MARCA">Marca</label><br>
       <input type="input" name="MARCA" style=" width: 40%;padding: 10px 20px; border: 1px solid #ccc; border-radius: 4px;  box-sizing: border-box;" required/><br />
       <label for="STOCK">Stock</label><br>
       <input type="number" name="STOCK" style=" width: 40%;padding: 10px 20px; border: 1px solid #ccc; border-radius: 4px;  box-sizing: border-box;" required/><br />
       <label> Proveedores </label>
       <select style=" width: 40%" name="selectProveedores">
       <?php foreach ($proveedores as $k => $v): ?>
        <option type="input" value="<?php echo $v["RUT_PROVEEDOR"] ?>" required><?php echo $v["NOMBRE_P"] ?></option>
        <?php endforeach ?>

</select>
<br>


       <input type="submit" name="editar" class="btn btn-default" value="Crear insumo" />
</form>
 
  </div>

</body>