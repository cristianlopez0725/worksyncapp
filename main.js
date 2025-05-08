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
  
    const task = { title, deadline, email, notified: false };
    tasks.push(task);
    addTaskToDOM(task);
    scheduleNotification(task);
    taskForm.reset();
  });
  
  function addTaskToDOM(task) {
    const li = document.createElement("li");
    li.textContent = `${task.title} - Vence: ${task.deadline.toLocaleString()}`;
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
  