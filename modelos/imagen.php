<?php

    include_once('usuario.php');
    include_once('instalacion.php');

    class Imagen {

        public function subir($imagen, $id, $tipo, $objeto) {

            $objetoNuevo = new $objeto();

            if ($imagen["error"] == 4) { // Si no se ha introducido ninguna imagen, no la actualizamos en la bd.

                if ($objetoNuevo->getCampo($id, 'imagen') == null) {
                    $rutaImagen = "img/".$tipo."/default.jpg";    
                } else {
                    $rutaImagen = $objetoNuevo->getCampo($id, 'imagen');    
                }
                            
    
            } else {
    
                $ext = pathinfo($imagen["name"], PATHINFO_EXTENSION);

                if ($ext == "jpg" || $ext == "png" || $ext == "bmp") {

                    if ($imagen["size"] <= 1000000) {

                        $rutaImagen = 'img/'.$tipo.'/' . $id . "." . pathinfo($imagen["name"], PATHINFO_EXTENSION);
                        move_uploaded_file($imagen["tmp_name"],$rutaImagen);

                    }

                }
    
            }

            return $rutaImagen;
       
        }

    }