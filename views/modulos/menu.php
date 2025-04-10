<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<nav class="mt-2" >
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="home.php" class="nav-link">
            <i class='bx bxs-home' ></i>
              <p>
                Inicio 
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="profileUser.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Perfil Usuario
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="login.php" class="nav-link">
            <i class='bx bxs-user-detail'></i>
              <p>
                Administracion
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="socialMedia.php" class="nav-link">
            <i class='bx bxs-share-alt' ></i>
              <p>
                Social Media
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="usuario.php" class="nav-link">
            <i class='bx bxs-user'></i>
              <p>
                Usuario
              </p>
            </a>
            <li class="nav-item">
            <a href="estudios.php" class="nav-link">
            <i class='bx bxs-book-bookmark'></i>
              <p>
                Estudios 
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="experiencia.php" class="nav-link">
            <i class='bx bxs-extension' ></i>
              <p>
                Experiencia
              </p>
            </a>
          </li>
        
      
          <li class="nav-header">SALIR</li>
          <li class="nav-item">
            <form action="<?php echo 'logout.php' ?>" method="GET" style="display: inline;">
              <button type="submit" class="nav-link" style="background: none; border: none; ; cursor: pointer;">
              <i class='bx bxs-log-out' ></i>
                <p>Cerrar sesion</p>
              </button>
            </form>
          </li>
        </ul>
</nav>