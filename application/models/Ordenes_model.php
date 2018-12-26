<?php
class Ordenes_model extends CI_Model { 
  	public function __construct() {
     parent::__construct();
     $this->load->database();
 
      
  	}

   public function obtener_tipo_v(){

      $this->load->database('CSA1');
      $this->db->select('*');
      $this->db->from('TIPO_VENTA');
      $this->db->order_by('NOMBRE', 'asc');
      $result = $this->db->get();
      return  $result->result_array();

    }
  
  
  	public function add_orden($total){

  	  $id_s = $this->session->userdata('ID_SUCURSAL');
      $id_u = $this->session->userdata('RUT');
      $N_ORDEN = $this->input->post('N_ORDEN', true);
      $UCC = $this->input->post('selectUCC', true);
      $FECHA_INGRESO = $this->input->post('FECHA_INGRESO', true);
      $TIPO_VENTA = $this->input->post('selectTipo_venta', true);
      $this->db->where('N_ORDEN', $N_ORDEN);
       $query = $this->db->get('VENTA');
      if ($query->num_rows() == 0){
      $data = "INSERT INTO VENTA (ID_Venta,ID_Usuario,N_Boleta,N_Orden, Fecha_ingreso, ID_UCC,ID_Tipo_Venta,Total, TIPO_VENTA,ID_Sucursal)values (venta_seq.nextval, '$id_u', null,'$N_ORDEN' , TO_DATE('$FECHA_INGRESO','YY-MM-DD'), '$UCC', '$TIPO_VENTA', '$total', null, '$id_s')";
      $result = $this->db->query($data);
      return $result;
      }else{
        return FALSE;
      }
  	}

    public function add_orden_producto($n,$m,$ultimo){

        $data = "INSERT INTO ITEMS_VENTA(ID_ITEMS_VENTA, ID_VENTA, ID_PRODUCTO, CANTIDAD) VALUES (venta_seq.nextval, '$ultimo', '$n', '$m')";
        $result = $this->db->query($data);

    }

    
    
    public function obtener_productos($ID_SUCURSAL){
      
      $this->db->select('*');
      $this->db->from('PRODUCTO');
      $this->db->where('ID_SUCURSAL', $ID_SUCURSAL);
      $this->db->where('ESTADO', 1);
      $proveedor=$this->db->get();
      return $proveedor->result_array();
    }
    
    public function insumo($id_producto){
      
      $this->load->database('CSA1');
      $this->db->select('ID_INSUMO');
      $this->db->from('PRODUCTO');
      $this->db->where('ID_PRODUCTO', $id_producto);
      $result = $this->db->get();
      return  $result->result_array();
    }

    public function stock($insumo){
      
      $this->load->database('CSA1');
      $this->db->select('STOCK');
      $this->db->from('INSUMO');
      $this->db->where('ID_INSUMO', $insumo);
      $result = $this->db->get();
      return $result->result_array();
    }

    public function descontar($insumo, $cantidad_total){
      
      $this->load->database('CSA1');
      $this->db->set('STOCK', $cantidad_total, FALSE);
      $this->db->where('ID_INSUMO', $insumo);
      $this->db->update('INSUMO');

    }
    public function obtener_ordenes(){

      $this->load->database('CSA1');
      $this->db->select('*');
      $this->db->from('VENTA');
      $this->db->where('N_BOLETA', null);
      $this->db->order_by('FECHA_INGRESO', 'asc');
      $result = $this->db->get();
      return  $result->result_array();

    }

    public function detalle_venta($id){

      $this->load->database('CSA1');
      $this->db->select('*');
      $this->db->from('ITEMS_VENTA');
      $this->db->where('ID_VENTA', $id);
      $result = $this->db->get();
      return  $result->result_array();

    }
 }
?>