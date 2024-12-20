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
    <button onclick="mostraForm('Add_Biglietto')">Prenota Biglietto</button>
    <button onclick="mostraForm('Add_Film')">Valuta Film</button>

    <!-- Biglietto -->

        <div id="Add_Biglietto" class="form-container" style="display: none;">
            <h2>Inserisci la biografia dell'attore: </h2>
            <form method="POST">
                Posto: <input type="text" name="posto" required>
                Sala: <input type="text" name="sala" required>
                Email: <input type="text" name="email" required>
                Orario: <input type="text" name="orario" required>
                Pagamento: <input type="text" name="pagamento" required>
            
                <input type="hidden" name="action" value="azione_biglietto">
                <input type="submit" value="Inserisci"> 
            </form>
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'azione_biglietto') {
                // Raccogli i dati inviati dal form
                $Posto = $_POST['posto'];
                $Sala = $_POST['sala'];
                $Email = $_POST['email'];
                $Orario = $_POST['orario'];
                $Pagamento = $_POST['pagamento'];
          
                              // Esegui la query per trovare l'ID dell'utente
                              $query = "SELECT USERNAME FROM utente WHERE Email = '$Email' LIMIT 1";
          
                              // Esegui la query
                              $result = $connessione->query($query);
          
                              if ($result && $result->num_rows > 0) {
                                  // Se l'utente esiste, prendi l'USERNAME
                                  $row = $result->fetch_assoc();
                                  $id_utente = $row['USERNAME'];
                                }else {
                                    echo "<p>Errore: Nome dell'attore non trovato nella tabella utente.</p>";
                                }

                              // Esegui la query per trovare il CODICE dell'orario
                              $query = "SELECT CODICE FROM orari WHERE Ora = '$Orario' LIMIT 1";
          
                              // Esegui la query
                              $result = $connessione->query($query);
          
                              if ($result && $result->num_rows > 0) {
                                  // Se l' orario esiste, prendi il CODICE
                                  $row = $result->fetch_assoc();
                                  $id_orario = $row['CODICE'];
                                }else {
                                    echo "<p>Errore: Orario non trovato nella tabella orari.</p>";
                                }

                              // Esegui la query per trovare l'ID del numero
                              $query = "SELECT ID FROM sala WHERE Numero = '$Sala' LIMIT 1";
          
                              // Esegui la query
                              $result = $connessione->query($query);
          
                              if ($result && $result->num_rows > 0) {
                                  // Se il numero esiste, prendi l'ID
                                  $row = $result->fetch_assoc();
                                  $id_sala = $row['ID'];
                                }else {
                                    echo "<p>Errore: Sala non trovato nella tabella sale.</p>";
                                }


                // Crea una query per inserire i dati nella tabella "Biglietto"
                $sql = "INSERT INTO biglietto (Posto, Id_utente, Id_orari, Id_sala, Pagamento, Prezzo) VALUES ('$Posto', '$id_utente', '$id_orario', '$id_sala', '$Pagamento', '6.90')";
            
                // Esegui la query
                if ($connessione->query($sql)) {
                    echo "<p>Dati inseriti con successo!</p>";
                } else {
                    echo "<p>Errore: " . $connessione->error . "</p>";
                }
            }

            // Mostrare i dati esistenti
             $query = "
                 SELECT Data, Ora, Id_film
                 FROM orari
                 JOIN biglietto ON orari.CODICE = biglietto.ID
              ";

            $result = $connessione->query($query);
            if ($result && $result->num_rows > 0) {
                echo '<table>';
                echo '<tr><th>Data</th><th>Ora</th><th>Id_film</th></tr>';
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>{$row['Data']}</td><td>{$row['Ora']}</td><td>{$row['Id_film']}</td></tr>";
                }
                echo '</table>';
            } else {
                echo '<p>Non ci sono dati nella tabella.</p>';
            }

            // Mostrare i dati esistenti
             $query = "
                 SELECT Numero
                 FROM sala
                 JOIN biglietto ON sala.ID = biglietto.ID
              ";

            $result = $connessione->query($query);
            if ($result && $result->num_rows > 0) {
                echo '<table>';
                echo '<tr><th>Numero di sala</th></tr>';
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>{$row['Numero']}</td></tr>";
                }
                echo '</table>';
            } else {
                echo '<p>Non ci sono dati nella tabella.</p>';
            }

            ?>
        </div>      

    <!-- Valutazione -->

    <div id="Add_Film" class="form-container" style="display: none;">
            <h2>Inserisci la biografia dell'attore: </h2>
            <form method="POST">
                Film: <input type="text" name="film" required>
                Email: <input type="text" name="email" required>
                Voto: <input type="text" name="voto" required>
            
                <input type="hidden" name="action" value="azione_valutazione">
                <input type="submit" value="Inserisci"> 
            </form>
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'azione_valutazione') {
                // Raccogli i dati inviati dal form
                $Film = $_POST['film'];
                $Email = $_POST['email'];
                $Voto = $_POST['voto'];
          
                              // Esegui la query per trovare l'USERNAME della mail
                              $query = "SELECT USERNAME FROM utente WHERE Email = '$Email' LIMIT 1";
          
                              // Esegui la query
                              $result = $connessione->query($query);
          
                              if ($result && $result->num_rows > 0) {
                                  // Se la mail esiste, prendi l'ID
                                  $row = $result->fetch_assoc();
                                  $id_utente = $row['USERNAME'];
                                }else {
                                    echo "<p>Errore: Nome dell'attore non trovato nella tabella utente.</p>";
                                }

                              // Esegui la query per trovare il CODICE del titolo del film
                              $query = "SELECT CODICE FROM film WHERE Titolo = '$Film' LIMIT 1";
          
                              // Esegui la query
                              $result = $connessione->query($query);
          
                              if ($result && $result->num_rows > 0) {
                                  // Se il titolo esiste, prendi il CODICE
                                  $row = $result->fetch_assoc();
                                  $id_film = $row['CODICE'];
                                }else {
                                    echo "<p>Errore: Orario non trovato nella tabella orari.</p>";
                                }


                // Crea una query per inserire i dati nella tabella "Classifica"
                $sql = "INSERT INTO classifica (Id_valutazione, Id_film, Voto) VALUES ('$id_utente', '$id_film', '$Voto')";
            
                // Esegui la query
                if ($connessione->query($sql)) {
                    echo "<p>Dati inseriti con successo!</p>";
                } else {
                    echo "<p>Errore: " . $connessione->error . "</p>";
                }
            }

            // Mostrare i dati esistenti
             $query = "
                 SELECT Titolo
                 FROM film
                 JOIN classifica ON film.CODICE = classifica.ID
              ";

            $result = $connessione->query($query);
            if ($result && $result->num_rows > 0) {
                echo '<table>';
                echo '<tr><th>Titolo</th></tr>';
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>{$row['Titolo']}</td></tr>";
                }
                echo '</table>';
            } else {
                echo '<p>Non ci sono dati nella tabella.</p>';
            }

            ?>
        </div>              

</body>
</html>
