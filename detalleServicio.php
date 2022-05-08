<?php
include_once "dbDelicias.php";
$conexion = mysqli_connect($host, $user, $passw, $database);

if(isset($_REQUEST["id"]) && isset($_REQUEST["idServicios"])){
    $idCliente = $_REQUEST["id"];
    $idServicios = $_REQUEST["idServicios"];
}

?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Detalles de Pago</h1>
        </div>

      </div>
    </div><!-- /.container-fluid -->
 

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Factura</h3>
            </div>


            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                  <img src="logoDelicias.jpeg" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" style="width: 6%; margin-top: -5px;" alt="">
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
                    ens.Kenndy, C/resp 29. <br>
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

                 <h5 class="mt-5"> <b>Order ID:</b> <?php echo $idServicios; ?></h5><br>
               
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
                      <td><?php  echo $row['fecha_pedido']; ?>
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
                  <img src="dist/img/credit/visa.png" alt="Visa">
                  <img src="dist/img/credit/mastercard.png" alt="Mastercard">

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

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <a href="pages/examples/invoice-print.php?id=<?php echo $idCliente; ?>&idServicios=<?php echo $idServicios ?>" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                  
                  <?php if ($_SESSION["posicion"] == "Administradora") { ?>
                  <a href="panel.php?modulo=servicios&idPagarTodo=<?php echo $idCliente;  mysqli_close($conexion); ?>" class="pagarTodo">
                    <button type="button" class="btn btn-success float-right">
                      <i class="far fa-credit-card"></i> 
                        Realizar Pago
                    </button>
                  </a>
                  <?php } ?>
                  
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->


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