
<nav class="navbar navbar-expand-lg navbar-blue fixed-top">

      <div class="container">
        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="<?php echo base_url();?>index.php/Usuarios/cerrar_sesion" class="btn btn-default">Bienvenido&nbsp;&nbsp;<?php echo $this->session->userdata('NOMBRE'); ?>
                
              </a>
            </li>
              <a href="<?php echo base_url();?>index.php/Ventas/add" class="btn btn-default">Ventas</a>
<a href="<?php echo base_url();?>index.php/Ordenes/add" class="btn btn-default">Ordenes</a>
<a href="<?php echo base_url();?>index.php/Compras/add" class="btn btn-default">Compras</a>
<a href="<?php echo base_url();?>index.php/Becas/index" class="btn btn-default">Becas</a><br><br>
<a href="<?php echo base_url();?>index.php/Usuarios/logueado/" class="btn btn-default">Informes</a>
<a href="<?php echo base_url();?>index.php/Usuarios/cerrar_sesion" class="btn btn-default">Cerrar sesión</a></div>
          </ul>
        </div>
      </div>
    </nav>