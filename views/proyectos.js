let proyectos = JSON.parse(localStorage.getItem('proyectos')) || [];
let proyectoActivo = null;

document.getElementById('crearProyecto').addEventListener('click', () => {
  const nombre = document.getElementById('nuevoProyecto').value.trim();
  if (!nombre) return alert('Ingresa un nombre para el proyecto');
  proyectos.push({ nombre, listas: [] });
  guardarLocal();
  document.getElementById('nuevoProyecto').value = '';
  cargarProyectos();
});

function cargarProyectos() {
  const lista = document.getElementById('listaProyectos');
  lista.innerHTML = '';
  proyectos.forEach((proyecto, index) => {
    const li = document.createElement('li');
    li.className = 'list-group-item d-flex justify-content-between align-items-center';

    const spanNombre = document.createElement('span');
    spanNombre.textContent = proyecto.nombre;

    const divBotones = document.createElement('div');

    const btnAbrir = document.createElement('button');
    btnAbrir.className = 'btn btn-sm btn-outline-secondary me-2';
    btnAbrir.textContent = 'Abrir';
    btnAbrir.onclick = () => abrirProyecto(index);

    const btnEliminar = document.createElement('button');
    btnEliminar.className = 'btn btn-sm btn-outline-danger';
    btnEliminar.title = 'Eliminar proyecto';
    btnEliminar.innerHTML = '🗑️';
    btnEliminar.onclick = () => {
      if (confirm(`¿Seguro que quieres eliminar el proyecto "${proyecto.nombre}"?`)) {
        proyectos.splice(index, 1);
        guardarLocal();
        cargarProyectos();
      }
    };

    divBotones.appendChild(btnAbrir);
    divBotones.appendChild(btnEliminar);

    li.appendChild(spanNombre);
    li.appendChild(divBotones);
    lista.appendChild(li);
  });
}

function abrirProyecto(index) {
  proyectoActivo = index;
  document.getElementById('pantallaInicio').classList.add('d-none');
  document.getElementById('tablero').classList.remove('d-none');
  document.getElementById('nombreProyecto').textContent = proyectos[index].nombre;
  cargarListas();
}

function volverInicio() {
  proyectoActivo = null;
  document.getElementById('pantallaInicio').classList.remove('d-none');
  document.getElementById('tablero').classList.add('d-none');
  cerrarPanelTarea();
}

function agregarLista() {
  const titulo = prompt('Nombre de la lista:');
  if (!titulo) return;
  proyectos[proyectoActivo].listas.push({ titulo, tareas: [] });
  guardarLocal();
  cargarListas();
}

function agregarTarea(indexLista) {
  const tareaTitulo = prompt('Nombre de la tarea:');
  if (!tareaTitulo) return;
  const nuevaTarea = {
    titulo: tareaTitulo,
    descripcion: '',
    etiquetas: [],
    miembros: [],
    portada: null,
    fechas: { inicio: null, vencimiento: null }
  };
  proyectos[proyectoActivo].listas[indexLista].tareas.push(nuevaTarea);
  guardarLocal();
  cargarListas();
}

function cargarListas() {
  const container = document.getElementById('listasContainer');
  container.innerHTML = '';
  const listas = proyectos[proyectoActivo].listas;
  listas.forEach((lista, i) => {
    const divLista = document.createElement('div');
    divLista.className = 'list';
    divLista.dataset.listaIndex = i;
    divLista.innerHTML = `
      <h5 contenteditable="true" onblur="editarTituloLista(${i}, this.innerText)">${lista.titulo}</h5>
      <ul class="list-group tareas-lista" id="lista-${i}" data-lista-index="${i}"></ul>
      <button class="btn btn-sm btn-outline-primary mt-2" onclick="agregarTarea(${i})">+ Añadir tarea</button>
    `;
    container.appendChild(divLista);

    const ul = divLista.querySelector('ul');
    ul.innerHTML = '';
    lista.tareas.forEach((tarea, j) => {
      const li = document.createElement('li');
      li.className = 'list-group-item';
      li.draggable = true;
      li.dataset.listaIndex = i;
      li.dataset.tareaIndex = j;
      li.innerHTML = `<span>${tarea.titulo}</span>`;
      li.addEventListener('click', () => abrirPanelTarea(i, j));
      li.addEventListener('dragstart', dragStart);
      li.addEventListener('dragend', dragEnd);
      ul.appendChild(li);
    });

    ul.addEventListener('dragover', dragOver);
    ul.addEventListener('dragleave', dragLeave);
    ul.addEventListener('drop', drop);
  });
}

