<div class="container w-75 mr-5 mt-3">

  <?php
  include_once "dbDelicias.php";

  if (isset($_REQUEST["submit"])) {
    $id = $_POST["idCliente"];
    $cantidad = $_POST["cantidad"];
    $descripcion = $_POST["descripcion"];
     
    //establecer minutos y fecha
    $dtz = new DateTimeZone("America/Santo_Domingo");
    $hora = new DateTime("now",$dtz); 
    $fecha = $hora->format("d-m-Y");
    
    $credito = $_POST["credito"];
    

    $con = mysqli_connect($host, $user, $passw, $database);

      if($id != null){
        $sql = "SELECT * from servicios where idCliente = '" . $id . "' and estadoPago = 0;";
        $res = mysqli_query($con, $sql);

        $row = mysqli_fetch_assoc($res);
      }


      if($row['idCliente'] != null){

        $idserv = $row['idServicios'];

        //inserta nuevo registro de orden ya existente hasta que se pague ! nota: hasta que cambie el estado de pago
        $sql2 = "INSERT INTO `det_servicio`(`idservicio`, `cantidad`, `descripcion`,`fecha_pedido`,`credito`) VALUES ('" . $idserv . "','" . $cantidad . "','" . $descripcion . "','" . $fecha . "','" . $credito . "');";
        $res2 = mysqli_query($con, $sql2);

      }else{
        //crea nueva orden si no hay datos de orden abierta para el cliente seleccionado
        $sql2 = "INSERT INTO `servicios`(`idCliente`, `fecha_apertura`, `idUsuario`) VALUES ('" . $id . "','" . $fecha . "','" . $_SESSION['id'] . "');";
        $res2 = mysqli_query($con, $sql2);

        $sql3 = "SELECT idServicios FROM `servicios` WHERE idCliente = '" . $id . "' and estadoPago = 0;";
        $res3 = mysqli_query($con, $sql3);
        $row = mysqli_fetch_assoc($res3);

        $sql4 = "INSERT INTO `det_servicio`(`idservicio`, `cantidad`, `descripcion`,`fecha_pedido`,`credito`) VALUES ('" . $row['idServicios'] . "','" . $cantidad . "','" . $descripcion . "','" . $fecha . "','" . $credito . "');";
        $res4 = mysqli_query($con, $sql4);

      }


   
      if ($res2 == true) {
      mysqli_close($con);
      //con este meta redirigo la pagina de porque no puedo hacerlo con header y esta forma es mas especifica
      echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=nuevaOrden&mensaje=Orden tomada con exito" />';

      } else {
          die("no se puedo conectar");
    }
  }


  ?>


  <div class="card card-danger ">
    <div class="card-header">
      <h3 class="card-title">Tomando Orden de "<?php echo $_REQUEST['nombre'];?>"</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="panel.php?modulo=tomandoOrdenCliente" method="post" class="form-horizontal">
      <div class="card-body">
        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-2 col-form-label">Cantidad</label>
          <div class="col-sm-10">
            <input type="number" class="form-control" placeholder="Cantidad" name="cantidad" required>
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
            <input type="number" class="form-control" placeholder="Credito" name="credito" required>
          </div>
        </div>
      </div>
      <input type="number" name="idCliente" value="<?php echo $_REQUEST['id'];?>" hidden>
      <!-- /.card-body -->
      <div class="card-footer">
        <button type="submit" class="btn btn-danger" name="submit">Ordenar</button>
      </div>
      <!-- /.card-footer -->
    </form>
  </div>
</div>


