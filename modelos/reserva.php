<?php

    include_once("mysqlDB.php");
    include_once("seguridad.php");
    include_once("horario.php");
    include_once("imagen.php");

    class Reserva {

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
         * Función que devuelve una reserva concreta.
         * @param id El id de la reserva a consultar.
         * @return Un objeto con todos los datos de la reserva extraídos de la BD, o null en caso de error.
         */
        public function get($id) {
            
            $result = $this->db->consulta("SELECT *
                                            FROM polireservas
                                            WHERE id = '$id'");

            return $result;

        }

        /**
         * Función que devuelve todas las reservas.
         * @return Un objeto con todos los datos de todas las reservas extraídos de la BD, o null en caso de error.
         */
        public function getAll() {
            
            $result = $this->db->consulta("SELECT *
                                            FROM polireservas");

            return $result;

        }

        /**
         * Función que inserta nuevas reservas.
         * @return 1 en caso de éxito, 0 en caso de error.
         */
        public function add($id, $fecha, $hora, $precio, $instalacion) {
            
            $result = $this->db->modificacion("INSERT INTO polireservas
                                               VALUES ('$id','$fecha','$hora','$precio','$instalacion')");

            return $result;

        }

        /**
         * Función que devuelve el ultimo id de la tabla reservas + 1.
         * @return El ultimo id de la tabla reservas + 1.
         */
        public function getLastId() {
            
            $result = $this->db->consulta("SELECT max(id)+1 as id
                                            FROM polireservas");

            return $result[0]->id;

        }

    }