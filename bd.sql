CREATE TABLE poliUsuario (
    id INT PRIMARY KEY,
    usuario VARCHAR(100),
    contrasenya VARCHAR(100),
    email VARCHAR(100),
    nombre VARCHAR(50),
    apellido1 VARCHAR(100),
    apellido2 VARCHAR(100),
    dni CHAR(9),
    imagen VARCHAR(100)
);

CREATE TABLE poliReserva (
    id INT PRIMARY KEY,
    fecha DATE,
    hora TIME,
    precio NUMERIC(6,2)
);

CREATE TABLE poliInstalacion (
    id INT PRIMARY KEY,
    nombre VARCHAR(100),
    descripcion VARCHAR(1000),
    imagen VARCHAR(100),
    precioHora NUMERIC(6,2)
);

CREATE TABLE poliHorarioInstalacion (
    id INT PRIMARY KEY,
    dia_semana TINYINT,
    hora_inicio TINYINT,
    hora_fin TINYINT
);

INSERT INTO poliUsuario
VALUES
    (0,"admin","admin","admin@admin.admin","admin","admin","admin","77159467X","img/admin.jpg");