<?php

    include_once("vista.php");
    include_once("modelos/usuario.php");
    include_once("modelos/reserva.php");
    include_once("modelos/instalacion.php");
    include_once("modelos/horarioInstalacion.php");

    class Controlador {

        private $vista, $usuario, $reserva, $instalacion, $horarioInstalacion;

        /**
         * Constructor. Crea las variables de los modelos y la vista
         */
        public function __construct() {

            $this->vista = new Vista();
            $this->usuario = new Usuario();
            $this->reserva = new Reserva();
            $this->instalacion = new Instalacion();
            $this->horarioInstalacion = new horarioInstalacion();

        }
        
    }