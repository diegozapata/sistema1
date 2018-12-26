 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ordenes extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper("url");
		$this->load->model("Ordenes_model");
		$this->load->model("Ventas_model");
		$this->load->model("Ucc_model");
		$this->load->library("session");
		$this->load->database();
	}
	
	public function add(){
		$id_s = $this->session->userdata('ID_SUCURSAL');
        $productos = $this->Ventas_model->obtener_productos($id_s);
        $UCC = $this->Ucc_model->obtener_todos();
		$data = array(
						"productos" => $productos,
						"UCC" => $UCC 
						);

        $this->load->view('header');
		$this->load->view('menu_lateral');
		$this->load->view('Ordenes/crear_orden',$data);
		$this->load->view('footer');
		
	
	}
	public function addOrden(){
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


		$item = $this->Ordenes_model->add_orden($total);
		if ($item != FALSE) {
		$ultimo_id_orden = $this->db->select('ID_VENTA')->from('VENTA')->where('N_BOLETA', null)->order_by('ID_VENTA',"desc")->limit(1)->get()->row(); 
        $ultimo_id_orden = (array) $ultimo_id_orden;
        $ultimo=$ultimo_id_orden['ID_VENTA'];

        
				
				for($j=1;$j<=($x-2)/2; $j++){
					$n=$data[$j];
					$m=$data[$cantidad.$j];
					$this->Ordenes_model->add_orden_producto($n,$m,$ultimo);
					$insumo_1 = $this->Ventas_model->insumo($n);
					$insumo = $insumo_1[0]['ID_INSUMO'];
					$stock_1 = $this->Ventas_model->stock($insumo);
					$stock = $stock_1[0]['STOCK'];
					$cantidad_total= $stock - $m;
			  		$this->Ventas_model->descontar($insumo, $cantidad_total);
								
				}		
		
			echo "<script>alert('¡Orden realizada!.');</script>";
	 		redirect('Ordenes/add', 'refresh');
 		}else{
 			echo "<script>alert('¡Numero de Orden repetido!.');</script>";
 			redirect('Ordenes/add', 'refresh');
 		}
	}

	public function lista_ordenes(){
		$data['Ventas'] = $this->Ordenes_model->obtener_ordenes();
		$this->load->view('header');
		$this->load->view('menu_lateral');
		$this->load->view('Ordenes/read_ordenes',$data);
		$this->load->view('footer');


	}

	public function detalle_orden($id){
		$this->load->helper('url');
        $id = $this->uri->segment(3);
        $data['Detalle'] = $this->Ventas_model->detalle_venta($id);
        $this->load->view('header');
		$this->load->view('menu_lateral');
		$this->load->view('Ordenes/read_orden_detalle',$data);
		$this->load->view('footer');

	}

	public function desactivar(){

		$this->load->helper('url');
        $id = $this->uri->segment(3);
        $this->Ventas_model->desactivar($id);
        redirect('Ordenes/lista_ordenes', 'refresh');
	}

	public function activar(){

		$this->load->helper('url');
        $id = $this->uri->segment(3);
        $this->Ventas_model->activar($id);
        redirect('Ordenes/lista_ordenes', 'refresh');
	}


	
	
}