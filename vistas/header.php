<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="scripts/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="estilos/estilos.css">
    <title>Polideportivo Celia Viñas - Tu complejo deportivo de confianza</title>
</head>
<body>

<?php

    include_once("modelos/seguridad.php");
    $seguridad = new Seguridad();

    if ($seguridad->haySesionIniciada()) {

        echo "<div id='header'>
            <a href='index.php'><img id='logo' src='img/logo.png' /></a>
            <table id='tablaHeader'>
                <tr>
                    <td onclick='location.href=\"index.php?action=gestionReservas\"'>Reservas</td>";

                if ($seguridad->get("rol") == 1) {

                   echo "<td onclick='location.href=\"index.php?action=gestionUsuarios\"'>Usuarios</td>
                        <td onclick='location.href=\"index.php?action=gestionInstalaciones\"'>Instalaciones</td>";

                }

        echo    "</tr>
            </table>
            <button id='botonCerrarSesion' onclick='location.href=\"index.php?action=cerrarSesion\"'>Cerrar sesión</button>
        </div>";

    }