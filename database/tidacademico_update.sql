-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-01-2024 a las 23:43:31
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tid`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activiti`
--

CREATE TABLE `activiti` (
  `idactiviti` int(11) NOT NULL,
  `yearId_act` int(11) NOT NULL,
  `curso_act` int(11) NOT NULL,
  `fechaCreatd` date NOT NULL,
  `status` enum('ACTIVO','INACTIVO') NOT NULL,
  `ordeperiodoTipo` int(11) DEFAULT NULL,
  `tipo_evalu` int(11) DEFAULT NULL,
  `User_sesion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activ_curso`
--

CREATE TABLE `activ_curso` (
  `actcur_id` int(11) NOT NULL,
  `activ_Id` int(11) NOT NULL,
  `actividades` varchar(255) NOT NULL,
  `puntajes` int(11) NOT NULL,
  `cursoid` int(11) NOT NULL,
  `fechaCreatd` date NOT NULL,
  `ordenTipoeva` int(11) DEFAULT NULL,
  `evalu_tipo` varchar(255) DEFAULT NULL,
  `User_sesscion` int(11) DEFAULT NULL,
  `yearId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE `alumno` (
  `idalumno` int(11) NOT NULL,
  `apellidos` varchar(45) DEFAULT NULL,
  `alumnonombre` varchar(45) DEFAULT NULL,
  `dni` int(11) DEFAULT NULL,
  `telefono` int(11) DEFAULT NULL,
  `codigo` int(11) DEFAULT NULL,
  `sexo` char(1) DEFAULT NULL,
  `fnacimiento` date DEFAULT NULL,
  `stadoalumno` enum('ACTIVO','INACTIVO') NOT NULL,
  `fechaRegisto` date DEFAULT NULL,
  `fechaUpdate` date DEFAULT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `rolalumno` int(11) NOT NULL,
  `alumno_foto` text DEFAULT NULL,
  `bajaAlumn` enum('1','0') NOT NULL,
  `fk_ubigeo` varchar(255) DEFAULT NULL,
  `fk_docu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`idalumno`, `apellidos`, `alumnonombre`, `dni`, `telefono`, `codigo`, `sexo`, `fnacimiento`, `stadoalumno`, `fechaRegisto`, `fechaUpdate`, `direccion`, `rolalumno`, `alumno_foto`, `bajaAlumn`, `fk_ubigeo`, `fk_docu`) VALUES
(64, 'Vasquez Huaranga', 'Harvey Yerik', 77330159, 967523180, 12001, 'M', '2005-07-05', 'ACTIVO', '2024-01-08', '2024-01-08', 'S/D4465', 3, 'images.png', '0', '010101', 1),
(65, 'Vasquez Huaranga', 'Harvey Yerik', 77330152, 967523180, 12001, 'M', '2005-09-05', 'ACTIVO', '2024-01-08', '2024-01-08', 'S/D4465', 3, '1704723004_8108.jpg', '0', '010101', 1),
(66, 'Vasquez Huaranga', 'Harvey Yerik', 77330151, 123456789, 12001, 'M', '2005-05-08', 'ACTIVO', '2024-01-08', '2024-01-08', 'S/D4465', 3, '1704723238_1698.jpg', '1', '010101', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apoderados`
--

CREATE TABLE `apoderados` (
  `idApoderado` int(11) NOT NULL,
  `paderNombre` varchar(45) DEFAULT NULL,
  `PadreApellidos` varchar(45) DEFAULT NULL,
  `padreDni` varchar(45) DEFAULT NULL,
  `madreNombres` varchar(45) DEFAULT NULL,
  `madreApellidos` varchar(45) DEFAULT NULL,
  `madreDni` varchar(45) DEFAULT NULL,
  `cole_procedente` varchar(45) DEFAULT NULL,
  `coleUbicacion` varchar(45) DEFAULT NULL,
  `coleCodigo` int(11) DEFAULT NULL,
  `dateCreat` date DEFAULT NULL,
  `dateUpdate` date DEFAULT NULL,
  `id_Alumn` int(11) DEFAULT NULL,
  `fk_ubigeo` varchar(255) DEFAULT NULL,
  `fk_docu` int(11) DEFAULT NULL,
  `fk_docu_padre` int(11) DEFAULT NULL,
  `fk_ubigeo_padre` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `apoderados`
--

INSERT INTO `apoderados` (`idApoderado`, `paderNombre`, `PadreApellidos`, `padreDni`, `madreNombres`, `madreApellidos`, `madreDni`, `cole_procedente`, `coleUbicacion`, `coleCodigo`, `dateCreat`, `dateUpdate`, `id_Alumn`, `fk_ubigeo`, `fk_docu`, `fk_docu_padre`, `fk_ubigeo_padre`) VALUES
(15, '', '', '', '', '', '', '', '', 0, '2024-01-08', '2024-01-08', 64, '010101', 1, 1, '010101'),
(16, '', '', '', '', '', '', '', '', 0, '2024-01-08', '2024-01-08', 65, '010101', 1, 1, '010101'),
(17, '', '', '', '', '', '', '', '', 0, '2024-01-08', '2024-01-08', 66, '010101', 1, 1, '010101');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `IdAsisten` int(10) UNSIGNED NOT NULL,
  `idalumno_asi` int(11) NOT NULL,
  `Fechas` date NOT NULL,
  `Est_Asis` tinyint(1) NOT NULL,
  `idgrado` int(11) DEFAULT NULL,
  `idnivel` int(11) DEFAULT NULL,
  `idseccion` varchar(10) DEFAULT NULL,
  `yearid` int(11) DEFAULT NULL,
  `userSesion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aula`
--

CREATE TABLE `aula` (
  `idaula` int(11) NOT NULL,
  `nombreaula` varchar(45) NOT NULL,
  `piso` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `aforro` int(11) NOT NULL,
  `status` enum('LIBRE','OCUPADO') DEFAULT NULL,
  `dateCreat` date NOT NULL,
  `dateUpdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `aula`
--

INSERT INTO `aula` (`idaula`, `nombreaula`, `piso`, `numero`, `aforro`, `status`, `dateCreat`, `dateUpdate`) VALUES
(25, 'PRIMER GRADO A', 1, 101, 35, 'OCUPADO', '2023-12-28', '2023-12-28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `privado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `descripcion`, `privado`) VALUES
(2, 'Comunicados', 'Aquí van los comunicados', 1),
(3, 'Noticias', 'Aquí van las noticias', 0),
(4, 'Eventos', 'Aquí van los eventos', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_curso`
--

CREATE TABLE `categoria_curso` (
  `id` int(11) NOT NULL,
  `nombrecat` varchar(255) DEFAULT NULL,
  `fechaRegistro` date DEFAULT NULL,
  `fechaActualizacion` date DEFAULT NULL,
  `categoriaCodigo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria_curso`
--

INSERT INTO `categoria_curso` (`id`, `nombrecat`, `fechaRegistro`, `fechaActualizacion`, `categoriaCodigo`) VALUES
(1, 'Matematica', '2023-12-30', '2023-12-30', '100');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colegio`
--

CREATE TABLE `colegio` (
  `idColegio` int(11) NOT NULL,
  `nameColegio` varchar(255) DEFAULT NULL,
  `telefColegio` int(11) DEFAULT NULL,
  `emailColegio` varchar(45) DEFAULT NULL,
  `ubicacion` varchar(45) DEFAULT NULL,
  `logoColegio` text DEFAULT NULL,
  `escudoPais` text DEFAULT NULL,
  `bannerColegio` text DEFAULT NULL,
  `idiomaColegio` varchar(45) DEFAULT NULL,
  `colorSidebar` varchar(45) DEFAULT NULL,
  `colorHeader` varchar(45) DEFAULT NULL,
  `yearCeation` date DEFAULT NULL,
  `descrition` text DEFAULT NULL,
  `ugel` varchar(45) DEFAULT NULL,
  `dateCreate` date DEFAULT NULL,
  `dateUpdate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `colegio`
--

INSERT INTO `colegio` (`idColegio`, `nameColegio`, `telefColegio`, `emailColegio`, `ubicacion`, `logoColegio`, `escudoPais`, `bannerColegio`, `idiomaColegio`, `colorSidebar`, `colorHeader`, `yearCeation`, `descrition`, `ugel`, `dateCreate`, `dateUpdate`) VALUES
(1, 'ORION', 967523180, 'orion@gmail.com', 'TARMA - PERU', 'LOGOIMG122023135412.jpg', 'PAISIMG122023135412.jpg', 'BANNIMG122023135412.jpg', NULL, NULL, NULL, NULL, NULL, 'TARMA', '2023-02-01', '2023-12-28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `criterio`
--

CREATE TABLE `criterio` (
  `idboletNota` int(11) NOT NULL,
  `criteriosEvaluacion` text NOT NULL,
  `curso_id` int(11) NOT NULL,
  `grado_id` int(11) NOT NULL,
  `yearEscolar_id` int(11) NOT NULL,
  `idnivel` int(11) DEFAULT NULL,
  `fechRegistro` date NOT NULL,
  `userSession` int(11) DEFAULT NULL,
  `fechaUpdate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

CREATE TABLE `curso` (
  `idcurso` int(11) NOT NULL,
  `cursoCodigo` varchar(8) DEFAULT NULL,
  `nonbrecurso` varchar(45) NOT NULL,
  `statuscurso` enum('LIBRE','ASIGNADO') NOT NULL,
  `fechaRegistro` datetime DEFAULT NULL,
  `fechaActualizacion` datetime DEFAULT NULL,
  `tipo` enum('SEMESTRAL','TRIMESTRAL','BIMESTRAL','ELECTIVO','ESTANDAR') NOT NULL,
  `fk_categoria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `curso`
--

INSERT INTO `curso` (`idcurso`, `cursoCodigo`, `nonbrecurso`, `statuscurso`, `fechaRegistro`, `fechaActualizacion`, `tipo`, `fk_categoria`) VALUES
(77, 'A001-2', 'FISICA III', 'LIBRE', '2023-12-30 16:02:24', '2023-12-30 16:02:55', 'BIMESTRAL', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes`
--

CREATE TABLE `docentes` (
  `id_docente` int(11) NOT NULL,
  `nombres` varchar(45) NOT NULL,
  `apellidos` varchar(45) DEFAULT NULL,
  `dni` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `codigo` varchar(45) DEFAULT NULL,
  `rolDocente` int(11) DEFAULT NULL,
  `nivelId` int(11) DEFAULT NULL,
  `tipo_docente` enum('CONTRATADO','NOMBRADO') DEFAULT NULL,
  `estado_baja` enum('1','0') NOT NULL,
  `createDate` date DEFAULT NULL,
  `updateDate` date DEFAULT NULL,
  `userSession` int(11) DEFAULT NULL,
  `fk_ubigeo` varchar(255) DEFAULT NULL,
  `fk_docu` int(11) DEFAULT NULL,
  `docente_foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `docentes`
--

INSERT INTO `docentes` (`id_docente`, `nombres`, `apellidos`, `dni`, `email`, `telefono`, `codigo`, `rolDocente`, `nivelId`, `tipo_docente`, `estado_baja`, `createDate`, `updateDate`, `userSession`, `fk_ubigeo`, `fk_docu`, `docente_foto`) VALUES
(43, 'HARVEY YERIK', 'HUAMAN', '77330150', 'yerik05vh@gmail.com', '+51967523180', '12002', 2, 1, 'CONTRATADO', '1', '2024-01-08', NULL, NULL, '010101', 1, 'images.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docente_curso`
--

CREATE TABLE `docente_curso` (
  `iddocenteCurso` int(11) NOT NULL,
  `idDocente` int(11) DEFAULT NULL,
  `idGrado` int(11) DEFAULT NULL,
  `idCursos` int(11) DEFAULT NULL,
  `idyear` int(11) DEFAULT NULL,
  `Seccion` varchar(25) DEFAULT NULL,
  `idSession` int(11) DEFAULT NULL,
  `createDate` date DEFAULT NULL,
  `updateDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docente_grados`
--

CREATE TABLE `docente_grados` (
  `iddocentGrados` int(11) NOT NULL,
  `docenteId` int(11) DEFAULT NULL,
  `gradoId` int(11) DEFAULT NULL,
  `nivelgradiId` int(11) DEFAULT NULL,
  `idseccion` varchar(45) DEFAULT NULL,
  `yearId` int(11) DEFAULT NULL,
  `sesionId` int(11) DEFAULT NULL,
  `createDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `faseescolar`
--

CREATE TABLE `faseescolar` (
  `fase_id` int(11) NOT NULL,
  `idyearE` int(11) NOT NULL,
  `fase_nombre` varchar(45) DEFAULT NULL,
  `FechaInicial` date DEFAULT NULL,
  `FechaFinal` date DEFAULT NULL,
  `stdfase` enum('ACTIVO','INACTIVO') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grado`
--

CREATE TABLE `grado` (
  `idgrado` int(11) NOT NULL,
  `gradonombre` varchar(45) NOT NULL,
  `aula_id` int(11) NOT NULL,
  `turno_id` int(11) NOT NULL,
  `nivel_id` int(11) DEFAULT NULL,
  `vacantes` int(11) DEFAULT NULL,
  `seccion` varchar(45) DEFAULT NULL,
  `fechaRegistro` datetime DEFAULT NULL,
  `fechaActualizacion` datetime DEFAULT NULL,
  `gradostatus` enum('ACTIVO','INACTIVO') DEFAULT NULL,
  `year_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `grado`
--

INSERT INTO `grado` (`idgrado`, `gradonombre`, `aula_id`, `turno_id`, `nivel_id`, `vacantes`, `seccion`, `fechaRegistro`, `fechaActualizacion`, `gradostatus`, `year_id`) VALUES
(12, 'PRIMER GRADO A', 25, 1, 1, 35, 'A', '2023-12-28 22:56:09', '2023-12-28 22:56:09', 'ACTIVO', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grado_curso`
--

CREATE TABLE `grado_curso` (
  `idgrado_curso` int(11) NOT NULL,
  `grado_id` int(11) NOT NULL,
  `curso_id` int(11) NOT NULL,
  `yearEscolar` int(11) NOT NULL,
  `Idseccion` varchar(45) DEFAULT NULL,
  `dateRegistro` date DEFAULT NULL,
  `dateUpdate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario25`
--

CREATE TABLE `horario25` (
  `idhorario` int(11) NOT NULL,
  `gradoId` int(11) DEFAULT NULL,
  `turnoId` int(11) DEFAULT NULL,
  `nivelId` int(11) DEFAULT NULL,
  `seccionId` varchar(45) DEFAULT NULL,
  `jornadId` int(11) DEFAULT NULL,
  `yearId` int(11) DEFAULT NULL,
  `aula_id` int(11) DEFAULT NULL,
  `datecreat` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario_curso`
--

CREATE TABLE `horario_curso` (
  `cursohoraId` int(11) NOT NULL,
  `idtd` int(11) NOT NULL,
  `idhora` int(11) NOT NULL,
  `idcurso` int(11) NOT NULL,
  `dia` int(11) NOT NULL,
  `gradoid` int(11) NOT NULL,
  `turnoId` int(11) DEFAULT NULL,
  `nivelId` int(11) DEFAULT NULL,
  `seccionId` varchar(45) DEFAULT NULL,
  `idjornada` int(11) DEFAULT NULL,
  `idyear` int(11) DEFAULT NULL,
  `FechRegistro` datetime DEFAULT NULL,
  `statushorario` enum('ACTIVO','INACTIVO') NOT NULL,
  `idhoraio` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jornadas`
--

CREATE TABLE `jornadas` (
  `IdJornas` int(11) NOT NULL,
  `IdJornYear` int(11) NOT NULL,
  `tunoid` int(11) NOT NULL,
  `gradoid` int(11) NOT NULL,
  `nivelGrado` int(11) DEFAULT NULL,
  `seccionjor` varchar(45) DEFAULT NULL,
  `idAula` int(11) DEFAULT NULL,
  `Horainicio` time NOT NULL,
  `horafinal` time NOT NULL,
  `createDate` date NOT NULL,
  `status` enum('ACTIVO','INACTIVO') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `jornadas`
--

INSERT INTO `jornadas` (`IdJornas`, `IdJornYear`, `tunoid`, `gradoid`, `nivelGrado`, `seccionjor`, `idAula`, `Horainicio`, `horafinal`, `createDate`, `status`) VALUES
(3, 4, 1, 12, 1, 'A', 25, '08:00:00', '13:29:00', '2023-12-28', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jornas_horas`
--

CREATE TABLE `jornas_horas` (
  `HorJor_id` int(11) NOT NULL,
  `jorna_ID` int(11) NOT NULL,
  `Hora_inicio` time NOT NULL,
  `hora_final` time NOT NULL,
  `createDate` date NOT NULL,
  `gradoId` int(11) DEFAULT NULL,
  `yearId` int(11) DEFAULT NULL,
  `nivelGrado_id` int(11) DEFAULT NULL,
  `seccionHor` varchar(45) DEFAULT NULL,
  `turnoId` int(11) DEFAULT NULL,
  `aulaId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `jornas_horas`
--

INSERT INTO `jornas_horas` (`HorJor_id`, `jorna_ID`, `Hora_inicio`, `hora_final`, `createDate`, `gradoId`, `yearId`, `nivelGrado_id`, `seccionHor`, `turnoId`, `aulaId`) VALUES
(9, 3, '08:00:00', '10:31:00', '2023-12-28', 12, 4, 1, 'A', 1, 25),
(10, 3, '10:31:00', '13:29:00', '2023-12-28', 12, 4, 1, 'A', 1, 25);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libretanotas`
--

CREATE TABLE `libretanotas` (
  `idLibretaNotas` int(11) NOT NULL,
  `idalumno` int(11) DEFAULT NULL,
  `id_curso` int(11) DEFAULT NULL,
  `di_year` int(11) DEFAULT NULL,
  `calificacions` int(11) DEFAULT NULL,
  `id_Criterio` int(11) DEFAULT NULL,
  `gradoId` int(11) DEFAULT NULL,
  `niveiId` int(11) DEFAULT NULL,
  `tipoEva` int(11) DEFAULT NULL,
  `creteDte` date DEFAULT NULL,
  `userSession` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matricula`
--

CREATE TABLE `matricula` (
  `idmatricula` int(11) NOT NULL,
  `Id_alumno` int(11) NOT NULL,
  `Id_grado` int(11) NOT NULL,
  `Id_aula` int(11) NOT NULL,
  `Id_turno` int(11) NOT NULL,
  `Id_nivls` int(11) NOT NULL,
  `cargoPago` enum('NO','SI') DEFAULT NULL,
  `year_id` int(11) NOT NULL,
  `seccion` varchar(45) DEFAULT NULL,
  `cargoMatricula` double DEFAULT NULL,
  `creatDate` date DEFAULT NULL,
  `updateDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `niveles`
--

CREATE TABLE `niveles` (
  `idniveles` int(11) NOT NULL,
  `nombreNivell` varchar(45) NOT NULL,
  `yearNivel` int(11) DEFAULT NULL,
  `createDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `niveles`
--

INSERT INTO `niveles` (`idniveles`, `nombreNivell`, `yearNivel`, `createDate`) VALUES
(1, 'PRIMARIA', 1, '2022-11-06'),
(2, 'SECUNDARIA', 1, '2022-11-06'),
(3, 'SUPERIOR', 1, '2022-11-06'),
(4, 'INICIAL', 1, '2022-11-06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas`
--

CREATE TABLE `notas` (
  `idnotas` int(11) NOT NULL,
  `gradoid` int(11) NOT NULL,
  `cursoid` int(11) NOT NULL,
  `alumnoid` int(11) NOT NULL,
  `seccionid` varchar(45) NOT NULL,
  `cargaacadId` int(11) DEFAULT NULL,
  `ordentipo` int(11) DEFAULT NULL,
  `tipoevaluacionid` int(11) NOT NULL,
  `nota_alum` decimal(10,2) NOT NULL,
  `idnivel` int(11) DEFAULT NULL,
  `yearid` int(11) DEFAULT NULL,
  `usersession` int(11) DEFAULT NULL,
  `createDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notasalfabetico`
--

CREATE TABLE `notasalfabetico` (
  `idLibretaNotas` int(11) NOT NULL,
  `idalumno` int(11) DEFAULT NULL,
  `id_curso` int(11) DEFAULT NULL,
  `di_year` int(11) DEFAULT NULL,
  `calificacions` varchar(3) DEFAULT NULL,
  `id_Criterio` int(11) DEFAULT NULL,
  `gradoId` int(11) DEFAULT NULL,
  `niveiId` int(11) DEFAULT NULL,
  `tipoEva` int(11) DEFAULT NULL,
  `creteDte` date DEFAULT NULL,
  `userSession` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `portada` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `fechaCreacion` datetime NOT NULL,
  `fkCategoria` int(11) NOT NULL,
  `fkUsuario` int(11) NOT NULL,
  `importante` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`id`, `titulo`, `portada`, `descripcion`, `fechaCreacion`, `fkCategoria`, `fkUsuario`, `importante`) VALUES
(5, 'Colegios Orien les desea feliz año nuevo 2024', 'https://colegiosorion.edu.pe//uploads/1703889267_8144.jpeg', '<p>Nuestra plana docente, alumno y todos lo que conformamos la familia del Colegio Orion les desea feliz año 2024</p>', '2023-12-29 22:34:27', 3, 1, 0),
(6, 'Ejemplo de noticia I', 'https://colegiosorion.edu.pe//uploads/1704305269_4380.jpeg', '<p class=\"ql-align-justify\"><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><h2>Why do we use it?</h2><p class=\"ql-align-justify\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p><p><br></p>', '2024-01-03 18:07:49', 4, 1, 0),
(7, 'Prueba numero 1', 'https://colegiosorion.edu.pe//uploads/1704471943_6987.jpeg', '<h2>Where does it come from?</h2><p class=\"ql-align-justify\">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</p><p class=\"ql-align-justify\">The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p><h2>Where can I get some?</h2><p class=\"ql-align-justify\">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p><p>paragraphs</p><p>words</p><p>bytes</p><p>lists</p><p>Start with \'Lorem</p><p>ipsum dolor sit amet...\'</p><p><br></p><p><br></p>', '2024-01-05 16:25:43', 3, 1, 0),
(8, 'PRUBEA NUMERO 3', 'http://192.168.1.5/tid-academicouploads/1704472114_7901.jpeg', '<h2>Where does it come from?</h2><p class=\"ql-align-justify\">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</p><p class=\"ql-align-justify\">The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p><h2>Where can I get some?</h2><p class=\"ql-align-justify\">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p><p>paragraphs</p><p>words</p><p>bytes</p><p>lists</p><p>Start with \'Lorem</p><p>ipsum dolor sit amet...\'</p><p><br></p><p><br></p>', '2024-01-05 17:28:34', 4, 1, 1),
(9, 'Un titutlo genial III', '1704579438_2811.png', '<p><span style=\"background-color: rgba(245, 245, 245, 0.494);\">Tu espacio para dar vida a noticias, eventos y blogs que reflejen el vibrante espíritu de nuestra comunidad educativa. Aquí, puedes compartir logros, experiencias y anuncios importantes de manera sencilla. Solo sigue los pasos intuitivos, agrega imágenes vibrantes y conecta con nuestra audiencia de manera significativa. ¡Haz que cada palabra cuente y celebremos juntos nuestros éxitos! ??Tu espacio para dar vida a noticias, eventos y blogs que reflejen el vibrante espíritu de nuestra comunidad educativa. Aquí, puedes compartir logros, experiencias y anuncios importantes de manera sencilla. Solo sigue los pasos intuitivos, agrega imágenes vibrantes y conecta con nuestra audiencia de manera significativa. ¡Haz que cada palabra cuente y celebremos juntos nuestros éxitos! ??</span></p>', '2024-01-06 23:17:18', 3, 1, 1),
(10, 'Inglés  loopstudios-landing-page with React and CSS', '1704579508_5699.png', '<p><span style=\"background-color: rgba(245, 245, 245, 0.494);\">Tu espacio para dar vida a noticias, eventos y blogs que reflejen el vibrante espíritu de nuestra comunidad educativa. Aquí, puedes compartir logros, experiencias y anuncios importantes de manera sencilla. Solo sigue los pasos intuitivos, agrega imágenes vibrantes y conecta con nuestra audiencia de manera significativa. ¡Haz que cada palabra cuente y celebremos juntos nuestros éxitos! ??Tu espacio para dar vida a noticias, eventos y blogs que reflejen el vibrante espíritu de nuestra comunidad educativa. Aquí, puedes compartir logros, experiencias y anuncios importantes de manera sencilla. Solo sigue los pasos intuitivos, agrega imágenes vibrantes y conecta con nuestra audiencia de manera significativa. ¡Haz que cada palabra cuente y celebremos juntos nuestros éxitos! ??</span></p>', '2024-01-06 23:18:28', 3, 1, 1),
(11, 'PRUEBA 8', '1704579595_8921.png', '<p><span style=\"background-color: rgba(245, 245, 245, 0.494);\">Tu espacio para dar vida a noticias, eventos y blogs que reflejen el vibrante espíritu de nuestra comunidad educativa. Aquí, puedes compartir logros, experiencias y anuncios importantes de manera sencilla. Solo sigue los pasos intuitivos, agrega imágenes vibrantes y conecta con nuestra audiencia de manera significativa. ¡Haz que cada palabra cuente y celebremos juntos nuestros éxitos! ??Tu espacio para dar vida a noticias, eventos y blogs que reflejen el vibrante espíritu de nuestra comunidad educativa. Aquí, puedes compartir logros, experiencias y anuncios importantes de manera sencilla. Solo sigue los pasos intuitivos, agrega imágenes vibrantes y conecta con nuestra audiencia de manera significativa. ¡Haz que cada palabra cuente y celebremos juntos nuestros éxitos! ??</span></p>', '2024-01-06 23:19:55', 3, 1, 0),
(12, 'fdsadfsafdasfdsa', '1704579679_4860.jpg', '<p><span style=\"background-color: rgba(245, 245, 245, 0.494);\">Tu espacio para dar vida a noticias, eventos y blogs que reflejen el vibrante espíritu de nuestra comunidad educativa. Aquí, puedes compartir logros, experiencias y anuncios importantes de manera sencilla. Solo sigue los pasos intuitivos, agrega imágenes vibrantes y conecta con nuestra audiencia de manera significativa. ¡Haz que cada palabra cuente y celebremos juntos nuestros éxitos! ??Tu espacio para dar vida a noticias, eventos y blogs que reflejen el vibrante espíritu de nuestra comunidad educativa. Aquí, puedes compartir logros, experiencias y anuncios importantes de manera sencilla. Solo sigue los pasos intuitivos, agrega imágenes vibrantes y conecta con nuestra audiencia de manera significativa. ¡Haz que cada palabra cuente y celebremos juntos nuestros éxitos! ??</span></p>', '2024-01-06 23:21:19', 3, 1, 1),
(13, 'fdasfdsasdfa', '1704579846_8122.png', '<p><span style=\"background-color: rgba(245, 245, 245, 0.494);\">Tu espacio para dar vida a noticias, eventos y blogs que reflejen el vibrante espíritu de nuestra comunidad educativa. Aquí, puedes compartir logros, experiencias y anuncios importantes de manera sencilla. Solo sigue los pasos intuitivos, agrega imágenes vibrantes y conecta con nuestra audiencia de manera significativa. ¡Haz que cada palabra cuente y celebremos juntos nuestros éxitos! ??</span></p>', '2024-01-06 23:24:06', 3, 1, 1),
(14, 'fsdafdsafdsa', '1704579991_2204.jpg', '<p>fdasdfsafdsafdasfdsafdasfdsafasdoiosdfajofdsajiofdajofjdasfjdasklfjdasko<span style=\"background-color: rgba(245, 245, 245, 0.494);\">Tu espacio para dar vida a noticias, eventos y blogs que reflejen el vibrante espíritu de nuestra comunidad educativa. Aquí, puedes compartir logros, experiencias y anuncios importantes de manera sencilla. Solo sigue los pasos intuitivos, agrega imágenes vibrantes y conecta con nuestra audiencia de manera significativa. ¡Haz que cada palabra cuente y celebremos juntos nuestros éxitos! ??Tu espacio para dar vida a noticias, eventos y blogs que reflejen el vibrante espíritu de nuestra comunidad educativa. Aquí, puedes compartir logros, experiencias y anuncios importantes de manera sencilla. Solo sigue los pasos intuitivos, agrega imágenes vibrantes y conecta con nuestra audiencia de manera significativa. ¡Haz que cada palabra cuente y celebremos juntos nuestros éxitos! ??Tu espacio para dar vida a noticias, eventos y blogs que reflejen el vibrante espíritu de nuestra comunidad educativa. Aquí, puedes compartir logros, experiencias y anuncios importantes de manera sencilla. Solo sigue los pasos intuitivos, agrega imágenes vibrantes y conecta con nuestra audiencia de manera significativa. ¡Haz que cada palabra cuente y celebremos juntos nuestros éxitos! ??</span>jfdksfds</p>', '2024-01-06 23:26:31', 3, 1, 0),
(15, 'fsdafdsafdsa', '1704579999_1127.jpg', '<p>fdasdfsafdsafdasfdsafdasfdsafasdoiosdfajofdsajiofdajofjdasfjdasklfjdasko<span style=\"background-color: rgba(245, 245, 245, 0.494);\">Tu espacio para dar vida a noticias, eventos y blogs que reflejen el vibrante espíritu de nuestra comunidad educativa. Aquí, puedes compartir logros, experiencias y anuncios importantes de manera sencilla. Solo sigue los pasos intuitivos, agrega imágenes vibrantes y conecta con nuestra audiencia de manera significativa. ¡Haz que cada palabra cuente y celebremos juntos nuestros éxitos! ??Tu espacio para dar vida a noticias, eventos y blogs que reflejen el vibrante espíritu de nuestra comunidad educativa. Aquí, puedes compartir logros, experiencias y anuncios importantes de manera sencilla. Solo sigue los pasos intuitivos, agrega imágenes vibrantes y conecta con nuestra audiencia de manera significativa. ¡Haz que cada palabra cuente y celebremos juntos nuestros éxitos! ??Tu espacio para dar vida a noticias, eventos y blogs que reflejen el vibrante espíritu de nuestra comunidad educativa. Aquí, puedes compartir logros, experiencias y anuncios importantes de manera sencilla. Solo sigue los pasos intuitivos, agrega imágenes vibrantes y conecta con nuestra audiencia de manera significativa. ¡Haz que cada palabra cuente y celebremos juntos nuestros éxitos! ??</span>jfdksfds</p>', '2024-01-06 23:26:39', 3, 1, 0),
(16, 'fsdafdsafdsa', '1704580003_5330.jpg', '<p>fdasdfsafdsafdasfdsafdasfdsafasdoiosdfajofdsajiofdajofjdasfjdasklfjdasko<span style=\"background-color: rgba(245, 245, 245, 0.494);\">Tu espacio para dar vida a noticias, eventos y blogs que reflejen el vibrante espíritu de nuestra comunidad educativa. Aquí, puedes compartir logros, experiencias y anuncios importantes de manera sencilla. Solo sigue los pasos intuitivos, agrega imágenes vibrantes y conecta con nuestra audiencia de manera significativa. ¡Haz que cada palabra cuente y celebremos juntos nuestros éxitos! ??Tu espacio para dar vida a noticias, eventos y blogs que reflejen el vibrante espíritu de nuestra comunidad educativa. Aquí, puedes compartir logros, experiencias y anuncios importantes de manera sencilla. Solo sigue los pasos intuitivos, agrega imágenes vibrantes y conecta con nuestra audiencia de manera significativa. ¡Haz que cada palabra cuente y celebremos juntos nuestros éxitos! ??Tu espacio para dar vida a noticias, eventos y blogs que reflejen el vibrante espíritu de nuestra comunidad educativa. Aquí, puedes compartir logros, experiencias y anuncios importantes de manera sencilla. Solo sigue los pasos intuitivos, agrega imágenes vibrantes y conecta con nuestra audiencia de manera significativa. ¡Haz que cada palabra cuente y celebremos juntos nuestros éxitos! ??</span>jfdksfds</p>', '2024-01-06 23:26:43', 3, 1, 0),
(17, 'fsdafdsafdsa', '1704580003_3971.jpg', '<p>fdasdfsafdsafdasfdsafdasfdsafasdoiosdfajofdsajiofdajofjdasfjdasklfjdasko<span style=\"background-color: rgba(245, 245, 245, 0.494);\">Tu espacio para dar vida a noticias, eventos y blogs que reflejen el vibrante espíritu de nuestra comunidad educativa. Aquí, puedes compartir logros, experiencias y anuncios importantes de manera sencilla. Solo sigue los pasos intuitivos, agrega imágenes vibrantes y conecta con nuestra audiencia de manera significativa. ¡Haz que cada palabra cuente y celebremos juntos nuestros éxitos! ??Tu espacio para dar vida a noticias, eventos y blogs que reflejen el vibrante espíritu de nuestra comunidad educativa. Aquí, puedes compartir logros, experiencias y anuncios importantes de manera sencilla. Solo sigue los pasos intuitivos, agrega imágenes vibrantes y conecta con nuestra audiencia de manera significativa. ¡Haz que cada palabra cuente y celebremos juntos nuestros éxitos! ??Tu espacio para dar vida a noticias, eventos y blogs que reflejen el vibrante espíritu de nuestra comunidad educativa. Aquí, puedes compartir logros, experiencias y anuncios importantes de manera sencilla. Solo sigue los pasos intuitivos, agrega imágenes vibrantes y conecta con nuestra audiencia de manera significativa. ¡Haz que cada palabra cuente y celebremos juntos nuestros éxitos! ??</span>jfdksfds</p>', '2024-01-06 23:26:43', 3, 1, 0),
(18, 'fsdafdsafdsa', '1704580003_8699.jpg', '<p>fdasdfsafdsafdasfdsafdasfdsafasdoiosdfajofdsajiofdajofjdasfjdasklfjdasko<span style=\"background-color: rgba(245, 245, 245, 0.494);\">Tu espacio para dar vida a noticias, eventos y blogs que reflejen el vibrante espíritu de nuestra comunidad educativa. Aquí, puedes compartir logros, experiencias y anuncios importantes de manera sencilla. Solo sigue los pasos intuitivos, agrega imágenes vibrantes y conecta con nuestra audiencia de manera significativa. ¡Haz que cada palabra cuente y celebremos juntos nuestros éxitos! ??Tu espacio para dar vida a noticias, eventos y blogs que reflejen el vibrante espíritu de nuestra comunidad educativa. Aquí, puedes compartir logros, experiencias y anuncios importantes de manera sencilla. Solo sigue los pasos intuitivos, agrega imágenes vibrantes y conecta con nuestra audiencia de manera significativa. ¡Haz que cada palabra cuente y celebremos juntos nuestros éxitos! ??Tu espacio para dar vida a noticias, eventos y blogs que reflejen el vibrante espíritu de nuestra comunidad educativa. Aquí, puedes compartir logros, experiencias y anuncios importantes de manera sencilla. Solo sigue los pasos intuitivos, agrega imágenes vibrantes y conecta con nuestra audiencia de manera significativa. ¡Haz que cada palabra cuente y celebremos juntos nuestros éxitos! ??</span>jfdksfds</p>', '2024-01-06 23:26:43', 3, 1, 0),
(19, 'fdsafdsasdfa', '1704580068_4375.png', '<p><span style=\"background-color: rgba(245, 245, 245, 0.494);\">Tu espacio para dar vida a noticias, eventos y blogs que reflejen el vibrante espíritu de nuestra comunidad educativa. Aquí, puedes compartir logros, experiencias y anuncios importantes de manera sencilla. Solo sigue los pasos intuitivos, agrega imágenes vibrantes y conecta con nuestra audiencia de manera significativa. ¡Haz que cada palabra cuente y celebremos juntos nuestros éxitos! ??Tu espacio para dar vida a noticias, eventos y blogs que reflejen el vibrante espíritu de nuestra comunidad educativa. Aquí, puedes compartir logros, experiencias y anuncios importantes de manera sencilla. Solo sigue los pasos intuitivos, agrega imágenes vibrantes y conecta con nuestra audiencia de manera significativa. ¡Haz que cada palabra cuente y celebremos juntos nuestros éxitos! ??</span></p>', '2024-01-06 23:27:48', 3, 1, 1),
(20, 'fdsafdsasdfafasdfasdfadfsadfasf', '1704580180_3972.png', '<p><span style=\"background-color: rgba(245, 245, 245, 0.494);\">Tu espacio para dar vida a noticias, eventos y blogs que reflejen el vibrante espíritu de nuestra comunidad educativa. Aquí, puedes compartir logros, experiencias y anuncios importantes de manera sencilla. Solo sigue los pasos intuitivos, agrega imágenes vibrantes y conecta con nuestra audiencia de manera significativa. ¡Haz que cada palabra cuente y celebremos juntos nuestros éxitos! ??Tu espacio para dar vida a noticias, eventos y blogs que reflejen el vibrante espíritu de nuestra comunidad educativa. Aquí, puedes compartir logros, experiencias y anuncios importantes de manera sencilla. Solo sigue los pasos intuitivos, agrega imágenes vibrantes y conecta con nuestra audiencia de manera significativa. ¡Haz que cada palabra cuente y celebremos juntos nuestros éxitos! ??</span></p>', '2024-01-06 23:29:40', 3, 1, 1),
(21, 'TID', '1704580313_6025.jpg', '<p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><br></p>', '2024-01-06 23:31:53', 3, 1, 0),
(22, 'TID', '1704580316_9123.jpg', '<p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><br></p>', '2024-01-06 23:31:56', 3, 1, 0),
(23, 'Inglés  loopstudios-landing-page with React and CSS', '1704580362_2496.jpg', '<p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><br></p>', '2024-01-06 23:32:42', 3, 1, 1),
(24, 'PRUEBA 8', '1704580415_2110.jpg', '<p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><br></p>', '2024-01-06 23:33:35', 4, 1, 0),
(25, 'PRUEBA 8', '1704580422_2344.jpg', '<p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><br></p>', '2024-01-06 23:33:42', 4, 1, 0),
(26, 'PRUEBA 8', '1704580424_5293.jpg', '<p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><br></p>', '2024-01-06 23:33:44', 4, 1, 0),
(27, 'PRUEBA 8', '1704580424_3662.jpg', '<p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><br></p>', '2024-01-06 23:33:44', 4, 1, 0),
(28, 'PRUEBA 8', '1704580424_9350.jpg', '<p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><br></p>', '2024-01-06 23:33:44', 4, 1, 0),
(29, 'PRUEBA 8', '1704580424_8997.jpg', '<p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><br></p>', '2024-01-06 23:33:44', 4, 1, 0),
(30, 'PRUEBA 8', '1704580425_5795.jpg', '<p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><br></p>', '2024-01-06 23:33:45', 4, 1, 0),
(31, 'PRUEBA 8', '1704580425_1868.jpg', '<p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><br></p>', '2024-01-06 23:33:45', 4, 1, 0),
(32, 'PRUEBA 8', '1704580425_3565.jpg', '<p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><br></p>', '2024-01-06 23:33:45', 4, 1, 0),
(33, 'PRUEBA 8', '1704580425_5373.jpg', '<p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><br></p>', '2024-01-06 23:33:45', 4, 1, 0),
(34, 'PRUEBA 8', '1704580426_9590.jpg', '<p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><br></p>', '2024-01-06 23:33:46', 4, 1, 0),
(35, 'PRUEBA 8', '1704580426_1400.jpg', '<p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><br></p>', '2024-01-06 23:33:46', 4, 1, 0);
INSERT INTO `noticias` (`id`, `titulo`, `portada`, `descripcion`, `fechaCreacion`, `fkCategoria`, `fkUsuario`, `importante`) VALUES
(36, 'PRUEBA 8', '1704580426_5596.jpg', '<p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><br></p>', '2024-01-06 23:33:46', 4, 1, 0),
(37, 'PRUEBA 8', '1704580494_7272.png', '<p><strong>&nbsp; &nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(97, 175, 239);\">setAttribute</strong><strong>(</strong><strong style=\"color: rgb(152, 195, 121);\">\"disabled\"</strong><strong>,</strong><strong style=\"color: rgb(152, 195, 121);\">\"true\"</strong><strong>) </strong></p><p>&nbsp; &nbsp; <strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; &nbsp; </strong><strong style=\"color: rgb(97, 175, 239);\">setTimeout</strong><strong>(</strong><strong style=\"color: rgb(198, 120, 221);\">async</strong><strong>() </strong><strong style=\"color: rgb(198, 120, 221);\">=&gt;</strong><strong> {</strong></p><p>&nbsp; &nbsp; &nbsp; <strong style=\"color: rgb(198, 120, 221);\">const</strong><strong> </strong><strong style=\"color: rgb(229, 192, 123);\">res</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(198, 120, 221);\">await</strong><strong> </strong><strong style=\"color: rgb(97, 175, 239);\">fetch</strong><strong>(</strong><strong style=\"color: rgb(229, 192, 123);\">URL</strong><strong>, {</strong></p><p>&nbsp; &nbsp; &nbsp; &nbsp; <strong style=\"color: rgb(224, 108, 117);\">method</strong><strong>: </strong><strong style=\"color: rgb(152, 195, 121);\">\"POST\"</strong><strong>,</strong></p><p>&nbsp; &nbsp; &nbsp; &nbsp; <strong style=\"color: rgb(224, 108, 117);\">body</strong><strong>: </strong><strong style=\"color: rgb(224, 108, 117);\">data</strong></p><p><strong>&nbsp; &nbsp; &nbsp; })</strong></p><p><strong>&nbsp; &nbsp; &nbsp; </strong><strong style=\"color: rgb(198, 120, 221);\">const</strong><strong> </strong><strong style=\"color: rgb(229, 192, 123);\">json</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(198, 120, 221);\">await</strong><strong> </strong><strong style=\"color: rgb(229, 192, 123);\">res</strong><strong>.</strong><strong style=\"color: rgb(97, 175, 239);\">json</strong><strong>()</strong></p><p>&nbsp; &nbsp; &nbsp; <strong style=\"color: rgb(198, 120, 221);\">return</strong><strong> </strong><strong style=\"color: rgb(224, 108, 117);\">json</strong></p><p><strong>&nbsp; &nbsp; &nbsp; </strong></p><p><strong>&nbsp; &nbsp; }, </strong><strong style=\"color: rgb(209, 154, 102);\">5000</strong><strong>);</strong></p><p>&nbsp; &nbsp; <strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(97, 175, 239);\">removeAttribute</strong><strong>(</strong><strong style=\"color: rgb(152, 195, 121);\">\"disabled\"</strong><strong>)</strong></p><p>&nbsp; &nbsp; <strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Publicar\"</strong></p><p><strong>&nbsp; &nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(97, 175, 239);\">setAttribute</strong><strong>(</strong><strong style=\"color: rgb(152, 195, 121);\">\"disabled\"</strong><strong>,</strong><strong style=\"color: rgb(152, 195, 121);\">\"true\"</strong><strong>) </strong></p><p>&nbsp; &nbsp; <strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; &nbsp; </strong><strong style=\"color: rgb(97, 175, 239);\">setTimeout</strong><strong>(</strong><strong style=\"color: rgb(198, 120, 221);\">async</strong><strong>() </strong><strong style=\"color: rgb(198, 120, 221);\">=&gt;</strong><strong> {</strong></p><p>&nbsp; &nbsp; &nbsp; <strong style=\"color: rgb(198, 120, 221);\">const</strong><strong> </strong><strong style=\"color: rgb(229, 192, 123);\">res</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(198, 120, 221);\">await</strong><strong> </strong><strong style=\"color: rgb(97, 175, 239);\">fetch</strong><strong>(</strong><strong style=\"color: rgb(229, 192, 123);\">URL</strong><strong>, {</strong></p><p>&nbsp; &nbsp; &nbsp; &nbsp; <strong style=\"color: rgb(224, 108, 117);\">method</strong><strong>: </strong><strong style=\"color: rgb(152, 195, 121);\">\"POST\"</strong><strong>,</strong></p><p>&nbsp; &nbsp; &nbsp; &nbsp; <strong style=\"color: rgb(224, 108, 117);\">body</strong><strong>: </strong><strong style=\"color: rgb(224, 108, 117);\">data</strong></p><p><strong>&nbsp; &nbsp; &nbsp; })</strong></p><p><strong>&nbsp; &nbsp; &nbsp; </strong><strong style=\"color: rgb(198, 120, 221);\">const</strong><strong> </strong><strong style=\"color: rgb(229, 192, 123);\">json</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(198, 120, 221);\">await</strong><strong> </strong><strong style=\"color: rgb(229, 192, 123);\">res</strong><strong>.</strong><strong style=\"color: rgb(97, 175, 239);\">json</strong><strong>()</strong></p><p>&nbsp; &nbsp; &nbsp; <strong style=\"color: rgb(198, 120, 221);\">return</strong><strong> </strong><strong style=\"color: rgb(224, 108, 117);\">json</strong></p><p><strong>&nbsp; &nbsp; &nbsp; </strong></p><p><strong>&nbsp; &nbsp; }, </strong><strong style=\"color: rgb(209, 154, 102);\">5000</strong><strong>);</strong></p><p>&nbsp; &nbsp; <strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(97, 175, 239);\">removeAttribute</strong><strong>(</strong><strong style=\"color: rgb(152, 195, 121);\">\"disabled\"</strong><strong>)</strong></p><p>&nbsp; &nbsp; <strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Publicar\"</strong><strong>&nbsp; &nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(97, 175, 239);\">setAttribute</strong><strong>(</strong><strong style=\"color: rgb(152, 195, 121);\">\"disabled\"</strong><strong>,</strong><strong style=\"color: rgb(152, 195, 121);\">\"true\"</strong><strong>) </strong></p><p>&nbsp; &nbsp; <strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; &nbsp; </strong><strong style=\"color: rgb(97, 175, 239);\">setTimeout</strong><strong>(</strong><strong style=\"color: rgb(198, 120, 221);\">async</strong><strong>() </strong><strong style=\"color: rgb(198, 120, 221);\">=&gt;</strong><strong> {</strong></p><p>&nbsp; &nbsp; &nbsp; <strong style=\"color: rgb(198, 120, 221);\">const</strong><strong> </strong><strong style=\"color: rgb(229, 192, 123);\">res</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(198, 120, 221);\">await</strong><strong> </strong><strong style=\"color: rgb(97, 175, 239);\">fetch</strong><strong>(</strong><strong style=\"color: rgb(229, 192, 123);\">URL</strong><strong>, {</strong></p><p>&nbsp; &nbsp; &nbsp; &nbsp; <strong style=\"color: rgb(224, 108, 117);\">method</strong><strong>: </strong><strong style=\"color: rgb(152, 195, 121);\">\"POST\"</strong><strong>,</strong></p><p>&nbsp; &nbsp; &nbsp; &nbsp; <strong style=\"color: rgb(224, 108, 117);\">body</strong><strong>: </strong><strong style=\"color: rgb(224, 108, 117);\">data</strong></p><p><strong>&nbsp; &nbsp; &nbsp; })</strong></p><p><strong>&nbsp; &nbsp; &nbsp; </strong><strong style=\"color: rgb(198, 120, 221);\">const</strong><strong> </strong><strong style=\"color: rgb(229, 192, 123);\">json</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(198, 120, 221);\">await</strong><strong> </strong><strong style=\"color: rgb(229, 192, 123);\">res</strong><strong>.</strong><strong style=\"color: rgb(97, 175, 239);\">json</strong><strong>()</strong></p><p>&nbsp; &nbsp; &nbsp; <strong style=\"color: rgb(198, 120, 221);\">return</strong><strong> </strong><strong style=\"color: rgb(224, 108, 117);\">json</strong></p><p><strong>&nbsp; &nbsp; &nbsp; </strong></p><p><strong>&nbsp; &nbsp; }, </strong><strong style=\"color: rgb(209, 154, 102);\">5000</strong><strong>);</strong></p><p>&nbsp; &nbsp; <strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(97, 175, 239);\">removeAttribute</strong><strong>(</strong><strong style=\"color: rgb(152, 195, 121);\">\"disabled\"</strong><strong>)</strong></p><p>&nbsp; &nbsp; <strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Publicar\"</strong><strong>&nbsp; &nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(97, 175, 239);\">setAttribute</strong><strong>(</strong><strong style=\"color: rgb(152, 195, 121);\">\"disabled\"</strong><strong>,</strong><strong style=\"color: rgb(152, 195, 121);\">\"true\"</strong><strong>) </strong></p><p>&nbsp; &nbsp; <strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; &nbsp; </strong><strong style=\"color: rgb(97, 175, 239);\">setTimeout</strong><strong>(</strong><strong style=\"color: rgb(198, 120, 221);\">async</strong><strong>() </strong><strong style=\"color: rgb(198, 120, 221);\">=&gt;</strong><strong> {</strong></p><p>&nbsp; &nbsp; &nbsp; <strong style=\"color: rgb(198, 120, 221);\">const</strong><strong> </strong><strong style=\"color: rgb(229, 192, 123);\">res</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(198, 120, 221);\">await</strong><strong> </strong><strong style=\"color: rgb(97, 175, 239);\">fetch</strong><strong>(</strong><strong style=\"color: rgb(229, 192, 123);\">URL</strong><strong>, {</strong></p><p>&nbsp; &nbsp; &nbsp; &nbsp; <strong style=\"color: rgb(224, 108, 117);\">method</strong><strong>: </strong><strong style=\"color: rgb(152, 195, 121);\">\"POST\"</strong><strong>,</strong></p><p>&nbsp; &nbsp; &nbsp; &nbsp; <strong style=\"color: rgb(224, 108, 117);\">body</strong><strong>: </strong><strong style=\"color: rgb(224, 108, 117);\">data</strong></p><p><strong>&nbsp; &nbsp; &nbsp; })</strong></p><p><strong>&nbsp; &nbsp; &nbsp; </strong><strong style=\"color: rgb(198, 120, 221);\">const</strong><strong> </strong><strong style=\"color: rgb(229, 192, 123);\">json</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(198, 120, 221);\">await</strong><strong> </strong><strong style=\"color: rgb(229, 192, 123);\">res</strong><strong>.</strong><strong style=\"color: rgb(97, 175, 239);\">json</strong><strong>()</strong></p><p>&nbsp; &nbsp; &nbsp; <strong style=\"color: rgb(198, 120, 221);\">return</strong><strong> </strong><strong style=\"color: rgb(224, 108, 117);\">json</strong></p><p><strong>&nbsp; &nbsp; &nbsp; </strong></p><p><strong>&nbsp; &nbsp; }, </strong><strong style=\"color: rgb(209, 154, 102);\">5000</strong><strong>);</strong></p><p>&nbsp; &nbsp; <strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(97, 175, 239);\">removeAttribute</strong><strong>(</strong><strong style=\"color: rgb(152, 195, 121);\">\"disabled\"</strong><strong>)</strong></p><p>&nbsp; &nbsp; <strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Publicar\"</strong></p><p><strong>&nbsp; &nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(97, 175, 239);\">setAttribute</strong><strong>(</strong><strong style=\"color: rgb(152, 195, 121);\">\"disabled\"</strong><strong>,</strong><strong style=\"color: rgb(152, 195, 121);\">\"true\"</strong><strong>) </strong></p><p>&nbsp; &nbsp; <strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; &nbsp; </strong><strong style=\"color: rgb(97, 175, 239);\">setTimeout</strong><strong>(</strong><strong style=\"color: rgb(198, 120, 221);\">async</strong><strong>() </strong><strong style=\"color: rgb(198, 120, 221);\">=&gt;</strong><strong> {</strong></p><p>&nbsp; &nbsp; &nbsp; <strong style=\"color: rgb(198, 120, 221);\">const</strong><strong> </strong><strong style=\"color: rgb(229, 192, 123);\">res</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(198, 120, 221);\">await</strong><strong> </strong><strong style=\"color: rgb(97, 175, 239);\">fetch</strong><strong>(</strong><strong style=\"color: rgb(229, 192, 123);\">URL</strong><strong>, {</strong></p><p>&nbsp; &nbsp; &nbsp; &nbsp; <strong style=\"color: rgb(224, 108, 117);\">method</strong><strong>: </strong><strong style=\"color: rgb(152, 195, 121);\">\"POST\"</strong><strong>,</strong></p><p>&nbsp; &nbsp; &nbsp; &nbsp; <strong style=\"color: rgb(224, 108, 117);\">body</strong><strong>: </strong><strong style=\"color: rgb(224, 108, 117);\">data</strong></p><p><strong>&nbsp; &nbsp; &nbsp; })</strong></p><p><strong>&nbsp; &nbsp; &nbsp; </strong><strong style=\"color: rgb(198, 120, 221);\">const</strong><strong> </strong><strong style=\"color: rgb(229, 192, 123);\">json</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(198, 120, 221);\">await</strong><strong> </strong><strong style=\"color: rgb(229, 192, 123);\">res</strong><strong>.</strong><strong style=\"color: rgb(97, 175, 239);\">json</strong><strong>()</strong></p><p>&nbsp; &nbsp; &nbsp; <strong style=\"color: rgb(198, 120, 221);\">return</strong><strong> </strong><strong style=\"color: rgb(224, 108, 117);\">json</strong></p><p><strong>&nbsp; &nbsp; &nbsp; </strong></p><p><strong>&nbsp; &nbsp; }, </strong><strong style=\"color: rgb(209, 154, 102);\">5000</strong><strong>);</strong></p><p>&nbsp; &nbsp; <strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(97, 175, 239);\">removeAttribute</strong><strong>(</strong><strong style=\"color: rgb(152, 195, 121);\">\"disabled\"</strong><strong>)</strong></p><p>&nbsp; &nbsp; <strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Publicar\"</strong><strong>&nbsp; &nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(97, 175, 239);\">setAttribute</strong><strong>(</strong><strong style=\"color: rgb(152, 195, 121);\">\"disabled\"</strong><strong>,</strong><strong style=\"color: rgb(152, 195, 121);\">\"true\"</strong><strong>) </strong></p><p>&nbsp; &nbsp; <strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; &nbsp; </strong><strong style=\"color: rgb(97, 175, 239);\">setTimeout</strong><strong>(</strong><strong style=\"color: rgb(198, 120, 221);\">async</strong><strong>() </strong><strong style=\"color: rgb(198, 120, 221);\">=&gt;</strong><strong> {</strong></p><p>&nbsp; &nbsp; &nbsp; <strong style=\"color: rgb(198, 120, 221);\">const</strong><strong> </strong><strong style=\"color: rgb(229, 192, 123);\">res</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(198, 120, 221);\">await</strong><strong> </strong><strong style=\"color: rgb(97, 175, 239);\">fetch</strong><strong>(</strong><strong style=\"color: rgb(229, 192, 123);\">URL</strong><strong>, {</strong></p><p>&nbsp; &nbsp; &nbsp; &nbsp; <strong style=\"color: rgb(224, 108, 117);\">method</strong><strong>: </strong><strong style=\"color: rgb(152, 195, 121);\">\"POST\"</strong><strong>,</strong></p><p>&nbsp; &nbsp; &nbsp; &nbsp; <strong style=\"color: rgb(224, 108, 117);\">body</strong><strong>: </strong><strong style=\"color: rgb(224, 108, 117);\">data</strong></p><p><strong>&nbsp; &nbsp; &nbsp; })</strong></p><p><strong>&nbsp; &nbsp; &nbsp; </strong><strong style=\"color: rgb(198, 120, 221);\">const</strong><strong> </strong><strong style=\"color: rgb(229, 192, 123);\">json</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(198, 120, 221);\">await</strong><strong> </strong><strong style=\"color: rgb(229, 192, 123);\">res</strong><strong>.</strong><strong style=\"color: rgb(97, 175, 239);\">json</strong><strong>()</strong></p><p>&nbsp; &nbsp; &nbsp; <strong style=\"color: rgb(198, 120, 221);\">return</strong><strong> </strong><strong style=\"color: rgb(224, 108, 117);\">json</strong></p><p><strong>&nbsp; &nbsp; &nbsp; </strong></p><p><strong>&nbsp; &nbsp; }, </strong><strong style=\"color: rgb(209, 154, 102);\">5000</strong><strong>);</strong></p><p>&nbsp; &nbsp; <strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(97, 175, 239);\">removeAttribute</strong><strong>(</strong><strong style=\"color: rgb(152, 195, 121);\">\"disabled\"</strong><strong>)</strong></p><p>&nbsp; &nbsp; <strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Publicar\"</strong></p><p><br></p>', '2024-01-06 23:34:54', 3, 1, 1),
(38, 'PRUEBA 8fsdafdsafds', '1704580597_1515.jpg', '<p><strong>&nbsp; &nbsp; </strong><strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(97, 175, 239);\">setAttribute</strong><strong>(</strong><strong style=\"color: rgb(152, 195, 121);\">\"disabled\"</strong><strong>,</strong><strong style=\"color: rgb(152, 195, 121);\">\"true\"</strong><strong>) </strong></p><p>&nbsp; &nbsp; <strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Creando...\"</strong></p><p><strong>&nbsp; &nbsp; </strong><strong style=\"color: rgb(97, 175, 239);\">setTimeout</strong><strong>(</strong><strong style=\"color: rgb(198, 120, 221);\">async</strong><strong>() </strong><strong style=\"color: rgb(198, 120, 221);\">=&gt;</strong><strong> {</strong></p><p>&nbsp; &nbsp; &nbsp; <strong style=\"color: rgb(198, 120, 221);\">const</strong><strong> </strong><strong style=\"color: rgb(229, 192, 123);\">res</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(198, 120, 221);\">await</strong><strong> </strong><strong style=\"color: rgb(97, 175, 239);\">fetch</strong><strong>(</strong><strong style=\"color: rgb(229, 192, 123);\">URL</strong><strong>, {</strong></p><p>&nbsp; &nbsp; &nbsp; &nbsp; <strong style=\"color: rgb(224, 108, 117);\">method</strong><strong>: </strong><strong style=\"color: rgb(152, 195, 121);\">\"POST\"</strong><strong>,</strong></p><p>&nbsp; &nbsp; &nbsp; &nbsp; <strong style=\"color: rgb(224, 108, 117);\">body</strong><strong>: </strong><strong style=\"color: rgb(224, 108, 117);\">data</strong></p><p><strong>&nbsp; &nbsp; &nbsp; })</strong></p><p><strong>&nbsp; &nbsp; &nbsp; </strong><strong style=\"color: rgb(198, 120, 221);\">const</strong><strong> </strong><strong style=\"color: rgb(229, 192, 123);\">json</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(198, 120, 221);\">await</strong><strong> </strong><strong style=\"color: rgb(229, 192, 123);\">res</strong><strong>.</strong><strong style=\"color: rgb(97, 175, 239);\">json</strong><strong>()</strong></p><p>&nbsp; &nbsp; &nbsp; <strong style=\"color: rgb(198, 120, 221);\">return</strong><strong> </strong><strong style=\"color: rgb(224, 108, 117);\">json</strong></p><p><strong>&nbsp; &nbsp; &nbsp; </strong></p><p><strong>&nbsp; &nbsp; }, </strong><strong style=\"color: rgb(209, 154, 102);\">5000</strong><strong>);</strong></p><p>&nbsp; &nbsp; <strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(97, 175, 239);\">removeAttribute</strong><strong>(</strong><strong style=\"color: rgb(152, 195, 121);\">\"disabled\"</strong><strong>)</strong></p><p>&nbsp; &nbsp; <strong style=\"color: rgb(229, 192, 123);\">$buttonSubmit</strong><strong>.</strong><strong style=\"color: rgb(224, 108, 117);\">textContent</strong><strong> </strong><strong style=\"color: rgb(86, 182, 194);\">=</strong><strong> </strong><strong style=\"color: rgb(152, 195, 121);\">\"Publicar\"</strong></p><p><br></p>', '2024-01-06 23:36:37', 3, 1, 0),
(39, 'Inglés  loopstudios-landing-page with React and CSS', '1704580701_3916.png', '<p>2222222222<strong style=\"color: rgb(229, 192, 123);\">buttonSubmitContain</strong></p><p><strong style=\"color: rgb(229, 192, 123);\">buttonSubmitContain</strong></p><p><strong style=\"color: rgb(229, 192, 123);\">buttonSubmitContain</strong><span style=\"background-color: rgba(245, 245, 245, 0.494);\">os pasos intuitivos, agrega imágenes vibrantes y conecta con nuestra audios pasos intuitivos, agrega imágenes vibrantes y conecta con nuestra audios pasos intuitivos, agrega imágenes vibrantes y conecta con nuestra audios pasos intuitivos, agrega imágenes vibrantes y conecta con nuestra audi</span></p><p><br></p>', '2024-01-06 23:38:21', 3, 1, 0),
(40, 'fasdfdsafdsa', '1704580772_4995.jpg', '<p><span style=\"background-color: rgba(245, 245, 245, 0.494);\">os pasos intuitivos, agrega imágenes vibrantes y conecta con nuestra audios pasos intuitivos, agrega imágenes vibrantes y conecta con nuestra audios pasos intuitivos, agrega imágenes vibrantes y conecta con nuestra audios pasos intuitivos, agrega imágenes vibrantes y conecta con nuestra audios pasos intuitivos, agrega imágenes vibrantes y conecta con nuestra audi</span></p>', '2024-01-06 23:39:32', 3, 1, 1);
INSERT INTO `noticias` (`id`, `titulo`, `portada`, `descripcion`, `fechaCreacion`, `fkCategoria`, `fkUsuario`, `importante`) VALUES
(41, 'async function crearNoticia(data) {   const URL = \"../ajax/noticia_ajax.php\";   const $buttonSubmitContain = document.getElementById(\"submit\");   $buttonSubmitContain.setAttribute(\"disabled\", \"true\");   $buttonSubmitContain.textContent = \"Creando...\";    ', '1704580867_8554.jpg', '<p><span class=\"hljs-keyword\" style=\"background-color: rgb(0, 0, 0); color: rgb(46, 149, 211);\">async</span><span style=\"background-color: rgb(0, 0, 0); color: rgb(255, 255, 255);\"> </span><span style=\"background-color: rgb(0, 0, 0); color: rgb(46, 149, 211);\" class=\"hljs-keyword\">function</span><span style=\"background-color: rgb(0, 0, 0); color: rgb(255, 255, 255);\"> </span><span style=\"background-color: rgb(0, 0, 0); color: rgb(242, 44, 61);\" class=\"hljs-title\">crearNoticia</span><span style=\"background-color: rgb(0, 0, 0); color: rgb(255, 255, 255);\">(</span><span style=\"background-color: rgb(0, 0, 0); color: rgb(255, 255, 255);\" class=\"hljs-params\">data</span><span style=\"background-color: rgb(0, 0, 0); color: rgb(255, 255, 255);\">) {</span></p><p>  <span class=\"hljs-keyword\" style=\"background-color: rgb(0, 0, 0); color: rgb(46, 149, 211);\">const</span><span style=\"background-color: rgb(0, 0, 0); color: rgb(255, 255, 255);\"> </span><span style=\"background-color: rgb(0, 0, 0); color: rgb(223, 48, 121);\" class=\"hljs-variable\">URL</span><span style=\"background-color: rgb(0, 0, 0); color: rgb(255, 255, 255);\"> = </span><span style=\"background-color: rgb(0, 0, 0); color: rgb(0, 166, 125);\" class=\"hljs-string\">\"../ajax/noticia_ajax.php\"</span><span style=\"background-color: rgb(0, 0, 0); color: rgb(255, 255, 255);\">;</span></p><p><span style=\"color: rgb(255, 255, 255);\">  </span><span style=\"color: rgb(46, 149, 211); background-color: rgb(0, 0, 0);\" class=\"hljs-keyword\">const</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> $buttonSubmitContain = </span><span style=\"color: rgb(223, 48, 121); background-color: rgb(0, 0, 0);\" class=\"hljs-variable\">document</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">.</span><span style=\"color: rgb(242, 44, 61); background-color: rgb(0, 0, 0);\" class=\"hljs-title\">getElementById</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">(</span><span style=\"color: rgb(0, 166, 125); background-color: rgb(0, 0, 0);\" class=\"hljs-string\">\"submit\"</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">);</span></p><p><span style=\"color: rgb(255, 255, 255);\">  $buttonSubmitContain.</span><span style=\"color: rgb(242, 44, 61); background-color: rgb(0, 0, 0);\" class=\"hljs-title\">setAttribute</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">(</span><span style=\"color: rgb(0, 166, 125); background-color: rgb(0, 0, 0);\" class=\"hljs-string\">\"disabled\"</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">, </span><span style=\"color: rgb(0, 166, 125); background-color: rgb(0, 0, 0);\" class=\"hljs-string\">\"true\"</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">);</span></p><p><span style=\"color: rgb(255, 255, 255);\">  $buttonSubmitContain.</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\" class=\"hljs-property\">textContent</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> = </span><span style=\"color: rgb(0, 166, 125); background-color: rgb(0, 0, 0);\" class=\"hljs-string\">\"Creando...\"</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">;</span></p><p><br></p><p><span style=\"color: rgb(255, 255, 255);\">  </span><span style=\"color: rgb(46, 149, 211); background-color: rgb(0, 0, 0);\" class=\"hljs-keyword\">const</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> </span><span style=\"color: rgb(242, 44, 61); background-color: rgb(0, 0, 0);\" class=\"hljs-title\">sleep</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> = (</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\" class=\"hljs-params\">ms</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">) =&gt; </span><span style=\"color: rgb(46, 149, 211); background-color: rgb(0, 0, 0);\" class=\"hljs-keyword\">new</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> </span><span style=\"color: rgb(242, 44, 61); background-color: rgb(0, 0, 0);\" class=\"hljs-title\">Promise</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">(</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\" class=\"hljs-params\">resolve</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\" class=\"hljs-function\"> =&gt;</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> </span><span style=\"color: rgb(233, 149, 12); background-color: rgb(0, 0, 0);\" class=\"hljs-built_in\">setTimeout</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">(resolve, ms));</span></p><p><br></p><p><span style=\"color: rgb(255, 255, 255);\">  </span><span style=\"color: rgb(46, 149, 211); background-color: rgb(0, 0, 0);\" class=\"hljs-keyword\">try</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> {</span></p><p><span style=\"color: rgb(255, 255, 255);\">    </span><span style=\"color: rgba(255, 255, 255, 0.5); background-color: rgb(0, 0, 0);\" class=\"hljs-comment\">// Esperar 5 segundos antes de realizar la solicitud</span></p><p><span style=\"background-color: rgb(0, 0, 0); color: rgb(255, 255, 255);\">    </span><span style=\"background-color: rgb(0, 0, 0); color: rgb(46, 149, 211);\" class=\"hljs-keyword\">await</span><span style=\"background-color: rgb(0, 0, 0); color: rgb(255, 255, 255);\"> </span><span style=\"background-color: rgb(0, 0, 0); color: rgb(242, 44, 61);\" class=\"hljs-title\">sleep</span><span style=\"background-color: rgb(0, 0, 0); color: rgb(255, 255, 255);\">(</span><span style=\"background-color: rgb(0, 0, 0); color: rgb(223, 48, 121);\" class=\"hljs-number\">5000</span><span style=\"background-color: rgb(0, 0, 0); color: rgb(255, 255, 255);\">);</span></p><p><br></p><p><span style=\"color: rgb(255, 255, 255);\">    </span><span style=\"color: rgb(46, 149, 211); background-color: rgb(0, 0, 0);\" class=\"hljs-keyword\">const</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> res = </span><span style=\"color: rgb(46, 149, 211); background-color: rgb(0, 0, 0);\" class=\"hljs-keyword\">await</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> </span><span style=\"color: rgb(242, 44, 61); background-color: rgb(0, 0, 0);\" class=\"hljs-title\">fetch</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">(</span><span style=\"color: rgb(223, 48, 121); background-color: rgb(0, 0, 0);\" class=\"hljs-variable\">URL</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">, {</span></p><p><span style=\"color: rgb(255, 255, 255);\">      </span><span style=\"color: rgb(223, 48, 121); background-color: rgb(0, 0, 0);\" class=\"hljs-attr\">method</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">: </span><span style=\"color: rgb(0, 166, 125); background-color: rgb(0, 0, 0);\" class=\"hljs-string\">\"POST\"</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">,</span></p><p><span style=\"color: rgb(255, 255, 255);\">      </span><span style=\"color: rgb(223, 48, 121); background-color: rgb(0, 0, 0);\" class=\"hljs-attr\">body</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">: data</span></p><p><span style=\"color: rgb(255, 255, 255);\">    });</span></p><p><br></p><p><span style=\"color: rgb(255, 255, 255);\">    </span><span style=\"color: rgb(46, 149, 211); background-color: rgb(0, 0, 0);\" class=\"hljs-keyword\">const</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> json = </span><span style=\"color: rgb(46, 149, 211); background-color: rgb(0, 0, 0);\" class=\"hljs-keyword\">await</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> res.</span><span style=\"color: rgb(242, 44, 61); background-color: rgb(0, 0, 0);\" class=\"hljs-title\">json</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">();</span></p><p><span style=\"color: rgb(255, 255, 255);\">    </span><span style=\"color: rgb(223, 48, 121); background-color: rgb(0, 0, 0);\" class=\"hljs-variable\">console</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">.</span><span style=\"color: rgb(242, 44, 61); background-color: rgb(0, 0, 0);\" class=\"hljs-title\">log</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">(</span><span style=\"color: rgb(0, 166, 125); background-color: rgb(0, 0, 0);\" class=\"hljs-string\">\"Se terminó todo\"</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">);</span></p><p><span style=\"color: rgb(255, 255, 255);\">  } </span><span style=\"color: rgb(46, 149, 211); background-color: rgb(0, 0, 0);\" class=\"hljs-keyword\">catch</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> (error) {</span></p><p><span style=\"color: rgb(255, 255, 255);\">    </span><span style=\"color: rgb(223, 48, 121); background-color: rgb(0, 0, 0);\" class=\"hljs-variable\">console</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">.</span><span style=\"color: rgb(242, 44, 61); background-color: rgb(0, 0, 0);\" class=\"hljs-title\">log</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">(error);</span></p><p><span style=\"color: rgb(255, 255, 255);\">  } </span><span style=\"color: rgb(46, 149, 211); background-color: rgb(0, 0, 0);\" class=\"hljs-keyword\">finally</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> {</span></p><p><span style=\"color: rgb(255, 255, 255);\">    $buttonSubmitContain.</span><span style=\"color: rgb(242, 44, 61); background-color: rgb(0, 0, 0);\" class=\"hljs-title\">removeAttribute</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">(</span><span style=\"color: rgb(0, 166, 125); background-color: rgb(0, 0, 0);\" class=\"hljs-string\">\"disabled\"</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">);</span></p><p><span style=\"color: rgb(255, 255, 255);\">    $buttonSubmitContain.</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\" class=\"hljs-property\">textContent</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> = </span><span style=\"color: rgb(0, 166, 125); background-color: rgb(0, 0, 0);\" class=\"hljs-string\">\"Publicar\"</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">;</span></p><p><span style=\"color: rgb(255, 255, 255);\">  }</span></p><p><span style=\"color: rgb(255, 255, 255);\">}</span><span style=\"color: rgb(46, 149, 211); background-color: rgb(0, 0, 0);\" class=\"hljs-keyword\">async</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> </span><span style=\"color: rgb(46, 149, 211); background-color: rgb(0, 0, 0);\" class=\"hljs-keyword\">function</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> </span><span style=\"color: rgb(242, 44, 61); background-color: rgb(0, 0, 0);\" class=\"hljs-title\">crearNoticia</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">(</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\" class=\"hljs-params\">data</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">) {</span></p><p>  <span class=\"hljs-keyword\" style=\"background-color: rgb(0, 0, 0); color: rgb(46, 149, 211);\">const</span><span style=\"background-color: rgb(0, 0, 0); color: rgb(255, 255, 255);\"> </span><span style=\"background-color: rgb(0, 0, 0); color: rgb(223, 48, 121);\" class=\"hljs-variable\">URL</span><span style=\"background-color: rgb(0, 0, 0); color: rgb(255, 255, 255);\"> = </span><span style=\"background-color: rgb(0, 0, 0); color: rgb(0, 166, 125);\" class=\"hljs-string\">\"../ajax/noticia_ajax.php\"</span><span style=\"background-color: rgb(0, 0, 0); color: rgb(255, 255, 255);\">;</span></p><p><span style=\"color: rgb(255, 255, 255);\">  </span><span style=\"color: rgb(46, 149, 211); background-color: rgb(0, 0, 0);\" class=\"hljs-keyword\">const</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> $buttonSubmitContain = </span><span style=\"color: rgb(223, 48, 121); background-color: rgb(0, 0, 0);\" class=\"hljs-variable\">document</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">.</span><span style=\"color: rgb(242, 44, 61); background-color: rgb(0, 0, 0);\" class=\"hljs-title\">getElementById</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">(</span><span style=\"color: rgb(0, 166, 125); background-color: rgb(0, 0, 0);\" class=\"hljs-string\">\"submit\"</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">);</span></p><p><span style=\"color: rgb(255, 255, 255);\">  $buttonSubmitContain.</span><span style=\"color: rgb(242, 44, 61); background-color: rgb(0, 0, 0);\" class=\"hljs-title\">setAttribute</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">(</span><span style=\"color: rgb(0, 166, 125); background-color: rgb(0, 0, 0);\" class=\"hljs-string\">\"disabled\"</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">, </span><span style=\"color: rgb(0, 166, 125); background-color: rgb(0, 0, 0);\" class=\"hljs-string\">\"true\"</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">);</span></p><p><span style=\"color: rgb(255, 255, 255);\">  $buttonSubmitContain.</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\" class=\"hljs-property\">textContent</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> = </span><span style=\"color: rgb(0, 166, 125); background-color: rgb(0, 0, 0);\" class=\"hljs-string\">\"Creando...\"</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">;</span></p><p><br></p><p><span style=\"color: rgb(255, 255, 255);\">  </span><span style=\"color: rgb(46, 149, 211); background-color: rgb(0, 0, 0);\" class=\"hljs-keyword\">const</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> </span><span style=\"color: rgb(242, 44, 61); background-color: rgb(0, 0, 0);\" class=\"hljs-title\">sleep</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> = (</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\" class=\"hljs-params\">ms</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">) =&gt; </span><span style=\"color: rgb(46, 149, 211); background-color: rgb(0, 0, 0);\" class=\"hljs-keyword\">new</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> </span><span style=\"color: rgb(242, 44, 61); background-color: rgb(0, 0, 0);\" class=\"hljs-title\">Promise</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">(</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\" class=\"hljs-params\">resolve</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\" class=\"hljs-function\"> =&gt;</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> </span><span style=\"color: rgb(233, 149, 12); background-color: rgb(0, 0, 0);\" class=\"hljs-built_in\">setTimeout</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">(resolve, ms));</span></p><p><br></p><p><span style=\"color: rgb(255, 255, 255);\">  </span><span style=\"color: rgb(46, 149, 211); background-color: rgb(0, 0, 0);\" class=\"hljs-keyword\">try</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> {</span></p><p><span style=\"color: rgb(255, 255, 255);\">    </span><span style=\"color: rgba(255, 255, 255, 0.5); background-color: rgb(0, 0, 0);\" class=\"hljs-comment\">// Esperar 5 segundos antes de realizar la solicitud</span></p><p><span style=\"background-color: rgb(0, 0, 0); color: rgb(255, 255, 255);\">    </span><span style=\"background-color: rgb(0, 0, 0); color: rgb(46, 149, 211);\" class=\"hljs-keyword\">await</span><span style=\"background-color: rgb(0, 0, 0); color: rgb(255, 255, 255);\"> </span><span style=\"background-color: rgb(0, 0, 0); color: rgb(242, 44, 61);\" class=\"hljs-title\">sleep</span><span style=\"background-color: rgb(0, 0, 0); color: rgb(255, 255, 255);\">(</span><span style=\"background-color: rgb(0, 0, 0); color: rgb(223, 48, 121);\" class=\"hljs-number\">5000</span><span style=\"background-color: rgb(0, 0, 0); color: rgb(255, 255, 255);\">);</span></p><p><br></p><p><span style=\"color: rgb(255, 255, 255);\">    </span><span style=\"color: rgb(46, 149, 211); background-color: rgb(0, 0, 0);\" class=\"hljs-keyword\">const</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> res = </span><span style=\"color: rgb(46, 149, 211); background-color: rgb(0, 0, 0);\" class=\"hljs-keyword\">await</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> </span><span style=\"color: rgb(242, 44, 61); background-color: rgb(0, 0, 0);\" class=\"hljs-title\">fetch</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">(</span><span style=\"color: rgb(223, 48, 121); background-color: rgb(0, 0, 0);\" class=\"hljs-variable\">URL</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">, {</span></p><p><span style=\"color: rgb(255, 255, 255);\">      </span><span style=\"color: rgb(223, 48, 121); background-color: rgb(0, 0, 0);\" class=\"hljs-attr\">method</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">: </span><span style=\"color: rgb(0, 166, 125); background-color: rgb(0, 0, 0);\" class=\"hljs-string\">\"POST\"</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">,</span></p><p><span style=\"color: rgb(255, 255, 255);\">      </span><span style=\"color: rgb(223, 48, 121); background-color: rgb(0, 0, 0);\" class=\"hljs-attr\">body</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">: data</span></p><p><span style=\"color: rgb(255, 255, 255);\">    });</span></p><p><br></p><p><span style=\"color: rgb(255, 255, 255);\">    </span><span style=\"color: rgb(46, 149, 211); background-color: rgb(0, 0, 0);\" class=\"hljs-keyword\">const</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> json = </span><span style=\"color: rgb(46, 149, 211); background-color: rgb(0, 0, 0);\" class=\"hljs-keyword\">await</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> res.</span><span style=\"color: rgb(242, 44, 61); background-color: rgb(0, 0, 0);\" class=\"hljs-title\">json</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">();</span></p><p><span style=\"color: rgb(255, 255, 255);\">    </span><span style=\"color: rgb(223, 48, 121); background-color: rgb(0, 0, 0);\" class=\"hljs-variable\">console</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">.</span><span style=\"color: rgb(242, 44, 61); background-color: rgb(0, 0, 0);\" class=\"hljs-title\">log</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">(</span><span style=\"color: rgb(0, 166, 125); background-color: rgb(0, 0, 0);\" class=\"hljs-string\">\"Se terminó todo\"</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">);</span></p><p><span style=\"color: rgb(255, 255, 255);\">  } </span><span style=\"color: rgb(46, 149, 211); background-color: rgb(0, 0, 0);\" class=\"hljs-keyword\">catch</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> (error) {</span></p><p><span style=\"color: rgb(255, 255, 255);\">    </span><span style=\"color: rgb(223, 48, 121); background-color: rgb(0, 0, 0);\" class=\"hljs-variable\">console</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">.</span><span style=\"color: rgb(242, 44, 61); background-color: rgb(0, 0, 0);\" class=\"hljs-title\">log</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">(error);</span></p><p><span style=\"color: rgb(255, 255, 255);\">  } </span><span style=\"color: rgb(46, 149, 211); background-color: rgb(0, 0, 0);\" class=\"hljs-keyword\">finally</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> {</span></p><p><span style=\"color: rgb(255, 255, 255);\">    $buttonSubmitContain.</span><span style=\"color: rgb(242, 44, 61); background-color: rgb(0, 0, 0);\" class=\"hljs-title\">removeAttribute</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">(</span><span style=\"color: rgb(0, 166, 125); background-color: rgb(0, 0, 0);\" class=\"hljs-string\">\"disabled\"</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">);</span></p><p><span style=\"color: rgb(255, 255, 255);\">    $buttonSubmitContain.</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\" class=\"hljs-property\">textContent</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> = </span><span style=\"color: rgb(0, 166, 125); background-color: rgb(0, 0, 0);\" class=\"hljs-string\">\"Publicar\"</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">;</span></p><p><span style=\"color: rgb(255, 255, 255);\">  }</span></p><p><span style=\"color: rgb(255, 255, 255);\">}</span><span style=\"color: rgb(46, 149, 211); background-color: rgb(0, 0, 0);\" class=\"hljs-keyword\">async</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> </span><span style=\"color: rgb(46, 149, 211); background-color: rgb(0, 0, 0);\" class=\"hljs-keyword\">function</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> </span><span style=\"color: rgb(242, 44, 61); background-color: rgb(0, 0, 0);\" class=\"hljs-title\">crearNoticia</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">(</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\" class=\"hljs-params\">data</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">) {</span></p><p>  <span class=\"hljs-keyword\" style=\"background-color: rgb(0, 0, 0); color: rgb(46, 149, 211);\">const</span><span style=\"background-color: rgb(0, 0, 0); color: rgb(255, 255, 255);\"> </span><span style=\"background-color: rgb(0, 0, 0); color: rgb(223, 48, 121);\" class=\"hljs-variable\">URL</span><span style=\"background-color: rgb(0, 0, 0); color: rgb(255, 255, 255);\"> = </span><span style=\"background-color: rgb(0, 0, 0); color: rgb(0, 166, 125);\" class=\"hljs-string\">\"../ajax/noticia_ajax.php\"</span><span style=\"background-color: rgb(0, 0, 0); color: rgb(255, 255, 255);\">;</span></p><p><span style=\"color: rgb(255, 255, 255);\">  </span><span style=\"color: rgb(46, 149, 211); background-color: rgb(0, 0, 0);\" class=\"hljs-keyword\">const</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> $buttonSubmitContain = </span><span style=\"color: rgb(223, 48, 121); background-color: rgb(0, 0, 0);\" class=\"hljs-variable\">document</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">.</span><span style=\"color: rgb(242, 44, 61); background-color: rgb(0, 0, 0);\" class=\"hljs-title\">getElementById</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">(</span><span style=\"color: rgb(0, 166, 125); background-color: rgb(0, 0, 0);\" class=\"hljs-string\">\"submit\"</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">);</span></p><p><span style=\"color: rgb(255, 255, 255);\">  $buttonSubmitContain.</span><span style=\"color: rgb(242, 44, 61); background-color: rgb(0, 0, 0);\" class=\"hljs-title\">setAttribute</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">(</span><span style=\"color: rgb(0, 166, 125); background-color: rgb(0, 0, 0);\" class=\"hljs-string\">\"disabled\"</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">, </span><span style=\"color: rgb(0, 166, 125); background-color: rgb(0, 0, 0);\" class=\"hljs-string\">\"true\"</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">);</span></p><p><span style=\"color: rgb(255, 255, 255);\">  $buttonSubmitContain.</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\" class=\"hljs-property\">textContent</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> = </span><span style=\"color: rgb(0, 166, 125); background-color: rgb(0, 0, 0);\" class=\"hljs-string\">\"Creando...\"</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">;</span></p><p><br></p><p><span style=\"color: rgb(255, 255, 255);\">  </span><span style=\"color: rgb(46, 149, 211); background-color: rgb(0, 0, 0);\" class=\"hljs-keyword\">const</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> </span><span style=\"color: rgb(242, 44, 61); background-color: rgb(0, 0, 0);\" class=\"hljs-title\">sleep</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> = (</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\" class=\"hljs-params\">ms</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">) =&gt; </span><span style=\"color: rgb(46, 149, 211); background-color: rgb(0, 0, 0);\" class=\"hljs-keyword\">new</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> </span><span style=\"color: rgb(242, 44, 61); background-color: rgb(0, 0, 0);\" class=\"hljs-title\">Promise</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">(</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\" class=\"hljs-params\">resolve</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\" class=\"hljs-function\"> =&gt;</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> </span><span style=\"color: rgb(233, 149, 12); background-color: rgb(0, 0, 0);\" class=\"hljs-built_in\">setTimeout</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">(resolve, ms));</span></p><p><br></p><p><span style=\"color: rgb(255, 255, 255);\">  </span><span style=\"color: rgb(46, 149, 211); background-color: rgb(0, 0, 0);\" class=\"hljs-keyword\">try</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> {</span></p><p><span style=\"color: rgb(255, 255, 255);\">    </span><span style=\"color: rgba(255, 255, 255, 0.5); background-color: rgb(0, 0, 0);\" class=\"hljs-comment\">// Esperar 5 segundos antes de realizar la solicitud</span></p><p><span style=\"background-color: rgb(0, 0, 0); color: rgb(255, 255, 255);\">    </span><span style=\"background-color: rgb(0, 0, 0); color: rgb(46, 149, 211);\" class=\"hljs-keyword\">await</span><span style=\"background-color: rgb(0, 0, 0); color: rgb(255, 255, 255);\"> </span><span style=\"background-color: rgb(0, 0, 0); color: rgb(242, 44, 61);\" class=\"hljs-title\">sleep</span><span style=\"background-color: rgb(0, 0, 0); color: rgb(255, 255, 255);\">(</span><span style=\"background-color: rgb(0, 0, 0); color: rgb(223, 48, 121);\" class=\"hljs-number\">5000</span><span style=\"background-color: rgb(0, 0, 0); color: rgb(255, 255, 255);\">);</span></p><p><br></p><p><span style=\"color: rgb(255, 255, 255);\">    </span><span style=\"color: rgb(46, 149, 211); background-color: rgb(0, 0, 0);\" class=\"hljs-keyword\">const</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> res = </span><span style=\"color: rgb(46, 149, 211); background-color: rgb(0, 0, 0);\" class=\"hljs-keyword\">await</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> </span><span style=\"color: rgb(242, 44, 61); background-color: rgb(0, 0, 0);\" class=\"hljs-title\">fetch</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">(</span><span style=\"color: rgb(223, 48, 121); background-color: rgb(0, 0, 0);\" class=\"hljs-variable\">URL</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">, {</span></p><p><span style=\"color: rgb(255, 255, 255);\">      </span><span style=\"color: rgb(223, 48, 121); background-color: rgb(0, 0, 0);\" class=\"hljs-attr\">method</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">: </span><span style=\"color: rgb(0, 166, 125); background-color: rgb(0, 0, 0);\" class=\"hljs-string\">\"POST\"</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">,</span></p><p><span style=\"color: rgb(255, 255, 255);\">      </span><span style=\"color: rgb(223, 48, 121); background-color: rgb(0, 0, 0);\" class=\"hljs-attr\">body</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">: data</span></p><p><span style=\"color: rgb(255, 255, 255);\">    });</span></p><p><br></p><p><span style=\"color: rgb(255, 255, 255);\">    </span><span style=\"color: rgb(46, 149, 211); background-color: rgb(0, 0, 0);\" class=\"hljs-keyword\">const</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> json = </span><span style=\"color: rgb(46, 149, 211); background-color: rgb(0, 0, 0);\" class=\"hljs-keyword\">await</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> res.</span><span style=\"color: rgb(242, 44, 61); background-color: rgb(0, 0, 0);\" class=\"hljs-title\">json</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">();</span></p><p><span style=\"color: rgb(255, 255, 255);\">    </span><span style=\"color: rgb(223, 48, 121); background-color: rgb(0, 0, 0);\" class=\"hljs-variable\">console</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">.</span><span style=\"color: rgb(242, 44, 61); background-color: rgb(0, 0, 0);\" class=\"hljs-title\">log</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">(</span><span style=\"color: rgb(0, 166, 125); background-color: rgb(0, 0, 0);\" class=\"hljs-string\">\"Se terminó todo\"</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">);</span></p><p><span style=\"color: rgb(255, 255, 255);\">  } </span><span style=\"color: rgb(46, 149, 211); background-color: rgb(0, 0, 0);\" class=\"hljs-keyword\">catch</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> (error) {</span></p><p><span style=\"color: rgb(255, 255, 255);\">    </span><span style=\"color: rgb(223, 48, 121); background-color: rgb(0, 0, 0);\" class=\"hljs-variable\">console</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">.</span><span style=\"color: rgb(242, 44, 61); background-color: rgb(0, 0, 0);\" class=\"hljs-title\">log</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">(error);</span></p><p><span style=\"color: rgb(255, 255, 255);\">  } </span><span style=\"color: rgb(46, 149, 211); background-color: rgb(0, 0, 0);\" class=\"hljs-keyword\">finally</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> {</span></p><p><span style=\"color: rgb(255, 255, 255);\">    $buttonSubmitContain.</span><span style=\"color: rgb(242, 44, 61); background-color: rgb(0, 0, 0);\" class=\"hljs-title\">removeAttribute</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">(</span><span style=\"color: rgb(0, 166, 125); background-color: rgb(0, 0, 0);\" class=\"hljs-string\">\"disabled\"</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">);</span></p><p><span style=\"color: rgb(255, 255, 255);\">    $buttonSubmitContain.</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\" class=\"hljs-property\">textContent</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> = </span><span style=\"color: rgb(0, 166, 125); background-color: rgb(0, 0, 0);\" class=\"hljs-string\">\"Publicar\"</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">;</span></p><p><span style=\"color: rgb(255, 255, 255);\">  }</span></p><p><span style=\"color: rgb(255, 255, 255);\">}</span><span style=\"color: rgb(46, 149, 211); background-color: rgb(0, 0, 0);\" class=\"hljs-keyword\">async</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> </span><span style=\"color: rgb(46, 149, 211); background-color: rgb(0, 0, 0);\" class=\"hljs-keyword\">function</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> </span><span style=\"color: rgb(242, 44, 61); background-color: rgb(0, 0, 0);\" class=\"hljs-title\">crearNoticia</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">(</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\" class=\"hljs-params\">data</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">) {</span></p><p>  <span class=\"hljs-keyword\" style=\"background-color: rgb(0, 0, 0); color: rgb(46, 149, 211);\">const</span><span style=\"background-color: rgb(0, 0, 0); color: rgb(255, 255, 255);\"> </span><span style=\"background-color: rgb(0, 0, 0); color: rgb(223, 48, 121);\" class=\"hljs-variable\">URL</span><span style=\"background-color: rgb(0, 0, 0); color: rgb(255, 255, 255);\"> = </span><span style=\"background-color: rgb(0, 0, 0); color: rgb(0, 166, 125);\" class=\"hljs-string\">\"../ajax/noticia_ajax.php\"</span><span style=\"background-color: rgb(0, 0, 0); color: rgb(255, 255, 255);\">;</span></p><p><span style=\"color: rgb(255, 255, 255);\">  </span><span style=\"color: rgb(46, 149, 211); background-color: rgb(0, 0, 0);\" class=\"hljs-keyword\">const</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> $buttonSubmitContain = </span><span style=\"color: rgb(223, 48, 121); background-color: rgb(0, 0, 0);\" class=\"hljs-variable\">document</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">.</span><span style=\"color: rgb(242, 44, 61); background-color: rgb(0, 0, 0);\" class=\"hljs-title\">getElementById</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">(</span><span style=\"color: rgb(0, 166, 125); background-color: rgb(0, 0, 0);\" class=\"hljs-string\">\"submit\"</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">);</span></p><p><span style=\"color: rgb(255, 255, 255);\">  $buttonSubmitContain.</span><span style=\"color: rgb(242, 44, 61); background-color: rgb(0, 0, 0);\" class=\"hljs-title\">setAttribute</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">(</span><span style=\"color: rgb(0, 166, 125); background-color: rgb(0, 0, 0);\" class=\"hljs-string\">\"disabled\"</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">, </span><span style=\"color: rgb(0, 166, 125); background-color: rgb(0, 0, 0);\" class=\"hljs-string\">\"true\"</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">);</span></p><p><span style=\"color: rgb(255, 255, 255);\">  $buttonSubmitContain.</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\" class=\"hljs-property\">textContent</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> = </span><span style=\"color: rgb(0, 166, 125); background-color: rgb(0, 0, 0);\" class=\"hljs-string\">\"Creando...\"</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">;</span></p><p><br></p><p><span style=\"color: rgb(255, 255, 255);\">  </span><span style=\"color: rgb(46, 149, 211); background-color: rgb(0, 0, 0);\" class=\"hljs-keyword\">const</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> </span><span style=\"color: rgb(242, 44, 61); background-color: rgb(0, 0, 0);\" class=\"hljs-title\">sleep</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> = (</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\" class=\"hljs-params\">ms</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">) =&gt; </span><span style=\"color: rgb(46, 149, 211); background-color: rgb(0, 0, 0);\" class=\"hljs-keyword\">new</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> </span><span style=\"color: rgb(242, 44, 61); background-color: rgb(0, 0, 0);\" class=\"hljs-title\">Promise</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">(</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\" class=\"hljs-params\">resolve</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\" class=\"hljs-function\"> =&gt;</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> </span><span style=\"color: rgb(233, 149, 12); background-color: rgb(0, 0, 0);\" class=\"hljs-built_in\">setTimeout</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">(resolve, ms));</span></p><p><br></p><p><span style=\"color: rgb(255, 255, 255);\">  </span><span style=\"color: rgb(46, 149, 211); background-color: rgb(0, 0, 0);\" class=\"hljs-keyword\">try</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> {</span></p><p><span style=\"color: rgb(255, 255, 255);\">    </span><span style=\"color: rgba(255, 255, 255, 0.5); background-color: rgb(0, 0, 0);\" class=\"hljs-comment\">// Esperar 5 segundos antes de realizar la solicitud</span></p><p><span style=\"background-color: rgb(0, 0, 0); color: rgb(255, 255, 255);\">    </span><span style=\"background-color: rgb(0, 0, 0); color: rgb(46, 149, 211);\" class=\"hljs-keyword\">await</span><span style=\"background-color: rgb(0, 0, 0); color: rgb(255, 255, 255);\"> </span><span style=\"background-color: rgb(0, 0, 0); color: rgb(242, 44, 61);\" class=\"hljs-title\">sleep</span><span style=\"background-color: rgb(0, 0, 0); color: rgb(255, 255, 255);\">(</span><span style=\"background-color: rgb(0, 0, 0); color: rgb(223, 48, 121);\" class=\"hljs-number\">5000</span><span style=\"background-color: rgb(0, 0, 0); color: rgb(255, 255, 255);\">);</span></p><p><br></p><p><span style=\"color: rgb(255, 255, 255);\">    </span><span style=\"color: rgb(46, 149, 211); background-color: rgb(0, 0, 0);\" class=\"hljs-keyword\">const</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> res = </span><span style=\"color: rgb(46, 149, 211); background-color: rgb(0, 0, 0);\" class=\"hljs-keyword\">await</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> </span><span style=\"color: rgb(242, 44, 61); background-color: rgb(0, 0, 0);\" class=\"hljs-title\">fetch</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">(</span><span style=\"color: rgb(223, 48, 121); background-color: rgb(0, 0, 0);\" class=\"hljs-variable\">URL</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">, {</span></p><p><span style=\"color: rgb(255, 255, 255);\">      </span><span style=\"color: rgb(223, 48, 121); background-color: rgb(0, 0, 0);\" class=\"hljs-attr\">method</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">: </span><span style=\"color: rgb(0, 166, 125); background-color: rgb(0, 0, 0);\" class=\"hljs-string\">\"POST\"</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">,</span></p><p><span style=\"color: rgb(255, 255, 255);\">      </span><span style=\"color: rgb(223, 48, 121); background-color: rgb(0, 0, 0);\" class=\"hljs-attr\">body</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">: data</span></p><p><span style=\"color: rgb(255, 255, 255);\">    });</span></p><p><br></p><p><span style=\"color: rgb(255, 255, 255);\">    </span><span style=\"color: rgb(46, 149, 211); background-color: rgb(0, 0, 0);\" class=\"hljs-keyword\">const</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> json = </span><span style=\"color: rgb(46, 149, 211); background-color: rgb(0, 0, 0);\" class=\"hljs-keyword\">await</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> res.</span><span style=\"color: rgb(242, 44, 61); background-color: rgb(0, 0, 0);\" class=\"hljs-title\">json</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">();</span></p><p><span style=\"color: rgb(255, 255, 255);\">    </span><span style=\"color: rgb(223, 48, 121); background-color: rgb(0, 0, 0);\" class=\"hljs-variable\">console</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">.</span><span style=\"color: rgb(242, 44, 61); background-color: rgb(0, 0, 0);\" class=\"hljs-title\">log</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">(</span><span style=\"color: rgb(0, 166, 125); background-color: rgb(0, 0, 0);\" class=\"hljs-string\">\"Se terminó todo\"</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">);</span></p><p><span style=\"color: rgb(255, 255, 255);\">  } </span><span style=\"color: rgb(46, 149, 211); background-color: rgb(0, 0, 0);\" class=\"hljs-keyword\">catch</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> (error) {</span></p><p><span style=\"color: rgb(255, 255, 255);\">    </span><span style=\"color: rgb(223, 48, 121); background-color: rgb(0, 0, 0);\" class=\"hljs-variable\">console</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">.</span><span style=\"color: rgb(242, 44, 61); background-color: rgb(0, 0, 0);\" class=\"hljs-title\">log</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">(error);</span></p><p><span style=\"color: rgb(255, 255, 255);\">  } </span><span style=\"color: rgb(46, 149, 211); background-color: rgb(0, 0, 0);\" class=\"hljs-keyword\">finally</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> {</span></p><p><span style=\"color: rgb(255, 255, 255);\">    $buttonSubmitContain.</span><span style=\"color: rgb(242, 44, 61); background-color: rgb(0, 0, 0);\" class=\"hljs-title\">removeAttribute</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">(</span><span style=\"color: rgb(0, 166, 125); background-color: rgb(0, 0, 0);\" class=\"hljs-string\">\"disabled\"</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">);</span></p><p><span style=\"color: rgb(255, 255, 255);\">    $buttonSubmitContain.</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\" class=\"hljs-property\">textContent</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> = </span><span style=\"color: rgb(0, 166, 125); background-color: rgb(0, 0, 0);\" class=\"hljs-string\">\"Publicar\"</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">;</span></p><p><span style=\"color: rgb(255, 255, 255);\">  }</span></p><p><span style=\"color: rgb(255, 255, 255);\">}</span><span style=\"color: rgb(46, 149, 211); background-color: rgb(0, 0, 0);\" class=\"hljs-keyword\">async</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> </span><span style=\"color: rgb(46, 149, 211); background-color: rgb(0, 0, 0);\" class=\"hljs-keyword\">function</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> </span><span style=\"color: rgb(242, 44, 61); background-color: rgb(0, 0, 0);\" class=\"hljs-title\">crearNoticia</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">(</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\" class=\"hljs-params\">data</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">) {</span></p><p>  <span class=\"hljs-keyword\" style=\"background-color: rgb(0, 0, 0); color: rgb(46, 149, 211);\">const</span><span style=\"background-color: rgb(0, 0, 0); color: rgb(255, 255, 255);\"> </span><span style=\"background-color: rgb(0, 0, 0); color: rgb(223, 48, 121);\" class=\"hljs-variable\">URL</span><span style=\"background-color: rgb(0, 0, 0); color: rgb(255, 255, 255);\"> = </span><span style=\"background-color: rgb(0, 0, 0); color: rgb(0, 166, 125);\" class=\"hljs-string\">\"../ajax/noticia_ajax.php\"</span><span style=\"background-color: rgb(0, 0, 0); color: rgb(255, 255, 255);\">;</span></p><p><span style=\"color: rgb(255, 255, 255);\">  </span><span style=\"color: rgb(46, 149, 211); background-color: rgb(0, 0, 0);\" class=\"hljs-keyword\">const</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> $buttonSubmitContain = </span><span style=\"color: rgb(223, 48, 121); background-color: rgb(0, 0, 0);\" class=\"hljs-variable\">document</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">.</span><span style=\"color: rgb(242, 44, 61); background-color: rgb(0, 0, 0);\" class=\"hljs-title\">getElementById</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">(</span><span style=\"color: rgb(0, 166, 125); background-color: rgb(0, 0, 0);\" class=\"hljs-string\">\"submit\"</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">);</span></p><p><span style=\"color: rgb(255, 255, 255);\">  $buttonSubmitContain.</span><span style=\"color: rgb(242, 44, 61); background-color: rgb(0, 0, 0);\" class=\"hljs-title\">setAttribute</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">(</span><span style=\"color: rgb(0, 166, 125); background-color: rgb(0, 0, 0);\" class=\"hljs-string\">\"disabled\"</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">, </span><span style=\"color: rgb(0, 166, 125); background-color: rgb(0, 0, 0);\" class=\"hljs-string\">\"true\"</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">);</span></p><p><span style=\"color: rgb(255, 255, 255);\">  $buttonSubmitContain.</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\" class=\"hljs-property\">textContent</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> = </span><span style=\"color: rgb(0, 166, 125); background-color: rgb(0, 0, 0);\" class=\"hljs-string\">\"Creando...\"</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">;</span></p><p><br></p><p><span style=\"color: rgb(255, 255, 255);\">  </span><span style=\"color: rgb(46, 149, 211); background-color: rgb(0, 0, 0);\" class=\"hljs-keyword\">const</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> </span><span style=\"color: rgb(242, 44, 61); background-color: rgb(0, 0, 0);\" class=\"hljs-title\">sleep</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> = (</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\" class=\"hljs-params\">ms</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">) =&gt; </span><span style=\"color: rgb(46, 149, 211); background-color: rgb(0, 0, 0);\" class=\"hljs-keyword\">new</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> </span><span style=\"color: rgb(242, 44, 61); background-color: rgb(0, 0, 0);\" class=\"hljs-title\">Promise</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">(</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\" class=\"hljs-params\">resolve</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\" class=\"hljs-function\"> =&gt;</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> </span><span style=\"color: rgb(233, 149, 12); background-color: rgb(0, 0, 0);\" class=\"hljs-built_in\">setTimeout</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">(resolve, ms));</span></p><p><br></p><p><span style=\"color: rgb(255, 255, 255);\">  </span><span style=\"color: rgb(46, 149, 211); background-color: rgb(0, 0, 0);\" class=\"hljs-keyword\">try</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> {</span></p><p><span style=\"color: rgb(255, 255, 255);\">    </span><span style=\"color: rgba(255, 255, 255, 0.5); background-color: rgb(0, 0, 0);\" class=\"hljs-comment\">// Esperar 5 segundos antes de realizar la solicitud</span></p><p><span style=\"background-color: rgb(0, 0, 0); color: rgb(255, 255, 255);\">    </span><span style=\"background-color: rgb(0, 0, 0); color: rgb(46, 149, 211);\" class=\"hljs-keyword\">await</span><span style=\"background-color: rgb(0, 0, 0); color: rgb(255, 255, 255);\"> </span><span style=\"background-color: rgb(0, 0, 0); color: rgb(242, 44, 61);\" class=\"hljs-title\">sleep</span><span style=\"background-color: rgb(0, 0, 0); color: rgb(255, 255, 255);\">(</span><span style=\"background-color: rgb(0, 0, 0); color: rgb(223, 48, 121);\" class=\"hljs-number\">5000</span><span style=\"background-color: rgb(0, 0, 0); color: rgb(255, 255, 255);\">);</span></p><p><br></p><p><span style=\"color: rgb(255, 255, 255);\">    </span><span style=\"color: rgb(46, 149, 211); background-color: rgb(0, 0, 0);\" class=\"hljs-keyword\">const</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> res = </span><span style=\"color: rgb(46, 149, 211); background-color: rgb(0, 0, 0);\" class=\"hljs-keyword\">await</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> </span><span style=\"color: rgb(242, 44, 61); background-color: rgb(0, 0, 0);\" class=\"hljs-title\">fetch</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">(</span><span style=\"color: rgb(223, 48, 121); background-color: rgb(0, 0, 0);\" class=\"hljs-variable\">URL</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">, {</span></p><p><span style=\"color: rgb(255, 255, 255);\">      </span><span style=\"color: rgb(223, 48, 121); background-color: rgb(0, 0, 0);\" class=\"hljs-attr\">method</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">: </span><span style=\"color: rgb(0, 166, 125); background-color: rgb(0, 0, 0);\" class=\"hljs-string\">\"POST\"</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">,</span></p><p><span style=\"color: rgb(255, 255, 255);\">      </span><span style=\"color: rgb(223, 48, 121); background-color: rgb(0, 0, 0);\" class=\"hljs-attr\">body</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">: data</span></p><p><span style=\"color: rgb(255, 255, 255);\">    });</span></p><p><br></p><p><span style=\"color: rgb(255, 255, 255);\">    </span><span style=\"color: rgb(46, 149, 211); background-color: rgb(0, 0, 0);\" class=\"hljs-keyword\">const</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> json = </span><span style=\"color: rgb(46, 149, 211); background-color: rgb(0, 0, 0);\" class=\"hljs-keyword\">await</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> res.</span><span style=\"color: rgb(242, 44, 61); background-color: rgb(0, 0, 0);\" class=\"hljs-title\">json</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">();</span></p><p><span style=\"color: rgb(255, 255, 255);\">    </span><span style=\"color: rgb(223, 48, 121); background-color: rgb(0, 0, 0);\" class=\"hljs-variable\">console</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">.</span><span style=\"color: rgb(242, 44, 61); background-color: rgb(0, 0, 0);\" class=\"hljs-title\">log</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">(</span><span style=\"color: rgb(0, 166, 125); background-color: rgb(0, 0, 0);\" class=\"hljs-string\">\"Se terminó todo\"</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">);</span></p><p><span style=\"color: rgb(255, 255, 255);\">  } </span><span style=\"color: rgb(46, 149, 211); background-color: rgb(0, 0, 0);\" class=\"hljs-keyword\">catch</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> (error) {</span></p><p><span style=\"color: rgb(255, 255, 255);\">    </span><span style=\"color: rgb(223, 48, 121); background-color: rgb(0, 0, 0);\" class=\"hljs-variable\">console</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">.</span><span style=\"color: rgb(242, 44, 61); background-color: rgb(0, 0, 0);\" class=\"hljs-title\">log</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">(error);</span></p><p><span style=\"color: rgb(255, 255, 255);\">  } </span><span style=\"color: rgb(46, 149, 211); background-color: rgb(0, 0, 0);\" class=\"hljs-keyword\">finally</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> {</span></p><p><span style=\"color: rgb(255, 255, 255);\">    $buttonSubmitContain.</span><span style=\"color: rgb(242, 44, 61); background-color: rgb(0, 0, 0);\" class=\"hljs-title\">removeAttribute</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">(</span><span style=\"color: rgb(0, 166, 125); background-color: rgb(0, 0, 0);\" class=\"hljs-string\">\"disabled\"</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">);</span></p><p><span style=\"color: rgb(255, 255, 255);\">    $buttonSubmitContain.</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\" class=\"hljs-property\">textContent</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\"> = </span><span style=\"color: rgb(0, 166, 125); background-color: rgb(0, 0, 0);\" class=\"hljs-string\">\"Publicar\"</span><span style=\"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);\">;</span></p><p><span style=\"color: rgb(255, 255, 255);\">  }</span></p><p><span style=\"color: rgb(255, 255, 255);\">}</span></p>', '2024-01-06 23:41:07', 3, 1, 0);
INSERT INTO `noticias` (`id`, `titulo`, `portada`, `descripcion`, `fechaCreacion`, `fkCategoria`, `fkUsuario`, `importante`) VALUES
(42, 'Inglés  loopstudios-landing-page with React and CSS', '1704580989_9786.jpg', '<p><strong style=\"color: rgb(229, 192, 123);\">buttonSubmit</strong></p><p><strong style=\"color: rgb(229, 192, 123);\">buttonSubmit</strong></p><p><strong style=\"color: rgb(229, 192, 123);\">buttonSubmit</strong></p><p><strong style=\"color: rgb(229, 192, 123);\">buttonSubmit</strong></p><p><strong style=\"color: rgb(229, 192, 123);\">buttonSubmit</strong></p><p><strong style=\"color: rgb(229, 192, 123);\">buttonSubmit</strong></p><p><strong style=\"color: rgb(229, 192, 123);\">buttonSubmit</strong></p><p><strong style=\"color: rgb(229, 192, 123);\">buttonSubmit</strong></p><p><br></p>', '2024-01-06 23:43:09', 3, 1, 0),
(43, 'Inglés  loopstudios-landing-page with React and CSS', '1704580999_6371.jpg', '<p><strong style=\"color: rgb(229, 192, 123);\">buttonSubmit</strong></p><p><strong style=\"color: rgb(229, 192, 123);\">buttonSubmit</strong></p><p><strong style=\"color: rgb(229, 192, 123);\">buttonSubmit</strong></p><p><strong style=\"color: rgb(229, 192, 123);\">buttonSubmit</strong></p><p><strong style=\"color: rgb(229, 192, 123);\">buttonSubmit</strong></p><p><strong style=\"color: rgb(229, 192, 123);\">buttonSubmit</strong></p><p><strong style=\"color: rgb(229, 192, 123);\">buttonSubmit</strong></p><p><strong style=\"color: rgb(229, 192, 123);\">buttonSubmit</strong></p><p><br></p>', '2024-01-06 23:43:19', 3, 1, 0),
(44, 'PRUEBA 8', '1704581046_9229.jpg', '<p>ffsdafdasfasdfdasfdasfdasfdasfdsaf<strong style=\"color: rgb(229, 192, 123);\">buttonSubmit</strong></p><p><strong style=\"color: rgb(229, 192, 123);\">buttonSubmit</strong></p><p><strong style=\"color: rgb(229, 192, 123);\">buttonSubmit</strong></p><p><strong style=\"color: rgb(229, 192, 123);\">buttonSubmit</strong></p><p><strong style=\"color: rgb(229, 192, 123);\">buttonSubmit</strong></p><p><strong style=\"color: rgb(229, 192, 123);\">buttonSubmit</strong></p><p><br></p>', '2024-01-06 23:44:06', 3, 1, 1),
(45, 'PRUEBA 8', '1704581134_2658.jpg', '<p>fafsdafdsafdasfdsa<strong style=\"color: rgb(229, 192, 123);\">buttonSubmit</strong></p><p><strong style=\"color: rgb(229, 192, 123);\">buttonSubmit</strong></p><p><strong style=\"color: rgb(229, 192, 123);\">buttonSubmit</strong></p><p><strong style=\"color: rgb(229, 192, 123);\">buttonSubmit</strong></p><p><strong style=\"color: rgb(229, 192, 123);\">buttonSubmit</strong></p><p><strong style=\"color: rgb(229, 192, 123);\">buttonSubmitbuttonSubmit</strong></p><p><strong style=\"color: rgb(229, 192, 123);\">buttonSubmit</strong></p><p><strong style=\"color: rgb(229, 192, 123);\">buttonSubmit</strong></p><p><strong style=\"color: rgb(229, 192, 123);\">buttonSubmit</strong></p><p><strong style=\"color: rgb(229, 192, 123);\">buttonSubmit</strong></p><p><strong style=\"color: rgb(229, 192, 123);\">buttonSubmit</strong></p><p><strong style=\"color: rgb(229, 192, 123);\">buttonSubmit</strong></p><p><strong style=\"color: rgb(229, 192, 123);\">buttonSubmit</strong></p><p><strong style=\"color: rgb(229, 192, 123);\">buttonSubmit</strong></p><p><strong style=\"color: rgb(229, 192, 123);\">buttonSubmit</strong></p><p><br></p>', '2024-01-06 23:45:34', 3, 1, 0),
(46, 'Algo que se escribe pero etngo sueño', '1704581526_8118.jpg', '<p><strong style=\"color: rgb(97, 175, 239);\">activeModal</strong><strong>()</strong></p><p><strong style=\"color: rgb(97, 175, 239);\">activeModal</strong><strong>()</strong></p><p><strong style=\"color: rgb(97, 175, 239);\">activeModal</strong><strong>()</strong></p><p><strong style=\"color: rgb(97, 175, 239);\">activeModal</strong><strong>()</strong></p><p><strong style=\"color: rgb(97, 175, 239);\">activeModal</strong><strong>()</strong></p><p><strong style=\"color: rgb(97, 175, 239);\">activeModal</strong><strong>()</strong></p><p><strong style=\"color: rgb(97, 175, 239);\">activeModal</strong><strong>()</strong></p><p><strong style=\"color: rgb(97, 175, 239);\">activeModal</strong><strong>()</strong></p><p><strong style=\"color: rgb(97, 175, 239);\">activeModal</strong><strong>()</strong></p><p><strong style=\"color: rgb(97, 175, 239);\">activeModal</strong><strong>()</strong></p><p><strong style=\"color: rgb(97, 175, 239);\">activeModal</strong><strong>()</strong></p><p><strong style=\"color: rgb(97, 175, 239);\">activeModal</strong><strong>()</strong></p><p><strong style=\"color: rgb(97, 175, 239);\">activeModal</strong><strong>()</strong></p><p><strong style=\"color: rgb(97, 175, 239);\">activeModal</strong><strong>()</strong></p><p><strong style=\"color: rgb(97, 175, 239);\">activeModal</strong><strong>()</strong></p><p><strong style=\"color: rgb(97, 175, 239);\">activeModal</strong><strong>()</strong></p><p><br></p>', '2024-01-06 23:52:06', 4, 1, 0),
(47, 'Un comunicado efa', '1704636794_9756.jpg', '<p><strong style=\"color: rgb(190, 80, 70);\">&lt;?php</strong></p><p><strong>&nbsp; &nbsp;</strong><strong style=\"color: rgb(86, 182, 194);\">header</strong><strong>(</strong><strong style=\"color: rgb(152, 195, 121);\">\'Location: Login/index.php\'</strong><strong>);</strong></p><p><strong style=\"color: rgb(190, 80, 70);\">?&gt;</strong></p><p><strong style=\"color: rgb(190, 80, 70);\">&lt;?php</strong></p><p><strong>&nbsp; &nbsp;</strong><strong style=\"color: rgb(86, 182, 194);\">header</strong><strong>(</strong><strong style=\"color: rgb(152, 195, 121);\">\'Location: Login/index.php\'</strong><strong>);</strong></p><p><strong style=\"color: rgb(190, 80, 70);\">?&gt;</strong></p><p><strong style=\"color: rgb(190, 80, 70);\">&lt;?php</strong></p><p><strong>&nbsp; &nbsp;</strong><strong style=\"color: rgb(86, 182, 194);\">header</strong><strong>(</strong><strong style=\"color: rgb(152, 195, 121);\">\'Location: Login/index.php\'</strong><strong>);</strong></p><p><strong style=\"color: rgb(190, 80, 70);\">?&gt;</strong></p><p><strong style=\"color: rgb(190, 80, 70);\">&lt;?php</strong></p><p><strong>&nbsp; &nbsp;</strong><strong style=\"color: rgb(86, 182, 194);\">header</strong><strong>(</strong><strong style=\"color: rgb(152, 195, 121);\">\'Location: Login/index.php\'</strong><strong>);</strong></p><p><strong style=\"color: rgb(190, 80, 70);\">?&gt;</strong></p><p><br></p>', '2024-01-07 15:13:14', 2, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodo`
--

CREATE TABLE `periodo` (
  `id_periodo` int(11) NOT NULL,
  `year_id` int(11) NOT NULL,
  `tipo_periodo` int(11) NOT NULL,
  `ordenTipo_periodo` int(11) DEFAULT NULL,
  `fech_inicio` date NOT NULL,
  `fech_final` date NOT NULL,
  `p_stado` enum('ACTIVO','INACTIVO') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ponderados`
--

CREATE TABLE `ponderados` (
  `idpond` int(11) NOT NULL,
  `alumno_id` int(11) DEFAULT NULL,
  `curso_id` int(11) DEFAULT NULL,
  `notaacum` decimal(10,2) DEFAULT NULL,
  `grado_id` int(11) DEFAULT NULL,
  `ordentio` int(11) DEFAULT NULL,
  `tipo_id` int(11) DEFAULT NULL,
  `year_id` int(11) DEFAULT NULL,
  `nivel_id` int(11) DEFAULT NULL,
  `seccion` varchar(45) DEFAULT NULL,
  `userseccion` int(11) DEFAULT NULL,
  `cretedate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registopagos`
--

CREATE TABLE `registopagos` (
  `idregistropagos` int(11) NOT NULL,
  `alumno_id` int(11) DEFAULT NULL,
  `tipo` enum('MATRÍCULA','PENCION') DEFAULT NULL,
  `year_id` int(11) DEFAULT NULL,
  `motoPago` double DEFAULT NULL,
  `stadoPago` enum('PAGADO','PENDIENTE') DEFAULT NULL,
  `fechasPagados` date DEFAULT NULL,
  `prox_pago` date DEFAULT NULL,
  `dateoperation` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `rol_id` int(11) NOT NULL,
  `rol_nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`rol_id`, `rol_nombre`) VALUES
(1, 'ADMINISTRADOR'),
(2, 'DOCENTE'),
(3, 'ALUMNO'),
(4, 'APODERADO'),
(5, 'FUNCIONARIO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stadopenciones`
--

CREATE TABLE `stadopenciones` (
  `idstadop` int(11) NOT NULL,
  `entidad` int(11) DEFAULT NULL,
  `ultimoPagofecha` date DEFAULT NULL,
  `proximoPagoFecha` date DEFAULT NULL,
  `stado` enum('PAGADO','PAGO PENDIENTE') DEFAULT NULL,
  `userSesion` int(11) DEFAULT NULL,
  `createDate` date DEFAULT NULL,
  `updateDate` date DEFAULT NULL,
  `yeayid` int(11) DEFAULT NULL,
  `aplicargo` enum('NO','SI') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoevaluacion`
--

CREATE TABLE `tipoevaluacion` (
  `tipo_id` int(11) NOT NULL,
  `tipo_nombre` varchar(255) NOT NULL,
  `t_stado` enum('ACTIVO','INACTIVO') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tipoevaluacion`
--

INSERT INTO `tipoevaluacion` (`tipo_id`, `tipo_nombre`, `t_stado`) VALUES
(1, 'SOLO NOTAS FINALES', 'ACTIVO'),
(2, 'PERIODO BIMESTRAL', 'ACTIVO'),
(3, 'PERIODO TRIMESTRAL', 'ACTIVO'),
(4, 'PERIODO SEMESTRAL', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tp_docu`
--

CREATE TABLE `tp_docu` (
  `id_tp_docu` int(11) NOT NULL,
  `codigo` char(5) NOT NULL,
  `descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tp_docu`
--

INSERT INTO `tp_docu` (`id_tp_docu`, `codigo`, `descripcion`) VALUES
(1, '01', 'DNI'),
(4, '04', 'Carnet de extranjeria'),
(6, '06', 'RUC'),
(7, '07', 'Pasaporte');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turnos`
--

CREATE TABLE `turnos` (
  `turno_id` int(11) NOT NULL,
  `turno_nombre` varchar(45) NOT NULL,
  `stadoturno` enum('ACTIVO','INACTIVO') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `turnos`
--

INSERT INTO `turnos` (`turno_id`, `turno_nombre`, `stadoturno`) VALUES
(1, 'MAÑANA', 'ACTIVO'),
(2, 'NOCHE', 'ACTIVO'),
(3, 'TARDE', 'ACTIVO'),
(4, 'VESPERTINO', 'ACTIVO'),
(5, 'MATURDINO', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turnos_hora`
--

CREATE TABLE `turnos_hora` (
  `turHora_id` int(11) NOT NULL,
  `Id_year` int(11) NOT NULL,
  `inicioHora` varchar(45) NOT NULL,
  `finHora` varchar(45) NOT NULL,
  `idturno` int(11) NOT NULL,
  `stad` enum('ACTIVO','INACTIVO') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `turnos_hora`
--

INSERT INTO `turnos_hora` (`turHora_id`, `Id_year`, `inicioHora`, `finHora`, `idturno`, `stad`) VALUES
(7, 4, '08:00', '13:29', 1, 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubigeo`
--

CREATE TABLE `ubigeo` (
  `cod_ubigeo` varchar(20) NOT NULL,
  `depa` varchar(200) NOT NULL,
  `provi` varchar(200) NOT NULL,
  `distri` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `ubigeo`
--

INSERT INTO `ubigeo` (`cod_ubigeo`, `depa`, `provi`, `distri`) VALUES
('010101', 'AMAZONAS', 'CHACHAPOYAS', 'CHACHAPOYAS'),
('010102', 'AMAZONAS', 'CHACHAPOYAS', 'ASUNCION'),
('010103', 'AMAZONAS', 'CHACHAPOYAS', 'BALSAS'),
('010104', 'AMAZONAS', 'CHACHAPOYAS', 'CHETO'),
('010105', 'AMAZONAS', 'CHACHAPOYAS', 'CHILIQUIN'),
('010106', 'AMAZONAS', 'CHACHAPOYAS', 'CHUQUIBAMBA'),
('010107', 'AMAZONAS', 'CHACHAPOYAS', 'GRANADA'),
('010108', 'AMAZONAS', 'CHACHAPOYAS', 'HUANCAS'),
('010109', 'AMAZONAS', 'CHACHAPOYAS', 'LA JALCA'),
('010110', 'AMAZONAS', 'CHACHAPOYAS', 'LEIMEBAMBA'),
('010111', 'AMAZONAS', 'CHACHAPOYAS', 'LEVANTO'),
('010112', 'AMAZONAS', 'CHACHAPOYAS', 'MAGDALENA'),
('010113', 'AMAZONAS', 'CHACHAPOYAS', 'MARISCAL CASTILLA'),
('010114', 'AMAZONAS', 'CHACHAPOYAS', 'MOLINOPAMPA'),
('010115', 'AMAZONAS', 'CHACHAPOYAS', 'MONTEVIDEO'),
('010116', 'AMAZONAS', 'CHACHAPOYAS', 'OLLEROS'),
('010117', 'AMAZONAS', 'CHACHAPOYAS', 'QUINJALCA'),
('010118', 'AMAZONAS', 'CHACHAPOYAS', 'SAN FRANCISCO DE DAGUAS'),
('010119', 'AMAZONAS', 'CHACHAPOYAS', 'SAN ISIDRO DE MAINO'),
('010120', 'AMAZONAS', 'CHACHAPOYAS', 'SOLOCO'),
('010121', 'AMAZONAS', 'CHACHAPOYAS', 'SONCHE'),
('010201', 'AMAZONAS', 'BAGUA', 'BAGUA'),
('010202', 'AMAZONAS', 'BAGUA', 'ARAMANGO'),
('010203', 'AMAZONAS', 'BAGUA', 'COPALLIN'),
('010204', 'AMAZONAS', 'BAGUA', 'EL PARCO'),
('010205', 'AMAZONAS', 'BAGUA', 'IMAZA'),
('010206', 'AMAZONAS', 'BAGUA', 'LA PECA'),
('010301', 'AMAZONAS', 'BONGARA', 'JUMBILLA'),
('010302', 'AMAZONAS', 'BONGARA', 'CHISQUILLA'),
('010303', 'AMAZONAS', 'BONGARA', 'CHURUJA'),
('010304', 'AMAZONAS', 'BONGARA', 'COROSHA'),
('010305', 'AMAZONAS', 'BONGARA', 'CUISPES'),
('010306', 'AMAZONAS', 'BONGARA', 'FLORIDA'),
('010307', 'AMAZONAS', 'BONGARA', 'JAZAN'),
('010308', 'AMAZONAS', 'BONGARA', 'RECTA'),
('010309', 'AMAZONAS', 'BONGARA', 'SAN CARLOS'),
('010310', 'AMAZONAS', 'BONGARA', 'SHIPASBAMBA'),
('010311', 'AMAZONAS', 'BONGARA', 'VALERA'),
('010312', 'AMAZONAS', 'BONGARA', 'YAMBRASBAMBA'),
('010401', 'AMAZONAS', 'CONDORCANQUI', 'NIEVA'),
('010402', 'AMAZONAS', 'CONDORCANQUI', 'EL CENEPA'),
('010403', 'AMAZONAS', 'CONDORCANQUI', 'RIO SANTIAGO'),
('010501', 'AMAZONAS', 'LUYA', 'LAMUD'),
('010502', 'AMAZONAS', 'LUYA', 'CAMPORREDONDO'),
('010503', 'AMAZONAS', 'LUYA', 'COCABAMBA'),
('010504', 'AMAZONAS', 'LUYA', 'COLCAMAR'),
('010505', 'AMAZONAS', 'LUYA', 'CONILA'),
('010506', 'AMAZONAS', 'LUYA', 'INGUILPATA'),
('010507', 'AMAZONAS', 'LUYA', 'LONGUITA'),
('010508', 'AMAZONAS', 'LUYA', 'LONYA CHICO'),
('010509', 'AMAZONAS', 'LUYA', 'LUYA'),
('010510', 'AMAZONAS', 'LUYA', 'LUYA VIEJO'),
('010511', 'AMAZONAS', 'LUYA', 'MARIA'),
('010512', 'AMAZONAS', 'LUYA', 'OCALLI'),
('010513', 'AMAZONAS', 'LUYA', 'OCUMAL'),
('010514', 'AMAZONAS', 'LUYA', 'PISUQUIA'),
('010515', 'AMAZONAS', 'LUYA', 'PROVIDENCIA'),
('010516', 'AMAZONAS', 'LUYA', 'SAN CRISTOBAL'),
('010517', 'AMAZONAS', 'LUYA', 'SAN FRANCISCO DEL YESO'),
('010518', 'AMAZONAS', 'LUYA', 'SAN JERONIMO'),
('010519', 'AMAZONAS', 'LUYA', 'SAN JUAN DE LOPECANCHA'),
('010520', 'AMAZONAS', 'LUYA', 'SANTA CATALINA'),
('010521', 'AMAZONAS', 'LUYA', 'SANTO TOMAS'),
('010522', 'AMAZONAS', 'LUYA', 'TINGO'),
('010523', 'AMAZONAS', 'LUYA', 'TRITA'),
('010601', 'AMAZONAS', 'RODRIGUEZ DE MENDOZA', 'SAN NICOLAS'),
('010602', 'AMAZONAS', 'RODRIGUEZ DE MENDOZA', 'CHIRIMOTO'),
('010603', 'AMAZONAS', 'RODRIGUEZ DE MENDOZA', 'COCHAMAL'),
('010604', 'AMAZONAS', 'RODRIGUEZ DE MENDOZA', 'HUAMBO'),
('010605', 'AMAZONAS', 'RODRIGUEZ DE MENDOZA', 'LIMABAMBA'),
('010606', 'AMAZONAS', 'RODRIGUEZ DE MENDOZA', 'LONGAR'),
('010607', 'AMAZONAS', 'RODRIGUEZ DE MENDOZA', 'MARISCAL BENAVIDES'),
('010608', 'AMAZONAS', 'RODRIGUEZ DE MENDOZA', 'MILPUC'),
('010609', 'AMAZONAS', 'RODRIGUEZ DE MENDOZA', 'OMIA'),
('010610', 'AMAZONAS', 'RODRIGUEZ DE MENDOZA', 'SANTA ROSA'),
('010611', 'AMAZONAS', 'RODRIGUEZ DE MENDOZA', 'TOTORA'),
('010612', 'AMAZONAS', 'RODRIGUEZ DE MENDOZA', 'VISTA ALEGRE'),
('010701', 'AMAZONAS', 'UTCUBAMBA', 'BAGUA GRANDE'),
('010702', 'AMAZONAS', 'UTCUBAMBA', 'CAJARURO'),
('010703', 'AMAZONAS', 'UTCUBAMBA', 'CUMBA'),
('010704', 'AMAZONAS', 'UTCUBAMBA', 'EL MILAGRO'),
('010705', 'AMAZONAS', 'UTCUBAMBA', 'JAMALCA'),
('010706', 'AMAZONAS', 'UTCUBAMBA', 'LONYA GRANDE'),
('010707', 'AMAZONAS', 'UTCUBAMBA', 'YAMON'),
('020101', 'ANCASH', 'HUARAZ', 'HUARAZ'),
('020102', 'ANCASH', 'HUARAZ', 'COCHABAMBA'),
('020103', 'ANCASH', 'HUARAZ', 'COLCABAMBA'),
('020104', 'ANCASH', 'HUARAZ', 'HUANCHAY'),
('020105', 'ANCASH', 'HUARAZ', 'INDEPENDENCIA'),
('020106', 'ANCASH', 'HUARAZ', 'JANGAS'),
('020107', 'ANCASH', 'HUARAZ', 'LA LIBERTAD'),
('020108', 'ANCASH', 'HUARAZ', 'OLLEROS'),
('020109', 'ANCASH', 'HUARAZ', 'PAMPAS GRANDE'),
('020110', 'ANCASH', 'HUARAZ', 'PARIACOTO'),
('020111', 'ANCASH', 'HUARAZ', 'PIRA'),
('020112', 'ANCASH', 'HUARAZ', 'TARICA'),
('020201', 'ANCASH', 'AIJA', 'AIJA'),
('020202', 'ANCASH', 'AIJA', 'CORIS'),
('020203', 'ANCASH', 'AIJA', 'HUACLLAN'),
('020204', 'ANCASH', 'AIJA', 'LA MERCED'),
('020205', 'ANCASH', 'AIJA', 'SUCCHA'),
('020301', 'ANCASH', 'ANTONIO RAYMONDI', 'LLAMELLIN'),
('020302', 'ANCASH', 'ANTONIO RAYMONDI', 'ACZO'),
('020303', 'ANCASH', 'ANTONIO RAYMONDI', 'CHACCHO'),
('020304', 'ANCASH', 'ANTONIO RAYMONDI', 'CHINGAS'),
('020305', 'ANCASH', 'ANTONIO RAYMONDI', 'MIRGAS'),
('020306', 'ANCASH', 'ANTONIO RAYMONDI', 'SAN JUAN DE RONTOY'),
('020401', 'ANCASH', 'ASUNCION', 'CHACAS'),
('020402', 'ANCASH', 'ASUNCION', 'ACOCHACA'),
('020501', 'ANCASH', 'BOLOGNESI', 'CHIQUIAN'),
('020502', 'ANCASH', 'BOLOGNESI', 'ABELARDO PARDO LEZAMETA'),
('020503', 'ANCASH', 'BOLOGNESI', 'ANTONIO RAYMONDI'),
('020504', 'ANCASH', 'BOLOGNESI', 'AQUIA'),
('020505', 'ANCASH', 'BOLOGNESI', 'CAJACAY'),
('020506', 'ANCASH', 'BOLOGNESI', 'CANIS'),
('020507', 'ANCASH', 'BOLOGNESI', 'COLQUIOC'),
('020508', 'ANCASH', 'BOLOGNESI', 'HUALLANCA'),
('020509', 'ANCASH', 'BOLOGNESI', 'HUASTA'),
('020510', 'ANCASH', 'BOLOGNESI', 'HUAYLLACAYAN'),
('020511', 'ANCASH', 'BOLOGNESI', 'LA PRIMAVERA'),
('020512', 'ANCASH', 'BOLOGNESI', 'MANGAS'),
('020513', 'ANCASH', 'BOLOGNESI', 'PACLLON'),
('020514', 'ANCASH', 'BOLOGNESI', 'SAN MIGUEL DE CORPANQUI'),
('020515', 'ANCASH', 'BOLOGNESI', 'TICLLOS'),
('020601', 'ANCASH', 'CARHUAZ', 'CARHUAZ'),
('020602', 'ANCASH', 'CARHUAZ', 'ACOPAMPA'),
('020603', 'ANCASH', 'CARHUAZ', 'AMASHCA'),
('020604', 'ANCASH', 'CARHUAZ', 'ANTA'),
('020605', 'ANCASH', 'CARHUAZ', 'ATAQUERO'),
('020606', 'ANCASH', 'CARHUAZ', 'MARCARA'),
('020607', 'ANCASH', 'CARHUAZ', 'PARIAHUANCA'),
('020608', 'ANCASH', 'CARHUAZ', 'SAN MIGUEL DE ACO'),
('020609', 'ANCASH', 'CARHUAZ', 'SHILLA'),
('020610', 'ANCASH', 'CARHUAZ', 'TINCO'),
('020611', 'ANCASH', 'CARHUAZ', 'YUNGAR'),
('020701', 'ANCASH', 'CARLOS FERMIN FITZCARRALD', 'SAN LUIS'),
('020702', 'ANCASH', 'CARLOS FERMIN FITZCARRALD', 'SAN NICOLAS'),
('020703', 'ANCASH', 'CARLOS FERMIN FITZCARRALD', 'YAUYA'),
('020801', 'ANCASH', 'CASMA', 'CASMA'),
('020802', 'ANCASH', 'CASMA', 'BUENA VISTA ALTA'),
('020803', 'ANCASH', 'CASMA', 'COMANDANTE NOEL'),
('020804', 'ANCASH', 'CASMA', 'YAUTAN'),
('020901', 'ANCASH', 'CORONGO', 'CORONGO'),
('020902', 'ANCASH', 'CORONGO', 'ACO'),
('020903', 'ANCASH', 'CORONGO', 'BAMBAS'),
('020904', 'ANCASH', 'CORONGO', 'CUSCA'),
('020905', 'ANCASH', 'CORONGO', 'LA PAMPA'),
('020906', 'ANCASH', 'CORONGO', 'YANAC'),
('020907', 'ANCASH', 'CORONGO', 'YUPAN'),
('021001', 'ANCASH', 'HUARI', 'HUARI'),
('021002', 'ANCASH', 'HUARI', 'ANRA'),
('021003', 'ANCASH', 'HUARI', 'CAJAY'),
('021004', 'ANCASH', 'HUARI', 'CHAVIN DE HUANTAR'),
('021005', 'ANCASH', 'HUARI', 'HUACACHI'),
('021006', 'ANCASH', 'HUARI', 'HUACCHIS'),
('021007', 'ANCASH', 'HUARI', 'HUACHIS'),
('021008', 'ANCASH', 'HUARI', 'HUANTAR'),
('021009', 'ANCASH', 'HUARI', 'MASIN'),
('021010', 'ANCASH', 'HUARI', 'PAUCAS'),
('021011', 'ANCASH', 'HUARI', 'PONTO'),
('021012', 'ANCASH', 'HUARI', 'RAHUAPAMPA'),
('021013', 'ANCASH', 'HUARI', 'RAPAYAN'),
('021014', 'ANCASH', 'HUARI', 'SAN MARCOS'),
('021015', 'ANCASH', 'HUARI', 'SAN PEDRO DE CHANA'),
('021016', 'ANCASH', 'HUARI', 'UCO'),
('021101', 'ANCASH', 'HUARMEY', 'HUARMEY'),
('021102', 'ANCASH', 'HUARMEY', 'COCHAPETI'),
('021103', 'ANCASH', 'HUARMEY', 'CULEBRAS'),
('021104', 'ANCASH', 'HUARMEY', 'HUAYAN'),
('021105', 'ANCASH', 'HUARMEY', 'MALVAS'),
('021201', 'ANCASH', 'HUAYLAS', 'CARAZ'),
('021202', 'ANCASH', 'HUAYLAS', 'HUALLANCA'),
('021203', 'ANCASH', 'HUAYLAS', 'HUATA'),
('021204', 'ANCASH', 'HUAYLAS', 'HUAYLAS'),
('021205', 'ANCASH', 'HUAYLAS', 'MATO'),
('021206', 'ANCASH', 'HUAYLAS', 'PAMPAROMAS'),
('021207', 'ANCASH', 'HUAYLAS', 'PUEBLO LIBRE'),
('021208', 'ANCASH', 'HUAYLAS', 'SANTA CRUZ'),
('021209', 'ANCASH', 'HUAYLAS', 'SANTO TORIBIO'),
('021210', 'ANCASH', 'HUAYLAS', 'YURACMARCA'),
('021301', 'ANCASH', 'MARISCAL LUZURIAGA', 'PISCOBAMBA'),
('021302', 'ANCASH', 'MARISCAL LUZURIAGA', 'CASCA'),
('021303', 'ANCASH', 'MARISCAL LUZURIAGA', 'ELEAZAR GUZMAN BARRON'),
('021304', 'ANCASH', 'MARISCAL LUZURIAGA', 'FIDEL OLIVAS ESCUDERO'),
('021305', 'ANCASH', 'MARISCAL LUZURIAGA', 'LLAMA'),
('021306', 'ANCASH', 'MARISCAL LUZURIAGA', 'LLUMPA'),
('021307', 'ANCASH', 'MARISCAL LUZURIAGA', 'LUCMA'),
('021308', 'ANCASH', 'MARISCAL LUZURIAGA', 'MUSGA'),
('021401', 'ANCASH', 'OCROS', 'OCROS'),
('021402', 'ANCASH', 'OCROS', 'ACAS'),
('021403', 'ANCASH', 'OCROS', 'CAJAMARQUILLA'),
('021404', 'ANCASH', 'OCROS', 'CARHUAPAMPA'),
('021405', 'ANCASH', 'OCROS', 'COCHAS'),
('021406', 'ANCASH', 'OCROS', 'CONGAS'),
('021407', 'ANCASH', 'OCROS', 'LLIPA'),
('021408', 'ANCASH', 'OCROS', 'SAN CRISTOBAL DE RAJAN'),
('021409', 'ANCASH', 'OCROS', 'SAN PEDRO'),
('021410', 'ANCASH', 'OCROS', 'SANTIAGO DE CHILCAS'),
('021501', 'ANCASH', 'PALLASCA', 'CABANA'),
('021502', 'ANCASH', 'PALLASCA', 'BOLOGNESI'),
('021503', 'ANCASH', 'PALLASCA', 'CONCHUCOS'),
('021504', 'ANCASH', 'PALLASCA', 'HUACASCHUQUE'),
('021505', 'ANCASH', 'PALLASCA', 'HUANDOVAL'),
('021506', 'ANCASH', 'PALLASCA', 'LACABAMBA'),
('021507', 'ANCASH', 'PALLASCA', 'LLAPO'),
('021508', 'ANCASH', 'PALLASCA', 'PALLASCA'),
('021509', 'ANCASH', 'PALLASCA', 'PAMPAS'),
('021510', 'ANCASH', 'PALLASCA', 'SANTA ROSA'),
('021511', 'ANCASH', 'PALLASCA', 'TAUCA'),
('021601', 'ANCASH', 'POMABAMBA', 'POMABAMBA'),
('021602', 'ANCASH', 'POMABAMBA', 'HUAYLLAN'),
('021603', 'ANCASH', 'POMABAMBA', 'PAROBAMBA'),
('021604', 'ANCASH', 'POMABAMBA', 'QUINUABAMBA'),
('021701', 'ANCASH', 'RECUAY', 'RECUAY'),
('021702', 'ANCASH', 'RECUAY', 'CATAC'),
('021703', 'ANCASH', 'RECUAY', 'COTAPARACO'),
('021704', 'ANCASH', 'RECUAY', 'HUAYLLAPAMPA'),
('021705', 'ANCASH', 'RECUAY', 'LLACLLIN'),
('021706', 'ANCASH', 'RECUAY', 'MARCA'),
('021707', 'ANCASH', 'RECUAY', 'PAMPAS CHICO'),
('021708', 'ANCASH', 'RECUAY', 'PARARIN'),
('021709', 'ANCASH', 'RECUAY', 'TAPACOCHA'),
('021710', 'ANCASH', 'RECUAY', 'TICAPAMPA'),
('021801', 'ANCASH', 'SANTA', 'CHIMBOTE'),
('021802', 'ANCASH', 'SANTA', 'CACERES DEL PERU'),
('021803', 'ANCASH', 'SANTA', 'COISHCO'),
('021804', 'ANCASH', 'SANTA', 'MACATE'),
('021805', 'ANCASH', 'SANTA', 'MORO'),
('021806', 'ANCASH', 'SANTA', 'NEPEÑA'),
('021807', 'ANCASH', 'SANTA', 'SAMANCO'),
('021808', 'ANCASH', 'SANTA', 'SANTA'),
('021809', 'ANCASH', 'SANTA', 'NUEVO CHIMBOTE'),
('021901', 'ANCASH', 'SIHUAS', 'SIHUAS'),
('021902', 'ANCASH', 'SIHUAS', 'ACOBAMBA'),
('021903', 'ANCASH', 'SIHUAS', 'ALFONSO UGARTE'),
('021904', 'ANCASH', 'SIHUAS', 'CASHAPAMPA'),
('021905', 'ANCASH', 'SIHUAS', 'CHINGALPO'),
('021906', 'ANCASH', 'SIHUAS', 'HUAYLLABAMBA'),
('021907', 'ANCASH', 'SIHUAS', 'QUICHES'),
('021908', 'ANCASH', 'SIHUAS', 'RAGASH'),
('021909', 'ANCASH', 'SIHUAS', 'SAN JUAN'),
('021910', 'ANCASH', 'SIHUAS', 'SICSIBAMBA'),
('022001', 'ANCASH', 'YUNGAY', 'YUNGAY'),
('022002', 'ANCASH', 'YUNGAY', 'CASCAPARA'),
('022003', 'ANCASH', 'YUNGAY', 'MANCOS'),
('022004', 'ANCASH', 'YUNGAY', 'MATACOTO'),
('022005', 'ANCASH', 'YUNGAY', 'QUILLO'),
('022006', 'ANCASH', 'YUNGAY', 'RANRAHIRCA'),
('022007', 'ANCASH', 'YUNGAY', 'SHUPLUY'),
('022008', 'ANCASH', 'YUNGAY', 'YANAMA'),
('030101', 'APURIMAC', 'ABANCAY', 'ABANCAY'),
('030102', 'APURIMAC', 'ABANCAY', 'CHACOCHE'),
('030103', 'APURIMAC', 'ABANCAY', 'CIRCA'),
('030104', 'APURIMAC', 'ABANCAY', 'CURAHUASI'),
('030105', 'APURIMAC', 'ABANCAY', 'HUANIPACA'),
('030106', 'APURIMAC', 'ABANCAY', 'LAMBRAMA'),
('030107', 'APURIMAC', 'ABANCAY', 'PICHIRHUA'),
('030108', 'APURIMAC', 'ABANCAY', 'SAN PEDRO DE CACHORA'),
('030109', 'APURIMAC', 'ABANCAY', 'TAMBURCO'),
('030201', 'APURIMAC', 'ANDAHUAYLAS', 'ANDAHUAYLAS'),
('030202', 'APURIMAC', 'ANDAHUAYLAS', 'ANDARAPA'),
('030203', 'APURIMAC', 'ANDAHUAYLAS', 'CHIARA'),
('030204', 'APURIMAC', 'ANDAHUAYLAS', 'HUANCARAMA'),
('030205', 'APURIMAC', 'ANDAHUAYLAS', 'HUANCARAY'),
('030206', 'APURIMAC', 'ANDAHUAYLAS', 'HUAYANA'),
('030207', 'APURIMAC', 'ANDAHUAYLAS', 'KISHUARA'),
('030208', 'APURIMAC', 'ANDAHUAYLAS', 'PACOBAMBA'),
('030209', 'APURIMAC', 'ANDAHUAYLAS', 'PACUCHA'),
('030210', 'APURIMAC', 'ANDAHUAYLAS', 'PAMPACHIRI'),
('030211', 'APURIMAC', 'ANDAHUAYLAS', 'POMACOCHA'),
('030212', 'APURIMAC', 'ANDAHUAYLAS', 'SAN ANTONIO DE CACHI'),
('030213', 'APURIMAC', 'ANDAHUAYLAS', 'SAN JERONIMO'),
('030214', 'APURIMAC', 'ANDAHUAYLAS', 'SAN MIGUEL DE CHACCRAMPA'),
('030215', 'APURIMAC', 'ANDAHUAYLAS', 'SANTA MARIA DE CHICMO'),
('030216', 'APURIMAC', 'ANDAHUAYLAS', 'TALAVERA'),
('030217', 'APURIMAC', 'ANDAHUAYLAS', 'TUMAY HUARACA'),
('030218', 'APURIMAC', 'ANDAHUAYLAS', 'TURPO'),
('030219', 'APURIMAC', 'ANDAHUAYLAS', 'KAQUIABAMBA'),
('030220', 'APURIMAC', 'ANDAHUAYLAS', 'JOSE MARIA ARGUEDAS'),
('030301', 'APURIMAC', 'ANTABAMBA', 'ANTABAMBA'),
('030302', 'APURIMAC', 'ANTABAMBA', 'EL ORO'),
('030303', 'APURIMAC', 'ANTABAMBA', 'HUAQUIRCA'),
('030304', 'APURIMAC', 'ANTABAMBA', 'JUAN ESPINOZA MEDRANO'),
('030305', 'APURIMAC', 'ANTABAMBA', 'OROPESA'),
('030306', 'APURIMAC', 'ANTABAMBA', 'PACHACONAS'),
('030307', 'APURIMAC', 'ANTABAMBA', 'SABAINO'),
('030401', 'APURIMAC', 'AYMARAES', 'CHALHUANCA'),
('030402', 'APURIMAC', 'AYMARAES', 'CAPAYA'),
('030403', 'APURIMAC', 'AYMARAES', 'CARAYBAMBA'),
('030404', 'APURIMAC', 'AYMARAES', 'CHAPIMARCA'),
('030405', 'APURIMAC', 'AYMARAES', 'COLCABAMBA'),
('030406', 'APURIMAC', 'AYMARAES', 'COTARUSE'),
('030407', 'APURIMAC', 'AYMARAES', 'IHUAYLLO'),
('030408', 'APURIMAC', 'AYMARAES', 'JUSTO APU SAHUARAURA'),
('030409', 'APURIMAC', 'AYMARAES', 'LUCRE'),
('030410', 'APURIMAC', 'AYMARAES', 'POCOHUANCA'),
('030411', 'APURIMAC', 'AYMARAES', 'SAN JUAN DE CHACÑA'),
('030412', 'APURIMAC', 'AYMARAES', 'SAÑAYCA'),
('030413', 'APURIMAC', 'AYMARAES', 'SORAYA'),
('030414', 'APURIMAC', 'AYMARAES', 'TAPAIRIHUA'),
('030415', 'APURIMAC', 'AYMARAES', 'TINTAY'),
('030416', 'APURIMAC', 'AYMARAES', 'TORAYA'),
('030417', 'APURIMAC', 'AYMARAES', 'YANACA'),
('030501', 'APURIMAC', 'COTABAMBAS', 'TAMBOBAMBA'),
('030502', 'APURIMAC', 'COTABAMBAS', 'COTABAMBAS'),
('030503', 'APURIMAC', 'COTABAMBAS', 'COYLLURQUI'),
('030504', 'APURIMAC', 'COTABAMBAS', 'HAQUIRA'),
('030505', 'APURIMAC', 'COTABAMBAS', 'MARA'),
('030506', 'APURIMAC', 'COTABAMBAS', 'CHALLHUAHUACHO'),
('030601', 'APURIMAC', 'CHINCHEROS', 'CHINCHEROS'),
('030602', 'APURIMAC', 'CHINCHEROS', 'ANCO_HUALLO'),
('030603', 'APURIMAC', 'CHINCHEROS', 'COCHARCAS'),
('030604', 'APURIMAC', 'CHINCHEROS', 'HUACCANA'),
('030605', 'APURIMAC', 'CHINCHEROS', 'OCOBAMBA'),
('030606', 'APURIMAC', 'CHINCHEROS', 'ONGOY'),
('030607', 'APURIMAC', 'CHINCHEROS', 'URANMARCA'),
('030608', 'APURIMAC', 'CHINCHEROS', 'RANRACANCHA'),
('030609', 'APURIMAC', 'CHINCHEROS', 'ROCCHACC'),
('030610', 'APURIMAC', 'CHINCHEROS', 'EL PORVENIR'),
('030611', 'APURIMAC', 'CHINCHEROS', 'LOS CHANKAS'),
('030701', 'APURIMAC', 'GRAU', 'CHUQUIBAMBILLA'),
('030702', 'APURIMAC', 'GRAU', 'CURPAHUASI'),
('030703', 'APURIMAC', 'GRAU', 'GAMARRA'),
('030704', 'APURIMAC', 'GRAU', 'HUAYLLATI'),
('030705', 'APURIMAC', 'GRAU', 'MAMARA'),
('030706', 'APURIMAC', 'GRAU', 'MICAELA BASTIDAS'),
('030707', 'APURIMAC', 'GRAU', 'PATAYPAMPA'),
('030708', 'APURIMAC', 'GRAU', 'PROGRESO'),
('030709', 'APURIMAC', 'GRAU', 'SAN ANTONIO'),
('030710', 'APURIMAC', 'GRAU', 'SANTA ROSA'),
('030711', 'APURIMAC', 'GRAU', 'TURPAY'),
('030712', 'APURIMAC', 'GRAU', 'VILCABAMBA'),
('030713', 'APURIMAC', 'GRAU', 'VIRUNDO'),
('030714', 'APURIMAC', 'GRAU', 'CURASCO'),
('040101', 'AREQUIPA', 'AREQUIPA', 'AREQUIPA'),
('040102', 'AREQUIPA', 'AREQUIPA', 'ALTO SELVA ALEGRE'),
('040103', 'AREQUIPA', 'AREQUIPA', 'CAYMA'),
('040104', 'AREQUIPA', 'AREQUIPA', 'CERRO COLORADO'),
('040105', 'AREQUIPA', 'AREQUIPA', 'CHARACATO'),
('040106', 'AREQUIPA', 'AREQUIPA', 'CHIGUATA'),
('040107', 'AREQUIPA', 'AREQUIPA', 'JACOBO HUNTER'),
('040108', 'AREQUIPA', 'AREQUIPA', 'LA JOYA'),
('040109', 'AREQUIPA', 'AREQUIPA', 'MARIANO MELGAR'),
('040110', 'AREQUIPA', 'AREQUIPA', 'MIRAFLORES'),
('040111', 'AREQUIPA', 'AREQUIPA', 'MOLLEBAYA'),
('040112', 'AREQUIPA', 'AREQUIPA', 'PAUCARPATA'),
('040113', 'AREQUIPA', 'AREQUIPA', 'POCSI'),
('040114', 'AREQUIPA', 'AREQUIPA', 'POLOBAYA'),
('040115', 'AREQUIPA', 'AREQUIPA', 'QUEQUEÑA'),
('040116', 'AREQUIPA', 'AREQUIPA', 'SABANDIA'),
('040117', 'AREQUIPA', 'AREQUIPA', 'SACHACA'),
('040118', 'AREQUIPA', 'AREQUIPA', 'SAN JUAN DE SIGUAS'),
('040119', 'AREQUIPA', 'AREQUIPA', 'SAN JUAN DE TARUCANI'),
('040120', 'AREQUIPA', 'AREQUIPA', 'SANTA ISABEL DE SIGUAS'),
('040121', 'AREQUIPA', 'AREQUIPA', 'SANTA RITA DE SIGUAS'),
('040122', 'AREQUIPA', 'AREQUIPA', 'SOCABAYA'),
('040123', 'AREQUIPA', 'AREQUIPA', 'TIABAYA'),
('040124', 'AREQUIPA', 'AREQUIPA', 'UCHUMAYO'),
('040125', 'AREQUIPA', 'AREQUIPA', 'VITOR'),
('040126', 'AREQUIPA', 'AREQUIPA', 'YANAHUARA'),
('040127', 'AREQUIPA', 'AREQUIPA', 'YARABAMBA'),
('040128', 'AREQUIPA', 'AREQUIPA', 'YURA'),
('040129', 'AREQUIPA', 'AREQUIPA', 'JOSE LUIS BUSTAMANTE Y RIVERO'),
('040201', 'AREQUIPA', 'CAMANA', 'CAMANA'),
('040202', 'AREQUIPA', 'CAMANA', 'JOSE MARIA QUIMPER'),
('040203', 'AREQUIPA', 'CAMANA', 'MARIANO NICOLAS VALCARCEL'),
('040204', 'AREQUIPA', 'CAMANA', 'MARISCAL CACERES'),
('040205', 'AREQUIPA', 'CAMANA', 'NICOLAS DE PIEROLA'),
('040206', 'AREQUIPA', 'CAMANA', 'OCOÑA'),
('040207', 'AREQUIPA', 'CAMANA', 'QUILCA'),
('040208', 'AREQUIPA', 'CAMANA', 'SAMUEL PASTOR'),
('040301', 'AREQUIPA', 'CARAVELI', 'CARAVELI'),
('040302', 'AREQUIPA', 'CARAVELI', 'ACARI'),
('040303', 'AREQUIPA', 'CARAVELI', 'ATICO'),
('040304', 'AREQUIPA', 'CARAVELI', 'ATIQUIPA'),
('040305', 'AREQUIPA', 'CARAVELI', 'BELLA UNION'),
('040306', 'AREQUIPA', 'CARAVELI', 'CAHUACHO'),
('040307', 'AREQUIPA', 'CARAVELI', 'CHALA'),
('040308', 'AREQUIPA', 'CARAVELI', 'CHAPARRA'),
('040309', 'AREQUIPA', 'CARAVELI', 'HUANUHUANU'),
('040310', 'AREQUIPA', 'CARAVELI', 'JAQUI'),
('040311', 'AREQUIPA', 'CARAVELI', 'LOMAS'),
('040312', 'AREQUIPA', 'CARAVELI', 'QUICACHA'),
('040313', 'AREQUIPA', 'CARAVELI', 'YAUCA'),
('040401', 'AREQUIPA', 'CASTILLA', 'APLAO'),
('040402', 'AREQUIPA', 'CASTILLA', 'ANDAGUA'),
('040403', 'AREQUIPA', 'CASTILLA', 'AYO'),
('040404', 'AREQUIPA', 'CASTILLA', 'CHACHAS'),
('040405', 'AREQUIPA', 'CASTILLA', 'CHILCAYMARCA'),
('040406', 'AREQUIPA', 'CASTILLA', 'CHOCO'),
('040407', 'AREQUIPA', 'CASTILLA', 'HUANCARQUI'),
('040408', 'AREQUIPA', 'CASTILLA', 'MACHAGUAY'),
('040409', 'AREQUIPA', 'CASTILLA', 'ORCOPAMPA'),
('040410', 'AREQUIPA', 'CASTILLA', 'PAMPACOLCA'),
('040411', 'AREQUIPA', 'CASTILLA', 'TIPAN'),
('040412', 'AREQUIPA', 'CASTILLA', 'UÑON'),
('040413', 'AREQUIPA', 'CASTILLA', 'URACA'),
('040414', 'AREQUIPA', 'CASTILLA', 'VIRACO'),
('040501', 'AREQUIPA', 'CAYLLOMA', 'CHIVAY'),
('040502', 'AREQUIPA', 'CAYLLOMA', 'ACHOMA'),
('040503', 'AREQUIPA', 'CAYLLOMA', 'CABANACONDE'),
('040504', 'AREQUIPA', 'CAYLLOMA', 'CALLALLI'),
('040505', 'AREQUIPA', 'CAYLLOMA', 'CAYLLOMA'),
('040506', 'AREQUIPA', 'CAYLLOMA', 'COPORAQUE'),
('040507', 'AREQUIPA', 'CAYLLOMA', 'HUAMBO'),
('040508', 'AREQUIPA', 'CAYLLOMA', 'HUANCA'),
('040509', 'AREQUIPA', 'CAYLLOMA', 'ICHUPAMPA'),
('040510', 'AREQUIPA', 'CAYLLOMA', 'LARI'),
('040511', 'AREQUIPA', 'CAYLLOMA', 'LLUTA'),
('040512', 'AREQUIPA', 'CAYLLOMA', 'MACA'),
('040513', 'AREQUIPA', 'CAYLLOMA', 'MADRIGAL'),
('040514', 'AREQUIPA', 'CAYLLOMA', 'SAN ANTONIO DE CHUCA'),
('040515', 'AREQUIPA', 'CAYLLOMA', 'SIBAYO'),
('040516', 'AREQUIPA', 'CAYLLOMA', 'TAPAY'),
('040517', 'AREQUIPA', 'CAYLLOMA', 'TISCO'),
('040518', 'AREQUIPA', 'CAYLLOMA', 'TUTI'),
('040519', 'AREQUIPA', 'CAYLLOMA', 'YANQUE'),
('040520', 'AREQUIPA', 'CAYLLOMA', 'MAJES'),
('040601', 'AREQUIPA', 'CONDESUYOS', 'CHUQUIBAMBA'),
('040602', 'AREQUIPA', 'CONDESUYOS', 'ANDARAY'),
('040603', 'AREQUIPA', 'CONDESUYOS', 'CAYARANI'),
('040604', 'AREQUIPA', 'CONDESUYOS', 'CHICHAS'),
('040605', 'AREQUIPA', 'CONDESUYOS', 'IRAY'),
('040606', 'AREQUIPA', 'CONDESUYOS', 'RIO GRANDE'),
('040607', 'AREQUIPA', 'CONDESUYOS', 'SALAMANCA'),
('040608', 'AREQUIPA', 'CONDESUYOS', 'YANAQUIHUA'),
('040701', 'AREQUIPA', 'ISLAY', 'MOLLENDO'),
('040702', 'AREQUIPA', 'ISLAY', 'COCACHACRA'),
('040703', 'AREQUIPA', 'ISLAY', 'DEAN VALDIVIA'),
('040704', 'AREQUIPA', 'ISLAY', 'ISLAY'),
('040705', 'AREQUIPA', 'ISLAY', 'MEJIA'),
('040706', 'AREQUIPA', 'ISLAY', 'PUNTA DE BOMBON'),
('040801', 'AREQUIPA', 'LA UNION', 'COTAHUASI'),
('040802', 'AREQUIPA', 'LA UNION', 'ALCA'),
('040803', 'AREQUIPA', 'LA UNION', 'CHARCANA'),
('040804', 'AREQUIPA', 'LA UNION', 'HUAYNACOTAS'),
('040805', 'AREQUIPA', 'LA UNION', 'PAMPAMARCA'),
('040806', 'AREQUIPA', 'LA UNION', 'PUYCA'),
('040807', 'AREQUIPA', 'LA UNION', 'QUECHUALLA'),
('040808', 'AREQUIPA', 'LA UNION', 'SAYLA'),
('040809', 'AREQUIPA', 'LA UNION', 'TAURIA'),
('040810', 'AREQUIPA', 'LA UNION', 'TOMEPAMPA'),
('040811', 'AREQUIPA', 'LA UNION', 'TORO'),
('050101', 'AYACUCHO', 'HUAMANGA', 'AYACUCHO'),
('050102', 'AYACUCHO', 'HUAMANGA', 'ACOCRO'),
('050103', 'AYACUCHO', 'HUAMANGA', 'ACOS VINCHOS'),
('050104', 'AYACUCHO', 'HUAMANGA', 'CARMEN ALTO'),
('050105', 'AYACUCHO', 'HUAMANGA', 'CHIARA'),
('050106', 'AYACUCHO', 'HUAMANGA', 'OCROS'),
('050107', 'AYACUCHO', 'HUAMANGA', 'PACAYCASA'),
('050108', 'AYACUCHO', 'HUAMANGA', 'QUINUA'),
('050109', 'AYACUCHO', 'HUAMANGA', 'SAN JOSE DE TICLLAS'),
('050110', 'AYACUCHO', 'HUAMANGA', 'SAN JUAN BAUTISTA'),
('050111', 'AYACUCHO', 'HUAMANGA', 'SANTIAGO DE PISCHA'),
('050112', 'AYACUCHO', 'HUAMANGA', 'SOCOS'),
('050113', 'AYACUCHO', 'HUAMANGA', 'TAMBILLO'),
('050114', 'AYACUCHO', 'HUAMANGA', 'VINCHOS'),
('050115', 'AYACUCHO', 'HUAMANGA', 'JESUS NAZARENO'),
('050116', 'AYACUCHO', 'HUAMANGA', 'ANDRES AVELINO CACERES DORREGARAY'),
('050201', 'AYACUCHO', 'CANGALLO', 'CANGALLO'),
('050202', 'AYACUCHO', 'CANGALLO', 'CHUSCHI'),
('050203', 'AYACUCHO', 'CANGALLO', 'LOS MOROCHUCOS'),
('050204', 'AYACUCHO', 'CANGALLO', 'MARIA PARADO DE BELLIDO'),
('050205', 'AYACUCHO', 'CANGALLO', 'PARAS'),
('050206', 'AYACUCHO', 'CANGALLO', 'TOTOS'),
('050301', 'AYACUCHO', 'HUANCA SANCOS', 'SANCOS'),
('050302', 'AYACUCHO', 'HUANCA SANCOS', 'CARAPO'),
('050303', 'AYACUCHO', 'HUANCA SANCOS', 'SACSAMARCA'),
('050304', 'AYACUCHO', 'HUANCA SANCOS', 'SANTIAGO DE LUCANAMARCA'),
('050401', 'AYACUCHO', 'HUANTA', 'HUANTA'),
('050402', 'AYACUCHO', 'HUANTA', 'AYAHUANCO'),
('050403', 'AYACUCHO', 'HUANTA', 'HUAMANGUILLA'),
('050404', 'AYACUCHO', 'HUANTA', 'IGUAIN'),
('050405', 'AYACUCHO', 'HUANTA', 'LURICOCHA'),
('050406', 'AYACUCHO', 'HUANTA', 'SANTILLANA'),
('050407', 'AYACUCHO', 'HUANTA', 'SIVIA'),
('050408', 'AYACUCHO', 'HUANTA', 'LLOCHEGUA'),
('050409', 'AYACUCHO', 'HUANTA', 'CANAYRE'),
('050410', 'AYACUCHO', 'HUANTA', 'UCHURACCAY'),
('050411', 'AYACUCHO', 'HUANTA', 'PUCACOLPA'),
('050412', 'AYACUCHO', 'HUANTA', 'CHACA'),
('050501', 'AYACUCHO', 'LA MAR', 'SAN MIGUEL'),
('050502', 'AYACUCHO', 'LA MAR', 'ANCO'),
('050503', 'AYACUCHO', 'LA MAR', 'AYNA'),
('050504', 'AYACUCHO', 'LA MAR', 'CHILCAS'),
('050505', 'AYACUCHO', 'LA MAR', 'CHUNGUI'),
('050506', 'AYACUCHO', 'LA MAR', 'LUIS CARRANZA'),
('050507', 'AYACUCHO', 'LA MAR', 'SANTA ROSA'),
('050508', 'AYACUCHO', 'LA MAR', 'TAMBO'),
('050509', 'AYACUCHO', 'LA MAR', 'SAMUGARI'),
('050510', 'AYACUCHO', 'LA MAR', 'ANCHIHUAY'),
('050511', 'AYACUCHO', 'LA MAR', 'ORONCCOY'),
('050601', 'AYACUCHO', 'LUCANAS', 'PUQUIO'),
('050602', 'AYACUCHO', 'LUCANAS', 'AUCARA'),
('050603', 'AYACUCHO', 'LUCANAS', 'CABANA'),
('050604', 'AYACUCHO', 'LUCANAS', 'CARMEN SALCEDO'),
('050605', 'AYACUCHO', 'LUCANAS', 'CHAVIÑA'),
('050606', 'AYACUCHO', 'LUCANAS', 'CHIPAO'),
('050607', 'AYACUCHO', 'LUCANAS', 'HUAC-HUAS'),
('050608', 'AYACUCHO', 'LUCANAS', 'LARAMATE'),
('050609', 'AYACUCHO', 'LUCANAS', 'LEONCIO PRADO'),
('050610', 'AYACUCHO', 'LUCANAS', 'LLAUTA'),
('050611', 'AYACUCHO', 'LUCANAS', 'LUCANAS'),
('050612', 'AYACUCHO', 'LUCANAS', 'OCAÑA'),
('050613', 'AYACUCHO', 'LUCANAS', 'OTOCA'),
('050614', 'AYACUCHO', 'LUCANAS', 'SAISA'),
('050615', 'AYACUCHO', 'LUCANAS', 'SAN CRISTOBAL'),
('050616', 'AYACUCHO', 'LUCANAS', 'SAN JUAN'),
('050617', 'AYACUCHO', 'LUCANAS', 'SAN PEDRO'),
('050618', 'AYACUCHO', 'LUCANAS', 'SAN PEDRO DE PALCO'),
('050619', 'AYACUCHO', 'LUCANAS', 'SANCOS'),
('050620', 'AYACUCHO', 'LUCANAS', 'SANTA ANA DE HUAYCAHUACHO'),
('050621', 'AYACUCHO', 'LUCANAS', 'SANTA LUCIA'),
('050701', 'AYACUCHO', 'PARINACOCHAS', 'CORACORA'),
('050702', 'AYACUCHO', 'PARINACOCHAS', 'CHUMPI'),
('050703', 'AYACUCHO', 'PARINACOCHAS', 'CORONEL CASTAÑEDA'),
('050704', 'AYACUCHO', 'PARINACOCHAS', 'PACAPAUSA'),
('050705', 'AYACUCHO', 'PARINACOCHAS', 'PULLO'),
('050706', 'AYACUCHO', 'PARINACOCHAS', 'PUYUSCA'),
('050707', 'AYACUCHO', 'PARINACOCHAS', 'SAN FRANCISCO DE RAVACAYCO'),
('050708', 'AYACUCHO', 'PARINACOCHAS', 'UPAHUACHO'),
('050801', 'AYACUCHO', 'PAUCAR DEL SARA SARA', 'PAUSA'),
('050802', 'AYACUCHO', 'PAUCAR DEL SARA SARA', 'COLTA'),
('050803', 'AYACUCHO', 'PAUCAR DEL SARA SARA', 'CORCULLA'),
('050804', 'AYACUCHO', 'PAUCAR DEL SARA SARA', 'LAMPA'),
('050805', 'AYACUCHO', 'PAUCAR DEL SARA SARA', 'MARCABAMBA'),
('050806', 'AYACUCHO', 'PAUCAR DEL SARA SARA', 'OYOLO'),
('050807', 'AYACUCHO', 'PAUCAR DEL SARA SARA', 'PARARCA'),
('050808', 'AYACUCHO', 'PAUCAR DEL SARA SARA', 'SAN JAVIER DE ALPABAMBA'),
('050809', 'AYACUCHO', 'PAUCAR DEL SARA SARA', 'SAN JOSE DE USHUA'),
('050810', 'AYACUCHO', 'PAUCAR DEL SARA SARA', 'SARA SARA'),
('050901', 'AYACUCHO', 'SUCRE', 'QUEROBAMBA'),
('050902', 'AYACUCHO', 'SUCRE', 'BELEN'),
('050903', 'AYACUCHO', 'SUCRE', 'CHALCOS'),
('050904', 'AYACUCHO', 'SUCRE', 'CHILCAYOC'),
('050905', 'AYACUCHO', 'SUCRE', 'HUACAÑA'),
('050906', 'AYACUCHO', 'SUCRE', 'MORCOLLA'),
('050907', 'AYACUCHO', 'SUCRE', 'PAICO'),
('050908', 'AYACUCHO', 'SUCRE', 'SAN PEDRO DE LARCAY'),
('050909', 'AYACUCHO', 'SUCRE', 'SAN SALVADOR DE QUIJE'),
('050910', 'AYACUCHO', 'SUCRE', 'SANTIAGO DE PAUCARAY'),
('050911', 'AYACUCHO', 'SUCRE', 'SORAS'),
('051001', 'AYACUCHO', 'VICTOR FAJARDO', 'HUANCAPI'),
('051002', 'AYACUCHO', 'VICTOR FAJARDO', 'ALCAMENCA'),
('051003', 'AYACUCHO', 'VICTOR FAJARDO', 'APONGO'),
('051004', 'AYACUCHO', 'VICTOR FAJARDO', 'ASQUIPATA'),
('051005', 'AYACUCHO', 'VICTOR FAJARDO', 'CANARIA'),
('051006', 'AYACUCHO', 'VICTOR FAJARDO', 'CAYARA'),
('051007', 'AYACUCHO', 'VICTOR FAJARDO', 'COLCA'),
('051008', 'AYACUCHO', 'VICTOR FAJARDO', 'HUAMANQUIQUIA'),
('051009', 'AYACUCHO', 'VICTOR FAJARDO', 'HUANCARAYLLA'),
('051010', 'AYACUCHO', 'VICTOR FAJARDO', 'HUALLA'),
('051011', 'AYACUCHO', 'VICTOR FAJARDO', 'SARHUA'),
('051012', 'AYACUCHO', 'VICTOR FAJARDO', 'VILCANCHOS'),
('051101', 'AYACUCHO', 'VILCAS HUAMAN', 'VILCAS HUAMAN'),
('051102', 'AYACUCHO', 'VILCAS HUAMAN', 'ACCOMARCA'),
('051103', 'AYACUCHO', 'VILCAS HUAMAN', 'CARHUANCA'),
('051104', 'AYACUCHO', 'VILCAS HUAMAN', 'CONCEPCION'),
('051105', 'AYACUCHO', 'VILCAS HUAMAN', 'HUAMBALPA'),
('051106', 'AYACUCHO', 'VILCAS HUAMAN', 'INDEPENDENCIA'),
('051107', 'AYACUCHO', 'VILCAS HUAMAN', 'SAURAMA'),
('051108', 'AYACUCHO', 'VILCAS HUAMAN', 'VISCHONGO'),
('060101', 'CAJAMARCA', 'CAJAMARCA', 'CAJAMARCA'),
('060102', 'CAJAMARCA', 'CAJAMARCA', 'ASUNCION'),
('060103', 'CAJAMARCA', 'CAJAMARCA', 'CHETILLA'),
('060104', 'CAJAMARCA', 'CAJAMARCA', 'COSPAN'),
('060105', 'CAJAMARCA', 'CAJAMARCA', 'ENCAÑADA'),
('060106', 'CAJAMARCA', 'CAJAMARCA', 'JESUS'),
('060107', 'CAJAMARCA', 'CAJAMARCA', 'LLACANORA'),
('060108', 'CAJAMARCA', 'CAJAMARCA', 'LOS BAÑOS DEL INCA'),
('060109', 'CAJAMARCA', 'CAJAMARCA', 'MAGDALENA'),
('060110', 'CAJAMARCA', 'CAJAMARCA', 'MATARA'),
('060111', 'CAJAMARCA', 'CAJAMARCA', 'NAMORA'),
('060112', 'CAJAMARCA', 'CAJAMARCA', 'SAN JUAN'),
('060201', 'CAJAMARCA', 'CAJABAMBA', 'CAJABAMBA'),
('060202', 'CAJAMARCA', 'CAJABAMBA', 'CACHACHI'),
('060203', 'CAJAMARCA', 'CAJABAMBA', 'CONDEBAMBA'),
('060204', 'CAJAMARCA', 'CAJABAMBA', 'SITACOCHA'),
('060301', 'CAJAMARCA', 'CELENDIN', 'CELENDIN'),
('060302', 'CAJAMARCA', 'CELENDIN', 'CHUMUCH'),
('060303', 'CAJAMARCA', 'CELENDIN', 'CORTEGANA'),
('060304', 'CAJAMARCA', 'CELENDIN', 'HUASMIN'),
('060305', 'CAJAMARCA', 'CELENDIN', 'JORGE CHAVEZ'),
('060306', 'CAJAMARCA', 'CELENDIN', 'JOSE GALVEZ'),
('060307', 'CAJAMARCA', 'CELENDIN', 'MIGUEL IGLESIAS'),
('060308', 'CAJAMARCA', 'CELENDIN', 'OXAMARCA'),
('060309', 'CAJAMARCA', 'CELENDIN', 'SOROCHUCO'),
('060310', 'CAJAMARCA', 'CELENDIN', 'SUCRE'),
('060311', 'CAJAMARCA', 'CELENDIN', 'UTCO'),
('060312', 'CAJAMARCA', 'CELENDIN', 'LA LIBERTAD DE PALLAN'),
('060401', 'CAJAMARCA', 'CHOTA', 'CHOTA'),
('060402', 'CAJAMARCA', 'CHOTA', 'ANGUIA'),
('060403', 'CAJAMARCA', 'CHOTA', 'CHADIN'),
('060404', 'CAJAMARCA', 'CHOTA', 'CHIGUIRIP'),
('060405', 'CAJAMARCA', 'CHOTA', 'CHIMBAN'),
('060406', 'CAJAMARCA', 'CHOTA', 'CHOROPAMPA'),
('060407', 'CAJAMARCA', 'CHOTA', 'COCHABAMBA'),
('060408', 'CAJAMARCA', 'CHOTA', 'CONCHAN'),
('060409', 'CAJAMARCA', 'CHOTA', 'HUAMBOS'),
('060410', 'CAJAMARCA', 'CHOTA', 'LAJAS'),
('060411', 'CAJAMARCA', 'CHOTA', 'LLAMA'),
('060412', 'CAJAMARCA', 'CHOTA', 'MIRACOSTA'),
('060413', 'CAJAMARCA', 'CHOTA', 'PACCHA'),
('060414', 'CAJAMARCA', 'CHOTA', 'PION'),
('060415', 'CAJAMARCA', 'CHOTA', 'QUEROCOTO'),
('060416', 'CAJAMARCA', 'CHOTA', 'SAN JUAN DE LICUPIS'),
('060417', 'CAJAMARCA', 'CHOTA', 'TACABAMBA'),
('060418', 'CAJAMARCA', 'CHOTA', 'TOCMOCHE'),
('060419', 'CAJAMARCA', 'CHOTA', 'CHALAMARCA'),
('060501', 'CAJAMARCA', 'CONTUMAZA', 'CONTUMAZA'),
('060502', 'CAJAMARCA', 'CONTUMAZA', 'CHILETE'),
('060503', 'CAJAMARCA', 'CONTUMAZA', 'CUPISNIQUE'),
('060504', 'CAJAMARCA', 'CONTUMAZA', 'GUZMANGO'),
('060505', 'CAJAMARCA', 'CONTUMAZA', 'SAN BENITO'),
('060506', 'CAJAMARCA', 'CONTUMAZA', 'SANTA CRUZ DE TOLED'),
('060507', 'CAJAMARCA', 'CONTUMAZA', 'TANTARICA'),
('060508', 'CAJAMARCA', 'CONTUMAZA', 'YONAN'),
('060601', 'CAJAMARCA', 'CUTERVO', 'CUTERVO'),
('060602', 'CAJAMARCA', 'CUTERVO', 'CALLAYUC'),
('060603', 'CAJAMARCA', 'CUTERVO', 'CHOROS'),
('060604', 'CAJAMARCA', 'CUTERVO', 'CUJILLO'),
('060605', 'CAJAMARCA', 'CUTERVO', 'LA RAMADA'),
('060606', 'CAJAMARCA', 'CUTERVO', 'PIMPINGOS'),
('060607', 'CAJAMARCA', 'CUTERVO', 'QUEROCOTILLO'),
('060608', 'CAJAMARCA', 'CUTERVO', 'SAN ANDRES DE CUTERVO'),
('060609', 'CAJAMARCA', 'CUTERVO', 'SAN JUAN DE CUTERVO'),
('060610', 'CAJAMARCA', 'CUTERVO', 'SAN LUIS DE LUCMA'),
('060611', 'CAJAMARCA', 'CUTERVO', 'SANTA CRUZ'),
('060612', 'CAJAMARCA', 'CUTERVO', 'SANTO DOMINGO DE LA CAPILLA'),
('060613', 'CAJAMARCA', 'CUTERVO', 'SANTO TOMAS'),
('060614', 'CAJAMARCA', 'CUTERVO', 'SOCOTA'),
('060615', 'CAJAMARCA', 'CUTERVO', 'TORIBIO CASANOVA'),
('060701', 'CAJAMARCA', 'HUALGAYOC', 'BAMBAMARCA'),
('060702', 'CAJAMARCA', 'HUALGAYOC', 'CHUGUR'),
('060703', 'CAJAMARCA', 'HUALGAYOC', 'HUALGAYOC'),
('060801', 'CAJAMARCA', 'JAEN', 'JAEN'),
('060802', 'CAJAMARCA', 'JAEN', 'BELLAVISTA'),
('060803', 'CAJAMARCA', 'JAEN', 'CHONTALI'),
('060804', 'CAJAMARCA', 'JAEN', 'COLASAY'),
('060805', 'CAJAMARCA', 'JAEN', 'HUABAL'),
('060806', 'CAJAMARCA', 'JAEN', 'LAS PIRIAS'),
('060807', 'CAJAMARCA', 'JAEN', 'POMAHUACA'),
('060808', 'CAJAMARCA', 'JAEN', 'PUCARA'),
('060809', 'CAJAMARCA', 'JAEN', 'SALLIQUE'),
('060810', 'CAJAMARCA', 'JAEN', 'SAN FELIPE'),
('060811', 'CAJAMARCA', 'JAEN', 'SAN JOSE DEL ALTO'),
('060812', 'CAJAMARCA', 'JAEN', 'SANTA ROSA'),
('060901', 'CAJAMARCA', 'SAN IGNACIO', 'SAN IGNACIO'),
('060902', 'CAJAMARCA', 'SAN IGNACIO', 'CHIRINOS'),
('060903', 'CAJAMARCA', 'SAN IGNACIO', 'HUARANGO'),
('060904', 'CAJAMARCA', 'SAN IGNACIO', 'LA COIPA'),
('060905', 'CAJAMARCA', 'SAN IGNACIO', 'NAMBALLE'),
('060906', 'CAJAMARCA', 'SAN IGNACIO', 'SAN JOSE DE LOURDES'),
('060907', 'CAJAMARCA', 'SAN IGNACIO', 'TABACONAS'),
('061001', 'CAJAMARCA', 'SAN MARCOS', 'PEDRO GALVEZ'),
('061002', 'CAJAMARCA', 'SAN MARCOS', 'CHANCAY'),
('061003', 'CAJAMARCA', 'SAN MARCOS', 'EDUARDO VILLANUEVA'),
('061004', 'CAJAMARCA', 'SAN MARCOS', 'GREGORIO PITA'),
('061005', 'CAJAMARCA', 'SAN MARCOS', 'ICHOCAN'),
('061006', 'CAJAMARCA', 'SAN MARCOS', 'JOSE MANUEL QUIROZ'),
('061007', 'CAJAMARCA', 'SAN MARCOS', 'JOSE SABOGAL'),
('061101', 'CAJAMARCA', 'SAN MIGUEL', 'SAN MIGUEL'),
('061102', 'CAJAMARCA', 'SAN MIGUEL', 'BOLIVAR'),
('061103', 'CAJAMARCA', 'SAN MIGUEL', 'CALQUIS'),
('061104', 'CAJAMARCA', 'SAN MIGUEL', 'CATILLUC'),
('061105', 'CAJAMARCA', 'SAN MIGUEL', 'EL PRADO'),
('061106', 'CAJAMARCA', 'SAN MIGUEL', 'LA FLORIDA'),
('061107', 'CAJAMARCA', 'SAN MIGUEL', 'LLAPA'),
('061108', 'CAJAMARCA', 'SAN MIGUEL', 'NANCHOC'),
('061109', 'CAJAMARCA', 'SAN MIGUEL', 'NIEPOS'),
('061110', 'CAJAMARCA', 'SAN MIGUEL', 'SAN GREGORIO'),
('061111', 'CAJAMARCA', 'SAN MIGUEL', 'SAN SILVESTRE DE COCHAN'),
('061112', 'CAJAMARCA', 'SAN MIGUEL', 'TONGOD'),
('061113', 'CAJAMARCA', 'SAN MIGUEL', 'UNION AGUA BLANCA'),
('061201', 'CAJAMARCA', 'SAN PABLO', 'SAN PABLO'),
('061202', 'CAJAMARCA', 'SAN PABLO', 'SAN BERNARDINO'),
('061203', 'CAJAMARCA', 'SAN PABLO', 'SAN LUIS'),
('061204', 'CAJAMARCA', 'SAN PABLO', 'TUMBADEN'),
('061301', 'CAJAMARCA', 'SANTA CRUZ', 'SANTA CRUZ'),
('061302', 'CAJAMARCA', 'SANTA CRUZ', 'ANDABAMBA'),
('061303', 'CAJAMARCA', 'SANTA CRUZ', 'CATACHE'),
('061304', 'CAJAMARCA', 'SANTA CRUZ', 'CHANCAYBAÑOS'),
('061305', 'CAJAMARCA', 'SANTA CRUZ', 'LA ESPERANZA'),
('061306', 'CAJAMARCA', 'SANTA CRUZ', 'NINABAMBA'),
('061307', 'CAJAMARCA', 'SANTA CRUZ', 'PULAN'),
('061308', 'CAJAMARCA', 'SANTA CRUZ', 'SAUCEPAMPA'),
('061309', 'CAJAMARCA', 'SANTA CRUZ', 'SEXI'),
('061310', 'CAJAMARCA', 'SANTA CRUZ', 'UTICYACU'),
('061311', 'CAJAMARCA', 'SANTA CRUZ', 'YAUYUCAN'),
('070101', 'CALLAO', 'CALLAO', 'CALLAO'),
('070102', 'CALLAO', 'CALLAO', 'BELLAVISTA'),
('070103', 'CALLAO', 'CALLAO', 'CARMEN DE LA LEGUA REYNOSO'),
('070104', 'CALLAO', 'CALLAO', 'LA PERLA'),
('070105', 'CALLAO', 'CALLAO', 'LA PUNTA'),
('070106', 'CALLAO', 'CALLAO', 'VENTANILLA'),
('070107', 'CALLAO', 'CALLAO', 'MI PERU'),
('080101', 'CUSCO', 'CUSCO', 'CUSCO'),
('080102', 'CUSCO', 'CUSCO', 'CCORCA'),
('080103', 'CUSCO', 'CUSCO', 'POROY'),
('080104', 'CUSCO', 'CUSCO', 'SAN JERONIMO'),
('080105', 'CUSCO', 'CUSCO', 'SAN SEBASTIAN'),
('080106', 'CUSCO', 'CUSCO', 'SANTIAGO'),
('080107', 'CUSCO', 'CUSCO', 'SAYLLA'),
('080108', 'CUSCO', 'CUSCO', 'WANCHAQ'),
('080201', 'CUSCO', 'ACOMAYO', 'ACOMAYO'),
('080202', 'CUSCO', 'ACOMAYO', 'ACOPIA'),
('080203', 'CUSCO', 'ACOMAYO', 'ACOS'),
('080204', 'CUSCO', 'ACOMAYO', 'MOSOC LLACTA'),
('080205', 'CUSCO', 'ACOMAYO', 'POMACANCHI'),
('080206', 'CUSCO', 'ACOMAYO', 'RONDOCAN'),
('080207', 'CUSCO', 'ACOMAYO', 'SANGARARA'),
('080301', 'CUSCO', 'ANTA', 'ANTA'),
('080302', 'CUSCO', 'ANTA', 'ANCAHUASI'),
('080303', 'CUSCO', 'ANTA', 'CACHIMAYO'),
('080304', 'CUSCO', 'ANTA', 'CHINCHAYPUJIO'),
('080305', 'CUSCO', 'ANTA', 'HUAROCONDO'),
('080306', 'CUSCO', 'ANTA', 'LIMATAMBO'),
('080307', 'CUSCO', 'ANTA', 'MOLLEPATA'),
('080308', 'CUSCO', 'ANTA', 'PUCYURA'),
('080309', 'CUSCO', 'ANTA', 'ZURITE'),
('080401', 'CUSCO', 'CALCA', 'CALCA'),
('080402', 'CUSCO', 'CALCA', 'COYA'),
('080403', 'CUSCO', 'CALCA', 'LAMAY'),
('080404', 'CUSCO', 'CALCA', 'LARES'),
('080405', 'CUSCO', 'CALCA', 'PISAC'),
('080406', 'CUSCO', 'CALCA', 'SAN SALVADOR'),
('080407', 'CUSCO', 'CALCA', 'TARAY'),
('080408', 'CUSCO', 'CALCA', 'YANATILE'),
('080501', 'CUSCO', 'CANAS', 'YANAOCA'),
('080502', 'CUSCO', 'CANAS', 'CHECCA'),
('080503', 'CUSCO', 'CANAS', 'KUNTURKANKI'),
('080504', 'CUSCO', 'CANAS', 'LANGUI'),
('080505', 'CUSCO', 'CANAS', 'LAYO'),
('080506', 'CUSCO', 'CANAS', 'PAMPAMARCA'),
('080507', 'CUSCO', 'CANAS', 'QUEHUE'),
('080508', 'CUSCO', 'CANAS', 'TUPAC AMARU'),
('080601', 'CUSCO', 'CANCHIS', 'SICUANI'),
('080602', 'CUSCO', 'CANCHIS', 'CHECACUPE'),
('080603', 'CUSCO', 'CANCHIS', 'COMBAPATA'),
('080604', 'CUSCO', 'CANCHIS', 'MARANGANI'),
('080605', 'CUSCO', 'CANCHIS', 'PITUMARCA'),
('080606', 'CUSCO', 'CANCHIS', 'SAN PABLO'),
('080607', 'CUSCO', 'CANCHIS', 'SAN PEDRO'),
('080608', 'CUSCO', 'CANCHIS', 'TINTA'),
('080701', 'CUSCO', 'CHUMBIVILCAS', 'SANTO TOMAS'),
('080702', 'CUSCO', 'CHUMBIVILCAS', 'CAPACMARCA'),
('080703', 'CUSCO', 'CHUMBIVILCAS', 'CHAMACA'),
('080704', 'CUSCO', 'CHUMBIVILCAS', 'COLQUEMARCA'),
('080705', 'CUSCO', 'CHUMBIVILCAS', 'LIVITACA'),
('080706', 'CUSCO', 'CHUMBIVILCAS', 'LLUSCO'),
('080707', 'CUSCO', 'CHUMBIVILCAS', 'QUIÑOTA'),
('080708', 'CUSCO', 'CHUMBIVILCAS', 'VELILLE'),
('080801', 'CUSCO', 'ESPINAR', 'ESPINAR'),
('080802', 'CUSCO', 'ESPINAR', 'CONDOROMA'),
('080803', 'CUSCO', 'ESPINAR', 'COPORAQUE'),
('080804', 'CUSCO', 'ESPINAR', 'OCORURO'),
('080805', 'CUSCO', 'ESPINAR', 'PALLPATA'),
('080806', 'CUSCO', 'ESPINAR', 'PICHIGUA'),
('080807', 'CUSCO', 'ESPINAR', 'SUYCKUTAMBO'),
('080808', 'CUSCO', 'ESPINAR', 'ALTO PICHIGUA'),
('080901', 'CUSCO', 'LA CONVENCION', 'SANTA ANA'),
('080902', 'CUSCO', 'LA CONVENCION', 'ECHARATE'),
('080903', 'CUSCO', 'LA CONVENCION', 'HUAYOPATA'),
('080904', 'CUSCO', 'LA CONVENCION', 'MARANURA'),
('080905', 'CUSCO', 'LA CONVENCION', 'OCOBAMBA'),
('080906', 'CUSCO', 'LA CONVENCION', 'QUELLOUNO'),
('080907', 'CUSCO', 'LA CONVENCION', 'KIMBIRI'),
('080908', 'CUSCO', 'LA CONVENCION', 'SANTA TERESA'),
('080909', 'CUSCO', 'LA CONVENCION', 'VILCABAMBA'),
('080910', 'CUSCO', 'LA CONVENCION', 'PICHARI'),
('080911', 'CUSCO', 'LA CONVENCION', 'INKAWASI'),
('080912', 'CUSCO', 'LA CONVENCION', 'VILLA VIRGEN'),
('080913', 'CUSCO', 'LA CONVENCION', 'VILLA KINTIARINA'),
('080914', 'CUSCO', 'LA CONVENCION', 'MEGANTONI'),
('081001', 'CUSCO', 'PARURO', 'PARURO'),
('081002', 'CUSCO', 'PARURO', 'ACCHA'),
('081003', 'CUSCO', 'PARURO', 'CCAPI'),
('081004', 'CUSCO', 'PARURO', 'COLCHA'),
('081005', 'CUSCO', 'PARURO', 'HUANOQUITE'),
('081006', 'CUSCO', 'PARURO', 'OMACHA'),
('081007', 'CUSCO', 'PARURO', 'PACCARITAMBO'),
('081008', 'CUSCO', 'PARURO', 'PILLPINTO'),
('081009', 'CUSCO', 'PARURO', 'YAURISQUE'),
('081101', 'CUSCO', 'PAUCARTAMBO', 'PAUCARTAMBO'),
('081102', 'CUSCO', 'PAUCARTAMBO', 'CAICAY'),
('081103', 'CUSCO', 'PAUCARTAMBO', 'CHALLABAMBA'),
('081104', 'CUSCO', 'PAUCARTAMBO', 'COLQUEPATA'),
('081105', 'CUSCO', 'PAUCARTAMBO', 'HUANCARANI'),
('081106', 'CUSCO', 'PAUCARTAMBO', 'KOSÑIPATA'),
('081201', 'CUSCO', 'QUISPICANCHI', 'URCOS'),
('081202', 'CUSCO', 'QUISPICANCHI', 'ANDAHUAYLILLAS'),
('081203', 'CUSCO', 'QUISPICANCHI', 'CAMANTI'),
('081204', 'CUSCO', 'QUISPICANCHI', 'CCARHUAYO'),
('081205', 'CUSCO', 'QUISPICANCHI', 'CCATCA'),
('081206', 'CUSCO', 'QUISPICANCHI', 'CUSIPATA'),
('081207', 'CUSCO', 'QUISPICANCHI', 'HUARO'),
('081208', 'CUSCO', 'QUISPICANCHI', 'LUCRE'),
('081209', 'CUSCO', 'QUISPICANCHI', 'MARCAPATA'),
('081210', 'CUSCO', 'QUISPICANCHI', 'OCONGATE'),
('081211', 'CUSCO', 'QUISPICANCHI', 'OROPESA'),
('081212', 'CUSCO', 'QUISPICANCHI', 'QUIQUIJANA'),
('081301', 'CUSCO', 'URUBAMBA', 'URUBAMBA'),
('081302', 'CUSCO', 'URUBAMBA', 'CHINCHERO'),
('081303', 'CUSCO', 'URUBAMBA', 'HUAYLLABAMBA'),
('081304', 'CUSCO', 'URUBAMBA', 'MACHUPICCHU'),
('081305', 'CUSCO', 'URUBAMBA', 'MARAS'),
('081306', 'CUSCO', 'URUBAMBA', 'OLLANTAYTAMBO'),
('081307', 'CUSCO', 'URUBAMBA', 'YUCAY'),
('090101', 'HUANCAVELICA', 'HUANCAVELICA', 'HUANCAVELICA'),
('090102', 'HUANCAVELICA', 'HUANCAVELICA', 'ACOBAMBILLA'),
('090103', 'HUANCAVELICA', 'HUANCAVELICA', 'ACORIA'),
('090104', 'HUANCAVELICA', 'HUANCAVELICA', 'CONAYCA'),
('090105', 'HUANCAVELICA', 'HUANCAVELICA', 'CUENCA'),
('090106', 'HUANCAVELICA', 'HUANCAVELICA', 'HUACHOCOLPA'),
('090107', 'HUANCAVELICA', 'HUANCAVELICA', 'HUAYLLAHUARA'),
('090108', 'HUANCAVELICA', 'HUANCAVELICA', 'IZCUCHACA'),
('090109', 'HUANCAVELICA', 'HUANCAVELICA', 'LARIA'),
('090110', 'HUANCAVELICA', 'HUANCAVELICA', 'MANTA'),
('090111', 'HUANCAVELICA', 'HUANCAVELICA', 'MARISCAL CACERES'),
('090112', 'HUANCAVELICA', 'HUANCAVELICA', 'MOYA'),
('090113', 'HUANCAVELICA', 'HUANCAVELICA', 'NUEVO OCCORO'),
('090114', 'HUANCAVELICA', 'HUANCAVELICA', 'PALCA'),
('090115', 'HUANCAVELICA', 'HUANCAVELICA', 'PILCHACA'),
('090116', 'HUANCAVELICA', 'HUANCAVELICA', 'VILCA'),
('090117', 'HUANCAVELICA', 'HUANCAVELICA', 'YAULI'),
('090118', 'HUANCAVELICA', 'HUANCAVELICA', 'ASCENSION'),
('090119', 'HUANCAVELICA', 'HUANCAVELICA', 'HUANDO'),
('090201', 'HUANCAVELICA', 'ACOBAMBA', 'ACOBAMBA'),
('090202', 'HUANCAVELICA', 'ACOBAMBA', 'ANDABAMBA'),
('090203', 'HUANCAVELICA', 'ACOBAMBA', 'ANTA'),
('090204', 'HUANCAVELICA', 'ACOBAMBA', 'CAJA'),
('090205', 'HUANCAVELICA', 'ACOBAMBA', 'MARCAS'),
('090206', 'HUANCAVELICA', 'ACOBAMBA', 'PAUCARA'),
('090207', 'HUANCAVELICA', 'ACOBAMBA', 'POMACOCHA'),
('090208', 'HUANCAVELICA', 'ACOBAMBA', 'ROSARIO'),
('090301', 'HUANCAVELICA', 'ANGARAES', 'LIRCAY'),
('090302', 'HUANCAVELICA', 'ANGARAES', 'ANCHONGA'),
('090303', 'HUANCAVELICA', 'ANGARAES', 'CALLANMARCA'),
('090304', 'HUANCAVELICA', 'ANGARAES', 'CCOCHACCASA'),
('090305', 'HUANCAVELICA', 'ANGARAES', 'CHINCHO'),
('090306', 'HUANCAVELICA', 'ANGARAES', 'CONGALLA'),
('090307', 'HUANCAVELICA', 'ANGARAES', 'HUANCA-HUANCA'),
('090308', 'HUANCAVELICA', 'ANGARAES', 'HUAYLLAY GRANDE'),
('090309', 'HUANCAVELICA', 'ANGARAES', 'JULCAMARCA'),
('090310', 'HUANCAVELICA', 'ANGARAES', 'SAN ANTONIO DE ANTAPARCO'),
('090311', 'HUANCAVELICA', 'ANGARAES', 'SANTO TOMAS DE PATA'),
('090312', 'HUANCAVELICA', 'ANGARAES', 'SECCLLA'),
('090401', 'HUANCAVELICA', 'CASTROVIRREYNA', 'CASTROVIRREYNA'),
('090402', 'HUANCAVELICA', 'CASTROVIRREYNA', 'ARMA'),
('090403', 'HUANCAVELICA', 'CASTROVIRREYNA', 'AURAHUA'),
('090404', 'HUANCAVELICA', 'CASTROVIRREYNA', 'CAPILLAS'),
('090405', 'HUANCAVELICA', 'CASTROVIRREYNA', 'CHUPAMARCA'),
('090406', 'HUANCAVELICA', 'CASTROVIRREYNA', 'COCAS'),
('090407', 'HUANCAVELICA', 'CASTROVIRREYNA', 'HUACHOS'),
('090408', 'HUANCAVELICA', 'CASTROVIRREYNA', 'HUAMATAMBO'),
('090409', 'HUANCAVELICA', 'CASTROVIRREYNA', 'MOLLEPAMPA'),
('090410', 'HUANCAVELICA', 'CASTROVIRREYNA', 'SAN JUAN'),
('090411', 'HUANCAVELICA', 'CASTROVIRREYNA', 'SANTA ANA'),
('090412', 'HUANCAVELICA', 'CASTROVIRREYNA', 'TANTARA'),
('090413', 'HUANCAVELICA', 'CASTROVIRREYNA', 'TICRAPO'),
('090501', 'HUANCAVELICA', 'CHURCAMPA', 'CHURCAMPA'),
('090502', 'HUANCAVELICA', 'CHURCAMPA', 'ANCO'),
('090503', 'HUANCAVELICA', 'CHURCAMPA', 'CHINCHIHUASI'),
('090504', 'HUANCAVELICA', 'CHURCAMPA', 'EL CARMEN'),
('090505', 'HUANCAVELICA', 'CHURCAMPA', 'LA MERCED'),
('090506', 'HUANCAVELICA', 'CHURCAMPA', 'LOCROJA'),
('090507', 'HUANCAVELICA', 'CHURCAMPA', 'PAUCARBAMBA'),
('090508', 'HUANCAVELICA', 'CHURCAMPA', 'SAN MIGUEL DE MAYOCC'),
('090509', 'HUANCAVELICA', 'CHURCAMPA', 'SAN PEDRO DE CORIS'),
('090510', 'HUANCAVELICA', 'CHURCAMPA', 'PACHAMARCA'),
('090511', 'HUANCAVELICA', 'CHURCAMPA', 'COSME'),
('090601', 'HUANCAVELICA', 'HUAYTARA', 'HUAYTARA'),
('090602', 'HUANCAVELICA', 'HUAYTARA', 'AYAVI'),
('090603', 'HUANCAVELICA', 'HUAYTARA', 'CORDOVA'),
('090604', 'HUANCAVELICA', 'HUAYTARA', 'HUAYACUNDO ARMA'),
('090605', 'HUANCAVELICA', 'HUAYTARA', 'LARAMARCA'),
('090606', 'HUANCAVELICA', 'HUAYTARA', 'OCOYO'),
('090607', 'HUANCAVELICA', 'HUAYTARA', 'PILPICHACA'),
('090608', 'HUANCAVELICA', 'HUAYTARA', 'QUERCO'),
('090609', 'HUANCAVELICA', 'HUAYTARA', 'QUITO-ARMA'),
('090610', 'HUANCAVELICA', 'HUAYTARA', 'SAN ANTONIO DE CUSICANCHA'),
('090611', 'HUANCAVELICA', 'HUAYTARA', 'SAN FRANCISCO DE SANGAYAICO'),
('090612', 'HUANCAVELICA', 'HUAYTARA', 'SAN ISIDRO'),
('090613', 'HUANCAVELICA', 'HUAYTARA', 'SANTIAGO DE CHOCORVOS'),
('090614', 'HUANCAVELICA', 'HUAYTARA', 'SANTIAGO DE QUIRAHUARA'),
('090615', 'HUANCAVELICA', 'HUAYTARA', 'SANTO DOMINGO DE CAPILLAS'),
('090616', 'HUANCAVELICA', 'HUAYTARA', 'TAMBO'),
('090701', 'HUANCAVELICA', 'TAYACAJA', 'PAMPAS'),
('090702', 'HUANCAVELICA', 'TAYACAJA', 'ACOSTAMBO'),
('090703', 'HUANCAVELICA', 'TAYACAJA', 'ACRAQUIA'),
('090704', 'HUANCAVELICA', 'TAYACAJA', 'AHUAYCHA'),
('090705', 'HUANCAVELICA', 'TAYACAJA', 'COLCABAMBA'),
('090706', 'HUANCAVELICA', 'TAYACAJA', 'DANIEL HERNANDEZ'),
('090707', 'HUANCAVELICA', 'TAYACAJA', 'HUACHOCOLPA'),
('090709', 'HUANCAVELICA', 'TAYACAJA', 'HUARIBAMBA'),
('090710', 'HUANCAVELICA', 'TAYACAJA', 'ÑAHUIMPUQUIO'),
('090711', 'HUANCAVELICA', 'TAYACAJA', 'PAZOS'),
('090713', 'HUANCAVELICA', 'TAYACAJA', 'QUISHUAR'),
('090714', 'HUANCAVELICA', 'TAYACAJA', 'SALCABAMBA'),
('090715', 'HUANCAVELICA', 'TAYACAJA', 'SALCAHUASI'),
('090716', 'HUANCAVELICA', 'TAYACAJA', 'SAN MARCOS DE ROCCHAC'),
('090717', 'HUANCAVELICA', 'TAYACAJA', 'SURCUBAMBA'),
('090718', 'HUANCAVELICA', 'TAYACAJA', 'TINTAY PUNCU'),
('090719', 'HUANCAVELICA', 'TAYACAJA', 'QUICHUAS'),
('090720', 'HUANCAVELICA', 'TAYACAJA', 'ANDAYMARCA'),
('090721', 'HUANCAVELICA', 'TAYACAJA', 'ROBLE'),
('090722', 'HUANCAVELICA', 'TAYACAJA', 'PICHOS'),
('090723', 'HUANCAVELICA', 'TAYACAJA', 'SANTIAGO DE TUCUMA'),
('100101', 'HUANUCO', 'HUANUCO', 'HUANUCO'),
('100102', 'HUANUCO', 'HUANUCO', 'AMARILIS'),
('100103', 'HUANUCO', 'HUANUCO', 'CHINCHAO'),
('100104', 'HUANUCO', 'HUANUCO', 'CHURUBAMBA'),
('100105', 'HUANUCO', 'HUANUCO', 'MARGOS'),
('100106', 'HUANUCO', 'HUANUCO', 'QUISQUI (KICHKI)'),
('100107', 'HUANUCO', 'HUANUCO', 'SAN FRANCISCO DE CAYRAN'),
('100108', 'HUANUCO', 'HUANUCO', 'SAN PEDRO DE CHAULAN'),
('100109', 'HUANUCO', 'HUANUCO', 'SANTA MARIA DEL VALLE'),
('100110', 'HUANUCO', 'HUANUCO', 'YARUMAYO'),
('100111', 'HUANUCO', 'HUANUCO', 'PILLCO MARCA'),
('100112', 'HUANUCO', 'HUANUCO', 'YACUS'),
('100113', 'HUANUCO', 'HUANUCO', 'SAN PABLO DE PILLAO'),
('100201', 'HUANUCO', 'AMBO', 'AMBO'),
('100202', 'HUANUCO', 'AMBO', 'CAYNA'),
('100203', 'HUANUCO', 'AMBO', 'COLPAS'),
('100204', 'HUANUCO', 'AMBO', 'CONCHAMARCA'),
('100205', 'HUANUCO', 'AMBO', 'HUACAR'),
('100206', 'HUANUCO', 'AMBO', 'SAN FRANCISCO'),
('100207', 'HUANUCO', 'AMBO', 'SAN RAFAEL'),
('100208', 'HUANUCO', 'AMBO', 'TOMAY KICHWA'),
('100301', 'HUANUCO', 'DOS DE MAYO', 'LA UNION'),
('100307', 'HUANUCO', 'DOS DE MAYO', 'CHUQUIS'),
('100311', 'HUANUCO', 'DOS DE MAYO', 'MARIAS'),
('100313', 'HUANUCO', 'DOS DE MAYO', 'PACHAS'),
('100316', 'HUANUCO', 'DOS DE MAYO', 'QUIVILLA'),
('100317', 'HUANUCO', 'DOS DE MAYO', 'RIPAN'),
('100321', 'HUANUCO', 'DOS DE MAYO', 'SHUNQUI'),
('100322', 'HUANUCO', 'DOS DE MAYO', 'SILLAPATA'),
('100323', 'HUANUCO', 'DOS DE MAYO', 'YANAS'),
('100401', 'HUANUCO', 'HUACAYBAMBA', 'HUACAYBAMBA'),
('100402', 'HUANUCO', 'HUACAYBAMBA', 'CANCHABAMBA'),
('100403', 'HUANUCO', 'HUACAYBAMBA', 'COCHABAMBA'),
('100404', 'HUANUCO', 'HUACAYBAMBA', 'PINRA'),
('100501', 'HUANUCO', 'HUAMALIES', 'LLATA'),
('100502', 'HUANUCO', 'HUAMALIES', 'ARANCAY'),
('100503', 'HUANUCO', 'HUAMALIES', 'CHAVIN DE PARIARCA'),
('100504', 'HUANUCO', 'HUAMALIES', 'JACAS GRANDE'),
('100505', 'HUANUCO', 'HUAMALIES', 'JIRCAN'),
('100506', 'HUANUCO', 'HUAMALIES', 'MIRAFLORES'),
('100507', 'HUANUCO', 'HUAMALIES', 'MONZON'),
('100508', 'HUANUCO', 'HUAMALIES', 'PUNCHAO'),
('100509', 'HUANUCO', 'HUAMALIES', 'PUÑOS'),
('100510', 'HUANUCO', 'HUAMALIES', 'SINGA'),
('100511', 'HUANUCO', 'HUAMALIES', 'TANTAMAYO'),
('100601', 'HUANUCO', 'LEONCIO PRADO', 'RUPA-RUPA'),
('100602', 'HUANUCO', 'LEONCIO PRADO', 'DANIEL ALOMIA ROBLES'),
('100603', 'HUANUCO', 'LEONCIO PRADO', 'HERMILIO VALDIZAN'),
('100604', 'HUANUCO', 'LEONCIO PRADO', 'JOSE CRESPO Y CASTILLO'),
('100605', 'HUANUCO', 'LEONCIO PRADO', 'LUYANDO'),
('100606', 'HUANUCO', 'LEONCIO PRADO', 'MARIANO DAMASO BERAUN'),
('100607', 'HUANUCO', 'LEONCIO PRADO', 'PUCAYACU'),
('100608', 'HUANUCO', 'LEONCIO PRADO', 'CASTILLO GRANDE'),
('100609', 'HUANUCO', 'LEONCIO PRADO', 'PUEBLO NUEVO'),
('100610', 'HUANUCO', 'LEONCIO PRADO', 'SANTO DOMINGO DE ANDIA'),
('100701', 'HUANUCO', 'MARAÑON', 'HUACRACHUCO'),
('100702', 'HUANUCO', 'MARAÑON', 'CHOLON'),
('100703', 'HUANUCO', 'MARAÑON', 'SAN BUENAVENTURA'),
('100704', 'HUANUCO', 'MARAÑON', 'LA MORADA'),
('100705', 'HUANUCO', 'MARAÑON', 'SANTA ROSA DE ALTO YANAJANCA'),
('100801', 'HUANUCO', 'PACHITEA', 'PANAO'),
('100802', 'HUANUCO', 'PACHITEA', 'CHAGLLA'),
('100803', 'HUANUCO', 'PACHITEA', 'MOLINO'),
('100804', 'HUANUCO', 'PACHITEA', 'UMARI'),
('100901', 'HUANUCO', 'PUERTO INCA', 'PUERTO INCA'),
('100902', 'HUANUCO', 'PUERTO INCA', 'CODO DEL POZUZO'),
('100903', 'HUANUCO', 'PUERTO INCA', 'HONORIA'),
('100904', 'HUANUCO', 'PUERTO INCA', 'TOURNAVISTA'),
('100905', 'HUANUCO', 'PUERTO INCA', 'YUYAPICHIS'),
('101001', 'HUANUCO', 'LAURICOCHA', 'JESUS'),
('101002', 'HUANUCO', 'LAURICOCHA', 'BAÑOS'),
('101003', 'HUANUCO', 'LAURICOCHA', 'JIVIA'),
('101004', 'HUANUCO', 'LAURICOCHA', 'QUEROPALCA'),
('101005', 'HUANUCO', 'LAURICOCHA', 'RONDOS'),
('101006', 'HUANUCO', 'LAURICOCHA', 'SAN FRANCISCO DE ASIS'),
('101007', 'HUANUCO', 'LAURICOCHA', 'SAN MIGUEL DE CAURI'),
('101101', 'HUANUCO', 'YAROWILCA', 'CHAVINILLO'),
('101102', 'HUANUCO', 'YAROWILCA', 'CAHUAC'),
('101103', 'HUANUCO', 'YAROWILCA', 'CHACABAMBA'),
('101104', 'HUANUCO', 'YAROWILCA', 'APARICIO POMARES'),
('101105', 'HUANUCO', 'YAROWILCA', 'JACAS CHICO'),
('101106', 'HUANUCO', 'YAROWILCA', 'OBAS'),
('101107', 'HUANUCO', 'YAROWILCA', 'PAMPAMARCA'),
('101108', 'HUANUCO', 'YAROWILCA', 'CHORAS'),
('110101', 'ICA', 'ICA', 'ICA'),
('110102', 'ICA', 'ICA', 'LA TINGUIÑA'),
('110103', 'ICA', 'ICA', 'LOS AQUIJES'),
('110104', 'ICA', 'ICA', 'OCUCAJE'),
('110105', 'ICA', 'ICA', 'PACHACUTEC'),
('110106', 'ICA', 'ICA', 'PARCONA'),
('110107', 'ICA', 'ICA', 'PUEBLO NUEVO'),
('110108', 'ICA', 'ICA', 'SALAS'),
('110109', 'ICA', 'ICA', 'SAN JOSE DE LOS MOLINOS'),
('110110', 'ICA', 'ICA', 'SAN JUAN BAUTISTA'),
('110111', 'ICA', 'ICA', 'SANTIAGO'),
('110112', 'ICA', 'ICA', 'SUBTANJALLA'),
('110113', 'ICA', 'ICA', 'TATE'),
('110114', 'ICA', 'ICA', 'YAUCA DEL ROSARIO'),
('110201', 'ICA', 'CHINCHA', 'CHINCHA ALTA'),
('110202', 'ICA', 'CHINCHA', 'ALTO LARAN'),
('110203', 'ICA', 'CHINCHA', 'CHAVIN'),
('110204', 'ICA', 'CHINCHA', 'CHINCHA BAJA'),
('110205', 'ICA', 'CHINCHA', 'EL CARMEN'),
('110206', 'ICA', 'CHINCHA', 'GROCIO PRADO'),
('110207', 'ICA', 'CHINCHA', 'PUEBLO NUEVO'),
('110208', 'ICA', 'CHINCHA', 'SAN JUAN DE YANAC'),
('110209', 'ICA', 'CHINCHA', 'SAN PEDRO DE HUACARPANA'),
('110210', 'ICA', 'CHINCHA', 'SUNAMPE'),
('110211', 'ICA', 'CHINCHA', 'TAMBO DE MORA'),
('110301', 'ICA', 'NASCA', 'NASCA'),
('110302', 'ICA', 'NASCA', 'CHANGUILLO'),
('110303', 'ICA', 'NASCA', 'EL INGENIO'),
('110304', 'ICA', 'NASCA', 'MARCONA'),
('110305', 'ICA', 'NASCA', 'VISTA ALEGRE'),
('110401', 'ICA', 'PALPA', 'PALPA'),
('110402', 'ICA', 'PALPA', 'LLIPATA'),
('110403', 'ICA', 'PALPA', 'RIO GRANDE'),
('110404', 'ICA', 'PALPA', 'SANTA CRUZ'),
('110405', 'ICA', 'PALPA', 'TIBILLO'),
('110501', 'ICA', 'PISCO', 'PISCO'),
('110502', 'ICA', 'PISCO', 'HUANCANO'),
('110503', 'ICA', 'PISCO', 'HUMAY'),
('110504', 'ICA', 'PISCO', 'INDEPENDENCIA'),
('110505', 'ICA', 'PISCO', 'PARACAS'),
('110506', 'ICA', 'PISCO', 'SAN ANDRES'),
('110507', 'ICA', 'PISCO', 'SAN CLEMENTE'),
('110508', 'ICA', 'PISCO', 'TUPAC AMARU INCA'),
('120101', 'JUNIN', 'HUANCAYO', 'HUANCAYO'),
('120104', 'JUNIN', 'HUANCAYO', 'CARHUACALLANGA'),
('120105', 'JUNIN', 'HUANCAYO', 'CHACAPAMPA'),
('120106', 'JUNIN', 'HUANCAYO', 'CHICCHE'),
('120107', 'JUNIN', 'HUANCAYO', 'CHILCA'),
('120108', 'JUNIN', 'HUANCAYO', 'CHONGOS ALTO'),
('120111', 'JUNIN', 'HUANCAYO', 'CHUPURO'),
('120112', 'JUNIN', 'HUANCAYO', 'COLCA'),
('120113', 'JUNIN', 'HUANCAYO', 'CULLHUAS'),
('120114', 'JUNIN', 'HUANCAYO', 'EL TAMBO'),
('120116', 'JUNIN', 'HUANCAYO', 'HUACRAPUQUIO'),
('120117', 'JUNIN', 'HUANCAYO', 'HUALHUAS'),
('120119', 'JUNIN', 'HUANCAYO', 'HUANCAN'),
('120120', 'JUNIN', 'HUANCAYO', 'HUASICANCHA'),
('120121', 'JUNIN', 'HUANCAYO', 'HUAYUCACHI'),
('120122', 'JUNIN', 'HUANCAYO', 'INGENIO'),
('120124', 'JUNIN', 'HUANCAYO', 'PARIAHUANCA'),
('120125', 'JUNIN', 'HUANCAYO', 'PILCOMAYO'),
('120126', 'JUNIN', 'HUANCAYO', 'PUCARA'),
('120127', 'JUNIN', 'HUANCAYO', 'QUICHUAY'),
('120128', 'JUNIN', 'HUANCAYO', 'QUILCAS'),
('120129', 'JUNIN', 'HUANCAYO', 'SAN AGUSTIN'),
('120130', 'JUNIN', 'HUANCAYO', 'SAN JERONIMO DE TUNAN'),
('120132', 'JUNIN', 'HUANCAYO', 'SAÑO'),
('120133', 'JUNIN', 'HUANCAYO', 'SAPALLANGA');
INSERT INTO `ubigeo` (`cod_ubigeo`, `depa`, `provi`, `distri`) VALUES
('120134', 'JUNIN', 'HUANCAYO', 'SICAYA'),
('120135', 'JUNIN', 'HUANCAYO', 'SANTO DOMINGO DE ACOBAMBA'),
('120136', 'JUNIN', 'HUANCAYO', 'VIQUES'),
('120201', 'JUNIN', 'CONCEPCION', 'CONCEPCION'),
('120202', 'JUNIN', 'CONCEPCION', 'ACO'),
('120203', 'JUNIN', 'CONCEPCION', 'ANDAMARCA'),
('120204', 'JUNIN', 'CONCEPCION', 'CHAMBARA'),
('120205', 'JUNIN', 'CONCEPCION', 'COCHAS'),
('120206', 'JUNIN', 'CONCEPCION', 'COMAS'),
('120207', 'JUNIN', 'CONCEPCION', 'HEROINAS TOLEDO'),
('120208', 'JUNIN', 'CONCEPCION', 'MANZANARES'),
('120209', 'JUNIN', 'CONCEPCION', 'MARISCAL CASTILLA'),
('120210', 'JUNIN', 'CONCEPCION', 'MATAHUASI'),
('120211', 'JUNIN', 'CONCEPCION', 'MITO'),
('120212', 'JUNIN', 'CONCEPCION', 'NUEVE DE JULIO'),
('120213', 'JUNIN', 'CONCEPCION', 'ORCOTUNA'),
('120214', 'JUNIN', 'CONCEPCION', 'SAN JOSE DE QUERO'),
('120215', 'JUNIN', 'CONCEPCION', 'SANTA ROSA DE OCOPA'),
('120301', 'JUNIN', 'CHANCHAMAYO', 'CHANCHAMAYO'),
('120302', 'JUNIN', 'CHANCHAMAYO', 'PERENE'),
('120303', 'JUNIN', 'CHANCHAMAYO', 'PICHANAQUI'),
('120304', 'JUNIN', 'CHANCHAMAYO', 'SAN LUIS DE SHUARO'),
('120305', 'JUNIN', 'CHANCHAMAYO', 'SAN RAMON'),
('120306', 'JUNIN', 'CHANCHAMAYO', 'VITOC'),
('120401', 'JUNIN', 'JAUJA', 'JAUJA'),
('120402', 'JUNIN', 'JAUJA', 'ACOLLA'),
('120403', 'JUNIN', 'JAUJA', 'APATA'),
('120404', 'JUNIN', 'JAUJA', 'ATAURA'),
('120405', 'JUNIN', 'JAUJA', 'CANCHAYLLO'),
('120406', 'JUNIN', 'JAUJA', 'CURICACA'),
('120407', 'JUNIN', 'JAUJA', 'EL MANTARO'),
('120408', 'JUNIN', 'JAUJA', 'HUAMALI'),
('120409', 'JUNIN', 'JAUJA', 'HUARIPAMPA'),
('120410', 'JUNIN', 'JAUJA', 'HUERTAS'),
('120411', 'JUNIN', 'JAUJA', 'JANJAILLO'),
('120412', 'JUNIN', 'JAUJA', 'JULCAN'),
('120413', 'JUNIN', 'JAUJA', 'LEONOR ORDOÑEZ'),
('120414', 'JUNIN', 'JAUJA', 'LLOCLLAPAMPA'),
('120415', 'JUNIN', 'JAUJA', 'MARCO'),
('120416', 'JUNIN', 'JAUJA', 'MASMA'),
('120417', 'JUNIN', 'JAUJA', 'MASMA CHICCHE'),
('120418', 'JUNIN', 'JAUJA', 'MOLINOS'),
('120419', 'JUNIN', 'JAUJA', 'MONOBAMBA'),
('120420', 'JUNIN', 'JAUJA', 'MUQUI'),
('120421', 'JUNIN', 'JAUJA', 'MUQUIYAUYO'),
('120422', 'JUNIN', 'JAUJA', 'PACA'),
('120423', 'JUNIN', 'JAUJA', 'PACCHA'),
('120424', 'JUNIN', 'JAUJA', 'PANCAN'),
('120425', 'JUNIN', 'JAUJA', 'PARCO'),
('120426', 'JUNIN', 'JAUJA', 'POMACANCHA'),
('120427', 'JUNIN', 'JAUJA', 'RICRAN'),
('120428', 'JUNIN', 'JAUJA', 'SAN LORENZO'),
('120429', 'JUNIN', 'JAUJA', 'SAN PEDRO DE CHUNAN'),
('120430', 'JUNIN', 'JAUJA', 'SAUSA'),
('120431', 'JUNIN', 'JAUJA', 'SINCOS'),
('120432', 'JUNIN', 'JAUJA', 'TUNAN MARCA'),
('120433', 'JUNIN', 'JAUJA', 'YAULI'),
('120434', 'JUNIN', 'JAUJA', 'YAUYOS'),
('120501', 'JUNIN', 'JUNIN', 'JUNIN'),
('120502', 'JUNIN', 'JUNIN', 'CARHUAMAYO'),
('120503', 'JUNIN', 'JUNIN', 'ONDORES'),
('120504', 'JUNIN', 'JUNIN', 'ULCUMAYO'),
('120601', 'JUNIN', 'SATIPO', 'SATIPO'),
('120602', 'JUNIN', 'SATIPO', 'COVIRIALI'),
('120603', 'JUNIN', 'SATIPO', 'LLAYLLA'),
('120604', 'JUNIN', 'SATIPO', 'MAZAMARI'),
('120605', 'JUNIN', 'SATIPO', 'PAMPA HERMOSA'),
('120606', 'JUNIN', 'SATIPO', 'PANGOA'),
('120607', 'JUNIN', 'SATIPO', 'RIO NEGRO'),
('120608', 'JUNIN', 'SATIPO', 'RIO TAMBO'),
('120609', 'JUNIN', 'SATIPO', 'VIZCATAN DEL ENE'),
('120701', 'JUNIN', 'TARMA', 'TARMA'),
('120702', 'JUNIN', 'TARMA', 'ACOBAMBA'),
('120703', 'JUNIN', 'TARMA', 'HUARICOLCA'),
('120704', 'JUNIN', 'TARMA', 'HUASAHUASI'),
('120705', 'JUNIN', 'TARMA', 'LA UNION'),
('120706', 'JUNIN', 'TARMA', 'PALCA'),
('120707', 'JUNIN', 'TARMA', 'PALCAMAYO'),
('120708', 'JUNIN', 'TARMA', 'SAN PEDRO DE CAJAS'),
('120709', 'JUNIN', 'TARMA', 'TAPO'),
('120801', 'JUNIN', 'YAULI', 'LA OROYA'),
('120802', 'JUNIN', 'YAULI', 'CHACAPALPA'),
('120803', 'JUNIN', 'YAULI', 'HUAY-HUAY'),
('120804', 'JUNIN', 'YAULI', 'MARCAPOMACOCHA'),
('120805', 'JUNIN', 'YAULI', 'MOROCOCHA'),
('120806', 'JUNIN', 'YAULI', 'PACCHA'),
('120807', 'JUNIN', 'YAULI', 'SANTA BARBARA DE CARHUACAYAN'),
('120808', 'JUNIN', 'YAULI', 'SANTA ROSA DE SACCO'),
('120809', 'JUNIN', 'YAULI', 'SUITUCANCHA'),
('120810', 'JUNIN', 'YAULI', 'YAULI'),
('120901', 'JUNIN', 'CHUPACA', 'CHUPACA'),
('120902', 'JUNIN', 'CHUPACA', 'AHUAC'),
('120903', 'JUNIN', 'CHUPACA', 'CHONGOS BAJO'),
('120904', 'JUNIN', 'CHUPACA', 'HUACHAC'),
('120905', 'JUNIN', 'CHUPACA', 'HUAMANCACA CHICO'),
('120906', 'JUNIN', 'CHUPACA', 'SAN JUAN DE ISCOS'),
('120907', 'JUNIN', 'CHUPACA', 'SAN JUAN DE JARPA'),
('120908', 'JUNIN', 'CHUPACA', 'TRES DE DICIEMBRE'),
('120909', 'JUNIN', 'CHUPACA', 'YANACANCHA'),
('130101', 'LA LIBERTAD', 'TRUJILLO', 'TRUJILLO'),
('130102', 'LA LIBERTAD', 'TRUJILLO', 'EL PORVENIR'),
('130103', 'LA LIBERTAD', 'TRUJILLO', 'FLORENCIA DE MORA'),
('130104', 'LA LIBERTAD', 'TRUJILLO', 'HUANCHACO'),
('130105', 'LA LIBERTAD', 'TRUJILLO', 'LA ESPERANZA'),
('130106', 'LA LIBERTAD', 'TRUJILLO', 'LAREDO'),
('130107', 'LA LIBERTAD', 'TRUJILLO', 'MOCHE'),
('130108', 'LA LIBERTAD', 'TRUJILLO', 'POROTO'),
('130109', 'LA LIBERTAD', 'TRUJILLO', 'SALAVERRY'),
('130110', 'LA LIBERTAD', 'TRUJILLO', 'SIMBAL'),
('130111', 'LA LIBERTAD', 'TRUJILLO', 'VICTOR LARCO HERRERA'),
('130201', 'LA LIBERTAD', 'ASCOPE', 'ASCOPE'),
('130202', 'LA LIBERTAD', 'ASCOPE', 'CHICAMA'),
('130203', 'LA LIBERTAD', 'ASCOPE', 'CHOCOPE'),
('130204', 'LA LIBERTAD', 'ASCOPE', 'MAGDALENA DE CAO'),
('130205', 'LA LIBERTAD', 'ASCOPE', 'PAIJAN'),
('130206', 'LA LIBERTAD', 'ASCOPE', 'RAZURI'),
('130207', 'LA LIBERTAD', 'ASCOPE', 'SANTIAGO DE CAO'),
('130208', 'LA LIBERTAD', 'ASCOPE', 'CASA GRANDE'),
('130301', 'LA LIBERTAD', 'BOLIVAR', 'BOLIVAR'),
('130302', 'LA LIBERTAD', 'BOLIVAR', 'BAMBAMARCA'),
('130303', 'LA LIBERTAD', 'BOLIVAR', 'CONDORMARCA'),
('130304', 'LA LIBERTAD', 'BOLIVAR', 'LONGOTEA'),
('130305', 'LA LIBERTAD', 'BOLIVAR', 'UCHUMARCA'),
('130306', 'LA LIBERTAD', 'BOLIVAR', 'UCUNCHA'),
('130401', 'LA LIBERTAD', 'CHEPEN', 'CHEPEN'),
('130402', 'LA LIBERTAD', 'CHEPEN', 'PACANGA'),
('130403', 'LA LIBERTAD', 'CHEPEN', 'PUEBLO NUEVO'),
('130501', 'LA LIBERTAD', 'JULCAN', 'JULCAN'),
('130502', 'LA LIBERTAD', 'JULCAN', 'CALAMARCA'),
('130503', 'LA LIBERTAD', 'JULCAN', 'CARABAMBA'),
('130504', 'LA LIBERTAD', 'JULCAN', 'HUASO'),
('130601', 'LA LIBERTAD', 'OTUZCO', 'OTUZCO'),
('130602', 'LA LIBERTAD', 'OTUZCO', 'AGALLPAMPA'),
('130604', 'LA LIBERTAD', 'OTUZCO', 'CHARAT'),
('130605', 'LA LIBERTAD', 'OTUZCO', 'HUARANCHAL'),
('130606', 'LA LIBERTAD', 'OTUZCO', 'LA CUESTA'),
('130608', 'LA LIBERTAD', 'OTUZCO', 'MACHE'),
('130610', 'LA LIBERTAD', 'OTUZCO', 'PARANDAY'),
('130611', 'LA LIBERTAD', 'OTUZCO', 'SALPO'),
('130613', 'LA LIBERTAD', 'OTUZCO', 'SINSICAP'),
('130614', 'LA LIBERTAD', 'OTUZCO', 'USQUIL'),
('130701', 'LA LIBERTAD', 'PACASMAYO', 'SAN PEDRO DE LLOC'),
('130702', 'LA LIBERTAD', 'PACASMAYO', 'GUADALUPE'),
('130703', 'LA LIBERTAD', 'PACASMAYO', 'JEQUETEPEQUE'),
('130704', 'LA LIBERTAD', 'PACASMAYO', 'PACASMAYO'),
('130705', 'LA LIBERTAD', 'PACASMAYO', 'SAN JOSE'),
('130801', 'LA LIBERTAD', 'PATAZ', 'TAYABAMBA'),
('130802', 'LA LIBERTAD', 'PATAZ', 'BULDIBUYO'),
('130803', 'LA LIBERTAD', 'PATAZ', 'CHILLIA'),
('130804', 'LA LIBERTAD', 'PATAZ', 'HUANCASPATA'),
('130805', 'LA LIBERTAD', 'PATAZ', 'HUAYLILLAS'),
('130806', 'LA LIBERTAD', 'PATAZ', 'HUAYO'),
('130807', 'LA LIBERTAD', 'PATAZ', 'ONGON'),
('130808', 'LA LIBERTAD', 'PATAZ', 'PARCOY'),
('130809', 'LA LIBERTAD', 'PATAZ', 'PATAZ'),
('130810', 'LA LIBERTAD', 'PATAZ', 'PIAS'),
('130811', 'LA LIBERTAD', 'PATAZ', 'SANTIAGO DE CHALLAS'),
('130812', 'LA LIBERTAD', 'PATAZ', 'TAURIJA'),
('130813', 'LA LIBERTAD', 'PATAZ', 'URPAY'),
('130901', 'LA LIBERTAD', 'SANCHEZ CARRION', 'HUAMACHUCO'),
('130902', 'LA LIBERTAD', 'SANCHEZ CARRION', 'CHUGAY'),
('130903', 'LA LIBERTAD', 'SANCHEZ CARRION', 'COCHORCO'),
('130904', 'LA LIBERTAD', 'SANCHEZ CARRION', 'CURGOS'),
('130905', 'LA LIBERTAD', 'SANCHEZ CARRION', 'MARCABAL'),
('130906', 'LA LIBERTAD', 'SANCHEZ CARRION', 'SANAGORAN'),
('130907', 'LA LIBERTAD', 'SANCHEZ CARRION', 'SARIN'),
('130908', 'LA LIBERTAD', 'SANCHEZ CARRION', 'SARTIMBAMBA'),
('131001', 'LA LIBERTAD', 'SANTIAGO DE CHUCO', 'SANTIAGO DE CHUCO'),
('131002', 'LA LIBERTAD', 'SANTIAGO DE CHUCO', 'ANGASMARCA'),
('131003', 'LA LIBERTAD', 'SANTIAGO DE CHUCO', 'CACHICADAN'),
('131004', 'LA LIBERTAD', 'SANTIAGO DE CHUCO', 'MOLLEBAMBA'),
('131005', 'LA LIBERTAD', 'SANTIAGO DE CHUCO', 'MOLLEPATA'),
('131006', 'LA LIBERTAD', 'SANTIAGO DE CHUCO', 'QUIRUVILCA'),
('131007', 'LA LIBERTAD', 'SANTIAGO DE CHUCO', 'SANTA CRUZ DE CHUCA'),
('131008', 'LA LIBERTAD', 'SANTIAGO DE CHUCO', 'SITABAMBA'),
('131101', 'LA LIBERTAD', 'GRAN CHIMU', 'CASCAS'),
('131102', 'LA LIBERTAD', 'GRAN CHIMU', 'LUCMA'),
('131103', 'LA LIBERTAD', 'GRAN CHIMU', 'MARMOT'),
('131104', 'LA LIBERTAD', 'GRAN CHIMU', 'SAYAPULLO'),
('131201', 'LA LIBERTAD', 'VIRU', 'VIRU'),
('131202', 'LA LIBERTAD', 'VIRU', 'CHAO'),
('131203', 'LA LIBERTAD', 'VIRU', 'GUADALUPITO'),
('140101', 'LAMBAYEQUE', 'CHICLAYO', 'CHICLAYO'),
('140102', 'LAMBAYEQUE', 'CHICLAYO', 'CHONGOYAPE'),
('140103', 'LAMBAYEQUE', 'CHICLAYO', 'ETEN'),
('140104', 'LAMBAYEQUE', 'CHICLAYO', 'ETEN PUERTO'),
('140105', 'LAMBAYEQUE', 'CHICLAYO', 'JOSE LEONARDO ORTIZ'),
('140106', 'LAMBAYEQUE', 'CHICLAYO', 'LA VICTORIA'),
('140107', 'LAMBAYEQUE', 'CHICLAYO', 'LAGUNAS'),
('140108', 'LAMBAYEQUE', 'CHICLAYO', 'MONSEFU'),
('140109', 'LAMBAYEQUE', 'CHICLAYO', 'NUEVA ARICA'),
('140110', 'LAMBAYEQUE', 'CHICLAYO', 'OYOTUN'),
('140111', 'LAMBAYEQUE', 'CHICLAYO', 'PICSI'),
('140112', 'LAMBAYEQUE', 'CHICLAYO', 'PIMENTEL'),
('140113', 'LAMBAYEQUE', 'CHICLAYO', 'REQUE'),
('140114', 'LAMBAYEQUE', 'CHICLAYO', 'SANTA ROSA'),
('140115', 'LAMBAYEQUE', 'CHICLAYO', 'SAÑA'),
('140116', 'LAMBAYEQUE', 'CHICLAYO', 'CAYALTI'),
('140117', 'LAMBAYEQUE', 'CHICLAYO', 'PATAPO'),
('140118', 'LAMBAYEQUE', 'CHICLAYO', 'POMALCA'),
('140119', 'LAMBAYEQUE', 'CHICLAYO', 'PUCALA'),
('140120', 'LAMBAYEQUE', 'CHICLAYO', 'TUMAN'),
('140201', 'LAMBAYEQUE', 'FERREÑAFE', 'FERREÑAFE'),
('140202', 'LAMBAYEQUE', 'FERREÑAFE', 'CAÑARIS'),
('140203', 'LAMBAYEQUE', 'FERREÑAFE', 'INCAHUASI'),
('140204', 'LAMBAYEQUE', 'FERREÑAFE', 'MANUEL ANTONIO MESONES MURO'),
('140205', 'LAMBAYEQUE', 'FERREÑAFE', 'PITIPO'),
('140206', 'LAMBAYEQUE', 'FERREÑAFE', 'PUEBLO NUEVO'),
('140301', 'LAMBAYEQUE', 'LAMBAYEQUE', 'LAMBAYEQUE'),
('140302', 'LAMBAYEQUE', 'LAMBAYEQUE', 'CHOCHOPE'),
('140303', 'LAMBAYEQUE', 'LAMBAYEQUE', 'ILLIMO'),
('140304', 'LAMBAYEQUE', 'LAMBAYEQUE', 'JAYANCA'),
('140305', 'LAMBAYEQUE', 'LAMBAYEQUE', 'MOCHUMI'),
('140306', 'LAMBAYEQUE', 'LAMBAYEQUE', 'MORROPE'),
('140307', 'LAMBAYEQUE', 'LAMBAYEQUE', 'MOTUPE'),
('140308', 'LAMBAYEQUE', 'LAMBAYEQUE', 'OLMOS'),
('140309', 'LAMBAYEQUE', 'LAMBAYEQUE', 'PACORA'),
('140310', 'LAMBAYEQUE', 'LAMBAYEQUE', 'SALAS'),
('140311', 'LAMBAYEQUE', 'LAMBAYEQUE', 'SAN JOSE'),
('140312', 'LAMBAYEQUE', 'LAMBAYEQUE', 'TUCUME'),
('150101', 'LIMA', 'LIMA', 'LIMA'),
('150102', 'LIMA', 'LIMA', 'ANCON'),
('150103', 'LIMA', 'LIMA', 'ATE'),
('150104', 'LIMA', 'LIMA', 'BARRANCO'),
('150105', 'LIMA', 'LIMA', 'BREÑA'),
('150106', 'LIMA', 'LIMA', 'CARABAYLLO'),
('150107', 'LIMA', 'LIMA', 'CHACLACAYO'),
('150108', 'LIMA', 'LIMA', 'CHORRILLOS'),
('150109', 'LIMA', 'LIMA', 'CIENEGUILLA'),
('150110', 'LIMA', 'LIMA', 'COMAS'),
('150111', 'LIMA', 'LIMA', 'EL AGUSTINO'),
('150112', 'LIMA', 'LIMA', 'INDEPENDENCIA'),
('150113', 'LIMA', 'LIMA', 'JESUS MARIA'),
('150114', 'LIMA', 'LIMA', 'LA MOLINA'),
('150115', 'LIMA', 'LIMA', 'LA VICTORIA'),
('150116', 'LIMA', 'LIMA', 'LINCE'),
('150117', 'LIMA', 'LIMA', 'LOS OLIVOS'),
('150118', 'LIMA', 'LIMA', 'LURIGANCHO'),
('150119', 'LIMA', 'LIMA', 'LURIN'),
('150120', 'LIMA', 'LIMA', 'MAGDALENA DEL MAR'),
('150121', 'LIMA', 'LIMA', 'PUEBLO LIBRE'),
('150122', 'LIMA', 'LIMA', 'MIRAFLORES'),
('150123', 'LIMA', 'LIMA', 'PACHACAMAC'),
('150124', 'LIMA', 'LIMA', 'PUCUSANA'),
('150125', 'LIMA', 'LIMA', 'PUENTE PIEDRA'),
('150126', 'LIMA', 'LIMA', 'PUNTA HERMOSA'),
('150127', 'LIMA', 'LIMA', 'PUNTA NEGRA'),
('150128', 'LIMA', 'LIMA', 'RIMAC'),
('150129', 'LIMA', 'LIMA', 'SAN BARTOLO'),
('150130', 'LIMA', 'LIMA', 'SAN BORJA'),
('150131', 'LIMA', 'LIMA', 'SAN ISIDRO'),
('150132', 'LIMA', 'LIMA', 'SAN JUAN DE LURIGANCHO'),
('150133', 'LIMA', 'LIMA', 'SAN JUAN DE MIRAFLORES'),
('150134', 'LIMA', 'LIMA', 'SAN LUIS'),
('150135', 'LIMA', 'LIMA', 'SAN MARTIN DE PORRES'),
('150136', 'LIMA', 'LIMA', 'SAN MIGUEL'),
('150137', 'LIMA', 'LIMA', 'SANTA ANITA'),
('150138', 'LIMA', 'LIMA', 'SANTA MARIA DEL MAR'),
('150139', 'LIMA', 'LIMA', 'SANTA ROSA'),
('150140', 'LIMA', 'LIMA', 'SANTIAGO DE SURCO'),
('150141', 'LIMA', 'LIMA', 'SURQUILLO'),
('150142', 'LIMA', 'LIMA', 'VILLA EL SALVADOR'),
('150143', 'LIMA', 'LIMA', 'VILLA MARIA DEL TRIUNFO'),
('150201', 'LIMA', 'BARRANCA', 'BARRANCA'),
('150202', 'LIMA', 'BARRANCA', 'PARAMONGA'),
('150203', 'LIMA', 'BARRANCA', 'PATIVILCA'),
('150204', 'LIMA', 'BARRANCA', 'SUPE'),
('150205', 'LIMA', 'BARRANCA', 'SUPE PUERTO'),
('150301', 'LIMA', 'CAJATAMBO', 'CAJATAMBO'),
('150302', 'LIMA', 'CAJATAMBO', 'COPA'),
('150303', 'LIMA', 'CAJATAMBO', 'GORGOR'),
('150304', 'LIMA', 'CAJATAMBO', 'HUANCAPON'),
('150305', 'LIMA', 'CAJATAMBO', 'MANAS'),
('150401', 'LIMA', 'CANTA', 'CANTA'),
('150402', 'LIMA', 'CANTA', 'ARAHUAY'),
('150403', 'LIMA', 'CANTA', 'HUAMANTANGA'),
('150404', 'LIMA', 'CANTA', 'HUAROS'),
('150405', 'LIMA', 'CANTA', 'LACHAQUI'),
('150406', 'LIMA', 'CANTA', 'SAN BUENAVENTURA'),
('150407', 'LIMA', 'CANTA', 'SANTA ROSA DE QUIVES'),
('150501', 'LIMA', 'CAÑETE', 'SAN VICENTE DE CAÑETE'),
('150502', 'LIMA', 'CAÑETE', 'ASIA'),
('150503', 'LIMA', 'CAÑETE', 'CALANGO'),
('150504', 'LIMA', 'CAÑETE', 'CERRO AZUL'),
('150505', 'LIMA', 'CAÑETE', 'CHILCA'),
('150506', 'LIMA', 'CAÑETE', 'COAYLLO'),
('150507', 'LIMA', 'CAÑETE', 'IMPERIAL'),
('150508', 'LIMA', 'CAÑETE', 'LUNAHUANA'),
('150509', 'LIMA', 'CAÑETE', 'MALA'),
('150510', 'LIMA', 'CAÑETE', 'NUEVO IMPERIAL'),
('150511', 'LIMA', 'CAÑETE', 'PACARAN'),
('150512', 'LIMA', 'CAÑETE', 'QUILMANA'),
('150513', 'LIMA', 'CAÑETE', 'SAN ANTONIO'),
('150514', 'LIMA', 'CAÑETE', 'SAN LUIS'),
('150515', 'LIMA', 'CAÑETE', 'SANTA CRUZ DE FLORES'),
('150516', 'LIMA', 'CAÑETE', 'ZUÑIGA'),
('150601', 'LIMA', 'HUARAL', 'HUARAL'),
('150602', 'LIMA', 'HUARAL', 'ATAVILLOS ALTO'),
('150603', 'LIMA', 'HUARAL', 'ATAVILLOS BAJO'),
('150604', 'LIMA', 'HUARAL', 'AUCALLAMA'),
('150605', 'LIMA', 'HUARAL', 'CHANCAY'),
('150606', 'LIMA', 'HUARAL', 'IHUARI'),
('150607', 'LIMA', 'HUARAL', 'LAMPIAN'),
('150608', 'LIMA', 'HUARAL', 'PACARAOS'),
('150609', 'LIMA', 'HUARAL', 'SAN MIGUEL DE ACOS'),
('150610', 'LIMA', 'HUARAL', 'SANTA CRUZ DE ANDAMARCA'),
('150611', 'LIMA', 'HUARAL', 'SUMBILCA'),
('150612', 'LIMA', 'HUARAL', 'VEINTISIETE DE NOVIEMBRE'),
('150701', 'LIMA', 'HUAROCHIRI', 'MATUCANA'),
('150702', 'LIMA', 'HUAROCHIRI', 'ANTIOQUIA'),
('150703', 'LIMA', 'HUAROCHIRI', 'CALLAHUANCA'),
('150704', 'LIMA', 'HUAROCHIRI', 'CARAMPOMA'),
('150705', 'LIMA', 'HUAROCHIRI', 'CHICLA'),
('150706', 'LIMA', 'HUAROCHIRI', 'CUENCA'),
('150707', 'LIMA', 'HUAROCHIRI', 'HUACHUPAMPA'),
('150708', 'LIMA', 'HUAROCHIRI', 'HUANZA'),
('150709', 'LIMA', 'HUAROCHIRI', 'HUAROCHIRI'),
('150710', 'LIMA', 'HUAROCHIRI', 'LAHUAYTAMBO'),
('150711', 'LIMA', 'HUAROCHIRI', 'LANGA'),
('150712', 'LIMA', 'HUAROCHIRI', 'SAN PEDRO DE LARAOS'),
('150713', 'LIMA', 'HUAROCHIRI', 'MARIATANA'),
('150714', 'LIMA', 'HUAROCHIRI', 'RICARDO PALMA'),
('150715', 'LIMA', 'HUAROCHIRI', 'SAN ANDRES DE TUPICOCHA'),
('150716', 'LIMA', 'HUAROCHIRI', 'SAN ANTONIO'),
('150717', 'LIMA', 'HUAROCHIRI', 'SAN BARTOLOME'),
('150718', 'LIMA', 'HUAROCHIRI', 'SAN DAMIAN'),
('150719', 'LIMA', 'HUAROCHIRI', 'SAN JUAN DE IRIS'),
('150720', 'LIMA', 'HUAROCHIRI', 'SAN JUAN DE TANTARANCHE'),
('150721', 'LIMA', 'HUAROCHIRI', 'SAN LORENZO DE QUINTI'),
('150722', 'LIMA', 'HUAROCHIRI', 'SAN MATEO'),
('150723', 'LIMA', 'HUAROCHIRI', 'SAN MATEO DE OTAO'),
('150724', 'LIMA', 'HUAROCHIRI', 'SAN PEDRO DE CASTA'),
('150725', 'LIMA', 'HUAROCHIRI', 'SAN PEDRO DE HUANCAYRE'),
('150726', 'LIMA', 'HUAROCHIRI', 'SANGALLAYA'),
('150727', 'LIMA', 'HUAROCHIRI', 'SANTA CRUZ DE COCACHACRA'),
('150728', 'LIMA', 'HUAROCHIRI', 'SANTA EULALIA'),
('150729', 'LIMA', 'HUAROCHIRI', 'SANTIAGO DE ANCHUCAYA'),
('150730', 'LIMA', 'HUAROCHIRI', 'SANTIAGO DE TUNA'),
('150731', 'LIMA', 'HUAROCHIRI', 'SANTO DOMINGO DE LOS OLLEROS'),
('150732', 'LIMA', 'HUAROCHIRI', 'SURCO'),
('150801', 'LIMA', 'HUAURA', 'HUACHO'),
('150802', 'LIMA', 'HUAURA', 'AMBAR'),
('150803', 'LIMA', 'HUAURA', 'CALETA DE CARQUIN'),
('150804', 'LIMA', 'HUAURA', 'CHECRAS'),
('150805', 'LIMA', 'HUAURA', 'HUALMAY'),
('150806', 'LIMA', 'HUAURA', 'HUAURA'),
('150807', 'LIMA', 'HUAURA', 'LEONCIO PRADO'),
('150808', 'LIMA', 'HUAURA', 'PACCHO'),
('150809', 'LIMA', 'HUAURA', 'SANTA LEONOR'),
('150810', 'LIMA', 'HUAURA', 'SANTA MARIA'),
('150811', 'LIMA', 'HUAURA', 'SAYAN'),
('150812', 'LIMA', 'HUAURA', 'VEGUETA'),
('150901', 'LIMA', 'OYON', 'OYON'),
('150902', 'LIMA', 'OYON', 'ANDAJES'),
('150903', 'LIMA', 'OYON', 'CAUJUL'),
('150904', 'LIMA', 'OYON', 'COCHAMARCA'),
('150905', 'LIMA', 'OYON', 'NAVAN'),
('150906', 'LIMA', 'OYON', 'PACHANGARA'),
('151001', 'LIMA', 'YAUYOS', 'YAUYOS'),
('151002', 'LIMA', 'YAUYOS', 'ALIS'),
('151003', 'LIMA', 'YAUYOS', 'ALLAUCA'),
('151004', 'LIMA', 'YAUYOS', 'AYAVIRI'),
('151005', 'LIMA', 'YAUYOS', 'AZANGARO'),
('151006', 'LIMA', 'YAUYOS', 'CACRA'),
('151007', 'LIMA', 'YAUYOS', 'CARANIA'),
('151008', 'LIMA', 'YAUYOS', 'CATAHUASI'),
('151009', 'LIMA', 'YAUYOS', 'CHOCOS'),
('151010', 'LIMA', 'YAUYOS', 'COCHAS'),
('151011', 'LIMA', 'YAUYOS', 'COLONIA'),
('151012', 'LIMA', 'YAUYOS', 'HONGOS'),
('151013', 'LIMA', 'YAUYOS', 'HUAMPARA'),
('151014', 'LIMA', 'YAUYOS', 'HUANCAYA'),
('151015', 'LIMA', 'YAUYOS', 'HUANGASCAR'),
('151016', 'LIMA', 'YAUYOS', 'HUANTAN'),
('151017', 'LIMA', 'YAUYOS', 'HUAÑEC'),
('151018', 'LIMA', 'YAUYOS', 'LARAOS'),
('151019', 'LIMA', 'YAUYOS', 'LINCHA'),
('151020', 'LIMA', 'YAUYOS', 'MADEAN'),
('151021', 'LIMA', 'YAUYOS', 'MIRAFLORES'),
('151022', 'LIMA', 'YAUYOS', 'OMAS'),
('151023', 'LIMA', 'YAUYOS', 'PUTINZA'),
('151024', 'LIMA', 'YAUYOS', 'QUINCHES'),
('151025', 'LIMA', 'YAUYOS', 'QUINOCAY'),
('151026', 'LIMA', 'YAUYOS', 'SAN JOAQUIN'),
('151027', 'LIMA', 'YAUYOS', 'SAN PEDRO DE PILAS'),
('151028', 'LIMA', 'YAUYOS', 'TANTA'),
('151029', 'LIMA', 'YAUYOS', 'TAURIPAMPA'),
('151030', 'LIMA', 'YAUYOS', 'TOMAS'),
('151031', 'LIMA', 'YAUYOS', 'TUPE'),
('151032', 'LIMA', 'YAUYOS', 'VIÑAC'),
('151033', 'LIMA', 'YAUYOS', 'VITIS'),
('160101', 'LORETO', 'MAYNAS', 'IQUITOS'),
('160102', 'LORETO', 'MAYNAS', 'ALTO NANAY'),
('160103', 'LORETO', 'MAYNAS', 'FERNANDO LORES'),
('160104', 'LORETO', 'MAYNAS', 'INDIANA'),
('160105', 'LORETO', 'MAYNAS', 'LAS AMAZONAS'),
('160106', 'LORETO', 'MAYNAS', 'MAZAN'),
('160107', 'LORETO', 'MAYNAS', 'NAPO'),
('160108', 'LORETO', 'MAYNAS', 'PUNCHANA'),
('160110', 'LORETO', 'MAYNAS', 'TORRES CAUSANA'),
('160112', 'LORETO', 'MAYNAS', 'BELEN'),
('160113', 'LORETO', 'MAYNAS', 'SAN JUAN BAUTISTA'),
('160201', 'LORETO', 'ALTO AMAZONAS', 'YURIMAGUAS'),
('160202', 'LORETO', 'ALTO AMAZONAS', 'BALSAPUERTO'),
('160205', 'LORETO', 'ALTO AMAZONAS', 'JEBEROS'),
('160206', 'LORETO', 'ALTO AMAZONAS', 'LAGUNAS'),
('160210', 'LORETO', 'ALTO AMAZONAS', 'SANTA CRUZ'),
('160211', 'LORETO', 'ALTO AMAZONAS', 'TENIENTE CESAR LOPEZ ROJAS'),
('160301', 'LORETO', 'LORETO', 'NAUTA'),
('160302', 'LORETO', 'LORETO', 'PARINARI'),
('160303', 'LORETO', 'LORETO', 'TIGRE'),
('160304', 'LORETO', 'LORETO', 'TROMPETEROS'),
('160305', 'LORETO', 'LORETO', 'URARINAS'),
('160401', 'LORETO', 'MARISCAL RAMON CASTILLA', 'RAMON CASTILLA'),
('160402', 'LORETO', 'MARISCAL RAMON CASTILLA', 'PEBAS'),
('160403', 'LORETO', 'MARISCAL RAMON CASTILLA', 'YAVARI'),
('160404', 'LORETO', 'MARISCAL RAMON CASTILLA', 'SAN PABLO'),
('160501', 'LORETO', 'REQUENA', 'REQUENA'),
('160502', 'LORETO', 'REQUENA', 'ALTO TAPICHE'),
('160503', 'LORETO', 'REQUENA', 'CAPELO'),
('160504', 'LORETO', 'REQUENA', 'EMILIO SAN MARTIN'),
('160505', 'LORETO', 'REQUENA', 'MAQUIA'),
('160506', 'LORETO', 'REQUENA', 'PUINAHUA'),
('160507', 'LORETO', 'REQUENA', 'SAQUENA'),
('160508', 'LORETO', 'REQUENA', 'SOPLIN'),
('160509', 'LORETO', 'REQUENA', 'TAPICHE'),
('160510', 'LORETO', 'REQUENA', 'JENARO HERRERA'),
('160511', 'LORETO', 'REQUENA', 'YAQUERANA'),
('160601', 'LORETO', 'UCAYALI', 'CONTAMANA'),
('160602', 'LORETO', 'UCAYALI', 'INAHUAYA'),
('160603', 'LORETO', 'UCAYALI', 'PADRE MARQUEZ'),
('160604', 'LORETO', 'UCAYALI', 'PAMPA HERMOSA'),
('160605', 'LORETO', 'UCAYALI', 'SARAYACU'),
('160606', 'LORETO', 'UCAYALI', 'VARGAS GUERRA'),
('160701', 'LORETO', 'DATEM DEL MARAÑON', 'BARRANCA'),
('160702', 'LORETO', 'DATEM DEL MARAÑON', 'CAHUAPANAS'),
('160703', 'LORETO', 'DATEM DEL MARAÑON', 'MANSERICHE'),
('160704', 'LORETO', 'DATEM DEL MARAÑON', 'MORONA'),
('160705', 'LORETO', 'DATEM DEL MARAÑON', 'PASTAZA'),
('160706', 'LORETO', 'DATEM DEL MARAÑON', 'ANDOAS'),
('160801', 'LORETO', 'PUTUMAYO', 'PUTUMAYO'),
('160802', 'LORETO', 'PUTUMAYO', 'ROSA PANDURO'),
('160803', 'LORETO', 'PUTUMAYO', 'TENIENTE MANUEL CLAVERO'),
('160804', 'LORETO', 'PUTUMAYO', 'YAGUAS'),
('170101', 'MADRE DE DIOS', 'TAMBOPATA', 'TAMBOPATA'),
('170102', 'MADRE DE DIOS', 'TAMBOPATA', 'INAMBARI'),
('170103', 'MADRE DE DIOS', 'TAMBOPATA', 'LAS PIEDRAS'),
('170104', 'MADRE DE DIOS', 'TAMBOPATA', 'LABERINTO'),
('170201', 'MADRE DE DIOS', 'MANU', 'MANU'),
('170202', 'MADRE DE DIOS', 'MANU', 'FITZCARRALD'),
('170203', 'MADRE DE DIOS', 'MANU', 'MADRE DE DIOS'),
('170204', 'MADRE DE DIOS', 'MANU', 'HUEPETUHE'),
('170301', 'MADRE DE DIOS', 'TAHUAMANU', 'IÑAPARI'),
('170302', 'MADRE DE DIOS', 'TAHUAMANU', 'IBERIA'),
('170303', 'MADRE DE DIOS', 'TAHUAMANU', 'TAHUAMANU'),
('180101', 'MOQUEGUA', 'MARISCAL NIETO', 'MOQUEGUA'),
('180102', 'MOQUEGUA', 'MARISCAL NIETO', 'CARUMAS'),
('180103', 'MOQUEGUA', 'MARISCAL NIETO', 'CUCHUMBAYA'),
('180104', 'MOQUEGUA', 'MARISCAL NIETO', 'SAMEGUA'),
('180105', 'MOQUEGUA', 'MARISCAL NIETO', 'SAN CRISTOBAL'),
('180106', 'MOQUEGUA', 'MARISCAL NIETO', 'TORATA'),
('180201', 'MOQUEGUA', 'GENERAL SANCHEZ CERRO', 'OMATE'),
('180202', 'MOQUEGUA', 'GENERAL SANCHEZ CERRO', 'CHOJATA'),
('180203', 'MOQUEGUA', 'GENERAL SANCHEZ CERRO', 'COALAQUE'),
('180204', 'MOQUEGUA', 'GENERAL SANCHEZ CERRO', 'ICHUÑA'),
('180205', 'MOQUEGUA', 'GENERAL SANCHEZ CERRO', 'LA CAPILLA'),
('180206', 'MOQUEGUA', 'GENERAL SANCHEZ CERRO', 'LLOQUE'),
('180207', 'MOQUEGUA', 'GENERAL SANCHEZ CERRO', 'MATALAQUE'),
('180208', 'MOQUEGUA', 'GENERAL SANCHEZ CERRO', 'PUQUINA'),
('180209', 'MOQUEGUA', 'GENERAL SANCHEZ CERRO', 'QUINISTAQUILLAS'),
('180210', 'MOQUEGUA', 'GENERAL SANCHEZ CERRO', 'UBINAS'),
('180211', 'MOQUEGUA', 'GENERAL SANCHEZ CERRO', 'YUNGA'),
('180301', 'MOQUEGUA', 'ILO', 'ILO'),
('180302', 'MOQUEGUA', 'ILO', 'EL ALGARROBAL'),
('180303', 'MOQUEGUA', 'ILO', 'PACOCHA'),
('190101', 'PASCO', 'PASCO', 'CHAUPIMARCA'),
('190102', 'PASCO', 'PASCO', 'HUACHON'),
('190103', 'PASCO', 'PASCO', 'HUARIACA'),
('190104', 'PASCO', 'PASCO', 'HUAYLLAY'),
('190105', 'PASCO', 'PASCO', 'NINACACA'),
('190106', 'PASCO', 'PASCO', 'PALLANCHACRA'),
('190107', 'PASCO', 'PASCO', 'PAUCARTAMBO'),
('190108', 'PASCO', 'PASCO', 'SAN FRANCISCO DE ASIS DE YARUSYACAN'),
('190109', 'PASCO', 'PASCO', 'SIMON BOLIVAR'),
('190110', 'PASCO', 'PASCO', 'TICLACAYAN'),
('190111', 'PASCO', 'PASCO', 'TINYAHUARCO'),
('190112', 'PASCO', 'PASCO', 'VICCO'),
('190113', 'PASCO', 'PASCO', 'YANACANCHA'),
('190201', 'PASCO', 'DANIEL ALCIDES CARRION', 'YANAHUANCA'),
('190202', 'PASCO', 'DANIEL ALCIDES CARRION', 'CHACAYAN'),
('190203', 'PASCO', 'DANIEL ALCIDES CARRION', 'GOYLLARISQUIZGA'),
('190204', 'PASCO', 'DANIEL ALCIDES CARRION', 'PAUCAR'),
('190205', 'PASCO', 'DANIEL ALCIDES CARRION', 'SAN PEDRO DE PILLAO'),
('190206', 'PASCO', 'DANIEL ALCIDES CARRION', 'SANTA ANA DE TUSI'),
('190207', 'PASCO', 'DANIEL ALCIDES CARRION', 'TAPUC'),
('190208', 'PASCO', 'DANIEL ALCIDES CARRION', 'VILCABAMBA'),
('190301', 'PASCO', 'OXAPAMPA', 'OXAPAMPA'),
('190302', 'PASCO', 'OXAPAMPA', 'CHONTABAMBA'),
('190303', 'PASCO', 'OXAPAMPA', 'HUANCABAMBA'),
('190304', 'PASCO', 'OXAPAMPA', 'PALCAZU'),
('190305', 'PASCO', 'OXAPAMPA', 'POZUZO'),
('190306', 'PASCO', 'OXAPAMPA', 'PUERTO BERMUDEZ'),
('190307', 'PASCO', 'OXAPAMPA', 'VILLA RICA'),
('190308', 'PASCO', 'OXAPAMPA', 'CONSTITUCION'),
('200101', 'PIURA', 'PIURA', 'PIURA'),
('200104', 'PIURA', 'PIURA', 'CASTILLA'),
('200105', 'PIURA', 'PIURA', 'CATACAOS'),
('200107', 'PIURA', 'PIURA', 'CURA MORI'),
('200108', 'PIURA', 'PIURA', 'EL TALLAN'),
('200109', 'PIURA', 'PIURA', 'LA ARENA'),
('200110', 'PIURA', 'PIURA', 'LA UNION'),
('200111', 'PIURA', 'PIURA', 'LAS LOMAS'),
('200114', 'PIURA', 'PIURA', 'TAMBO GRANDE'),
('200115', 'PIURA', 'PIURA', 'VEINTISEIS DE OCTUBRE'),
('200201', 'PIURA', 'AYABACA', 'AYABACA'),
('200202', 'PIURA', 'AYABACA', 'FRIAS'),
('200203', 'PIURA', 'AYABACA', 'JILILI'),
('200204', 'PIURA', 'AYABACA', 'LAGUNAS'),
('200205', 'PIURA', 'AYABACA', 'MONTERO'),
('200206', 'PIURA', 'AYABACA', 'PACAIPAMPA'),
('200207', 'PIURA', 'AYABACA', 'PAIMAS'),
('200208', 'PIURA', 'AYABACA', 'SAPILLICA'),
('200209', 'PIURA', 'AYABACA', 'SICCHEZ'),
('200210', 'PIURA', 'AYABACA', 'SUYO'),
('200301', 'PIURA', 'HUANCABAMBA', 'HUANCABAMBA'),
('200302', 'PIURA', 'HUANCABAMBA', 'CANCHAQUE'),
('200303', 'PIURA', 'HUANCABAMBA', 'EL CARMEN DE LA FRONTERA'),
('200304', 'PIURA', 'HUANCABAMBA', 'HUARMACA'),
('200305', 'PIURA', 'HUANCABAMBA', 'LALAQUIZ'),
('200306', 'PIURA', 'HUANCABAMBA', 'SAN MIGUEL DE EL FAIQUE'),
('200307', 'PIURA', 'HUANCABAMBA', 'SONDOR'),
('200308', 'PIURA', 'HUANCABAMBA', 'SONDORILLO'),
('200401', 'PIURA', 'MORROPON', 'CHULUCANAS'),
('200402', 'PIURA', 'MORROPON', 'BUENOS AIRES'),
('200403', 'PIURA', 'MORROPON', 'CHALACO'),
('200404', 'PIURA', 'MORROPON', 'LA MATANZA'),
('200405', 'PIURA', 'MORROPON', 'MORROPON'),
('200406', 'PIURA', 'MORROPON', 'SALITRAL'),
('200407', 'PIURA', 'MORROPON', 'SAN JUAN DE BIGOTE'),
('200408', 'PIURA', 'MORROPON', 'SANTA CATALINA DE MOSSA'),
('200409', 'PIURA', 'MORROPON', 'SANTO DOMINGO'),
('200410', 'PIURA', 'MORROPON', 'YAMANGO'),
('200501', 'PIURA', 'PAITA', 'PAITA'),
('200502', 'PIURA', 'PAITA', 'AMOTAPE'),
('200503', 'PIURA', 'PAITA', 'ARENAL'),
('200504', 'PIURA', 'PAITA', 'COLAN'),
('200505', 'PIURA', 'PAITA', 'LA HUACA'),
('200506', 'PIURA', 'PAITA', 'TAMARINDO'),
('200507', 'PIURA', 'PAITA', 'VICHAYAL'),
('200601', 'PIURA', 'SULLANA', 'SULLANA'),
('200602', 'PIURA', 'SULLANA', 'BELLAVISTA'),
('200603', 'PIURA', 'SULLANA', 'IGNACIO ESCUDERO'),
('200604', 'PIURA', 'SULLANA', 'LANCONES'),
('200605', 'PIURA', 'SULLANA', 'MARCAVELICA'),
('200606', 'PIURA', 'SULLANA', 'MIGUEL CHECA'),
('200607', 'PIURA', 'SULLANA', 'QUERECOTILLO'),
('200608', 'PIURA', 'SULLANA', 'SALITRAL'),
('200701', 'PIURA', 'TALARA', 'PARIÑAS'),
('200702', 'PIURA', 'TALARA', 'EL ALTO'),
('200703', 'PIURA', 'TALARA', 'LA BREA'),
('200704', 'PIURA', 'TALARA', 'LOBITOS'),
('200705', 'PIURA', 'TALARA', 'LOS ORGANOS'),
('200706', 'PIURA', 'TALARA', 'MANCORA'),
('200801', 'PIURA', 'SECHURA', 'SECHURA'),
('200802', 'PIURA', 'SECHURA', 'BELLAVISTA DE LA UNION'),
('200803', 'PIURA', 'SECHURA', 'BERNAL'),
('200804', 'PIURA', 'SECHURA', 'CRISTO NOS VALGA'),
('200805', 'PIURA', 'SECHURA', 'VICE'),
('200806', 'PIURA', 'SECHURA', 'RINCONADA LLICUAR'),
('210101', 'PUNO', 'PUNO', 'PUNO'),
('210102', 'PUNO', 'PUNO', 'ACORA'),
('210103', 'PUNO', 'PUNO', 'AMANTANI'),
('210104', 'PUNO', 'PUNO', 'ATUNCOLLA'),
('210105', 'PUNO', 'PUNO', 'CAPACHICA'),
('210106', 'PUNO', 'PUNO', 'CHUCUITO'),
('210107', 'PUNO', 'PUNO', 'COATA'),
('210108', 'PUNO', 'PUNO', 'HUATA'),
('210109', 'PUNO', 'PUNO', 'MAÑAZO'),
('210110', 'PUNO', 'PUNO', 'PAUCARCOLLA'),
('210111', 'PUNO', 'PUNO', 'PICHACANI'),
('210112', 'PUNO', 'PUNO', 'PLATERIA'),
('210113', 'PUNO', 'PUNO', 'SAN ANTONIO'),
('210114', 'PUNO', 'PUNO', 'TIQUILLACA'),
('210115', 'PUNO', 'PUNO', 'VILQUE'),
('210201', 'PUNO', 'AZANGARO', 'AZANGARO'),
('210202', 'PUNO', 'AZANGARO', 'ACHAYA'),
('210203', 'PUNO', 'AZANGARO', 'ARAPA'),
('210204', 'PUNO', 'AZANGARO', 'ASILLO'),
('210205', 'PUNO', 'AZANGARO', 'CAMINACA'),
('210206', 'PUNO', 'AZANGARO', 'CHUPA'),
('210207', 'PUNO', 'AZANGARO', 'JOSE DOMINGO CHOQUEHUANCA'),
('210208', 'PUNO', 'AZANGARO', 'MUÑANI'),
('210209', 'PUNO', 'AZANGARO', 'POTONI'),
('210210', 'PUNO', 'AZANGARO', 'SAMAN'),
('210211', 'PUNO', 'AZANGARO', 'SAN ANTON'),
('210212', 'PUNO', 'AZANGARO', 'SAN JOSE'),
('210213', 'PUNO', 'AZANGARO', 'SAN JUAN DE SALINAS'),
('210214', 'PUNO', 'AZANGARO', 'SANTIAGO DE PUPUJA'),
('210215', 'PUNO', 'AZANGARO', 'TIRAPATA'),
('210301', 'PUNO', 'CARABAYA', 'MACUSANI'),
('210302', 'PUNO', 'CARABAYA', 'AJOYANI'),
('210303', 'PUNO', 'CARABAYA', 'AYAPATA'),
('210304', 'PUNO', 'CARABAYA', 'COASA'),
('210305', 'PUNO', 'CARABAYA', 'CORANI'),
('210306', 'PUNO', 'CARABAYA', 'CRUCERO'),
('210307', 'PUNO', 'CARABAYA', 'ITUATA'),
('210308', 'PUNO', 'CARABAYA', 'OLLACHEA'),
('210309', 'PUNO', 'CARABAYA', 'SAN GABAN'),
('210310', 'PUNO', 'CARABAYA', 'USICAYOS'),
('210401', 'PUNO', 'CHUCUITO', 'JULI'),
('210402', 'PUNO', 'CHUCUITO', 'DESAGUADERO'),
('210403', 'PUNO', 'CHUCUITO', 'HUACULLANI'),
('210404', 'PUNO', 'CHUCUITO', 'KELLUYO'),
('210405', 'PUNO', 'CHUCUITO', 'PISACOMA'),
('210406', 'PUNO', 'CHUCUITO', 'POMATA'),
('210407', 'PUNO', 'CHUCUITO', 'ZEPITA'),
('210501', 'PUNO', 'EL COLLAO', 'ILAVE'),
('210502', 'PUNO', 'EL COLLAO', 'CAPAZO'),
('210503', 'PUNO', 'EL COLLAO', 'PILCUYO'),
('210504', 'PUNO', 'EL COLLAO', 'SANTA ROSA'),
('210505', 'PUNO', 'EL COLLAO', 'CONDURIRI'),
('210601', 'PUNO', 'HUANCANE', 'HUANCANE'),
('210602', 'PUNO', 'HUANCANE', 'COJATA'),
('210603', 'PUNO', 'HUANCANE', 'HUATASANI'),
('210604', 'PUNO', 'HUANCANE', 'INCHUPALLA'),
('210605', 'PUNO', 'HUANCANE', 'PUSI'),
('210606', 'PUNO', 'HUANCANE', 'ROSASPATA'),
('210607', 'PUNO', 'HUANCANE', 'TARACO'),
('210608', 'PUNO', 'HUANCANE', 'VILQUE CHICO'),
('210701', 'PUNO', 'LAMPA', 'LAMPA'),
('210702', 'PUNO', 'LAMPA', 'CABANILLA'),
('210703', 'PUNO', 'LAMPA', 'CALAPUJA'),
('210704', 'PUNO', 'LAMPA', 'NICASIO'),
('210705', 'PUNO', 'LAMPA', 'OCUVIRI'),
('210706', 'PUNO', 'LAMPA', 'PALCA'),
('210707', 'PUNO', 'LAMPA', 'PARATIA'),
('210708', 'PUNO', 'LAMPA', 'PUCARA'),
('210709', 'PUNO', 'LAMPA', 'SANTA LUCIA'),
('210710', 'PUNO', 'LAMPA', 'VILAVILA'),
('210801', 'PUNO', 'MELGAR', 'AYAVIRI'),
('210802', 'PUNO', 'MELGAR', 'ANTAUTA'),
('210803', 'PUNO', 'MELGAR', 'CUPI'),
('210804', 'PUNO', 'MELGAR', 'LLALLI'),
('210805', 'PUNO', 'MELGAR', 'MACARI'),
('210806', 'PUNO', 'MELGAR', 'NUÑOA'),
('210807', 'PUNO', 'MELGAR', 'ORURILLO'),
('210808', 'PUNO', 'MELGAR', 'SANTA ROSA'),
('210809', 'PUNO', 'MELGAR', 'UMACHIRI'),
('210901', 'PUNO', 'MOHO', 'MOHO'),
('210902', 'PUNO', 'MOHO', 'CONIMA'),
('210903', 'PUNO', 'MOHO', 'HUAYRAPATA'),
('210904', 'PUNO', 'MOHO', 'TILALI'),
('211001', 'PUNO', 'SAN ANTONIO DE PUTINA', 'PUTINA'),
('211002', 'PUNO', 'SAN ANTONIO DE PUTINA', 'ANANEA'),
('211003', 'PUNO', 'SAN ANTONIO DE PUTINA', 'PEDRO VILCA APAZA'),
('211004', 'PUNO', 'SAN ANTONIO DE PUTINA', 'QUILCAPUNCU'),
('211005', 'PUNO', 'SAN ANTONIO DE PUTINA', 'SINA'),
('211101', 'PUNO', 'SAN ROMAN', 'JULIACA'),
('211102', 'PUNO', 'SAN ROMAN', 'CABANA'),
('211103', 'PUNO', 'SAN ROMAN', 'CABANILLAS'),
('211104', 'PUNO', 'SAN ROMAN', 'CARACOTO'),
('211105', 'PUNO', 'SAN ROMAN', 'SAN MIGUEL'),
('211201', 'PUNO', 'SANDIA', 'SANDIA'),
('211202', 'PUNO', 'SANDIA', 'CUYOCUYO'),
('211203', 'PUNO', 'SANDIA', 'LIMBANI'),
('211204', 'PUNO', 'SANDIA', 'PATAMBUCO'),
('211205', 'PUNO', 'SANDIA', 'PHARA'),
('211206', 'PUNO', 'SANDIA', 'QUIACA'),
('211207', 'PUNO', 'SANDIA', 'SAN JUAN DEL ORO'),
('211208', 'PUNO', 'SANDIA', 'YANAHUAYA'),
('211209', 'PUNO', 'SANDIA', 'ALTO INAMBARI'),
('211210', 'PUNO', 'SANDIA', 'SAN PEDRO DE PUTINA PUNCO'),
('211301', 'PUNO', 'YUNGUYO', 'YUNGUYO'),
('211302', 'PUNO', 'YUNGUYO', 'ANAPIA'),
('211303', 'PUNO', 'YUNGUYO', 'COPANI'),
('211304', 'PUNO', 'YUNGUYO', 'CUTURAPI'),
('211305', 'PUNO', 'YUNGUYO', 'OLLARAYA'),
('211306', 'PUNO', 'YUNGUYO', 'TINICACHI'),
('211307', 'PUNO', 'YUNGUYO', 'UNICACHI'),
('220101', 'SAN MARTIN', 'MOYOBAMBA', 'MOYOBAMBA'),
('220102', 'SAN MARTIN', 'MOYOBAMBA', 'CALZADA'),
('220103', 'SAN MARTIN', 'MOYOBAMBA', 'HABANA'),
('220104', 'SAN MARTIN', 'MOYOBAMBA', 'JEPELACIO'),
('220105', 'SAN MARTIN', 'MOYOBAMBA', 'SORITOR'),
('220106', 'SAN MARTIN', 'MOYOBAMBA', 'YANTALO'),
('220201', 'SAN MARTIN', 'BELLAVISTA', 'BELLAVISTA'),
('220202', 'SAN MARTIN', 'BELLAVISTA', 'ALTO BIAVO'),
('220203', 'SAN MARTIN', 'BELLAVISTA', 'BAJO BIAVO'),
('220204', 'SAN MARTIN', 'BELLAVISTA', 'HUALLAGA'),
('220205', 'SAN MARTIN', 'BELLAVISTA', 'SAN PABLO'),
('220206', 'SAN MARTIN', 'BELLAVISTA', 'SAN RAFAEL'),
('220301', 'SAN MARTIN', 'EL DORADO', 'SAN JOSE DE SISA'),
('220302', 'SAN MARTIN', 'EL DORADO', 'AGUA BLANCA'),
('220303', 'SAN MARTIN', 'EL DORADO', 'SAN MARTIN'),
('220304', 'SAN MARTIN', 'EL DORADO', 'SANTA ROSA'),
('220305', 'SAN MARTIN', 'EL DORADO', 'SHATOJA'),
('220401', 'SAN MARTIN', 'HUALLAGA', 'SAPOSOA'),
('220402', 'SAN MARTIN', 'HUALLAGA', 'ALTO SAPOSOA'),
('220403', 'SAN MARTIN', 'HUALLAGA', 'EL ESLABON'),
('220404', 'SAN MARTIN', 'HUALLAGA', 'PISCOYACU'),
('220405', 'SAN MARTIN', 'HUALLAGA', 'SACANCHE'),
('220406', 'SAN MARTIN', 'HUALLAGA', 'TINGO DE SAPOSOA'),
('220501', 'SAN MARTIN', 'LAMAS', 'LAMAS'),
('220502', 'SAN MARTIN', 'LAMAS', 'ALONSO DE ALVARADO'),
('220503', 'SAN MARTIN', 'LAMAS', 'BARRANQUITA'),
('220504', 'SAN MARTIN', 'LAMAS', 'CAYNARACHI'),
('220505', 'SAN MARTIN', 'LAMAS', 'CUÑUMBUQUI'),
('220506', 'SAN MARTIN', 'LAMAS', 'PINTO RECODO'),
('220507', 'SAN MARTIN', 'LAMAS', 'RUMISAPA'),
('220508', 'SAN MARTIN', 'LAMAS', 'SAN ROQUE DE CUMBAZA'),
('220509', 'SAN MARTIN', 'LAMAS', 'SHANAO'),
('220510', 'SAN MARTIN', 'LAMAS', 'TABALOSOS'),
('220511', 'SAN MARTIN', 'LAMAS', 'ZAPATERO'),
('220601', 'SAN MARTIN', 'MARISCAL CACERES', 'JUANJUI'),
('220602', 'SAN MARTIN', 'MARISCAL CACERES', 'CAMPANILLA'),
('220603', 'SAN MARTIN', 'MARISCAL CACERES', 'HUICUNGO'),
('220604', 'SAN MARTIN', 'MARISCAL CACERES', 'PACHIZA'),
('220605', 'SAN MARTIN', 'MARISCAL CACERES', 'PAJARILLO'),
('220701', 'SAN MARTIN', 'PICOTA', 'PICOTA'),
('220702', 'SAN MARTIN', 'PICOTA', 'BUENOS AIRES'),
('220703', 'SAN MARTIN', 'PICOTA', 'CASPISAPA'),
('220704', 'SAN MARTIN', 'PICOTA', 'PILLUANA'),
('220705', 'SAN MARTIN', 'PICOTA', 'PUCACACA'),
('220706', 'SAN MARTIN', 'PICOTA', 'SAN CRISTOBAL'),
('220707', 'SAN MARTIN', 'PICOTA', 'SAN HILARION'),
('220708', 'SAN MARTIN', 'PICOTA', 'SHAMBOYACU'),
('220709', 'SAN MARTIN', 'PICOTA', 'TINGO DE PONASA'),
('220710', 'SAN MARTIN', 'PICOTA', 'TRES UNIDOS'),
('220801', 'SAN MARTIN', 'RIOJA', 'RIOJA'),
('220802', 'SAN MARTIN', 'RIOJA', 'AWAJUN'),
('220803', 'SAN MARTIN', 'RIOJA', 'ELIAS SOPLIN VARGAS'),
('220804', 'SAN MARTIN', 'RIOJA', 'NUEVA CAJAMARCA'),
('220805', 'SAN MARTIN', 'RIOJA', 'PARDO MIGUEL'),
('220806', 'SAN MARTIN', 'RIOJA', 'POSIC'),
('220807', 'SAN MARTIN', 'RIOJA', 'SAN FERNANDO'),
('220808', 'SAN MARTIN', 'RIOJA', 'YORONGOS'),
('220809', 'SAN MARTIN', 'RIOJA', 'YURACYACU'),
('220901', 'SAN MARTIN', 'SAN MARTIN', 'TARAPOTO'),
('220902', 'SAN MARTIN', 'SAN MARTIN', 'ALBERTO LEVEAU'),
('220903', 'SAN MARTIN', 'SAN MARTIN', 'CACATACHI'),
('220904', 'SAN MARTIN', 'SAN MARTIN', 'CHAZUTA'),
('220905', 'SAN MARTIN', 'SAN MARTIN', 'CHIPURANA'),
('220906', 'SAN MARTIN', 'SAN MARTIN', 'EL PORVENIR'),
('220907', 'SAN MARTIN', 'SAN MARTIN', 'HUIMBAYOC'),
('220908', 'SAN MARTIN', 'SAN MARTIN', 'JUAN GUERRA'),
('220909', 'SAN MARTIN', 'SAN MARTIN', 'LA BANDA DE SHILCAYO'),
('220910', 'SAN MARTIN', 'SAN MARTIN', 'MORALES'),
('220911', 'SAN MARTIN', 'SAN MARTIN', 'PAPAPLAYA'),
('220912', 'SAN MARTIN', 'SAN MARTIN', 'SAN ANTONIO'),
('220913', 'SAN MARTIN', 'SAN MARTIN', 'SAUCE'),
('220914', 'SAN MARTIN', 'SAN MARTIN', 'SHAPAJA'),
('221001', 'SAN MARTIN', 'TOCACHE', 'TOCACHE'),
('221002', 'SAN MARTIN', 'TOCACHE', 'NUEVO PROGRESO'),
('221003', 'SAN MARTIN', 'TOCACHE', 'POLVORA'),
('221004', 'SAN MARTIN', 'TOCACHE', 'SHUNTE'),
('221005', 'SAN MARTIN', 'TOCACHE', 'UCHIZA'),
('230101', 'TACNA', 'TACNA', 'TACNA'),
('230102', 'TACNA', 'TACNA', 'ALTO DE LA ALIANZA'),
('230103', 'TACNA', 'TACNA', 'CALANA'),
('230104', 'TACNA', 'TACNA', 'CIUDAD NUEVA'),
('230105', 'TACNA', 'TACNA', 'INCLAN'),
('230106', 'TACNA', 'TACNA', 'PACHIA'),
('230107', 'TACNA', 'TACNA', 'PALCA'),
('230108', 'TACNA', 'TACNA', 'POCOLLAY'),
('230109', 'TACNA', 'TACNA', 'SAMA'),
('230110', 'TACNA', 'TACNA', 'CORONEL GREGORIO ALBARRACIN LANCHIPA'),
('230111', 'TACNA', 'TACNA', 'LA YARADA LOS PALOS'),
('230201', 'TACNA', 'CANDARAVE', 'CANDARAVE'),
('230202', 'TACNA', 'CANDARAVE', 'CAIRANI'),
('230203', 'TACNA', 'CANDARAVE', 'CAMILACA'),
('230204', 'TACNA', 'CANDARAVE', 'CURIBAYA'),
('230205', 'TACNA', 'CANDARAVE', 'HUANUARA'),
('230206', 'TACNA', 'CANDARAVE', 'QUILAHUANI'),
('230301', 'TACNA', 'JORGE BASADRE', 'LOCUMBA'),
('230302', 'TACNA', 'JORGE BASADRE', 'ILABAYA'),
('230303', 'TACNA', 'JORGE BASADRE', 'ITE'),
('230401', 'TACNA', 'TARATA', 'TARATA'),
('230402', 'TACNA', 'TARATA', 'HEROES ALBARRACIN'),
('230403', 'TACNA', 'TARATA', 'ESTIQUE'),
('230404', 'TACNA', 'TARATA', 'ESTIQUE-PAMPA'),
('230405', 'TACNA', 'TARATA', 'SITAJARA'),
('230406', 'TACNA', 'TARATA', 'SUSAPAYA'),
('230407', 'TACNA', 'TARATA', 'TARUCACHI'),
('230408', 'TACNA', 'TARATA', 'TICACO'),
('240101', 'TUMBES', 'TUMBES', 'TUMBES'),
('240102', 'TUMBES', 'TUMBES', 'CORRALES'),
('240103', 'TUMBES', 'TUMBES', 'LA CRUZ'),
('240104', 'TUMBES', 'TUMBES', 'PAMPAS DE HOSPITAL'),
('240105', 'TUMBES', 'TUMBES', 'SAN JACINTO'),
('240106', 'TUMBES', 'TUMBES', 'SAN JUAN DE LA VIRGEN'),
('240201', 'TUMBES', 'CONTRALMIRANTE VILLAR', 'ZORRITOS'),
('240202', 'TUMBES', 'CONTRALMIRANTE VILLAR', 'CASITAS'),
('240203', 'TUMBES', 'CONTRALMIRANTE VILLAR', 'CANOAS DE PUNTA SAL'),
('240301', 'TUMBES', 'ZARUMILLA', 'ZARUMILLA'),
('240302', 'TUMBES', 'ZARUMILLA', 'AGUAS VERDES'),
('240303', 'TUMBES', 'ZARUMILLA', 'MATAPALO'),
('240304', 'TUMBES', 'ZARUMILLA', 'PAPAYAL'),
('250101', 'UCAYALI', 'CORONEL PORTILLO', 'CALLERIA'),
('250102', 'UCAYALI', 'CORONEL PORTILLO', 'CAMPOVERDE'),
('250103', 'UCAYALI', 'CORONEL PORTILLO', 'IPARIA'),
('250104', 'UCAYALI', 'CORONEL PORTILLO', 'MASISEA'),
('250105', 'UCAYALI', 'CORONEL PORTILLO', 'YARINACOCHA'),
('250106', 'UCAYALI', 'CORONEL PORTILLO', 'NUEVA REQUENA'),
('250107', 'UCAYALI', 'CORONEL PORTILLO', 'MANANTAY'),
('250201', 'UCAYALI', 'ATALAYA', 'RAYMONDI'),
('250202', 'UCAYALI', 'ATALAYA', 'SEPAHUA'),
('250203', 'UCAYALI', 'ATALAYA', 'TAHUANIA'),
('250204', 'UCAYALI', 'ATALAYA', 'YURUA'),
('250301', 'UCAYALI', 'PADRE ABAD', 'PADRE ABAD'),
('250302', 'UCAYALI', 'PADRE ABAD', 'IRAZOLA'),
('250303', 'UCAYALI', 'PADRE ABAD', 'CURIMANA'),
('250304', 'UCAYALI', 'PADRE ABAD', 'NESHUYA'),
('250305', 'UCAYALI', 'PADRE ABAD', 'ALEXANDER VON HUMBOLDT'),
('250401', 'UCAYALI', 'PURUS', 'PURUS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usu_id` int(11) NOT NULL,
  `identidad` int(11) DEFAULT NULL,
  `usu_usuario` varchar(45) DEFAULT NULL,
  `usu_nombre` varchar(30) DEFAULT NULL,
  `usu_apellidos` varchar(45) DEFAULT NULL,
  `usu_contrasena` char(255) DEFAULT NULL,
  `rol_id` int(11) DEFAULT NULL,
  `imagen` text DEFAULT NULL,
  `usu_estatus` enum('ACTIVO','INACTIVO') NOT NULL,
  `toke_loguin` text DEFAULT NULL,
  `date_sessio` date DEFAULT NULL,
  `session_fallidos` int(11) DEFAULT NULL,
  `tp_docu` int(11) NOT NULL,
  `dni` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usu_id`, `identidad`, `usu_usuario`, `usu_nombre`, `usu_apellidos`, `usu_contrasena`, `rol_id`, `imagen`, `usu_estatus`, `toke_loguin`, `date_sessio`, `session_fallidos`, `tp_docu`, `dni`) VALUES
(1, 0, 'Soporte', 'Soporte TID', 'Academico', '$argon2i$v=19$m=65536,t=4,p=1$cWxjL1IvbVpzSTJPOGpyYQ$1go3uo+QIyOZUyjycCIgR3aoORX3hW1kb67sVVaHTIk', 1, 'USER_UPDATE12202310456.jpg', 'ACTIVO', NULL, NULL, NULL, 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `yearscolar`
--

CREATE TABLE `yearscolar` (
  `id_year` int(11) NOT NULL,
  `fechainicio` date NOT NULL,
  `fechafin` date NOT NULL,
  `cierramatricula` date NOT NULL,
  `tipoevaluacion` varchar(45) NOT NULL,
  `yearScolar` varchar(45) NOT NULL,
  `stadoyear` enum('ACTIVO','INACTIVO') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `yearscolar`
--

INSERT INTO `yearscolar` (`id_year`, `fechainicio`, `fechafin`, `cierramatricula`, `tipoevaluacion`, `yearScolar`, `stadoyear`) VALUES
(4, '2024-01-01', '2024-03-30', '2024-02-01', 'PERIODOS', '2024', 'ACTIVO');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `activiti`
--
ALTER TABLE `activiti`
  ADD PRIMARY KEY (`idactiviti`),
  ADD KEY `act_curs_idx` (`curso_act`);

--
-- Indices de la tabla `activ_curso`
--
ALTER TABLE `activ_curso`
  ADD PRIMARY KEY (`actcur_id`),
  ADD KEY `avt_punt_idx` (`activ_Id`);

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`idalumno`),
  ADD KEY `fk_ubigeo` (`fk_ubigeo`),
  ADD KEY `fk_docu` (`fk_docu`);

--
-- Indices de la tabla `apoderados`
--
ALTER TABLE `apoderados`
  ADD PRIMARY KEY (`idApoderado`),
  ADD KEY `alumn_apo_idx` (`id_Alumn`),
  ADD KEY `fk_ubigeo_apoderado` (`fk_ubigeo`),
  ADD KEY `fk_docu_apoderados` (`fk_docu`),
  ADD KEY `fk_docu_padre` (`fk_docu_padre`),
  ADD KEY `fk_ubigeo_padre` (`fk_ubigeo_padre`);

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`IdAsisten`),
  ADD KEY `alum_asist_idx` (`idalumno_asi`);

--
-- Indices de la tabla `aula`
--
ALTER TABLE `aula`
  ADD PRIMARY KEY (`idaula`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categoria_curso`
--
ALTER TABLE `categoria_curso`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `colegio`
--
ALTER TABLE `colegio`
  ADD PRIMARY KEY (`idColegio`);

--
-- Indices de la tabla `criterio`
--
ALTER TABLE `criterio`
  ADD PRIMARY KEY (`idboletNota`);

--
-- Indices de la tabla `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`idcurso`),
  ADD KEY `fk_categoria_curso` (`fk_categoria`);

--
-- Indices de la tabla `docentes`
--
ALTER TABLE `docentes`
  ADD PRIMARY KEY (`id_docente`),
  ADD UNIQUE KEY `dni_UNIQUE` (`dni`),
  ADD UNIQUE KEY `codigo_UNIQUE` (`codigo`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD KEY `fk_ubigeo_docente` (`fk_ubigeo`),
  ADD KEY `fk_docu_docentes` (`fk_docu`);

--
-- Indices de la tabla `docente_curso`
--
ALTER TABLE `docente_curso`
  ADD PRIMARY KEY (`iddocenteCurso`);

--
-- Indices de la tabla `docente_grados`
--
ALTER TABLE `docente_grados`
  ADD PRIMARY KEY (`iddocentGrados`);

--
-- Indices de la tabla `faseescolar`
--
ALTER TABLE `faseescolar`
  ADD PRIMARY KEY (`fase_id`);

--
-- Indices de la tabla `grado`
--
ALTER TABLE `grado`
  ADD PRIMARY KEY (`idgrado`);

--
-- Indices de la tabla `grado_curso`
--
ALTER TABLE `grado_curso`
  ADD PRIMARY KEY (`idgrado_curso`);

--
-- Indices de la tabla `horario25`
--
ALTER TABLE `horario25`
  ADD PRIMARY KEY (`idhorario`);

--
-- Indices de la tabla `horario_curso`
--
ALTER TABLE `horario_curso`
  ADD PRIMARY KEY (`cursohoraId`);

--
-- Indices de la tabla `jornadas`
--
ALTER TABLE `jornadas`
  ADD PRIMARY KEY (`IdJornas`),
  ADD KEY `year_jorn_idx` (`IdJornYear`),
  ADD KEY `year_grad_idx` (`gradoid`),
  ADD KEY `year_turn_idx` (`tunoid`);

--
-- Indices de la tabla `jornas_horas`
--
ALTER TABLE `jornas_horas`
  ADD PRIMARY KEY (`HorJor_id`),
  ADD KEY `jor_hor_idx` (`jorna_ID`);

--
-- Indices de la tabla `libretanotas`
--
ALTER TABLE `libretanotas`
  ADD PRIMARY KEY (`idLibretaNotas`);

--
-- Indices de la tabla `matricula`
--
ALTER TABLE `matricula`
  ADD PRIMARY KEY (`idmatricula`),
  ADD KEY `alum_matr_idx` (`Id_alumno`);

--
-- Indices de la tabla `niveles`
--
ALTER TABLE `niveles`
  ADD PRIMARY KEY (`idniveles`);

--
-- Indices de la tabla `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`idnotas`),
  ADD KEY `grado_alum_idx` (`gradoid`);

--
-- Indices de la tabla `notasalfabetico`
--
ALTER TABLE `notasalfabetico`
  ADD PRIMARY KEY (`idLibretaNotas`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkCategoria` (`fkCategoria`),
  ADD KEY `fkUsuario` (`fkUsuario`);

--
-- Indices de la tabla `periodo`
--
ALTER TABLE `periodo`
  ADD PRIMARY KEY (`id_periodo`);

--
-- Indices de la tabla `ponderados`
--
ALTER TABLE `ponderados`
  ADD PRIMARY KEY (`idpond`);

--
-- Indices de la tabla `registopagos`
--
ALTER TABLE `registopagos`
  ADD PRIMARY KEY (`idregistropagos`),
  ADD KEY `alum_pago_idx` (`alumno_id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`rol_id`);

--
-- Indices de la tabla `stadopenciones`
--
ALTER TABLE `stadopenciones`
  ADD PRIMARY KEY (`idstadop`),
  ADD KEY `alun_stad_idx` (`entidad`);

--
-- Indices de la tabla `tipoevaluacion`
--
ALTER TABLE `tipoevaluacion`
  ADD PRIMARY KEY (`tipo_id`);

--
-- Indices de la tabla `tp_docu`
--
ALTER TABLE `tp_docu`
  ADD PRIMARY KEY (`id_tp_docu`);

--
-- Indices de la tabla `turnos`
--
ALTER TABLE `turnos`
  ADD PRIMARY KEY (`turno_id`);

--
-- Indices de la tabla `turnos_hora`
--
ALTER TABLE `turnos_hora`
  ADD PRIMARY KEY (`turHora_id`);

--
-- Indices de la tabla `ubigeo`
--
ALTER TABLE `ubigeo`
  ADD PRIMARY KEY (`cod_ubigeo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usu_id`),
  ADD KEY `usuarios_ibfk_1` (`rol_id`);

--
-- Indices de la tabla `yearscolar`
--
ALTER TABLE `yearscolar`
  ADD PRIMARY KEY (`id_year`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `activiti`
--
ALTER TABLE `activiti`
  MODIFY `idactiviti` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `activ_curso`
--
ALTER TABLE `activ_curso`
  MODIFY `actcur_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `alumno`
--
ALTER TABLE `alumno`
  MODIFY `idalumno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT de la tabla `apoderados`
--
ALTER TABLE `apoderados`
  MODIFY `idApoderado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  MODIFY `IdAsisten` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `aula`
--
ALTER TABLE `aula`
  MODIFY `idaula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `categoria_curso`
--
ALTER TABLE `categoria_curso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `colegio`
--
ALTER TABLE `colegio`
  MODIFY `idColegio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `criterio`
--
ALTER TABLE `criterio`
  MODIFY `idboletNota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `curso`
--
ALTER TABLE `curso`
  MODIFY `idcurso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT de la tabla `docentes`
--
ALTER TABLE `docentes`
  MODIFY `id_docente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `docente_curso`
--
ALTER TABLE `docente_curso`
  MODIFY `iddocenteCurso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `docente_grados`
--
ALTER TABLE `docente_grados`
  MODIFY `iddocentGrados` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `faseescolar`
--
ALTER TABLE `faseescolar`
  MODIFY `fase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `grado`
--
ALTER TABLE `grado`
  MODIFY `idgrado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `grado_curso`
--
ALTER TABLE `grado_curso`
  MODIFY `idgrado_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `horario25`
--
ALTER TABLE `horario25`
  MODIFY `idhorario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `horario_curso`
--
ALTER TABLE `horario_curso`
  MODIFY `cursohoraId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `jornadas`
--
ALTER TABLE `jornadas`
  MODIFY `IdJornas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `jornas_horas`
--
ALTER TABLE `jornas_horas`
  MODIFY `HorJor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `libretanotas`
--
ALTER TABLE `libretanotas`
  MODIFY `idLibretaNotas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `matricula`
--
ALTER TABLE `matricula`
  MODIFY `idmatricula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `niveles`
--
ALTER TABLE `niveles`
  MODIFY `idniveles` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `notas`
--
ALTER TABLE `notas`
  MODIFY `idnotas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `notasalfabetico`
--
ALTER TABLE `notasalfabetico`
  MODIFY `idLibretaNotas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `periodo`
--
ALTER TABLE `periodo`
  MODIFY `id_periodo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `ponderados`
--
ALTER TABLE `ponderados`
  MODIFY `idpond` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `registopagos`
--
ALTER TABLE `registopagos`
  MODIFY `idregistropagos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `rol_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `stadopenciones`
--
ALTER TABLE `stadopenciones`
  MODIFY `idstadop` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipoevaluacion`
--
ALTER TABLE `tipoevaluacion`
  MODIFY `tipo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tp_docu`
--
ALTER TABLE `tp_docu`
  MODIFY `id_tp_docu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `turnos`
--
ALTER TABLE `turnos`
  MODIFY `turno_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `turnos_hora`
--
ALTER TABLE `turnos_hora`
  MODIFY `turHora_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `usu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `yearscolar`
--
ALTER TABLE `yearscolar`
  MODIFY `id_year` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `activiti`
--
ALTER TABLE `activiti`
  ADD CONSTRAINT `act_curs` FOREIGN KEY (`curso_act`) REFERENCES `curso` (`idcurso`);

--
-- Filtros para la tabla `activ_curso`
--
ALTER TABLE `activ_curso`
  ADD CONSTRAINT `avt_punt` FOREIGN KEY (`activ_Id`) REFERENCES `activiti` (`idactiviti`);

--
-- Filtros para la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD CONSTRAINT `fk_docu` FOREIGN KEY (`fk_docu`) REFERENCES `tp_docu` (`id_tp_docu`),
  ADD CONSTRAINT `fk_ubigeo` FOREIGN KEY (`fk_ubigeo`) REFERENCES `ubigeo` (`cod_ubigeo`);

--
-- Filtros para la tabla `apoderados`
--
ALTER TABLE `apoderados`
  ADD CONSTRAINT `alumn_apo` FOREIGN KEY (`id_Alumn`) REFERENCES `alumno` (`idalumno`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_docu_apoderados` FOREIGN KEY (`fk_docu`) REFERENCES `tp_docu` (`id_tp_docu`),
  ADD CONSTRAINT `fk_docu_padre` FOREIGN KEY (`fk_docu_padre`) REFERENCES `tp_docu` (`id_tp_docu`),
  ADD CONSTRAINT `fk_ubigeo_apoderado` FOREIGN KEY (`fk_ubigeo`) REFERENCES `ubigeo` (`cod_ubigeo`),
  ADD CONSTRAINT `fk_ubigeo_padre` FOREIGN KEY (`fk_ubigeo_padre`) REFERENCES `ubigeo` (`cod_ubigeo`);

--
-- Filtros para la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD CONSTRAINT `alum_asist` FOREIGN KEY (`idalumno_asi`) REFERENCES `alumno` (`idalumno`);

--
-- Filtros para la tabla `curso`
--
ALTER TABLE `curso`
  ADD CONSTRAINT `fk_categoria_curso` FOREIGN KEY (`fk_categoria`) REFERENCES `categoria_curso` (`id`);

--
-- Filtros para la tabla `docentes`
--
ALTER TABLE `docentes`
  ADD CONSTRAINT `fk_docu_docentes` FOREIGN KEY (`fk_docu`) REFERENCES `tp_docu` (`id_tp_docu`),
  ADD CONSTRAINT `fk_ubigeo_docente` FOREIGN KEY (`fk_ubigeo`) REFERENCES `ubigeo` (`cod_ubigeo`);

--
-- Filtros para la tabla `jornadas`
--
ALTER TABLE `jornadas`
  ADD CONSTRAINT `year_grad` FOREIGN KEY (`gradoid`) REFERENCES `grado` (`idgrado`),
  ADD CONSTRAINT `year_jorn` FOREIGN KEY (`IdJornYear`) REFERENCES `yearscolar` (`id_year`),
  ADD CONSTRAINT `year_turn` FOREIGN KEY (`tunoid`) REFERENCES `turnos` (`turno_id`);

--
-- Filtros para la tabla `jornas_horas`
--
ALTER TABLE `jornas_horas`
  ADD CONSTRAINT `hor_jor` FOREIGN KEY (`jorna_ID`) REFERENCES `jornadas` (`IdJornas`);

--
-- Filtros para la tabla `matricula`
--
ALTER TABLE `matricula`
  ADD CONSTRAINT `alum_matr` FOREIGN KEY (`Id_alumno`) REFERENCES `alumno` (`idalumno`);

--
-- Filtros para la tabla `notas`
--
ALTER TABLE `notas`
  ADD CONSTRAINT `grado_alum` FOREIGN KEY (`gradoid`) REFERENCES `grado` (`idgrado`);

--
-- Filtros para la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD CONSTRAINT `noticias_ibfk_1` FOREIGN KEY (`fkCategoria`) REFERENCES `categorias` (`id`),
  ADD CONSTRAINT `noticias_ibfk_2` FOREIGN KEY (`fkUsuario`) REFERENCES `usuarios` (`usu_id`);

--
-- Filtros para la tabla `registopagos`
--
ALTER TABLE `registopagos`
  ADD CONSTRAINT `alum_pago` FOREIGN KEY (`alumno_id`) REFERENCES `alumno` (`idalumno`) ON DELETE CASCADE;

--
-- Filtros para la tabla `stadopenciones`
--
ALTER TABLE `stadopenciones`
  ADD CONSTRAINT `alun_stad` FOREIGN KEY (`entidad`) REFERENCES `alumno` (`idalumno`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`rol_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
tid