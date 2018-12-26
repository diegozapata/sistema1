<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sucursales extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper("url");
		$this->load->model("Sucursales_model");
		$this->load->library("session");
		$this->load->database();
	}
	public function index()
	{
		$this->load->view('header');
		$this->load->view('menu_lateral');
		$data['Sucursales'] = $this->Sucursales_model->obtener_todos();
		$this->load->view('Sucursales/read_sucursales', $data);
		$this->load->view('footer');
	}
	
	

	
	public function add(){
		$this->load->view('header');
		$this->load->view('menu_lateral');
		$this->load->view("Sucursales/crear_sucursal");
		$this->load->view('footer');
	}
	public function addSucursal(){
		$this->Sucursales_model->add();
		$this->load->view('header');
		$this->load->view('menu_lateral');
		$data['Sucursales'] = $this->Sucursales_model->obtener_todos();
		$this->load->view('Sucursales/read_sucursales', $data);
		$this->load->view('footer');
	}

	public function delete($id){
		
          $this->load->helper('url');
          $id = $this->uri->segment(3);
     	  $verificador1 = $this->Sucursales_model->verificar1($id);
     	  $verificador2 = $this->Sucursales_model->verificar2($id);
     	  $verificador_final = $verificador1 + $verificador2;
    	  if($verificador_final == null){
          	$item=$this->Sucursales_model->delete($id);
          	echo "<script> alert('Sucursal eliminada.');</script>";
          	redirect('Sucursales/index', 'refresh');
          }else{
          	echo "<script>alert('La sucursal está en uso, no se puede eliminar.');</script>";
 			redirect('Sucursales/index', 'refresh');
          }
         


	}

	public function editar($id){
		$id = $this->uri->segment(3);
		$obtenerSucursal = $this->Sucursales_model->obtener_sucursal($id);
		if($obtenerSucursal != FALSE){
			foreach($obtenerSucursal->result() as $row){
				$NOMBRE_S = $row->NOMBRE_S;
				$CIUDAD = $row->CIUDAD;
			}
			$data = array(
							'id' => $id, 
							'NOMBRE_S' => $NOMBRE_S,
							'CIUDAD' => $CIUDAD
							
						);
	}else{
			return FALSE;
		}
		$this->load->view('header');
		$this->load->view('menu_lateral');
		$this->load->view('Sucursales/update_sucursal', $data);
	}

	public function editarSucursal(){
		$id = $this->uri->segment(3);
		
		$data = array(
						'NOMBRE_S' => $this->input->post('NOMBRE_S', true),
						'CIUDAD' => $this->input->post('CIUDAD', true)
						
						
		);

		$this->Sucursales_model->editar_sucursal($id, $data);	
		$this->load->view('header');
		$this->load->view('menu_lateral');
		$data['Sucursales'] = $this->Sucursales_model->obtener_todos();
		$this->load->view('Sucursales/read_sucursales', $data);
		$this->load->view('footer');


	}
}
