-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 15, 2014 at 08:35 PM
-- Server version: 5.1.53
-- PHP Version: 5.3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gestor`
--

-- --------------------------------------------------------

--
-- Table structure for table `access`
--

CREATE TABLE IF NOT EXISTS `access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `reason` text NOT NULL,
  `duration` time NOT NULL,
  `date` date NOT NULL,
  `applicationToken` text NOT NULL,
  `approved` int(11) NOT NULL,
  `accessToken` text NOT NULL,
  `pending` int(11) NOT NULL DEFAULT '1',
  `username` varchar(200) NOT NULL,
  `usermail` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `access`
--

INSERT INTO `access` (`id`, `userId`, `reason`, `duration`, `date`, `applicationToken`, `approved`, `accessToken`, `pending`, `username`, `usermail`) VALUES
(18, 12, 'Modificar ingresos de personal', '02:03:04', '2014-05-15', '29fd4c4776a1dccc10ee7f7bf66e0c43e44e2c4026c49f1deb7f236aa1823a7b', 0, '', 1, 'GerardoP', 'gerardo@mail.com');

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE IF NOT EXISTS `application` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL,
  `registerDate` date NOT NULL,
  `registeredBy` varchar(200) NOT NULL,
  `token` text NOT NULL,
  `url` text NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`id`, `name`, `registerDate`, `registeredBy`, `token`, `url`, `active`) VALUES
(1, 'ARSI', '2014-03-17', 'Pedro Perez', '29fd4c4776a1dccc10ee7f7bf66e0c43e44e2c4026c49f1deb7f236aa1823a7b', 'http://localhost:8082/gestor/external/externalApi.php', 1),
(8, 'Test Application', '2014-05-15', 'JohnDoe', 'd28e02466c71a3aed6a7d8cc725d8acdfb39b4cb77ac24a3f49a0824ddb1434d', 'http://localhost:8082/gestor/external/externalApi.php', 1);

-- --------------------------------------------------------

--
-- Table structure for table `audit`
--

CREATE TABLE IF NOT EXISTS `audit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL,
  `applicationToken` int(11) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `accessToken` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `audit`
--


-- --------------------------------------------------------

--
-- Table structure for table `auditor`
--

CREATE TABLE IF NOT EXISTS `auditor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `company` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `accessToken` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `auditor`
--

INSERT INTO `auditor` (`id`, `name`, `company`, `date`, `accessToken`) VALUES
(19, 'Alejandro', 'Auditores AC', '2014-05-15', '4e2385a2843bb682471634bcdb5108d7e064f3b8d4cd4122213cd743fcac3504');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `salt` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `mail`, `salt`, `password`) VALUES
(1, 'Admin2', 'gestor.octopus2@gmail.com', '›š¡9[ÑD7©bàLQGÜÑ_‡žJw#"Ï€eêF', 'ee5ed092c1dfb75dbd4b29f42302211932daa5517dd7d2a3502740fb032cc905');
