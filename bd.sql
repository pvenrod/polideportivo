CREATE TABLE poliUsuarios (
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

CREATE TABLE poliReservas (
    id INT PRIMARY KEY,
    fecha DATE,
    hora TIME,
    precio NUMERIC(6,2)
);

CREATE TABLE poliInstalaciones (
    id INT PRIMARY KEY,
    nombre VARCHAR(100),
    descripcion VARCHAR(1000),
    imagen VARCHAR(100),
    precioHora NUMERIC(6,2)
);

CREATE TABLE poliHorarioInstalaciones (
    id INT PRIMARY KEY,
    dia_semana TINYINT,
    hora_inicio TINYINT,
    hora_fin TINYINT
);

INSERT INTO poliUsuarios
VALUES
    (0,"admin","admin","admin@admin.admin","admin","admin","admin","77159467X","img/admin.jpg");




CREATE TABLE poliRoles (
	id INT PRIMARY KEY,
	nombre VARCHAR(50)
);

INSERT INTO poliRoles 
VALUES 
	(1, "Admin"),
	(2, "Estándar"),
	(3, "Deshabilitado");

CREATE TABLE poliUsuariosRoles (
	idUsuario INT,
	idRol INT,
	PRIMARY KEY (idUsuario, idRol)
);

INSERT INTO poliUsuariosRoles 
VALUES
	(0,0),
	(0,1);
);