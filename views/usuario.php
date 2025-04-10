<?php

// Define la URL base de tu proyecto
define("BASE_URL", "/proyecto_pagina/views/");

// Llama al archivo de conexión
require_once("../config/conexion.php");

// Inicia la sesión si no está iniciada
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

// Verifica si el usuario está logueado
if (!isset($_SESSION["usu_id"])) {
  // Si no está logueado, redirige a 404.php
  header("Location: " . Conectar::ruta() . "views/404.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Usuario</title>

  <?php require_once("modulos/css.php"); ?>


</head>

<body class="hold-transition sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
    <?php require_once("modulos/header.php"); ?>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <a href="../index.php" class="brand-link">
        <img src="../images/logo.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Proyecto web</span>
      </a>

    <div class="sidebar">
    

      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../images/Profile-PNG-File.png" class="img-circle elevation-2" alt="User Image">
        </div>

        <div class="info">
          <p class="text-white"><?php echo  $_SESSION['usu_nom'] ." ". $_SESSION['usu_apep'] ; ?></p>
        </div>
      </div>

      
      <input type="hidden" id="usu_id" value="<?php echo $_SESSION["usu_id"];?>">

      <?php require_once("modulos/menu.php"); ?>
    </div>
  </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Usuario</h1>
            </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="card">
            <div class="card-header">
              <button class="btn btn-success btn-sm float-right" onclick="mostrarModalCrear()">
                <i class="fas fa-plus"></i> Añadir Usuario
              </button>
            </div>
            <div class="card-body">
              <table id="tablaUsuarios" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody></tbody>
              </table>
            </div>
          </div>
        </div>
      </section>

      <!-- Modal -->
      <div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalAddLabel">Agregar Usuario</h5>
            </div>
            <form>
              <input type="hidden" id="usuario_id">
              <div class="modal-body">
                <div class="form-group">
                  <label for="usuario_nombre">Nombre</label>
                  <input type="text" id="usuario_nombre" class="form-control" placeholder="Nombre">
                </div>
                <div class="form-group">
                  <label for="usuario_apep">Apellido Paterno</label>
                  <input type="text" id="usuario_apep" class="form-control" placeholder="Apellido Paterno">
                </div>
                <div class="form-group">
                  <label for="usuario_apem">Apellido Materno</label>
                  <input type="text" id="usuario_apem" class="form-control" placeholder="Apellido Materno">
                </div>
                <div class="form-group">
                  <label for="usuario_correo">Correo</label>
                  <input type="email" id="usuario_correo" class="form-control" placeholder="Correo electrónico">
                </div>
                <div class="form-group">
                  <label for="usuario_telf">Teléfono</label>
                  <input type="text" id="usuario_telf" class="form-control" placeholder="Teléfono">
                </div>
                <div class="form-group">
                  <label for="usuario_pass">Contraseña</label>
                  <input type="password" id="usuario_pass" class="form-control" placeholder="Contraseña">
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary" onclick="guardarUsuario()">Guardar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>


    <?php require_once("modulos/footer.php"); ?>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->


  <?php require_once("modulos/js.php"); ?>
  <script src="../views/js/socialMedia.js"></script>


</body>

</html>

