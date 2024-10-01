-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-09-2024 a las 22:28:02
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
-- Base de datos: `jeldata_24`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes_criterios`
--

CREATE TABLE `docentes_criterios` (
  `id` int(11) NOT NULL,
  `bloque` varchar(100) NOT NULL,
  `categoria` varchar(100) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `docentes_criterios`
--

INSERT INTO `docentes_criterios` (`id`, `bloque`, `categoria`, `descripcion`) VALUES
(1, 'Planificación y Desarrollo de la Clase', 'Planificación General', 'Se ha realizado una planificación anual detallada pensando qué se quiere lograr y qué se pretende que los alumnos aprendan.'),
(2, 'Planificación y Desarrollo de la Clase', 'Planificación General', 'Se entregaron planificaciones de la unidad con las secuencias didácticas especificadas, donde se observa claramente lo que aprenderán los alumnos.'),
(3, 'Planificación y Desarrollo de la Clase', 'Planificación General', 'La planificación de unidad contempla objetivos de aprendizaje, habilidades y contenido en base al tipo textual.'),
(4, 'Planificación y Desarrollo de la Clase', 'Planificación General', 'La planificación de clase contempla 3 momentos: Inicio-Desarrollo-Cierre y los tiempos que llevará.'),
(5, 'Planificación y Desarrollo de la Clase', 'Planificación General', 'La planificación contempla el trabajo en oralidad, lectura fluida, lectura comprensiva, escritura fluida, escritura ideatoria, reflexión sobre la gramática y recorrido literario.'),
(6, 'Planificación y Desarrollo de la Clase', 'Planificación General', 'Se contempla la realización de rutinas para afianzar habilidades que deben automatizarse.'),
(7, 'Planificación y Desarrollo de la Clase', 'Planificación General', 'Se contempla planificación en 3 niveles de dificultad.'),
(8, 'Planificación y Desarrollo de la Clase', 'Planificación General', 'Las actividades coinciden con los objetivos.'),
(9, 'Planificación y Desarrollo de la Clase', 'Planificación General', 'Se comparten los objetivos con los alumnos y los padres.'),
(10, 'Planificación y Desarrollo de la Clase', 'Evaluación', 'Se realizan evaluaciones al finalizar cada unidad.'),
(11, 'Planificación y Desarrollo de la Clase', 'Evaluación', 'Se evalúa la lectura y escritura en forma periódica en p/m o l/m.'),
(12, 'Planificación y Desarrollo de la Clase', 'Evaluación', 'Se utilizan listas de cotejo o métricas para evaluar habilidades.'),
(13, 'Planificación y Desarrollo de la Clase', 'Evaluación', 'Existe variedad de modalidades de evaluación tanto sumativa como formativa.'),
(14, 'Planificación y Desarrollo de la Clase', 'Rutinas de Inicio', 'Los primeros 15-20 minutos se utilizan para reforzar estrategias y conocimientos.'),
(15, 'Planificación y Desarrollo de la Clase', 'Rutinas de Inicio', 'Se promueve la metacognición durante las rutinas de inicio.'),
(16, 'Planificación y Desarrollo de la Clase', 'Rutinas de Inicio', 'Las actividades apuntan a habilidades que se deben consolidar como estrategias de lectura, práctica del grafismo, nociones ortográficas, deletreo, estrategias de aprendizaje.'),
(17, 'Planificación y Desarrollo de la Clase', 'Manejo de Grupo', 'Se alternan actividades en grupo completo, duplas, pequeños grupos y trabajo individual.'),
(18, 'Planificación y Desarrollo de la Clase', 'Manejo de Grupo', 'Se promueve el trabajo colaborativo y no paralelo.'),
(19, 'Planificación y Desarrollo de la Clase', 'Manejo de Grupo', 'Las dinámicas guardan relación con el objetivo de la actividad.'),
(20, 'Planificación y Desarrollo de la Clase', 'Manejo de Grupo', 'En una misma clase se utilizan distintos espacios para organizar a los alumnos (todos adelante, en mesas, en gradas, etc.).'),
(21, 'Planificación y Desarrollo de la Clase', 'Apoyos en el Aula', 'Se utilizan ayudas memoria plastificadas que los alumnos pueden luego reutilizar.'),
(22, 'Planificación y Desarrollo de la Clase', 'Apoyos en el Aula', 'Hay una cartelera ortográfica actualizada con las reglas que van abordando.'),
(23, 'Planificación y Desarrollo de la Clase', 'Apoyos en el Aula', 'Se actualizan las carteleras áulicas mensualmente con la información explícita sobre el tipo textual que se trabaja y los recursos para dominarlo.'),
(24, 'Planificación y Desarrollo de la Clase', 'Apoyos en el Aula', 'El docente escribe el objetivo o los objetivos de la unidad/clase para hacerlo visible.'),
(25, 'Planificación y Desarrollo de la Clase', 'Uso del Cuaderno', 'El cuaderno se utiliza para copia, escritura espontánea y ejercicios.'),
(26, 'Planificación y Desarrollo de la Clase', 'Uso del Cuaderno', 'Se incluyen fotocopias con contenidos relevantes.'),
(27, 'Planificación y Desarrollo de la Clase', 'Uso del Cuaderno', 'Hay evidencia de escritura espontánea frecuente.'),
(28, 'Planificación y Desarrollo de la Clase', 'Uso del Cuaderno', 'En 1 y 2 grado se observa práctica del trazado de los grafismos en renglón pautado o doble línea.'),
(29, 'Planificación y Desarrollo de la Clase', 'Uso del Cuaderno', 'Se refleja la información explícita dada en clase.'),
(30, 'Planificación y Desarrollo de la Clase', 'Uso del Cuaderno', 'Se implementan listas de cotejo para favorecer la metacognición tanto de lectura como de escritura.'),
(31, 'Planificación y Desarrollo de la Clase', 'Uso del Cuaderno', 'Utilización de la tipografía script para la lectura.'),
(32, 'Planificación y Desarrollo de la Clase', 'Cierre Metacognitivo', 'Se realiza un cierre metacognitivo al final de la clase sobre lo realizado.'),
(33, 'Planificación y Desarrollo de la Clase', 'Cierre Metacognitivo', 'El cierre dura entre 7-10 minutos y es oral.'),
(34, 'Planificación y Desarrollo de la Clase', 'Cierre Metacognitivo', 'Se consolida lo trabajado y se destacan aprendizajes.'),
(35, 'Planificación y Desarrollo de la Clase', 'Cierre Metacognitivo', 'Se promueve el intercambio con los alumnos.'),
(36, 'Observación de la Enseñanza y Práctica', 'Oralidad', 'Utiliza la oralidad para reflexionar sobre lo aprendido.'),
(37, 'Observación de la Enseñanza y Práctica', 'Oralidad', 'Utiliza la oralidad en rutinas de pensamiento que promuevan la reflexión.'),
(38, 'Observación de la Enseñanza y Práctica', 'Oralidad', 'Introduce temas y estrategias de modo oral y promoviendo el intercambio.'),
(39, 'Observación de la Enseñanza y Práctica', 'Oralidad', 'Trabaja de modo explícito algunas de las siguientes destrezas explicitando estrategias para un mayor dominio: Relato espontáneo sobre hechos vividos, Re-Narrar, Narrar, Diálogo/turnos, Elaboración de preguntas, Respuesta a preguntas, Descripción, Relatar '),
(40, 'Observación de la Enseñanza y Práctica', 'Oralidad', 'Utiliza apoyos visuales para el enriquecimiento de la oralidad (estructura del relato, palabras a utilizar, orden de los temas, información importante para incluir).'),
(41, 'Observación de la Enseñanza y Práctica', 'Enseñanza de la Lectura', 'Se enseña de modo explícito cómo se lee.'),
(42, 'Observación de la Enseñanza y Práctica', 'Enseñanza de la Lectura', 'Se ejercita la lectura diariamente.'),
(43, 'Observación de la Enseñanza y Práctica', 'Enseñanza de la Lectura', 'Se utilizan estrategias de lectura adecuadas a la etapa lectora de los alumnos.'),
(44, 'Observación de la Enseñanza y Práctica', 'Enseñanza de la Lectura', 'Se anima a los alumnos a utilizar estrategias y el docente las modela.'),
(45, 'Observación de la Enseñanza y Práctica', 'Enseñanza de la Lectura', 'Se utiliza alguna de las siguientes prácticas de lectura: Todos leen alternadamente el mismo texto, Lectura a coro o en eco, Un alumno lee a otro, Cada alumno lee un libro que seleccionó, etc.'),
(46, 'Observación de la Enseñanza y Práctica', 'Lectura Comprensiva', 'Se fomenta la lectura comprensiva a través de la lectura dialógica.'),
(47, 'Observación de la Enseñanza y Práctica', 'Lectura Comprensiva', 'Se promueve la reflexión sobre el vocabulario durante la lectura.'),
(48, 'Observación de la Enseñanza y Práctica', 'Lectura Comprensiva', 'Se trabaja la lectura comprensiva a partir de la explicitación de estrategias que promuevan el uso de habilidades cognitivas que favorecen la comprensión.'),
(49, 'Observación de la Enseñanza y Práctica', 'Uso de la Biblioteca en el Aula', 'Se fomenta el uso de la biblioteca en el aula.'),
(50, 'Observación de la Enseñanza y Práctica', 'Uso de la Biblioteca en el Aula', 'Los libros están seleccionados y organizados por niveles.'),
(51, 'Observación de la Enseñanza y Práctica', 'Uso de la Biblioteca en el Aula', 'Se realiza un seguimiento de los libros leídos por los alumnos.'),
(52, 'Observación de la Enseñanza y Práctica', 'Recorrido Literario', 'Se realizan recorridos literarios con diferentes criterios (géneros, personajes, autores, etc.).'),
(53, 'Observación de la Enseñanza y Práctica', 'Recorrido Literario', 'Se promueve la lectura de clásicos y contemporáneos.'),
(54, 'Observación de la Enseñanza y Práctica', 'Recorrido Literario', 'Se discuten las temáticas y estilos de los textos leídos.'),
(55, 'Observación de la Enseñanza y Práctica', 'Recorrido Literario', 'Se dispone de un momento semanal para ello.'),
(56, 'Observación de la Enseñanza y Práctica', 'Recorrido Literario', 'Se promueve el pensamiento crítico mediante preguntas o actividades que lo lleven a reflexionar al alumno.'),
(57, 'Observación de la Enseñanza y Práctica', 'Enseñanza de la Escritura Grafismo', 'Se enseña la escritura de manera explícita.'),
(58, 'Observación de la Enseñanza y Práctica', 'Enseñanza de la Escritura Grafismo', 'Se promueven actividades de copia y dictado.'),
(59, 'Observación de la Enseñanza y Práctica', 'Enseñanza de la Escritura Grafismo', 'Se utilizan listas de cotejo para valorar el progreso en la escritura.'),
(60, 'Observación de la Enseñanza y Práctica', 'Enseñanza de la Escritura Grafismo', 'Se explicita verbalmente cómo hacer el trazado del grafismo.'),
(61, 'Observación de la Enseñanza y Práctica', 'Enseñanza de la Escritura Grafismo', 'Se trabajan los grafismos por similitud de trazado.'),
(62, 'Observación de la Enseñanza y Práctica', 'Enseñanza de la Escritura Grafismo', 'Se utiliza renglón pautado o doble línea.'),
(63, 'Observación de la Enseñanza y Práctica', 'Escritura Ideatoria', 'Se promueve la escritura ideatoria a partir de un tipo textual donde se explicita la estructura y las estrategias.'),
(64, 'Observación de la Enseñanza y Práctica', 'Escritura Ideatoria', 'Se realizan actividades de brainstorming para generar ideas antes de escribir.'),
(65, 'Observación de la Enseñanza y Práctica', 'Escritura Ideatoria', 'Se promueve la revisión de lo escrito a través de una lista de cotejo.'),
(66, 'Observación de la Enseñanza y Práctica', 'Reflexión sobre la Gramática', 'Se seleccionan temáticas de reflexión de la lengua en concordancia con el tipo textual abordado.'),
(67, 'Observación de la Enseñanza y Práctica', 'Reflexión sobre la Gramática', 'Se realiza una reflexión explícita sobre las reglas gramaticales y se brindan apoyos.'),
(68, 'Observación de la Enseñanza y Práctica', 'Reflexión sobre la Gramática', 'Se utilizan ejemplos prácticos para explicar conceptos gramaticales.'),
(69, 'Observación de la Enseñanza y Práctica', 'Reflexión sobre la Gramática', 'Se promueve la corrección y revisión gramatical en los escritos de los alumnos.'),
(70, 'Observación de la Enseñanza y Práctica', 'Reflexión sobre la Gramática', 'Se trabaja de modo explícito conceptos como Reglas ortográficas, Reglas de puntuación, Clases de palabras (adjetivos, sustantivos, verbos, adverbios, conectores), etc.'),
(71, 'Lista de Cotejo para Evaluar la Planificación Didáctica del Docente', 'Secuencia Didáctica', 'Se detallan objetivos de aprendizaje y fundamentos de la secuencia y se discriminan de los contenidos.'),
(72, 'Lista de Cotejo para Evaluar la Planificación Didáctica del Docente', 'Secuencia Didáctica', 'Las clases contemplan gradualidad en el dominio del contenido y de las habilidades.'),
(73, 'Lista de Cotejo para Evaluar la Planificación Didáctica del Docente', 'Secuencia Didáctica', 'Las actividades planteadas guardan estrecha relación con los objetivos.'),
(74, 'Lista de Cotejo para Evaluar la Planificación Didáctica del Docente', 'Secuencia Didáctica', 'Cada clase cuenta con tres momentos diferenciados (I-D-C) y los mismos guardan conexión entre sí.'),
(75, 'Lista de Cotejo para Evaluar la Planificación Didáctica del Docente', 'Secuencia Didáctica', 'Las diversas clases van haciendo hincapié en distintas habilidades pero dentro del mismo tipo textual.'),
(76, 'Lista de Cotejo para Evaluar la Planificación Didáctica del Docente', 'Secuencia Didáctica', 'Resulta claro lo que el docente quiere que los alumnos aprendan.'),
(77, 'Lista de Cotejo para Evaluar la Planificación Didáctica del Docente', 'Secuencia Didáctica', 'Se contemplan andamiajes e información a explicitar a los alumnos.'),
(78, 'Lista de Cotejo para Evaluar la Planificación Didáctica del Docente', 'Secuencia Didáctica', 'En el inicio el docente genera el alerta, atrae la atención de los alumnos o activa conocimientos que luego necesitarán para el desarrollo.'),
(79, 'Lista de Cotejo para Evaluar la Planificación Didáctica del Docente', 'Secuencia Didáctica', 'En el desarrollo el docente modela lo que quiere que los alumnos aprendan, brinda pasos y estrategias y da andamiaje visual según sea pertinente.'),
(80, 'Lista de Cotejo para Evaluar la Planificación Didáctica del Docente', 'Secuencia Didáctica', 'En el desarrollo practica junto a los alumnos lo que quiere que luego hagan, explica la consigna y da ejemplos.'),
(81, 'Lista de Cotejo para Evaluar la Planificación Didáctica del Docente', 'Secuencia Didáctica', 'En el desarrollo se contempla un momento de práctica de los alumnos con los andamiajes brindados.'),
(82, 'Lista de Cotejo para Evaluar la Planificación Didáctica del Docente', 'Secuencia Didáctica', 'El docente promueve el pensamiento crítico y propone actividades donde el alumno se mantiene activo.'),
(83, 'Lista de Cotejo para Evaluar la Planificación Didáctica del Docente', 'Secuencia Didáctica', 'El docente brinda retroalimentación a los alumnos mientras trabajan.'),
(84, 'Lista de Cotejo para Evaluar la Planificación Didáctica del Docente', 'Secuencia Didáctica', 'El docente contempla actividades para tres niveles de dificultad a través de ajuste en el material.'),
(85, 'Lista de Cotejo para Evaluar la Planificación Didáctica del Docente', 'Secuencia Didáctica', 'En el cierre el docente resalta algo ocurrido o consolida lo aprendido de modo oral o con intercambio con los alumnos.'),
(86, 'Lista de Cotejo para Evaluar la Planificación Didáctica del Docente', 'Estrategias de Enseñanza', 'Las actividades planificadas promueven un rol activo y reflexivo de los estudiantes.'),
(87, 'Lista de Cotejo para Evaluar la Planificación Didáctica del Docente', 'Estrategias de Enseñanza', 'Se incluye la enseñanza explícita, el modelado y la gradualidad en los aprendizajes.'),
(88, 'Lista de Cotejo para Evaluar la Planificación Didáctica del Docente', 'Estrategias de Enseñanza', 'El docente brinda con claridad pasos y estrategia o nociones que se deben dominar para el tipo textual.'),
(89, 'Lista de Cotejo para Evaluar la Planificación Didáctica del Docente', 'Estrategias de Enseñanza', 'Se integran las planificaciones de los distintos grados para lograr coherencia institucional.'),
(90, 'Lista de Cotejo para Evaluar la Planificación Didáctica del Docente', 'Estrategias de Enseñanza', 'Se incluyen momentos de metacognición para consolidar lo trabajado.'),
(91, 'Lista de Cotejo para Evaluar la Planificación Didáctica del Docente', 'Estrategias de Enseñanza', 'El docente realiza preguntas abiertas y valora las intervenciones de los alumnos.'),
(92, 'Lista de Cotejo para Evaluar la Planificación Didáctica del Docente', 'Evaluación', 'Se planifican prácticas de lectura oral y de escritura (tiempo y calidad de grafismos, ortografía, redacción).'),
(93, 'Lista de Cotejo para Evaluar la Planificación Didáctica del Docente', 'Evaluación', 'Se promueve la escritura dirigida o andamiada, la escritura espontánea y la revisión.'),
(94, 'Lista de Cotejo para Evaluar la Planificación Didáctica del Docente', 'Evaluación', 'Se incluyen evaluaciones periódicas y listas de cotejo para monitorear el progreso.'),
(95, 'Lista de Cotejo para Evaluar la Planificación Didáctica del Docente', 'Evaluación', 'Se incluyen rúbricas para cotejar la trayectoria de aprendizaje de los alumnos.'),
(96, 'Lista de Cotejo para Evaluar la Planificación Didáctica del Docente', 'Evaluación', 'Se comparten las rúbricas con padres y alumnos.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes_criterios.short`
--

