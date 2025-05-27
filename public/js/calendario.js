const calendar = document.getElementById('calendar');
  const modal = document.getElementById('eventModal');
  const eventTitle = document.getElementById('eventTitle');
  const eventType = document.getElementById('eventType');

  let currentDayElement = null;

  for (let i = 1; i <= 30; i++) {
    const day = document.createElement('div');
    day.className = 'day';
    day.innerHTML = `<div class="day-number">${i}</div>
      <button class="add-btn" onclick="openModal(this)">+</button>`;
    calendar.appendChild(day);
  }

  function openModal(button) {
    currentDayElement = button.parentElement;
    modal.style.display = 'flex';
    eventTitle.value = '';
  }

  function saveEvent() {
    const title = eventTitle.value.trim();
    const type = eventType.value;

    if (title && currentDayElement) {
      const newEvent = document.createElement('div');
      newEvent.className = `event ${type}`;
      newEvent.innerText = title;
      currentDayElement.appendChild(newEvent);
    }

    modal.style.display = 'none';
  }

  window.onclick = function(e) {
    if (e.target === modal) {
      modal.style.display = 'none';
    }
  };