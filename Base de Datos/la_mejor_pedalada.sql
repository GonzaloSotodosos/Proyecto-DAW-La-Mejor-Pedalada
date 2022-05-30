-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-05-2022 a las 20:20:28
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `la_mejor_pedalada`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bicicletas`
--

CREATE TABLE `bicicletas` (
  `id_bici` int(6) NOT NULL,
  `marca` varchar(15) DEFAULT NULL,
  `modelo` varchar(25) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `imagen` varchar(30) DEFAULT NULL,
  `detalles` varchar(2000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `bicicletas`
--

INSERT INTO `bicicletas` (`id_bici`, `marca`, `modelo`, `precio`, `imagen`, `detalles`) VALUES
(1, 'Orbea', 'Alma M30', 2399, 'alma1.png', 'Orbea Alma M30 de fibra de carbono edición especial 2022. Cambio Shimano XT M8100 SGS Shadow Plus. Está hecha para que puedas ir más rápido que nunca, sube y baja todo tipo de pendientes de la forma más ligera. La nueva Alma está hecha para las etapas más exigentes, los aficionados más estruendosos y los corredores más duros. Los ciclistas que buscan una Alma son atletas que únicamente se conforman con lo máximo.'),
(2, 'Orbea', 'Oiz M30', 3899, 'oiz1.png', 'Orbea Oiz M30 de fibra de carbono edición especial 2022. Cambio Shimano XT M8100 SGS Shadow Plus. La Oiz sabe bien lo que cuesta llegar a la cima, y con dos campeonatos del mundo demuestran que Oiz está en lo más alto. Oiz y el auténtico cross-country son sinónimos.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id_sesion` varchar(50) NOT NULL,
  `id_bici` int(6) DEFAULT NULL,
  `id_equipamiento` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita_taller`
--

CREATE TABLE `cita_taller` (
  `id_cliente` int(6) UNSIGNED NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `primer_apellido` varchar(50) DEFAULT NULL,
  `segundo_apellido` varchar(50) DEFAULT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `poblacion` varchar(50) DEFAULT NULL,
  `ciudad` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `marca` varchar(15) DEFAULT NULL,
  `modelo` varchar(25) DEFAULT NULL,
  `detalles` varchar(2000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cita_taller`
--

