-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-02-2017 a las 12:18:13
-- Versión del servidor: 5.6.16
-- Versión de PHP: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `hotel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_descripcion` varchar(100) DEFAULT NULL,
  `c_estado` int(11) DEFAULT '1',
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

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

CREATE TABLE IF NOT EXISTS `ciudad` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_pais` int(11) DEFAULT NULL,
  `c_descripcion` varchar(100) DEFAULT NULL,
  `c_estado` int(11) DEFAULT '1',
  PRIMARY KEY (`c_id`),
  KEY `pais_fk` (`c_pais`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `ciudad`
--

INSERT INTO `ciudad` (`c_id`, `c_pais`, `c_descripcion`, `c_estado`) VALUES
(0, 1, 'TARAPOTO - SAN MARTIN', 1),
(1, 1, 'LIMA', 1),
(2, 2, 'LIMA', 1),
(3, 2, 'SANTIAGO', 1),
(4, 4, 'SAO PAULO', 1),
(5, 1, 'CHICLAYO', 1),
(6, 7, 'LISBOA', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_tipocliente` int(11) DEFAULT NULL,
  `c_dni` varchar(8) DEFAULT NULL,
  `c_nombres` varchar(100) DEFAULT NULL,
  `c_direccion` varchar(200) DEFAULT NULL,
  `c_fechareg` date DEFAULT NULL,
  `c_celular` varchar(15) DEFAULT NULL,
  `c_estado` int(11) DEFAULT '1',
  PRIMARY KEY (`c_id`),
  KEY `tipocliente_fk` (`c_tipocliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`c_id`, `c_tipocliente`, `c_dni`, `c_nombres`, `c_direccion`, `c_fechareg`, `c_celular`, `c_estado`) VALUES
(1, 1, '98538458', 'juan morales dfgf', 'Tarapoto', '2017-02-06', '958485857', 1),
(2, 1, '98538465', 'alfredo redategui fsdfgh', 'Tarapoto', '2017-02-06', '958485857', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consumo`
--

CREATE TABLE IF NOT EXISTS `consumo` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_cliente` int(11) DEFAULT NULL,
  `c_empleado` int(11) DEFAULT NULL,
  `c_fecha` date DEFAULT NULL,
  `c_total` double DEFAULT NULL,
  `c_igv` double DEFAULT NULL,
  `c_estado` int(11) DEFAULT '1',
  PRIMARY KEY (`c_id`),
  KEY `fk_cliente` (`c_cliente`),
  KEY `fk_empleado` (`c_empleado`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_consumo`
--

CREATE TABLE IF NOT EXISTS `detalle_consumo` (
  `dc_consumo` int(11) NOT NULL,
  `dc_producto` int(11) NOT NULL,
  `dc_cantidad` int(11) DEFAULT NULL,
  `dc_precio_unitario` double DEFAULT NULL,
  `dc_igv` double DEFAULT NULL,
  `dc_monto` double DEFAULT NULL,
  `dc_estado` int(11) DEFAULT '1',
  PRIMARY KEY (`dc_consumo`,`dc_producto`),
  KEY `fk_producto` (`dc_producto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_reserva`
--

CREATE TABLE IF NOT EXISTS `detalle_reserva` (
  `dr_reserva` int(11) NOT NULL,
  `dr_habitacion` int(11) NOT NULL,
  `dr_monto` double DEFAULT NULL,
  `dr_estado` int(11) DEFAULT '1',
  PRIMARY KEY (`dr_reserva`,`dr_habitacion`),
  KEY `fk_habitacion` (`dr_habitacion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle_reserva`
--

INSERT INTO `detalle_reserva` (`dr_reserva`, `dr_habitacion`, `dr_monto`, `dr_estado`) VALUES
(1, 2, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_servicio`
--

CREATE TABLE IF NOT EXISTS `detalle_servicio` (
  `ds_entrada` int(11) NOT NULL,
  `ds_producto` int(11) NOT NULL,
  `ds_cantidad` int(11) DEFAULT NULL,
  `ds_precio_unitario` double DEFAULT NULL,
  `ds_igv` double DEFAULT NULL,
  `ds_monto` double DEFAULT NULL,
  `ds_estado` int(11) DEFAULT '1',
  PRIMARY KEY (`ds_entrada`,`ds_producto`),
  KEY `fk_producto1` (`ds_producto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE IF NOT EXISTS `empleado` (
  `e_id` int(11) NOT NULL AUTO_INCREMENT,
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
  `e_estado` int(11) DEFAULT '1',
  PRIMARY KEY (`e_id`),
  KEY `tipoempleado_fk1` (`e_tipoempleado`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`e_id`, `e_dni`, `e_nombres`, `e_apellidos`, `e_direccion`, `e_usuario`, `e_clave`, `e_celular`, `e_sexo`, `e_fechareg`, `e_tipoempleado`, `e_estado`) VALUES
(1, '93589585', 'DANIEL', 'OBLITAS', 'TARAPOTO', 'daniel', '123', '3894984848', 'MASCULINO', '2017-02-07', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enseres`
--

CREATE TABLE IF NOT EXISTS `enseres` (
  `e_id` int(11) NOT NULL AUTO_INCREMENT,
  `e_categoria` int(11) NOT NULL,
  `e_habitacion` int(11) NOT NULL,
  `e_descripcion` varchar(100) DEFAULT NULL,
  `e_estado` int(11) DEFAULT '1',
  PRIMARY KEY (`e_id`),
  KEY `fk_habitacion1` (`e_habitacion`),
  KEY `fk_categoria1` (`e_categoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

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

CREATE TABLE IF NOT EXISTS `entrada` (
  `e_id` int(11) NOT NULL AUTO_INCREMENT,
  `e_huesped` int(11) DEFAULT NULL,
  `e_empleado` int(11) DEFAULT NULL,
  `e_habitacion` int(11) DEFAULT NULL,
  `e_ciudad` int(11) DEFAULT NULL,
  `e_fechaini` date DEFAULT NULL,
  `e_fechafin` date NOT NULL,
  `e_dias` int(11) NOT NULL,
  `e_total` double DEFAULT NULL,
  `e_estado` int(11) DEFAULT '1',
  PRIMARY KEY (`e_id`),
  KEY `fk_huesped` (`e_huesped`),
  KEY `fk_empleado2` (`e_empleado`),
  KEY `fk_ciudad1` (`e_ciudad`),
  KEY `fk_habitacion2` (`e_habitacion`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `entrada`
--

INSERT INTO `entrada` (`e_id`, `e_huesped`, `e_empleado`, `e_habitacion`, `e_ciudad`, `e_fechaini`, `e_fechafin`, `e_dias`, `e_total`, `e_estado`) VALUES
(1, 3, 1, 3, 0, '2017-02-19', '2017-02-20', 1, 50, 0),
(2, 4, 1, 1, 0, '2017-02-22', '2017-02-24', 2, 80, 0),
(3, 5, 1, 2, 0, '2017-02-27', '2017-03-03', 4, 280, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitacion`
--

CREATE TABLE IF NOT EXISTS `habitacion` (
  `h_id` int(11) NOT NULL AUTO_INCREMENT,
  `h_tipohabitacion` int(11) DEFAULT NULL,
  `h_nro` varchar(10) DEFAULT NULL,
  `h_descripcion` varchar(100) DEFAULT NULL,
  `h_precio` double NOT NULL,
  `h_estado` int(11) DEFAULT '1',
  PRIMARY KEY (`h_id`),
  KEY `tipohabitacion_fk` (`h_tipohabitacion`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `habitacion`
--

INSERT INTO `habitacion` (`h_id`, `h_tipohabitacion`, `h_nro`, `h_descripcion`, `h_precio`, `h_estado`) VALUES
(1, 1, '100', 'Habitacion nueva', 80, 1),
(2, 1, '101', 'Habitacion nueva', 70, 2),
(3, 1, '102', 'Habitacion nueva', 50, 1),
(4, 1, '103', 'Habitacion nueva', 50, 1),
(5, 2, '104', 'Habitacion nueva', 60, 1),
(6, 2, '105', 'Habitacion nueva', 60, 1),
(7, 2, '106', 'Habitacion nueva', 100, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `huesped`
--

CREATE TABLE IF NOT EXISTS `huesped` (
  `h_id` int(11) NOT NULL AUTO_INCREMENT,
  `h_tipodocumento` int(11) DEFAULT NULL,
  `h_documento` varchar(11) DEFAULT NULL,
  `h_nacionalidad` int(11) NOT NULL,
  `h_nombres` varchar(100) DEFAULT NULL,
  `h_direccion` varchar(200) DEFAULT NULL,
  `h_fechareg` date DEFAULT NULL,
  `h_celular` varchar(15) DEFAULT NULL,
  `h_estado` int(11) DEFAULT '1',
  PRIMARY KEY (`h_id`),
  KEY `tipodoc_fk` (`h_tipodocumento`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `huesped`
--

INSERT INTO `huesped` (`h_id`, `h_tipodocumento`, `h_documento`, `h_nacionalidad`, `h_nombres`, `h_direccion`, `h_fechareg`, `h_celular`, `h_estado`) VALUES


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE IF NOT EXISTS `pais` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `p_descripcion` varchar(100) DEFAULT NULL,
  `p_estado` int(11) DEFAULT '1',
  PRIMARY KEY (`p_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`p_id`, `p_descripcion`, `p_estado`) VALUES
(1, 'PERU', 1),
(2, 'CHILE', 1),
(3, 'ARGENTINA', 1),
(4, 'BRASIL', 1),
(5, 'COLOMBIA', 1),
(6, 'ECUADOR', 1),
(7, 'PORTUGAL', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE IF NOT EXISTS `producto` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `p_categoria` int(11) DEFAULT NULL,
  `p_descripcion` varchar(100) DEFAULT NULL,
  `p_stock` int(11) NOT NULL,
  `p_precio` double NOT NULL,
  `p_estado` int(11) DEFAULT '1',
  PRIMARY KEY (`p_id`),
  KEY `categoria_fk` (`p_categoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`p_id`, `p_categoria`, `p_descripcion`, `p_stock`, `p_precio`, `p_estado`) VALUES
(1, 2, 'Gaseosa 500 ML', 10, 2.5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

CREATE TABLE IF NOT EXISTS `reserva` (
  `r_id` int(11) NOT NULL AUTO_INCREMENT,
  `r_cliente` int(11) DEFAULT NULL,
  `r_fecha` date DEFAULT NULL,
  `r_total` double DEFAULT NULL,
  `r_estado` int(11) DEFAULT '1',
  PRIMARY KEY (`r_id`),
  KEY `fk_cliente1` (`r_cliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `reserva`
--

INSERT INTO `reserva` (`r_id`, `r_cliente`, `r_fecha`, `r_total`, `r_estado`) VALUES
(1, 1, '2017-02-19', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE IF NOT EXISTS `servicio` (
  `s_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_entrada` int(11) DEFAULT NULL,
  `s_tiposervicio` int(11) NOT NULL,
  `s_total` double DEFAULT NULL,
  `s_estado` int(11) DEFAULT '1',
  PRIMARY KEY (`s_id`),
  KEY `fk_entrada` (`s_entrada`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`s_id`, `s_entrada`, `s_tiposervicio`, `s_total`, `s_estado`) VALUES
(1, 1, 1, 10, 1),
(3, 1, 2, 15, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_cliente`
--

CREATE TABLE IF NOT EXISTS `tipo_cliente` (
  `tc_id` int(11) NOT NULL AUTO_INCREMENT,
  `tc_descripcion` varchar(100) DEFAULT NULL,
  `tc_estado` int(11) DEFAULT '1',
  PRIMARY KEY (`tc_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `tipo_cliente`
--

INSERT INTO `tipo_cliente` (`tc_id`, `tc_descripcion`, `tc_estado`) VALUES
(1, 'NORMAL', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documento`
--

CREATE TABLE IF NOT EXISTS `tipo_documento` (
  `td_id` int(11) NOT NULL AUTO_INCREMENT,
  `td_descripcion` varchar(100) DEFAULT NULL,
  `td_estado` int(11) DEFAULT '1',
  PRIMARY KEY (`td_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

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

CREATE TABLE IF NOT EXISTS `tipo_empleado` (
  `te_id` int(11) NOT NULL AUTO_INCREMENT,
  `te_descripcion` varchar(100) DEFAULT NULL,
  `te_estado` int(11) DEFAULT '1',
  PRIMARY KEY (`te_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `tipo_empleado`
--

INSERT INTO `tipo_empleado` (`te_id`, `te_descripcion`, `te_estado`) VALUES
(1, 'ADMINISTRADOR', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_habitacion`
--

CREATE TABLE IF NOT EXISTS `tipo_habitacion` (
  `th_id` int(11) NOT NULL AUTO_INCREMENT,
  `th_descripcion` varchar(100) DEFAULT NULL,
  `th_estado` int(11) DEFAULT '1',
  PRIMARY KEY (`th_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

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

CREATE TABLE IF NOT EXISTS `tipo_servicio` (
  `ts_id` int(11) NOT NULL AUTO_INCREMENT,
  `ts_descripcion` varchar(100) DEFAULT NULL,
  `ts_estado` int(11) DEFAULT '1',
  PRIMARY KEY (`ts_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tipo_servicio`
--

INSERT INTO `tipo_servicio` (`ts_id`, `ts_descripcion`, `ts_estado`) VALUES
(1, 'RESTAURANT', 1),
(2, 'INTERNET WIFI', 1);

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
