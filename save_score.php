<?php

include "dataconnect.php";



// Creazione connessione
$conn = new mysqli($servername, $username, $password, $dbname);





// Controllo connessione
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

// Ricezione dati
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $reaction_time = $conn->real_escape_string($_POST['reaction_time']);

    $sql = "INSERT INTO scores (username, reaction_time) VALUES ('$username', '$reaction_time')";

    if ($conn->query($sql) === TRUE) {
        echo "Punteggio salvato con successo!";
    } else {
        echo "Errore: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
