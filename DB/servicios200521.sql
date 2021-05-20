-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-05-2021 a las 16:10:12
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `servicios`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `avisos`
--

CREATE TABLE `avisos` (
  `Consecutivo` int(11) NOT NULL,
  `Seccion` varchar(10) COLLATE utf8mb4_bin NOT NULL,
  `Grado` int(11) NOT NULL,
  `Grupo` varchar(5) COLLATE utf8mb4_bin DEFAULT NULL,
  `Titulo` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `Contenido` longtext COLLATE utf8mb4_bin NOT NULL,
  `Url` text COLLATE utf8mb4_bin NOT NULL,
  `Imagen` text COLLATE utf8mb4_bin NOT NULL,
  `Fecha_Inicio` date NOT NULL,
  `Fecha_Fin` date NOT NULL,
  `Activo` varchar(4) COLLATE utf8mb4_bin DEFAULT NULL,
  `Usuario` text COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `avisos`
--

INSERT INTO `avisos` (`Consecutivo`, `Seccion`, `Grado`, `Grupo`, `Titulo`, `Contenido`, `Url`, `Imagen`, `Fecha_Inicio`, `Fecha_Fin`, `Activo`, `Usuario`) VALUES
(13, 'PRE', 0, '', 'Este es el d&iacute;a del Se&ntilde;or', 'La cuaresma nos recuerda que debemos practicar la humildad. Escucha un breve mensaje de nuestro capell&aacute;n', 'https://fb.watch/4ax9QPIMVn/', 'images/Cuaresma.png', '2021-03-01', '2021-03-31', 'Si', 'jjmoreno23'),
(14, 'PRI', 0, '', 'Este es el d&iacute;a del Se&ntilde;or', 'La cuaresma nos recuerda que debemos practicar la humildad. Escucha un breve mensaje de nuestro capell&aacute;n', 'https://fb.watch/4ax9QPIMVn/', 'images/Cuaresma.png', '2021-03-01', '2021-03-31', 'Si', 'jjmoreno23'),
(15, 'SEC', 0, '', 'Este es el d&iacute;a del Se&ntilde;or', 'La cuaresma nos recuerda que debemos practicar la humildad. Escucha un breve mensaje de nuestro capell&aacute;n', 'https://fb.watch/4ax9QPIMVn/', 'images/Cuaresma.png', '2021-03-01', '2021-03-31', 'Si', 'jjmoreno23'),
(16, 'BAC', 0, '', 'Este es el d&iacute;a del Se&ntilde;or', 'La cuaresma nos recuerda que debemos practicar la humildad. Escucha un breve mensaje de nuestro capell&aacute;n', '', 'images/Cuaresma.png', '2021-03-01', '2021-03-31', 'No', 'jjmoreno23'),
(17, 'UNI', 0, '', '&iexcl;Festeja con nosotros este 80 ', '&iexcl;Tenemos un regalo para ti! Aprovecha este gran descuento en agradecimiento a tu presencia, confianza y permanencia con nosotros.', '', 'images/80Aniversario.jpg', '2021-03-08', '2021-04-30', 'Si', 'jjmoreno23'),
(18, 'PRI', 0, '', 'Solicita tu Kardex', 'lo que sea', 'https://valladolid.edu.mx/', 'images/Menu30y31.jpg', '2021-03-01', '2021-03-20', 'Si', 'jjmoreno23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `becas`
--

CREATE TABLE `becas` (
  `Id` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `Seccion` varchar(3) COLLATE utf8mb4_bin NOT NULL,
  `CicloAct` varchar(4) COLLATE utf8mb4_bin NOT NULL,
  `CicloSig` varchar(4) COLLATE utf8mb4_bin NOT NULL,
  `Grado` int(2) NOT NULL,
  `Tipo` varchar(3) COLLATE utf8mb4_bin NOT NULL,
  `Status` int(2) DEFAULT 0,
  `Fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Observaciones` text COLLATE utf8mb4_bin DEFAULT NULL,
  `Review` text COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `becas`
--

INSERT INTO `becas` (`Id`, `Seccion`, `CicloAct`, `CicloSig`, `Grado`, `Tipo`, `Status`, `Fecha`, `Observaciones`, `Review`) VALUES
('111006', 'SEC', '20-0', '21-0', 2, 'sep', 0, '2021-03-13 16:11:02', NULL, NULL),
('170085', 'PRI', '20-0', '21-0', 5, 'int', 1, '2021-03-16 14:49:57', 'Se alcanz&oacute; el l&iacute;mite de becas otorgadas', '20% para el alumno'),
('171099', 'PRI', '20-0', '21-0', 2, 'sep', 2, '2021-03-19 20:05:11', 'Aceptado con el 20%', 'Se le descompuso la Suburban.'),
('183039', 'BAC', '20-1', '20-2', 6, 'int', 0, '2021-03-16 14:29:51', NULL, NULL),
('190064', 'PRI', '20-0', '21-0', 5, 'hno', 0, '2021-03-13 15:55:32', NULL, NULL),
('201016', 'PRE', '20-0', '21-0', 2, 'sep', 0, '2021-03-13 15:10:10', '13/03/21 - Incluir el comprobante de ingresos del c&oacute;nyuge.', '13/03/21 - Falt&oacute; comprobante de ingresos del c&oacute;nyuge.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `circulares`
--

CREATE TABLE `circulares` (
  `IdCircular` int(11) NOT NULL,
  `Seccion` varchar(3) COLLATE utf8mb4_bin NOT NULL,
  `IdGrupo` varchar(5) COLLATE utf8mb4_bin NOT NULL,
  `Descripcion` varchar(80) COLLATE utf8mb4_bin NOT NULL,
  `Archivo` text COLLATE utf8mb4_bin NOT NULL,
  `Ciclo` varchar(5) COLLATE utf8mb4_bin NOT NULL,
  `Visible` varchar(2) COLLATE utf8mb4_bin NOT NULL DEFAULT 'Si'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `circulares`
--

INSERT INTO `circulares` (`IdCircular`, `Seccion`, `IdGrupo`, `Descripcion`, `Archivo`, `Ciclo`, `Visible`) VALUES
(10, 'PRI', '', 'Circular Enero', 'circulares/1/CIRCULAR_ENERO.pdf', '20-0', 'Si'),
(11, 'PRI', '', 'Información de Pagos por COVID-19', 'circulares/1/Circular_Pagos.pdf', '20-0', 'Si'),
(12, 'SEC', '', 'Circular Febrero', 'circulares/2/Circular07_04022021.pdf', '20-0', 'Si'),
(13, 'SEC', 'SEC11', 'Horarios de Reuniones Zoom 1er Grado', 'circulares/2/Zoom_Horarios_1erGrado.pdf', '20-0', 'Si'),
(14, 'BAC', '', 'Comunicado sobre los pagos COVID-19', 'circulares/3/BAC_Comunicado_Pagos.pdf', '20-1', 'Si'),
(15, 'UNI', '', 'Comunicado Fin de curso e inicio de ciclo', 'circulares/4/UNI_Circular_FinCurso_InicioCiclo.pdf', '20-1', 'Si'),
(16, 'LFR', '', 'Cuaderno Servicio Social Fisioterapia y Rehabilitación', 'circulares/4/LFR_Cuaderno Servicio Social LFR.pdf', '20-1', 'Si'),
(17, 'PRE', '', 'Circular Febrero 2021', 'circulares/0/CircularFebrero2021.pdf', '20-0', 'Si'),
(18, 'PRE', '', 'Circular Marzo 2021', 'circulares/0/Circular_Marzo2021.pdf', '20-0', 'Si'),
(19, 'PRI', '', 'Indicaciones Generales para REINSCRIPCIÓN', 'circulares/1/Circular05_Octubre.pdf', '20-0', 'Si');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactoalumno`
--

CREATE TABLE `contactoalumno` (
  `Id` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `Calle` tinytext COLLATE utf8mb4_bin NOT NULL,
  `Colonia` tinytext COLLATE utf8mb4_bin NOT NULL,
  `Ciudad` tinytext COLLATE utf8mb4_bin NOT NULL,
  `Estado` int(2) UNSIGNED ZEROFILL NOT NULL,
  `Postal` int(6) NOT NULL,
  `TelFijo` varchar(10) COLLATE utf8mb4_bin NOT NULL,
  `Celular` varchar(10) COLLATE utf8mb4_bin NOT NULL,
  `Correo` text COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `contactoalumno`
--

INSERT INTO `contactoalumno` (`Id`, `Calle`, `Colonia`, `Ciudad`, `Estado`, `Postal`, `TelFijo`, `Celular`, `Correo`) VALUES
('101019', 'AV. MICHOACAN #45', 'VISTA BELLA', 'MORELIA', 16, 0, '299 26 71', '443492518', ''),
('101036', 'BUCARELI #162', 'ERENDIRA', 'MORELIA', 16, 5824, '', '', ''),
('111006', 'JUAN JOSE DE LEJARZA  #258', 'CENTRO', 'MORELIA', 16, 58000, '0000000000', '0000000000', 'correo@correo.com'),
('111069', 'JOSE SIXTO VERDUZCO #218', 'ISAAC ARRIAGA', 'MORELIA', 16, 5821, '697289', '', ''),
('111078', 'SOR JUANA INES DE LA CRUZ #18', 'CENTRO', 'MORELIA', 16, 58, '313 63 71', '', ''),
('121059', 'SANTA MARTHA  #29', 'FRACC. SANTA MARTHA FUENTES VA', 'MORELIA', 16, 58195, '', '', ''),
('121078', 'PINO CHINO #755', 'REAL TULIPANES', 'MORELIA', 16, 586, '', '', ''),
('121099', 'MANGO #382', 'FRACC. LA HUERTA', 'MORELIA', 16, 588, '', '', ''),
('131037', 'JUAN RUIZ DE ALARCON #3', 'CUAUHTEMOC', 'MORELIA', 16, 582, '3134493', '', ''),
('141043', 'HUNGRIA # 91 #', 'METROPOLIS 2', 'MORELIA', 16, 5888, '4-27-66-5', '', ''),
('144317', 'FRAY JACOBO DACIANO #59', 'COL ANAHUAC', 'ZACAPU', 16, 5863, '43613461', '443 589395', 'lft.yajaira@gmail.com'),
('150050', 'ATECUARO #1686', 'FRACC LOMA LARGA', 'MORELIA', 16, 5895, '347535', '', ''),
('150070', 'BELLAS ARTES  #33', 'REAL UNIVERSIDAD', 'REAL UNIVERSIDAD', 16, 586, '', '', ''),
('151009', 'CIRCUITO LA ESPINACA INT. 31 #EDIF. 49', 'CAMPESTRE DEL VERGEL', 'MORELIA', 16, 58195, '', '', ''),
('151103', 'FRAY ALONSO DE HERRERA  #439', 'FRACC. SOLEAR OTE.', 'MORELIA', 16, 5821, '', '', ''),
('151109', 'MANUEL BONILLA #95', 'DEFENSORES DE PUEBLA', 'MORELIA', 16, 58147, '', '', ''),
('154088', 'RIO SILAO  #9', 'CAMPRESTRE DEL RIO', 'YURIRIA ', 15, 3894, '4451172564', '4451172564', 'luisjavier.lja@gmail.com'),
('160036', 'RINCàN DE ERATZICUA 8 #', 'FRACC. FRESNOS', 'MORELIA, MICHOACµN', 16, 0, '299447', '', ''),
('162022', 'AV. PASEO DEL PARQUE # 627 INT. 627', 'FRACC. PASEO DEL PARQUE', 'MORELIA', 16, 0, '443694755', '', ''),
('162059', 'CALZONTZIN # 13 INT. 13 ', 'FELIX IRETA', 'MORELIA', 16, 587, '4434257517', '4432862376', ''),
('170032', 'BALSAS #8', 'LAGO 1', 'MORELIA', 16, 58115, '44327583', '', ''),
('170085', 'GUANAJUATO INT. A #74', 'COL. MOLINO DE PARRAS', 'MORELIA', 16, 581, '4312124100', '1234567890', 'correo@correo.com'),
('171001', 'JUAN IBARRA #3', 'VILLAS DEL REAL', 'MORELIA', 16, 58116, '443145381', '', ''),
('171004', 'CUTZI #35', 'FELIX IRETA', 'MORELIA', 16, 587, '44324687 A', '', ''),
('171014', '2A. PRIVADA ANA MARIA GALLAGA INT. C #933', 'CUAUHTEMOC', 'MORELIA', 16, 582, '', '', ''),
('171092', 'AV. JARDINES #219', 'CAMPESTRE DEL VERGEL', 'MORELIA', 16, 58195, '', '', ''),
('171099', 'TZITZIQUI #39', 'FRACC. XANGARI', 'A. Obregon', 16, 58920, '4434403414', '4434403414', 'correo@correo.com'),
('172004', 'CIRCUITO ACONCAGUA #218', 'FRAC. PASEO ALTOZANO', 'MORELIA', 16, 5835, '', '', ''),
('172010', 'JUAN CRISOSTOMO BONILLA #362', 'DEFENSORES DE PUEBLA', 'MORELIA', 16, 0, '', '', ''),
('174011', 'CALZ PEDRO G GARZA Y TREVI¥O #87 COL BARRIO NUEVO SAN PEDRO COAHUILA #', '', 'MORELIA', 16, 0, '', '', 'ispcpagos@hotmail.com'),
('174046', 'CULTURA #71 COL. MOLINO DE PARRAS MORELIA MICH #', '', 'MORELIA', 16, 0, '', '4432859351', 'Arturo_ndo@hotmail.com'),
('174050', 'CALLE TABACHINES  ##19', '2DO SECTOR DE FIDELAC', 'LAZARO CARDENAS', 16, 695, '', '443217', 'aldo.f123@hotmail.com'),
('174055', 'AV. JUNTA DE JAUJILLA #489', 'JAUJILLA', 'MORELIA', 16, 58179, '443369451', '443132585', 'mabis_5@hotmail.com'),
('174128', '', '', 'MORELIA', 16, 0, '', '4431713217', 'libigonzalezgalvaan@outlook.com'),
('180036', 'CTO CUERAMO #18', 'FRACC. SAN GUILLERMO', 'MORELIA', 16, 0, '', '', ''),
('181001', 'AMADO CAMACHO #487', 'CHAPULTEPEC OTE.', 'MORELIA', 16, 5826, '4433159424', '', ''),
('181009', 'ANSELMO ORTEGA #143', 'DEFENSORES DE PUEBLA', 'MORELIA', 16, 58147, '312 78 47', '', ''),
('181106', 'JUAN RUIZ DE ALARCON  #21', 'CENTRO ', 'MORELIA', 16, 58, '', '', ''),
('182009', 'ANA MARIA GALLAGA  #631', 'CENTRO ', 'MORELIA', 16, 58, '', '', ''),
('182020', '2 DE NOVIEMBRE  #99', 'SAN JUANITO ITZICUARO', 'MORELIA', 16, 58341, '', '', ''),
('183025', 'LAZARO CARDENAZ #148', 'HEBERTO CASTILLO', 'MORELIA', 16, 589, '', '4434639888', 'josuealcantar149@gmail.com'),
('183039', 'PRIVADA MEXICO INT. 247 #35', 'AMERICAS BRITANIA', 'MORELIA', 16, 5827, '4433333659', '4434867815', 'correo@correo.com'),
('183046', 'MONTES URALES #127', 'VALLE DEL PARAISO', 'MORELIA', 16, 5835, '62412232', '4431294923', 'santiago.ferrer@cmn.edu.mx'),
('183080', 'ZIRAN ZIRAN CAMARO #45', 'VISTA BELLA', 'MORELIA', 16, 589, '324325', '44325965', 'ameg_yemi@hotmail.com'),
('184051', 'RICON DE JARIPO  #57', 'RINCON QUIETO', 'MORELIA', 16, 5869, '326343', '44 32 28 3', 'IVAN_RIVER.X@HOTMAIL.COM'),
('184124', 'AV. ACUEDUCTO #2417', 'LOMAS DE HIDALGO', 'MORELIA', 16, 5824, '443314412', '443526398', 'pequelupitazj86@gmail.com'),
('184167', 'PRIV. VICENTE SANTAMARÖA  #33', 'VENTURA PUENTE OTE.', 'MORELIA', 16, 582, '443189611', '753141424', 'surf14@outlook.com'),
('184170', 'CIRCUITO INSURGENTES #86', 'ANA MARIA GALLAGA ', 'MORELIA', 16, 58195, '', '4432164169', 'Fridam17@outlook.com'),
('190008', 'GERARDO MURILLO #96', 'FRACC. DIEGO RIVERA', 'MORELIA', 16, 58219, '44322397 A', '', ''),
('190036', 'SILVESTRE MARROQUIN #412', 'CONGRESO CONSTITUYENTES DEMICH', 'MORELIA', 16, 58219, '', '', ''),
('190064', 'RAZA ZAPOTECAS #48-A', 'LOMAS DE SANTIAGUITO', 'MORELIA', 16, 581200, '4433213278', '4433213278', 'correo@correo.com'),
('191005', 'JOSE MARIA LA FRAGUA INT. 2 #EDIF 21', 'INFONAVIT BENITO JUAREZ ', 'MORELIA', 16, 5867, '', '', ''),
('191050', 'PINO CHINO INT. A1 #27', 'FRACC REAL UNIVERSIDAD ', 'MORELIA', 16, 0, '', '', ''),
('191070', 'PEDRO ROSALES INT. 12 #16', 'BALCONES DE MORELIA ', 'MORELIA', 16, 5885, '3333333333', '2222222222', 'correo@correo.com'),
('191071', 'PEDRO ROSALES INT. 12 #16', 'BALCONES DE MORELIA ', 'MORELIA', 16, 5885, '', '', ''),
('191106', 'DE LOS VIENTOS #193', 'CAMPESTRE LA HUERTA ', 'MORELIA', 16, 0, '', '', ''),
('191115', 'AV QUINCEO  #21', 'LAGO 3', 'MORELIA', 16, 58115, '', '', ''),
('192011', 'CASIMIRO GOMEZ #69', 'FRACC. VILLAS DEL SUR II', 'MORELIA', 16, 5895, '', '', ''),
('192026', 'AV. JOSE MARIA MORELOS  #15', 'JESUS DEL MONTE ', 'MORELIA', 16, 58000, '0000000000', '0000000000', 'correo@correo.com'),
('192042', 'ASTRONOMOS  #6', 'AMP. JARDINES DEL TOREO ', 'MORELIA', 16, 5849, '', '', ''),
('193021', '22 OCTUBRE 1814 #39', 'HACIENDA TRINIDAD', 'MORELIA', 16, 58195, '44338127', '4431178911', ''),
('193087', 'AV. SAN JOSE DEL CERRITO INT. 18 #4', 'FRACCIONAMIENTO EL PUEBLITO', 'MORELIA', 16, 5888, '443228715', '443228715', 'yaspao@icloud.com'),
('194039', 'MATEO GARCIA VILLAGRAN  #5', 'JARDIN MORELIA ', 'TARIMBARO ', 16, 5888, '34394', '', 'valerialcaraz16@gmail.com'),
('194072', 'CERRADA FRANCISCO VILLA  #S/N', 'TECARIO', 'TACAMBARO ', 16, 61652, '459341613', '4591567', 'judithmorana6@gmail.com'),
('194108', 'JAVIER MINA  #45', 'CENTRO ', 'MORELIA', 16, 58, '443 3 12 1', '4434 37578', 'albertocamval166@gmail.com'),
('194151', 'ANTONIO CASO ANDRADE  #269', 'FRACC. VILLAS DEL SUR ', 'ZAMORA', 16, 589, '35152 5447', '351158736', 'stacyalfaroavila@hotmail.com'),
('194156', 'VILLAHERMOSA  #3', 'AMPLIACION REVOLUCION ', 'URUAPAN ', 16, 6153, '4432403851', '4522126165', 'correo@correo.com'),
('194164', 'TENIENTE ALEMAN  #116', 'CHAPULTEPEC SUR ', 'MORELIA ', 16, 5826, '4431 66892', '4431 66892', 'dr.gerardoag@outlook.com'),
('194176', 'DR. CAYETANO ANDRADE #275', 'CENTRO', 'MOROLEÓN', 15, 388, '4451 12571', '4451 12571', 'mananalaraalc@outlook.com'),
('200041', 'ORDENANZAS 75 #45', 'VASCO DE QUIROGA', 'MORELIA', 16, 5823, '4431822576', '', ''),
('201016', 'CALLE CINO  #261', 'MATAMOROS ', 'MORELIA', 16, 5824, '', '', ''),
('201032', 'VICENTE MORALES  #50', 'COLONIA', 'Morelia', 16, 5895, '4432000000', '4432111111', 'correo@correo.com'),
('201036', 'GANADERIA DE TEQUISQUIAPAN  #383', 'AMP. JARDINES DEL TOREO ', 'MORELIA', 16, 5849, '2992114', '', ''),
('201046', 'ROBLE BLANCO #42', 'FRACC.PASEO LOS ENCINOS', 'MORELIA', 16, 5887, '', '', ''),
('201067', 'AV. PASEO DEL PARQUE  #357', 'PASEO DEL PARQUE', 'MORELIA', 16, 0, '', '', ''),
('202021', '2DO. RETORNO DEL CASTOR #24', 'FRACC. COLINAS DE ALTOZANO', 'Morelia', 16, 5835, '', '', ''),
('203006', 'ANTONIO PLAZA INT. 13 #42', 'LOMAS DE SANTA MARIA', 'MORELIA', 16, 589, '4431969383', '', ''),
('203038', 'CIRCUITO CAMPESTRE  #33', 'FRACC CLUB CAMPESTRE ', 'MORELIA', 16, 58296, '443141161', '', ''),
('204001', 'TZINTZUNTZAN  #1954', 'MARIANO MATAMOROS ', 'MORELIA', 16, 5824, '', '4433253726', ''),
('204003', 'INDEPENDENCIA  #12', 'CENTRO', 'URUAPAN', 16, 6, '4525242965', '45217116', 'montseuruapan@gmail.com'),
('204024', 'CASCADA #124', 'AMPLIACIàN GERTRUDIS SANCHEZ ', 'MORELIA', 16, 58116, '4434278716', '4434386188', 'roxverani@live.com.mx'),
('204070', 'CAPITAN MIGUEL LEBRIJA #648', 'JARDINES DE GUADALUPE', 'MORELIA', 16, 5814, '4432 27 46', '44348539', 'alejandremorenodagne@gmai.com'),
('204088', 'LAS FLORES #1', 'BARRIO SANTO SANTIAGO', 'SAN JUAN NUEVO', 16, 649, '452 113 2 ', '4521988586', 'aguilarmontserrat419@gmail.com'),
('204104', '24 DE FEBRERO #14', 'PARCELA', 'PUEBLA', 21, 7339, '221 413 1 ', '22141314', 'conyarroyo94@gmail.com'),
('204161', 'CA¥ADA DE SAN MARTIN  #416', 'TRES MARÖAS', 'MORELIA', 16, 0, '4431718152', '443249374', 'lauraw_avm@hotmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datosidalumno`
--

CREATE TABLE `datosidalumno` (
  `Id` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `Nombre` text COLLATE utf8mb4_bin NOT NULL,
  `Apellidos` text COLLATE utf8mb4_bin NOT NULL,
  `Grado` int(1) NOT NULL,
  `Grupo` int(1) NOT NULL,
  `Seccion` int(1) NOT NULL,
  `IdGrupo` varchar(5) COLLATE utf8mb4_bin NOT NULL,
  `Correo` text COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `datosidalumno`
--

INSERT INTO `datosidalumno` (`Id`, `Nombre`, `Apellidos`, `Grado`, `Grupo`, `Seccion`, `IdGrupo`, `Correo`) VALUES
('101019', 'FERNANDO ', 'BARRERA CASTRO', 3, 2, 2, 'SEC32', 'correo@correo.com'),
('101036', 'GIOVANNA ', 'QUINTERO QUIÑONEZ', 3, 3, 2, 'SEC33', 'correo@correo.com'),
('111006', 'BRIANY YARETZY', 'CAMARGO MARROQUIN', 1, 2, 2, 'SEC12', 'correo@correo.com'),
('111069', 'AZUL ', 'LUCAS CASTAÑEDA', 1, 1, 2, 'SEC11', 'correo@correo.com'),
('111078', 'SOFIA ', 'HERNANDEZ CRUZ', 2, 3, 2, 'SEC23', 'correo@correo.com'),
('121059', 'MONTSERRAT ', 'IBARRA TORRES', 6, 3, 1, 'PRI63', 'correo@correo.com'),
('121078', 'JAIME ELIAS', 'MORALES MEDINA', 2, 2, 2, 'SEC22', 'correo@correo.com'),
('121099', 'ARIADNE ', 'MEDINA RAMOS', 6, 2, 1, 'PRI62', 'correo@correo.com'),
('131037', 'JOSE HESED', 'CRUZ HERNANDEZ', 6, 4, 1, 'PRI64', 'correo@correo.com'),
('141043', 'LUIS SEBASTIAN', 'ESPINOZA JULIAN', 5, 2, 1, 'PRI52', 'correo@correo.com'),
('144317', 'YAJAIRA ', 'LEON REYES', 2, 1, 4, 'ERN21', 'correo@correo.com'),
('150050', 'NETZAHUALCOYOTL ', 'NARANJO CORIA', 6, 1, 1, 'PRI61', 'correo@correo.com'),
('150070', 'SOPHIA MICHELL', 'FELIX PALOMARES', 1, 3, 2, 'SEC13', 'correo@correo.com'),
('151009', 'ARIEL EDUARDO', 'JIMENEZ DELGADO', 3, 1, 1, 'PRI31', 'correo@correo.com'),
('151103', 'MIGUEL ANGEL', 'GUATI ROJO NUÑEZ', 3, 2, 1, 'PRI32', 'correo@correo.com'),
('151109', 'ANTONIA ', 'MELGOZA RODRIGUEZ', 3, 4, 1, 'PRI34', 'correo@correo.com'),
('154088', 'LUIS JAVIER', 'AGUILERA ABARCA', 1, 1, 4, 'ETO11', 'correo@correo.com'),
('154139', 'MARINA ', 'COATL CUAYA', 5, 1, 4, 'LFC51', 'correo@correo.com'),
('160036', 'MARIA JOSE', 'GIL ARANA', 5, 3, 1, 'PRI53', 'correo@correo.com'),
('162022', 'VALENTINA ', 'RUIZ VERA', 3, 1, 3, 'BAC31', 'correo@correo.com'),
('162059', 'REGINA ', 'ARCHUNDIA CAMPOS', 3, 3, 3, 'BAC33', 'correo@correo.com'),
('170032', 'KIMBERLY SOFIA', 'CALDERON VILLALOBOS', 4, 1, 1, 'PRI41', 'correo@correo.com'),
('170085', 'IKER ', 'MONGE CARRILLO', 4, 2, 1, 'PRI42', 'correo@correo.com'),
('171001', 'NATALIA ', 'MARRERO GONZALEZ', 2, 5, 1, 'PRI25', 'correo@correo.com'),
('171004', 'FRANCISCO ', 'GALINDO MOLINA', 2, 1, 1, 'PRI21', 'correo@correo.com'),
('171014', 'ALONDRA DENERIS', 'FUENTES HERNANDEZ', 1, 3, 1, 'PRI13', 'correo@correo.com'),
('171092', 'ANGEL ', 'GARDUÑO JIMENEZ', 2, 3, 1, 'PRI23', 'correo@correo.com'),
('171099', 'MATEO ', 'JIMENEZ DE LA VEGA', 1, 2, 1, 'PRI12', 'correo@correo.com'),
('172004', 'HECTOR MANUEL', 'ARREOLA PEREZ', 1, 3, 3, 'BAC13', 'correo@correo.com'),
('172010', 'MAJLI CONSTANZA', 'CAMACHO LARA', 1, 2, 3, 'BAC12', 'correo@correo.com'),
('174011', 'GRACIELA ', 'ROSALES ARMAS', 4, 1, 4, 'LFC41', 'correo@correo.com'),
('174015', 'MARIO ALBERTO', 'CAZAREZ MEZA', 2, 1, 4, 'LFC21', 'correo@correo.com'),
('174046', 'ARTURO NOEL', 'DIAZ OROZCO', 7, 2, 4, 'LFR72', 'correo@correo.com'),
('174050', 'ALDO ', 'FARIAS CHAVEZ', 5, 1, 4, 'LFR51', 'correo@correo.com'),
('174055', 'MELISSA ', 'GARCIA CARAPIA', 7, 1, 4, 'LFR71', 'correo@correo.com'),
('174128', 'LIZBETH GUADALUPE', 'GONZALEZ GALVAN', 7, 1, 4, 'LNI71', 'correo@correo.com'),
('180036', 'MISAEL ', 'PACHECO SAUCEDO', 3, 3, 1, 'PRI33', 'correo@correo.com'),
('181001', 'DAVID ', 'HERNANDEZ CORREA', 2, 4, 1, 'PRI24', 'correo@correo.com'),
('181009', 'ADAN SEBASTIAN', 'CHAVEZ MORRAZ', 3, 2, 0, 'PRE32', 'correo@correo.com'),
('181106', 'REGINA ', 'CEDEÑO GONZALEZ', 1, 1, 1, 'PRI11', 'correo@correo.com'),
('182009', 'JOSE ANGEL', 'BALLESTEROS PIÑON', 3, 1, 2, 'SEC31', 'correo@correo.com'),
('182020', 'JOAQUIN ', 'JIMENEZ CORONA', 3, 4, 2, 'SEC34', 'correo@correo.com'),
('183025', 'JOSUE GEOVANNY', 'ALCAUTER ORTEGA', 5, 4, 3, 'BAC54', 'correo@correo.com'),
('183039', 'DANIELA ', 'MOLINA PALMERIN', 5, 2, 3, 'BAC52', 'correo@correo.com'),
('183046', 'SANTIAGO ', 'FERRER VALLE', 5, 3, 3, 'BAC53', 'correo@correo.com'),
('183080', 'GEMA ', 'AYALA HUERTA', 5, 1, 3, 'BAC51', 'correo@correo.com'),
('184051', 'CARLOS IVAN', 'DIAZ CAMBRON', 5, 2, 4, 'LFR52', 'correo@correo.com'),
('184106', 'HECTOR JOSE', 'MEJIA VELAZQUEZ', 5, 1, 4, 'LNI51', 'correo@correo.com'),
('184124', 'MARIA GUADALUPE', 'ZAMORA JIMENEZ', 3, 1, 4, 'LFC31', 'correo@correo.com'),
('184167', 'FRANCISCO JOSE', 'JIMENEZ MAGAÑA', 3, 3, 4, 'LFR33', 'correo@correo.com'),
('184170', 'FRIDA ', 'MEDINA CHAVEZ', 5, 3, 4, 'LFR53', 'correo@correo.com'),
('190008', 'LEONARDO ', 'RAMIREZ GUTIERREZ', 2, 2, 1, 'PRI22', 'correo@correo.com'),
('190036', 'ANDREA ', 'CHAVEZ JACOBO', 1, 4, 2, 'SEC14', 'correo@correo.com'),
('190064', 'OSCAR ZOE', 'MAGDALENO CENDEJAS', 4, 3, 1, 'PRI43', 'correo@correo.com'),
('191005', 'SANTIAGO ', 'CUEVAS GUZMAN', 3, 4, 0, 'PRE34', 'correo@correo.com'),
('191050', 'BRUNO EMILIO', 'CASTRO BARRIOS', 2, 3, 0, 'PRE23', 'correo@correo.com'),
('191070', 'SEBASTIAN ', 'BUENROSTRO SALTO', 2, 1, 0, 'PRE21', 'correo@correo.com'),
('191071', 'ANGEL ', 'BUENROSTRO SALTO', 2, 2, 0, 'PRE22', 'correo@correo.com'),
('191106', 'IAN PABLO', 'HERNANDEZ VAZQUEZ', 2, 4, 0, 'PRE24', 'correo@correo.com'),
('191115', 'IVANA QUETZALI', 'ORTIZ VEGA', 1, 4, 1, 'PRI14', 'correo@correo.com'),
('192011', 'ALEXANDRA ', 'VALDES MALDONADO', 2, 4, 2, 'SEC24', 'correo@correo.com'),
('192026', 'MARIANA ', 'MOLINA GONZALEZ', 2, 1, 2, 'SEC21', 'correo@correo.com'),
('192042', 'MIRANDA ', 'FLORES SANTANA', 2, 5, 2, 'SEC25', 'correo@correo.com'),
('193021', 'GRECIA ANETTE', 'GARIBAY SOLIS', 3, 4, 3, 'BAC34', 'correo@correo.com'),
('193087', 'LESLIE PAOLA', 'HERNANDEZ CARLOS', 3, 2, 3, 'BAC32', 'correo@correo.com'),
('194039', 'VALERIA ', 'ALCARAZ GARCIA', 3, 1, 4, 'LNI31', 'correo@correo.com'),
('194072', 'JUDITH ', 'MORENO ALVAREZ', 3, 1, 4, 'LAV31', 'correo@correo.com'),
('194108', 'ALBERTO ', 'CAMPOS VALDES', 3, 2, 4, 'LFR32', 'correo@correo.com'),
('194151', 'STACY ARELY', 'ALFARO AVILA', 3, 1, 4, 'LFR31', 'correo@correo.com'),
('194156', 'PAULINA ALEJANDRA', 'ANGEL SANCHEZ', 3, 1, 4, 'ARQ31', 'correo@correo.com'),
('194164', 'GERARDO ', 'ACUÑA GOMEZ', 2, 1, 4, 'ETO21', 'correo@correo.com'),
('194176', 'MARIANA ', 'LARA ALCANTAR', 2, 1, 4, 'ERD21', 'correo@correo.com'),
('200041', 'MATIAS ALEJANDRO', 'MALVIDO SOLIS', 5, 1, 1, 'PRI51', 'correo@correo.com'),
('201016', 'PATRICIA ', 'BELTRAN BARTOLO', 1, 2, 0, 'PRE12', 'correo@correo.com'),
('201032', 'MIA LUISA', 'BALLESTEROS BRISEÑO', 1, 1, 0, 'PRE11', 'correo@correo.com'),
('201036', 'MATEO ', 'CHAVEZ HUERTA', 3, 1, 0, 'PRE31', 'correo@correo.com'),
('201046', 'AXEL MIKEL', 'GARCIA VARGAS', 3, 3, 0, 'PRE33', 'correo@correo.com'),
('201067', 'LUCIANA ', 'CASTILLO LINARES', 1, 3, 0, 'PRE13', 'correo@correo.com'),
('202021', 'RODRIGO ', 'CORONA MENDOZA', 1, 5, 2, 'SEC15', 'correo@correo.com'),
('203006', 'CAMILA ', 'CABALLERO CHAVEZ', 1, 4, 3, 'BAC14', 'correo@correo.com'),
('203038', 'DIRVANA ', 'COLOR AGUIRRE', 1, 1, 3, 'BAC11', 'correo@correo.com'),
('204001', 'MARINA ', 'CRUZ CANO', 1, 1, 4, 'LDE11', 'correo@correo.com'),
('204003', 'NATALIA MONTSERRAT', 'BELTRAN PAZ', 1, 1, 4, 'LFR11', 'correo@correo.com'),
('204024', 'ROXANA YEOSVERANI', 'ALVA GARCIA', 1, 1, 4, 'LAV11', 'correo@correo.com'),
('204070', 'DAGNE ', 'ALEJANDRE MORENO', 1, 1, 4, 'LNI11', 'correo@correo.com'),
('204088', 'GUADALUPE MONTSERRAT', 'AGUILAR ROSAS', 1, 2, 4, 'LFR12', 'correo@correo.com'),
('204104', 'CONCEPCION ', 'ARROYO PATIÑO', 1, 1, 4, 'LFC11', 'correo@correo.com'),
('204161', 'LAURA EUGENIA', 'ALEMAN VILLALON', 1, 3, 4, 'LFR13', 'correo@correo.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datosidusuario`
--

CREATE TABLE `datosidusuario` (
  `Id` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `Nombres` text COLLATE utf8mb4_bin NOT NULL,
  `Seccion` set('0','1','2','3','4','5','10') COLLATE utf8mb4_bin NOT NULL,
  `Grado` set('1','2','3','4','5','6','7','8') COLLATE utf8mb4_bin NOT NULL,
  `Carrera` set('NO','ARQ','EFR','LAV','LDE','LFC','LFR','LNI') COLLATE utf8mb4_bin NOT NULL DEFAULT 'NO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin COMMENT='Datos Usuarios';

--
-- Volcado de datos para la tabla `datosidusuario`
--

INSERT INTO `datosidusuario` (`Id`, `Nombres`, `Seccion`, `Grado`, `Carrera`) VALUES
('ControlEsc', 'CONTROL ESCOLAR', '1', '', 'NO'),
('admin', 'Administrador', '10', '', 'NO'),
('bachillerato1', 'Titular Bach 1ro', '3', '1', 'NO'),
('bachillerato3', 'Titular Bach 3ro', '3', '3', 'NO'),
('becas', 'Responsable de BECAS', '10', '', 'NO'),
('controlbachillerato', 'Control Escolar bachillerato', '3', '', 'NO'),
('controlpreescolar', 'Control Escolar Preescolar', '0', '', 'NO'),
('controlprimaria', 'Control Escolar Primaria', '1', '', 'NO'),
('controlsecundaria', 'Control Escolar Secundaria', '2', '', 'NO'),
('controluniversidad', 'Control Escolar Universidad', '4', '', 'NO'),
('coordinador', 'Coordinador Primaria', '1', '', 'NO'),
('coordinadorUNI', 'Coordinacion Universidad', '4', '', 'LNI'),
('docente', 'Docente Universidad', '4', '1', 'LFR'),
('fisioterapia1', 'Titular LFR 1ro', '2', '1', 'LFR'),
('fisioterapia3', 'Titular LFR 3ro', '4', '3', 'LFR'),
('jjmoreno23', 'José de Jesús Moreno Contreras', '10', '', 'NO'),
('preescolar1A', 'Titular PRE11', '0', '1', 'NO'),
('preescolar2A', 'Titular PRE21', '0', '2', 'NO'),
('primaria1A', 'Titular PRI11', '1', '1', 'NO'),
('primaria2A', 'Titular PRI21', '1', '2', 'NO'),
('secundaria1A', 'Titular SEC11', '2', '1', 'NO'),
('secundaria2A', 'Titular SEC21', '2', '2', 'NO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `IdGrupo` varchar(5) COLLATE utf8mb4_bin NOT NULL,
  `Seccion` int(11) NOT NULL,
  `Grado` int(11) NOT NULL,
  `Ciclo` varchar(5) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`IdGrupo`, `Seccion`, `Grado`, `Ciclo`) VALUES
('ARQ31', 4, 1, '20-1'),
('BAC11', 3, 1, '20-1'),
('BAC12', 3, 1, '20-1'),
('BAC13', 3, 1, '20-1'),
('BAC14', 3, 1, '20-1'),
('BAC31', 3, 3, '20-1'),
('BAC32', 3, 3, '20-1'),
('BAC33', 3, 3, '20-1'),
('BAC34', 3, 3, '20-1'),
('BAC51', 3, 5, '20-1'),
('BAC52', 3, 5, '20-1'),
('BAC53', 3, 5, '20-1'),
('BAC54', 3, 5, '20-1'),
('ERD21', 4, 2, '20-1'),
('ERN21', 4, 2, '20-1'),
('ETO11', 4, 1, '20-1'),
('ETO21', 4, 2, '20-1'),
('LAV11', 4, 1, '20-1'),
('LAV31', 4, 3, '20-1'),
('LAV51', 4, 5, '20-1'),
('LAV71', 4, 7, '20-1'),
('LDE11', 4, 1, '20-1'),
('LFC11', 4, 1, '20-1'),
('LFC21', 4, 2, '20-1'),
('LFC31', 4, 3, '20-1'),
('LFC41', 4, 4, '20-1'),
('LFC51', 4, 5, '20-1'),
('LFR11', 4, 1, '20-1'),
('LFR12', 4, 1, '20-1'),
('LFR13', 4, 1, '20-1'),
('LFR14', 4, 1, '20-1'),
('LFR31', 4, 3, '20-1'),
('LFR32', 4, 3, '20-1'),
('LFR33', 4, 3, '20-1'),
('LFR51', 4, 5, '20-1'),
('LFR52', 4, 5, '20-1'),
('LFR53', 4, 5, '20-1'),
('LFR71', 4, 5, '20-1'),
('LFR72', 4, 5, '20-1'),
('LNI11', 4, 1, '20-1'),
('LNI31', 4, 3, '20-1'),
('LNI51', 4, 5, '20-1'),
('LNI71', 4, 5, '20-1'),
('PRE11', 0, 1, '20-0'),
('PRE12', 0, 1, '20-0'),
('PRE13', 0, 1, '20-0'),
('PRE21', 0, 2, '20-0'),
('PRE22', 0, 2, '20-0'),
('PRE23', 0, 2, '20-0'),
('PRE24', 0, 2, '20-0'),
('PRE31', 0, 3, '20-0'),
('PRE32', 0, 3, '20-0'),
('PRE33', 0, 3, '20-0'),
('PRE34', 0, 3, '20-0'),
('PRI11', 1, 1, '20-0'),
('PRI12', 1, 1, '20-0'),
('PRI13', 1, 1, '20-0'),
('PRI14', 1, 1, '20-0'),
('PRI21', 1, 2, '20-0'),
('PRI22', 1, 2, '20-0'),
('PRI23', 1, 2, '20-0'),
('PRI24', 1, 2, '20-0'),
('PRI31', 1, 3, '20-0'),
('PRI32', 1, 3, '20-0'),
('PRI33', 1, 3, '20-0'),
('PRI34', 1, 3, '20-0'),
('PRI41', 1, 4, '20-0'),
('PRI42', 1, 4, '20-0'),
('PRI43', 1, 4, '20-0'),
('PRI51', 1, 5, '20-0'),
('PRI52', 1, 5, '20-0'),
('PRI53', 1, 5, '20-0'),
('PRI61', 1, 6, '20-0'),
('PRI62', 1, 6, '20-0'),
('PRI63', 1, 6, '20-0'),
('SEC11', 2, 1, '20-0'),
('SEC12', 2, 1, '20-0'),
('SEC13', 2, 1, '20-0'),
('SEC21', 2, 2, '20-0'),
('SEC22', 2, 2, '20-0'),
('SEC23', 2, 2, '20-0'),
('SEC24', 2, 2, '20-0'),
('SEC31', 2, 3, '20-0'),
('SEC32', 2, 3, '20-0'),
('SEC33', 2, 3, '20-0'),
('SEC34', 2, 3, '20-0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reinscripciones`
--

CREATE TABLE `reinscripciones` (
  `Id` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `Seccion` int(11) NOT NULL,
  `CicloAct` varchar(4) COLLATE utf8mb4_bin NOT NULL,
  `CicloSig` varchar(4) COLLATE utf8mb4_bin NOT NULL,
  `Grado` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `flag` int(11) NOT NULL DEFAULT 0,
  `Fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Observaciones` text COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `reinscripciones`
--

INSERT INTO `reinscripciones` (`Id`, `Seccion`, `CicloAct`, `CicloSig`, `Grado`, `Status`, `flag`, `Fecha`, `Observaciones`) VALUES
('111006', 2, '20-0', '21-0', 2, 0, 0, '2021-03-13 16:09:54', NULL),
('170085', 1, '20-0', '21-0', 5, 2, 0, '2021-03-16 14:44:45', ''),
('171099', 1, '20-0', '21-0', 2, 0, 0, '2021-03-19 19:55:35', NULL),
('183039', 3, '20-1', '20-2', 6, 0, 0, '2021-03-16 14:24:57', NULL),
('190064', 1, '20-0', '21-0', 5, 0, 0, '2021-03-13 15:59:34', ''),
('191070', 0, '20-0', '21-0', 3, 0, 0, '2021-03-13 15:46:41', 'revisa la documentacion'),
('192026', 2, '20-0', '21-0', 3, 0, 0, '2021-03-13 16:23:55', NULL),
('194156', 4, '20-1', '20-2', 4, 0, 4, '2021-04-12 17:09:20', NULL),
('201032', 0, '20-0', '21-0', 2, 2, 0, '2021-03-14 03:03:39', 'Hola');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `titulares`
--

CREATE TABLE `titulares` (
  `IdUsuario` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `Ciclo` varchar(5) COLLATE utf8mb4_bin NOT NULL,
  `IdGrupo` varchar(5) COLLATE utf8mb4_bin NOT NULL,
  `Consecutivo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `titulares`
--

INSERT INTO `titulares` (`IdUsuario`, `Ciclo`, `IdGrupo`, `Consecutivo`) VALUES
('docente', '20-1', 'LNI11', 1),
('docente', '20-1', 'LAV11', 2),
('preescolar1A', '20-0', 'PRE11', 3),
('preescolar2A', '20-0', 'PRE21', 4),
('bachillerato1', '20-1', 'BAC11', 5),
('bachillerato1', '20-1', 'BAC12', 6),
('fisioterapia1', '20-1', 'LFR11', 7),
('fisioterapia1', '20-1', 'LFR12', 8),
('primaria1A', '20-1', 'PRI11', 9),
('primaria2A', '20-1', 'PRI21', 10),
('secundaria1A', '20-1', 'SEC11', 11),
('secundaria2A', '20-1', 'SEC21', 12),
('bachillerato3', '20-1', 'BAC31', 13),
('bachillerato3', '20-1', 'BAC33', 14),
('fisioterapia3', '20-1', 'LFR31', 15),
('fisioterapia3', '20-1', 'LFR33', 16),
('fisioterapia3', '20-1', 'LFR32', 17);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `Id` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `Pass` varchar(70) COLLATE utf8mb4_bin NOT NULL,
  `Type` int(1) NOT NULL DEFAULT 0,
  `Privileges` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin COMMENT='Tabla de Usuarios (sin datos)';

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Id`, `Pass`, `Type`, `Privileges`) VALUES
('101019', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('101036', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('111006', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('111069', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('111078', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('121059', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('121078', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('121099', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('131037', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('141043', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('144317', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('150050', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('150070', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('151009', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('151103', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('151109', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('154088', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('154139', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('160036', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('162022', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('162059', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('170032', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('170085', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('171001', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('171004', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('171014', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('171092', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('171099', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('172004', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('172010', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('174011', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('174015', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('174046', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('174050', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('174055', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('174128', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('180036', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('181001', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('181009', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('181106', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('182009', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('182020', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('183025', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('183039', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('183046', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('183080', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('184051', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('184106', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('184124', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('184167', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('184170', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('190008', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('190036', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('190064', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('191005', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('191050', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('191070', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('191071', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('191106', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('191115', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('192011', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('192026', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('192042', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('193021', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('193087', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('194039', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('194072', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('194108', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('194151', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('194156', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('194164', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('194176', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('200041', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('201016', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('201032', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('201036', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('201046', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('201067', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('202021', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('203006', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('203038', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('204001', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('204003', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('204024', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('204070', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('204088', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('204104', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('204161', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
('ControlEsc', 'e10adc3949ba59abbe56e057f20f883e', 1, 3),
('admin', 'e10adc3949ba59abbe56e057f20f883e', 1, 5),
('bachillerato1', 'e10adc3949ba59abbe56e057f20f883e', 1, 2),
('bachillerato3', 'e10adc3949ba59abbe56e057f20f883e', 1, 2),
('becas', '85e0c3574dab7f1ce9bd720b96b69645', 1, 4),
('controlbachillerato', 'e10adc3949ba59abbe56e057f20f883e', 1, 3),
('controlpreescolar', 'e10adc3949ba59abbe56e057f20f883e', 1, 3),
('controlprimaria', 'e10adc3949ba59abbe56e057f20f883e', 1, 3),
('controlsecundaria', 'e10adc3949ba59abbe56e057f20f883e', 1, 3),
('controluniversidad', 'e10adc3949ba59abbe56e057f20f883e', 1, 3),
('coordinador', 'e10adc3949ba59abbe56e057f20f883e', 1, 5),
('coordinadorUNI', 'e10adc3949ba59abbe56e057f20f883e', 1, 5),
('docente', 'ac99fecf6fcb8c25d18788d14a5384ee', 1, 2),
('fisioterapia1', 'e10adc3949ba59abbe56e057f20f883e', 1, 2),
('fisioterapia3', 'e10adc3949ba59abbe56e057f20f883e', 1, 2),
('jjmoreno23', 'e10adc3949ba59abbe56e057f20f883e', 1, 6),
('preescolar1A', 'e10adc3949ba59abbe56e057f20f883e', 1, 2),
('preescolar2A', 'e10adc3949ba59abbe56e057f20f883e', 1, 2),
('primaria1A', 'e10adc3949ba59abbe56e057f20f883e', 1, 2),
('primaria2A', 'e10adc3949ba59abbe56e057f20f883e', 1, 2),
('secundaria1A', 'e10adc3949ba59abbe56e057f20f883e', 1, 2),
('secundaria2A', 'e10adc3949ba59abbe56e057f20f883e', 1, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `avisos`
--
ALTER TABLE `avisos`
  ADD UNIQUE KEY `AvisosIDX` (`Consecutivo`);

--
-- Indices de la tabla `becas`
--
ALTER TABLE `becas`
  ADD UNIQUE KEY `IdxBeca` (`Id`,`CicloAct`,`Seccion`);

--
-- Indices de la tabla `circulares`
--
ALTER TABLE `circulares`
  ADD PRIMARY KEY (`IdCircular`);

--
-- Indices de la tabla `contactoalumno`
--
ALTER TABLE `contactoalumno`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `datosidalumno`
--
ALTER TABLE `datosidalumno`
  ADD UNIQUE KEY `Id` (`Id`);

--
-- Indices de la tabla `datosidusuario`
--
ALTER TABLE `datosidusuario`
  ADD UNIQUE KEY `Id` (`Id`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD UNIQUE KEY `IdxGrupo` (`IdGrupo`,`Ciclo`);

--
-- Indices de la tabla `reinscripciones`
--
ALTER TABLE `reinscripciones`
  ADD UNIQUE KEY `IdxReinsc` (`Id`,`CicloAct`);

--
-- Indices de la tabla `titulares`
--
ALTER TABLE `titulares`
  ADD PRIMARY KEY (`Consecutivo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD UNIQUE KEY `Id` (`Id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `avisos`
--
ALTER TABLE `avisos`
  MODIFY `Consecutivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `circulares`
--
ALTER TABLE `circulares`
  MODIFY `IdCircular` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `titulares`
--
ALTER TABLE `titulares`
  MODIFY `Consecutivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `becas`
--
ALTER TABLE `becas`
  ADD CONSTRAINT `Becas_ibfk_1` FOREIGN KEY (`Id`) REFERENCES `datosidalumno` (`Id`);

--
-- Filtros para la tabla `contactoalumno`
--
ALTER TABLE `contactoalumno`
  ADD CONSTRAINT `ContactoAlumno_ibfk_1` FOREIGN KEY (`Id`) REFERENCES `datosidalumno` (`Id`);

--
-- Filtros para la tabla `reinscripciones`
--
ALTER TABLE `reinscripciones`
  ADD CONSTRAINT `Reinscripciones_ibfk_1` FOREIGN KEY (`Id`) REFERENCES `datosidalumno` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
