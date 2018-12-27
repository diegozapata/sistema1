<?php
class Ventas_model extends CI_Model { 
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
  
  
  	public function add_venta($total){

  	  $id_s = $this->session->userdata('ID_SUCURSAL');
      $id_u = $this->session->userdata('RUT');
      $N_BOLETA = $this->input->post('N_BOLETA', true);
      $FECHA_INGRESO = $this->input->post('FECHA_INGRESO', true);
      $TIPO_VENTA = $this->input->post('select', true);
      $VOUCHER = $this->input->post('browser', true);
      if ($TIPO_VENTA == 'Normal') {
        $this->db->where('N_BOLETA', $N_BOLETA);
       $query = $this->db->get('VENTA');
      if ($query->num_rows() == 0){
      $data = "INSERT INTO VENTA (ID_Venta,ID_Usuario,N_Boleta,N_Orden, Fecha_ingreso, ID_UCC,ID_Tipo_Venta,Total, TIPO_VENTA,ID_Sucursal,ESTADO)values (venta_seq.nextval, '$id_u', '$N_BOLETA',null , TO_DATE('$FECHA_INGRESO','YY-MM-DD'), 61, null, '$total', 0, '$id_s', 1)";
      $result = $this->db->query($data);
      return $result;
      }else{
        return FALSE;
       }
      }elseif ($TIPO_VENTA == 'Transbank') {
        $this->db->where('N_BOLETA', $N_BOLETA);
       $query = $this->db->get('VENTA');
      if ($query->num_rows() == 0){
      $data = "INSERT INTO VENTA (ID_Venta,ID_Usuario,N_Boleta,N_Orden, Fecha_ingreso, ID_UCC,ID_Tipo_Venta,Total, TIPO_VENTA,ID_Sucursal,ESTADO)values (venta_seq.nextval, '$id_u', '$N_BOLETA',null , TO_DATE('$FECHA_INGRESO','YY-MM-DD'), 61, '$VOUCHER' , '$total', 1, '$id_s', 1)";
      $result = $this->db->query($data);
      return $result;
      }else{
        return FALSE;
       }
      }
      
   
  	}

    public function add_venta_producto($n,$m,$ultimo){

        $data = "INSERT INTO ITEMS_VENTA(ID_ITEMS_VENTA, ID_VENTA, ID_PRODUCTO, CANTIDAD) VALUES (venta_seq.nextval, '$ultimo', '$n', '$m')";
        $result = $this->db->query($data);

    }

