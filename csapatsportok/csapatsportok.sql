-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2022. Nov 27. 16:31
-- Kiszolgáló verziója: 10.4.27-MariaDB
-- PHP verzió: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `csapatsportok`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `csapat`
--

CREATE TABLE `csapat` (
  `csapatid` int(5) NOT NULL,
  `nev` varchar(30) NOT NULL,
  `gyozelem` int(2) DEFAULT NULL,
  `vereseg` int(2) DEFAULT NULL,
  `dontetlen` int(2) DEFAULT NULL,
  `divizio` int(2) NOT NULL,
  `meccsid` int(5) NOT NULL,
  `edzoid` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `csapat`
--

INSERT INTO `csapat` (`csapatid`, `nev`, `gyozelem`, `vereseg`, `dontetlen`, `divizio`, `meccsid`, `edzoid`) VALUES
(2801, 'Espanyol', 10, 16, 12, 1, 43370, 66306),
(4493, 'Betis', 19, 11, 8, 1, 12187, 62138),
(21134, 'Sevilla', 18, 4, 16, 1, 3154, 43087),
(40335, 'Atletico Madrid', 21, 9, 8, 1, 551, 37203),
(41783, 'Valencia', 11, 12, 15, 1, 29184, 9451),
(43702, 'Celta Vigo', 12, 16, 10, 1, 41706, 80077),
(50344, 'Mallorca', 10, 19, 9, 1, 65098, 46370),
(54828, 'Barcelona', 21, 7, 10, 1, 66666, 6103),
(64983, 'Real Madrid', 26, 4, 8, 1, 81425, 58469),
(67377, 'Rayo Vallecano', 11, 18, 9, 1, 43370, 57317),
(77172, 'Osasuna', 12, 15, 11, 1, 30330, 11159),
(82393, 'Real Sociedad', 17, 10, 11, 1, 14771, 56192),
(82744, 'Villareal', 16, 11, 11, 1, 28871, 77540),
(86874, 'Elche', 11, 18, 9, 1, 45635, 86874),
(95989, 'Athletic Club', 14, 11, 13, 1, 28871, 84917),
(97925, 'Getafe', 8, 15, 15, 1, 45635, 31644);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `edzo`
--

CREATE TABLE `edzo` (
  `edzoid` int(5) NOT NULL,
  `nev` varchar(50) NOT NULL,
  `eletkor` int(5) NOT NULL,
  `egyesulet` varchar(50) NOT NULL,
  `szarmazas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `edzo`
--

INSERT INTO `edzo` (`edzoid`, `nev`, `eletkor`, `egyesulet`, `szarmazas`) VALUES
(6103, 'Xavi Hernandez', 42, 'Barcelona', 'Spanyolorszag'),
(9451, 'Gennaro Gattuso', 44, 'Valencia FC', 'Olaszorszag'),
(11159, 'Jagoba Arrasate', 44, 'CA Osasuna', 'Spanyolorszag'),
(31644, 'Quique Sánchez Flores', 57, 'Getafe FC', 'Spanyolorszag'),
(37203, 'Diego Simeone', 52, 'Atletico Madrid', 'Argentina'),
(43087, 'Jorge Sampaoli', 62, 'Sevilla FC', 'Argentina'),
(46370, 'Javier Aguirre', 63, 'RCD Mallorca', 'Mexiko'),
(56192, 'Imano Alguacil', 51, 'Real Sociedad', 'Spanyolorszag'),
(57317, 'Francisco Jémez Martín', 52, 'Rayo Vallecano', 'Spanyolorszag'),
(57318, 'Claudio Barragán', 58, 'Cadiz FC', 'Spanyolorszag'),
(58469, 'Carlo Ancelotti', 63, 'Real Madrid', 'Olaszorszag'),
(62138, 'Manuel Pellegrini', 69, 'Real Betis', 'Chile'),
(66306, 'Vicente Moreno', 48, 'RCD Espanyol', 'Spanyolorszag'),
(77540, 'Quique Setién', 64, 'Villareal', 'Spanyolorszag'),
(80077, 'Eduardo Coudet', 48, 'RC Celta De Vigo', 'Argentin'),
(84917, 'Ernesto Valverde', 58, 'Athletic Club', 'Spanyolorszag'),
(86874, 'Fran Escriba', 57, 'Elche FC', 'Spanyolorszag');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `gyakorlat`
--

CREATE TABLE `gyakorlat` (
  `edzoid` int(5) NOT NULL,
  `hossz` int(6) NOT NULL,
  `idopont` date NOT NULL,
  `melyikcsapat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `gyakorlat`
--

INSERT INTO `gyakorlat` (`edzoid`, `hossz`, `idopont`, `melyikcsapat`) VALUES
(9451, 90, '2022-10-27', 'Valencia'),
(6103, 60, '2022-11-24', 'Barcelona'),
(11159, 70, '2022-09-23', 'Osasuna'),
(31644, 80, '2021-02-10', 'Getafe'),
(37203, 85, '2021-05-12', 'Atletico Madrid'),
(43087, 60, '2021-03-17', 'Sevilla'),
(46370, 45, '2021-04-12', 'Mallorca'),
(56192, 120, '2021-06-03', 'Real Sociedad'),
(57317, 95, '2021-03-23', 'Rayo Vallecano'),
(57318, 70, '2022-08-13', 'Cadiz'),
(58469, 100, '2022-01-11', 'Real Madrid'),
(62138, 50, '2021-01-10', 'Real Betis'),
(66306, 110, '2021-05-08', 'Espanyol'),
(77540, 99, '2021-01-10', 'Villareal'),
(80077, 30, '2022-11-02', 'Celta Vigo'),
(84917, 78, '2021-07-17', 'Athletic Club'),
(86874, 90, '2021-03-30', 'Elche');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `jatekos`
--

CREATE TABLE `jatekos` (
  `jatekosid` int(5) NOT NULL,
  `nev` varchar(30) NOT NULL,
  `mezszam` int(2) NOT NULL,
  `szarmazas` varchar(30) NOT NULL,
  `csapatid` int(5) NOT NULL,
  `pozicio` varchar(30) NOT NULL,
  `kapitany` tinyint(1) NOT NULL,
  `gol` int(3) DEFAULT NULL,
  `golpassz` int(3) DEFAULT NULL,
  `lapok` int(3) DEFAULT NULL,
  `kor` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `jatekos`
--

INSERT INTO `jatekos` (`jatekosid`, `nev`, `mezszam`, `szarmazas`, `csapatid`, `pozicio`, `kapitany`, `gol`, `golpassz`, `lapok`, `kor`) VALUES
(6340, 'Robert Lewandowski', 9, 'Lengyel', 54828, 'ST', 0, 13, 4, 0, 34),
(7314, 'Daniel Parejo', 10, 'Spanyolorszag', 82744, 'CM', 0, 2, 10, 3, 33),
(12777, 'Stefan Savic', 15, 'Montenegro', 40335, 'CB', 0, 0, 0, 12, 31),
(15709, 'Iago Aspas', 10, 'Spanyol', 43702, 'ST', 0, 18, 6, 8, 35),
(24033, 'Oscar Trejo', 8, 'Argentin', 67377, 'CAM', 0, 3, 9, 13, 34),
(25345, 'Omar Alderete', 15, 'Paraguay', 97925, 'CB', 0, 2, 0, 15, 25),
(40371, 'Karim Benzema', 9, 'Francia', 64983, 'ST', 1, 27, 12, 0, 34),
(51422, 'Jordi Alba', 18, 'Spanyol', 54828, 'LB', 0, 2, 10, 11, 33),
(53079, 'Inigo Martínez', 4, 'Spanyol', 95989, 'CB', 0, 3, 0, 10, 31),
(57079, 'Ousmane Dembélé', 7, 'Francia', 54828, 'RW', 0, 1, 13, 3, 25),
(66744, 'Franco Russo', 5, 'Spanyol', 50344, 'CB', 0, 1, 0, 7, 28),
(73060, 'Enes Ünal', 10, 'Török', 97925, 'ST', 0, 16, 1, 8, 25),
(74031, 'Iker Muniain', 10, 'Spanyol', 95989, 'CAM', 0, 4, 10, 3, 29),
(86315, 'Juanmi', 7, 'Spanyol', 4493, 'ST', 0, 16, 4, 5, 29),
(88097, 'Sergio Busquets', 5, 'Spanyol', 54828, 'CDM', 1, 2, 0, 12, 34),
(92399, 'Raúl de Tomás', 11, 'Spanyol', 67377, 'ST', 0, 17, 3, 8, 28),
(94266, 'Vinícius Júnior', 18, 'Brazil', 64983, 'LW ', 0, 17, 10, 6, 22);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `meccs`
--

CREATE TABLE `meccs` (
  `meccsid` int(5) NOT NULL,
  `helyszin` varchar(60) NOT NULL,
  `idopont` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `meccs`
--

INSERT INTO `meccs` (`meccsid`, `helyszin`, `idopont`) VALUES
(551, 'Manuel Ruiz de Lopera', '2022-01-04'),
(3154, 'San Mamés', '2022-05-29'),
(12187, 'Mestalla', '2022-11-09'),
(14771, 'El Madrigal', '2021-10-05'),
(28871, 'José Zorilla', '2021-01-24'),
(29184, 'Estadio Metropolitano', '2021-06-10'),
(30330, 'Anoeta', '2021-02-14'),
(41706, 'La Rosaleda', '2021-09-23'),
(43370, 'Manuel Martínez Valero', '2021-11-24'),
(45635, 'Estadio de la Cartuja', '2022-03-16'),
(65098, 'Ciutat de Valencia', '2022-02-01'),
(72798, 'Lluís Companys', '2022-02-18'),
(75482, 'Mendizorrotza', '2021-04-16'),
(81425, 'Santiago Bernabeu', '2022-11-23'),
(84412, 'Balaídos', '2021-04-15'),
(94966, 'Ramón de Carranza', '2021-06-02'),
(98374, 'Ramón Sánchez-Pizjuán', '2022-03-14');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `tamogat`
--

CREATE TABLE `tamogat` (
  `tamogatoid` int(5) NOT NULL,
  `csapatid` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `tamogat`
--

INSERT INTO `tamogat` (`tamogatoid`, `csapatid`) VALUES
(5679, 41783),
(8163, 21134),
(9465, 50344),
(18890, 4493),
(21454, 77172),
(28888, 54828),
(28998, 54828),
(32209, 64983),
(37558, 67377),
(39331, 82393),
(40839, 64983),
(44314, 54828),
(44814, 86874),
(55579, 97925),
(69154, 2801),
(78727, 95989),
(92269, 43702),
(93033, 40335),
(96611, 82744);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `csapat`
--
ALTER TABLE `csapat`
  ADD PRIMARY KEY (`csapatid`),
  ADD KEY `edzoid` (`edzoid`),
  ADD KEY `meccsid` (`meccsid`);

--
-- A tábla indexei `edzo`
--
ALTER TABLE `edzo`
  ADD PRIMARY KEY (`edzoid`);

--
-- A tábla indexei `gyakorlat`
--
ALTER TABLE `gyakorlat`
  ADD KEY `edzoid` (`edzoid`);

--
-- A tábla indexei `jatekos`
--
ALTER TABLE `jatekos`
  ADD PRIMARY KEY (`jatekosid`),
  ADD KEY `csapatid` (`csapatid`);

--
-- A tábla indexei `meccs`
--
ALTER TABLE `meccs`
  ADD PRIMARY KEY (`meccsid`);

--
-- A tábla indexei `tamogat`
--
ALTER TABLE `tamogat`
  ADD PRIMARY KEY (`tamogatoid`,`csapatid`) USING BTREE,
  ADD KEY `csapatid` (`csapatid`);

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `csapat`
--
ALTER TABLE `csapat`
  ADD CONSTRAINT `csapat_ibfk_1` FOREIGN KEY (`edzoid`) REFERENCES `edzo` (`edzoid`);

--
-- Megkötések a táblához `gyakorlat`
--
ALTER TABLE `gyakorlat`
  ADD CONSTRAINT `gyakorlat_ibfk_1` FOREIGN KEY (`edzoid`) REFERENCES `edzo` (`edzoid`);

--
-- Megkötések a táblához `jatekos`
--
ALTER TABLE `jatekos`
  ADD CONSTRAINT `jatekos_ibfk_1` FOREIGN KEY (`csapatid`) REFERENCES `csapat` (`csapatid`);

--
-- Megkötések a táblához `tamogat`
--
ALTER TABLE `tamogat`
  ADD CONSTRAINT `tamogat_ibfk_1` FOREIGN KEY (`csapatid`) REFERENCES `csapat` (`csapatid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
