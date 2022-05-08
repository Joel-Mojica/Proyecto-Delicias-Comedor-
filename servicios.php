<?php
include_once "dbDelicias.php";
$conexion = mysqli_connect($host, $user, $passw, $database);
//--------------------------
//seccion para pagar una sola orden
  if (isset($_REQUEST["idPagar"])) {
  $idPagar = $_REQUEST["idPagar"];
  $query = "UPDATE `det_servicio` SET `credito`= null WHERE idDetalle  = '" . $idPagar . "'; ";
  $res2 = mysqli_query($conexion,$query);
  if ($res2 == true) {
?>
        <div class="alert alert-success alert-dismissible fade show float-right" role="alert">
              Se realizo el pago exitosamente.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
        </div>
  <?php
  } else {
  ?>
    <div class="alert alert-danger float-right " role="alert">
      Error! no se pudo realizar el pago.
    </div>
<?php
  }
}

//--------------------------------------------------
// aqui pago el total de toda la ordene, osea la factura completa
if (isset($_REQUEST["idPagarTodo"])) {
  $idPagarTodo = $_REQUEST["idPagarTodo"];
  $query = "UPDATE `servicios` SET `estadoPago`= 1, `fecha_factura` = CURRENT_DATE WHERE idCliente  = '" . $idPagarTodo . "' and estadoPago = 0; ";
  $res2 = mysqli_query($conexion,$query);
  if ($res2 == true) {
?>
        <div class="alert alert-success alert-dismissible fade show float-right" role="alert">
              Saldo de cuenta realizado exitosamente.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
        </div>
  <?php
  } else {
  ?>
    <div class="alert alert-danger float-right " role="alert">
      Error! no se pudo realizar el pago.
    </div>
<?php
  }
}

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Servicios</h1>
        </div>

      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Ordenes a Credito "Delicias Comedor"</h3>
            </div>
            <!-- /.card-header -->

            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Descripcion</th>
                    <th>Fecha</th>
                    <th>Credito</th>
                    <th>Acciones</th>

                  </tr>
                </thead>
                <tbody>

                  <?php
                  $sql = "SELECT  d.idDetalle,
                                  s.idServicios,
                                    s.idCliente,
                                    d.cantidad,
                                    d.descripcion,
                                    d.fecha_pedido,
                                    d.credito,
                                concat(c.nombre,' ',c.apellido) as nombreCompleto
                       from servicios s, clientes c , det_servicio d
                        where s.idCliente = c.idCliente
                        and s.idServicios = d.idservicio
                         and estadoPago = 0 
                         and d.credito != 0 ";

                  $res = mysqli_query($conexion, $sql);

                  while ($row = mysqli_fetch_assoc($res)) {
                  ?>
                    <tr>
                      <td><?php echo  $row['nombreCompleto']; ?></td>
                      <td><?php echo $row['cantidad']; ?>
                      <td><?php echo  $row['descripcion']; ?>
                      <td><?php echo $row['fecha_pedido']; ?>
                      <td><?php echo $row['credito']; ?>
                      <td style=" width: 17%!important;" >
     
           
            <div class="card">
              
              <div class="card-header">
                <h3 class="card-title">Detalles</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>

              <!-- /.card-body -->
              <div class="card-footer bg-white" style="display: none;">
                <ul class="nav nav-pills flex-column">
                  <li class="nav-item">
                      <span class="nav-link">
                        <a href="panel.php?modulo=detalleServicio&id=<?php echo $row['idCliente']; ?>&idServicios=<?php echo $row['idServicios']; ?>" ><button type="button" class="btn btn-block btn-outline-primary btn-sm">Factura</button></a>
                      </span>
                  </li>
                  <?php if ($_SESSION["posicion"] == "Administradora") { ?>
                  <li class="nav-item">
                      <span class="nav-link">
                        <a href="panel.php?modulo=servicios&idPagar=<?php echo $row['idDetalle']; ?>" class="pagarUnaOrden"><button type="button" class="btn btn-block btn-outline-danger btn-sm">Pagar</button></a>
                      </span>
                 
                  </li>
                    <li class="nav-item">
                        <span class="nav-link">
                          <a href="panel.php?modulo=editarOrdenCliente&idDetalle=<?php echo $row['idDetalle']; ?>&nombre=<?php echo $row['nombreCompleto']; ?>" class="editarUnaOrden"><button type="button" class="btn btn-block btn-outline-warning btn-sm">Editar</button></a>
                        </span>
                    </li>
                  <?php } ?>

                </ul>
              </div> 
            
                    </tr>

                  <?php }
                  mysqli_close($conexion); ?>
                </tbody>

              </table>
            </div>
            
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->



