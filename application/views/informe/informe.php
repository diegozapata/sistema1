<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
 

    <title>Crud Productos</title>  


    <!-- Bootstrap core CSS -->
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">

</head> 
<body>     
           
<?php if(is_array($productos)){?>

         <div class="row">
          <div class="col"><h3> Fecha:<?php echo $fecha['mday'];?>/<?php echo $fecha['mon'];?>/<?php echo $fecha['year'];?></h3></div>
          <div class="col-md-4 col-md-offset-4">
            <form id="query1" method="POST" action=" <?=base_url()?>pdfs/generaI">
                <?php $data= array(
              "productos"=> $productos,
              "fecha"=>$fecha);?>
        <input type="hidden" id="query1" name="query1" value='<?php echo serialize($data);?>'>

        <input type="submit"  class="btn btn-success"  id="query1" value="Crea un informe">

</form>
          </div>

        </div>
 <table class="table table-bordered" width="100%">
  <thead>
    <tr>
      <th scope="col">Nombre</th>
      <th scope="col">Precio Compra</th>
      <th scope="col">Marca</th>
      <th scope="col">Stock</th>
      <th scope="col">Nombre proveedor</th>
  


    </tr>
  </thead>
  <tbody>
   <?php foreach($productos as $item):?>
    <tr>
     
    
      <td ><?php echo $item['NOMBRE_I'];?></td>
      <td ><?php echo $item['PRECIO_C'];?></td>
      <td ><?php echo $item['MARCA'];?></td>
      <td ><?php echo $item['STOCK'];?></td>
      <td ><?php echo $item['NOMBRE'];?></td>


   </tr>   
 <?php endforeach; } ?>
  </tbody>


</table>

  <a href="<?php echo base_url(); ?>/informes" class="btn btn-danger" >Volver</a>

</body>
</html>