<?php

    class Seguridad {

        public function abrirSesion($usuario) {
            session_start();
            $_SESSION["id"] = $usuario->id;
            $_SESSION["usuario"] = $usuario->usuario;
            $_SESSION["imagen"] = $usuario->imagen;
            $_SESSION["email"] = $usuario->email;
        }

        public function cerrarSesion() {
            session_destroy();
        }

        public function get($variable) {
            if (isset($_SESSION[$variable])) {
                return $_SESSION[$variable];
            } else {
                return false;
            }
        }

        public function set($variable, $valor) {
            $_SESSION[$variable] = $valor;
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