 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Compras extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper("url");
		$this->load->model("Ordenes_model");
		$this->load->model("Ventas_model");
		$this->load->model("Ucc_model");
		$this->load->model("Compras_model");
		$this->load->model("Insumos_model");
		$this->load->model("Proveedores_model");
		$this->load->library("session");
		$this->load->database();
	}
	
	public function add(){
		$id_s = $this->session->userdata('ID_SUCURSAL');
        $insumos = $this->Insumos_model->obtener_todos($id_s);
        $proveedores = $this->Proveedores_model->obtener_todos();
        $data = array(
						"insumos" => $insumos,
						"proveedores" => $proveedores
						);

        $this->load->view('header');
		$this->load->view('menu_lateral');
		$this->load->view('Compras/crear_compra',$data);
		$this->load->view('footer');
		
	
	}
	public function addCompra(){
		$data = $_POST;
		
				foreach($data as $fila => $valor) {
					$filas[] = $fila;
					$valores[] = $valor;
				}

		$x = count($data)-1;
		$cantidad = 'cantidad';
		$subtotal = 0;
		$total= 0 ;
		$IVA = 1.19;
				
				for($j=1;$j<=($x-2)/2; $j++){
					$n=$data[$j]; //id_producto
					$m=$data[$cantidad.$j]; //cantidad vendida
					$precio = $this->Compras_model->total($n);
					$precio2= $precio[0];
					$precio_total = $precio2['PRECIO_C']*$m;
					$subtotal=$subtotal+$precio_total;
					$total=$subtotal*$IVA; 
				

				}


		$item = $this->Compras_model->add_compra($subtotal,$total);
		if ($item != FALSE) {
        	
        
		$ultimo_id_orden = $this->db->select('ID_COMPRA')->from('COMPRA')->order_by('ID_COMPRA',"desc")->limit(1)->get()->row(); 
        $ultimo_id_orden = (array) $ultimo_id_orden;
        $ultimo=$ultimo_id_orden['ID_COMPRA'];

       
				
				for($j=1;$j<=($x-2)/2; $j++){
					$n=$data[$j];
					$m=$data[$cantidad.$j];
					$this->Compras_model->add_compra_producto($n,$m,$ultimo);
					$stock_1 = $this->Ventas_model->stock($n);
					$stock = $stock_1[0]['STOCK'];
					$cantidad_total= $stock + $m;
			  		$this->Compras_model->sumar($n, $cantidad_total);
								
				}		
		
		echo "<script>alert('¡Compra realizada!.');</script>";
 		redirect('Compras/add', 'refresh');
 		}else{
        	echo "<script>alert('¡Número Factura repetido!.');</script>";
 			redirect('Compras/add', 'refresh');
        }
	}

	public function lista_compras(){
		$data['Compras'] = $this->Compras_model->obtener_compras();
		$this->load->view('header');
		$this->load->view('menu_lateral');
		$this->load->view('Compras/read_compras',$data);
		$this->load->view('footer');


	}

	public function detalle_compra($id){
		$this->load->helper('url');
        $id = $this->uri->segment(3);
        $data['Detalle'] = $this->Compras_model->detalle_compra($id);
        $this->load->view('header');
		$this->load->view('menu_lateral');
		$this->load->view('Compras/read_compra_detalle',$data);
		$this->load->view('footer');

	}
	public function desactivar(){

		$this->load->helper('url');
        $id = $this->uri->segment(3);
        $items = $this->Compras_model->insumos_cantidad($id);
        $this->Compras_model->desactivar($id);
        $x = count($items);
        for($i=0; $i<$x; $i++){
        	$n = $items[$i]['ID_INSUMO'];
        	$m = $items[$i]['CANTIDAD'];
        	$stock_1 = $this->Ventas_model->stock($n);
			$stock = $stock_1[0]['STOCK'];
			$cantidad_total= $stock + $m;
			$this->Compras_model->sumar($n, $cantidad_total);
        }
        redirect('Compras/lista_compras', 'refresh');
	}

	public function activar(){

		$this->load->helper('url');
        $id = $this->uri->segment(3);
        $items = $this->Compras_model->insumos_cantidad($id);
        $this->Compras_model->activar($id);
        $x = count($items);
        for($i=0; $i<$x; $i++){
        	$n = $items[$i]['ID_INSUMO'];
        	$m = $items[$i]['CANTIDAD'];
        	$stock_1 = $this->Ventas_model->stock($n);
			$stock = $stock_1[0]['STOCK'];
			$cantidad_total= $stock - $m;
			$this->Compras_model->sumar($n, $cantidad_total);
        }
        redirect('Compras/lista_compras', 'refresh');
	}
	
	
}