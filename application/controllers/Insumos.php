<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Insumos extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper("url");
		$this->load->model("Insumos_model");
		$this->load->library("session");
		$this->load->database();
	}
	public function index()
	{
		
		$this->load->view('header');
		$this->load->view('menu_lateral');
		$data['Insumos'] = $this->Insumos_model->obtener_todos();
		$this->load->view('Insumos/read_insumos', $data);
		$this->load->view('footer');
	}
	public function add(){
		
        $proveedores = $this->Insumos_model->obtener_proveedores();
		$data = array("proveedores" => $proveedores);

        $this->load->view('header');
		$this->load->view('menu_lateral');
		$this->load->view("Insumos/crear_insumo",$data);
		$this->load->view('footer');
		
	
	}
	public function addInsumo(){
		$this->Insumos_model->add();
		echo "<script>alert('¡Insumo agregado!');</script>";
        redirect('Insumos/index', 'refresh');
	}

	public function delete($id){
		$this->load->helper('url');
        $id = $this->uri->segment(3);
        $verificador1 = $this->Insumos_model->verificar1($id);
        $verificador2 = $this->Insumos_model->verificar2($id);
        $verificador_total = $verificador1 + $verificador2;
        if($verificador_total == null){  
            $item = $this->Insumos_model->delete($id);
            echo "<script>alert('¡Insumo eliminado!.');</script>";
            redirect('Insumos/index', 'refresh');
        }else{
            echo "<script> alert('Insumo en uso, no se puede eliminar');</script>";
            redirect('Insumos/index', 'refresh'); 
        }
	}
	public function editar($id){
		$id = $this->uri->segment(3);
		$obtenerInsumo = $this->Insumos_model->obtener_insumo($id);
		if($obtenerInsumo != FALSE){
			foreach($obtenerInsumo->result() as $row){
				$NOMBRE_I = $row->NOMBRE_I;
				$MARCA = $row->MARCA;
				$PRECIO_C = $row->PRECIO_C;
				$STOCK = $row->STOCK;
				$RUT_PROVEEDOR = $row->RUT_PROVEEDOR;
			}
			$data = array(
							'id' => $id, 
							'NOMBRE_I' => $NOMBRE_I,
							'PRECIO_C' => $PRECIO_C,
							'MARCA' => $MARCA,
							'STOCK' => $STOCK,
							'RUT_PROVEEDOR' => $RUT_PROVEEDOR
							
						);
			$proveedores = $this->Insumos_model->obtener_proveedores();
			$data['proveedores'] = $proveedores;
			$proveedor = $this->Insumos_model->obtener_proveedor($RUT_PROVEEDOR);
			$data['proveedor'] = $proveedor;
		}else{
			return FALSE;
		}
		$this->load->view('header');
		$this->load->view('menu_lateral');
		$this->load->view('Insumos/update_insumo', $data);
	}
	public function editarInsumo(){
		$id = $this->uri->segment(3);
		
		$data = array(
						'NOMBRE_I' => $this->input->post('NOMBRE_I', true),
						'PRECIO_C' => $this->input->post('PRECIO_C', true),
						'MARCA' => $this->input->post('MARCA', true),
						'STOCK' => $this->input->post('STOCK', true),
						'RUT_PROVEEDOR' => $this->input->post('selectProveedores', true),
						'ID_SUCURSAL' => $this->session->userdata('ID_SUCURSAL')

		);

		$this->Insumos_model->editar_insumo($id, $data);	
		
		echo "<script>alert('¡Insumo actualizado!');</script>";
        redirect('Insumos/index', 'refresh');
	}
	
}