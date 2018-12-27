<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class informes_controller extends CI_Controller {

	function _construct(){
		parent::_construct();
		$this->load->helper('url','form');
		$this->load->model('compras_model');
    $this->load->model('ventas_model');


	}

	public function index()
	{   
        //$this->session->sess_destroy();
		$this->load->view('header');
		$this->load->view('view_inicio');
		//$this->load->view('crear_ucc');
		$this->load->view('menu_lateral');
		$this->load->view('footer');	
	}

	

	public function informesCompras()
	{   

		$this->load->model('compras_model');
    $this->load->view('header');
    $this->load->view('informesC/view_informescompras');
    $this->load->view('menu_lateral');
    $this->load->view('footer');
		//$data['compras'] = $this->compras_model->obtener_todos();
		
		
	}

  

     public function informesCompras2()
  {   
       $resultados=null;
    $this->load->model('compras_model');
    $data= array();
      $query1=$this->input->get('query1',TRUE);
      $query2=$this->input->get('query2',TRUE);
      $id_sucursal=$this->input->get('id_sucursal',TRUE);
      $this->load->view('header');
    $this->load->view('informesC/informeC1',$data);
    $this->load->view('menu_lateral');
    $this->load->view('footer');
        
      if ($query1!=null) {
       $resultados=$this->compras_model->buscarrango($query1,$query2,$id_sucursal);
      if ($resultados != FALSE) {
            $ucc = $this->compras_model->obtener_ucc();
            $data= array("resultados"=> $resultados,
                           "ucc"  =>  $ucc,
              "query1"=> $query1,"query2"=> $query2);
        return   $this->load->view('informesC/informeResultadoC',$data);
       }else{
        echo "<script> alert('No hay registros');</script>";
         redirect('informes', 'refresh'); 
       }
          
   
    }
  }


   public function informesVentas()
  {   

      $transbank=null;
       $resultados=null;
    $this->load->model('ventas_model');
    $data= array();
      $query=$this->input->get('query',TRUE);
      $query1=$this->input->get('query1',TRUE);
      $id_sucursal=$this->input->get('id_sucursal',TRUE);
      $this->load->view('header');
     $this->load->view('informesV/informeV',$data);
     $this->load->view('menu_lateral');
     $this->load->view('footer');

        
      if ($query1) {
       $resultados=$this->ventas_model->buscar($query,$query1,$id_sucursal);
      if ($resultados != FALSE) {
            foreach ($resultados as $valor) {

              $valor['TIPO_VENTA']===0;
              $transbank =$resultados;

            }
                  //var_dump($transbank);


        $ucc=$this->ventas_model->obtener_ucc();
        $tipos_ventas=$this->ventas_model->obtener_tipo_venta();
       // $productos = $this->ventas_model->obtener_itemventa();
        $productos1 = $this->ventas_model->obtener_todosproductos();
            $data= array("resultados"=> $resultados,
              "ucc"=> $ucc,"tipos_ventas"=> $tipos_ventas,
              "query"=> $query,"query1"=> $query1,"productos1"=> $productos1,"transbank"=> $transbank  );

       }else{
      echo "<script> alert('No hay registros');</script>";
      redirect('informes', 'refresh'); 
       }
          
//var_dump($resultados);
      
      return   $this->load->view('informesV/informeResultadoS',$data);
      
      //
   
    
    }
  }
    

     public function informesVentas2()
  {   
       $resultados=null;
    $this->load->model('ventas_model');
    $data= array();
      $query1=$this->input->get('query1',TRUE);
      $query2=$this->input->get('query2',TRUE);
      $id_sucursal=$this->input->get('id_sucursal',TRUE);
      $this->load->view('header');
     $this->load->view('informesV/informeV1',$data);
     $this->load->view('menu_lateral');
     $this->load->view('footer');
        
      if ($query1) {
       $resultados=$this->ventas_model->buscarrango($query1,$query2,$id_sucursal);
      if ($resultados != FALSE) {
        $ucc=$this->ventas_model->obtener_ucc();
        $tipos_ventas=$this->ventas_model->obtener_tipo_venta();
            $data= array("resultados"=> $resultados,
              "ucc"=> $ucc,"tipos_ventas"=> $tipos_ventas,
              "query1"=> $query1,"query2"=> $query2);
       }else{
      echo "<script> alert('No hay registros');</script>";
      redirect('informes', 'refresh'); 
       }
          
//var_dump($resultados);
        
  
      return   $this->load->view('informesV/informeResultadoV',$data);
      //
   
    
    }
  }

 
    public function generar() {

        $this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Diego Zapata');
        $pdf->SetTitle('Informe');
        $pdf->SetSubject('Informe');
        $pdf->SetKeywords('guide');
 
// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config_alt.php de libraries/config
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE , PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
        $pdf->setFooterData($tc = array(0, 64, 0), $lc = array(0, 64, 128));
 
// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
 
// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
 
// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
 
// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
 
//relación utilizada para ajustar la conversión de los píxeles
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
 
 
// ---------------------------------------------------------
// establecer el modo de fuente por defecto
        $pdf->setFontSubsetting(true);
 
// Establecer el tipo de letra
 
//Si tienes que imprimir carácteres ASCII estándar, puede utilizar las fuentes básicas como
// Helvetica para reducir el tamaño del archivo.
        $pdf->SetFont('freemono', '', 10, '', true);
 
// Añadir una página
// Este método tiene varias opciones, consulta la documentación para más información.
        
 $pdf->AddPage();
//fijar efecto de sombra en el texto
        $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));
 
