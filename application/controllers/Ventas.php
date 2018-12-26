 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ventas extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper("url");
		$this->load->model("Ventas_model");
		$this->load->model("Compras_model");
		$this->load->model("Ordenes_model");
		$this->load->model("Becas_model");
		$this->load->library("session");
		$this->load->database();
	}
	
	public function add(){
		
		$id_s = $this->session->userdata('ID_SUCURSAL');
        $tipo_v = $this->Ventas_model->obtener_tipo_v();
		$productos = $this->Ventas_model->obtener_productos($id_s);
		$data = array(
						"tipo_v" => $tipo_v,
						"productos" => $productos
						);

        $this->load->view('header');
		$this->load->view('menu_lateral');
		$this->load->view("Ventas/crear_venta",$data);
		$this->load->view('footer');
		
	
	}
	public function addVenta(){
		$data = $_POST;
				
				foreach($data as $fila => $valor) {
					$filas[] = $fila;
					$valores[] = $valor;
				}

		$x = count($data)-1;
		$cantidad = 'cantidad';
		$total= 0 ;
				
				for($j=1;$j<=($x-2)/2; $j++){
					$n=$data[$j]; //id_producto
					$m=$data[$cantidad.$j]; //cantidad vendida
					$precio = $this->Ventas_model->total($n);
					$precio2= $precio[0];
					$precio_total = $precio2['PRECIO_V']*$m;
					$total=$total+$precio_total; 
				}

		$item = $this->Ventas_model->add_venta($total);
		if ($item != FALSE) {

		$ultimo_id_venta = $this->db->select('ID_VENTA')->from('VENTA')->where('N_ORDEN', null)->order_by('ID_VENTA',"desc")->limit(1)->get()->row(); 
        $ultimo_id_venta = (array) $ultimo_id_venta;
        $ultimo=$ultimo_id_venta['ID_VENTA'];
				
				for($j=1;$j<=($x-2)/2; $j++){
					$n=$data[$j];
					$m=$data[$cantidad.$j];
					$this->Ventas_model->add_venta_producto($n,$m,$ultimo);
					$insumo_1 = $this->Ventas_model->insumo($n);
					$insumo = $insumo_1[0]['ID_INSUMO'];
					$stock_1 = $this->Ventas_model->stock($insumo);
					$stock = $stock_1[0]['STOCK'];
					$cantidad_total= $stock - $m;
			  		$this->Ventas_model->descontar($insumo, $cantidad_total);
								
				}		
		
		echo "<script>alert('¡Venta realizada!.');</script>";
 		redirect('Ventas/add', 'refresh');
 		}else{
 			echo "<script>alert('¡Número Boleta repetido!.');</script>";
 			redirect('Ventas/add', 'refresh');
 		}

	}

	public function lista_ventas(){
		$data['Ventas'] = $this->Ventas_model->obtener_ventas();
		$this->load->view('header');
		$this->load->view('menu_lateral');
		$this->load->view('Ventas/read_ventas',$data);
		$this->load->view('footer');


	}

	public function detalle_venta($id){
		$this->load->helper('url');
        $id = $this->uri->segment(3);
        $data['Detalle'] = $this->Ventas_model->detalle_venta($id);
        $this->load->view('header');
		$this->load->view('menu_lateral');
		$this->load->view('Ventas/read_venta_detalle',$data);
		$this->load->view('footer');

	}

	public function desactivar(){

		$this->load->helper('url');
        $id = $this->uri->segment(3);
        $items = $this->Ventas_model->insumos_cantidad($id);
        $this->Ventas_model->desactivar($id);
        $x = count($items);
        for($i=0; $i<$x; $i++){
        	$producto = $items[$i]['ID_PRODUCTO'];
        	$N = $this->Ventas_model->obtener_id_insumo($producto);
        	$n = $N[0]['ID_INSUMO'];
        	$m = $items[$i]['CANTIDAD'];
        	$stock_1 = $this->Ventas_model->stock($n);
			$stock = $stock_1[0]['STOCK'];
			$cantidad_total= $stock + $m;
			$this->Compras_model->sumar($n, $cantidad_total);
        }
        redirect('Ventas/lista_ventas', 'refresh');
	}

	public function activar(){

		$this->load->helper('url');
        $id = $this->uri->segment(3);
        $items = $this->Ventas_model->insumos_cantidad($id);
        $this->Ventas_model->activar($id);
        $x = count($items);
        for($i=0; $i<$x; $i++){
        	$producto = $items[$i]['ID_PRODUCTO'];
        	$N = $this->Ventas_model->obtener_id_insumo($producto);
        	$n = $N[0]['ID_INSUMO'];
        	$m = $items[$i]['CANTIDAD'];
        	$stock_1 = $this->Ventas_model->stock($n);
			$stock = $stock_1[0]['STOCK'];
			$cantidad_total= $stock - $m;
			$this->Compras_model->sumar($n, $cantidad_total);
        }
        redirect('Ventas/lista_ventas', 'refresh');
	}

	public function prueba(){
		$data = $_POST;

		foreach($data as $fila => $valor) {
					$filas[] = $fila;
					$valores[] = $valor;
				}
		$y = count($data);
		if($valores[2]== 'Normal'){
			if($y%2 == 0){

				$x = ($y-4)/2;
				$cantidad = 'cantidad';
				$total= 0 ;
				
				for($j=1;$j<=$x; $j++){
					$n=$data[$j]; //id_producto
					$m=$data[$cantidad.$j]; //cantidad vendida
					$precio = $this->Ventas_model->total($n);
					$precio2= $precio[0];
					$precio_total = $precio2['PRECIO_V']*$m;
					$total=$total+$precio_total; 
				}

				$item = $this->Ventas_model->add_venta($total);
				if ($item != FALSE) {

		$ultimo_id_venta = $this->db->select('ID_VENTA')->from('VENTA')->where('N_ORDEN', null)->order_by('ID_VENTA',"desc")->limit(1)->get()->row(); 
        $ultimo_id_venta = (array) $ultimo_id_venta;
        $ultimo=$ultimo_id_venta['ID_VENTA'];
				
				for($j=1;$j<=$x; $j++){
					$n=$data[$j];
					$m=$data[$cantidad.$j];
					$this->Ventas_model->add_venta_producto($n,$m,$ultimo);
					$insumo_1 = $this->Ventas_model->insumo($n);
					$insumo = $insumo_1[0]['ID_INSUMO'];
					$stock_1 = $this->Ventas_model->stock($insumo);
					$stock = $stock_1[0]['STOCK'];
					$cantidad_total= $stock - $m;
			  		$this->Ventas_model->descontar($insumo, $cantidad_total);
								
				}		
		
		echo "<script>alert('¡Venta realizada!.');</script>";
 		redirect('Ventas/add', 'refresh');
 		}else{
 			echo "<script>alert('¡Número Boleta repetido!.');</script>";
 			redirect('Ventas/add', 'refresh');
 		}
			}elseif($y%2 == 1){
				
				$x = ($y-3)/2;
				$cantidad = 'cantidad';
				$total= 0 ;
				
				for($j=1;$j<=$x; $j++){
					$n=$data[$j]; //id_producto
					$m=$data[$cantidad.$j]; //cantidad vendida
					$precio = $this->Ventas_model->total($n);
					$precio2= $precio[0];
					$precio_total = $precio2['PRECIO_V']*$m;
					$total=$total+$precio_total; 
				}

				$item = $this->Ventas_model->add_venta($total);
				if ($item != FALSE) {

		$ultimo_id_venta = $this->db->select('ID_VENTA')->from('VENTA')->where('N_ORDEN', null)->order_by('ID_VENTA',"desc")->limit(1)->get()->row(); 
        $ultimo_id_venta = (array) $ultimo_id_venta;
        $ultimo=$ultimo_id_venta['ID_VENTA'];
				
				for($j=1;$j<=$x; $j++){
					$n=$data[$j];
					$m=$data[$cantidad.$j];
					$this->Ventas_model->add_venta_producto($n,$m,$ultimo);
					$insumo_1 = $this->Ventas_model->insumo($n);
					$insumo = $insumo_1[0]['ID_INSUMO'];
					$stock_1 = $this->Ventas_model->stock($insumo);
					$stock = $stock_1[0]['STOCK'];
					$cantidad_total= $stock - $m;
			  		$this->Ventas_model->descontar($insumo, $cantidad_total);
								
				}		
		
		echo "<script>alert('¡Venta realizada!.');</script>";
 		redirect('Ventas/add', 'refresh');
 		}else{
 			echo "<script>alert('¡Número Boleta repetido!.');</script>";
 			redirect('Ventas/add', 'refresh');
 		}
			}
			
		}elseif ($valores[2] == 'Transbank') {
			$x = ($y-4)/2;
				$cantidad = 'cantidad';
				$total= 0 ;
				
				for($j=1;$j<=$x; $j++){
					$n=$data[$j]; //id_producto
					$m=$data[$cantidad.$j]; //cantidad vendida
					$precio = $this->Ventas_model->total($n);
					$precio2= $precio[0];
					$precio_total = $precio2['PRECIO_V']*$m;
					$total=$total+$precio_total; 
				}

				$item = $this->Ventas_model->add_venta($total);
				if ($item != FALSE) {

		$ultimo_id_venta = $this->db->select('ID_VENTA')->from('VENTA')->where('N_ORDEN', null)->order_by('ID_VENTA',"desc")->limit(1)->get()->row(); 
        $ultimo_id_venta = (array) $ultimo_id_venta;
        $ultimo=$ultimo_id_venta['ID_VENTA'];
				
				for($j=1;$j<=$x; $j++){
					$n=$data[$j];
					$m=$data[$cantidad.$j];
					$this->Ventas_model->add_venta_producto($n,$m,$ultimo);
					$insumo_1 = $this->Ventas_model->insumo($n);
					$insumo = $insumo_1[0]['ID_INSUMO'];
					$stock_1 = $this->Ventas_model->stock($insumo);
					$stock = $stock_1[0]['STOCK'];
					$cantidad_total= $stock - $m;
			  		$this->Ventas_model->descontar($insumo, $cantidad_total);
								
				}		
		
		echo "<script>alert('¡Venta realizada!.');</script>";
 		redirect('Ventas/add', 'refresh');
 		}else{
 			echo "<script>alert('¡Número Boleta repetido!.');</script>";
 			redirect('Ventas/add', 'refresh');
 		}

		}elseif ($valores[2] == 'Beca') {
			$data = count($_POST);
			$producto = $this->input->post('producto1', true);
			if($data == 6 && $producto == 'Fotocopia normal'){
      		$item = $this->Becas_model->add_beca();
      		if($item != null){
      			$CANTIDAD= $this->input->post('cantidad1', true);
				$stock_1 = $this->Ventas_model->stock(173);
				$stock = $stock_1[0]['STOCK'];
				$cantidad_total= $stock - $CANTIDAD;
				$this->Ordenes_model->descontar(173, $cantidad_total);
				echo "<script>alert('¡Beca ingresada!.');</script>";
 				redirect('Becas/add', 'refresh');
			}else{
			echo "<script>alert('¡Sesión expirada!.');</script>";
 			redirect('Usuarios/iniciar_sesion', 'refresh');
			}
      		}else{
      			echo "<script>alert('Productos elegidos no corresponden');</script>";
      	 		redirect('Ventas/add', 'refresh');
      		}
		}
		
	}
	
	
}