function editarTituloLista(i, nuevoTitulo) {
  proyectos[proyectoActivo].listas[i].titulo = nuevoTitulo.trim() || proyectos[proyectoActivo].listas[i].titulo;
  guardarLocal();
}

function guardarLocal() {
  localStorage.setItem('proyectos', JSON.stringify(proyectos));
}

// PANEL LATERAL TAREA
const panel = document.getElementById('panelTarea');
const etiquetasContainer = document.getElementById('etiquetasContainer');
const selectorColores = document.getElementById('selectorColores');
const btnAgregarEtiqueta = document.getElementById('btnAgregarEtiqueta');
const btnCerrarSelector = document.getElementById('btnCerrarSelector');

let tareaActual = null;
let listaActual = null;
let etiquetaSeleccionada = null;

function abrirPanelTarea(iLista, iTarea) {
  listaActual = iLista;
  tareaActual = iTarea;
  panel.classList.remove('d-none');

  const tarea = proyectos[proyectoActivo].listas[iLista].tareas[iTarea];

  document.getElementById('tituloTarea').value = tarea.titulo;
  document.getElementById('descripcionTarea').value = tarea.descripcion;
  document.getElementById('nombreLista').textContent = `Lista: ${proyectos[proyectoActivo].listas[iLista].titulo}`;
  renderEtiquetas();
}

function cerrarPanelTarea() {
  panel.classList.add('d-none');
  tareaActual = null;
  listaActual = null;
  etiquetaSeleccionada = null;
}

document.getElementById('tituloTarea').addEventListener('input', e => {
  if (listaActual !== null && tareaActual !== null) {
    proyectos[proyectoActivo].listas[listaActual].tareas[tareaActual].titulo = e.target.value;
    guardarLocal();
    cargarListas();
  }
});

document.getElementById('descripcionTarea').addEventListener('input', e => {
  if (listaActual !== null && tareaActual !== null) {
    proyectos[proyectoActivo].listas[listaActual].tareas[tareaActual].descripcion = e.target.value;
    guardarLocal();
  }
});

function renderEtiquetas() {
  etiquetasContainer.innerHTML = '';
  const etiquetas = proyectos[proyectoActivo].listas[listaActual].tareas[tareaActual].etiquetas;

  etiquetas.forEach((etiqueta, index) => {
    const span = document.createElement('span');
    span.className = `etiqueta ${etiqueta.color}`;
    span.textContent = etiqueta.texto;
    span.title = 'Click para cambiar color, doble click para eliminar';

    span.addEventListener('click', () => {
      etiquetaSeleccionada = index;
      mostrarSelectorColores();
    });

    span.addEventListener('dblclick', () => {
      if (confirm(`¿Eliminar la etiqueta "${etiqueta.texto}"?`)) {
        etiquetas.splice(index, 1);
        renderEtiquetas();
        guardarLocal();
      }
    });

    etiquetasContainer.appendChild(span);
  });
}

btnAgregarEtiqueta.addEventListener('click', () => {
  if (listaActual === null || tareaActual === null) return;
  const texto = prompt('Nombre de la etiqueta:');
  if (!texto) return;
  proyectos[proyectoActivo].listas[listaActual].tareas[tareaActual].etiquetas.push({
    texto,
    color: 'color-gris'
  });
  renderEtiquetas();
  mostrarSelectorColores(true);
  guardarLocal();
});

btnCerrarSelector.addEventListener('click', () => {
  selectorColores.classList.add('d-none');
  etiquetaSeleccionada = null;
});

selectorColores.querySelectorAll('.color-option').forEach(colorDiv => {
  colorDiv.addEventListener('click', () => {
    if (etiquetaSeleccionada === null) return;
    const color = colorDiv.dataset.color;
    proyectos[proyectoActivo].listas[listaActual].tareas[tareaActual].etiquetas[etiquetaSeleccionada].color = color;
    renderEtiquetas();
    selectorColores.classList.add('d-none');
    etiquetaSeleccionada = null;
    guardarLocal();
  });
});

function mostrarSelectorColores(seleccionarUltimo = false) {
  selectorColores.classList.remove('d-none');
  if (seleccionarUltimo) {
    etiquetaSeleccionada = proyectos[proyectoActivo].listas[listaActual].tareas[tareaActual].etiquetas.length - 1;
  }
}

// Otros botones funcionales
document.getElementById('btnEditarEtiquetas').addEventListener('click', () => {
  alert('Para editar etiquetas, haz clic en ellas en el panel lateral.');
});

