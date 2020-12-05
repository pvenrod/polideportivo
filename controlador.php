<?php

    include_once("vista.php");
    include_once("modelos/usuario.php");
    //include_once("modelos/reserva.php");
    include_once("modelos/instalacion.php");
    include_once("modelos/horario.php");
    include_once("modelos/rol.php");
    include_once("modelos/seguridad.php");

    class Controlador {

        private $vista, $usuario, $reserva, $instalacion, $horarioInstalacion, $rol;

        /**
         * Constructor. Crea las variables de los modelos y la vista
         */
        public function __construct() {

            $this->vista = new Vista();
            $this->usuario = new Usuario();
            //$this->reserva = new Reserva();
            $this->instalacion = new Instalacion();
            $this->horario = new Horario();
            $this->rol = new Rol();
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

        public function gestionUsuarios($criterio = null,$mostrarBorrados = null) {

            if ($criterio == null) {
                $criterio = "id";
            }
            if ($mostrarBorrados == "on") {
                $criterio2 = "";
            } else {
                $criterio2 = "WHERE NOT borrado = 'si'";
            }

            $data["usuarios"] = $this->usuario->getAll($criterio,$criterio2);
            $data["borrados"] = $mostrarBorrados;
            $this->vista->mostrar("usuario/gestionUsuarios", $data);
        }

        public function gestionInstalaciones($criterio = null) {

            if ($criterio == null) {
                $criterio = "id";
            }

            $data["instalaciones"] = $this->instalacion->getAll($criterio);
            $data["horarios"] = $this->horario->getAll(date('w'));
            $this->vista->mostrar("instalacion/gestionInstalaciones", $data);

        }
        
        public function gestionReservas() {
            //$data["reservas"] = $this->reserva->getAll();
            $this->vista->mostrar("reserva/gestionReservas");
        }

        // ==========================================================================================================


        // FUNCIONES DE LOS USUARIOS ========================================================

        public function crearUsuario() {

            $id = $this->usuario->getLastId();
            $usuario = $_REQUEST["usuario"];
            $contrasenya = $_REQUEST["contrasenya"];
            $email = $_REQUEST["email"];
            $nombre = $_REQUEST["nombre"];
            $apellido1 = $_REQUEST["apellido1"];
            $apellido2 = $_REQUEST["apellido2"];
            $dni = $_REQUEST["dni"];
            $imagen = $_FILES["imagen"];
            $borrado = 'no';
            if (isset($_REQUEST["roles"])) {
                $roles = $_REQUEST["roles"];
            } else {
                $roles = array("2");
            }

            if ($this->usuario->add($id,$usuario,$contrasenya,$email,$nombre,$apellido1,$apellido2,$dni,$imagen,$borrado,$roles) > 1) {
                $this->perfil($id);
            } else {
                echo "<script>
                        i=5;
                            setInterval(function() {
                                if (i==0) {
                                    location.href='index.php';
                                }
                            document.body.innerHTML = 'Ha ocurrido un error. Redireccionando en ' + i;
                                i--;
                            },1000);
                    </script>";
            }

        }

        public function perfil($id = null) {

            if (!isset($id)) {
                $id = $_REQUEST["id"];
            }
        
            $data["todosLosRoles"] = $this->rol->getAll();
            $data["rolesUsuario"] = $this->rol->get($id);
            $data["usuario"] = $this->usuario->get($id);
            $data["reservas"] = $this->usuario->getReservas($id);
            $this->vista->mostrar("usuario/perfil",$data);

        }

        public function modificarUsuario() {

            $id = $_REQUEST["id"];
            $usuario = $_REQUEST["usuario"];
            $contrasenya = $_REQUEST["contrasenya"];
            $email = $_REQUEST["email"];
            $nombre = $_REQUEST["nombre"];
            $apellido1 = $_REQUEST["apellido1"];
            $apellido2 = $_REQUEST["apellido2"];
            $dni = $_REQUEST["dni"];
            $imagen = $_FILES["imagen"];
            if (isset($_REQUEST["roles"])) {
                $roles = $_REQUEST["roles"];
            } else {
                $roles = array("2");
            }
            

            if ($this->usuario->update($id,$usuario,$contrasenya,$email,$nombre,$apellido1,$apellido2,$dni,$imagen,$roles) > 1) {
                $this->perfil($id);
            } else {
                echo "<script>
                        i=5;
                            setInterval(function() {
                                if (i==0) {
                                    location.href='index.php';
                                }
                            document.body.innerHTML = 'Ha ocurrido un error. Redireccionando en ' + i;
                                i--;
                            },1000);
                    </script>";
            }

        }

        public function eliminarUsuario() {

            $id = $_REQUEST["id"];
            $this->usuario->delete($id);

            $this->gestionUsuarios();

        }

        public function activarUsuario() {

            $id = $_REQUEST["id"];
            $this->usuario->activate($id);

            $this->gestionUsuarios();

        }

        public function buscarUsuario() {

            $texto = $_REQUEST["texto"];

            $data["usuarios"] = $this->usuario->busqueda($texto);
            $this->vista->mostrar("usuario/gestionUsuarios", $data);

        }

        public function ordenar() {

            $criterio = $_REQUEST["criterio"];

            $this->gestionUsuarios($criterio);

        }

        public function borrados() {

            $mostrarBorrados = "";

            if (isset($_REQUEST["borrados"])) {
                $mostrarBorrados = $_REQUEST["borrados"];
            }
            

            $this->gestionUsuarios(null,$mostrarBorrados);
            
        }

        // FUNCIONES DE LAS INSTALACIONES ========================================================

        public function crearInstalacion() {

            $id = $this->instalacion->getLastId();
            $nombre = $_REQUEST["nombre"];
            $descripcion = $_REQUEST["descripcion"];
            $imagen = $_FILES["imagen"];
            $precioHora = $_REQUEST["precioHora"];
            $horarios = array();

            for ($i=1; $i<=14; $i++) {
                $horarios[] = $_REQUEST["d" . $i];
            }


            if ($this->instalacion->add($nombre,$descripcion,$imagen,$precioHora,$horarios,$id) > 1) {
                $this->instalacion($id);
            } else {
                echo "<script>
                        i=5;
                            setInterval(function() {
                                if (i==0) {
                                    location.href='index.php';
                                }
                            document.body.innerHTML = 'Ha ocurrido un error. Redireccionando en ' + i;
                                i--;
                            },1000);
                    </script>";
            }

        }

        public function modificarInstalacion() {

            $id = $_REQUEST["id"];
            $nombre = $_REQUEST["nombre"];
            $descripcion = $_REQUEST["descripcion"];
            $imagen = $_FILES["imagen"];
            $precioHora = $_REQUEST["precioHora"];


            if ($this->instalacion->update($id,$nombre,$descripcion,$imagen,$precioHora) > 0) {
                $this->instalacion($id);
            } else {
                echo "<script>
                        i=5;
                            setInterval(function() {
                                if (i==0) {
                                    location.href='index.php?action=gestionInstalaciones';
                                }
                            document.body.innerHTML = 'Ha ocurrido un error. Redireccionando en ' + i;
                                i--;
                            },1000);
                    </script>";
            }

        }


        public function ordenarInstalaciones() {

            $criterio = $_REQUEST["criterio"];

            $this->gestionInstalaciones($criterio);

        }

        public function buscarInstalacion() {

            $texto = $_REQUEST["texto"];

            $data["horarios"] = $this->horario->getAll(date('w'));
            $data["instalaciones"] = $this->instalacion->busqueda($texto);
            $this->vista->mostrar("instalacion/gestionInstalaciones", $data);

        }

        public function instalacion($id = null) {

            if (!isset($id)) {
                $id = $_REQUEST["id"];
            }

            $data["instalacion"] = $this->instalacion->get($id);
            $data["horarios"] = $this->horario->get($id);
            $this->vista->mostrar("instalacion/perfilInstalacion",$data);

        }

        public function eliminarInstalacion() {

            $id = $_REQUEST["id"];
            $this->instalacion->delete($id);

            $this->gestionInstalaciones();

        }

        //FUNCIONES PARA AJAX
        public function cargarImagen() {

            $id = $_REQUEST["id"];

            echo $this->usuario->getCampo($id,'imagen');

        }

        public function cargarImagenInstalacion() {

            $id = $_REQUEST["id"];

            echo $this->instalacion->getCampo($id,'imagen');

        }

    }