CREATE TABLE `docentes_criterios.short` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `categoria` varchar(100) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `docentes_criterios.short`
--

INSERT INTO `docentes_criterios.short` (`id`, `titulo`, `categoria`, `descripcion`) VALUES
(1, '', 'Planificación General', 'Se ha realizado una planificación anual detallada pensando qué se quiere lograr y qué se pretende que los alumnos aprendan.'),
(2, '', 'Planificación General', 'Se entregaron planificaciones de la unidad con las secuencias didácticas especificadas, donde se observa claramente lo que aprenderán los alumnos.'),
(3, '', 'Planificación General', 'La planificación de unidad contempla objetivos de aprendizaje, habilidades y contenido en base al tipo textual.'),
(10, '', 'Evaluación', 'Se realizan evaluaciones al finalizar cada unidad.'),
(11, '', 'Evaluación', 'Se evalúa la lectura y escritura en forma periódica en p/m o l/m.'),
(12, '', 'Evaluación', 'Se utilizan listas de cotejo o métricas para evaluar habilidades.'),
(14, '', 'Rutinas de Inicio', 'Los primeros 15-20 minutos se utilizan para reforzar estrategias y conocimientos.'),
(15, '', 'Rutinas de Inicio', 'Se promueve la metacognición durante las rutinas de inicio.'),
(16, '', 'Rutinas de Inicio', 'Las actividades apuntan a habilidades que se deben consolidar como estrategias de lectura, práctica del grafismo, nociones ortográficas, deletreo, estrategias de aprendizaje.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes_evaluaciones`
--

CREATE TABLE `docentes_evaluaciones` (
  `id` int(11) NOT NULL,
  `id_docente` int(11) DEFAULT NULL,
  `evaluador` varchar(100) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `observaciones` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `docentes_evaluaciones`
--

INSERT INTO `docentes_evaluaciones` (`id`, `id_docente`, `evaluador`, `fecha`, `observaciones`) VALUES
(16, 1, 'Nacho', '2024-09-28', NULL),
(17, 1, 'Rufina', '2024-09-28', NULL),
(18, 1, 'Rufina 2', '2024-09-28', NULL),
(19, 1, 'Srta Maestra', '2024-09-28', NULL),
(20, 1, 'Srta Maestra', '2024-09-28', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes_resultados_evaluacion`
--

CREATE TABLE `docentes_resultados_evaluacion` (
  `id` int(11) NOT NULL,
  `id_evaluacion` int(11) DEFAULT NULL,
  `id_criterio` int(11) DEFAULT NULL,
  `resultado` tinyint(1) DEFAULT NULL,
  `observaciones` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `docentes_resultados_evaluacion`
--

INSERT INTO `docentes_resultados_evaluacion` (`id`, `id_evaluacion`, `id_criterio`, `resultado`, `observaciones`) VALUES
(53, 18, 10, 1, ''),
(54, 18, 11, 0, ''),
(55, 18, 12, 1, ''),
(56, 19, 10, 1, 'rerewr'),
(57, 19, 11, 0, 'rewrew'),
(58, 19, 1, 1, 'rewrew'),
(59, 19, 3, 0, 'rewrwer'),
(60, 20, 10, 1, 'rerewr'),
(61, 20, 11, 0, 'rewrew'),
(62, 20, 1, 1, 'rewrew'),
(63, 20, 3, 0, 'rewrwer');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `docentes_criterios`
--
ALTER TABLE `docentes_criterios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `docentes_criterios.short`
--
ALTER TABLE `docentes_criterios.short`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `docentes_evaluaciones`
--
ALTER TABLE `docentes_evaluaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_docente` (`id_docente`);

--
-- Indices de la tabla `docentes_resultados_evaluacion`
--
ALTER TABLE `docentes_resultados_evaluacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_evaluacion` (`id_evaluacion`),
  ADD KEY `id_criterio` (`id_criterio`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `docentes_criterios`
--
ALTER TABLE `docentes_criterios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT de la tabla `docentes_criterios.short`
--
ALTER TABLE `docentes_criterios.short`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT de la tabla `docentes_evaluaciones`
--
ALTER TABLE `docentes_evaluaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `docentes_resultados_evaluacion`
--
ALTER TABLE `docentes_resultados_evaluacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `docentes_evaluaciones`
--
ALTER TABLE `docentes_evaluaciones`
  ADD CONSTRAINT `docentes_evaluaciones_ibfk_1` FOREIGN KEY (`id_docente`) REFERENCES `docentes` (`id`);

--
-- Filtros para la tabla `docentes_resultados_evaluacion`
--
ALTER TABLE `docentes_resultados_evaluacion`
  ADD CONSTRAINT `docentes_resultados_evaluacion_ibfk_1` FOREIGN KEY (`id_evaluacion`) REFERENCES `docentes_evaluaciones` (`id`),
  ADD CONSTRAINT `docentes_resultados_evaluacion_ibfk_2` FOREIGN KEY (`id_criterio`) REFERENCES `docentes_criterios.short` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
