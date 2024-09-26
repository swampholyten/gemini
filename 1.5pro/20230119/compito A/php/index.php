<?php
// Informazioni di connessione al database (da sostituire con i tuoi dati)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "esami";

// Creazione della connessione
$conn = new mysqli($servername, $username, $password, $dbname);

// Controllo errori di connessione
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

// Controllo dei parametri GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        // Visualizza un singolo film
        $id = $_GET['id'];
        $sql = "SELECT * FROM movies WHERE Id=$id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Visualizza i dettagli del film in HTML (esempio)
            echo "<h2>" . $row["Title"] . "</h2>";
            echo "<p>Anno: " . $row["Year"] . "</p>";
            // ... altri dettagli ...
            echo "<img src='" . $row["Poster"] . "' alt='" . $row["Title"] . "'>";
        } else {
            echo "Film non trovato.";
        }
    } else if (isset($_GET['title'], $_GET['year'], ...)) {
        // Modifica un film
        // Verifica che tutti i campi obbligatori siano presenti
        // Esegui l'update
    } else {
        // Visualizza tutti i film
        $sql = "SELECT * FROM movies";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Titolo</th><th>Anno</th><th>...</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["Id"] . "</td>";
                echo "<td>" . $row["Title"] . "</td>";
                // ... altri campi ...
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "Nessun film trovato.";
        }
    }
}

$conn->close();