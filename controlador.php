<?php

    include_once("vista.php");
    include_once("modelos/usuario.php");
    include_once("modelos/reserva.php");
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
            $this->reserva = new Reserva();
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

                $this->gestionReservas();

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
                    $this->gestionReservas();
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

            if ($this->seguridad->esAdmin()) {
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
            } else {
                $this->gestionReservas();
            }

        }

        public function gestionInstalaciones($criterio = null) {

            if ($this->seguridad->esAdmin()) {
                if ($criterio == null) {
                    $criterio = "id";
                }
    
                $data["instalaciones"] = $this->instalacion->getAll($criterio);
                $data["horarios"] = $this->horario->getAll(date('w'));
                $this->vista->mostrar("instalacion/gestionInstalaciones", $data);
            } else {
                $this->gestionReservas();
            }

        }
        
        public function gestionReservas() {

            if ($this->seguridad->haySesionIniciada()) {
                if ($this->seguridad->esAdmin()) {
                    $data["reservas"] = $this->reserva->getAll();
                } else {
                    $data["reservas"] = $this->reserva->get($this->seguridad->get('id'));
                }
                $data["instalaciones"] = $this->instalacion->getAll();
                $data["idUsuario"] = $this->seguridad->get('id');
                $this->vista->mostrar("reserva/gestionReservas", $data);
            } else {
                $data["msjError"] = "Necesitas iniciar sesión.";
                $this->vista->mostrar("usuario/formularioIniciarSesion", $data);
            }
            
            
        }

        // ==========================================================================================================


        // FUNCIONES DE LOS USUARIOS ========================================================

        public function crearUsuario() {


            if ($this->seguridad->esAdmin()) {
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
            } else {
                $this->gestionReservas();
            }
            
        }

        public function perfil($id = null) {

            if ($this->seguridad->esAdmin() || $_REQUEST["id"] == $this->seguridad->get('id')) {

                if (!isset($id)) {
                    $id = $_REQUEST["id"];
                }
            
                $data["todosLosRoles"] = $this->rol->getAll();
                $data["rolesUsuario"] = $this->rol->get($id);
                $data["usuario"] = $this->usuario->get($id);
                $data["reservas"] = $this->reserva->get($id);
                $this->vista->mostrar("usuario/perfil",$data);

            } else {
                if (isset($id)) {
                    if ($id == $this->seguridad->get('id')) {
                        $data["todosLosRoles"] = $this->rol->getAll();
                        $data["rolesUsuario"] = $this->rol->get($id);
                        $data["usuario"] = $this->usuario->get($id);
                        $data["reservas"] = $this->reserva->get($id);
                        $this->vista->mostrar("usuario/perfil",$data);
                    }
                    $id = $this->seguridad->get('id');
                } else {
                    $this->gestionReservas();
                }
            }

        }

        public function modificarUsuario() {

            if ($this->seguridad->esAdmin() || $_REQUEST["id"] == $this->seguridad->get('id')) {
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
            } else {
                $this->gestionReservas();
            }

        }

        public function eliminarUsuario() {

            if ($this->seguridad->esAdmin() || $_REQUEST["id"] == $this->seguridad->get('id')) {
                $id = $_REQUEST["id"];
                $this->usuario->delete($id);
                if ($id == $this->seguridad->get('id')) {
                    $this->cerrarSesion();
                }
                $this->gestionUsuarios();
            } else {
                $this->gestionReservas();
            }
            

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

            if ($this->seguridad->esAdmin()) {
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
            } else {
                $this->gestionReservas();
            }

        }

        public function modificarInstalacion() {

            if ($this->seguridad->esAdmin()) {
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
            } else {
                $this->gestionReservas();
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

            if ($this->seguridad->esAdmin()) {
                if (!isset($id)) {
                    $id = $_REQUEST["id"];
                }
    
                $data["instalacion"] = $this->instalacion->get($id);
                $data["horarios"] = $this->horario->get($id);
                $this->vista->mostrar("instalacion/perfilInstalacion",$data);
            } else {
                $this->gestionReservas();
            }

        }

        public function eliminarInstalacion() {

            if ($this->seguridad->esAdmin()) {
                $id = $_REQUEST["id"];
                $this->instalacion->delete($id);
    
                $this->gestionInstalaciones();
            } else {
                $this->gestionReservas();
            }
            

        }

        // FUNCIONES DE LAS INSTALACIONES ========================================================

        public function crearReserva() {

            $id = $this->reserva->getLastId();
            $fecha = $_REQUEST["fecha"];
            $instalacion = $_REQUEST["instalacion"];
            $precio = $this->instalacion->getCampo($instalacion,'precioHora') * 1;
            $usuario = $_REQUEST["idUsuario"];

            if ($this->reserva->add($id, $fecha, $precio, $instalacion, $usuario) > 0) {
                $this->vistaModificarReserva($id,$instalacion);
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

        public function vistaModificarReserva($id = null,$instalacion=null) {

            if (!isset($id)) {
                $id = $_REQUEST["id"];
            }

            if (!isset($instalacion)) {
                $instalacion = $this->reserva->getCampo($id,'instalacion');
            }

            $data["reserva"] = $this->reserva->getOne($id);
            $data["instalaciones"] = $this->instalacion->getAll();
            $data["horario"] = $this->horario->get($instalacion);
            $data["reservasInstalacion"] = $this->reserva->getPorInstalacion($instalacion);
            $this->vista->mostrar("reserva/reserva", $data);

        }

        public function modificarReserva() {

            $id = $_REQUEST["id"];
            $fecha = $this->reserva->getCampo($id, 'fecha');
            $horaInicio = $_REQUEST["horaInicio"];
            $horaFin = $_REQUEST["horaFin"];
            $instalacion = $this->reserva->getCampo($id, 'instalacion');
            $precio = (float)$this->instalacion->getCampo($instalacion,'precioHora') * ((int)$horaFin-(int)$horaInicio);
            $usuario = $_REQUEST["idUsuario"];

            if ($this->reserva->update($id,$fecha,$horaInicio,$horaFin,$precio,$instalacion,$usuario)>0) {
                $this->gestionReservas();
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

        // FUNCIONES PARA AJAX ========================================================

        public function cargarImagen() {

            $id = $_REQUEST["id"];

            echo $this->usuario->getCampo($id,'imagen');

        }

        public function cargarImagenInstalacion() {

            $id = $_REQUEST["id"];

            echo $this->instalacion->getCampo($id,'imagen');

        }

        public function numeroReservas() {

            $fecha = strtotime($_REQUEST["fecha"]);
            $dia = date('d',$fecha);
            $mes = date('m',$fecha);
            $anyo = date('Y',$fecha);

            echo $this->reserva->cantidad($dia, $mes, $anyo);

        }

        public function buscarReservas() {

            $fecha = strtotime($_REQUEST["fecha"]);
            $dia = date('d',$fecha);
            $mes = date('m',$fecha);
            $anyo = date('Y',$fecha);

            if ($this->seguridad->esAdmin()) {
                $result = $this->reserva->buscar($dia, $mes, $anyo);
            } else {
                $result = $this->reserva->buscar($dia, $mes, $anyo,$this->seguridad->get('id'));
            }
            echo json_encode($result);

        }

        public function eliminarReserva($ajax = null) {

            $id = $_REQUEST["id"];

            if ($ajax != null && ($this->seguridad->esAdmin() || $this->seguridad->get('id') == $id)) {
                echo $this->reserva->delete($id);
            } else {
                $this->reserva->delete($id);
                $this->gestionReservas();
            }
            

        }

    }