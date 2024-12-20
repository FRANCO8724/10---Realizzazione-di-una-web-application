-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Dic 20, 2024 alle 19:12
-- Versione del server: 10.4.28-MariaDB
-- Versione PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cinema`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `biglietto`
--

CREATE TABLE `biglietto` (
  `ID` int(11) NOT NULL,
  `Posto` int(11) NOT NULL,
  `Id_utente` int(11) NOT NULL,
  `Id_orari` int(11) NOT NULL,
  `Id_sala` int(11) NOT NULL,
  `Pagamento` text NOT NULL,
  `Prezzo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `biglietto`
--

INSERT INTO `biglietto` (`ID`, `Posto`, `Id_utente`, `Id_orari`, `Id_sala`, `Pagamento`, `Prezzo`) VALUES
(1, 12, 2, 3, 1, 'Carta', 12),
(2, 2, 2, 1, 1, 'Contanti', 7),
(3, 9, 1, 1, 2, 'Carta', 12);

-- --------------------------------------------------------

--
-- Struttura della tabella `cast2`
--

CREATE TABLE `cast2` (
  `CODICE` int(11) NOT NULL,
  `Nome` text NOT NULL,
  `Cognome` text NOT NULL,
  `Data_di_nascita` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `cast2`
--

INSERT INTO `cast2` (`CODICE`, `Nome`, `Cognome`, `Data_di_nascita`) VALUES
(1, 'Robert', 'De niro', '2014-12-17'),
(2, 'Adam', 'Driver', '2020-12-09'),
(3, 'Joe', 'Pesci', '2024-07-17'),
(4, 'William ', 'Dafoe', '2024-02-11');

-- --------------------------------------------------------

--
-- Struttura della tabella `cinema`
--

CREATE TABLE `cinema` (
  `ID` int(11) NOT NULL,
  `Nome` text NOT NULL,
  `Id_telefono` int(11) NOT NULL,
  `Id_indirizzo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `cinema`
--

INSERT INTO `cinema` (`ID`, `Nome`, `Id_telefono`, `Id_indirizzo`) VALUES
(1, 'UCI Curno', 3, 2),
(2, 'UCI Bergamo', 1, 1),
(3, 'UCI Milano', 3, 3),
(4, 'UCI Bologna', 4, 10);

-- --------------------------------------------------------

--
-- Struttura della tabella `classifica`
--

CREATE TABLE `classifica` (
  `ID` int(11) NOT NULL,
  `Id_valutazione` int(11) NOT NULL,
  `Id_film` int(11) NOT NULL,
  `Voto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `classifica`
--

INSERT INTO `classifica` (`ID`, `Id_valutazione`, `Id_film`, `Voto`) VALUES
(1, 1, 2, 7),
(2, 1, 3, 3),
(3, 1, 3, 9),
(4, 3, 2, 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `film`
--

CREATE TABLE `film` (
  `CODICE` int(11) NOT NULL,
  `Titolo` text NOT NULL,
  `Data_uscita_film` date NOT NULL,
  `Anno` int(11) NOT NULL,
  `Paese` text NOT NULL,
  `Durata` float NOT NULL,
  `Seguiti` text NOT NULL,
  `Genere` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `film`
--

INSERT INTO `film` (`CODICE`, `Titolo`, `Data_uscita_film`, `Anno`, `Paese`, `Durata`, `Seguiti`, `Genere`) VALUES
(1, 'The irishman', '2024-11-03', 2019, 'America', 3.2, '-', 'Dramma/Documentario'),
(2, 'Interstellar', '2023-01-09', 2014, 'America', 2.56, '-', 'Sci-fi/Dramma'),
(3, 'Spider-man', '2017-12-15', 2017, 'Inghilterra', 1.4, 'Spider-man 2,Spider-man 3', 'Fantascienza');

-- --------------------------------------------------------

--
-- Struttura della tabella `indirizzo`
--

CREATE TABLE `indirizzo` (
  `ID` int(11) NOT NULL,
  `via` text NOT NULL,
  `Cap` int(11) NOT NULL,
  `Città` text NOT NULL,
  `Civico` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `indirizzo`
--

INSERT INTO `indirizzo` (`ID`, `via`, `Cap`, `Città`, `Civico`) VALUES
(1, 'Via marco Polo', 43050, 'Varese', 21),
(2, 'Via garibaldi', 30790, 'Vienna', 3),
(3, 'via carducci', 34001, 'Cremona', 65),
(10, 'via XX maggio', 21010, 'Bologna', 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `orari`
--

CREATE TABLE `orari` (
  `CODICE` int(11) NOT NULL,
  `Data` date NOT NULL,
  `Ora` float NOT NULL,
  `Id_film` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `orari`
--

INSERT INTO `orari` (`CODICE`, `Data`, `Ora`, `Id_film`) VALUES
(1, '2024-04-23', 23, 2),
(2, '2024-04-23', 13, 3),
(3, '2024-12-09', 13, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `partecipazione`
--

CREATE TABLE `partecipazione` (
  `ID` int(11) NOT NULL,
  `Id_cast` int(11) NOT NULL,
  `Id_film` int(11) NOT NULL,
  `Ruolo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `partecipazione`
--

INSERT INTO `partecipazione` (`ID`, `Id_cast`, `Id_film`, `Ruolo`) VALUES
(1, 1, 1, 'Protagonista'),
(2, 3, 1, 'Comparsa'),
(3, 2, 3, 'Co-protagonista');

-- --------------------------------------------------------

--
-- Struttura della tabella `planimetria`
--

CREATE TABLE `planimetria` (
  `ID` int(11) NOT NULL,
  `cm2` int(11) NOT NULL,
  `posti` int(11) NOT NULL,
  `Capienza` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `planimetria`
--

INSERT INTO `planimetria` (`ID`, `cm2`, `posti`, `Capienza`) VALUES
(1, 250, 75, 150),
(2, 150, 23, 45),
(3, 210, 45, 89),
(4, 200, 0, 50);

-- --------------------------------------------------------

--
-- Struttura della tabella `sala`
--

CREATE TABLE `sala` (
  `ID` int(11) NOT NULL,
  `Numero` int(11) NOT NULL,
  `Id_planimetria` int(11) NOT NULL,
  `Id_cinema` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `sala`
--

INSERT INTO `sala` (`ID`, `Numero`, `Id_planimetria`, `Id_cinema`) VALUES
(1, 56, 2, 3),
(2, 32, 3, 1),
(3, 5, 1, 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `telefono`
--

CREATE TABLE `telefono` (
  `ID` int(11) NOT NULL,
  `Numero` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `telefono`
--

INSERT INTO `telefono` (`ID`, `Numero`) VALUES
(1, '456 201 6582'),
(2, '232 643 9982'),
(3, '232 724 5621'),
(4, '365 291 1062');

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `USERNAME` int(11) NOT NULL,
  `Password` text NOT NULL,
  `Email` text NOT NULL,
  `Nome` text NOT NULL,
  `Cognome` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`USERNAME`, `Password`, `Email`, `Nome`, `Cognome`) VALUES
(1, 'kjg3jkh1', 'Alberto72@gmail.com', 'alberto', 'Rossi'),
(2, 'aqp3jkmidgvdik.', 'Carloconti9@gmail.com', 'Carlo', 'Conti'),
(3, 'tqhjjaszpiojp23.', 'Valeriobraschi@gmail.com', 'Valerio', 'Braschi');

-- --------------------------------------------------------

--
-- Struttura della tabella `vita`
--

CREATE TABLE `vita` (
  `ID` int(11) NOT NULL,
  `Genitori` text NOT NULL,
  `Figli` text NOT NULL,
  `Biografia` text NOT NULL,
  `Filmografia` text NOT NULL,
  `Id_cast` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `vita`
--

INSERT INTO `vita` (`ID`, `Genitori`, `Figli`, `Biografia`, `Filmografia`, `Id_cast`) VALUES
(1, 'Angelo Pesci, Maria Mesce', 'Tiffany Pesci', 'Joseph Frank Pesci, detto Joe, è un attore e musicista statunitense di origini italiane. È noto principalmente per l\'interpretazione del mafioso italoamericano Tommy DeVito in Quei bravi ragazzi di Martin Scorsese, che gli permise nel 1991, di vincere il premio Oscar nella categoria miglior attore non protagonista.', 'Balliamo insieme il twist (Hey, Let\'s Twist!), regia di Greg Garrison (1961) - non accreditato\r\nBackstreet (The Death Collector), regia di Ralph De Vito (1976)\r\nEsecuzione al braccio 3 (Short Eyes), regia di Robert M. Young (1977) - non accreditato\r\nToro scatenato (Raging Bull), regia di Martin Scorsese (1980)\r\nJean e Barbara - Un film da finire (I\'m Dancing as Fast as I Can), regia di Jack Hofsiss (1982)\r\nDear Mr. Wonderful, regia di Peter Lilienthal (1982)\r\nSoldi facili (Easy Money), regia di James Signorelli (1983)\r\nEureka, regia di Nicolas Roeg (1983)\r\nTutti dentro, regia di Alberto Sordi (1984)\r\nC\'era una volta in America (Once Upon a Time in America), regia di Sergio Leone (1984)\r\nKidnapping - Pericolo in agguato (Man on Fire), regia di Elie Chouraqui (1987)\r\nMoonwalker, regia di Jerry Kramer (1988)\r\nArma letale 2 (Lethal Weapon 2), regia di Richard Donner (1989)\r\nOre contate (Catchfire), regia di Dennis Hopper (1989) - cameo non accreditato\r\nIl matrimonio di Betsy (Betsy\'s Wedding), regia di Alan Alda (1990)\r\nQuei bravi ragazzi (Goodfellas), regia di Martin Scorsese (1990)\r\nMamma, ho perso l\'aereo (Home Alone), regia di Chris Columbus (1990)\r\nIl padrone di casa (The Super), regia di Rod Daniel (1991)\r\nJFK - Un caso ancora aperto (JFK), regia di Oliver Stone (1991)\r\nMio cugino Vincenzo (My Cousin Vinny), regia di Jonathan Lynn (1992)\r\nArma letale 3 (Lethal Weapon 3), regia di Richard Donner (1992)\r\nOcchio indiscreto (The Public Eye), regia di Howard Franklin (1992)\r\nMamma, ho riperso l\'aereo: mi sono smarrito a New York (Home Alone 2: Lost in New York), regia di Chris Columbus (1992)\r\nBronx (A Bronx Tale), regia di Robert De Niro (1993) - cameo\r\nJimmy Hollywood, regia di Barry Levinson (1994)\r\n110 e lode (With Honors), regia di Alek Keshishian (1994)\r\nCasinò (Casino), regia di Martin Scorsese (1995)\r\nOtto teste e una valigia (8 Heads in a Duffel Bag), regia di Tom Schulman (1997)\r\nChi pesca trova (Gone Fishin\'), regia di Christopher Cain (1997)\r\nArma letale 4 (Lethal Weapon 4), regia di Richard Donner (1998)\r\nThe Good Shepherd - L\'ombra del potere (The Good Shepherd), regia di Robert De Niro (2006) - cameo\r\nLove Ranch, regia di Taylor Hackford (2010)\r\nThe Irishman, regia di Martin Scorsese (2019)\r\nIl giorno dell\'incontro (Day of the Fight), regia di Jack Huston (2023)', 3),
(2, 'Joe Driver, Nancy Wright', '-', 'Dopo l\'esperienza militare nel Corpo dei Marines, ha acquisito popolarità come attore grazie al ruolo di Adam Sackler nella serie comica-drammatica della HBO, Girls (2012-2017), per la quale ha ricevuto tre nomination consecutive per il Primetime Emmy Award come miglior attore non protagonista in una commedia. Ha vinto la Coppa Volpi per la miglior interpretazione maschile per il dramma Hungry Hearts (2014) e il premio come miglior attore dalla Los Angeles Film Critics Association per Paterson (2016). Per BlacKkKlansman (2018), diretto da Spike Lee, ha ricevuto la candidatura per l\'Oscar come miglior attore non protagonista.', 'J. Edgar, regia di Clint Eastwood (2011)\r\nGayby, regia di Jonathan Lisecki (2012)\r\nNot Waving But Drowning, regia di Devyn Waitt (2012)\r\nLincoln, regia di Steven Spielberg (2012)\r\nFrances Ha, regia di Noah Baumbach (2012)\r\nBluebird, regia di Lance Edmands (2013)\r\nA proposito di Davis (Inside Llewyn Davis), regia di Joel ed Ethan Coen (2013)\r\nTracks - Attraverso il deserto (Tracks), regia di John Curran (2013)\r\nWhat If, regia di Michael Dowse (2013)\r\nHungry Hearts, regia di Saverio Costanzo (2014)\r\nThis Is Where I Leave You, regia di Shawn Levy (2014)\r\nGiovani si diventa (While We\'re Young), regia di Noah Baumbach (2014)\r\nStar Wars: Il risveglio della Forza (Star Wars: The Force Awakens), regia di J. J. Abrams (2015)\r\nMidnight Special - Fuga nella notte (Midnight Special), regia di Jeff Nichols (2016)\r\nPaterson, regia di Jim Jarmusch (2016)\r\nSilence, regia di Martin Scorsese (2016)\r\nLa truffa dei Logan (Logan Lucky), regia di Steven Soderbergh (2017)\r\nThe Meyerowitz Stories, regia di Noah Baumbach (2017)\r\nStar Wars: Gli ultimi Jedi (Star Wars: The Last Jedi), regia di Rian Johnson (2017)\r\nL\'uomo che uccise Don Chisciotte (The Man Who Killed Don Quixote), regia di Terry Gilliam (2018)\r\nBlacKkKlansman, regia di Spike Lee (2018)\r\nThe Report, regia di Scott Z. Burns (2019)\r\nI morti non muoiono (The Dead Don\'t Die), regia di Jim Jarmusch (2019)\r\nStoria di un matrimonio (Marriage Story), regia di Noah Baumbach (2019)\r\nStar Wars: L\'ascesa di Skywalker (Star Wars: The Rise of Skywalker), regia di J. J. Abrams (2019)\r\nAnnette, regia di Leos Carax (2021)\r\nThe Last Duel, regia di Ridley Scott (2021)\r\nHouse of Gucci, regia di Ridley Scott (2021)\r\nRumore bianco (White Noise), regia di Noah Baumbach (2022)\r\n65 - Fuga dalla Terra (65), regia di Scott Beck e Bryan Woods (2023)\r\nFerrari, regia di Michael Mann (2023)\r\nMegalopolis, regia di Francis Ford Coppola (2024)', 2),
(3, 'Robert De Niro, Virginia Admiral', 'Drena De Niro, Aaron Kendrick De Niro, Julian Henry De Niro, Elliot De Niro, Raphael De Niro', 'Robert Anthony De Niro è un attore e produttore cinematografico statunitense con cittadinanza italiana.', 'Cry in the Street, di Rolf Lauckner (1961-1962)\r\nGod Wants What Man Wants, di Arthur Sanier (1965)\r\nThe World of Günter Grass, da Günter Grass, adattamento di Dennis Rosa (1966)\r\nTchin Tchin, di Sidney Michael (1967)\r\nGeneration, di William Goodhart (1967)\r\nThe Boor, di Anton Čechov (1968)\r\nGlamour, Glory and Gold: The Life and Legend of Nola Noonan, Goddes and Star, di Jackie Curtis (1968)\r\nGloria and Esperanza, di Julie Bovasso (1969)\r\nThe Basement, di Harold Pinter (1969)\r\nCaptain Smith and His Glory, di David Freeman (1969)\r\nCome and Go, di Samuel Beckett (1969)\r\nOne Night Stands for a Noisy Passenger, di Shelley Winters (1970)\r\nThree Zen Koans, in Kool Aid, di Merle Molofsky (1971)\r\nShubert\'s Last Serenade, di Julie Bovasso (1973)\r\nCuba and His Teddy Bear, di Reinaldo Povod (1986)', 1);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `biglietto`
--
ALTER TABLE `biglietto`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Entrata` (`Id_sala`),
  ADD KEY `Prenotazione` (`Id_utente`),
  ADD KEY `Inizio_proiezione` (`Id_orari`);

--
-- Indici per le tabelle `cast2`
--
ALTER TABLE `cast2`
  ADD PRIMARY KEY (`CODICE`);

--
-- Indici per le tabelle `cinema`
--
ALTER TABLE `cinema`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Cinema-Indirizzo` (`Id_indirizzo`),
  ADD KEY `Recapito` (`Id_telefono`);

--
-- Indici per le tabelle `classifica`
--
ALTER TABLE `classifica`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Classificazione` (`Id_film`),
  ADD KEY `Valutazione` (`Id_valutazione`);

--
-- Indici per le tabelle `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`CODICE`);

--
-- Indici per le tabelle `indirizzo`
--
ALTER TABLE `indirizzo`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `orari`
--
ALTER TABLE `orari`
  ADD PRIMARY KEY (`CODICE`),
  ADD KEY `Proiezione` (`Id_film`);

--
-- Indici per le tabelle `partecipazione`
--
ALTER TABLE `partecipazione`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Cast-Partecipazione` (`Id_cast`),
  ADD KEY `Film-Partecipazione` (`Id_film`);

--
-- Indici per le tabelle `planimetria`
--
ALTER TABLE `planimetria`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `sala`
--
ALTER TABLE `sala`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Appartiene` (`Id_cinema`),
  ADD KEY `Sala-Planimetria` (`Id_planimetria`);

--
-- Indici per le tabelle `telefono`
--
ALTER TABLE `telefono`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`USERNAME`);

--
-- Indici per le tabelle `vita`
--
ALTER TABLE `vita`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Approfondimenti` (`Id_cast`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `biglietto`
--
ALTER TABLE `biglietto`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT per la tabella `cast2`
--
ALTER TABLE `cast2`
  MODIFY `CODICE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT per la tabella `cinema`
--
ALTER TABLE `cinema`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT per la tabella `classifica`
--
ALTER TABLE `classifica`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT per la tabella `film`
--
ALTER TABLE `film`
  MODIFY `CODICE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `indirizzo`
--
ALTER TABLE `indirizzo`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT per la tabella `orari`
--
ALTER TABLE `orari`
  MODIFY `CODICE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT per la tabella `partecipazione`
--
ALTER TABLE `partecipazione`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT per la tabella `planimetria`
--
ALTER TABLE `planimetria`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT per la tabella `sala`
--
ALTER TABLE `sala`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT per la tabella `telefono`
--
ALTER TABLE `telefono`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT per la tabella `utente`
--
ALTER TABLE `utente`
  MODIFY `USERNAME` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `vita`
--
ALTER TABLE `vita`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `biglietto`
--
ALTER TABLE `biglietto`
  ADD CONSTRAINT `Entrata` FOREIGN KEY (`Id_sala`) REFERENCES `sala` (`ID`),
  ADD CONSTRAINT `Inizio_proiezione` FOREIGN KEY (`Id_orari`) REFERENCES `orari` (`CODICE`),
  ADD CONSTRAINT `Prenotazione` FOREIGN KEY (`Id_utente`) REFERENCES `utente` (`USERNAME`);

--
-- Limiti per la tabella `cinema`
--
ALTER TABLE `cinema`
  ADD CONSTRAINT `Cinema-Indirizzo` FOREIGN KEY (`Id_indirizzo`) REFERENCES `indirizzo` (`ID`),
  ADD CONSTRAINT `Recapito` FOREIGN KEY (`Id_telefono`) REFERENCES `telefono` (`ID`);

--
-- Limiti per la tabella `classifica`
--
ALTER TABLE `classifica`
  ADD CONSTRAINT `Classificazione` FOREIGN KEY (`Id_film`) REFERENCES `film` (`CODICE`),
  ADD CONSTRAINT `Valutazione` FOREIGN KEY (`Id_valutazione`) REFERENCES `utente` (`USERNAME`);

--
-- Limiti per la tabella `orari`
--
ALTER TABLE `orari`
  ADD CONSTRAINT `Proiezione` FOREIGN KEY (`Id_film`) REFERENCES `film` (`CODICE`);

--
-- Limiti per la tabella `partecipazione`
--
ALTER TABLE `partecipazione`
  ADD CONSTRAINT `Cast-Partecipazione` FOREIGN KEY (`Id_cast`) REFERENCES `cast2` (`CODICE`),
  ADD CONSTRAINT `Film-Partecipazione` FOREIGN KEY (`Id_film`) REFERENCES `film` (`CODICE`);

--
-- Limiti per la tabella `sala`
--
ALTER TABLE `sala`
  ADD CONSTRAINT `Appartiene` FOREIGN KEY (`Id_cinema`) REFERENCES `cinema` (`ID`),
  ADD CONSTRAINT `Sala-Planimetria` FOREIGN KEY (`Id_planimetria`) REFERENCES `planimetria` (`ID`);

--
-- Limiti per la tabella `vita`
--
ALTER TABLE `vita`
  ADD CONSTRAINT `Approfondimenti` FOREIGN KEY (`Id_cast`) REFERENCES `cast2` (`CODICE`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
