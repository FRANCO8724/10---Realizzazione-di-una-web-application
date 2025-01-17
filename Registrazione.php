<?php

$action = $_POST['action'] ?? null;

$host = "127.0.0.1";
$user = "root";
$password = "";
$database = "cinema";

// Connessione al database
$connessione = new mysqli($host, $user, $password, $database);

// Verifica connessione
if ($connessione === false) {
    die("Errore di connessione: " . $connessione->connect_error);
}

// Recupero dati dal form
$Password = $_POST['Password_Registrazione'];
$Email = $_POST['Email_registrazione'];
$Nome = $_POST['Nome_registrazione'];
$Cognome = $_POST['Cognome_registrazione'];

// Verifica che i dati siano stati ricevuti
if (!$Password || !$Email || !$Nome || !$Cognome) {
    die("Errore: tutti i campi sono obbligatori.");
}

// Query di inserimento
$sql = "INSERT INTO utente (Password, Email, Nome, Cognome) VALUES ('$Password', '$Email', '$Nome', '$Cognome')";
 // Esegui la query
 if ($connessione->query($sql)) {
    echo "<p>Dati inseriti con successo!</p>";
} else {
    echo "<p>Errore: " . $connessione->error . "</p>";
}
?>
