<?php

    include_once("mysqlDB.php");
    include_once("seguridad.php");
    include_once("horario.php");
    include_once("imagen.php");

    class Instalacion {

        private $db, $seguridad, $imagen, $horario;

        /**
         * Constructor. Establece la conexión con la base de datos y la 
         * guarda en una variable de clase. Además, crea la variable seguridad, 
         * que es una instancia de la clase Seguridad.
         */
        public function __construct() {

            $this->db = new mysqlDB();
            $this->seguridad = new Seguridad();
            $this->imagen = new Imagen();
            $this->horario = new Horario();

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

        /**
         * Función para crear nuevos usuarios.
         * @param id Es el id de la nueva instalación.
         * @param nombre Es el nombre de la nueva instalación.
         * @param descripcion Es la descripción de la nueva instalación.
         * @param imagen Es la imagen de la nueva instalación.
         * @param precioHora Es el precio por hora de la nueva instalación.
         * @param horarios Son los horarios de la nueva instalación.
         * @return 2 en caso de éxito, y <2 en caso de error.
         */
        public function add($nombre,$descripcion,$imagen,$precioHora,$horarios,$id) {

            $rutaImagen = $this->imagen->subir($imagen,$id,'instalaciones');

            $result = $this->db->modificacion("INSERT INTO poliinstalaciones
                                               VALUES ('$id','$nombre','$descripcion','$rutaImagen','$precioHora')");

            $horaInicio = array();
            $horaCierre = array();

            for ($i=0; $i<=11; $i++) {

                $horaInicio[] = $horarios[$i+1];
                $horaCierre[] = $horarios[$i+2];                

            }
            
            $diaSemana = 1;

            for ($i=0; $i<7; $i++) {

                $horaInicio2 = $horaInicio[$i];
                $horaCierre2 = $horaCierre[$i];
                $idHorario = $this->horario->getLastId();

                $result2 = $this->db->modificacion("INSERT INTO polihorarioinstalaciones
                                                    VALUES ('$idHorario','$diaSemana','$horaInicio2:00','$horaCierre2:00','$id')");

                $diaSemana++;

            }

            return $result + $result2;

        }

        /**
         * Función para crear nuevos usuarios.
         * @param id Es el id de la nueva instalación.
         * @param nombre Es el nombre de la nueva instalación.
         * @param descripcion Es la descripción de la nueva instalación.
         * @param imagen Es la imagen de la nueva instalación.
         * @param precioHora Es el precio por hora de la nueva instalación.
         * @return 2 en caso de éxito, y <2 en caso de error.
         */
        public function update($id,$nombre,$descripcion,$imagen,$precioHora) {

            $rutaImagen = $this->imagen->subir($imagen,$id,'instalaciones');

            $this->db->modificacion("UPDATE poliinstalaciones
                                    SET nombre='temporal'
                                    WHERE id='$id'");

            $result = $this->db->modificacion("UPDATE poliinstalaciones
                                               SET nombre='$nombre', descripcion='$descripcion', imagen='$rutaImagen', precioHora='$precioHora'
                                               WHERE id='$id'");

            return $result;

        }

        /**
         * Función que devuelve el horario de una instalación determinada.
         * @return Un objeto con todos los horarios de la instalación extraídos de la BD, o null en caso de error.
         */
        public function getHorarios($idInstalacion) {

            $result = $this->db->consulta("SELECT *
                                            FROM polihorarioinstalaciones
                                            WHERE idInstalacion = '$id'");

            return $result;

        }

        /**
         * Función que devuelve el ultimo id de la tabla instalaciones + 1.
         * @return El ultimo id de la tabla instalaciones + 1.
         */
        public function getLastId() {
            
            $result = $this->db->consulta("SELECT max(id)+1 as id
                                            FROM poliinstalaciones");

            return $result[0]->id;

        }

        /**
         * Función que devuelve un campo concreto de una instalacion concreta.
         * @param id La instalacion deseada.
         * @param campo El campo a extraer de la bd.
         * @return El valor del campo extraido directamente de la bd.
         */
        public function getCampo($id,$campo) {

            $result = $this->db->consulta("SELECT $campo
                                            FROM poliinstalaciones
                                            WHERE id='$id'");

            return $result[0]->$campo;

        }

         /**
         * Función que busca instalaciones en la bd.
         * * @param texto El texto a buscar
         * @return Un array con las instalaciones encontrados.
         */
        public function busqueda($texto) {

            $result = $this->db->consulta("SELECT *
                                            FROM poliinstalaciones
                                            WHERE 
                                                nombre LIKE '%$texto%'
                                                OR
                                                descripcion LIKE '%$texto%'
                                                OR
                                                precio LIKE '%$texto%'");
            
            return $result;

        }

        /**
         * Función para eliminar instalaciones
         * @param id Es el id de la instalación a eliminar.
         * @return 1 en caso de éxito, y 0 en caso de error.
         */
        public function delete($id) {

            $result = $this->db->modificacion("DELETE FROM poliinstalaciones
                                               WHERE id='$id'");
            
            $result = $this->db->modificacion("DELETE FROM polihorarioinstalaciones
                                               WHERE idInstalacion='$id'");


            return $result;

        }

    }