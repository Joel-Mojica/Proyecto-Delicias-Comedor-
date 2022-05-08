<div class="container  mt-3">

  <?php
  include_once "dbDelicias.php";

  if (isset($_POST['submitcrearCliente'])) {
    $nombre = ucwords($_POST["nombre"]);
    $apellido = ucwords($_POST["apellido"]);
    $telefono = $_POST["telefono"];
    $direccion = $_POST["direccion"];

    $con = mysqli_connect($host, $user, $passw, $database);

   $sql = "INSERT INTO `clientes`(`nombre`, `apellido`, `telefono`, `direccion`) VALUES ('" . $nombre . "','" . $apellido . "','" . $telefono . "','" . $direccion . "');";
    $res = mysqli_query($con, $sql);
    if ($res == true) {
      mysqli_close($con);

      //con este meta redirigo la pagina de porque no puedo hacerlo con header y esta forma es mas especifica
     echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=clientes&mensaje=Cliente creado exitosamente" />';

      } else {
          die("no se puedo conectar");
    }
  }

  ?>


  <div class="card card-success ml-5 w-75">
    <div class="card-header">
      <h3 class="card-title">Crear Nuevo Cliente</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="panel.php?modulo=crearCliente" method="post" class="form-horizontal">
      <div class="card-body">
        <div class="form-group row">
          <label for="inputNombre" class="col-sm-2 col-form-label">Nombre</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Nombre" name="nombre" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputApellido" class="col-sm-2 col-form-label">Apellido</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Apellido" name="apellido" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputTelefono" class="col-sm-2 col-form-label">Telefono</label>
          <div class="col-sm-10">
            <input type="number" class="form-control" placeholder="Telefono" name="telefono" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputDireccion" class="col-sm-2 col-form-label">Direccion</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Direccion" name="direccion" required>
          </div>
        </div>
      </div>
   
      <!-- /.card-body -->
      <div class="card-footer">
        <button type="submit" class="btn btn-success w-25" name="submitcrearCliente">Crear</button>
      </div>
      <!-- /.card-footer -->
    </form>
  </div>
</div>