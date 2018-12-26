<?php
class Proveedores_model extends CI_Model { 
  	public function __construct() {
     parent::__construct();
  	 $this->load->database();
    }

  	public function obtener_todos(){

  		$this->load->database('CSA1');
  		$this->db->select('*');
  		$this->db->from('PROVEEDOR');
	    $this->db->order_by('NOMBRE_P', 'asc');
	    $result = $this->db->get();

	    return  $result->result_array();
  	}
  	public function add(){
  	     
        $RUT_PROVEEDOR = $this->input->post('RUT_PROVEEDOR'); 
        
        $this->db->select('*');
        $this->db->from('PROVEEDOR');
        $this->db->where('RUT_PROVEEDOR', $RUT_PROVEEDOR);
        $rut = $this->db->get();
        $rut = $rut->result_array();
        if($rut == NULL){

        $NOMBRE_P = $this->input->post('NOMBRE_P');
         $TELEFONO = $this->input->post('TELEFONO');
         $DIRECCION = $this->input->post('DIRECCION');
        $data = "INSERT INTO PROVEEDOR(RUT_PROVEEDOR, NOMBRE_P, TELEFONO, DIRECCION) values('$RUT_PROVEEDOR', '$NOMBRE_P', '$TELEFONO', '$DIRECCION')";
        $result = $this->db->query($data); 
    
        return $result;
        }else{
          return NULL;
        }
        
  	}

  	
  	public function delete($id){
  		$this->db->where('RUT_PROVEEDOR', $id);
      return $this->db->delete('PROVEEDOR');



  	}
    public function obtener_proveedor($id){
      $this->db->where('RUT_PROVEEDOR', $id);
        $query = $this->db->get('PROVEEDOR');
        if ($query->num_rows() > 0){
        return $query;
       }else{
        return FALSE;
       }
    }
    
    public function editar_proveedor($id, $data){
        $this->db->where('RUT_PROVEEDOR', $id);
        $this->db->update('PROVEEDOR', $data);

    }
    
    public function verificar1($id){

        $this->db->select('ID_COMPRA');
        $this->db->from('COMPRA');
        $this->db->where('RUT_PROVEEDOR', $id);
        $result = $this->db->get();
        return $result->result_array();

    }
    
        public function verificar2($id){

        $this->db->select('ID_INSUMO');
        $this->db->from('INSUMO');
        $this->db->where('RUT_PROVEEDOR', $id);
        $result = $this->db->get();
        return $result->result_array();

    }

 }
?>