// Establecemos el contenido para imprimir
        $data = unserialize(stripslashes($this->input->post('query1')));

        //$productos=$data['productos'];
        $resultados=$data['resultados'];
        $query=$data['query'];
        $query1=$data['query1'];
        $ucc=$data['ucc'];
        $tipos_ventas=$data['tipos_ventas'];
        
        //var_dump($resultados);
        //

       //
        //preparamos y maquetamos el contenido a crear
        $html = '';
        $html.= "<style type=text/css>";
        $html.= "th";
        $html.= "td";
        $html.="table,td {
                  border: 1px solid black;
                   }";
       $html.="table,th {
                  border: 1px solid black;
                   }";
        $html.= "</style>";
        $html.= "<h4>Cantidad de ventas realizadas: ".count($resultados)."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Desde&nbsp;" . date("d-m-Y ", strtotime($query))."&nbsp;&nbsp;&nbsp;Hasta&nbsp;". date("d-m-Y ", strtotime($query1))."</h4>";
        $html.= "<br>";
        $html.= "<br>";
        $html.= "<br>";
        $html.= "<br>";
        $html.= "<table width='100%'>";
        $html.= "<h3>Venta normal</h3>";
        $html.= "<tr><th>Numero boleta</th><th>Fecha de venta</th><th>Total</th></tr>";
         $sumando=null;
           $iva=null; 
           $SubTotal=null; 
        foreach ($resultados as $fila) {
              if ($fila['TIPO_VENTA']==='0') {

             $id = $fila['N_BOLETA'];


            $localidad =date("d-m-Y ", strtotime($fila['FECHA_INGRESO']));


                 
           

            //var_dump($enseñanza);
              $total =$fila['TOTAL'];
              
        $SubTotal += $fila['TOTAL'];
 
            $html.= "<tr><td class='Numero boleta'>".$id."</td><td class='Detalle'>".$localidad."</td><td class='Valor Neto'>".$total."</td></tr>";
      } }

           $iva=$SubTotal*0.19;
          $sumando=$SubTotal+$iva;
           $html.= "</table>";
           
           $html.= "<h4>SubTotal &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$SubTotal."</h4>";
          $html.= "<h4>Iva &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$iva."</h4>";
          $html.= "<h4>Total general&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$sumando."</h4>";
            
  
         //$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);



          $html.= "<table width='100%'>";
          $html.= "<h3>Venta transbank</h3>";
        $html.= "<tr><th>Numero boleta</th><th>Fecha de venta</th><th>Total</th></tr>";
          $sumando1=null;
           $iva1=null; 
           $SubTotal1=null; 
        foreach ($resultados as $fila) {
              if ($fila['TIPO_VENTA']!='0') {

             $id = $fila['N_BOLETA'];


            $localidad =date("d-m-Y ", strtotime($fila['FECHA_INGRESO']));


                 
           

            //var_dump($enseñanza);
              $total =$fila['TOTAL'];
              
        $SubTotal1 += $fila['TOTAL'];
 
            $html.= "<tr><td class='Numero boleta'>".$id."</td><td class='Detalle'>".$localidad."</td><td class='Valor Neto'>".$total."</td></tr>";
      } }

           $iva1=$SubTotal1*0.19;
          $sumando1=$SubTotal1+$iva1;
        $html.= "</table>";
         $html.= "<h4>SubTotal &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$SubTotal1."</h4>";
          $html.= "<h4>Iva &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$iva1."</h4>";
           $html.= "<h4>Total general&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$sumando1."</h4>";
           $html.= "<h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;____________________<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Firma Responsable</h4>";
        $pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
