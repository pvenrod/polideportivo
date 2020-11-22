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

                $this->verificarRoles();

            } else {

                $this->vista->mostrar("usuario/formularioIniciarSesion");

            }

        }

        public function procesarLogin() {

            $usuario = $_REQUEST["usuario"];
            $contrasenya = $_REQUEST["contrasenya"];

            if ($this->usuario->buscarUsuario($usuario, $contrasenya)) {

                $this->verificarRoles();

            } else {

                $data["msjError"] = "Usuario o contraseña incorrectos.";
                $this->vista->mostrar("usuario/formularioIniciarSesion", $data);

            }

        }

        public function cerrarSesion() {

            $this->seguridad->cerrarSesion();
            header("Location: index.php");

        }

        public function verificarRoles() {

            if ( $this->usuario->getNumRoles($this->seguridad->get("id")) > 1) {

                $data["roles"] = $this->usuario->getRoles($this->seguridad->get("id"));
                $this->vista->mostrar("usuario/selectorDeRoles", $data);

            } else {

                $this->vista->mostrar("reservas/listaReservas");

            }

        }

        public function procesarSeleccionDeRol() {

            $rolSeleccionado = $_REQUEST["rol"];
            $this->seguridad->set("rol",$rolSeleccionado);

            echo $this->seguridad->get("rol");

        }
        
    }