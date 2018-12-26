<script>        
         var cantidad = 1;   //inicializa variables globales del script usado más adelante
         var producto = 1;
</script>
     
<body>     
  <div class="container" style="margin-left: 13%">
    <h2>Crear nueva venta</h2>
      <a href="<?php echo base_url();?>index.php/Ventas/lista_ventas" class="btn btn-default" style="margin-left: 72%">Lista de ventas</a>
      <form id="form" name="form" action="<?=base_url()?>index.php/Ventas/prueba" method="POST">
        <label for="N_BOLETA">N° BOLETA</label><br>
        <input type="number" name="N_BOLETA" value="" min="0" max="9999999999" style="width: 71%" required/><br />
        <label for="FECHA_INGRESO">FECHA DE INGRESO</label><br>
        <input type="date" name="FECHA_INGRESO" value="<?php echo date("Y-m-d");?>" style="width: 71%" required/><br />
        <br>
        <label>Tipo de venta</label>
            <select name="select"  id="select" style="width: 71%" 
          onchange="if(this.options[this.selectedIndex].value=='Transbank'){
              toggleField(this,this.nextSibling);
              
          }if(this.options[this.selectedIndex].value=='Beca'){toggleField(this,this.nextSibling);
              
          }" >
            <option value="Normal">Normal</option>
            <option value="Transbank">Transbank</option>
            <option value="Beca">Beca</option>
            
        </select><input name="browser" style="display:none;" disabled="disabled" 
            onblur="if(this.value==''){toggleField(this,this.previousSibling);}">
            


<br>
        <label for="Productos">Productos</label>
        <label for="Cantidad" style="margin-left: 26%">Cantidad</label>
        <br>
        <div id="seccionProductos"></div>
        <label>Total:</label>
        <div id="total"></div>
        <div id="jsAux"></div>
        <body onload="clickButton()">
        <input type="button" name="editar" id="addItem" value="+ Agregar producto" class="btn btn-default" style="width: 20%" />
        <br>
        <br>
        <label>Finalizar venta</label>
        <br>
        <input type="submit" value="Finalizar venta" class="btn btn-default" style="width: 40%; display: block;"/>
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
    var productos = <?php echo json_encode($productos) ?>;
    var tpl = "";
   
    tpl += "<div class=\"row newProduct\" ><div class=\"col s12 m3 l4 \"><select class=\"browser-default select-producto\"  name=\""+producto+"\"+x id=\"producto\"+x value=\""+productos.ID_PRODUCTO+"\">";
    
    for(var i = 0; i < productos.length; i++){
      
      tpl += "<option id=\"prod"+productos[i].ID_PRODUCTO+"\" value=\""+productos[i].ID_PRODUCTO+"\" valor=\""+productos[i].PRECIO_V+"\" data-valor=\""+productos[i].PRECIO_V+"\">"+productos[i].NOMBRE+" &nbsp;&nbsp;&nbsp;&nbsp;   Precio: $"+productos[i].PRECIO_V+"</option>";
    
    }
    
    tpl += "</select></div><div class=\"col s12 m3 l4 \"><input type=\"number\" class=\"valor\" min=\"0\"name=\"cantidad"+cantidad+"\"></div></div>";
    
    cantidad++;
    producto++;
   
    $("#seccionProductos").append(tpl);

    script = '<script>var total = 0; $(".valor").on("keyup", function(e){';
    script += 'var largo = ($(".newProduct").length); total = 0;' ;
    script += '$.each($(".newProduct"), function( index, elemento ) {';
    script += 'var id = $(elemento).children("div").children("select").val();';
    script += 'total += parseInt($(elemento).children("div").children(".valor").val())*parseInt($("#prod"+id).data("valor"));';
    script += '}); $("#total").html(total); });';
    script += '\n';
    script += '$(".select-producto").on("change", function(e){';
    script += 'var largo = ($(".newProduct").length); total = 0;' ;
    script += '$.each($(".newProduct"), function( index, elemento ) {';
    script += 'var id = $(elemento).children("div").children("select").val();';
    script += 'total += parseInt($(elemento).children("div").children(".valor").val())*parseInt($("#prod"+id).data("valor"));';
    script += '}); $("#total").html(total); })<\/script>';
    
    $("#jsAux").html(script);
    

  });
   

</script>
<script>

function toggleField(hideObj,showObj){
  hideObj.disabled=false;        
  hideObj.style.display='inline';
  showObj.disabled=false;   
  showObj.style.display='inline';
  showObj.focus();
}
</script>