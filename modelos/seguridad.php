<?php

    class Seguridad {

        public function abrirSesion($usuario,$roles) {
            session_start();
            $_SESSION["id"] = $usuario->id;
            $_SESSION["usuario"] = $usuario->usuario;
            $_SESSION["imagen"] = $usuario->imagen;
            $_SESSION["email"] = $usuario->email;

            foreach($roles as $rol) {
                $_SESSION["roles"][$rol->idRol] = $rol->idRol;
            }

        }

        public function cerrarSesion() {
            session_destroy();
        }

        public function get($variable) {
            return $_SESSION[$variable];
        }

        public function haySesionIniciada() {
            if (isset($_SESSION["id"])) {
                return true;
            } else {
                return false;
            }
        }

        public function errorAccesoNoPermitido() {
			$data['msjError'] = "No tienes permisos para hacer eso";
			$this->vista->mostrar("usuario/formularioLogin", $data);
        }
    }