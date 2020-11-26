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

            if (!$this->seguridad->get("rol")) {

                if ( $this->usuario->getNumRoles($this->seguridad->get("id")) > 1) {

                    $data["roles"] = $this->usuario->getRoles($this->seguridad->get("id"));
                    $this->vista->mostrar("usuario/selectorDeRoles", $data);
    
                } else {
    
                    $this->gestionReservas();
    
                }

            } else {

                //$this->gestionReservas(); TENGO QUE DESCOMENTARLO CUANDO TENGAS ESTA FUNCION TERMINADA
                $this->gestionUsuarios();

            }

        }

        public function procesarSeleccionDeRol() { //ESTA ES LA FUNCIÓN QUE LANZA LA PRIMERA VISTA DE LA APLICACIÓN

            $rolSeleccionado = $_REQUEST["rol"];
            $this->seguridad->set("rol",$rolSeleccionado);

            switch ($this->seguridad->get("rol")) {

                case "1": //Usuarios Admin
                    $this->gestionUsuarios();
                break;

                case "2": //Usuarios estándar
                    $this->gestionInstalaciones();
                break;

                case "3": //Usuarios deshabilitados
                    $this->cerrarSesion();
                    $data['msjError'] = "Tu usuario aún no está habilitado.";
			        $this->vista->mostrar("usuario/formularioIniciarSesion", $data);
                break;

            }

        }







        // ======================================= FUNCIONES DE GESTIÓN DE USUARIOS, INSTALACIONES Y RESERVAS

        public function gestionUsuarios() {
            $data["usuarios"] = $this->usuario->getAll();
            $this->vista->mostrar("usuario/gestionUsuarios", $data);
        }

        public function gestionInstalaciones() {
            //$data["instalaciones"] = $this->instalacion->getAll();
            $this->vista->mostrar("usuario/gestionInstalaciones", $data);
        }
        
        public function gestionReservas() {
            //$data["reservas"] = $this->reserva->getAll();
            $this->vista->mostrar("usuario/gestionReservas", $data);
        }

        // ==========================================================================================================







        public function modificarUsuario() {
            $id = $_REQUEST["id"];
            $usuario = $_REQUEST["usuario"];
            $email = $_REQUEST["email"];
            $nombre = $_REQUEST["nombre"];
            $apellido1 = $_REQUEST["apellido1"];
            $apellido2 = $_REQUEST["apellido2"];
            $dni = $_REQUEST["dni"];
            $imagen = $_FILES["imagen"];

            if ($this->usuario->update($id,$usuario,$email,$nombre,$apellido1,$apellido2,$dni,$imagen)) {
                $this->gestionUsuarios();
            }
        

        }
    }