<?php
include 'includes/db.php';
$base = new DB();
// Creamos tabla

$query = $base->connect()->prepare(
    "CREATE TABLE empleado (
        id_empleado INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        p_nombre VARCHAR(100) NULL,
        s_nombre VARCHAR(100) NULL,
        p_apellido VARCHAR(100) NULL,
        s_apellido VARCHAR(100) NULL,
        genero VARCHAR(50) NULL,
        celular INT,
        direccion VARCHAR(150) NULL,
        fotografia VARCHAR(150) NOT NULL
    )"
);

$query->execute();

// Insertamos datos
$query = $base->connect()->prepare("INSERT INTO empleado VALUES (1, 'Fernando','Ale','Paz','Guerra','masculino',787878,'Calle v','man-1.png');");
$query->execute();
$query = $base->connect()->prepare("INSERT INTO empleado VALUES (2, 'Juan','Ale','Mamani','Miranda','masculino',4564545,'Calle z','man-2.png');");
$query->execute();
// INSERT INTO empleadoss VALUES (2, 'Juan','Ale','Mamani','Miranda','masculino',4564545,'Calle z','man-2.png')