document.getElementById('btnCambiarMiembros').addEventListener('click', () => {
  if (listaActual === null || tareaActual === null) return;
  const miembros = prompt('Ingrese los miembros separados por coma:', proyectos[proyectoActivo].listas[listaActual].tareas[tareaActual].miembros.join(', '));
  if (miembros !== null) {
    proyectos[proyectoActivo].listas[listaActual].tareas[tareaActual].miembros = miembros.split(',').map(m => m.trim()).filter(m => m);
    alert('Miembros actualizados');
    guardarLocal();
  }
});

document.getElementById('btnCambiarPortada').addEventListener('click', () => {
  if (listaActual === null || tareaActual === null) return;
  const portada = prompt('Ingrese URL de la portada:', proyectos[proyectoActivo].listas[listaActual].tareas[tareaActual].portada || '');
  if (portada !== null) {
    proyectos[proyectoActivo].listas[listaActual].tareas[tareaActual].portada = portada.trim() || null;
    alert('Portada actualizada');
    guardarLocal();
  }
});

document.getElementById('btnEditarFechas').addEventListener('click', () => {
  if (listaActual === null || tareaActual === null) return;
  const tarea = proyectos[proyectoActivo].listas[listaActual].tareas[tareaActual];
  const inicio = prompt('Fecha de inicio (YYYY-MM-DD):', tarea.fechas.inicio || '');
  const vencimiento = prompt('Fecha de vencimiento (YYYY-MM-DD):', tarea.fechas.vencimiento || '');
  if (inicio !== null && vencimiento !== null) {
    tarea.fechas.inicio = inicio.trim() || null;
    tarea.fechas.vencimiento = vencimiento.trim() || null;
    alert('Fechas actualizadas');
    guardarLocal();
  }
});

document.getElementById('btnMoverTarjeta').addEventListener('click', () => {
  if (listaActual === null || tareaActual === null) return;
  const listas = proyectos[proyectoActivo].listas;
  let opciones = listas.map((l, i) => `${i}: ${l.titulo}`).join('\n');
  const destino = prompt(`Mover a lista:\n${opciones}`, listaActual);
  if (destino !== null && listas[destino] && destino != listaActual) {
    const tarea = proyectos[proyectoActivo].listas[listaActual].tareas.splice(tareaActual, 1)[0];
    proyectos[proyectoActivo].listas[destino].tareas.push(tarea);
    cerrarPanelTarea();
    guardarLocal();
    cargarListas();
  }
});

document.getElementById('btnCopiarTarjeta').addEventListener('click', () => {
  if (listaActual === null || tareaActual === null) return;
  const tarea = proyectos[proyectoActivo].listas[listaActual].tareas[tareaActual];
  const copia = JSON.parse(JSON.stringify(tarea));
  proyectos[proyectoActivo].listas[listaActual].tareas.push(copia);
  guardarLocal();
  cargarListas();
  alert('Tarjeta copiada');
});

// Drag & Drop
let draggedItem = null;

function dragStart(e) {
  draggedItem = e.target;
  e.target.classList.add('dragging');
  e.dataTransfer.effectAllowed = 'move';
  e.dataTransfer.setData('text/plain', '');
}

function dragEnd(e) {
  e.target.classList.remove('dragging');
  draggedItem = null;
  document.querySelectorAll('.list-group').forEach(ul => ul.classList.remove('drag-over'));
}

function dragOver(e) {
  e.preventDefault();
  if (!draggedItem) return;
  if (e.currentTarget.classList.contains('list-group')) {
    e.currentTarget.classList.add('drag-over');
  }
}

function dragLeave(e) {
  if (e.currentTarget.classList.contains('list-group')) {
    e.currentTarget.classList.remove('drag-over');
  }
}

function drop(e) {
  e.preventDefault();
  if (!draggedItem) return;
  const ul = e.currentTarget;
  ul.classList.remove('drag-over');

  const origenLista = parseInt(draggedItem.dataset.listaIndex);
  const origenTarea = parseInt(draggedItem.dataset.tareaIndex);
  const destinoLista = parseInt(ul.dataset.listaIndex);

  if (isNaN(origenLista) || isNaN(origenTarea) || isNaN(destinoLista)) return;

  // Sacar la tarea de la lista origen
  const tarea = proyectos[proyectoActivo].listas[origenLista].tareas.splice(origenTarea, 1)[0];
  // Ponerla al final de la lista destino
  proyectos[proyectoActivo].listas[destinoLista].tareas.push(tarea);

  guardarLocal();
  cargarListas();
}

// Inicializar carga
cargarProyectos();