<!-- /.Calculadora para ayudarse -->
<table style="text-align:center;  margin-left: 57.5%;" class="border rounded-10" >
 <tr style="text-align:center;">
 <td colspan = "4">
 <input id="resultado" type="text" value="0" size="20" style="border: 3px solid blue; padding: 10px;" /><input id="memoria" type="hidden" value="0" />
 </td>
 </tr>

 <tr style="text-align:center;">
 <td>
 <input type="button" value="7"
 onClick="var str1=document.getElementById('resultado').value; if(str1 == '0'){document.getElementById('resultado').value=7}else{ var str2='7'; var res = str1.concat(str2);document.getElementById('resultado').value=res;}"
 style="width:55px">
 </td>
 <td>
 <input type="button" value="8"
 onClick="var str1=document.getElementById('resultado').value; if(str1 == '0'){document.getElementById('resultado').value=8}else{ var str2='8'; var res = str1.concat(str2);document.getElementById('resultado').value=res;}"
 style="width:55px">
 </td>
 <td>
 <input type="button" value="9"
 onClick="var str1=document.getElementById('resultado').value; if(str1 == '0'){document.getElementById('resultado').value=9}else{ var str2='9'; var res = str1.concat(str2);document.getElementById('resultado').value=res;}"
 style="width:55px">
 </td>
 <td>
 <input type="button" value="/"
 onClick="operaciones('dividir'); return false;"
 style="width:55px">
 </td>
 </tr>

 <tr style="text-align:center;">
 <td>
 <input type="button" value="4"
 onClick="var str1=document.getElementById('resultado').value; if(str1 == '0'){document.getElementById('resultado').value=4}else{ var str2='4'; var res = str1.concat(str2);document.getElementById('resultado').value=res;}"
 style="width:55px">
 </td>
 <td>
 <input type="button" value="5"
 onClick="var str1=document.getElementById('resultado').value; if(str1 == '0'){document.getElementById('resultado').value=5}else{ var str2='5'; var res = str1.concat(str2);document.getElementById('resultado').value=res;}"
 style="width:55px">
 </td>
 <td>
 <input type="button" value="6"
 onClick="var str1=document.getElementById('resultado').value; if(str1 == '0'){document.getElementById('resultado').value=6}else{ var str2='6'; var res = str1.concat(str2);document.getElementById('resultado').value=res;}"
 style="width:55px">
 </td>
 <td>
 <input type="button" value="*"
 onClick="operaciones('multiplicar'); return false;"
 style="width:55px">
 </td>
 </tr>

 <tr style="text-align:center;">
 <td>
 <input type="button" value="1"
 onClick="var str1=document.getElementById('resultado').value; if(str1 == '0'){document.getElementById('resultado').value=1}else{ var str2='1'; var res = str1.concat(str2);document.getElementById('resultado').value=res;}"
 style="width:55px">
 </td>
 <td>
 <input type="button" value="2"
 onClick="var str1=document.getElementById('resultado').value; if(str1 == '0'){document.getElementById('resultado').value=2}else{ var str2='2'; var res = str1.concat(str2);document.getElementById('resultado').value=res;}"
 style="width:55px">
 </td>
 <td>
 <input type="button" value="3"
 onClick="var str1=document.getElementById('resultado').value; if(str1 == '0'){document.getElementById('resultado').value=3}else{ var str2='3'; var res = str1.concat(str2);document.getElementById('resultado').value=res;}"
 style="width:55px">
 </td>
 <td>
 <input type="button" value="-" 
 onClick="operaciones('restar'); return false;"
 style="width:55px">
 </td>
 </tr>

 <tr style="text-align:center;">
 <td>
 <input type="button" value="0"
 onClick="var str1=document.getElementById('resultado').value; if(str1 == '0'){document.getElementById('resultado').value=0}else{ var str2='0'; var res = str1.concat(str2);document.getElementById('resultado').value=res;}"
 style="width:55px"> 
 </td>
 <td colspan="2">
 <input type="button" value="="
 onClick="operaciones('igual'); return false;"
 style="width:110px">
 </td>
 <td>
 <input type="button" value="+"
 onClick="operaciones('sumar'); return false;"
 style="width:55px">
 </td>
 </tr>


</table>

