<?php

    class Imagen {

        public function subir($imagen, $usuario, $tipo) {

            if ($imagen["error"] == 4) { // Si no se ha introducido ninguna imagen, no la actualizamos en la bd.

                $rutaImagen = "img/".$tipo."/default.jpg";                
    
            } else {
    
                $ext = pathinfo($imagen["name"], PATHINFO_EXTENSION);

                if ($ext == "jpg" || $ext == "png" || $ext == "bmp") {

                    if ($imagen["size"] <= 1000000) {

                        $rutaImagen = 'img/usuarios/' . $usuario . "." . pathinfo($imagen["name"], PATHINFO_EXTENSION);
                        move_uploaded_file($imagen["tmp_name"],$rutaImagen);

                    }

                }
    
            }

            return $rutaImagen;
       
        }

    }