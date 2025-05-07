let menu = document.querySelector('#menu-bars');
let navbar = document.querySelector('.navbar');

menu.onclick = () =>{
    menu.classList.toggle('fa-times');
    navbar.classList.toggle('active');
  }
  
  let section = document.querySelectorAll('section');
  let navLinks = document.querySelectorAll('header .navbar a');
  
  window.onscroll = () =>{

    menu.classList.remove('fa-times');
    navbar.classList.remove('active');
  
    section.forEach(sec =>{
  
      let top = window.scrollY;
      let height = sec.offsetHeight;
      let offset = sec.offsetTop - 150;
      let id = sec.getAttribute('id');
  
      if(top >= offset && top < offset + height){
        navLinks.forEach(links =>{
          links.classList.remove('active');
          document.querySelector('header .navbar a[href*='+id+']').classList.add('active');
        });
      };
  
    });
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
    
  
  }