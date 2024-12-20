<?php

$action = $_POST['action'] ?? null;

$host = "127.0.0.1";
$user = "root";
$password = "";
$database = "cinema";

$connessione = new mysqli($host, $user, $password, $database);

if ($connessione === false) {
    die("Errore di connessione: " . $connessione->connect_error);
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Gestione Dati</title>
    <link rel="stylesheet" href="stylesute.css">
    <script>
        function mostraForm(tipo) {
            const forms = document.querySelectorAll('.form-container');
            forms.forEach(form => form.style.display = 'none');
            document.getElementById(tipo).style.display = 'block';
        }
    </script>
</head>
<body>

    <h2>Seleziona l'azione da eseguire</h2>
    <button onclick="mostraForm('Registrazione')">Registrati</button>

        <!-- Registrati -->
        <div id="Registrazione" class="form-container" style="display: none;">
        <h2>Inserisci le tue credenziali: </h2>
        <form method="POST">
            Nome: <input type="text" name="nome" required>
            Cognome: <input type="text" name="cognome" required>
            Password: <input type="text" name="password" required>
            Email: <input type="text" name="email" required>
            <input type="hidden" name="action" value="azione_fregistra">
            <input type="submit" value="Inserisci">
        </form>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'azione_fregistra') {
        // Raccogli i dati inviati dal form
        $Nome = $_POST['nome'];
        $Cognome = $_POST['cognome'];
        $Password = $_POST['password'];
        $Email = $_POST['email'];

            // Crea una query per inserire i dati nella tabella "Utente"
            $sql = "INSERT INTO utente (Password, Email, Nome, Cognome) VALUES ('$Password', '$Email', '$Nome', '$Cognome')";
            
            // Esegui la query
            if ($connessione->query($sql)) {
                echo "<p>Dati inseriti con successo!</p>";
            } else {
                echo "<p>Errore: " . $connessione->error . "</p>";
            }
        }

        ?>
    </div>

</body>
</html>