INSERT INTO `cita_taller` (`id_cliente`, `nombre`, `primer_apellido`, `segundo_apellido`, `direccion`, `poblacion`, `ciudad`, `email`, `marca`, `modelo`, `detalles`) VALUES
(1, 'Alvaro', 'Aguayo', 'Garcia', 'Calle Finlandia', 'Meco', 'Madrid', 'aaguayo@gmail.com', 'Specialized', 'Epic', 'Tubelizar ruedas'),
(8, 'Gonzalo', 'Sotodosos', 'Romero', 'Calle Estonia, 4 1ºB', 'Meco', 'Meco', 'gsr1526@hotmail.com', 'Orbea', 'Alma', 'pastillas freno'),
(9, 'Silvia', 'Bueno', 'Jimenez', 'Calle Pio Baroja, 22', 'Meco', 'Madrid', 'silvia@silvia.com', 'Orbea', 'Alma', 'Mantenimiento Primer año'),
(10, 'Gonzalo', 'Sotodosos', 'Romero', 'Calle Estonia, 4 1ºB', 'Meco', 'Meco', 'gsr1526@hotmail.com', 'Orbea', 'Alma', 'Cambiar pastillas'),
(11, 'Julio', 'Diaz', 'Diaz', 'La Paloma', 'Meco', 'Madrid', 'julio@diaz.es', 'Orbea', 'Alma', 'Tubelizar ruedas'),
(12, 'Jose Luis', 'Rio', 'Mar', 'Calle La Flor, 3 2º E', 'Madrid', 'Madrid', 'rio@mar.es', 'Orbea', 'Alma', 'ruedas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipamiento`
--

CREATE TABLE `equipamiento` (
  `id_equipamiento` int(6) NOT NULL,
  `titulo` varchar(15) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `imagen` varchar(30) DEFAULT NULL,
  `detalles` varchar(2000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `equipamiento`
--

INSERT INTO `equipamiento` (`id_equipamiento`, `titulo`, `precio`, `imagen`, `detalles`) VALUES
(1, 'Maillot', 60, 'maillot.png', 'El maillot Santini UCI World Champion 2021 está fabricado con tejidos ecológicos procedentes de PET 100% reciclado. El maillot también se entregará en un embalaje compostable.\r\nMaterial de maillot: 100% de malla de poliéster, Material de pantalones Cortos: 80% de poliéster y 20% licra\r\nTamaño: S/M/L/XL/XXL/XXXL/XXXXL/XXXXXL'),
(2, 'Culote', 58, 'culote.png', 'El culote largo Northwave Force 2 está fabricado con tejido elástico bidireccional de napa para conseguir un gran aislamiento en las salidas de otoño e invierno. La parte inferior de las piernas elástica de silicona mantiene la prenda en su lugar en todo momento. Incluye la badana Coolmax Sport Man.\r\n\r\nBadana Coolmax Sport Man: Esta badana tiene una construcción realizada con espumas de capacidad media para recorridos de kilometraje medio.'),
(3, 'Casco', 40, 'casco.png', 'El casco Giro Agilis tiene una variedad de características para la conducción en carretera y en múltiples superficies. La carcasa exterior Hardbody se extiende hasta el interior del casco y está hecha de un resistente policarbonato que se funde permanentemente con la pieza de espuma EPS mediante el proceso In-Mold para mejorar la durabilidad y la ventilación sin causar una masa excesiva.'),
(4, 'Zapatillas', 80, 'zapatillas.png', 'Las zapatillas Spiuk Mondie de MTB ofrece una ventilación interior excelente durante toda la salida, gracias a su cubierta microperforada con el sistema Drilling Shell System de Spiuk. El sistema de cierre BOA, complementado con un mini-velcro delantero permite un ajuste óptimo con una sola mano en cualquier momento. La suela Advanced Composite de fibra de vidrio y poliamida está complementada con un taqueado profundo de goma para obtener un agarre adecuado ante la exigencia de las pistas de montaña y los senderos.'),
(5, 'Guantes', 25, 'guantes.png', 'Los guantes Giro Bravo LF tienen la palma con diseño Super Fit de tres paneles para un ajuste a medida. Palma de cuero sintético Clarino que mejora el agarre y la transpirabilidad, a la vez que aumenta la durabilidad. La parte superior es de malla transpirable que absorbe la humedad y es elástica en todas direcciones. Acolchado optimizado para un mayor confort. Microfibra muy absorbente para secar el sudor. Lengüeta Sonic integrada para una fácil extracción. Cierre de Velcro de perfil bajo.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(6) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `contrasenia` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `contrasenia`) VALUES
(1, 'admin', 'F.123456'),
(2, 'pepe', 'P.123456'),
(3, 'Luis', 'L.123456');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bicicletas`
--
ALTER TABLE `bicicletas`
  ADD PRIMARY KEY (`id_bici`);

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD KEY `id_bici` (`id_bici`),
  ADD KEY `id_equipamiento` (`id_equipamiento`);

--
-- Indices de la tabla `cita_taller`
--
ALTER TABLE `cita_taller`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `equipamiento`
--
ALTER TABLE `equipamiento`
  ADD PRIMARY KEY (`id_equipamiento`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cita_taller`
--
ALTER TABLE `cita_taller`
  MODIFY `id_cliente` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `equipamiento`
--
ALTER TABLE `equipamiento`
  MODIFY `id_equipamiento` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `carrito_ibfk_1` FOREIGN KEY (`id_bici`) REFERENCES `bicicletas` (`id_bici`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carrito_ibfk_2` FOREIGN KEY (`id_equipamiento`) REFERENCES `equipamiento` (`id_equipamiento`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
