<?php

define("BASE_PATH", "/worksync/views/"); 
require_once("../config/conexion_worksync.php"); 
    if (isset($_SESSION["id"])) {
    
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>404 - Página no encontrada</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="../public/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="../public/dist/css/adminlte.css">
</head>
<body class="hold-transition sidebar-mini">
<section class="content">
    <div class="error-page">
        <h2 class="headline text-warning">404</h2>

        <div class="error-content">
            <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Página no encontrada.</h3>

            <p>
                Parece que no podemos encontrar lo que buscas. Regresa a la <a href="index.php">pantalla de inicio</a>.
            </p>
        </div>
    </div>
</section>

<script src="../public/plugins/jquery/jquery.min.js"></script>
<script src="../public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../public/dist/js/adminlte.min.js"></script>
</body>
</html>