// ---------------------------------------------------------
// Cerrar el documento PDF y preparamos la salida
// Este método tiene varias opciones, consulte la documentación para más información.
        $nombre_archivo = utf8_decode("informe.pdf");
        $pdf->Output($nombre_archivo, 'D');
        return $pdf;
        
    
  }

   public function genera() {

     
        $this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Diego Zapata');
        $pdf->SetTitle('Informe');
        $pdf->SetSubject('Informe');
        $pdf->SetKeywords('guide');
 
// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config_alt.php de libraries/config
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE , PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
        $pdf->setFooterData($tc = array(0, 64, 0), $lc = array(0, 64, 128));
 
// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
 
// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
 
// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
 
// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
 
//relación utilizada para ajustar la conversión de los píxeles
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
 
 
// ---------------------------------------------------------
// establecer el modo de fuente por defecto
        $pdf->setFontSubsetting(true);
 
// Establecer el tipo de letra
 $pdf->SetFont('helvetica', 'B', 7);

//Si tienes que imprimir carácteres ASCII estándar, puede utilizar las fuentes básicas como
// Helvetica para reducir el tamaño del archivo.
        $pdf->SetFont('freemono', '', 9, '', true);
 
// Añadir una página
// Este método tiene varias opciones, consulta la documentación para más información.
        
 $pdf->AddPage();
//fijar efecto de sombra en el texto
        $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));
 
// Establecemos el contenido para imprimir
        $data = unserialize(stripslashes($this->input->post('query1')));

        $resultados=$data['resultados'];
        $query1=$data['query1'];
        $query2=$data['query2'];
        $ucc=$data['ucc'];
        $tipos_ventas=$data['tipos_ventas'];
        
        //var_dump($resultados);
        //

       //
        //preparamos y maquetamos el contenido a crear
        $html = '';
        $html.= "<style type=text/css>";
        $html.= "th";
        $html.= "td";
        $html.="table,td {
                  border: 1px solid black;
                   }";
       $html.="table,th {
                  border: 1px solid black;
                   }";
        $html.= "</style>";
        $html.= "<h4>Cantidad de ventas realizadas: ".count($resultados)."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Desde&nbsp;" . date("d-m-Y ", strtotime($query1))."&nbsp;&nbsp;&nbsp;Hasta&nbsp;". date("d-m-Y ", strtotime($query2))."</h4>";
        $html.= "<table width='100%'>";
        $html.= "<tr><th>Descripcion unidad</th><th>Codigo</th><th>Administrativo</th><th>Enseñanza</th><th>Total</th></tr>";
          $enseñanza1=0;
          $enseñanza=0;
        foreach ($resultados as $fila) {
            foreach($ucc as $item2){
              if ($fila['ID_UCC']===$item2['ID_UCC'] )  

             $id = $item2['NOMBRE'];}


            $localidad = $fila['ID_UCC'];


            foreach($tipos_ventas as $item1){
             if ($fila['ID_TIPO_VENTA']===$item1['ID_TIPO_VENTA'] && $item1['NOMBRE']==='ENSENANZA') {
                $enseñanza =$fila['TOTAL']; 
                  }
           elseif($fila['ID_TIPO_VENTA']===$item1['ID_TIPO_VENTA'] && $item1['NOMBRE']==='ADMINISTRATIVO'){
                $enseñanza1 =$fila['TOTAL'];}

              }//var_dump($enseñanza);
              $total =$fila['TOTAL'];
              
              if ($enseñanza!=$total ){
                    $enseñanza=0;
               }
               if ($enseñanza1!=$total ){
                    $enseñanza1=0;
               }
            
 
            $html.= "<tr><td class='Descripcion unidad'>".$id."</td><td class='Codigo'>".$localidad."</td><td class='Administrativo'>".$enseñanza1."</td><td class='Enseñanza'>".$enseñanza."</td><td class='total'>".$total."</td></tr>";
       }
        $html.= "</table>";


       $sumando=0;

         $sumando1=0;
          if(is_array($resultados) && is_array($tipos_ventas)) {
         foreach($resultados as $item)
         foreach($tipos_ventas as $item1)
    if ($item['ID_TIPO_VENTA']===$item1['ID_TIPO_VENTA'] && $item1['NOMBRE']==='ADMINISTRATIVO') {
            $sumando1 += $item['TOTAL'];
         }}
         
           
             if(is_array($resultados) && is_array($tipos_ventas)) {
         foreach($resultados as $item)
               foreach($tipos_ventas as $item1)
     if ($item['ID_TIPO_VENTA']===$item1['ID_TIPO_VENTA'] && $item1['NOMBRE']==='ENSENANZA'){ 
               $sumando += $item['TOTAL'];}}
           $html.= "<br>";
           $html.= "<br>";
           $html.= "<br>";
           $html.= "<br>";
          $html.= "<h4>Total general&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".($sumando1)."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".($sumando)."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".array_sum(array_column($resultados, 'TOTAL'))."</h4>";

  
         $pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
        
