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
$Password = $_POST['Password_utente2'];
$Email = $_POST['Email_utente2'];
 
    $stmt = $connessione->prepare("SELECT USERNAME FROM utente WHERE Email = ? AND Password = ?");

// Associa i parametri alla query
$stmt->bind_param("ss",$Email,$Password);

// Esegui la query
$stmt->execute();

// Ottieni il risultato
$result = $stmt->get_result();

// Verifica se sono stati trovati dei risultati
if ($result->num_rows > 0) {
    // Se le credenziali sono corrette, reindirizza l'utente a utente.php
    header("Location: utente.php");
    exit;  // Assicurati che lo script venga interrotto dopo il reindirizzamento
} else {
    echo "Credenziali sbagliate"; // Credenziali non valide
}

// Chiudi lo statement
$stmt->close();

// Chiudi la connessione
$connessione->close();

?>