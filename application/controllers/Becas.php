 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Becas extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper("url");
		$this->load->model("Ordenes_model");
		$this->load->model("Ventas_model");
		$this->load->model("Becas_model");
		$this->load->model("Compras_model");
		$this->load->model("Insumos_model");
		$this->load->library("session");
		$this->load->database();
	}
	
	public function add(){
		$id_s = $this->session->userdata('ID_SUCURSAL');
        $this->load->view('header');
		$this->load->view('menu_lateral');
		$this->load->view('Becas/crear_beca');
		$this->load->view('footer');
		
	
	}
	public function addBeca(){
			
		$CANTIDAD= $this->input->post('CANTIDAD', true);
		$item = $this->Becas_model->add_beca();
		if($item != null){
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
	}	
	public function index(){
		$data['Becas'] = $this->Becas_model->obtener_becas();
		$this->load->view('header');
		$this->load->view('menu_lateral');
		$this->load->view('Becas/read_becas',$data);
		$this->load->view('footer');


	}

	public function desactivar(){

		$this->load->helper('url');
        $id = $this->uri->segment(3);
        $cantidad = $this->Becas_model->cantidad($id);
        $cantidad = $cantidad[0]['CANTIDAD'];
        $this->Becas_model->desactivar($id);
        $stock_1 = $this->Ventas_model->stock(173);
		$stock = $stock_1[0]['STOCK'];
		$cantidad_total=$stock+$cantidad;
        $this->Compras_model->sumar(173, $cantidad_total);
        redirect('Becas/lista_becas', 'refresh');
    }

    public function activar(){

		$this->load->helper('url');
        $id = $this->uri->segment(3);
        $cantidad = $this->Becas_model->cantidad($id);
        $this->Becas_model->activar($id);
        $stock_1 = $this->Ventas_model->stock($n);
		$stock = $stock_1[0]['STOCK'];
		$cantidad_total=$stock-$cantidad;
        $this->Compras_model->sumar(170, $cantidad_total);
        redirect('Becas/lista_becas', 'refresh');
    }
		
}