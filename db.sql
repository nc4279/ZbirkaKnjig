-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Gostitelj: 127.0.0.1
-- Čas nastanka: 23. maj 2021 ob 21.45
-- Različica strežnika: 10.4.18-MariaDB
-- Različica PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Zbirka podatkov: `book`
--

-- --------------------------------------------------------

--
-- Struktura tabele `knjiga`
--

CREATE TABLE `knjiga` (
  `id` int(11) NOT NULL,
  `naslov` varchar(50) COLLATE utf8_slovenian_ci NOT NULL,
  `avtor` text COLLATE utf8_slovenian_ci NOT NULL,
  `datum` date NOT NULL,
  `cena` decimal(6,0) NOT NULL,
  `ocena` int(1) NOT NULL,
  `mnenje` text COLLATE utf8_slovenian_ci DEFAULT NULL,
  `user` varchar(30) COLLATE utf8_slovenian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Odloži podatke za tabelo `knjiga`
--

INSERT INTO `knjiga` (`id`, `naslov`, `avtor`, `datum`, `cena`, `ocena`, `mnenje`, `user`) VALUES
(16, 'zhhh', 'hhhhh', '2021-05-04', '3', 2, 'hihi', 'neki'),
(17, 'abc', 'ok', '2021-05-05', '10', 4, 'kk', 'neki'),
(18, 'nina', 'cerar nina', '2021-05-05', '20', 5, 'the best', 'neki'),
(21, 'Premagani led', 'Jane Colls', '2015-02-20', '32', 4, 'zelo zanimivo branje', 'nina10'),
(22, 'Poljub', 'Kell Martin', '2016-05-10', '35', 5, 'zelo romantična knjiga', 'nina10'),
(23, 'Lepote morja', 'Tine Zajek', '2019-05-03', '0', 2, 'meh', 'nina10');

-- --------------------------------------------------------

--
-- Struktura tabele `kviz`
--

CREATE TABLE `kviz` (
  `id` int(11) NOT NULL,
  `datum` date NOT NULL,
  `rezultat` int(11) NOT NULL,
  `uporabnik` varchar(30) COLLATE utf8_slovenian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Odloži podatke za tabelo `kviz`
--

INSERT INTO `kviz` (`id`, `datum`, `rezultat`, `uporabnik`) VALUES
(13, '2021-05-21', 90, 'neki'),
(14, '2021-05-22', 20, 'neki'),
(16, '2021-05-23', 80, 'nina10');

-- --------------------------------------------------------

--
-- Struktura tabele `uporabnik`
--

CREATE TABLE `uporabnik` (
  `up_ime` varchar(30) COLLATE utf8_slovenian_ci NOT NULL,
  `geslo` varchar(130) COLLATE utf8_slovenian_ci NOT NULL,
  `ime` text COLLATE utf8_slovenian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Odloži podatke za tabelo `uporabnik`
--

INSERT INTO `uporabnik` (`up_ime`, `geslo`, `ime`) VALUES
('neki', '$2y$10$sh7RzFsVXCVYedR34JhS6.ht6DyJvKSBluP2QjbguC7vcBID33pSS', 'neki'),
('nina10', '$2y$10$eVGdob/TULLk8Vt/f9Ud.uvc/HA1t4SCVv2sSHVghAridkkELyvvu', 'Nina');

-- --------------------------------------------------------

--
-- Struktura tabele `vprašanje`
--

CREATE TABLE `vprašanje` (
  `id` int(11) NOT NULL,
  `vprašanje` varchar(150) COLLATE utf8_slovenian_ci NOT NULL,
  `odgovor` varchar(50) COLLATE utf8_slovenian_ci NOT NULL,
  `odgovor1` varchar(50) COLLATE utf8_slovenian_ci NOT NULL,
  `odgovor2` varchar(50) COLLATE utf8_slovenian_ci NOT NULL,
  `pravilno` varchar(50) COLLATE utf8_slovenian_ci NOT NULL,
  `user` varchar(30) COLLATE utf8_slovenian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Odloži podatke za tabelo `vprašanje`
--

INSERT INTO `vprašanje` (`id`, `vprašanje`, `odgovor`, `odgovor1`, `odgovor2`, `pravilno`, `user`) VALUES
(3, 'Kdaj sta bili napisani prvi slovenski knjigi Katekizem in Abecednik?', '1550', '1522', '1560', '1550', 'neki'),
(5, 'Kdo je napisal prvi slovenski pravopis?', 'Adam Bohorič', 'Primož Trubar', 'Jurij Dalmatin', 'Adam Bohorič', NULL),
(6, 'Kdo je napisal prvi slovenski roman?', 'France Prešeren', 'Josip Jurčič', 'Ivan Cankar', 'Josip Jurčič', NULL),
(7, 'Kako se imenuje prvi slovenski roman, ki ga je napisal Josip Jurčič?', 'Moj brat', 'Sosedov brat', 'Deseti brat', 'Deseti brat', NULL),
(8, 'Na kateri dan praznujemo svetovni dan knjige?', '3.2', '23.4', '12.3', '23.4', NULL),
(9, 'Z čim se je začela slovenska književnost?', 'Z zapisi Celovskega rokopisa', 'Z zapisi Stiškega rokopisa', 'Z zapisi Brižinskih spomenikov', 'Z zapisi Brižinskih spomenikov', NULL),
(10, 'Kako se glasi prva slovenska tragedija?', 'Tugomer', 'Odiseja', 'Viskoz', 'Tugomer', NULL),
(11, 'Kdo je napisal prvo slovensko komedijo \"Županova Micka\" ?', 'Fran Levstik', 'Ivan Cankar', 'Anton Tomaž Linhart', 'Anton Tomaž Linhart', NULL),
(12, 'Kdo je napisal prvo slovensko povest \"Sreča v nesreči\"?', 'Janez Cigler', 'Marko Pohlin', 'Fran Levstik', 'Janez Cigler', NULL),
(13, 'Popotovanje iz Litije do Čateža je eno najbolj znanih slovenskih potopisnih del. Kdo ga je napisal?', 'Prežihov Voranc', 'Josip Jurčil', 'Fran Levstik', 'Fran Levstik', NULL),
(14, ' Kateri Ivan je avtor del Visoška kronika, Med gorami, Mrtva srca in Cvetje v jeseni?', 'Ivan Pregelj', 'Ivan Cankar', 'Ivan Tavčar', 'Ivan Tavčar', NULL),
(15, 'Lovro Kuhar je napisal znamenita dela kot so Solzice, Samorastniki, Požganica, Jamnica, Doberdob. Pod katerim psevdonimom je znan Lovro Kuhar?', 'Prežihov Voranc', 'France Bevk', 'Ciril Kosmač', 'Prežihov Voranc', NULL),
(16, 'Kje se je rodil Ivan Cankar?', 'V Celju', 'V Laškem', 'V Vrhniki', 'V Vrhniki', NULL),
(17, 'Poleg pisatelja, je bil Ivan Tavčar tudi ...?', 'Ljubljanski župan', 'Učitelj', 'Igralec', 'Ljubljanski župan', NULL);

--
-- Indeksi zavrženih tabel
--

--
-- Indeksi tabele `knjiga`
--
ALTER TABLE `knjiga`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`);

--
-- Indeksi tabele `kviz`
--
ALTER TABLE `kviz`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_kviz_up` (`uporabnik`);

--
-- Indeksi tabele `uporabnik`
--
ALTER TABLE `uporabnik`
  ADD PRIMARY KEY (`up_ime`),
  ADD KEY `up_ime` (`up_ime`);

--
-- Indeksi tabele `vprašanje`
--
ALTER TABLE `vprašanje`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_vpr_up` (`user`);

--
-- AUTO_INCREMENT zavrženih tabel
--

--
-- AUTO_INCREMENT tabele `knjiga`
--
ALTER TABLE `knjiga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT tabele `kviz`
--
ALTER TABLE `kviz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT tabele `vprašanje`
--
ALTER TABLE `vprašanje`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Omejitve tabel za povzetek stanja
--

--
-- Omejitve za tabelo `knjiga`
--
ALTER TABLE `knjiga`
  ADD CONSTRAINT `fk_knjiga_up` FOREIGN KEY (`user`) REFERENCES `uporabnik` (`up_ime`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Omejitve za tabelo `kviz`
--
ALTER TABLE `kviz`
  ADD CONSTRAINT `fk_kviz_up` FOREIGN KEY (`uporabnik`) REFERENCES `uporabnik` (`up_ime`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Omejitve za tabelo `vprašanje`
--
ALTER TABLE `vprašanje`
  ADD CONSTRAINT `fk_vpr_up` FOREIGN KEY (`user`) REFERENCES `uporabnik` (`up_ime`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
