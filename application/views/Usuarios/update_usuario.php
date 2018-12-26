     
   <div class="container" style="margin-left: 13%" >
      <h2>Crear usuario</h2>

      <form id="form" name="form" action="<?=base_url()?>index.php/Usuarios/editUsuario" method="POST">
<input type="button" class="btn btn-default" style="margin-left: 70%" value="volver" name="volver" onclick="history.back()" /><br>
      <label for="RUT">Rut: <?=$RUT?></label><br />
       

       <label for="NOMBRE">Nombre</label><br />
       <input type="input" name="NOMBRE" value="<?=$NOMBRE?>" /><br />

       <label for="APELLIDOS">Apellidos</label><br />
       <input type="input" name="APELLIDOS" value="<?=$APELLIDOS?>"/><br />

       <label for="CARGO">Cargo</label><br />
       <input type="input" name="CARGO" value="<?=$CARGO?>"/><br />
       
       <label for="CLAVE">Clave</label><br />
       <input type="password" name="CLAVE" value="<?=$CLAVE?>"/><br />


       <label>Perfil</label>
        <select  id="ID_PERFIL" name ="ID_PERFIL">
          <?php if($ID_PERFIL == '24' || $ID_PERFIL = 'null'):?>
                <option type ='input' value="24">Vendedor</option>
                <?php elseif ($ID_PERFIL == '25'):?>
                <option type ='input' value="25">Administrador</option>
                <?php elseif ($ID_PERFIL == '26'):?>
                <option type ='input' value="26">Super Administrador</option>
                <?php endif;?>
        <option value="24">Vendedor</option>
        <option value="25">Administrador</option>
        <option value="26">Superadministrador</option>  
      </select>
<br />
        <input type="submit" class="bnt UCM" name="submit" value="Agregar usuario" />

  </div>

