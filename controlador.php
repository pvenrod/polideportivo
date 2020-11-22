<?php

    include_once("vista.php");
    include_once("modelos/usuario.php");
    //include_once("modelos/reserva.php");
    //include_once("modelos/instalacion.php");
    //include_once("modelos/horarioInstalacion.php");
    include_once("modelos/seguridad.php");

    class Controlador {

        private $vista, $usuario, $reserva, $instalacion, $horarioInstalacion;

        /**
         * Constructor. Crea las variables de los modelos y la vista
         */
        public function __construct() {

            $this->vista = new Vista();
            $this->usuario = new Usuario();
            //$this->reserva = new Reserva();
            //$this->instalacion = new Instalacion();
            //$this->horarioInstalacion = new HorarioInstalacion();
            $this->seguridad = new Seguridad();

        }

        public function mostrarFormularioIniciarSesion() {

            if ($this->seguridad->haySesionIniciada()) {

                $this->vista->mostrar("usuario/selectorDeRol");

            } else {

                $this->vista->mostrar("usuario/formularioIniciarSesion");

            }

        }

        public function procesarLogin() {

            $usuario = $_REQUEST["usuario"];
            $contrasenya = $_REQUEST["contrasenya"];

            if ($this->usuario->buscarUsuario($usuario, $contrasenya)) {

                if (count($this->seguridad->get("roles")) > 1) {

                    $this->vista->mostrar("usuario/selectorDeRol");

                } else {

                    $this->vista->mostrar("reservas/listaReservas");

                }

            } else {

                $data["msjError"] = "Usuario o contraseña incorrectos.";
                $this->vista->mostrar("usuario/formularioIniciarSesion", $data);

            }

        }

        public function cerrarSesion() {

            $this->seguridad->cerrarSesion();
            header("Location: index.php");

        }
        
    }