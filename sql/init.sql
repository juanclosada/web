-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-08-2025 a las 05:20:04
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: mi_negocio
--
-- Crear base de datos mi_negocio
CREATE DATABASE IF NOT EXISTS mi_negocio CHARACTER SET utf8 COLLATE utf8_spanish2_ci;
USE mi_negocio;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla carrito
--

CREATE TABLE carrito (
  id int(11) NOT NULL,
  usuario_id int(11) DEFAULT NULL,
  producto_id int(11) DEFAULT NULL,
  factura_id int(200)  NULL,
  cantidad int(11) DEFAULT NULL,
  Precio decimal(10,0) NOT NULL,
  Subtotal int(20) NOT NULL,
  estado int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla carrito
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla contactos
--

CREATE TABLE contactos (
  id int(11) NOT NULL,
  usuario_id int(11) NOT NULL,
  nombre varchar(100) NOT NULL,
  correo varchar(100) NOT NULL,
  asunto varchar(150) NOT NULL,
  mensaje text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla contactos
--

INSERT INTO contactos (id, usuario_id, nombre, correo, asunto, mensaje) VALUES
(1, 5, 'migel angel astaytsyat', 'gggagsgagsfat@asas.com', 'prueba', 'prueba'),
(2, 53, 'ANDRES FABIAN  LEÓN GUTIERREZ', 'leonardo17@gmail.com', 'Compra feliz', '\"Muy satisfecho con mi compra, el producto llegó rápido y en perfectas condiciones. ¡Recomendado!\"'),
(3, 60, 'JUAN  PÉREZ', 'cliente1@correo.com', 'Compra feliz', 'Satisfecho con mi compra, el producto llegó rápido y en perfectas condiciones. ¡Recomendado!\"'),
(4, 56, 'LEONARDO GUTIERREZ CTE', 'leonardo808161@gmail.com', 'prueba juan', 'compra satisfecha ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla detalle_factura
--

CREATE TABLE detalle_factura (
  id int(11) NOT NULL,
  usuario_id int(11) DEFAULT NULL,
  producto_id int(11) DEFAULT NULL,
  factura_id int(200) NOT NULL,
  cantidad int(11) DEFAULT NULL,
  Precio decimal(10,0) NOT NULL,
  Subtotal int(20) NOT NULL,
  estado int(11) DEFAULT NULL,
  nombre_p varchar(100)  NULL,
  desc_p varchar(1000) NULL,
  image_p varchar(500) NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla detalle_factura
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla envios
--

CREATE TABLE envios (
  id_envio int(11) NOT NULL,
  id_factura int(11) NOT NULL,
  direccion_envio varchar(255)  NULL,
  ciudad varchar(100)  NULL,
  departamento varchar(100)  NULL,
  codigo_postal varchar(20) DEFAULT NULL,
  telefono_contacto varchar(20) DEFAULT NULL,
  estado_envio int(11)  NULL,
  fecha_envio varchar(100)  NULL,
  fecha_entrega varchar(100)  NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla envios
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla factura
--

CREATE TABLE factura (
  id int(11) NOT NULL,
  usuario_id int(11) DEFAULT NULL,
  descuento int(11) NOT NULL,
  IVA int(11) NOT NULL,
  total int(11) NOT NULL,
  estado int(11) NOT NULL,
  fecha varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  forma_pago int(11) DEFAULT NULL,
  numero_tarjeta varchar(100)  NULL,
  fecha_expedicion varchar(5) CHARACTER SET utf8 COLLATE utf8_spanish2_ci  NULL,
  cvv int(11)  NULL,
  fecha_pago varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla factura
--
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla productos
--

CREATE TABLE productos (
  id_producto int(11) NOT NULL,
  nombre varchar(300) NOT NULL,
  descripcion varchar(1000) DEFAULT NULL,
  precio decimal(10,2) NOT NULL,
  stock int(11) NOT NULL,
  imagen varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla productos
--

INSERT INTO productos (id_producto, nombre, descripcion, precio, stock, imagen) VALUES
(1, 'Armario PRACTIMAC Sevilla 190 cm Ceniza', 'Con el ARMARIO PRACTIMAC Sevilla 190 cm, podrás dar orden a tu dormitorio porque cuenta con: maletero interno en la parte superior, 2 cajones, 4 colgaderos, espacio para zapatos en la parte inferior, 6 puertas (una con chapa de seguridad), 3 entrepaños y rodachinas para fácil desplazamiento. El mueble es fabricado con madera aglomerada de alta resistencia y acabado en melamina, logrando dar estabilidad y la durabilidad que debe tener un mueble para tu dormitorio, además tiene rieles y bisagras metálicos que garantizan un mejor desempeño. Este producto es fabricado y ensamblado en Colombia y cuenta con 5 años de garantía. ¡Anímate y cómpralo ya!', 1289900.00, 13, '../vista/img/armarionuevo1.jpg'),
(2, 'Armario MADERKIT Frida 140 cm Gales-Wengue', 'El Armario Frida 140 cm le dará a tu habitación un look elegante y moderno. Es un mueble listo para armar, cuenta con 1 cajón, 4 puertas abatibles, 1 tubo para colgar y 7 nichos para guardar ropa doblada y zapatos. Este producto es fabricado y ensamblado en Colombia, está fabricado en tableros de partículas de madera con una capa protectora, que brinda estabilidad y durabilidad al mueble. Los herrajes son metálicos, y cuenta con 5 años de garantía en las partes de madera y 1 año en la herrajería. Nuestra madera proviene de bosques 100% cultivados. ¡Anímate y cómpralo ya!', 809900.00, 12, '../vista/img/armarionuevo2.jpg'),
(12, 'Armario MADERKIT Kanon 140 cm Niebla', 'Con el Armario Kanon 140 cm de MADERKIT, podrás dar orden a tu dormitorio porque cuenta con: un colgadero, 2 cajones con chapa, 6 puertas abatibles, un entrepaño y maletero interno. El mueble es fabricado con madera aglomerada de alta resistencia y acabado en melamina, logrando dar estabilidad y la durabilidad que debe tener un mueble para dormitorio, además tiene rieles y bisagras metálicos que garantizan un mejor desempeño. Este producto es fabricado y ensamblado en Colombia. ¡Pídelo en línea y amobla tus espacios con Maderkit!', 999900.00, 6, '../vista/img/armarionuevo3.jpg\r\n'),
(13, 'Armario Gabinete RIMAX Rattan Wengue', 'Completa los muebles de tu hogar con este ARMARIO RIMAX de 65,5 cm, cuenta con un amplio espacio en el interior, tiene dos (2) gabinetes donde puedes organizar cobijas, toallas, almohadas o utensilios de cocina, es multifuncional y gracias a su tamaño lo puedes ubicar donde lo necesites. ¡Anímate y cómpralo ya!', 259900.00, 3, '../vista/img/armarionuevo6.jpg'),
(14, 'Armario PRACTIMAC Aquiles 100 Cm Caramelo', 'Con el ARMARIO PRACTIMAC Aquiles 100 cm, podrás dar orden a tu dormitorio porque cuenta con colgadero superior y un compartimiento lateral con dos entrepaños ideales para doblar la ropa, tiene 2 puertas abatibles con lindas manijas de aluminio. el mueble es fabricado con madera aglomerada de alta resistencia y acabado en Melamina, logrando dar estabilidad y la durabilidad que debe tener un mueble para tu dormitorio, además tiene rieles y bisagras metálicos que garantizan un mejor desempeño. Este producto es fabricado y ensamblado en Colombia y cuenta con 5 años de garantía. ¡Anímate y cómpralo ya!', 689900.00, 2, '../vista/img/armarionuevo5.jpg'),
(15, 'Armario PRACTIMAC Tifón 230 cm Wengue-Gales', 'El Closet Tifón 2.30 metros de PRACTIMAC, tiene un diseño ideal para para ti porque tiene puertas abatibles y division central para ropa doblada. Con este armario podrás dar orden a tu dormitorio porque cuenta con colgadero superior y un amplio maletero superior. El mueble es fabricado con madera aglomerada de alta resistencia y acabado en melamina, logrando dar estabilidad y la durabilidad que debe tener un mueble para tu dormitorio, además tiene bisagras metálicas que garantizan un mejor desempeño. Este producto es fabricado y ensamblado en Colombia y cuenta con 5 años de garantía.', 1559900.00, 2, '../vista/img/armarionuevo7.jpg'),
(16, 'Camarote Multifuncional MADERKIT Duna 100 X 190 Cm', '¡Con el camarote multifuncional optimizarás espacio y tendrás 3 muebles en 1! Es un mueble listo para armar, cuenta con cama para colchón de 1 metro, escalera y baranda para mayor seguridad, escritorio extensible con 1 cajón y 2 nichos y closet con puertas corredizas, 1 tubo para colgar y 2 entrepaños, está elaborado con tablero de densidad media, con partículas de madera y recubrimiento melamínico. Cuenta con 5 años de garantía en las partes de madera y 1 año en la herrajería. ¡Pídelo en línea y complementa el amoblado de tu habitación!', 1679900.00, 4, '../vista/img/camarotenuevo1.jpg'),
(17, 'Cama Baul Temus', 'Madera : NOGAL madera limpia, no reciclada, es secada al horno e inmunizada contra gorgojos Maxima durabilidad', 754990.00, 2, '../vista/img/basecama2.jpg'),
(18, 'Mesa para TV de 55\" MADERKIT Nórdica Rovere', 'La mesa para TV de MADERKIT Nórdica es ideal para TV hasta de 55\", cuenta con 3 entrepaños y 4 nichos para que organices tus objetos decorativos, equipos de video, revistas o libros. Este producto es fabricado en Colombia, está fabricado en tableros de partículas de madera con una capa protectora, que brinda estabilidad y durabilidad al mueble. Los herrajes son metálicos, cuenta con 5 años de garantía en las partes de madera y 1 año en la herrajería. Nuestra madera proviene de bosques 100% cultivados. ¡Anímate y cómpralo ya!', 299900.00, 20, '../vista/img/mesatvnueva1.jpg'),
(19, 'Centro de Entretenimiento MADERKIT Martina Rovere-Blanco', 'El Centro de Entretenimiento Martina es un mueble listo para armar, cuenta con superficie para TV de 75\", 3 nichos abiertos, 2 puertas y 1 repisa superior para que organices elementos decorativos o aparatos electrónicos. Este producto es fabricado y ensamblado en Colombia, está fabricado en tableros de partículas de madera con una capa protectora, que brinda estabilidad y durabilidad al mueble. Los herrajes son metálicos, y cuenta con 5 años de garantía en las partes de madera y 1 año en la herrajería. Nuestra madera proviene de bosques 100% cultivados. ¡Anímate y cómpralo ya!', 999900.00, 20, '../vista/img/centroentretenimientonuevo1.jpg'),
(20, 'Silla de Oficina TUKASA 5938L Negra', 'Renueva tus espacios de trabajo y/o estudio con los diseños modernos que TUKASA te puede proporcionar. La SILLA DE OFICINA TUKASA se convierte en un elemento indispensable para tu comodidad, su diseño dinámico combina perfectamente los materiales, confort , comodidad y estilo, cuenta con excelente soporte en los rodachines dándole gran estabilidad. ¡Anímate y cómprala ya!', 319900.00, 20, '../vista/img/sillanueva10.jpg'),
(21, 'Asiento 2', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/asiento2.jpg'),
(22, 'Asiento 3', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/asiento3.jpg'),
(23, 'Asiento 4', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/asiento4.jpg'),
(24, 'Asiento 5', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/asiento5.jpg'),
(25, 'Asiento 6', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/asiento6.jpg'),
(26, 'Asiento 7', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/asiento7.jpg'),
(27, 'Asiento 8', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/asiento8.jpg'),
(28, 'Asiento 9', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/asiento9.jpg'),
(29, 'Asiento 10', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/asiento10.jpg'),
(30, 'Camacuna 1', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/camacuna1.jpg'),
(31, 'Camacuna 2', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/camacuna2.jpg'),
(32, 'Camacuna 3', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/camacuna3.jpg'),
(33, 'Camacuna 4', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/camacuna4.jpg'),
(34, 'Camacuna 5', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/camacuna5.jpg'),
(35, 'Camacuna 6', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/camacuna6.jpg'),
(36, 'Camacuna 6', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/camacuna6.jpg'),
(37, 'Camacuna 7', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/camacuna7.jpg'),
(38, 'Camacuna 8', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/camacuna8.jpg'),
(39, 'Camacuna 9', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/camacuna9.jpg'),
(40, 'Camacuna 10', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/camacuna10.jpg'),
(41, 'Escritorio 1 ', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/escritorio1.jpg'),
(42, 'Escritorio 2', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/escritorio2.jpg'),
(43, 'Escritorio 3', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/escritorio3.jpg'),
(44, 'Escritorio 4', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/escritorio4.jpg'),
(45, 'Escritorio 5', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/escritorio5.jpg'),
(46, 'Escritorio 6', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/escritorio6.jpg'),
(47, 'Escritorio 7', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/escritorio7.jpg'),
(48, 'Escritorio 8', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/escritorio8.jpg'),
(49, 'Escritorio 9', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/escritorio9.jpg'),
(50, 'Escritorio 10', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/escritorio10.jpg'),
(51, 'Juego de alcoba 1', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/juego_de_alcoba1.jpg'),
(52, 'Juego de alcoba 2', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/juego_de_alcoba2.jpg'),
(53, 'Juego de alcoba 3', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/juego_de_alcoba3.jpg'),
(54, 'Juego de alcoba 4', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/juego_de_alcoba4.jpg'),
(55, 'Juego de alcoba 5', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/juego_de_alcoba5.jpg'),
(56, 'Juego de alcoba 6', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/juego_de_alcoba6.jpg'),
(57, 'Juego de alcoba 7', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/juego_de_alcoba7.jpg'),
(58, 'Juego de alcoba 8', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/juego_de_alcoba8.jpg'),
(59, 'Juego de alcoba 9', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/juego_de_alcoba9.jpg'),
(60, 'Juego de alcoba 10', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/juego_de_alcoba10.jpg'),
(61, 'Mesa de centro 1', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/mesa_de_centro1.jpg'),
(62, 'Mesa de centro 2', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/mesa_de_centro2.jpg'),
(63, 'Mesa de centro 3', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/mesa_de_centro3.jpg'),
(64, 'Mesa de centro 4', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/mesa_de_centro4.jpg'),
(65, 'Mesa de centro 5', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/mesa_de_centro5.jpg'),
(66, 'Mesa de centro 6', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/mesa_de_centro6.jpg'),
(67, 'Mesa de centro 7', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/mesa_de_centro7.jpg'),
(68, 'Mesa de centro 8', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/mesa_de_centro8.jpg'),
(69, 'Mesa de centro 9', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/mesa_de_centro9.jpg'),
(70, 'Mesa de centro 10', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/mesa_de_centro10.jpg'),
(71, 'Puff 1', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/puff1.jpg'),
(72, 'Puff 2', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/puff2.jpg'),
(73, 'Puff 3', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/puff3.jpg'),
(74, 'Puff 4', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/puff4.jpg'),
(75, 'Puff 5', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/puff5.jpg'),
(76, 'Puff 6', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/puff6.jpg'),
(77, 'Puff 7', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/puff7.jpg'),
(78, 'Puff 8', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/puff8.jpg'),
(79, 'Puff 9', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/puff9.jpg'),
(80, 'Puff 10', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/puff10.jpg'),
(81, 'Sofá 1', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/sofa1.jpg'),
(82, 'Sofá 2', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/sofa2.jpg'),
(83, 'Sofá 3', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/sofa3.jpg'),
(84, 'Sofá 4', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/sofa4.jpg'),
(85, 'Sofá 5', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/sofa5.jpg'),
(86, 'Sofá 6', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/sofa6.jpg'),
(87, 'Sofá 7', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/sofa7.jpg'),
(88, 'Sofá 8', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/sofa8.jpg'),
(89, 'Sofá 9', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/sofa9.jpg'),
(90, 'Sofá 10', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/sofa10.jpg'),
(91, 'Tendido 1', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/tendido1.jpg'),
(92, 'Tendido 2', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/tendido2.jpg'),
(93, 'Tendido 3', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/tendido3.jpg'),
(94, 'Tendido 4', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/tendido4.jpg'),
(95, 'Tendido 5', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/tendido5.jpg'),
(96, 'Tendido 6', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/tendido6.jpg'),
(97, 'Tendido 7', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/tendido7.jpg'),
(98, 'Tendido 8', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/tendido8.jpg'),
(99, 'Tendido 9', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/tendido9.jpg'),
(100, 'Tendido 10', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/tendido10.jpg'),
(101, 'Tocador 1', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/tocador1.jpg'),
(102, 'Tocador 2', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/tocador2.jpg'),
(103, 'Tocador 3', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/tocador3.jpg'),
(104, 'Tocador 4', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/tocador4.jpg'),
(105, 'Tocador 5', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/tocador5.jpg'),
(106, 'Tocador 6', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/tocador6.jpg'),
(107, 'Tocador 7', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/tocador7.jpg'),
(108, 'Tocador 8', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/tocador8.jpg'),
(109, 'Tocador 9', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/tocador9.jpg'),
(110, 'Tocador 10', 'En madera de gran calidad y hermoso diseño.', 134980.00, 20, '../vista/img/tocador10.jpg'),
(111, 'Silla de Oficina TUKASA 5938L Negra', 'Renueva tus espacios de trabajo y/o estudio con los diseños modernos que TUKASA te puede proporcionar. La SILLA DE OFICINA TUKASA se convierte en un elemento indispensable para tu comodidad, su diseño dinámico combina perfectamente los materiales, confort , comodidad y estilo, cuenta con excelente soporte en los rodachines dándole gran estabilidad. ¡Anímate y cómprala ya!', 319900.00, 5, '../vista/img/1754617067_sillanueva10.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla roles
--

CREATE TABLE roles (
  id_rol int(11) NOT NULL,
  cargo varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla roles
--

INSERT INTO roles (id_rol, cargo) VALUES
(1, 'Administrador'),
(2, 'Jefe de bodega'),
(3, 'Cliente'),
(4, 'Vendedor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla usuarios
--

CREATE TABLE usuarios (
  id_usuario int(11) NOT NULL,
  nombre varchar(100) NOT NULL,
  correo varchar(100) NOT NULL,
  contrasena varchar(255) NOT NULL,
  id_rol int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla usuarios
--

INSERT INTO usuarios (id_usuario, nombre, correo, contrasena, id_rol) VALUES
(4, 'asasas', 'asas@asas.com', '$2y$10$Mytznga4jCpYkXM3venLdO0gGLNnSSsaB5q8mhBSBIkuGVCGOCgsy', 3),
(5, 'migel angel astaytsyat', 'gggagsgagsfat@asas.com', '$2y$10$BlrjW82yRS4DGdHhoCcIYuV0yFczchOoVPiCW4pbB2q46IqbNPP92', 3),
(16, 'charles', 'charles.pinto@gmail.com', '0123456789', 3),
(19, 'karen Daniela', 'karen0826dani@outlook.com', '123456789', 3),
(20, 'laura marcela', 'luaralopez@hotmail.com', '123456789', 3),
(28, 'juan pelaez', 'juanpelaez@gmail.com', '123456', 3),
(44, 'pepito ', 'pepito.perez@gmail.com', '123456789', 3),
(50, 'SARAY JULIANA LEON GARZON', 'sarayleon@gmail.com', '$2y$10$8.EgMR2gLcfOPJmS3MCdouIQt/GAJs6rSOytoJ9M.67ARMw2vb0Za', 3),
(51, 'SIMON LEONARDO LEÓN GUTIERREZ', 'andresleonardo2417@gmail.com', '$2y$10$huOMpjzDA9boBWA51fV.SO5N8wPxDV9.sG8BhdDPNOG0E9S5qMUQ2', 1),
(52, 'KARINA GARZON', 'karinagarzon@gmail.com', '$2y$10$vPQ.FFkfdUV1twSM7GrFC.iGXjcMqJ4BIpRxRchnhtlbJwpmZZiYy', 1),
(53, 'ANDRES FABIAN  LEÓN GUTIERREZ', 'leonardo17@gmail.com', '$2y$10$roiU8ZjQgo3TOtBsFrDTyO7Z111kg.ztUXRP2rZK7xZAvrgUG5fAe', 3),
(55, 'LEONARDO admin 2jack', 'andressuma@gmail.com', '$2y$10$1RbK38nMhUAKHt0mOz3CE.k8fBeXaUghIzyzAeeLj41zvFC6sW/.6', 1),
(56, 'LEONARDO GUTIERREZ CTE', 'leonardo808161@gmail.com', '$2y$10$mpXKwPQpehRmD0WuQoMHs.T.Cl8QK8Yc4l4Y87n6oydk.Arujxyqy', 3),
(57, 'SOFIA BERGARA', 'Sofi1979@gmail.com', '$2y$10$1ixTPBJsMbeWPVPt49UuLOz5n/g7yFbLGD6e4QSbpx6QuRwdImH6.', 3),
(59, 'PANCHO MONTE ALEGRE', 'pancho@gmail.com', '$2y$10$25zZpXAfvWENjhH1tQ.LG.QzLdNnq9TND.rn7zCf6.UAFYruDlra6', 3),
(60, 'JUAN  PÉREZ', 'cliente1@correo.com', '$2y$10$Mytznga4jCpYkXM3venLdO0gGLNnSSsaB5q8mhBSBIkuGVCGOCgsy', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla carrito
--
ALTER TABLE carrito
  ADD PRIMARY KEY (id),
  ADD KEY usuario_id (usuario_id),
  ADD KEY producto_id (producto_id);

--
-- Indices de la tabla contactos
--
ALTER TABLE contactos
  ADD PRIMARY KEY (id);

--
-- Indices de la tabla detalle_factura
--
ALTER TABLE detalle_factura
  ADD PRIMARY KEY (id),
  ADD KEY dff1_ibfk_1 (usuario_id),
  ADD KEY ddf2_ibfk_2 (producto_id);

--
-- Indices de la tabla envios
--
ALTER TABLE envios
  ADD PRIMARY KEY (id_envio);

--
-- Indices de la tabla factura
--
ALTER TABLE factura
  ADD PRIMARY KEY (id),
  ADD KEY usuario_id (usuario_id);

--
-- Indices de la tabla productos
--
ALTER TABLE productos
  ADD PRIMARY KEY (id_producto);

--
-- Indices de la tabla roles
--
ALTER TABLE roles
  ADD PRIMARY KEY (id_rol);

--
-- Indices de la tabla usuarios
--
ALTER TABLE usuarios
  ADD PRIMARY KEY (id_usuario),
  ADD UNIQUE KEY correo (correo),
  ADD KEY id_rol (id_rol);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla carrito
--
ALTER TABLE carrito
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT de la tabla contactos
--
ALTER TABLE contactos
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla detalle_factura
--
ALTER TABLE detalle_factura
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT de la tabla envios
--
ALTER TABLE envios
  MODIFY id_envio int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla factura
--
ALTER TABLE factura
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla productos
--
ALTER TABLE productos
  MODIFY id_producto int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT de la tabla roles
--
ALTER TABLE roles
  MODIFY id_rol int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla usuarios
--
ALTER TABLE usuarios
  MODIFY id_usuario int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla carrito
--
ALTER TABLE carrito
  ADD CONSTRAINT carrito_ibfk_1 FOREIGN KEY (usuario_id) REFERENCES usuarios (id_usuario),
  ADD CONSTRAINT carrito_ibfk_2 FOREIGN KEY (producto_id) REFERENCES productos (id_producto);

--
-- Filtros para la tabla detalle_factura
--
ALTER TABLE detalle_factura
  ADD CONSTRAINT ddf2_ibfk_2 FOREIGN KEY (producto_id) REFERENCES productos (id_producto),
  ADD CONSTRAINT dff1_ibfk_1 FOREIGN KEY (usuario_id) REFERENCES usuarios (id_usuario);

--
-- Filtros para la tabla usuarios
--
ALTER TABLE usuarios
  ADD CONSTRAINT usuarios_ibfk_1 FOREIGN KEY (id_rol) REFERENCES roles (id_rol);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
