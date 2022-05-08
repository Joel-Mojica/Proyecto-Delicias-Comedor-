<div class="container w-50 mt-3">

  <?php
  include_once "dbDelicias.php";
  $con = mysqli_connect($host, $user, $passw, $database);

//Despues de submit(guardar) edita los datos
  if (isset($_REQUEST['submit'])) {
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $email = $_POST["email"];
    $pass = $_POST["pass"];
    $telefono = $_POST["telefono"];
    $posicion = $_POST["posicion"];
    
    $idUsuarios = $_POST["id"];

     $sql = "UPDATE `usuarios` set email='" . $email . "', pass='" . $pass . "', nombre='" . $nombre . "', apellido='" . $apellido . "', telefono = '" . $telefono . "', posicion='" . $posicion . "' where id = '" . $idUsuarios . "';";
     $res = mysqli_query($con, $sql);
      if ($res == true) {

      //con este meta redirigo la pagina de porque no puedo hacerlo con header y esta forma es mas especifica
      echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=usuarios&mensaje=Usuario ' . $nombre . ' editado exitosamente" />';

    } else {
      die("no se puedo conectar");
    }
  }


  //Trae los datos para verlos en el value del form
  if (isset($_REQUEST["id"])) {
    $id = $_REQUEST['id'];
    $sql = "SELECT id,nombre,apellido,email,pass,telefono,posicion from usuarios where id = '" . $id . "' ; ";
    $res = mysqli_query($con, $sql);
    if ($res == true) {
      $row = mysqli_fetch_assoc($res);
    } else {
      echo "error";
    }
  }

  mysqli_close($con);

  ?>


  <div class="card card-secondary ">
    <div class="card-header">
      <h3 class="card-title">Editar Usuario</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="panel.php?modulo=editarUsuario" method="post" class="form-horizontal">
      <div class="card-body">
        <div class="form-group row">
          <label for="inputNombre3" class="col-sm-2 col-form-label">Nombre</label>
          <div class="col-sm-10">
            <input type="hidden" name="id" value="<?php echo $row["id"]; ?>" >
            <input type="text" class="form-control" placeholder="<?php echo $row["nombre"]; ?>" name="nombre" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputApellido3" class="col-sm-2 col-form-label">Apellido</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="<?php echo $row["apellido"]; ?>"  name="apellido" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
          <div class="col-sm-10">
            <input type="email" class="form-control" placeholder="<?php echo $row["email"]; ?>" name="email" required>
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
            <input type="number" class="form-control" placeholder="<?php echo $row["telefono"]; ?>" name="telefono" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPosicion3" class="col-sm-2 col-form-label">Posicion</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="<?php echo $row["posicion"]; ?>" name="posicion" required>
          </div>
        </div>
   
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <button type="submit" class="btn btn-secondary" name="submit">Editar</button>
      </div>
      <!-- /.card-footer -->
    </form>
  </div>
</div>