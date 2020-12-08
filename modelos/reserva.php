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
        public function getOne($id) {
            
            $result = $this->db->consulta("SELECT *
                                            FROM polireservas
                                            WHERE id = '$id'");

            return $result;

        }

        /**
         * Función que devuelve una reserva concreta.
         * @param id El id de la reserva a consultar.
         * @return Un objeto con todos los datos de la reserva extraídos de la BD, o null en caso de error.
         */
        public function get($id) {
            
            $result = $this->db->consulta("SELECT *
                                            FROM polireservas
                                            WHERE usuario = '$id'");

            return $result;

        }

        /**
         * Función que devuelve unas reservas concreta.
         * @param id El id de la reserva a consultar.
         * @return Un objeto con todos los datos de la reserva extraídos de la BD, o null en caso de error.
         */
        public function getPorInstalacion($idInstalacion) {
            
            $result = $this->db->consulta("SELECT *
                                            FROM polireservas
                                            WHERE instalacion = '$idInstalacion'");

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
        public function add($id, $fecha, $precio, $instalacion, $usuario) {
            
            $result = $this->db->modificacion("INSERT INTO polireservas
                                               VALUES ('$id','$fecha',DEFAULT,DEFAULT,'$precio','$instalacion','$usuario')");

            return $result;

        }

        /**
         * Función que modifica reservas.
         * @return 1 en caso de éxito, 0 en caso de error.
         */
        public function update($id, $fecha, $horaInicio, $horaFin, $precio, $instalacion, $usuario) {
            
            $this->delete($id);
            
            $result = $this->db->modificacion("INSERT INTO polireservas
                                               VALUES ('$id','$fecha','$horaInicio','$horaFin','$precio','$instalacion','$usuario')");

            return $result;

        }

        /**
         * Función que elimina reservas.
         * @return 1 en caso de éxito, 0 en caso de error..
         */
        public function delete($id) {

            $result = $this->db->modificacion("DELETE FROM polireservas
                                                WHERE id='$id'");
            
            return $result;

        }

        /**
         * Función que devuelve el ultimo id de la tabla reservas + 1.
         * @return El ultimo id de la tabla reservas + 1.
         */
        public function getLastId() {
            
            $result = $this->db->consulta("SELECT IFNULL(max(id)+1,1) as id
                                            FROM polireservas");

            return $result[0]->id;

        }

        /**
         * Función para ajax que devuelve un array con las reservas de un dia determinado.
         * @return Un array con las reservas de un dia determinado.
         */
        public function buscar($dia, $mes, $anyo,$usuario = null) {

            if ($usuario==null) {
                $criterio = "";
            } else {
                $criterio = "AND usuario='$usuario'";
            }
            $result = $this->db->consulta("SELECT pr.id as id,pr.horaInicio as horaInicio,pr.horaFin as horaFin,pr.precio as precio, pins.nombre as instalacion
                                            FROM polireservas pr
                                            INNER JOIN poliinstalaciones pins
                                                ON pr.instalacion = pins.id
                                            WHERE day(fecha) = '$dia'
                                            AND
                                            month(fecha) = '$mes'
                                            AND
                                            year(fecha) = '$anyo'
                                            $criterio");
            
            return $result;

        }


        /**
         * Función para ajax que devuelve la cantidad de reservas para un día determinado.
         * @return Un número con la cantidad de reservas.
         */
        public function cantidad($dia, $mes, $anyo) {

            $result = $this->db->consulta("SELECT count(*) as num
                                            FROM polireservas
                                            WHERE day(fecha) = '$dia'
                                            AND
                                            month(fecha) = '$mes'
                                            AND
                                            year(fecha) = '$anyo'");
            
            return $result[0]->num;

        }

        /**
         * Función que devuelve un campo concreto de una reserva concreta.
         * @param id La reserva deseada.
         * @param campo El campo a extraer de la bd.
         * @return El valor del campo extraido directamente de la bd.
         */
        public function getCampo($id,$campo) {

            $result = $this->db->consulta("SELECT $campo
                                            FROM polireservas
                                            WHERE id='$id'");
            if ($result != null) {
                $result = $result[0]->$campo;
            }
            return $result;

        }

    }