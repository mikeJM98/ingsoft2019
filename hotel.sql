-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-05-2019 a las 19:04:36
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hotel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `c_id` int(11) NOT NULL,
  `c_descripcion` varchar(100) DEFAULT NULL,
  `c_estado` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`c_id`, `c_descripcion`, `c_estado`) VALUES
(1, 'ARTEFACTOS', 1),
(2, 'GASEOSA', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

CREATE TABLE `ciudad` (
  `c_id` int(11) NOT NULL,
  `c_pais` int(11) DEFAULT NULL,
  `c_descripcion` varchar(100) DEFAULT NULL,
  `c_estado` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ciudad`
--

INSERT INTO `ciudad` (`c_id`, `c_pais`, `c_descripcion`, `c_estado`) VALUES
(0, 1, 'TARAPOTO - SAN MARTIN', 1),
(8, 8, 'Tarapoto', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `c_id` int(11) NOT NULL,
  `c_tipocliente` int(11) DEFAULT NULL,
  `c_dni` varchar(8) DEFAULT NULL,
  `c_nombres` varchar(100) DEFAULT NULL,
  `c_direccion` varchar(200) DEFAULT NULL,
  `c_fechareg` date DEFAULT NULL,
  `c_celular` varchar(15) DEFAULT NULL,
  `c_estado` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`c_id`, `c_tipocliente`, `c_dni`, `c_nombres`, `c_direccion`, `c_fechareg`, `c_celular`, `c_estado`) VALUES
(1, 1, '98538458', 'juan morales dfgf', 'Tarapoto', '2017-02-06', '958485857', 0),
(3, 1, '48515513', 'Juan Miguel Alvarado Julca', 'jr. cesar david 123', '2019-04-24', '927202725', 0),
(4, 1, '70989910', 'Christian Manue Juárez Rivero', 'jr. cesar david 126', '2019-04-27', '956908983', 0),
(5, 1, '70989910', 'Christian Manue Juárez Rivero', 'jr. cesar david 126', '2019-04-27', '956908983', 0),
(6, 1, '70188345', 'Ricardo salazar Ríos', 'jr. aviación 345', '2019-04-28', '945678754', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consumo`
--

CREATE TABLE `consumo` (
  `c_id` int(11) NOT NULL,
  `c_cliente` int(11) DEFAULT NULL,
  `c_empleado` int(11) DEFAULT NULL,
  `c_fecha` date DEFAULT NULL,
  `c_total` double DEFAULT NULL,
  `c_igv` double DEFAULT NULL,
  `c_estado` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_consumo`
--

CREATE TABLE `detalle_consumo` (
  `dc_consumo` int(11) NOT NULL,
  `dc_producto` int(11) NOT NULL,
  `dc_cantidad` int(11) DEFAULT NULL,
  `dc_precio_unitario` double DEFAULT NULL,
  `dc_igv` double DEFAULT NULL,
  `dc_monto` double DEFAULT NULL,
  `dc_estado` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_reserva`
--

CREATE TABLE `detalle_reserva` (
  `dr_reserva` int(11) NOT NULL,
  `dr_habitacion` int(11) NOT NULL,
  `dr_monto` double DEFAULT NULL,
  `dr_estado` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle_reserva`
--

INSERT INTO `detalle_reserva` (`dr_reserva`, `dr_habitacion`, `dr_monto`, `dr_estado`) VALUES
(3, 1, 0, 1),
(4, 1, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_servicio`
--

CREATE TABLE `detalle_servicio` (
  `ds_entrada` int(11) NOT NULL,
  `ds_producto` int(11) NOT NULL,
  `ds_cantidad` int(11) DEFAULT NULL,
  `ds_precio_unitario` double DEFAULT NULL,
  `ds_igv` double DEFAULT NULL,
  `ds_monto` double DEFAULT NULL,
  `ds_estado` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `e_id` int(11) NOT NULL,
  `e_dni` varchar(8) DEFAULT NULL,
  `e_nombres` varchar(100) DEFAULT NULL,
  `e_apellidos` varchar(100) DEFAULT NULL,
  `e_direccion` varchar(200) DEFAULT NULL,
  `e_usuario` varchar(50) DEFAULT NULL,
  `e_clave` varchar(100) DEFAULT NULL,
  `e_celular` varchar(15) DEFAULT NULL,
  `e_sexo` varchar(15) DEFAULT NULL,
  `e_fechareg` date DEFAULT NULL,
  `e_tipoempleado` int(11) NOT NULL,
  `e_estado` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`e_id`, `e_dni`, `e_nombres`, `e_apellidos`, `e_direccion`, `e_usuario`, `e_clave`, `e_celular`, `e_sexo`, `e_fechareg`, `e_tipoempleado`, `e_estado`) VALUES
(1, '93589585', 'JUAN', 'ALVARADO', 'TARAPOTO', 'juan', '123', '3894984848', 'MASCULINO', '2017-02-07', 1, 0),
(2, '70989910', 'Christian Manue', 'Juárez Rivero', 'jr. cesar david 126', 'CMJR', '123', '956908983', 'MASCULINO', '2019-04-28', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enseres`
--

CREATE TABLE `enseres` (
  `e_id` int(11) NOT NULL,
  `e_categoria` int(11) NOT NULL,
  `e_habitacion` int(11) NOT NULL,
  `e_descripcion` varchar(100) DEFAULT NULL,
  `e_estado` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `enseres`
--

INSERT INTO `enseres` (`e_id`, `e_categoria`, `e_habitacion`, `e_descripcion`, `e_estado`) VALUES
(8, 1, 4, 'TELEVISOR LCD', 1),
(9, 1, 3, 'TELEVISOR LCD', 1),
(10, 1, 2, 'TELEVISOR LCD', 1),
(11, 1, 1, 'TELEVISOR LCD', 1),
(12, 1, 1, 'VENTILADOR', 1),
(15, 1, 6, 'TELEVISOR LCD', 1),
(16, 1, 5, 'TELEVISOR LCD', 1),
(17, 1, 7, 'TELEVISOR LCD', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrada`
--

CREATE TABLE `entrada` (
  `e_id` int(11) NOT NULL,
  `e_huesped` int(11) DEFAULT NULL,
  `e_empleado` int(11) DEFAULT NULL,
  `e_habitacion` int(11) DEFAULT NULL,
  `e_ciudad` int(11) DEFAULT NULL,
  `e_fechaini` date DEFAULT NULL,
  `e_fechafin` date NOT NULL,
  `e_dias` int(11) NOT NULL,
  `e_total` double DEFAULT NULL,
  `e_estado` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `entrada`
--

INSERT INTO `entrada` (`e_id`, `e_huesped`, `e_empleado`, `e_habitacion`, `e_ciudad`, `e_fechaini`, `e_fechafin`, `e_dias`, `e_total`, `e_estado`) VALUES
(1, 3, 1, 3, 0, '2017-02-19', '2017-02-20', 1, 50, 0),
(7, 7, 1, 7, 0, '2019-04-27', '2019-04-28', 1, 100, 0),
(8, 7, 1, 1, 0, '2019-04-28', '2019-04-30', 2, 160, 0),
(9, 7, 1, 3, 0, '2019-04-28', '2019-05-01', 3, 150, 0),
(10, 8, 1, 1, 0, '2019-04-28', '2019-04-29', 1, 80, 0),
(11, 7, 1, 1, 0, '2019-04-28', '2019-04-29', 1, 80, 0),
(12, 7, 2, 1, 0, '2019-04-28', '2019-04-29', 1, 80, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitacion`
--

CREATE TABLE `habitacion` (
  `h_id` int(11) NOT NULL,
  `h_tipohabitacion` int(11) DEFAULT NULL,
  `h_nro` varchar(10) DEFAULT NULL,
  `h_descripcion` varchar(100) DEFAULT NULL,
  `h_precio` double NOT NULL,
  `h_estado` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `habitacion`
--

INSERT INTO `habitacion` (`h_id`, `h_tipohabitacion`, `h_nro`, `h_descripcion`, `h_precio`, `h_estado`) VALUES
(1, 1, '100', 'Habitacion nueva', 80, 1),
(2, 1, '101', 'Habitacion nueva', 70, 1),
(3, 1, '102', 'Habitacion nueva', 50, 1),
(4, 1, '103', 'Habitacion nueva', 50, 1),
(5, 2, '104', 'Habitacion nueva', 60, 1),
(6, 2, '105', 'Habitacion nueva', 60, 1),
(7, 2, '106', 'Habitacion nueva', 100, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `huesped`
--

CREATE TABLE `huesped` (
  `h_id` int(11) NOT NULL,
  `h_tipodocumento` int(11) DEFAULT NULL,
  `h_documento` varchar(11) DEFAULT NULL,
  `h_nacionalidad` int(11) NOT NULL,
  `h_nombres` varchar(100) DEFAULT NULL,
  `h_direccion` varchar(200) DEFAULT NULL,
  `h_fechareg` date DEFAULT NULL,
  `h_celular` varchar(15) DEFAULT NULL,
  `h_estado` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `huesped`
--

INSERT INTO `huesped` (`h_id`, `h_tipodocumento`, `h_documento`, `h_nacionalidad`, `h_nombres`, `h_direccion`, `h_fechareg`, `h_celular`, `h_estado`) VALUES
(3, 1, '68484885', 1, 'juan martinez', NULL, '2017-02-19', NULL, 0),
(4, 1, '98344444', 5, 'Mario Velarde', NULL, '2017-02-22', NULL, 0),
(5, 1, '49388475', 6, 'Cristiano Ronaldo', NULL, '2017-02-27', NULL, 0),
(7, 1, '70989910', 2, 'Christian Manue Juárez Rivero', 'jr. cesar david 126', '2019-04-27', '956908983', 0),
(8, 1, '48515513', 7, 'Ricardo salazar Ríos', NULL, '2019-04-28', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE `pais` (
  `p_id` int(11) NOT NULL,
  `p_descripcion` varchar(100) DEFAULT NULL,
  `p_estado` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`p_id`, `p_descripcion`, `p_estado`) VALUES
(1, 'PERU', 0),
(2, 'CHILE', 0),
(3, 'ARGENTINA', 0),
(4, 'BRASIL', 0),
(5, 'COLOMBIA', 0),
(6, 'ECUADOR', 0),
(7, 'PORTUGAL', 0),
(8, 'Perú', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `p_id` int(11) NOT NULL,
  `p_categoria` int(11) DEFAULT NULL,
  `p_descripcion` varchar(100) DEFAULT NULL,
  `p_stock` int(11) NOT NULL,
  `p_precio` double NOT NULL,
  `p_estado` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`p_id`, `p_categoria`, `p_descripcion`, `p_stock`, `p_precio`, `p_estado`) VALUES
(1, 2, 'Gaseosa 500 ML', 10, 2.5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

CREATE TABLE `reserva` (
  `r_id` int(11) NOT NULL,
  `r_cliente` int(11) DEFAULT NULL,
  `r_fecha` date DEFAULT NULL,
  `r_total` double DEFAULT NULL,
  `r_estado` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `reserva`
--

INSERT INTO `reserva` (`r_id`, `r_cliente`, `r_fecha`, `r_total`, `r_estado`) VALUES
(1, 1, '2017-02-19', NULL, 2),
(2, 4, '2019-04-27', NULL, 2),
(3, 5, '2019-04-27', NULL, 2),
(4, 6, '2019-05-02', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `s_id` int(11) NOT NULL,
  `s_entrada` int(11) DEFAULT NULL,
  `s_tiposervicio` int(11) NOT NULL,
  `s_total` double DEFAULT NULL,
  `s_estado` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`s_id`, `s_entrada`, `s_tiposervicio`, `s_total`, `s_estado`) VALUES
(1, 1, 1, 10, 1),
(3, 1, 2, 15, 1),
(4, 1, 1, 80, 1),
(5, 7, 1, 67, 1),
(6, 7, 2, 80, 1),
(7, 1, 1, 30, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_cliente`
--

CREATE TABLE `tipo_cliente` (
  `tc_id` int(11) NOT NULL,
  `tc_descripcion` varchar(100) DEFAULT NULL,
  `tc_estado` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_cliente`
--

INSERT INTO `tipo_cliente` (`tc_id`, `tc_descripcion`, `tc_estado`) VALUES
(1, 'NORMAL', 1),
(2, 'EMPRESA', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documento`
--

CREATE TABLE `tipo_documento` (
  `td_id` int(11) NOT NULL,
  `td_descripcion` varchar(100) DEFAULT NULL,
  `td_estado` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_documento`
--

INSERT INTO `tipo_documento` (`td_id`, `td_descripcion`, `td_estado`) VALUES
(1, 'DNI', 1),
(2, 'RUC', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_empleado`
--

CREATE TABLE `tipo_empleado` (
  `te_id` int(11) NOT NULL,
  `te_descripcion` varchar(100) DEFAULT NULL,
  `te_estado` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_empleado`
--

INSERT INTO `tipo_empleado` (`te_id`, `te_descripcion`, `te_estado`) VALUES
(1, 'ADMINISTRADOR', 1),
(2, 'Recepcionista', 1),
(3, 'Barredor', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_habitacion`
--

CREATE TABLE `tipo_habitacion` (
  `th_id` int(11) NOT NULL,
  `th_descripcion` varchar(100) DEFAULT NULL,
  `th_estado` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_habitacion`
--

INSERT INTO `tipo_habitacion` (`th_id`, `th_descripcion`, `th_estado`) VALUES
(1, 'HABITACION SIMPLE', 1),
(2, 'HABITACION DOBLE', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_servicio`
--

CREATE TABLE `tipo_servicio` (
  `ts_id` int(11) NOT NULL,
  `ts_descripcion` varchar(100) DEFAULT NULL,
  `ts_estado` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_servicio`
--

INSERT INTO `tipo_servicio` (`ts_id`, `ts_descripcion`, `ts_estado`) VALUES
(1, 'RESTAURANT', 1),
(2, 'INTERNET WIFI', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`c_id`);

--
-- Indices de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `pais_fk` (`c_pais`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `tipocliente_fk` (`c_tipocliente`);

--
-- Indices de la tabla `consumo`
--
ALTER TABLE `consumo`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `fk_cliente` (`c_cliente`),
  ADD KEY `fk_empleado` (`c_empleado`);

--
-- Indices de la tabla `detalle_consumo`
--
ALTER TABLE `detalle_consumo`
  ADD PRIMARY KEY (`dc_consumo`,`dc_producto`),
  ADD KEY `fk_producto` (`dc_producto`);

--
-- Indices de la tabla `detalle_reserva`
--
ALTER TABLE `detalle_reserva`
  ADD PRIMARY KEY (`dr_reserva`,`dr_habitacion`),
  ADD KEY `fk_habitacion` (`dr_habitacion`);

--
-- Indices de la tabla `detalle_servicio`
--
ALTER TABLE `detalle_servicio`
  ADD PRIMARY KEY (`ds_entrada`,`ds_producto`),
  ADD KEY `fk_producto1` (`ds_producto`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`e_id`),
  ADD KEY `tipoempleado_fk1` (`e_tipoempleado`);

--
-- Indices de la tabla `enseres`
--
ALTER TABLE `enseres`
  ADD PRIMARY KEY (`e_id`),
  ADD KEY `fk_habitacion1` (`e_habitacion`),
  ADD KEY `fk_categoria1` (`e_categoria`);

--
-- Indices de la tabla `entrada`
--
ALTER TABLE `entrada`
  ADD PRIMARY KEY (`e_id`),
  ADD KEY `fk_huesped` (`e_huesped`),
  ADD KEY `fk_empleado2` (`e_empleado`),
  ADD KEY `fk_ciudad1` (`e_ciudad`),
  ADD KEY `fk_habitacion2` (`e_habitacion`);

--
-- Indices de la tabla `habitacion`
--
ALTER TABLE `habitacion`
  ADD PRIMARY KEY (`h_id`),
  ADD KEY `tipohabitacion_fk` (`h_tipohabitacion`);

--
-- Indices de la tabla `huesped`
--
ALTER TABLE `huesped`
  ADD PRIMARY KEY (`h_id`),
  ADD KEY `tipodoc_fk` (`h_tipodocumento`);

--
-- Indices de la tabla `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`p_id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `categoria_fk` (`p_categoria`);

--
-- Indices de la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`r_id`),
  ADD KEY `fk_cliente1` (`r_cliente`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`s_id`),
  ADD KEY `fk_entrada` (`s_entrada`);

--
-- Indices de la tabla `tipo_cliente`
--
ALTER TABLE `tipo_cliente`
  ADD PRIMARY KEY (`tc_id`);

--
-- Indices de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  ADD PRIMARY KEY (`td_id`);

--
-- Indices de la tabla `tipo_empleado`
--
ALTER TABLE `tipo_empleado`
  ADD PRIMARY KEY (`te_id`);

--
-- Indices de la tabla `tipo_habitacion`
--
ALTER TABLE `tipo_habitacion`
  ADD PRIMARY KEY (`th_id`);

--
-- Indices de la tabla `tipo_servicio`
--
ALTER TABLE `tipo_servicio`
  ADD PRIMARY KEY (`ts_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `consumo`
--
ALTER TABLE `consumo`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `e_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `enseres`
--
ALTER TABLE `enseres`
  MODIFY `e_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `entrada`
--
ALTER TABLE `entrada`
  MODIFY `e_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `habitacion`
--
ALTER TABLE `habitacion`
  MODIFY `h_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `huesped`
--
ALTER TABLE `huesped`
  MODIFY `h_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `pais`
--
ALTER TABLE `pais`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `reserva`
--
ALTER TABLE `reserva`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tipo_cliente`
--
ALTER TABLE `tipo_cliente`
  MODIFY `tc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  MODIFY `td_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_empleado`
--
ALTER TABLE `tipo_empleado`
  MODIFY `te_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipo_habitacion`
--
ALTER TABLE `tipo_habitacion`
  MODIFY `th_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_servicio`
--
ALTER TABLE `tipo_servicio`
  MODIFY `ts_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD CONSTRAINT `pais_fk` FOREIGN KEY (`c_pais`) REFERENCES `pais` (`p_id`);

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `tipocliente_fk` FOREIGN KEY (`c_tipocliente`) REFERENCES `tipo_cliente` (`tc_id`);

--
-- Filtros para la tabla `consumo`
--
ALTER TABLE `consumo`
  ADD CONSTRAINT `fk_cliente` FOREIGN KEY (`c_cliente`) REFERENCES `cliente` (`c_id`),
  ADD CONSTRAINT `fk_empleado` FOREIGN KEY (`c_empleado`) REFERENCES `empleado` (`e_id`);

--
-- Filtros para la tabla `detalle_consumo`
--
ALTER TABLE `detalle_consumo`
  ADD CONSTRAINT `fk_consumo` FOREIGN KEY (`dc_consumo`) REFERENCES `consumo` (`c_id`),
  ADD CONSTRAINT `fk_producto` FOREIGN KEY (`dc_producto`) REFERENCES `producto` (`p_id`);

--
-- Filtros para la tabla `detalle_reserva`
--
ALTER TABLE `detalle_reserva`
  ADD CONSTRAINT `fk_habitacion` FOREIGN KEY (`dr_habitacion`) REFERENCES `habitacion` (`h_id`),
  ADD CONSTRAINT `fk_reserva` FOREIGN KEY (`dr_reserva`) REFERENCES `reserva` (`r_id`);

--
-- Filtros para la tabla `detalle_servicio`
--
ALTER TABLE `detalle_servicio`
  ADD CONSTRAINT `fk_entrada1` FOREIGN KEY (`ds_entrada`) REFERENCES `entrada` (`e_id`),
  ADD CONSTRAINT `fk_producto1` FOREIGN KEY (`ds_producto`) REFERENCES `producto` (`p_id`);

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `tipoempleado_fk1` FOREIGN KEY (`e_tipoempleado`) REFERENCES `tipo_empleado` (`te_id`);

--
-- Filtros para la tabla `enseres`
--
ALTER TABLE `enseres`
  ADD CONSTRAINT `fk_categoria1` FOREIGN KEY (`e_categoria`) REFERENCES `categoria` (`c_id`),
  ADD CONSTRAINT `fk_habitacion1` FOREIGN KEY (`e_habitacion`) REFERENCES `habitacion` (`h_id`);

--
-- Filtros para la tabla `entrada`
--
ALTER TABLE `entrada`
  ADD CONSTRAINT `fk_ciudad1` FOREIGN KEY (`e_ciudad`) REFERENCES `ciudad` (`c_id`),
  ADD CONSTRAINT `fk_empleado2` FOREIGN KEY (`e_empleado`) REFERENCES `empleado` (`e_id`),
  ADD CONSTRAINT `fk_habitacion2` FOREIGN KEY (`e_habitacion`) REFERENCES `habitacion` (`h_id`),
  ADD CONSTRAINT `fk_huesped` FOREIGN KEY (`e_huesped`) REFERENCES `huesped` (`h_id`);

--
-- Filtros para la tabla `habitacion`
--
ALTER TABLE `habitacion`
  ADD CONSTRAINT `tipohabitacion_fk` FOREIGN KEY (`h_tipohabitacion`) REFERENCES `tipo_habitacion` (`th_id`);

--
-- Filtros para la tabla `huesped`
--
ALTER TABLE `huesped`
  ADD CONSTRAINT `tipodoc_fk` FOREIGN KEY (`h_tipodocumento`) REFERENCES `tipo_documento` (`td_id`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `categoria_fk` FOREIGN KEY (`p_categoria`) REFERENCES `categoria` (`c_id`);

--
-- Filtros para la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `fk_cliente1` FOREIGN KEY (`r_cliente`) REFERENCES `cliente` (`c_id`);

--
-- Filtros para la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD CONSTRAINT `fk_entrada` FOREIGN KEY (`s_entrada`) REFERENCES `entrada` (`e_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
