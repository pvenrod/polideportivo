<?php

    include_once("mysqlDB.php");
    include_once("seguridad.php");

    class Horario {

        private $db, $seguridad;

        /**
         * Constructor. Establece la conexión con la base de datos y la 
         * guarda en una variable de clase. Además, crea la variable seguridad, 
         * que es una instancia de la clase Seguridad.
         */
        public function __construct() {

            $this->db = new mysqlDB();
            $this->seguridad = new Seguridad();

        }

        /**
         * Función que devuelve todos los horarios
         * @return Un objeto con todos los horarios de todas las instalaciones extraídos de la BD, o null en caso de error.
         */
        public function getAll($dia) {

            $result = $this->db->consulta("SELECT *
                                            FROM polihorarioinstalaciones
                                            WHERE dia_semana = '$dia'");

            return $result;

        }

        /**
         * Función que devuelve el horario de una instalación determinada.
         * @return Un objeto con todos los horarios de la instalación extraídos de la BD, o null en caso de error.
         */
        public function get($idInstalacion) {

            $result = $this->db->consulta("SELECT *
                                            FROM polihorarioinstalaciones
                                            WHERE idInstalacion = '$idInstalacion'");

            return $result;

        }

    }