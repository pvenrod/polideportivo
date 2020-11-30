<?php

    include_once("mysqlDB.php");
    include_once("seguridad.php");

    class Instalacion {

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
         * Función que devuelve una instalación concreta.
         * @param id El id de la instalación a consultar.
         * @return Un objeto con todos los datos de la instalación extraídos de la BD, o null en caso de error.
         */
        public function get($id) {
            
            $result = $this->db->consulta("SELECT *
                                            FROM poliinstalaciones
                                            WHERE id = '$id'");

            return $result;

        }

        /**
         * Función que devuelve todas las instalaciones.
         * @return Un objeto con todos los datos de todas las instalaciones extraídos de la BD, o null en caso de error.
         */
        public function getAll($criterio) {

            $result = $this->db->consulta("SELECT *
                                            FROM poliinstalaciones
                                            ORDER BY $criterio ASC");

            return $result;

        }

    }