    public function total($id_producto){

      $this->load->database('CSA1');
      $this->db->select('PRECIO_V');
      $this->db->from('PRODUCTO');
      $this->db->where('ID_PRODUCTO', $id_producto);
      $result = $this->db->get();
      return  $result->result_array();

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
    public function obtener_ventas(){

      $this->load->database('CSA1');
      $this->db->select('*');
      $this->db->from('VENTA');
      $this->db->where('N_ORDEN', null);
      $this->db->order_by('FECHA_INGRESO', 'asc');
      $result = $this->db->get();
      return  $result->result_array();

    }

    public function detalle_venta($id){

      $this->load->database('CSA1');
      $this->db->select('*');
      $this->db->from('ITEMS_VENTA');
      $this->db->where('ID_VENTA', $id);
      $this->db->join('PRODUCTO', 'PRODUCTO.ID_PRODUCTO = ITEMS_VENTA.ID_PRODUCTO');
      $result = $this->db->get();
      return  $result->result_array();

    }

    public function obtener_id_insumo($producto){

      $this->db->select('ID_INSUMO');
      $this->db->from('PRODUCTO');
      $this->db->where('ID_PRODUCTO', $producto);
      $result = $this->db->get();
      return  $result->result_array();

    }

     public function desactivar($id){
      $this->db->where('ID_VENTA', $id);
      $this->db->set('ESTADO', 0);
      return $this->db->update('VENTA');
    }
    public function activar($id){
      $this->db->where('ID_VENTA', $id);
      $this->db->set('ESTADO', 1);
      return $this->db->update('VENTA');
    }

    public function insumos_cantidad($id){

      $this->db->select('ID_PRODUCTO, CANTIDAD');
      $this->db->from('ITEMS_VENTA');
      $this->db->where('ID_VENTA', $id);
      $result = $this->db->get();
      return  $result->result_array();

    }

    public function obtener_todos(){
      $this->load->database('CSA1');  
      $this->db->select('*');
      $this->db->from('VENTA');
      //$this->db->join('INSUMO', 'INSUMO.ID_INSUMO = PRODUCTO.ID_INSUMO');
      $this->db->join('SUCURSAL', 'SUCURSAL.ID_SUCURSAL = VENTA.ID_SUCURSAL');
      $this->db->order_by('ID_VENTA', 'asc');
      $consulta = $this->db->get();
     
      return $consulta->result_array();
   }
public function obtener_sucursal(){
      $this->load->database('SCA1');
      $this->db->select('*');
      $this->db->from('SUCURSAL');
      $this->db->order_by('NOMBRE_S', 'asc');
      $result = $this->db->get();
        
      return  $result->result_array();
    }
public function buscar($query,$query1,$id_Sucursal){

    $data="SELECT * FROM VENTA WHERE FECHA_INGRESO between TO_DATE('$query','YYYY-MM-DD') AND TO_DATE('$query1','YYYY-MM-DD')";
    $data="SELECT * FROM VENTA WHERE ID_UCC=3 AND  ID_SUCURSAL = $id_Sucursal ";
 
    
     $query=$this->db->query($data); 
 
     if ($query->num_rows()>0)
        {
          
            
            return $query->result_array();
        }else FALSE;


}

public function buscarrango($query1,$query2,$id_sucursal){

    $data="SELECT * FROM VENTA WHERE FECHA_INGRESO between TO_DATE('$query1','YYYY-MM-DD') AND TO_DATE('$query2','YYYY-MM-DD')";
      $data="SELECT * FROM VENTA WHERE ID_UCC!=3 AND  ID_SUCURSAL = $id_sucursal";
     $query=$this->db->query($data); 

     if ($query->num_rows()>0)
        {
            return $query->result_array();
        }else FALSE;

}
public function obtener_ucc(){
      $this->load->database('CSA1');
      $this->db->select('*');
      $this->db->from('UCC');
      $this->db->order_by('NOMBRE', 'asc');
      $result = $this->db->get();
  
      return  $result->result_array();
    }
    public function obtener_tipo_venta(){
      $this->load->database('CSA1');
      $this->db->select('*');
      $this->db->from('TIPO_VENTA');
      $this->db->order_by('NOMBRE', 'asc');
      $result = $this->db->get();

      return  $result->result_array();
    }


    public function obtener_itemventa(){
      $this->load->database('CSA1');
      $this->db->select('*');
      $this->db->from('ITEMS_VENTA');
      $this->db->join('VENTA', 'VENTA.ID_VENTA = ITEMS_VENTA.ID_VENTA');
      $this->db->join('PRODUCTO', 'PRODUCTO.ID_PRODUCTO = ITEMS_VENTA.ID_PRODUCTO');
       $this->db->join('VENTA', 'VENTA.ID_VENTA = ITEMS_VENTA.ID_VENTA');
      $this->db->order_by('ID_ITEMS_VENTA', 'asc');
      $result = $this->db->get();
   
      return  $result->result_array();
    }

    public function obtener_todosproductos(){
      $this->load->database('CSA1'); 
      $this->db->select('*');
      $this->db->from('PRODUCTO');
      $this->db->order_by('ID_PRODUCTO', 'asc');
      $consulta = $this->db->get();
     
      return $consulta->result_array();
   }

 }
?>