// ---------------------------------------------------------
// Cerrar el documento PDF y preparamos la salida
// Este método tiene varias opciones, consulte la documentación para más información.
        $nombre_archivo = utf8_decode("informe.pdf");
        $pdf->Output($nombre_archivo, 'D');
        return $pdf;
        
    
  }

  public function generarC() {

        $this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Diego Zapata');
        $pdf->SetTitle('Informe');
        $pdf->SetSubject('Informe');
        $pdf->SetKeywords('guide');
 
// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config_alt.php de libraries/config
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE , PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
        $pdf->setFooterData($tc = array(0, 64, 0), $lc = array(0, 64, 128));
 
// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
 
// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
 
// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
 
// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
 
//relación utilizada para ajustar la conversión de los píxeles
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
 
 
// ---------------------------------------------------------
// establecer el modo de fuente por defecto
        $pdf->setFontSubsetting(true);
 
// Establecer el tipo de letra
 
//Si tienes que imprimir carácteres ASCII estándar, puede utilizar las fuentes básicas como
// Helvetica para reducir el tamaño del archivo.
        $pdf->SetFont('freemono', '', 10, '', true);
 
// Añadir una página
// Este método tiene varias opciones, consulta la documentación para más información.
        
 $pdf->AddPage();
//fijar efecto de sombra en el texto
        $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));
 
// Establecemos el contenido para imprimir
        $data = unserialize(stripslashes($this->input->post('query1')));

      
        $resultados=$data['resultados'];
        $query1=$data['query1'];
        $query2=$data['query2'];
        $ucc=$data['ucc'];
  
        
        //var_dump($resultados);
        //

       //
        //preparamos y maquetamos el contenido a crear
        $html = '';
        $html.= "<style type=text/css>";
        $html.= "th";
        $html.= "td";
        $html.="table,td {
                  border: 1px solid black;
                   }";
       $html.="table,th {
                  border: 1px solid black;
                   }";
        $html.= "</style>";
        $html.= "<h4>Cantidad de ventas realizadas: ".count($resultados)."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Desde&nbsp;" . date("d-m-Y ", strtotime($query1))."&nbsp;&nbsp;&nbsp;Hasta&nbsp;". date("d-m-Y ", strtotime($query2))."</h4>";
        $html.= "<table width='100%'>";
        $html.= "<tr><th>Numero compra</th><th>Factura</th><th>Subtotal</th><th>IVA</th><th>Total</th></tr>";
          $enseñanza1=0;
          $enseñanza=0;
        foreach ($resultados as $fila) {
           

             $id = $fila['ID_COMPRA'];


            $localidad = $fila['N_FACTURA'];

                $item=$fila['SUBTOTAL'];
               $item1=$fila['IVA'];
        
           

            //var_dump($enseñanza);
              $total =$fila['TOTAL'];
              
        
 
            $html.= "<tr><td class='Numero boleta'>".$id."</td><td class='Detalle'>".$localidad."</td><td class='Detalle'>".$item."</td><td class='Detalle'>".$item1."</td><td class='Valor Neto'>".$total."</td></tr>";
       }
        $html.= "</table>";
           
           
  
          $html.= "<h4>Total general&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".array_sum(array_column($resultados, 'TOTAL'))."</h4>";
            
  
         $pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
        
// ---------------------------------------------------------
// Cerrar el documento PDF y preparamos la salida
// Este método tiene varias opciones, consulte la documentación para más información.
        $nombre_archivo = utf8_decode("informe.pdf");
        $pdf->Output($nombre_archivo, 'D');
        return $pdf;
        
    
  }



}

        