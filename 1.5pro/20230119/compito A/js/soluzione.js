document.querySelector("button").addEventListener("click", function () {
  const numRighe = parseInt(
    document.querySelector('input[name="numerorighe"]').value
  );
  const numColonne = parseInt(
    document.querySelector('input[name="numerocolonne"]').value
  );
  const tabella = document.querySelector("table");
  const listaElementi = document.querySelector("ul");
  const paragrafoErrore = document.querySelector("form p");

  // Verifica input
  if (
    isNaN(numRighe) ||
    isNaN(numColonne) ||
    numRighe <= 0 ||
    numColonne <= 0
  ) {
    paragrafoErrore.textContent = "Inserisci due numeri interi positivi.";
    return;
  } else {
    paragrafoErrore.textContent = "";
  }

  // Crea la tabella
  tabella.innerHTML = "";
  for (let i = 0; i < numRighe; i++) {
    const riga = tabella.insertRow();
    for (let j = 0; j < numColonne; j++) {
      const cella = riga.insertCell();
      if (i === 0 || j === 0) {
        cella.textContent = i === 0 ? `C${j}` : `R${i}`;
      } else {
        cella.textContent = generateRandomString(10);
        cella.addEventListener("click", function () {
          if (cella.style.backgroundColor === "red") {
            cella.style.backgroundColor = "";
            listaElementi.removeChild(
              document.querySelector(`li:contains(${cella.textContent})`)
            );
          } else {
            cella.style.backgroundColor = "#F00";
            const li = document.createElement("li");
            li.textContent = cella.textContent;
            listaElementi.appendChild(li);
          }
        });
      }
    }
  }
});

function generateRandomString(length) {
  const characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
  let result = "";
  for (let i = 0; i < length; i++) {
    result += characters.charAt(Math.floor(Math.random() * characters.length));
  }
  return result;
}
