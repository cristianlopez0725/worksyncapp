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
document.getElementById('save-project-btn').addEventListener('click', () => {
  const nombre = document.getElementById('project-name').value;
  const descripcion = document.getElementById('project-description').value;

  fetch('../controller/guardar_proyecto.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: `nombre=${encodeURIComponent(nombre)}&descripcion=${encodeURIComponent(descripcion)}`
  })
  .then(res => res.json())
  .then(data => {
    if (data.success) {
      alert('Proyecto guardado con éxito!');
    } else {
      alert('Error: ' + (data.error || 'No se pudo guardar'));
    }
  });
});

document.getElementById('load-project-btn').addEventListener('click', () => {
  fetch('../controller/cargar_proyecto.php')
    .then(res => res.json())
    .then(proyectos => {
      if (proyectos.error) {
        alert('Error: ' + proyectos.error);
        return;
      }

      let lista = 'Proyectos disponibles:\n';
      proyectos.forEach(p => {
        lista += `• ${p.nombre} (ID: ${p.id})\n`;
      });
      alert(lista);
    });
});
