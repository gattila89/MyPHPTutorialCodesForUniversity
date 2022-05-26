-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2022 at 04:43 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `iwyrwv_testdb`
--
CREATE DATABASE IF NOT EXISTS `iwyrwv_testdb` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `iwyrwv_testdb`;

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `Naplozas`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `Naplozas` (IN `inpmuvelet` VARCHAR(50), IN `inptabla` VARCHAR(50), IN `inpValtozasKomment` VARCHAR(255))   BEGIN INSERT INTO `naplo`(`Muvelet`, `Tabla`,`ValtozasKomment`) VALUES (inpmuvelet,inpTabla,inpValtozasKomment); END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `beszallitok`
--

DROP TABLE IF EXISTS `beszallitok`;
CREATE TABLE IF NOT EXISTS `beszallitok` (
  `BeszallitoID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nev` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telefon` varchar(50) DEFAULT NULL,
  `szekhely` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`BeszallitoID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `beszallitok`
--

INSERT INTO `beszallitok` (`BeszallitoID`, `nev`, `email`, `telefon`, `szekhely`) VALUES
(1, 'Huncut Kft.', 'huncut@yahoo.com', '123456', 'Huncut utca 13'),
(2, 'Jozsi es fiai', 'jozsi@yahoo.com', '123436', 'Jozsi utca 1'),
(3, 'MekBela', 'mekbela@yahoo.com', '1234567', 'MekBela utca 11'),
(4, 'Tejbepapi gmbh', 'tejbepapi@yahoo.com', '123256', 'Tejbepapi ter 5'),
(5, 'Jozsef Szatmari', 'jocivagyok@yahoo.com', '567894', 'Szatmari utca 13');

--
-- Triggers `beszallitok`
--
DROP TRIGGER IF EXISTS `after_beszallitok_delete`;
DELIMITER $$
CREATE TRIGGER `after_beszallitok_delete` AFTER DELETE ON `beszallitok` FOR EACH ROW BEGIN CALL Naplozas('Delete','beszallitok',concat('Deleted_Beszallito_ID', '_', OLD.BeszallitoID)); END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `after_beszallitok_insert`;
DELIMITER $$
CREATE TRIGGER `after_beszallitok_insert` AFTER INSERT ON `beszallitok` FOR EACH ROW BEGIN CALL Naplozas('Insert','beszalltiok',concat('New_Beszallito_ID', '_', NEW.BeszallitoID)); END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `after_beszallitok_update`;
DELIMITER $$
CREATE TRIGGER `after_beszallitok_update` AFTER UPDATE ON `beszallitok` FOR EACH ROW BEGIN CALL Naplozas('Update','beszallitok', concat('Old_New_Update_params_', 'OLD: ', OLD.BeszallitoID, ', ', OLD.nev,', ', OLD.email,', ', OLD.telefon,', ',OLD.szekhely,' NEW: ',NEW.BeszallitoID, ', ', NEW.nev,', ', NEW.email,', ', NEW.telefon,', ',NEW.szekhely)); END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `naplo`
--

DROP TABLE IF EXISTS `naplo`;
CREATE TABLE IF NOT EXISTS `naplo` (
  `NaploID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Muvelet` varchar(50) DEFAULT NULL,
  `Datum` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Tabla` varchar(50) DEFAULT NULL,
  `ValtozasKomment` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`NaploID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `naplo`
--

INSERT INTO `naplo` (`NaploID`, `Muvelet`, `Datum`, `Tabla`, `ValtozasKomment`) VALUES
(1, 'Insert', '2022-05-26 14:23:29', 'vevok', 'New_Vevo_ID_1'),
(2, 'Insert', '2022-05-26 14:23:29', 'vevok', 'New_Vevo_ID_2'),
(3, 'Insert', '2022-05-26 14:23:29', 'vevok', 'New_Vevo_ID_3'),
(4, 'Insert', '2022-05-26 14:23:29', 'vevok', 'New_Vevo_ID_4'),
(5, 'Insert', '2022-05-26 14:23:29', 'vevok', 'New_Vevo_ID_5');

-- --------------------------------------------------------

--
-- Table structure for table `rendelesek`
--

DROP TABLE IF EXISTS `rendelesek`;
CREATE TABLE IF NOT EXISTS `rendelesek` (
  `RendelesekID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Term_szolgID` int(10) UNSIGNED DEFAULT NULL,
  `SzamlaID` int(10) UNSIGNED DEFAULT NULL,
  `Mennyiseg` int(11) DEFAULT NULL,
  PRIMARY KEY (`RendelesekID`),
  KEY `Term_szolgID` (`Term_szolgID`),
  KEY `SzamlaID` (`SzamlaID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rendelesek`
--

INSERT INTO `rendelesek` (`RendelesekID`, `Term_szolgID`, `SzamlaID`, `Mennyiseg`) VALUES
(1, 1, 1, 10),
(2, 2, 1, 10),
(3, 4, 2, 1),
(4, 5, 2, 1);

--
-- Triggers `rendelesek`
--
DROP TRIGGER IF EXISTS `after_rendelesek_delete`;
DELIMITER $$
CREATE TRIGGER `after_rendelesek_delete` AFTER DELETE ON `rendelesek` FOR EACH ROW BEGIN CALL Naplozas('Delete','rendelesek',concat('Deleted_Rendeles_ID', '_', OLD.RendelesekID)); END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `after_rendelesek_insert`;
DELIMITER $$
CREATE TRIGGER `after_rendelesek_insert` AFTER INSERT ON `rendelesek` FOR EACH ROW BEGIN CALL Naplozas('Insert','rendelesek',concat('New_Rendeles_ID', '_', NEW.RendelesekID)); END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `after_rendelesek_update`;
DELIMITER $$
CREATE TRIGGER `after_rendelesek_update` AFTER UPDATE ON `rendelesek` FOR EACH ROW BEGIN CALL Naplozas('Update','rendelesek', concat('Old_New_Update_params_', 'OLD: ', OLD.RendelesekID, ', ', OLD.Term_szolgID,', ', OLD.SzamlaID,', ', OLD.Mennyiseg, ', ',' NEW: ',NEW.RendelesekID, ', ', NEW.Term_szolgID,', ', NEW.SzamlaID,', ', NEW.Mennyiseg)); END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `szamlak`
--

DROP TABLE IF EXISTS `szamlak`;
CREATE TABLE IF NOT EXISTS `szamlak` (
  `SzamlaID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `VevoID` int(10) UNSIGNED DEFAULT NULL,
  `Datum` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`SzamlaID`),
  KEY `VevoID` (`VevoID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `szamlak`
--

INSERT INTO `szamlak` (`SzamlaID`, `VevoID`, `Datum`) VALUES
(1, 1, '2018-08-11 11:30:00'),
(2, 1, '2019-08-11 11:30:00');

--
-- Triggers `szamlak`
--
DROP TRIGGER IF EXISTS `after_szamlak_delete`;
DELIMITER $$
CREATE TRIGGER `after_szamlak_delete` AFTER DELETE ON `szamlak` FOR EACH ROW BEGIN CALL Naplozas('Delete','szamlak',concat('Old_Szamla_ID', '_', OLD.SzamlaID)); END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `after_szamlak_insert`;
DELIMITER $$
CREATE TRIGGER `after_szamlak_insert` AFTER INSERT ON `szamlak` FOR EACH ROW BEGIN CALL Naplozas('Insert','szamlak',concat('New_Szamla_ID', '_', NEW.SzamlaID)); END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `after_szamlak_update`;
DELIMITER $$
CREATE TRIGGER `after_szamlak_update` AFTER UPDATE ON `szamlak` FOR EACH ROW BEGIN CALL Naplozas('Update','szamlak', concat('Old_New_Update_params_', 'OLD: ', OLD.SzamlaID, ', ', OLD.VevoID,', ', OLD.Datum,', ',' NEW: ',NEW.SzamlaID, ', ', NEW.VevoID,', ', NEW.Datum)); END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `term_szolg`
--

DROP TABLE IF EXISTS `term_szolg`;
CREATE TABLE IF NOT EXISTS `term_szolg` (
  `Term_szolgID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nev` varchar(50) DEFAULT NULL,
  `isSzolgaltatas` tinyint(1) DEFAULT NULL,
  `egysegar` int(11) DEFAULT NULL,
  `BeszallitoID` int(10) UNSIGNED DEFAULT NULL,
  `mennyiseg` int(11) DEFAULT NULL,
  PRIMARY KEY (`Term_szolgID`),
  KEY `BeszallitoID` (`BeszallitoID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `term_szolg`
--

INSERT INTO `term_szolg` (`Term_szolgID`, `nev`, `isSzolgaltatas`, `egysegar`, `BeszallitoID`, `mennyiseg`) VALUES
(1, 'WC tisztito', 0, 50, 1, 100),
(2, 'Ablaktisztito', 0, 60, 1, 100),
(3, 'Bonyolult alkatresz', 0, 150, 2, 75),
(4, 'Dupla hamburger', 0, 87, 3, 10),
(5, 'Erotikus masszazs', 1, 500, 5, 0);

--
-- Triggers `term_szolg`
--
DROP TRIGGER IF EXISTS `after_term_szolg_delete`;
DELIMITER $$
CREATE TRIGGER `after_term_szolg_delete` AFTER DELETE ON `term_szolg` FOR EACH ROW BEGIN CALL Naplozas('Delete','term_szolg',concat('New_Term_szolg_ID', '_', OLD.Term_szolgID)); END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `after_term_szolg_insert`;
DELIMITER $$
CREATE TRIGGER `after_term_szolg_insert` AFTER INSERT ON `term_szolg` FOR EACH ROW BEGIN CALL Naplozas('Insert','term_szolg',concat('New_Term_szolg_ID', '_', NEW.Term_szolgID)); END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `after_term_szolg_update`;
DELIMITER $$
CREATE TRIGGER `after_term_szolg_update` AFTER UPDATE ON `term_szolg` FOR EACH ROW BEGIN CALL Naplozas('Update','term_szolg', concat('Old_New_Update_params_', 'OLD: ', OLD.term_szolgID, ', ', OLD.nev,', ', OLD.isSzolgaltatas,', ',OLD.egysegar,', ', OLD.beszallitoID,', ',OLD.mennyiseg,' NEW: ',NEW.term_szolgID, ', ', NEW.nev,', ', OLD.isSzolgaltatas,', ', NEW.egysegar,', ', NEW.beszallitoID,', ',NEW.mennyiseg)); END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `vevok`
--

DROP TABLE IF EXISTS `vevok`;
CREATE TABLE IF NOT EXISTS `vevok` (
  `VevoID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nev` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telefon` varchar(50) DEFAULT NULL,
  `cim` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`VevoID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vevok`
--

INSERT INTO `vevok` (`VevoID`, `nev`, `email`, `telefon`, `cim`) VALUES
(1, 'Attila', 'gattil@yahoo.com', '123456', 'Kereszt utca 13'),
(2, 'Elemer', 'elemer@yahoo.com', '123436', 'Sas utca 1'),
(3, 'Feri', 'feri123@yahoo.com', '1234567', 'Jos utca 11'),
(4, 'Geza', 'gezalegjobb@yahoo.com', '123256', 'Apati ter 5'),
(5, 'Joco', 'jocovagyok@yahoo.com', '567894', 'Jozsef utca 13');

--
-- Triggers `vevok`
--
DROP TRIGGER IF EXISTS `after_user_delete`;
DELIMITER $$
CREATE TRIGGER `after_user_delete` AFTER DELETE ON `vevok` FOR EACH ROW BEGIN CALL Naplozas('Delete','vevok',concat('Deleted_Vevo_ID', '_', OLD.VevoID)); END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `after_user_insert`;
DELIMITER $$
CREATE TRIGGER `after_user_insert` AFTER INSERT ON `vevok` FOR EACH ROW BEGIN CALL Naplozas('Insert','vevok',concat('New_Vevo_ID', '_', NEW.VevoID)); END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `after_user_update`;
DELIMITER $$
CREATE TRIGGER `after_user_update` AFTER UPDATE ON `vevok` FOR EACH ROW BEGIN CALL Naplozas('Update','vevok', concat('Old_New_Update_params_', 'OLD: ', OLD.VevoID, ', ', OLD.nev,', ', OLD.email,', ', OLD.telefon,', ',OLD.cim,' NEW: ',NEW.VevoID, ', ', NEW.nev,', ', NEW.email,', ', NEW.telefon,', ',NEW.cim)); END
$$
DELIMITER ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rendelesek`
--
ALTER TABLE `rendelesek`
  ADD CONSTRAINT `rendelesek_ibfk_1` FOREIGN KEY (`Term_szolgID`) REFERENCES `term_szolg` (`Term_szolgID`),
  ADD CONSTRAINT `rendelesek_ibfk_2` FOREIGN KEY (`SzamlaID`) REFERENCES `szamlak` (`SzamlaID`);

--
-- Constraints for table `szamlak`
--
ALTER TABLE `szamlak`
  ADD CONSTRAINT `szamlak_ibfk_1` FOREIGN KEY (`VevoID`) REFERENCES `vevok` (`VevoID`);

--
-- Constraints for table `term_szolg`
--
ALTER TABLE `term_szolg`
  ADD CONSTRAINT `term_szolg_ibfk_1` FOREIGN KEY (`BeszallitoID`) REFERENCES `beszallitok` (`BeszallitoID`);


--
-- Metadata
--
USE `phpmyadmin`;

--
-- Metadata for table beszallitok
--

--
-- Metadata for table naplo
--

--
-- Metadata for table rendelesek
--

--
-- Metadata for table szamlak
--

--
-- Metadata for table term_szolg
--

--
-- Metadata for table vevok
--

--
-- Metadata for database iwyrwv_testdb
--

--
-- Dumping data for table `pma__pdf_pages`
--

INSERT INTO `pma__pdf_pages` (`db_name`, `page_descr`) VALUES
('iwyrwv_testdb', 'alap');

SET @LAST_PAGE = LAST_INSERT_ID();
COMMIT;
