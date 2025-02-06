DROP DATABASE IF EXISTS HITO2_T2;
CREATE DATABASE HITO2_T2;
USE HITO2_T2;

-- Tabla de Usuarios
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(100) NOT NULL
);

-- Tabla de Tareas
CREATE TABLE tareas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    titulo VARCHAR(255) NOT NULL,
    descripcion TEXT,
    estado ENUM('pendiente', 'en progreso', 'completada') DEFAULT 'pendiente',
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_vencimiento DATE,
    FOREIGN KEY (usuario_id) REFERENCES Usuarios(id) ON DELETE CASCADE
);

-- Insertar un usuario de prueba
INSERT INTO Usuarios (nombre, correo, password)  
VALUES ('Juan Pérez', 'juan.perez@email.com', '123456');

-- Insertar una tarea para el usuario recién creado
INSERT INTO Tareas (usuario_id, titulo, descripcion, estado, fecha_vencimiento)  
VALUES (2, 'Comprar víveres', 'Comprar leche, pan y huevos en el supermercado.', 'pendiente', '2025-02-10');

