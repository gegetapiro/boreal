<?php
include "dataconnect.php";

// Creazione connessione
$conn = new mysqli($servername, $username, $password, $dbname);

// Controllo connessione
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

// Query per ottenere il miglior tempo di ogni utente
$sql = "SELECT username, MIN(reaction_time) AS best_time, MIN(created_at) AS first_occurrence 
        FROM scores 
        GROUP BY username 
        ORDER BY best_time ASC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classifica - Boreale</title>
    <style>
        body {
            text-align: center;
            font-family: Arial, sans-serif;
        }

        table {
            width: 60%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid black;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1>Classifica Boreale</h1>
    <table>
        <tr>
            <th>Posizione</th>
            <th>Nome</th>
            <th>Miglior Tempo di Reazione (ms)</th>
            <th>Data</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            $posizione = 1;
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$posizione}</td>";
                echo "<td>{$row['username']}</td>";
                echo "<td>{$row['best_time']}</td>";
                echo "<td>{$row['first_occurrence']}</td>";
                echo "</tr>";
                $posizione++;
            }
        } else {
            echo "<tr><td colspan='4'>Nessun punteggio registrato</td></tr>";
        }
        ?>
    </table>
    <a href="index.html">Torna al gioco</a>
</body>

</html>

<?php
$conn->close();
?>