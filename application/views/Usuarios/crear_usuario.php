     
   <div class="container" style="margin-left: 13%" >
      <h2>Crear usuario</h2>

      <form id="form" name="form" action="<?=base_url()?>index.php/Usuarios/addUsuario" method="POST">
<input type="button" class="btn btn-default" style="margin-left: 70%" value="volver" name="volver" onclick="history.back()" /><br>
      <label for="RUT">Rut</label><br />
       <input type="input" name="RUT" /><br />

       <label for="NOMBRE">Nombre</label><br />
       <input type="input" name="NOMBRE" /><br />

       <label for="APELLIDOS">Apellidos</label><br />
       <input type="input" name="APELLIDOS" /><br />

       <label for="CARGO">Cargo</label><br />
       <input type="input" name="CARGO" /><br />
       
       <label for="CLAVE">Clave</label><br />
       <input type="password" name="CLAVE" /><br />


       <label>Perfil</label>
        <select  id="ID_PERFIL" name ="ID_PERFIL">
        <option value="24">Vendedor</option>
        <option value="25">Administrador</option>
        <option value="26">Superadministrador</option>  
      </select>
<br />
        <input type="submit" class="bnt UCM" name="submit" value="Agregar usuario" />

  </div>

