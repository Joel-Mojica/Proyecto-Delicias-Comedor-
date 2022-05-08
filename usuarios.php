<?php
include_once "dbDelicias.php";
$conexion = mysqli_connect($host, $user, $passw, $database);

  if (isset($_REQUEST["idBorrar"])) {
  $id = $_REQUEST["idBorrar"];
  $query = "UPDATE `usuarios` SET `estado`= 0, `fecha_salida` = CURRENT_DATE WHERE id =  '" . $id . "'; ";
  $res = mysqli_query($conexion,$query);
  if ($res == true) {
?>
    <div class="alert alert-warning alert-dismissible fade show float-right" role="alert">
              Usuario borrado exitosamente.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
        </div>
  <?php
  } else {
  ?>
    <div class="alert alert-danger float-right " role="alert">
      Error! no se ha borrado el usuario.
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
          <h1>Usuarios</h1>
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
              <h3 class="card-title">Control de usuarios de "Delicias Comedor"</h3>
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
                    <th>Email</th>
                    <th>Posicion</th>
                    <th>Fecha Ingreso</th>
                    <th>Acciones<a href="panel.php?modulo=crearUsuario"><i class="far fa-user ml-3"></i></a> </th>

                  </tr>
                </thead>
                <tbody>

                  <?php
                  $sql = "SELECT id,nombre,apellido,telefono,email,posicion, date_format(fecha_ingreso,'%d-%m-%Y') as fecha_ingreso from usuarios where estado = 1 ; ";
                  $res = mysqli_query($conexion, $sql);

                  while ($row = mysqli_fetch_assoc($res)) {
                  ?>
                    <tr>
                      <td><?php echo  $row['nombre']; ?></td>
                      <td><?php echo $row['apellido']; ?>
                      <td><?php echo  $row['telefono']; ?>
                      <td><?php echo $row['email']; ?>
                      <td><?php echo $row['posicion']; ?>
                      <td><?php echo $row['fecha_ingreso']; ?>
                      <td><a href="panel.php?modulo=editarUsuario&id=<?php echo $row['id']; ?> "><i class="fa fa-edit text-blue "></i></a> 
                          <a href="panel.php?modulo=usuarios&idBorrar=<?php echo $row['id']; ?> " class="text-danger borrar"><i class="fa fa-trash text-red ml-3"></i></a>
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






