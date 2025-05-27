document.addEventListener('DOMContentLoaded', () => {
  const saveBtn = document.getElementById('save-project-btn');

  saveBtn.addEventListener('click', () => {
    const nombre = document.getElementById('project-name').value.trim();
    const descripcion = document.getElementById('project-description').value.trim();

    if (!nombre) {
      alert('Por favor, ingresa un nombre para el proyecto.');
      return;
    }

    const formData = new FormData();
    formData.append('nombre', nombre);
    formData.append('descripcion', descripcion);

    fetch('../controller/guardar_proyecto.php', {
      method: 'POST',
      body: formData
    })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        alert('Proyecto guardado correctamente');
        document.getElementById('project-name').value = '';
        document.getElementById('project-description').value = '';
      } else {
        alert('Error: ' + data.message);
      }
    })
    .catch(error => {
      console.error('Error:', error);
      alert('Error de red o del servidor.');
    });
  });
});
document.getElementById("load-project-btn").addEventListener("click", function () {
  fetch("../backend/listar_proyectos.php")
    .then(response => response.json())
    .then(data => {
      const lista = document.getElementById("lista-proyectos");
      lista.innerHTML = "";

      if (data.length === 0) {
        lista.innerHTML = "<p>No tienes proyectos guardados.</p>";
      } else {
        data.forEach(proyecto => {
          const item = document.createElement("div");
          item.className = "proyecto-item p-2 border rounded mb-2";
          item.innerHTML = `
            <strong>${proyecto.titulo}</strong>
            <p>${proyecto.descripcion}</p>
            <button class="btn btn-sm btn-primary" onclick="cargarProyecto(${proyecto.id})">Cargar</button>
          `;
          lista.appendChild(item);
        });
      }

      const modal = new bootstrap.Modal(document.getElementById('modalCargarProyectos'));
      modal.show();
    });
});

function cargarProyecto(id) {
  fetch(`../backend/cargar_proyecto_id.php?id=${id}`)
    .then(response => response.json())
    .then(data => {
      if (data.exito) {
        document.getElementById("project-name").value = data.titulo;
        document.getElementById("project-description").value = data.descripcion;
        bootstrap.Modal.getInstance(document.getElementById('modalCargarProyectos')).hide();
      } else {
        alert("Error al cargar el proyecto.");
      }
    });
}
