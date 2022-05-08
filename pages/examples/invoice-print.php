<?php
include_once "../../dbDelicias.php";
$conexion = mysqli_connect($host, $user, $passw, $database);

if(isset($_REQUEST["id"]) && isset($_REQUEST["idServicios"])){
  $idCliente = $_REQUEST["id"];
  $idServicios = $_REQUEST["idServicios"];
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Delicias | Factura Print</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 4 -->

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-12">
        <h2 class="page-header">
        <img src="../../logoDelicias.jpeg" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" style="width: 6%; margin-top: -5px;" alt="">
         Delicias Comedor.
                    <small class="float-right"><?php echo date("d/m/Y"); ?></small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  De
                  <address>
                    <strong>DELICIAS.</strong><br>
                    Ens.kenndy, C/resp 29. <br>
                    Distrito Nacional, Sto.Dom <br>
                    Tel: (809) 540 6962 <br>
                    Email: dilciayahaira88@gmail.com
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  Para
                  <address>
                  <?php 
                  $sql3 = "SELECT concat(nombre,' ',apellido)as nombre ,telefono,direccion from clientes where idCliente = '".$idCliente."'; ";
                  $res3 = mysqli_query($conexion, $sql3);
                  $row3 = mysqli_fetch_assoc($res3);
                ?>
                    <strong><?php echo $row3["nombre"] ?></strong><br>
                    <p class="w-50"><?php echo $row3["direccion"] ?><br>
                    Tel: <?php echo $row3["telefono"] ?><br>
                  </address>
                  
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
               
                <h5 class="mt-5"> <b>NO_FACT:</b> <?php echo $idServicios; ?></h5><br>
               
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>Cantidad</th>
                      <th>Descripcion</th>
                      <th>Fecha</th>
                      <th>Credito</th>
                    </tr>
                    </thead>
                    <tbody>
                    
                    <?php
                  $sql = "SELECT * from det_servicio where idservicio = '".$idServicios."' and credito != 0 ";
                  $res = mysqli_query($conexion, $sql);

                  while ($row = mysqli_fetch_assoc($res)) {
                  ?>
                    <tr>
                      <td><?php echo  $row['cantidad']; ?></td>
                      <td><?php echo $row['descripcion']; ?>
                      <td><?php echo  $row['fecha_pedido']; ?>
                      <td>RD$ <?php echo $row['credito']; ?>
                      
                    </tr>

                  <?php } ?>

                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                  <p class="lead">Metodo de Pago:</p>
                  <img src="../../dist/img/credit/visa.png" alt="Visa">
                  <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">


                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                     Transferencia y depósito.<br>Beneficiario: 
                     
                      Dilcia Yahaira Rodriguez Acosta. <br>
                   
                    Cuenta popular en pesos: 798580346.

                   <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">                    
                    Nota: Todos los clientes con crédito se les cobrará interés equivalente al impuesto actual establecido en Rep.Dom.
                  </p>
                </div>
                <!-- /.col -->
                <div class="col-6">
                  <p class="lead">Monto Adeudado</p>

                  <div class="table-responsive">
                    <table class="table">
                      <tbody><tr>
                        <th style="width:50%">Subtotal:</th>

                        <?php 
                            //sumatoria subtotal sin impuestos
                          $sql2 = "SELECT 
                                    sum(credito) as sumatoria,
                                    sum(credito)*0.18 as impuesto,
                                    sum(credito) + sum(credito)*0.18 as total
                                    from det_servicio
                                    where idservicio = '".$idServicios."'  ";

                            $res2 = mysqli_query($conexion, $sql2);
                            $row2 = mysqli_fetch_assoc($res2);
                            ?>
                        <td>RD$ <?php echo $row2["sumatoria"]; ?> </td>
                             
                      <tr>
                        <th>Interes (18.0%)</th>
                        <td>RD$ <?php echo $row2["impuesto"]; ?> </td>
                      </tr>
                      <tr>
                        <th>Envio:</th>
                        <td>RD$ 0.00</td>
                      </tr>
                      <tr>
                        <th>Total:</th>
                        <td>RD$ <?php echo $row2["total"]; ?> </td>
                      </tr>
                    </tbody></table>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->

<script type="text/javascript"> 
  window.addEventListener("load", window.print());
</script>
</body>
</html>
