-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 04-02-2021 a les 13:33:45
-- Versió del servidor: 5.7.18-ndb-7.6.3
-- PHP Version: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gestor_permisos`
--

-- --------------------------------------------------------

--
-- Estructura de la taula `administradores`
--

CREATE TABLE IF NOT EXISTS `administradores` (
  `niu` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de la taula `ambitos`
--

CREATE TABLE IF NOT EXISTS `ambitos` (
`idAmbitos` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_estonian_ci DEFAULT NULL,
  `tabla` varchar(100) COLLATE utf8_estonian_ci DEFAULT NULL,
  `nom` varchar(100) COLLATE utf8_estonian_ci DEFAULT NULL,
  `asignable` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci;

--
-- Bolcant dades de la taula `ambitos`
--

INSERT INTO `ambitos` (`idAmbitos`, `nombre`, `tabla`, `nom`, `asignable`) VALUES
(1, 'Centros', 'idCentro', 'Centres', 1),
(2, 'Estudios', 'idEstudio', 'Estudis', 1),
(3, 'Asignaturas', 'idAsignaturas', 'Assignatures', 0),
(4, 'Departamentos', 'idDepartamentos', 'Departaments', 1),
(5, 'Grupo', 'idGrupo', 'Grups', 0),
(6, 'Profesores', 'niu', 'Professors', 0),
(7, 'Universidad', NULL, 'Universitat', 1),
(8, 'Estudiante', NULL, 'Estudiant', 0);

-- --------------------------------------------------------

--
-- Estructura de la taula `anio`
--

CREATE TABLE IF NOT EXISTS `anio` (
  `inicio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci;

--
-- Bolcant dades de la taula `anio`
--

INSERT INTO `anio` (`inicio`) VALUES
(2020);

-- --------------------------------------------------------

--
-- Estructura de la taula `asignaturas`
--

