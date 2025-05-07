const board = document.getElementById('board');
const addListBtn = document.getElementById('addList');

addListBtn.addEventListener('click', () => {
  const listName = prompt("Nombre de la lista:");
  if (!listName) return;

  const list = document.createElement('div');
  list.className = 'list';
  list.innerHTML = `
    <h3>${listName}</h3>
    <div class="cards" ondragover="event.preventDefault()" ondrop="drop(event)">
    </div>
    <textarea placeholder="Nueva tarea..."></textarea>
    <button class="addCard">Añadir tarea</button>
  `;

  const textarea = list.querySelector('textarea');
  const cardsContainer = list.querySelector('.cards');
  const addCardBtn = list.querySelector('.addCard');

  addCardBtn.addEventListener('click', () => {
    const text = textarea.value.trim();
    if (!text) return;

    const card = document.createElement('div');
    card.className = 'card';
    card.draggable = true;
    card.textContent = text;
    card.addEventListener('dragstart', drag);

    cardsContainer.appendChild(card);
    textarea.value = '';
  });

  board.insertBefore(list, addListBtn);
});

// Drag and Drop
function drag(event) {
  event.dataTransfer.setData("text/plain", event.target.outerHTML);
  event.target.remove();
}

function drop(event) {
  const data = event.dataTransfer.getData("text/plain");
  event.target.insertAdjacentHTML("beforeend", data);
  const newCard = event.target.lastElementChild;
  newCard.addEventListener('dragstart', drag);
}