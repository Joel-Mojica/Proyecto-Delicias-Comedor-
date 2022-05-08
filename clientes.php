<?php
include_once "dbDelicias.php";
$conexion = mysqli_connect($host, $user, $passw, $database);

//este if es para borrar contenido mediante id
  if (isset($_REQUEST["idBorrar"])) {
  $id = $_REQUEST["idBorrar"];
  $query = "DELETE from clientes where idCliente = '" . $id . "'; ";
  $res = mysqli_query($conexion,$query);
  if ($res == true) {
?>
    <div class="alert alert-danger alert-dismissible fade show float-right" role="alert">
              Cliente borrado con exito.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
        </div>

  <?php
  } else {
  ?>
    <div class="alert alert-danger float-right " role="alert">
      Error! no se ha borrado el cliente.
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
              <h3 class="card-title">Clientes "Delicias Comedor"</h3>
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
                    <th>Acciones<a href="panel.php?modulo=crearCliente"><i class="far fa-user ml-3"></i></a> </th>

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
                     
                      <td><a href="panel.php?modulo=editarCliente&id=<?php echo $row['idCliente']; ?>"><i class="fa fa-edit text-blue"></i></a> 

                      <?php if ($_SESSION["posicion"] == "Administradora") { ?>
                          <a href="panel.php?modulo=clientes&idBorrar=<?php echo $row['idCliente']; ?>" class="text-danger borrar"><i class="fa fa-trash text-red ml-3"></i></a>
                      <?php } ?>
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