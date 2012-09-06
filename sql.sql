-- phpMyAdmin SQL Dump
-- version 3.2.2.1
-- http://www.phpmyadmin.net
--
-- Machine: localhost:3306
-- Genereertijd: 06 Sept 2012 om 14:50
-- Serverversie: 5.1.40
-- PHP-Versie: 5.2.12

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `sleepoefeningdb`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `drag_oefening`
--

CREATE TABLE IF NOT EXISTS `drag_oefening` (
  `id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `oefening` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Gegevens worden uitgevoerd voor tabel `drag_oefening`
--

INSERT INTO `drag_oefening` (`id`, `name`, `image`, `oefening`) VALUES
(1, 'Skelet', 'res/skelet.jpg', 0),
(2, 'Balie', 'res/balie.jpg', 0),
(3, 'Recept', 'res/recept.jpg', 0),
(4, 'Arts', 'res/arts.jpg', 0),
(5, 'Bezorging', 'res/bezorging.jpg', 0),
(6, 'Assistente', 'res/assistente.jpg', 0),
(7, 'Medicijnenkastmeneer', 'res/medicijnenkast.jpg', 0),
(8, 'Injectie', 'res/injectie.jpg', 0),
(9, 'Apotheker', 'res/apotheker.jpg', 0),
(10, 'Medicijnstrip', 'res/medicijnstrip.jpg', 0),
(11, '5 Cent', 'res/cent.jpg', 0),
(12, 'Zalf', 'res/zalf.jpg', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `drag_oefeningen`
--

CREATE TABLE IF NOT EXISTS `drag_oefeningen` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Gegevens worden uitgevoerd voor tabel `drag_oefeningen`
--

INSERT INTO `drag_oefeningen` (`id`, `name`) VALUES
(1, 'Medisch');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `jewe`
--

CREATE TABLE IF NOT EXISTS `jewe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `woord` varchar(50) NOT NULL,
  `fwoord` varchar(50) NOT NULL,
  `plaatje` varchar(200) NOT NULL,
  `geluid` varchar(200) NOT NULL,
  `geluid2` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Gegevens worden uitgevoerd voor tabel `jewe`
--


-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `oefening1`
--

CREATE TABLE IF NOT EXISTS `oefening1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `woord` varchar(50) NOT NULL,
  `fwoord` varchar(50) NOT NULL,
  `plaatje` varchar(200) NOT NULL,
  `geluid` varchar(200) NOT NULL,
  `geluid2` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Gegevens worden uitgevoerd voor tabel `oefening1`
--


-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `oefening2`
--

CREATE TABLE IF NOT EXISTS `oefening2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `woord` varchar(50) NOT NULL,
  `fwoord` varchar(50) NOT NULL,
  `plaatje` varchar(200) NOT NULL,
  `geluid` varchar(200) NOT NULL,
  `geluid2` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Gegevens worden uitgevoerd voor tabel `oefening2`
--


-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `oefening3`
--

CREATE TABLE IF NOT EXISTS `oefening3` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `woord` varchar(50) NOT NULL,
  `fwoord` varchar(50) NOT NULL,
  `plaatje` varchar(200) NOT NULL,
  `geluid` varchar(200) NOT NULL,
  `geluid2` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Gegevens worden uitgevoerd voor tabel `oefening3`
--


-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `hash` varchar(225) NOT NULL,
  `ip` varchar(225) NOT NULL,
  `logintime` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Gegevens worden uitgevoerd voor tabel `sessions`
--

INSERT INTO `sessions` (`id`, `userid`, `hash`, `ip`, `logintime`) VALUES
(2, 1, 'e4ceb30b3dd4cd2132493482b35e1194', '37.34.56.55', '2012-09-06');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Gegevens worden uitgevoerd voor tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');
