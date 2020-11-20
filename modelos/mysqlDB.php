<?php

    class mysqlDB {

        private $db;

        /**
         * Constructor. Establece la conexión con la base de datos y la 
         * guarda en una variable de clase.
         */
        public function __construct() {

            $this->db = new mysqli("localhost","paolo","Gji54@7s","paolo-veneruso");

        }


        /**
         * Función que loguea a los usuarios.
         * @param sql La consulta sql que se va a ejecutar.
         * @return un array con las filas extraídas de la base de datos.
         */
        public function consulta($sql) {

            $arrayResult = array();

            if ($result = $this->db->query($sql)) {

                if ($result->num_rows > 0) {

                    while ($fila = $result->fetch_object()) {

                        $arrayResult[] = $fila;
    
                    }

                } else {

                    $arrayResult = false;

                }
                
            }

            return $arrayResult;
        }


        /**
         * Función que loguea a los usuarios.
         * @param sql El código sql que se va a ejecutar.
         * @return un array con las filas extraídas de la base de datos.
         */
        public function modificacion($sql) {

            $this->db->query($sql);
            
            return $this->db->affected_rows;

        }

    }

