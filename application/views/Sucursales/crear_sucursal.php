<body>     
  <div class="container" style="margin-left: 13%">
      <h2>Crear nueva sucursal</h2>

    
<form id="form" name="form" action="<?=base_url()?>index.php/Sucursales/addSucursal" method="POST">
                  <input type="button" class="btn btn-default" style="margin-left: 70%" value="volver" name="volver" onclick="history.back()" /><br>

       <label for="NOMBRE_S">Nombre</label><br />
       <input type="input" name="NOMBRE_S" value="" required /><br />
       <label for="CIUDAD">Ciudad</label><br />
       <input type="input" name="CIUDAD" value="" required/><br />
       <br>

       <input type="submit" class="btn UCM" name="editar" value="Agregar sucursal" />
</form>
 
  </div>

</body>