CREATE TABLE IF NOT EXISTS `asignaturas` (
  `idAsignaturas` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_estonian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci;

--
-- Bolcant dades de la taula `asignaturas`
--

INSERT INTO `asignaturas` (`idAsignaturas`, `nombre`) VALUES
(102687, 'Tractament Digital del Senyal'),
(102691, 'Comunicacions Òptiques'),
(102696, 'Teoria de la Comunicació'),
(102699, 'Xarxes de Telecomunicació'),
(102710, 'Sistemes de Radiocomunicació'),
(102740, 'Sistemes Distribuïts'),
(102741, 'Gest.Adm.Bases de Dades'),
(102742, 'Tecnologies Desenv. Internet i Web'),
(102743, 'Enginyeria del Software'),
(102744, 'Bases de Dades'),
(102745, 'Legislació'),
(102746, 'Xarxes'),
(102747, 'Sistemes Operatius'),
(102748, 'Treball de Final de Grau'),
(102749, 'Tecnologies Avançades d''Internet'),
(102750, 'Sistemes i Tecnologies Web'),
(102751, 'Infraest.Tecnologia i Xarxes'),
(102752, 'Sistemes d''Informació'),
(102753, 'Visualització Gràfica Interactiva'),
(102754, 'Sistemes Multimèdia'),
(102757, 'Garant.Inform.Seguretat'),
(102758, 'Test i Qualitat del Software'),
(102759, 'Disseny de Software'),
(102760, 'Gestió de Projectes'),
(102761, 'Anglès Professional II'),
(102762, 'Anglès Professional I'),
(102763, 'Requisits del Software'),
(102764, 'Metodologia de la Programació'),
(102765, 'Fonaments Dels Computadors'),
(102767, 'Laboratori de Programació'),
(102768, 'Intel·ligència Artificial'),
(102769, 'Informació i Seguretat'),
(102770, 'Tendències Actuals'),
(102771, 'Electricitat i Electrònica'),
(102772, 'Matemàtica Discreta'),
(102773, 'Fonam.Tecnol.D.Informació'),
(102774, 'Estructura de Computadors'),
(102775, 'Arquitectura de Computadors'),
(102776, 'Gestió i Administració de Xarxes'),
(102777, 'Computació d''Altes Prestacions'),
(102778, 'Arquitectures Avançades'),
(102781, 'Mod.Qualit.Gestió de TIC'),
(102782, 'Compiladors'),
(102783, 'Anàlisi i Disseny d''Algorismes'),
(102784, 'Visió per Computador'),
(102785, 'Robòtica, Llenguatge i Planificació'),
(102786, 'Coneixement, Raonament i Incertesa'),
(102787, 'Aprenentatge Computacional'),
(102788, 'Laboratori Integrat de Software'),
(102789, 'Gesti.Desenv.Software'),
(102790, 'Arquitect.Tecnolog.Software'),
(102791, 'Sistemes Encastats'),
(102792, 'Prototipatge de Sistemes Encastats'),
(102793, 'Microprocessadors i Perifèrics'),
(102794, 'Integració Hardware/software'),
(103518, 'Transmissors i Receptors de Telec.'),
(103801, 'Àlgebra'),
(103802, 'Càlcul'),
(103803, 'Estadística'),
(103804, 'Ètica per a l''Enginyeria'),
(103805, 'Fonaments d''Enginyeria'),
(103806, 'Fonaments d''Informàtica'),
(103807, 'Organització i Gestió d''Empreses'),
(103983, 'Pràctiques Externes'),
(105072, 'Tecnologia Blockchain i Criptomoned'),
(105073, 'Tecnologies Compressió de la Inform'),
(105074, 'Aplicacions de la Teoria de Codis'),
(105075, 'Internet de les Coses');

-- --------------------------------------------------------

--
-- Estructura de la taula `asignaturas_has_estudios`
--

CREATE TABLE IF NOT EXISTS `asignaturas_has_estudios` (
  `Asignaturas_idAsignaturas` int(11) NOT NULL,
  `Estudios_idEstudios` int(11) NOT NULL,
  `Estudio_Centros_idCentros` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci;

--
-- Bolcant dades de la taula `asignaturas_has_estudios`
--

INSERT INTO `asignaturas_has_estudios` (`Asignaturas_idAsignaturas`, `Estudios_idEstudios`, `Estudio_Centros_idCentros`) VALUES
(102687, 1207, 115),
(102691, 1207, 115),
(102696, 1207, 115),
(102699, 1207, 115),
(102710, 1207, 115),
(102740, 958, 115),
(102740, 1207, 115),
(102741, 958, 115),
(102742, 958, 115),
(102743, 958, 115),
(102744, 958, 115),
(102745, 958, 115),
(102746, 958, 115),
(102747, 958, 115),
(102748, 958, 115),
(102749, 958, 115),
(102749, 1207, 115),
(102750, 958, 115),
(102750, 1207, 115),
(102751, 958, 115),
(102752, 958, 115),
(102752, 1207, 115),
(102753, 958, 115),
(102754, 958, 115),
(102757, 958, 115),
(102757, 1207, 115),
(102758, 958, 115),
(102759, 958, 115),
(102759, 1207, 115),
(102760, 958, 115),
(102761, 958, 115),
(102762, 958, 115),
(102763, 958, 115),
(102764, 958, 115),
(102765, 958, 115),
(102767, 958, 115),
(102768, 958, 115),
(102769, 958, 115),
(102770, 958, 115),
(102771, 958, 115),
(102772, 958, 115),
(102773, 958, 115),
(102773, 1207, 115),
(102774, 958, 115),
(102775, 958, 115),
(102776, 958, 115),
(102777, 958, 115),
(102778, 958, 115),
(102781, 958, 115),
(102782, 958, 115),
(102783, 958, 115),
(102784, 958, 115),
(102785, 958, 115),
(102786, 958, 115),
(102787, 958, 115),
(102788, 958, 115),
(102789, 958, 115),
(102790, 958, 115),
(102791, 958, 115),
(102792, 958, 115),
(102793, 958, 115),
(102794, 958, 115),
(103518, 1207, 115),
(103801, 958, 115),
(103802, 958, 115),
(103803, 958, 115),
(103804, 958, 115),
(103805, 958, 115),
(103806, 958, 115),
(103807, 958, 115),
(103983, 958, 115),
(105072, 958, 115),
(105073, 958, 115),
(105074, 958, 115),
(105075, 958, 115);

-- --------------------------------------------------------

--
-- Estructura de la taula `cargos`
--

CREATE TABLE IF NOT EXISTS `cargos` (
`idCargos` int(11) NOT NULL,
  `descripcion` varchar(300) COLLATE utf8_estonian_ci DEFAULT NULL,
  `idEnAmbito` int(11) DEFAULT NULL,
  `Ambitos_idAmbitos` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci;

--
-- Bolcant dades de la taula `cargos`
--

INSERT INTO `cargos` (`idCargos`, `descripcion`, `idEnAmbito`, `Ambitos_idAmbitos`) VALUES
(1, 'Test i qualitat', 958, 2),
(2, 'prueba2', 115, 1),
(4, 'Director', 115, 1),
(11, 'UAB', 0, 7),
(28, 'PRUEBA ESTUDIOS', 951, 2),
(29, 'PRUEBA UNIVERSIDAD', 0, 7),
(30, 'PRUEBA CENTROS', 115, 1),
(31, 'PRUEBA DEPARTAMENTO', 471, 4);

-- --------------------------------------------------------

--
-- Estructura de la taula `cargos_has_profesores`
--

CREATE TABLE IF NOT EXISTS `cargos_has_profesores` (
  `Cargos_idCargos` int(11) NOT NULL,
  `Profesores_niu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci;

--
-- Bolcant dades de la taula `cargos_has_profesores`
--

INSERT INTO `cargos_has_profesores` (`Cargos_idCargos`, `Profesores_niu`) VALUES
(2, 1000210),
(1, 1000365),
(4, 1000587),
(2, 1001048),
(31, 1001048);

-- --------------------------------------------------------

--
-- Estructura de la taula `centros`
--

CREATE TABLE IF NOT EXISTS `centros` (
  `idCentro` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_estonian_ci NOT NULL,
  `acronimo` varchar(100) COLLATE utf8_estonian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci;

--
-- Bolcant dades de la taula `centros`
--

INSERT INTO `centros` (`idCentro`, `nombre`, `acronimo`) VALUES
(101, 'Facultat de Filosofia i Lletres', 'FFiL'),
(102, 'Facultat de Medicina', 'FM'),
(103, 'Facultat de Ciències', 'FC'),
(105, 'Facultat de Ciències de la Comunicació', 'FCC'),
(106, 'Facultat de Dret', 'FD'),
(107, 'Facultat de Veterinària', 'FV'),
(108, 'Facultat de Ciències Polítiques i de Sociologia', 'FCPS'),
(109, 'Facultat de Psicologia', 'FP'),
(110, 'Facultat de Traducció i d''Interpretació', 'FTI'),
(111, 'Facultat de Ciències de l''Educació', 'FCE'),
(113, 'Facultat de Biociències', 'FB'),
(114, 'Facultat d''Economia i Empresa', 'FEE'),
(115, 'Escola d''Enginyeria', 'EE');

-- --------------------------------------------------------

--
-- Estructura de la taula `departamentos`
--

CREATE TABLE IF NOT EXISTS `departamentos` (
  `idDepartamentos` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_estonian_ci NOT NULL,
  `acronimo` varchar(100) COLLATE utf8_estonian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci;

--
-- Bolcant dades de la taula `departamentos`
--

INSERT INTO `departamentos` (`idDepartamentos`, `nombre`, `acronimo`) VALUES
(402, 'Departament de Matemàtiques', 'DM'),
(403, 'Departament de Química', 'DQ'),
(429, 'Departament de Filologia Anglesa i de Germanística', 'DFAG'),
(431, 'Departament de Geografia', 'DG'),
(433, 'Departament de Ciència Política i de Dret Públic', 'DCPiDP'),
(461, 'Departament de Telecomunicació i d''Enginyeria de Sistemes', 'DTES'),
(463, 'Departament d''Enginyeria Electrònica', 'DEE'),
(469, 'Departament d''Arquitectura de Computadors i Sistemes Operatius', 'DACSO'),
(470, 'Departament de Microelectrónica i de Sistemes Electrònics', 'DMSE'),
(471, 'Departament de Ciències de la Computació', 'DCC'),
(472, 'Departament d''Enginyeria de la Informació i de les Comunicacions', 'DEIC'),
(485, 'Departament d''Empresa', 'DE'),
(2634, 'Departament d''Enginyeria Química, Biològica i Ambiental', 'DEQBA');

-- --------------------------------------------------------

--
-- Estructura de la taula `departamentos_has_profesores`
--

CREATE TABLE IF NOT EXISTS `departamentos_has_profesores` (
  `Departamentos_idDepartamentos` int(11) NOT NULL,
  `Profesores_niu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci;

--
-- Bolcant dades de la taula `departamentos_has_profesores`
--

INSERT INTO `departamentos_has_profesores` (`Departamentos_idDepartamentos`, `Profesores_niu`) VALUES
(402, 1000365),
(463, 1000365),
(463, 1000460),
(431, 1001048),
(463, 1001048),
(469, 1001048),
(471, 1001048),
(402, 1001143),
(431, 1001143),
(402, 1001691),
(431, 1002063);

-- --------------------------------------------------------

--
-- Estructura de la taula `estudios`
--

CREATE TABLE IF NOT EXISTS `estudios` (
  `idEstudio` int(11) NOT NULL,
  `nombre` varchar(150) COLLATE utf8_estonian_ci NOT NULL,
  `acronimo` varchar(300) COLLATE utf8_estonian_ci DEFAULT NULL,
  `Centros_idCentros` int(11) NOT NULL,
  `activo` tinyint(4) DEFAULT NULL,
  `tipo` enum('Grau','Màster') COLLATE utf8_estonian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci;

--
-- Bolcant dades de la taula `estudios`
--

INSERT INTO `estudios` (`idEstudio`, `nombre`, `acronimo`, `Centros_idCentros`, `activo`, `tipo`) VALUES
(951, 'Grau en Enginyeria Química', 'GEQ', 115, 1, 'Grau'),
(956, 'Grau en Enginyeria de Sistemes de Telecomunicació', 'GEST', 115, 1, 'Grau'),
(957, 'Grau en Enginyeria Electrònica de Telecomunicació', 'GEET', 115, 1, 'Grau'),
(958, 'Grau en Enginyeria Informàtica', 'GEI', 115, 1, 'Grau'),
(1170, 'Màster en Enginyeria de Telecomunicació', 'MET', 115, 1, 'Màster'),
(1206, 'Grau en Enginyeria Informàtica (Menció en Enginyeria de Computadors) i Grau en Enginyeria Electrònica de Telecomunicació', 'GEI+GEET', 115, 1, 'Grau'),
(1207, 'Grau en Enginyeria Informàtica (Menció en Tecnologies de la Informació) i Grau en Enginyeria de Sistemes de Telecomunicació', 'GEI+GEST', 115, 1, 'Grau'),
(1365, 'Grau en Enginyeria Electrònica de Telecomunicació i Grau en Enginyeria de Sistemes de Telecomunicació', 'GEET+GEST', 115, 1, 'Grau'),
(1394, 'Grau en Enginyeria de Dades', 'GED', 115, 1, 'Grau'),
(1395, 'Grau en Gestió de Ciutats Intel·ligents i Sostenibles', 'GGCIS', 115, 1, 'Grau');

-- --------------------------------------------------------

--
-- Estructura de la taula `failed_jobs`
--

CREATE TABLE IF NOT EXISTS `failed_jobs` (
`id` bigint(20) unsigned NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de la taula `grupo`
--

CREATE TABLE IF NOT EXISTS `grupo` (
  `idGrupo` int(11) NOT NULL,
  `Anio_inicio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci;

--
-- Bolcant dades de la taula `grupo`
--

INSERT INTO `grupo` (`idGrupo`, `Anio_inicio`) VALUES
(41, 2020),
(42, 2020),
(43, 2020),
(44, 2020),
(45, 2020),
(47, 2020),
(51, 2020),
(52, 2020),
(90, 2020),
(410, 2020),
(411, 2020),
(412, 2020),
(413, 2020),
(415, 2020),
(417, 2020),
(418, 2020),
(419, 2020),
(420, 2020),
(421, 2020),
(422, 2020),
(430, 2020),
(431, 2020),
(432, 2020),
(440, 2020),
(441, 2020),
(450, 2020),
(451, 2020),
(452, 2020),
(453, 2020),
(471, 2020),
(472, 2020),
(500, 2020),
(999, 2020);

-- --------------------------------------------------------

--
-- Estructura de la taula `grupo_has_asignaturas`
--

CREATE TABLE IF NOT EXISTS `grupo_has_asignaturas` (
  `Grupo_idGrupo` int(11) NOT NULL,
  `Asignaturas_idAsignaturas` int(11) NOT NULL,
  `ocupacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci;

--
-- Bolcant dades de la taula `grupo_has_asignaturas`
--

INSERT INTO `grupo_has_asignaturas` (`Grupo_idGrupo`, `Asignaturas_idAsignaturas`, `ocupacion`) VALUES
(41, 102746, 82),
(41, 102747, 104),
(41, 102768, 81),
(41, 102769, 82),
(41, 102771, 80),
(41, 102772, 76),
(41, 102774, 63),
(41, 102775, 96),
(41, 103801, 77),
(41, 103802, 85),
(41, 103803, 62),
(41, 103805, 42),
(41, 103806, 75),
(41, 103807, 93),
(42, 103805, 40),
(43, 102746, 81),
(43, 102747, 103),
(43, 102768, 80),
(43, 102769, 82),
(43, 102771, 82),
(43, 102772, 76),
(43, 102774, 63),
(43, 102775, 96),
(43, 103801, 77),
(43, 103802, 85),
(43, 103803, 62),
(43, 103805, 39),
(43, 103806, 76),
(43, 103807, 93),
(44, 103805, 39),
(45, 102746, 43),
(45, 102747, 67),
(45, 102768, 53),
(45, 102769, 46),
(45, 102771, 91),
(45, 102772, 72),
(45, 102774, 57),
(45, 102775, 55),
(45, 103801, 83),
(45, 103802, 67),
(45, 103803, 47),
(45, 103805, 41),
(45, 103806, 80),
(45, 103807, 79),
(47, 102746, 75),
(47, 102772, 18),
(47, 103801, 26),
(47, 103805, 38),
(47, 103806, 30),
(51, 102687, 28),
(51, 102691, 25),
(51, 102696, 20),
(51, 102699, 12),
(51, 102710, 25),
(51, 102749, 16),
(51, 102750, 20),
(51, 102752, 18),
(51, 102757, 17),
(51, 102759, 22),
(51, 102773, 16),
(51, 103518, 14),
(52, 102740, 12),
(90, 102752, 3),
(410, 102742, 88),
(410, 102745, 105),
(410, 102760, 79),
(410, 103804, 70),
(411, 102743, 37),
(411, 102744, 42),
(411, 102764, 43),
(411, 102765, 45),
(411, 102767, 49),
(412, 102743, 32),
(412, 102744, 40),
(412, 102764, 41),
(412, 102765, 44),
(412, 102767, 47),
(413, 102767, 1),
(415, 102742, 86),
(415, 102745, 98),
(415, 102760, 80),
(415, 103804, 54),
(417, 102742, 40),
(417, 103804, 70),
(418, 102761, 31),
(418, 102762, 31),
(418, 102770, 29),
(418, 105075, 20),
(419, 102742, 80),
(420, 102758, 97),
(420, 102759, 85),
(420, 102763, 94),
(420, 102781, 74),
(420, 102788, 82),
(420, 102789, 86),
(420, 102790, 84),
(421, 102741, 46),
(422, 102741, 43),
(430, 102740, 55),
(430, 102776, 49),
(430, 102777, 39),
(430, 102778, 38),
(430, 102791, 73),
(430, 102792, 40),
(430, 102793, 40),
(430, 102794, 40),
(431, 102743, 38),
(431, 102744, 42),
(431, 102764, 41),
(431, 102765, 45),
(431, 102767, 44),
(432, 102743, 37),
(432, 102744, 40),
(432, 102764, 41),
(432, 102765, 45),
(432, 102767, 46),
(440, 102753, 44),
(440, 102754, 90),
(440, 102782, 42),
(440, 102783, 40),
(440, 102784, 73),
(440, 102785, 80),
(440, 102786, 74),
(440, 102787, 86),
(441, 102753, 38),
(441, 102782, 41),
(441, 102783, 38),
(450, 102740, 61),
(450, 102749, 67),
(450, 102750, 79),
(450, 102751, 93),
(450, 102752, 76),
(450, 102757, 76),
(450, 102759, 68),
(450, 102773, 75),
(450, 105072, 19),
(450, 105073, 17),
(450, 105074, 6),
(451, 102743, 35),
(451, 102744, 20),
(451, 102764, 41),
(451, 102765, 45),
(451, 102767, 25),
(452, 102743, 1),
(452, 102744, 21),
(452, 102764, 40),
(452, 102767, 23),
(453, 102767, 41),
(471, 102764, 1),
(471, 102765, 44),
(472, 102764, 32),
(999, 102748, 0),
(999, 103983, 0);

-- --------------------------------------------------------

--
-- Estructura de la taula `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
`id` int(10) unsigned NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Bolcant dades de la taula `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 2);

-- --------------------------------------------------------

--
-- Estructura de la taula `objeto`
--

CREATE TABLE IF NOT EXISTS `objeto` (
`idObjeto` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_estonian_ci NOT NULL,
  `descripcion` varchar(300) COLLATE utf8_estonian_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci;

--
-- Bolcant dades de la taula `objeto`
--

INSERT INTO `objeto` (`idObjeto`, `nombre`, `descripcion`) VALUES
(14, 'Prueba 1', 'Esto es una descripción de prueba'),
(16, 'ObjetoPrueba', 'Esto es una descripcion de prueba para un objeto'),
(17, 'OtroObjetoPrueba', 'Esto es una descripción de prueba para un objeto con $&%(!·!%)·&%'),
(22, 'pruebbbbb', 'probando basico básico otro'),
(26, 'MiObjetoDePrueba', 'Esto es una prueba para el Jose'),
(30, 'Testing', 'Testing'),
(31, 'Un objeto de prueba', 'Esto es una descripción de prueba'),
(33, 'Un objeto de prueba 2', 'Esto es una descripción de prueba 2'),
(34, 'Objeto de pruebas', 'Objeto para mostrar una búsqueda básica'),
(35, 'Libro HP', 'Libro...');

-- --------------------------------------------------------

--
-- Estructura de la taula `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de la taula `permisos`
--

CREATE TABLE IF NOT EXISTS `permisos` (
`idPermisos` int(11) NOT NULL,
  `nivel` enum('ninguno','basico','total') COLLATE utf8_estonian_ci DEFAULT 'ninguno',
  `Objeto_idObjeto` int(11) NOT NULL,
  `Ambitos_idAmbitos` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=233 DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci;

--
-- Bolcant dades de la taula `permisos`
--

INSERT INTO `permisos` (`idPermisos`, `nivel`, `Objeto_idObjeto`, `Ambitos_idAmbitos`) VALUES
(41, 'ninguno', 22, 1),
(42, 'ninguno', 22, 2),
(43, 'ninguno', 22, 4),
(44, 'ninguno', 22, 7),
(137, 'basico', 30, 1),
(138, 'basico', 30, 2),
(139, 'basico', 30, 3),
(140, 'total', 30, 4),
(141, 'total', 30, 5),
(142, 'basico', 30, 6),
(143, 'basico', 30, 7),
(144, 'basico', 30, 8),
(169, 'basico', 33, 1),
(170, 'basico', 33, 2),
(171, 'ninguno', 33, 3),
(172, 'total', 33, 4),
(173, 'total', 33, 5),
(174, 'ninguno', 33, 6),
(175, 'basico', 33, 7),
(176, 'ninguno', 33, 8),
(177, 'ninguno', 31, 1),
(178, 'ninguno', 31, 2),
(179, 'ninguno', 31, 3),
(180, 'ninguno', 31, 4),
(181, 'ninguno', 31, 5),
(182, 'ninguno', 31, 6),
(183, 'ninguno', 31, 7),
(184, 'ninguno', 31, 8),
(185, 'ninguno', 14, 1),
(186, 'total', 14, 2),
(187, 'basico', 14, 3),
(188, 'basico', 14, 4),
(189, 'basico', 14, 5),
(190, 'ninguno', 14, 6),
(191, 'ninguno', 14, 7),
(192, 'ninguno', 14, 8),
(193, 'ninguno', 16, 1),
(194, 'ninguno', 16, 2),
(195, 'ninguno', 16, 3),
(196, 'ninguno', 16, 4),
(197, 'ninguno', 16, 5),
(198, 'ninguno', 16, 6),
(199, 'ninguno', 16, 7),
(200, 'ninguno', 16, 8),
(201, 'ninguno', 17, 1),
(202, 'ninguno', 17, 2),
(203, 'ninguno', 17, 3),
(204, 'ninguno', 17, 4),
(205, 'ninguno', 17, 5),
(206, 'ninguno', 17, 6),
(207, 'ninguno', 17, 7),
(208, 'ninguno', 17, 8),
(209, 'ninguno', 26, 1),
(210, 'ninguno', 26, 2),
(211, 'ninguno', 26, 3),
(212, 'ninguno', 26, 4),
(213, 'ninguno', 26, 5),
(214, 'ninguno', 26, 6),
(215, 'ninguno', 26, 7),
(216, 'ninguno', 26, 8),
(217, 'ninguno', 34, 1),
(218, 'ninguno', 34, 2),
(219, 'ninguno', 34, 3),
(220, 'ninguno', 34, 4),
(221, 'ninguno', 34, 5),
(222, 'ninguno', 34, 6),
(223, 'ninguno', 34, 7),
(224, 'ninguno', 34, 8),
(225, 'ninguno', 35, 1),
(226, 'ninguno', 35, 2),
(227, 'ninguno', 35, 3),
(228, 'ninguno', 35, 4),
(229, 'ninguno', 35, 5),
(230, 'ninguno', 35, 6),
(231, 'ninguno', 35, 7),
(232, 'ninguno', 35, 8);

-- --------------------------------------------------------

--
-- Estructura de la taula `personal_access_tokens`
--

CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
`id` bigint(20) unsigned NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Bolcant dades de la taula `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(5, 'App\\Models\\User', 2, 'gestor-permisos', '5e2d9d2dd5ed2f2d4777e89493b5d5ee0564cd9d71b975f70d8c6b7b8e4527ad', '["*"]', '2021-01-05 21:30:28', '2020-12-31 05:23:14', '2021-01-05 21:30:28'),
(6, 'App\\Models\\User', 2, 'gestor-permisos', '3ee05b17f79acac5381fabcfe111a83f7a54290ccc26bf8f0b798c2c742a94e1', '["*"]', '2021-01-05 12:35:09', '2021-01-05 12:34:19', '2021-01-05 12:35:09'),
(7, 'App\\Models\\User', 2, 'gestor-permisos', 'f26783454cb0e39d3c1e8ece62d3bf5abb9c1debdd0e397fb576cb98eec2f741', '["*"]', '2021-01-10 18:01:48', '2021-01-10 18:01:07', '2021-01-10 18:01:48');

-- --------------------------------------------------------

--
-- Estructura de la taula `profesores`
--

CREATE TABLE IF NOT EXISTS `profesores` (
  `niu` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_estonian_ci NOT NULL,
  `apellido` varchar(100) COLLATE utf8_estonian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci;

--
-- Bolcant dades de la taula `profesores`
--

INSERT INTO `profesores` (`niu`, `nombre`, `apellido`) VALUES
(1000210, 'Ramon', 'Baldrich Caselles'),
(1000327, 'Joaquin', 'Borges Ayats'),
(1000365, 'Josep Maria', 'Burgues Badia'),
(1000460, 'Jordi', 'Carrabina Bordoll'),
(1000587, 'Ana', 'Cortes Fite'),
(1000786, 'Carles', 'Ferrer Ramis'),
(1001048, 'Porfidio', 'Hernandez Bude'),
(1001143, 'Josep', 'Llados Canet'),
(1001185, 'Antonio Manuel', 'Lopez Peña'),
(1001207, 'Felipe', 'Lumbreras Ruiz'),
(1001243, 'Tomás Manuel', 'Margalef Burrull'),
(1001260, 'Enric', 'Marti Godia'),
(1001475, 'Merce', 'Mur Effing'),
(1001549, 'Xavier', 'Oriols Pladevall'),
(1001550, 'Joan', 'Orobitg Huguet'),
(1001691, 'Jordi', 'Pons Aróztegui'),
(1001727, 'Marta', 'Prim Sabria'),
(1001803, 'Dolores Isabel', 'Rexachs del Rosario'),
(1001816, 'Lluis', 'Ribas Xirgo'),
(1001830, 'Josep', 'Rifà Coma'),
(1001851, 'Francesc Xavier', 'Roca Marva'),
(1001997, 'Francisco Javier', 'Sanchez Pujadas'),
(1002030, 'Laia', 'Saumell Ariño'),
(1002042, 'Miquel Àngel', 'Senar Rosell'),
(1002055, 'Joan', 'Serra Sagrista'),
(1002061, 'Javier', 'Serrano Garcia'),
(1002063, 'Joan', 'Serrat Gual'),
(1002107, 'Joan', 'Sorribes Gomis'),
(1002124, 'Jorge Francisco', 'Suñé Tarruella'),
(1002245, 'Ernest', 'Valveny Llobet'),
(1002248, 'Maria Isabel', 'Vanrell Martorell'),
(1002260, 'Antonio Jose', 'Velasco Gonzalez'),
(1002272, 'Joan Manuel', 'Verdera Melenchon'),
(1002313, 'Juan Jose', 'Villanueva Pipaon'),
(1002914, 'Gema', 'Sanchez Albaladejo'),
(1003042, 'Juan Carlos', 'Moure Lopez'),
(1003281, 'Daniel', 'Franco Puntes'),
(1003394, 'Francesc', 'Perera Domenech'),
(1003453, 'Eduardo', 'Cesar Galobardes'),
(1003546, 'Vicente', 'Soler Ruiz'),
(1003712, 'Lluis Antoni', 'Teres Teres'),
(1004099, 'Remo Lucio', 'Suppi Boldrito'),
(1004129, 'Joan', 'Porti Pique'),
(1104294, 'Fernando Luis', 'Vilariño Freire'),
(1104296, 'Xavier', 'Otazu Porter'),
(1105319, 'Oger', 'Malet Munté'),
(1111439, 'Jose', 'Parron Granados'),
(1111530, 'Gary', 'Junkin  '),
(1112621, 'Joan', 'Bartrina Rapesta'),
(1113408, 'Diego Javier', 'Mostaccio  '),
(1136085, 'Alicia', 'Fornes Bisquerra'),
(1139100, 'Ramon', 'Grau Sala'),
(1145445, 'Patricia', 'Marquez Valle'),
(1148013, 'Jorge Andres', 'Verdu Tirado'),
(1148029, 'Marc', 'Tallo Sendra'),
(1156667, 'Ruben', 'Martinez Vidal'),
(1161496, 'Ramon', 'Marti Escale'),
(1175003, 'Jose Antonio', 'Lopez Salcedo'),
(1181452, 'Victor', 'Garcia Font'),
(1197444, 'Joan', 'Giner Miguelez'),
(1206147, 'Dimosthenis', 'Karatzas  '),
(1207845, 'Carlos Alejandro', 'Parraga  '),
(1215500, 'Jorge', 'Bernal del Nozal'),
(1259088, 'Miguel', 'Hernández Cabronero'),
(1313564, 'Maria Isabel', 'Guitart Hormigo'),
(1340045, 'Katerine', 'Diaz Chito'),
(1378913, 'Ignacio', 'Izaga Martinez'),
(1400442, 'Raimon', 'Casanova Mohr'),
(1410521, 'Helena', 'Bolta Torrell'),
(1430896, 'Yael', 'Tudela Barroso'),
(1460920, 'Daniel', 'Montesinos Santos'),
(1497073, 'Dion Eustathios Olivier', 'Tzamarias  '),
(1521598, 'Diego Mauricio', 'Freire Bastidas'),
(1532072, 'Aaron', 'Blanco Esteban'),
(1545507, 'Mario', 'Yelamos Rebolledo'),
(1574280, 'Maria del Carmen', 'Gonzalez Barreno'),
(1574282, 'Cristina', 'Romero Tris'),
(1585479, 'Cristian', 'Da Silva Campello'),
(1596544, 'Santiago', 'Rivas Contreras'),
(2014362, 'Oriol', 'Jaumandreu Sellares'),
(2015999, 'Jordi', 'Herrera Joancomarti'),
(2016279, 'Maria Merce', 'Villanueva Gay'),
(2016570, 'David', 'Castells Rufas'),
(2016699, 'Antonio Miguel', 'Espinosa Morales'),
(2017133, 'David', 'Megias Jimenez'),
(2017311, 'Andres', 'Perez Martinez'),
(2017417, 'Sergi', 'Robles Martinez'),
(2017538, 'Jordi', 'Serra Ruiz'),
(2033583, 'Xavier', 'Cartoixa Soler'),
(2033648, 'Marc', 'Porti Pujal'),
(2034122, 'Ramon', 'Musach Pi'),
(2040232, 'Yolanda', 'Benitez Fernandez'),
(2040797, 'Daniel', 'Ponsa Mussarra'),
(2044386, 'Jordi', 'Gonzalez Sabate'),
(2044435, 'Roberto', 'Benavente Vidal'),
(2047573, 'Estrella Maria', 'Abril Gutierrez'),
(2051455, 'David', 'Jimenez Jimenez'),
(2052641, 'Guillermo', 'Navarro Arribas'),
(2057360, 'Marius', 'Monton Macian'),
(2058008, 'Josep Maria', 'Basart Muñoz'),
(2059673, 'Cristina', 'Fernandez Cordoba'),
(2066956, 'Juan-Carlos', 'Sebastian Perez'),
(2067513, 'Marcel', 'Matencio Miret'),
(2068875, 'Aura', 'Hernandez Sabate'),
(2073294, 'Debora', 'Gil Resina'),
(2075963, 'Jordi', 'Casas Roma'),
(2077232, 'Oriol', 'Ramos Terrades'),
(2077472, 'Mireia', 'Bellot Garcia'),
(2079609, 'Francesc', 'Auli Llinas'),
(2085222, 'Aitor', 'Alsina Rodriguez'),
(2090361, 'Enric', 'Vergara Carreras'),
(2090712, 'Raul', 'Aragones Ortiz'),
(2102478, 'Anna Barbara', 'Sikora  '),
(2131799, 'Ian', 'Blanes Garcia'),
(2132203, 'Carlos', 'Sanchez Ramos'),
(2141099, 'Juan Francisco', 'Protasio Ramirez');

-- --------------------------------------------------------

--
-- Estructura de la taula `profesores_has_grupo`
--

CREATE TABLE IF NOT EXISTS `profesores_has_grupo` (
  `Profesores_niu` int(11) NOT NULL,
  `Grupo_idGrupo` int(11) NOT NULL,
  `Grupo_Anio_inicio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci;

--
-- Bolcant dades de la taula `profesores_has_grupo`
--

INSERT INTO `profesores_has_grupo` (`Profesores_niu`, `Grupo_idGrupo`, `Grupo_Anio_inicio`) VALUES
(1000210, 440, 2020),
(1000210, 999, 2020),
(1000327, 47, 2020),
(1000327, 450, 2020),
(1000365, 43, 2020),
(1000460, 418, 2020),
(1000460, 999, 2020),
(1000587, 41, 2020),
(1000587, 42, 2020),
(1000587, 43, 2020),
(1000587, 44, 2020),
(1000587, 45, 2020),
(1000587, 47, 2020),
(1000587, 999, 2020),
(1000786, 430, 2020),
(1001048, 41, 2020),
(1001048, 43, 2020),
(1001048, 45, 2020),
(1001048, 52, 2020),
(1001048, 430, 2020),
(1001048, 450, 2020),
(1001048, 999, 2020),
(1001143, 432, 2020),
(1001143, 999, 2020),
(1001185, 420, 2020),
(1001185, 999, 2020),
(1001207, 440, 2020),
(1001207, 999, 2020),
(1001243, 41, 2020),
(1001243, 43, 2020),
(1001243, 45, 2020),
(1001260, 440, 2020),
(1001260, 441, 2020),
(1001260, 999, 2020),
(1001475, 418, 2020),
(1001549, 41, 2020),
(1001549, 43, 2020),
(1001549, 45, 2020),
(1001550, 41, 2020),
(1001691, 418, 2020),
(1001691, 450, 2020),
(1001691, 999, 2020),
(1001727, 999, 2020),
(1001803, 430, 2020),
(1001803, 999, 2020),
(1001816, 430, 2020),
(1001816, 999, 2020),
(1001830, 41, 2020),
(1001830, 43, 2020),
(1001830, 51, 2020),
(1001830, 450, 2020),
(1001851, 41, 2020),
(1001851, 45, 2020),
(1001851, 999, 2020),
(1001997, 440, 2020),
(1001997, 441, 2020),
(1001997, 999, 2020),
(1002030, 41, 2020),
(1002030, 45, 2020),
(1002042, 41, 2020),
(1002042, 999, 2020),
(1002055, 450, 2020),
(1002055, 999, 2020),
(1002061, 51, 2020),
(1002063, 51, 2020),
(1002063, 420, 2020),
(1002063, 450, 2020),
(1002063, 999, 2020),
(1002107, 41, 2020),
(1002107, 43, 2020),
(1002107, 45, 2020),
(1002124, 41, 2020),
(1002124, 43, 2020),
(1002124, 45, 2020),
(1002245, 999, 2020),
(1002248, 41, 2020),
(1002248, 43, 2020),
(1002248, 45, 2020),
(1002248, 999, 2020),
(1002260, 430, 2020),
(1002272, 45, 2020),
(1002313, 999, 2020),
(1002914, 411, 2020),
(1002914, 412, 2020),
(1002914, 413, 2020),
(1002914, 431, 2020),
(1002914, 432, 2020),
(1002914, 451, 2020),
(1002914, 452, 2020),
(1002914, 453, 2020),
(1002914, 999, 2020),
(1003042, 43, 2020),
(1003042, 45, 2020),
(1003042, 430, 2020),
(1003042, 999, 2020),
(1003281, 999, 2020),
(1003394, 47, 2020),
(1003453, 999, 2020),
(1003546, 999, 2020),
(1003712, 999, 2020),
(1004099, 430, 2020),
(1004099, 999, 2020),
(1004129, 41, 2020),
(1004129, 43, 2020),
(1004129, 45, 2020),
(1104294, 440, 2020),
(1104294, 999, 2020),
(1104296, 420, 2020),
(1104296, 999, 2020),
(1105319, 999, 2020),
(1111439, 51, 2020),
(1111530, 51, 2020),
(1112621, 41, 2020),
(1112621, 43, 2020),
(1112621, 450, 2020),
(1112621, 999, 2020),
(1113408, 999, 2020),
(1136085, 431, 2020),
(1136085, 999, 2020),
(1139100, 999, 2020),
(1145445, 411, 2020),
(1148013, 51, 2020),
(1148029, 410, 2020),
(1148029, 415, 2020),
(1148029, 420, 2020),
(1148029, 999, 2020),
(1156667, 999, 2020),
(1161496, 999, 2020),
(1175003, 51, 2020),
(1181452, 999, 2020),
(1197444, 451, 2020),
(1206147, 999, 2020),
(1207845, 999, 2020),
(1215500, 431, 2020),
(1215500, 432, 2020),
(1215500, 440, 2020),
(1215500, 441, 2020),
(1215500, 999, 2020),
(1259088, 999, 2020),
(1313564, 51, 2020),
(1313564, 90, 2020),
(1313564, 450, 2020),
(1340045, 451, 2020),
(1340045, 999, 2020),
(1378913, 420, 2020),
(1400442, 999, 2020),
(1410521, 420, 2020),
(1410521, 999, 2020),
(1430896, 413, 2020),
(1430896, 432, 2020),
(1497073, 999, 2020),
(1521598, 999, 2020),
(1532072, 43, 2020),
(1532072, 999, 2020),
(1545507, 420, 2020),
(1574280, 452, 2020),
(1574282, 999, 2020),
(1585479, 411, 2020),
(1585479, 413, 2020),
(1585479, 431, 2020),
(1596544, 420, 2020),
(2014362, 452, 2020),
(2015999, 51, 2020),
(2015999, 450, 2020),
(2015999, 999, 2020),
(2016279, 43, 2020),
(2016279, 45, 2020),
(2016279, 450, 2020),
(2016279, 999, 2020),
(2016570, 999, 2020),
(2016699, 41, 2020),
(2016699, 45, 2020),
(2017133, 999, 2020),
(2017311, 999, 2020),
(2017417, 41, 2020),
(2017417, 51, 2020),
(2017417, 450, 2020),
(2017417, 999, 2020),
(2017538, 440, 2020),
(2017538, 999, 2020),
(2033583, 41, 2020),
(2033583, 43, 2020),
(2033583, 45, 2020),
(2033648, 41, 2020),
(2033648, 43, 2020),
(2033648, 45, 2020),
(2034122, 999, 2020),
(2040232, 999, 2020),
(2040797, 420, 2020),
(2040797, 999, 2020),
(2044386, 440, 2020),
(2044386, 999, 2020),
(2044435, 43, 2020),
(2044435, 47, 2020),
(2044435, 999, 2020),
(2047573, 452, 2020),
(2047573, 453, 2020),
(2051455, 41, 2020),
(2051455, 43, 2020),
(2051455, 45, 2020),
(2052641, 51, 2020),
(2052641, 450, 2020),
(2052641, 999, 2020),
(2057360, 430, 2020),
(2057360, 999, 2020),
(2058008, 410, 2020),
(2058008, 415, 2020),
(2058008, 417, 2020),
(2058008, 999, 2020),
(2059673, 43, 2020),
(2059673, 45, 2020),
(2059673, 450, 2020),
(2059673, 999, 2020),
(2066956, 999, 2020),
(2067513, 420, 2020),
(2068875, 440, 2020),
(2068875, 441, 2020),
(2068875, 999, 2020),
(2073294, 411, 2020),
(2073294, 412, 2020),
(2073294, 431, 2020),
(2073294, 432, 2020),
(2073294, 451, 2020),
(2073294, 452, 2020),
(2073294, 999, 2020),
(2075963, 999, 2020),
(2077232, 421, 2020),
(2077232, 422, 2020),
(2077232, 451, 2020),
(2077232, 999, 2020),
(2077472, 431, 2020),
(2079609, 410, 2020),
(2079609, 415, 2020),
(2079609, 417, 2020),
(2079609, 419, 2020),
(2085222, 999, 2020),
(2090361, 452, 2020),
(2090361, 472, 2020),
(2090361, 999, 2020),
(2090712, 999, 2020),
(2102478, 41, 2020),
(2102478, 42, 2020),
(2102478, 43, 2020),
(2102478, 44, 2020),
(2102478, 45, 2020),
(2102478, 47, 2020),
(2102478, 430, 2020),
(2102478, 999, 2020),
(2131799, 51, 2020),
(2131799, 450, 2020),
(2131799, 999, 2020),
(2132203, 412, 2020),
(2132203, 422, 2020),
(2141099, 999, 2020);

-- --------------------------------------------------------

--
-- Estructura de la taula `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Bolcant dades de la taula `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Daniel Montesinos', 'daniel.montesinos@e-campus.uab.cat', NULL, '$2y$10$4SkwKrlj9zE8xwZQv0REc.3Fc.p8b3cEyMrIhaNBJC1ptJLwsweKe', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administradores`
--
ALTER TABLE `administradores`
 ADD PRIMARY KEY (`niu`);

--
-- Indexes for table `ambitos`
--
ALTER TABLE `ambitos`
 ADD PRIMARY KEY (`idAmbitos`);

--
-- Indexes for table `anio`
--
ALTER TABLE `anio`
 ADD PRIMARY KEY (`inicio`);

--
-- Indexes for table `asignaturas`
--
ALTER TABLE `asignaturas`
 ADD PRIMARY KEY (`idAsignaturas`);

--
-- Indexes for table `asignaturas_has_estudios`
--
ALTER TABLE `asignaturas_has_estudios`
 ADD PRIMARY KEY (`Asignaturas_idAsignaturas`,`Estudios_idEstudios`,`Estudio_Centros_idCentros`), ADD KEY `fk_Asignaturas_has_Grados_Grados1_idx` (`Estudios_idEstudios`,`Estudio_Centros_idCentros`), ADD KEY `fk_Asignaturas_has_Grados_Asignaturas1_idx` (`Asignaturas_idAsignaturas`);

--
-- Indexes for table `cargos`
--
ALTER TABLE `cargos`
 ADD PRIMARY KEY (`idCargos`,`Ambitos_idAmbitos`), ADD KEY `fk_Cargos_Ambitos1_idx` (`Ambitos_idAmbitos`);

--
-- Indexes for table `cargos_has_profesores`
--
ALTER TABLE `cargos_has_profesores`
 ADD PRIMARY KEY (`Cargos_idCargos`,`Profesores_niu`), ADD KEY `fk_Cargos_has_Profesores_Profesores1_idx` (`Profesores_niu`), ADD KEY `fk_Cargos_has_Profesores_Cargos1_idx` (`Cargos_idCargos`);

--
-- Indexes for table `centros`
--
ALTER TABLE `centros`
 ADD PRIMARY KEY (`idCentro`);

--
-- Indexes for table `departamentos`
--
ALTER TABLE `departamentos`
 ADD PRIMARY KEY (`idDepartamentos`);

--
-- Indexes for table `departamentos_has_profesores`
--
ALTER TABLE `departamentos_has_profesores`
 ADD PRIMARY KEY (`Departamentos_idDepartamentos`,`Profesores_niu`), ADD KEY `fk_Departamentos_has_Profesores_Profesores1_idx` (`Profesores_niu`), ADD KEY `fk_Departamentos_has_Profesores_Departamentos1_idx` (`Departamentos_idDepartamentos`);

--
-- Indexes for table `estudios`
--
ALTER TABLE `estudios`
 ADD PRIMARY KEY (`idEstudio`,`Centros_idCentros`), ADD KEY `fk_Grados_Facultades1_idx` (`Centros_idCentros`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `grupo`
--
ALTER TABLE `grupo`
 ADD PRIMARY KEY (`idGrupo`,`Anio_inicio`), ADD KEY `fk_Grupo_Anio1_idx` (`Anio_inicio`);

--
-- Indexes for table `grupo_has_asignaturas`
--
ALTER TABLE `grupo_has_asignaturas`
 ADD PRIMARY KEY (`Grupo_idGrupo`,`Asignaturas_idAsignaturas`), ADD KEY `fk_Grupo_has_Asignaturas_Asignaturas1_idx` (`Asignaturas_idAsignaturas`), ADD KEY `fk_Grupo_has_Asignaturas_Grupo1_idx` (`Grupo_idGrupo`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `objeto`
--
ALTER TABLE `objeto`
 ADD PRIMARY KEY (`idObjeto`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
 ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permisos`
--
ALTER TABLE `permisos`
 ADD PRIMARY KEY (`idPermisos`,`Objeto_idObjeto`,`Ambitos_idAmbitos`), ADD KEY `fk_Permisos_Objeto1_idx` (`Objeto_idObjeto`), ADD KEY `fk_Permisos_Ambitos1_idx` (`Ambitos_idAmbitos`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`), ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `profesores`
--
ALTER TABLE `profesores`
 ADD PRIMARY KEY (`niu`);

--
-- Indexes for table `profesores_has_grupo`
--
ALTER TABLE `profesores_has_grupo`
 ADD PRIMARY KEY (`Profesores_niu`,`Grupo_idGrupo`,`Grupo_Anio_inicio`), ADD KEY `fk_Profesores_has_Grupo_Profesores1_idx` (`Profesores_niu`), ADD KEY `fk_Profesores_has_Grupo_Grupo1_idx` (`Grupo_idGrupo`,`Grupo_Anio_inicio`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ambitos`
--
ALTER TABLE `ambitos`
MODIFY `idAmbitos` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `cargos`
--
ALTER TABLE `cargos`
MODIFY `idCargos` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `objeto`
--
ALTER TABLE `objeto`
MODIFY `idObjeto` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `permisos`
--
ALTER TABLE `permisos`
MODIFY `idPermisos` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=233;
--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Restriccions per taules bolcades
--

--
-- Restriccions per la taula `asignaturas_has_estudios`
--
ALTER TABLE `asignaturas_has_estudios`
ADD CONSTRAINT `fk_Asignaturas_has_Grados_Asignaturas1` FOREIGN KEY (`Asignaturas_idAsignaturas`) REFERENCES `asignaturas` (`idAsignaturas`),
ADD CONSTRAINT `fk_Asignaturas_has_Grados_Grados1` FOREIGN KEY (`Estudios_idEstudios`, `Estudio_Centros_idCentros`) REFERENCES `estudios` (`idEstudio`, `Centros_idCentros`);

--
-- Restriccions per la taula `cargos`
--
ALTER TABLE `cargos`
ADD CONSTRAINT `fk_Cargos_Ambitos1` FOREIGN KEY (`Ambitos_idAmbitos`) REFERENCES `ambitos` (`idAmbitos`);

--
-- Restriccions per la taula `cargos_has_profesores`
--
ALTER TABLE `cargos_has_profesores`
ADD CONSTRAINT `fk_Cargos_has_Profesores_Cargos1` FOREIGN KEY (`Cargos_idCargos`) REFERENCES `cargos` (`idCargos`),
ADD CONSTRAINT `fk_Cargos_has_Profesores_Profesores1` FOREIGN KEY (`Profesores_niu`) REFERENCES `profesores` (`niu`);

--
-- Restriccions per la taula `departamentos_has_profesores`
--
ALTER TABLE `departamentos_has_profesores`
ADD CONSTRAINT `fk_Departamentos_has_Profesores_Departamentos1` FOREIGN KEY (`Departamentos_idDepartamentos`) REFERENCES `departamentos` (`idDepartamentos`),
ADD CONSTRAINT `fk_Departamentos_has_Profesores_Profesores1` FOREIGN KEY (`Profesores_niu`) REFERENCES `profesores` (`niu`);

--
-- Restriccions per la taula `estudios`
--
ALTER TABLE `estudios`
ADD CONSTRAINT `fk_Grados_Facultades1` FOREIGN KEY (`Centros_idCentros`) REFERENCES `centros` (`idCentro`);

--
-- Restriccions per la taula `grupo`
--
ALTER TABLE `grupo`
ADD CONSTRAINT `fk_Grupo_Anio1` FOREIGN KEY (`Anio_inicio`) REFERENCES `anio` (`inicio`);

--
-- Restriccions per la taula `grupo_has_asignaturas`
--
ALTER TABLE `grupo_has_asignaturas`
ADD CONSTRAINT `fk_Grupo_has_Asignaturas_Asignaturas1` FOREIGN KEY (`Asignaturas_idAsignaturas`) REFERENCES `asignaturas` (`idAsignaturas`),
ADD CONSTRAINT `fk_Grupo_has_Asignaturas_Grupo1` FOREIGN KEY (`Grupo_idGrupo`) REFERENCES `grupo` (`idGrupo`);

--
-- Restriccions per la taula `permisos`
--
ALTER TABLE `permisos`
ADD CONSTRAINT `fk_Permisos_Ambitos1` FOREIGN KEY (`Ambitos_idAmbitos`) REFERENCES `ambitos` (`idAmbitos`),
ADD CONSTRAINT `fk_Permisos_Objeto1` FOREIGN KEY (`Objeto_idObjeto`) REFERENCES `objeto` (`idObjeto`);

--
-- Restriccions per la taula `profesores_has_grupo`
--
ALTER TABLE `profesores_has_grupo`
ADD CONSTRAINT `fk_Profesores_has_Grupo_Grupo1` FOREIGN KEY (`Grupo_idGrupo`, `Grupo_Anio_inicio`) REFERENCES `grupo` (`idGrupo`, `Anio_inicio`),
ADD CONSTRAINT `fk_Profesores_has_Grupo_Profesores1` FOREIGN KEY (`Profesores_niu`) REFERENCES `profesores` (`niu`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
