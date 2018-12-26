<!doctype html>
<html lang="en">
<div class="container">    
<?php if(is_array($resultados)){?>



          <div class="row">
            <div class="col"><h3> Cantidad de ventas realizadas:<?php echo count($resultados);?></h3></div>
          <div class="col"><center><h6>Desde: <?php echo date("d-m-Y ", strtotime($query1));?>  Hasta:<?php echo date("d-m-Y ", strtotime($query2));?></h6></center></div>
          <div class="col-md-4 col-md-offset-4">
            <form id="query1" method="POST" action=" <?=base_url();?>index.php/pdfs/genera">
                <?php $data= array("resultados"=> $resultados,
              "ucc"=> $ucc,"tipos_ventas"=> $tipos_ventas,
              "query1"=> $query1,"query2"=> $query2);?>
        <input type="hidden" id="query1" name="query1" value='<?php echo serialize($data);?>'>

        <input type="submit"  id="query1" value="Crea un informe">

</form>
          </div>

        </div>

<div class="col">
  <div class="row">
     <table class="table table-bordered" width="90%">
     <thead>
    <tr>
     
      <th scope="col">Descripcion Unidad</th>
      <th scope="col">Codigo</th>
      <th scope="col">Administrativo</th>
      <th scope="col">Enseñanza</th>
      <th scope="col">Total</th>


    </tr>
  </thead>
  <tbody>
   

  <?php foreach($resultados as $item):?>
    <tr>
     
    <?php foreach($ucc as $item2):?>
      <?php if ($item['ID_UCC']===$item2['ID_UCC'] ) {?>
      <td ><?php echo $item2['NOMBRE'];?></td>

        <?php }endforeach;?> 

      <td ><?php echo $item['ID_UCC'];?></td>
      <?php foreach($tipos_ventas as $item1):?>
      <?php if ($item['ID_TIPO_VENTA']===$item1['ID_TIPO_VENTA'] && $item1['NOMBRE']==='ENSENANZA') {?>
          <td></td>
         <td><?php echo $item['TOTAL'];?></td>
     <?php } elseif ($item['ID_TIPO_VENTA']===$item1['ID_TIPO_VENTA'] && $item1['NOMBRE']==='ADMINISTRATIVO') {?>
            <td ><?php echo $item['TOTAL']?></td>
            <td ></td>



       <?php } endforeach;?> 
      <td ><?php echo $item['TOTAL']?></td>
    </tr>  


 <?php endforeach;}?> 
</tbody>
</table>
</div>
<div class="row" >
  
<div class="col"><h6>Total general</h6></div>
<div class="col">     </div>
<div class="col">



                         </div>
<div class="col">     </div>
<div class="col">     </div>
<div class="col">  <?php $sumando=0;?>
             <?php if(is_array($resultados) && is_array($tipos_ventas)) { ?>
            <?php foreach($resultados as $item):?>
              <?php foreach($tipos_ventas as $item1):?>
   <?php if ($item['ID_TIPO_VENTA']===$item1['ID_TIPO_VENTA'] && $item1['NOMBRE']==='ADMINISTRATIVO') {?>
               
              <?php $sumando += $item['TOTAL'];?>
         
         
         <?php } endforeach;?>      
             <?php  endforeach;}?>   
                      <h6> <?php echo  $sumando;?> </h6>    </div>




<div class="col"> <?php $sumando=0;?>
             <?php if(is_array($resultados) && is_array($tipos_ventas)) { ?>
            <?php foreach($resultados as $item):?>
              <?php foreach($tipos_ventas as $item1):?>
   <?php if ($item['ID_TIPO_VENTA']===$item1['ID_TIPO_VENTA'] && $item1['NOMBRE']==='ENSENANZA') {?>
               
              <?php $sumando += $item['TOTAL'];?>
         
         
         <?php } endforeach;?>      
             <?php  endforeach;}?>   
                      <h6> <?php echo  $sumando;?> </h6>     </div>
<div class="col">   <?php if(is_array($resultados)){?>
<h6><?php echo  array_sum(array_column($resultados, 'TOTAL'));?></h6>  </div>







</div>
</div>

<div >
  



</div>
<?php }?>

  </tbody></div>  
  </html>















  