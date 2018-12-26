<!DOCTYPE html>
<html >


   <body>
    <div class="container">
    <h1>Buscar</h1>

    <form id="buscar" method="GET" action=" <?php echo base_url();?>index.php/informes/ventas">


        <input type="date" id="query" name="query">
        <input type="date" id="query1" name="query1">
        <input type="submit"  id="buscar" value="buscar">
 </form>

 

 <br> <br>


     
<a href="<?php echo base_url(); ?>index.php/informes" class="btn btn-danger" >Volver</a></div>
</body>       
</html>