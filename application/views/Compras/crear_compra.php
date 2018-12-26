<script>        
         var cantidad = 1;   //inicializa variables globales del script usado más adelante
         var insumo = 1;
         var IVA = 1.19;
</script>
    
<body>     
  <div class="container" style="margin-left: 13%">
    <h2>Crear nueva compra</h2>
      <a href="<?php echo base_url();?>index.php/Compras/lista_compras" class="btn btn-default" style="margin-left: 70%">Lista de compras</a>
      <form id="form" name="form" action="<?=base_url()?>index.php/Compras/addCompra" method="POST">
        <label for="N_FACTURA">N° FACTURA</label><br>
        <input type="number" name="N_FACTURA" value="" min="0" max="9999999999" size="30" required/><br />
        <label for="FECHA_INGRESO">FECHA DE INGRESO</label><br>
        <input type="date" name="FECHA_INGRESO" value="<?php echo date("Y-m-d");?>" size="30" required/><br />
        <label>Proveedor</label>
        <select  class="form-control"  id="RUT_PROVEEDOR" name ="RUT_PROVEEDOR" style="width: 40%">
        <?php foreach ($proveedores as $v):?>     
        <option type ="input" name="selectRUT" value="<?php echo $v["RUT_PROVEEDOR"]?> "><?php echo $v["NOMBRE_P"] ?></option>  <br />
        <?php endforeach ?> </select>
        <br>
        <label for="Insumos">Insumos</label>
        <label for="Cantidad" style="margin-left: 26%">Cantidad</label><br>
        <div id="seccionInsumos"></div>
        <label>Subtotal:</label>
        <div id="subtotal"></div>
        <label>Total:</label>
        <div id="total"></div>
        <div id="jsAux"></div>
        <body onload="clickButton()">
        <input type="button" name="editar" id="addItem" value="+ Agregar insumo" class="btn btn-default" style="width:20%" />
        <br>
        <br>
        <label>Finalizar compra</label>
        <br>
        <input type="submit" value="Finalizar compra" class="btn btn-default" "/>
      </form>
 
  </div>

</body>

<script type="text/javascript">
  function clickButton(){
    document.getElementById('addItem').click()
  }
</script>

<script type="text/javascript">
  $("#addItem").on("click", function(event){
    var insumos = <?php echo json_encode($insumos) ?>;
    var tpl = "";
   
    tpl += "<div class=\"row newProduct\" ><div class=\"col s12 m3 l4 \"><select class=\"browser-default select-insumo\"  name=\""+insumo+"\"+x id=\"insumo"+insumo+"\"+x value=\""+insumos.ID_INSUMO+"\">";
    
    for(var i = 0; i < insumos.length; i++){
      
      tpl += "<option id=\"ins"+insumos[i].ID_INSUMO+"\" value=\""+insumos[i].ID_INSUMO+"\" valor=\""+insumos[i].PRECIO_C+"\" data-valor=\""+insumos[i].PRECIO_C+"\">"+insumos[i].NOMBRE_I+"</option>";
    
    }
    
    tpl += "</select></div><div class=\"col s12 m3 l2\"><input type=\"number\" class=\"valor\" min=\"0\"name=\"cantidad"+cantidad+"\" ></div></div>";
    
    cantidad++;
    insumo++;
       
    $("#seccionInsumos").append(tpl);

    script = '<script>var subtotal = 0; var total=0;  $(".valor").on("keyup", function(e){';
    script += 'var largo = ($(".newProduct").length); subtotal = 0;' ;
    script += '$.each($(".newProduct"), function( index, elemento ) {';
    script += 'var id = $(elemento).children("div").children("select").val();';
    script += 'subtotal += parseInt($(elemento).children("div").children(".valor").val())*parseInt($("#ins"+id).data("valor")); total=subtotal*IVA;';
    script += '}); $("#subtotal").html(subtotal); $("#total").html(total); });';
    script += '\n';
    script += '$(".select-insumo").on("change", function(e){';
    script += 'var largo = ($(".newProduct").length); subtotal = 0;' ;
    script += '$.each($(".newProduct"), function( index, elemento ) {';
    script += 'var id = $(elemento).children("div").children("select").val();';
    script += 'subtotal += parseInt($(elemento).children("div").children(".valor").val())*parseInt($("#ins"+id).data("valor")); total=subtotal*IVA;';
    script += '});  $("#subtotal").html(subtotal); $("#total").html(total); });<\/script>';
    
    $("#jsAux").html(script);
    

  });
   

</script>