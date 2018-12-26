<?php
class Compras_model extends CI_Model { 
  	public function __construct() {
     parent::__construct();
     $this->load->database();

      
  	}

   public function add_compra($subtotal,$total){

  	  $id_s = $this->session->userdata('ID_SUCURSAL');
      $id_u = $this->session->userdata('RUT');
      $N_FACTURA = $this->input->post('N_FACTURA', true);
      $FECHA_INGRESO = $this->input->post('FECHA_INGRESO', true);
      $RUT_PROVEEDOR = $this->input->post('RUT_PROVEEDOR', true);
      $this->db->where('N_FACTURA', $N_FACTURA);
       $query = $this->db->get('COMPRA');
       if ($query->num_rows() == 0){
      $data = "INSERT INTO COMPRA (ID_Compra,ID_Usuario,N_Factura, Fecha_ingreso, ID_UCC,Subtotal,IVA,Total, RUT_PROVEEDOR,ID_Sucursal, ESTADO) values (compra_seq.nextval, '$id_u', '$N_FACTURA', TO_DATE('$FECHA_INGRESO','YY-MM-DD'), 61, '$subtotal',null,'$total', '$RUT_PROVEEDOR', '$id_s', 1)";
      $result = $this->db->query($data);
      return $result;
    }else{
        return FALSE;
       }

  	}

    public function add_compra_producto($n,$m,$ultimo){

        $data = "INSERT INTO ITEMS_COMPRA(ID_ITEMS_COMPRA, ID_COMPRA, ID_INSUMO, CANTIDAD) VALUES (compra_seq.nextval, '$ultimo', '$n', '$m')";
        $result = $this->db->query($data);

    }
    public function total($id_insumo){

      $this->load->database('CSA1');
      $this->db->select('PRECIO_C');
      $this->db->from('INSUMO');
      $this->db->where('ID_INSUMO', $id_insumo);
      $result = $this->db->get();
      return  $result->result_array();

    }

    
    

    public function sumar($insumo, $cantidad_total){
      
      $this->load->database('CSA1');
      $this->db->set('STOCK', $cantidad_total, FALSE);
      $this->db->where('ID_INSUMO', $insumo);
      $this->db->update('INSUMO');

    }
    public function obtener_compras(){

      $this->load->database('CSA1');
      $this->db->select('*');
      $this->db->from('COMPRA');
      $this->db->order_by('FECHA_INGRESO', 'asc');
      $result = $this->db->get();
      return  $result->result_array();

    }

    public function detalle_compra($id){

      $this->load->database('CSA1');
      $this->db->select('*');
      $this->db->from('ITEMS_COMPRA');
      $this->db->where('ID_COMPRA', $id);
      $this->db->join('INSUMO', 'INSUMO.ID_INSUMO = ITEMS_COMPRA.ID_INSUMO');
      $result = $this->db->get();
      return  $result->result_array();
      
    }

    public function desactivar($id){
      $this->db->where('ID_COMPRA', $id);
      $this->db->set('ESTADO', 0);
      return $this->db->update('COMPRA');
    }
    public function activar($id){
      $this->db->where('ID_COMPRA', $id);
      $this->db->set('ESTADO', 1);
      return $this->db->update('COMPRA');
    }

    public function insumos_cantidad($id){

      $this->db->select('ID_INSUMO, CANTIDAD');
      $this->db->from('ITEMS_COMPRA');
      $this->db->where('ID_COMPRA', $id);
      $result = $this->db->get();
      return  $result->result_array();

    }

    public function obtener_todos(){
      $this->load->database('CSA1');  
      $this->db->select('*');
      $this->db->from('COMPRA');
      //$this->db->join('INSUMO', 'INSUMO.ID_INSUMO = PRODUCTO.ID_INSUMO');
      $this->db->join('SUCURSAL', 'SUCURSAL.ID_SUCURSAL = COMPRA.ID_SUCURSAL');
      $this->db->order_by('ID_COMPRA', 'asc');
      $consulta = $this->db->get();
     
      return $consulta->result_array();
   }
public function obtener_sucursal(){
      $this->load->database('SCA1');
      $this->db->select('*');
      $this->db->from('SUCURSAL');
      $this->db->order_by('NOMBRE_S', 'asc');
      $result = $this->db->get();
        // $query = $this->db->get('INSUMO');
      return  $result->result_array();
    }
public function buscar($query){

    $data="SELECT * FROM COMPRA WHERE FECHA_INGRESO = TO_DATE('$query','YYYY-MM-DD')";
   
     $query=$this->db->query($data); 
 
     if ($query->num_rows()>0)
        {
            
            return $query->result_array();
        }else FALSE;


}

public function buscarrango($query1,$query2,$id_Sucursal){
     
     
    $data="SELECT * FROM COMPRA WHERE FECHA_INGRESO between TO_DATE('$query1','YYYY-MM-DD') AND TO_DATE('$query2','YYYY-MM-DD')";
      $data="SELECT * FROM COMPRA WHERE  ID_SUCURSAL = $id_Sucursal";
     $query=$this->db->query($data); 
    
     if ($query->num_rows()>0)
        {
            return $query->result_array();
        }else FALSE;

}

public function obtener_ucc(){
      $this->load->database('SCA1');
      $this->db->select('*');
      $this->db->from('UCC');
      $this->db->order_by('NOMBRE', 'asc');
      $result = $this->db->get();
        // $query = $this->db->get('INSUMO');
      return  $result->result_array();
    }
    
 }
?>