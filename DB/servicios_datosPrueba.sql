-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-03-2021 a las 15:56:11
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 8.0.2

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
  `Titulo` varchar(30) COLLATE utf8mb4_bin NOT NULL,
  `Contenido` longtext COLLATE utf8mb4_bin NOT NULL,
  `Url` text COLLATE utf8mb4_bin NOT NULL,
  `Imagen` text COLLATE utf8mb4_bin NOT NULL,
  `Fecha_Inicio` date NOT NULL,
  `Fecha_Fin` date NOT NULL,
  `Activo` text COLLATE utf8mb4_bin DEFAULT NULL,
  `Usuario` text COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `avisos`
--

INSERT INTO `avisos` (`Consecutivo`, `Seccion`, `Grado`, `Grupo`, `Titulo`, `Contenido`, `Url`, `Imagen`, `Fecha_Inicio`, `Fecha_Fin`, `Activo`, `Usuario`) VALUES
(1, 'UNI', 0, NULL, 'Aviso 1', 'Este es un aviso de Prueba, la sección es Universidad y es General', 'http://umvalla.edu.mx', 'images/pic01.jpg', '2020-07-17', '2021-01-01', 'Si', 'jjmoreno23'),
(2, 'LFR', 0, NULL, 'Aviso 2', 'Este es un segundo aviso de prueba. Recuerda que puedes tener varios dependiendo de la sección.', 'http://umvalla.edu.mx', 'images/pic02.jpg', '2020-07-17', '2021-04-01', 'Si', 'jjmoreno23'),
(3, 'BAC', 0, NULL, 'Aviso 3', 'PREPARATORIA. Este es un tercer aviso de prueba. Recuerda que puedes tener varios dependiendo de la sección.', 'http://umvalla.edu.mx', 'images/pic03.jpg', '2020-07-17', '2021-04-01', 'Si', 'jjmoreno23'),
(4, 'LFR', 1, 'LFR11', 'Aviso 4', 'Este es un cuarto aviso de prueba. Recuerda que puedes tener varios dependiendo de la sección.', 'http://umvalla.edu.mx', 'images/pic04.jpg', '2021-03-15', '2021-04-30', 'Si', 'jjmoreno23'),
(10, 'LFR', 0, '', 'T&iacute;tulo del Aviso', 'Texto del Contenido', 'https://valladolid.edu.mx/Servicios-Escolares/secundaria/media/InvitacionFestival.jpg', 'images/LOGO MARISTAS ANAGRAMA.jpg', '2021-03-01', '2021-03-31', 'Si', 'jjmoreno23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `becas`
--

CREATE TABLE `becas` (
  `Id` varchar(20) COLLATE utf8mb4_bin NOT NULL,
  `Seccion` varchar(3) COLLATE utf8mb4_bin NOT NULL,
  `CicloAct` varchar(4) COLLATE utf8mb4_bin NOT NULL,
  `CicloSig` varchar(4) COLLATE utf8mb4_bin NOT NULL,
  `Grado` int(11) NOT NULL,
  `Tipo` varchar(3) COLLATE utf8mb4_bin NOT NULL,
  `Status` int(11) DEFAULT 0,
  `Fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Observaciones` text COLLATE utf8mb4_bin DEFAULT NULL,
  `Review` text COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `circulares`
--

CREATE TABLE `circulares` (
  `IdCircular` int(11) NOT NULL,
  `Seccion` varchar(10) COLLATE utf8mb4_bin NOT NULL,
  `IdGrupo` varchar(10) COLLATE utf8mb4_bin NOT NULL,
  `Descripcion` varchar(80) COLLATE utf8mb4_bin NOT NULL,
  `Archivo` text COLLATE utf8mb4_bin NOT NULL,
  `Ciclo` varchar(5) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `circulares`
--

INSERT INTO `circulares` (`IdCircular`, `Seccion`, `IdGrupo`, `Descripcion`, `Archivo`, `Ciclo`) VALUES
(1, 'LFR', 'LFR11', 'Indicaciones sobre Reuniones Zoom', 'circulares/4/LFR_CertificateRemoteWorkandVirtualCollaboration.pdf', '20-1'),
(2, 'LFR', 'LFR12', 'Indicaciones sobre Reuniones Zoom Grupo 12', 'circulares/4/LFR_CertificateRemoteWorkandVirtualCollaboration.pdf', '20-1'),
(3, 'PRI', '', 'Circular del mes de Marzo Primaria', 'circulares/1/FreeRDP-User-Manual.pdf', '20-0'),
(4, 'LFR', '', 'Indicaciones entrega de documentación oficial a Control Escolar', 'circulares/4/LFR_CertificateRemoteWorkandVirtualCollaboration.pdf', '20-1'),
(5, 'LFR', '', 'Circular de Bienvenida, indicaciones Generales', 'circulares/4/LFR_PagoFinalCredito.pdf', '20-1'),
(6, 'PRI', '', 'Indicaciones Generales para REINSCRIPCIÓN', 'circulares/1/Reporte André.pdf', '20-0'),
(7, 'PRI', 'PRI31', 'Circular de Prueba', 'circulares/1/Circular Febrero 2021- personal docente.pdf', '20-0'),
(8, 'LFR', '', 'Circular 2. Venta de Libros', 'circulares/4/LFR_DepositoOMG.pdf', '20-1'),
(9, 'LFR', 'LFR11', 'Circular del mes de Marzo', 'circulares/4/LFR_Recibo-Feb.pdf', '20-1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactoalumno`
--

CREATE TABLE `contactoalumno` (
  `Id` varchar(20) COLLATE utf8mb4_bin NOT NULL,
  `Calle` tinytext COLLATE utf8mb4_bin NOT NULL,
  `Colonia` tinytext COLLATE utf8mb4_bin NOT NULL,
  `Ciudad` tinytext COLLATE utf8mb4_bin NOT NULL,
  `Estado` int(11) NOT NULL,
  `Postal` int(11) NOT NULL,
  `TelFijo` varchar(10) COLLATE utf8mb4_bin NOT NULL,
  `Celular` varchar(10) COLLATE utf8mb4_bin NOT NULL,
  `Correo` varchar(80) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `contactoalumno`
--

INSERT INTO `contactoalumno` (`Id`, `Calle`, `Colonia`, `Ciudad`, `Estado`, `Postal`, `TelFijo`, `Celular`, `Correo`) VALUES
('101019', 'AV. MICHOACAN #45', 'VISTA BELLA', 'MORELIA', 0, 0, '299 26 71', '443492518', ''),
('101036', 'BUCARELI #162', 'ERENDIRA', 'MORELIA', 0, 5824, '', '', ''),
('111006', 'JUAN JOSE DE LEJARZA  #258', 'CENTRO', 'MORELIA', 0, 58, '', '', ''),
('111069', 'JOSE SIXTO VERDUZCO #218', 'ISAAC ARRIAGA', 'MORELIA', 0, 5821, '697289', '', ''),
('111078', 'SOR JUANA INES DE LA CRUZ #18', 'CENTRO', 'MORELIA', 0, 58, '313 63 71', '', ''),
('121059', 'SANTA MARTHA  #29', 'FRACC. SANTA MARTHA FUENTES VA', 'MORELIA', 0, 58195, '', '', ''),
('121078', 'PINO CHINO #755', 'REAL TULIPANES', 'MORELIA', 0, 586, '', '', ''),
('121099', 'MANGO #382', 'FRACC. LA HUERTA', 'MORELIA', 0, 588, '', '', ''),
('131037', 'JUAN RUIZ DE ALARCON #3', 'CUAUHTEMOC', 'MORELIA', 0, 582, '3134493', '', ''),
('141043', 'HUNGRIA # 91 #', 'METROPOLIS 2', 'MORELIA', 0, 5888, '4-27-66-5', '', ''),
('144317', 'FRAY JACOBO DACIANO #59', 'COL ANAHUAC', 'ZACAPU', 0, 5863, '43613461', '443 589395', 'lft.yajaira@gmail.com'),
('150050', 'ATECUARO #1686', 'FRACC LOMA LARGA', 'MORELIA', 0, 5895, '347535', '', ''),
('150070', 'BELLAS ARTES  #33', 'REAL UNIVERSIDAD', 'REAL UNIVERSIDAD', 0, 586, '', '', ''),
('151009', 'CIRCUITO LA ESPINACA INT. 31 #EDIF. 49', 'CAMPESTRE DEL VERGEL', 'MORELIA', 0, 58195, '', '', ''),
('151103', 'FRAY ALONSO DE HERRERA  #439', 'FRACC. SOLEAR OTE.', 'MORELIA', 0, 5821, '', '', ''),
('151109', 'MANUEL BONILLA #95', 'DEFENSORES DE PUEBLA', 'MORELIA', 0, 58147, '', '', ''),
('154088', 'RIO SILAO  #9', 'CAMPRESTRE DEL RIO', 'YURIRIA ', 0, 3894, '4451172564', '4451172564', 'luisjavier.lja@gmail.com'),
('160036', 'RINCàN DE ERATZICUA 8 #', 'FRACC. FRESNOS', 'MORELIA, MICHOACµN', 0, 0, '299447', '', ''),
('162022', 'AV. PASEO DEL PARQUE # 627 INT. 627', 'FRACC. PASEO DEL PARQUE', 'MORELIA', 0, 0, '443694755', '', ''),
('162059', 'CALZONTZIN # 13 INT. 13 ', 'FELIX IRETA', 'MORELIA', 0, 587, '4434257517', '4432862376', ''),
('170032', 'BALSAS #8', 'LAGO 1', 'MORELIA', 0, 58115, '44327583', '', ''),
('170085', 'GUANAJUATO INT. A #74', 'COL. MOLINO DE PARRAS', 'MORELIA', 0, 581, '3121241', '', ''),
('171001', 'JUAN IBARRA #3', 'VILLAS DEL REAL', 'MORELIA', 0, 58116, '443145381', '', ''),
('171004', 'CUTZI #35', 'FELIX IRETA', 'MORELIA', 0, 587, '44324687 A', '', ''),
('171014', '2A. PRIVADA ANA MARIA GALLAGA INT. C #933', 'CUAUHTEMOC', 'MORELIA', 0, 582, '', '', ''),
('171092', 'AV. JARDINES #219', 'CAMPESTRE DEL VERGEL', 'MORELIA', 0, 58195, '', '', ''),
('171099', 'TZITZIQUI #39', 'FRACC. XANGARI', 'MORELIA', 0, 5889, '', '', ''),
('172004', 'CIRCUITO ACONCAGUA #218', 'FRAC. PASEO ALTOZANO', 'MORELIA', 0, 5835, '', '', ''),
('172010', 'JUAN CRISOSTOMO BONILLA #362', 'DEFENSORES DE PUEBLA', 'MORELIA', 0, 0, '', '', ''),
('174011', 'CALZ PEDRO G GARZA Y TREVI¥O #87 COL BARRIO NUEVO SAN PEDRO COAHUILA #', '', 'MORELIA', 0, 0, '', '', 'ispcpagos@hotmail.com'),
('174046', 'CULTURA #71 COL. MOLINO DE PARRAS MORELIA MICH #', '', 'MORELIA', 0, 0, '', '4432859351', 'Arturo_ndo@hotmail.com'),
('174050', 'CALLE TABACHINES  ##19', '2DO SECTOR DE FIDELAC', 'LAZARO CARDENAS', 0, 695, '', '443217', 'aldo.f123@hotmail.com'),
('174055', 'AV. JUNTA DE JAUJILLA #489', 'JAUJILLA', 'MORELIA', 0, 58179, '443369451', '443132585', 'mabis_5@hotmail.com'),
('174128', '', '', 'MORELIA', 0, 0, '', '4431713217', 'libigonzalezgalvaan@outlook.com'),
('180036', 'CTO CUERAMO #18', 'FRACC. SAN GUILLERMO', 'MORELIA', 0, 0, '', '', ''),
('181001', 'AMADO CAMACHO #487', 'CHAPULTEPEC OTE.', 'MORELIA', 0, 5826, '4433159424', '', ''),
('181009', 'ANSELMO ORTEGA #143', 'DEFENSORES DE PUEBLA', 'MORELIA', 0, 58147, '312 78 47', '', ''),
('181106', 'JUAN RUIZ DE ALARCON  #21', 'CENTRO ', 'MORELIA', 0, 58, '', '', ''),
('182009', 'ANA MARIA GALLAGA  #631', 'CENTRO ', 'MORELIA', 0, 58, '', '', ''),
('182020', '2 DE NOVIEMBRE  #99', 'SAN JUANITO ITZICUARO', 'MORELIA', 0, 58341, '', '', ''),
('183025', 'LAZARO CARDENAZ #148', 'HEBERTO CASTILLO', 'MORELIA', 0, 589, '', '4434639888', 'josuealcantar149@gmail.com'),
('183039', 'PRIVADA MEXICO INT. 247 #35', 'AMERICAS BRITANIA', 'MORELIA', 0, 5827, '3333659', '4434867815', ''),
('183046', 'MONTES URALES #127', 'VALLE DEL PARAISO', 'MORELIA', 0, 5835, '62412232', '4431294923', 'santiago.ferrer@cmn.edu.mx'),
('183080', 'ZIRAN ZIRAN CAMARO #45', 'VISTA BELLA', 'MORELIA', 0, 589, '324325', '44325965', 'ameg_yemi@hotmail.com'),
('184051', 'RICON DE JARIPO  #57', 'RINCON QUIETO', 'MORELIA', 0, 5869, '326343', '44 32 28 3', 'IVAN_RIVER.X@HOTMAIL.COM'),
('184124', 'AV. ACUEDUCTO #2417', 'LOMAS DE HIDALGO', 'MORELIA', 0, 5824, '443314412', '443526398', 'pequelupitazj86@gmail.com'),
('184167', 'PRIV. VICENTE SANTAMARÖA  #33', 'VENTURA PUENTE OTE.', 'MORELIA', 0, 582, '443189611', '753141424', 'surf14@outlook.com'),
('184170', 'CIRCUITO INSURGENTES #86', 'ANA MARIA GALLAGA ', 'MORELIA', 0, 58195, '', '4432164169', 'Fridam17@outlook.com'),
('190008', 'GERARDO MURILLO #96', 'FRACC. DIEGO RIVERA', 'MORELIA', 0, 58219, '44322397 A', '', ''),
('190036', 'SILVESTRE MARROQUIN #412', 'CONGRESO CONSTITUYENTES DEMICH', 'MORELIA', 0, 58219, '', '', ''),
('190064', 'RAZA ZAPOTECAS #48-A', 'LOMAS DE SANTIAGUITO', 'MORELIA', 0, 5812, '4433213278', '', ''),
('191005', 'JOSE MARIA LA FRAGUA INT. 2 #EDIF 21', 'INFONAVIT BENITO JUAREZ ', 'MORELIA', 0, 5867, '', '', ''),
('191050', 'PINO CHINO INT. A1 #27', 'FRACC REAL UNIVERSIDAD ', 'MORELIA', 0, 0, '', '', ''),
('191070', 'PEDRO ROSALES INT. 12 #16', 'BALCONES DE MORELIA ', 'MORELIA', 0, 5885, '', '', ''),
('191071', 'PEDRO ROSALES INT. 12 #16', 'BALCONES DE MORELIA ', 'MORELIA', 0, 5885, '', '', ''),
('191106', 'DE LOS VIENTOS #193', 'CAMPESTRE LA HUERTA ', 'MORELIA', 0, 0, '', '', ''),
('191115', 'AV QUINCEO  #21', 'LAGO 3', 'MORELIA', 0, 58115, '', '', ''),
('192011', 'CASIMIRO GOMEZ #69', 'FRACC. VILLAS DEL SUR II', 'MORELIA', 0, 5895, '', '', ''),
('192026', 'AV. JOSE MARIA MORELOS  #15', 'JESUS DEL MONTE ', 'MORELIA', 0, 0, '', '', ''),
('192042', 'ASTRONOMOS  #6', 'AMP. JARDINES DEL TOREO ', 'MORELIA', 0, 5849, '', '', ''),
('193021', '22 OCTUBRE 1814 #39', 'HACIENDA TRINIDAD', 'MORELIA', 0, 58195, '44338127', '4431178911', ''),
('193087', 'AV. SAN JOSE DEL CERRITO INT. 18 #4', 'FRACCIONAMIENTO EL PUEBLITO', 'MORELIA', 0, 5888, '443228715', '443228715', 'yaspao@icloud.com'),
('194039', 'MATEO GARCIA VILLAGRAN  #5', 'JARDIN MORELIA ', 'TARIMBARO ', 0, 5888, '34394', '', 'valerialcaraz16@gmail.com'),
('194072', 'CERRADA FRANCISCO VILLA  #S/N', 'TECARIO', 'TACAMBARO ', 0, 61652, '459341613', '4591567', 'judithmorana6@gmail.com'),
('194108', 'JAVIER MINA  #45', 'CENTRO ', 'MORELIA', 0, 58, '443 3 12 1', '4434 37578', 'albertocamval166@gmail.com'),
('194151', 'ANTONIO CASO ANDRADE  #269', 'FRACC. VILLAS DEL SUR ', 'ZAMORA', 0, 589, '35152 5447', '351158736', 'stacyalfaroavila@hotmail.com'),
('194156', 'VILLAHERMOSA  #3', 'AMPLIACION REVOLUCION ', 'URUAPAN ', 0, 6153, '', '452 126165', ''),
('194164', 'TENIENTE ALEMAN  #116', 'CHAPULTEPEC SUR ', 'MORELIA ', 0, 5826, '4431 66892', '4431 66892', 'dr.gerardoag@outlook.com'),
('194176', 'DR. CAYETANO ANDRADE #275', 'CENTRO', 'MOROLEÓN', 0, 388, '4451 12571', '4451 12571', 'mananalaraalc@outlook.com'),
('200041', 'ORDENANZAS 75 #45', 'VASCO DE QUIROGA', 'MORELIA', 0, 5823, '4431822576', '', ''),
('201016', 'CALLE CINO  #261', 'MATAMOROS ', 'MORELIA', 0, 5824, '', '', ''),
('201032', 'VICENTE MORALES  #', 'PE¥A BLANCA ', 'Morelia', 0, 5895, '', '', ''),
('201036', 'GANADERIA DE TEQUISQUIAPAN  #383', 'AMP. JARDINES DEL TOREO ', 'MORELIA', 0, 5849, '2992114', '', ''),
('201046', 'ROBLE BLANCO #42', 'FRACC.PASEO LOS ENCINOS', 'MORELIA', 0, 5887, '', '', ''),
('201067', 'AV. PASEO DEL PARQUE  #357', 'PASEO DEL PARQUE', 'MORELIA', 0, 0, '', '', ''),
('202021', '2DO. RETORNO DEL CASTOR #24', 'FRACC. COLINAS DE ALTOZANO', 'Morelia', 0, 5835, '', '', ''),
('203006', 'ANTONIO PLAZA INT. 13 #42', 'LOMAS DE SANTA MARIA', 'MORELIA', 0, 589, '4431969383', '', ''),
('203038', 'CIRCUITO CAMPESTRE  #33', 'FRACC CLUB CAMPESTRE ', 'MORELIA', 0, 58296, '443141161', '', ''),
('204001', 'TZINTZUNTZAN  #1954', 'MARIANO MATAMOROS ', 'MORELIA', 0, 5824, '', '4433253726', ''),
('204003', 'INDEPENDENCIA  #12', 'CENTRO', 'URUAPAN', 0, 6, '4525242965', '45217116', 'montseuruapan@gmail.com'),
('204024', 'CASCADA #124', 'AMPLIACIàN GERTRUDIS SANCHEZ ', 'MORELIA', 0, 58116, '4434278716', '4434386188', 'roxverani@live.com.mx'),
('204070', 'CAPITAN MIGUEL LEBRIJA #648', 'JARDINES DE GUADALUPE', 'MORELIA', 0, 5814, '4432 27 46', '44348539', 'alejandremorenodagne@gmai.com'),
('204088', 'LAS FLORES #1', 'BARRIO SANTO SANTIAGO', 'SAN JUAN NUEVO', 0, 649, '452 113 2 ', '4521988586', 'aguilarmontserrat419@gmail.com'),
('204104', '24 DE FEBRERO #14', 'PARCELA', 'PUEBLA', 0, 7339, '221 413 1 ', '22141314', 'conyarroyo94@gmail.com'),
('204161', 'CA¥ADA DE SAN MARTIN  #416', 'TRES MARÖAS', 'MORELIA', 0, 0, '4431718152', '443249374', 'lauraw_avm@hotmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datosidalumno`
--

CREATE TABLE `datosidalumno` (
  `Id` varchar(20) COLLATE utf8mb4_bin NOT NULL,
  `Nombre` text COLLATE utf8mb4_bin NOT NULL,
  `Apellidos` text COLLATE utf8mb4_bin NOT NULL,
  `Grado` int(11) NOT NULL,
  `Grupo` int(11) NOT NULL,
  `Seccion` int(11) NOT NULL,
  `IdGrupo` varchar(10) COLLATE utf8mb4_bin NOT NULL,
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
  `Id` varchar(20) COLLATE utf8mb4_bin NOT NULL,
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
('becas', 'Responsable de BECAS', '10', '', 'NO'),
('docente', 'Docente Universidad', '4', '1', 'LFR'),
('jjmoreno23', 'José de Jesús Moreno Contreras', '10', '', 'NO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `IdGrupo` varchar(10) COLLATE utf8mb4_bin NOT NULL,
  `Seccion` int(11) NOT NULL,
  `Grado` int(11) NOT NULL,
  `Ciclo` varchar(4) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`IdGrupo`, `Seccion`, `Grado`, `Ciclo`) VALUES
('LFR11', 4, 1, '20-1'),
('LFR12', 4, 1, '20-1'),
('LFR13', 4, 1, '20-1'),
('LFR31', 4, 3, '20-1'),
('PRI11', 1, 1, '20-0'),
('PRI21', 1, 2, '20-0'),
('PRI31', 1, 3, '20-0'),
('PRI41', 1, 4, '20-0'),
('SEC22', 2, 2, '20-0'),
('SEC23', 2, 2, '20-0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reinscripciones`
--

CREATE TABLE `reinscripciones` (
  `Id` varchar(20) COLLATE utf8mb4_bin NOT NULL,
  `Seccion` int(11) NOT NULL,
  `CicloAct` varchar(4) COLLATE utf8mb4_bin NOT NULL,
  `CicloSig` varchar(4) COLLATE utf8mb4_bin NOT NULL,
  `Grado` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `flag` int(11) NOT NULL DEFAULT 0,
  `Fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Observaciones` text COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `titulares`
--

CREATE TABLE `titulares` (
  `IdUsuario` varchar(20) COLLATE utf8mb4_bin NOT NULL,
  `Ciclo` varchar(20) COLLATE utf8mb4_bin NOT NULL,
  `IdGrupo` varchar(5) COLLATE utf8mb4_bin NOT NULL,
  `Consecutivo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `titulares`
--

INSERT INTO `titulares` (`IdUsuario`, `Ciclo`, `IdGrupo`, `Consecutivo`) VALUES
('docente', '20-21', 'LFR11', 1),
('docente', '20-21', 'LFR12', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `Id` varchar(20) COLLATE utf8mb4_bin NOT NULL,
  `Pass` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `Type` int(11) NOT NULL DEFAULT 0,
  `Privileges` int(11) NOT NULL DEFAULT 0
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
('becas', '85e0c3574dab7f1ce9bd720b96b69645', 1, 4),
('docente', 'ac99fecf6fcb8c25d18788d14a5384ee', 1, 2),
('jjmoreno23', 'e10adc3949ba59abbe56e057f20f883e', 1, 5);

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
  MODIFY `Consecutivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `circulares`
--
ALTER TABLE `circulares`
  MODIFY `IdCircular` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `titulares`
--
ALTER TABLE `titulares`
  MODIFY `Consecutivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
