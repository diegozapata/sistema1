<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ucc extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper("url");
		$this->load->model("Ucc_model");
		$this->load->library("session");
		$this->load->database();
	}
	public function index()
	{
		$this->load->view('header');
		$this->load->view('menu_lateral');
		$data['UCC'] = $this->Ucc_model->obtener_todos();
		$this->load->view('UCC/read_ucc', $data);
		$this->load->view('footer');
	}
	
	public function delete($id){
		
        $this->load->helper('url');
        $id = $this->uri->segment(3);
     	$verificador1 = $this->Ucc_model->verificar1($id);
     	$verificador2 = $this->Ucc_model->verificar2($id);
     	$verificador_final = $verificador1 + $verificador2;
    	if($verificador_final == null){  
        	$item=$this->Ucc_model->delete($id);
        	echo "<script> alert('Ucc eliminada.');</script>";
          	redirect('Ucc/index', 'refresh');
        }else{
        	echo "<script> alert('Ucc en uso, no se puede eliminar');</script>";
          	redirect('Ucc/index', 'refresh');
        }
        	
	}

	public function editar(){
		$id = $this->uri->segment(3);
		$obtenerUCC = $this->Ucc_model->obtenerUCC($id);
		if($obtenerUCC != FALSE){
			foreach($obtenerUCC->result() as $row){
				$NOMBRE = $row->NOMBRE;
				$NUMERO_UCC = $row->NUMERO_UCC;
				$ANEXO = $row->ANEXO;
				$TIPO_MATERIAL = $row->TIPO_MATERIAL;
			}
			$data = array(
							'id' => $id, 
							'NOMBRE' => $NOMBRE,
							'NUMERO_UCC' => $NUMERO_UCC,
							'ANEXO' => $ANEXO,
							'TIPO_MATERIAL' => $TIPO_MATERIAL
						);
		}else{
			return FALSE;
		}
		$this->load->view('header');
		$this->load->view('menu_lateral');
		$this->load->view('UCC/update_ucc', $data);


	}
	public function editarUCC(){
		$id = $this->uri->segment(3);
		$NUMERO_UCC = $this->Ucc_model->obtener_codigo_UCC($id);
		$NUMERO_UCC = $NUMERO_UCC[0]['NUMERO_UCC'];
		$data = array(
						'NOMBRE' => $this->input->post('NOMBRE', true),
						'NUMERO_UCC' => $NUMERO_UCC,
						'ANEXO' => $this->input->post('ANEXO', true),
						'TIPO_MATERIAL' => $this->input->post('TIPO_MATERIAL', true)
		);
		$this->Ucc_model->editarUCC($id, $data);
		redirect('Ucc/index', 'refresh');

	}

	public function add(){
		$this->load->helper('form');
    $this->load->library('form_validation');
	$this->form_validation->set_rules('NOMBRE', 'NOMBRE', 'required');
	$this->form_validation->set_rules('NUMERO_UCC', 'NUMERO_UCC', 'required');
	$this->form_validation->set_rules('ANEXO', 'ANEXO', 'required');
	
    
        
        $this->load->view('header');
		$this->load->view('menu_lateral');
		$this->load->view("UCC/crear_ucc");
		$this->load->view('footer');

    }
    public function addUcc(){	
    	$this->load->view('header');
		$this->load->view('menu_lateral');
        $item = $this->Ucc_model->add();
        if ($item != FALSE) {
        	echo "<script>alert('¡UCC ingresada con éxito!.');</script>";
 			redirect('Ucc/index', 'refresh');
        }else{
        	echo "<script>alert('¡Número de UCC repetido!.');</script>";
 			redirect('Ucc/add', 'refresh');
        }
    
    }
    

	
}
