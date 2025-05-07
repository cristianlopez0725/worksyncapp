function mostrarPantalla(pantalla) {
    document.getElementById("pantalla-inicial").classList.add("oculto");
    document.getElementById("pantalla-login").classList.add("oculto");
    document.getElementById("pantalla-registro").classList.add("oculto");
    document.getElementById("pantalla-recuperar").classList.add("oculto");
  
    if (pantalla === "login") {
      document.getElementById("pantalla-login").classList.remove("oculto");
    } else if (pantalla === "registro") {
      document.getElementById("pantalla-registro").classList.remove("oculto");
    } else if (pantalla === "recuperar") {
      document.getElementById("pantalla-recuperar").classList.remove("oculto");
    }
  }
  
  function volver() {
    document.getElementById("pantalla-login").classList.add("oculto");
    document.getElementById("pantalla-registro").classList.add("oculto");
    document.getElementById("pantalla-recuperar").classList.add("oculto");
    document.getElementById("pantalla-inicial").classList.remove("oculto");
  }