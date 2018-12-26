<?php
class Sucursales_model extends CI_Model { 
  	public function __construct() {
     parent::__construct();
  	 $this->load->database();
    }

  	public function obtener_todos(){

  		$this->load->database('SCA');
  		$this->db->select('*');
  		$this->db->from('SUCURSAL');
	    $this->db->order_by('NOMBRE_S', 'asc');
	    $result = $this->db->get();

	    return  $result->result_array();
  	}
  	public function add(){
  	
        $NOMBRE_S = $this->input->post('NOMBRE_S');
         $CIUDAD = $this->input->post('CIUDAD');
         $data = "INSERT INTO SUCURSAL(ID_SUCURSAL, NOMBRE_S, CIUDAD) values(sucursal_seq.nextval, '$NOMBRE_S', '$CIUDAD')";
        $result = $this->db->query($data); 
    
    return $result;
  	}

  	
  	public function delete($id){
  		$this->db->where('ID_SUCURSAL', $id);
      return $this->db->delete('SUCURSAL');



  	}
    public function obtener_sucursal($id){
      $this->db->where('ID_SUCURSAL', $id);
        $query = $this->db->get('SUCURSAL');
        if ($query->num_rows() > 0){
        return $query;
       }else{
        return FALSE;
       }
    }
    
    public function editar_sucursal($id, $data){
        $this->db->where('ID_SUCURSAL', $id);
        $this->db->update('SUCURSAL', $data);

    }

    public function verificar1($id){

        $this->db->select('ID_COMPRA');
        $this->db->from('COMPRA');
        $this->db->where('ID_SUCURSAL', $id);
        $result = $this->db->get();
        return $result->result_array();

    }
    
        public function verificar2($id){

        $this->db->select('ID_VENTA');
        $this->db->from('VENTA');
        $this->db->where('ID_SUCURSAL', $id);
        $result = $this->db->get();
        return $result->result_array();

    }
 }
?>