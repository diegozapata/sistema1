<?php
class Becas_model extends CI_Model { 
  	public function __construct() {
     parent::__construct();
     $this->load->database();

      
  	}

   public function add_beca(){
      
  	  $id_s = $this->session->userdata('ID_SUCURSAL');
      if($id_s != null){
      $id_u = $this->session->userdata('RUT');
      $N_BECA = $this->input->post('N_BOLETA', true);
      $FECHA_INGRESO = $this->input->post('FECHA_INGRESO', true);
      $CANTIDAD = $this->input->post('cantidad1', true);
      $data = "INSERT INTO BECA (ID_BECA,CANTIDAD,ID_USUARIO, ID_SUCURSAL, N_BECA,FECHA_INGRESO, ESTADO)values (beca_seq.nextval, '$CANTIDAD', '$id_u','$id_s', '$N_BECA', TO_DATE('$FECHA_INGRESO','YY-MM-DD'), 1)";
      $result = $this->db->query($data);
      return $result;
      }else{
        return null;
      }
  	}

   public function obtener_becas(){
      $id_s = $this->session->userdata('ID_SUCURSAL');
      $this->db->select('*');
      $this->db->from('BECA');
      $this->db->where('ID_SUCURSAL', $id_s);
      $proveedor=$this->db->get();
      return $proveedor->result_array();
    }

    public function cantidad($id){

      $this->db->select('CANTIDAD');
      $this->db->from('BECA');
      $this->db->where('ID_BECA', $id);
      $cantidad = $this->db->get();
      return $cantidad->result_array();

    }

    public function desactivar($id){

      $this->db->where('ID_BECA', $id);
      $this->db->set('ESTADO', 0);
      return $this->db->update('BECA');
      
    }

    public function activar($id){

      $this->db->where('ID_BECA', $id);
      $this->db->set('ESTADO', 1);
      return $this->db->update('BECA');
      
    }    
    
 }
?>