
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Menu Principal</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">


            <?php 
            include_once "dbDelicias.php";
            $con = mysqli_connect($host,$user,$passw,$database);
              $sql = "select COUNT(idCliente)as cantidad from clientes"; 
                $res = mysqli_query($con,$sql);
                  $row = mysqli_fetch_assoc($res);
                  //sentencia para ver el numero de clientes que tenemos
            ?>

              <h3>Clientes: <?php echo $row["cantidad"]; ?></h3>

              <p style="font-size: 30px;">Nueva Orden</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="panel.php?modulo=nuevaOrden" class="small-box-footer">Tomar Orden <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">

            <?php 
            include_once "dbDelicias.php";
            $con = mysqli_connect($host,$user,$passw,$database);
              $sql = "SELECT sum(d.credito) as pagadoHoy FROM `servicios` s, det_servicio d WHERE s.idServicios = d.idservicio and estadoPago = 1 and fecha_factura = CURRENT_DATE;"; 
                $res = mysqli_query($con,$sql);
                  $row = mysqli_fetch_assoc($res);
            ?>

              <h3 class="mb-3">Pagado Hoy: </h3>

              <p style="font-size: 32px;"> <?php echo 'RD$ '.$row["pagadoHoy"].'.00'; ?></p>
            </div>
            <div class="icon">
              <i class="fas fa-coins"></i>  
            </div>

          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">

            <?php 
            include_once "dbDelicias.php";
            $con = mysqli_connect($host,$user,$passw,$database);
              $sql2 = "SELECT SUM(d.credito) as totalCredito
              FROM servicios s, det_servicio d
                where s.idServicios = d.idservicio
                and s.estadoPago = 0
                AND d.credito != 0"; 
                $res2 = mysqli_query($con,$sql2);
                  $row2 = mysqli_fetch_assoc($res2);
                  //sentencia para ver el numero de clientes que tenemos
            ?>

              <h3 class="text-white mb-3">Total Credito: </h3>
              
              <p class="text-white" style="font-size: 32px;"><?php echo  'RD$ '.$row2["totalCredito"].'.00'; ?> </p>  
              
              <div class="icon">
              <i class="fas fa-money-bill-alt" ></i>
            </div>
              
            </div>
          
          </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              
            <?php 
            include_once "dbDelicias.php";
            $con = mysqli_connect($host,$user,$passw,$database);
              $sql3 = "select COUNT(*) as cantidadFacturas from servicios where estadoPago = 1"; 
                $res3 = mysqli_query($con,$sql3);
                  $row3 = mysqli_fetch_assoc($res3);
                  //sentencia para ver el numero de clientes que tenemos
            ?>

              <h3>Hist Facturas: </h3> <p style="font-size: 32px;"><?php echo $row3["cantidadFacturas"]; ?> FACT. </p>

              <?php mysqli_close($con); ?>
            </div>

            <div class="icon">
            <i class="fas fa-file-invoice-dollar"></i>
            </div>

            <a href="panel.php?modulo=facturas" class="small-box-footer p-1">Ver Facturas <i class="fas fa-arrow-circle-right"></i></a>

          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->




      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">
     
          
           <!-- Calendar -->
           <div class="card bg-gradient-success">
            <div class="card-header border-0">

              <h3 class="card-title">
                <i class="far fa-calendar-alt"></i>
                Calendar
              </h3>
              <!-- tools card -->
              <div class="card-tools">
                <!-- button with a dropdown -->
                <div class="btn-group">
                  <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52">
                    <i class="fas fa-bars"></i></button>
                  <div class="dropdown-menu" role="menu">
                    <a href="#" class="dropdown-item">Add new event</a>
                    <a href="#" class="dropdown-item">Clear events</a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">View calendar</a>
                  </div>
                </div>
                <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
              <!-- /. tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body pt-0">
              <!--The calendar -->
              <div id="calendar" style="width: 100%"></div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.calendar -->





          


          <!-- TO DO List -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">
                <i class="ion ion-clipboard mr-1"></i>
                To Do List
              </h3>

              <div class="card-tools">
                <ul class="pagination pagination-sm">
                  <li class="page-item"><a href="#" class="page-link">&laquo;</a></li>
                  <li class="page-item"><a href="#" class="page-link">1</a></li>
                  <li class="page-item"><a href="#" class="page-link">2</a></li>
                  <li class="page-item"><a href="#" class="page-link">3</a></li>
                  <li class="page-item"><a href="#" class="page-link">&raquo;</a></li>
                </ul>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <ul class="todo-list" data-widget="todo-list">
                <li>
                  <!-- drag handle -->
                  <span class="handle">
                    <i class="fas fa-ellipsis-v"></i>
                    <i class="fas fa-ellipsis-v"></i>
                  </span>
                  <!-- checkbox -->
                  <div  class="icheck-primary d-inline ml-2">
                    <input type="checkbox" value="" name="todo1" id="todoCheck1">
                    <label for="todoCheck1"></label>
                  </div>
                  <!-- todo text -->
                  <span class="text">Organizar el area de trabajo</span>
                  <!-- Emphasis label -->
                  <small class="badge badge-danger"><i class="far fa-clock"></i> 2 mins</small>
                  <!-- General tools such as edit or delete-->
                  <div class="tools">
                    <i class="fas fa-edit"></i>
                    <i class="fas fa-trash-o"></i>
                  </div>
                </li>
                <li>
                  <span class="handle">
                    <i class="fas fa-ellipsis-v"></i>
                    <i class="fas fa-ellipsis-v"></i>
                  </span>
                  <div  class="icheck-primary d-inline ml-2">
                    <input type="checkbox" value="" name="todo2" id="todoCheck2" checked>
                    <label for="todoCheck2"></label>
                  </div>
                  <span class="text">Sacar la mesa y pasar un trapo</span>
                  <small class="badge badge-info"><i class="far fa-clock"></i> 4 mins</small>
                  <div class="tools">
                    <i class="fas fa-edit"></i>
                    <i class="fas fa-trash-o"></i>
                  </div>
                </li>
                <li>
                  <span class="handle">
                    <i class="fas fa-ellipsis-v"></i>
                    <i class="fas fa-ellipsis-v"></i>
                  </span>
                  <div  class="icheck-primary d-inline ml-2">
                    <input type="checkbox" value="" name="todo3" id="todoCheck3">
                    <label for="todoCheck3"></label>
                  </div>
                  <span class="text">Poner servilletas en la sala y envolver cubiertos y cuchara</span>
                  <small class="badge badge-warning"><i class="far fa-clock"></i> 6 mins</small>
                  <div class="tools">
                    <i class="fas fa-edit"></i>
                    <i class="fas fa-trash-o"></i>
                  </div>
                </li>
                <li>
                  <span class="handle">
                    <i class="fas fa-ellipsis-v"></i>
                    <i class="fas fa-ellipsis-v"></i>
                  </span>
                  <div  class="icheck-primary d-inline ml-2">
                    <input type="checkbox" value="" name="todo4" id="todoCheck4">
                    <label for="todoCheck4"></label>
                  </div>
                  <span class="text">No salir del area de trabajo sin dejar relevo</span>
                  <small class="badge badge-success"><i class="far fa-clock"></i> 3 mins</small>
                  <div class="tools">
                    <i class="fas fa-edit"></i>
                    <i class="fas fa-trash-o"></i>
                  </div>
                </li>
                <li>
                  <span class="handle">
                    <i class="fas fa-ellipsis-v"></i>
                    <i class="fas fa-ellipsis-v"></i>
                  </span>
                  <div  class="icheck-primary d-inline ml-2">
                    <input type="checkbox" value="" name="todo5" id="todoCheck5">
                    <label for="todoCheck5"></label>
                  </div>
                  <span class="text">Pedir ayuda y usar calculadora si es necesario</span>
                  <small class="badge badge-primary"><i class="far fa-clock"></i> 1 mins</small>
                  <div class="tools">
                    <i class="fas fa-edit"></i>
                    <i class="fas fa-trash-o"></i>
                  </div>
                </li>
                <li>
                  <span class="handle">
                    <i class="fas fa-ellipsis-v"></i>
                    <i class="fas fa-ellipsis-v"></i>
                  </span>
                  <div  class="icheck-primary d-inline ml-2">
                    <input type="checkbox" value="" name="todo6" id="todoCheck6">
                    <label for="todoCheck6"></label>
                  </div>
                  <span class="text">Vender toda la mercancia "Meta del dia"</span>
                  <small class="badge badge-secondary"><i class="far fa-clock"></i> 4 mins</small>
                  <div class="tools">
                    <i class="fas fa-edit"></i>
                    <i class="fas fa-trash-o"></i>
                  </div>
                </li>
              </ul>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
              <button type="button" class="btn btn-info float-right"><i class="fas fa-plus"></i> Add item</button>
            </div>
          </div>
          <!-- /.card -->
        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 connectedSortable">

          <!-- Map card -->
          <div class="card bg-gradient-primary">
            <div class="card-header border-0">
              <h3 class="card-title">
                <i class="fas fa-map-marker-alt mr-1"></i>
                Visitors
              </h3>
              <!-- card tools -->
              <div class="card-tools">
                <button type="button"
                        class="btn btn-primary btn-sm daterange"
                        data-toggle="tooltip"
                        title="Date range">
                  <i class="far fa-calendar-alt"></i>
                </button>
                <button type="button"
                        class="btn btn-primary btn-sm"
                        data-card-widget="collapse"
                        data-toggle="tooltip"
                        title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
              <!-- /.card-tools -->
            </div>
            <div class="card-body">
              <div id="" style="height: 250px; width: 100%;"></div>
            </div>
            <!-- /.card-body-->
            <div class="card-footer bg-transparent">
              <div class="row">
                <div class="col-4 text-center">
                  <div id="sparkline-1"></div>
                  <div class="text-white">Visitors</div>
                </div>
                <!-- ./col -->
                <div class="col-4 text-center">
                  <div id="sparkline-2"></div>
                  <div class="text-white">Online</div>
                </div>
                <!-- ./col -->
                <div class="col-4 text-center">
                  <div id="sparkline-3"></div>
                  <div class="text-white">Sales</div>
                </div>
                <!-- ./col -->
              </div>
              <!-- /.row -->
            </div>
          </div>
          <!-- /.card -->

 
 
        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
