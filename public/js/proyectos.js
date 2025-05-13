document.addEventListener('DOMContentLoaded', loadTasks);

document.querySelectorAll('.add-task').forEach(button => {
  button.addEventListener('click', () => {
    const input = button.previousElementSibling;
    const taskText = input.value.trim();
    if (taskText) {
      const task = createTaskElement({ title: taskText, description: '' });
      button.parentElement.querySelector('.task-container').appendChild(task);
      input.value = '';
      saveTasks();
    }
  });
});

document.getElementById('add-list-btn').addEventListener('click', () => {
  const board = document.getElementById('board');
  const list = document.createElement('div');
  list.className = 'list';
  list.innerHTML = `
    <h2>Nueva lista</h2>
    <div class="task-container" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
    <input type="text" placeholder="Nueva tarea..." class="task-input">
    <button class="add-task">+ Agregar tarea</button>
  `;
  board.insertBefore(list, document.getElementById('add-list-btn'));

  const addButton = list.querySelector('.add-task');
  const input = list.querySelector('.task-input');
  const container = list.querySelector('.task-container');

  addButton.addEventListener('click', () => {
    const taskText = input.value.trim();
    if (taskText) {
      const task = createTaskElement({ title: taskText, description: '' });
      container.appendChild(task);
      input.value = '';
      saveTasks();
    }
  });
});

function createTaskElement(taskData) {
  const task = document.createElement('div');
  task.className = 'task';
  task.textContent = taskData.title;
  task.setAttribute('draggable', true);
  task.id = 'task-' + Date.now();

  task.dataset.title = taskData.title;
  task.dataset.description = taskData.description || '';
  task.dataset.date = taskData.date || '';
  task.dataset.tags = taskData.tags || '';

  task.addEventListener('click', () => openTaskDetail(task));
  task.addEventListener('dragstart', dragStart);
  return task;
}

function openTaskDetail(taskElement) {
  const titleInput = document.getElementById('task-title-input');
  const descInput = document.getElementById('task-description');
  const dateInput = document.getElementById('task-date');
  const fileInput = document.getElementById('task-file');
  const tagsInput = document.getElementById('task-tags');

  // Rellenar datos
  titleInput.value = taskElement.dataset.title;
  descInput.value = taskElement.dataset.description || '';
  dateInput.value = taskElement.dataset.date || '';
  tagsInput.value = taskElement.dataset.tags || '';
  
  document.getElementById('task-detail').classList.remove('hidden');

  // Botón editar
  document.getElementById('edit-toggle').onclick = () => {
    const disabled = titleInput.disabled;
    [titleInput, descInput, dateInput, fileInput, tagsInput].forEach(el => el.disabled = !disabled);
    document.getElementById('edit-task').disabled = disabled;
  };

  // Guardar cambios
  document.getElementById('edit-task').onclick = () => {
    taskElement.dataset.title = titleInput.value.trim() || 'Sin título';
    taskElement.dataset.description = descInput.value;
    taskElement.dataset.date = dateInput.value;
    taskElement.dataset.tags = tagsInput.value;

    // Actualizar texto visible
    taskElement.textContent = titleInput.value.trim() || 'Sin título';

    saveTasks();
    // Desactivar campos después de guardar
    [titleInput, descInput, dateInput, fileInput, tagsInput].forEach(el => el.disabled = true);
    document.getElementById('edit-task').disabled = true;
  };

  // Eliminar tarea
  document.getElementById('delete-task').onclick = () => {
    taskElement.remove();
    saveTasks();
    closeTaskDetail();
  };
}


document.getElementById('close-detail').addEventListener('click', closeTaskDetail);

function closeTaskDetail() {
  document.getElementById('task-detail').classList.add('hidden');
}

function allowDrop(ev) {
  ev.preventDefault();
}

function drop(ev) {
  ev.preventDefault();
  const task = ev.dataTransfer.getData('text');
  const taskElement = document.getElementById(task);
  ev.target.appendChild(taskElement);
  saveTasks();
}

function dragStart(ev) {
  ev.dataTransfer.setData('text', ev.target.id);
}

function saveTasks() {
  const tasks = [];
  document.querySelectorAll('.task-container').forEach(container => {
    const listTasks = [];
    container.querySelectorAll('.task').forEach(task => {
      listTasks.push({
        title: task.dataset.title,
        description: task.dataset.description,
        date: task.dataset.date,
        tags: task.dataset.tags
      });
    });
    tasks.push(listTasks);
  });
  localStorage.setItem('tasks', JSON.stringify(tasks));
}

function loadTasks() {
  const tasks = JSON.parse(localStorage.getItem('tasks'));
  if (tasks) {
    tasks.forEach((listTasks, index) => {
      const list = document.querySelectorAll('.list')[index];
      if (!list) return;
      const container = list.querySelector('.task-container');
      listTasks.forEach(taskData => {
        const task = createTaskElement(taskData);
        container.appendChild(task);
      });
    });
  }
}