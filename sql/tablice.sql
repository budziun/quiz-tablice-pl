-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sty 31, 2025 at 11:40 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tablice`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `city`
--

CREATE TABLE `city` (
  `id` int(11) NOT NULL,
  `name` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `answer` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `multiple` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `name`, `answer`, `multiple`) VALUES
(1, 'CG', 'Grudziądz', NULL),
(2, 'CW', 'Włocławek', NULL),
(3, 'CB', 'Bydgoszcz', NULL),
(4, 'CT', 'Toruń', NULL),
(5, 'BI', 'Białystok', NULL),
(6, 'BS', 'Suwałki', NULL),
(7, 'BL', 'Łomża', NULL),
(8, 'DJ', 'Jelenia Góra', NULL),
(9, 'DL', 'Legnica', NULL),
(10, 'DB', 'Wałbrzych', NULL),
(11, 'DW', 'Wrocław', NULL),
(12, 'EP', 'Piotrków Trybunalski', NULL),
(13, 'ES', 'Skierniewice', NULL),
(14, 'EL', 'Łódź', NULL),
(15, 'FG', 'Gorzów Wielkopolski', NULL),
(16, 'FZ', 'Zielona Góra', NULL),
(17, 'GD', 'Gdańsk', NULL),
(18, 'GA', 'Gdynia', NULL),
(19, 'GSP', 'Sopot', NULL),
(20, 'GS', 'Słupsk', NULL),
(21, 'KK', 'Kraków', 'KR'),
(22, 'KN', 'Nowy Sącz', NULL),
(23, 'KT', 'Tarnów', NULL),
(24, 'LB', 'Biała Podlaska', NULL),
(25, 'LC', 'Chełm', NULL),
(26, 'LU', 'Lublin', NULL),
(27, 'LZ', 'Zamość', NULL),
(28, 'NE', 'Elbląg', NULL),
(29, 'NO', 'Olsztyn', NULL),
(30, 'OP', 'Opole', NULL),
(31, 'PK', 'Kalisz', NULL),
(32, 'PN', 'Konin', NULL),
(33, 'PL', 'Leszno', NULL),
(34, 'PO', 'Poznań', 'PY'),
(35, 'RK', 'Krosno', NULL),
(36, 'RP', 'Przemyśl', NULL),
(37, 'RZ', 'Rzeszów', NULL),
(38, 'RT', 'Tarnobrzeg', NULL),
(39, 'SB', 'Bielsko-Biała', NULL),
(40, 'SY', 'Bytom', NULL),
(41, 'SH', 'Chorzów', NULL),
(42, 'SC', 'Częstochowa', NULL),
(43, 'SD', 'Dąbrowa Górnicza', NULL),
(44, 'SG', 'Gliwice', NULL),
(45, 'SJZ', 'Jastrzębie-Zdrój', NULL),
(46, 'SJ', 'Jaworzno', NULL),
(47, 'SK', 'Katowice', NULL),
(48, 'SM', 'Mysłowice', NULL),
(49, 'SPI', 'Piekary Śląskie', NULL),
(50, 'SL', 'Ruda Śląska', NULL),
(51, 'SR', 'Rybnik', NULL),
(52, 'SI', 'Siemianowice Śląskie', NULL),
(53, 'SO', 'Sosnowiec', NULL),
(54, 'SW', 'Świętochłowice', NULL),
(55, 'ST', 'Tychy', NULL),
(56, 'SZ', 'Zabrze', NULL),
(57, 'SZO', 'Żory', NULL),
(58, 'TK', 'Kielce', NULL),
(59, 'WO', 'Ostrołęka', NULL),
(60, 'WP', 'Płock', NULL),
(61, 'WR', 'Radom', NULL),
(62, 'WS', 'Siedlce', NULL),
(63, 'WB', 'Warszawa Bemowo', NULL),
(64, 'WA', 'Warszawa Białołęka', NULL),
(65, 'WD', 'Warszawa Bielany', NULL),
(66, 'WE', 'Warszawa Mokotów', NULL),
(67, 'WU', 'Warszawa Ochota', NULL),
(68, 'WH', 'Warszawa Praga Północ', NULL),
(69, 'WF', 'Warszawa Praga Południe', NULL),
(70, 'WW', 'Warszawa Rembertów, Wilanów, Włochy', NULL),
(71, 'WI', 'Warszawa Śródmieście', NULL),
(72, 'WJ', 'Warszawa Targówek', NULL),
(73, 'WK', 'Warszawa Ursus', NULL),
(74, 'WN', 'Warszawa Ursynów', NULL),
(75, 'WT', 'Warszawa Wawer', NULL),
(76, 'WX', 'Warszawa Wesoła, Żoliborz', NULL),
(77, 'WY', 'Warszawa Wola', NULL),
(78, 'ZK', 'Koszalin', NULL),
(79, 'ZSW', 'Świnoujście', NULL),
(80, 'ZZ', 'Szczecin', 'ZS');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `nowwa`
--

CREATE TABLE `nowwa` (
  `id` int(11) NOT NULL,
  `name` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `answer` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `multiple` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `nowwa`
--

INSERT INTO `nowwa` (`id`, `name`, `answer`, `multiple`) VALUES
(1, 'CG', 'Grudziądz', NULL),
(2, 'CW', 'Włocławek', NULL),
(3, 'CB', 'Bydgoszcz', NULL),
(4, 'CT', 'Toruń', NULL),
(5, 'BI', 'Białystok', NULL),
(6, 'BS', 'Suwałki', NULL),
(7, 'BL', 'Łomża', NULL),
(8, 'DJ', 'Jelenia Góra', NULL),
(9, 'DL', 'Legnica', NULL),
(10, 'DB', 'Wałbrzych', NULL),
(11, 'DW', 'Wrocław', NULL),
(12, 'EP', 'Piotrków Trybunalski', NULL),
(13, 'ES', 'Skierniewice', NULL),
(14, 'EL', 'Łódź', NULL),
(15, 'FG', 'Gorzów Wielkopolski', NULL),
(16, 'FZ', 'Zielona Góra', NULL),
(17, 'GD', 'Gdańsk', NULL),
(18, 'GA', 'Gdynia', NULL),
(19, 'GSP', 'Sopot', NULL),
(20, 'GS', 'Słupsk', NULL),
(21, 'KK', 'Kraków', 'KR'),
(22, 'KN', 'Nowy Sącz', NULL),
(23, 'KT', 'Tarnów', NULL),
(24, 'LB', 'Biała Podlaska', NULL),
(25, 'LC', 'Chełm', NULL),
(26, 'LU', 'Lublin', NULL),
(27, 'LZ', 'Zamość', NULL),
(28, 'NE', 'Elbląg', NULL),
(29, 'NO', 'Olsztyn', NULL),
(30, 'OP', 'Opole', NULL),
(31, 'PK', 'Kalisz', NULL),
(32, 'PN', 'Konin', NULL),
(33, 'PL', 'Leszno', NULL),
(34, 'PO', 'Poznań', 'PY'),
(35, 'RK', 'Krosno', NULL),
(36, 'RP', 'Przemyśl', NULL),
(37, 'RZ', 'Rzeszów', NULL),
(38, 'RT', 'Tarnobrzeg', NULL),
(39, 'SB', 'Bielsko-Biała', NULL),
(40, 'SY', 'Bytom', NULL),
(41, 'SH', 'Chorzów', NULL),
(42, 'SC', 'Częstochowa', NULL),
(43, 'SD', 'Dąbrowa Górnicza', NULL),
(44, 'SG', 'Gliwice', NULL),
(45, 'SJZ', 'Jastrzębie-Zdrój', NULL),
(46, 'SJ', 'Jaworzno', NULL),
(47, 'SK', 'Katowice', NULL),
(48, 'SM', 'Mysłowice', NULL),
(49, 'SPI', 'Piekary Śląskie', NULL),
(50, 'SL', 'Ruda Śląska', NULL),
(51, 'SR', 'Rybnik', NULL),
(52, 'SI', 'Siemianowice Śląskie', NULL),
(53, 'SO', 'Sosnowiec', NULL),
(54, 'SW', 'Świętochłowice', NULL),
(55, 'ST', 'Tychy', NULL),
(56, 'SZ', 'Zabrze', NULL),
(57, 'SZO', 'Żory', NULL),
(58, 'TK', 'Kielce', NULL),
(59, 'WO', 'Ostrołęka', NULL),
(60, 'WP', 'Płock', NULL),
(61, 'WR', 'Radom', NULL),
(62, 'WS', 'Siedlce', NULL),
(63, 'ZK', 'Koszalin', NULL),
(64, 'ZSW', 'Świnoujście', NULL),
(65, 'ZZ', 'Szczecin', 'ZS');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `police`
--

CREATE TABLE `police` (
  `id` int(11) NOT NULL,
  `name` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `answer` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `multiple` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `police`
--

INSERT INTO `police` (`id`, `name`, `answer`, `multiple`) VALUES
(1, 'HPA', 'Komenda Główna Policji', NULL),
(2, 'HPZ', 'Komenda Stołeczna Policji', NULL),
(3, 'HPL', 'Szkoła Policji', NULL),
(4, 'HPB', 'dolnośląskie', NULL),
(5, 'HPD', 'lubelskie', NULL),
(6, 'HPF', 'łódzkie', NULL),
(7, 'HPH', 'mazowieckie', NULL),
(8, 'HPK', 'podkarpackie', NULL),
(9, 'HPN', 'pomorskie', NULL),
(10, 'HPS', 'świętokrzyskie', NULL),
(11, 'HPU', 'wielkopolskie', NULL),
(12, 'HPC', 'kujawsko-pomorskie', NULL),
(13, 'HPE', 'lubuskie', NULL),
(14, 'HPG', 'małopolskie', NULL),
(15, 'HPJ', 'opolskie', NULL),
(16, 'HPM', 'podlaskie', NULL),
(17, 'HPP', 'śląskie', NULL),
(18, 'HPT', 'warmińsko-mazurskie', NULL),
(19, 'HPW', 'zachodniopomorskie', NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `tablice`
--

CREATE TABLE `tablice` (
  `id` int(11) NOT NULL,
  `name` varchar(5) NOT NULL,
  `answer` varchar(60) NOT NULL,
  `multiple` varchar(3) DEFAULT NULL,
  `wojewodztwo` varchar(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tablice`
