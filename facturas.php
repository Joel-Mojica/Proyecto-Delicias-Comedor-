<?php
include_once "dbDelicias.php";
$conexion = mysqli_connect($host, $user, $passw, $database);

?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>HISTORICO FACTURAS</h1>
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
              <h3 class="card-title">Historico facturas realizadas a credito</h3>
            </div>
            <!-- /.card-header -->



            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Factura</th>
                    <th>Cliente</th>
                    <th>Fecha Apertura</th>
                    <th>Usuario Tomo Orden</th>
                    <th>Fecha Factura</th>

                  </tr>
                </thead>
                <tbody>

                  <?php
                  $sql = "select s.idServicios,
                                 s.idCliente,
                                 s.fecha_apertura,
                                 date_format(s.fecha_factura,'%d-%m-%Y') as fecha_factura,
                                  s.idUsuario,
                                  concat(u.nombre,' ',u.apellido)as nombre_usuario,
                                  c.nombre as nombre_cliente
                    from servicios s, clientes c, usuarios u
                    where  c.idCliente = s.idCliente
                    and s.idUsuario = u.id
                    and estadoPago = 1 
                    order by idServicios
                    desc";
                  $res = mysqli_query($conexion, $sql);

                  while ($row = mysqli_fetch_assoc($res)) {
                  ?>
                    <tr>
                      <td> <a href="pages/examples/invoice-print.php?id=<?php echo $row['idCliente']; ?>&idServicios=<?php echo $row['idServicios']; ?>" target="_blank" class="text-danger"><i class="fas fa-file-pdf ml-5" style="font-size: 30px;"></i></a>   <?php  ?></td>
                      <td> <?php echo  $row['nombre_cliente']; ?></td>
                      <td><?php echo $row['fecha_apertura']; ?></td>
                      <td><?php echo $row['nombre_usuario']; ?></td>
                      <td><?php echo $row['fecha_factura']; ?></td>
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