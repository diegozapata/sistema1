<?php
class Insumos_model extends CI_Model { 
  	public function __construct() {
     parent::__construct();
     $this->load->database();

      
  	}

    public function obtener_todos(){
      $ID_SUCURSAL = $this->session->userdata('ID_SUCURSAL');
      $this->load->database('CSA1');
      $this->db->select('*');
      $this->db->from('INSUMO');
      $this->db->where('ID_SUCURSAL', $ID_SUCURSAL);
      $this->db->join('PROVEEDOR', 'PROVEEDOR.RUT_PROVEEDOR = INSUMO.RUT_PROVEEDOR');
      $this->db->order_by('ID_INSUMO', 'asc');
      $result = $this->db->get();
      return  $result->result_array();

    }

    public function obtener_proveedores(){

      $this->load->database('CSA1');
      $this->db->select('*');
      $this->db->from('PROVEEDOR');
      $this->db->order_by('NOMBRE_P', 'asc');
      $result = $this->db->get();
      return  $result->result_array();

    }
    
    
  	public function add(){
  	
        $NOMBRE_I = $this->input->post('NOMBRE_I', true);
        $PRECIO_C = $this->input->post('PRECIO_C', true);
        $MARCA = $this->input->post('MARCA', true);
        $STOCK = $this->input->post('STOCK', true);
        $RUT_PROVEEDOR = $this->input->post('selectProveedores', true);
        $ID_SUCURSAL = $this->session->userdata('ID_SUCURSAL');
        $data = "INSERT INTO INSUMO(ID_INSUMO, NOMBRE_I, PRECIO_C, MARCA, STOCK, RUT_PROVEEDOR, ID_SUCURSAL) values (insumo_seq.nextval, '$NOMBRE_I', '$PRECIO_C', '$MARCA', '$STOCK', '$RUT_PROVEEDOR', '$ID_SUCURSAL')";
        $result = $this->db->query($data);
        return $result;
  	}

  	public function obtener_insumo($id){
        $this->db->where('ID_INSUMO', $id);
        $query = $this->db->get('INSUMO');
        if ($query->num_rows() > 0){
        return $query;
       }else{
        return FALSE;
       }
    }
    public function obtener_proveedor($RUT_PROVEEDOR){
      $this->db->select('*');
      $this->db->from('PROVEEDOR');
      $this->db->where('RUT_PROVEEDOR', $RUT_PROVEEDOR);
      $proveedor=$this->db->get();
      return $proveedor->result_array();
    }
    
    public function editar_insumo($id, $data){
        $this->db->where('ID_INSUMO', $id);
        $this->db->update('INSUMO', $data);

    }

  	public function delete($id){
  		$this->db->where('ID_INSUMO', $id);
        return $this->db->delete('INSUMO');



  	}

    public function verificar1($id){

        $this->db->select('ID_ITEMS_COMPRA');
        $this->db->from('ITEMS_COMPRA');
        $this->db->where('ID_INSUMO', $id);
        $result = $this->db->get();
        return $result->result_array();

    }

    public function verificar2($id){

        $this->db->select('ID_PRODUCTO');
        $this->db->from('PRODUCTO');
        $this->db->where('ID_INSUMO', $id);
        $result = $this->db->get();
        return $result->result_array();

    }

  }
?>