--

INSERT INTO `tablice` (`id`, `name`, `answer`, `multiple`, `wojewodztwo`) VALUES
(1, 'CG', 'Grudziądz', NULL, 'kujawsko-pomorskie'),
(2, 'CW', 'Włocławek', NULL, 'kujawsko-pomorskie'),
(3, 'CB', 'Bydgoszcz', NULL, 'kujawsko-pomorskie'),
(4, 'CT', 'Toruń', NULL, 'kujawsko-pomorskie'),
(5, 'CGR', 'powiat grudziądzki', NULL, 'kujawsko-pomorskie'),
(6, 'CAL', 'powiat aleksandrowski', NULL, 'kujawsko-pomorskie'),
(7, 'CBR', 'powiat brodnicki', NULL, 'kujawsko-pomorskie'),
(8, 'CBY', 'powiat bydgoski', NULL, 'kujawsko-pomorskie'),
(9, 'CCH', 'powiat chełmiński', NULL, 'kujawsko-pomorskie'),
(10, 'CGD', 'powiat golubsko-dobrzyński', NULL, 'kujawsko-pomorskie'),
(11, 'CIN', 'powiat inowrocławski', NULL, 'kujawsko-pomorskie'),
(12, 'CLI', 'powiat lipnowski', NULL, 'kujawsko-pomorskie'),
(13, 'CMG', 'powiat mogileński', NULL, 'kujawsko-pomorskie'),
(14, 'CNA', 'powiat nakielski', NULL, 'kujawsko-pomorskie'),
(15, 'CRA', 'powiat radziejowski', NULL, 'kujawsko-pomorskie'),
(16, 'CRY', 'powiat rypiński', NULL, 'kujawsko-pomorskie'),
(17, 'CSE', 'powiat sępoleński', NULL, 'kujawsko-pomorskie'),
(18, 'CSW', 'powiat świecki', NULL, 'kujawsko-pomorskie'),
(19, 'CTR', 'powiat toruński', NULL, 'kujawsko-pomorskie'),
(20, 'CTU', 'powiat tucholski', NULL, 'kujawsko-pomorskie'),
(21, 'CWA', 'powiat wąbrzeski', NULL, 'kujawsko-pomorskie'),
(22, 'CWL', 'powiat włocławski', NULL, 'kujawsko-pomorskie'),
(23, 'CZN', 'powiat żniński', NULL, 'kujawsko-pomorskie'),
(24, 'BI', 'Białystok', NULL, 'podlaskie'),
(25, 'BS', 'Suwałki', NULL, 'podlaskie'),
(26, 'BL', 'Łomża', NULL, 'podlaskie'),
(27, 'BAU', 'powiat augustowski', NULL, 'podlaskie'),
(28, 'BIA', 'powiat białostocki', NULL, 'podlaskie'),
(29, 'BBI', 'powiat bielski (podlaskie)', NULL, 'podlaskie'),
(30, 'BGR', 'powiat grajewski', NULL, 'podlaskie'),
(31, 'BHA', 'powiat hajnowski', NULL, 'podlaskie'),
(32, 'BMN', 'powiat moniecki', NULL, 'podlaskie'),
(33, 'BSE', 'powiat sejneński', NULL, 'podlaskie'),
(34, 'BSI', 'powiat siemiatycki', NULL, 'podlaskie'),
(35, 'BSK', 'powiat sokólski', NULL, 'podlaskie'),
(36, 'BSU', 'powiat suwalski', NULL, 'podlaskie'),
(37, 'BWM', 'powiat wysokomazowiecki', NULL, 'podlaskie'),
(38, 'BZA', 'powiat zambrowski', NULL, 'podlaskie'),
(39, 'BLM', 'powiat łomżyński', NULL, 'podlaskie'),
(40, 'DJ', 'Jelenia Góra', NULL, 'dolnośląskie'),
(41, 'DL', 'Legnica', NULL, 'dolnośląskie'),
(42, 'DB', 'Wałbrzych', NULL, 'dolnośląskie'),
(43, 'DW', 'Wrocław', NULL, 'dolnośląskie'),
(44, 'DBL', 'powiat bolesławiecki', NULL, 'dolnośląskie'),
(45, 'DDZ', 'powiat dzierżoniowski', NULL, 'dolnośląskie'),
(46, 'DGR', 'powiat górowski', NULL, 'dolnośląskie'),
(47, 'DGL', 'powiat głogowski', NULL, 'dolnośląskie'),
(48, 'DJE', 'powiat jeleniogórski', NULL, 'dolnośląskie'),
(49, 'DKA', 'powiat kamiennogórski', NULL, 'dolnośląskie'),
(50, 'DKL', 'powiat kłodzki', NULL, 'dolnośląskie'),
(51, 'DLE', 'powiat legnicki', NULL, 'dolnośląskie'),
(52, 'DLB', 'powiat lubański', NULL, 'dolnośląskie'),
(53, 'DLU', 'powiat lubiński', NULL, 'dolnośląskie'),
(54, 'DLW', 'powiat lwówecki', NULL, 'dolnośląskie'),
(55, 'DMI', 'powiat milicki', NULL, 'dolnośląskie'),
(56, 'DOL', 'powiat oleśnicki', NULL, 'dolnośląskie'),
(57, 'DOA', 'powiat oławski', NULL, 'dolnośląskie'),
(58, 'DPL', 'powiat polkowicki', NULL, 'dolnośląskie'),
(59, 'DSR', 'powiat średzki (dolnośląskie)', NULL, 'dolnośląskie'),
(60, 'DST', 'powiat strzeliński', NULL, 'dolnośląskie'),
(61, 'DSW', 'powiat świdnicki (dolnośląskie)', NULL, 'dolnośląskie'),
(62, 'DTR', 'powiat trzebnicki', NULL, 'dolnośląskie'),
(63, 'DBA', 'powiat wałbrzyski', NULL, 'dolnośląskie'),
(64, 'DWL', 'powiat wołowski', NULL, 'dolnośląskie'),
(65, 'DWR', 'powiat wrocławski', NULL, 'dolnośląskie'),
(66, 'DZA', 'powiat ząbkowicki', NULL, 'dolnośląskie'),
(67, 'DZG', 'powiat zgorzelecki', NULL, 'dolnośląskie'),
(68, 'DZL', 'powiat złotoryjski', NULL, 'dolnośląskie'),
(69, 'EP', 'Piotrków Trybunalski', NULL, 'łódzkie'),
(70, 'ES', 'Skierniewice', NULL, 'łódzkie'),
(71, 'EL', 'Łódź', NULL, 'łódzkie'),
(72, 'EBE', 'powiat bełchatowski', NULL, 'łódzkie'),
(73, 'EBR', 'powiat brzeziński', NULL, 'łódzkie'),
(74, 'EKU', 'powiat kutnowski', NULL, 'łódzkie'),
(75, 'EOP', 'powiat opoczyński', NULL, 'łódzkie'),
(76, 'EPA', 'powiat pabianicki', NULL, 'łódzkie'),
(77, 'EPJ', 'powiat pajęczański', NULL, 'łódzkie'),
(78, 'EPI', 'powiat piotrkowski', NULL, 'łódzkie'),
(79, 'EPD', 'powiat poddębicki', NULL, 'łódzkie'),
(80, 'ERA', 'powiat radomszczański', NULL, 'łódzkie'),
(81, 'ERW', 'powiat rawski', NULL, 'łódzkie'),
(82, 'ESI', 'powiat sieradzki', NULL, 'łódzkie'),
(83, 'ESK', 'powiat skierniewicki', NULL, 'łódzkie'),
(84, 'ETM', 'powiat tomaszowski (łódzkie)', NULL, 'łódzkie'),
(85, 'EWI', 'powiat wieluński', NULL, 'łódzkie'),
(86, 'EWE', 'powiat wieruszowski', NULL, 'łódzkie'),
(87, 'EZD', 'powiat zduńskowolski', NULL, 'łódzkie'),
(88, 'EZG', 'powiat zgierski', NULL, 'łódzkie'),
(89, 'ELA', 'powiat łaski', NULL, 'łódzkie'),
(90, 'ELE', 'powiat łęczycki', NULL, 'łódzkie'),
(91, 'ELW', 'powiat łódzki wschodni', NULL, 'łódzkie'),
(92, 'ELC', 'powiat łowicki', NULL, 'łódzkie'),
(93, 'FG', 'Gorzów Wielkopolski', NULL, 'lubuskie'),
(94, 'FZ', 'Zielona Góra', NULL, 'lubuskie'),
(95, 'FGW', 'powiat gorzowski', NULL, 'lubuskie'),
(96, 'FKR', 'powiat krośnieński (lubuskie)', NULL, 'lubuskie'),
(97, 'FMI', 'powiat międzyrzecki', NULL, 'lubuskie'),
(98, 'FNW', 'powiat nowosolski', NULL, 'lubuskie'),
(99, 'FSD', 'powiat strzelecko-drezdenecki', NULL, 'lubuskie'),
(100, 'FSU', 'powiat sulęciński', NULL, 'lubuskie'),
(101, 'FSW', 'powiat świebodziński', NULL, 'lubuskie'),
(102, 'FSL', 'powiat słubicki', NULL, 'lubuskie'),
(103, 'FWS', 'powiat wschowski', NULL, 'lubuskie'),
(104, 'FZG', 'powiat żagański', NULL, 'lubuskie'),
(105, 'FZA', 'powiat żarski', NULL, 'lubuskie'),
(106, 'FZI', 'powiat zielonogórski', NULL, 'lubuskie'),
(107, 'GD', 'Gdańsk', NULL, 'pomorskie'),
(108, 'GA', 'Gdynia', NULL, 'pomorskie'),
(109, 'GSP', 'Sopot', NULL, 'pomorskie'),
(110, 'GS', 'Słupsk', NULL, 'pomorskie'),
(111, 'GBY', 'powiat bytowski', NULL, 'pomorskie'),
(112, 'GCH', 'powiat chojnicki', NULL, 'pomorskie'),
(113, 'GCZ', 'powiat człuchowski', NULL, 'pomorskie'),
(114, 'GDA', 'powiat gdański', NULL, 'pomorskie'),
(115, 'GKA', 'powiat kartuski', NULL, 'pomorskie'),
(116, 'GKS', 'powiat kościerski', NULL, 'pomorskie'),
(117, 'GKW', 'powiat kwidzyński', NULL, 'pomorskie'),
(118, 'GLE', 'powiat lęborski', NULL, 'pomorskie'),
(119, 'GMB', 'powiat malborski', NULL, 'pomorskie'),
(120, 'GND', 'powiat nowodworski (pomorskie)', NULL, 'pomorskie'),
(121, 'GPU', 'powiat pucki', NULL, 'pomorskie'),
(122, 'GST', 'powiat starogardzki', NULL, 'pomorskie'),
(123, 'GSZ', 'powiat sztumski', NULL, 'pomorskie'),
(124, 'GSL', 'powiat słupski', NULL, 'pomorskie'),
(125, 'GTC', 'powiat tczewski', NULL, 'pomorskie'),
(126, 'GWE', 'powiat wejherowski', 'GWO', 'pomorskie'),
(127, 'KK', 'Kraków', 'KR', 'małopolskie'),
(128, 'KN', 'Nowy Sącz', NULL, 'małopolskie'),
(129, 'KT', 'Tarnów', NULL, 'małopolskie'),
(130, 'KBC', 'powiat bocheński', 'KBA', 'małopolskie'),
(131, 'KBR', 'powiat brzeski (małopolskie)', NULL, 'małopolskie'),
(132, 'KCH', 'powiat chrzanowski', NULL, 'małopolskie'),
(133, 'KDA', 'powiat dąbrowski', NULL, 'małopolskie'),
(134, 'KGR', 'powiat gorlicki', NULL, 'małopolskie'),
(135, 'KRA', 'powiat krakowski', NULL, 'małopolskie'),
(136, 'KLI', 'powiat limanowski', NULL, 'małopolskie'),
(137, 'KMI', 'powiat miechowski', NULL, 'małopolskie'),
(138, 'KMY', 'powiat myślenicki', NULL, 'małopolskie'),
(139, 'KNS', 'powiat nowosądecki', NULL, 'małopolskie'),
(140, 'KNT', 'powiat nowotarski', NULL, 'małopolskie'),
(141, 'KOL', 'powiat olkuski', NULL, 'małopolskie'),
(142, 'KOS', 'powiat oświęcimski', NULL, 'małopolskie'),
(143, 'KPR', 'powiat proszowicki', NULL, 'małopolskie'),
(144, 'KSU', 'powiat suski', NULL, 'małopolskie'),
(145, 'KTA', 'powiat tarnowski', NULL, 'małopolskie'),
(146, 'KTT', 'powiat tatrzański', NULL, 'małopolskie'),
(147, 'KWA', 'powiat wadowicki', NULL, 'małopolskie'),
(148, 'KWI', 'powiat wielicki', NULL, 'małopolskie'),
(149, 'LB', 'Biała Podlaska', NULL, 'lubelskie'),
(150, 'LC', 'Chełm', NULL, 'lubelskie'),
(151, 'LU', 'Lublin', NULL, 'lubelskie'),
(152, 'LZ', 'Zamość', NULL, 'lubelskie'),
(153, 'LBI', 'powiat bialski', NULL, 'lubelskie'),
(154, 'LBL', 'powiat biłgorajski', NULL, 'lubelskie'),
(155, 'LCH', 'powiat chełmski', NULL, 'lubelskie'),
(156, 'LHR', 'powiat hrubieszowski', NULL, 'lubelskie'),
(157, 'LJA', 'powiat janowski', NULL, 'lubelskie'),
(158, 'LKR', 'powiat kraśnicki', NULL, 'lubelskie'),
(159, 'LKS', 'powiat krasnostawski', NULL, 'lubelskie'),
(160, 'LLB', 'powiat lubartowski', NULL, 'lubelskie'),
(161, 'LUB', 'powiat lubelski', NULL, 'lubelskie'),
(162, 'LOP', 'powiat opolski (lubelskie)', NULL, 'lubelskie'),
(163, 'LPA', 'powiat parczewski', NULL, 'lubelskie'),
(164, 'LPU', 'powiat puławski', NULL, 'lubelskie'),
(165, 'LRA', 'powiat radzyński', NULL, 'lubelskie'),
(166, 'LRY', 'powiat rycki', NULL, 'lubelskie'),
(167, 'LSW', 'powiat świdnicki (lubelskie)', NULL, 'lubelskie'),
(168, 'LTM', 'powiat tomaszowski (lubelskie)', NULL, 'lubelskie'),
(169, 'LWL', 'powiat włodawski', NULL, 'lubelskie'),
(170, 'LZA', 'powiat zamojski', NULL, 'lubelskie'),
(171, 'LLE', 'powiat łęczyński', NULL, 'lubelskie'),
(172, 'LLU', 'powiat łukowski', NULL, 'lubelskie'),
(173, 'NE', 'Elbląg', NULL, 'warmińsko-mazurskie'),
(174, 'NO', 'Olsztyn', NULL, 'warmińsko-mazurskie'),
(175, 'NBA', 'powiat bartoszycki', NULL, 'warmińsko-mazurskie'),
(176, 'NBR', 'powiat braniewski', NULL, 'warmińsko-mazurskie'),
(177, 'NDZ', 'powiat działdowski', NULL, 'warmińsko-mazurskie'),
(178, 'NEB', 'powiat elbląski', NULL, 'warmińsko-mazurskie'),
(179, 'NEL', 'powiat ełcki', NULL, 'warmińsko-mazurskie'),
(180, 'NGI', 'powiat giżycki', NULL, 'warmińsko-mazurskie'),
(181, 'NGO', 'powiat gołdapski', NULL, 'warmińsko-mazurskie'),
(182, 'NIL', 'powiat iławski', NULL, 'warmińsko-mazurskie'),
(183, 'NKE', 'powiat kętrzyński', NULL, 'warmińsko-mazurskie'),
(184, 'NLI', 'powiat lidzbarski', NULL, 'warmińsko-mazurskie'),
(185, 'NMR', 'powiat mrągowski', NULL, 'warmińsko-mazurskie'),
(186, 'NNI', 'powiat nidzicki', NULL, 'warmińsko-mazurskie'),
(187, 'NNM', 'powiat nowomiejski', NULL, 'warmińsko-mazurskie'),
(188, 'NOE', 'powiat olecki', NULL, 'warmińsko-mazurskie'),
(189, 'NOL', 'powiat olsztyński', NULL, 'warmińsko-mazurskie'),
(190, 'NOS', 'powiat ostródzki', NULL, 'warmińsko-mazurskie'),
(191, 'NPI', 'powiat piski', NULL, 'warmińsko-mazurskie'),
(192, 'NSZ', 'powiat szczycieński', NULL, 'warmińsko-mazurskie'),
(193, 'NWE', 'powiat węgorzewski', NULL, 'warmińsko-mazurskie'),
(194, 'OP', 'Opole', NULL, 'opolskie'),
(195, 'OB', 'powiat brzeski (opolskie)', NULL, 'opolskie'),
(196, 'OGL', 'powiat głubczycki', NULL, 'opolskie'),
(197, 'OK', 'powiat kędzierzyńsko-kozielski', NULL, 'opolskie'),
(198, 'OKL', 'powiat kluczborski', NULL, 'opolskie'),
(199, 'OKR', 'powiat krapkowicki', NULL, 'opolskie'),
(200, 'ONA', 'powiat namysłowski', NULL, 'opolskie'),
(201, 'ONY', 'powiat nyski', NULL, 'opolskie'),
(202, 'OOL', 'powiat oleski', NULL, 'opolskie'),
(203, 'OPO', 'powiat opolski (opolskie)', NULL, 'opolskie'),
(204, 'OPR', 'powiat prudnicki', NULL, 'opolskie'),
(205, 'OST', 'powiat strzelecki', NULL, 'opolskie'),
(206, 'PK', 'Kalisz', NULL, 'wielkopolskie'),
(207, 'PN', 'Konin', NULL, 'wielkopolskie'),
(208, 'PL', 'Leszno', NULL, 'wielkopolskie'),
(209, 'PO', 'Poznań', 'PY', 'wielkopolskie'),
(210, 'PCH', 'powiat chodzieski', NULL, 'wielkopolskie'),
(211, 'PCT', 'powiat czarnkowsko-trzcianecki', NULL, 'wielkopolskie'),
(212, 'PGN', 'powiat gnieźnieński', NULL, 'wielkopolskie'),
(213, 'PGS', 'powiat gostyński', NULL, 'wielkopolskie'),
(214, 'PGO', 'powiat grodziski (wielkopolskie)', NULL, 'wielkopolskie'),
(215, 'PJA', 'powiat jarociński', NULL, 'wielkopolskie'),
(216, 'PKA', 'powiat kaliski', NULL, 'wielkopolskie'),
(217, 'PKE', 'powiat kępiński', NULL, 'wielkopolskie'),
(218, 'PKL', 'powiat kolski', NULL, 'wielkopolskie'),
(219, 'PKN', 'powiat koniński', NULL, 'wielkopolskie'),
(220, 'PKS', 'powiat kościański', NULL, 'wielkopolskie'),
(221, 'PKR', 'powiat krotoszyński', NULL, 'wielkopolskie'),
(222, 'PLE', 'powiat leszczyński', NULL, 'wielkopolskie'),
(223, 'PMI', 'powiat międzychodzki', NULL, 'wielkopolskie'),
(224, 'PNT', 'powiat nowotomyski', NULL, 'wielkopolskie'),
(225, 'POB', 'powiat obornicki', NULL, 'wielkopolskie'),
(226, 'POS', 'powiat ostrowski (wielkopolskie)', NULL, 'wielkopolskie'),
(227, 'POT', 'powiat ostrzeszowski', NULL, 'wielkopolskie'),
(228, 'PP', 'powiat pilski', NULL, 'wielkopolskie'),
(229, 'PPL', 'powiat pleszewski', NULL, 'wielkopolskie'),
(230, 'PZ', 'powiat poznański', NULL, 'wielkopolskie'),
(231, 'PRA', 'powiat rawicki', NULL, 'wielkopolskie'),
(232, 'PSR', 'powiat średzki (wielkopolskie)', NULL, 'wielkopolskie'),
(233, 'PSE', 'powiat śremski', NULL, 'wielkopolskie'),
(234, 'PSZ', 'powiat szamotulski', NULL, 'wielkopolskie'),
(235, 'PSL', 'powiat słupecki', NULL, 'wielkopolskie'),
(236, 'PTU', 'powiat turecki', NULL, 'wielkopolskie'),
(237, 'PWA', 'powiat wągrowiecki', NULL, 'wielkopolskie'),
(238, 'PWL', 'powiat wolsztyński', NULL, 'wielkopolskie'),
(239, 'PWR', 'powiat wrzesiński', NULL, 'wielkopolskie'),
(240, 'PZL', 'powiat złotowski', NULL, 'wielkopolskie'),
(241, 'RK', 'Krosno', NULL, 'podkarpackie'),
(242, 'RP', 'Przemyśl', NULL, 'podkarpackie'),
(243, 'RZ', 'Rzeszów', NULL, 'podkarpackie'),
(244, 'RT', 'Tarnobrzeg', NULL, 'podkarpackie'),
(245, 'RBI', 'powiat bieszczadzki', NULL, 'podkarpackie'),
(246, 'RBR', 'powiat brzozowski', NULL, 'podkarpackie'),
(247, 'RDE', 'powiat dębicki', NULL, 'podkarpackie'),
(248, 'RJA', 'powiat jarosławski', NULL, 'podkarpackie'),
(249, 'RJS', 'powiat jasielski', NULL, 'podkarpackie'),
(250, 'RKL', 'powiat kolbuszowski', NULL, 'podkarpackie'),
(251, 'RKR', 'powiat krośnieński (podkarpackie)', NULL, 'podkarpackie'),
(252, 'RLS', 'powiat leski', NULL, 'podkarpackie'),
(253, 'RLE', 'powiat leżajski', NULL, 'podkarpackie'),
(254, 'RLU', 'powiat lubaczowski', NULL, 'podkarpackie'),
(255, 'RMI', 'powiat mielecki', NULL, 'podkarpackie'),
(256, 'RNI', 'powiat niżański', NULL, 'podkarpackie'),
(257, 'RPR', 'powiat przemyski', NULL, 'podkarpackie'),
(258, 'RPZ', 'powiat przeworski', NULL, 'podkarpackie'),
(259, 'RRS', 'powiat ropczycko-sędziszowski', NULL, 'podkarpackie'),
(260, 'RZE', 'powiat rzeszowski', NULL, 'podkarpackie'),
(261, 'RSA', 'powiat sanocki', NULL, 'podkarpackie'),
(262, 'RST', 'powiat stalowowolski', NULL, 'podkarpackie'),
(263, 'RSR', 'powiat strzyżowski', NULL, 'podkarpackie'),
(264, 'RTA', 'powiat tarnobrzeski', NULL, 'podkarpackie'),
(265, 'RLA', 'powiat łańcucki', NULL, 'podkarpackie'),
(266, 'SB', 'Bielsko-Biała', NULL, 'śląskie'),
(267, 'SY', 'Bytom', NULL, 'śląskie'),
(268, 'SH', 'Chorzów', NULL, 'śląskie'),
(269, 'SC', 'Częstochowa', NULL, 'śląskie'),
(270, 'SD', 'Dąbrowa Górnicza', NULL, 'śląskie'),
(271, 'SG', 'Gliwice', NULL, 'śląskie'),
(272, 'SJZ', 'Jastrzębie-Zdrój', NULL, 'śląskie'),
(273, 'SJ', 'Jaworzno', NULL, 'śląskie'),
(274, 'SK', 'Katowice', NULL, 'śląskie'),
(275, 'SM', 'Mysłowice', NULL, 'śląskie'),
(276, 'SPI', 'Piekary Śląskie', NULL, 'śląskie'),
(277, 'SL', 'Ruda Śląska', NULL, 'śląskie'),
(278, 'SR', 'Rybnik', NULL, 'śląskie'),
(279, 'SI', 'Siemianowice Śląskie', NULL, 'śląskie'),
(280, 'SO', 'Sosnowiec', NULL, 'śląskie'),
(281, 'SW', 'Świętochłowice', NULL, 'śląskie'),
(282, 'ST', 'Tychy', NULL, 'śląskie'),
(283, 'SZ', 'Zabrze', NULL, 'śląskie'),
(284, 'SZO', 'Żory', NULL, 'śląskie'),
(285, 'SBE', 'powiat będziński', NULL, 'śląskie'),
(286, 'SBI', 'powiat bielski (śląskie)', NULL, 'śląskie'),
(287, 'SBL', 'powiat bieruńsko-lędziński', NULL, 'śląskie'),
(288, 'SCI', 'powiat cieszyński', NULL, 'śląskie'),
(289, 'SCZ', 'powiat częstochowski', NULL, 'śląskie'),
(290, 'SGL', 'powiat gliwicki', NULL, 'śląskie'),
(291, 'SKL', 'powiat kłobucki', NULL, 'śląskie'),
(292, 'SLU', 'powiat lubliniecki', NULL, 'śląskie'),
(293, 'SMI', 'powiat mikołowski', NULL, 'śląskie'),
(294, 'SMY', 'powiat myszkowski', NULL, 'śląskie'),
(295, 'SPS', 'powiat pszczyński', NULL, 'śląskie'),
(296, 'SRC', 'powiat raciborski', NULL, 'śląskie'),
(297, 'SRB', 'powiat rybnicki', NULL, 'śląskie'),
(298, 'STA', 'powiat tarnogórski', NULL, 'śląskie'),
(299, 'SWD', 'powiat wodzisławski', 'SWZ', 'śląskie'),
(300, 'SZA', 'powiat zawierciański', NULL, 'śląskie'),
(301, 'SZY', 'powiat żywiecki', NULL, 'śląskie'),
(302, 'TK', 'Kielce', NULL, 'świętokrzyskie'),
(303, 'TBU', 'powiat buski', NULL, 'świętokrzyskie'),
(304, 'TJE', 'powiat jędrzejowski', NULL, 'świętokrzyskie'),
(305, 'TKA', 'powiat kazimierski', NULL, 'świętokrzyskie'),
(306, 'TKI', 'powiat kielecki', NULL, 'świętokrzyskie'),
(307, 'TKN', 'powiat konecki', NULL, 'świętokrzyskie'),
(308, 'TOP', 'powiat opatowski', NULL, 'świętokrzyskie'),
(309, 'TOS', 'powiat ostrowiecki', NULL, 'świętokrzyskie'),
(310, 'TPI', 'powiat pińczowski', NULL, 'świętokrzyskie'),
(311, 'TSA', 'powiat sandomierski', NULL, 'świętokrzyskie'),
(312, 'TSK', 'powiat skarżyski', NULL, 'świętokrzyskie'),
(313, 'TST', 'powiat starachowicki', NULL, 'świętokrzyskie'),
(314, 'TSZ', 'powiat staszowski', NULL, 'świętokrzyskie'),
(315, 'TLW', 'powiat włoszczowski', NULL, 'świętokrzyskie'),
(316, 'WO', 'Ostrołęka', NULL, 'mazowieckie'),
(317, 'WP', 'Płock', NULL, 'mazowieckie'),
(318, 'WR', 'Radom', NULL, 'mazowieckie'),
(319, 'WS', 'Siedlce', NULL, 'mazowieckie'),
(320, 'WB', 'Warszawa Bemowo', NULL, 'mazowieckie'),
(321, 'WA', 'Warszawa Białołęka', NULL, 'mazowieckie'),
(322, 'WD', 'Warszawa Bielany', NULL, 'mazowieckie'),
(323, 'WE', 'Warszawa Mokotów', NULL, 'mazowieckie'),
(324, 'WU', 'Warszawa Ochota', NULL, 'mazowieckie'),
(325, 'WH', 'Warszawa Praga Północ', NULL, 'mazowieckie'),
(326, 'WF', 'Warszawa Praga Południe', NULL, 'mazowieckie'),
(327, 'WW', 'Warszawa Rembertów, Wilanów, Włochy', NULL, 'mazowieckie'),
(328, 'WI', 'Warszawa Śródmieście', NULL, 'mazowieckie'),
(329, 'WJ', 'Warszawa Targówek', NULL, 'mazowieckie'),
(330, 'WK', 'Warszawa Ursus', NULL, 'mazowieckie'),
(331, 'WN', 'Warszawa Ursynów', NULL, 'mazowieckie'),
(332, 'WT', 'Warszawa Wawer', NULL, 'mazowieckie'),
(333, 'WX', 'Warszawa Wesoła, Żoliborz', NULL, 'mazowieckie'),
(334, 'WY', 'Warszawa Wola', NULL, 'mazowieckie'),
(335, 'WBR', 'powiat białobrzeski', NULL, 'mazowieckie'),
(336, 'WCI', 'powiat ciechanowski', NULL, 'mazowieckie'),
(337, 'WG', 'powiat garwoliński', NULL, 'mazowieckie'),
(338, 'WGS', 'powiat gostyniński', NULL, 'mazowieckie'),
(339, 'WGM', 'powiat grodziski (mazowieckie)', NULL, 'mazowieckie'),
(340, 'WGR', 'powiat grójecki', NULL, 'mazowieckie'),
(341, 'WKZ', 'powiat kozienicki', NULL, 'mazowieckie'),
(342, 'WL', 'powiat legionowski', NULL, 'mazowieckie'),
(343, 'WLI', 'powiat lipski', NULL, 'mazowieckie'),
(344, 'WMA', 'powiat makowski', NULL, 'mazowieckie'),
(345, 'WM', 'powiat miński', NULL, 'mazowieckie'),
(346, 'WML', 'powiat mławski', NULL, 'mazowieckie'),
(347, 'WND', 'powiat nowodworski (mazowieckie)', NULL, 'mazowieckie'),
(348, 'WOR', 'powiat ostrowski (mazowieckie)', NULL, 'mazowieckie'),
(349, 'WOS', 'powiat ostrołęcki', NULL, 'mazowieckie'),
(350, 'WOT', 'powiat otwocki', NULL, 'mazowieckie'),
(351, 'WPI', 'powiat piaseczyński', NULL, 'mazowieckie'),
(352, 'WPR', 'powiat pruszkowski', 'WPS', 'mazowieckie'),
(353, 'WPZ', 'powiat przasnyski', NULL, 'mazowieckie'),
(354, 'WPY', 'powiat przysuski', NULL, 'mazowieckie'),
(355, 'WPU', 'powiat pułtuski', NULL, 'mazowieckie'),
(356, 'WPL', 'powiat płocki', NULL, 'mazowieckie'),
(357, 'WPN', 'powiat płoński', NULL, 'mazowieckie'),
(358, 'WRA', 'powiat radomski', NULL, 'mazowieckie'),
(359, 'WSI', 'powiat siedlecki', NULL, 'mazowieckie'),
(360, 'WSE', 'powiat sierpecki', NULL, 'mazowieckie'),
(361, 'WSC', 'powiat sochaczewski', NULL, 'mazowieckie'),
(362, 'WSK', 'powiat sokołowski', NULL, 'mazowieckie'),
(363, 'WSZ', 'powiat szydłowiecki', NULL, 'mazowieckie'),
(364, 'WZ', 'powiat warszawski zachodni', NULL, 'mazowieckie'),
(365, 'WWE', 'powiat węgrowski', NULL, 'mazowieckie'),
(366, 'WV', 'powiat wołomiński', 'WWL', 'mazowieckie'),
(367, 'WWY', 'powiat wyszkowski', NULL, 'mazowieckie'),
(368, 'WZU', 'powiat żuromiński', NULL, 'mazowieckie'),
(369, 'WZW', 'powiat zwoleński', NULL, 'mazowieckie'),
(370, 'WZY', 'powiat żyrardowski', NULL, 'mazowieckie'),
(371, 'WLS', 'powiat łosicki', NULL, 'mazowieckie'),
(372, 'ZK', 'Koszalin', NULL, 'zachodnio-pomorskie'),
(373, 'ZSW', 'Świnoujście', NULL, 'zachodnio-pomorskie'),
(374, 'ZZ', 'Szczecin', 'ZS', 'zachodnio-pomorskie'),
(375, 'ZBI', 'powiat białogardzki', NULL, 'zachodnio-pomorskie'),
(376, 'ZCH', 'powiat choszczeński', NULL, 'zachodnio-pomorskie'),
(377, 'ZDR', 'powiat drawski', NULL, 'zachodnio-pomorskie'),
(378, 'ZGL', 'powiat goleniowski', NULL, 'zachodnio-pomorskie'),
(379, 'ZGY', 'powiat gryficki', NULL, 'zachodnio-pomorskie'),
(380, 'ZGR', 'powiat gryfiński', NULL, 'zachodnio-pomorskie'),
(381, 'ZKA', 'powiat kamieński', NULL, 'zachodnio-pomorskie'),
(382, 'ZKO', 'powiat koszaliński', NULL, 'zachodnio-pomorskie'),
(383, 'ZKL', 'powiat kołobrzeski', NULL, 'zachodnio-pomorskie'),
(384, 'ZMY', 'powiat myśliborski', NULL, 'zachodnio-pomorskie'),
(385, 'ZPL', 'powiat policki', NULL, 'zachodnio-pomorskie'),
(386, 'ZPY', 'powiat pyrzycki', NULL, 'zachodnio-pomorskie'),
(387, 'ZST', 'powiat stargardzki', NULL, 'zachodnio-pomorskie'),
(388, 'ZSD', 'powiat świdwiński', NULL, 'zachodnio-pomorskie'),
(389, 'ZSZ', 'powiat szczecinecki', NULL, 'zachodnio-pomorskie'),
(390, 'ZSL', 'powiat sławieński', NULL, 'zachodnio-pomorskie'),
(391, 'ZWA', 'powiat wałecki', NULL, 'zachodnio-pomorskie'),
(392, 'ZLO', 'powiat łobeski', NULL, 'zachodnio-pomorskie');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wwa`
--

CREATE TABLE `wwa` (
  `id` int(11) NOT NULL,
  `name` varchar(5) NOT NULL,
  `answer` varchar(60) NOT NULL,
  `multiple` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `wwa`
--

INSERT INTO `wwa` (`id`, `name`, `answer`, `multiple`) VALUES
(1, 'WY', 'Warszawa Wola', NULL),
(2, 'WX', 'Warszawa Wesoła, Żoliborz', NULL),
(3, 'WT', 'Warszawa Wawer', NULL),
(4, 'WN', 'Warszawa Ursynów', NULL),
(5, 'WK', 'Warszawa Ursus', NULL),
(6, 'WJ', 'Warszawa Targówek', NULL),
(7, 'WI', 'Warszawa Śródmieście', NULL),
(8, 'WW', 'Warszawa Rembertów, Wilanów, Włochy', NULL),
(9, 'WF', 'Warszawa Praga Południe', NULL),
(10, 'WH', 'Warszawa Praga Północ', NULL),
(11, 'WU', 'Warszawa Ochota', NULL),
(12, 'WE', 'Warszawa Mokotów', NULL),
(13, 'WD', 'Warszawa Bielany', NULL),
(14, 'WA', 'Warszawa Białołęka', NULL),
(15, 'WB', 'Warszawa Bemowo', NULL),
(16, 'WZ', 'powiat warszawski zachodni', NULL);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `nowwa`
--
ALTER TABLE `nowwa`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `police`
--
ALTER TABLE `police`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `tablice`
--
ALTER TABLE `tablice`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `wwa`
--
ALTER TABLE `wwa`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT for table `nowwa`
--
ALTER TABLE `nowwa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `police`
--
ALTER TABLE `police`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tablice`
--
ALTER TABLE `tablice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=394;

--
-- AUTO_INCREMENT for table `wwa`
--
ALTER TABLE `wwa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
