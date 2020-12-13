-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-12-2020 a las 06:11:53
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `grupo_15`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `ID` int(11) NOT NULL,
  `RAZON_SOCIAL` varchar(25) NOT NULL,
  `ACTIVO` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`ID`, `RAZON_SOCIAL`, `ACTIVO`) VALUES
(1, 'BGH', 1),
(2, 'Sony', 1),
(3, 'Apple', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `destino`
--

CREATE TABLE `destino` (
  `ID` int(11) NOT NULL DEFAULT 0,
  `DIRECCION` varchar(50) DEFAULT NULL,
  `NUMERO` int(11) DEFAULT NULL,
  `ID_LOCALIDAD` int(11) DEFAULT NULL,
  `ID_PROV` int(11) DEFAULT NULL,
  `ID_PAIS` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `destino`
--

INSERT INTO `destino` (`ID`, `DIRECCION`, `NUMERO`, `ID_LOCALIDAD`, `ID_PROV`, `ID_PAIS`) VALUES
(1, 'Sarrachaga', 103, 1, 1, 1),
(2, 'Larreta', 1600, 2, 5, 1),
(3, 'Bartolome Mitre', 500, 3, 4, 2),
(4, 'Pte. Peron ', 4560, 4, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `ID` int(3) NOT NULL,
  `NOMBRE` varchar(25) NOT NULL,
  `APELLIDO` varchar(25) NOT NULL,
  `DNI` int(12) NOT NULL,
  `SEXO` char(1) NOT NULL,
  `FECHA_NACIMIENTO` date NOT NULL,
  `FECHA_INGRESO` date NOT NULL,
  `SUELDO` decimal(10,2) NOT NULL,
  `USUARIO` varchar(25) NOT NULL,
  `PASSWORD` varchar(25) NOT NULL,
  `ID_ROL` int(3) NOT NULL,
  `ACTIVO` char(1) NOT NULL DEFAULT '1',
  `AVATAR` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`ID`, `NOMBRE`, `APELLIDO`, `DNI`, `SEXO`, `FECHA_NACIMIENTO`, `FECHA_INGRESO`, `SUELDO`, `USUARIO`, `PASSWORD`, `ID_ROL`, `ACTIVO`, `AVATAR`) VALUES
(1, 'Fabricio', 'Yucra', 94220641, 'M', '1992-01-22', '0000-00-00', '55004.00', 'yucra', '1234', 1, '1', 'foto1'),
(2, 'Nicolas', 'Duarte', 36163776, 'M', '1991-11-29', '2015-11-07', '5111.00', 'duarte', '1234', 2, '1', 'foto2'),
(3, 'Adam', 'Utrera', 35537714, 'M', '1991-03-13', '2015-11-29', '52001.00', 'utrera', '1234', 3, '1', 'foto3'),
(4, 'Alejandro', 'Cruz', 35097711, 'M', '1988-07-17', '2015-11-29', '53400.00', 'cruz', '0000', 4, '1', 'foto4'),
(5, 'Jorge', 'Nitales', 44220641, 'M', '1976-11-03', '2015-11-29', '13000.00', 'chofer', '1234', 1, '1', 'foto5'),
(6, 'Armando', 'Bronca Segura', 35537714, 'M', '1977-11-29', '2015-11-29', '9000.00', 'encargado', '1234', 2, '1', 'foto6');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localidad`
--

CREATE TABLE `localidad` (
  `ID` int(11) NOT NULL,
  `LOCALIDAD` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `localidad`
--

INSERT INTO `localidad` (`ID`, `LOCALIDAD`) VALUES
(1, '25 de Mayo'),
(2, 'Rawson'),
(3, 'Antofagasta'),
(4, 'Rodeo de la Cruz');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE `pais` (
  `ID` int(11) NOT NULL,
  `DESCRIPCION` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`ID`, `DESCRIPCION`) VALUES
(1, 'Argentina'),
(2, 'Chile');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parada`
--

CREATE TABLE `parada` (
  `ID` int(11) NOT NULL,
  `ID_DESTINO` int(11) DEFAULT NULL,
  `LATITUD` varchar(50) DEFAULT NULL,
  `LONGITUD` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `parada`
--

INSERT INTO `parada` (`ID`, `ID_DESTINO`, `LATITUD`, `LONGITUD`) VALUES
(1, 1, '-34.692239', ' -58.585623'),
(2, 1, '-36.633720', '-64.254454'),
(3, 2, '-43.162433', '-66.095400'),
(4, 2, '-36.633720', '-64.254454'),
(5, 3, '-34.692239', ' -58.585623'),
(6, 3, '-33.155451', '-71.459791'),
(7, 4, '-32.885774', '-68.887323'),
(8, 4, '-34.601190', '-58.455416');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proforma`
--

CREATE TABLE `proforma` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `Cliente_id` int(11) NOT NULL,
  `tipo_carga` varchar(50) NOT NULL,
  `peso_neto` int(11) NOT NULL,
  `hazard` varchar(50) NOT NULL,
  `reefer` varchar(50) NOT NULL,
  `kilometros` int(11) NOT NULL,
  `combustible` int(11) NOT NULL,
  `ETD` date NOT NULL,
  `ETA` date NOT NULL,
  `viaticos` int(11) NOT NULL,
  `peajes y pasejes` int(11) NOT NULL,
  `extras` int(11) NOT NULL,
  `costo hazard` int(11) NOT NULL,
  `costo reefer` int(11) NOT NULL,
  `Chofer_asignado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincia`
--

CREATE TABLE `provincia` (
  `ID` int(11) NOT NULL,
  `DESCRIPCION` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `provincia`
--

INSERT INTO `provincia` (`ID`, `DESCRIPCION`) VALUES
(1, 'Buenos Aires'),
(2, 'Cordoba'),
(3, 'Mendoza'),
(4, 'Sgo. de Chile'),
(5, 'Chubut');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `ID` int(3) NOT NULL,
  `DESCRIPCION` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`ID`, `DESCRIPCION`) VALUES
(1, 'chofer'),
(2, 'encargado_de_taller'),
(3, 'supervisor'),
(4, 'administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguimiento`
--

CREATE TABLE `seguimiento` (
  `ID` int(3) NOT NULL,
  `ID_VIAJE` int(3) NOT NULL,
  `FECHA` date NOT NULL,
  `LT_COMBUSTIBLE` int(3) NOT NULL,
  `LUGAR_CARGA` varchar(100) NOT NULL,
  `COORX` varchar(50) DEFAULT NULL,
  `COORY` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `seguimiento`
--

INSERT INTO `seguimiento` (`ID`, `ID_VIAJE`, `FECHA`, `LT_COMBUSTIBLE`, `LUGAR_CARGA`, `COORX`, `COORY`) VALUES
(1, 1, '2017-11-08', 254, 'algo', '-34.692239', '-58.585623'),
(2, 2, '2017-11-09', 200, 'otro', '-36.633720', '-64.254454'),
(3, 3, '2017-11-25', 205, 'casa', '-43.162433', '-66.095400'),
(4, 4, '2017-11-12', 190, 'otro', '-36.633720', '-64.254454'),
(5, 5, '2017-11-25', 204, 'bodega', '-34.692239', ' -58.585623'),
(6, 6, '2017-11-12', 235, 'casa', '-33.155451', '-71.459791'),
(7, 7, '2017-11-25', 260, 'otro', '-32.885774', '-68.887323'),
(8, 8, '2017-11-12', 253, 'otro', '-34.601190', '-58.455416');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `service`
--

CREATE TABLE `service` (
  `ID` int(3) NOT NULL,
  `PATENTE_VEHICULO` varchar(25) NOT NULL,
  `FECHA` date NOT NULL,
  `KM_VEHICULO` decimal(10,2) NOT NULL,
  `COSTO` decimal(10,2) NOT NULL,
  `COMENTARIO` varchar(200) NOT NULL,
  `ACTIVO` int(1) NOT NULL DEFAULT 1,
  `EMPLEADO_ENCARGADO` int(3) NOT NULL,
  `REALIZADO` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `service`
--

INSERT INTO `service` (`ID`, `PATENTE_VEHICULO`, `FECHA`, `KM_VEHICULO`, `COSTO`, `COMENTARIO`, `ACTIVO`, `EMPLEADO_ENCARGADO`, `REALIZADO`) VALUES
(2, 'AXE-752', '2015-10-01', '140000.00', '80000.00', 'Se deben cambiar las 8 cubiertas del camion.', 1, 2, 1),
(3, 'NYP-872', '2015-11-02', '75000.00', '10000.00', 'Se debe realizar el cambio de aceite y filtros.', 1, 2, 1),
(4, 'PYH-985', '2015-12-01', '85000.00', '15000.00', 'Se deben cambiar los amortiguadores delanteros y traseros del vehiculo .', 1, 6, 0),
(5, 'CIH-796', '2015-12-14', '50000.00', '20000.00', 'Se deben cambiar las luces traseras del vehiculo.', 1, 6, 0),
(6, 'AXJ-777', '2015-12-30', '100000.00', '40000.00', 'Se deben cambiar las pastillas de freno del vehiculo.', 1, 2, 0),
(7, 'AXE-752', '2015-12-02', '0.00', '500.00', 'Arreglar Cubierta', 1, 6, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculo`
--

CREATE TABLE `vehiculo` (
  `PATENTE` varchar(25) NOT NULL,
  `MODELO` varchar(25) NOT NULL,
  `ANO` int(5) NOT NULL,
  `MARCA` varchar(25) NOT NULL,
  `NRO_CHASIS` bigint(50) NOT NULL,
  `NRO_MOTOR` bigint(50) NOT NULL,
  `ACTIVO` int(1) NOT NULL DEFAULT 1,
  `AVATAR` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vehiculo`
--

INSERT INTO `vehiculo` (`PATENTE`, `MODELO`, `ANO`, `MARCA`, `NRO_CHASIS`, `NRO_MOTOR`, `ACTIVO`, `AVATAR`) VALUES
('AXE-752', 'FMX', 1999, 'Iveco', 688963, 146398, 1, 'foto1'),
('AXJ-777', 'TECTOR ATTACK', 2001, 'Iveco', 654987, 453987, 1, 'foto2'),
('CIH-796', 'TECTOR', 2012, 'Iveco', 255789, 236694, 1, 'foto4'),
('COH-876', 'CURSOR', 1999, 'Iveco', 369852, 741123, 1, 'foto3'),
('NYP-872', 'VM', 2015, 'Iveco', 698741, 369852, 1, 'foto5'),
('PYH-985', 'VERTIS', 2003, 'Iveco', 698745, 357159, 1, 'foto6'),
('RSC-987', 'FH', 2005, 'Iveco', 654185, 789546, 1, 'foto7');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viaje`
--

CREATE TABLE `viaje` (
  `ID` int(11) NOT NULL,
  `PATENTE_VEHICULO` varchar(25) NOT NULL,
  `ID_DESTINO` int(11) NOT NULL,
  `ID_CLIENTE` int(11) NOT NULL,
  `FECHA_PROGRAMADA` date NOT NULL,
  `FECHA_INICIO` date NOT NULL,
  `FECHA_FIN` date NOT NULL,
  `CANT_KILOMETROS` int(11) NOT NULL,
  `ID_EMPLEADO` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `viaje`
--

INSERT INTO `viaje` (`ID`, `PATENTE_VEHICULO`, `ID_DESTINO`, `ID_CLIENTE`, `FECHA_PROGRAMADA`, `FECHA_INICIO`, `FECHA_FIN`, `CANT_KILOMETROS`, `ID_EMPLEADO`) VALUES
(2, 'RSC-987', 1, 3, '2015-11-25', '2015-11-29', '2015-12-06', 500, 1),
(3, 'AXE-752', 1, 1, '2014-01-01', '2015-11-29', '2014-01-01', 500, 1),
(5, 'PYH-985', 3, 2, '2015-11-30', '2015-11-14', '2015-12-01', 1200, 5),
(6, 'PYH-985', 2, 2, '2015-11-30', '2015-12-03', '2015-12-06', 4600, 1),
(9, 'COH-876', 1, 1, '2015-12-25', '2015-12-30', '2015-12-31', 1200, 1),
(10, 'PYH-985', 2, 2, '2015-11-30', '2015-11-30', '2015-11-30', 200, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `destino`
--
ALTER TABLE `destino`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_PROV` (`ID_PROV`),
  ADD KEY `ID_PAIS` (`ID_PAIS`),
  ADD KEY `ID_LOCALIDAD` (`ID_LOCALIDAD`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `parada`
--
ALTER TABLE `parada`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_DESTINO` (`ID_DESTINO`);

--
-- Indices de la tabla `proforma`
--
ALTER TABLE `proforma`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `provincia`
--
ALTER TABLE `provincia`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `seguimiento`
--
ALTER TABLE `seguimiento`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD PRIMARY KEY (`PATENTE`);

--
-- Indices de la tabla `viaje`
--
ALTER TABLE `viaje`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_DESTINO` (`ID_DESTINO`),
  ADD KEY `ID_EMPLEADO` (`ID_EMPLEADO`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `proforma`
--
ALTER TABLE `proforma`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `viaje`
--
ALTER TABLE `viaje`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
