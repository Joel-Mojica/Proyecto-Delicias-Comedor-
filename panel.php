<!DOCTYPE html>
<html>

<?php

 // Desactivar toda notificación de error/////////////////////////////////////////////////////
 error_reporting(0);


session_start();
if(isset($_REQUEST["sesion"]) && $_REQUEST["sesion"]=="cerrar"){
    session_destroy();
    header("location: index.php");
}
if (isset($_SESSION["id"]) == false) {
  header("location: index.php");
}

$modulo = $_REQUEST["modulo"] ?? '';
?>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Delicias | Comedor</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="panel.html" class="nav-link">Home</a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
      
      <div>

      <button class="btn btn-block btn-outline-danger" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
        Cerrar Sesion
      </button>

      <div class="collapse" id="collapseExample">
        <div class="card card-body">
          <p>Pulsa 
              <a href="panel.php?modulo=&sesion=cerrar" class="" title="cerrar session">
                <i class="fa fa-times-circle nav-icon text-red"></i>
              </a>
        </div>
      </div>



       
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
      <img src="logoDelicias.jpeg" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|} rounded-pill" style="width: 20%; margin-top: -5px;" alt="">
        <span class="brand-text font-weight-light">Delicias Comedor</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="dist/img/iconoIn.png" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block"><?php echo $_SESSION["nombre"];?></a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item has-treeview menu-open">
              <a href="#" class="nav-link active">
              <i class="fas fa-store-alt nav-icon"></i>
                <p>
                  Mostrar/Ocultar Menu
                  <i class="far fa-shopping-cart nav-icon"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="panel.php?modulo=estadistica" class="nav-link <?php echo ($modulo == "estadistica" || $modulo == "") ? 'active' : ''; ?> ">
                    <i class="fa fa-chart-bar nav-icon"></i>
                    <p>Estadistica</p>
                  </a>
                </li>

              <?php 
               if ($_SESSION["posicion"] == "Administradora") {
              ?>
                      <li class="nav-item">
                        <a href="panel.php?modulo=usuarios" class="nav-link <?php echo ($modulo == "usuarios" || $modulo == "crearUsuario") ? 'active' : ''; ?> ">
                          <i class="fa fa-user nav-icon"></i>
                          <p>Usuarios</p>
                        </a>
                      </li>
                <?php  } ?>

                <li class="nav-item">
                  <a href="panel.php?modulo=productos" class="nav-link <?php echo ($modulo == "productos") ? 'active' : ''; ?> ">
                    <i class="fa fa-shopping-bag nav-icon"></i>
                    <p>Productos</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="panel.php?modulo=clientes" class="nav-link <?php echo ($modulo == "clientes") ? 'active' : ''; ?> ">
                    <i class="fa fa-users nav-icon"></i>
                    <p>Clientes</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="panel.php?modulo=servicios" class="nav-link <?php echo ($modulo == "servicios") ? 'active' : ''; ?> ">
                  <i class="fa fa-shopping-cart nav-icon"></i>
                    <p>Servicios</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="panel.php?modulo=facturas" class="nav-link <?php echo ($modulo == "facturas") ? 'active' : ''; ?>">
                    <i class="fas fa-file-invoice nav-icon"></i>
                    <p>Facturas</p>
                  </a>
                </li>
              </ul>
            </li>


            <!-- /aqui se divide el slidebar de el cuerpo -->

          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <?php

    //recibo un mensaje desde crearusuario para mostrarse en panel usuarios si todo funciona me envia el mensaje de creado exitosamente
    if (isset($_REQUEST['mensaje'])) {



    ?>
     <div class="alert alert-primary alert-dismissible fade show float-right" role="alert">
               <?php echo $_REQUEST["mensaje"] ?>   
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
        </div>
    <?php
    }  

    /*Hago un efecto angular al cargar solo el lado derecho de la pagina con este metodo prestado
    cree la variable modulo en la linea 10 que envia el nombre de la pagina que se cliquea en el link 
    y asi saber cual pagina traer con include_once
    */
    if ($modulo == "estadistica" || $modulo == "") {
      include_once "estadistica.php";
    }
    if ($modulo == "usuarios") {
      include_once "usuarios.php";
    }
    if ($modulo == "productos") {
      include_once "productos.php";
    }
    if ($modulo == "facturas") {
      include_once "facturas.php";
    }
    if ($modulo == "crearUsuario") {
      include_once "crearUsuario.php";
    }
    if ($modulo == "editarUsuario") {
      include_once "editarUsuario.php";
    }
    if ($modulo == "clientes"){
      include_once "clientes.php";
    }
    if ($modulo == "crearCliente"){
      include_once "crearCliente.php";
    }
    if ($modulo == "editarCliente"){
      include_once "editarCliente.php";
    }
    if ($modulo == "servicios"){
      include_once "servicios.php";
    }
    if ($modulo == "nuevaOrden"){
      include_once "nuevaOrden.php";
    }
    if ($modulo == "tomandoOrdenCliente"){
      include_once "tomandoOrdenCliente.php";
    }
    if ($modulo == "editarOrdenCliente"){
      include_once "editarOrdenCliente.php";
    }
    if ($modulo == "detalleServicio"){
      include_once "detalleServicio.php";
    }

   


    ?>


    <footer class="main-footer">
      <strong>Copyright &copy; 2019-2021 <a href="#">DeliciasComedor</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 2.0.0
      </div>
    </footer>


  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="plugins/moment/moment.min.js"></script>
  <script src="plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="dist/js/pages/dashboard.js"></script>
  <!-- AdminLTE for demo purposes -->
  <!-- DataTables -->
  <script src="plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

  <script src="calcula.js"></script>
  <script>
    //script para datatable
    $(function() {
      $("#example1").DataTable({
        "responsive": true,
        "autoWidth": false,
      });
    });
  </script>

  <script>
    //alerta de borrar ususario.
    $(document).ready(function() {
      $(".borrar").click(function(e) {
        e.preventDefault();
        var res = confirm("Estas seguro que quieres borrarlo?");
        if (res == true) {
          var link = $(this).attr("href");
          window.location = link;
        }
      });
    });
    
    //alerta pagar una sola orden
    $(document).ready(function() {
      $(".pagarUnaOrden").click(function(e) {
        e.preventDefault();
        var res = confirm("Estas seguro que quieres pagar esta orden?");
        if (res == true) {
          var link = $(this).attr("href");
          window.location = link;
        }
      });
    });

    $(document).ready(function() {
      $(".pagarTodo").click(function(e) {
        e.preventDefault();
        var res = confirm("Desea saldar la cuenta?");
        if (res == true) {
          var link = $(this).attr("href");
          window.location = link;
        }
      });
    });
  </script>

</body>

</html>