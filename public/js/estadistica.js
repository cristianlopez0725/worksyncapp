function obtenerTareasDeUsuario(usuario, tareas) {
  return tareas.filter(t => t.usuario === usuario);
}

function contarPorEstado(tareas) {
  const conteo = {};
  tareas.forEach(t => {
    conteo[t.estado] = (conteo[t.estado] || 0) + 1;
  });
  return conteo;
}

function graficarTareasPorEstado(ctx, datos) {
  new Chart(ctx, {
    type: "pie",
    data: {
      labels: Object.keys(datos),
      datasets: [{
        label: 'Cantidad de tareas',
        data: Object.values(datos),
        backgroundColor: ["#f39c12", "#3498db", "#2ecc71"]
      }]
    },
    options: {
      responsive: true
    }
  });
}

document.addEventListener("DOMContentLoaded", () => {
  const tareasDelUsuario = obtenerTareasDeUsuario(usuarioActual, tareas);
  const statusStats = contarPorEstado(tareasDelUsuario);

  const statusChart = document.getElementById("statusChart");
  graficarTareasPorEstado(statusChart, statusStats);
});