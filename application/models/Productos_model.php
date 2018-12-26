<?php
class Productos_model extends CI_Model { 
   public function __construct() {
     $this->load->database();

      parent::__construct();

   } 

      public function obtener_todos($ID_SUCURSAL){
      $this->load->database('CSA1');	
      $this->db->select('*');
      $this->db->from('PRODUCTO');
      $this->db->where('ID_SUCURSAL', $ID_SUCURSAL);
      $this->db->join('INSUMO', 'INSUMO.ID_INSUMO = PRODUCTO.ID_INSUMO');
      $this->db->join('SUCURSAL', 'SUCURSAL.ID_SUCURSAL = PRODUCTO.ID_SUCURSAL');
      $this->db->order_by('ID_PRODUCTO', 'asc');
      $consulta = $this->db->get();
     return $consulta->result_array();
   }


    public function delete_news($id)
    {
        $this->db->where('ID_PRODUCTO', $id);
        return $this->db->delete('PRODUCTO');
    }

    

    public function add()
    {
     
  
    
        $NOMBRE   = $this->input->post('NOMBRE');
        $PRECIO_V  = $this->input->post('PRECIO_V');
        $ID_INSUMO   = $this->input->post('selectInsumo');
        $id_s = $this->session->userdata('ID_SUCURSAL');
        $ESTADO   = $this->input->post('selectEstado');
        if($ESTADO == 'Activo'){
          $valor = 1;
        }else{
          $valor = 0;       
        }
        $data = "INSERT INTO PRODUCTO (ID_PRODUCTO, NOMBRE, PRECIO_V, ID_INSUMO, ID_SUCURSAL, ESTADO) values (producto_seq.nextval, '$NOMBRE', '$PRECIO_V','$ID_INSUMO', '$id_s', '$valor')";
        $result = $this->db->query($data);
    }



 public function obtener_insumos(){
      $this->load->database('CSA1');
      $this->db->select('*');
      $this->db->from('INSUMO');
      $this->db->order_by('NOMBRE_I', 'asc');
      $result = $this->db->get();
      return  $result->result_array();
    }



    function update($id, $nombre,$precio)
    {
        $this->db->where('ID_PRODUCTO', $id);
        $this->db->set('NOMBRE', $nombre);
        $this->db->set('PRECIO_V', $precio);
         $this->db->set('ESTADO', $estado);
        return $this->db->update('PRODUCTO');
    }


   public function obtener_producto($id){
      $this->db->where('ID_PRODUCTO', $id);
        $query = $this->db->get('PRODUCTO');
        if ($query->num_rows() > 0){
        return $query;
       }else{
        return FALSE;
       }
    }
    public function editar_producto($id, $data){

      $this->db->where('ID_PRODUCTO', $id);
      $this->db->update('PRODUCTO', $data);
    }

    public function desactivar($id){
      $this->db->where('ID_PRODUCTO', $id);
      $this->db->set('ESTADO', 0);
      return $this->db->update('PRODUCTO');
    }
    public function activar($id){
      $this->db->where('ID_PRODUCTO', $id);
      $this->db->set('ESTADO', 1);
      return $this->db->update('PRODUCTO');
    }

    public function verificar($id){

        $this->db->select('ID_ITEMS_VENTA');
        $this->db->from('ITEMS_VENTA');
        $this->db->where('ID_PRODUCTO', $id);
        $result = $this->db->get();
        return $result->result_array();

    }
}
?>