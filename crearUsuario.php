<div class="container w-75 mt-3">

  <?php
  include_once "dbDelicias.php";

  if (isset($_REQUEST['submit'])) {
    $nombre = ucwords($_POST["nombre"]);
    $apellido = ucwords($_POST["apellido"]);
    $email = $_POST["email"];
    $pass = $_POST["pass"];
    $telefono = $_POST["telefono"];
    $posicion = $_POST["posicion"];
    $estado = $_POST["estado"];

    $con = mysqli_connect($host, $user, $passw, $database);

   $sql = "INSERT INTO `usuarios`(`nombre`, `apellido`, `email`,`pass`, `telefono`, `posicion`,`estado`, `fecha_ingreso`) VALUES ('" .$nombre. "','" .$apellido. "','" .$email. "','" .$pass. "','" .$telefono. "','" .$posicion. "','" .$estado. "', CURRENT_DATE);";
    $res = mysqli_query($con, $sql);
    if ($res == true) {
      mysqli_close($con);

      //con este meta redirigo la pagina de porque no puedo hacerlo con header y esta forma es mas especifica
     echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=usuarios&mensaje=Usuario creado exitosamente" />';

      } else {
          die("no se puedo conectar");
    }
  }

  ?>


  <div class="card card-secondary">
    <div class="card-header">
      <h3 class="card-title">Crear Usuario</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="panel.php?modulo=crearUsuario" method="post" class="form-horizontal">
    <div class="card-body">
        <div class="form-group row">
          <label for="inputNombre3" class="col-sm-2 col-form-label">Nombre</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Nombre" name="nombre" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputApellido3" class="col-sm-2 col-form-label">Apellido</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Apellido"  name="apellido" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
          <div class="col-sm-10">
            <input type="email" class="form-control" placeholder="Email" name="email" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-2 col-form-label">Pass</label>
          <div class="col-sm-10">
            <input type="password" class="form-control" placeholder="Contraseña" name="pass" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputTelefono3" class="col-sm-2 col-form-label">Telefono</label>
          <div class="col-sm-10">
            <input type="number" class="form-control" placeholder="Telefono" name="telefono" required>
          </div>
        </div>
          <!-- Valores posicion y estado por difault -->
            <input type="text" class="form-control" value="empleado" name="posicion" hidden>
            <input type="number" class="form-control" value=1 name="estado" hidden>
        
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <button type="submit" class="btn btn-secondary" name="submit">Crear Nuevo Usuario</button>
      </div>
      <!-- /.card-footer -->
    </form>
  </div>
</div>