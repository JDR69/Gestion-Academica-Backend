-- Script para crear la base de datos y tablas en PostgreSQL
-- Ejecuta primero la creación de la base de datos en pgAdmin
CREATE DATABASE gestionacademica;

-- Conéctate a la base de datos gestionacademica antes de ejecutar el resto
-- El siguiente bloque crea las tablas

CREATE TABLE Asistencia (
    ID INT PRIMARY KEY NOT NULL,
    Descripcion VARCHAR(20) NOT NULL
);

CREATE TABLE Docente (
    ID INT PRIMARY KEY NOT NULL,
    Nombre VARCHAR(50) NOT NULL,
    Apellido VARCHAR(50) NOT NULL,
    Registro INT NOT NULL,
    Contrasena VARCHAR(250) NOT NULL,
    Correo VARCHAR(50) NOT NULL,
    Fecha_Nacimiento DATE NOT NULL,
    Genero VARCHAR(10) NOT NULL,
    Estado BOOLEAN
);

CREATE TABLE Materia (
    ID INT PRIMARY KEY,
    Nombre VARCHAR(100) NOT NULL
);

CREATE TABLE Grupos (
    ID INT PRIMARY KEY,
    Nombre VARCHAR(100) NOT NULL
);

CREATE TABLE Aula (
    ID INT PRIMARY KEY,
    Nro_Facultad INT NOT NULL,
    Nro_Aula INT NOT NULL
);

CREATE TABLE Horarios (
    ID INT PRIMARY KEY,
    Hora_Inicio TIME NOT NULL,
    Hora_Fin TIME NOT NULL
);

CREATE TABLE Detalle_Horario (
    ID INT PRIMARY KEY,
    Materia_ID INT NOT NULL,
    Grupo_ID INT NOT NULL,
    Aula_ID INT NOT NULL,
    Horario_ID INT NOT NULL,
    FOREIGN KEY (Materia_ID) REFERENCES Materia(ID),
    FOREIGN KEY (Grupo_ID) REFERENCES Grupos(ID),
    FOREIGN KEY (Aula_ID) REFERENCES Aula(ID),
    FOREIGN KEY (Horario_ID) REFERENCES Horarios(ID)
);

CREATE TABLE Detalle_Docente (
    ID INT PRIMARY KEY,
    ID_Docente INT NOT NULL,
    ID_Asistencia INT NOT NULL,
    ID_Detalle_Horario INT NOT NULL,
    FOREIGN KEY (ID_Docente) REFERENCES Docente(ID),
    FOREIGN KEY (ID_Asistencia) REFERENCES Asistencia(ID),
    FOREIGN KEY (ID_Detalle_Horario) REFERENCES Detalle_Horario(ID)
);
