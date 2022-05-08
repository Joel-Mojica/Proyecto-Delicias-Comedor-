<!DOCTYPE html>
<html>
 

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Delicias comendor | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>Delicias</b>COMEDOR</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      
 
      <?php 

     
   
      if(isset($_POST['submit'])){
          $email = $_POST['email']??'';
          $pass = $_POST['pass']??'';

          include_once "dbDelicias.php";
         
         $con =  mysqli_connect($host,$user,$passw,$database);

         $sql = "SELECT id, email , nombre,posicion,estado from usuarios where email='".$email."' and pass='".$pass."';";
        
         $res = mysqli_query($con,$sql);
         $row = mysqli_fetch_assoc($res);
       

         if($row){
           session_start();
           $_SESSION['id'] = $row['id'];
           $_SESSION["nombre"] = $row["nombre"];
           $_SESSION["apellido"] = $row["apellido"];
           $_SESSION["posicion"] = $row["posicion"];
           $_SESSION["estado"] = $row["estado"];

          mysqli_close($con);

          header("location:panel.php");
          
         }else{
           //mensaje de alerta por si la sesion no inicia
            $mensaje = '<div class="alert alert-danger">Usuario o Contraseña incorrecto</div>'; 

         }

      }
         
           
      ?>

    
    <p class="login-box-msg">Log in administrador</p>
    <?php 

      if(empty($mensaje)){
        $mensaje = "";
      }
  
    echo $mensaje; 
    
    ?>
      <form method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="pass">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block" name="submit">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

     
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

</body>
</html>








