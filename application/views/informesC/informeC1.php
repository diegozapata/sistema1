<!DOCTYPE html>
<html >

   <body>
    <div class="container">
    <h1>Buscar</h1>

    <form id="buscar" method="GET" action=" <?php echo base_url();?>index.php/informes/comprasM/ ">


        <input type="date" id="query1" name="query1">
        <input type="date" id="query2" name="query2">
        <input type="hidden" id="id_sucursal" name="id_sucursal" value="<?php echo $this->session->userdata('ID_SUCURSAL');?>">
        <input  type="submit"  id="buscar" value="buscar">
 </form>

 

 <br> <br>


             
   <a href="<?php echo base_url(); ?>index.php/informes" class="btn btn-danger" >Volver</a></div>
</body>       
</html>