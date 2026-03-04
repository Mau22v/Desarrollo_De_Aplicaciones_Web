CREATE DATABASE horoscopo;
USE horoscopo;

-- ============================================================
-- SIGNOS
-- ============================================================

-- -----------------------------------------------
-- TABLA SIGNOS 
-- -----------------------------------------------
CREATE TABLE signos (
    idSigno     INT AUTO_INCREMENT PRIMARY KEY,
    nombre      VARCHAR(20)  NOT NULL UNIQUE,
    elemento    ENUM('fuego','agua','aire','tierra') NOT NULL,
    diaInicio   INT NOT NULL,
    mesInicio   INT NOT NULL,
    diaFin      INT NOT NULL,
    mesFin      INT NOT NULL,
    descripcion VARCHAR(255) NULL
) ENGINE=InnoDB;

-- -----------------------------------------------
-- DATOS
-- -----------------------------------------------
INSERT INTO signos (nombre, elemento, diaInicio, mesInicio, diaFin, mesFin, descripcion) VALUES
('Aries',       'fuego',  21, 3,  19, 4,  'Valiente, enérgico, impulsivo.'),
('Tauro',       'tierra', 20, 4,  20, 5,  'Paciente, confiable, determinado.'),
('Géminis',     'aire',   21, 5,  20, 6,  'Versátil, curioso, comunicativo.'),
('Cáncer',      'agua',   21, 6,  22, 7,  'Sensible, protector, intuitivo.'),
('Leo',         'fuego',  23, 7,  22, 8,  'Creativo, líder, apasionado.'),
('Virgo',       'tierra', 23, 8,  22, 9,  'Analítico, perfeccionista, práctico.'),
('Libra',       'aire',   23, 9,  22, 10, 'Equilibrado, justo, sociable.'),
('Escorpio',    'agua',   23, 10, 21, 11, 'Intenso, misterioso, apasionado.'),
('Sagitario',   'fuego',  22, 11, 21, 12, 'Aventurero, optimista, sincero.'),
('Capricornio', 'tierra', 22, 12, 19, 1,  'Responsable, disciplinado, ambicioso.'),
('Acuario',     'aire',   20, 1,  18, 2,  'Original, independiente, visionario.'),
('Piscis',      'agua',   19, 2,  20, 3,  'Empático, soñador, sensible.');

-- ============================================================
-- REGISTRO CÓSMICO 
-- ============================================================

-- -----------------------------------------------
-- TABLA USUARIOS
-- -----------------------------------------------
CREATE TABLE usuarios (
    idUsuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    apellidoPaterno VARCHAR(50) NOT NULL,
    apellidoMaterno VARCHAR(50) NOT NULL,
    nick VARCHAR(50) NOT NULL UNIQUE,
    correo VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(100) NOT NULL,
    genero ENUM('mujer','hombre') NOT NULL,
    frecuencia ENUM('diario','semanal','ocasional') NOT NULL,
    espiritualidad ENUM('curioso','creyente','muy_conectado') NOT NULL
) ENGINE=InnoDB;

-- -----------------------------------------------
-- TABLA PAGINAS
-- -----------------------------------------------
CREATE TABLE paginas (
    idPagina INT AUTO_INCREMENT PRIMARY KEY,
    nombrePagina VARCHAR(50) NOT NULL UNIQUE
) ENGINE=InnoDB;

-- -----------------------------------------------
-- DATOS
-- -----------------------------------------------
INSERT INTO paginas (nombrePagina) VALUES
('Univision'),
('Horoscopo.eu'),
('ElHoroscopodeHoy.es');

-- -----------------------------------------------
-- TABLA USUARIO_PAGINAS
-- -----------------------------------------------
CREATE TABLE usuario_paginas (
    idUsuario INT NOT NULL,
    idPagina INT NOT NULL,
    PRIMARY KEY (idUsuario, idPagina),
    FOREIGN KEY (idUsuario) REFERENCES usuarios(idUsuario),
    FOREIGN KEY (idPagina) REFERENCES paginas(idPagina)
) ENGINE=InnoDB;

-- -----------------------------------------------
-- TABLA INTERES
-- -----------------------------------------------
CREATE TABLE interes (
    idInteres INT AUTO_INCREMENT PRIMARY KEY,
    tipoInteres VARCHAR(100) NOT NULL UNIQUE
) ENGINE=InnoDB;

