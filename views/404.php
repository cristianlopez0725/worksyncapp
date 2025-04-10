<?php
define("BASE_PATH", "/pagina/views/"); 
require_once("../config/conexion.php"); 

if (isset($_SESSION["usu_id"])) {

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> 404 Page not found</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="../public/plugins/fontawesome-free/css/all.min.css">
¿  <link rel="stylesheet" href="../public/dist/css/adminlte.css">
</head>
<body class="hold-transition sidebar-mini">
<section class="content">
      <div class="error-page">
        <h2 class="headline text-warning"> 404</h2>

        <div class="error-content">
          <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Page not found.</h3>

          <p>
            Comprueba si la conexion es correcta <a href="login.php">return to login</a> .
          </p>

          
        </div>
      
      </div>
    </section>


<script src="../public/plugins/jquery/jquery.min.js"></script>
<script src="../public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../public/dist/js/adminlte.min.js"></script>

</body>
</html>
