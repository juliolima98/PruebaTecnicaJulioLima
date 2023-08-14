-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-08-2023 a las 04:30:29
-- Versión del servidor: 10.4.8-MariaDB
-- Versión de PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbpruebatecnica`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE `cargo` (
  `ID_CARGO` int(11) NOT NULL,
  `NOMBRE_CARGO` varchar(100) DEFAULT NULL,
  `DESCRIPCION_CARGO` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`ID_CARGO`, `NOMBRE_CARGO`, `DESCRIPCION_CARGO`) VALUES
(1, 'PROGRAMADOR', 'PROGRAMADOR PHP'),
(2, 'DESARROLLADOR FRONT-END', 'DESARROLLO DE VISTAS'),
(3, 'test', 'cargo test'),
(4, 'test editando probando', 'es una prueba');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `ID_EMPLEADO` int(11) NOT NULL,
  `ID_SUCURSAL` int(11) DEFAULT NULL,
  `NOMBRE_EMPLEADO` varchar(100) DEFAULT NULL,
  `APELLIDO_EMPLEADO` varchar(100) DEFAULT NULL,
  `DIRECCION_EMPLEADO` varchar(500) DEFAULT NULL,
  `TELEFONO_EMPLEADO` varchar(100) DEFAULT NULL,
  `ID_CARGO` int(11) DEFAULT NULL,
  `ID_ESTADO` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`ID_EMPLEADO`, `ID_SUCURSAL`, `NOMBRE_EMPLEADO`, `APELLIDO_EMPLEADO`, `DIRECCION_EMPLEADO`, `TELEFONO_EMPLEADO`, `ID_CARGO`, `ID_ESTADO`) VALUES
(16, 1, 'lakxkxxlk', 'lklskxmdkj', 'ksksfjsgj', '1920-2192', 1, 1),
(17, 2, 'asdaaaaa', 'testerdsfsf', 'easddf', '1920-2192', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_empleado`
--

CREATE TABLE `estado_empleado` (
  `ID_ESTADO` int(11) NOT NULL,
  `DESCRIPCION_ESTADO` enum('ACTIVO','INACTIVO') DEFAULT 'ACTIVO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estado_empleado`
--

INSERT INTO `estado_empleado` (`ID_ESTADO`, `DESCRIPCION_ESTADO`) VALUES
(1, 'ACTIVO'),
(2, 'INACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursal`
--

CREATE TABLE `sucursal` (
  `ID_SUCURSAL` int(11) NOT NULL,
  `ID_CARGO` int(11) DEFAULT NULL,
  `NOMBRE_SUCURSAL` varchar(100) DEFAULT NULL,
  `DIRECCION_SUCURSAL` varchar(300) DEFAULT NULL,
  `TELEFONO_SUCURSAL` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `sucursal`
--

INSERT INTO `sucursal` (`ID_SUCURSAL`, `ID_CARGO`, `NOMBRE_SUCURSAL`, `DIRECCION_SUCURSAL`, `TELEFONO_SUCURSAL`) VALUES
(1, 1, 'INFORMATICA', 'SAN SALVADOR', '5216-2032'),
(2, 2, 'RECURSOS HUMANOS', 'SANTA TECLA', '7219-2039'),
(5, 4, 'sucursal nueva 3', 'santo tomas', '7182-2031');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`ID_CARGO`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`ID_EMPLEADO`),
  ADD KEY `FK_ID_ESTADO` (`ID_ESTADO`),
  ADD KEY `FK_ID_SUCURSAL` (`ID_SUCURSAL`),
  ADD KEY `FK_ID_CARGO_EMP` (`ID_CARGO`);

--
-- Indices de la tabla `estado_empleado`
--
ALTER TABLE `estado_empleado`
  ADD PRIMARY KEY (`ID_ESTADO`);

--
-- Indices de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  ADD PRIMARY KEY (`ID_SUCURSAL`),
  ADD KEY `FK_ID_CARGO` (`ID_CARGO`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
  MODIFY `ID_CARGO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `ID_EMPLEADO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `estado_empleado`
--
ALTER TABLE `estado_empleado`
  MODIFY `ID_ESTADO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  MODIFY `ID_SUCURSAL` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `FK_ID_CARGO_EMP` FOREIGN KEY (`ID_CARGO`) REFERENCES `cargo` (`ID_CARGO`),
  ADD CONSTRAINT `FK_ID_ESTADO` FOREIGN KEY (`ID_ESTADO`) REFERENCES `estado_empleado` (`ID_ESTADO`),
  ADD CONSTRAINT `FK_ID_SUCURSAL` FOREIGN KEY (`ID_SUCURSAL`) REFERENCES `sucursal` (`ID_SUCURSAL`);

--
-- Filtros para la tabla `sucursal`
--
ALTER TABLE `sucursal`
  ADD CONSTRAINT `FK_ID_CARGO` FOREIGN KEY (`ID_CARGO`) REFERENCES `cargo` (`ID_CARGO`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
