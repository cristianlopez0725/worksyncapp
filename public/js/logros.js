const usuario = usuarios.find(u => u.correo === usuarioLogeado);

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
  if (done === total) return "¡Excelente! Completaste todas tus tareas.";
  if (done >= total * 0.75) return "¡Muy bien! Estás cerca de la meta.";
  if (done >= total * 0.5) return "¡Buen avance! Sigue así.";
  return "¡No te rindas! Cada tarea cuenta.";
}

// Solo mostrar las tareas del usuario logeado
function renderUser() {
  const total = usuario.tareas.length;
  const done = usuario.tareas.filter(t => t.done).length;

  const message = getMessage(done, total);

  const card = document.createElement('div');
  card.className = 'user-card';
  card.dataset.index = 0;  // Solo hay un usuario ahora

  card.innerHTML = `
    <h2>${usuario.nombre}</h2>
    <div class="medals">
      ${done === total ? '<span class="medal">🏅</span>' : ''}
      ${done/total >= 0.5 ? '<span class="medal">🥈</span>' : ''}
    </div>
    <canvas class="progress-chart" id="chart-0"></canvas>
    <p class="user-message">${message}</p>
  `;

  usersListEl.appendChild(card);

  const ctx = document.getElementById('chart-0').getContext('2d');
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Completadas','Pendientes'],
      datasets: [{ label: 'Tareas', data: [done, total-done], backgroundColor: ['#4caf50','#ef5350'] }]
    },
    options: { responsive: true, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true } } }
  });
}

function showDetail() {
  mainView.style.display = 'none';
  detailView.style.display = 'block';
  detailUsername.textContent = usuario.nombre;
  doneList.innerHTML = '';
  pendingList.innerHTML = '';
  
  usuario.tareas.forEach(t => {
    const li = document.createElement('li');
    li.textContent = t.texto;
    if (t.done) doneList.appendChild(li);
    else pendingList.appendChild(li);
  });

  const done = usuario.tareas.filter(t => t.done).length;
  const total = usuario.tareas.length;
  detailMessageEl.textContent = getMessage(done, total);
}

backBtn.addEventListener('click', () => {
  detailView.style.display = 'none';
  mainView.style.display = 'block';
});

// Inicializar
renderUser();