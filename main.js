// Inicializar EmailJS
(function () {
  emailjs.init("TU_CLAVE_PUBLICA"); // Reemplaza con tu clave pública de EmailJS
})();

// Solicitar permiso para notificaciones
if (Notification.permission !== "granted") {
  Notification.requestPermission();
}

const taskForm = document.getElementById("task-form");
const taskList = document.getElementById("task-list");
let tasks = [];

taskForm.addEventListener("submit", (e) => {
  e.preventDefault();
  const title = document.getElementById("task-title").value;
  const deadline = new Date(document.getElementById("task-deadline").value);
  const email = document.getElementById("task-email").value;
  const fileInput = document.getElementById("task-file");
  const file = fileInput.files[0];

  if (file) {
    const reader = new FileReader();
    reader.onload = function () {
      const fileData = reader.result;
      const task = { title, deadline, email, fileData, fileName: file.name, notified: false };
      tasks.push(task);
      addTaskToDOM(task);
      scheduleNotification(task);
      taskForm.reset();
    };
    reader.readAsDataURL(file);
  } else {
    const task = { title, deadline, email, fileData: null, fileName: null, notified: false };
    tasks.push(task);
    addTaskToDOM(task);
    scheduleNotification(task);
    taskForm.reset();
  }
});

function addTaskToDOM(task) {
  const li = document.createElement("li");
  li.textContent = `${task.title} - Vence: ${task.deadline.toLocaleString()}`;
  if (task.fileName) {
    const fileLink = document.createElement("a");
    fileLink.href = task.fileData;
    fileLink.download = task.fileName;
    fileLink.textContent = ` Descargar ${task.fileName}`;
    fileLink.style.marginLeft = "10px";
    li.appendChild(fileLink);
  }
  taskList.appendChild(li);
}

function scheduleNotification(task) {
  const now = new Date();
  const timeUntilDeadline = task.deadline - now;

  if (timeUntilDeadline > 0) {
    setTimeout(() => {
      showNotification(task.title);
      sendEmail(task);
      task.notified = true;
    }, timeUntilDeadline);
  } else {
    // Si la fecha ya pasó, notificar inmediatamente
    showNotification(task.title);
    sendEmail(task);
    task.notified = true;
  }
}

function showNotification(title) {
  if (Notification.permission === "granted") {
    new Notification("Recordatorio de Tarea", {
      body: `La tarea "${title}" está por vencer.`,
    });
  }
}

function sendEmail(task) {
  const templateParams = {
    to_email: task.email,
    task_title: task.title,
    task_deadline: task.deadline.toLocaleString(),
    // No se puede enviar el archivo directamente con EmailJS sin backend
  };

  emailjs
    .send("TU_ID_DE_SERVICIO", "TU_ID_DE_PLANTILLA", templateParams)
    .then(
      (response) => {
        console.log("Correo enviado con éxito", response.status, response.text);
      },
      (error) => {
        console.error("Error al enviar el correo", error);
      }
    );
}
