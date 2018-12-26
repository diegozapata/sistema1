<body>     
  <div class="container" style="margin-left: 13%">
      <h2>Editar UCC</h2>
    
<form id="form" name="form" action="<?=base_url()?>index.php/Ucc/editarUCC/<?=$id?>" method="POST">
            <input type="button" class="btn btn-default" style="margin-left: 70%" value="volver" name="volver" onclick="history.back()" /><br>

       <label for="NOMBRE" >Nombre</label><br />
       <input type="input" name="NOMBRE" value="<?=$NOMBRE?>" required/><br />
       <label for="ANEXO">Anexo</label><br />
       <input type="input" name="ANEXO" value="<?=$ANEXO?>"/><br />
       <label>Tipo de material</label>
            <select class="browser-default select-producto" id="TIPO_MATERIAL" name="TIPO_MATERIAL" style="width:40%">
                <?php if($TIPO_MATERIAL == '0' || $TIPO_MATERIAL = 'null'):?>
                <option type ='input' value="0">Administrativo</option>
                <?php elseif ($TIPO_MATERIAL == '1'):?>
                <option type ='input' value="1">Enseñanza</option>
                <?php endif;?>
                <option  type ="input" value="0">Administrativo</option>
                <option  type ="input" value="1">Enseñanza</option>
               
         </select><br>

       <input type="submit" class="btn btn-default" name="editar" value="Actualizar UCC" />
</form>
 
  </div>

</body>