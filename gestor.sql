-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 12, 2014 at 04:40 PM
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `access`
--

INSERT INTO `access` (`id`, `userId`, `reason`, `duration`, `date`, `applicationToken`, `approved`, `accessToken`, `pending`, `username`, `usermail`) VALUES
(1, 123, 'Modificar un error de tipografia', '00:00:02', '2014-04-07', '29fd4c4776a1dccc10ee7f7bf66e0c43e44e2c4026c49f1deb7f236aa1823a7b', 1, '89eb455630ab034e6e28541003ae40a3fbe1a406fe16221ebba71c4b36396619', 1, 'Gerardo', 'gera@mail.com'),
(2, 123, 'Modificar registros de alumnos', '02:00:00', '0000-00-00', '29fd4c4776a1dccc10ee7f7bf66e0c43e44e2c4026c49f1deb7f236aa1823a7b\r\n\r\n', 0, '', 1, 'Gerardo', 'gera@mail.com'),
(3, 12, 'Modificar ingresos de personal', '02:03:04', '0000-00-00', '29fd4c4776a1dccc10ee7f7bf66e0c43e44e2c4026c49f1deb7f236aa1823a7b', 0, '', 1, 'GerardoP', 'gerardo@mail.com'),
(4, 12, 'Modificar ingresos de personal', '02:03:04', '0000-00-00', '29fd4c4776a1dccc10ee7f7bf66e0c43e44e2c4026c49f1deb7f236aa1823a7b', 0, '', 1, 'GerardoP', 'gerardo@mail.com'),
(5, 12, 'Modificar ingresos de personal waaaaaaa', '02:03:04', '0000-00-00', '29fd4c4776a1dccc10ee7f7bf66e0c43e44e2c4026c49f1deb7f236aa1823a7b', 1, '0b7f4524f1134670fd8f674ffb26c59cec1f797cef9f3082af817f64d75aed7f', 0, 'GerardoP', 'gerardo@mail.com');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`id`, `name`, `registerDate`, `registeredBy`, `token`, `url`, `active`) VALUES
(1, 'ARSI', '2014-03-17', 'Pedro Perez', '29fd4c4776a1dccc10ee7f7bf66e0c43e44e2c4026c49f1deb7f236aa1823a7b', 'http://localhost:8082/gestor/external/externalApi.php', 1),
(2, 'ARSI2', '0000-00-00', 'Pedro Perez2', '90d9ec3b89369900219373513a61e657b4e8ec1ac1799d60d18d3e44ba1924bd', 'arsi.com/api/logrequest.php', 1),
(3, 'ARSI3', '0000-00-00', 'Pedro Perez2', '5f21b5bb77c7cefa6e27f2e940e169d6cebc8c72fc6589e89407340081c585fe', 'arsi.com/api/logrequest.php', 1),
(4, 'ARSI3', '0000-00-00', 'Pedro Perez2', '972836f4a70c2ca8b0550f5f2ce58923cc73c0ffd9743a02bca0f962cb1f8bf1', 'arsi.com/api/logrequest.php', 0),
(5, 'ARSI4', '0000-00-00', 'Pedro Perez2', '5eb8b99b2f1c82c025a06dee2aa81be9fa9e3f4ce4a1e28219e2b64bc91a2623', 'arsi.com/api/logrequest.php', 0);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `auditor`
--

INSERT INTO `auditor` (`id`, `name`, `company`, `date`, `accessToken`) VALUES
(1, 'Pedro Perez', 'Auditoria Legal', '2014-05-09', 'af351218aed4c037e5e0737f024e9398398aa495eeafb606a08b5990c7536d38'),
(2, 'Pedro Perez', 'Auditoria Legal', '2014-05-09', 'cbcb6104644883126a7bc6b91b0315673868254b9e2b5f195dc2b6fb36da3a18'),
(3, 'Martin', 'Auditores famosos', '2014-05-10', '7f5b03c38aa0edb18846d8bbeda7174bdd5b59b650b132c911073a5d22be527a'),
(4, 'Alex', 'americana', '2014-05-10', 'f745836bb0ebaab88c7f0d052beb56182611efe5c5b477491ef30ebcd35ecd26'),
(5, 'Alex', 'aq', '2014-05-10', '501551104f800319acfc6add0ee9efbbf2df7a4fd8a2c3990e4ba821efe4e306');

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
(1, 'Admin', 'gestor.octopus@gmail.com', '7u6`ølZHäwPRE‡¯\rª4µ2ª‹‚¿ÌÒ•G"', '2fc87af61eb5c5154629903179490679a71637460955a20366b262adfad2e327');
