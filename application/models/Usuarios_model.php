<?php
class Usuarios_model extends CI_Model { 
   public function __construct() {
     parent::__construct();
     $this->load->database();
   }

   public function usuario_por_nombre_contrasena($RUT, $CLAVE){
      $this->db->select('RUT, NOMBRE, APELLIDOS, ID_PERFIL, ID_SUCURSAL');
      $this->db->from('USUARIO');
      $this->db->where('RUT', $RUT);
      $this->db->where('CLAVE', $CLAVE);
      $consulta = $this->db->get();
      $resultado = $consulta->row();
      return $resultado;
   }

   public function obtener_todos($ID_SUCURSAL){
     
      $this->db->select('*');
      $this->db->from('USUARIO');
      $this->db->where('ID_SUCURSAL', $ID_SUCURSAL);
      $this->db->order_by('RUT', 'asc');
      $consulta = $this->db->get();
     
      return $consulta->result_array();
   }

   public function verificar1($id){

        $this->db->select('ID_COMPRA');
        $this->db->from('COMPRA');
        $this->db->where('ID_USUARIO', $id);
        $result = $this->db->get();
        return $result->result_array();

    }
    
        public function verificar2($id){

        $this->db->select('ID_VENTA');
        $this->db->from('VENTA');
        $this->db->where('ID_USUARIO', $id);
        $result = $this->db->get();
        return $result->result_array();

    }

    public function eliminar($id)
    {
        $this->db->where('RUT', $id);
        return $this->db->delete('USUARIO');
    }

    public function add()
    {
     
  
    $data = array(
        'RUT'   => $this->input->post('RUT'),
        'NOMBRE'   => $this->input->post('NOMBRE'),
        'APELLIDOS'   => $this->input->post('APELLIDOS'),
        'CARGO'   => $this->input->post('CARGO'),
        'ID_PERFIL'   => $this->input->post('ID_PERFIL'),
        'CLAVE'   => $this->input->post('CLAVE'),
        'ID_SUCURSAL' => $this->session->userdata('ID_SUCURSAL')
    
    );
    $RUT   = $this->input->post('RUT');
    $this->db->where('RUT', $RUT);
       $query = $this->db->get('USUARIO');
      if ($query->num_rows() == 0){
     $result = $this->db->insert('USUARIO', $data);
      return $result;
    }else{
      return false;
    }

  }

  function obtenerUsuario($id){
       $this->db->where('RUT', $id);
       $query = $this->db->get('USUARIO');
       if ($query->num_rows() > 0){
        return $query;
       }else{
        return FALSE;
       }

    }

    function editarUsuario($id, $data){
      $this->db->where('RUT', $id);
      $this->db->update('USUARIO', $data);

    }



}