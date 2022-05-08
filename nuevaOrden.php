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
          <h1>Clientes</h1>
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
              <h3 class="card-title">Clientes "Delicias" Tomar Orden</h3>
            </div>
            <!-- /.card-header -->

            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Telefono</th>
                    <th>Direccion</th>
                    <th>Acciones</th>

                  </tr>
                </thead>
                <tbody>

                  <?php
                  $sql = "SELECT idCliente,nombre,apellido,telefono,direccion from clientes; ";
                  $res = mysqli_query($conexion, $sql);

                  while ($row = mysqli_fetch_assoc($res)) {
                  ?>
                    <tr>
                      <td><?php echo  $row['nombre']; ?></td>
                      <td><?php echo $row['apellido']; ?>
                      <td><?php echo  $row['telefono']; ?>
                      <td><?php echo $row['direccion']; ?>
                     <!--por este enlace envio el id del cliente y el nombre para hacer referencia al nombre y id-->
                      <td><a href="panel.php?modulo=tomandoOrdenCliente&id=<?php echo $row['idCliente'];?>&nombre=<?php echo $row['nombre'];?> "><button type="submit" class="btn btn-info" name="submit">Ordenar</button></a> 
                      </td>
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