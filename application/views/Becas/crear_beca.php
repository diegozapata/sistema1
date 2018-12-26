
<body>     
  <div class="container" style="margin-left: 13%">
    <h2>Ingreso de becas</h2>
      <a href="<?php echo base_url();?>index.php/Becas/lista_becas" class="btn btn-default" style="margin-left: 70%">Lista de becas</a>
      <form id="form" name="form" action="<?=base_url()?>index.php/Becas/addBeca" method="POST">
        <label for="N_BECA">N° BECA</label><br>
        <input type="number" name="N_BECA" value="" min="0" max="9999999999" size="30" required/><br />
        <label for="FECHA_INGRESO">FECHA DE INGRESO</label><br>
        <input type="date" name="FECHA_INGRESO" value="<?php echo date("Y-m-d");?>" size="30" required/><br />
        <label for="Insumos">Cantidad</label><br>
        <input type="number" name="CANTIDAD" size="30" required/><br />
        <input type="submit" value="Ingresar beca" class="btn UCM" "/>
      </form>
 
  </div>

</body>

