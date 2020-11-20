<?php

    include_once("vista.php");
    //include_once("modelos/usuario.php");
    //include_once("modelos/reserva.php");
    //include_once("modelos/instalacion.php");
    //include_once("modelos/horarioInstalacion.php");
    //include_once("modelos/seguridad.php");

    class Controlador {

        private $vista, $usuario, $reserva, $instalacion, $horarioInstalacion;

        /**
         * Constructor. Crea las variables de los modelos y la vista
         */
        public function __construct() {

            $this->vista = new Vista();
            //$this->usuario = new Usuario();
            //$this->reserva = new Reserva();
            //$this->instalacion = new Instalacion();
            //$this->horarioInstalacion = new HorarioInstalacion();
            //$this->seguridad = new Seguridad();

        }

        public function mostrarFormularioIniciarSesion() {

            /*if ($this->seguridad->existe("idUsuario")) {

                $data["rolUsuario"] = $this->seguridad->get("rolUsuario");
                $data["listaReservas"] = $this->reserva->getAll();
                $this->vista->mostrar("reserva/listaReservas", $data);

            } else {

                $this->vista->mostrar("usuario/formularioIniciarSesion");

            }*/

            $this->vista->mostrar("usuario/formularioIniciarSesion");

        }
        
    }