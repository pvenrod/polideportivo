<?php

    include_once("mysqlDB.php");
    include_once("seguridad.php");

    class Usuario {

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
         * Función que loguea a los usuarios.
         * @param usuario El nombre de usuario.
         * @param contrasenya La contraseña del usuario.
         * @return True si existe un usuario con esas credenciales, False en caso contrario.
         */
        public function buscarUsuario($usuario,$contrasenya) {

            session_destroy();

            $devolver = false;

            $result = $this->db->consulta("SELECT pu.id, pu.usuario, pu.email, pu.imagen
                                            FROM poliUsuarios pu
                                            WHERE pu.usuario = '$usuario' AND
                                            BINARY pu.contrasenya = '$contrasenya'");

            if ($result) {

                $result2 = $this->db->consulta("SELECT pur.idRol
                                                FROM poliUsuarios pu
                                                INNER JOIN poliUsuariosRoles pur
                                                    ON pu.id = pur.idUsuario
                                                WHERE pu.usuario = '$usuario' AND
                                                BINARY pu.contrasenya = '$contrasenya'");

                $this->seguridad->abrirSesion($result[0],$result2);
                $devolver = true;

            }

            return $devolver;

        }


        /**
         * Función que devuelve un usuario concreto.
         * @param id El id del usuario a consultar.
         * @return Un objeto con todos los datos de la persona extraídos de la BD, o null en caso de error.
         */
        public function get($id) {
            
            $result = $this->db->consulta("SELECT *
                                            FROM usuarios
                                            WHERE id = '$id'");

            return $result;

        }

        /**
         * Función que devuelve todos los usuarios.
         * @return Un objeto con todos los datos de todos los usuarios extraídos de la BD, o null en caso de error.
         */
        public function getAll() {

            $result = $this->db->consulta("SELECT *
                                            FROM usuarios");

            return $result;

        }

        
        /**
         * Función para registrar nuevos usuarios.
         * @param usuario El nombre de usuario.
         * @param email El email del usuario.
         * @param contrasenya La contraseña del usuario.
         * @param contrasenya2 La confirmación de la contraseña.
         * @return 1 en caso de éxito, y 0 en caso de error.
         */
        public function insert($usuario, $email, $contrasenya1, $contrasenya2) {

            $result = 0;

            $id = $this->db->consulta("SELECT IFNULL(MAX(id), 0) + 1 as id
                                        FROM usuarios")[0]->id; // Saco el nuevo id para el usuario
            $usuario;
            $email;
            $contrasenya1;
            $contrasenya2;
            $foto = "img/imagen.png";
            $rol = "desactivado";

            if ($contrasenya1 == $contrasenya2) {

                $result = $this->db->modificacion("INSERT INTO usuarios
                                                    VALUES
                                                        ('$id', '$usuario', '$email', '$contrasenya1', '$foto', '$rol')");

            }

            return $result;

        }


        /**
         * Función para actualizar la información de los usuarios.
         * @param id Es el id del usuario a actualizar.
         * @param usuario Es el nombre de usuario del usuario a actualizar.
         * @param email Es el nuevo email del usuario a actualizar.
         * @param contrasenya Es la nueva contraseña del usuario a actualizar.
         * @param contrasenya2 Es la confirmación de la contraseña.
         * @param rol Es el rol del usuario a actualizar.
         * @return 1 en caso de éxito, y 0 en caso de error.
         */
        public function update($id, $usuario, $email, $contrasenya, $contrasenya2, $rol) {

            $result = 0;

            $id;
            $usuario;
            $email;
            $contrasenya;
            $contrasenya2;
            $rol;

            if ($contrasenya == $contrasenya2) {

                $this->delete($id);

                $result = $this->db->modificacion("INSERT INTO usuarios
                                                VALUES
                                                    ('$id', '$usuario', '$email', '$contrasenya', '$rol'");

            }

            return $result;

        }


        /**
         * Función para actualizar la información de los usuarios.
         * @param id Es el id del usuario a eliminar.
         * @return 1 en caso de éxito, y 0 en caso de error.
         */
        public function delete($id) {

            $result = $this->db->modificacion("DELETE FROM usuarios
                                            WHERE id = '$id'");

            // También vamos a borrar todas las incidencias creadas por este usuario.
            $result2 = $this->db->modificacion("DELETE FROM incidencias
                                             WHERE usuario = '$id'");


            return $result;

        }
    }

