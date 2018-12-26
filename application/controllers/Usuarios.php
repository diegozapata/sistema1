<?php
if (!defined('BASEPATH'))
   exit('No direct script access allowed');
class Usuarios extends CI_Controller {
   public function __construct() {
      parent::__construct();
      $this->load->helper("url");
      $this->load->model("Usuarios_model");
      $this->load->library("session");
      $this->load->database();
   }
   public function iniciar_sesion() {
      $data = array();
      $this->load->view('header');
      $this->load->view('login', $data);
      $this->load->view('footer');
   }
   public function iniciar_sesion_post() {
      if ($this->input->post()) {
         $RUT = $this->input->post('RUT');
         $CLAVE = $this->input->post('CLAVE');
         $this->load->model('Usuarios_model');
         $usuario = $this->Usuarios_model->usuario_por_nombre_contrasena($RUT, $CLAVE);
         if ($usuario) {
            $usuario_data = array(
               'RUT' => $usuario->RUT,
               'NOMBRE' => $usuario->NOMBRE,
               'APELLIDOS' => $usuario->APELLIDOS,
               'ID_SUCURSAL' => $usuario->ID_SUCURSAL,
               'ID_PERFIL' => $usuario->ID_PERFIL,
               'logueado' => TRUE
            );
            $this->session->set_userdata($usuario_data);
            redirect('Usuarios/logueado');
         } else {
            redirect('Usuarios/iniciar_sesion');
         }
      } else {
         $this->iniciar_sesion();
      }
   }
   public function logueado() {
      if($this->session->userdata('logueado')){
         $data = array();
         $data['NOMBRE'] = $this->session->userdata('NOMBRE');
         $this->load->view('header');
         $this->load->view('menu_lateral');
        // $this->load->view('welcome_message', $data);
         $this->load->view('inicio', $data);
         $this->load->view('footer');
      }else{
         redirect('usuarios/iniciar_sesion');
      }
   }
   public function cerrar_sesion() {
      $usuario_data = array(
         'logueado' => FALSE
      );
      $this->session->sess_destroy();
      $this->session->set_userdata($usuario_data);

      redirect('usuarios/iniciar_sesion');
   }

   public function index()
   {   

      $ID_SUCURSAL = $this->session->userdata('ID_SUCURSAL');
      $data['usuarios'] = $this->Usuarios_model->obtener_todos($ID_SUCURSAL);
      
      
      $this->load->view('header');
         $this->load->view('menu_lateral');
         $this->load->view('Usuarios/read_usuarios', $data);
         $this->load->view('footer');

      
   }

   public function eliminar(){
      
      $id = $this->uri->segment(3);
      
      $verificador1 = $this->Usuarios_model->verificar1($id);
      $verificador2 = $this->Usuarios_model->verificar2($id);
      $verificador_final = $verificador1 + $verificador2;
         if($verificador_final == null){  
            $item=$this->Usuarios_model->eliminar($id);
               echo "<script> alert('Usuario eliminado');</script>";
               redirect('Usuarios/index', 'refresh');
         }else{
               echo "<script> alert('Usuario en uso, no se puede eliminar');</script>";
               redirect('Usuarios/index', 'refresh');
         }
   }

   public function add(){

         $this->load->view('header');
         $this->load->view('menu_lateral');
         $this->load->view('Usuarios/crear_usuario');
         $this->load->view('footer');



   }

   public function addUsuario(){

      $item = $this->Usuarios_model->add();
      if ($item != false) {
         echo "<script> alert('Usuario agregado');</script>";
         redirect('Usuarios/index', 'refresh');
      }else{
         echo "<script> alert('El RUT ya está catastrado');</script>";
         redirect('Usuarios/add', 'refresh');
      }

   }

   public function edit(){

      $id = $this->uri->segment(3);
      $obtenerUsuario = $this->Usuarios_model->obtenerUsuario($id);
      if($obtenerUsuario != FALSE){
         foreach($obtenerUsuario->result() as $row){
            $NOMBRE = $row->NOMBRE;
            $APELLIDOS = $row->APELLIDOS;
            $CARGO = $row->CARGO;
            $CLAVE = $row->CLAVE;
            $ID_PERFIL =$row->ID_PERFIL;
         }
         $data = array(
                     'RUT' => $id, 
                     'NOMBRE' => $NOMBRE,
                     'APELLIDOS' => $APELLIDOS,
                     'CARGO' => $CARGO,
                     'CLAVE' => $CLAVE,
                     'ID_PERFIL' => $ID_PERFIL
                  );
      }else{
         return FALSE;
      }
      $this->load->view('header');
      $this->load->view('menu_lateral');
      $this->load->view('Usuarios/update_usuario', $data);

   }
   

   public function editUsuario(){
      $id = $this->uri->segment(3);
      $data = array(
                  
                  'NOMBRE' => $this->input->post('NOMBRE', true),
                  'APELLIDOS' => $this->input->post('APELLIDOS', true),
                  'CARGO' => $this->input->post('CARGO', true),
                  'CLAVE' => $this->input->post('CLAVE', true),
                  'ID_PERFIL' => $this->input->post('ID_PERFIL', true),
      );
      $this->Usuarios_model->editarUsuario($id, $data);
      echo "<script> alert('Usuario modificado');</script>";
      redirect('Usuarios/index', 'refresh');


   }
}