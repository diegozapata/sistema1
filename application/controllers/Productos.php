<?php
defined('BASEPATH') OR exit('No direct script access allowed');



	class Productos extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper("url");
        $this->load->model("Proveedores_model");
        $this->load->model("Insumos_model");
        $this->load->model("Productos_model");
        $this->load->library("session");
        $this->load->helper('form');
        $this->load->database();
  }


    public function moduloproducto(){   
        $this->load->model("Productos_model");
        $ID_SUCURSAL = $this->session->userdata('ID_SUCURSAL');
      	$data['productos'] = $this->Productos_model->obtener_todos($ID_SUCURSAL);
    	$this->load->view('header');
        $this->load->view('Productos/view_moduloproducto', $data);
        $this->load->view('menu_lateral');
        $this->load->view('footer');
		
	}
    public function eliminar($id){
	    
        $id = $this->uri->segment(3);
        
        $verificador = $this->Productos_model->verificar($id);
        if($verificador == null){  
            $item = $this->Productos_model->delete_news($id);
            echo "<script>alert('¡Producto eliminado!.');</script>";
            redirect('Productos/moduloproducto', 'refresh');
        }else{
            echo "<script> alert('Producto en uso, no se puede eliminar');</script>";
            redirect('Productos/moduloproducto', 'refresh'); 
        }

    }


    public function add(){

        
        $this->load->library('form_validation');
        $insumos = $this->Insumos_model->obtener_todos();
        $data  =  array( 
                        "insumos"  =>  $insumos
                    );
       
                   
            $this->load->view('header');
            $this->load->view('Productos/add',$data);   
            $this->load->view('menu_lateral');
            $this->load->view('footer');
        }

    public function addProducto(){
    
            $NOMBRE   = $this->input->post('NOMBRE');
            $PRECIO_V  = $this->input->post('PRECIO_V');
            $ID_INSUMO   = $this->input->post('selectInsumo');
            $id_s = $this->session->userdata('ID_SUCURSAL');
            $ESTADO   = $this->input->post('selectEstado');
            $this->Productos_model->add();
            echo "<script>alert('¡Producto ingresado!.');</script>";
            redirect('Productos/moduloproducto', 'refresh');
            
        }
    
    public function edit(){

        $id = $this->uri->segment(3);
        $obtenerProducto = $this->Productos_model->obtener_producto($id);
        if($obtenerProducto != FALSE){
            foreach($obtenerProducto->result() as $row){
                $NOMBRE = $row->NOMBRE;
                $PRECIO_V = $row->PRECIO_V;
                $ID_INSUMO = $row->ID_INSUMO;
                $ESTADO = $row->ESTADO;
            }
            $Insumos = $this->Insumos_model->obtener_todos();
            if($ESTADO == '1'){
          $ESTADO = 'Activo';
        }else{
           $ESTADO = 'Inactivo';         
        }
        $obtenerInsumo= $this->Insumos_model->obtener_insumo($ID_INSUMO);
        if($obtenerInsumo != FALSE){
            foreach($obtenerInsumo->result() as $row){
                $NOMBRE_I = $row->NOMBRE_I;
            }
        }else{
            return FALSE;
        }
            $data = array(
                            'id' => $id, 
                            'NOMBRE' => $NOMBRE,
                            'PRECIO_V' => $PRECIO_V,
                            'ID_INSUMO' => $ID_INSUMO,
                            'NOMBRE_I' =>$NOMBRE_I,
                            'ESTADO' => $ESTADO,
                            'Insumos' => $Insumos
                        );
        
        }else{
                return FALSE;
        }
        $this->load->view('header');
        $this->load->view('menu_lateral');
        $this->load->view('Productos/update_producto', $data);


    }

    public function editarProducto(){

        $id = $this->uri->segment(3);
        
        $data = array(
                        'NOMBRE' => $this->input->post('NOMBRE', true),
                        'PRECIO_V' => $this->input->post('PRECIO_V', true),
                        'ID_INSUMO' => $this->input->post('selectInsumo', true),
                        'ID_SUCURSAL' => $this->session->userdata('ID_SUCURSAL'),
                        'ESTADO' => $this->input->post('selectEstado', true),
                        
        );
        if($data['ESTADO'] == 'Activo'){
          $data['ESTADO'] = '1';
        }else{
           $data['ESTADO'] = '0';         
        }
       
        $this->Productos_model->editar_producto($id, $data); 
        echo "<script>alert('¡Producto actualizado!');</script>";
        redirect('Productos/moduloproducto', 'refresh');
    }

    public function desactivar(){

        $this->load->helper('url');
        $id = $this->uri->segment(3);
        $this->Productos_model->desactivar($id);
        redirect('Productos/moduloproducto', 'refresh');
    }

    public function activar(){

        $this->load->helper('url');
        $id = $this->uri->segment(3);
        $this->Productos_model->activar($id);
        redirect('Productos/moduloproducto', 'refresh');
    }
}