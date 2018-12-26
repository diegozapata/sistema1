  <div class="container" style="margin-left: 13%">
      <h2>Editar producto</h2>

    
<form id="form" name="form" action="<?=base_url()?>index.php/Productos/editarProducto/<?=$id?>" method="POST">
      <input type="button" class="btn btn-default" style="margin-left: 70%" value="volver" name="volver" onclick="history.back()" /><br>
       <label for="NOMBRE">Nombre</label><br />
       <input type="input" name="NOMBRE" value="<?=$NOMBRE?>" required /><br />
       <label for="PRECIO_V">Precio de venta</label><br />
       <input type="input" name="PRECIO_V" value="<?=$PRECIO_V?>" required/><br />
       <label>Insumo</label>
        <select  class="form-control"  id="selectInsumo" name ="selectInsumo" style="width:40%">
          <option type ="input" name="selectInsumo" value="<?=$ID_INSUMO?>" ><?=$NOMBRE_I?></option>
       <?php foreach ($Insumos as $v):?>     
        <option type ="input" name="selectInsumo" value="<?php echo $v["ID_INSUMO"]?> "><?php echo $v["NOMBRE_I"] ?></option>  <br />
        <?php endforeach ?> </select>
        <br>
       <label>Estado</label>
            <select class="form-control" id="selectEstado"name="selectEstado" style="width:40%">
                <option  type ="input" value="<?=$ESTADO?>"><?=$ESTADO?></option>
                <option  type ="input" value="Activo">Activo</option>
                <option  type ="input" value="Inactivo">Inactivo</option>
               
         </select><br>
       
       <input type="submit" class="btn btn-default" name="editar" value="Actualizar Producto" />
</form>
 
  </div>

</body>