-- -----------------------------------------------
-- DATOS
-- -----------------------------------------------
INSERT INTO interes (tipoInteres) VALUES
('amor'), ('dinero'), ('espiritual'), ('destino');

-- -----------------------------------------------
-- TABLA USUARIO_INTERES
-- -----------------------------------------------
CREATE TABLE usuario_interes (
    idUsuario INT NOT NULL,
    idInteres INT NOT NULL,
    PRIMARY KEY (idUsuario, idInteres),
    FOREIGN KEY (idUsuario) REFERENCES usuarios(idUsuario),
    FOREIGN KEY (idInteres) REFERENCES interes(idInteres)
) ENGINE=InnoDB;

-- ============================================================
-- COSMOS TEST
-- ============================================================

-- -----------------------------------------------
-- TABLA CONSULTA
-- -----------------------------------------------
CREATE TABLE consulta (
    idConsulta INT AUTO_INCREMENT PRIMARY KEY,
    idUsuario INT NOT NULL,
    idSigno INT NOT NULL,
    modo ENUM('personal','compatibilidad') NOT NULL,
    nombreConsulta VARCHAR(50) NOT NULL,
    horaNacimiento TIME NOT NULL,
    fechaNacimiento DATE NOT NULL, 
    emocion ENUM('paz','confundido','estresado','motivado') NOT NULL,
    FOREIGN KEY (idUsuario) REFERENCES usuarios(idUsuario),
    FOREIGN KEY (idSigno) REFERENCES signos(idSigno)
) ENGINE=InnoDB;

-- -----------------------------------------------
-- TABLA COMPATIBILIDAD
-- -----------------------------------------------
CREATE TABLE compatibilidad (
    idCompatibilidad INT AUTO_INCREMENT PRIMARY KEY,
    idConsulta INT NOT NULL UNIQUE,
    nombreSujeto VARCHAR(50) NOT NULL,
    horaNacSujeto TIME NOT NULL,
    fechaNacSujeto DATE NOT NULL,
    FOREIGN KEY (idConsulta) REFERENCES consulta(idConsulta)
) ENGINE=InnoDB;
-- -----------------------------------------------
-- TABLA CONTEXTO PERSONAL
-- -----------------------------------------------
CREATE TABLE contexto (
    idContexto INT AUTO_INCREMENT PRIMARY KEY,
    idConsulta INT NOT NULL UNIQUE, 
    finanzas ENUM('buena','regular','mala') NOT NULL,
    laboral ENUM('desempleado','empleado','empresario') NOT NULL,
    conexion ENUM('ninguna','almas','llamas') NOT NULL,
    enfermedades TEXT NULL,
    FOREIGN KEY (idConsulta) REFERENCES consulta(idConsulta)
) ENGINE=InnoDB;

-- -----------------------------------------------
-- TABLA PERFIL
-- -----------------------------------------------
CREATE TABLE perfil (
    idPerfil INT AUTO_INCREMENT PRIMARY KEY,
    idConsulta INT NOT NULL UNIQUE,
    personalidad ENUM('introvertido','equilibrado','extrovertido') NOT NULL,
    busqueda ENUM('amor','estabilidad','crecimiento','dinero') NOT NULL,
    estres ENUM('bajo','medio','alto') NOT NULL,
    intuicion ENUM('siempre','a_veces','casi_nunca') NOT NULL,
    elementoPerfil ENUM('fuego','agua','aire','tierra') NOT NULL,
    FOREIGN KEY (idConsulta) REFERENCES consulta(idConsulta)
) ENGINE=InnoDB;

-- -----------------------------------------------
-- TABLA COMPATIBILIDAD
-- -----------------------------------------------
CREATE TABLE compatibilidad (
    idCompatibilidad INT AUTO_INCREMENT PRIMARY KEY,
    idConsulta INT NOT NULL UNIQUE,
    nombreSujeto VARCHAR(50) NOT NULL,
    horaNacSujeto TIME NOT NULL,
    fechaNacSujeto DATE NOT NULL,
    FOREIGN KEY (idConsulta) REFERENCES consulta(idConsulta)
) ENGINE=InnoDB;