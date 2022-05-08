<?php
  include_once "dbDelicias.php";

  if (isset($_REQUEST["submit"])) {
    $id = $_POST["idDetalle"];
    $cantidad = $_POST["cantidad"];
    $descripcion = $_POST["descripcion"];
    $credito = $_POST["credito"];
    
    $con = mysqli_connect($host, $user, $passw, $database);

   $sql = "UPDATE `det_servicio` set cantidad='" . $cantidad . "', descripcion='" . $descripcion . "', credito='" . $credito . "' where idDetalle = '" . $id . "';";
   $res = mysqli_query($con, $sql);
    if ($res == true) {
      mysqli_close($con);

      //con este meta redirigo la pagina, no puedo hacerlo con header y esta forma es mas especifica
      echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=servicios&mensaje=Orden Editada con exito" />';

      } else {
          die("no se puedo conectar");
    }
  }

?>

<div class="container w-50 mt-3">

    <div class="card card-warning ">
    <div class="card-header">
      <h3 class="card-title">Editar Orden de "<?php  if(isset($_REQUEST['nombre'])){echo $_REQUEST['nombre'];} ?>"</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="panel.php?modulo=editarOrdenCliente" method="post" class="form-horizontal">
      <div class="card-body">
        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-2 col-form-label">Cantidad</label>
          <div class="col-sm-10">
            <input type="number" class="form-control w-25" placeholder="Cantidad" name="cantidad" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-2 col-form-label">Descripcion</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Descripcion" name="descripcion" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-2 col-form-label">Credito</label>
          <div class="col-sm-10">
            <input type="number" class="form-control w-25" placeholder="Credito" name="credito" required>
          </div>
        </div>
      </div>
      <input type="number" name="idDetalle" value="<?php if(isset($_REQUEST['idDetalle'])){echo $_REQUEST['idDetalle'];} ?>" hidden required>
      <!-- /.card-body -->
      <div class="card-footer">
        <button type="submit" class="btn btn-warning" name="submit">Editar Orden</button>
      </div>
      <!-- /.card-footer -->
    </form>
  </div>
</div>

</div>