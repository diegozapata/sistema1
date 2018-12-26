<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<style>
/* width */
::-webkit-scrollbar {
  width: 10px;
}

/* Track */
::-webkit-scrollbar-track {
  box-shadow: inset 0 0 5px grey; 
  border-radius: 10px;
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: #404B95; 
  border-radius: 10px;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #3F51B5; 
}
</style>



    <!-- Bootstrap core CSS -->

    
  </head>

  <body>
    

    <div class="container-fluid"  >

      <div class="row" >
        <nav class="sidebar" >
          <div class="sidebar-sticky" style="margin-right: 89%; margin-top: 1.2%; margin-bottom: 10%">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" href="<?php echo base_url();?>index.php/Welcome/inicio" >
                  <span data-feather="home"></span>
                  Inicio <span class="sr-only"></span>
                </a>
              </li>
              <label>Gestores</label>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url();?>index.php/Ventas/add" >
                  <span data-feather="file"></span>
                  Ventas
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url();?>index.php/Ordenes/add" >
                  <span data-feather="file"></span>
                  Ordenes
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url();?>index.php/Compras/add" >
                  <span data-feather="file"></span>
                  Compras
                </a>
              </li><li class="nav-item">
                <a class="nav-link" href="<?php echo base_url();?>index.php/Becas/index" >
                  <span data-feather="file"></span>
                  Becas
                </a>
              </li>
              <label>Informes</label>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url();?>index.php/informes" >
                  <span data-feather="file-text"></span>
                  Informes
                </a>
              </li>
              <label>Mantenedores</label>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url();?>index.php/Insumos/index" >
                  <span data-feather="layers"></span>
                  Insumos
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url();?>index.php/Productos/moduloproducto" >
                  <span data-feather="layers"></span>
                  Productos
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url();?>index.php/Proveedores/index" >
                  <span data-feather="layers"></span>
                  Provedores
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url();?>index.php/Ucc/index" >
                  <span data-feather="layers"></span>
                  UCC
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url();?>index.php/Sucursales/index" >
                  <span data-feather="layers"></span>
                  Sucursales
                </a>
              </li>
              <label>Configuraciones</label>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url();?>index.php/Usuarios/index" >
                  <span data-feather="settings"></span>
                  Usuarios
                </a>
              <li class="nav-item">
                <a class="nav-link" href="#" >
                  <span data-feather="settings"></span>
                  Config
                </a>
                <br><br>

              </li>
            </ul>


          </div>
        </nav>

        
      </div>
    </div>

    
    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace()
    </script>

    <!-- Graphs -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
    
  </body>
</html>