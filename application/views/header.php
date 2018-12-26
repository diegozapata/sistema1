<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <!-- Bootstrap CSS -->


      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" >
      <link rel="stylesheet" type="text/css" media="screen" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
      <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url();?>assets/css/materialize.css" />
      <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url();?>assets/css/animate.css" />
      <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url();?>assets/css/sweetalert.css" />
      <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url();?>assets/css/menu.css" />
      <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url();?>assets/css/notificaciones.css" />  
      <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url();?>assets/css/jquery.dataTables.min.css">
      <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url();?>assets/css/tableexport.css" /> 
      <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url();?>assets/css/app.css" />
      <link rel="stylesheet" type="text/css" media="print" href="<?php echo base_url();?>assets/css/print.css" /> <link rel="stylesheet" type="text/css" media="print" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.0.3/sweetalert2.css" />   
      <link href="<?php echo base_url();?>assets/css/dashboard.css" rel="stylesheet">
      <link rel="stylesheet" href="<?php echo base_url();?>/assets/css/profile.css"/>
<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/jquery.dataTables.css"> -->
  

    <title>Bienvenido</title>
  </head>
  <body>
    <a href="#" class="navbar-left"><img src="http://portal.ucm.cl//content/uploads/2016/10/logo.png"></a>
      
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="https://code.jquery.com/jquery-3.3.1.min.js" ></script>
      <script src="<?php echo base_url();?>/assets/js/popper.min.js" ></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" ></script>
      <!-- <script type="text/javascript" charset="utf8" src="<?php echo base_url();?>/assets/js/jquery.dataTables.js"></script> -->
      <!-- <script src="<?php echo base_url();?>/assets/js/jquery.js"></script>       -->
      <!-- <script src="<?php echo base_url(); ?>/assets/js/ajax.js"></script> -->
      <script src="<?php echo base_url();?>/assets/js/materialize.js"></script>
      <script src="<?php echo base_url();?>/assets/js/sweetalert.min.js"></script>
      <script src="<?php echo base_url();?>/assets/js/smooth-scroll.js"></script>     
      <script src="<?php echo base_url();?>/assets/js/wow.min.js"></script>
      <!-- <script src="<?php echo base_url();?>/assets/js/jquery.dataTables.min.js"></script> -->
      <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
      <script src="<?php echo base_url();?>/assets/js/notif.js"></script>
      <script src="<?php echo base_url();?>/assets/js/xlsx.core.js"></script>
      <script src="<?php echo base_url();?>/assets/js/FileSaver.js"></script>
      <script src="<?php echo base_url();?>/assets/js/tableexport.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.0.3/sweetalert2.all.js"></script>
    <!-- Icons -->
      <script src="<?php echo base_url();?>/assets/js/feather.min.js"></script>
      <script src="<?php echo base_url();?>/assets/js/Chart.min.js"></script>
      <script language="JavaScript" type="text/javascript">
$(document).ready(function(){
    $("a.delete").click(function(e){
        if(!confirm('¿Está seguro que desea eliminar este elemento?')){
            e.preventDefault();
            return false;
        }
        return true;
    });
});
</script>
      <script language="JavaScript">
          function confirmar ( mensaje ) {
            return confirm( mensaje );
          } 
      </script>
      <script>
      $(document).ready(function () {
          $("#grid").DataTable({
            


          });
      });
  </script>}
  <nav class="navbar navbar-expand-lg navbar-blue fixed-top">

      <div class="container">
        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <?php if($this->session->userdata('NOMBRE')===null){?>

                <a class="nav-link" href="<?php echo base_url();?>index.php/Usuarios/iniciar_sesion" class="btn btn-default"> Iniciar Sesion</a>

              <?php } elseif($this->session->userdata()!=null){?>


              <a class="nav-link" href="<?php echo base_url();?>index.php/Usuarios/cerrar_sesion" class="btn btn-default">Cerrar Sesion
                <?php } ?>
                </a>
            


            </li>

          </ul>
        </div>
      </div>
    </nav>