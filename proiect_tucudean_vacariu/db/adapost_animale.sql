-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Gazdă: 127.0.0.1
-- Timp de generare: ian. 04, 2021 la 05:22 PM
-- Versiune server: 10.4.14-MariaDB
-- Versiune PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Bază de date: `adapost_animale`
--

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `adaposturi`
--

CREATE TABLE `adaposturi` (
  `idAdapost` int(11) NOT NULL,
  `tipAdapost` enum('canin','felin') NOT NULL,
  `locuriDisponibile` int(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `adaposturi`
--

INSERT INTO `adaposturi` (`idAdapost`, `tipAdapost`, `locuriDisponibile`) VALUES
(1, 'canin', 0),
(2, 'felin', 1),
(3, 'canin', 0),
(4, 'canin', 0),
(5, 'canin', 1),
(6, 'canin', 2),
(7, 'canin', 3),
(8, 'canin', 3),
(9, 'canin', 3),
(10, 'felin', 5),
(11, 'felin', 5),
(12, 'felin', 3);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `adoptii`
--

CREATE TABLE `adoptii` (
  `idAdoptie` int(11) NOT NULL,
  `idAnimal` int(11) NOT NULL,
  `idClient` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `adoptii`
--

INSERT INTO `adoptii` (`idAdoptie`, `idAnimal`, `idClient`) VALUES
(4, 6, 3),
(5, 7, 4),
(6, 1, 1),
(7, 2, 3),
(8, 22, 6),
(9, 19, 2),
(10, 26, 7);

--
-- Declanșatori `adoptii`
--
DELIMITER $$
CREATE TRIGGER `trig_adpotii` AFTER INSERT ON `adoptii` FOR EACH ROW BEGIN
    UPDATE animal_adapost
    SET dataAdoptie = CURRENT_TIMESTAMP
    -- idAdapost am incercat sa referim idAdapost din adaposturi
    -- cu NEW.idAdapost referim idAdapost din animal_adapost
    WHERE idAnimal = NEW.idAnimal;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `animale`
--

CREATE TABLE `animale` (
  `idAnimal` int(11) NOT NULL,
  `tip_animal` enum('caine','pisica') NOT NULL,
  `rasa` varchar(64) NOT NULL,
  `culoare` varchar(64) NOT NULL,
  `varsta` int(11) NOT NULL,
  `sex` enum('mascul','femela','necunoscut') NOT NULL,
  `nume` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `animale`
--

INSERT INTO `animale` (`idAnimal`, `tip_animal`, `rasa`, `culoare`, `varsta`, `sex`, `nume`) VALUES
(1, 'caine', 'Metis', 'negru', 4, 'mascul', 'Rexi'),
(2, 'pisica', 'Birmaneza', 'maro, crem', 1, 'femela', 'Rozica'),
(3, 'caine', 'pug', 'gri', 2, 'femela', 'Mati'),
(4, 'pisica', 'europeana', 'gri cu alb', 1, 'femela', 'Titi'),
(5, 'caine', 'metis', 'maro', 2, 'femela', 'Dixi'),
(6, 'pisica', 'europeana', 'tarcata', 1, 'femela', 'Mitzi'),
(7, 'pisica', 'metis', 'alb gri', 2, 'mascul', 'Pisu'),
(8, 'pisica', 'europeana', 'gri', 3, 'femela', 'Dory'),
(9, 'caine', 'metis', 'alb', 1, 'mascul', 'Jimmy'),
(10, 'caine', 'metis', 'maro', 7, 'mascul', 'Rudolf'),
(11, 'pisica', 'europeana', 'alb', 5, 'femela', 'Matilda'),
(12, 'caine', 'labrador', 'auriu', 10, 'femela', 'Dora'),
(13, 'caine', 'buldog', 'gri', 4, 'femela', 'Nina'),
(14, 'caine', 'chihuahua', 'maro', 5, 'mascul', 'Pablo'),
(15, 'pisica', 'siameza', 'gri cu alb', 2, 'femela', 'Juana'),
(16, 'pisica', 'europeana', 'gri', 5, 'mascul', 'Ferdi'),
(17, 'caine', 'maidanez', 'maro', 6, 'femela', 'Gina'),
(18, 'caine', 'metis', 'gri', 5, 'mascul', 'Rex'),
(19, 'pisica', 'birmaneza', 'maro', 2, 'mascul', 'Tomy'),
(20, 'caine', 'Coli', 'negru maro', 3, 'femela', 'Lessie'),
(21, 'caine', 'bichon', 'alb', 4, 'mascul', 'Busy'),
(22, 'caine', 'metis', 'gri', 2, 'femela', 'Deia'),
(23, 'caine', 'labrador', 'negru', 6, 'mascul', 'Blakie'),
(24, 'pisica', 'sfinx', 'crem', 5, 'mascul', 'Lord'),
(25, 'pisica', 'sfinx', 'crem', 5, 'femela', 'Cleo'),
(26, 'caine', 'labrador', 'auriu', 4, 'mascul', 'Rex');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `animal_adapost`
--

CREATE TABLE `animal_adapost` (
  `idAnimalAdapost` int(11) NOT NULL,
  `idAnimal` int(11) NOT NULL,
  `idAdapost` int(11) NOT NULL,
  `dataIntrare` timestamp NOT NULL DEFAULT current_timestamp(),
  `dataAdoptie` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `animal_adapost`
--

INSERT INTO `animal_adapost` (`idAnimalAdapost`, `idAnimal`, `idAdapost`, `dataIntrare`, `dataAdoptie`) VALUES
(4, 1, 1, '2021-01-02 16:57:48', '2021-01-04 00:25:19'),
(5, 2, 2, '2021-01-02 17:25:33', '2021-01-04 00:25:49'),
(6, 4, 2, '2021-01-02 18:11:43', NULL),
(7, 3, 1, '2021-01-02 18:18:12', NULL),
(8, 5, 3, '2021-01-02 18:55:44', NULL),
(9, 6, 2, '2021-01-02 19:42:34', '2021-01-02 20:01:16'),
(10, 7, 2, '2021-01-02 23:52:18', '2021-01-02 23:57:04'),
(12, 8, 2, '2021-01-03 19:05:53', NULL),
(15, 10, 1, '2021-01-03 19:10:25', NULL),
(16, 11, 12, '2021-01-03 19:14:41', NULL),
(17, 12, 3, '2021-01-03 19:18:12', NULL),
(18, 9, 3, '2021-01-03 19:24:54', NULL),
(24, 13, 4, '2021-01-03 19:30:34', NULL),
(25, 14, 4, '2021-01-03 21:05:09', NULL),
(26, 15, 2, '2021-01-03 21:08:35', NULL),
(27, 16, 12, '2021-01-03 21:21:19', NULL),
(28, 17, 4, '2021-01-03 21:27:47', NULL),
(30, 18, 5, '2021-01-03 21:50:26', NULL),
(31, 19, 2, '2021-01-03 21:55:34', '2021-01-04 01:28:13'),
(36, 20, 5, '2021-01-03 22:09:37', NULL),
(37, 21, 6, '2021-01-03 22:11:31', NULL),
(38, 22, 5, '2021-01-03 22:13:52', '2021-01-04 01:26:42'),
(40, 23, 1, '2021-01-04 01:10:03', NULL),
(41, 24, 2, '2021-01-04 01:10:46', NULL),
(42, 26, 5, '2021-01-04 15:10:12', '2021-01-04 15:12:07');

--
-- Declanșatori `animal_adapost`
--
DELIMITER $$
CREATE TRIGGER `trig_eliberareLoc` AFTER DELETE ON `animal_adapost` FOR EACH ROW BEGIN
    UPDATE adaposturi
    SET locuriDisponibile = locuriDisponibile + 1
    -- idAdapost am incercat sa referim idAdapost din adaposturi
    -- cu NEW.idAdapost referim idAdapost din animal_adapost
    WHERE idAdapost = OLD.idAdapost;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trig_eliberareLoc_adoptie` AFTER UPDATE ON `animal_adapost` FOR EACH ROW BEGIN
    UPDATE adaposturi
    SET locuriDisponibile = locuriDisponibile + 1
    -- idAdapost am incercat sa referim idAdapost din adaposturi
    -- cu NEW.idAdapost referim idAdapost din animal_adapost
    WHERE idAdapost = OLD.idAdapost;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trig_intrare` AFTER INSERT ON `animal_adapost` FOR EACH ROW BEGIN
    UPDATE adaposturi
    SET locuriDisponibile = locuriDisponibile - 1
    -- idAdapost am incercat sa referim idAdapost din adaposturi
    -- cu NEW.idAdapost referim idAdapost din animal_adapost
    WHERE idAdapost = NEW.idAdapost;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `clienti`
--

CREATE TABLE `clienti` (
  `idClient` int(11) NOT NULL,
  `numeClient` varchar(255) NOT NULL,
  `numarTelefon` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `adresa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `clienti`
--

INSERT INTO `clienti` (`idClient`, `numeClient`, `numarTelefon`, `email`, `adresa`) VALUES
(1, 'Mircea Constantin', '0747123456', 'mircea.constantin@yahoo.com', 'Strada Panselutelor, numar 123, Timisoara, Timis'),
(2, 'Andrei Vacariu', '0758219331', 'avacariu@mail.com', 'Timisoara, Timis'),
(3, 'Georgiana Vasilache', '0123456789', 'georgiana.vasilacke@smekerie.ro', 'Jimbolia, numar 194'),
(4, 'Mihai Cireada', '0785412345', 'mihai.c@shmecher.com', 'Strada Platanilor, nr 75'),
(6, 'Georgiana Tucudean', '0724587123', 'georgianat@email.com', 'Timisoara, Timis'),
(7, 'Silvan Motorca', '0123456789', 'silvan@mail.com', 'Timisoara, Timis');

--
-- Indexuri pentru tabele eliminate
--

--
-- Indexuri pentru tabele `adaposturi`
--
ALTER TABLE `adaposturi`
  ADD PRIMARY KEY (`idAdapost`);

--
-- Indexuri pentru tabele `adoptii`
--
ALTER TABLE `adoptii`
  ADD PRIMARY KEY (`idAdoptie`),
  ADD KEY `idAnimal` (`idAnimal`),
  ADD KEY `idClient` (`idClient`);

--
-- Indexuri pentru tabele `animale`
--
ALTER TABLE `animale`
  ADD PRIMARY KEY (`idAnimal`);

--
-- Indexuri pentru tabele `animal_adapost`
--
ALTER TABLE `animal_adapost`
  ADD PRIMARY KEY (`idAnimalAdapost`),
  ADD KEY `idAnimal` (`idAnimal`),
  ADD KEY `idAdapost` (`idAdapost`);

--
-- Indexuri pentru tabele `clienti`
--
ALTER TABLE `clienti`
  ADD PRIMARY KEY (`idClient`);

--
-- AUTO_INCREMENT pentru tabele eliminate
--

--
-- AUTO_INCREMENT pentru tabele `adaposturi`
--
ALTER TABLE `adaposturi`
  MODIFY `idAdapost` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pentru tabele `adoptii`
--
ALTER TABLE `adoptii`
  MODIFY `idAdoptie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pentru tabele `animale`
--
ALTER TABLE `animale`
  MODIFY `idAnimal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pentru tabele `animal_adapost`
--
ALTER TABLE `animal_adapost`
  MODIFY `idAnimalAdapost` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT pentru tabele `clienti`
--
ALTER TABLE `clienti`
  MODIFY `idClient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constrângeri pentru tabele eliminate
--

--
-- Constrângeri pentru tabele `adoptii`
--
ALTER TABLE `adoptii`
  ADD CONSTRAINT `adoptii_ibfk_1` FOREIGN KEY (`idClient`) REFERENCES `clienti` (`idClient`),
  ADD CONSTRAINT `adoptii_ibfk_2` FOREIGN KEY (`idAnimal`) REFERENCES `animale` (`idAnimal`);

--
-- Constrângeri pentru tabele `animal_adapost`
--
ALTER TABLE `animal_adapost`
  ADD CONSTRAINT `animal_adapost_ibfk_1` FOREIGN KEY (`idAnimal`) REFERENCES `animale` (`idAnimal`),
  ADD CONSTRAINT `animal_adapost_ibfk_2` FOREIGN KEY (`idAdapost`) REFERENCES `adaposturi` (`idAdapost`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
