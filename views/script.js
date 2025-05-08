// Datos de ejemplo
const usuarios = [
    { nombre: "Camilo", tareas: [
        { texto: "Diseñar interfaz", done: true },
        { texto: "Configurar base", done: true },
        { texto: "Implementar login", done: true }
      ]
    },
    { nombre: "Cristian", tareas: [
        { texto: "Escribir tests", done: false },
        { texto: "Revisar PRs", done: false },
        { texto: "Documentar API", done: false }
      ]
    },
    { nombre: "MateoZ", tareas: [
        { texto: "Crear prototipo", done: true },
        { texto: "Feedback equipo", done: true },
        { texto: "Corregir errores", done: false }
      ]
    },
    { nombre: "MateoM", tareas: [
        { texto: "Configurar CI/CD", done: true },
        { texto: "Optimizar queries", done: true },
        { texto: "Revisar logs", done: true }
      ]
    },
    { nombre: "Clara", tareas: [
        { texto: "Analizar reqs", done: false },
        { texto: "Esquema de base", done: false },
        { texto: "Reunión stakeholders", done: true }
      ]
    },
    { nombre: "Hernando", tareas: [
        { texto: "Deploy producción", done: true },
        { texto: "Monitoreo", done: true },
        { texto: "Documentación", done: true }
      ]
    }
  ];
  
  const usersListEl = document.getElementById('users-list');
  const mainView = document.getElementById('main-view');
  const detailView = document.getElementById('detail-view');
  const backBtn = document.getElementById('back-btn');
  const detailUsername = document.getElementById('detail-username');
  const doneList = document.getElementById('done-tasks');
  const pendingList = document.getElementById('pending-tasks');
  const detailMessageEl = document.getElementById('detail-message');
  const filterCompleteBtn = document.getElementById('filter-complete');
  const filterAllBtn = document.getElementById('filter-all');
  
  function getMessage(done, total) {
    if (done === total) return "¡Excelente! Completaste todas tus tareas. 🎉";
    if (done >= total * 0.75) return "¡Muy bien! Estás cerca de la meta. 💪";
    if (done >= total * 0.5) return "¡Buen avance! Sigue así. 🚀";
    return "¡No te rindas! Cada tarea cuenta. 🌱";
  }
  
  function renderUsers(filter100 = false) {
    usersListEl.innerHTML = '';
    usuarios.forEach((u, idx) => {
      const total = u.tareas.length;
      const done = u.tareas.filter(t => t.done).length;
      if (filter100 && done < total) return;
  
      const card = document.createElement('div');
      card.className = 'user-card';
      card.dataset.index = idx;
  
      const message = getMessage(done, total);
      card.innerHTML = `
        <h2>${u.nombre}</h2>
        <div class="medals">
          ${done === total ? '<span class="medal">🏅</span>' : ''}
          ${done/total >= 0.5 ? '<span class="medal">🥈</span>' : ''}
        </div>
        <canvas class="progress-chart" id="chart-${idx}"></canvas>
        <p class="user-message">${message}</p>
      `;
      card.addEventListener('click', () => showDetail(idx));
      usersListEl.appendChild(card);
  
      const ctx = document.getElementById(`chart-${idx}`).getContext('2d');
      new Chart(ctx, {
        type: 'bar',
        data: {
          labels: ['Completadas','Pendientes'],
          datasets: [{ label: 'Tareas', data: [done, total-done], backgroundColor: ['#4caf50','#ef5350'] }]
        },
        options: { responsive: true, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true } } }
      });
    });
  }
  
  function showDetail(idx) {
    mainView.style.display = 'none';
    detailView.style.display = 'block';
    const u = usuarios[idx];
    detailUsername.textContent = u.nombre;
    doneList.innerHTML = '';
    pendingList.innerHTML = '';
    u.tareas.forEach(t => {
      const li = document.createElement('li');
      li.textContent = t.texto;
      if (t.done) doneList.appendChild(li);
      else pendingList.appendChild(li);
    });
    const done = u.tareas.filter(t => t.done).length;
    const total = u.tareas.length;
    detailMessageEl.textContent = getMessage(done, total);
  }
  
  backBtn.addEventListener('click', () => {
    detailView.style.display = 'none';
    mainView.style.display = 'block';
  });
  filterCompleteBtn.addEventListener('click', () => renderUsers(true));
  filterAllBtn.addEventListener('click', () => renderUsers(false));
  
  // Inicializar
  renderUsers();
  