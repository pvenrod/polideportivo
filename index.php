<?php

    session_start();

    include_once("controlador.php");
    $controlador = new Controlador();

    if (isset($_REQUEST["action"])) {

        $action = $_REQUEST["action"]; // Recogemos la acción a realizar (si es que está definida).

    }

    else {

        $action = "mostrarFormularioIniciarSesion"; // En caso de no estar definida, esta será la acción por defecto.

    }

    $controlador->$action(); // Ejecutamos la acción a través del objeto controlador.