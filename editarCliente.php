

  <?php
  include_once "dbDelicias.php";

 $con = mysqli_connect($host, $user, $passw, $database);

  if (isset($_POST['submitEditarCliente'])) {
    $nombre = ucwords($_POST["nombre"]);
    $apellido = ucwords($_POST["apellido"]);
    $telefono = $_POST["telefono"];
    $direccion = $_POST["direccion"];

    $idCliente = $_POST["idCliente"];

   

    $sql = "UPDATE `clientes` set nombre='" . $nombre . "', apellido='" . $apellido . "', telefono='" . $telefono . "', direccion='" . $direccion . "' where idCliente = '" . $idCliente . "';";
    $res = mysqli_query($con, $sql);
    if ($res == true) {
      mysqli_close($con);

      //con este meta redirigo la pagina de porque no puedo hacerlo con header y esta forma es mas especifica
     echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=clientes&mensaje=Cliente se edito exitosamente" />';

      } else {
          die("no se puedo conectar");
    }
  }

//Trae los datos para verlos en el value del form
if (isset($_REQUEST["id"])) {
    $id = $_REQUEST['id'];
    $sql = "SELECT idCliente,nombre,apellido,telefono,direccion from clientes where idCliente = '" . $id . "' ; ";
    $res = mysqli_query($con, $sql);
    if ($res == true) {
      $row = mysqli_fetch_assoc($res);
    } else {
      echo "error";
    }
  }

  

  ?>


<div class="w-50 container mt-3">
<div class="card card-success">
    <div class="card-header">
      <h3 class="card-title">Editar Cliente</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="panel.php?modulo=editarCliente" method="post" class="form-horizontal">
      <div class="card-body">
        <div class="form-group row">
          <label for="inputNombre" class="col-sm-2 col-form-label">Nombre</label>
          <div class="col-sm-10">
            <input type="number" name="idCliente" value="<?php echo $row["idCliente"]; ?>" hidden>
            <input type="text" class="form-control" placeholder="<?php echo $row["nombre"]; ?>" name="nombre" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputApellido" class="col-sm-2 col-form-label">Apellido</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="<?php echo $row["apellido"]; ?>" name="apellido" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputTelefono" class="col-sm-2 col-form-label">Telefono</label>
          <div class="col-sm-10">
            <input type="number" class="form-control" placeholder="<?php echo $row["telefono"]; ?>" name="telefono" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputDireccion" class="col-sm-2 col-form-label">Direccion</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="<?php echo $row["direccion"]; mysqli_close($con); ?>" name="direccion" required>
          </div>
        </div>
      </div>
   
      <!-- /.card-body -->
      <div class="card-footer">
        <button type="submit" class="btn btn-success" name="submitEditarCliente">Editar</button>
      </div>
      <!-- /.card-footer -->
    </form>
  </div>
</div>
</div>