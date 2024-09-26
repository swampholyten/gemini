<?php
// Imposta la connessione al database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "esami";

$conn = new mysqli($servername, $username, $password, $dbname);

// Controlla se la connessione è riuscita
if ($conn->connect_error) {
  die("Connessione fallita: " . $conn->connect_error);
}

// Controlla se ci sono parametri passati in GET
if (isset($_GET['id'])) {
  $id = $_GET['id'];

  // Controlla se sono presenti tutti i parametri per la modifica
  if (isset($_GET['title']) && isset($_GET['year']) && isset($_GET['rated']) && isset($_GET['released']) && isset($_GET['runtime']) && isset($_GET['genre']) && isset($_GET['director']) && isset($_GET['poster'])) {
    $title = $_GET['title'];
    $year = $_GET['year'];
    $rated = $_GET['rated'];
    $released = $_GET['released'];
    $runtime = $_GET['runtime'];
    $genre = $_GET['genre'];
    $director = $_GET['director'];
    $poster = $_GET['poster'];

    // Esegui l'aggiornamento dei dati del film
    $sql = "UPDATE movies SET Title='$title', Year='$year', Rated='$rated', Released='$released', Runtime='$runtime', Genre='$genre', Director='$director', Poster='$poster' WHERE Id=$id";
    if ($conn->query($sql) === TRUE) {
      echo "Film aggiornato correttamente";
    } else {
      echo "Errore nell'aggiornamento del film: " . $conn->error;
    }
  } else {
    // Visualizza un messaggio di errore per i campi mancanti
    echo "Errore: Mancano alcuni campi per la modifica.";
    echo "<br>";
    if (!isset($_GET['title'])) {
      echo "Campo 'title' mancante.";
    }
    if (!isset($_GET['year'])) {
      echo "Campo 'year' mancante.";
    }
    if (!isset($_GET['rated'])) {
      echo "Campo 'rated' mancante.";
    }
    if (!isset($_GET['released'])) {
      echo "Campo 'released' mancante.";
    }
    if (!isset($_GET['runtime'])) {
      echo "Campo 'runtime' mancante.";
    }
    if (!isset($_GET['genre'])) {
      echo "Campo 'genre' mancante.";
    }
    if (!isset($_GET['director'])) {
      echo "Campo 'director' mancante.";
    }
    if (!isset($_GET['poster'])) {
      echo "Campo 'poster' mancante.";
    }
  }
} else {
  // Recupera tutti i film dalla tabella movies
  $sql = "SELECT * FROM movies";
  $result = $conn->query($sql);

  // Stampa l'elenco dei film in una pagina HTML
  echo "<!DOCTYPE html>";
  echo "<html>";
  echo "<head>";
  echo "<title>Elenco Film</title>";
  echo "</head>";
  echo "<body>";
  echo "<h1>Elenco Film</h1>";
  echo "<table>";
  echo "<tr>";
  echo "<th>Id</th>";
  echo "<th>Title</th>";
  echo "<th>Year</th>";
  echo "<th>Rated</th>";
  echo "<th>Released</th>";
  echo "<th>Runtime</th>";
  echo "<th>Genre</th>";
  echo "<th>Director</th>";
  echo "<th>Poster</th>";
  echo "</tr>";

  if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
      echo "<tr>";
      echo "<td>" . $row["Id"] . "</td>";
      echo "<td>" . $row["Title"] . "</td>";
      echo "<td>" . $row["Year"] . "</td>";
      echo "<td>" . $row["Rated"] . "</td>";
      echo "<td>" . $row["Released"] . "</td>";
      echo "<td>" . $row["Runtime"] . "</td>";
      echo "<td>" . $row["Genre"] . "</td>";
      echo "<td>" . $row["Director"] . "</td>";
      echo "<td><img src='" . $row["Poster"] . "' alt='" . $row["Title"] . "' width='100'></td>";
      echo "</tr>";
    }
  } else {
    echo "<tr><td colspan='9'>Nessun film trovato</td></tr>";
  }
  echo "</table>";
  echo "</body>";
  echo "</html>";
}

// Chiudi la connessione al database
$conn->close();
?>