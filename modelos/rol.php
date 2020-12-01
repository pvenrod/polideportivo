<?php

    include_once("mysqlDB.php");
    include_once("seguridad.php");

    class Rol {

        private $db, $seguridad;

        /**
         * Constructor. Establece la conexión con la base de datos y la 
         * guarda en una variable de clase.
         */
        public function __construct() {

            $this->db = new mysqlDB();
            $this->seguridad = new Seguridad();

        }

        /**
         * Función que devuelve los roles de un usuario concreto.
         * @param id El id del usuario a consultar sus roles.
         * @return Un objeto con todos los roles del usuario, o null en caso de error.
         */
        public function get($id) {
            
            $result = $this->db->consulta("SELECT poliroles.id
                                            FROM poliroles
                                            INNER JOIN poliusuariosroles
                                                ON poliroles.id = poliusuariosroles.idrol
                                            WHERE poliusuariosroles.idUsuario = '$id'");

            return $result;

        }

        /**
         * Función que devuelve todos los usuarios.
         * @return Un objeto con todos los datos de todos los usuarios extraídos de la BD, o null en caso de error.
         */
        public function getAll() {

            $result = $this->db->consulta("SELECT *
                                            FROM poliroles");

            return $result;

        }


    }