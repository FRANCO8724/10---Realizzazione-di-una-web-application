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
    <link rel="stylesheet" href="stylesamm.css">
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
    <button onclick="mostraForm('Add_film')">Aggiungi film</button>
    <button onclick="mostraForm('Add_membro')">Aggiungi Membro</button>
    <button onclick="mostraForm('Add_biografia')">Aggiungi Biografia</button>
    <button onclick="mostraForm('Add_proiezione')">Aggiungi Proiezione</button>
    <button onclick="mostraForm('Add_cinema')">Aggiungi Cinema</button>
    <button onclick="mostraForm('Add_sale')">Aggiungi Sale</button>
    
    <!-- Film -->
    <div id="Add_film" class="form-container" style="display: none;">
        <h2>Inserisci le informazioni relative al film: </h2>
        <form method="POST">
            Titolo: <input type="text" name="titolo" required>
            Uscita: <input type="text" name="data" required>
            Anno: <input type="text" name="anno" required>
            Paese: <input type="text" name="paese" required>
            Durata: <input type="text" name="durata" required>
            Seguiti: <input type="text" name="seguiti" required>
            Genere: <input type="text" name="genere" required>
            <input type="hidden" name="action" value="azione_film">
            <input type="submit" value="Inserisci">
        </form>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'azione_film') {
        // Raccogli i dati inviati dal form
        $Titolo = $_POST['titolo'];
        $Uscita = $_POST['data'];
        $Anno = $_POST['anno'];
        $Paese = $_POST['paese'];
        $Durata = $_POST['durata'];
        $Seguiti = $_POST['seguiti'];
        $Genere = $_POST['genere'];


            // Crea una query per inserire i dati nella tabella "film"
            $sql = "INSERT INTO film (Titolo, Data_uscita_film, Anno, Paese, Durata, Seguiti, Genere) VALUES ('$Titolo', '$Uscita', '$Anno', '$Paese','$Durata', '$Seguiti', '$Genere')";
            
            // Esegui la query
            if ($connessione->query($sql)) {
                echo "<p>Dati inseriti con successo!</p>";
            } else {
                echo "<p>Errore: " . $connessione->error . "</p>";
            }
        }

        ?>
    </div>
    <!-- Membro -->

    <div id="Add_membro" class="form-container" style="display: none;">
        <h2>Inserisci le informazioni relative al partecipante: </h2>
        <form method="POST">
            Nome: <input type="text" name="nome" required>
            Cognome: <input type="text" name="cognome" required>
            Nascita: <input type="text" name="nascita" required>

            Ruolo: <input type="text" name="ruolo" required>
            Film: <input type="text" name="film" required>
            <input type="hidden" name="action" value="Attore_azione">
            <input type="submit" value="Inserisci"> 
    
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'Attore_azione') {
                // Raccogli i dati inviati dal form
                $Nome = $_POST['nome'];
                $Cognome = $_POST['cognome'];
                $Data_di_nascita = $_POST['nascita'];
                // Crea una query per inserire i dati nella tabella "cast"
                $sql = "INSERT INTO cast (Nome, Cognome, Data_di_nascita) VALUES ('$Nome', '$Cognome', '$Data_di_nascita')";
            
                // Esegui la query
                if ($connessione->query($sql)) {
                    echo "<p>Dati inseriti con successo!</p>";
                } else {
                    echo "<p>Errore: " . $connessione->error . "</p>";
                }

            }

            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'Attore_azione') {
                $Ruolo = $_POST['ruolo'];    
                $nome_attore = $_POST['nome'];
                $nome_film = $_POST['film'];
          
                  // Esegui la query per trovare il CODICE dell'attore
                  $query = "SELECT CODICE FROM cast WHERE Nome = '$nome_attore' LIMIT 1";
                  // Esegui la query
                  $result = $connessione->query($query);

                  if ($result && $result->num_rows > 0) {
                      // Se l'attore esiste, prendi il CODICE
                      $row = $result->fetch_assoc();
                      $id_attore = $row['CODICE'];
                    }else {
                        echo "<p>Errore: Nome dell'attore non trovato nella tabella cast2.</p>";
                    }
          
                  // Esegui la query per trovare il CODICE del film
                  $query = "SELECT CODICE FROM film WHERE Titolo = '$nome_film' LIMIT 1";

                  // Esegui la query
                  $result = $connessione->query($query);

                  if ($result && $result->num_rows > 0) {
                      // Se il film esiste, prendi il CODICE
                      $row = $result->fetch_assoc();
                      $id_film = $row['CODICE'];
                    }else { 
                        echo "<p>Errore: Nome dell'attore non trovato nella tabella film.</p>";
                    }

                 //Crea una query per inserire i dati nella tabella "Partecipazione"
                $sql = "INSERT INTO partecipazione (Id_cast, Id_film, Ruolo) VALUES ('$id_attore', '$id_film', '$Ruolo')";
            
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
        </form>
    </div>

    <!-- Biografia -->

    <div id="Add_biografia" class="form-container" style="display: none;">
        <h2>Inserisci la biografia dell'attore: </h2>
        <form method="POST">
            Genitori: <input type="text" name="genitori" required>
            Figli: <input type="text" name="figli" required>
            Biografia: <input type="text" name="biografia" required>
            Filmografia: <input type="text" name="filmografia" required>
            Nome: <input type="text" name="nome" required>
            
            <input type="hidden" name="action" value="Vita_attore">
            <input type="submit" value="Inserisci"> 
    
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'Vita_attore') {
                // Raccogli i dati inviati dal form
                $Genitori = $_POST['genitori'];
                $Figli = $_POST['figli'];
                $Biografia = $_POST['biografia'];
                $Filmografia = $_POST['filmografia'];

                              // Recupera il nome dell'attore dalla richiesta
                              $nome_cast = $_POST['nome'];
          
                              // Esegui la query per trovare il CODICE dell'attore
                              $query = "SELECT CODICE FROM cast2 WHERE Nome = '$nome_cast' LIMIT 1";
          
                              // Esegui la query
                              $result = $connessione->query($query);
          
                              if ($result && $result->num_rows > 0) {
                                  // Se l' attore esiste, prendi il CODICE
                                  $row = $result->fetch_assoc();
                                  $id_cast = $row['CODICE'];
                                }else {
                                    echo "<p>Errore: Nome dell'attore non trovato nella tabella cast2.</p>";
                                }


                // Crea una query per inserire i dati nella tabella "Vita"
                $sql = "INSERT INTO vita (Genitori, Figli, Biografia, Filmografia, Id_cast) VALUES ('$Genitori', '$Figli', '$Biografia', '$Filmografia', '$id_cast')";
            
                // Esegui la query
                if ($connessione->query($sql)) {
                    echo "<p>Dati inseriti con successo!</p>";
                } else {
                    echo "<p>Errore: " . $connessione->error . "</p>";
                }
            }

            // Mostrare i dati esistenti

        $query = "
                 SELECT Nome , Cognome , Data_di_nascita
                 FROM cast
                 JOIN vita ON cast.CODICE = vita.ID
        ";

            $result = $connessione->query($query);
            if ($result && $result->num_rows > 0) {
                echo '<table>';
                echo '<tr><th>Nome</th><th>Cognome</th><th>Data_di_nascita</th></tr>';
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>{$row['Nome']}</td><td>{$row['Cognome']}</td><td>{$row['Data_di_nascita']}</td></tr>";
                }
                echo '</table>';
            } else {
                echo '<p>Non ci sono dati nella tabella.</p>';
            }

            ?>
        </form>
    </div>

    <!-- Proiezione -->

    <div id="Add_proiezione" class="form-container" style="display: none;">
        <h2>Inserisci gli orari dei vari film: </h2>
        <form method="POST">
            Data: <input type="text" name="data" required>
            Ora: <input type="text" name="ora" required>
            Film: <input type="text" name="film" required>
            <input type="hidden" name="action" value="azione_orario">
            <input type="submit" value="Inserisci">
        </form>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'azione_orario') {
        // Raccogli i dati inviati dal form
        $Data = $_POST['data'];
        $Uscita = $_POST['ora'];
        $nome_film = $_POST['film'];

                  // Esegui la query per trovare il CODICE del Film
                  $query = "SELECT CODICE FROM film WHERE Titolo = '$nome_film' LIMIT 1";

                  // Esegui la query
                  $result = $connessione->query($query);

                  if ($result && $result->num_rows > 0) {
                      // Se il film esiste, prendi il CODICE
                      $row = $result->fetch_assoc();
                      $id_film = $row['CODICE'];
                    }else { 
                        echo "<p>Errore: Nome dell'attore non trovato nella tabella film.</p>";
                    }



            // Crea una query per inserire i dati nella tabella "Orari"
            $sql = "INSERT INTO orari (Data, Ora, Id_film) VALUES ('$Data', '$Uscita', '$id_film')";
            
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

    <!-- Cinema -->

    <div id="Add_cinema" class="form-container" style="display: none;">
        <h2>Inserisci le informazioni relative al cinema: </h2>
        <form method="POST">
            Numero: <input type="text" name="numero" required>
            Nome: <input type="text" name="nome" required>
            Via: <input type="text" name="via" required>
            Cap: <input type="text" name="cap" required>
            Città: <input type="text" name="città" required>
            Civico: <input type="text" name="civico" required>
            <input type="hidden" name="action" value="azione_cinema">
            <input type="submit" value="Inserisci">
        </form>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'azione_cinema') {
        $Numero = $_POST['numero'];
            // Crea una query per inserire i dati nella tabella "telefono"
            $sql = "INSERT INTO telefono (Numero) VALUES ('$Numero')";
                    
            // Esegui la query
            if ($connessione->query($sql)) {
                echo "<p>Dati inseriti con successo!</p>";
            } else {
                echo "<p>Errore: " . $connessione->error . "</p>";
            }
        
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'azione_cinema') {
        // Raccogli i dati inviati dal form
        $Via = $_POST['via'];
        $Cap = $_POST['cap'];
        $Città = $_POST['città'];
        $Civico = $_POST['civico'];


            // Crea una query per inserire i dati nella tabella "Indirizzo"
            $sql = "INSERT INTO indirizzo (via, Cap, Città, Civico) VALUES ('$Via', '$Cap', '$Città', '$Civico')";
            
            // Esegui la query
            if ($connessione->query($sql)) {
                echo "<p>Dati inseriti con successo!</p>";
            } else {
                echo "<p>Errore: " . $connessione->error . "</p>";
            }
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'azione_cinema') {
        
        $Numero = $_POST['numero'];
        $Via = $_POST['via'];
        $Nome = $_POST['nome'];

              // Esegui la query per trovare l'ID del telefono
              $query = "SELECT ID FROM telefono WHERE Numero = '$Numero' LIMIT 1";
              // Esegui la query
              $result = $connessione->query($query);

              if ($result && $result->num_rows > 0) {
                  // Se il numero di telefono esiste, prendi l'ID
                  $row = $result->fetch_assoc();
                  $id_numero= $row['ID'];
                }else {
                    echo "<p>Errore: Nome dell'attore non trovato nella tabella cast2.</p>";
                }
      
              // Esegui la query per trovare l'ID della via
              $query = "SELECT ID FROM indirizzo WHERE via = '$Via' LIMIT 1";

              // Esegui la query
              $result = $connessione->query($query);

              if ($result && $result->num_rows > 0) {
                  // Se la via esiste, prendi l'ID
                  $row = $result->fetch_assoc();
                  $id_via = $row['ID'];
                }else { 
                    echo "<p>Errore: Nome dell'attore non trovato nella tabella film.</p>";
                }

             //Crea una query per inserire i dati nella tabella "cinema"
            $sql = "INSERT INTO cinema (Nome, Id_telefono, Id_indirizzo) VALUES ('$Nome', '$id_numero', '$id_via')";
        
            // Esegui la query
            if ($connessione->query($sql)) {
                echo "<p>Dati inseriti con successo!</p>";
            } else {
                echo "<p>Errore: " . $connessione->error . "</p>";
            }

        }

        ?>
    </div>

    <!-- Sale -->
    <div id="Add_sale" class="form-container" style="display: none;">
        <h2>Inserisci le informazioni relative alla sala: </h2>
        <form method="POST">
            N_sala: <input type="text" name="n_sala" required>
            Cm2: <input type="text" name="cm2" required>
            Posti: <input type="text" name="posti" required>
            Capienza: <input type="text" name="capienza" required>
            Cinema: <input type="text" name="cinema" required>
            <input type="hidden" name="action" value="azione_sala">
            <input type="submit" value="Inserisci">
        </form>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'azione_sala') {
        $Cm2 = $_POST['cm2'];
        $Posti = $_POST['posti'];
        $Capienza = $_POST['capienza'];
            // Crea una query per inserire i dati nella tabella "planimetria"
            $sql = "INSERT INTO planimetria (cm2, posti, Capienza) VALUES ('$Cm2', '$Posti', '$Capienza')";
                    
            // Esegui la query
            if ($connessione->query($sql)) {
                echo "<p>Dati inseriti con successo!</p>";
            } else {
                echo "<p>Errore: " . $connessione->error . "</p>";
            }
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'azione_sala') {      
        $N_sala = $_POST['n_sala'];
        $Cm2 = $_POST['cm2'];
        $Cinema = $_POST['cinema'];

              // Esegui la query per trovare l'ID di cm2
              $query = "SELECT ID FROM planimetria WHERE cm2 = '$Cm2' LIMIT 1";
              // Esegui la query
              $result = $connessione->query($query);

              if ($result && $result->num_rows > 0) {
                  // Se cm2 esiste, prendi l'ID
                  $row = $result->fetch_assoc();
                  $id_planimetria= $row['ID'];
                }else {
                    echo "<p>Errore: Nome dell'attore non trovato nella tabella cast2.</p>";
                }
      
              // Esegui la query per trovare l'ID del cinema
              $query = "SELECT ID FROM cinema WHERE Nome = '$Cinema' LIMIT 1";

              // Esegui la query
              $result = $connessione->query($query);

              if ($result && $result->num_rows > 0) {
                  // Se il cinema esiste, prendi l'ID
                  $row = $result->fetch_assoc();
                  $id_cinema = $row['ID'];
                }else { 
                    echo "<p>Errore: Nome dell'attore non trovato nella tabella film.</p>";
                }

             //Crea una query per inserire i dati nella tabella "Sala"
            $sql = "INSERT INTO sala (Numero, Id_planimetria, Id_cinema) VALUES ('$N_sala', '$id_planimetria', '$id_cinema')";
        
            // Esegui la query
            if ($connessione->query($sql)) {
                echo "<p>Dati inseriti con successo!</p>";
            } else {
                echo "<p>Errore: " . $connessione->error . "</p>";
            }

                // Reindirizza per evitare reinvii
                header("Location: {$_SERVER['PHP_SELF']}");
                exit();
        }

                            // Mostrare i dati esistenti
                            $query = "
                            SELECT Nome
                            FROM cinema
                            JOIN sala ON cinema.ID = sala.ID
                         ";
                
                       $result = $connessione->query($query);
                       if ($result && $result->num_rows > 0) {
                           echo '<table>';
                           echo '<tr><th>Cinema</th></tr>';
                           while ($row = $result->fetch_assoc()) {
                               echo "<tr><td>{$row['Nome']}</td></tr>";
                           }
                           echo '</table>';
                       } else {
                           echo '<p>Non ci sono dati nella tabella.</p>';
                       }
        
        ?>
    </div>

</body>
</html>