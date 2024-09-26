const form = document.querySelector("form");
const numRigheInput = form.querySelector('input[name="numerorighe"]');
const numColonneInput = form.querySelector('input[name="numerocolonne"]');
const messaggioErrore = form.querySelector("p");
const tabella = document.querySelector("table");
const listaElementi = document.querySelector("ul");

form.addEventListener("submit", (event) => {
  event.preventDefault(); // Previene il comportamento di default del form
  const numRighe = parseInt(numRigheInput.value);
  const numColonne = parseInt(numColonneInput.value);

  if (
    isNaN(numRighe) ||
    isNaN(numColonne) ||
    numRighe <= 0 ||
    numColonne <= 0
  ) {
    messaggioErrore.textContent = "Inserisci due numeri interi positivi!";
    return;
  }

  messaggioErrore.textContent = ""; // Nasconde il messaggio di errore

  // Crea la tabella
  tabella.innerHTML = ""; // Pulisci la tabella precedente
  const headerRow = tabella.insertRow();
  const headerCell = headerRow.insertCell();
  for (let i = 1; i <= numColonne; i++) {
    headerCell = headerRow.insertCell();
    headerCell.textContent = `C${i}`;
  }
  for (let i = 1; i <= numRighe; i++) {
    const row = tabella.insertRow();
    const cell = row.insertCell();
    cell.textContent = `R${i}`;
    for (let j = 1; j <= numColonne; j++) {
      cell = row.insertCell();
      cell.textContent = generaStringaCasuale(10);
      cell.addEventListener("click", handleClickCell);
    }
  }
});

function handleClickCell(event) {
  const cell = event.target;
  if (cell.classList.contains("selected")) {
    cell.classList.remove("selected");
    cell.style.backgroundColor = "";
    const cellText = cell.textContent;
    const itemToRemove = listaElementi.querySelector(
      `li:contains(${cellText})`
    );
    if (itemToRemove) {
      listaElementi.removeChild(itemToRemove);
    }
  } else {
    cell.classList.add("selected");
    cell.style.backgroundColor = "#F00";
    const listItem = document.createElement("li");
    listItem.textContent = cell.textContent;
    listaElementi.appendChild(listItem);
  }
}

function generaStringaCasuale(lunghezza) {
  const caratteri = "abcdefghijklmnopqrstuvwxyz";
  let stringa = "";
  for (let i = 0; i < lunghezza; i++) {
    stringa += caratteri.charAt(Math.floor(Math.random() * caratteri.length));
  }
  return stringa;
}
