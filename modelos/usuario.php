<?php

    include_once("mysqlDB.php");
    include_once("seguridad.php");
    include_once("imagen.php");

    class Usuario {

        private $db, $seguridad, $imagen;
        
        /**
         * Constructor. Establece la conexión con la base de datos y la 
         * guarda en una variable de clase. Además, crea la variable seguridad, 
         * que es una instancia de la clase Seguridad.
         */
        public function __construct() {

            $this->db = new mysqlDB();
            $this->seguridad = new Seguridad();
            $this->imagen = new Imagen();

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
                                            FROM poliusuarios pu
                                            WHERE pu.usuario = '$usuario' AND
                                            BINARY pu.contrasenya = '$contrasenya'");

            if ($result) {

                $this->seguridad->abrirSesion($result[0]);
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
                                            FROM poliusuarios
                                            WHERE id = '$id'");

            return $result;

        }


        /**
         * Función que devuelve todos los usuarios.
         * @return Un objeto con todos los datos de todos los usuarios extraídos de la BD, o null en caso de error.
         */
        public function getAll($criterio,$criterio2) {

            $result = $this->db->consulta("SELECT *
                                            FROM poliusuarios
                                            $criterio2
                                            ORDER BY $criterio ASC");

            return $result;

        }


        /**
         * Función para crear nuevos usuarios.
         * @param id Es el id del nuevo usuario.
         * @param usuario Es el nombre de usuario del nuevo usuario.
         * @param email Es el nuevo email del nuevo usuario.
         * @param contrasenya Es la nueva contraseña del nuevo usuario.
         * @param nombre Es el nombre del nuevo usuario.
         * @param apellido1 Es el primer apellido del nuevo usuario.
         * @param apellido2 Es el segundo apellido del nuevo usuario.
         * @param dni Es el dni del nuevo usuario.
         * @param imagen Es la imagen del nuevo usuario.
         * @return 2 en caso de éxito, y <2 en caso de error.
         */
        public function add($id,$usuario,$contrasenya,$email,$nombre,$apellido1,$apellido2,$dni,$imagen,$borrado,$roles) {

            $rutaImagen = $this->imagen->subir($imagen,$usuario,'usuarios');

            $result = $this->db->modificacion("INSERT INTO poliusuarios
                                               VALUES ('$id','$usuario','$contrasenya','$email','$nombre','$apellido1','$apellido2','$dni','$rutaImagen','$borrado')");

            foreach($roles as $rol) {

                $result2 = $this->db->modificacion("INSERT INTO poliusuariosroles
                                                    VALUES
                                                        ('$id','$rol')");

            }

            return $result + $result2;

        }


        /**
         * Función para actualizar la información de los usuarios.
         * @param id Es el id del usuario a actualizar.
         * @param usuario Es el nombre de usuario del usuario a actualizar.
         * @param email Es el nuevo email del usuario a actualizar.
         * @param contrasenya Es la nueva contraseña del usuario a actualizar.
         * @param nombre Es el nombre del usuario a actualizar
         * @param apellido1 Es el primer apellido del usuario a actualizar.
         * @param apellido2 Es el segundo apellido del usuario a actualizar.
         * @param dni Es el dni del usuario a actualizar.
         * @param imagen Es la imagen del usuario a actualizar.
         * @return 2 en caso de éxito, y <2 en caso de error.
         */
        public function update($id,$usuario,$contrasenya,$email,$nombre,$apellido1,$apellido2,$dni,$imagen,$roles) {

            if ($contrasenya == "") {
                $contrasenya = $this->getCampo($id,"contrasenya"); // Si no se ha introducido una contraseña, dejo la misma que existe en la db.
            }

            if ($imagen["error"] == 4) { // Si no se ha introducido ninguna imagen, no la actualizamos en la bd.

                $this->db->modificacion("UPDATE poliusuarios
                                            SET usuario='temporal'
                                            WHERE id='$id'"); // Cambio un campo para que la consulta siguiente siempre devuelva 1 como filas afectadas, haya o no cambios.

                $result = $this->db->modificacion("UPDATE poliusuarios
                                                        SET usuario='$usuario',contrasenya='$contrasenya',email='$email',nombre='$nombre',apellido1='$apellido1',apellido2='$apellido2',dni='$dni'
                                                        WHERE id='$id'");

            } else {

                $rutaImagen = $this->imagen->subir($imagen,$usuario,'usuarios');

                $result = $this->db->modificacion("UPDATE poliusuarios
                                                        SET usuario='$usuario',contrasenya='$contrasenya',email='$email',nombre='$nombre',apellido1='$apellido1',apellido2='$apellido2',dni='$dni',imagen='$rutaImagen'
                                                        WHERE id='$id'");
            }

            $this->db->modificacion("DELETE FROM poliusuariosroles
                                    WHERE idUsuario='$id'");

            foreach($roles as $rol) {
                $result2 = $this->db->modificacion("INSERT INTO poliusuariosroles
                                                    VALUES
                                                        ('$id','$rol')");
            }

            return $result + $result2;

        }


        /**
         * Función para eliminar usuarios
         * @param id Es el id del usuario a eliminar.
         * @return 1 en caso de éxito, y 0 en caso de error.
         */
        public function delete($id) {

            $result = $this->db->modificacion("UPDATE poliusuarios
                                            SET borrado = 'si'
                                            WHERE id='$id'");


            return $result;

        }


        /**
         * Función para reactivar usuarios
         * @param id Es el id del usuario a eliminar.
         * @return 1 en caso de éxito, y 0 en caso de error.
         */
        public function activate($id) {

            $result = $this->db->modificacion("UPDATE poliusuarios
                                            SET borrado = 'no'
                                            WHERE id='$id'");


            return $result;

        }


        /**
         * Función que devuelve el ultimo id de la tabla usuarios + 1.
         * @return El ultimo id de la tabla usuarios + 1.
         */
        public function getLastId() {
            
            $result = $this->db->consulta("SELECT max(id)+1 as id
                                            FROM poliusuarios");

            return $result[0]->id;

        }


        /**
         * Función que devuelve los roles de un usuario concreto.
         * @param id El id del usuario a consultar.
         * @return Un objeto con los roles de la persona extraídos de la BD, o null en caso de error.
         */
        public function getRoles($id) {
            
            $result = $this->db->consulta("SELECT pr.id as id, pr.nombre as nombre
                                            FROM poliroles pr
                                            INNER JOIN poliusuariosroles pur
                                                ON pr.id = pur.idRol
                                            WHERE pur.idUsuario = '$id'");

            return $result;

        }

        /**
         * Función que devuelve la cantidad de roles de un usuario.
         * * @param id El id del usuario a consultar.
         * @return La cantidad de roles de un usuario.
         */
        public function getNumRoles($id) {

            $result = $this->db->consulta("SELECT count(pur.idRol) as numRoles
                                            FROM poliusuarios pu
                                            INNER JOIN poliusuariosroles pur
                                                ON pu.id = pur.idUsuario
                                            WHERE pur.idUsuario = '$id'");

            return $result[0]->numRoles;

        }


        /**
         * Función que busca usuarios en la bd.
         * * @param texto El texto a buscar
         * @return Un array con los usuarios encontrados.
         */
        public function busqueda($texto) {

            $result = $this->db->consulta("SELECT *
                                            FROM poliusuarios
                                            WHERE 
                                                (usuario LIKE '%$texto%'
                                                OR
                                                email LIKE '%$texto%'
                                                OR
                                                nombre LIKE '%$texto%'
                                                OR
                                                apellido1 LIKE '%$texto%'
                                                OR
                                                apellido2 LIKE '%$texto%'
                                                OR
                                                dni LIKE '%$texto%')
                                                AND
                                                NOT borrado = 'si'");
            
            return $result;

        }


        /**
         * Función que devuelve un campo concreto de un usuario concreto.
         * @param id El usuario deseado.
         * @param campo El campo a extraer de la bd.
         * @return El valor del campo extraido directamente de la bd.
         */
        public function getCampo($id,$campo) {

            $result = $this->db->consulta("SELECT $campo
                                            FROM poliusuarios
                                            WHERE id='$id'");

            return $result[0]->$campo;

        }


        /**
         * Función que devuelve las reservas de un usuario concreto.
         * @param id El id del usuario deseado.
         * @return Un array con todas las reservas de dicho usuario.
         */
        public function getReservas($id) {
            
            $result = $this->db->consulta("SELECT *
                                            FROM polireservas
                                            WHERE idUsuario = '$id'");

            return $result;

        }

    }