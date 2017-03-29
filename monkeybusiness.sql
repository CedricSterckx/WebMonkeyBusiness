-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 29 mrt 2017 om 11:27
-- Serverversie: 10.1.21-MariaDB
-- PHP-versie: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `monkeybusiness`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `documenten`
--

CREATE TABLE `documenten` (
  `ID` int(11) NOT NULL,
  `Documentnummer` int(11) NOT NULL,
  `Documenttype` varchar(120) NOT NULL,
  `Documentaanmaakdatum` date NOT NULL,
  `Documentvervaldatum` date NOT NULL,
  `Documentklantnummer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gebruikers`
--

CREATE TABLE `gebruikers` (
  `GebruikerID` int(5) NOT NULL,
  `GebruikerNaam` varchar(20) NOT NULL,
  `GebruikerVoornaam` varchar(20) NOT NULL,
  `GebruikerPostcode` int(4) NOT NULL,
  `GebruikerGemeente` varchar(20) NOT NULL,
  `GebruikerStraat` varchar(20) NOT NULL,
  `GebruikerHuisnummer` int(5) NOT NULL,
  `GebruikerTelefoon` int(9) NOT NULL,
  `GebruikerGSM` int(10) NOT NULL,
  `GebruikerMail` varchar(50) NOT NULL,
  `GebruikerType` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Info van de personeelsleden';

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `klanten`
--

CREATE TABLE `klanten` (
  `ID` int(11) NOT NULL,
  `Klantnummer` int(11) DEFAULT NULL,
  `Naam` varchar(30) DEFAULT NULL,
  `Voornaam` varchar(30) DEFAULT NULL,
  `Postcode` int(4) NOT NULL,
  `Gemeente` varchar(40) NOT NULL,
  `Straat` varchar(100) NOT NULL,
  `Huisnummer` int(11) NOT NULL,
  `Telefoonnummer` int(50) NOT NULL,
  `Gsmnummer` int(20) NOT NULL,
  `Email` varchar(120) NOT NULL,
  `Getekendeofferte` int(11) NOT NULL,
  `Getekendcontract` int(11) NOT NULL,
  `Project` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `leverancier`
--

CREATE TABLE `leverancier` (
  `ID` int(11) NOT NULL,
  `Nummer` int(11) NOT NULL,
  `Postcode` int(4) NOT NULL,
  `Gemeente` varchar(50) NOT NULL,
  `Straat` varchar(100) NOT NULL,
  `Telefoonnummer` int(50) NOT NULL,
  `Gsmnummer` int(50) NOT NULL,
  `Email` varchar(125) NOT NULL,
  `Type` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `projecten`
--

CREATE TABLE `projecten` (
  `ProjectID` int(11) NOT NULL,
  `ProjectNaam` varchar(20) NOT NULL,
  `ProjectBeginDatum` date NOT NULL,
  `ProjectEindDatum` date NOT NULL,
  `ProjectKlantNummer` int(11) NOT NULL,
  `ProjectBezetting` varchar(30) NOT NULL,
  `ProjectKost` int(11) NOT NULL,
  `ProjectMaterialen` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Informatie over het project';

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `documenten`
--
ALTER TABLE `documenten`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Documentklantnummer` (`Documentklantnummer`);

--
-- Indexen voor tabel `gebruikers`
--
ALTER TABLE `gebruikers`
  ADD PRIMARY KEY (`GebruikerID`);

--
-- Indexen voor tabel `klanten`
--
ALTER TABLE `klanten`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `FOREIGN` (`Getekendcontract`),
  ADD UNIQUE KEY `Getekendeofferte` (`Getekendeofferte`),
  ADD UNIQUE KEY `Getekendcontract` (`Getekendcontract`),
  ADD UNIQUE KEY `Klantnummer` (`Klantnummer`);

--
-- Indexen voor tabel `leverancier`
--
ALTER TABLE `leverancier`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Nummer` (`Nummer`);

--
-- Indexen voor tabel `projecten`
--
ALTER TABLE `projecten`
  ADD PRIMARY KEY (`ProjectID`),
  ADD UNIQUE KEY `ProjectKlantNummer` (`ProjectKlantNummer`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `documenten`
--
ALTER TABLE `documenten`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `gebruikers`
--
ALTER TABLE `gebruikers`
  MODIFY `GebruikerID` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `klanten`
--
ALTER TABLE `klanten`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `leverancier`
--
ALTER TABLE `leverancier`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `projecten`
--
ALTER TABLE `projecten`
  MODIFY `ProjectID` int(11) NOT NULL AUTO_INCREMENT;
--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `klanten`
--
ALTER TABLE `klanten`
  ADD CONSTRAINT `klanten_ibfk_1` FOREIGN KEY (`Klantnummer`) REFERENCES `projecten` (`ProjectKlantNummer`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
