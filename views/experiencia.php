<?php

// Define la URL base de tu proyecto
if (!defined("BASE_URL")) {
  define("BASE_URL", "/PaginaHZ/views/");
}

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
  <title>Experiencia</title>

  <?php require_once("modulos/css.php"); ?>
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
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

    <div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Experiencia</h1>
            </div>
          </div>
        </div>
      </section>

      <section class="content">
        <div class="container-fluid">
          <div class="card">
            <div class="card-header">
              <button class="btn btn-success btn-sm float-right" onclick="mostrarModalCrear()">
                <i class="fas fa-plus"></i> Agregar Experiencia
              </button>
            </div>
            <div class="card-body">
              <table id="tablaExperiencia" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Empresa</th>
                    <th>Puesto</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
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
              <h5 class="modal-title" id="modalAddLabel">Agregar Experiencia</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form>
              <input type="hidden" id="experiencia_id">
              <div class="modal-body">
                <div class="form-group">
                  <label for="experiencia_empresa">Empresa</label>
                  <input type="text" id="experiencia_empresa" class="form-control" placeholder="Nombre de la Empresa">
                </div>
                <div class="form-group">
                  <label for="experiencia_puesto">Puesto</label>
                  <input type="text" id="experiencia_puesto" class="form-control" placeholder="Puesto Ocupado">
                </div>
                <div class="form-group">
                  <label for="experiencia_fecha_inicio">Fecha Inicio</label>
                  <input type="date" id="experiencia_fecha_inicio" class="form-control">
                </div>
                <div class="form-group">
                  <label for="experiencia_fecha_fin">Fecha Fin</label>
                  <input type="date" id="experiencia_fecha_fin" class="form-control">
                </div>
                <div class="form-group">
                  <label for="experiencia_descripcion">Descripción</label>
                  <textarea id="experiencia_descripcion" class="form-control" rows="3" placeholder="Descripción de las responsabilidades"></textarea>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary" onclick="guardarExperiencia()">Guardar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <?php require_once("modulos/footer.php"); ?>
  </div>

  <?php require_once("modulos/js.php"); ?>
  <script src="../views/js/experiencia.js"></script>
</body>

</html>
