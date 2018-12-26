   <!doctype html>
<html lang="en">
<div class="container">   
<?php if(is_array($resultados)){?>

         <div class="row">
            <div class="col"><h6> Cantidad de ventas realizadas:<?php echo count($resultados);?></h6></div>
          <div class="col"><center><h6>Desde: <?php echo date("d-m-Y ", strtotime($query1));?>  Hasta:<?php echo date("d-m-Y ", strtotime($query2));?></h6></center></div>
          <div class="col-md-4 col-md-offset-4">
            <form id="query1" method="POST" action=" <?=base_url();?>index.php/pdfs/generaC">
                <?php $data= array("resultados"=> $resultados,
              "ucc"=> $ucc,
              "query1"=> $query1,"query2"=> $query2);?>
        <input type="hidden" id="query1" name="query1" value='<?php echo serialize($data);?>'>

        <input type="submit"  id="query1" value="Crea un informe">

</form>
          </div>

        </div>

           <table class="table table-bordered" width="100%">
  <thead>
    <tr>
     
      <th scope="col">Compra</th>
      <th scope="col">Usuario</th>
      <th scope="col">Factura</th>
      <th scope="col">Fecha ingreso</th>
      <th scope="col">Ucc</th>
     <th scope="col">Subtotal</th>
     <th scope="col">Iva</th>
     <th scope="col">Total</th>


    </tr>
  </thead>
  <tbody>
   
<?php if(is_array($ucc)){?>
  <?php foreach($resultados as $item):?>
    <tr>
     
    
      <td ><?php echo $item['ID_COMPRA'];?></td>
      <td ><?php echo $item['ID_USUARIO'];?></td>
      <td ><?php echo $item['N_FACTURA'];?></td>
      <td ><?php echo $item['FECHA_INGRESO'];?></td>

      <?php foreach($ucc as $uc):?>
      <?php if($item['ID_UCC'] === $uc['ID_UCC']){?>

      <td ><?php echo $uc['NOMBRE'];?></td>
      <?php} else{?> 

        <?php }?> 

        <?php endforeach;?> 
      <td ><?php echo $item['SUBTOTAL']?></td>
      <td ><?php echo $item['IVA']?></td>
      <td ><?php echo $item['TOTAL']?></td>

    </tr>  


 <?php endforeach;}?> 
<?php }?>
 <?php if(is_array($resultados)){?>
  <h3> Total :<?php echo  array_sum(array_column($resultados, 'TOTAL'));?></h3>


<?php }?>


  </tbody>
</table>
  
</div>   
</html>