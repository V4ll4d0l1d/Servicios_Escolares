-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 03-02-2021 a las 11:09:37
-- Versión del servidor: 8.0.22-0ubuntu0.20.04.3
-- Versión de PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `Servicios`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Avisos`
--

CREATE TABLE `Avisos` (
  `Consecutivo` int NOT NULL,
  `Seccion` int NOT NULL,
  `Carrera` varchar(3) COLLATE utf8mb4_bin NOT NULL,
  `Grado` int NOT NULL,
  `Titulo` varchar(30) COLLATE utf8mb4_bin NOT NULL,
  `Contenido` longtext COLLATE utf8mb4_bin NOT NULL,
  `Url` text COLLATE utf8mb4_bin NOT NULL,
  `Imagen` text COLLATE utf8mb4_bin NOT NULL,
  `Fecha_Inicio` date NOT NULL,
  `Fecha_Fin` date NOT NULL,
  `Activo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `Usuario` text COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `Avisos`
--

INSERT INTO `Avisos` (`Consecutivo`, `Seccion`, `Carrera`, `Grado`, `Titulo`, `Contenido`, `Url`, `Imagen`, `Fecha_Inicio`, `Fecha_Fin`, `Activo`, `Usuario`) VALUES
(1, 4, 'LFR', 0, 'Aviso 1', 'Este es un aviso de Prueba, la sección es Universidad y es General', 'http://umvalla.edu.mx', 'pic01.jpg', '2020-07-17', '2021-04-01', 'Si', 'jjmoreno23'),
(2, 4, '0', 0, 'Aviso 2', 'Este es un segundo aviso de prueba. Recuerda que puedes tener varios dependiendo de la sección.', 'http://umvalla.edu.mx', 'pic02.jpg', '2020-07-17', '2021-04-01', 'Si', 'jjmoreno23'),
(3, 3, '0', 0, 'Aviso 3', 'PREPARATORIA. Este es un tercer aviso de prueba. Recuerda que puedes tener varios dependiendo de la sección.', 'http://umvalla.edu.mx', 'pic03.jpg', '2020-07-17', '2021-04-01', 'Si', 'jjmoreno23'),
(4, 4, '0', 1, 'Aviso 4', 'Este es un cuarto aviso de prueba. Recuerda que puedes tener varios dependiendo de la sección.', 'http://umvalla.edu.mx', 'pic04.jpg', '2020-07-17', '2021-04-01', 'Si', 'jjmoreno23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Becas`
--

CREATE TABLE `Becas` (
  `Id` varchar(20) COLLATE utf8mb4_bin NOT NULL,
  `Seccion` varchar(3) COLLATE utf8mb4_bin NOT NULL,
  `CicloAct` varchar(4) COLLATE utf8mb4_bin NOT NULL,
  `CicloSig` varchar(4) COLLATE utf8mb4_bin NOT NULL,
  `Grado` int NOT NULL,
  `Tipo` varchar(3) COLLATE utf8mb4_bin NOT NULL,
  `Status` int DEFAULT '0',
  `Fecha` timestamp NOT NULL,
  `Observaciones` text COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `Becas`
--

INSERT INTO `Becas` (`Id`, `Seccion`, `CicloAct`, `CicloSig`, `Grado`, `Tipo`, `Status`, `Fecha`, `Observaciones`) VALUES
('160023', 'LFR', '20-1', '20-2', 2, 'hno', 0, '2021-02-03 02:29:48', 'Esta es una prueba de las observaciones que pudieran tener.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ContactoAlumno`
--

CREATE TABLE `ContactoAlumno` (
  `Id` varchar(20) COLLATE utf8mb4_bin NOT NULL,
  `Calle` tinytext COLLATE utf8mb4_bin NOT NULL,
  `Colonia` tinytext COLLATE utf8mb4_bin NOT NULL,
  `Ciudad` tinytext COLLATE utf8mb4_bin NOT NULL,
  `Estado` int NOT NULL,
  `Postal` int NOT NULL,
  `TelFijo` varchar(10) COLLATE utf8mb4_bin NOT NULL,
  `Celular` varchar(10) COLLATE utf8mb4_bin NOT NULL,
  `Correo` varchar(80) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `ContactoAlumno`
--

INSERT INTO `ContactoAlumno` (`Id`, `Calle`, `Colonia`, `Ciudad`, `Estado`, `Postal`, `TelFijo`, `Celular`, `Correo`) VALUES
('160023', 'Pipila 212', 'Centro', 'Morelia', 16, 58000, '4434403414', '4434403414', 'otrocorreo@correo.com.mx');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `DatosIDAlumno`
--

CREATE TABLE `DatosIDAlumno` (
  `Id` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `Nombre` text COLLATE utf8mb4_bin NOT NULL,
  `Apellidos` text COLLATE utf8mb4_bin NOT NULL,
  `Grado` int NOT NULL,
  `Grupo` int NOT NULL,
  `Seccion` int NOT NULL,
  `IdGrupo` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `Correo` text COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `DatosIDAlumno`
--

INSERT INTO `DatosIDAlumno` (`Id`, `Nombre`, `Apellidos`, `Grado`, `Grupo`, `Seccion`, `IdGrupo`, `Correo`) VALUES
('160023', 'Pedro Jaime', 'López González', 1, 1, 4, 'LFR11', 'otrocorreo@correo.com.mx'),
('160024', 'Miguel Angel', 'Hurtado Flores', 1, 1, 4, 'LFR11', 'correo@otromail.com'),
('160025', 'JUAN LUIS', 'GONZALEZ GONZALEZ', 1, 1, 4, 'LFR12', 'uncorreo@mail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `DatosIDUsuario`
--

CREATE TABLE `DatosIDUsuario` (
  `Id` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `Nombres` text COLLATE utf8mb4_bin NOT NULL,
  `Seccion` set('0','1','2','3','4','5','10') COLLATE utf8mb4_bin NOT NULL,
  `Grado` set('1','2','3','4','5','6','7','8') COLLATE utf8mb4_bin NOT NULL,
  `Carrera` set('NO','ARQ','EFR','LAV','LDE','LFC','LFR','LNI') COLLATE utf8mb4_bin NOT NULL DEFAULT 'NO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin COMMENT='Datos Usuarios';

--
-- Volcado de datos para la tabla `DatosIDUsuario`
--

INSERT INTO `DatosIDUsuario` (`Id`, `Nombres`, `Seccion`, `Grado`, `Carrera`) VALUES
('docente', 'Docente Universidad', '4', '1', 'LFR'),
('jjmoreno23', 'José de Jesús Moreno Contreras', '10', '', 'NO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Reinscripciones`
--

CREATE TABLE `Reinscripciones` (
  `Id` varchar(20) COLLATE utf8mb4_bin NOT NULL,
  `Seccion` int NOT NULL,
  `CicloAct` varchar(4) COLLATE utf8mb4_bin NOT NULL,
  `CicloSig` varchar(4) COLLATE utf8mb4_bin NOT NULL,
  `Grado` int NOT NULL,
  `Status` int NOT NULL,
  `flag` int NOT NULL DEFAULT '0',
  `Fecha` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `Reinscripciones`
--

INSERT INTO `Reinscripciones` (`Id`, `Seccion`, `CicloAct`, `CicloSig`, `Grado`, `Status`, `flag`, `Fecha`) VALUES
('160023', 4, '20-1', '20-2', 2, 0, 0, '2021-01-30 01:57:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Titulares`
--

CREATE TABLE `Titulares` (
  `IdUsuario` varchar(20) COLLATE utf8mb4_bin NOT NULL,
  `Ciclo` varchar(20) COLLATE utf8mb4_bin NOT NULL,
  `IdGrupo` varchar(5) COLLATE utf8mb4_bin NOT NULL,
  `Consecutivo` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `Titulares`
--

INSERT INTO `Titulares` (`IdUsuario`, `Ciclo`, `IdGrupo`, `Consecutivo`) VALUES
('docente', '20-21', 'LFR11', 1),
('docente', '20-21', 'LFR12', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuarios`
-- Se cambia a 32 el varchar de pass porque el cifrado md5 tiene 32 caracteres
--

CREATE TABLE `Usuarios` (
  `Id` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `Pass` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `Type` int NOT NULL DEFAULT '0',
  `Privileges` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin COMMENT='Tabla de Usuarios (sin datos)';

--
-- Volcado de datos para la tabla `Usuarios`
-- Se agrega md5() a las contraseñas para cifrarlas
--

INSERT INTO `Usuarios` (`Id`, `Pass`, `Type`, `Privileges`) VALUES
('160023', md5('123456'), 0, 0),
('160024', md5('123456'), 0, 0),
('docente', md5('docente'), 1, 2),
('jjmoreno23', md5('123456'), 1, 5);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Avisos`
--
ALTER TABLE `Avisos`
  ADD UNIQUE KEY `AvisosIDX` (`Consecutivo`);

--
-- Indices de la tabla `Becas`
--
ALTER TABLE `Becas`
  ADD UNIQUE KEY `IdxBeca` (`Id`,`CicloAct`,`Seccion`);

--
-- Indices de la tabla `ContactoAlumno`
--
ALTER TABLE `ContactoAlumno`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `DatosIDAlumno`
--
ALTER TABLE `DatosIDAlumno`
  ADD UNIQUE KEY `Id` (`Id`);

--
-- Indices de la tabla `DatosIDUsuario`
--
ALTER TABLE `DatosIDUsuario`
  ADD UNIQUE KEY `Id` (`Id`);

--
-- Indices de la tabla `Reinscripciones`
--
ALTER TABLE `Reinscripciones`
  ADD UNIQUE KEY `IdxReinsc` (`Id`,`CicloAct`);

--
-- Indices de la tabla `Titulares`
--
ALTER TABLE `Titulares`
  ADD PRIMARY KEY (`Consecutivo`);

--
-- Indices de la tabla `Usuarios`
--
ALTER TABLE `Usuarios`
  ADD UNIQUE KEY `Id` (`Id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Avisos`
--
ALTER TABLE `Avisos`
  MODIFY `Consecutivo` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `Titulares`
--
ALTER TABLE `Titulares`
  MODIFY `Consecutivo` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
