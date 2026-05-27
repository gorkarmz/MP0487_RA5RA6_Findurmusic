CREATE TABLE USUARIO (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Correo_electronico VARCHAR(150) NOT NULL UNIQUE,
    Contrasena VARCHAR(255) NOT NULL,
    esAdmin TINYINT(1) NOT NULL DEFAULT 0
);
CREATE TABLE EVENTO (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(100) NOT NULL UNIQUE,
    Localizacion VARCHAR(150) NOT NULL,
    Tipo VARCHAR(50) NOT NULL
);
INSERT INTO EVENTO (Nombre, Localizacion, Tipo) VALUES
('Tech Summit 2025', 'Madrid', 'Conferencia'),
('Sound Solidario', 'Valencia', 'Deportivo'),
('Concierto Primavera', 'Barcelona', 'Musical'),
('Expo Comic', 'Sevilla', 'Exposición'),
('Feria del Libro', 'Granada', 'Cultural');